<?php
include ("res/TeamNames.php");

$season = $_GET['season'];
if ($season < 1950) {
	//$file = fopen("data/leagues_BAA_".$season."_games_games.csv", "r");
} else {
	//$file = fopen("data/leagues_NBA_".$season."_games_games.csv", "r");
}

$holder = "New York Knicks";
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
				<option value="?season=1947" <?php if ($season == "1947") {?> selected <?php } ?> >1946/47</option>
				<option value="?season=1948" <?php if ($season == "1948") {?> selected <?php } ?> >1947/48</option>
				<option value="?season=1949" <?php if ($season == "1949") {?> selected <?php } ?> >1948/49</option>
				<option value="?season=1950" <?php if ($season == "1950") {?> selected <?php } ?> >1949/50</option>
				<option value="?season=1951" <?php if ($season == "1951") {?> selected <?php } ?> >1950/51</option>
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
				
				$league = "BAA";
				$season = 1947;
				$streak = 0;
				$largest_streak = 0;
				$mode = 0;

				while ($season < 2016) {
					if ($mode == 0) {
						$file = fopen("data/leagues_".$league."_".$season."_games_games.csv", "r");
						$mode = 1;
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
								}
								else {
									$holder = $line[4];
								}
								if ($temp == $holder) {
									$streak++;
								} else {
									$streak = 1;;
								}
								?>
								<tr>
									<th><?php echo $cont;?></th>
									<td><?php echo $line[0]?></td>
									<td><?php echo $line[4]." (".$teams[$line[4]].")"?></td>
									<td><?php echo $line[5]?></td>
									<td><?php echo $line[2]." (".$teams[$line[2]].")"?></td>
									<td><?php echo $line[3]?></td>
									<td><?php echo $holder?></td>
									<td><?php echo $streak?></td>
								</tr>
								<?php
								if ($streak > $largest_streak) {
									$largest_streak = $streak;
									$largest_holder = $holder;
								}
							}
						}
					}
					
					if ($mode == 0) {
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
					?>
					
					<tr>
						<td colspan = 8><?php echo $largest_streak; ?> <= largest streak</td>					
					</tr>
					<tr>
						<td colspan = 8><?php echo $largest_holder; ?> <= largest holder</td>
					</tr>
					<tr>
						<td colspan = 8><?php echo $season; if ($mode == 1) {echo " Playoffs ";} ?> Game Log</td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
		</div>
		<?php
		?>
	</body>
</html>