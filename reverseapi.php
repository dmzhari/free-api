<?php
/*
/ # Author : ./EcchiExploit
/ # Reverse Ip Lookup Unlimited Api
*/
function reverse($url){
	$setopt = array(
		CURLOPT_URL => "https://tools.hack.co.id/reverseip/",
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_POSTFIELDS => "domain=$url&recaptcha_response=",
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
		$site = "http://".$domain;
	}
	else {
		$site = $domain;
	}
	$parse = parse_url($site);
	$url = preg_replace('/^www\./', '', $parse['host']);
	$www = "www.".$url;
	$ip = gethostbyname($www);
	$reverse = reverse($ip);
	$list = preg_match_all("/<td><a href=\"(.*?)\">/i", $reverse, $listdomain);
	if ($listdomain[1] == true) {
		$arr = [
		'author' => './EcchiExplot',
		'status' => 'success',
		'result' => $listdomain[1]
		];
		echo json_encode($arr);
	}
	else {
		$arr = [
		'author' => './EcchiExplot',
		'status' => 'failed',
		'result' => $listdomain[1]
		];
		echo json_encode($arr);
	}
}
else if (!empty($_GET['ip'])) {
	$ip = htmlspecialchars($_GET['ip']);
	$reverse = reverse($ip);
	$list = preg_match_all("/<td><a href=\"(.*?)\">/i", $reverse, $listdomain);
	if ($listdomain[1] == true) {
		$arr = [
		'author' => './EcchiExplot',
		'status' => 'success',
		'result' => $listdomain[1]
		];
		echo json_encode($arr);
	}
	else {
		$arr = [
		'author' => './EcchiExplot',
		'status' => 'failed',
		'result' => $listdomain[1]
		];
		echo json_encode($arr);
	}
}
else {
	echo "Domain Or Ip Empty";
}
?>