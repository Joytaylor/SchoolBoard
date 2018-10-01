<?php
 include("config.php");

 $question = $_POST['question'];
 $subject = $_POST['subject'];
 $sql = "INSERT INTO Classes ( subject, question ) VALUES ('$subject' , '$question')";
 if (mysqli_query($conn, $sql)){
   header( 'Location: /SchoolBoard/'.$subject.".php");
 }
 else{
    echo "Error". $sql . "<br> ". mysqli_error($conn);
 }
?>
