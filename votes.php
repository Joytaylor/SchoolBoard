<?php  include("config.php");
$question = $POST['question'];

$sql = "SELECT `votes` FROM `question` WHERE `questionid` = $question";
$result = $conn->query($sql) or die($conn->error);

$row = mysqli_fetch_assoc($result);
$result  = $row['votes'] + 1;
$sql= "UPDATE `question` SET `votes` = $result WHERE `questionid` = $question";
$result = $conn->query($sql) or die($conn->error);
header( 'Location: /SchoolBoard/stats.php');
?>
