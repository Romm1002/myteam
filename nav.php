<?php
require_once "entete.php";

if(empty($_SESSION["grade"]) || $_SESSION["grade"]<1){
    header("location:index");
}
?>

<nav class="navbar navbar-light navbar-expand-md">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" id="logo" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <div class="navbar-nav ml-auto">
                <a href="#" class="nav-item nav-link mx-2">Test</a>
                <a href="#" class="nav-item nav-link mx-2">Test</a>
                <a href="projets.php" class="nav-item nav-link mx-2">Projets</a>
                <a href="equipe.php" class="nav-item nav-link mx-2">Équipe</a>
                <a href="deconnexion.php" class="nav-item btn btn-outline-danger mx-2">Déconnexion</a>

            </div>
        </div>
    </div>
</nav>
