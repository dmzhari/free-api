<?php

header('Content-type: application/json');
ob_clean();
flush();
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
			$url = file_get_contents($getpages);
			$scrap = preg_match_all("/<td>(.*?)([a-z])<\/td>/i", $url, $getdomain);
			$rep = str_replace('</td>', '', $getdomain[0]);
			$rep = str_replace('<td>', '', $rep);
			$rep = preg_replace("/\/[^\/]*\/?$/i", '', $rep);
			$rep = array_filter(array_unique($rep));
			if (is_null($rep)) {
				$api['status'] = 'failed';
				$api['result'] = 'No Result!!';
				//echo json_encode($api, JSON_PRETTY_PRINT);
			} else {
				$api['status'] = 'success';
				$api["result_$i"] = $rep;
			}
			$i++;
		}
		echo json_encode($api, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
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
	echo "Grabber from empty or null!!\n";
	echo "How To Use : http://localhost/xsec-api.php?from=grab-from\n\n
	Grabber From Archive : http://localhost/xsec-api.php?from=archive\n
	Grabber From Special : http://localhost/xsec-api.php?from=special\n
	Grabber From Onhold	 : http://localhost/xsec-api.php?from=onhold\n\n
	Use Grab From Team Or Attacker :\n
	http://localhost/xsec-api.php?from=team&page=number-page&team=nickname-team\n
	http://localhost/xsec-api.php?from=attacker&page=number-page&nickname=attacker-name";
} else if (empty($page)) {
	echo "Page null or empty!!\n";
	echo 'How To Use : http://localhost/xsec-api.php?from=grab-from&page=number-page';
}
