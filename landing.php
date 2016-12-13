<?php
include ("res/TeamNames.php");
$string = file_get_contents("res/season-holders.json");
$json_a = json_decode($string, true);

$season = 2016;
if (file_exists("data/leagues_NBA_".$season."_games_games_playoffs.csv")) {
    $playoffs_file = "data/leagues_NBA_".$season."_games_games_playoffs.csv";
    $playoffs_games = file($playoffs_file, FILE_SKIP_EMPTY_LINES);
    if (count($playoffs_games) < 17) {
        $regular_file = "data/leagues_NBA_".$season."_games_games.csv";
        $regular_games = file($regular_file, FILE_SKIP_EMPTY_LINES);

        $type = "playoffs";
        $season--;
    } else {
        $type = "regular";
    }
} else {
    $regular_file = "data/leagues_NBA_".$season."_games_games.csv";
    $regular_games = file($regular_file, FILE_SKIP_EMPTY_LINES);
    if (count($regular_games) < 17) {
        $playoffs_file = "data/leagues_NBA_".($season - 1)."_games_games_playoffs.csv";
        $playoffs_games = file($playoffs_file);

        $type = "regular";
        $season--;
    } else {
        $type = "playoffs";
        $season--;
    }
}

foreach ($json_a as $key => $row) {
    if ($row['season'] == $season && $row['type'] == $type) {
        $original_holder = $json_a[$key]["holder"];
        break;
    }
}

$holder = $original_holder;

//2014 @ playoffs SAS
//2015 @ regular NOP
//playoffs -> last complete was next regular season
//regular -> last complete was next playoffs
if ($type == "playoffs") {
    $season++;
    $loc = "data/leagues_NBA_".$season."_games_games.csv";
} else {
    $loc = "data/leagues_NBA_".$season."_games_games_playoffs.csv";
}

$file = fopen($loc, "r");
$cont = 0;
while (($line = fgetcsv($file)) !== FALSE) {
        if ($cont > 1) {
            if ($line[2] == $holder OR $line[4] == $holder) {
                $cont2++;
                $titlegames[] = $line;
                if ($line[3] > $line[5]) {
                    $holder = $line[2];
                }
                else {
                    $holder = $line[4];
                }
            }
        }
        $cont++;
}
$cont = $cont2;
fclose($file);

if ($titlegames[$cont - 1][3] > $titlegames[$cont - 1][5]) {
    $champ = $titlegames[$cont - 1][2];
} else {
    $champ = $titlegames[$cont - 1][4];
}

$string = file_get_contents("res/teamstreaks.json");
$json_b = json_decode($string, true);

// CURRENT HOLDER STATS
foreach($json_b as $key => $row) {
    if ($row["id"] == $teams[$champ]) {
        $current_streak = $json_b[$key]["current_streak"];
        $season_streak = $json_b[$key]["season_streak"];
        $alltime_streak = $json_b[$key]["alltime_streak"];
        $wins = $json_b[$key]["wins_season"];
        $losses = $json_b[$key]["losses_season"];
        $total_games = $wins + $losses;
        if ($total_games == 0) {
            $per = 0;
        } else {
            $per = ($wins * 100) / $total_games;
            $per = substr($per, 0, 5);
        }
        break;
    }
}

// SEASON STATS
$best_season_streak = 0;
$best_season_streak_team = array();
$title_games_season = 0;
$most_wins_season = 0;
$most_wins_seaosn_team = 0;

foreach($json_b as $key => $row) {
    if ($json_b[$key]["season_streak"] > $best_season_streak) {
        $best_season_streak = $json_b[$key]["season_streak"];
        $best_season_streak_team = array();
        $best_season_streak_team[] = $json_b[$key]["id"];
    } else if ($json_b[$key]["season_streak"] == $best_season_streak) {
        $best_season_streak_team[] = $json_b[$key]["id"];
    }
    $most_wins_season = $json_b[$key]["wins_season"] > $most_wins_season ? $json_b[$key]["wins_season"] : $most_wins_season;
}

// ALLTIME STATS
$best_alltime_streak = 0;
$best_alltime_streak_team = array();

foreach($json_b as $key => $row) {
    if ($json_b[$key]["alltime_streak"] > $best_alltime_streak) {
        $best_alltime_streak = $json_b[$key]["alltime_streak"];
        $best_alltime_streak_team = array();
        $best_alltime_streak_team[] = $json_b[$key]["id"];
    } else if ($json_b[$key]["alltime_streak"] == $best_alltime_streak) {
        $best_alltime_streak_team[] = $json_b[$key]["id"];
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NBA Unofficial Champs</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<br>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="#">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="gamelog.php">Game Log</a>
                    </li>
                    <li>
                        <a href="#services">Services</a>
                    </li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>NBA Unofficial Champs</h1>
                        <h3>Tracking the belt holder all the way back to 1946</h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                            </li>
                            <li>
                                <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Linkedin</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->

	<a  name="services"></a>
    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Current Belt Holder:<br><?php echo $champ; ?></h2>
                    <br>
                    <h4>Current Streak: <b><?php echo $current_streak; ?></b></h4>
                    <h4>Longest Streak this season: <b><?php echo $season_streak; ?></b></h4>
                    <h4>Longest Streak all time: <b><?php echo $alltime_streak; ?></b></h4>
                    <br>
                    <h4>Title games this season: <?php echo $total_games; ?></h4>
                    <h4>Wins: <?php echo $wins; ?></h4>
                    <h4>Losses: <?php echo $losses; ?></h4>
                    <h4>Win %: <?php echo $per; ?></h4>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/logos/GSW.png" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <label>Last 15 Title Games Log</label>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Home</th>
                                <th>PTS</th>
                                <th>Away</th>
                                <th>PTS</th>
                                <th>Winner</th>
                                <th>Streak</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        for ($i = 0; $i < 15; $i++) {
                            $streak = 1;
                            if ($titlegames[$cont - $i - 1][3] > $titlegames[$cont - $i - 1][5]) {
                                $holder = $titlegames[$cont - $i - 1][2];
                            }
                            else {
                                $holder = $titlegames[$cont - $i - 1][4];
                            }

                            $aux = 1;
                            $tempholder = $holder;
                            while ($holder == $tempholder && ($i - 1 - $aux) < $cont) {

                                if ($titlegames[$cont - $i - 1 - $aux][3] > $titlegames[$cont - $i - 1 - $aux][5]) {
                                    $tempholder = $titlegames[$cont - $i - 1 - $aux][2];
                                }
                                else {
                                    $tempholder = $titlegames[$cont - $i - 1 - $aux][4];
                                }
                                $aux++;

                                if ($holder == $tempholder) {
                                    $streak++;
                                }
                            }

                            ?>
                            <tr>
                                <td><?php echo $titlegames[$cont - $i - 1][0]?></td>
                                <td><?php echo $titlegames[$cont - $i - 1][4]." (".$teams[$titlegames[$cont - $i - 1][4]].")"?></td>
                                <td><?php echo $titlegames[$cont - $i - 1][5]?></td>
                                <td><?php echo $titlegames[$cont - $i - 1][2]." (".$teams[$titlegames[$cont - $i - 1][2]].")"?></td>
                                <td><?php echo $titlegames[$cont - $i - 1][3]?></td>
                                <td><?php echo "<img class='small-logo' src='img/logos/icons/".$teams[$holder].".png'>".$holder ?></td>
                                <td><?php echo $streak ?></td>
                            </tr>
                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
                <?php
                ?>
            </div>
        </div>
    </div>

    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <?php 
                    foreach ($json_b as $key => $row) { $lim++; if ($lim > 30) break;?>
                    <div class="col-lg-2 col-md-4 col-sm-2 col-xs-4" style="margin-bottom: 10px;">
                        <img class="img-responsive" src="img/logos/icons/<?php echo $json_b[$key]['id'] ?>.png" alt="">
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-6">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->

    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Rules</h2>
                    <ul>
                        <li>The first team to win an official match since the ABA foundation (1946) were declared the first ever Unofficial NBA Champions. 
                        This were the New York Knicks after a 68-66 win over the Toronto Huskies on November 1st, 1946.</li>
                        <li>The next official match involving the title holder is considered a title match, with the winner taking the title.</li>
                        <li>Official matches must me regular season or playoff games, no pre-season.</li>
                    </ul>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive img-round" src="img/other/joey.jpg" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->

    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">2014/15 Season Stats</h2>
                    <h4>Longest Streak: <?php echo $best_season_streak; ?> 
                    <?php for ($i = 0; $i < count($best_season_streak_team); $i++)
                            echo "<img class='small-logo' src='http://i.cdn.turner.com/nba/nba/.element/img/1.0/logos/teamlogos_80x64/".$best_season_streak_team[$i].".gif'>";
                    ?>
                    </h4>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">All Time Stats</h2>
                    <h4>Longest Streak: <?php echo $best_alltime_streak; ?> 
                    <?php for ($i = 0; $i < count($best_alltime_streak_team); $i++)
                            echo "<img class='small-logo' src='http://i.cdn.turner.com/nba/nba/.element/img/1.0/logos/teamlogos_80x64/".$best_alltime_streak_team[$i].".gif'>";
                    ?>
                    </h4>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

	<a  name="contact"></a>
    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Connect to Start Bootstrap:</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li>
                        <li>
                            <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Linkedin</span></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="gamelog.php">Game Log</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#services">Services</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; Your Company 2014. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
