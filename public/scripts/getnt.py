import requests, json, xmltodict, MySQLdb, datetime, sys

reload(sys)
sys.setdefaultencoding('utf-8')

url="http://10.65.10.125:7777/ws/Report247.WSOUT:TOMSOM_API/Report247_WSOUT_TOMSOM_API_Port"
headers =   {
            'content-type'    : 'text/xml',
            'SOAPAction'      : 'Report247_WSOUT_TOMSOM_API_Binder_getTOMSOMALLData'
}
body =  """
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tom="http://eaidev2/Report247/WSOUT/TOMSOM_API">
           <soapenv:Header/>
           <soapenv:Body>
              <tom:getTOMSOMALL Data/>
           </soapenv:Body>
        </soapenv:Envelope>
        """

response = requests.post(url, data=body, headers=headers)

d = xmltodict.parse(response.text, xml_attribs=True)
data = d['SOAP-ENV:Envelope']['SOAP-ENV:Body']['ser-root:getTOMSOMALLDataResponse']['DATA']

#mysql
db 		= MySQLdb.connect(host="10.62.170.36", port=3310, user="telkom", passwd="telkom", db="crm_dashboard")
cur 	= db.cursor()
sqltruncate = 'TRUNCATE TABLE tomsom';
cur.execute(sqltruncate)
now = str(datetime.datetime.now())

for i, row in enumerate(data):
	CRMORDERID			= str(row['CRMORDERID']) 
	INSTALLEDPRODUCTID 	= str(row['INSTALLEDPRODUCTID'])
	EXTERNALID			= str(row['EXTERNALID'])
	PRODUCTNAME			= str(row['PRODUCTNAME'])
	ORDERTYPE			= str(row['ORDERTYPE']) 
	TSQ_STATE			= str(row['TSQ_STATE']).replace("'","") if type(row['TSQ_STATE']) == unicode else 'None'
	TSQ_DESC			= str(row['TSQ_DESC']).replace("'","") if type(row['TSQ_DESC']) == unicode else 'None'
	DELIVER_STATE		= str(row['DELIVER_STATE']).replace("'","") if type(row['DELIVER_STATE']) == unicode else 'None'
	DELIVER_DESC		= str(row['DELIVER_DESC']).replace("'","") if type(row['DELIVER_DESC']) == unicode else 'None'
	sql 			= "insert into tomsom (CRMORDERID, INSTALLEDPRODUCTID, EXTERNALID, PRODUCTNAME, ORDERTYPE, TSQ_STATE, TSQ_DESC, DELIVER_STATE, DELIVER_DESC, lastupdate) values('"+CRMORDERID+"','"+INSTALLEDPRODUCTID+"','"+EXTERNALID+"','"+PRODUCTNAME+"','"+ORDERTYPE+"','"+TSQ_STATE+"','"+TSQ_DESC+"','"+DELIVER_STATE+"','"+DELIVER_DESC+"','"+now+"')"
	cur.execute(sql)
db.commit()
