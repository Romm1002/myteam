<?php
require_once "../modeles/Modele.php";

$Taches = new Taches();
$Projets = new Projets();

// print_r($_POST["idUtilisateur"]);

if($_POST["idUtilisateur"] == $utilisateur->getId()){
    $Taches->terminer_tache(1, $_POST["idTache"]);
    header("location:../pages/projets.php?id=" . $_GET["id"] . "&error=0");
}else{
    header("location:../pages/projets.php?id=" . $_GET["id"] . "&error=1");
}
?>