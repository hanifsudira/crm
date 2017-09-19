#!/usr/bin/python
import cx_Oracle,requests,MySQLdb,sys,datetime,json
from bs4 import BeautifulSoup

reload(sys)
sys.setdefaultencoding('utf-8')

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()
print 'Line items query process'
#orasql = "select t2.order_num AS ORDER#, t1.row_id AS ROW_ID, t4.attrib_05 AS ORDER_SUBTYPE, t2.rev_num AS REV, t3.name AS PRODUCT, t2.status_cd AS OH_STATUS, t1.status_cd AS LI_STATUS, t1.milestone_code AS MILESTONE, To_char(t1.created + 7 / 24, 'dd-Mon-yyyy hh24:mi:ss') AS CREATED_AT, t1.fulflmnt_status_cd AS FULFILL_STATUS, t6.x_pti1_accnt_nas AS ACC_NAS, t6.x_pti1__nipnas AS NIPNAS, t1.service_num AS SID_NUM, Decode(t1.status_cd, 'Pending', 1, 'Submitted', 2, 'In Progress', 3, 'Pending BASO', 4, 'Pending Billing Approval', 5, 'Complete', 6, 'Failed', 7, 'Pending Cancel', 8, 'Cancelled', 9, 99) OH_SEQ, Decode(t1.milestone_code, NULL, 0, 'SYNC CUSTOMER START', 1, 'SYNC CUSTOMER COMPLETE', 2, 'PROVISION START', 3, 'PROVISION COMPLETE', 4, 'BASO STARTED', 5, 'BILLING APPROVAL STARTED', 6, 'FULFILL BILLING START', 7, 'FULFILL BILLING COMPLETE', 8, 99) MSTONE_SEQ, t1.asset_integ_id AS INT_ID, t9.x_pti1_segment as Segmen FROM sblprd.s_order_item t1 inner join sblprd.s_order t2 ON t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 ON t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 ON t4.par_row_id = t2.row_id inner join sblprd.s_org_ext t6 ON t6.row_id = T2.bill_accnt_id left outer join sblprd.s_doc_agree t5 ON t5.row_id = t1.agree_id left join sblprd.s_org_ext t9 on t9.row_id = T1.OWNER_ACCOUNT_ID WHERE T1.created > To_date('24/07/2017', 'DD/MM/YYYY') AND t1.row_id = t1.root_order_item_id AND t2.rev_num = (SELECT Max(rev_num) FROM sblprd.s_order x WHERE x.order_num = t2.order_num AND x.status_cd NOT IN ( 'Abandoned', 'x')) ORDER BY oh_seq, mstone_seq"
orasql = "SELECT t2.order_num AS ORDER#, t1.row_id AS ROW_ID, t4.attrib_05 AS ORDER_SUBTYPE, t2.rev_num AS REV, t3.name AS PRODUCT, t2.status_cd AS OH_STATUS, t1.status_cd AS LI_STATUS, t1.milestone_code AS MILESTONE, To_char(t1.created + 7 / 24, 'dd-Mon-yyyy hh24:mi:ss') AS CREATED_AT, t1.fulflmnt_status_cd AS FULFILL_STATUS, t6.x_pti1_accnt_nas AS ACC_NAS, t6.x_pti1__nipnas AS NIPNAS, t1.service_num AS SID_NUM, Decode(t1.status_cd, 'Pending', 1, 'Submitted', 2, 'In Progress', 3, 'Pending BASO', 4, 'Pending Billing Approval', 5, 'Complete', 6, 'Failed', 7, 'Pending Cancel', 8, 'Cancelled', 9, 99) OH_SEQ, Decode(t1.milestone_code, NULL, 0, 'SYNC CUSTOMER START', 1, 'SYNC CUSTOMER COMPLETE', 2, 'PROVISION START', 3, 'PROVISION COMPLETE', 4, 'BASO STARTED', 5, 'BILLING APPROVAL STARTED', 6, 'FULFILL BILLING START', 7, 'FULFILL BILLING COMPLETE', 8, 99) MSTONE_SEQ, t1.asset_integ_id AS INT_ID, t9.x_pti1_segment AS Segmen, t2.row_id as ROWID_ORDER FROM sblprd.s_order_item t1 inner join sblprd.s_order t2 ON t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 ON t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 ON t4.par_row_id = t2.row_id inner join sblprd.s_org_ext t6 ON t6.row_id = T2.bill_accnt_id left outer join sblprd.s_doc_agree t5 ON t5.row_id = t1.agree_id left join sblprd.s_org_ext t9 ON t9.row_id = T1.owner_account_id WHERE T1.created > To_date('24/07/2017', 'DD/MM/YYYY') AND t2.rev_num =(SELECT Max(rev_num) FROM sblprd.s_order x WHERE x.order_num = t2.order_num AND x.status_cd NOT IN ( 'Abandoned', 'x')) ORDER BY oh_seq, mstone_seq"
result = cursor.execute(orasql).fetchall()
#mysql
db 		= MySQLdb.connect(host="10.62.170.36", port=3310, user="telkom", passwd="telkom", db="crm_dashboard")
cur 	= db.cursor()
sqltruncate = 'TRUNCATE TABLE int_report';
cur.execute(sqltruncate)
now = str(datetime.datetime.now())
print 'Inserting process'

tomsom = requests.get('http://10.62.170.36:1234/report/tomsomget')
tomsom = json.loads(tomsom.content)

for i,data in enumerate(result):
	ORDER 			= str(data[0])
	ROW_ID 			= str(data[1])
	ORDER_SUBTYPE	= str(data[2]) 
	REV 			= str(data[3]) 
	PRODUCT 		= str(data[4]) 
	OH_STATUS 		= str(data[5]) 
	LI_STATUS 		= str(data[6]) 
	MILESTONE 		= str(data[7]) 
	CREATED_AT 		= str(data[8]) 
	FULFILL_STATUS 	= str(data[9]) 
	ACC_NAS 		= str(data[10]) 
	NIPNAS 			= str(data[11]) 
	SID_NUM 		= str(data[12]) 
	OH_SEQ 			= str(data[13]) 
	MSTONE_SEQ 		= str(data[14])
	INT_ID 			= str(data[15])
	LI_STATUS_INT 	= str(data[6]) 
	MILE_STATUS_INT = str(data[7])
	SEGMENT			= str(data[16])
	ROWID_ORDER		= str(data[17])
	TSQ_STATE		= tomsom[INT_ID]['TSQ_STATE'] if INT_ID in tomsom.keys() else 'None'
	TSQ_DESC		= tomsom[INT_ID]['TSQ_DESC'] if INT_ID in tomsom.keys() else 'None'
	DELIVER_STATE	= tomsom[INT_ID]['DELIVER_STATE'] if INT_ID in tomsom.keys() else 'None' 
	DELIVER_DESC	= tomsom[INT_ID]['DELIVER_DESC'] if INT_ID in tomsom.keys() else 'None'
	sql 			= "insert into int_report (ORDER_NUM, ROW_ID, ORDER_SUBTYPE, REV, PRODUCT, OH_STATUS, LI_STATUS, MILESTONE, CREATED_AT, FULFILL_STATUS, ACC_NAS, NIPNAS, SID_NUM, OH_SEQ, MSTONE_SEQ, LI_STATUS_INT, MILE_STATUS_INT, lastupdate, INT_ID, INT_NOTE, SEGMENT, TSQ_STATE, TSQ_DESC, DELIVER_STATE, DELIVER_DESC, ROWID_ORDER) values('"+ORDER+"','"+ROW_ID+"','"+ORDER_SUBTYPE+"','"+REV+"','"+PRODUCT+"','"+OH_STATUS+"','"+LI_STATUS+"','"+MILESTONE+"','"+CREATED_AT+"','"+FULFILL_STATUS+"','"+ACC_NAS+"','"+NIPNAS+"','"+SID_NUM+"','"+OH_SEQ+"','"+MSTONE_SEQ+"','"+LI_STATUS_INT+"','"+MILE_STATUS_INT+"','"+now+"','"+INT_ID+"','None','"+SEGMENT+"','"+TSQ_STATE+"','"+TSQ_DESC+"','"+DELIVER_STATE+"','"+DELIVER_DESC+"','"+ROWID_ORDER+"')"
	cur.execute(sql)
db.commit()
print 'ORDER_NUM and ROW_ID query process'
clause		= "SELECT distinct(order_num) FROM int_report where oh_status<>'Pending'" 
cur.execute(clause)
#comaia
print 'COMAIA and update process'

result = requests.get('http://10.65.10.212/reqi/comaia/json.php?crmid=all')
result = json.loads(result.content)

for data in cur.fetchall():
	if data[0] in result:
		if result[data[0]]['TASK_MNEMONIC'] is not None:
			tipe = result[data[0]]['TASK_MNEMONIC'].lower()
		else:
			tipe = str(result[data[0]]['TASK_MNEMONIC'])

		if result[data[0]]['STATE_MNEMONIC'] is not None:
			tipe2 = result[data[0]]['STATE_MNEMONIC'].lower()
		else:
			tipe2 = str(result[data[0]]['STATE_MNEMONIC'])
	else:
		tipe 	= ''
		tipe2 	= ''

	if 'provisionordersi' in tipe:
		if 'waitforfalloutrecovery' in tipe2:
			cur.execute("UPDATE int_report SET LI_STATUS_INT='In Progress' ,MILE_STATUS_INT='PROVISION START', INT_NOTE='ERROR DELIVER' WHERE ORDER_NUM='"+data[0]+"';")
		else:	
			cur.execute("UPDATE int_report SET LI_STATUS_INT='In Progress' ,MILE_STATUS_INT='PROVISION START', INT_NOTE='DELIVER' WHERE ORDER_NUM='"+data[0]+"';")
	elif 'provisionordertsq' in tipe:
		if 'waitforfalloutrecovery' in tipe2:
			cur.execute("UPDATE int_report SET LI_STATUS_INT='In Progress' ,MILE_STATUS_INT='SYNC CUSTOMER COMPLETE', INT_NOTE='ERROR TSQ' WHERE ORDER_NUM='"+data[0]+"';")
		else:
			cur.execute("UPDATE int_report SET LI_STATUS_INT='In Progress' ,MILE_STATUS_INT='SYNC CUSTOMER COMPLETE', INT_NOTE='TSQ' WHERE ORDER_NUM='"+data[0]+"';")
	elif 'basoactivitytask' in tipe:
		cur.execute("UPDATE int_report SET LI_STATUS_INT='Pending BASO' ,MILE_STATUS_INT='BASO STARTED', INT_NOTE='PENDING BASO' WHERE ORDER_NUM='"+data[0]+"';")
	elif 'aprovebillingtask' in tipe:
		cur.execute("UPDATE int_report SET LI_STATUS_INT='Pending Billing Approval' ,MILE_STATUS_INT='BILLING APPROVAL STARTED', INT_NOTE='PENDING BILLING APPROVAL' WHERE ORDER_NUM='"+data[0]+"';")
	elif 'fulfillbillingsitask' in tipe:
		cur.execute("UPDATE int_report SET LI_STATUS_INT='Pending Billing Approval' ,MILE_STATUS_INT='FULFILL BILLING START', INT_NOTE='ERROR FULFILL BILLING START' WHERE ORDER_NUM='"+data[0]+"';")
	elif ('synccustomerwaitinforsccdresponse' in tipe) or ('synccustomersitask' in tipe):
		cur.execute("UPDATE int_report SET LI_STATUS_INT='In Progress' ,MILE_STATUS_INT='SYNC CUSTOMER START', INT_NOTE='ERROR SYNC CUSTOMER' WHERE ORDER_NUM='"+data[0]+"';")
	elif tipe == 'None':
		cur.execute("UPDATE int_report SET LI_STATUS_INT='Complete' ,MILE_STATUS_INT='FULFILL BILLING COMPLETE', INT_NOTE='COMPLETE' WHERE ORDER_NUM='"+data[0]+"';")
	#result = requests.post('http://10.65.10.212/reqi/comaia/index.php?p=search',data={'search' : str(data[0])})
	#soup = BeautifulSoup(result.content, 'html.parser')
	#table = soup.findAll('table')[2]
	#table2 = soup.findAll('table')[1]
	#rows = table.find('tbody').findAll('tr')
	# status = ""
	# for row in rows:
	# 	cell = row.findAll('td')
	# 	if cell[1].text == '':
	# 		status = 'NULL'
	# 		break
	# 	if cell[1].text == 'STARTED':
	# 		status = cell[0].text
	# 		break
	# 	if i == len(cell) and cell[1].text == 'COMPLETED':
	# 		status = cell[0].text + 'Complete'
	# 		break
	# try:
	# 	tipe = table2.findAll('td')[6].getText().lower()
	# 	tipe2 = table2.findAll('td')[7].getText().lower()
	# except IndexError:
	# 	tipe = 'None'
	# 	tipe2 = 'None'
	#ProvisionOrderFunction = PROVISION START 
	#if status == 'ProvisionOrderFunction':
	#FulfillBillingFunction = FULFILL BILLING START
	# elif status == 'FulfillBillingFunction':
	# 	cur.execute("UPDATE int_report SET LI_STATUS_INT='Pending Billing Approval' ,MILE_STATUS_INT='FULFILL BILLING START' WHERE ORDER_NUM='"+data[0]+"';")
	# #FulfillBillingFunctionComplete = FULFILL BILLING COMPLETE
	# elif status == 'FulfillBillingFunctionComplete':
	#    cur.execute("UPDATE int_report SET LI_STATUS_INT='Complete' ,MILE_STATUS_INT='FULFILL BILLING COMPLETE' WHERE ORDER_NUM='"+data[0]+"';")
db.commit()
	






	