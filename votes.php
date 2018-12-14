<?php  include("config.php");
$question = $_POST['question'];

$sql = "SELECT `studentHasVoted` FROM `studentVotes` WHERE `questionid` = $question AND `studentid` = "."'". $_COOKIE['user_id']."'";
$result = $conn->query($sql) or die($conn->error);
if (mysqli_fetch_assoc($result) == NULL) {
    $sql = "SELECT `votes` FROM `question` WHERE `questionid` = $question";
    $result = $conn->query($sql) or die($conn->error);
    $row = mysqli_fetch_assoc($result);
    $result  = $row['votes'] + 1;
    $sql= "UPDATE `question` SET `votes` = $result WHERE `questionid` = $question";
    $result = $conn->query($sql) or die($conn->error);

    $sql = "INSERT INTO `studentVotes` (studentid, questionid, studentHasVoted) VALUES (". $_COOKIE['user_id'].", $question, TRUE )";
    mysqli_query($conn, $sql);
    echo $sql;
    header( 'Location: /SchoolBoard/stats.php');
}
else {
    header( 'Location: /SchoolBoard/stats.php');
    echo"heeloo";
}
?>
