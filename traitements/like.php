<?php
require_once "../pages/header.php";
$Publications = new Publication($_POST["buttonJaime"]);

if($Publications->isLiked($utilisateur->getId())){

    $Publications->removeJaime($_POST["buttonJaime"]);
    header("location:../pages/accueil.php#publication" . $_POST["buttonJaime"]);
}else{

    $Publications->jaime($_POST["buttonJaime"]);

    header("location:../pages/accueil.php#publication" . $_POST["buttonJaime"]);
}
