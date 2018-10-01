<!--Joy Taylor Aug 9th  Base for creating sites updated -->
<!DOCTYPE html>
<html id = "classPage">
<head>
<!--Samuel Anozie, July 29, 2017. This is the Stats page. -->
<title>Stats - SchoolBoard</title>
<meta charset = "UTF-8"/>
<link rel = "stylesheet" type = "text/css" href = "styles.css"/>
<link rel = "icon" href = "favicon.jpg" type = "image/jpg"/>
<!--Fonts-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Syncopate" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative" rel="stylesheet">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
@import url('https://fonts.googleapis.com/css?family=Pontano+Sans');
html {
	height: 100%;
}
body {
	text-align: center;
	height: 100%;
	background-image: url('backpic.jpg');
	background-size: cover;
	overflow: auto;
}
</style>
</head>
<body>
<div class = "img" id = "Stats">
	<a href = "index.html">
		<img src = "Picture1.png" id = "Stats"/>
	</a>
</div>
<div class = "body" id = "Stats">
<div class = "classname" id = "Stats">
	<div class = "heading">
		<h1>Stats</h1>
	</div>
	<div class = "statement">
		<p> Teachers - Trainor</p>
	</div>
</div>
<div class = "outerContainer">
	<?php
			include("config.php");
			mysqli_select_db($conn, 'classes');
			$sql= "SELECT * FROM `classes` WHERE subject ='stats'";
			$result = mysqli_query($conn, $sql);

			if (true) {
				echo " <h3> PAST ANSWERS </h3>";
				while($row = $result->fetch_assoc()) {
					echo "<h6> ". $row['question']."</h6><br/>";
				}
			}
	 ?>
	<h3> Your most Recent Question Was:</h3>
	<h3 id ='here'></h3>
	<div class = "innerContainer">
	<script>

		window.onload = function () {
    var url = document.location.href,
        params = url.split('?')[1].split('&'),
        data = {}, tmp;
    for (var i = 0, l = params.length; i < l; i++) {
         tmp = params[i].split('=');
         data[tmp[0]] = tmp[1];
    }
    document.getElementById('here').innerHTML = data.question;
}
		</script>

		<h2>No more questions asked for this class yet, check again soon!</h2>
		<div class = "ask"><a href = "StatsQuestionPage.html"><h3>Ask a question</h3></a></div>
		<h4><a class = "backLink" href = "SchoolBoardAccountPage.html">Go back to account</a></h4>
    </div>
</div>
</div>
</body>
</html>
