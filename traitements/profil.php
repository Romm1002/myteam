<?php
require_once "../modeles/Modele.php";

$erreurs = [];
if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"])){
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $erreurs[]="L'adresse email saisie n'est pas valide";
    }
    if($utilisateur->verification_email($_POST["email"]) > 0 && $_POST["email"] != $utilisateur->getEmail()){
        $erreurs[]="L'adresse email saisie existe deja";
    }

    if(count($erreurs) === 0){
        //aucune erreur, envoie du formulaire
        try{
            $utilisateur->updateProfil($_POST["nom"], $_POST["prenom"], $_POST["email"]);
            if(!empty($_FILES["pdp"]) && !empty($_FILES["pdp"]["name"])){
                $allowed =  array('gif','png' ,'jpg');
                $target_dir = "../pages/images/avatar/";
                $imageFileType = strtolower(pathinfo($_FILES["pdp"]["name"], PATHINFO_EXTENSION));
                $target_file = $target_dir . $utilisateur->getId() . "." . $imageFileType;
                
                if(in_array($imageFileType, $allowed) ) {
                    move_uploaded_file($_FILES["pdp"]["tmp_name"], $target_file);
                    $utilisateur->updatePhotoProfil($target_file);
                }
            }
            $_SESSION = $utilisateur->connexion($utilisateur->getEmail());
            header("location:../pages/accueil.php?page=profil&validate=OK");
        }catch(Exception $e){
            header("location:../pages/accueil.php?page=profil&validate=NO");
        }
    }else{
        //affichage des erreurs
        ?>
        <div class="alert alert-danger mt-3 index-50 mx-5">
            Erreur : 
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

