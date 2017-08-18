import sys, requests as req, json
from bs4 import BeautifulSoup as bs

#data = [['Sub'],['1-6421921', '1-13131718', '1-5768110']]#json.loads(sys.argv[2])
#'1-6421921', '1-13131718', '1-5768110'
#datas = [['1-6421921', '1-13131718', '1-5768110'],[],[],[]]

datas = json.loads(sys.argv[1])

allreturn = []
for data in datas:
    temp = []
    listResult = []
    for val in data:
        param = {'search' : val}
        result = req.post('http://10.65.10.212/reqi/comaia/index.php?p=search',data=param)
        #print result.content
        soup = bs(result.content, 'html.parser')
        table = soup.findAll('table')[2]
        i = 1
        rows = table.find('tbody').findAll('tr')
        #print len(rows)
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
                status = cell[0] + 'Complete'
                break
            i+=1
        if status == 'ProvisionOrderFunction':
            listResult.append('PROVISION START')
        elif status == 'FulfillBillingFunction':
            listResult.append('FULFILL BILLING START')
        elif status == 'FulfillBillingFunctionComplete':
            listResult.append('FULFILL BILLING COMPLETE')
        elif status == 'NULL':
            listResult.append('NULL') 

    temp = [listResult.count('PROVISION START'),listResult.count('FULFILL BILLING START'),listResult.count('FULFILL BILLING COMPLETE')]
    allreturn.append(temp)
print json.dumps(allreturn)