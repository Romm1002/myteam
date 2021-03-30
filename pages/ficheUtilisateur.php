<?php
require_once "../traitements/header.php";


?>
<div class="container">
    <h1 class="mb-3">Fiche de l'utilisateur </h1>
    <div class="list-group">
        <div class="list-group-item">
            <h4>Nom :</h4>
            <p class="ml-3"><?=$utilisateur["nom"];?></p>
        </div>
        <div class="list-group-item">
            <h4>Prénom :</h4>
            <p class="ml-3"><?=$utilisateur["prenom"];?></p>
        </div>
        <div class="list-group-item">
            <h4>Date de naissance :</h4>
            <p class="ml-3"><?=$utilisateur["datenaiss"];?></p>
        </div>
        <div class="list-group-item">
            <h4>Adresse email :</h4>
            <p class="ml-3"><?=$utilisateur["email"];?></p>
        </div>
        <div class="list-group-item">
            <h4>Poste :</h4>
            <p class="ml-3"><?=$utilisateur["poste"];?></p>
        </div>
        <div class="list-group-item">
            <h4>Accès :</h4>
            <p class="ml-3"><?=$utilisateur["grade"];?></p>
        </div>
    </div>
</div>