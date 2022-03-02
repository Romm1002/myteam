<?php
require_once "../modeles/Modele.php";

$chat = new Chats();
$date = new DateTime();


if(!empty($_POST["newMessage"])){
    $chat->new_chat($uilisateur->getId(), $date->format('Y-m-d H:i:s'), $_POST["newMessage"], $_POST["idProjet"]);
    header('location:../pages/projets.php?id=' . $_POST['idProjet']);
}

?>