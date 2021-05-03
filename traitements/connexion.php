<?php
require_once "../modeles/modele.php";

$Utilisateurs = new Utilisateurs();

// Redirection si le membre est déjà connecté
if(!empty($_SESSION["grade"])){
    header("location:../pages/index.php");
}

$erreurs = 0;

// Vérifications pour envoyer le formulaire de connexion // Si les champs ne sont pas vides
if(!empty($_POST["envoi"]) && $_POST["envoi"] == 1){
    if(!empty($_POST["email"]) && !empty($_POST["mdp"])){
        extract($_POST);

        // Vérification si l'email est valide
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erreurs++;
            header("location:../pages/index.php?error=invalideEmail");
            // mail invalide
        }

        // On vérifie si l'identifiant existe en BDD
        $connexion = $Utilisateurs->connexion($email);
        if($connexion > 0){
            $utilisateur = $connexion;

            // On vérifie si le mdp entré correspond au mdp hashé en BDD
            if(!password_verify($mdp, $utilisateur["mdp"])){
                $erreurs++;
                header("location:../pages/index.php?error=mdp");
                // Mdp incorrect
            }
        }else{
            $erreurs++;
            header("location:../pages/index.php?error=emailInexistant");
            //mail non existant
        }
    }else{
        $erreurs++;
        header("location:../pages/index.php?error=empty");
    }

    // On vérifie si le nombre d'erreur est de 0 pour connecter l'utilisateur et créer sa session
    if($erreurs == 0){
        // On connecte l'utilisateur en utilisant le $_SESSION
        $_SESSION = $utilisateur;
        header("location:../pages/accueil.php");
    }
}
?>