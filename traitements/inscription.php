<?php
// Tableau d'erreurs lors de la connexion.
$erreurs = [];

if(!empty($_POST["envoi"])){
    // On vérifie que les champs du formulaire ne sont pas vides et existent.
    if(!empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["Cmdp"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["datenaiss"])){
        extract($_POST);

        // Vérification si l'email est valide
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erreurs[]="L'addresse email saisie n'est pas valide";
        }
        // Récupération des informations de la BDD pour savoir si les infos transmises sont uniques
        inscription($email);
        // Si l'adresse email existe en BDD = erreur
        if(inscription($email) > 0){
            $erreurs[]="L'addresse email saisie existe deja";
        }
        // Vérification du mot de passe (identique et longueur)
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
            insertionInscription($_POST["nom"], $_POST["prenom"],$_POST["datenaiss"], $_POST["email"], $mdp, 1, "../pages/images/avatar/photoProfil.jpg");
                ?>
                <div class="alert alert-success mt-3 index-50">
                    L'inscription a bien été enregistré
                </div>
                <?php
        }catch(Exception $e){
            ?>
            <div class="alert alert-danger mt-3 index-50">
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