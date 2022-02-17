<?php
require_once "../modeles/Modele.php";


if($utilisateur->getBoolFirstConnexion() == 1){
    header("location:../pages/first_connexion.php");
}
?>