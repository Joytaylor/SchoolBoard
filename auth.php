<?php

echo $password;
include("config.php");
$username= $_POST["first_name"];
$password=$_POST["password"];
$sql = "SELECT * FROM users WHERE `username` = '". $username ."' and `password` = '". $password."'";
echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating table: " . $conn->error;
    echo $sql;
}
?>
