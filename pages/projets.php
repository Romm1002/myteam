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
                    <div style="justify-content:<?=$chat->getUtilisateur()->getId() == $utilisateur->getId() ? "flex-start" : "flex-end";?>" class="message">
                        <span class="<?=$chat->getUtilisateur()->getId() == $utilisateur->getId() ? "blue" : "grey";?>">
                            <div class="infos">
                                <img src="<?=$chat->getUtilisateur()->getPhotoProfil();?>" alt="Photo de profil" width="25" height="25" style="object-fit: cover">
                                <?=htmlspecialchars($chat->getUtilisateur()->getPrenom()) . " " . htmlspecialchars($chat->getUtilisateur()->getNom());?>
                            </div>
                            <hr>
                            <div class="text">
                                <?=htmlspecialchars($chat->getmessage());?>
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
        <div class="container-1">
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
                    <th>Attribué à</th>
                    <th>Tâche parent (N°)</th>
                    <th>Date de fin</th>
                    <th>Action</th>

                    <?php
                    foreach($taches as $tache){
                        ?>
                        <tr style="background-color: <?=$tache->getTerminee() == 0 && $tache->getDateFin() < date("Y-m-d") ? "red" : "";?>">
                            <td><?=$tache->getId();?></td>
                            <td><?=htmlspecialchars($tache->getLibelle());?></td>
                            <td><?=$tache->getPrenom() . " " . $tache->getNom();?></td>
                            <td><?=$tache->getIdTacheParent();?></td>
                            <td><?=$tache->getDateFin();?></td>
                            <td>
                                <?php
                                if($tache->getTerminee() == 0){
                                    ?>
                                    <form action="../traitements/terminerTache.php?id=<?=$tache->getIdProjet();?>&idt=<?=$tache->getId();?>" method="POST" id="form-<?=$tache->getId()?>">
                                        <input type="hidden" name="idUtilisateur" value="<?=$tache->getIdUtilisateur();?>">
                                        <input type="hidden" name="idTache" value="<?=$tache->getId();?>">
                                        <input type="checkbox" name="terminer" value="1" id="<?=$tache->getId()?>">
                                        Terminer
                                    </form>
                                    <?php
                                }else{
                                    ?>
                                    La tâche est déjà terminée
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
        </div>

        <div class="container-2">
            <div class="bottom">
                <form action="../traitements/nouvelle_tache.php" method="post">
                    <label for="nouvelle_tache">Nouvelle tâche</label>
                    <input type="text" name="libelle" placeholder="Libelle de la tâche" required>
                    <input type="hidden" name="idProjet" value="<?=$_GET["id"];?>">

                    <label for="attribution">Attribuer la tâche à</label>
                    <select name="salarie" required>
                        <option value="none" selected disabled>Selectionner un salarié</option>
                        <?php
                        foreach($projet->selectionParticipants($_GET["id"]) as $user){
                            ?>
                            <option value="<?=$user->getId();?>"><?=$user->getPrenom() . " " . $user->getNom();?></option>
                            <?php
                        }
                        ?>
                    </select>

                    <label for="tache_parent">Tâche parent</label>
                    <select name="parent">
                        <option value="none" selected disabled>Selectionner une tâche parent</option>
                        <?php
                        foreach($taches as $tache){
                            ?>
                            <option value="<?=$tache->getId();?>"><?=$tache->getId();?></option>
                            <?php
                        }
                        ?>
                    </select>

                    <label for="date_fin">Date de fin</label>
                    <input type="date" name="date_fin" required>
                    <button type="submit">OK</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="scripts/scriptTache.js"></script>

<?php
if(isset($_GET["error"])){
    switch($_GET["error"]){
        case 0:
            ?>
            <div class="alert alert-success" style="position: absolute; top: 50px">
                La tâche à été terminée.
            </div>
            <?php
            break;
        case 1:
            ?>
            <div class="alert alert-danger" style="position: absolute; top: 50px">
                La tâche ne vous appartient pas ou la tâche parent associé n'est pas terminée.
            </div>
            <?php
            break;
        case 2:
            ?>
            <div class="alert alert-danger" style="position: absolute; top: 50px">
                La tâche ne peut pas avoir une date de fin antérieur à la date du jour.
            </div>
            <?php
    }
}
?>