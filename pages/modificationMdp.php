<?php
require_once "../pages/header.php";
require_once "../traitements/notConnected.php";
require_once "../traitements/redirection_first_connexion.php";

if(!empty($_GET)){
    if($_GET["validate"] == "no"){
        ?>
        <div class="alert alert-danger">
            Les mots de passe ne correspondent pas ou sont inférieurs à 8 caractères !
        </div>
        <?php
    }else if($_GET["validate"] == "error"){
        ?>
        <div class="alert alert-danger">
            Une erreur à eu lieu. Veuillez réessayer !
        </div>
        <?php
    }else if($_GET["validate"] == "yes"){
        ?>
        <div class="alert alert-success">
            Votre mot de passe à bien été modifié !
        </div>
        <?php
    }else if($_GET["validate"] == 2){
        ?>
        <div class="alert alert-danger">
            Le mot de passe doit contenir, au minimum, une minuscule, une majuscule, un chiffre et un caractère spécial.
        </div>
        <?php
    }else if($_GET["validate"] == 3){
        ?>
        <div class="alert alert-danger">
            Votre mot de passe actuel n'est pas correct.
        </div>
        <?php
    }
}
?>

<head>
    <link rel="stylesheet" href="../pages/styles/styleModificationMdp.css">
</head>

<body>
    <!-- Logo MyTeam -->
    <img src="../pages/images/logoMYTEAM/logo.svg" alt="Logo de MyTeam" width="220">

    <!-- Décorations d'arrière plan -->
    <div class="circle1"></div>
    <div class="circle2"></div>

    <!-- Conteneur de la modification du MDP -->
    <div class="container-mdp">
        <div class="container-header">
            <a href="../pages/accueil.php?page=profil">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            <h1>Modifier son mot de passe</h1>
        </div>
        <div class="container-content">
            <form action="../traitements/modificationMdp.php" method="post">
                <div class="mdp">
                    <label for="oldMdp">Mot de passe actuel</label>
                    <input type="password" name="oldMdp" placeholder="Mot de passe actuel" required>
                </div>
                <div class="mdp">
                    <label for="newMdp">Nouveau mot de passe</label>
                    <input type="password" name="newMdp" placeholder="Nouveau mot de passe" required>
                </div>
                <div class="mdp">
                    <label for="repeatMdp">Répétez le nouveau mot de passe</label>
                    <input type="password" name="repeatMdp" placeholder="Répétez le nouveau mot de passe">
                </div>
        </div>
        <div class="container-footer">
                <button type="submit">Modifier</button>
            </form>
        </div>
    </div>
</body>