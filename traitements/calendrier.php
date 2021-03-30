<?php
require_once "../modeles/modele.php";

if(!empty($_POST["supprEvenement"])){
    supprEvenement($_POST["supprEvenement"]);
    $date = $_POST["date"];
}
if(!empty($_POST["date"])){
    extract($_POST);
}else{
    $date = date("Y-m-d");
}
$calendrier = [];
$annee = intval( substr($date,0,4));
$mois = intval( substr($date,5,2));
$days = getDaysInMonth($annee,$mois);
for($i=1; $i<=$days ; $i++){
    $calendrier[] = ['date' => $annee."-".$mois."-".$i, 'jourDeSemaine' => dayOfWeek($annee."-".$mois."-".$i), 'jour' => $i ];
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
$evenements = evenementsParDate($date);