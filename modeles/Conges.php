<?php
class Conges extends Modele{
    private $idConge;
    private $dateDebut;
    private $dateFin;
    private $commentaire;
    private $statut;
    private $raison;
    private $nom;
    private $prenom;

    public function initialiser($idConge, $dateDebut, $dateFin, $commentaire, $statut, $raison, $nom, $prenom){
        $this->idConge = $idConge;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->commentaire = $commentaire;
        $this->status = $statut;
        $this->raison = $raison;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    // GETTERS
    public function getIdConge(){
        return $this->idConge;
    }
    public function getDateDebut(){
        return $this->dateDebut;
    }
    public function getDateFin(){
        return $this->dateFin;
    }
    public function getCommentaire(){
        return $this->commentaire;
    }
    public function getStatut(){
        return $this->statut;
    }
    public function getRaison(){
        return $this->raison;
    }
    public function getNom_Conge(){
        return $this->nom;
    }
    public function getPrenom_Conge(){
        return $this->prenom;
    }

    // MÉTHODES
    public function getConges(){
        $requete = $this->getBdd()->prepare("SELECT idConge, dateDebut, dateFin, commentaire, status, raison, nom, prenom FROM conges LEFT JOIN utilisateurs USING(idUtilisateur)");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCongeParUtilisateur($idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT * FROM conges WHERE idUtilisateur = ?");
        $requete->execute([$idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCongeEnAttenteParUtilisateur($idUtilisateur, $statut){
        $requete = $this->getBdd()->prepare("SELECT * FROM conges WHERE idUtilisateur = ? AND status = ?");
        $requete->execute([$idUtilisateur, $statut]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function supprimerConge($idConge){
        $requete = $this->getBdd()->prepare("DELETE FROM conges WHERE idConge = ?");
        $requete->execute([$idConge]);
    }

    public function nouveauConge($idUtilisateur, $dateDebut, $dateFin, $commentaire, $statut, $raison){
        $requete = $this->getBdd()->prepare("INSERT INTO conges(idUtilisateur, dateDebut, dateFin, commentaire, status, raison) VALUES(?, ?, ?, ?, ?, ?)");
        $requete->execute([$idUtilisateur, $dateDebut, $dateFin, $commentaire, $statut, $raison]);
    }
}
?>