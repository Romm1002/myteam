<?php
require_once "../modeles/modele.php";

$erreurs = [];
if(!empty($_POST["mdp"]) && !empty($_POST["confirmationMdp"])){
    extract($_POST);

    // Vérification du mot de passe (identique et longueur)
    if($mdp != $confirmationMdp){
        $erreurs[] = "Les mots de passes saisis ne sont pas identiques";
        header("location:../pages/modificationMdp.php?validate=NOsame");
    }else{
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        updateMdp($mdp, $_SESSION["idUtilisateur"]);
    }
}