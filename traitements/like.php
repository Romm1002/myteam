<?php
require_once "header.php";
$Publications = new Publications();

if($Publications->recuperationJaimes($_SESSION["idUtilisateur"], $_POST["buttonJaime"]) >= 1){
    $Publications->like($_POST["buttonJaime"]);

    $Publications->removeJaime($_POST["buttonJaime"]);
    header("location:../pages/accueil.php#publication" . $_POST["buttonJaime"]);
}else{
    $Publications->like($_POST["buttonJaime"]);

    $Publications->jaime($_POST["buttonJaime"]);

    header("location:../pages/accueil.php#publication" . $_POST["buttonJaime"]);
}
