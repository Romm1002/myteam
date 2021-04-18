<?php
class Evenements extends Modele{
    private $date; //string
    private $designation; //string
    private $heureDebut; //string
    private $heureFin; //string
    private $idUtilisateur; //int
    public function __construct($date,$designation,$idUtilisateur,$heureDebut,$heureFin)
    {
        $this->date = $date;
        $this->designation = $designation;
        $this->heureDebut = $heureDebut;
        $this->heureFin = $heureFin;
        $this->idUtilisateur = $idUtilisateur;
    }
    public function evenementsParDate($date,$idUtilisateur){
        $requete = $this->getBdd() ->prepare("SELECT * FROM evenements WHERE date = ? AND idUtilisateur = ? ORDER BY heureDebut");
        $requete ->execute([$date,$idUtilisateur]);
        return $requete-> fetchAll(PDO::FETCH_ASSOC);
    }
    public function ajout(){
        $requete = $this->getBdd()->prepare("INSERT INTO evenements(designation,date,heureDebut,heureFin,idUtilisateur) VALUES(?,?,?,?,?)");
        $requete ->execute([$this->designation,$this->date,$this->heureDebut,$this->heureFin,$this->idUtilisateur]);
    }
    public function supprEvenement($idEvenement){
        $requete = $this->getBdd()->prepare("DELETE FROM evenements WHERE idEvenement = ?");
        $requete ->execute([$idEvenement]);
    }

}