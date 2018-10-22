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
	<a href = "index.html">
		<img src = "Picture1.png"/>
	</a>
	<div class = "strip"></div>
</div>
<div class = "container">
	<div class = "header">
		<h1>Welcome, Teacher X</h1><!--Add description beneath, eventually-->
	</div>
	<div class = "description">
		<p>This is where you can view information on the classes in your department.</p>
	</div>
	<div class = "class">
		<div class = "name">
			<h2>SI Chemistry</h2>
		</div>
		<div class = "sections">
			<div class = "sub">
				<div id = "left_container_SCI105-7" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Kopff</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "1-2 (A,C)" onclick = "widthChange('_SCI105-7')"></input>
					</div>
				</div>
				<div id = "right_container_SCI105-7" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
			<span>
				<div class = "sub">
					<div id = "left_container_SCI105-8" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Kopff</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "3-4 (A,C)" onclick = "widthChange('_SCI105-8')"></input>
					</div>
				</div>
				<div id = "right_container_SCI105-8" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
				</div>
			</span>
			<div class = "sub">
				<div id = "left_container_SCI105-9" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Kopff</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "3-4 (B,D)" onclick = "widthChange('_SCI105-9')"></input>
					</div>
				</div>
				<div id = "right_container_SCI105-9" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
			<div class = "sub">
				<div id = "left_container_SCI105-10" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Golab</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "5-6 (B,D)" onclick = "widthChange('_SCI105-10')"></input>
					</div>
				</div>
				<div id = "right_container_SCI105-10" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
			<div class = "sub">
				<div id = "left_container_SCI105-11" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Golab</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "7-8 (A,C)" onclick = "widthChange('_SCI105-11')"></input>
					</div>
				</div>
				<div id = "right_container_SCI105-11" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
			<div class = "sub">
				<div id = "left_container_SCI105-12" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Golab</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "7-8 (B,D)" onclick = "widthChange('_SCI105-12')"></input>
					</div>
				</div>
				<div id = "right_container_SCI105-12" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class = "class">
		<div class = "name">
			<h2>AD Chemistry</h2>
		</div>
		<div class = "sections">
			<div class = "sub">
				<div id = "left_container_SCI202-1" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Devol</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "1-2 (A,C)" onclick = "widthChange('_SCI202-1')"></input>
					</div>
				</div>
				<div id = "right_container_SCI202-1" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
			<div class = "sub">
				<div id = "left_container_SCI202-2" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Devol</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "3-4 (A,C)" onclick = "widthChange('_SCI202-2')"></input>
					</div>
				</div>
				<div id = "right_container_SCI202-2" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
			<div class = "sub">
				<div id = "left_container_SCI202-3" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Clancy</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "3-4 (B,D)" onclick = "widthChange('_SCI202-3')"></input>
					</div>
				</div>
				<div id = "right_container_SCI202-3" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
			<div class = "sub">
				<div id = "left_container_SCI202-4" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Kopff</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "5-6 (B,D)" onclick = "widthChange('_SCI202-4')"></input>
					</div>
				</div>
				<div id = "right_container_SCI202-4" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
			<div class = "sub">
				<div id = "left_container_SCI202-5" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Clancy</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "7-8 (A,C)" onclick = "widthChange('_SCI202-5')"></input>
					</div>
				</div>
				<div id = "right_container_SCI202-5" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class = "class">
		<div class = "name">
			<h2>ORG Chemistry</h2>
		</div>
		<div class = "sections">
			<div class = "sub">
				<div id = "left_container_SCI222-1" class = "left_container">
					<div class = "teacher">
						<h3>Dr. White</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "1-2 (B,D)" onclick = "widthChange('_SCI222-1')"></input>
					</div>
				</div>
				<div id = "right_container_SCI222-1" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
			<div class = "sub">
				<div id = "left_container_SCI222-2" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Thurmond</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "3-4 (A,C)" onclick = "widthChange('_SCI222-2')"></input>
					</div>
				</div>
				<div id = "right_container_SCI222-2" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
			<div class = "sub">
				<div id = "left_container_SCI222-3" class = "left_container">
					<div class = "teacher">
						<h3>Dr. Thurmond</h3>
					</div>
					<div class = "time">
						<input type = "button" class = "section" value = "7-8 (A,C)" onclick = "widthChange('_SCI222-3')"></input>
					</div>
				</div>
				<div id = "right_container_SCI222-3" class = "right_container">
					<div class = "new">
						<h4>GO</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
