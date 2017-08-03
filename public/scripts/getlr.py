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
query = "select t2.order_num as ORDER#, t2.rev_num as REV, t3.name as PRODUCT, t2.status_cd as OH_STATUS, t1.status_cd as LI_STATUS, t1.milestone_code as MILESTONE, t4.attrib_05 as ORDER_SUBTYPE, to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as CREATED_AT, t1.fulflmnt_status_cd as FULFILL_STATUS, t6.X_PTI1_ACCNT_NAS as ACC_NAS, t6.X_PTI1__NIPNAS as NIPNAS, t1.service_num as SID_NUM from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id inner join sblprd.s_org_ext t6 on t6.row_id = T2.BILL_ACCNT_ID left outer join sblprd.s_doc_agree t5 on t5.row_id = t1.agree_id where T1.CREATED > TO_DATE ('24/07/2017','DD/MM/YYYY') and t1.row_id = t1.root_order_item_id and t1.status_cd = 'Cancelled' and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num and x.status_cd not in ('Abandoned','x')) order by t2.order_num"
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
	sql             = "insert into lineitem_report (ORDER,REV,PRODUCT,OH_STATUS,LI_STATUS,MILESTONE,ORDER_SUBTYPE,CREATED_AT,FULFILL_STATUS,ACC_NAS,NIPNAS,SID_NUM,lastupdate) values('"+ORDER+"','"+REV+"','"+PRODUCT+"','"+OH_STATUS+"','"+LI_STATUS+"','"+MILESTONE+"','"+ORDER_SUBTYPE+"','"+CREATED_AT+"','"+FULFILL_STATUS+"','"+ACC_NAS+"','"+NIPNAS+"','"+SID_NUM+"','"+now+"')"
	cur.execute(sql)
db.commit()
cur.close()
db.close()