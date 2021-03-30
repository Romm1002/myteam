<?php

function profil($idUtilisateur){
    $requete = getBdd()->prepare("SELECT * FROM utilisateurs INNER JOIN postes USING(idposte) WHERE idUtilisateur = ?");
    $requete->execute([$idUtilisateur]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function modificationEmail($email){
    $requete = getBdd()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
    $requete->execute([$email]);
    return $requete->rowCount();
}

function updateProfil($nom, $prenom, $email, $idUtilisateur){
    $requete = getBdd()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?,  email = ? WHERE idUtilisateur = ?");
    $requete->execute([$nom, $prenom, $email, $idUtilisateur]);
}

function updatePhotoProfil($target_file, $idUtilisateur){
    $requete = getBdd() ->prepare("UPDATE utilisateurs SET photoProfil = ? WHERE idUtilisateur = ?");
    $requete->execute([$target_file, $idUtilisateur]);
}

function updateMdp($mdp, $idUtilisateur){
    $requete = getBdd()->prepare("UPDATE utilisateurs SET mdp = ? WHERE idUtilisateur = ?");
    $requete->execute([$mdp, $idUtilisateur]);
}