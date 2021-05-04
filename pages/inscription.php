<?php
require_once "../traitements/header.php";
require_once "../traitements/connected.php";
?>

<head>
    <link rel="stylesheet" href="../pages/styles/styleInscription.css">
</head>

<body>
    <!-- Background de fond -->
    <video src="../pages/images/bgConnexion.mp4" muted autoplay loop></video>

    <img id="logoInscription" src="images/logoMYTEAM/logo.svg" alt="Logo de MyTeam" width="200">


    <div class="container-inscription">
        <div class="inscription-header">
            <h1>Inscription</h1>
        </div>
        <div class="inscription-content">
            <form action="../traitements/inscription.php" method="post">
                <div class="form-ligne">
                    <div class="ligne-left">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" value="<?=(isset($nom) ? $nom : "")?>" required>
                    </div>
                    <div class="ligne-right">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" value="<?=(isset($prenom) ? $prenom : "")?>" required>
                    </div>
                </div>

                <div class="form-ligne-solo">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" placeholder="Adresse e-mail" value="<?=(isset($email) ? $email : "")?>" required>
                </div>

                <div class="form-ligne-solo">
                    <label for="datenaiss">Date de naissance</label>
                    <input type="date" id="datenaiss" name="datenaiss" value="<?=(isset($datenaiss) ? $datenaiss : "")?>" required>
                </div>

                <div class="form-ligne">
                    <div class="ligne-left">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" id="mdp" name="mdp" placeholder="Mot de passe"> 
                        <img src="images/eye.png" onclick="togglePassword('mdp')" id="mdp1" width="25">
                    </div>

                    <div class="ligne-right">
                        <label for="Cmdp">Confirmation</label>
                        <input type="password" id="Cmdp" name="Cmdp" placeholder="Confirmez">
                        <img src="images/eye.png" onclick="togglePassword('Cmdp')" id="mdp2" width="25">
                    </div>
                </div>

                <a href="../pages/index.php">Tu as déjà un compte ? C'est ICI !</a>
        </div>
        <div class="inscription-footer">
                <button type="submit" name="envoi" value="1">S'inscrire</button>
            </form>
        </div>
    </div>
</body>

<?php
if(!empty($_GET)){
    if($_GET["error"] == "invalideEmail"){
        ?>
        <div class="alert alert-danger">
            L'adresse e-mail saisi n'est pas valide !
        </div>
        <?php
    }else if($_GET["error"] == "notSamePasswords"){
        ?>
        <div class="alert alert-danger">
            Les mots de passe ne sont pas identiques !
        </div>
        <?php
    }else if($_GET["error"] == "passwordLen"){
        ?>
        <div class="alert alert-danger">
            Votre mot de passe fait moins de 8 caractères !
        </div>
        <?php
    }else if($_GET["error"] == "empty"){
        ?>
        <div class="alert alert-danger">
            Les champs ci-dessous ne peuvent pas être vides !
        </div>
        <?php
    }else if($_GET["error"] == "yes"){
        ?>
        <div class="alert alert-danger">
            Votre inscription à échouée ! Veuillez réessayer.
        </div>
        <?php
    }
    else if($_GET["error"] == "no"){
        ?>
        <div class="alert alert-success">
            L'inscription à été réalisée ! Vous pouvez désormais vous connectez !
        </div>
        <?php
    }
    
}
?>