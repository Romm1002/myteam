<?php
session_start();

class Modele{
    public function getBdd(){
        // INITIALISATION DE LA CONNEXION A LA BDD
        return new PDO('mysql:host=localhost;dbname=myteam;charset=UTF8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        // return new PDO('mysql:host=ipssisqmyteam.mysql.db;dbname=ipssisqmyteam;charset=UTF8', 'ipssisqmyteam', 'Ipssi2022myteam');
    }

    /*
     * PARTIE MAINTENANCE
     */

     public function maintenance(){
         $requete = $this->getBdd()->prepare("SELECT maintenance FROM maintenance");
         $requete->execute();
         return $requete->fetch(PDO::FETCH_ASSOC);
     }


    /* 
     * PARTIE PROJET 
     */

    

    // renvoi un entier de la somme de tout les evenements correspondant a la date et l'utilisateur
    public function nbrEvenements($date,$idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT date, COUNT(idEvenement) AS 'nbr' FROM `evenements` WHERE date LIKE ? AND idUtilisateur = ? GROUP BY date");
        $requete->execute([$date . "%",$idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
     * PARTIE MESSAGERIE
     */
    public function recuperationContacts($idUtilisateur){
        $listContact = array();

        $requete = $this->getBdd()->prepare("SELECT nom, prenom, photoProfil, idUtilisateur FROM utilisateurs WHERE idUtilisateur != ?");
        $requete->execute([$idUtilisateur]);
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $utilisateur = new Utilisateurs;
            $utilisateur->initialiser($value["nom"], $value["prenom"], $value["photoProfil"], $value["idUtilisateur"]);
            array_push($listContact, $utilisateur);
        }
        return $listContact;
    }

    // Permet de rechercher une personne des contacts via la barre de recherche
    public function rechercheContact($s1, $idUtilisateur){
        $listContact = array();

        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE (prenom LIKE ? OR nom LIKE ?) AND idUtilisateur != ?");
        $requete->execute(["%" . $s1 . "%", "%" . $s1 . "%", $idUtilisateur]);
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $utilisateur = new Utilisateurs;
            $utilisateur->initialiser($value["nom"], $value["prenom"], $value["photoProfil"], $value["idUtilisateur"]);
            array_push($listContact, $utilisateur);
        } 
        return $listContact;
    }

    // Permet l'affichage des messages envoy??s entre 2 personnes
    public function recuperationMessage($idPersonne1, $idPersonne2){
        $listMessage = array();
        $requete = $this->getBdd()->prepare("SELECT * FROM messagerie WHERE (idUtilisateur = ? AND idReceveur = ?) OR (idUtilisateur = ? AND idReceveur = ?)");
        $requete->execute([$idPersonne1, $idPersonne2, $idPersonne2, $idPersonne1]);
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $message = new Messagerie;
            $message->initialiser( $value["idMessage"], $value["idUtilisateur"], $value["contenu"], $value["heure"]);
            array_push($listMessage, $message);
        }
        return $listMessage;
    }
    
    /*
     * PARTIE UTILISATEUR
     */
    public function getUtilisateurs(){
        $listUtilisateur = array();
        $requete = $this->getBdd()->prepare('SELECT * FROM utilisateurs');
        $requete->execute();
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $utilisateur = new Utilisateurs;
            $utilisateur->initialiser($value["nom"], $value["prenom"], $value["photoProfil"], $value["idUtilisateur"], $value["color"]);
            array_push($listUtilisateur, $utilisateur);
        }
        return $listUtilisateur;
    }
    
    /*
     * PARTIE PROJET
     */
    public function getProjets(){
        $listProjet = array();
        $requete = $this->getBdd()->prepare('SELECT * FROM projets');
        $requete->execute();
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $projet = new Projets;
            $projet->initialiser($value["idProjet"], $value["nomProjet"], $value["descriptionProjet"],  $value["dateDebut"], $value["dateFin"], $value["image"], $value["archive"],);
            array_push($listProjet, $projet);
        }
        return $listProjet;
    }

    /*
     * PARTIE PROJET
     */
    public function getPublications(){
        $listPublication = array();
        $requete = $this->getBdd()->prepare("SELECT * FROM publications LEFT JOIN utilisateurs USING(idUtilisateur) LEFT JOIN postes USING(idposte) ORDER BY datePublication DESC");
        $requete->execute();
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $utilisateur = new Utilisateurs;
            $utilisateur->initialiser($value["nom"], $value["prenom"], $value["photoProfil"], $value["idUtilisateur"]);
            $publication = new Publication;
            $publication->initialiser($value["idPublication"], $value["contenuPublication"], $value["datePublication"], $utilisateur, $value["typePublication"], $value["jaime"]);
            array_push($listPublication, $publication);
        }
        return $listPublication;
    }
}
?>