<?php
require_once "../modeles/modele.php";

$Utilisateur = new Utilisateurs();

$erreurs = 0;

if(!empty($_POST["newMdp"]) && !empty($_POST["repeatMdp"])){
    extract($_POST);

    // Vérification du mot de passe (identique et longueur)
    if($newMdp != $repeatMdp){
        $erreurs++;
        header("location:../pages/modificationMdp.php?validate=no");
    }
    if(strlen($newMdp) < 8){
        $erreurs++;
        header("location:../pages/modificationMdp.php?validate=no");
    }

    if($erreurs == 0){
        try{
            $mdp = password_hash($newMdp, PASSWORD_BCRYPT);
            $Utilisateur->updateMdp($mdp, $_SESSION["idUtilisateur"]);
            header("location:../pages/modificationMdp.php?validate=yes");
        }catch(Exception $e){
            header("location:../pages/modificationMdp.php?validate=error");
        }
    }
}