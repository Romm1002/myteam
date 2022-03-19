<?php
require_once "../modeles/Modele.php";

$tache = new Taches();

$dateDuJour = date("Y-m-d");
$dateFin = $_POST["date_fin"];

if(!empty($_POST["libelle"]) && !empty($_POST["salarie"]) && !empty($dateFin)){
    if($dateFin > $dateDuJour){
        $tache->nouvelle_tache($_POST["libelle"], $_POST["idProjet"], $_POST["salarie"], $_POST["parent"], 0,$_POST["date_fin"]);
        header("location:../pages/projets.php?id=" . $_POST["idProjet"]);
    }else{
        header("location:../pages/projets.php?id=" . $_POST["idProjet"] . "&error=2");
    }
}
?>