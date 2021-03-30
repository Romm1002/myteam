<?php
// Redirection en fonction du grade du membre connecté.
if(!empty($_SESSION["poste"])){
    $grade = $_SESSION["grade"];
    if($grade == 0){
        header("location:visiteurs.php");
    }elseif($grade > 0) {
        header("location:accueil.php");
    }
}

// Tableau d'erreurs lors de la connexion.
$erreurs = [];

// Vérification si les champs de connexion de sont pas vides.
if(isset($_POST["envoi"]) && !empty($_POST["envoi"] && $_POST["envoi"]==1)){
    if(!empty($_POST["email"]) && !empty($_POST["mdp"])){
        extract($_POST);

        // Vérification si l'email est valide
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erreurs[]="L'adresse email saisie n'est pas valide";
        }
        
        // Vérification si le mdp est valide (plus de 8 caractères)
        // if(strlen($mdp) < 8){
        //     $erreurs[]="Le mot de passe doit faire au moins 8 caractères";
        // }

        $connexion = connexion($email);
        //on verifie qu'il n'y a aucune erreur pour optimiser les requetes
        if(count($erreurs) == 0){
            connexion($email);
            // Vérification si l'email existe en BDD
            if(connexion($email) > 0){
                $utilisateur = connexion($email);
                // Vérification si le mdp entrer correspond au mdp dans la BDD.
                if(!password_verify($mdp,$utilisateur["mdp"])){
                    $erreurs[]="Le mot de passe saisi est icorrect";
                }
            }else{
                $erreurs[]="L'adresse email saisie n'existe pas";
            }
        }

    }else{
        $erreurs[]="Au moins un champs n'a pas été saisi";
    }

    // Si le nombre d'erreurs est à 0:
    if(count($erreurs)=== 0){
        // On connecte l'utilisateur avec une session et on le redirige vers la page correspondante à son grade.
        $_SESSION = $utilisateur;
        header("location:index.php");
    }else{
    // Affichage des erreurs possibles
        ?>
        <div class="alert alert-danger mt-3" style="z-index:999">
            Erreur<?=(count($erreurs)>1 ? "s" :"")?> : 
            <?php
                foreach($erreurs as $erreur){
                    echo($erreur);
                    ?>
                    <br>
                    <?php
                }
            ?>
        </div>
<?php
    }
}
?>