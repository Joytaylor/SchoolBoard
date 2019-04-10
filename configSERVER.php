<?php
$hostname = "mysql.theschoolboard.co";
$username = "samanozie";
$password = 'CsIs4souperKoolkids';
$database = 'schoolboard';

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
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
question VARCHAR(1000)
)";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
	//echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE teacherResponses (
responseid INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
questionid INT(10) UNSIGNED,
FOREIGN KEY (questionid) REFERENCES Question(questionid),
votes int(3) Not Null,
dateOfResponse DATETIME Not Null,
user_id int(6) Not Null,
question VARCHAR(1000),
teacherResponse VARCHAR(1000)
)";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
	//echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE studentVotes(
  voteId int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  studentid int(6) Not Null,
  questionid int(8) Not Null,
  studentHasVoted boolean Not Null
)";
if ($conn->query($sql)) {
    //echo "studentvotes created successfully";
} else {
	//echo "Error creating table: " . $conn->error;
}
$sql = "CREATE TABLE Users (
user_id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(10) Not Null,
name VARCHAR(10) Not Null,
lastname VARCHAR(10) Not Null,
password VARCHAR(100) Not Null,
status VARCHAR(30) Not Null
)";
if ($conn->query($sql)) {
    //echo "table users created successfully";
} else {
    //echo "Error creating table: " . $conn->error;
}

//for product testing in IN2

$sql = "INSERT INTO Classes VALUES (1, 1, 'IN2', 1)";
mysqli_query($conn, $sql);
?>
