<?php
include("cookiecheck.php");
 include("config.php");

 $question = $_POST['question'];
 $subject = $_POST['subject'];
 $sql = " UPDATE Question SET teacherResponce = $_POST['teacherResponce']
  WHERE subject = $_POST['subject'] AND question = $_POST['Question']" ;

 if (mysqli_query($conn, $sql)){
   header( 'Location: /SchoolBoard/'.$subject.".php");
 }
 else{
   echo "Error". $sql . "<br> ". mysqli_error($conn);
 }
?>
