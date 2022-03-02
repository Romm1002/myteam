<?php
class Conges extends Modele{
    private $idConge;
    private $dateDebut;
    private $dateFin;
    private $commentaire;
    private $statut;
    private $raison;

    public function initialiser($idConge, $dateDebut, $dateFin, $commentaire, $statut, $raison){
        $this->idConge = $idConge;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->commentaire = $commentaire;
        $this->status = $statut;
        $this->raison = $raison;
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

    // MÉTHODES
    public function getCongeParUtilisateur($idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT * FROM conges WHERE idUtilisateur = ?");
        $requete->execute([$idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>