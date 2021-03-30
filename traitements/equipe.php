<?php
//verif du grade
if($_SESSION["grade"]!=10){
    header("location:index");
}
//recupération des données avec filtre
if(!empty($_POST["recherche"])){
    rechercheEmploye();
    // verfication que la recherche existe
    // $search = $_POST["recherche"];
    if(rechercheEmploye($_POST["recherche"]) < 1){
        $erreur = "La recherche effectuée ne correspond à aucune donnée";
    }else{
        rechercheEmploye();
    }
//recupération des données sans filtre
}else{

    if(rechercheOK() < 1){
        $erreur = "La base de donnée est vide";
    }else{
        rechercheOK();
    }
}