<?php
$servername = "localhost";
$username = "schoolAdmin";
$password = "CsIs4souperKoolkids";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
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
user_id int(6) UNSIGNED PRIMARY KEY,
username VARCHAR(10) Not Null,
name VARCHAR(10) Not Null,
lastname VARCHAR(10) Not Null,
password VARCHAR(100) Not Null,
status VARCHAR(30) Not Null
)";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
    //echo "Error creating table: " . $conn->error;
}
?>
