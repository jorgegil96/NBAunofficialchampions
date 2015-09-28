<?php

	$teams = [
        'Washington Wizards' => 'WAS',
        'Cleveland Cavaliers' => 'CLE',
        'Dallas Mavericks' => 'DAL',
        'Los Angeles Lakers' => 'LAL',
        'Boston Celtics' => 'BOS',
        'Miami Heat' => 'MIA', 
        'Sacramento Kings' => 'SAC',
        'Chicago Bulls' => 'CHI',
        'Houston Rockets' => 'HOU',
        'Detroit Pistons' => 'DET',
        'Memphis Grizzlies' => 'MEM',
        'Los Angeles Clippers' => 'LAC',
        'San Antonio Spurs' => 'SAS',
        'Denver Nuggets' => 'DEN',
        'Philadelphia 76ers' => 'PHI',
        'Golden State Warriors' => 'GSW',
        'Phoenix Suns' => 'PHX',
        'Portland Trail Blazers' => 'POR',
        'Indiana Pacers' => 'IND',
        'Toronto Raptors' => 'TOR',
        'Utah Jazz' => 'UTA',
        'Oklahoma City Thunder' => 'OKC',
        'Atlanta Hawks' => 'ATL',
        'Milwaukee Bucks' => 'MIL',
        'Charlotte Hornets' => 'CHA',
        'Minnesota Timberwolves' => 'MIN',
        'New York Knicks' => 'NYK',
        'Orlando Magic' => 'ORL',
        'Brooklyn Nets' => 'BKN',
        'New Orleans Pelicans' => 'NOP',

        // Defunct Franchises
        'New Jersey Nets' => 'NJN',
        'New Orleans Hornets' => 'NOH',
        'New Orleans/Oklahoma City Hornets' => 'NOK',
        'Seattle SuperSonics' => 'SEA',
        'Vancouver Grizzlies' => 'VAN',
        'Charlotte Bobcats'   => 'CHA',
        'Toronto Huskies' => 'HUS',
        'Chicago Stags' => 'CHS',
        'Providence Steam Rollers' => 'PRO',
        'Pittsburgh Ironmen' => 'PIT',
        'Philadelphia Warriors' => 'PHW',
        'St. Louis Bombers' => 'BOM',
        'Cleveland Rebels' => 'CLR',
        'Washington Capitols' => 'WAS',
        'Detroit Falcons' => 'DEF',
        'Baltimore Bullets' => 'BAL',
        'Minneapolis Lakers' => 'MNL',
        'Indianapolis Olympians' => 'INO',
        'Indianapolis Jets' => 'JET',
        'Fort Wayne Pistons' => 'FTW',
        'Rochester Royals' => 'ROC',
        'Waterloo Hawks' => 'WAT',
        'Anderson Packers' => 'AND',
        'Syracuse Nationals' => 'SYR',
        'Tri-Cities Blackhawks' => 'TCB',


    ];

	$franchises = [
        'ATL' => ['Atlanta Hawks', 'St. Louis Hawks', 'Milwaukee Hawks', 'Tri-Cities Blackhawks'],
        'BOS' => ['Boston Celtics'],
        'BKN' => ['Brooklyn Nets', 'New Jersey Nets', 'New York Nets'],
        'CHA' => ['Charlotte Hornets', 'Charlotte Bobcats'],
        'CHI' => ['Chicago Bulls'],
        'CLE' => ['Cleveland Cavaliers'],
        'DAL' => ['Dallas Mavericks'],
        'DEN' => ['Denver Nuggets'],
        'DET' => ['Detroit Pistons', 'Fort Wayne Pistons'],
        'GSW' => ['Golden State Warriors', 'San Francisco Warriors', 'Philadelphia Warriors'],
        'HOU' => ['Houston Rockets', 'San Diego Rockets'],
        'IND' => ['Indiana Pacers'],
        'LAC' => ['Los Angeles Clippers', 'San Diego Clippers', 'Buffalo Braves'],
        'LAL' => ['Los Angeles Lakers', 'Minneapolis Lakers'],
        'MEM' => ['Memphis Grizzlies', 'Vancouver Grizzlies'],
        'MIA' => ['Miami Heat'],
        'MIL' => ['Milwaukee Bucks'],
        'MIN' => ['Minnesota Timberwolves'],
        'NOP' => ['New Orleans Pelicans', 'New Orleans Hornets', 'New Orleans/Oklahoma City Hornets'],
        'NYK' => ['New York Knicks'],
        'OKC' => ['Oklahoma City Thunder', 'Seattle SuperSonics'],
        'ORL' => ['Orlando Magic'],
        'PHI' => ['Philadelphia 76ers', 'Syracuse Nationals'],
        'PHX' => ['Phoenix Suns'],
        'POR' => ['Portland Trail Blazers'],
        'SAC' => ['Sacramento Kings', 'Kansas City Kings', 'Kansas City-Omaha Kings', 'Cincinnati Royals', 'Rochester Royals'],
        'SAS' => ['San Antonio Spurs'],
        'TOR' => ['Toronto Raptors'],
        'UTA' => ['Utah Jazz', 'New Orleans Jazz'],
        'WAS' => ['Washington Wizards', 'Washington Bullets', 'Capital Bullets', 'Baltimore Bullets', 'Chicago Zephyrs', 'Chicago Packers', 'Washington Capitols'],
        // ---
        //'SEA' => ['Seattle SuperSonics'],
        //'VAN' => ['Vancouver Grizzlies'],
        //'NJN' => ['New Jersey Nets'],
        //'NOH' => ['New Orleans Hornets'],
        //'NOK' => ['New Orleans/Oklahoma City Hornets'],        
        'AND' => ['Anderson Packers'],
        'BLB' => ['Baltimore Bullets'],
        'CHS' => ['Chicago Stags'],
        //'DNN' => ['Denver Nuggets'],
        'INO' => ['Indianapolis Olympians'],
        'SHE' => ['Sheboygan Red Skins'],
        'STB' => ['St. Louis Bombers'],
        'WSH' => ['Washington Capitols'],
        'WAT' => ['Waterloo Hawks'],
        'HUS' => ['Toronto Huskies'],
        'PRO' => ['Providence Steam Rollers'],
        'PIT' => ['Pittsburgh Ironmen'],
        'CLR' => ['Cleveland Rebels'],
        'DEF' => ['Detroit Falcons'],
        'JET' => ['Indianapolis Jets'],
        'WAT' => ['Waterloo Hawks'],



    ];

    function getFranchise($string, $franchises) {
        foreach ($franchises as $fra=>$fra_array) {
            foreach ($fra_array as $name) {
                if ($name == $string) {
                    return $fra;
                }
            }
        }
    }



?>