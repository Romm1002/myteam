<?php
require_once "../traitements/header.php";
require_once "../traitements/accueil.php";

$Publication = new Publication();
$InfosProfil = new InfoProfils();

$publications = $Publication->publications($filtre);
$informationsProfil = $InfosProfil->profil($_SESSION["idUtilisateur"]);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
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
                    <a href="equipe.php?pages=membre">
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

            <a name="top"></a>

            <a href="#top" class="rocket">
                <img src="images/rocket.png" alt="Retour top" width="35">
                <span>La fusée permet de revenir au début des publications !</span>
            </a>

                <div class="publications">
                    <form method="post">
                        <div class="writePublication">
                            <img src="<?=$informationsProfil["photoProfil"];?>" width="50" height="50">
                            <input type="text" id="nouvellePublication" placeholder="Commencer un post" readonly onclick="openPublications()">
                        </div>
                    </form>
                    <div class="footer">
                        <hr>
                        <p>Classer par : </p>
                        <button type="submit" onclick="filtreCroissant()">Plus récent</button>
                        <button type="submit" onclick="filtreDecroissant()">Moins récent</button>
                    </div>
                </div>



                

                <div class="main-section" id="main-section">
                <?php
                foreach($publications as $publication){
                ?>
                            <div class="carte <?=$publication["typePublication"] == "annonce" ? "bg-primary" : "";?>" id="carte"> 
                                <div>
                                    <img src="<?=$publication["photoProfil"];?>" class="photoDeProfil" alt="Photo de profil" width="40" height="40">
                                    <strong>
                                        <span class="h5 mt-1">
                                            <?=$publication["nom"] . " " . $publication["prenom"];?>
                                        </span>
                                    </strong> 
                                </div>
        
                                <br>
                                <br>
                                <br>
        
                                <p class="contenuPublication"><?=$publication["contenuPublication"];?></p>
                            
                                <small class="text-muted mr-4"><?=$publication["datePublication"];?></small>
                            </div>
                            <?php
                }
                ?>
                </div>
            </div>
        </section>

        <section>
            <div class="clickPublications" id="clickPublications">
                <div class="newPub">
                    <div class="header">
                        <p onclick="closePublications()">	&#10006;</p>
                        <h1>Créer un post</h1>
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
                        <label for="projet">Créer une post simple</label>
                        </form>
                    </div>
                    
                </div>
            </div>
        </section>
    </main>


</body>
