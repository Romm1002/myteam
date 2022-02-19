<?php
require_once "../modeles/Modele.php";

$Modele = new Modele();
$maintenance = $Modele->maintenance()["maintenance"];

// On vérifie si le boolean est à 1 et si c'est le cas, le site est en maintenance.
if($maintenance == 1){
    if($utilisateur->getGrade() != 10){
        session_destroy();
        header("location:../pages/index.php?error=3");
    }
}
?>