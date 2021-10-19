<?php
class Projets extends Modele{
    // Permet la création d'un nouveau projet
    public function newProjet($nomProjet, $membresProjet, $descriptionProjet, $dateDebut, $dateFin){
        $requete = $this->getBdd()->prepare("INSERT INTO projets(nomProjet, membresProjet, descriptionProjet, dateDebut, dateFin, image) VALUES(?, ?, ?, ?, ?, ?)");
        $requete->execute([$nomProjet, $membresProjet, $descriptionProjet, $dateDebut, $dateFin, "../pages/images/projets/projet" . rand(1, 7) . ".jpg"]);
    }
    
    // Séléctionne les utilisateurs présents dans un projet pour les afficher dedans
    public function selectionParticipants($idProjet){
        $requete = $this->getBdd()->prepare("SELECT utilisateurs.nom, utilisateurs.prenom, participationprojet.* FROM participationprojet LEFT JOIN utilisateurs USING(idUtilisateur) WHERE idProjet = ?");
        $requete->execute([$idProjet]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // public function detailsProjets($idProjet){
    //     $requete = $this->getBdd()->prepare("SELECT * FROM projets WHERE idProjet = ?");
    //     $requete->execute([$idProjet]);
    //     return $requete->fetch(PDO::FETCH_ASSOC);
    // }

    public function getDate(){
        $requete = $this->getBdd()->prepare('SELECT date FROM plannifications');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function plannifications($idUtilisateur, $date){
        $requete = $this->getBdd()->prepare('SELECT * FROM plannifications WHERE idUtilisateur = ? AND date = ?');
        // On a formater la date pour quelle soit la même qu'en BDD
        $requete->execute([$idUtilisateur, $date->format("Y-m-d")]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selection_projets(){
        $requete = $this->getBdd()->prepare('SELECT * FROM projets');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selection_projets_participants($idUtilisateur){
        $requete = $this->getBdd()->prepare('SELECT * FROM `participationprojet` LEFT JOIN projets USING(idProjet) WHERE idUtilisateur = ?');
        $requete->execute([$idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recherche_projet($s1){
        $requete = $this->getBdd()->prepare('SELECT * FROM projets WHERE libelle LIKE ?');
        $requete->execute(['%' . $s1 . '%', '%' . $s1 . '%']);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}