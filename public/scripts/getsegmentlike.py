#!/usr/bin/python
import cx_Oracle,requests,MySQLdb,sys,datetime,json
from bs4 import BeautifulSoup

reload(sys)
sys.setdefaultencoding('utf-8')

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

orasql = "select T1.agree_num AS agree_num, t1.NAME AS agree_name, T1.rev_num AS rev, t1.stat_cd AS status, T1.agree_type_cd AS type, T1.eff_start_dt AS start_date, t1.eff_end_dt AS end_date, T2.agree_num AS num_parent, T2.rev_num AS rev_parent, T3.x_pti1_segment AS segmen, t4.service_num AS sid_num, t5.NAME AS cc, t6.order_num AS order#, t9.login AS am_primary, t10.NAME AS PRODUCT FROM sblprd.s_doc_agree t1 LEFT JOIN sblprd.s_doc_agree t2 ON t2.row_id = t1.par_agree_id LEFT JOIN sblprd.s_org_ext t3 ON t3.row_id = T1.target_ou_id LEFT JOIN sblprd.s_order_item t4 ON t4.agree_id = t1.row_id LEFT JOIN sblprd.s_org_ext t5 ON t5.row_id = t4.owner_account_id LEFT JOIN sblprd.s_order t6 ON t6.row_id = t4.order_id LEFT JOIN sblprd.s_agree_postn t7 ON t7.agree_id = t1.row_id LEFT JOIN sblprd.s_postn t8 ON t8.row_id = t7.postn_id LEFT JOIN sblprd.s_user t9 ON t9.row_id = t8.pr_emp_id LEFT JOIN sblprd.s_prod_int t10 ON t10.row_id = t4.prod_id"
result = cursor.execute(orasql).fetchall()
#mysql
db 		= MySQLdb.connect(host="10.62.170.36", port=3310, user="telkom", passwd="telkom", db="crm_dashboard")
cur 	= db.cursor()
sqltruncate = 'TRUNCATE TABLE segment_line';
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
	SID_NUM 		= str(data[10]).replace("'","\\'")
	CC 				= str(data[11]).replace("'","\\'")
	ORDER_NUM 		= str(data[12]).replace("'","\\'")
	AM_PRIMARY		= str(data[13]).replace("'","\\'")
	AM_PRIMARY 		= 'None' if AM_PRIMARY in forbid else AM_PRIMARY
	PRODUCT 		= str(data[14]).replace("'","\\'")
	sql 			= "insert into segment_line (AGREE_NUM, AGREE_NAME, REV, STATUS, TYPE, START_DATE, END_DATE, NUM_PARENT, REV_PARENT, SEGMEN, lastupdate, SID_NUM, CC, ORDER_NUM, AM_PRIMARY, PRODUCT) values('"+AGREE_NUM+"','"+AGREE_NAME+"','"+REV+"','"+STATUS+"','"+TYPE+"','"+START_DATE+"','"+END_DATE+"','"+NUM_PARENT+"','"+REV_PARENT+"','"+SEGMEN+"','"+now+"','"+SID_NUM+"','"+CC+"','"+ORDER_NUM+"','"+AM_PRIMARY+"','"+PRODUCT+"')"
	cur.execute(sql)
db.commit()