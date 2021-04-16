<?php
require_once "../traitements/header.php";
require_once "../traitements/equipe.php";
$Administration = new Administration();
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
                            <form action="#" method="post">
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
                                <th>Date de naissance</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach($Administration->membres() as $membre){
                                    ?>
                                    <tr id="<?=$membre["idUtilisateur"];?>">
                                        <td><?=$membre["idUtilisateur"];?></td>
                                        <td><?=$membre["nom"];?></td>
                                        <td><?=$membre["prenom"];?></td>
                                        <td><?=$membre["email"];?></td>
                                        <td><?=substr($membre["dateNaiss"], 8, 2) . " " . $Administration->dateMois(substr($membre["dateNaiss"], 5, 2)) . " " . substr($membre["dateNaiss"], 0, 4);?></td>
                                        <td>
                                            <button type="button" onclick="modifierMembres()">Modifier</button>
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
            }
        }
            ?>
    </div>
</body>