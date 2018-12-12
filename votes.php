<?php  include("config.php");
$question = $_POST['question'];

$sql = "SELECT `studentHasVoted` FROM `question` WHERE `questionid` = $question";
$result = $conn->query($sql) or die($conn->error);
if (mysqli_num_rows != 1) {
    $sql = "SELECT `votes` FROM `question` WHERE `questionid` = $question";
    $result = $conn->query($sql) or die($conn->error);
    $row = mysqli_fetch_assoc($result);
    $result  = $row['votes'] + 1;
    $sql= "UPDATE `question` SET `votes` = $result WHERE `questionid` = $question";
    $result = $conn->query($sql) or die($conn->error);
    header( 'Location: /SchoolBoard/stats.php');
    $sql = "UPDATE `question` SET `studentHasVoted` = 1 WHERE `questionid` = $question";
    mysqli_query($conn, $sql);
}
else {
    header( 'Location: /SchoolBoard/stats.php');
}
?>
