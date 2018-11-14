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
	text-align: center;
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
			include("cookiecheck.php");
			mysqli_select_db($conn, 'SchoolBoard');
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
echo "
<div id = 'question'>";
	if ($teach == true) {
	echo "<button class = 'answerButton' id = 'answerButton_$num' onclick = visible('formContainer_$num')>ANSWER</button>";
	}
	echo "<div id = 'text'><h6> ".$row['question']."</h6></div>
	<div class = 'vote'  onclick = 'vote($num)'>
		<div class = 'top'><span class = 'num' id = 'num_$num'>0</span></div>
		<div class = 'bottom'><p class = 'vote'>VOTE</p></div>
	</div>
</div>";
if ($row['teacherResponce'] != NULL) {
echo "<div id = 'answer'><div id = 'atext'><h6>". $row['teacherResponce'] ."</h6></div></div>";
}
echo "<br/>";
if($teach == true){
echo "<div class = 'formContainer' id = 'formContainer_$num'>
<form class = 'answerForm' action='teacherprocess.php' method = 'POST'>
	<input type = 'hidden' name='question' value='".$row['question']."'>
	<input type='hidden' name='subject' value='stats'>
	<textarea type='text' name='teacher' placeholder = 'Type your answer here (Max 1000 Characters)'></textarea><br>
	<input type = 'submit' name = 'submit' value = 'SUBMIT' id='submit'>
</form>
<button id = 'closeButton' onclick = invisible('formContainer_$num')>Close Form</button>
</div>";
}
$num++;
}
echo "<script>
function visible(form) {
	document.getElementById(form).style.display = 'block';
}
function invisible(form) {
	document.getElementById(form).style.display = 'none';
}
</script>";
if ($teach == false) {
	echo "<div class = 'ask'><a href = 'StatsQuestionPage.html'><h3>ASK A QUESTION</h3></a></div>";
	echo "<h4><a class = 'backLink' href = 'SchoolBoardAccountPage.php'>GO BACK TO ACCOUNT</a></h4>";
}
if ($teach == true) {
	echo "<h4><a class = 'backLink' href = 'SchoolBoardTeacherAccount.php'>GO BACK TO ACCOUNT</a></h4>";
}
}
?>
		
   </div>
</div>
</body>
</html>
