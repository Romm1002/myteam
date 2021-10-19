<?php
require_once "../traitements/header.php";
require_once "../traitements/ajoutUtilisateur.php";

$Administration = new Administration();

$Administration->recuperationPostes();

?>

    <div class="container">
        <h1>Ajout</h1>
        <form method="POST" onsubmit="inscription()">
            <div class="form-group d-flex flex-row">
                <div class="mr-3 w-100">
                    <label for="nom" class="form-control-lg mb-0">Nom</label>
                    <input type="text" class="form-control form-control" id="nom" name="nom" placeholder="Entrer votre nom" value="<?=(isset($nom) ? $nom : "")?>" required>    
                </div>
                <div class="w-100">
                    <label for="prenom" class="form-control-lg mb-0">Prénom</label>
                    <input type="text" class="form-control form-control" id="prenom" name="prenom" placeholder="Entrer votre prénom" value="<?=(isset($prenom) ? $prenom : "")?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="form-control-lg mb-0">Adresse email</label>
                <input type="email" class="form-control form-control" id="email" name="email" placeholder="Adresse email" value="<?=(isset($email) ? $email : "")?>" required>
            </div>
            <div class="form-group">
                <label for="datenaiss" class="form-control-lg mb-0">Date de naissance</label>
                <input type="date" class="form-control form-control" id="datenaiss" name="datenaiss" value="<?=(isset($datenaiss) ? $datenaiss : "")?>" required>
            </div>
            <div class="form-group d-flex ">
                <div class="mr-3 w-100">
                    <label for="mdp" class="form-control-lg mb-0">Mot de passe</label>
                    <input type="password" class="form-control form-control" id="mdp" name="mdp" placeholder="mot de passe"> 
                    <img src="images/eye.png" onclick="togglePassword('mdp')" class="field-icon">
                </div>
                <div class="w-100">
                    <label for="Cmdp" class="form-control-lg mb-0">Confirmation</label>
                    <input type="password" class="form-control form-control" id="Cmdp" name="Cmdp" placeholder="Confirmer">
                    <img src="images/eye.png" onclick="togglePassword('Cmdp')" class="field-icon">
                </div>
            </div>
            <div class="text-center d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-info btn w-25" name="envoi" value="1" onclick="inscription()">Envoyer</button>
            </div>
        </form>
    </div>
    
    <script src="../pages/scripts/fonction.js"></script>