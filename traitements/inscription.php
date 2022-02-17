<?php
require_once "../modeles/Modele.php";

$Utilisateurs = new Utilisateurs();

// Redirection si le membre est déjà connecté
if(!empty($_SESSION)){
    header("location:../pages/index.php");
}

$erreurs = 0;

function password_strength($password) {
	$returnVal = True;

	if ( strlen($password) < 8 ) {
		$returnVal = False;
	}

	if ( !preg_match("#[0-9]+#", $password) ) {
		$returnVal = False;
	}

	if ( !preg_match("#[a-z]+#", $password) ) {
		$returnVal = False;
	}

	if ( !preg_match("#[A-Z]+#", $password) ) {
		$returnVal = False;
	}

	if ( !preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $password) ) {
		$returnVal = False;
	}

	return $returnVal;
}

// Vérifications pour envoyer le formulaire de connexion // Si les champs ne sont pas vides
if(!empty($_POST["envoi"]) && $_POST["envoi"] == 1){
    if(!empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["Cmdp"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["datenaiss"])){

        // Vérification si l'email est valide
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $erreurs++;
            header("location:../pages/inscription.php?error=invalideEmail");
            // mail invalide
        }

        // Récupération des informations de la BDD pour savoir si les infos transmises sont uniques
        $inscription = $Utilisateurs->verification_email($_POST["email"]);
        if($inscription > 0){
            $erreurs++;
            header("location:../pages/inscription.php?error=emailExistant");
            //mail existant
        }

        $ageMinimal = date("Y") - 18;
        $ageMaximal = date("Y") - 100;

        if(substr($_POST["datenaiss"], 0, 4) > $ageMinimal){
            $erreurs++;
            header("location:../pages/inscription.php?error=agemoins");
            // trop jeune
        }

        if(substr($_POST["datenaiss"], 0, 4) < $ageMaximal){
            $erreurs++;
            header("location:../pages/inscription.php?error=ageplus");
            // trop vieux
        }

        // Vérification du mot de passe (identique)
        if($_POST["mdp"] !== $_POST["Cmdp"]){
            $erreurs++;
            header("location:../pages/inscription.php?error=notSamePasswords");
            //mdp pas identiques
        }

        // On vérifit la force du mdp
        if( !preg_match("#[0-9]+#", $_POST["mdp"])){
            $erreurs++;
            header("location:../pages/inscription.php?error=notStrong");
        }
    
        if(!preg_match("#[a-z]+#", $_POST["mdp"])){
            $erreurs++;
            header("location:../pages/inscription.php?error=notStrong");
        }
    
        if(!preg_match("#[A-Z]+#", $_POST["mdp"])){
            $erreurs++;
            header("location:../pages/inscription.php?error=notStrong");
        }
    
        if(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $_POST["mdp"])){
            $erreurs++;
            header("location:../pages/inscription.php?error=notStrong");
        }

        // Vérification de la longueur du mdp
        if(strlen($_POST["mdp"]) < 8){
            $erreurs++;
            header("location:../pages/inscription.php?error=passwordLen");
            //mdp pas assez long
        }

        // Vérification de la checkbox des CdU
        if(!isset($_POST["conditions_utilisations"])){
            $erreurs++;
            header("location:../pages/inscription.php?error=checkbox");
            // checkbox des conditions d'utilisations n'est pas cochée
        }
    }else{
        $erreurs++;
        header("location:../pages/inscription.php?error=empty");
        //champs vides
    }

    // Si il n'y a aucune erreur
    if($erreurs == 0){
        try{
            // Hashage du mdp
            $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT);

            // On insère les données du formulaire en BDD
            $Utilisateurs->inscription($_POST["nom"], $_POST["prenom"], $_POST["datenaiss"], filter_var($_POST["email"], FILTER_SANITIZE_EMAIL), $mdp, 3, "../pages/images/avatar/photoProfil.jpg", 0);
            header("location:../pages/inscription.php?error=no");
        }catch(Exception $e){
            header("location:../pages/inscription.php=error=yes");
        }
    }
}