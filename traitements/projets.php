<?php
if(empty($_SESSION["grade"]) || $_SESSION["grade"] < 1){
    header("location:index.php");
}

if(!empty($_POST["nomProjet"]) && !empty($_POST["membresProjet"]) && !empty($_POST["descriptionProjet"]) && !empty($_POST["dateDebut"]) && !empty($_POST["dateFin"])){
    extract($_POST);
    newProjet($nomProjet, $membresProjet, $descriptionProjet, $dateDebut, $dateFin);
}