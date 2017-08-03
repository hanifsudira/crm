#!/usr/bin/python
import MySQLdb,sys,datetime,os
os.environ['LD_LIBRARY_PATH'] = '/usr/lib/oracle/11.2/client64/lib'
import cx_Oracle

reload(sys)
sys.setdefaultencoding('utf-8')

#mysql
db = MySQLdb.connect(host="10.62.170.36", port=3310, user="telkom", passwd="telkom", db="crm_dashboard")
cur = db.cursor()

sqltruncate = 'TRUNCATE TABLE lineitem_report';
cur.execute(sqltruncate)

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()
result = cursor.execute(query)

now = str(datetime.datetime.now())

for data in result:
	ORDER			= str(data[0]).strip()
	REV				= str(data[1]).strip()
	PRODUCT			= str(data[2]).strip()
	OH_STATUS		= str(data[3]).strip()
	LI_STATUS		= str(data[4]).strip()
	MILESTONE		= str(data[5]).strip()
	ORDER_SUBTYPE	= str(data[6]).strip()
	CREATED_AT		= str(data[7]).strip()
	FULFILL_STATUS	= str(data[8]).strip()
	ACC_NAS			= str(data[9]).strip()
	NIPNAS			= str(data[10]).strip()
	SID_NUM			= str(data[11]).strip()
	sql             = "insert into lineitem_report (ORDER#,REV,PRODUCT,OH_STATUS,LI_STATUS,MILESTONE,ORDER_SUBTYPE,CREATED_AT,FULFILL_STATUS,ACC_NAS,NIPNAS,SID_NUM,lastupdate) values('"+ORDER+"','"+REV+"','"+PRODUCT+"','"+OH_STATUS+"','"+LI_STATUS+"','"+MILESTONE+"','"+ORDER_SUBTYPE+"','"+CREATED_AT+"','"+FULFILL_STATUS+"','"+ACC_NAS+"','"+NIPNAS+"','"+now+"')"
	cur.execute(sql)
db.commit()
cur.close()
db.close()