<?php
include ("res/TeamNames.php");

$season = 2015;
$file = fopen("data/leagues_NBA_".$season."_games_games.csv", "r");

$holder = "San Antonio Spurs";
$cont = 0;
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
                        <a href="#about">About</a>
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
                    <h2 class="section-heading">Current Belt Holder:<br>Golden State Warriors</h2>
                    <br>
                    <h4>Current Streak: <b>8</b></h4>
                    <h4>Longest Streak this season: <b>9</b></h4>
                    <h4>Longest Streak all time: <b>25</b></h4>
                    <br>
                    <h4>Title games this season: 20</h4>
                    <h4>Wins: 15</h4>
                    <h4>Losses: 5</h4>
                    <h4>Win %: 75%</h4>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/logos/gsw.png" alt="">
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
                                <th>#</th>
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
                        while (($line =  fgetcsv($file)) !== FALSE) {
                            if ($line > 2) {
                                if ($line[2] == $holder OR $line[4] == $holder) {
                                    $titlegames[] = $line;
                                    $cont++;
                                }
                            }
                        }
                        fclose($file);
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
                                <th><?php echo $cont - $i + 1;?></th>
                                <td><?php echo $titlegames[$cont - $i - 1][0]?></td>
                                <td><?php echo $titlegames[$cont - $i - 1][4]." (".$teams[$titlegames[$cont - $i - 1][4]].")"?></td>
                                <td><?php echo $titlegames[$cont - $i - 1][5]?></td>
                                <td><?php echo $titlegames[$cont - $i - 1][2]." (".$teams[$titlegames[$cont - $i - 1][2]].")"?></td>
                                <td><?php echo $titlegames[$cont - $i - 1][3]?></td>
                                <td><?php echo "<img class='small-logo' src='http://i.cdn.turner.com/nba/nba/.element/img/1.0/logos/teamlogos_80x64/".$teams[$holder].".gif'>".$holder ?></td>
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
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">All Time Stats</h2>
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
                            <a href="#about">About</a>
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
