import cx_Oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

query = "select " \
          "t2.order_num, " \
          "t4.attrib_05 as order_subtype , " \
          "t2.status_cd as oh_status, " \
          "t1.row_id as moli_row_id, " \
          "to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as moli_created_dt, " \
          "to_char(t1.last_upd+7/24, 'dd-Mon-yyyy hh24:mi:ss') as moli_last_updated_dt, " \
          "t3.name as moli_product_name, " \
          "t1.status_cd as moli_status, " \
          "t1.fulflmnt_status_cd as moli_fulfillment_status , " \
          "t1.milestone_code as moli_milestone, " \
          "t1.service_num as moli_service_id, " \
          "t1.asset_integ_id as moli_asset_integ_id, " \
          "t1.x_bill_start_dt as moli_bill_start_dt, " \
          "t5.agree_num as moli_agree_num " \
        "from " \
          "sblprd.s_order_item t1 " \
          "inner join sblprd.s_order t2 on t2.row_id = tinstantclient_11_21.order_id " \
          "inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id " \
          "inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id " \
          "left outer join sblprd.s_doc_agree t5 on t5.row_id = t1.agree_id " \
        "where " \
          "t1.row_id = t1.root_order_item_id and t2.status_cd != 'Complete' order by t2.order_num, t1.ln_num;"

result = cursor.execute(query)
print result
