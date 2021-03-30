<?php
require_once "../traitements/header.php";
$details = detailsProjets($_GET["idProjet"]);
$informationsProfil = profil($_SESSION["idUtilisateur"]);

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

            <div class="container">
        <!-- <a href="accueil.php" class="btn btn-danger btn-small float-right my-3">Retour à l'accueil</a> -->
        <h1 class="my-5">Détails du projet : <?=$details["nomProjet"];?></h1>
        <ul class="list-group">
            <li class="list-group-item border border-dark">
                <h4>Nom du projet</h4>
                <?=$details["nomProjet"];?>
            </li>
            <li class="list-group-item border border-dark">
                <h4>Membres participants au projet</h4>
                <?=$details["membresProjet"];?>
            </li>
            <li class="list-group-item border border-dark">
                <h4>Description du projet</h4>
                <?=$details["descriptionProjet"];?>
            </li>
            <li class="list-group-item border border-dark">
                <h4>Date de début</h4>
                <?=$details["dateDebut"];?>
            </li>
            <li class="list-group-item border border-dark">
                <h4>Date de fin</h4>
                <?=$details["dateFin"];?>
                
            </li>
        </ul>
    </div>
            </div>
        </section>
    </main>


</body>