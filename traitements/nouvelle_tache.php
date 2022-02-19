<?php
require_once "../modeles/Modele.php";

$tache = new Taches();

if(!empty($_POST["libelle"])){
    $tache->nouvelle_tache($_POST["libelle"], 0, $_POST["idProjet"]);
    header("location:../pages/projets.php?id=" . $_POST["idProjet"]);
}
?>