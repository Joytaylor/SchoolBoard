<?php
if(!isset($_COOKIE["user"])) {
	header("Location: SchoolBoardLogInPage.html");
} else {
	if(!isset($_COOKIE["user_id"])) {
		header("Location: SchoolBoardLogInPage.html");
	}
	else {
		header("Location: SchoolBoardAccountPage.php");
	}
}
?>
