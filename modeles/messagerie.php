<?php
class Messagerie extends Modele{
    public function recuperationContacts($idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT nom, prenom, photoProfil, idUtilisateur FROM utilisateurs WHERE idUtilisateur != ?");
        $requete->execute([$idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function recuperationInformationsContact($idAvec){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
        $requete->execute([$idAvec]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    
    public function newMessage($idEnvoyeur, $idReceveur, $contenu){
        $requete = $this->getBdd()->prepare("INSERT INTO messagerie(idEnvoyeur,idReceveur, contenu, heure) VALUES(?, ?, ?, NOW())");
        $requete->execute([$idEnvoyeur, $idReceveur, $contenu]);
    }
    
    public function recuperationMessage($idPersonne1, $idPersonne2){
        $requete = $this->getBdd()->prepare("SELECT * FROM messagerie WHERE (idEnvoyeur = ? AND idReceveur = ?) OR (idEnvoyeur = ? AND idReceveur = ?)");
        $requete->execute([$idPersonne1, $idPersonne2, $idPersonne2, $idPersonne1]);
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