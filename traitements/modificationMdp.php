<?php
require_once "../modeles/Modele.php";


$erreurs = 0;

if(!empty($_POST["newMdp"]) && !empty($_POST["repeatMdp"]) && !empty($_POST["oldMdp"])){

    // On vérifie que le mot de passe actuel (qui va devenir l'ancien) est bien le bon
    $password = $utilisateur->connexion($utilisateur->getEmail())['mdp'];
    if(!password_verify($_POST["oldMdp"], $password)){
        $erreurs++;
        header("location:../pages/modificationMdp.php?validate=3");
    }

    // Vérification du mot de passe (identique et longueur)
    if($_POST["newMdp"] != $_POST["repeatMdp"]){
        $erreurs++;
        header("location:../pages/modificationMdp.php?validate=no");
    }
    if(strlen($_POST["newMdp"]) < 8){
        $erreurs++;
        header("location:../pages/modificationMdp.php?validate=no");
    }

    // On vérifit la force du mdp
    if( !preg_match("#[0-9]+#", $_POST["newMdp"])){
        $erreurs++;
        header("location:../pages/modificationMdp.php?validate=2");
    }

    if(!preg_match("#[a-z]+#", $_POST["newMdp"])){
        $erreurs++;
        header("location:../pages/modificationMdp.php?validate=2");
    }

    if(!preg_match("#[A-Z]+#", $_POST["newMdp"])){
        $erreurs++;
        header("location:../pages/modificationMdp.php?validate=2");
    }

    if(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $_POST["newMdp"])){
        $erreurs++;
        header("location:../pages/modificationMdp.php?validate=2");
    }

    if($erreurs == 0){
        try{
            $mdp = password_hash($_POST["newMdp"], PASSWORD_BCRYPT);
            $utilisateur->updateMdp($mdp);
            header("location:../pages/modificationMdp.php?validate=yes");
        }catch(Exception $e){
            header("location:../pages/modificationMdp.php?validate=error");
        }
    }
}