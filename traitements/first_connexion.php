<?php
require_once "../modeles/Modele.php";


$erreur = 0;

if($_POST["send"] == 1){
    if(!empty($_POST["password"]) && !empty($_POST["confirmation_password"])){
        if($_POST["password"] !== $_POST["confirmation_password"]){
            $erreur++;
            header("location:../pages/first_connexion.php?error=0");
        }

        if(strlen($_POST["password"]) < 8){
            $erreur++;
            header("location:../pages/first_connexion.php?error=1");
        }

        // On vérifit la force du mdp
        if( !preg_match("#[0-9]+#", $_POST["password"])){
            $erreur++;
            header("location:../pages/first_connexion.php?error=2");
        }
    
        if(!preg_match("#[a-z]+#", $_POST["password"])){
            $erreur++;
            header("location:../pages/first_connexion.php?error=2");
        }
    
        if(!preg_match("#[A-Z]+#", $_POST["password"])){
            $erreur++;
            header("location:../pages/first_connexion.php?error=2");
        }
    
        if(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $_POST["password"])){
            $erreur++;
            header("location:../pages/first_connexion.php?error=2");
        }
    }

    if($erreur == 0){
        $utilisateur->updateMdp(password_hash($_POST["password"], PASSWORD_BCRYPT));
        $utilisateur->update_firstConnexion(0);
        header("location:../pages/accueil.php");
    }
}
?>