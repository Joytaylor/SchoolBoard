<!--Joy Taylor Aug 9th  Base for creating sites updated -->
<?php

?>
<!DOCTYPE html>
<html id = "classPage">
<head>
<!--Samuel Anozie, July 29, 2017. This is the IN2 page. -->
<title>IN2 - SchoolBoard</title>
<meta charset = "UTF-8"/>
<link rel = "stylesheet" type = "text/css" href = "styles.css"/>
<link rel = "icon" href = "favicon.jpg" type = "image/jpg"/>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>

html {
	height: 100%;
}
body {
	text-align: center;
	height: 100%;
	background-image: url('backpic.jpg');
	background-size: cover;
	overflow: auto;
	margin: auto;
}
</style>
</head>
<body>
<div class = "img" id = "IN2">
	<a href = "index.php">
		<img src = "Picture1.png" id = "IN2"/>
	</a>
</div>
<div class = "classname" id = "IN2">
	<div class = "heading">
		<h1> IN2 </h1>
	</div>
	<div class = "statement">
		<p>Q u e s t i o n s</p>
	</div>
</div>
<div class = "outerContainer">
<div class = "innerContainter">
	<?php
    include("config.php");
	include("cookiecheck.php");
	mysqli_select_db($conn, 'SchoolBoard');
	?>
	<script>
		function vote(div) {
			var num = parseInt(document.getElementById("num_" + div).innerHTML);
			document.getElementById("num_" + div).innerHTML = num + 1;
			console.log("num_" + div)
			num += 1;

			/*for (var i = (div-1); i > 0; i--) {
				var compare = parseInt(document.getElementById("num_" + i).innerHTML);
				if (num > compare) {
					var higher = document.getElementById("div_" + div);
					var lower = document.getElementById("div_" + i);
					document.getElementById("div_" + div).innerHTML = lower.innerHTML;
					document.getElementById("div_" + i).innerHTML = higher.innerHTML;
				}
			}*/
		}
        function disable(input) {
			var vote = document.getElementById(input);
            vote.disabled = true;
			vote.style.opacity = 0.2;
		}
        function visible(form, button) {
        var div = document.getElementById(form).style;
        var clicked = document.getElementById(button);
        if (button == 'answerButton') {
            div.display = 'block';
        }
        else {
            div.display = 'none';
        }
    }
        function removeElement(elementId) {
    // Removes an element from the document
    var element = document.getElementById(elementId);
    element.parentNode.removeChild(element);
}

	</script>
	<!--in the event that a question has to be deleted from the database, all of the question Id's will be thrown off. Proceed with caution-->
	<?php
        $teach = false;
        $sql =  "SELECT status FROM users WHERE username = '".$_COOKIE["user"] ."'";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();
        if( $row["status"] == "teacher"){
            $teach= true;
        }
            echo "<div class = 'time'><h3>This Week</h3><div class = 'strip'></div></div>";
            static $num = 1;
            $sql= "SELECT * FROM question WHERE subject = 'IN2'";
            $result = mysqli_query($conn, $sql);
            $numrows = mysqli_num_rows($result);
            for ($i = 1; $i <= $numrows; $i++) {
                $sql= "SELECT * FROM question WHERE subject = 'IN2' AND questionid = $i ORDER BY dateOfAsk DESC";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                echo "<span id = 'div_$num'>
                <div id = 'question'>";
                    //make sure that teachers are not able to vote on questions, or I guess they could?
                    if($teach == true){
                        echo "
                        <button class = 'answerButton' id = 'answerButton' onclick = visible('answerForm_$num','answerButton')>ANSWER</button>
                        ";
                    }
                       echo "<div id = 'text'>
                            <h6> ". $row['question']. "</h6>
                        </div>
                        <div class = 'vote'>
                            <div class = 'votecontainer'>
                            <form id = 'voteform' method='POST' action='votes.php'>
                                <span class = 'num' id = 'num_$num'>" . $row['votes'] . "</span>
                                <input type= 'hidden' name='question' value=". $row['questionid']."><br>
                                <input class = 'vote' id = 'vote_$num' type = 'submit' name = 'submit' value = 'VOTE' >
                            </form>
                            </div>
                        </div>
                    </div>";
                    if ($teach == true) {
                        echo "
                    <form class = 'answerForm' id = 'answerForm_$num' action='teacherprocess.php' method = 'POST'>
                        <input type = 'hidden' name='question' value='".$row['question']."'>
                        <input type='hidden' name='subject' value='IN2'>
                        <textarea name='teacher' placeholder = 'Type your answer here'></textarea><br>
                        <input type = 'submit' name = 'submit' value = 'SUBMIT' id='submit'><br>
                        <button id = 'closeButton' onclick = visible('answerForm_$num', 'closeButton')>CLOSE FORM</button>
                    </form>";
                    }
                    echo "</span>";
                    if ($row['teacherResponce'] != NULL){
                        echo "<div id = 'answer'><div id = 'text'><h6> ". $row['teacherResponce']."</h6></div></div>";
                    }
                    echo "<script>";
                        $sql = "SELECT `studentHasVoted` FROM `studentVotes` WHERE `questionid` = $i AND `studentid` = ".
												"'".$_COOKIE['user_id']."'";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['studentHasVoted'] == 1) {
                                echo "disable('vote_$num');";
                            }
                        }
                    echo "</script>";
                    $num++;
                    }
}
	 ?>
		<div id = "ask" class = "ask"><a href = "IN2QuestionPage.html"><h3>ASK A QUESTION</h3></a></div>
		<h4><a class = "backLink" href = "SchoolBoardAccountPage.php">GO BACK TO ACCOUNT</a></h4>
		<?php
            if ($teach == true) {
                echo "<script>removeElement('ask')</script>";
            }
    ?>
   </div>
</div>
</body>
</html>
