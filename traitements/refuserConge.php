<?php
require_once "../modeles/Modele.php";

if($utilisateur->getGrade() != 6){
    header("location:../pages/accueil.php?page=conges");
}else{
    $Conges = new Conges();
    $Conges->refuserConge(1, $_POST["raison_refus"], $_POST["idConge"]);
    header("location:../pages/accueil.php?page=conges");
}
?>