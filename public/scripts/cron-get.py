#!/usr/bin/python
import requests,datetime,MySQLdb,json
from bs4 import BeautifulSoup
from calendar import monthrange

db = MySQLdb.connect(host="127.0.0.1", user="root", passwd="", db="migrasi")

now = datetime.datetime.now()
day = str(now.day)
month = str(now.month)
year = str(now.year)
init = '1'+'/'+month+'/'+year
today = day+'/'+month+'/'+year
muchday = monthrange(int(year),int(month))[1]

cur = db.cursor()
query = "select witel,target from target where tahun="+str(year)+";"
cur.execute(query)
target = cur.fetchall()

url3p = 'http://mydashboard.telkom.co.id/ms2/report_progres_useetv8.php'
url2p = 'http://mydashboard.telkom.co.id/ms2/report_internet2.php'

monthly3p,monthly2p,daily3p,daily2p = [],[],[],[]

def getdata3p():
    values = {'start_date': init, 'end_date': today, 'p_kawasan': 'DIVRE 2'}
    r = requests.post(url3p, data=values)
    soup = BeautifulSoup(r.content, 'html.parser')

    datas = []
    for row in soup.find_all('tr'):
        cols = row.find_all('td')
        cols = [ele.text.strip() for ele in cols]
        datas.append([ele for ele in cols if ele])

    for i, data in enumerate(datas):
        if i > 16 and i <= 25:
            temp = ""
            for i in range(len(data)):
                temp += str(data[i]) + "|"
            monthly3p.append(temp)

def getdata2p():
    values = {'start_date': init, 'end_date': today}
    r = requests.post(url2p, data=values)
    soup = BeautifulSoup(r.content, 'html.parser')

    datas = []
    for row in soup.find_all('tr'):
        cols = row.find_all('td')
        cols = [ele.text.strip() for ele in cols]
        datas.append([ele for ele in cols if ele])

    for i, data in enumerate(datas):
        if i > 27 and i <= 36:
            temp = ""
            for i in range(len(data)):
                temp += str(data[i]) + "|"
            monthly2p.append(temp)

def getdaily3p():
    values = {'start_date': today, 'end_date': today, 'p_kawasan': 'DIVRE 2'}
    r = requests.post(url3p, data=values)
    soup = BeautifulSoup(r.content, 'html.parser')

    datas = []
    for row in soup.find_all('tr'):
        cols = row.find_all('td')
        cols = [ele.text.strip() for ele in cols]
        datas.append([ele for ele in cols if ele])

    for i, data in enumerate(datas):
        if i > 15 and i <= 25:
            temp = ""
            for i in range(len(data)):
                temp += str(data[i]) + "|"
            daily3p.append(temp)

def getdaily2p():
    values = {'start_date': today, 'end_date': today}
    r = requests.post(url2p, data=values)
    soup = BeautifulSoup(r.content, 'html.parser')

    datas = []
    for row in soup.find_all('tr'):
        cols = row.find_all('td')
        cols = [ele.text.strip() for ele in cols]
        datas.append([ele for ele in cols if ele])

    for i, data in enumerate(datas):
        if i > 27 and i <= 36:
            temp = ""
            for i in range(len(data)):
                temp += str(data[i]) + "|"
            daily2p.append(temp)

def getlastupdate():
    r = requests.get('https://mdashboard.telkom.co.id/indihome/app.php/report/tgl_update')
    value = json.loads(r.content)
    return value['rows']['SELESAI']

if __name__ == '__main__':
    getdata2p()
    getdata3p()
    getdaily2p()
    getdaily3p()
    lastupdate = datetime.datetime.strptime(getlastupdate(), '%d-%b-%Y %H:%M:%S')

    divre2 = ["BANTEN", "BEKASI", "BOGOR", "JAKBAR", "JAKPUS", "JAKSEL", "JAKTIM", "JAKUT", "TANGERANG"]

    re2 = []
    for regional in divre2:
        temp = []
        temp.append(regional)
        status = 0

        for d3p in daily3p:
            d3p = d3p.split('|')
            if regional == d3p[2]:
                temp.append(d3p[11])
                churn = int(d3p[13])+int(d3p[14])+int(d3p[15])
                temp.append(churn)
                status = 1
                break

        if not status:
        	temp.append(0)
        	temp.append(0)

        for d2p in daily2p:
            d2p = d2p.split('|')
            if regional == d2p[2]:
                temp.append(int(d2p[8]))
                break

        for m3p in monthly3p:
            m3p = m3p.split('|')
            if regional == m3p[2]:
                push = m3p[16].replace(',','')
                temp.append(push)
                break

        for m2p in monthly2p:
            m2p = m2p.split('|')
            if regional == m2p[2]:
                push = m2p[13].replace(',', '')
                temp.append(push)
                break

        for witel in target:
            if regional == witel[0]:
                temp.append([json.loads(target[0][1])[str(month)]])

        re2.append(temp)

    newcur = db.cursor()
    for i in re2:
        witel = i[0]
        ps3p = i[1]
        ps2p = i[3]
        pstot = int(ps3p)+int(ps2p)
        churn = i[2]
        nalhi = pstot-churn
        nalmtd = int(i[4])+int(i[5])
        target = i[6][0]
        targetmtd = (int(day)/float(muchday))*int(target)
        achmtd = nalmtd/targetmtd
        #print witel,ps3p,ps2p,pstot,churn,nalhi,nalmtd,target,targetmtd,achmtd,lastupdate
        #sql = "insert into data (witel,ps3p,ps2p,pstot,churn,nalhi,nalmtd,target,targetmtd,achmtd,lastupdate) values('"+witel+"','"+str(ps3p)+"','"+str(ps2p)+"','"+str(pstot)+"','"+str(churn)+"','"+str(nalhi)+"','"+str(nalmtd)+"','"+str(target)+"','"+str(targetmtd)+"','"+str(achmtd)+"','"+str(lastupdate)+"');"
        sql = "update o098 set ps3p='"+str(ps3p)+"',ps2p='"+str(ps2p)+"',pstot='"+str(pstot)+"',churn='"+str(churn)+"',nalhi='"+str(nalhi)+"',nalmtd='"+str(nalmtd)+"',target='"+str(target)+"',targetmtd='"+str(targetmtd)+"',achmtd='"+str(achmtd)+"',lastupdate='"+str(lastupdate)+"' where witel='"+witel+"';"
        newcur.execute(sql)
    db.commit()
    cur.close()
    db.close()
