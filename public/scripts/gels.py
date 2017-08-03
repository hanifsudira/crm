#!/usr/bin/python
import MySQLdb,sys,datetime,os
os.environ['LD_LIBRARY_PATH'] = '/usr/lib/oracle/11.2/client64/lib'
import cx_Oracle

reload(sys)
sys.setdefaultencoding('utf-8')

#mysql
db = MySQLdb.connect(host="10.62.170.36", port=3310, user="telkom", passwd="telkom", db="crm_dashboard")
cur = db.cursor()

sqltruncate = 'TRUNCATE TABLE lineitem_summary';
cur.execute(sqltruncate)

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()
result = cursor.execute(query)

now = str(datetime.datetime.now())

for data in result:
	OH_STATUS		= str(data[0]).strip()
	LI_STATUS		= str(data[1]).strip()
	MILESTONE		= str(data[2]).strip()
	JUMLAH			= str(data[3]).strip()
	sql             = "insert into lineitem_summary (OH_STATUS,LI_STATUS,MILESTONE,JUMLAH,lastupdate) values('"+OH_STATUS+"','"+LI_STATUS+"','"+MILESTONE+"','"+JUMLAH+"','"+now+"')"
	cur.execute(sql)
db.commit()
cur.close()
db.close()