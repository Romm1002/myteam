<?php
require_once "../traitements/header.php";

$informationsProfil = profil($_SESSION["idUtilisateur"]);

if(!empty($_GET)){
    if(!empty($_GET["validate"]) == "NOsame"){
        ?>
        <div class="alert alert-danger mt-3 index-50 position-absolute w-50 text-center">
            Vos mots de passe ne sont pas identiques !
        </div>
        <?php
    }else if(!empty($_GET["validate"]) == "NOlength"){
        ?>
        <div class="alert alert-danger mt-3 index-50 position-absolute w-50 text-center">
            Vos mots de passe font moins de 8 caractères !
        </div>
        <?php
    }
}

?>
<body>

    <main>
        
        <div class="circle1"></div>
        <div class="circle2"></div>

        <section class="glass">
            <div class="dashboard">

                <a href="deconnexion.php">
                    <img src="images/power.png" class="btnDeconnexion" alt="Bouton de déconnexion" width="35">
                </a>
                <?php
                if(($informationsProfil["idposte"]) == 3){
                    ?>
                    <a href="equipe.php">
                        <img src="images/admin.png" class="btnAdmin" alt="Bouton accès administration" width="35">
                    </a>
                    <?php
                }
                ?>


                <div class="user">
                    <img src="<?=$informationsProfil["photoProfil"];?>" class="photoDeProfil mb-1" alt="Photo de profil de <?=$informationsProfil["nom"] . " " . $informationsProfil["prenom"];?>" width="70" height="70">
                    <h3 class="h2"><?=$informationsProfil["nom"] . " " . $informationsProfil["prenom"];?></h3>
                    <p class="m-0 text-muted"><?=$informationsProfil["poste"];?></p>
                </div>

                <div class="links">
                    <ul class="h5">
                        <a href="accueil.php">
                            <li class="mb-3">Accueil</li>
                        </a>
                        <a href="calendrier.php">
                            <li class="mb-3">Emploi du temps</li>
                        </a>
                        <a href="listeProjets.php">
                            <li class="mb-3">Projets</li>
                        </a>
                        <a href="profil.php">
                            <li class="mb-3">Profil</li>
                        </a>
                    </ul>
                </div>

                <div class="messagerie">
                    <a href="messagerie.php" class="btn">Messagerie</a>
                </div>
            </div>

            <div class="reseau">
                <div class="modificationMotDePasse">

                    <h1 class="mt-4">Modification du mot de passe</h1>
                    <hr>
        
                    <form action="../traitements/modificationMdp.php" method="post">
                        <label for="mdp">Nouveau mot de passe</label>
                        <input type="password" name="mdp" id="mdp" placeholder="Nouveau mot de passe...">
        
                        <label for="confirmationMdp">Nouveau mot de passe</label>
                        <input type="password" name="confirmationMdp" id="confirmationMdp" placeholder="Confirmation...">

                        <button type="submit">Modifier</button>
                    </form>
                </div>

            </div>
        </section>
    </main>
</body>