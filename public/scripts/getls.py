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
query = "select OH_STATUS, LI_STATUS, MILESTONE, COUNT(1) as JUMLAH from (select t2.order_num as ORDER#, t1.row_id as ROW_ID, t4.attrib_05 as ORDER_SUBTYPE, t2.rev_num as REV, t3.name as PRODUCT, t2.status_cd as OH_STATUS, t1.status_cd as LI_STATUS, t1.milestone_code as MILESTONE, to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as CREATED_AT, t1.fulflmnt_status_cd as FULFILL_STATUS, t6.X_PTI1_ACCNT_NAS as ACC_NAS, t6.X_PTI1__NIPNAS as NIPNAS, t1.service_num as SID_NUM, decode(t1.status_cd,'Pending',1,'Submitted',2,'In Progress',3,'Pending BASO',4,'Pending Billing Approval',5,'Complete',6,'Failed',7,'Pending Cancel',8,'Cancelled',9,99) OH_SEQ, decode(t1.milestone_code,NULL,0,'SYNC CUSTOMER START',1,'SYNC CUSTOMER COMPLETE',2,'PROVISION START',3,'PROVISION COMPLETE',4,'BASO STARTED',5,'BILLING APPROVAL STARTED',6,'FULFILL BILLING START',7,'FULFILL BILLING COMPLETE',8,99) MSTONE_SEQ from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id inner join sblprd.s_org_ext t6 on t6.row_id = T2.BILL_ACCNT_ID left outer join sblprd.s_doc_agree t5 on t5.row_id = t1.agree_id where T1.CREATED > TO_DATE ('24/07/2017','DD/MM/YYYY') and t1.row_id = t1.root_order_item_id and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num and x.status_cd not in ('Abandoned','x')) order by OH_SEQ, MSTONE_SEQ) group by OH_STATUS, LI_STATUS, MILESTONE order by OH_STATUS DESC"
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