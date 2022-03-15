<?php
require_once "../modeles/Modele.php";

$tache = new Taches();

if(!empty($_POST["libelle"]) && !empty($_POST["salarie"]) && !empty($_POST["date_fin"])){
    $tache->nouvelle_tache($_POST["libelle"], 0, $_POST["idProjet"], $_POST["salarie"], $_POST["parent"], $_POST["date_fin"]);
    header("location:../pages/projets.php?id=" . $_POST["idProjet"]);
}
?>