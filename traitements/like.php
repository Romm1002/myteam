<?php
require_once "../pages/header.php";
$Publications = new Publication();

if($Publications->recuperationJaimes($_SESSION["idUtilisateur"], $_POST["buttonJaime"]) == 1){

    $Publications->removeJaime($_POST["buttonJaime"]);
    header("location:../pages/accueil.php#publication" . $_POST["buttonJaime"]);
}else{

    $Publications->jaime($_POST["buttonJaime"]);

    header("location:../pages/accueil.php#publication" . $_POST["buttonJaime"]);
}
