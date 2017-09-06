#!/usr/bin/python
import cx_Oracle,requests,MySQLdb,sys,datetime
from bs4 import BeautifulSoup

reload(sys)
sys.setdefaultencoding('utf-8')

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

print 'agree query process'
orasql = "select t1.row_id as ca_id, t2.row_ID agg_id, t1.loc as site ,t2.name as agg_name ,t2.agree_num as agg_num ,t2.rev_num as rev_num ,t2.par_agree_id as parent ,t4.name as product ,t2.agree_type_cd as agg_type ,t4.billing_type_cd as prod from sblprd.s_org_ext t1 left join sblprd.s_doc_agree t2 on t2.target_ou_id = t1.row_id left join sblprd.s_asset t3 on t3.cur_agree_id = t2.row_id left join sblprd.s_prod_int t4 on t4.row_id = t3.prod_id where (t4.billing_type_cd = 'Service Bundle' or t4.billing_type_cd is null) and t1.accnt_type_cd = 'Customer' order by t2.agree_num"
result = cursor.execute(orasql).fetchall()

#mysql
db 		= MySQLdb.connect(host="10.62.170.36", port=3310, user="telkom", passwd="telkom", db="crm_dashboard")
cur 	= db.cursor()

sqltruncate = 'TRUNCATE TABLE tree';
cur.execute(sqltruncate)

now = str(datetime.datetime.now())
print 'Inserting process'
for i,data in enumerate(result):
	CA_ID 		= str(data[0]).replace("'","\\'")
	AGG_ID 		= str(data[1]).replace("'","\\'")
	SITE 		= str(data[2]).replace("'","\\'")
	AGG_NAME 	= str(data[3]).replace("'","\\'")
	AGG_NUM 	= str(data[4]).replace("'","\\'")
	REV_NUM 	= data[5]
	PARENT 		= str(data[6]).replace("'","\\'")
	PRODUCT 	= str(data[7]).replace("'","\\'")
	AGG_TYPE 	= str(data[8]).replace("'","\\'")
	PROD 		= str(data[9]).replace("'","\\'")
	if REV_NUM is None:	
		sql 	= "insert into tree (CA_ID, AGG_ID, SITE, AGG_NAME, AGG_NUM, PARENT, PRODUCT, AGG_TYPE, PROD, lastupdate) values('"+SITE+"','"+AGG_NAME+"','"+AGG_NUM+"','"+PARENT+"','"+PRODUCT+"','"+AGG_TYPE+"','"+PROD+"','"+now+"')"
	else:
		sql 	= "insert into tree (CA_ID, AGG_ID, SITE, AGG_NAME, AGG_NUM, REV_NUM, PARENT, PRODUCT, AGG_TYPE, PROD, lastupdate) values('"+SITE+"','"+AGG_NAME+"','"+AGG_NUM+"','"+str(float(REV_NUM))+"','"+PARENT+"','"+PRODUCT+"','"+AGG_TYPE+"','"+PROD+"','"+now+"')"
	cur.execute(sql)
db.commit()