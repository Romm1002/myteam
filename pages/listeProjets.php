<?php
require_once "../traitements/header.php";
require_once "../traitements/listeProjets.php";

$informationsProfil = profil($_SESSION["idUtilisateur"]);
selectionProjets();
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
                <h1 class="mt-4">Les projets en cours</h1>
                <hr>

                <div class="projets">
                        <?php
                        foreach(selectionProjets() as $projet){
                        ?>
                        <div class="card">
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
                        ?>
                </div>
                
            </div>
        </section>
    </main>
</body>

<?php
?>