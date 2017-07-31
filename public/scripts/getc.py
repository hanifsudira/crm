#!/usr/bin/python
import cx_Oracle,MySQLdb,sys,datetime

reload(sys)
sys.setdefaultencoding('utf-8')

#mysql
db = MySQLdb.connect(host="127.0.0.1", user="telkom", passwd="telkom", db="crm_dashboard")
cur = db.cursor()

sqltruncate = 'TRUNCATE TABLE oracount';
cur.execute(sqltruncate)

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()
#query = "select t2.order_num, t4.attrib_05 as order_subtype , t2.status_cd as oh_status, t1.row_id as moli_row_id, to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as moli_created_dt, to_char(t1.last_upd+7/24, 'dd-Mon-yyyy hh24:mi:ss') as moli_last_updated_dt, t3.name as moli_product_name, t1.status_cd as moli_status, t1.fulflmnt_status_cd as moli_fulfillment_status, t1.milestone_code as moli_milestone, t1.service_num as moli_service_id, t1.asset_integ_id as moli_asset_integ_id, t1.x_bill_start_dt as moli_bill_start_dt, t5.agree_num as moli_agree_num from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id left outer join sblprd.s_doc_agree t5 on t5.row_id = t1.agree_id where t1.row_id = t1.root_order_item_id and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num and status_cd not in ('Abandoned')) order by t2.order_num, t1.ln_num"
query = "select  status status_order, moli_fulfillment_status status_fulfillment,moli_milestone milestone, count(*) jumlah from (select t2.order_num, t4.attrib_05 as order_subtype , t2.status_cd as status, t1.row_id as moli_row_id, to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as moli_created_dt, to_char(t1.last_upd+7/24, 'dd-Mon-yyyy hh24:mi:ss') as moli_last_updated_dt, t3.name as moli_product_name, t1.status_cd as moli_status, t1.fulflmnt_status_cd as moli_fulfillment_status, t1.milestone_code as moli_milestone, t1.service_num as moli_service_id, t1.asset_integ_id as moli_asset_integ_id, t1.x_bill_start_dt as moli_bill_start_dt, t5.agree_num as moli_agree_num from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id left outer join sblprd.s_doc_agree t5 on t5.row_id = t1.agree_id where t1.row_id = t1.root_order_item_id and t1.status_cd not in('Abandoned','Cancelled') and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num and x.status_cd not in ('Abandoned','x'))) group by status, moli_milestone, moli_fulfillment_status order by 1"
result = cursor.execute(query)

now = str(datetime.datetime.now())

for data in result:
	STATUS_ORDER  		= str(data[0]).strip()
	STATUS_FULFILLMENT  = str(data[1]).strip()
	MILESTONE       	= str(data[2]).strip()
	JUMLAH     			= str(data[3]).strip()
	sql                	= "insert into oracount (STATUS_ORDER,STATUS_FULFILLMENT,MILESTONE,JUMLAH,lastupdate) values('"+STATUS_ORDER+"','"+STATUS_FULFILLMENT+"','"+MILESTONE+"','"+JUMLAH+"','"+now+"')"
	cur.execute(sql)
db.commit()
cur.close()
db.close()