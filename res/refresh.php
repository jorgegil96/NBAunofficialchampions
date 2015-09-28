<?php
include ("TeamNames.php");

$json_string = file_get_contents("teamstreaks.json");
$json_data = json_decode($json_string, true);

// First winner, league and season ever
$holder = "New York Knicks";
$league = "BAA";
$season = 1947;

$streak = 0;

/*
mode = 0 --> open regular season
mode = 1 --> open playoffs
*/
$mode = 0;

while ($season < 2016) {
    if ($mode == 0) {
        $file = fopen("../data/leagues_" . $league . "_" . $season . "_games_games.csv", "r");
        $mode = 1;
        $season_streak = 0; //resets every new season
        foreach ($json_data as $key => $row) {
            $json_data[$key]['season_streak'] = 0;
            $json_data[$key]['wins_season'] = 0;
            $json_data[$key]['losses_season'] = 0;
        }
    } 
    else {
        $file = fopen("../data/leagues_" . $league . "_" . $season . "_games_games_playoffs.csv", "r");
        $mode = 0;
    }
    while (($line = fgetcsv($file)) !== FALSE) {
        if ($line > 2) {
            if ($line[2] == $holder OR $line[4] == $holder) {
                $temp = $holder;
                if ($line[3] > $line[5]) {
                    $holder = $line[2];
                    $losser = $line[4];
                } 
                else {
                    $holder = $line[4];
                    $losser = $line[2];
                }
                if ($temp == $holder) {
                    $streak++;
                    $season_streak++;
                } 
                else {
                    $streak = 1;
                    $season_streak = 1;
                }
                
                $winner = getFranchise($holder, $franchises);
                $losser = getFranchise($losser, $franchises);
                foreach ($json_data as $key => $row) {
                    if ($row['id'] == $winner) {
                        $json_data[$key]['current_streak'] = $streak;
                        if ($season_streak > $json_data[$key]['season_streak']) {
                            $json_data[$key]['season_streak'] = $season_streak;
                        }
                        if ($streak > $json_data[$key]['alltime_streak']) {
                            $json_data[$key]['alltime_streak'] = $streak;
                        }
                        $json_data[$key]['wins_season']++;
                        $json_data[$key]['wins_alltime']++;
                    }
                }
                foreach ($json_data as $key => $row) {
                    if ($row['id'] == $losser) {
                        $json_data[$key]['current_streak'] = 0;
                        $json_data[$key]['losses_season']++;
                        $json_data[$key]['losses_alltime']++;
                    }
                }
            }
        }
    }
    
    if ($mode == 0) {
        $season++;
    }

    // Exception for 1948 season, previous holder did not play next season
    if ($season == 1948) {
        $streak = 0;
        $holder = "Washington Capitols";
    }
    if ($season > 1949) {
        $league = "NBA";
    }
    fclose($file);
}

/* 
foreach ($json_data as $key => $row) {
    $json_data[$key]['current_streak'] = 0;
    $json_data[$key]['season_streak'] = 0;
    $json_data[$key]['alltime_streak'] = 0;
    $json_data[$key]['wins'] = 0;
    $json_data[$key]['losses'] = 0;
}
*/

echo "<pre>";
print_r($json_data);
echo "<pre>";

$new_json_string = json_encode($json_data);
file_put_contents("teamstreaks.json", $new_json_string);
?>