<?php

header("Content-type: application/json");
error_reporting(0);

$url = file_get_contents('https://mywaifulist.moe/random');
$name = preg_match('/<meta property=\"og:title\" content=\"(.*?)\">/', $url, $nametitle);
$des = preg_match('/<meta property="og:description" content="(.*?)"/', $url, $description);
$thumb = preg_match('/"image": "(.*?)"/', $url, $image);
$gender = preg_match('/"gender": "(.*?)"/', $url, $gen);

$api = [
    'name' => $nametitle[1],
    'description' => htmlspecialchars_decode($description[1], ENT_QUOTES),
    'thumbnail' => $image[1],
    'gender' => $gen[1],
];

echo json_encode($api, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
