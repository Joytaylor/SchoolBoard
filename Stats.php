<!--Joy Taylor Aug 9th  Base for creating sites updated -->
<!DOCTYPE html>
<html id = "classPage">
<head>
<!--Samuel Anozie, July 29, 2017. This is the Stats page. -->
<title>Stats - SchoolBoard</title>
<meta charset = "UTF-8"/>
<link rel = "stylesheet" type = "text/css" href = "styles.css"/>
<link rel = "icon" href = "favicon.jpg" type = "image/jpg"/>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>

html {
	height: 100%;
}
body {
	text-align: center;
	height: 100%;
	background-image: url('backpic.jpg');
	background-size: cover;
	overflow: auto;
	margin: auto;
}
</style>
</head>
<body>
<div class = "img" id = "Stats">
	<a href = "index.html">
		<img src = "Picture1.png" id = "Stats"/>
	</a>
</div>
<div class = "classname" id = "Stats">
	<div class = "heading">
		<h1>Stats</h1>
	</div>
	<div class = "statement">
		<p>Q u e s t i o n s</p>
	</div>
</div>
<div class = "outerContainer">
<div class = "innerContainter">
	<script>
		function vote(div) {
			var num = parseInt(document.getElementById("num_" + div).innerHTML);
			document.getElementById("num_" + div).innerHTML = num + 1;
			num += 1;
			/*for (var i = (div-1); i > 0; i--) {
				var compare = parseInt(document.getElementById("num_" + i).innerHTML);
				if (num > compare) {
					var higher = document.getElementById("div_" + div);
					var lower = document.getElementById("div_" + i);
					document.getElementById("div_" + div).innerHTML = lower.innerHTML;
					document.getElementById("div_" + i).innerHTML = higher.innerHTML;
				}
			}*/
		}
	</script>
	<?php
			include("config.php");
			mysqli_select_db($conn, 'SchoolBoard');
			$sql= "SELECT * FROM `question` WHERE subject ='stats' ORDER BY `dateOfAsk` DESC";
			$result = $conn->query($sql) or die($conn->error);

			if (true) {
				echo "<div class = 'time'><h3>This Week</h3><div class = 'strip'></div></div>";
				$num = 1;
				while($row = $result->fetch_assoc()) {
					echo "<span id = 'div_$num'><div id = 'question'><div id = 'text'><h6> ". $row['question']."</h6></div><div class = 'vote'  onclick = 'vote($num)'><p class = 'vote'>VOTE</p><span class = 'num' id = 'num_$num'>0</span></div></div></span>";
					$num++;
				}
			//Each question will be a div, so when data is pulled from the database, will it only pull the text  for the question, then put it in the div, or will it pull the whole div? in any case, I will put the div below with the content needed, including space for the voting section and the counter for the votes. I will assume that the text will be pulled, so I will leave an empty <p> tag for pastes.
			}
	 ?>
		<div class = "ask"><a href = "StatsQuestionPage.html"><h3>ASK A QUESTION</h3></a></div>
		<h4><a class = "backLink" href = "SchoolBoardAccountPage.html">GO BACK TO ACCOUNT</a></h4>
   </div>
</div>
</body>
</html>
