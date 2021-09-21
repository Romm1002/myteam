<?php
require_once "../traitements/header.php";
require_once "../traitements/equipe.php";
$Administration = new Administration();
$Projets = new Projets();

?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
<link rel="stylesheet" href="../pages/styleAdministration.css">

<body>
    <div class="navigation">
        <div class="navigation-header">
            <i class="fas fa-users-cog"></i>
            <h1>Administration</h1>
        </div>
        <div class="navigation-content">
            <ul>
                <a href="../pages/equipe.php?pages=membre">
                    <li>
                        <i class="fas fa-users"></i>    
                        Membres
                    </li>
                </a>
                <a href="../pages/equipe.php?pages=projets">
                    <li>
                        <i class="fas fa-project-diagram"></i>    
                        Projets
                    </li>
                </a>
                <a href="../pages/equipe.php?pages=messagerie">
                    <li>
                        <i class="fas fa-comments"></i>
                        Messagerie
                    </li>
                </a>
                <a href="../pages/equipe.php?pages=publications">
                    <li>
                        <i class="fas fa-retweet"></i>
                        Publications
                    </li>
                </a>  
            </ul>
        </div>
        <div class="navigation-footer">
            <a href="../pages/accueil.php" title="Retour à l'accueil">
                <i class="fas fa-arrow-left"></i>
                <p>Retour</p>
            </a>
        </div>
    </div>

    <div class="flex-column">
        <div class="informations">
            <div class="cards">
                <div class="infos">
                    <div class="info-header">
                        <i class="fas fa-user-friends"></i>
                        <h5 id="h5card1">Membres inscrits</h5>
                    </div>
                    <div class="info-content">
                        <p><?=$Administration->membresInscrits();?></p>
                    </div>
                    <div class="info-footer">
                        <div class="green-round"></div>
                        <p>À jour</p>
                    </div>
                </div>
                <div class="infos">
                    <div class="info-header">
                        <i class="fas fa-project-diagram"></i>
                        <h5 id="h5card2">Projets en cours</h5>
                    </div>
                    <div class="info-content">
                        <p><?=$Administration->ProjetsEnCours();?></p>
                    </div>
                    <div class="info-footer">
                        <div class="green-round"></div>
                        <p>À jour</p>
                    </div>
                </div>
                <div class="infos">
                    <div class="info-header">
                        <i class="fas fa-satellite-dish"></i>
                        <h5 id="h5card3">Messages échangés</h5>
                    </div>
                    <div class="info-content">
                        <p><?=$Administration->MessagesEchanges()?></p>
                    </div>
                    <div class="info-footer">
                        <div class="green-round"></div>
                        <p>À jour</p>
                    </div>
                </div>
                <div class="infos">
                    <div class="info-header">
                        <i class="fas fa-retweet"></i>
                        <h5 id="h5card4">Publications envoyées</h5>
                    </div>
                    <div class="info-content">
                        <p><?=$Administration->publicationEnvoyees()?></p>
                    </div>
                    <div class="info-footer">
                        <div class="green-round"></div>
                        <p>À jour</p>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Gestion de l'affichage de l'administration en fonction du GET
        if(!empty($_GET)){
            if($_GET["pages"] == "membre"){
                ?>
                <div class="gestion">
                    <div class="gestion-header">
                        <div class="titre-header">
                            <h1>Gestion des membres</h1>
                        </div>
                        <div class="search-header">
                            <form method="post">
                                <input type="text" name="chercherMembre" id="chercherMembre" placeholder="Filtre...">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>


                    </div>
                    <div class="gestion-content">
                        <table>
                            <thead>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Adresse e-mail</th>
                                <th>Poste</th>
                                <th>Date de naissance</th>
                                <th>Gérer</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach($membres as $membre){
                                    ?>
                                    <tr id="<?=$membre["idUtilisateur"];?>">
                                        <td><?=$membre["idUtilisateur"];?></td>
                                        <td>
                                            <?=$membre["nom"];?>
                                            <button onclick="changeInputType('nom<?=$membre['idUtilisateur'];?>')">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <input type="hidden" id="nom<?=$membre["idUtilisateur"];?>" name="nom<?=$membre["idUtilisateur"];?>" value="<?=$membre["nom"];?>">
                                        </td>
                                        <td>
                                            <?=$membre["prenom"];?>
                                            <button onclick="changeInputType('prenom<?=$membre['idUtilisateur'];?>', event)">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <input type="hidden" id="prenom<?=$membre["idUtilisateur"];?>" name="prenom<?=$membre["idUtilisateur"];?>" value="<?=$membre["prenom"];?>">
                                        </td>
                                        <td>
                                            <?=$membre["email"];?>
                                            <button onclick="changeInputType('email<?=$membre['idUtilisateur'];?>', event)">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <input type="hidden" id="email<?=$membre["idUtilisateur"];?>" name="email<?=$membre["idUtilisateur"];?>" value="<?=$membre["email"];?>">
                                        </td>
                                        <td><?=$membre["poste"];?></td>
                                        <td><?=substr($membre["dateNaiss"], 8, 2) . " " . $Administration->dateMois(substr($membre["dateNaiss"], 5, 2)) . " " . substr($membre["dateNaiss"], 0, 4);?></td>
                                        <td id="gerer_membre">
                                            <a href="#">Modifier</a>
                                            <a href="#">Supprimer</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="gestion-footer"></div>
                </div>
                <?php
            }else if($_GET["pages"] == "messagerie"){
                ?>
                <div class="gestion">
                    <div class="gestion-header">
                        <h1>Historique des derniers message échangés</h1>
                    </div>
                    <div class="gestion-content">
                        <table>
                            <thead>
                                <th>N°</th>
                                <th>Envoyeur</th>
                                <th>Receveur</th>
                                <th>Contenu</th>
                                <th>Heure</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach($Administration->recuperationMessages() as $message){
                                    ?>
                                    <tr>
                                        <td><?=$message["idMessage"];?></td>
                                        <td><?=$message["envoyeur"];?></td>
                                        <td><?=$message["receveur"];?></td>
                                        <td><?=$message["contenu"];?></td>
                                        <td><?=substr($message["heure"], 8, 2) . " " . $Administration->dateMois(substr($message["heure"], 5, 2)) . " " . substr($message["heure"], 0, 4) . " à " . substr($message["heure"], 11, 5);?></td>
                                        <td>
                                            <a class="deleteMessage" href="../traitements/deleteMessage.php?idMessage=<?=$message["idMessage"];?>">SUPPRIMER</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            }else if($_GET["pages"] == "projets"){
                ?>
                <div class="gestion">
                    <div class="gestion-header">
                        <h1>Les projets en cours</h1>
                    </div>
                    <div class="gestion-content cards">
                        <?php
                        foreach($Projets->selectionProjets() as $projet){
                            ?>
                            <div class="projet-card">
                                <div class="card-hero">
                                    <img src="<?php echo $projet["image"];?>" alt="Image d'illustration" width="100%">
                                </div>
                                <div class="card-header">
                                    <h1><?php echo $projet["nomProjet"];?></h1>
                                </div>
                                <div class="card-content">
                                    <p><?php echo $projet["descriptionProjet"];?></p>
                                </div>
                                <div class="card-footer">
                                    <p><?php echo "Du " . $projet["dateDebut"] . " au " . $projet["dateFin"];?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                </div>
                <?php
            }
        }

            ?>
    </div>


    <script src="scriptAdministration.js"></script>
</body>