<?php
require_once "../pages/header.php";
require_once "../traitements/connected.php";

$Utilisateurs = new Utilisateurs();
$Modele = new Modele();
$maintenance = $Modele->maintenance()["maintenance"];
    
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
    }else if($_GET["error"] == "3"){
        ?>
        <div class="alert alert-danger">
            Le site est en maintenance. Vous pouvez vous connecter uniquement si vous êtes un administrateur.
        </div>
        <?php
    }
}


if($maintenance == 1){
    ?>
    <div class="alert alert-primary d-flex align-items-center alert-dismissible fade show position-absolute" style="max-width: 350px; top: 20px; right: 20px" role="alert">
        <svg class="bi flex-shrink-0 me-2 mr-3" width="24" height="24" role="img" aria-label="Info:"><use class="mr-2" xlink:href="#info-fill"/></svg>
        <div>
            Le site est actuellement en maintenance. Vous pouvez vous connecter uniquement si vous êtes un administrateur.
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}
?>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>