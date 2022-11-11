<?php

namespace Suresh\ScraperBot\Controller;

use Suresh\ScraperBot\Bot;
use Suresh\ScraperBot\NodeFilter\NodeCollection;

class ScrapController
{

    public function withPagination($categoryURL)
    {
        $bot = new Bot();
        $bot->get($categoryURL);
        $pages = NodeCollection::paginate("strong");
        $output = [];
        $category = NodeCollection::tagName("h1");
        $values = NodeCollection::link('h3');
        foreach ($values as $key => $value) {
            $bot->get($value);
            $output[] = [
                'id' => randomVal(8),
                'category' => $category,
                'category-url' => $categoryURL,
                'title' => NodeCollection::tagName("h1"),
                'price' => preg_replace('/[^0-9.]+/', '', NodeCollection::xPath("//p[@class='price_color']")),
                'stock' => preg_replace('/[^a-z- ]/i', '', NodeCollection::table(5, "td")),
                'stock_qty'  => (int) filter_var(NodeCollection::table(5, "td"), FILTER_SANITIZE_NUMBER_INT),
                'UPC' => NodeCollection::table(0, "td"),
                'rating' => NodeCollection::rating("//div[@class='col-sm-6 product_main']"),
                'reviews' => (int) filter_var(NodeCollection::table(6, "td"), FILTER_SANITIZE_NUMBER_INT),
                'url' => $value
            ];
        }
        foreach ($pages as $key => $page) {
            $bot->get($page);
            $values = NodeCollection::link('h3');
            foreach ($values as $value) {
                $bot->get($value);
                $output[] = [
                    'id' => randomVal(8),
                    'category' => $category,
                    'category-url' => $categoryURL,
                    'title' => NodeCollection::tagName("h1"),
                    'price' => preg_replace('/[^0-9.]+/', '', NodeCollection::xPath("//p[@class='price_color']")),
                    'stock' => preg_replace('/[^a-z- ]/i', '', NodeCollection::table(5, "td")),
                    'stock_qty'  => (int) filter_var(NodeCollection::table(5, "td"), FILTER_SANITIZE_NUMBER_INT),
                    'UPC' => NodeCollection::table(0, "td"),
                    'rating' => NodeCollection::rating("//div[@class='col-sm-6 product_main']"),
                    'reviews' => (int) filter_var(NodeCollection::table(6, "td"), FILTER_SANITIZE_NUMBER_INT),
                    'url' => $value
                ];
            }
        }
        return $output;
    }


    public function withOutPagination($categoryURL)
    {
        $bot = new Bot();
        $bot->get($categoryURL);
        $output = [];
        $values = NodeCollection::link('h3');
        $category = NodeCollection::tagName("h1");
        foreach ($values as $key => $value) {
            $bot->get($value);
            $output[] = [
                'id' => randomVal(8),
                'category' => $category,
                'category-url' => $categoryURL,
                'title' => NodeCollection::tagName("h1"),
                'price' => preg_replace('/[^0-9.]+/', '', NodeCollection::xPath("//p[@class='price_color']")),
                'stock' => preg_replace('/[^a-z- ]/i', '', NodeCollection::table(5, "td")),
                'stock_qty'  => (int) filter_var(NodeCollection::table(5, "td"), FILTER_SANITIZE_NUMBER_INT),
                'UPC' => NodeCollection::table(0, "td"),
                'rating' => NodeCollection::rating("//div[@class='col-sm-6 product_main']"),
                'reviews' => (int) filter_var(NodeCollection::table(6, "td"), FILTER_SANITIZE_NUMBER_INT),
                'url' => $value,
            ];
        }
        return $output;
    }
}
