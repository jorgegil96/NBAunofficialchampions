<?php
include ("res/TeamNames.php");

$season = $_GET['season'];
if ($season < 1950) {
	$file = fopen("data/leagues_BAA_".$season."_games_games.csv", "r");
} else {
	$file = fopen("data/leagues_NBA_".$season."_games_games.csv", "r");
}

$holder = "San Antonio Spurs";
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
					</tr>
				</thead>
				<tbody>
				<?php
				while (($line =  fgetcsv($file)) !== FALSE) {
					if ($line > 2) {
						if ($line[2] == $holder OR $line[4] == $holder) {
							$cont++;
							if ($line[3] > $line[5]) {
								$holder = $line[2];
							}
							else {
								$holder = $line[4];
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
							</tr>
							<?php
						}
					}
				}
				?>
				</tbody>
			</table>
		</div>
		<?php
		fclose($file);
		?>
	</body>
</html>