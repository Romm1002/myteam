<?php
require_once "../modeles/modele.php";

$Evenements = new Evenements();
$Planning = new Planning();
if(!empty($_GET["date"])){
    extract($_GET);
}else{
    $date = date("Y-m-d");
}
$annee = substr($date,0,4);
$mois = substr($date,5,2);
$jour = substr($date,8,2);
$dateobject= new dateTime();
$dateobject->setDate($annee, $mois, $jour);

// suppression d'un evenement
if(!empty($_POST["supprEvenement"])){
    $Evenements->supprEvenement($_POST["supprEvenement"]);
    header("location:../pages/planning.php?date=".$date);
}

// modification d'un evenement
if(!empty($_POST["designation"]) && !empty($_POST["modif"])){
    extract($_POST);
    $Evenements->modifEvenement($modif, $designation);
    header("location:../pages/planning.php?date=".$date."&ajout=modif");
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
    if(intval($heureDebut) < 8 || intval($heureFin) > 19){
        header("location:../pages/planning.php?date=".$date."&ajout=2");
        exit;
    }
    $Evenements->ajoutEvenement($designation,$date,$heureDebut,$heureFin,$_SESSION["idUtilisateur"],$couleur);
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
    $calendrier[] = ['date' => $annee."-".$mois."-".$jour, 'jourDeSemaine' => $Planning->dayOfWeek($annee."-".$mois."-".$i), 'jour' => $i, 'nbr' => ""];
}
$nbrEvenements = $Evenements->nbrEvenements(substr($date,0,7),$_SESSION["idUtilisateur"]);
foreach($nbrEvenements as $evenement){
    foreach($calendrier as $jour){
        if($evenement["date"] == $jour["date"]){
            $calendrier[$jour["jour"]-1]["nbr"] = $evenement["nbr"];
        }
    }    
}

$jour = substr($date,8,2);
$moisPrec;
$moisSuiv;
if($mois +1 == 13){
    $moisPrec = $annee . "-" . "11" . "-" . $jour;
    $moisSuiv = $annee+1 . "-" . "01" . "-" . $jour;
}elseif($mois-1 == 0){
    $moisPrec = $annee-1 . "-" . "12" . "-" . $jour;
    $moisSuiv = $annee . "-" . "02" . "-" . $jour;
}else{
    $moisPrec = $annee . "-" . ($mois-1 < 10 ? "0": "") . strval($mois-1) . "-" . $jour;
    $moisSuiv = $annee . "-" . ($mois+1 < 10 ? "0": "") . strval($mois+1) . "-" . $jour;
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
