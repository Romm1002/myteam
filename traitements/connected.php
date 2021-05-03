<?php
if(empty($_SESSION)){
    header("location:../pages/index.php");
}else{
    header("location:../pages/accueil.php");
}
?>