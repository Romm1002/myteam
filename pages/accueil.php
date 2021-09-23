<?php
require_once "../traitements/header.php";
require_once "../traitements/accueil.php";
require_once "../traitements/planification.php";
require_once "../traitements/notConnected.php";

$Utilisateurs = new Utilisateurs();
$membres = $Utilisateurs->users();
$Publication = new Publication();
$Services = new Services();

$informationsProfil = $Utilisateurs->profil($_SESSION["idUtilisateur"]);
$publications = $Publication->publications();

$InfosProfil = new InfoProfils();
$Projets = new Projets();

$Projets->selectionProjets();
?>

<head>
    <link rel="stylesheet" href="../pages/styles/styleAccueil.css">
</head>

<body>
    <div class="container-accueil">
        <div class="accueil-left">
            <div class="left-actions">
                <!-- Bouton de déconnexion -->
                <a href="../pages/deconnexion.php" title="Se déconnecter">
                    <img src="images/power.png" class="btnDeconnexion" alt="Bouton de déconnexion" width="35">
                </a>
                <!-- Bouton accès à l'administration si le idPoste est à 3 qui correspond à ADMIN -->
                <?php
                if($informationsProfil["idposte"] == 2){
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
                    <a href="../pages/accueil.php?page=planification">
                        <li>Planification</li>
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
                <a href="#top" class="rocket">
                    <img src="images/rocket.png" alt="Retour top" width="35">
                    <span>La fusée permet de revenir au début des publications !</span>
                </a>

                <div class="right-header">
                    <form action="#" method="post">
                        <img src="<?=$informationsProfil["photoProfil"];?>" width="50" height="50">
                        <input type="text" id="nouvellePublication" placeholder="Commencer un post" readonly onclick="openPublications()">
                    </form>
                </div>
                <div class="right-content" id="right-content">
                    <a name="top" id="top"></a>
                    <?php
                    foreach($publications as $publication){
                        ?>
                        <div class="carte-publication" style="<?=$publication["typePublication"] == "annonce" ? "background: #739bff" : "";?>" id="publication<?=$publication["idPublication"];?>">
                            <div class="publication-header">
                                <div class="header-left">
                                    <img src="<?=$publication["photoProfil"];?>" alt="Photo de profil de <?=$informationsProfil["nom"] . $informationsProfil["prenom"];?>" width="40" height="40">
                                    <p><?=$publication["nom"] . " " . $publication["prenom"];?></p>
                                </div>
                                <div class="header-right">
                                    <p><?php 
                                        echo substr($publication['datePublication'], 8, 2) . "/" . substr($publication["datePublication"], 5, 2) . "/" . substr($publication["datePublication"], 0, 4) . " à " . substr($publication["datePublication"], 11, 2) . "h" . substr($publication["datePublication"], 14, 2);
                                    ?></p>
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
                                <hr>
                                <label for="reponse">Commentaires : </label>
                                <form action="../traitements/repondre.php" method="POST">
                                    <textarea name="reponse" cols="80" rows="5" placeholder="Laissez un commentaire à cette publication !"></textarea>
                                    <button type="submit" name="id" value="<?=$publication["idPublication"];?>">Répondre</button>
                                </form>
                                <hr class="hr2">
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
            // Projets
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
                                <img src="<?=$projet["image"];?>" alt="Image d'illustration" width="100">
                            </div>
                            <div class="card-title">
                                <h2>
                                    <?=$projet["nomProjet"];?>
                                </h2>
                                <p>Créer le <?=substr($projet["dateDebut"], 8, 2) . "/" . substr($projet["dateDebut"], 5, 2) . "/" . substr($projet["dateDebut"], 0, 4);?></p>
                                <p>Fin le <?=substr($projet["dateFin"], 8, 2) . "/" . substr($projet["dateFin"], 5, 2) . "/" . substr($projet["dateFin"], 0, 4);?></p>
                                <p>Salariés concernés :</p>
                                <p><?=$projet["descriptionProjet"];?></p>
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
                        <div class="user" id="<?php echo "user" . $user["idUtilisateur"];?>">
                            <i class='fas fa-plus'></i>

                            &nbsp;

                            <?php echo  $user["nom"] . ", " . $user['prenom'];?>

                            &nbsp;&nbsp;

                                <?php
                                if($Services->rowCountService($user['idUtilisateur']) >= 1){
                                    echo '<span style="color: grey; font-weight: 400">[' . $user['nomService'] . ']</span>';
                                }
                                ?>
                        </div>
                    </div>
                    <?php
                    foreach($Utilisateurs->affectations($user["idUtilisateur"]) as $projet){
                        $datePlanif = clone $date;
                        ?>
                        <div class="nom_projet" id="<?=$user['idUtilisateur'];?>">
                            <div class="projet">
                                <?php
                                echo "&#10132;" . " " . $projet["nomProjet"];
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
                                    $plannifications = $Projets->plannifications($user["idUtilisateur"], $datePlanif);
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
                            
                            foreach($Utilisateurs->affectations($user["idUtilisateur"]) as $projet){
                                $datePlanif = clone $date;
                                ?>
                                <div class="ligne" style="background-color: rgb(221, 221, 221);">
                                    <?php
                                    for($k=0; $k<$nb_day_per_month; $k++){
                                        $dateIndex = $datePlanif->format("dmY");
                                        ?>
                                        <div class="detail <?= in_array($datePlanif->format('N') == 6 || $datePlanif->format('N') == 7, $jours_grises) ? "grey" : "";?>">
                                            <?php
                                            if(isset($affectationByDateAndProject[$dateIndex][$projet["idProjet"]])){
                                                echo '<p id="ratio_p" style="background: lightblue; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; margin-bottom: 0px">' . number_format($affectationByDateAndProject[$dateIndex][$projet['idProjet']], 1, ',', '') . "</p>";
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
            
            <div class="autres">
                <i class="fas fa-poll"></i>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="../pages/fonction.js"></script>
    <script src="../pages/script_overflow.js"></script>
</body>
