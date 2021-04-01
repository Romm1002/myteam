<?php
if(!empty($_POST["filtreRecherche"])){
    $contacts = recherche($_POST["filtreRecherche"]);
}else{
    $contacts = recuperationContacts();
}

if(!empty($_POST["nouveauMessage"])){
    newMessage($_SESSION["prenom"], $_GET["avec"], $_POST["nouveauMessage"]);
}

if(!empty($_POST["newMessage"])){
    extract($_POST);
    newMessage($_SESSION["prenom"], $_GET["avec"], $newMessage);
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