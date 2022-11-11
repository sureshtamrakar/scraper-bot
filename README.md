### Web scraper
##### Web Scraper using PHP Curl, DOMDocument, DOMXPath

#### Installation Instructions
* Clone repo to your local server
* Start local server `php -S localhost:8080` (Change your port according to your environment)

##### PHP server will start at: http://localhost:8080 or you can directly access by http://localhost/scraper-bot/

##### Scraper Information


| URL |  Note
| --- | --- |
| `http://localhost/scraper-bot` | Generates `toscrape_listing.csv`
| `http://localhost/scraper-bot/?reviews=download` | Generates `reviews_desc.csv`

## Usage example

```php
use Suresh\ScraperBot\Controller\ScrapController;
$scrap = new ScrapController;
$science = $scrap->withOutPagination("https://books.toscrape.com/catalogue/category/books/science_22/index.html");
$history = $scrap->withPagination("https://books.toscrape.com/catalogue/category/books/historical-fiction_4/index.html");
```

#### Note - File download is conditioned based on GET request. For `reviews_desc.csv` file `reviews` parameter should be valid. 

