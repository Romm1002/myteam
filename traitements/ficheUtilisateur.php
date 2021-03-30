<?php

if(empty($_GET["id"])){
    header("location:equipe.php");
}else{
    utilisateurs($_GET["idUtilisateur"]);
}