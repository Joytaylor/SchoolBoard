<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, 'SchoolBoard');
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


$sql = "CREATE TABLE Classes (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
subject VARCHAR(30) NOT NULL,
question VARCHAR(300) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
    //echo "Error creating table: " . $conn->error;
}


?>
