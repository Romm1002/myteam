<?php
class Plannifications extends Modele{
    
    // Permet d'afficher la somme des ratio
    // public function ratio($date, $idUtilisateur){
    //     $requete = $this->getBdd()->prepare('SELECT IFNULL(SUM(ratio), 0) FROM plannifications WHERE date = ? AND idUtilisateur = ?');
    //     $requete->execute([$date, $idUtilisateur]);
    //     return $requete->fetch(PDO::FETCH_ASSOC);
    // }

    // public function getDate(){
    //     $requete = $this->getBdd()->prepare('SELECT date FROM plannifications');
    //     $requete->execute();
    //     return $requete->fetchAll(PDO::FETCH_ASSOC);
    // }

    
}
?>