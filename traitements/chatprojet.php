<?php
require_once "../modeles/Modele.php";

$Projets = new Projets();
$date = new DateTime();


if(!empty($_POST["newMessage"])){
    $Projets->new_chat($uilisateur->getId(), $date->format('Y-m-d H:i:s'), $_POST["newMessage"], $_POST["idProjet"]);
    header('location:../pages/projets.php?id=' . $_POST['idProjet']);
}

?>