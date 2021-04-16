<?php
$Administration = new Administration();
//verif du grade
if($_SESSION["grade"]!=10){
    header("location:index");
}
//recupération des données avec filtre
if(!empty($_POST["recherche"])){
    $Administration->rechercheEmploye($search);
    // verfication que la recherche existe
    // $search = $_POST["recherche"];
    if($Administration->rechercheEmploye($_POST["recherche"]) < 1){
        $erreur = "La recherche effectuée ne correspond à aucune donnée";
    }else{
        $Administration->rechercheEmploye($search);
    }
//recupération des données sans filtre
}else{

    if($Administration->rechercheOK() < 1){
        $erreur = "La base de donnée est vide";
    }else{
        $Administration->rechercheOK();
    }
}