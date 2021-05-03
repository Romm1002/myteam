<?php
require_once "../traitements/header.php";
require_once "../traitements/profil.php";

$InfosProfil = new InfoProfils();

$informationsProfil = $InfosProfil->profil($_SESSION["idUtilisateur"]);
?>

<head>
    <link rel="stylesheet" href="../pages/styles/styleProfil.css">
</head>

<body>
    <div class="circle1"></div>
    <div class="circle2"></div>

    <div class="container-profil">
        <div class="profil-left">
            <div class="left-actions">
                <!-- Bouton de déconnexion -->
                <a href="../pages/deconnexion.php" title="Se déconnecter">
                    <img src="images/power.png" class="btnDeconnexion" alt="Bouton de déconnexion" width="35">
                </a>
                <!-- Bouton accès à l'administration si le idPoste est à 3 qui correspond à ADMIN -->
                <?php
                if($informationsProfil["idposte"] == 3){
                    ?>
                    <a href="../pages/equipe.php?pages=membre" title="Accéder à l'administration">
                        <img src="images/admin.png" class="btnAdmin" alt="Bouton accès administration" width="35">
                    </a>
                    <?php
                }
                ?>
            </div>
            <div class="left-header">
                <img src="<?=$informationsProfil["photoProfil"];?>" alt="Photo de profil de <?=$informationsProfil["nom"] . $informationsProfil["prenom"];?>" width="65" height="65">
                <p id="nomAndPrenom"><?=$informationsProfil["prenom"] . " " . $informationsProfil["nom"];?></p>
                <p id="poste"><?=$informationsProfil["poste"];?></p>
            </div>
            <div class="left-content">
                <ul>
                    <a href="../pages/accueil.php">
                        <li>Accueil</li>
                    </a>
                    <a href="../pages/planning.php">
                        <li>Planning</li>
                    </a>
                    <a href="../pages/listeProjets.php">
                        <li>Projets</li>
                    </a>
                    <a href="../pages/profil.php">
                        <li>Profil</li>
                    </a>
                </ul>
            </div>
            <div class="left-footer">
                <a href="#">MESSAGERIE</a>
            </div>
        </div>

        <div class="profil-right">
            <?php
            if(empty($_GET)){
            ?>
                <!-- Fusée qui permet de revenir au début de publications -->
                <a name="top"></a>
                <a href="#top" class="rocket">
                    <img src="images/rocket.png" alt="Retour top" width="35">
                    <span>La fusée permet de revenir au début des publications !</span>
                </a>

                <div class="right-header">
                    <form action="#" method="post">
                        <img src="<?=$informationsProfil["photoProfil"];?>" width="50" height="50">
                        <input type="text" id="nouvellePublication" placeholder="Commencer un post" readonly onclick="openPublications()">
                    </form>

                    <div class="filtres">
                        <hr>
                        <p>Classer par : </p>
                        <button type="submit" onclick="filtreCroissant()">Plus récent</button>
                        <button type="submit" onclick="filtreDecroissant()">Moins récent</button>
                    </div>
                </div>
                <div class="right-content" id="right-content">
                    <?php
                    foreach($publications as $publication){
                        ?>
                        <div class="carte-publication <?=$publication["typePublication"] == "annonce" ? "bg-primary" : "";?>">
                            <div class="publication-header">
                                <div class="header-left">
                                    <img src="<?=$publication["photoProfil"];?>" alt="Photo de profil de <?=$informationsProfil["nom"] . $informationsProfil["prenom"];?>" width="40" height="40">
                                    <p><?=$publication["nom"] . " " . $publication["prenom"];?></p>
                                </div>
                                <div class="header-right">
                                    <p><?=$publication["datePublication"];?></p>
                                </div>
                            </div>
                            <div class="publication-content">
                                <p><?=$publication["contenuPublication"];?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>





<!-- <body>
<?php
if(!empty($_GET)){
    if(!empty($_GET["validate"] == "OK")){
    ?>
    <div class="alert alert-success mt-3 index-50 position-absolute w-50 text-center">
        Vos modifications ont bien été enregistrées !
    </div>
    <?php
    }else if(!empty($_GET["validate"] == "NO")){
    ?>
    <div class="alert alert-danger mt-3 index-50 position-absolute w-50 text-center">
        Erreur : Vos modifications n'ont pas été enregistrées !
    </div>
    <?php
    }
}
?>
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
                        <a href="planning.php">
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
                <h1 class="mt-4">Paramètre du compte</h1>
                <hr>
                <div class="profil">

                    <div class="labels">
                        <div class="nomPrenom">
                            <p>Nom / Prenom</p>
                        </div>

                        <div class="pdp">
                            <p>Photo de profil</p>
                        </div>

                        <div class="email">
                            <p>Adresse email</p>
                        </div>

                        <div class="mdp">
                            <p>Mot de passe</p>
                        </div>

                    
                    </div>

                    
                    <form action="../traitements/profil.php" method="post" enctype="multipart/form-data">

                        <div class="infosNomPrenom">
                            <input type="text" placeholder="Nom" name="nom" value="<?=$informationsProfil["nom"];?>">
                            <input type="text" placeholder="Prénom" name="prenom" value="<?=$informationsProfil["prenom"];?>">
                        </div>

                        <div class="infosPdp">
                            <img src="<?=$informationsProfil["photoProfil"];?>" alt="test" width="50" height="50" style="object-fit: cover">
                            <label for="file" class="label-file ml-3">Choisir une image</label>
                            <input id="file" class="input-file" type="file" name="pdp">
                        </div>

                        <div class="infosEmail">
                            <input type="email" placeholder="Adresse email" name="email" value="<?=$informationsProfil["email"];?>">
                        </div>

                        <div class="infosMdp">
                            <a href="modificationMdp.php">Modifier le mot de passe</a>
                        </div>

                        <button type="submit" id="btnProfil">Enregistrer les modifications</button>
                    </form>


                    
                    
                </div>
                
            </div>
            
        </section>
        
    </main>
</body> -->
