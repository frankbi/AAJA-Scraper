import requests
import csv
import re
from bs4 import BeautifulSoup

c = csv.writer(open('rosters/Yankees_Roster.csv','w'), quoting = csv.QUOTE_ALL)
c.writerow(['First Name','Last Name','Team','Sport'])

url = 'http://newyork.yankees.mlb.com/team/roster_active.jsp?c_id=nyy'

r = requests.get(url)
soup = BeautifulSoup(r.text)
content = soup.table.findAll('a')
for x in content:
	name = x.string
	name = name.split(' ')
	c.writerow([name[0],name[1],'Yankees','Baseball'])
