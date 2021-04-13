<?php

//error_reporting(0);
header('Content-type: application/json');

function curl($keyword)
{
    $setopt = array(
        CURLOPT_URL => 'https://osint.sh/domain/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => "domain=$keyword",
        CURLOPT_POST => true,
        CURLOPT_CONNECTTIMEOUT => 60
    );
    $ch = curl_init();
    curl_setopt_array($ch, $setopt);
    $exe = curl_exec($ch);
    curl_close($ch);
    return $exe;
}

if (!empty($_GET['key'])) {
    $key = htmlspecialchars($_GET['key']);
    $curl = curl($key);

    // Scrap Web 
    $regex = preg_match_all('/\s<a href=\"https:\/\/(.*?)\">/', $curl, $getkeyword);
    $rep = array_filter(str_replace('teguh.co/', '', $getkeyword[1]));

    // Rest Api
    if (is_null($rep)) {
        $api['status'] = 'failed';
        $api['resutl'] = 'no result';
        echo json_encode($api, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    } else {
        $api['status'] = 'success';
        $api['result'] = $rep;
        echo json_encode($api, JSON_PRETTY_PRINT) | JSON_UNESCAPED_SLASHES;
    }
} else {
    $api['error'] = 'keyword empty!!';
    echo json_encode($api, JSON_PRETTY_PRINT);
}
