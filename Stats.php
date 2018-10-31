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
	<?php
			include("config.php");
			mysqli_select_db($conn, 'SchoolBoard');
			$sql= "SELECT * FROM `question` WHERE subject ='stats' ORDER BY `dateOfAsk` DESC";
			$result = $conn->query($sql) or die($conn->error);

			if (true) {
				echo " <h3>This Week</h3><br><div class = 'strip'></div>";
				while($row = $result->fetch_assoc()) {
					echo "<div class = 'question'><h6> ". $row['question']."</h6></div><br/>";
				}
			//Each question will be a div, so when data is pulled from the database, will it only pull the text  for the question, then put it in the div, or will it pull the whole div? in any case, I will put the div below with the content needed, including space for the voting section and the counter for the votes. I will assume that the text will be pulled, so I will leave an empty <p> tag for pastes.
			}
	 ?>
		<div class = "ask"><a href = "StatsQuestionPage.html"><h3>Ask a question</h3></a></div>
		<h4><a class = "backLink" href = "SchoolBoardAccountPage.html">Go back to account</a></h4>
   </div>
</div>
</body>
</html>
