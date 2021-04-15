<?php
class Evenements extends Modele{
    public function evenementsParDate($date,$idUtilisateur){
        $requete = $this->getBdd() ->prepare("SELECT * FROM evenements WHERE date = ? AND idUtilisateur = ? ORDER BY heureDebut");
        $requete ->execute([$date,$idUtilisateur]);
        return $requete-> fetchAll(PDO::FETCH_ASSOC);
    }
    public function ajoutEvenement($designation,$date,$heureDebut,$heureFin,$idUtilisateur){
        $requete = $this->getBdd()->prepare("INSERT INTO evenements(designation,date,heureDebut,heureFin,idUtilisateur) VALUES(?,?,?,?,?)");
        $requete ->execute([$designation,$date,$heureDebut,$heureFin,$idUtilisateur]);
    }
    public function supprEvenement($idEvenement){
        $requete = $this->getBdd()->prepare("DELETE FROM evenements WHERE idEvenement = ?");
        $requete ->execute([$idEvenement]);
    }
    public function nbrEvenements($date,$idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT date, COUNT(idEvenement) AS 'nbr' FROM `evenements` WHERE date LIKE ? AND idUtilisateur = ? GROUP BY date");
        $requete->execute([$date . "%",$idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

}