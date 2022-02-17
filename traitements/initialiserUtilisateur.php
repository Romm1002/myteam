<?php
if (!empty($_SESSION["idUtilisateur"]) && !empty($_SESSION["nom"]) && !empty($_SESSION["prenom"]) && !empty($_SESSION["dateNaiss"]) && !empty($_SESSION["email"]) && !empty($_SESSION["photoProfil"]) && !empty($_SESSION["poste"])&& !empty($_SESSION["grade"])){
    $utilisateur = new Utilisateurs($_SESSION["idUtilisateur"], $_SESSION["nom"], $_SESSION["prenom"], $_SESSION["dateNaiss"], $_SESSION["email"], $_SESSION["photoProfil"], $_SESSION["poste"], $_SESSION["grade"]);
}
?>