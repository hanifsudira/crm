import requests,datetime,MySQLdb,json
from bs4 import BeautifulSoup
from calendar import monthrange

db = MySQLdb.connect(host="127.0.0.1", user="root", passwd="", db="migrasi")

now = datetime.datetime.now()
day = str(now.day)
month = str(now.month)
year = str(now.year)
init = '01'+'/01/'+year
today = day+'/'+month+'/'+year

url = 'http://mydashboard.telkom.co.id/ms2/report_migrasi_ftth_detil.php?start_date='+init+'&end_date='+today+'&p_kawasans=DIVRE_2&p_witel=JAKBAR&p_migrasi=ALL&p_alpro=ALL&p_tito=ALL&p_colom=KANTOR_DATEL_JAKARTA_BARAT&p_etat=PS&p_sql=1'

r = requests.get(url)
soup = BeautifulSoup(r.content, 'html.parser')

datas = []
for row in soup.find_all('tr'):
    cols = row.find_all('td')
    cols = [ele.text.strip() for ele in cols]
    datas.append([ele for ele in cols])

cur = db.cursor()
for i,data in enumerate(datas):
	if i > 1:
		orderid = data[1]
		nama = data[6].replace("'",'')
		notelp = data[21]
		# print orderid,nama,alamat,keterangan,notelp
		# break
		sql = "insert into ms2migrate (orderid,nama,notelp) values('"+str(orderid)+"','"+str(nama)+"','"+str(notelp)+"');"
		cur.execute(sql)

db.commit()
cur.close()
db.close()