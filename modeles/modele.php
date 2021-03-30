<?php
session_start();
function getBdd(){
    // INITIALISATION DE LA CONNEXION A LA BDD
    return new PDO('mysql:host=localhost;dbname=myteam', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}

require_once "../modeles/informationsProfil.php";
require_once "../modeles/utilisateurs.php";
require_once "../modeles/publications.php";
require_once "../modeles/projets.php";
require_once "../modeles/fonctionCalendrier.php";
require_once "../modeles/administration.php";
require_once "../modeles/evenements.php";
require_once "../modeles/messagerie.php";