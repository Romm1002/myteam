<?php
class Messagerie extends Modele{
    public function recuperationContacts($idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT nom, prenom, photoProfil, idUtilisateur FROM utilisateurs WHERE idUtilisateur != ?");
        $requete->execute([$idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function recuperationInformationsContact($getAvec){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
        $requete->execute([$getAvec]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    
    public function newMessage($envoyeur, $receveur, $contenu){
        $requete = $this->getBdd()->prepare("INSERT INTO messagerie(envoyeur, receveur, contenu, heure) VALUES(?, ?, ?, NOW())");
        $requete->execute([$envoyeur, $receveur, $contenu]);
    }
    
    public function recuperationMessage($personne1, $personne2){
        $requete = $this->getBdd()->prepare("SELECT * FROM messagerie WHERE (envoyeur = ? AND receveur = ?) OR (envoyeur = ? AND receveur = ?)");
        $requete->execute([$personne1, $personne2, $personne2, $personne1]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function recherche($s1, $idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE (prenom LIKE ? OR nom LIKE ?) AND idUtilisateur != ?");
        $requete->execute(["%" . $s1 . "%", "%" . $s1 . "%", $idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteMessage($idMessage){
        $requete = $this->getBdd()->prepare("DELETE FROM messagerie WHERE idMessage = ?");
        $requete->execute([$idMessage]);
    }
}
?>