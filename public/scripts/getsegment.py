#!/usr/bin/python
import cx_Oracle,requests,MySQLdb,sys,datetime,json
from bs4 import BeautifulSoup

reload(sys)
sys.setdefaultencoding('utf-8')

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

orasql = "select T1.AGREE_NUM as agree_num ,t1.name as agree_name ,T1.REV_NUM as rev ,t1.stat_cd as status ,T1.AGREE_TYPE_CD as type ,T1.EFF_START_DT as start_date ,t1.eff_end_dt as end_date ,T2.agree_num as num_parent ,T2.rev_num as rev_parent ,T3.X_PTI1_SEGMENT as segmen from sblprd.s_doc_agree t1 left join sblprd.s_doc_agree t2 on t2.row_id = t1.par_agree_id left join sblprd.s_org_ext t3 on t3.row_id = T1.TARGET_OU_ID"
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
	SID_NUM 		= str(data[10]).replace("'","\\'")
	CC 				= str(data[11]).replace("'","\\'")
	ORDER_NUM 		= str(data[12]).replace("'","\\'")
	AM_PRIMARY		= str(data[13]).replace("'","\\'")
	AM_PRIMARY 		= 'None' if AM_PRIMARY in forbid else AM_PRIMARY
	sql 			= "insert into segment (AGREE_NUM, AGREE_NAME, REV, STATUS, TYPE, START_DATE, END_DATE, NUM_PARENT, REV_PARENT, SEGMEN, lastupdate, SID_NUM, CC, ORDER_NUM, AM_PRIMARY) values('"+AGREE_NUM+"','"+AGREE_NAME+"','"+REV+"','"+STATUS+"','"+TYPE+"','"+START_DATE+"','"+END_DATE+"','"+NUM_PARENT+"','"+REV_PARENT+"','"+SEGMEN+"','"+now+"','"+SID_NUM+"','"+CC+"','"+ORDER_NUM+"','"+AM_PRIMARY+"')"
	cur.execute(sql)
db.commit()