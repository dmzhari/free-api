<?php
/*
/ # Author : ./EcchiExploit
/ # Reverse Ip Lookup Unlimited Api
/ # How To Use :
/ # http://example.com/reverseapi.php?domain=your domain
/ # http://example.com/reverseapi.php?ip=your ip
*/
header('Content-type: application/json');
set_time_limit(60);
function reverse($url)
{
	$setopt = array(
		CURLOPT_URL => "https://osint.sh/reverseip/",
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_POSTFIELDS => "domain=$url",
		CURLOPT_POST => 1
	);
	$ch = curl_init();
	curl_setopt_array($ch, $setopt);
	$exe = curl_exec($ch);
	curl_close($ch);
	return $exe;
}
if (!empty($_GET['domain'])) {
	$domain = htmlspecialchars($_GET['domain']);
	if (!preg_match("#^http(s)?://#", $domain)) {
		$site = "http://" . $domain;
	} else {
		$site = $domain;
	}
	$parse = parse_url($site);
	$url = preg_replace('/^www\./', '', $parse['host']);
	$www = "www." . $url;
	$ip = gethostbyname($www);
	$reverse = reverse($ip);
	$list = preg_match_all("/<td data-th=\"Domain\">\s(.*?)<\/td>/i", $reverse, $listdomain);
	$getdomain = str_replace(' ', '', $listdomain[1]);
	if ($listdomain[1] == true) {
		$arr = [
			'author' => './EcchiExplot',
			'status' => 'success',
			'result' => array_filter($getdomain)
		];
		echo json_encode($arr, JSON_PRETTY_PRINT);
	} else {
		$arr = [
			'author' => './EcchiExplot',
			'status' => 'failed',
			'result' => $listdomain[1]
		];
		echo json_encode($arr, JSON_PRETTY_PRINT);
	}
} else if (!empty($_GET['ip'])) {
	$ip = htmlspecialchars($_GET['ip']);
	$reverse = reverse($ip);
	$list = preg_match_all("/<td data-th=\"Domain\">\s(.*?)<\/td>/i", $reverse, $listdomain);
	$getdomain = str_replace(' ', '', $listdomain[1]);
	if ($listdomain[1] == true) {
		$arr = [
			'author' => './EcchiExplot',
			'status' => 'success',
			'result' => array_filter($getdomain)
		];
		echo json_encode($arr, JSON_PRETTY_PRINT);
	} else {
		$arr = [
			'author' => './EcchiExplot',
			'status' => 'failed',
			'result' => $getdomain
		];
		echo json_encode($arr, JSON_PRETTY_PRINT);
	}
} else {
	echo "Domain Or Ip Empty";
}
