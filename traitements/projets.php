<?php
require_once "../modeles/Modele.php";

if(isset($_POST["terminer"])){
    $tache = new Taches;
    $tache->terminer_tache(1, $_POST["idTache"]);
}

$projet = new Projets($_GET["id"]);
$chats = $projet->getChatProjet();
$taches = $projet->getTaches();