#!/usr/bin/python
import cx_Oracle,MySQLdb,json,sys

reload(sys)
sys.setdefaultencoding('utf-8')

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()

sqllead 	= "select status_cd as STATUS, COUNT(1) JUMLAH ,decode(status_cd,'Unqualified',1,'Qualified',2,'Converted',3,'Retired',4,99) as STATUS_SEQ from (select * from SBLPRD.S_LEAD t1 where T1.CREATED > TO_DATE ('24/07/2017','DD/MM/YYYY'))group by status_cd order by STATUS_SEQ"
sqlquote 	= "select grouped_status,jumlah,decode(grouped_status,'In Progress',1,'Approval Process',2,'Order Placed',3,'Cancelled',4,99) as status_seq from (select decode(stat_cd,'In Progress','In Progress','Pending Approval','Approval Process','Approved','Approval Process','Rejected','Approval Process','Accepted By Customer','Approval Process','Rejected By Customer','Approval Process','Partial Order Placed','Order Placed','Order Placed','Order Placed','Cancelled','Cancelled','Abandoned','Cancelled','NA') as grouped_status,count(1) jumlah from (SELECT t1.quote_num,t1.stat_cd,to_char(t1.created+7/24, 'dd-Mon-yyyy hh24:mi:ss') as CREATED_AT FROM SBLPRD.S_DOC_QUOTE T1 WHERE T1.CREATED > TO_DATE ('24/07/2017','DD/MM/YYYY')) group by decode(stat_cd,'In Progress','In Progress','Pending Approval','Approval Process','Approved','Approval Process','Rejected','Approval Process','Accepted By Customer','Approval Process','Rejected By Customer','Approval Process','Partial Order Placed','Order Placed','Order Placed','Order Placed','Cancelled','Cancelled','Abandoned','Cancelled','NA')order by grouped_status asc) order by status_seq"
sqlagree	= "select agree_cd as jenis, count(1) jumlah from (select row_id,name,agree_num,agree_cd from sblprd.s_doc_agree t1 where T1.CREATED > TO_DATE ('24/07/2017','DD/MM/YYYY') and T1.CREATED < TO_DATE ('12/08/2017','DD/MM/YYYY') and t1.agree_cd IS NOT NULL) group by agree_cd"
sqlorder	= "select new_status, decode(new_status,'Pending',1,'Submitted',2,'In Progress',3,'Complete',4,'Failed',5,'Cancelled',6,99) as status_seq,jumlah from (select decode(status,'Pending Cancel','Cancelled',status) as new_status,count(1) jumlah from (select distinct t2.order_num,t2.status_cd as status from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id left outer join sblprd.s_doc_agree t5 on t5.row_id = t1.agree_id where T1.CREATED > TO_DATE ('24/07/2017','DD/MM/YYYY') and t1.row_id = t1.root_order_item_id and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num and x.status_cd not in ('Abandoned','x'))) group by decode(status,'Pending Cancel','Cancelled',status))order by status_seq"

querylead 	= cursor.execute(sqllead)
queryquote 	= cursor.execute(sqlquote)
queryagree 	= cursor.execute(sqlagree)
queryorder 	= cursor.execute(sqlorder)
query 		= [querylead,queryquote,queryagree,queryorder]

print json.dumps(query)