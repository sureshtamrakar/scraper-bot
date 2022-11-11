<?php

namespace Suresh\ScraperBot;

use Suresh\ScraperBot\NodeFilter\NodeCollection;

class Bot
{

    public function get(string $url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_ENCODING,  '');
        $response = curl_exec($ch);
        curl_close($ch);
        return new NodeCollection($response,$url);
    }
}
