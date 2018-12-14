<?php
 include("cookiecheck.php");
 include("config.php");

 $question = $_POST['question'];
 $subject = $_POST['subject'];
 $sql = "INSERT INTO Question (votes, subject,user_id, question, dateOfAsk) VALUES ('0','$subject' ,". $_COOKIE['user_id'].", '$question', NOW())";
 if (mysqli_query($conn, $sql)){
   header( 'Location: /SchoolBoard/'.$subject.".php");
 }
 else{
    echo "Error". $sql . "<br> ". mysqli_error($conn);
 }
?>
