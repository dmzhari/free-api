<?php
function curl($mail)
{
	$setopt = array(
		CURLOPT_URL 			=> 'https://osint.sh/reversewhois/',
		CURLOPT_RETURNTRANSFER	=> true,
		CURLOPT_POST			=> true,
		CURLOPT_POSTFIELDS		=> "email=$mail",
		CURLOPT_USERAGENT		=> 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36',
		CURLOPT_CONNECTTIMEOUT	=> 60,
		CURLOPT_TIMEOUT 		=> 60,
		CURLOPT_HEADER			=> false
	);
	$ch = curl_init();
	curl_setopt_array($ch, $setopt);
	$exe = curl_exec($ch);
	curl_close($ch);
	return $exe;
}
if (!empty($_GET['email']))
{
	$email = htmlspecialchars($_GET['email']);
	$lookup = curl($email);
	$scrapt = preg_match_all("/<a href=\"https:\/\/(.*?)\">(.*?)<\/a>/i", $lookup, $domain);
	$url = preg_replace("/<i class=\"(.*?)\"><\/i>/", '', $domain[2]);
	$url = str_replace('Teguh Aprianto', '',	 $url);
	$filter = array_filter($url);
	if (!$filter == null)
	{
			$api['status'] = http_response_code();
			$api['result'] = $filter;
			echo json_encode($api);
	}
	else
	{
		$api['status'] = http_response_code();
		$api['result'] = 'No Result';
		echo json_encode($api);
	}
}
else if (empty($_GET['email']))
{
	$api['error'] = 'Not Found';
	echo json_encode($api);
}
?>