<?php
require_once "../pages/header.php";
require_once "../traitements/notConnected.php";
require_once "../traitements/redirection_first_connexion.php";
require_once "../traitements/accueil.php";
require_once "../traitements/planification.php";

?>

<head>
    <link rel="stylesheet" href="../pages/styles/styleAccueil.css">
</head>

<style>
    .couleurPerso{
        background-color: <?=$_SESSION["color"];?>;
    }
</style>

<body>
    <div class="circle1 couleurPerso"></div>
    <div class="circle2 couleurPerso"></div>

    <div id="footer">
        <a href="mentions_legales.php">mentions légales</a>
    </div>
    <div class="container-accueil">
        <div class="accueil-left">
            <div class="left-actions">
                <!-- Bouton de déconnexion -->
                <a href="../pages/deconnexion.php" title="Se déconnecter">
                    <img src="images/power.png" class="btnDeconnexion" alt="Bouton de déconnexion" width="35">
                </a>
            </div>
            <div class="left-header">
                <img src="<?=$utilisateur->getPhotoProfil();?>" alt="Photo de profil de <?=htmlspecialchars($utilisateur->getNom()) . htmlspecialchars($utilisateur->getPrenom());?>" width="70" height="70" onclick="window.location = '../pages/accueil.php?page=profil'">
                <p id="nomAndPrenom" onclick="window.location = '../pages/accueil.php?page=profil'"><?=htmlspecialchars($utilisateur->getPrenom()) . " " . htmlspecialchars($utilisateur->getNom());?></p>
                <p id="poste"><?=$utilisateur->getPoste();?></p>
            </div>
            <div class="left-content">
                <ul>
                    <a href="../pages/accueil.php">
                        <li>Accueil</li>
                    </a>
                    <a href="../pages/planning.php">
                        <li>Planning</li>
                    </a>
                    <a href="../pages/accueil.php?page=planification">
                        <li>Planification</li>
                    </a>
                    <a href="../pages/accueil.php?page=projets">
                        <li>Projets</li>
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
                <a href="#top" class="rocket">
                    <img src="images/rocket.png" alt="Retour top" width="35">
                    <span>La fusée permet de revenir au début des publications !</span>
                </a>

                <div class="right-header">
                    <form action="#" method="post">
                        <img src="<?=$utilisateur->getPhotoProfil();?>" width="50" height="50">
                        <input type="text" id="nouvellePublication" placeholder="Commencer un post" readonly onclick="openPublications()">
                    </form>
                </div>
                <div class="right-content" id="right-content">
                    <a name="top" id="top"></a>
                    <?php
                    foreach($publications as $publication){
                        ?>
                        <div class="carte-publication" style="<?=$publication->getType() == "annonce" ? "background: #739bff" : "";?>" id="publication<?=$publication->getId();?>">
                            <div class="publication-header">
                                <div class="header-left">
                                    <img src="<?=$publication->getUtilisateur()->getPhotoProfil();?>" alt="Photo de profil de <?=$utilisateur->getNom() . $utilisateur->getPrenom();?>" width="40" height="40">
                                    <p><?=htmlspecialchars($publication->getUtilisateur()->getNom()) . " " . htmlspecialchars($publication->getUtilisateur()->getPrenom());?></p>
                                </div>
                                <div class="header-right">
                                    <p><?php 
                                        echo substr($publication->getDate(), 8, 2) . "/" . substr($publication->getDate(), 5, 2) . "/" . substr($publication->getDate(), 0, 4) . " à " . substr($publication->getDate(), 11, 2) . "h" . substr($publication->getDate(), 14, 2);
                                    ?></p>
                                </div>
                            </div>
                            <div class="publication-content">
                                <p><?=htmlspecialchars($publication->getContenu());?></p>


                                <div class="content-actions">
                                    <div class="actions">
                                        <form action="../traitements/like.php" method="post">
                                            <?php
                                            if(!$publication->isLiked($utilisateur->getId())){
                                                ?>
                                                <button type="submit" name="buttonJaime" value="<?=$publication->getId();?>">J'aime</button>
                                                <?php
                                            }else{
                                                ?>
                                                <button type="submit" name="buttonJaime" value="<?=$publication->getId();?>">Je n'aime plus</button>
                                                <?php
                                            }
                                            ?>
                                        </form>
                                        <p>&nbsp;&#8226;&nbsp;</p>
                                        <a id="<?=$publication->getId();?>" href="#">
                                            <button type="button" onclick="showRepondre('publication-reponse<?=$publication->getId();?>')">Commentaires</button>
                                        </a>
                                    </div>
                                    <div class="jaime">
                                        <i class="far fa-thumbs-up"></i>
                                        <p><?=$publication->getJaime();?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="publication-reponses" id="publication-reponse<?=$publication->getId();?>" style="display: none;">
                                <hr>
                                <label for="reponse">Commentaires : </label>
                                <form action="../traitements/repondre.php" method="POST">
                                    <textarea name="reponse" cols="80" rows="5" placeholder="Laissez un commentaire à cette publication !"></textarea>
                                    <button type="submit" name="id" value="<?=$publication->getId();?>">Répondre</button>
                                </form>
                                <hr class="hr2">
                                    <?php
                                    $reponses = $publication->reponses($publication->getId());
                                    foreach($publication->reponses() as $reponse){
                                        ?>
                                        <div class="reponse">
                                            <div class="reponse-header">
                                                <img src="<?=$reponse->getUtilisateur()->getPhotoProfil();?>" alt="Photo de profil" width="40" height="40">
                                                <h6><?=htmlspecialchars($reponse->getUtilisateur()->getNom()) . " " . htmlspecialchars($reponse->getUtilisateur()->getPrenom());?></h6>
                                            </div>
                                            <div class="reponse-content">
                                                <p><?=htmlspecialchars($reponse->getReponse());?></p>
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
                        <div class="content-nom">
                            <div class="content-1">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" placeholder="Nom..." value="<?=htmlspecialchars($utilisateur->getNom());?>" required>
                            </div>

                            <div class="content-1">
                                <label for="prenom">Prénom</label>
                                <input type="text" name="prenom" placeholder="Prénom..." value="<?=htmlspecialchars($utilisateur->getPrenom());?>" required>
                            </div>
                        </div>
                        <div class="content-pdp content-box">
                            <label for="pdp">Photo de profil</label>
                            <input type="file" name="pdp">
                        </div>
                        <div class="content-email content-box">
                            <label for="email">Adresse e-mail</label>
                            <input type="email" name="email" placeholder="Adresse e-mail..." value="<?=htmlspecialchars($utilisateur->getEmail());?>" required>
                        </div>
                        <div class="content-mdp content-box">
                            <label for="mdp">Mot de passe</label>
                            <a href="../pages/modificationMdp.php">Modifier votre mot de passe</a>
                        </div>
                        <div class="content-color content-box">
                            <label for="color">Couleur du profil</label>
                            <input type="color" name="color">
                        </div>
                        <div class="content-suppression content-box">
                            <a id="supprimer_compte" href="../traitements/suppression_compte.php">Supprimer mon compte</a>
                        </div>
                </div>
                <div class="profil-footer">
                        <button type="submit">Modifier mon profil</button>
                    </form>
                </div>
                <?php
            // Projets
            }else if($_GET["page"] == "projets"){
                ?>
                <div class="projets-header">
                    <h1>Liste de projets</h1>
                </div>
                <div class="projets-content">
                <?php
                foreach($listProjet as $projet){
                ?>
                <div class="carte">
                    <div class="carte-image">
                        <img src="<?=$projet->getImage();?>" alt="Image d'illustration" width="100">
                    </div>
                    <div class="max-width">
                        <div class="flex">
                            <div class="carte-titre">
                                <h1><?=htmlspecialchars($projet->getNom());?></h1>
                            </div>
                            <div class="carte-statut">
                                <?php
                                $date = date("Y-m-d");
                                if($projet->getDateDebut() > $date){
                                    echo "<div class='circle-blue' title='Projet non commencé'></div>";
                                }
                                else if($projet->getDateDebut() < $date && $projet->getDateFin() > $date || $projet->getDateDebut() < $date && $projet->getDateFin() == $date || $projet->getDateDebut() == $date && $projet->getDateFin() > $date){
                                    echo "<div class='circle-green' title='Projet en cours'></div>";
                                }
                                else if($projet->getDateFin() < $date){
                                    echo "<div class='circle-red' title='Projet terminé'></div>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="carte-contenu">
                            <p><?=htmlspecialchars($projet->getDescription());?></p>
                            <p>Début du projet le : <?=substr($projet->getDateDebut(), 8, 2) . "/" . substr($projet->getDateDebut(), 5, 2) . "/" . substr($projet->getDateDebut(), 0, 4)?></p>
                            <p>Fin du projet le : <?=substr($projet->getDateFin(), 8, 2) . "/" . substr($projet->getDateFin(), 5, 2) . "/" . substr($projet->getDateFin(), 0, 4)?></p>
                        </div>
                        <a href="../pages/projets.php?id=<?=$projet->getId();?>">En savoir plus</a>
                    </div>
                </div>
                <?php
                }
            }else if($_GET["page"] == "planification"){
                ?>
                <section class="main_div">
            <div class="top_left">
                <p>Employés</p>
            </div>
            <div class="top_right" id="top_right">
                <?php
                $dateColonnes = clone $date;
                for($i=0; $i<$nb_day_per_month; $i++){
                    if(!empty($_POST["date_debut"])){
                        $dateColonnes = new DateTime($_POST["date_debut"]);
                        $date = new DateTime($_POST["date_debut"]);
                        for($i=0; $i<$nb_day_per_month; $i++){
                            ?>
                            <div class="date">
                                <?php
                                switch($dateColonnes->format("D")){
                                    case "Mon":
                                        echo "Lu <br>";
                                        break;
                                    case "Tue":
                                        echo "Ma <br>";
                                        break;
                                    case "Wed":
                                        echo "Me <br>";
                                        break;
                                    case "Thu":
                                        echo "Je <br>";
                                        break;
                                    case "Fri":
                                        echo "Ve <br>";
                                        break;
                                    case "Sat":
                                        echo "Sa <br>";
                                        break;
                                    case "Sun":
                                        echo "Di <br>";
                                        break;
                            }
                                echo substr($dateColonnes->format("D d/m"), 4, 5);
                                ?>
                            </div>
                            <?php
                            $dateColonnes->add(new DateInterval('P1D'));
                        }
                    }else{
                        ?>
                        <div class="date <?=in_array($dateColonnes->format('N') == 6 || $dateColonnes->format('N') == 7, $jours_grises) ? "grey" : "";?>">
                            <?php
                            switch($dateColonnes->format("D")){
                                case "Mon":
                                    echo "Lu <br>";
                                    break;
                                case "Tue":
                                    echo "Ma <br>";
                                    break;
                                case "Wed":
                                    echo "Me <br>";
                                    break;
                                case "Thu":
                                    echo "Je <br>";
                                    break;
                                case "Fri":
                                    echo "Ve <br>";
                                    break;
                                case "Sat":
                                    echo "Sa <br>";
                                    break;
                                case "Sun":
                                    echo "Di <br>";
                                    break;
                        }
                            echo substr($dateColonnes->format("D d/m"), 4, 5);
                            ?>
                        </div>
                        <?php
                    }
                    $dateColonnes->add(new DateInterval('P1D'));
                }
                ?>
                <div style="min-width: 17px"></div>
            </div>
            <div class="bottom_left" id="bottom_left">
                <?php
                foreach($membres as $user){
                    ?>
                    <div class="bl_ligne">
                        <div class="user" id="<?php echo "user" . $user->getId();?>">
                            <i class='fas fa-plus'></i>

                            &nbsp;

                            <?php echo  htmlspecialchars($user->getNom()) . ", " . htmlspecialchars($user->getPrenom());?>

                            &nbsp;&nbsp;
                        </div>
                    </div>
                    <?php
                    foreach($user->getParticipations() as $projet){
                        $datePlanif = clone $date;
                        ?>
                        <div class="nom_projet" id="<?=$user->getId();?>">
                            <div class="projet">
                                <?php
                                echo "&#10132;" . " " . htmlspecialchars($projet->getNom());
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="divMedia"></div>
            </div>
            <div class="bottom_right" id="bottom_right" onscroll="overflowY()">
                <div class="contenu" id="contenu">

                <?php
                    foreach($membres as $user){
                        $datePlanif = clone $date;
                    
                        ?>
                        <div class="classMain" id="classMain">
                            <?php
                            $affectationByDateAndProject = [];
                            ?>
                            <div class="ligne_total">
                            <?php
                                for($j=0; $j<$nb_day_per_month; $j++){
                                    $plannifications = $user->plannifications($datePlanif);
                                    $total = 0;
                                    $dateIndex = $datePlanif->format('dmY');
                                    foreach($plannifications as $plannification){
                                        if(!isset($affectationByDateAndProject[$dateIndex])){
                                            $affectationByDateAndProject[$dateIndex] = [];
                                        }
                                        $total += $plannification['ratio'];
                                        $affectationByDateAndProject[$dateIndex][$plannification['idProjet']] = $plannification['ratio'];
                                    }
                                    ?>
                                        <div class="total <?php echo ($total <= 0.5) ? 'red' : (($total < 1) ? 'yellow' : 'green');?> <?=in_array($datePlanif->format('N') == 6 || $datePlanif->format('N') == 7, $jours_grises) ? "grey" : "";?>">
                                            <?php
                                            if(in_array($datePlanif->format('N') == 6 || $datePlanif->format('N') == 7, $jours_grises)){
                                                echo "";
                                            }else{
                                                echo $total;
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    $datePlanif->add(new DateInterval('P1D'));
                                }
                            ?>
                            </div>
                            <?php
                            
                            foreach($user->getParticipations() as $projet){
                                $datePlanif = clone $date;
                                ?>
                                <div class="ligne" style="background-color: rgb(221, 221, 221);">
                                <script src="../pages/scripts/script_planification.js"></script>
                                    <?php
                                    for($k=0; $k<$nb_day_per_month; $k++){
                                        $dateIndex = $datePlanif->format("dmY");
                                        ?>
                                        <div class="detail <?= in_array($datePlanif->format('N') == 6 || $datePlanif->format('N') == 7, $jours_grises) ? "grey" : "";?>" ondblclick="window.location = 'accueil.php?page=planification&popup=ratio&date=<?=$dateIndex;?>&id=<?=$user->getId();?>&projet=<?=$projet->getId();?>'">
                                            <?php
                                            if(isset($affectationByDateAndProject[$dateIndex][$projet->getId()])){
                                                echo '<p id="ratio_p" style="background: lightblue; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; margin-bottom: 0px">' . number_format($affectationByDateAndProject[$dateIndex][$projet->getId()], 1, ',', '') . "</p>";
                                            }else{
                                                echo "";
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        $datePlanif->add(new DateInterval('P1D'));
                                    }
                                    ?>
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
        </section>
                <?php
        }
            ?>
        </div>
    </div>
            



    <!-- Pop-up d'une nouvelle publication -->
    <div class="clickPublications" id="clickPublications" style="display: none;">
        <div class="newPub">
            <div class="header">
                <h1>Créer un post</h1>
                <p onclick="closePublications()">	&#10006;</p>
            </div>

            <hr>

            <div class="profil">
                <img src="<?=$utilisateur->getPhotoProfil();?>" width="40" height="40">
                <div class="npp">
                    <p><?=$utilisateur->getPrenom() . " " . $utilisateur->getNom();?></p>
                    <small><?=$utilisateur->getPoste();?></small>
                </div>
            </div>
                        
            <form method="post">
                <div class="contenu">
                        <textarea id="textarea" name="nouvellePublication" placeholder="De quoi souhaitez-vous discuter ?"></textarea>
                        <button type="button" onclick="ajoutHashtag()">Ajouter un hashtag</button>
                        <button type="submit" onclick="closePublications()">Publier</button>      
                </div>

                <div class="interactionsUtilisateur">
                    <input type="radio" name="typePost" class="typePost" id="annonce" value="annonce">
                    <label for="annonce">Créer une annonce</label>
                    <input type="radio" name="typePost" class="typePost" id="projet" checked value="simple">
                    <label for="projet">Créer un post simple</label>
                </div>  
            </form>
        </div>
    </div>

    <?php

    if(isset($_GET["popup"]) && $_GET["popup"] == "ratio"){
        ?>
        <div id="blackScreen">
            <div class="content">
                <div class="content-header">
                    <h3>Nouveau ratio</h1>
                    <p onclick="window.location = 'accueil.php?page=planification'">x</p>
                 </div>
                <div class="content-content">
                    <form action="../traitements/planification.php" method="post">
                        <input type="hidden" name="id" value="<?=$_GET["id"];?>">
                        <input type="hidden" name="idProjet" value="<?=$_GET["projet"];?>">
                        <input type="hidden" name="date" value="<?=$_GET["date"];?>">
                        <input type="number" name="ratio" placeholder="Entrez un ratio" max="<?= 1 - $total;?>" min="<?=0;?>" value="<?= 1 - $total;?>" step="0.1">
                        <button type="submit" name="send_ratio">OK</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    if(isset($_GET["error"]) && $_GET["error"] == "noaccess"){
        ?>
        <div class="alert alert-danger" style="position: absolute; bottom: 2%; left: 2%">
            Vous n'avez pas la permission de modifier le ratio d'un autre utilisateur !
        </div>
        <?php
    }
    ?>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="../pages/scripts/fonction.js"></script>
    <script src="../pages/scripts/script_overflow.js"></script>
</body>