<?php
$Messagerie = new Messagerie();
if(!empty($_POST["filtreRecherche"])){
    $contacts = $Messagerie->recherche($_POST["filtreRecherche"], $_SESSION["idUtilisateur"]);
}else{
    $contacts = $Messagerie->recuperationContacts($_SESSION["idUtilisateur"]);
}

if(!empty($_POST["nouveauMessage"])){
    $Messagerie->newMessage($_SESSION["prenom"], $_GET["avec"], $_POST["nouveauMessage"]);
}

if(!empty($_POST["newMessage"])){
    extract($_POST);
    $Messagerie->newMessage($_SESSION["prenom"], $_GET["avec"], $newMessage);
    ?>
    <script>
        document.location.href="messagerie.php?avec=<?=$_GET["avec"];?>"
    </script>
    <?php
}

if(!empty($_GET)){
    if($_GET["avec"] == $_SESSION["prenom"]){
        header("location:messagerie.php");
    }
}