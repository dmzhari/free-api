<?php
header("Content-type: application/json");
error_reporting(0);

$url = file_get_contents('http://randomwaifu.altervista.org/');

preg_match("/\">([a-zA-Z0-9].+\s[a-zA-Z0-9]+)/", $url, $nametitle);
preg_match_all("/([a-zA-Z0-9]+.png)/", $url, $thumb);
$split = explode(" from ", $nametitle[1]);

$api = [
    'name' => $split[0],
    'anime' => $split[1],
    'thumbnail' => "http://randomwaifu.altervista.org/images/" . $thumb[0][1],
];

echo json_encode($api, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
