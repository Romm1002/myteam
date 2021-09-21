<?php
require_once "../modeles/modele.php";
$InfosProfil = new Utilisateurs();
// if(empty($_SESSION["grade"]) || $_SESSION["grade"] < 1){
//     header("location:index.php");
// }

$erreurs = [];
if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"])){
    extract($_POST);
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erreurs[]="L'adresse email saisie n'est pas valide";
    }
    $InfosProfil->modificationEmail($email);
    if($InfosProfil->modificationEmail($email) > 0 && $email != $_SESSION["email"]){
        $erreurs[]="L'adresse email saisie existe deja";
    }

    if(count($erreurs) === 0){
        //aucune erreur, envoie du formulaire
        try{
            extract($_POST);
            $InfosProfil->updateProfil($nom, $prenom, $email, $_SESSION["idUtilisateur"]);
            if(!empty($_FILES["pdp"]) && !empty($_FILES["pdp"]["name"])){
                $target_dir = "../pages/images/avatar/";
                $target_file = $target_dir . ($_FILES["pdp"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                move_uploaded_file($_FILES["pdp"]["tmp_name"], $target_file);
                
                $InfosProfil->updatePhotoProfil($target_file, $_SESSION["idUtilisateur"]);
            }
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


