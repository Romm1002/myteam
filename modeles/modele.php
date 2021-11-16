<?php
session_start();
class Modele{
    protected function getBdd(){
        // INITIALISATION DE LA CONNEXION A LA BDD
        return new PDO('mysql:host=localhost;dbname=myteam;charset=UTF8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
}

require_once "../modeles/Utilisateurs.php";
require_once "../modeles/Publications.php";
require_once "../modeles/Projets.php";
require_once "../modeles/Messagerie.php";
require_once "../modeles/Administration.php";
require_once "../modeles/Planning.php";
require_once "../modeles/Evenements.php";
require_once "../modeles/Planifications.php";
require_once "../modeles/Services.php";
require_once "../modeles/Profil.php";
