<?php
$string = file_get_contents("res/teamstreaks.json");
$json_b = json_decode($string, true);

$champ = "Golden State Warriors";
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


?>

<!doctype html>
<html>
	<head>
		<title>Pie Chart</title>
		<script src="js/Chart.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	</head>
	<body>
		<div id="canvas-holder">
			<canvas id="chart-area" width="300" height="300"/>
		</div>


	<script>

		var allTimeWins;
		var allTimeLosses;

		$.getJSON('res/teamstreaks.json', function(data) {
			//console.log(data);
			$.each(data, function(key, value) {
				console.log(value);
				if (value["id"] == "GSW") {
					allTimeWins = data[key]["wins_alltime"];
					allTimeLosses = data[key]["losses_alltime"];

					runPie();
				}
			})
		});

		function runPie() {

			var pieData = [
					{
						value: allTimeWins,
						color:"#00E500",
						highlight: "#7FF27F",
						label: "Wins"
					},
					{
						value: allTimeLosses,
						color:"#F7464A",
						highlight: "#FF5A5E",
						label: "Losses"
					}

			];

			var ctx = document.getElementById("chart-area").getContext("2d");
			window.myPie = new Chart(ctx).Pie(pieData);
		}



	</script>
	</body>
</html>