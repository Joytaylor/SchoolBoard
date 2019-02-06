<!--Samuel Anozie, Eric Errampalli. Quarter Project. Due 12/9/18. This is the backend of the signup form that makes all the magic happen.-->
<?php
include 'config.php'; //including config file
// Create database. Following code from w3schools.com

mysqli_select_db($conn, 'schoolboard');

//insert data from form responses into the table while checkng for duplicates. if its all good, it's ready to go to the registered page.
$sql = "SELECT username FROM Users WHERE username = " . "'$_POST[username]'" . ";";
$result = mysqli_query($conn, $sql);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//checking if they are not already in the system, then putting them in the system
if (mysqli_num_rows($result) != 1) {
	$sql = "INSERT INTO Users (user_id, username, name, lastname, password, status) VALUES ('$_POST[user_id]', '$_POST[username]', '$_POST[firstName]', '$_POST[lastName]',  '$password', '$_POST[status]');";
    if (mysqli_query($conn, $sql)) {
		$sql = "INSERT INTO classes (subject_id, subject, user_id) VALUES (1, 'in2', '$_POST[user_id]');";
		mysqli_query($conn, $sql);
		header('Location: /SchoolBoard/SchoolBoardLogInPage.html');
	}
	else {
		include("newform.html");
		echo "<script type='text/javascript'>alert('Error entering form into database');</script>";
	}
}
else {
    include("newform.html");
    echo "<script type='text/javascript'>alert('Sorry! That username is taken! :(. Please try Again');</script>";
}
?>
