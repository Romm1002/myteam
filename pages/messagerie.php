<?php
require_once "../pages/header.php";
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
            <!-- Reponsive -->
            <div id="block" onclick="afficherContacts()"></div>

            <div id="accueil-left">
                <!-- retour -->
                <a id="lien_retour" href="accueil.php">
                    <i class="bi bi-arrow-left-short"></i>
                </a>

                <!-- fonction recherche -->
                <form method="POST">
                    <input type="text" name="filtreRecherche" placeholder="Rechercher...">
                    <button type="submit">
                        <i class="bi bi-check2"></i>
                    </button>
                </form>

                <!-- liste des contacts -->
                <div id="liste-contacts">
                <?php
                    foreach($contacts as $contact){
                        ?>
                        <a href="messagerie.php?avec=<?=$contact->getId();?>#bottom">
                            <div class="contacts">
                                <img src="<?=$contact->getPhotoProfil();?>" alt="Photo de profil" width="40" height="40">
                                <?php
                                if(strlen($contact->getPrenom() . " " . $contact->getNom()) >= 20){
                                    ?>
                                    <p title="<?=$contact->getPrenom() . " " . $contact->getNom();?>"><?=str_replace(substr($contact->getPrenom() . " " . $contact->getNom(), 14), "...", $contact->getPrenom() . " " . $contact->getNom());?></p>
                                    <?php
                                }else{
                                    ?>
                                    <p title="<?=$contact->getPrenom() . " " . $contact->getNom();?>"><?=htmlspecialchars($contact->getPrenom()) . " " . htmlspecialchars($contact->getNom());?></p>
                                    <?php
                                }
                                ?>
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
                            $raccourci = [":)", ":(", ":/", ":')", ":o", "(:", ":D", ";)", ":p"];
                            $emojis = ["<img src='images/emojis/emo_smile.svg' width='17px' height=''17px />", "<img src='images/emojis/emo_sad.svg' width='17px' height=''17px />", "<img src='images/emojis/emo_droit.svg' width='17px' height=''17px />", "<img src='images/emojis/emo_rire.svg' width='17px' height=''17px />", "<img src='images/emojis/emo_surpris.svg' width='17px' height=''17px />", "<img src='images/emojis/emo_envers.svg' width='17px' height=''17px />", "<img src='images/emojis/emo_smile+.svg' width='17px' height=''17px />", "<img src='images/emojis/emo_clin_oeil.svg' width='17px' height=''17px />", "<img src='images/emojis/emo_langue.svg' width='17px' height=''17px />"];

                            foreach($conversation as $message){
                                ?>
                                <div class="message <?=$utilisateur->getId() == $message->getIdUtilisateur() ? "envoye" : "recus";?>">
                                    <p><?=str_replace($raccourci, $emojis, htmlspecialchars($message->getContenu()));?></p>
                                </div>
                                <?php
                            }
                            ?>
                            </div>
                            <div id="bottom"></div>
                        </div>

                        <div class="reseau-footer">
                            <form method="POST">
                                <div id="form1">
                                    <input type="text" name="newMessage" placeholder="Votre message...">
                                    <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                </div>
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
            <div class="header">
                <p>Signaler un message</p>
                <i class="fas fa-times" onclick="close_menu_signaler()"></i>
            </div>

            <hr>

            <table>
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
                                <input type="hidden" name="idReceveur" value="<?=$_GET["avec"];?>">
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