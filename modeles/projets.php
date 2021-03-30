<?php

function newProjet($nomProjet, $membresProjet, $descriptionProjet, $dateDebut, $dateFin){
    $requete = getBdd()->prepare("INSERT INTO projets(nomProjet, membresProjet, descriptionProjet, dateDebut, dateFin, image) VALUES(?, ?, ?, ?, ?, ?)");
    $requete->execute([$nomProjet, $membresProjet, $descriptionProjet, $dateDebut, $dateFin, "../pages/images/projets/projet" . rand(1, 7) . ".jpg"]);
}

function selectionProjets(){
    $requete = getBdd()->prepare("SELECT * FROM projets");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function detailsProjets($idProjet){
    $requete = getBdd()->prepare("SELECT * FROM projets WHERE idProjet = ?");
    $requete->execute([$idProjet]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}