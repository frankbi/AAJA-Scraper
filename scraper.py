#!/usr/bin/env python
 
import scraperwiki
import requests
from bs4 import BeautifulSoup
 
base_url = 'http://frankbi.com/aaja/farmermarkets/'
page_array = []

def get_pages():
    html = requests.get(base_url+'page5.html')
    soup = BeautifulSoup(html.content, "html.parser")
    
    page_list = soup.findAll(id='pages')
    pages = page_list[0].findAll('a')
    
    for page in pages:
        page_array.append(page.get('href'))

def scrape_page(page):
    html = requests.get(page)
    soup = BeautifulSoup(html.content, "html.parser")

    table = soup.findAll('table')
    rows = table[0].findAll('tr')

    if len(soup.findAll('th')) > 0:
        rows = rows[1:]

    for row in rows:
        cells = row.findAll('td')
        data = {
            'county' : cells[0].get_text(),
            'market' : cells[1].get_text(),
            'address' : cells[2].get_text(),
            'city' : cells[3].get_text(),
            'state' : cells[4].get_text(),
            'zip_code' : cells[5].get_text(),
            'lat' : cells[6].get_text(),
            'lon' : cells[7].get_text()
        }

        scraperwiki.sql.save(data.keys(), data)

get_pages()
[scrape_page(base_url + page) for page in page_array]
