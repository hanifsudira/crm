#!/usr/bin/python
import cx_Oracle,requests,MySQLdb,sys,datetime,json
from bs4 import BeautifulSoup

reload(sys)
sys.setdefaultencoding('utf-8')

#oracle
con = cx_Oracle.connect('reportcrm/Telkom#2016@10.6.16.8/siebprddb')
cursor = con.cursor()
print 'Line items query process'	
orasql = "select t2.order_num AS ORDER#, t1.row_id AS ROW_ID, t4.attrib_05 AS ORDER_SUBTYPE, t2.rev_num AS REV, t3.NAME AS PRODUCT, t2.status_cd AS OH_STATUS, t1.status_cd AS LI_STATUS, t1.milestone_code AS MILESTONE, To_char(t1.created + 7 / 24, 'dd-Mon-yyyy hh24:mi:ss') AS CREATED_AT, t1.fulflmnt_status_cd AS FULFILL_STATUS, t6.x_pti1_accnt_nas AS ACC_NAS, t6.x_pti1__nipnas AS NIPNAS, t1.service_num AS SID_NUM, Decode(t1.status_cd, 'Pending', 1, 'Submitted', 2, 'In Progress', 3, 'Pending BASO', 4, 'Pending Billing Approval', 5, 'Complete', 6, 'Failed', 7, 'Pending Cancel', 8, 'Cancelled', 9, 99) OH_SEQ, Decode(t1.milestone_code, NULL, 0, 'SYNC CUSTOMER START', 1, 'SYNC CUSTOMER COMPLETE', 2, 'PROVISION START', 3, 'PROVISION COMPLETE', 4, 'BASO STARTED', 5, 'BILLING APPROVAL STARTED', 6, 'FULFILL BILLING START', 7, 'FULFILL BILLING COMPLETE', 8, 99) MSTONE_SEQ, t1.asset_integ_id AS INT_ID, t9.x_pti1_segment AS Segmen, t9.NAME AS CC, T2.agree_num AS num_parent, T2.rev_num AS rev_parent, T1.ONETIME_CHG_SUBTOT AS OTC, T1.PER_MTH_CHG_SUBTOT AS MRC FROM sblprd.s_order_item t1 INNER JOIN sblprd.s_order t2 ON t2.row_id = t1.order_id INNER JOIN sblprd.s_prod_int t3 ON t3.row_id = t1.prod_id INNER JOIN sblprd.s_order_x t4 ON t4.par_row_id = t2.row_id INNER JOIN sblprd.s_org_ext t6 ON t6.row_id = T2.bill_accnt_id LEFT OUTER JOIN sblprd.s_doc_agree t5 ON t5.row_id = t1.agree_id LEFT JOIN sblprd.s_org_ext t9 ON t9.row_id = T1.owner_account_id LEFT JOIN sblprd.s_doc_agree t2 ON t2.row_id = t1.agree_id WHERE T1.created > To_date('24/07/2017', 'DD/MM/YYYY') AND t1.row_id = t1.root_order_item_id AND t2.rev_num =(SELECT Max(rev_num) FROM sblprd.s_order x WHERE x.order_num = t2.order_num AND x.status_cd NOT IN ( 'Abandoned', 'x')) ORDER BY oh_seq, mstone_seq"
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
	CC 				= str(data[17]).replace("'","").strip()
	AGREE_NUM 		= str(data[18]).replace("'","\\'")
	AGREE_REV 		= str(data[19]).replace("'","\\'")
	OTC 			= str(data[20])
	MRC 			= str(data[21])
	TSQ_STATE		= tomsom[INT_ID]['TSQ_STATE'] if INT_ID in tomsom.keys() else 'None'
	TSQ_DESC		= tomsom[INT_ID]['TSQ_DESC'] if INT_ID in tomsom.keys() else 'None'
	DELIVER_STATE	= tomsom[INT_ID]['DELIVER_STATE'] if INT_ID in tomsom.keys() else 'None' 
	DELIVER_DESC	= tomsom[INT_ID]['DELIVER_DESC'] if INT_ID in tomsom.keys() else 'None'
	sql 			= "insert into int_report (ORDER_NUM, ROW_ID, ORDER_SUBTYPE, REV, PRODUCT, OH_STATUS, LI_STATUS, MILESTONE, CREATED_AT, FULFILL_STATUS, ACC_NAS, NIPNAS, SID_NUM, OH_SEQ, MSTONE_SEQ, LI_STATUS_INT, MILE_STATUS_INT, lastupdate, INT_ID, INT_NOTE, SEGMENT, TSQ_STATE, TSQ_DESC, DELIVER_STATE, DELIVER_DESC, CC, AGREE_NUM, AGREE_REV, OTC, MRC) values('"+ORDER+"','"+ROW_ID+"','"+ORDER_SUBTYPE+"','"+REV+"','"+PRODUCT+"','"+OH_STATUS+"','"+LI_STATUS+"','"+MILESTONE+"','"+CREATED_AT+"','"+FULFILL_STATUS+"','"+ACC_NAS+"','"+NIPNAS+"','"+SID_NUM+"','"+OH_SEQ+"','"+MSTONE_SEQ+"','"+LI_STATUS_INT+"','"+MILE_STATUS_INT+"','"+now+"','"+INT_ID+"','None','"+SEGMENT+"','"+TSQ_STATE+"','"+TSQ_DESC+"','"+DELIVER_STATE+"','"+DELIVER_DESC+"','"+CC+"','"+AGREE_NUM+"','"+AGREE_REV+"','"+OTC+"','"+MRC+"')"
	cur.execute(sql)
db.commit()

#tomsom
print 'tomsom query process'
clause 		= "SELECT ORDER_NUM, INT_ID, TSQ_STATE, TSQ_DESC, DELIVER_STATE, DELIVER_DESC, PRODUCT FROM int_report where oh_status<>'Pending'"
cur.execute(clause)

#comaia
print 'COMAIA and update process'
result = requests.get('http://10.65.10.212/reqi/comaia/json.php?crmid=all')
result = json.loads(result.content)

for data in cur.fetchall():
	ORDER_NUM 		= str(data[0]).strip()
	INT_ID 			= str(data[1]).strip()
	TSQ_STATE		= str(data[2]).strip()
	TSQ_DESC		= str(data[3]).strip()
	DELIVER_STATE	= str(data[4]).strip()
	DELIVER_DESC	= str(data[5]).strip()
	PRODUCT			= str(data[6]).strip()

	if ORDER_NUM in result:
		if result[ORDER_NUM]['TASK_MNEMONIC'] is not None:
			tipe = result[ORDER_NUM]['TASK_MNEMONIC'].lower().strip()
		else:
			tipe = str(result[ORDER_NUM]['TASK_MNEMONIC']).strip()

		if result[ORDER_NUM]['STATE_MNEMONIC'] is not None:
			tipe2 = result[ORDER_NUM]['STATE_MNEMONIC'].lower().strip()
		else:
			tipe2 = str(result[ORDER_NUM]['STATE_MNEMONIC']).strip()
	else:
		tipe 	= ''
		tipe2 	= ''


	if DELIVER_STATE == 'CANCELLED':
		cur.execute("UPDATE int_report SET INT_NOTE='CANCEL FROM OSS' WHERE INT_ID='"+INT_ID+"';")
	
	elif DELIVER_STATE == 'INPROGRESS' or DELIVER_STATE =='PROPOSED' or  DELIVER_STATE =='WAITERS':
		cur.execute("UPDATE int_report SET INT_NOTE='DELIVER' WHERE INT_ID='"+INT_ID+"';")
	
	elif DELIVER_STATE == 'CLOSED':
		if PRODUCT == 'Telkom Metro Network' or PRODUCT == 'MPLS VPN IP Network' or PRODUCT == 'VSAT IP Network':
			cur.execute("UPDATE int_report SET INT_NOTE='COMPLETE' WHERE INT_ID='"+INT_ID+"';")
		elif ('synccustomerwaitinforsccdresponse' in tipe) or ('synccustomersitask' in tipe):
			cur.execute("UPDATE int_report SET INT_NOTE='PENDING BASO' WHERE INT_ID='"+INT_ID+"';")
		elif 'provisionordersi' in tipe:
			if 'waitforfalloutrecovery' in tipe2:
				cur.execute("UPDATE int_report SET INT_NOTE='PENDING BASO' WHERE INT_ID='"+INT_ID+"';")
			else:	
				cur.execute("UPDATE int_report SET INT_NOTE='PENDING BASO' WHERE INT_ID='"+INT_ID+"';")
		elif 'provisionordertsq' in tipe:
			if 'waitforfalloutrecovery' in tipe2:
				cur.execute("UPDATE int_report SET INT_NOTE='PENDING BASO' WHERE INT_ID='"+INT_ID+"';")
			else:
				cur.execute("UPDATE int_report SET INT_NOTE='PENDING BASO' WHERE INT_ID='"+INT_ID+"';")
		elif 'basoactivitytask' in tipe:
			cur.execute("UPDATE int_report SET INT_NOTE='PENDING BASO' WHERE INT_ID='"+INT_ID+"';")
		elif 'aprovebillingtask' in tipe:
			cur.execute("UPDATE int_report SET INT_NOTE='PENDING BILLING APPROVAL' WHERE INT_ID='"+INT_ID+"';")
		elif 'fulfillbillingsitask' in tipe:
			cur.execute("UPDATE int_report SET INT_NOTE='ERROR FULFILL BILLING START' WHERE INT_ID='"+INT_ID+"';")
		elif tipe == 'None':
			cur.execute("UPDATE int_report SET INT_NOTE='COMPLETE' WHERE INT_ID='"+INT_ID+"';")

	elif DELIVER_STATE =='ERROR':
		if DELIVER_DESC == 'AREA CODE is Null':
			cur.execute("UPDATE int_report SET INT_NOTE='ERROR AREA' WHERE INT_ID='"+INT_ID+"';")
		else:
			cur.execute("UPDATE int_report SET INT_NOTE='ERROR DELIVER' WHERE INT_ID='"+INT_ID+"';")
			
	elif DELIVER_STATE == 'None':
		if DELIVER_DESC == 'AREA CODE is Null':
			cur.execute("UPDATE int_report SET INT_NOTE='ERROR AREA' WHERE INT_ID='"+INT_ID+"';")
		elif TSQ_STATE == 'INPROGRESS' or TSQ_STATE=='PROPOSED' or TSQ_STATE=='WAITERS':
			cur.execute("UPDATE int_report SET INT_NOTE='TSQ' WHERE INT_ID='"+INT_ID+"';")
		elif TSQ_STATE == 'CANCELLED':
			cur.execute("UPDATE int_report SET INT_NOTE='CANCEL FROM OSS' WHERE INT_ID='"+INT_ID+"';")
		elif TSQ_STATE == 'CLOSED':
			cur.execute("UPDATE int_report SET INT_NOTE='NEED DELIVER' WHERE INT_ID='"+INT_ID+"';")
		elif TSQ_STATE == 'ERROR':
			if TSQ_DESC == 'AREA CODE is Null':
				cur.execute("UPDATE int_report SET INT_NOTE='ERROR AREA' WHERE INT_ID='"+INT_ID+"';")
			else:
				cur.execute("UPDATE int_report SET INT_NOTE='ERROR TSQ' WHERE INT_ID='"+INT_ID+"';")
		elif TSQ_STATE == 'None':
			if TSQ_DESC == 'AREA CODE is Null':
				cur.execute("UPDATE int_report SET INT_NOTE='ERROR AREA' WHERE INT_ID='"+INT_ID+"';")
			elif ('synccustomerwaitinforsccdresponse' in tipe) or ('synccustomersitask' in tipe):
				cur.execute("UPDATE int_report SET INT_NOTE='ERROR SYNC CUSTOMER' WHERE INT_ID='"+INT_ID+"';")
			elif 'provisionordersi' in tipe:
				if 'waitforfalloutrecovery' in tipe2:
					cur.execute("UPDATE int_report SET INT_NOTE='ERROR DELIVER' WHERE INT_ID='"+INT_ID+"';")
				else:	
					cur.execute("UPDATE int_report SET INT_NOTE='DELIVER' WHERE INT_ID='"+INT_ID+"';")
			elif 'provisionordertsq' in tipe:
				if 'waitforfalloutrecovery' in tipe2:
					cur.execute("UPDATE int_report SET INT_NOTE='ERROR TSQ' WHERE INT_ID='"+INT_ID+"';")
				else:
					cur.execute("UPDATE int_report SET INT_NOTE='TSQ' WHERE INT_ID='"+INT_ID+"';")
			elif 'basoactivitytask' in tipe:
				cur.execute("UPDATE int_report SET INT_NOTE='PENDING BASO' WHERE INT_ID='"+INT_ID+"';")
			elif 'aprovebillingtask' in tipe:
				cur.execute("UPDATE int_report SET INT_NOTE='PENDING BILLING APPROVAL' WHERE INT_ID='"+INT_ID+"';")
			elif 'fulfillbillingsitask' in tipe:
				cur.execute("UPDATE int_report SET INT_NOTE='ERROR FULFILL BILLING START' WHERE INT_ID='"+INT_ID+"';")
			elif tipe == 'None':
				cur.execute("UPDATE int_report SET INT_NOTE='COMPLETE' WHERE INT_ID='"+INT_ID+"';")
db.commit()	