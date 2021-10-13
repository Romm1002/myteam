<?php


$Administration = new Administration();
$Utilisateurs = new Utilisateurs();
//verif du grade
if($_SESSION["grade"] != 10){
    header("location:../pages/accueil.php");
}

if(!empty($_POST["chercherMembre"])){
    $membres = $Administration->recherche($_POST["chercherMembre"]);
}else{
    $membres = $Administration->recuperationContacts();
}