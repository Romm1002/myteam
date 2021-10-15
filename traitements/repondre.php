<?php
require_once "header.php";
$Publication = new Publication();

if(!empty($_POST["reponse"])){
    extract($_POST);

    $Publication->repondrePublication($_POST["id"], $reponse, $_SESSION["idUtilisateur"]);
    header("location:../pages/accueil.php#publication" . $_POST["id"]);
}
?>