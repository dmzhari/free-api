<?php
ob_clean();
error_reporting(0);

function getpage($from, $page)
{
	$i = 1;
	if ($page >= 51) {
		$api['error'] = 'Max Page Is 50!!';
		echo json_encode($api);
	} else {
		while ($i <= $page) {
			$getpages = "$from/page=$i";
			echo getlistdomain(file_get_contents($getpages));
			$i++;
		}
	}
}

function getlistdomain($url)
{
	$scrap = preg_match_all("/<td>(.*?)([a-z])<\/td>/i", $url, $page);
	$rep = str_replace('</td>', '', $page[0]);
	$rep = str_replace('<td>', '', $rep);
	$rep = preg_replace("/\/[^\/]*\/?$/i", '', $rep);
	$rep = array_filter(array_unique($rep));
	foreach ($rep as $key) {
		if (is_null($key)) {
			$api['status'] = 'failed';
			$api['result'] = 'No Result!!';
			echo json_encode($api);
		} else {
			$api['status'] = 'success';
			$api['result'] = $key;
			echo json_encode($api);
		}
	}
}

$from 		= htmlspecialchars($_GET['from']);
$page 		= htmlspecialchars($_GET['page']);
$attacker 	= htmlspecialchars($_GET['nickname']);
$team 		= htmlspecialchars($_GET['team']);

if (!empty($from) && !empty($page) || !empty($attacker) || !empty($team)) {
	if ($from == 'archive') {
		$url = 'https://zone-xsec.com/archive';
		echo getpage($url, $page);
	} else if ($from == 'special') {
		$url = 'https://zone-xsec.com/special';
		echo getpage($url, $page);
	} else if ($from == 'onhold') {
		$url = 'https://zone-xsec.com/onhold';
		echo getpage($url, $page);
	} else if ($from == 'attacker') {
		if (empty($attacker)) {
			echo 'Nickname attacker null or empty!!';
		}
		$name = str_replace('+', '%20', $attacker);
		$url = "https://zone-xsec.com/archive/attacker/$name";
		echo getpage($url, $page);
	} else if ($from == 'team') {
		if (empty($team)) {
			echo 'Team attacker null or empty!!';
		}
		$name = str_replace('+', '%20', $team);
		$url = "https://zone-xsec.com/archive/team/$name";
		echo getpage($url, $page);
	}
} else if (empty($from)) {
	echo "Grabber from empty or null!!<br>";
	echo 'How To Use : http://localhost/xsec-api.php?from=grab-from<br><br>
	Grabber From Archive : http://localhost/xsec-api.php?from=archive<br>
	Grabber From Special : http://localhost/xsec-api.php?from=special<br>
	Grabber From Onhold	 : http://localhost/xsec-api.php?from=onhold<br><br>
	Use Grab From Team Or Attacker :<br>
	http://localhost/xsec-api.php?from=grab-from&page=number-page&team=nickname-team<br>
	http://localhost/xsec-api.php?from=grab-from&page=number-page&attacker=attacker-name';
} else if (empty($page)) {
	echo 'Page null or empty!!<br>';
	echo 'How To Use : http://localhost/xsec-api.php?from=grab-from&page=number-page';
}
