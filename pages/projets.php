<?php
require_once "../pages/header.php";
require_once "../traitements/notConnected.php";
require_once "../traitements/projets.php";
require_once "../traitements/redirection_first_connexion.php";


?>

<head>
    <link rel="stylesheet" href="../pages/styles/styleProjets.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>

<body>
    <div class="circle1"></div>
    <div class="circle2"></div>

    <div class="container">
        <div class="container-header">
            <div class="retour">
                <i class="fas fa-chevron-circle-left" onclick="window.location = 'accueil.php?page=projets'" title="Retourner à la liste des projets"></i>
            </div>
            <div class="titre">
                <h1><?=htmlspecialchars($projet->getNom());?></h1>
            </div>
            <div class="tache">
                <i class="fas fa-clipboard-list" title="Accéder au carnet des tâches du projet" onclick="openTaches()"></i>
            </div>
        </div>
        <div class="container-participants">
            <div class="titre">
                <h6>Ils participent au projet :</h6>
            </div>
            <div class="participants">
                <?php
                foreach($projet->selectionParticipants($_GET["id"]) as $user){
                    ?>
                    <div class="carte">
                        <div class="photo_profil">
                            <img src="<?=$user->getPhotoProfil();?>" alt="Photo de profil" width="35px" height="35px">
                        </div>
                        <div class="nom_prenom">
                            <div class="prenom">
                                <p><?=htmlspecialchars($user->getPrenom());?></p>
                            </div>
                            <div class="nom">
                                <p><?=htmlspecialchars($user->getNom());?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="container-chat">
            <div class="titre">
                <h6>Chat du projet :</h6>
            </div>
            <div class="chatbox">
                <?php
                foreach($chats as $chat){
                    ?>
                    <div style="justify-content:<?=$chat->getIdUtilisateur() == $utilisateur->getId() ? "flex-start" : "flex-end";?>" class="message">
                        <span class="<?=$chat->getIdUtilisateur() == $utilisateur->getId() ? "blue" : "grey";?>">
                            <div class="infos">
                                <img src="<?=$chat->getEnvoyeur()->getPhotoProfil();?>" alt="Photo de profil" width="25" height="25" style="object-fit: cover">
                                <?=htmlspecialchars($chat->getEnvoyeur()->getPrenom()) . " " . htmlspecialchars($chat->getEnvoyeur()->getNom());?>
                            </div>
                            <hr>
                            <div class="text">
                                <?=htmlspecialchars($chat->getContenu());?>
                            </div>
                        </span>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="container-message">
            <form action="../traitements/chatprojet.php" method="POST">
                <div class="left">
                    <input type="hidden" name="idProjet" value="<?=$_GET["id"];?>">
                    <input type="text" placeholder="Message..." name="newMessage">
                </div>
                <div class="right">
                    <button type="submit">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="scripts/scriptProjets.js"></script>

    <!-- Popup tâches du projet -->
    <div class="black-screen" id="black-screen" style="display: none;">
        <div class="container">
            <div class="top">
                <div class="left"></div>
                <div class="center">
                    <h1>Liste des tâches</h1>
                </div>
                <div class="right">
                    <i class="fas fa-times" onclick="closeTaches()"></i>
                </div>
            </div>
            <div class="middle">
                <table>
                    <th>N°</th>
                    <th>Libellé</th>
                    <th>Terminée</th>
                    <th>Action</th>

                    <?php
                    foreach($taches as $tache){
                        ?>
                        <tr>
                            <td><?=$tache->getId();?></td>
                            <td><?=htmlspecialchars($tache->getLibelle());?></td>
                            <td>
                                <?php
                                // Switch qui convertit 0 en "Non" et 1 en "Oui" pour savoir si le tâche est terminée
                                switch($tache->getTerminee()){
                                    case 0:
                                        echo "Non";
                                        break;
                                    case 1:
                                        echo "Oui";
                                        break;
                                    default:
                                        echo "Erreur";
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if($tache->getTerminee() == 0){
                                    ?>
                                    <form method="POST" id="form-<?=$tache->getId()?>">
                                        <input type="hidden" name="idTache" value="<?=$tache->getId();?>">
                                        <input type="checkbox" name="terminer" value="1" id="<?=$tache->getId()?>">
                                        Terminer
                                    </form>
                                    <?php
                                }else{
                                    ?>
                                    Aucune action possible
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            <div class="bottom">
                <form action="../traitements/nouvelle_tache.php" method="post">
                    <label for="nouvelle_tache">Nouvelle tâche</label>
                    <input type="text" name="libelle" placeholder="Libelle de la tâche" required>
                    <input type="hidden" name="idProjet" value="<?=$_GET["id"];?>">
                    <button type="submit">OK</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="scripts/scriptTache.js"></script>