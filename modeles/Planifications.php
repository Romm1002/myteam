<?php
class Plannifications extends Modele{
    private $idUtilisateur;
    private $idProjet;
    private $date;
    private $ratio;

    public function update_ratio($ratio, $idUtilisateur, $idProjet, $date){
        $requete = $this->getBdd()->prepare('UPDATE plannifications SET ratio = ? WHERE idUtilisateur = ? AND idProjet = ? AND date = ?');
        $requete->execute([$ratio, $idUtilisateur, $idProjet, $date]);
    }

    public function insert_ratio($idUtilisateur, $idProjet, $date, $ratio){
        $requete = $this->getBdd()->prepare('INSERT INTO plannifications(idUtilisateur, idProjet, date, ratio) VALUES(?, ?, ?, ?)');
        $requete->execute([$idUtilisateur, $idProjet, $date, $ratio]);
    }

    public function ratio($date, $idUtilisateur){
        $requete = $this->getBdd()->prepare('SELECT IFNULL(SUM(ratio), 0) FROM plannifications WHERE date = ? AND idUtilisateur = ?');
        $requete->execute([$date, $idUtilisateur]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
}
?>