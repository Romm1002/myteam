<?php
require_once "../traitements/header.php";
require_once "../traitements/accueil.php";
require_once "../traitements/notConnected.php";

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
            // L'accueil
            if(empty($_GET)){
            ?>
                <!-- Fusée qui permet de revenir au début de publications -->
                <a name="top" id="top"></a>
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
                        <div class="carte-publication <?=$publication["typePublication"] == "annonce" ? "bg-primary" : "";?>" id="publication<?=$publication["idPublication"];?>">
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


                                <div class="content-actions">
                                    <div class="actions">
                                        <form action="../traitements/like.php" method="post">
                                            <button type="submit" name="buttonJaime" value="<?=$publication["idPublication"];?>">J'aime</button>
                                        </form>
                                        <p>&nbsp;&#8226;&nbsp;</p>
                                        <a id="<?=$publication["idPublication"];?>" href="#">
                                            <button type="button" onclick="showRepondre('publication-reponse<?=$publication['idPublication'];?>')">Commentaires</button>
                                        </a>
                                    </div>
                                    <div class="jaime">
                                        <i class="far fa-thumbs-up"></i>
                                        <p><?=$publication["jaime"];?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="publication-reponses" id="publication-reponse<?=$publication["idPublication"];?>" style="display: none;">
                                <label for="reponse">Commentaires : </label>
                                <form action="../traitements/repondre.php" method="POST">
                                    <textarea name="reponse" cols="80" rows="5" placeholder="Laissez un commentaire à cette publication !"></textarea>
                                    <button type="submit" name="id" value="<?=$publication["idPublication"];?>">Répondre</button>
                                </form>
                                    <?php
                                    $reponses = $Publication->reponses($publication["idPublication"]);
                                    foreach($reponses as $reponse){
                                        ?>
                                        <div class="reponse">
                                            <div class="reponse-header">
                                                <img src="<?=$reponse["photoProfil"];?>" alt="Photo de profil" width="40" height="40">
                                                <h6><?=$reponse["nom"] . " " . $reponse["prenom"];?></h6>
                                            </div>
                                            <div class="reponse-content">
                                                <p><?=$reponse["reponse"];?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php
            // Profil
            }else if($_GET["page"] == "profil"){
                ?>
                <div class="profil-header">
                    <h1>Paramètres de votre profil</h1>
                </div>
                <div class="profil-content">
                    <form action="../traitements/profil.php" method="post" enctype="multipart/form-data">
                        <div class="content-nom content-box">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" placeholder="Nom..." value="<?=$informationsProfil["nom"];?>" required>
                        </div>
                        <div class="content-prenom content-box">
                            <label for="prenom">Prénom</label>
                            <input type="text" name="prenom" placeholder="Prénom..." value="<?=$informationsProfil["prenom"];?>" required>
                        </div>
                        <div class="content-pdp content-box">
                            <label for="pdp">Photo de profil</label>
                            <input type="file" name="pdp">
                        </div>
                        <div class="content-email content-box">
                            <label for="email">Adresse e-mail</label>
                            <input type="email" name="email" placeholder="Adresse e-mail..." value="<?=$informationsProfil["email"];?>" required>
                        </div>
                        <div class="content-mdp content-box">
                            <label for="mdp">Mot de passe</label>
                            <a href="../pages/modificationMdp.php">Modifier votre mot de passe</a>
                        </div>
                </div>
                <div class="profil-footer">
                        <button type="submit">Modifier mon profil</button>
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
