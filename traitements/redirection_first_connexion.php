<?php
require_once "../modeles/Modele.php";

if(empty($utilisateur)){
    header("location:../pages/index.php");
}
if($utilisateur->getBoolFirstConnexion() == 1){
    header("location:../pages/first_connexion.php");
}
?>