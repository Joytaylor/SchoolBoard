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
	
	$stmt = $conn->prepare("SELECT `username` FROM Users WHERE `username` = ?");
	$stmt -> bind_param("s", $username);
	$stmt->execute();
	$stmt-> store_result();
	$stmt->bind_result($result);
	$stmt->fetch();
	$stmt->close();


	$row = mysqli_fetch_assoc($result);
	$fetchedPassword = $row["password"];
	if (password_verify($password, $fetchedPassword)) {
		$cookie_value = $username;
		$sql =  "SELECT `user_id` FROM Users WHERE `username` = '$username'";
		$result = $conn->query($sql) or die($conn->error);
		$row = $result->fetch_assoc();
		setcookie("user", $cookie_value, time() + (3600), "/");
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
			echo "<script type='text/javascript'>alert(There's something wrong with your account. Please contact your SchoolBoard administrator.);</script>";
		}
	}
	else {
		include("SchoolBoardLogInPage.html");
		echo "<script type='text/javascript'>alert('Sorry! That username/password combination is incorrect, please try again');</script>";
	}
}
?>
