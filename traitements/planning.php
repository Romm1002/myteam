<?php
require_once "../modeles/modele.php";
$Evenements = new Evenements();
$Planning = new Planning();
if(!empty($_GET["date"])){
    extract($_GET);
}else{
    $date = date("Y-m-d");
}
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
    if(intval($heureDebut) < 8 || intval($heureFin) > 18){
        header("location:../pages/planning.php?date=".$date."&ajout=2");
        exit;
    }
    $Evenements->ajoutEvenement($designation,$date,$heureDebut,$heureFin,$_SESSION["idUtilisateur"]);
    header("location:../pages/planning.php?date=".$date."&ajout=OK");
    exit;
}

//remplissage du tableau calendrier
$calendrier = [];
$annee = substr($date,0,4);
$mois = substr($date,5,2);
$days = $Planning->getDaysInMonth(intval($annee),intval($mois));
for($i=1; $i<=$days ; $i++){
    $jour = "";
    if($i<10){
        $jour= "0" . $i ;
    }else{
        $jour = $i;
    }
    $calendrier[] = ['date' => $annee."-".$mois."-".$jour, 'jourDeSemaine' => $Planning->dayOfWeek($annee."-".$mois."-".$i), 'jour' => $i, 'nbr' => "", 'projet' => false];
}
$nbrEvenements = $Evenements->nbrEvenements(substr($date,0,7),$_SESSION["idUtilisateur"]);
// $projets = projetsUtilisateur($_SESSION["idUtilisateur"]);
foreach($nbrEvenements as $evenement){
    foreach($calendrier as $jour){
        if($evenement["date"] == $jour["date"]){
            $calendrier[$jour["jour"]-1]["nbr"] = $evenement["nbr"];
            unset($nbrEvenements[$key]);
        }
    }
    foreach($projets as $key => $projet){
        if(substr($projet["dateDebut"],0,4) > substr($jour["date"],0,4) OR substr($projet["dateDebut"],0,7) > substr($jour["date"],0,7) OR substr($projet["dateFin"],0,7) < substr($jour["date"],0,7) OR substr($projet["dateFin"],0,4) < substr($jour["date"],0,4)){
            unset($projets[$key]);
        }
        if(dateIntervalle($projet["dateDebut"],$projet["dateFin"],$jour["date"])){
            $jour["projet"] = "true";
        }
        
    }
    echo "<pre>";
    print_r($jour);
    echo "</pre>";
    
}

$evenements = $Evenements->evenementsParDate($date,$_SESSION["idUtilisateur"]);

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
// function dateIntervalle($debut,$fin,$test){
//     $dateDebut = new DateTime($debut);
//     $dateFin = new DateTime($fin);
//     $dateTest = new DateTime($test);
    

//     if ($dateDebut >= $dateTest and $dateFin >= $dateTest){
//         return true;
//     }else{
//         return false;
//     }
    
// }
