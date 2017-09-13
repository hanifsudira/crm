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



query = "select t2.order_num AS ORDER#, t1.row_id AS ROW_ID, t1.asset_integ_id AS INT_ID, t2.rev_num AS REV, t3.name AS PRODUCT, t2.status_cd AS OH_STATUS, t1.status_cd AS LI_STATUS, t1.milestone_code AS MILESTONE, t4.attrib_05 AS ORDER_SUBTYPE, To_char(t1.created + 7 / 24, 'dd-Mon-yyyy hh24:mi:ss') AS CREATED_AT, t6.x_pti1_accnt_nas AS ACC_NAS, t10.x_pti1__nipnas AS NIPNAS, T7.work_ph_num AS WORK_PHONE, T8.latitude, T8.longitude, t10.loc as CA, t6.loc as BA, t9.loc as SA, t11.fst_name || ' ' || t11.last_name as CA_CONT, t12.fst_name || ' ' || t12.last_name as BA_CONT FROM sblprd.s_order t2 left join sblprd.s_order_item t1 on t1.order_id = t2.row_id left join sblprd.s_prod_int t3 ON t3.row_id = t1.prod_id left join sblprd.s_order_x t4 ON t4.par_row_id = t2.row_id left join sblprd.s_org_ext t6 ON t6.row_id = T1.bill_accnt_id left join sblprd.s_org_ext t9 ON t9.row_id = T1.serv_accnt_id left join sblprd.s_org_ext t10 ON t10.row_id = T1.owner_account_id left join sblprd.s_contact t7 ON t7.row_id = t9.pr_con_id left join sblprd.s_addr_per t8 ON t8.row_id = t9.pr_addr_id left join sblprd.s_contact t11 ON t11.row_id = t10.pr_con_id left join sblprd.s_contact t12 ON t12.row_id = t6.pr_con_id WHERE T1.created > To_date('22/07/2017', 'DD/MM/YYYY') AND t2.rev_num = (SELECT Max(rev_num) FROM sblprd.s_order x WHERE x.order_num = t2.order_num) AND t2.order_num = '"+order_num+"' ORDER BY t2.order_num" 
result = cursor.execute(query).fetchall()
	
if result:
	mareturn = json.dumps(result)
	print mareturn
# else:
# 	query = querynwp
# 	result = cursor.execute(query).fetchall()
# 	mareturn = json.dumps(result)
# 	print mareturn