<?php
require_once "../pages/header.php";
require_once "../traitements/notConnected.php";
require_once "../traitements/first_connexion.php";



if($utilisateur->getBoolFirstConnexion() == 0){
    header("location:../pages/accueil.php");
}
?>

<head>
    <link rel="stylesheet" href="styles/styleFirstConnexion.css">
</head>

<body>
    <div class="circle1"></div>
    <div class="circle2"></div>

    <div class="container-first-connexion">
        <h1>Changer votre mot de passe</h1>

        <form method="post">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" name="password" placeholder="Nouveau mot de passe" required>

            <label for="confirmation_password">Confirmez votre mot de passe</label>
            <input type="password" name="confirmation_password" placeholder="Confirmez votre mot de passe" required>

            <button type="submit" name="send" value="1">VALIDER</button>
        </form>
    </div>
</body>

<?php
if(isset($_GET["error"])){
    switch($_GET["error"]){
        case 0:
            ?>
            <div class="alert alert-danger">
                Les mots de passe ne correspondent pas
            </div>
            <?php
            break;
        case 1:
            ?>
            <div class="alert alert-danger">
                Le mot de passe doit contenir au minimum 8 caractères
            </div>
            <?php
            break;
        case 2:
            ?>
            <div class="alert alert-danger">
                Le mot de passe doit contenir au minimum une minuscule, une majucule, un chiffre et un caractère spécial.
            </div>
            <?php
    }
}
?>