<?php
require_once "../modeles/Modele.php";

if($utilisateur->getGrade() != 6){
    header("location:../pages/accueil.php?page=conges");
}else{
    $Conges = new Conges();
    $Conges->accepterConge(2, $_GET["id"]);
    header("location:../pages/accueil.php?page=conges");
}
?>