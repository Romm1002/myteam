<?php
require_once "../modeles/Modele.php";

$Modele = new Modele();
$ipsAllowed = $Modele->getIpsAllowed();

if(!in_array($_SERVER["REMOTE_ADDR"], $ipsAllowed)){
    header("location:../pages/accueil.php?page=conges");
}else{
    if($utilisateur->getGrade() == 6){
        $Conges = new Conges();
        $Conges->accepterConge(2, $_GET["id"]);
        header("location:../pages/accueil.php?page=conges");
    }
}
?>