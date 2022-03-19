<?php
require_once "../modeles/Modele.php";

$Messagerie = new Messagerie();

if(!empty($_POST["filtreRecherche"])){
    $contacts = $Messagerie->rechercheContact($_POST["filtreRecherche"], $utilisateur->getId());
}else{
    $contacts = $Messagerie->recuperationContacts($utilisateur->getId());
}

if(!empty($_GET["avec"])){
    if($_GET["avec"] == $utilisateur->getId()){
        header("location:messagerie.php");
    }else{
        $Messagerie->recuperationInformationsContact($_GET["avec"]);
        $conversation = $Messagerie->recuperationMessage($utilisateur->getId(), $Messagerie->getReceveur()->getId());
    }
}

if(!empty($_POST["newMessage"])){
    extract($_POST);
    $Messagerie->newMessage($utilisateur->getId(), $newMessage);
    header("location:messagerie.php?avec=" . $_GET["avec"]);
}

// Permet d'insérer en BDD les messages signalés
if(!empty($_POST["contenuMessage"])){
    $Messagerie->signalerMessage($_POST["idMessage"], $_POST["contenuMessage"], 0, $_SESSION["idUtilisateur"], $_POST["idReceveur"]);
}