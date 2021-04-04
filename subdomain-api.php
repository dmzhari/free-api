<?php
ob_flush();
clearstatcache();
include '../random-useragent.php';
function curl($url)
{
    $setopt = array(
        CURLOPT_URL             => 'https://osint.sh/subdomain/',
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_POST            => true,
        CURLOPT_POSTFIELDS      => "domain=$url",
        CURLOPT_USERAGENT       => getUserAgent(),
        CURLOPT_TIMEOUT         => 60,
        CURLOPT_CONNECTTIMEOUT  => 60
    );
    $ch = curl_init();
    curl_setopt_array($ch, $setopt);
    $exe = curl_exec($ch);
    curl_close($ch);
    return $exe;
}
if (!empty($_GET['domain'])) {
    $domain = htmlspecialchars($_GET['domain']);
    $subdomain = curl($domain);
    $scrap = preg_match_all("/<a href=\"https:\/\/(.*?)\"/i", $subdomain, $subdo);
    $rep = array_unique(array_filter(preg_replace("#twitter.com/secgron|teguh.co/|www.linkedin.com/in/secgron|fb.me/secgron|fb.me/secgron|github.com/secgron#", '', $subdo[1])));
    $api['status'] = http_response_code();
    $api['result'] = $rep;
    echo json_encode($api);
} else {
    $api['error'] = 'Not Found';
    echo json_encode($api);
}
