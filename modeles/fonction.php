<?php
session_start();
function getBdd(){
    return new PDO('mysql:host=localhost;dbname=myteam','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
?>