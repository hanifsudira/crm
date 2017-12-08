#!/usr/bin/python
import cx_Oracle,requests,MySQLdb,sys,datetime,json
from bs4 import BeautifulSoup

reload(sys)
sys.setdefaultencoding('utf-8')

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

#orasql = "select T1.agree_num AS agree_num, t1.NAME AS agree_name, T1.rev_num AS rev, t1.stat_cd AS status, T1.agree_type_cd AS type, T1.eff_start_dt AS start_date, t1.eff_end_dt AS end_date, T2.agree_num AS num_parent, T2.rev_num AS rev_parent, T3.x_pti1_segment AS segmen, t3.loc AS CC, t9.login AS am_primary, t1.row_id AS row_id, t3.name AS CC_Name,(select max(x.order_num) from sblprd.s_order x where x.agree_id=t1.row_id) as last_order_num FROM sblprd.s_doc_agree t1 LEFT JOIN sblprd.s_doc_agree t2 ON t2.row_id = t1.par_agree_id LEFT JOIN sblprd.s_org_ext t3 ON t3.row_id = T1.target_ou_id LEFT JOIN sblprd.s_postn t8 ON t8.row_id = t1.sales_rep_postn_id LEFT JOIN sblprd.s_user t9 ON t9.row_id = t8.pr_emp_id where (select count(*) from sblprd.cx_asset_agree exmp where exmp.x_doc_agree=t1.row_id) > 0"
orasql = "select T1.agree_num AS agree_num, t1.NAME AS agree_name, T1.rev_num AS rev, t1.stat_cd AS status, T1.agree_type_cd AS type, T1.eff_start_dt + 7/24 AS start_date, t1.eff_end_dt + 7/24 AS end_date, T2.agree_num AS num_parent, T2.rev_num AS rev_parent, T3.x_pti1_segment AS segmen, t3.loc AS CC, t9.login AS am_primary, t1.row_id AS row_id, t3.NAME AS CC_Name,(SELECT Max(x.order_num) FROM sblprd.s_order x WHERE x.agree_id = t1.row_id) AS last_order_num FROM sblprd.s_doc_agree t1 LEFT JOIN sblprd.s_doc_agree t2 ON t2.row_id = t1.par_agree_id LEFT JOIN sblprd.s_org_ext t3 ON t3.row_id = T1.target_ou_id LEFT JOIN sblprd.s_postn t8 ON t8.row_id = t1.sales_rep_postn_id LEFT JOIN sblprd.s_user t9 ON t9.row_id = t8.pr_emp_id WHERE (SELECT Count(*) FROM sblprd.cx_asset_agree exmp WHERE exmp.x_doc_agree = t1.row_id) > 0"
result = cursor.execute(orasql).fetchall()
#mysql
db 		= MySQLdb.connect(host="10.62.170.36", port=3310, user="telkom", passwd="telkom", db="crm_dashboard")
cur 	= db.cursor()
sqltruncate = 'TRUNCATE TABLE segment';
cur.execute(sqltruncate)

forbid = ['OC_DES_AM','SADMIN','UNIVERSALQUEUE']

now = str(datetime.datetime.now())
for i,data in enumerate(result):
	AGREE_NUM 		= str(data[0]).replace("'","\\'") 
	AGREE_NAME		= str(data[1]).replace("'","\\'") 
	REV 			= str(data[2]).replace("'","\\'") 
	STATUS 			= str(data[3]).replace("'","\\'") 
	TYPE			= str(data[4]).replace("'","\\'") 
	START_DATE 		= str(data[5]).replace("'","\\'") 
	END_DATE 		= str(data[6]).replace("'","\\'") 
	NUM_PARENT 		= str(data[7]).replace("'","\\'") 
	REV_PARENT 		= str(data[8]).replace("'","\\'") 
	SEGMEN 			= str(data[9]).replace("'","\\'")
	CC 				= str(data[10]).replace("'","\\'")
	AM_PRIMARY		= str(data[11]).replace("'","\\'")
	AM_PRIMARY 		= 'None' if AM_PRIMARY in forbid else AM_PRIMARY
	ROW_ID 			= str(data[12]).replace("'","\\'")
	CC_NAME 		= str(data[13]).replace("'","\\'")
	LAST_ORDER_NUM 	= str(data[14]).replace("'","\\'")
	sql 			= "insert into segment (AGREE_NUM, AGREE_NAME, REV, STATUS, TYPE, START_DATE, END_DATE, NUM_PARENT, REV_PARENT, SEGMEN, lastupdate, CC, AM_PRIMARY, ROW_ID, CC_NAME, LAST_ORDER_NUM) values('"+AGREE_NUM+"','"+AGREE_NAME+"','"+REV+"','"+STATUS+"','"+TYPE+"','"+START_DATE+"','"+END_DATE+"','"+NUM_PARENT+"','"+REV_PARENT+"','"+SEGMEN+"','"+now+"','"+CC+"','"+AM_PRIMARY+"','"+ROW_ID+"','"+CC_NAME+"','"+LAST_ORDER_NUM+"')"
	cur.execute(sql)
db.commit()