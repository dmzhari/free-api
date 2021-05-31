<?php
header('Content-type: application/json');
clearstatcache();
set_time_limit(0);
error_reporting(0);

$con = mysqli_connect('localhost', 'root', '', 'binggrab');
$page = 0;
$dork = htmlspecialchars($_GET['dork']);
$dork = str_replace(' ', '%20', $dork);

if (empty($dork)) {
    $rest['error'] = 'Dork Empty';
    echo json_encode($rest, JSON_PRETTY_PRINT);
} else {
    while ($page <= 500) {
        $api = file_get_contents("https://www.bing.com/search?q=$dork&first=$page&FORM=PORE");
        $getdomain = preg_match_all('#<h2><a href="((?:https://|http://)[a-zA-Z0-9-_]+\.*[a-zA-Z0-9][a-zA-Z0-9-_]+\.[a-zA-Z]{2,11})#', $api, $domain);
        $page = $page + 10;
        foreach ($domain[1] as $key) {
            $key = preg_replace('/http:\/\/|https:\/\/|www./', '', $key);
            mysqli_query($con, "INSERT INTO domain VALUES ('$key')");
        }
    }

    $result = mysqli_query($con, 'SELECT * FROM domain');
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['list'] . "\n";
            mysqli_query($con, 'DELETE FROM domain');
        }
    } else {
        $rest['error'] = 'Database Empty';
        echo json_encode($rest, JSON_PRETTY_PRINT);
    }
}
