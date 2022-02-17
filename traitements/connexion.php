<?php
require_once "../modeles/Modele.php";



// Redirection si le membre est déjà connecté
require_once "connected.php";

$utilisateur = new Utilisateurs;
$erreurs = 0;

// Vérifications pour envoyer le formulaire de connexion // Si les champs ne sont pas vides
if(!empty($_POST["envoi"]) && $_POST["envoi"] == 1){
    if(!empty($_POST["email"]) && !empty($_POST["mdp"])){
        
        // Vérification si l'email est valide
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $erreurs++;
            header("location:../pages/index.php?error=0");
            // mail invalide
        }

        // On vérifie si l'identifiant existe en BDD
        $connexion = $utilisateur->connexion($_POST["email"]);
        if($connexion > 0){
            
            // On vérifie si le mdp entré correspond au mdp hashé en BDD
            if(!password_verify($_POST["mdp"], $connexion["mdp"])){
                $erreurs++;
                header("location:../pages/index.php?error=0");
                // Mdp incorrect
            }elseif ($connexion["idposte"] == 3) {
                $erreurs++;
                header("location:../pages/index.php?error=2");
                // l'utilisateur n'a pas été accépté par l'administrateur
            }
        }else{
            $erreurs++;
            header("location:../pages/index.php?error=0");
            //mail non existant
        }
    }else{
        $erreurs++;
        header("location:../pages/index.php?error=1");
    }

    // On vérifie si le nombre d'erreur est de 0 pour connecter l'utilisateur et créer sa session
    if($erreurs == 0){
        // On connecte l'utilisateur en utilisant le $_SESSION
        $_SESSION = $connexion;
        if(isset($_POST["memory"])){
            $token = bin2hex(random_bytes(15));
            $utilisateur->token($_SESSION["idUtilisateur"], $token);
            setcookie("memory", $_SESSION["idUtilisateur"] . "-" . $token, time()+60*60*24*30, "/", "myteam.ipssi-sio.fr", true, true);
        }

        if($_SESSION["first_connexion"] == 0){
            header("location:../pages/accueil.php");
        }
        else{
            header("location:../pages/first_connexion.php");
        }
    }
}
?>