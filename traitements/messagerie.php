<?php
$Messagerie = new Messagerie();
if(!empty($_POST["filtreRecherche"])){
    $contacts = $Messagerie->recherche($_POST["filtreRecherche"], $_SESSION["idUtilisateur"]);
}else{
    $contacts = $Messagerie->recuperationContacts($_SESSION["idUtilisateur"]);
}

if(!empty($_POST["nouveauMessage"])){
    $Messagerie->newMessage($_SESSION["idUtilisateur"], $_GET["avec"], $_POST["nouveauMessage"]);
}

if(!empty($_POST["newMessage"])){
    extract($_POST);
    $Messagerie->newMessage($_SESSION["idUtilisateur"], $_GET["avec"], $newMessage);
    header("location:messagerie.php?avec=" . $_GET["avec"]);
}


if(!empty($_GET)){
    if($_GET["avec"] == $_SESSION["idUtilisateur"]){
        header("location:messagerie.php");
    }
}