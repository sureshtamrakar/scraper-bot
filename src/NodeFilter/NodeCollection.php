<?php

namespace Suresh\ScraperBot\NodeFilter;

use DOMDocument;
use DOMXPath;

class NodeCollection
{

    public static DOMDocument $document;
    public static $url;


    public function __construct($response, $url)
    {
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($response);
        libxml_clear_errors();
        self::$document = $doc;
        self::$url = $url;
    }

    public static function xPath($selector)
    {
        $xpath = new DomXPath(self::$document);
        $article = $xpath->query($selector);
        return $article[0]->nodeValue;
    }

    public static function attribute($selector)
    {
        print_r(self::$document->getElementById($selector));
    }


    /* Get links of books */
    public static function link($selector)
    {
        $output = [];
        $articles = self::$document->getElementsByTagName($selector);
        foreach ($articles as $article) {
            $output[] = "https://books.toscrape.com/catalogue/" . str_replace("../", "", $article->firstChild->attributes['href']->value);
        }
        return $output;
    }


    /* Get by tag name of first element */
    public static function tagName($selector)
    {
        $articles = self::$document->getElementsByTagName($selector);
        return $articles[0]->nodeValue;
    }


    /* Pagination */
    public static function paginate($selector)
    {
        $paginate = self::$document->getElementsByTagName($selector);
        if ($paginate[1]->nodeValue > 20) {
            $page = ($paginate[1]->nodeValue) / 20;
            $count = (int)($page);
            return paginate(self::$url, $count);
        }
    }

    /* Table Value By Index */
    public static function table($index, $selector)
    {
        $item = self::$document->getElementsByTagName($selector);
        return $item[$index]->nodeValue;
    }

    /* Get review star value */

    public static function rating($selector)
    {
        $arr = [
            'One' => 1,
            'Two' => 2,
            'Three' => 3,
            'Four' => 4,
            'Five' => 5
        ];
        $xpath = new DomXPath(self::$document);
        $tags = $xpath->query($selector);
        $output = [];
        foreach ($tags as $tag) {
            $links = $tag->getElementsByTagName("p");
            $ratings = substr($links[2]->getAttribute('class'), 12);
            if (array_key_exists($ratings, $arr)) {
                return $arr[$ratings];
            }
        }
    }
}
