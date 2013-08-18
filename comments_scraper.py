#!/usr/bin/env python
 
# Import libraries
import scraperwiki
import requests
from bs4 import BeautifulSoup

# Set the home page to a variable 
base_url = 'http://frankbi.com/aaja/farmermarkets/'

# Initialize the list of pages to scrape
page_array = []

# Function to add links of pages to page_array variable. We run get_pages() at line 74.
def get_pages():

    # Set the content of the home page to a variable
    html = requests.get(base_url)

    # Use Beautiful Soup to "soupify" the content of the home page
    soup = BeautifulSoup(html.content, "html.parser")
    
    # Select the <ul id="pages"> and set it to a variable
    page_list = soup.findAll(id='pages')

    # Select all the <a> link tags inside the <ul> and set them to a variable
    pages = page_list[0].findAll('a')
    
    # Loop each of the <a> link tags
    for page in pages:

        # Add each <a> link tag to the page_array variable
        page_array.append(page.get('href'))

# Function to scrape data from each page in pages_array
def scrape_page(page):

    # Set the content of the page to a variable and "soupify"
    html = requests.get(page)
    soup = BeautifulSoup(html.content, "html.parser")

    # Select the <table> variable and set it to a variable
    table = soup.findAll('table')

    # Select all the <tr> tags and set them to a variable
    rows = table[0].findAll('tr')

    # Skip the table header <th> row if it's there'
    if len(soup.findAll('th')) > 0:
        rows = rows[1:]

    # Loop each of the <tr> tags
    for row in rows:

        # Select all the data <td> tags 
        cells = row.findAll('td')

        # Create a data variable that contains for each of the eight attributes we scrape
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

        # Use ScraperWiki's save method to save the data in the data variable to ScraperWiki's database
        scraperwiki.sql.save(data.keys(), data)

# Run the get_pages() function
get_pages()

# Loop through the pages in page_array and call scrape_page function using a Python list comprehension
[scrape_page(base_url + page) for page in page_array]