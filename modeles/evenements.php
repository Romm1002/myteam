<?php
function evenementsParDate($date,$idUtilisateur){
    $requete = getBdd() ->prepare("SELECT * FROM evenements WHERE date = ? AND idUtilisateur = ? ORDER BY heureDebut");
    $requete ->execute([$date,$idUtilisateur]);
    return $requete-> fetchAll(PDO::FETCH_ASSOC);
}
function ajoutEvenement($designation,$date,$heureDebut,$heureFin,$idUtilisateur){
    $requete = getBdd()->prepare("INSERT INTO evenements(designation,date,heureDebut,heureFin,idUtilisateur) VALUES(?,?,?,?,?)");
    $requete ->execute([$designation,$date,$heureDebut,$heureFin,$idUtilisateur]);
}
function supprEvenement($idEvenement){
    $requete = getBdd()->prepare("DELETE FROM evenements WHERE idEvenement = ?");
    $requete ->execute([$idEvenement]);
}
function nbrEvenements($date,$idUtilisateur){
    $requete = getBdd()->prepare("SELECT date, COUNT(idEvenement) AS 'nbr' FROM `evenements` WHERE date LIKE ? AND idUtilisateur = ? GROUP BY date ORDER BY date ASC");
    $requete->execute([$date . "%",$idUtilisateur]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}