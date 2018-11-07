<?php
include("cookiecheck.php");
 include("config.php");

 $question = $_GET['question'];
 $subject = $_GET['subject'];
 $teacher = $_GET["teacher"];
 echo $teacher;
 $sql = "UPDATE Question SET teacherResponce = "."' $_GET[teacher]' "." WHERE subject= "."'$_GET[subject]'"." AND question = "."'$_GET[question]'";
echo $sql;
 if (mysqli_query($conn, $sql)){
   header( 'Location: /SchoolBoard/'.$subject.".php");
 }
 else{
   echo "Error". $sql . "<br> ". mysqli_error($conn);
 }
?>
