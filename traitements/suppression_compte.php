<?php
require_once '../modeles/Modele.php';

$Utilisateurs->supprimer_compte($utilisateur->getId());
header('location:../pages/deconnexion.php');
?>