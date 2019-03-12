<?php
include("cookiecheck.php");
 include("config.php");

 $question = $_POST['question'];
 $subject = $_POST['subject'];
 $teacher = $_POST["teacher"];
 $question = addslashes($question);
 $stmt = $conn -> prepare("UPDATE Question SET teacherResponce = ? WHERE subject= ? AND question = ?");
 $stmt -> bind_param("sss", $teacher, $subject, $question);
 if ($stmt->execute()){
   header( 'Location: '.$subject.".php");
 }
 else{
   echo "Error". $sql . "<br> ". mysqli_error($conn);
 }
?>
