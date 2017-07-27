#!/usr/bin/python
import requests,datetime,MySQLdb,json,sys
from bs4 import BeautifulSoup
from calendar import monthrange

reload(sys)
sys.setdefaultencoding('utf-8')

db = MySQLdb.connect(host="127.0.0.1", user="root", passwd="", db="crm_dashboard")
cur = db.cursor()

r = requests.get('https://spreadsheets.google.com/feeds/list/1okb14Mlada3rGiMEu3RfsILkZLmETx7shajsTKH1zTQ/od6/public/values?alt=json')
data = json.loads(r.content)
entry = data['feed']['entry'] 

sqltruncate = 'TRUNCATE TABLE crm';
cur.execute(sqltruncate)

for i in entry:
    date                = str(i['gsx$tanggal']['$t']).replace("'","")
    sumber              = str(i['gsx$sumber']['$t']).replace("'","")
    onsite_support      = str(i['gsx$onsitesupport']['$t']).replace("'","")
    nama_user           = str(i['gsx$namauser']['$t']).replace("'","")
    nik_user            = str(i['gsx$nikuser']['$t']).replace("'","")
    user_login          = str(i['gsx$userlogin']['$t']).replace("'","")
    divisi              = str(i['gsx$divisisegment']['$t']).replace("'","")
    no_telp             = str(i['gsx$notelp']['$t']).replace("'","")
    no_quote            = str(i['gsx$nomorquote']['$t']).replace("'","")
    no_order            = str(i['gsx$nomororder']['$t']).replace("'","")
    deskripsi_komplain  = str(i['gsx$deskripsikomplain']['$t']).replace("'","")
    kategori            = str(i['gsx$kategori']['$t']).replace("'","")
    status              = str(i['gsx$statusfollowup']['$t']).replace("'","")
    assignee            = str(i['gsx$assignee']['$t']).replace("'","")
    solusi              = str(i['gsx$solusi']['$t']).replace("'","")
    sql = "insert into crm (date,sumber,onsite_support,nama_user,nik_user,user_login,divisi,no_telp,no_quote,no_order,deskripsi_komplain,kategori,status,assignee,solusi) values('"+date+"','"+sumber+"','"+onsite_support+"','"+nama_user+"','"+nik_user+"','"+user_login+"','"+divisi+"','"+no_telp+"','"+no_quote+"','"+no_order+"','"+deskripsi_komplain+"','"+kategori+"','"+status+"','"+assignee+"','"+solusi+"')"
    print sql
    cur.execute(sql)
db.commit()
cur.close()
db.close()