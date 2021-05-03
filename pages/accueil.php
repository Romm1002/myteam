<?php
require_once "../traitements/header.php";
require_once "../traitements/accueil.php";

$Utilisateur = new Utilisateurs();
$Publication = new Publication();

$informationsProfil = $Utilisateur->profil($_SESSION["idUtilisateur"]);
$publications = $Publication->publications();

$InfosProfil = new InfoProfils();
$Projets = new Projets();

$informationsProfil = $InfosProfil->profil($_SESSION["idUtilisateur"]);
$Projets->selectionProjets();
?>

<head>
    <link rel="stylesheet" href="../pages/styles/styleAccueil.css">
</head>

<body>
    <div class="circle1"></div>
    <div class="circle2"></div>

    <div class="container-accueil">
        <div class="accueil-left">
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
                    <a href="../pages/accueil.php?page=projets">
                        <li>Projets</li>
                    </a>
                    <a href="../pages/accueil.php?page=profil">
                        <li>Profil</li>
                    </a>
                </ul>
            </div>
            <div class="left-footer">
                <a href="../pages/messagerie.php">MESSAGERIE</a>
            </div>
        </div>

        <div class="accueil-right">
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
            }else if($_GET["page"] == "profil"){
                if(!empty($_GET["validate"])){
                    if(!empty($_GET["validate"] == "OK")){
                    ?>
                    <div class="alert alert-success mt-3 position-absolute w-50 text-center">
                        Vos modifications ont bien été enregistrées !
                    </div>
                    <?php
                    }else if(!empty($_GET["validate"] == "NO")){
                    ?>
                    <div class="alert alert-danger mt-3 position-absolute w-50 text-center">
                        Erreur : Vos modifications n'ont pas été enregistrées !
                    </div>
                    <?php
                    }
                }
                ?>
                <div class="profil-header">
                    <h1>Paramètres de votre compte</h1>
                </div>
                <div class="profil-content">
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

                </div>
                <div class="profil-footer">
                        <button type="submit" id="btnProfil">Enregistrer les modifications</button>
                    </form>
                </div>
                <?php
            }else if($_GET["page"] == "projets"){
                ?>
                <div class="projets-header">
                    <h1>Liste de projets</h1>
                </div>
                <div class="projets-content">
                <?php
                        foreach($Projets->selectionProjets() as $projet){
                        ?>
                        <div class="carte">
                            <div class="card-image">
                                <img src="<?=$projet["image"];?>" alt="Image d'illustration">
                            </div>
                            <div class="card-title">
                                <h2>
                                    <?=$projet["nomProjet"];?>
                                </h2>
                                <p>Projet créé le <?=$projet["dateDebut"];?></p>
                            </div>
                            <div class="card-actions">
                                <a href="detailsProjets.php?idProjet=<?=$projet["idProjet"];?>">En savoir plus</a>
                            </div>
                        </div>
                        <?php
                        }
            }
            ?>
            
        </div>
    </div>

    <!-- Pop-up d'une nouvelle publication -->
    <div class="clickPublications" id="clickPublications">
        <div class="newPub">
            <div class="header">
                <h1>Créer un post</h1>
                <p onclick="closePublications()">	&#10006;</p>
            </div>

            <hr>

            <div class="profil">
                <img src="<?=$informationsProfil["photoProfil"];?>" width="40" height="40">
                <div class="npp">
                    <p><?=$informationsProfil["prenom"] . " " . $informationsProfil["nom"];?></p>
                    <small><?=$informationsProfil["poste"];?></small>
                </div>
            </div>
                        
            <div class="contenu">
                <form method="post">
                    <textarea id="textarea" name="nouvellePublication" placeholder="De quoi souhaitez-vous discuter ?"></textarea>
                    <button type="button" onclick="ajoutHashtag()">Ajouter un hashtag</button>
                    <button type="submit" onclick="closePublications()">Publier</button>      
            </div>

            <div class="interactionsUtilisateur">
                <input type="radio" name="typePost" class="typePost" id="annonce" value="annonce">
                <label for="annonce">Créer une annonce</label>
                <input type="radio" name="typePost" class="typePost" id="projet" checked value="simple">
                <label for="projet">Créer un post simple</label>
                </form>
            </div>          
        </div>
    </div>

    <script src="../pages/fonction.js"></script>
</body>
