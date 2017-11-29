#!/usr/bin/python
import MySQLdb,sys,datetime,os
os.environ['LD_LIBRARY_PATH'] = '/usr/lib/oracle/11.2/client64/lib'
import cx_Oracle

reload(sys)
sys.setdefaultencoding('utf-8')

#mysql
db = MySQLdb.connect(host="10.62.170.36", port=3310, user="telkom", passwd="telkom", db="crm_dashboard")
cur = db.cursor()

sqltruncate = 'TRUNCATE TABLE order_summary';
cur.execute(sqltruncate)

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()
query = "select status, count(1) jumlah from(select distinct t2.order_num,t2.status_cd as status from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id left outer join sblprd.s_doc_agree t5 on t5.row_id = t1.agree_id where T1.CREATED > TO_DATE ('24/07/2017','DD/MM/YYYY') and t1.row_id = t1.root_order_item_id and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num and x.status_cd not in ('Abandoned','x'))) group by status"
result = cursor.execute(query)

now = str(datetime.datetime.now())

for data in result:
	STATUS			= str(data[0]).strip()
	JUMLAH			= str(data[1]).strip()
	sql             = "insert into order_summary (STATUS,JUMLAH,lastupdate) values('"+STATUS+"','"+JUMLAH+"','"+now+"')"
	cur.execute(sql)
db.commit()
cur.close()
db.close()