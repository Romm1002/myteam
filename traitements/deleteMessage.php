<?php
require_once "../traitements/header.php";

$Messagerie = new Messagerie();

$Messagerie->deleteMessage($_GET["idMessage"]);
header("location:../pages/equipe.php?pages=messagerie");