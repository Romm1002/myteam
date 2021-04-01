<?php
if(!empty($_GET["date"])){
    extract($_GET);
}else{
    $date = date("Y-m-d");
}
require_once "../modeles/modele.php";
// suppression d'un evenement
if(!empty($_POST["supprEvenement"])){
    supprEvenement($_POST["supprEvenement"]);
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
    if(intval($heureDebut) < 8 || intval($heureFin) > 18){
        header("location:../pages/planning.php?date=".$date."&ajout=2");
        exit;
    }
    ajoutEvenement($designation,$date,$heureDebut,$heureFin,$_SESSION["idUtilisateur"]);
    header("location:../pages/planning.php?date=".$date."&ajout=OK");
    exit;
}

//remplissage du tableau calendrier
$calendrier = [];
$annee = substr($date,0,4);
$mois = substr($date,5,2);
$days = getDaysInMonth(intval($annee),intval($mois));
for($i=1; $i<=$days ; $i++){
    $jour = "";
    if($i<10){
        $jour= "0" . $i ;
    }else{
        $jour = $i;
    }
    $calendrier[] = ['date' => $annee."-".$mois."-".$jour, 'jourDeSemaine' => dayOfWeek($annee."-".$mois."-".$i), 'jour' => $i, 'nbr' => "", 'projet' => false];
}
$nbrEvenements = nbrEvenements(substr($date,0,7),$_SESSION["idUtilisateur"]);
$projets = projetsUtilisateur($_SESSION["idUtilisateur"]);
foreach($nbrEvenements as $evenement){
    foreach($calendrier as $jour){
        if($evenement["date"] == $jour["date"]){
            $calendrier[$jour["jour"]-1]["nbr"] = $evenement["nbr"];

        }
    }
}




function dateMois($date){
    $mois = substr($date,5,2);
    switch($mois){
        case "1" : 
            return "Janvier";
        case "2" : 
            return "Février";
        case "3" : 
            return "Mars";
        case "4" : 
            return "Avril";
        case "5" : 
            return "Mai";
        case "6" : 
            return "Juin";
        case "7" : 
            return "Juillet";
        case "8" : 
            return "Août";
        case "9" : 
            return "Septembre";
        case "10" : 
            return "Octobre";
        case "11" : 
            return "Novembre";
        case "12" : 
            return "Décembre";
    }
}
$evenements = evenementsParDate($date,$_SESSION["idUtilisateur"]);