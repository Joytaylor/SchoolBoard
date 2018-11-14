<!DOCTYPE html>
<html id = "teacherPage">
<head>
<!--link-->
<link rel = "stylesheet" href = "styles.css"/>

<!--Fonts-->
<link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Syncopate" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway:200" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:100" rel="stylesheet">
<!--This thing for size of fonts-->
<meta name="viewport" content="initial-scale=1">
<title>SchoolBoard - Classes</title>
<style>
html {
	height: 100%;
}
body {
	height: 100%;
	margin: auto;
	position: relative;
	overflow: hidden;
}
@keyframes image {
	0% {width: 75%; height: 21%; margin-top: 20%;}
	100% {width: 25%; height:7%; margin-top: 0%;}`
}
@-webkit-keyframes image {
	0% {width: 75%; height: 21%; margin-top: 20%;}
	100% {width: 25%; height:7%; margin-top: 0%;}
}
@keyframes list {
	from {opacity: 0.0;}
	to {opacity: 1.0;}
}
@-webkit-keyframes list {
	from {opacity: 0.0;}
	to {opacity: 1.0;}
}
</style>
</head>
<body>
<script>
var w = 100
var v = 0
function widthChange(name)
{
	for (w = 100; w >= 65; w--)
	{
		document.getElementById("left_container"+name).style.width = w.toString() + '%';
		v = 90 - w;
		document.getElementById("right_container"+name).style.width = v.toString() + '%';
	}
}
</script>
<div class = "img">
	<a href = "index.php">
		<img src = "Picture1.png"/>
	</a>
	<div class = "strip"></div>
</div>
<div class = "container">
	<div class = "header">
		<h1>Welcome <?php
		include("cookiecheck.php");
		include("config.php");
		mysqli_select_db($conn, 'SchoolBoard');
		$sql = "SELECT name FROM users WHERE username = '". $_COOKIE['user']."'";
		$result = $conn->query($sql) or die($conn ->error);
		$row = $result->fetch_assoc();
		echo $row['name'];

		?>,</h1><!--Add description beneath, eventually-->
	</div>
	<div class = "description">
		<p>This is where you can view information on the classes in your department.</p>
	</div>
	<div class = "class">
		<div class = "name">
			<h2>STATS</h2>
		</div>
		<div class = "sections">
			<div class = "sub">
				<div id = "left_container_SCI105-7" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Anozie</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "1-2 (A,C)" onclick = "widthChange('_SCI105-7')">
					</div>
				</div>
				<div id = "right_container_SCI105-7" class = "right_container">
					<div class = "new">
						<a href = "Stats.php"><h4>GO</h4></a>
					</div>
				</div>
			</div>
				<div class = "sub">
					<div id = "left_container_SCI105-8" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Taylor</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "3-4 (A,C)" onclick = "widthChange('_SCI105-8')">
					</div>
				</div>
				<div id = "right_container_SCI105-8" class = "right_container">
					<div class = "new">
						<a href = "Stats.php"><h4>GO</h4></a>
					</div>
				</div>
				</div>
			<div class = "sub">
				<div id = "left_container_SCI105-9" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Anozie</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "3-4 (B,D)" onclick = "widthChange('_SCI105-9')">
					</div>
				</div>
				<div id = "right_container_SCI105-9" class = "right_container">
					<div class = "new">
						<a href = "Stats.php"><h4>GO</h4></a>
					</div>
				</div>
			</div>
				</div>
			</div>
		</div>
</body>
</html>
