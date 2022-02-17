<?php
require_once "../modeles/Modele.php";
require_once "../traitements/notConnected.php";
require_once "../traitements/redirection_first_connexion.php";
require_once "../traitements/messagerie.php";
require_once "header.php";

?>
<head>
    <link rel="stylesheet" href="../pages/styles/styleMessagerie.css">
</head>
<body>
    <main>
        <div class="circle1"></div>
        <div class="circle2"></div>
        
        <div id="container-accueil">
            <div id="block" onclick="afficherContacts()"></div>

            <div id="accueil-left">
                <a href="accueil.php"><i class="fas fa-arrow-circle-left"></i> Retour</a>
                <!-- fonction recherche -->
                <form method="POST">
                    <div>
                        <input type="text" name="filtreRecherche" placeholder="Rechercher...">
                    </div>
                    <button type="submit">&#10004;</button>
                </form>
                <!-- liste des contacts -->
                <div id="liste-contacts">
                <?php
                    foreach($contacts as $contact){
                        ?>
                        <a href="messagerie.php?avec=<?=$contact->getId();?>#bottom">
                            <div class="contacts">
                                <img src="<?=$contact->getPhotoProfil();?>" alt="Photo de profil" width="40" height="40">
                                <p><?=htmlspecialchars($contact->getPrenom()) . " " . htmlspecialchars($contact->getNom());?></p>
                            </div>
                        </a>
                        <?php
                    }
                    ?>
                </div>
                <!-- bouton responsive -->
                <div id="btn-contact" onclick="afficherContacts()">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>

            <div id="accueil-right">
            <?php
                if(empty($_GET)){
                    ?>
                    <div class="no-get">
                        <h1>Pour démarrer une discussion, séléctionnez un contact.</h1>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="get">
                        <div class="reseau-header">
                            <img src="<?=$Messagerie->getReceveur()->getPhotoProfil();?>" alt="Photo de profil" width="40" height="40">
                            <p><?=htmlspecialchars($Messagerie->getReceveur()->getPrenom()) . " " . htmlspecialchars($Messagerie->getReceveur()->getNom());?></p>
                        </div>

                        <div class="reseau-content">
                            <div class="messages">
                            <?php
                            foreach($conversation as $message){
                                ?>
                                <div class="message <?=$utilisateur->getId() == $message->getIdUtilisateur() ? "envoye" : "recus";?>">
                                    <p><?=htmlspecialchars($message->getContenu());?></p>
                                </div>
                                <?php
                            }
                            ?>
                            </div>
                            <div id="bottom"></div>
                        </div>

                        <div class="reseau-footer">
                            <form method="POST">
                                <input type="text" name="newMessage" placeholder="Votre message...">
                                <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                <button type="button" id="signaler" title="Signaler un message" onclick="open_warn_message()"><i class="fas fa-exclamation-circle"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

    </main>

    <div class="warn-message-background" id="warn-message-background" style="display: none;">
        <div class="warn-message">
        <i class="fas fa-times" onclick="close_menu_signaler()"></i>
            <table>
                <th>Message</th>
                <th>Action</th>

                <?php
                foreach($conversation as $message){
                    if($message->getIdUtilisateur() == $utilisateur->getId()){
                        continue;
                    }
                    ?>
                    <tr>
                        <form method="POST">
                            <td>
                                <?=htmlspecialchars($message->getContenu());?>
                                <input type="hidden" name="contenuMessage" value="<?=$message->getContenu();?>">
                                <input type="hidden" name="idMessage" value="<?=$message->getId();?>">
                            </td>
                            <td>
                                <button type="submit" name="signaler" value="1">Signaler</button>
                            </td>
                        </form>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>

    <script src="../pages/scripts/scriptMessagerie.js"></script>
    
</body>