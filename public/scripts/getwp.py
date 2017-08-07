#!/usr/bin/python
import MySQLdb,sys,datetime,os
os.environ['LD_LIBRARY_PATH'] = '/usr/lib/oracle/11.2/client64/lib'
import cx_Oracle

reload(sys)
sys.setdefaultencoding('utf-8')

order_num = str(sys.argv[2]).strip()
check = sys.argv[3]

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

querynwp = "select t2.order_num as ORDER#, t2.rev_num as REV, t3.name as PRODUCT, t2.status_cd as OH_STATUS, t1.status_cd as LI_STATUS, t1.milestone_code as MILESTONE, t4.attrib_05 as ORDER_SUBTYPE, to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as CREATED_AT, t6.X_PTI1_ACCNT_NAS as ACC_NAS, t6.X_PTI1__NIPNAS as NIPNAS, T8.LATITUDE, T8.LONGITUDE from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id inner join sblprd.s_org_ext t6 on t6.row_id = T2.BILL_ACCNT_ID inner join sblprd.s_org_ext t9 on t9.row_id = T2.serv_accnt_id inner join sblprd.s_addr_per t8 on t8.row_id t9.pr_addr_id where T1.CREATED > TO_DATE ('22/07/2017','DD/MM/YYYY') and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num) and t2.order_num = '"+order_num+"' order by t2.order_num"
querywwp = "select t2.order_num as ORDER#, t2.rev_num as REV, t3.name as PRODUCT, t2.status_cd as OH_STATUS, t1.status_cd as LI_STATUS, t1.milestone_code as MILESTONE, t4.attrib_05 as ORDER_SUBTYPE, to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as CREATED_AT, t6.X_PTI1_ACCNT_NAS as ACC_NAS, t6.X_PTI1__NIPNAS as NIPNAS, T7.WORK_PH_NUM as WORK_PHONE, T8.LATITUDE, T8.LONGITUDE from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id inner join sblprd.s_org_ext t6 on t6.row_id = T2.BILL_ACCNT_ID inner join sblprd.s_org_ext t9 on t9.row_id = T2.serv_accnt_id inner join sblprd.s_contact t7 on t7.row_id = t9.pr_con_id inner join sblprd.s_addr_per t8 on t8.row_id t9.pr_addr_id where T1.CREATED > TO_DATE ('22/07/2017','DD/MM/YYYY') and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num) and t2.order_num = '"+order_num+"' order by t2.order_num"


query = querywwp if (check=='1') else querynwp

result = cursor.execute(query)

rowdict = {}

for i,col in enumerate(result):
	rowdict[col] = result[i]

print rowdict