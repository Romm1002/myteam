<?php
if(empty($_POST["classement"])){
    $filtre = "asc";
}else{
    $filtre = $_POST["classement"];
    echo "trse";
}

// Redirection si le grade est inférieur à Employé
if(empty($_SESSION["grade"]) || $_SESSION["grade"] < 5){
    header("location:visiteurs.php");
}

extract($_POST);
setlocale(LC_TIME, "fr_FR.utf-8", "fra");
$date = strftime("%A-%d-%B %H:%M");


if(!empty($_POST["nouvellePublication"])){
    extract($_POST);
    newPublication($nouvellePublication, $date, $_SESSION["idUtilisateur"], $typePost);
    header("location:../pages/accueil.php");
}