<?php
session_start();
session_destroy();
if(isset($_COOKIE['memory'])){
    setcookie("memory", "", time() - 3600, "/", "myteam.ipssi-sio.fr", true, true); 
}
header("location:index.php");
?>