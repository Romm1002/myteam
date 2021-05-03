<?php
require_once "../traitements/header.php";
?>

<head>
    <link rel="stylesheet" href="../pages/styles/styleConnexion.css">
</head>

<body>
    <!-- Background de fond -->
    <video src="../pages/images/bgConnexion.mp4" muted autoplay loop></video>

    <img id="logoConnexion" src="images/logoMYTEAM/logo.svg" alt="Logo de MyTeam" width="200">


    <div class="container-connexion">
        <div class="connexion-header">
            <h1>Connexion</h1>
        </div>
        <div class="connexion-content">
            <form action="../traitements/connexion.php" method="post">
                <label for="email">Adresse email </label>
                <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" value="<?=(isset($email) ? $email : "")?>" required>

                <label for="mdp">Mot de passe</label>
                <input type="password" id="mdp" name="mdp" placeholder="Mot de passe"  required>
                <img src="../pages/images/eye.png" onclick="togglePassword('mdp')" class="field-icon" width="25">

                <a href="../pages/inscription.php">Vous n'êtes pas encore inscrit ? C'est ICI !</a>
            </div>
        <div class="connexion-footer">
                <button type="submit" name="envoi" value="1">Se connecter</button>
            </form>
        </div>
    </div>
</body>

<?php
// Affichage des erreurs en fonction du GET
if(!empty($_GET)){
    if($_GET["error"] == "invalideEmail"){
        ?>
        <div class="alert alert-danger">
            L'adresse e-mail saisi est invalide !
        </div>
        <?php
    }else if($_GET["error"] == "mdp"){
        ?>
        <div class="alert alert-danger">
            Le mot de passe saisi est incorrect !
        </div>
        <?php
    }else if($_GET["error"] == "emailInexistant"){
        ?>
        <div class="alert alert-danger">
            L'adresse e-mail saisi n'existe pas !
        </div>
        <?php
    }else if($_GET["error"] == "empty"){
        ?>
        <div class="alert alert-danger">
            Tous les champs ci-dessous sont obligatoires !
        </div>
        <?php
    }
}

?>
