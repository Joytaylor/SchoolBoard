<?php
include("cookiecheck.php");
include("config.php");

$question = $_POST['question'];
$subject = $_POST['subject'];
$response = $_POST["response"];
$questionid = $_POST["questionid"];
$question = addslashes($question);

$stmt = $conn -> prepare("INSERT INTO teacherResponses (questionid, dateOfResponse, question, teacherResponse) VALUES (?, NOW(), ?, ?)");
$stmt -> bind_param("sss", $questionid, $question, $response);
if ($stmt->execute()){
header( 'Location: '.$subject.".php");
}
else{
echo "Error". $sql . "<br> ". mysqli_error($conn);
}
?>
