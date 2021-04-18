<?php
session_start();
class Modele{
    protected function getBdd(){
        // INITIALISATION DE LA CONNEXION A LA BDD
        return new PDO('mysql:host=localhost;dbname=myteam', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
}

require_once "../modeles/informationsProfil.php";
require_once "../modeles/Utilisateurs.php";
require_once "../modeles/publications.php";
require_once "../modeles/projets.php";
require_once "../modeles/administration.php";
require_once "../modeles/evenements.php";
require_once "../modeles/messagerie.php";
require_once "../modeles/calendrier.php";
require_once "../modeles/planning.php";
require_once "../modeles/jour.php";