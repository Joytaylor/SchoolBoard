<?php
include("config.php");
?>
<!DOCTYPE html>
<html id = "index">
<!--Samuel Anozie, March 1, 2017. This is my div excersise for CSI, but it is also doubling as my SoCent project and my CSI quarter project. This website is not completely done, as there are multiple pages still left to add, but it meets the requirements for the CSI project as it is.-->
<!--URL = "students.imsa.edu/~sanozie"-->
<head>
<meta charset = "UTF-8">
<link rel = "stylesheet" href = "styles.css"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"/>
<title>SchoolBoard</title>
<link rel = "icon" href = "favicon.jpg" type = "image/jpg"/>
<style type = "text/css">
html {
	height: 100%;
}
body {
	background-size: cover;
	text-align: center;
	height: 100%;
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
<!--Link came from Google Fonts-->
<link href = "https://fonts.googleapis.com/css?family=Cinzel+Decorative" rel="stylesheet">
<script src ="script.js"></script>
<div class = "body">
<img id = "pic" class = "right_image" src = "flower.png" alt = "flower"/>
<img class = "center" src = "Picture1.png" alt = "header"/>
<img id = "pic" class = "left_image" src = "flower.png" alt = "flower"/>
	<div class = "headbar">
<!--I have yet to finish the Schools and About Us page, but I will work on this over Spring Break-->
		<ul>
			<li>Schools</li>
			<li>About Us</li>
			<li><a (href = "SchoolBoardSamplePage.html")>Sample</a></li>
			<li><a (href = "SchoolBoardContactPage.html")>Contact</a></li>
			<li><a (href = "SchoolBoardRequestPage.html")>Request</a></li>
		</ul>
	</div>
<!--I put overflow: auto on this div because there's just too much content! However, it worked out pretty well in the end. I originally wanted to put the pictures and descriptions side by side but then I realized that putting them in a line looked better.  I might change this just to see how it looks, and I had some ideas for animations concerning the pictures in the future.-->
	<div id="jpg">
	<div class = "heading"><h1>The Future of Inquiry</h1></div>
	<div class = "statement">
		<p>Our mission is simple: create a learning environment in which instinct and impulsiveness is never limited.</p>
	</div>
	<div class = "login">
		<a href = "SchoolBoardloginpage.html" style = "color: black">Log In</a>
	</div>
	<div class = "teacher">
		<a href = "newform.html" class = "signup" style = "color: white">Sign Up Here</a>
	</div>
</div>
</div>
</body>
</html>
