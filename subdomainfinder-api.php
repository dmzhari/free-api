<?php
// Use : localhost/subdomainfinder-api.php?domain=example.com
ob_flush();
clearstatcache();
function curl($url)
{
    $setopt = array(
        CURLOPT_URL => 'https://osint.sh/subdomain/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => "domain=$url",
        CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36",
        CURLOPT_TIMEOUT => 60,
        CURLOPT_CONNECTTIMEOUT => 60
    );
    $ch = curl_init();
    curl_setopt_array($ch, $setopt);
    $exe = curl_exec($ch);
    curl_close($ch);
    return $exe;
}
if (!empty($_GET['domain']))
{
    $domain = htmlspecialchars($_GET['domain']);
    $subdomain = curl($domain);
    $scrap = preg_match_all("/<a href=\"(.*?)\" target=\"_blank\">www.(.*?)<\/a>/i", $subdomain, $subdo);
    $api['status'] = http_response_code();
    $api['result'] = $subdo[2];
    echo json_encode($api);
}
else
{
    $api['error'] = 'Not Found';
    echo json_encode($api);
}
?>
