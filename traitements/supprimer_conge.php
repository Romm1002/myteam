<?php
require_once "../modeles/Modele.php";

$conges = new Conges();

if($_POST["btn-supprimer_conge"] == 1){
    $conges->supprimerConge($_POST["conge"]);
    header("location:../pages/accueil.php?page=conges");
}
?>