<?php
include 'config.php';
mysqli_select_db($conn, 'testing');
// remove all cookies
if (isset($_COOKIE['user'])) {
    unset($_COOKIE['user']);
    unset($_COOKIE['user_id']);
    setcookie('user', null, -1, '/');
    setcookie('user_id', null, -1, '/');
} else {
    echo "no, u reallyyyy thought ur code work";
}

header('Location: index.html');
?>
