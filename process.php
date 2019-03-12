<?php
 include("cookiecheck.php");
 include("config.php");

 $question = $_POST['question'];
 $subject = $_POST['subject'];
 $question= addslashes($question);
 $stmt= $conn->prepare( "INSERT INTO Question (votes, subject,user_id, question, dateOfAsk) VALUES ('0', ? ,". $_COOKIE['user_id'].", ?, NOW())");
 $stmt-> bind_param("ss", $subject, $question);

 if ($stmt->execute()){
   header( 'Location: '.$subject.".php");
 }
 else{
    echo "Error". $sql . "<br> ". mysqli_error($conn);
 }
?>
