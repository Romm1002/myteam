<?php
require_once "../pages/header.php";
$reponse = new Reponses();


if(!empty($_POST["reponse"])){

    $reponse->newReponse($_POST["id"], $_POST["reponse"], $utilisateur->getId());
    header("location:../pages/accueil.php#publication" . $_POST["id"]);
}
?>