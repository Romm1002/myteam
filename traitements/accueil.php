<?php
require_once "../modeles/Modele.php";

$Projets = new Projets();

$membres = $utilisateur->getUtilisateurs();

$publication = new Publication();

$publications = $publication->getPublications();

// $planification = new Plannifications;

if ($utilisateur->getGrade() == 10){
    $listProjet = $utilisateur->getProjet();
}else{
    $listProjet = $utilisateur->getParticipations();
}
if(empty($_POST["classement"])){
    $filtre = "asc";
}else{
    $filtre = $_POST["classement"];
    echo "trse";
}

setlocale(LC_TIME, "fr_FR.utf-8", "fra");
$date = new DateTime();


if(!empty($_POST["nouvellePublication"])){
    $publication->newPublication($_POST["nouvellePublication"], $date->format('Y-m-d H:i:s'), $utilisateur->getId(), $_POST["typePost"]);
    header("location:../pages/accueil.php");
}