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

//remplissage du tableau calendrier
// $nbrEvenements = $Evenements->nbrEvenements(substr($date,0,7),$_SESSION["idUtilisateur"]);
// // $projets = projetsUtilisateur($_SESSION["idUtilisateur"]);
// foreach($nbrEvenements as $evenement){
//     foreach($calendrier as $key => $jour){
//         if($evenement["date"] == $jour["date"]){
//             $calendrier[$jour["jour"]-1]["nbr"] = $evenement["nbr"];
//             unset($nbrEvenements[$key]);
//         }
//     }
//     foreach($projets as $key => $projet){
//         if(substr($projet["dateDebut"],0,4) > substr($jour["date"],0,4) OR substr($projet["dateDebut"],0,7) > substr($jour["date"],0,7) OR substr($projet["dateFin"],0,7) < substr($jour["date"],0,7) OR substr($projet["dateFin"],0,4) < substr($jour["date"],0,4)){
//             unset($projets[$key]);
//         }
//         if(dateIntervalle($projet["dateDebut"],$projet["dateFin"],$jour["date"])){
//             $jour["projet"] = "true";
//         }
        
//     }
//     echo "<pre>";
//     print_r($jour);
//     echo "</pre>";
    
// }

// $evenements = $Evenements->evenementsParDate($date,$_SESSION["idUtilisateur"]);


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
