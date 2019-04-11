<?php
include 'config.php';

mysqli_select_db($conn, 'schoolboard');

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
$username = test_input($_POST['username']);
$password = test_input($_POST['password']);
$firstName = test_input($_POST['firstName']);
$lastName = test_input($_POST['lastName']);
$status = test_input($_POST['status']);
	//insert data from form responses into the table while checkng for duplicates. if its all good, it's ready to go to the registered page.
$stmt = $conn->prepare("SELECT `username` FROM Users WHERE `username` = ?");
$stmt -> bind_param("s", $username);
$stmt->execute();
$stmt-> store_result();
$stmt->bind_result($result);
$stmt->fetch();


$password = password_hash($password, PASSWORD_DEFAULT);

//checking if they are not already in the system, then putting them in the system
if (mysqli_num_rows($result) == 1) {
	$stmt->close();
	include("newform.html");
    echo "<script type='text/javascript'>alert('Sorry! That username is taken! :(. Please try Again');</script>";
}
else {
  $stmt->close();
	$stmt = $conn-> prepare("INSERT INTO Users (username, name, lastname, password, status) VALUES (?, ?, ?, ?, ?)");
	$stmt -> bind_param("sssss", $username, $firstName, $lastName, $password, $status );
	$stmt->execute();
	$stmt-> store_result();
	$stmt->bind_result($result);
	$stmt->fetch();


//	$sql = "INSERT INTO Users (username, name, lastname, password, status) VALUES ('$username', '$firstName', '$lastName', '$password', '$status')";
	if (result != null ){
		$stmt->close();
		include("SchoolBoardLogInPage.html");
	}
	else {
		$stmt->close();
		echo "<script type='text/javascript'>alert('Something went wrong');</script>";
		echo $conn->error;
	}
}
}
?>
