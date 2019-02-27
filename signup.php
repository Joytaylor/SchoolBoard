<!--Samuel Anozie, Eric Errampalli. Quarter Project. Due 12/9/18. This is the backend of the signup form that makes all the magic happen.-->
<?php
include 'config.php'; //including config file
// Create database. Following code from w3schools.com

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
$stmt->bind_result($result);
$stmt->fetch();
$stmt->close();
$password = password_hash($password, PASSWORD_DEFAULT);

//checking if they are not already in the system, then putting them in the system
if ($result == null) {

	$stmt = $conn-> prepare( "INSERT INTO Users (username, name, lastname, password, status) VALUES (?, ?, ?, ?, ?)");
	$stmt -> bind_param("sssss", $username, $firstName, $lastName, $password, $status );
	$stmt->execute();
	$stmt->close();
		$sql = "INSERT INTO classes (subject_id, subject) VALUES (1, 'in2');";
		header('Location: /SchoolBoard/SchoolBoardLogInPage.html');


}
else {
    include("newform.html");
    echo "<script type='text/javascript'>alert('Sorry! That username is taken! :(. Please try Again');</script>";
}
}


?>
