<?php
require_once "../modeles/Modele.php";

$Modele = new Modele();
$ipsAllowed = $Modele->getIpsAllowed();

if(!in_array($_SERVER["REMOTE_ADDR"], $ipsAllowed)){
    header("location:../pages/accueil.php?page=conges");
}else{
    $Conges = new Conges();
    $Conges->refuserConge(1, $_POST["raison_refus"], $_POST["idConge"]);
    header("location:../pages/accueil.php?page=conges");
}
?>