<?php



use Suresh\ScraperBot\Bot;
use Suresh\ScraperBot\Controller\ScrapController;
use Suresh\ScraperBot\NodeFilter\NodeCollection;

require 'vendor/autoload.php';

if (isset($_GET['reviews'])) {
    $scrap = new ScrapController;
    $science = $scrap->withOutPagination("https://books.toscrape.com/catalogue/category/books/science_22/index.html");
    $history = $scrap->withPagination("https://books.toscrape.com/catalogue/category/books/historical-fiction_4/index.html");

    $data = array_merge($science, $history);
    $value = arraySort($data, 'stock_qty');
    createCSV('reviews_desc.csv', $value);
} else {
    $scrap = new ScrapController;
    $science = $scrap->withOutPagination("https://books.toscrape.com/catalogue/category/books/science_22/index.html");
    $history = $scrap->withPagination("https://books.toscrape.com/catalogue/category/books/historical-fiction_4/index.html");

    $value = array_merge($science, $history);
    createCSV('toscrape_listing.csv', $value);
}
