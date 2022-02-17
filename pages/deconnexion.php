<?php
session_start();
session_destroy();
header("location:index.php");

if (isset($_COOKIE['memory'])) {
    unset($_COOKIE['memory']); 
    setcookie('memory', null, -1, '/'); 
    return true;
} else {
    return false;
}
?>