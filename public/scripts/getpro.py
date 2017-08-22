#!/usr/bin/python
import MySQLdb,sys,datetime,os,json
os.environ['LD_LIBRARY_PATH'] = '/usr/lib/oracle/11.2/client64/lib'
import cx_Oracle
reload(sys)
sys.setdefaultencoding('utf-8')

order_num = str(sys.argv[1]).strip()
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

query = "select t2.name product,t1.status_cd status,t1.serial_num Service_ID,t3.name BA,t4.name BP,t1.start_dt start_date,t1.end_dt end_date,t1.x_bill_start_dt Bill_START,t5.agree_num AGREEMENT from sblprd.s_asset t1 left join sblprd.s_prod_int t2 on t2.row_id = t1.prod_id left join sblprd.s_org_ext t3 on t3.par_row_id = t1.bill_accnt_id left join sblprd.s_inv_prof t4 on t4.row_id = t1.bill_profile_id left join sblprd.s_doc_agree t5 on t5.row_id = t1.cur_agree_id left join sblprd.s_org_ext t6 on t6.par_row_id = t1.serv_acct_id where t6.ou_num = '"+order_num+"'"
result = cursor.execute(query).fetchall()
	
mareturn = json.dumps(result)
print mareturn
