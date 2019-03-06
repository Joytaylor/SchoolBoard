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
	/*
	$stmt= $conn->prepare("SELECT `password` FROM users WHERE `username` = ?");
	$stmt -> bind_param("s", $username);
	$stmt->execute();
	$stmt->bind_result($result);
	$stmt->fetch();
	$stmt->close();
	*/
	$sql = "SELECT `password` FROM Users WHERE `username` = '$username'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$fetchedPassword = $row["password"];
	if (password_verify($password, $fetchedPassword)) {
		$cookie_value = $username;
		setcookie("user", $cookie_value, time() + (3600), "/");
		$sql =  "SELECT `user_id` FROM Users WHERE `username` = '".$_COOKIE["user"] ."'";
	
		$result = $conn->query($sql) or die($conn->error);

		$row = $result->fetch_assoc();

		setcookie("user_id",$row['user_id'],time() + (3600), "/");

		$sql =  "SELECT `status` FROM Users WHERE `username` = '".$username."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if ($row["status"] == "teacher") {
			//header('Location: SchoolBoardTeacherAccount.php');
			header('Location: SchoolBoardAccountPage.php');
		}
		else if ($row["status"] == "student") {
			header('Location: SchoolBoardAccountPage.php');
		}
		else {
			include("SchoolBoardLogInPage.html");
			echo "<script type='text/javascript'>alert('Sorry! We cant find you account. Please try Again');</script>";
		}
	}
	else {
		include("SchoolBoardLogInPage.html");
		echo "<script type='text/javascript'>alert('Sorry! We cant find you account and all ur code is failing, Please try Again');</script>";
	}
}
?>
