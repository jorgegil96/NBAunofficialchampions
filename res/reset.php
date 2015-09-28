<?php
$json_string = file_get_contents("teamstreaks.json");
$json_data = json_decode($json_string, true);

foreach ($json_data as $key => $row) {
    $json_data[$key]['current_streak'] = 0;
    $json_data[$key]['season_streak'] = 0;
    $json_data[$key]['alltime_streak'] = 0;
    $json_data[$key]['wins_season'] = 0;
    $json_data[$key]['losses_season'] = 0;
    $json_data[$key]['wins_alltime'] = 0;
    $json_data[$key]['losses_alltime'] = 0;

    $count++;
}

echo "Succesfully modified ".$count." records...";

$new_json_string = json_encode($json_data);
file_put_contents("teamstreaks.json", $new_json_string);
?>