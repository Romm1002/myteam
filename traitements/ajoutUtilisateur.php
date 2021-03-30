<?php

//verif du grade
if($_SESSION["grade"]!=10){
    header("location:index");
}

$erreurs=[];

if(isset($_POST["envoi"]) && !empty($_POST["envoi"])){
    // On vérifie que les champs du formulaire ne sont pas vides et existent.
    if(isset($_POST["email"]) && !empty($_POST["email"])
    && isset($_POST["mdp"]) && !empty($_POST["mdp"])
    && isset($_POST["Cmdp"]) && !empty($_POST["Cmdp"])
    && isset($_POST["nom"]) && !empty($_POST["nom"])
    && isset($_POST["prenom"]) && !empty($_POST["prenom"])
    && isset($_POST["datenaiss"]) && !empty($_POST["datenaiss"])){
                extract($_POST);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $erreurs[]="L'addresse email saisie n'est pas valide";
                }
                
                if(recuperationEmail($email) > 0){
                    $erreurs[]="L'addresse email saisie existe deja";
                }
                //verif mdp
                if($mdp !== $Cmdp){
                    $erreurs[]="Les mots de passes saisis ne sont pas identiques";
                }
                if(strlen($mdp) < 8){
                    $erreurs[]="Le mot de passe doit faire au moins 8 caractères";
                }
        }else{
            $erreurs[]="Au moins un champs n'a pas été saisi";
        }
        if(count($erreurs) === 0){
            //aucune erreur, envoie du formulaire
            try{
                
                extract($_POST);
                $mdp = password_hash($mdp, PASSWORD_BCRYPT);
                newUtilisateur($nom, $prenom, $datenaiss, $email, $mdp, 1, "images/photoProfil.jpg");
                ?>
                <div class="alert alert-success mt-3 index-50">
                    L'inscription a bien été enregistré
                </div>
                <?php
                }catch(Exception $e){?>
                <div class="alert alert-danger mt-3 index-50">
                    $erreurs
            Erreur : L'inscritpion n'a pas été enregistré <br>
            </div>
    <?php
            }
        }else{
            //affichage des erreurs
            ?>
            <div class="alert alert-danger mt-3 index-50">
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
?>