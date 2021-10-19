<?php
class Messagerie extends Modele{
    // Permet la récupération des contacts afin de les afficher pour démarrer une conversation
    public function recuperationContacts($idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT nom, prenom, photoProfil, idUtilisateur FROM utilisateurs WHERE idUtilisateur != ?");
        $requete->execute([$idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Récupération des informations du contact séléctionné
    public function recuperationInformationsContact($idAvec){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
        $requete->execute([$idAvec]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    
    // Permet l'envoi d'un nouveau message
    public function newMessage($idEnvoyeur, $idReceveur, $contenu){
        $requete = $this->getBdd()->prepare("INSERT INTO messagerie(idEnvoyeur,idReceveur, contenu, heure) VALUES(?, ?, ?, NOW())");
        $requete->execute([$idEnvoyeur, $idReceveur, $contenu]);
    }
    
    // Permet l'affichage des messages envoyés avec une personne
    public function recuperationMessage($idPersonne1, $idPersonne2){
        $requete = $this->getBdd()->prepare("SELECT * FROM messagerie WHERE (idEnvoyeur = ? AND idReceveur = ?) OR (idEnvoyeur = ? AND idReceveur = ?)");
        $requete->execute([$idPersonne1, $idPersonne2, $idPersonne2, $idPersonne1]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Permet de rechercher une personne des contacts via la barre de recherche
    public function recherche($s1, $idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE (prenom LIKE ? OR nom LIKE ?) AND idUtilisateur != ?");
        $requete->execute(["%" . $s1 . "%", "%" . $s1 . "%", $idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>