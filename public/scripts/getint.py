#!/usr/bin/python
import cx_Oracle,requests,MySQLdb,sys,datetime
from bs4 import BeautifulSoup

reload(sys)
sys.setdefaultencoding('utf-8')
result = requests.post('http://10.65.10.212/reqi/comaia/index.php?p=search',data={'search' : '1-5224374'})
soup = BeautifulSoup(result.content, 'html.parser')
table = soup.findAll('table')[2]
rows = table.find('tbody').findAll('tr')
status = ""
for row in rows:
    cell = row.findAll('td')
    if cell[1].text == '':
        status = 'NULL'
        break
    if cell[1].text == 'STARTED':
        status = cell[0].text
        break
    if i == len(cell) and cell[1].text == 'COMPLETED':
        status = cell[0].text + 'Complete'
        break
table = soup.findAll('table')[1]

print table 

#ProvisionOrderFunction = PROVISION START 
if status == 'ProvisionOrderFunction':
    print 1
#FulfillBillingFunction = FULFILL BILLING START
elif status == 'FulfillBillingFunction':
    print 2

#FulfillBillingFunctionComplete = FULFILL BILLING COMPLETE
elif status == 'FulfillBillingFunctionComplete':
    print 3