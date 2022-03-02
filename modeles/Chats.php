<?php
class Chats extends Modele{
    private $idMessage;
    private $utilisateur;
    private $dateMessage;
    private $message;
    private $idProjet;

    public function initialiser($idMessage, $utilisateur, $dateMessage, $message, $idProjet){
        $this->idMessage = $idMessage;
        $this->utilisateur = $utilisateur;
        $this->dateMessage = $dateMessage;
        $this->message = $message;
        $this->idProjet = $idProjet;
    }

    public function getId(){
        return $this->idMessage;
    }
    public function getUtilisateur(){
        return $this->utilisateur;
    }
    public function getDateMessage(){
        return $this->dateMessage;
    }
    public function getmessage(){
        return $this->message;
    }
    public function getIdProjet(){
        return $this->idProjet;
    }
 
    public function new_chat($idAuteur, $date, $message, $idProjet){
        $requete = $this->getBdd()->prepare('INSERT INTO chatprojet(idUtilisateur, dateMessage, message, idProjet) VALUES(?, ?, ?, ?)');
        $requete->execute([$idAuteur, $date, $message, $idProjet]);
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
}
?>