<?php
$Publication = new Publication();
if(empty($_POST["classement"])){
    $filtre = "asc";
}else{
    $filtre = $_POST["classement"];
    echo "trse";
}

extract($_POST);
setlocale(LC_TIME, "fr_FR.utf-8", "fra");
$date = strftime("%A %d %B à %H:%M");

if(!empty($_POST["nouvellePublication"])){
    extract($_POST);
    $Publication->newPublication($nouvellePublication, $date, $_SESSION["idUtilisateur"], $typePost);
    header("location:../pages/accueil.php");
}