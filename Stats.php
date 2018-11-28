<!--Joy Taylor Aug 9th  Base for creating sites updated -->
<?php

?>
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
	<a href = "index.php">
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
	include("cookiecheck.php");
	mysqli_select_db($conn, 'SchoolBoard');
	?>
	<script>
		function vote(div) {
			var num = parseInt(document.getElementById("num_" + div).innerHTML);
			document.getElementById("num_" + div).innerHTML = num + 1;
			console.log("num_" + div)
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

			$teach = false;

			$sql =  "SELECT status FROM users WHERE username = '".$_COOKIE["user"] ."'";
			$result = $conn->query($sql) or die($conn->error);
			$row = $result->fetch_assoc();
			if( $row["status"] == "teacher"){
				$teach= true;
			}
			$sql= "SELECT * FROM `question` WHERE subject ='stats' ORDER BY `dateOfAsk` DESC";
			$result = $conn->query($sql) or die($conn->error);

			if (true) {
				echo "<div class = 'time'><h3>This Week</h3><div class = 'strip'></div></div>";
				static $num = 1;
				while($row = $result->fetch_assoc()) {

										echo "<span id = 'div_$num'>
										<div id = 'question'>
										<div id = 'text'><h6> ". $row['question']."</h6>
										</div><form method='POST' action='votes.php'>
										<input type= 'hidden' name='question' value='". $row['questionid'].">
										<input type = 'submit' name = 'submit' value = 'submit' id='submit'>
									 </form>";
										if ($row['teacherResponce'] != NULL){
											echo "<div id = 'answer'><div id = 'text'><h6> ". $row['teacherResponce']."</h6></div></div></span>";
										}
										echo "</div><br/>";
										if($teach == true){
											echo "<form action='teacherprocess.php' method = 'POST'>
											<input type = 'hidden' name='question' value='". $row["question"]."'>
											<input type='hidden' name='subject' value='stats'>

											<input type='text' name='teacher'>
											<input type = 'submit' name = 'submit' value = 'submit' id='submit'>
											</form>
											";


						echo "<span id = 'div_$num'><div id = 'question'><button class = 'answerButton' id = 'answerButton_$num' onclick = visible('answerForm_$num')>ANSWER</button><div id = 'text'><h6> ".$row['question']."</h6></div><div class = 'vote'  onclick = 'vote($num)'><p class = 'vote'>VOTE</p><span class = 'num' id = 'num_$num'>0</span></div></div></span>";
						if ($row['teacherResponce'] != NULL) {
						echo "<div id = 'answer'><div id = 'text'><h6> ". $row['teacherResponce'] . "</h6></div></div>";
					}
					echo "<br/>";
					if($teach == true){
						echo "<button id = 'answerButton' onclick = 'visible('answerButton')'>ANSWER</button>";
						echo "<form id = 'answerForm' action='teacherprocess.php' method = 'POST'>
						<input type = 'hidden' name='question' value='".$row['question']."'>
						<input type='hidden' name='subject' value='stats'>
						<input type='text' name='teacher' placeholder = 'Type your answer here'><br>
						<input type = 'submit' name = 'submit' value = 'submit' id='submit'>
						<button id = 'closeButton' onclick = visible('answerForm_$num')>Close Form</button>
						</form>
						</div>
						";
						echo "<script>
						function visible(form) {
							var div = document.getElementById(form).style;
							if (form == 'answerButton') {
								div.display = 'block';
								document.getElementById('answerForm').style.display = 'none';
							}
							else {
								document.getElementById('answerForm').style.display = 'block';
								div.display = 'none';
							}
						}
											</script>";
										}
										$num++;

				}
				echo "<script>
function visible(form) {
	var div = document.getElementById(form);
	if (div.className != 'answerButton') {
		document.getElementById(form).style.display = 'block';
	}
	else {
		document.getElementById(form).style.display = 'none';
	}
}
</script>";
}}
	 ?>

		<div class = "ask"><a href = "StatsQuestionPage.html"><h3>ASK A QUESTION</h3></a></div>
		<h4><a class = "backLink" href = "SchoolBoardAccountPage.php">GO BACK TO ACCOUNT</a></h4>
   </div>
</div>
</body>
</html>
