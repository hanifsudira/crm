#!/usr/bin/python
import cx_Oracle,requests,sys,datetime,json, MySQLdb
from bs4 import BeautifulSoup

def chunkIt(seq, num):
    avg = len(seq) / float(num)
    out = []
    last = 0.0

    while last < len(seq):
        out.append(seq[int(last):int(last + avg)])
        last += avg

    return out

reload(sys)
sys.setdefaultencoding('utf-8')

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()
con2 = cx_Oracle.connect('tosdb/telkom#123@10.60.185.132/tosdb')
cursor2 = con2.cursor()

print 'Line items query process'
orasql = "select t2.order_num, t1.service_num, t4.NAME, t1.status_cd, t1.milestone_code, t1.created, t3.attrib_05, t1.asset_integ_id, t9.login as am FROM sblprd.s_order_item t1 LEFT JOIN sblprd.s_order t2 ON t2.row_id = t1.order_id LEFT JOIN sblprd.s_order_x t3 ON t3.par_row_id = t2.row_id LEFT JOIN sblprd.s_prod_int t4 ON t4.row_id = t1.prod_id LEFT JOIN sblprd.s_doc_agree t5 ON t5.row_id = t1.agree_id LEFT JOIN sblprd.s_postn t6 ON t6.row_id = t5.sales_rep_postn_id LEFT JOIN sblprd.s_user t9 ON t9.row_id = t6.pr_emp_id WHERE(t1.created >= To_date('22/07/2017', 'DD/MM/YYYY') AND t1.created < To_date('1/11/2017', 'DD/MM/YYYY') OR t1.created >= To_date('2/11/2017', 'DD/MM/YYYY')) AND t2.order_num like '1-%' AND t2.rev_num = (SELECT Max(rev_num) FROM sblprd.s_order X WHERE X.order_num = T2.order_num AND X.status_cd NOT IN ( 'Abandoned', 'x')) AND t4.billing_type_cd = 'Service Bundle' AND t3.attrib_05 IN( 'Suspend', 'Resume' )"
result = cursor.execute(orasql).fetchall()

#mysql
db 		= MySQLdb.connect(host="10.62.170.36", port=3310, user="telkom", passwd="telkom", db="crm_dashboard")
cur 	= db.cursor()
sqltruncate = 'TRUNCATE TABLE nst';
cur.execute(sqltruncate)
now = str(datetime.datetime.now())

tomsom = requests.get('http://10.62.170.36:1234/report/tomsomget')
tomsom = json.loads(tomsom.content)

ordertibs = [str(data[0]) for data in result]
chunkordertibs = chunkIt(ordertibs, len(ordertibs)/500)

templist = []
for mylist in chunkordertibs:
	query = "select distinct(CUST_ORDER_NUM), PRODUCT_STATUS,EFFECTIVE_DTM, STATUS_REASON_TXT from v_np_productstatus where cust_order_num in "+str(tuple(mylist))
	templist.append(cursor2.execute(query).fetchall())

flat_list = [item for sublist in templist for item in sublist]

mydict = {}
for item in flat_list:
	if item[0] not in mydict:
		mydict[str(item[0])] = [item[1],item[2],item[3]]

now = str(datetime.datetime.now())
print 'Inserting process'
for i,data in enumerate(result):
	ORDER_NUM 		= str(data[0])
	SERVICE_NUM 	= str(data[1])
	NAME 			= str(data[2])
	STATUS_CD  		= str(data[3])
	MILESTONE_CODE 	= str(data[4])
	CREATED 		= str(data[5]) 
	ATTRIB_05 		= str(data[6])
	ASSET_INTEG_ID 	= str(data[7])
	AM 				= str(data[8])
	TSQ_STATE		= str(tomsom[ASSET_INTEG_ID]['TSQ_STATE']) if ASSET_INTEG_ID in tomsom.keys() and len(tomsom) > 0 else 'None'
	TSQ_DESC		= str(tomsom[ASSET_INTEG_ID]['TSQ_DESC']) if ASSET_INTEG_ID in tomsom.keys() and len(tomsom) > 0 else 'None'
	DELIVER_STATE	= str(tomsom[ASSET_INTEG_ID]['DELIVER_STATE']) if ASSET_INTEG_ID in tomsom.keys() and len(tomsom) > 0 else 'None' 
	DELIVER_DESC	= str(tomsom[ASSET_INTEG_ID]['DELIVER_DESC']) if ASSET_INTEG_ID in tomsom.keys() and len(tomsom) > 0 else 'None'
	PRODUCT_STATUS	= str(mydict[ORDER_NUM][0]) if ORDER_NUM in mydict else 'None'
	EFFECTIVE_DTM	= str(mydict[ORDER_NUM][1]) if ORDER_NUM in mydict else 'None'
	STATUS_REASON_TXT = str(mydict[ORDER_NUM][2]) if ORDER_NUM in mydict else 'None'
	sql 			= "insert into nst (ORDER_NUM,SERVICE_NUM,NAME,STATUS_CD,MILESTONE_CODE,CREATED,ATTRIB_05,ASSET_INTEG_ID,TSQ_STATE,TSQ_DESC,DELIVER_STATE,DELIVER_DESC,PRODUCT_STATUS,EFFECTIVE_DTM,STATUS_REASON_TXT, AM, LASTUPDATE) values('"+ORDER_NUM+"','"+SERVICE_NUM+"','"+NAME+"','"+STATUS_CD+"','"+MILESTONE_CODE+"','"+CREATED+"','"+ATTRIB_05+"','"+ASSET_INTEG_ID+"','"+TSQ_STATE+"','"+TSQ_DESC+"','"+DELIVER_STATE+"','"+DELIVER_DESC+"','"+PRODUCT_STATUS+"','"+EFFECTIVE_DTM+"','"+STATUS_REASON_TXT+"','"+AM+"','"+now+"')"
	cur.execute(sql)
db.commit()

