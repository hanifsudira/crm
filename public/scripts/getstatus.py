import cx_Oracle,requests,MySQLdb,sys,datetime,json,csv
from bs4 import BeautifulSoup

reload(sys)
sys.setdefaultencoding('utf-8')

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

with open('status.txt','rb') as f:
	for line in f.read():
		orasql "select t2.status_cd AS OH_STATUS, t1.status_cd AS LI_STATUS, t1.milestone_code AS MILESTONE, t1.fulflmnt_status_cd AS FULFILL_STATUS from sblprd.s_order_item t1 left join sblprd.s_order t2 on t2.row_id = t1.order_id where t2.order_num = '"+line[0].strip()+"'"
		result = cursor.execute(orasql).fetchall()
		for data in result:
			with open('new.txt','ab+') as nf:
				strn = str(data[0])+' '+str(data[1])+' '+str(data[2])+str(data[3])+'\n'
				newf = nf.write(strn)
