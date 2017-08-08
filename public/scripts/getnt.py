import requests, json, xmltodict

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
print json.dumps(d, indent=4)