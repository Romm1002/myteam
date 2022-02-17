<?php
require_once "../modeles/Modele.php";

$Projet = new Projets();

if(!empty($_POST["libelle"])){
    $Projet->nouvelle_tache($_POST["libelle"], 0, $_POST["idProjet"]);
    header("location:../pages/projets.php?id=" . $_POST["idProjet"]);
}
?>