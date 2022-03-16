<?php
require_once "../modeles/Modele.php";

if($utilisateur->getGrade() != 6){
    header("location:../pages/accueil.php?page=conges");
}else{
    header("location:../pages/raison_refus.php?id=" . $_GET["id"]);
}
?>