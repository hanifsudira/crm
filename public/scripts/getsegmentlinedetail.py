#!/usr/bin/python
import MySQLdb,sys,datetime,os,json
os.environ['LD_LIBRARY_PATH'] = '/usr/lib/oracle/11.2/client64/lib'
import cx_Oracle
reload(sys)
sys.setdefaultencoding('utf-8')

order_num = str(sys.argv[1]).strip()
#check = str(sys.argv[2]).strip()
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

# querynwp = "select t2.order_num as ORDER#, t1.row_id as ROW_ID ,t1.asset_integ_id as INT_ID, t2.rev_num as REV, t3.name as PRODUCT, t2.status_cd as OH_STATUS, t1.status_cd as LI_STATUS, t1.milestone_code as MILESTONE, t4.attrib_05 as ORDER_SUBTYPE, to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as CREATED_AT, t6.X_PTI1_ACCNT_NAS as ACC_NAS, t6.X_PTI1__NIPNAS as NIPNAS, T8.LATITUDE, T8.LONGITUDE from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id inner join sblprd.s_org_ext t6 on t6.row_id = T2.BILL_ACCNT_ID inner join sblprd.s_org_ext t9 on t9.row_id = T2.serv_accnt_id inner join sblprd.s_addr_per t8 on t8.row_id = t9.pr_addr_id where T1.CREATED > TO_DATE ('22/07/2017','DD/MM/YYYY') and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num) and t2.order_num = '"+order_num+"' order by t2.order_num"
# querywwp = "select t2.order_num as ORDER#, t1.row_id as ROW_ID ,t1.asset_integ_id as INT_ID, t2.rev_num as REV, t3.name as PRODUCT, t2.status_cd as OH_STATUS, t1.status_cd as LI_STATUS, t1.milestone_code as MILESTONE, t4.attrib_05 as ORDER_SUBTYPE, to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as CREATED_AT, t6.X_PTI1_ACCNT_NAS as ACC_NAS, t6.X_PTI1__NIPNAS as NIPNAS, T7.WORK_PH_NUM as WORK_PHONE, T8.LATITUDE, T8.LONGITUDE from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id inner join sblprd.s_org_ext t6 on t6.row_id = T2.BILL_ACCNT_ID inner join sblprd.s_org_ext t9 on t9.row_id = T2.serv_accnt_id inner join sblprd.s_contact t7 on t7.row_id = t9.pr_con_id inner join sblprd.s_addr_per t8 on t8.row_id = t9.pr_addr_id where T1.CREATED > TO_DATE ('22/07/2017','DD/MM/YYYY') and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num) and t2.order_num = '"+order_num+"' order by t2.order_num"
#query = "select t3.order_num as order_num, t2.name as product, t1.service_num as sid_num from sblprd.s_order_item t1 left join sblprd.s_prod_int t2 on t2.row_id = t1.prod_id left join sblprd.s_order t3 on t3.row_id = t1.order_id where t1.agree_id='"+order_num+"'" 
#query = "select t2.name as product, t1.service_num as sid_num, t4.loc as ca, t5.loc as ba, t6.loc as sa from sblprd.s_order_item t1 left join sblprd.s_prod_int t2 on t2.row_id = t1.prod_id left join sblprd.s_order t3 on t3.row_id = t1.order_id left join sblprd.s_org_ext t4 on t4.par_row_id = t1.owner_account_id left join sblprd.s_org_ext t5 on t5.row_id = t1.bill_accnt_id left join sblprd.s_org_ext t6 on t6.row_id = t1.serv_accnt_id where t1.agree_id='"+order_num+"' and t2.billing_type_cd = 'Service Bundle' and t3.rev_num =(select max(rev_num) from sblprd.s_order x where x.order_num = t3.order_num and x.status_cd not in ('Abandoned','Pending'))"
query = "select t2.asset_num as ASSET_NUM, t3.name AS PRODUCT_NAME, t4.loc AS CUSTOMER_ACCOUNT from sblprd.s_doc_agree t1 left join sblprd.s_asset t2 on t2.cur_agree_id = t1.row_id left join sblprd.s_prod_int t3 on t3.row_id = t2.prod_id left join sblprd.s_org_ext t4 on t4.row_id = t1.target_ou_id where t1.row_id = '"+order_num+"' and t4.accnt_type_cd = 'Customer'"
result = cursor.execute(query).fetchall()
	
if result:
	mareturn = json.dumps(result)
	print mareturn
# else:
# 	query = querynwp
# 	result = cursor.execute(query).fetchall()
# 	mareturn = json.dumps(result)
# 	print mareturn