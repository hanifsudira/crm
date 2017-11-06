import cx_Oracle
import csv , sys

reload(sys)
sys.setdefaultencoding('utf-8')

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

with open('sid.csv','rb') as f:
	reader = csv.reader(f)
	for line in reader:
		sid = line[0]
		print sid
		orasql = "select t2.order_num, t2.status_cd, t1.status_cd, t1.milestone_code, t1.fulflmnt_status_cd from sblprd.s_order_item t1 left join sblprd.s_order t2 on t2.row_id = t1.order_id left join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id where t1.service_num = '"+sid+"' and t3.billing_type_cd = 'Service Bundle'"
		result = cursor.execute(orasql).fetchall()
		for data in result:
			with open('reverse.txt','ab+') as nf:
				if str(data[1]) != 'Complete':
					strn = sid+';'+str(data[0])+';'+str(data[1])+';'+str(data[2])+';'+str(data[3])+';'+str(data[4])+'\n'
					newf = nf.write(strn)
