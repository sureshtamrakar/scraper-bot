<?php

if (!function_exists('paginate')) {

    function paginate($url, $count)
    {
        $newUrl = substr($url, 0, strrpos($url, '/'));
        $output = [];
        for ($i = 0; $i < $count; $i++) {
            $num = $i + 2;
            $output[] = $newUrl . '/' . "page-$num.html";
        }
        return $output;
    }
}
if (!function_exists('randomVal')) {

    function randomVal($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
}

if (!function_exists('arraySort')) {

    function arraySort($arr, $arr_key)
    {
        if (is_array($arr)) {
            $keys = array_column($arr, $arr_key);
            array_multisort($keys, SORT_DESC, $arr);
            return $arr;
        }
    }
}

if (!function_exists('createCSV')) {
    function createCSV($fileName, $datas)
    {
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$fileName}");
        header("Expires: 0");
        header("Pragma: public");

        $fh = @fopen('php://output', 'w');

        $headerDisplayed = false;

        foreach ($datas as $data) {
            // Add a header row if it hasn't been added yet
            if (!$headerDisplayed) {
                // Use the keys from $data as the titles
                fputcsv($fh, array_keys($data));
                $headerDisplayed = true;
            }

            // Put the data into the stream
            fputcsv($fh, $data);
        }
        // Close the file
        fclose($fh);
        // Make sure nothing else is sent, our file is done
        exit;
    }
}
