<?php
require_once "../modeles/Modele.php";
$Projets = new Projets();

if(empty($_SESSION["grade"]) || $_SESSION["grade"] < 1){
    header("location:index.php");
}

if(isset($_POST["terminer"])){
    $Projets->terminer_tache(1, $_POST["idTache"]);
}