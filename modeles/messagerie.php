<?php
function recuperationContacts($idUtilisateur){
    $requete = getBdd()->prepare("SELECT nom, prenom, photoProfil FROM utilisateurs WHERE idUtilisateur != ?");
    $requete->execute([$idUtilisateur]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function recuperationInformationsContact($getAvec){
    $requete = getBdd()->prepare("SELECT * FROM utilisateurs WHERE prenom = ?");
    $requete->execute([$getAvec]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function newMessage($envoyeur, $receveur, $contenu){
    $requete = getBdd()->prepare("INSERT INTO messagerie(envoyeur, receveur, contenu) VALUES(?, ?, ?)");
    $requete->execute([$envoyeur, $receveur, $contenu]);
}

function recuperationMessage($personne1, $personne2){
    $requete = getBdd()->prepare("SELECT * FROM messagerie WHERE (envoyeur = ? AND receveur = ?) OR (envoyeur = ? AND receveur = ?)");
    $requete->execute([$personne1, $personne2, $personne2, $personne1]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function recherche($s1){
    $requete = getBdd()->prepare("SELECT * FROM utilisateurs WHERE prenom LIKE ? OR nom LIKE ?");
    $requete->execute(["%" . $s1 . "%", "%" . $s1 . "%"]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}
?>