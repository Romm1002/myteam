<?php
require_once "../pages/header.php";
require_once "../traitements/connected.php";
require_once "../modeles/Modele.php";

$Utilisateurs = new Utilisateurs();
if(isset($_COOKIE["memory"])){
    $connexion_token = $Utilisateurs->connexion_token($_COOKIE["memory"]);
    if($connexion_token > 0){
        $_SESSION = $connexion_token;
        header("location:../pages/accueil.php");
    }
}
?>

<head>
    <link rel="stylesheet" href="../pages/styles/styleConnexion.css">
</head>

<body>
    <img src="../pages/images/logoMYTEAM/logo_white_large.png" alt="Logo de MYTeam" id="logoConnexion">

    <div class="container-connexion">
        <div class="connexion-header">
            <h1>Connexion</h1>
        </div>
        <div class="connexion-content">
            <form action="../traitements/connexion.php" method="post" id="myForm" class="myForm">
                <label for="email">Adresse email </label>
                <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" required>

                <label for="mdp">Mot de passe</label>
                <input type="password" id="mdp" name="mdp" placeholder="Mot de passe"  required>
                <img src="../pages/images/eye.png" onclick="togglePassword('mdp')" class="field-icon">

                <div style="display: flex; align-items: center; margin-top: 10px">
                    <input type="checkbox" id="memory" name="memory" style="margin-right: 10px">
                    <p style="margin-bottom: 0px;">Se souvenir de moi</p>
                </div>
                <div class="g-recaptcha" data-sitekey="6LdRsk4eAAAAAIZGmOn5C9dTJaYzf__iatnf-ffk"></div>

                <a id="goto" href="../pages/inscription.php">Nouveau sur MYTeam ? Rejoignez-nous !</a>

            </div>
        <div class="connexion-footer">
                <button type="submit" name="envoi" value="1">Se connecter</button>
            </form>
        </div>
    </div>
</body>

<script src="scripts/scriptCaptcha.js"></script>

<?php
// Affichage des erreurs en fonction du GET
if(!empty($_GET)){
    if($_GET["error"] == "0"){
        ?>
        <div class="alert alert-danger">
            L'adresse e-mail ou le mot de passe est incorrect !
        </div>
        <?php
    }else if($_GET["error"] == "1"){
        ?>
        <div class="alert alert-danger">
            Tous les champs ci-dessous sont obligatoires !
        </div>
        <?php
    }else if($_GET["error"] == "2"){
        ?>
        <div class="alert alert-danger">
            Vous n'avez pas encore été accepté par les administrateurs de MyTeam. Attendez quelques temps et réessayez.
        </div>
        <?php
    }
}
?>