<!--Samuel Anozie, Eric Errampalli. Quarter Project. Due 12/9/18. This is the backend of the signup form that makes all the magic happen.-->
<?php
include 'config.php'; //including config file
// Create database. Following code from w3schools.com

mysqli_select_db($conn, 'schoolboard');

// sql to create table
$sql = "CREATE DATABASE SchoolBoard";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
    //echo "Error creating database: " . $conn->error;
}

mysqli_select_db($conn, 'SchoolBoard');
$sql = "CREATE TABLE Classes (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
subject_id VARCHAR(30) NOT NULL,
subject VARCHAR(30),
user_id int(6)
)";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
    //echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE Question (
questionid INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
votes int(3) Not Null,
dateOfAsk DATETIME Not Null,
subject VARCHAR(30) NOT NULL,
user_id int(6)Not Null,
question VARCHAR(1000),
teacherResponce VARCHAR(1000),
studentHasVoted INT(1)
)";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
  //  echo "Error creating table: " . $conn->error;
}
$sql = "CREATE TABLE Question (
questionid INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
votes int(3) Not Null,
dateOfAsk DATETIME Not Null,
subject VARCHAR(30) NOT NULL,
user_id int(6)Not Null,
question VARCHAR(1000),
teacherResponce VARCHAR(1000)
)";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
  //  echo "Error creating table: " . $conn->error;
}
$sql = "CREATE TABLE studentVotes(
  voteId int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  studentid int(6) Not Null,
  questionid int(8) Not Null,
  studentHasVoted boolean Not Null
)";
if ($conn->query($sql)) {
    //echo "Database created successfully";
} else {
    //echo "Error creating table: " . $conn->error;
}
$sql = "CREATE TABLE Users (
user_id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(10) Not Null,
name VARCHAR(10) Not Null,
password VARCHAR(30) Not Null,
status VARCHAR(30) Not Null
)";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
    //echo "Error creating table: " . $conn->error;
}

//insert data from form responses into the table while checkng for duplicates. if its all good, it's ready to go to the registered page.
$sql = "SELECT username FROM Users WHERE username = " . "'$_POST[username]'" . ";";
$result = mysqli_query($conn, $sql);
$password = md5($_POST['password']);
if (mysqli_num_rows($result) != 1) {
	$sql = "INSERT INTO Users (user_id, username, name, lastname, password, status) VALUES ('$_POST[user_id]', '$_POST[username]', '$_POST[firstName]', '$_POST[lastName]',  '$password', '$_POST[status]');";
    mysqli_query($conn, $sql);
    header('Location: /SchoolBoard/SchoolBoardAccountPage.php');
}
else {
    include("newform.html");
    echo "<script type='text/javascript'>alert('Sorry! That username is taken! :(. Please try Again');</script>";
}
?>
