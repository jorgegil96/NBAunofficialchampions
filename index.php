<?php
include ("res/TeamNames.php");

$json_string = file_get_contents("res/season-holders.json");
$json_data = json_decode($json_string, true);

if(isset($_GET['season'])) {
	$season = $_GET['season'];
} else {
	$season = 2015;
}

if ($season == "all") {
	$all = true;
	$season = 1947;
}
else {
	$all = false;
}


if ($season < 1950) {
	$league = "BAA";
} else {
	$league = "NBA";
}


// Gets last holder of last season
foreach ($json_data as $key => $row) {
	if ($row['season'] == ($season - 1) && $row['type'] == "playoffs") {
	    $holder = $json_data[$key]['holder'];
	}
}


$cont = 0;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

    	<title>NBA Championship Belt</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	</head>
	<body>
		<div class="panel panel-default">
			<div class="panel-heading">
			<form role="form" action="">
			<div class="form-group">
			<label>Season Game Log:</label>
			<select class="form-control" id="season" name="" onchange="javascript:location.href = this.value;">
				<option value="?season=all" <?php if ($all) {?> selected <?php } ?> >All Seasons</option>
				<?php
				$num = 2015;
				while ($num > 1947) {
					?>
				<option value="?season=<?php echo $num; ?>" <?php if ($season == $num) {?> selected <?php } ?> ><?php echo ($num - 1)."/".$num; ?></option>
				<?php
					$num--;
				}
				?>
				<option value="?season=1947" <?php if ($season == "1947" && !$all) {?> selected <?php } ?> >1946/1947</option>
			</select>
			</div>
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
				
				$streak = 0;
				$largest_streak = 0;
				$mode = 0;

				while ($season < 2016) {
					if ($mode == 0) {
						$file = fopen("data/leagues_".$league."_".$season."_games_games.csv", "r");
						$mode = 1;
						$season_streak = 0;
					}else {
						$file = fopen("data/leagues_".$league."_".$season."_games_games_playoffs.csv", "r");
						$mode = 0;
					}
					while (($line =  fgetcsv($file)) !== FALSE) {
						if ($line > 2) {
							if ($line[2] == $holder OR $line[4] == $holder) {
								$cont++;
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
								} else {
									$streak = 1;
									$season_streak = 1;
								}
								
								

								?>
								<tr>
									<th><?php echo $cont;?></th>
									<td><?php echo $line[0]?></td>
									<td><?php echo "<img class='small-logo' src='img/logos/mini/".$teams[$line[4]].".gif'> ".$line[4]; ?></td>
									<td><?php echo $line[5]?></td>
									<td><?php echo "<img class='small-logo' src='img/logos/mini/".$teams[$line[2]].".gif'> ".$line[2]; ?></td>
									<td><?php echo $line[3]?></td>
									<td><?php echo "<img class='small-logo' src='img/logos/mini/".$teams[$holder].".gif'> ".$holder?></td>
									<td><?php echo $streak?></td>
								</tr>
								<?php

							}
						}
					}

					/*
					echo "<br>".$holder."...".$season."...".$mode;
					if ($mode == 0) {
						$aux = "playoffs";
					}
					else {
						$aux = "regular";
					}

					foreach ($json_data as $key => $row) {
	                    if ($row['season'] == $season && $row['type'] == $aux) {
	                        $json_data[$key]['holder'] = $holder;
	                    }
	                }
	                */
					
					if ($mode == 0) {
						if (!$all) {
							break;
						}
						$season++;
					}
					if ($season == 1948) {
						$streak = 0;
						$holder = "Washington Capitols";
					}
					if ($season > 1949) {
						$league = "NBA";
					}
					
					fclose($file);
				}
				?>
				</tbody>
			</table>
		</div>
	</body>
</html>
<?php
/*
$new_json_string = json_encode($json_data);
file_put_contents("res/season-holders.json", $new_json_string);
*/
?>