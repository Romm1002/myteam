<?php
function connexion($email){
    $requete = getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes ON utilisateurs.idposte = postes.idposte WHERE email = ?");
    $requete->execute([$email]);
    return $requete->fetch(PDO::FETCH_ASSOC);
    return $requete->rowCount();
}

function inscription($email){
    $requete = getBdd()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
    $requete->execute([$email]);
    return $requete->rowCount();
}

function insertionInscription($nom, $prenom, $datenaiss, $email, $mdp, $idposte, $photoProfil){
    $requete=getBdd()->prepare("INSERT INTO utilisateurs(nom,prenom,datenaiss,email,mdp,idposte,photoProfil) VALUES (?,?,?,?,?,?,?)");
    $requete->execute([$nom,$prenom,$datenaiss,$email,$mdp,$idposte,$photoProfil]);
}