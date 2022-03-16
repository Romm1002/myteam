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
        return $result;
    }
    
    // Permet l'envoi d'un nouveau message
    public function newMessage($idEnvoyeur, $contenu){
        try {
            $this->contenu = $contenu;
            $requete = $this->getBdd()->prepare("INSERT INTO messagerie(idUtilisateur,idReceveur, contenu, heure) VALUES(?, ?, ?, NOW())");
            $requete->execute([$idEnvoyeur, $this->receveur->getId(), $this->contenu]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function deleteMessage($idMessage){
        try {
            $this->idMessage = $idMessage;
            $requete = $this->getBdd()->prepare("DELETE FROM messagerie WHERE idMessage = ?");
            $requete->execute([$this->idMessage]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    
    // Permet d'insérer en BDD le message signalé par l'utilisateur
    public function signalerMessage($idMessage, $message, $traite, $idUtilisateur, $idSignale){
        try {
            $requete = $this->getBdd()->prepare("INSERT INTO messages_signales(idMessage, message, traite, idUtilisateur, idSignale) VALUES(?, ?, ?, ?, ?)");
            $requete->execute([$idMessage, $message, $traite, $idUtilisateur, $idSignale]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function deleteMessageSignale($idMessage){
        try {
            $this->idMessage = $idMessage;
            $requete = $this->getBdd()->prepare("DELETE FROM messages_signales WHERE idMessage = ?");
            $requete->execute([$this->idMessage]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Set the value of idUtilisateur
     *
     * @return  self
     */ 
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
}
?>