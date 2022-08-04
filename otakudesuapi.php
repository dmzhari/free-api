<?php

header('Content-type: application/json');
ob_flush();
error_reporting(0);
set_time_limit(0);
clearstatcache();
if (!empty($_GET['anime'])) {
	$anime = htmlspecialchars($_GET['anime']); # How To Use : http://example.com/otakudesuapi.php?anime=your anime title
	$get = file_get_contents("https://otakudesu.watch/?s=$anime&post_type=anime");
	if (preg_match("/<ul class=\"chivsrc\"><\/ul><div class=\"clear\">/i", $get)) {
		$api = [
			'author' => './EcchiExploit',
			'status' => 'failed',
			'result' => 'Anime Tidak Ada'
		];
		echo json_encode($api);
	} else {
		$re = preg_match_all("/title=\"(.*?)\" data-wpel-link=\"internal\">(.*?)/i", $get, $test);
		$page = file_get_contents($test[1][0]);
		$status = preg_match_all("/<span><b>Status<\/b>: (.*?)<\/span>/", $page, $check);
		if ($check[1][0] == "Ongoing") {
			$judul = preg_match_all("/class=\"infozingle\"><p><span><b(.*?)<\/b>:(.*?)<\/span>/i", $page, $judulanime);
			$sinopsis = preg_match_all("/class='sinopc'><p>(.*?)<\/p><\/div>/i", $page, $sinop);
			$thumb = preg_match_all("/img width=\"(.*?)\" height=\"(.*?)\" src=\"(.*?)\"/i", $page, $thumd);
			$nipc = preg_replace("/<p[^>]*?>/", "\n", $sinop[1][0]);
			$nipc = str_replace("</p>", "\n", $nipc);
			$nipc = preg_replace("/<a href=\"(.*?)\">(.*?)/i", "", $nipc);
			$nipc = str_replace("</a>", "", $nipc);
			$nipc = preg_replace("/<br \/>&#8211;/", "\n-", $nipc);
			$nipc = preg_replace("/<strong[^>]*?>/", "", $nipc);
			$nipc = str_replace("</strong>", "", $nipc);
			$ongoing = preg_match_all("/<span><a href=\"(.*?)\"/i", $page, $episode);
			$eps = file_get_contents($episode[1][1]);
			$p360 = preg_match_all("/<strong>MP4 360p<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $eps, $linkdownload) || preg_match_all("/<strong>360p<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $eps, $linkdownload);
			$download360 = preg_match_all("/href=\"(.*?)\"/i", $linkdownload[2][0], $don360p);
			$p480 = preg_match_all("/<strong>MP4 480p<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $eps, $linkdownload) || preg_match_all("/<strong>480p<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $eps, $linkdownload);
			$download480 = preg_match_all("/href=\"(.*?)\"/i", $linkdownload[2][0], $don480p);
			$p720 = preg_match_all("/<strong>MP4 720p<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $eps, $linkdownload) || preg_match_all("/<strong>720p<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $eps, $linkdownload);
			$download720 = preg_match_all("/href=\"(.*?)\"/i", $linkdownload[2][0], $don720p);
			$api = [
				'author' => './EcchiExploit',
				'status' => 'success',
				'result' => [
					'judul' => $judulanime[2][0],
					'thumbnail' => $thumd[3][0],
					'sinopsis' => $nipc,
					'download' => [
						'360' => [
							'racaty' => $don360p[1][0],
							'filesim' => $don360p[1][1],
							'acefile' => $don360p[1][2],
							'mega' => $don360p[1][3],
							'megaup' => $don360p[1][4]
						],
						'480p' => [
							'racaty' => $don480p[1][0],
							'filesim' => $don480p[1][1],
							'acefile' => $don480p[1][2],
							'mega' => $don480p[1][3],
							'megaup' => $don480p[1][4]
						],
						'720p' => [
							'racaty' => $don720p[1][0],
							'filesim' => $don720p[1][1],
							'acefile' => $don720p[1][2],
							'mega' => $don720p[1][3],
							'megaup' => $don720p[1][4]
						],
					],
				],
			];
			echo json_encode($api, JSON_PRETTY_PRINT);
		} else {
			$judul = preg_match_all("/class=\"infozingle\"><p><span><b(.*?)<\/b>:(.*?)<\/span>/i", $page, $judulanime);
			$sinopsis = preg_match_all("/class='sinopc'><p>(.*?)<\/p><\/div>/i", $page, $sinop);
			$thumb = preg_match_all("/img width=\"(.*?)\" height=\"(.*?)\" src=\"(.*?)\"/i", $page, $thumd);
			$nipc = preg_replace("/<p[^>]*?>/", "\n", $sinop[1][0]);
			$nipc = str_replace("</p>", "\n", $nipc);
			$nipc = preg_replace("/<a href=\"(.*?)\">(.*?)/i", "", $nipc);
			$nipc = str_replace("</a>", "", $nipc);
			$nipc = preg_replace("/<br \/>&#8211;/", "\n-", $nipc);
			$nipc = preg_replace("/<strong[^>]*?>/", "", $nipc);
			$nipc = str_replace("</strong>", "", $nipc);
			$batch = preg_match_all("/<span><a href=\"(.*?)\"/i", $page, $bat);
			$reso =  file_get_contents($bat[1][0]);
			$p360 = preg_match_all("/<strong>MP4 360p<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $reso, $linkdownload) || preg_match_all("/<strong>360p MP4<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $reso, $linkdownload);;
			$download360 = preg_match_all("/href=\"(.*?)\"/i", $linkdownload[2][0], $don360p);
			$p480 = preg_match_all("/<strong>MP4 480p<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $reso, $don480) || preg_match_all("/<strong>480p MP4<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $reso, $linkdownload);
			$download480 = preg_match_all("/href=\"(.*?)\"/i", $linkdownload[2][0], $don480p);
			$p720 = preg_match_all("/<strong>MP4 720p<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $reso, $don720) || preg_match_all("/<strong>720p MP4<\/strong> <a href=\"(.*?)\">(.*?)\/a> <i>/i", $reso, $linkdownload);
			$download720 = preg_match_all("/href=\"(.*?)\"/i", $linkdownload[2][0], $don720p);
			$api = [
				'author' => './EcchiExploit',
				'status' => 'success',
				'result' => [
					'judul' => $judulanime[2][0],
					'thumbnail' => $thumd[3][0],
					'sinopsis' => $nipc,
					'download' => [
						'360' => [
							'racaty' => $don360p[1][0],
							'filesim' => $don360p[1][1],
							'acefile' => $don360p[1][2],
							'mega' => $don360p[1][3],
							'megaup' => $don360p[1][4]
						],
						'480p' => [
							'racaty' => $don480p[1][0],
							'filesim' => $don480p[1][1],
							'acefile' => $don480p[1][2],
							'mega' => $don480p[1][3],
							'megaup' => $don480p[1][4]
						],
						'720p' => [
							'racaty' => $don720p[1][0],
							'filesim' => $don720p[1][1],
							'acefile' => $don720p[1][2],
							'mega' => $don720p[1][3],
							'megaup' => $don720p[1][4]
						],
					],
				],
			];
			echo json_encode($api, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		}
	}
} else {
	$api['error'] = 'not found';
	echo json_encode($api, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
ob_end_flush();
