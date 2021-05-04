<?php
require_once "../modeles/modele.php";
if(!empty($_GET["date"])){
    extract($_GET);
}else{
    $date = date("Y-m-d");
}
$calendrier = new Calendrier($date,$_SESSION["idUtilisateur"]);
// suppression d'un evenement
if(!empty($_POST["supprEvenement"])){
    $Evenements->supprEvenement($_POST["supprEvenement"]);
    header("location:../pages/planning.php?date=".$date);
}
// ajout d'un evenement
if(!empty($_POST["designation"]) && !empty($_POST["heureDebut"])){
    extract($_POST);
    if(empty($heureFin)){
        $heureFin = $heureDebut;    
    }
    if(intval($heureDebut) > intval($heureFin) || ((intval($heureDebut) == intval($heureFin)) && (intval(substr($heureDebut,3,2)) > intval(substr($heureFin,3,2)) ))){
        header("location:../pages/planning.php?date=".$date."&ajout=1");
        exit;
    }
    if(intval($heureDebut) < 8 || intval($heureDebut) > 18 || intval($heureFin) > 18){
        header("location:../pages/planning.php?date=".$date."&ajout=2");
        exit;
    }
    $evenements = new Evenements($date,$designation,$_SESSION["idUtilisateur"],$heureDebut,$heureFin);
    $evenements->ajout();
    header("location:../pages/planning.php?date=".$date."&ajout=OK");
    exit;
}
