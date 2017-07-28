# #!/usr/bin/python
# import requests,datetime,MySQLdb,json,sys
# from bs4 import BeautifulSoup
# from calendar import monthrange

# reload(sys)
# sys.setdefaultencoding('utf-8')

# db = MySQLdb.connect(host="127.0.0.1", user="root", passwd="", db="crm_dashboard")
# cur = db.cursor()

# r = requests.get('https://spreadsheets.google.com/feeds/list/1okb14Mlada3rGiMEu3RfsILkZLmETx7shajsTKH1zTQ/od6/public/values?alt=json')
# data = json.loads(r.content)
# entry = data['feed']['entry'] 

# sqltruncate = 'TRUNCATE TABLE crm';
# cur.execute(sqltruncate)

# for i in entry:
#     date                = str(i['gsx$tanggal']['$t']).replace("'","")
#     sumber              = str(i['gsx$sumber']['$t']).replace("'","")
#     onsite_support      = str(i['gsx$onsitesupport']['$t']).replace("'","")
#     nama_user           = str(i['gsx$namauser']['$t']).replace("'","")
#     nik_user            = str(i['gsx$nikuser']['$t']).replace("'","")
#     user_login          = str(i['gsx$userlogin']['$t']).replace("'","")
#     divisi              = str(i['gsx$divisisegment']['$t']).replace("'","")
#     no_telp             = str(i['gsx$notelp']['$t']).replace("'","")
#     no_quote            = str(i['gsx$nomorquote']['$t']).replace("'","")
#     no_order            = str(i['gsx$nomororder']['$t']).replace("'","")
#     deskripsi_komplain  = str(i['gsx$deskripsikomplain']['$t']).replace("'","")
#     kategori            = str(i['gsx$kategori']['$t']).replace("'","")
#     status              = str(i['gsx$statusfollowup']['$t']).replace("'","")
#     assignee            = str(i['gsx$assignee']['$t']).replace("'","")
#     solusi              = str(i['gsx$solusi']['$t']).replace("'","")
#     sql = "insert into crm (date,sumber,onsite_support,nama_user,nik_user,user_login,divisi,no_telp,no_quote,no_order,deskripsi_komplain,kategori,status,assignee,solusi) values('"+date+"','"+sumber+"','"+onsite_support+"','"+nama_user+"','"+nik_user+"','"+user_login+"','"+divisi+"','"+no_telp+"','"+no_quote+"','"+no_order+"','"+deskripsi_komplain+"','"+kategori+"','"+status+"','"+assignee+"','"+solusi+"')"
#     print sql
#     cur.execute(sql)
# db.commit()
# cur.close()
# db.close()

#!/usr/bin/python
import requests,datetime,MySQLdb,json,sys
from bs4 import BeautifulSoup
from calendar import monthrange

reload(sys)
sys.setdefaultencoding('utf-8')

db = MySQLdb.connect(host="127.0.0.1", user="root", passwd="", db="crm_dashboard")
cur = db.cursor()

sqltruncate = 'TRUNCATE TABLE crm';
cur.execute(sqltruncate)

r = requests.get('https://docs.google.com/spreadsheets/d/1AbHjZKulCIIkJHaH2nwlSecuc_gkLYmoBhHkuP8xxHk/pubhtml')
soup = BeautifulSoup(r.content, 'html.parser')
datas = []
for row in soup.find_all('tr'):
     cols = row.find_all('td')
     cols = [ele.text.strip() for ele in cols]
     datas.append([ele for ele in cols])

for i,data in enumerate(datas): 
    if i<4:
        continue 
    if len(data) == 32 and data[0] != '':
        date               = str(data[1]).replace("'","")
        sumber             = str(data[2]).replace("'","")
        onsite_support     = str(data[3]).replace("'","")
        nama_user          = str(data[4]).replace("'","")
        nik_user           = str(data[5]).replace("'","")
        user_login         = str(data[6]).replace("'","")
        divisi             = str(data[7]).replace("'","")
        no_telp            = str(data[8]).replace("'","")
        no_quote           = str(data[9]).replace("'","")
        no_order           = str(data[10]).replace("'","")
        deskripsi_komplain = str(data[11]).replace("'","")
        kategori           = str(data[13]).replace("'","")
        status             = str(data[14]).replace("'","")
        assignee           = str(data[15]).replace("'","")
        solusi             = str(data[16]).replace("'","")
        sql                = "insert into crm (date,sumber,onsite_support,nama_user,nik_user,user_login,divisi,no_telp,no_quote,no_order,deskripsi_komplain,kategori,status,assignee,solusi) values('"+date+"','"+sumber+"','"+onsite_support+"','"+nama_user+"','"+nik_user+"','"+user_login+"','"+divisi+"','"+no_telp+"','"+no_quote+"','"+no_order+"','"+deskripsi_komplain+"','"+kategori+"','"+status+"','"+assignee+"','"+solusi+"')"
        cur.execute(sql)
db.commit()
cur.close()
db.close()