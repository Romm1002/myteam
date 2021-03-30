<?php
require_once "../traitements/header.php";
?>

<head>
    <link rel="stylesheet" href="css/styleInscription&Connexion.css">
</head>

<body class="d-flex justify-content-center">
<a href="index.php">
    <img src="images/logoMYTEAM/logo.svg" id="logoIndex">
</a>

<video muted autoplay loop id="BgInscription">
    <source src="images/Bg.mp4" type="video/mp4">
</video>

<div id="formInscription">
    <h1>Inscription</h1>
    <form method="POST">
        <div class="form-group d-flex">
            <div class="mr-2">
                <label for="nom" class="form-control-lg mb-0">Nom</label>
                <input type="text" class="form-control form-control-lg" id="nom" name="nom" placeholder="Entrer votre nom" value="<?=(isset($nom) ? $nom : "")?>" required>    
            </div>
            <div>
                <label for="prenom" class="form-control-lg mb-0">Prénom</label>
                <input type="text" class="form-control form-control-lg" id="prenom" name="prenom" placeholder="Entrer votre prénom" value="<?=(isset($prenom) ? $prenom : "")?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="form-control-lg mb-0">Adresse email</label>
            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Adresse email" value="<?=(isset($email) ? $email : "")?>" required>
        </div>

        <div class="form-group">
            <label for="datenaiss" class="form-control-lg mb-0">Date de naissance</label>
            <input type="date" class="form-control form-control-lg" id="datenaiss" name="datenaiss" value="<?=(isset($datenaiss) ? $datenaiss : "")?>" required>
        </div>

        <div class="form-group d-flex">
            <div class="mr-2">
                <label for="mdp" class="form-control-lg mb-0">Mot de passe</label>
                <input type="password" class="form-control form-control-lg" id="mdp" name="mdp" placeholder="mot de passe"> 
                <img src="images/eye.png" onclick="togglePassword('mdp')" class="field-icon">
            </div>
            <div>
                <label for="Cmdp" class="form-control-lg mb-0">Confirmation</label>
                <input type="password" class="form-control form-control-lg" id="Cmdp" name="Cmdp" placeholder="Confirmer">
                <img src="images/eye.png" onclick="togglePassword('Cmdp')" class="field-icon">
            </div>
        </div>

        <div class="text-center d-flex justify-content-center flex-column mt-4">
        <a href="index.php" class="mb-3 lien">Tu as déjà un compte ?</a>
            <button type="submit" class="btn btn-info btn-lg" name="envoi" value="1">Envoyer</button>
        </div>
    </form>
</div>
</body>

<?php
require_once "../traitements/inscription.php";