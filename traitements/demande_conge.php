<?php
require_once "../modeles/Modele.php";

// Variable qui contient la classe Conges
$conges = new Conges();

// Variable d'erreurs
$erreurs = 0;

// On vérifie que les champs obligatoires ne soient pas vides
if(!empty($_POST["dateDebut"]) && !empty($_POST["dateFin"])){
        $jourDateDebut = substr($_POST["dateDebut"], 8, 2);
        $moisDateDebut = substr($_POST["dateDebut"], 5, 2);
        $anneeDateDebut = substr($_POST["dateDebut"], 0, 4);
        $dateDebut = new DateTime();
        $dateDebut->setDate($anneeDateDebut, $moisDateDebut, $jourDateDebut);

        $jourDateFin = substr($_POST["dateFin"], 8, 2);
        $moisDateFin = substr($_POST["dateFin"], 5, 2);
        $anneeDateFin = substr($_POST["dateFin"], 0, 4);
        $dateFin = new DateTime();
        $dateFin->setDate($anneeDateFin, $moisDateFin, $jourDateFin);

    // On vérifie que la date de fin est supérieur à la date de début
    if($dateDebut > $dateFin){
        $erreurs++;
        header("location:../pages/accueil.php?page=conges&error=0");
    }

    // On vérifie que la date de début est supérieur à la date du jour
    $dateDuJour = new DateTime("now");
    if($dateDebut <= $dateDuJour){
        $erreurs++;
        header("location:../pages/accueil.php?page=conges&error=1");
    }
}else{
    $erreurs++;
    header("location:../pages/accueil.php?page=conges&error=2");
}

// Si tout est ok dans le formulaire, on envoie les données fournis en BDD
if($erreurs == 0){
    $conges->nouveauConge($utilisateur->getId(), $_POST["dateDebut"], $_POST["dateFin"], $_POST["commentaire"], 0, "-");
    header("location:../pages/accueil.php?page=conges&error=no");
}
?>