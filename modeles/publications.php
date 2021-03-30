<?php
function publications(){
    $requete = getBdd()->prepare("SELECT * FROM publications LEFT JOIN utilisateurs USING(idUtilisateur) LEFT JOIN postes USING(idposte) ORDER BY datePublication DESC");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function newPublication($contenu, $date, $idUtilisateur){
    $requete = getBdd()->prepare("INSERT INTO publications(contenuPublication, datePublication, idUtilisateur) VALUES(?, ?, ?)");
    $requete->execute([$contenu, $date, $idUtilisateur]);
}