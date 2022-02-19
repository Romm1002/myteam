<?php
class Messagerie extends Modele{
    private $idMessage;
    private $idUtilisateur;
    private $receveur;
    private $contenu;
    private $heure;
    private $envoyeur;

    public function initialiser($idMessage, $idUtilisateur, $contenu, $heure, $envoyeur = null){
        $this->idMessage = $idMessage;
        $this->idUtilisateur = $idUtilisateur;
        $this->contenu = $contenu;
        $this->heure = $heure;
        if ($envoyeur != null){
            $this->envoyeur = $envoyeur;
        }
    }


    public function getId(){
        return $this->idMessage;
    }
    public function getIdUtilisateur(){
        return $this->idUtilisateur;
    }
    public function getReceveur(){
        return $this->receveur;
    }
    public function getContenu(){
        return $this->contenu;
    }
    public function getEnvoyeur(){
        return $this->envoyeur;
    }
 
    // Récupération des informations du contact séléctionné
    public function recuperationInformationsContact($idAvec){
        $requete = $this->getBdd()->prepare("SELECT nom, prenom, photoProfil, idUtilisateur FROM utilisateurs WHERE idUtilisateur = ?");
        $requete->execute([$idAvec]);
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        $utilisateur = new Utilisateurs;
        $utilisateur->initialiser($result["nom"], $result["prenom"], $result["photoProfil"], $result["idUtilisateur"]);
        $this->receveur = $utilisateur;
    }
    
    // Permet l'envoi d'un nouveau message
    public function newMessage($idEnvoyeur, $contenu){
        $this->contenu = $contenu;
        $requete = $this->getBdd()->prepare("INSERT INTO messagerie(idUtilisateur,idReceveur, contenu, heure) VALUES(?, ?, ?, NOW())");
        $requete->execute([$idEnvoyeur, $this->receveur->getId(), $this->contenu]);
    }
    
    // Permet d'insérer en BDD le message signalé par l'utilisateur
    public function signalerMessage($idMessage, $message, $traite, $idUtilisateur){
        $requete = $this->getBdd()->prepare("INSERT INTO messages_signales(idMessage, message, traite, idUtilisateur) VALUES(?, ?, ?, ?)");
        $requete->execute([$idMessage, $message, $traite, $idUtilisateur]);
    }
}
?>