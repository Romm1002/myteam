<?php
require_once "../modeles/Modele.php";

$Taches = new Taches();
$Projets = new Projets();

$tacheParent = $Taches->getTacheParent($_GET["idt"]);

if($_POST["idUtilisateur"] == $utilisateur->getId() && ($tacheParent["terminee"] == 1 || $tacheParent["terminee"] == NULL)){
    $Taches->terminer_tache(1, $_POST["idTache"]);
    header("location:../pages/projets.php?id=" . $_GET["id"] . "&error=0");
}else{
    header("location:../pages/projets.php?id=" . $_GET["id"] . "&error=1");
}
?>