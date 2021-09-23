<?php
// // Définition de la localisation pour la date
setlocale(LC_ALL, 'fr_FR.utf8', 'fra');

// Définition du nombre de jours par mois (mois actuel)
$nb_day_per_month = date('t', mktime(0, 0, 0, date("n"), 1, date("Y")));

// On récupère la date actuel
$date = new DateTime('NOW');

$jours_grises = [6, 7];
?>