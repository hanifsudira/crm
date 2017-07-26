#!/usr/bin/python
import requests,datetime,MySQLdb,json
from bs4 import BeautifulSoup
from calendar import monthrange

db = MySQLdb.connect(host="127.0.0.1", user="root", passwd="", db="crm_dashboard")
cur = db.cursor()

r = requests.get('https://docs.google.com/spreadsheets/d/1AbHjZKulCIIkJHaH2nwlSecuc_gkLYmoBhHkuP8xxHk/edit?usp=sharing')
soup = BeautifulSoup(r.content, 'html.parser')
datas = []
for row in soup.find_all('tr'):
    cols = row.find_all('td')
    cols = [ele.text.strip() for ele in cols]
    datas.append([ele for ele in cols])

for i,data in enumerate(datas):
    if i<4:
        continue
    if data[0].isdigit():
        date = data[1]
        sumber = data[2]
        onsite_support = data[3]
        nama_user = data[4]
        nik_user = data[5]
        user_login = data[6]
        divisi = data[7]
        no_telp = data[8]
        no_quote = data[9]
        no_order = data[10]
        deskripsi_komplain = data[11]
        kategori = data[13]
        status = data[14]
        assignee = data[15]
        solusi = data[16]
        sql = "insert into crm (date,sumber,onsite_support,nama_user,nik_user,user_login,divisi,no_telp,no_quote,no_order,deskripsi_komplain,kategori,status,assignee,solusi) values('"+date+"','"+sumber+"','"+onsite_support+"','"+nama_user+"','"+nik_user+"','"+user_login+"','"+divisi+"','"+no_telp+"','"+no_quote+"','"+no_order+"','"+deskripsi_komplain+"','"+kategori+"','"+status+"','"+assignee+"','"+solusi+"')"
        cur.execute(sql)
db.commit()
cur.close()
db.close()