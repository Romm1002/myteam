<?php
require_once "../modeles/modele.php";
require_once "../traitements/messagerie.php";
require_once "../traitements/notConnected.php";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="../pages/styles/styleMessagerie.css">
</head>
<body>
    <main>
        <div class="circle1"></div>
        <div class="circle2"></div>

        <div class="container-accueil">
            <div class="accueil-left">
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
                        <a href="messagerie.php?avec=<?=$contact["idUtilisateur"];?>#bottom">
                            <div class="contacts">
                                <img src="<?=$contact["photoProfil"];?>" alt="Photo de profil" width="40" height="40">
                                <p><?=$contact["prenom"] . " " . $contact["nom"];?></p>
                            </div>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="accueil-right">
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
                            <img src="<?=$Messagerie->recuperationInformationsContact($_GET["avec"])["photoProfil"];?>" alt="Photo de profil" width="40" height="40">
                            <p><?=$Messagerie->recuperationInformationsContact($_GET["avec"])["prenom"] . " " . $Messagerie->recuperationInformationsContact($_GET["avec"])["nom"];?></p>
                        </div>

                        <div class="reseau-content">
                            <div class="messages">
                            <?php
                            foreach($Messagerie->recuperationMessage($_SESSION["idUtilisateur"], $_GET["avec"]) as $message){
                                ?>
                                <div class="message <?=$_SESSION["idUtilisateur"] == $message["idEnvoyeur"] ? "envoye" : "recus";?>">
                                    <p><?=$message["contenu"];?></p>
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
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <!-- <section class="glass">
            

            <div class="reseau">
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
                            <img src="<?=$Messagerie->recuperationInformationsContact($_GET["avec"])["photoProfil"];?>" alt="Photo de profil" width="40" height="40">
                            <p><?=$Messagerie->recuperationInformationsContact($_GET["avec"])["prenom"] . " " . $Messagerie->recuperationInformationsContact($_GET["avec"])["nom"];?></p>
                        </div>

                        <div class="reseau-content">
                            <div class="messages">
                            <?php
                            foreach($Messagerie->recuperationMessage($_SESSION["prenom"], $_GET["avec"]) as $message){
                                ?>
                                <div class="message <?=$_SESSION["prenom"] == $message["envoyeur"] ? "ml-auto" : "mr-auto";?>">
                                    <p><?=$message["contenu"];?></p>
                                </div>
                                <?php
                            }
                            ?>
                            </div>
                        </div>

                        <div class="reseau-footer">
                            <form method="POST">
                                <input type="text" name="newMessage" placeholder="Votre message...">
                                <button type="submit"><i class="fas fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section> -->
    </main>
</body>