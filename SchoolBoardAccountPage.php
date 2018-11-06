<!DOCTYPE html>
<html id = "account">
<head>
<!--Samuel Anozie, June 2, 2017. This is the account page. We still need to figure out how to actually create accounts. Also an idea: have a Pick your Classes page so that users can edit the classes, figure out a way to ade/subtract divs,  prob with javascript-->
<meta charset = "UTF-8"/>
<link rel = "stylesheet" href = "styles.css"/>
<link rel = "icon" href = "favicon.jpg" type = "image/jpg"/>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!--Fonts-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Syncopate" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway:200" rel="stylesheet">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>SchoolBoard</title>
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
@keyframes list {
	from {opacity: 0.0;}
	to {opacity: 1.0;}
}
@-webkit-keyframes list {
	from {opacity: 0.0;}
	to {opacity: 1.0;}
}
 @keyframes image {
	0% {width: 75%; height: 21%; margin-top: 20%;}
	100% {width: 25%; height:7%; margin-top: 0%;}
}
@-webkit-keyframes image {
	0% {width: 75%; height: 21%; margin-top: 20%;}
	100% {width: 25%; height:7%; margin-top: 0%;}
}
</style>
</head>
<body id = "account">
<div class = "img">
	<a href = "index.html">
		<img src = "Picture2.png"/>
	</a>
</div>
<div class = "body">
	<div class = "greeting">
		<h3>Welcome <?php
		include("config.php");
		mysqli_select_db($conn, 'SchoolBoard');
		$sql = "SELECT name FROM users WHERE username = '". $_COOKIE['user']."'";
		$result = $conn->query($sql) or die($conn ->error);
		$row = $result->fetch_assoc();
		echo $row['name'];

		?>,</h3>
	</div>
<div class = "profile">
	<div class = "heading">
		<h1>Profile</h1>
	</div>
	<div class = "statement">
		<p>This is where you can check the questions asked in your classes, talk to teachers,  and see if your questions have been answered.</p>
	</div>
</div>
<div id = "classes" class = "tabcontent">
	<div class = "classLabel">
		<h2>Classes</h2>
	</div>
	<div id = "myCarousel" class = "carousel slide" data-ride = "carousel">
	  <!-- Indicators -->
	  <ol class = "carousel-indicators">
		<?php

		 $sql = "SELECT COUNT(subject) FROM classes";
		 $rs =$conn->query($sql) or die($conn->error);
		 $result = $rs->fetch_assoc();
		 for($i = 0; $i<current($result); $i++){
		   if ($i==1){

		  echo "<li data-target = '#myCarousel' data-slide-to=".$i." class='active'></li>";
		 }
		  else {
		     echo "<li data-target = '#myCarousel' data-slide-to=".$i."></li>";
		  }
		 }
		 ?>
	  </ol>

	  <!-- Wrapper for slides -->
	  <div class = "carousel-inner">
		<?php
		$sql= "SELECT * FROM classes WHERE user_id = '0'";
		 $result = $conn->query($sql) or die($conn->error);
			 while($row = $result->fetch_assoc()) {
				 echo "<div class = 'envelope'><div id = 'box' class = 'NetandWall'><div class = 'name'><h4>". $row['subject']."</h4></div><div class = 'launch'><h5><a href = ".$row['subject'].".php>Launch</a></h5></div></div></div>";
			 }
	?>
	<!--
	    <div class = "item ">
			<div class = "envelope">
	      	<div id = "box" class = "AdChemII">
				<div class = "name">
					<h4>Advanced Chemistry II</h4>
				</div>
				<div class = "launch">
					<h5><a href = "AdvancedChemistryII.html">Launch</a></h5>
				</div>
			</div>
			</div>
	    </div>

	    <div class = "item">
			<div class = "envelope">
	      	<div id = "box" class = "Biophysics">
				<div class = "name">
					<h4>Biophysics</h4>
				</div>
				<div class = "launch">
					<h5><a href = "Biophysics.html">Launch</a></h5>
				</div>
			</div>
			</div>
	    </div>

		<div class = "item">
			<div class = "envelope">
	      	<div id = "box" class = "20th">
				<div class = "name">
					<h4>20th Century</h4>
				</div>
				<div class = "launch">
					<h5><a href = "20thCentury.html">Launch</a></h5>
				</div>
			</div>
			</div>
	    </div>

		<div class = "item">
			<div class = "envelope">
	      	<div id = "box" class = "ModernWorldFiction">
				<div class = "name">
					<h4>Modern World Fiction</h4>
				</div>
				<div class = "launch">
					<h5><a href = "MWF.html">Launch</a></h5>
				</div>
			</div>
			</div>
	    </div>

		<div class = "item">
			<div class = "envelope">
	      	<div id = "box" class = "MandarinII">
				<div class = "name">
					<h4>Mandarin II</h4>
				</div>
				<div class = "launch">
					<h5><a href = "MandarinII.html">Launch</a></h5>
				</div>
			</div>
			</div>
	    </div>

		<div class = "item">
			<div class = "envelope">
	      	<div id = "box" class = "NetandWall">
				<div class = "name">
					<h4>Net and Wall Games</h4>
				</div>
				<div class = "launch">
					<h5><a href = "NetAndWall">Launch</a></h5>
				</div>
				</div>
			</div>
	    </div>
-->

	  <!-- Left and right controls -->
	  <a class = "left carousel-control" href = "#myCarousel" data-slide = "prev">
	    <span class = "glyphicon glyphicon-chevron-left"></span>
	    <span class = "sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#myCarousel" data-slide="next">
	    <span class = "glyphicon glyphicon-chevron-right"></span>
	    <span class = "sr-only">Next</span>
	  </a>
	</div>
	</div>
	<!-- <div id = "box" class = "BC1">
		<h4>BC I</h4>
	</div>
	<div id = "box" class = "AdChemII">
		<h4>Advanced Chemistry II</h4>
	</div>
	<div id = "box" class = "Biophysics">
		<h4>Biophysics</h4>
	</div>
	<div id = "box" class = "20th">
		<h4>20th Century</h4>
	</div>
	<div id = "box" class = "ModernWorldFiction">
		<h4>Modern World Fiction</h4>
	</div>
	<div id = "box" class = "MandarinII">
		<h4>Mandarin II</h4>
	</div>
	<div id = "box" class = "NetandWall">
		<h4>Net and Wall Games</h4>
	</div> -->
</div>
<div class = "quote">
	<img class = "openQuote" src = "OpenQuote.png"/>
	<div class = "envelope2">
		<div class = "quote1">
			<p>We get wise by asking questions, and even if these are not answered, we get wise, for a well-packed question carries its answer on its back as a snail carries its shell.</p>
			<p class = "description">- James Stephens, novelist</p>
		</div>
	</div>
	<img class = "closeQuote" src = "ClosingQuote.png"/>
</div>
<div id = "questions" class = "tabcontent">
	<div class = "classLabel">
		<h2>Questions</h2>
	</div>
	<div id = "myCarousel" class = "carousel slide" data-ride = "carousel">
	  <!-- Indicators -->
	  <ol class = "carousel-indicators">
	    <li data-target = "#myCarousel" data-slide-to="0" class="active"></li>
	    <li data-target = "#myCarousel" data-slide-to="1"></li>
	    <li data-target = "#myCarousel" data-slide-to="2"></li>
		<li data-target = "#myCarousel" data-slide-to="3"></li>
		<li data-target = "#myCarousel" data-slide-to="4"></li>
		<li data-target = "#myCarousel" data-slide-to="5"></li>
		<li data-target = "#myCarousel" data-slide-to="6"></li>
	  </ol>

	  <!-- Wrapper for slides -->
	  <div class = "carousel-inner">
	    <div class = "item active">
			<div class = "envelope">
	      	<div id = "box">
				<div class = "name">
					<h4>No Questions</h4>
				</div>
				<div class = "launch">
					<h5>Check</h5>
				</div>
			</div>
			</div>
	    </div>

	    <div class = "item">
			<div class = "envelope">
	      	<div id = "box">
				<div class = "name">
					<h4>No Questions</h4>
				</div>
				<div class = "launch">
					<h5>Check</h5>
				</div>
			</div>
			</div>
	    </div>

	    <div class = "item">
			<div class = "envelope">
	      	<div id = "box">
				<div class = "name">
					<h4>No Questions</h4>
				</div>
				<div class = "launch">
					<h5>Check</h5>
				</div>
			</div>
			</div>
	    </div>

		<div class = "item">
			<div class = "envelope">
	      	<div id = "box">
				<div class = "name">
					<h4>No Questions</h4>
				</div>
				<div class = "launch">
					<h5>Check</h5>
				</div>
			</div>
			</div>
	    </div>

		<div class = "item">
			<div class = "envelope">
	      	<div id = "box">
				<div class = "name">
					<h4>No Questions</h4>
				</div>
				<div class = "launch">
					<h5>Check</h5>
				</div>
			</div>
			</div>
	    </div>

		<div class = "item">
			<div class = "envelope">
	      	<div id = "box">
				<div class = "name">
					<h4>No Questions</h4>
				</div>
				<div class = "launch">
					<h5>Check</h5>
				</div>
			</div>
			</div>
	    </div>

		<div class = "item">
			<div class = "envelope">
	      	<div id = "box">
				<div class = "name">
					<h4>No Questions</h4>
				</div>
				<div class = "launch">
					<h5>Check</h5>
				</div>
				</div>
			</div>
	    </div>

	  <!-- Left and right controls -->
	  <a class = "left carousel-control" href = "#myCarousel" data-slide = "prev">
	    <span class = "glyphicon glyphicon-chevron-left"></span>
	    <span class = "sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#myCarousel" data-slide="next">
	    <span class = "glyphicon glyphicon-chevron-right"></span>
	    <span class = "sr-only">Next</span>
	  </a>
</div>
</div>
</div>
</div>
</body>
</html>
