<?php
include("config.php");
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	$sql = "SELECT `password` FROM users WHERE `username` = '". $username ."'";
	$result = $conn->query($sql);
	$result = $result->fetch_assoc();
	if(password_verify($password, current($result))) {
	//	$user = "user";
		$cookie_value = $username;
		setcookie($user, $cookie_value, time() + (3600), "/");
		$sql =  "SELECT user_id FROM users WHERE username = '".$_COOKIE["user"] ."'";
		$result = $conn->query($sql) or die($conn->error);
		$row = $result->fetch_assoc();

		setcookie("user_id",$row['user_id'],time() + (3600), "/");

		$sql =  "SELECT status FROM users WHERE username = '".$_COOKIE["user"] ."'";
		$result = $conn->query($sql) or die($conn->error);
		$row = $result->fetch_assoc();
		if ($row["status"] == "teacher") {
			//header('Location: /SchoolBoard/SchoolBoardTeacherAccount.php');
			header('Location: /SchoolBoard/SchoolBoardAccountPage.php');
		}
		else if ($row["status"] == "student") {
			header('Location: /SchoolBoard/SchoolBoardAccountPage.php');
		}
		else {
			include("SchoolBoardloginpage.html");
			echo "<script type='text/javascript'>alert('Sorry! We cant find you account. Please try Again');</script>";
		}
	}
	else {
		include("SchoolBoardloginpage.html");
		echo "<script type='text/javascript'>alert('Sorry! We cant find you account and all ur code is failing :(. Please try Again');</script>";
	}
}
?>
