<?php
require_once "../modeles/Modele.php";

$Planifications = new Plannifications();
// // Définition de la localisation pour la date
setlocale(LC_ALL, 'fr_FR.utf8', 'fra');

// Définition du nombre de jours par mois (mois actuel)
$nb_day_per_month = date('t', mktime(0, 0, 0, date("n"), 1, date("Y")));

// On récupère la date actuel
$date = new DateTime('NOW');

$jours_grises = [6, 7];

if(isset($_GET["id"]) && $_GET["id"] != $_SESSION["idUtilisateur"]){
    header("location:../pages/accueil.php?page=planification&error=noaccess");
}

if(!empty($_POST["ratio"])){
    $date = substr($_POST["date"], 4, 4) . "-" . substr($_POST["date"], 2, 2) . "-" . substr($_POST["date"], 0, 2);
    $Planifications->insert_ratio($_POST['id'], $_POST["idProjet"], $date, $_POST["ratio"]);
    header("location:../pages/accueil.php?page=planification");
}
?>