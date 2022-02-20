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
            <div id="block" onclick="afficherContacts()"></div>

            <div id="accueil-left">
                <div class="header">
                    <a href="accueil.php" title="Retour à l'accueil"><i class="fas fa-arrow-circle-left"></i> Retour</a>
                </div>

                <div class="filtre">
                    <form method="post">
                        <input type="text" name="filtreRecherche" placeholder="Rechercher...">
                        <button type="submit" title="Chercher un utilisateur">&#10004;</button>
                    </form>
                </div>

                <div class="contacts">
                    <?php
                    foreach($contacts as $contact){
                        ?>
                        <a href="messagerie.php?avec=<?=$contact->getId();?>">
                            <div class="contact">
                                <div class="photo-profil">
                                    <img src="<?=$contact->getPhotoProfil();?>" alt="Photo de profil" width="40" height="40">
                                </div>
                                <div class="informations">
                                    <div class="top">
                                        <p><?=$contact->getNom() . " " . $contact->getPrenom();?></p>
                                    </div>
                                    <div class="bottom">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div id="accueil-right">
            
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