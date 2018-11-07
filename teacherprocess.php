<?php
include("cookiecheck.php");
 include("config.php");

 $question = $_POST['question'];
 $subject = $_POST['subject'];
 $teacher = $_POST['teacherResponce'];
 echo $teacher;
 $sql = "UPDATE Question SET teacherResponce = "." $_POST[teacherResponce] "." WHERE subject= "."$_POST[subject]"." AND question = "."$_POST[question]";
echo $sql;
 if (mysqli_query($conn, $sql)){
   header( 'Location: /SchoolBoard/'.$subject.".php");
 }
 else{
   echo "Error". $sql . "<br> ". mysqli_error($conn);
 }
?>
