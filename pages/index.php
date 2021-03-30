<?php
require_once "../traitements/header.php";
require_once "../traitements/connexion.php";
?>

<head>
    <link rel="stylesheet" href="css/styleInscription&Connexion.css">
</head>

<body class="d-flex justify-content-center">
<a href="index.php" id="logoIndex">
    <img src="images/logoMYTEAM/logo.svg">
</a>

<video muted autoplay loop id="BgConnexion">
    <source src="images/Bg.mp4" type="video/mp4">
</video>

<div id="formConnexion">
    <h1>Connexion</h1>
    <form method="post">
        <div class="form-group">
            <label for="email" class="form-control-lg mb-0">Adresse email </label>
            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Entrer votre adresse email" value="<?=(isset($email) ? $email : "")?>" required>
        </div>
        <div class="form-group">
            <label for="mdp" class="form-control-lg mb-0">Mot de passe</label>
            <input type="password" class="form-control form-control-lg" id="mdp" name="mdp" placeholder="Mot de passe"  required>
            <img src="images/eye.png" onclick="togglePassword('mdp')" class="field-icon">
        </div>
        <div class="text-center d-flex justify-content-center flex-column">
            <a href="inscription.php" class="mb-3 lien">Vous n'êtes pas encore inscrit ?</a>
            <button type="submit" class="btn btn-info btn-lg" name="envoi" value="1">Se connecter</button>
        </div>
    </form>
</div>
</body>

<?php
require_once "../traitements/connexion.php";
?>