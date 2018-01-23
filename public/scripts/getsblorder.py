#!/usr/bin/python
import cx_Oracle,MySQLdb,sys,time
from bs4 import BeautifulSoup

reload(sys)
sys.setdefaultencoding('utf-8')

start_time = time.time()
#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

print 'Quering process'
orasql = "select T2.order_num AS ORDER_NUM, T2.row_id AS ROW_ID, T7.ATTRIB_05 AS ORDER_SUBTYPE, T3.name AS PRODUCT, T2.status_cd AS OH_STATUS, T1.status_cd AS LI_STATUS, T1.milestone_code AS MILESTONE, T1.fulflmnt_status_cd AS FULFILL_STATUS, To_char(t1.created + 7 / 24, 'dd-Mon-yyyy hh24:mi:ss') AS DATES, T4.X_PTI1_WITEL AS WITEL, T4.x_pti1_segment AS SEGMENT, T4.x_pti1_region AS REGION, T4.ou_type_cd AS DIVISI FROM sblprd.s_order_item T1 left join sblprd.s_order T2 ON T2.row_id = T1.order_id left join sblprd.s_prod_int T3 ON T3.row_id = T1.prod_id left join sblprd.s_org_ext T4 ON T4.row_id = T1.owner_account_id left join sblprd.s_doc_agree T5 ON T5.row_id = T1.agree_id left join sblprd.s_order_x t7 On t7.par_row_id = t2.row_id WHERE T1.created > To_date('22/07/2017', 'DD/MM/YYYY') AND t2.order_num like '1-%' AND T3.billing_type_cd = 'Service Bundle' AND T2.rev_num =(SELECT Max(rev_num) FROM sblprd.s_order X WHERE X.order_num = T2.order_num AND X.status_cd NOT IN ( 'Abandoned', 'x')) AND (T4.ou_type_cd = 'Business' OR T4.ou_type_cd = 'Government' OR T4.ou_type_cd = 'Enterprise')"
result = cursor.execute(orasql).fetchall()
#mysql
db 		= MySQLdb.connect(host="10.62.170.36", port=3310, user="telkom", passwd="telkom", db="crm_dashboard")
cur 	= db.cursor()

print 'Truncating process'
sqltruncate = 'TRUNCATE TABLE sblorder';
cur.execute(sqltruncate)

print 'Inserting process'
for i,data in enumerate(result):
	ORDER_NUM 		= str(data[0])
	ROW_ID 			= str(data[1])
	ORDER_SUBTYPE 	= str(data[2])
	PRODUCT			= str(data[3])
	OH_STATUS 		= str(data[4])
	LI_STATUS 		= str(data[5])
	MILESTONE 	   	= str(data[6])
	FULFILL_STATUS 	= str(data[7])
	DATES 			= str(data[8])
	WITEL 			= str(data[9])
	SEGMENT 		= str(data[10])
	REGION 			= str(data[11])
	DIVISI 			= str(data[12])
	sql 			= "insert into sblorder (ORDER_NUM, ROW_ID, ORDER_SUBTYPE, PRODUCT, OH_STATUS, LI_STATUS, MILESTONE, FULFILL_STATUS, DATES, WITEL, SEGMENT, REGION, DIVISI) values('"+ORDER_NUM+"', '"+ROW_ID+"', '"+ORDER_SUBTYPE+"', '"+PRODUCT+"', '"+OH_STATUS+"', '"+LI_STATUS+"', '"+MILESTONE+"', '"+FULFILL_STATUS+"', '"+DATES+"', '"+WITEL+"', '"+SEGMENT+"', '"+REGION+"', '"+DIVISI+"')"
	cur.execute(sql)
db.commit()
end_time = time.time()
print end_time - start_time