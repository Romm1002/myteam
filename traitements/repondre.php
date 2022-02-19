<?php
require_once "../pages/header.php";
$reponse = new Reponses();

if(!empty($_POST["reponse"])){

    $Publication->repondrePublication($_POST["id"], $_POST["reponse"], $utilisateu->getId());
    header("location:../pages/accueil.php#publication" . $_POST["id"]);
}
?>