<?php
function evenementsParDate($date){
    $requete = getBdd() ->prepare("SELECT * FROM evenements WHERE date = ? ORDER BY heureDebut");
    $requete ->execute([$date]);
    return $requete-> fetchAll(PDO::FETCH_ASSOC);
}
function ajoutEvenement($designation,$contenu,$date,$heureDebut,$heureFin){
    $requete = getBdd()->prepare("INSERT INTO evenements(designation,date,heureDebut,heureFin,contenu) VALUES(?,?,?,?,?)");
    $requete ->execute([$designation,$date,$heureDebut,$heureFin,$contenu]);
}
function supprEvenement($idEvenement){
    $requete = getBdd()->prepare("DELETE FROM evenements WHERE idEvenement = ?");
    $requete ->execute([$idEvenement]);
}