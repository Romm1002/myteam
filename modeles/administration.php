<?php
function rechercheEmploye($search){
    $requete = getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes ON utilisateurs.idposte = postes.idposte WHERE nom LIKE '?%' OR nom LIKE '%?%' OR nom LIKE '%?' OR prenom LIKE '?%' OR prenom LIKE '%?%' OR prenom LIKE '%?'");
    $requete -> execute([$search]);
    $requete->rowCount();
    $requete->fetchAll(PDO :: FETCH_ASSOC);
}

function rechercheOK(){
    $requete = getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes ON utilisateurs.idposte = postes.idposte");
    $requete -> execute();
    $requete->rowCount();
    $requete->fetchAll(PDO::FETCH_ASSOC);
}

function recuperationPostes(){
    //recupération des postes
    $requete=getBdd()->prepare("SELECT * FROM postes");
    $requete->execute();
    return $requete->fetch(PDO :: FETCH_ASSOC);
}

function recuperationEmail($email){
    $requete = getBdd()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
    $requete->execute([$email]);
    $requete->rowCount();
}

function newUtilisateur($nom, $prenom, $datenaiss, $email, $mdp, $idposte, $pdp){
    $requete=getBdd()->prepare("INSERT INTO utilisateurs(nom,prenom,datenaiss,email,mdp,idposte, photoProfil) VALUES (?,?,?,?,?, ?, ?)");
    $requete->execute([$nom,$prenom,$datenaiss,$email,$mdp, $idposte, $pdp]);
}

function utilisateurs($idUtilisateur){
    $requete = getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes ON utilisateurs.idposte = postes.idposte WHERE idutilisateur = ?");
    $requete->execute([$idUtilisateur]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}