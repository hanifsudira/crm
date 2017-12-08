#!/usr/bin/python
import cx_Oracle,requests,datetime,MySQLdb,json,sys

reload(sys)
sys.setdefaultencoding('utf-8')

#mysql
db = MySQLdb.connect(host="127.0.0.1", user="telkom", passwd="telkom", db="crm_dashboard")
cur = db.cursor()

sqltruncate = 'TRUNCATE TABLE oraexcel';
cur.execute(sqltruncate)

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()
#query = "select t2.order_num, t4.attrib_05 as order_subtype , t2.status_cd as oh_status, t1.row_id as moli_row_id, to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as moli_created_dt, to_char(t1.last_upd+7/24, 'dd-Mon-yyyy hh24:mi:ss') as moli_last_updated_dt, t3.name as moli_product_name, t1.status_cd as moli_status, t1.fulflmnt_status_cd as moli_fulfillment_status , t1.milestone_code as moli_milestone, t1.service_num as moli_service_id, t1.asset_integ_id as moli_asset_integ_id, t1.x_bill_start_dt as moli_bill_start_dt, t5.agree_num as moli_agree_num from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id left outer join sblprd.s_doc_agree t5 on t5.row_id = t1.agree_id where t1.row_id = t1.root_order_item_id and t2.status_cd != 'Complete'order by t2.order_num, t1.ln_num"
query = "select t2.order_num, t4.attrib_05 as order_subtype , t2.status_cd as oh_status, t1.row_id as moli_row_id, to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as moli_created_dt, to_char(t1.last_upd+7/24, 'dd-Mon-yyyy hh24:mi:ss') as moli_last_updated_dt, t3.name as moli_product_name, t1.status_cd as moli_status, t1.fulflmnt_status_cd as moli_fulfillment_status, t1.milestone_code as moli_milestone, t1.service_num as moli_service_id, t1.asset_integ_id as moli_asset_integ_id, t1.x_bill_start_dt as moli_bill_start_dt, t5.agree_num as moli_agree_num from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id left outer join sblprd.s_doc_agree t5 on t5.row_id = t1.agree_id where t1.row_id = t1.root_order_item_id and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num and status_cd not in ('Abandoned')) order by t2.order_num, t1.ln_num"
result = cursor.execute(query)

now = str(datetime.datetime.now())

for data in result:
	ORDER_NUM  				= str(data[0]).strip()
	ORDER_SUBTYPE           = str(data[1]).strip()
	OH_STATUS               = str(data[2]).strip()
	MOLI_ROW_ID     		= str(data[3]).strip()
	MOLI_CREATED_DT         = str(data[4]).strip()
	MOLI_LAST_UPDATED_DT    = str(data[5]).strip()
	MOLI_PRODUCT_NAME       = str(data[6]).strip()
	MOLI_STATUS             = str(data[7]).strip()
	MOLI_FULFILLMENT_STATUS = str(data[8]).strip()
	MOLI_MILESTONE          = str(data[9]).strip()
	MOLI_SERVICE_ID         = str(data[10]).strip()
	MOLI_ASSET_INTEG_ID     = str(data[11]).strip()
	MOLI_BILL_ 				= str(data[12]).strip()
	MOLI_AGREE_NUM          = str(data[13]).strip()
	sql                		= "insert into oraexcel (ORDER_NUM,ORDER_SUBTYPE,OH_STATUS,MOLI_ROW_ID,MOLI_CREATED_DT,MOLI_LAST_UPDATED_DT,MOLI_PRODUCT_NAME,MOLI_STATUS,MOLI_FULFILLMENT_STATUS,MOLI_MILESTONE,MOLI_SERVICE_ID,MOLI_ASSET_INTEG_ID,MOLI_BILL_,MOLI_AGREE_NUM,lastupdate) values('"+ORDER_NUM+"','"+ORDER_SUBTYPE+"','"+OH_STATUS+"','"+MOLI_ROW_ID+"','"+MOLI_CREATED_DT+"','"+MOLI_LAST_UPDATED_DT+"','"+MOLI_PRODUCT_NAME+"','"+MOLI_STATUS+"','"+MOLI_FULFILLMENT_STATUS+"','"+MOLI_MILESTONE+"','"+MOLI_SERVICE_ID+"','"+MOLI_ASSET_INTEG_ID+"','"+MOLI_BILL_+"','"+MOLI_AGREE_NUM+"','"+now+"')"
	cur.execute(sql)
db.commit()
cur.close()
db.close()