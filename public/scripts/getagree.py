#!/usr/bin/python
import cx_Oracle,requests,MySQLdb,sys,datetime
from bs4 import BeautifulSoup

reload(sys)
sys.setdefaultencoding('utf-8')

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

print 'agree query process'
orasql = "select t2.name as agg_name,t2.agree_num as agg_num,t2.rev_num as rev_num,t2.par_agree_id as parent,t4.name as product,t2.agree_type_cd as agg_type,t4.billing_type_cd as prod from sblprd.s_doc_agree t2 left join sblprd.s_asset t3 on t3.cur_agree_id = t2.row_id left join sblprd.s_prod_int t4 on t4.row_id = t3.prod_id where (t4.billing_type_cd = 'Service Bundle' or t4.billing_type_cd is null) order by t2.agree_num"
result = cursor.execute(orasql).fetchall()

#mysql
db 		= MySQLdb.connect(host="10.62.170.36", port=3310, user="telkom", passwd="telkom", db="crm_dashboard")
cur 	= db.cursor()

sqltruncate = 'TRUNCATE TABLE tree';
cur.execute(sqltruncate)

now = str(datetime.datetime.now())
print 'Inserting process'
for i,data in enumerate(result):
	AGG_NAME 	= str(data[0]).replace("'","\\'")
	AGG_NUM 	= str(data[1]).replace("'","\\'")
	REV_NUM 	= str(data[2]).replace("'","\\'")
	PARENT 		= str(data[3]).replace("'","\\'")
	PRODUCT 	= str(data[4]).replace("'","\\'")
	AGG_TYPE 	= str(data[5]).replace("'","\\'")
	PROD 		= str(data[6]).replace("'","\\'")	
	sql 			= "insert into tree  values('"+AGG_NAME+"','"+AGG_NUM+"','"+REV_NUM+"','"+PARENT+"','"+PRODUCT+"','"+AGG_TYPE+"','"+PROD+"','"+now+"')"
	cur.execute(sql)
db.commit()