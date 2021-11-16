<?php
require_once "../traitements/header.php";
require_once "../traitements/projets.php";
?>

<body>
<div class="container">
<form method="POST">
    <div class="form-group mb-4">
        <label for="nomProjet">Nom du projet</label>
        <input type="text" class="form-control" name="nomProjet" id="nomProjet" placeholder="Entrez le nom du projet...">
    </div>

    <div class="form-group" id="listeMembre">
        <label for="membresProjet">Noms des personnes participants au projet</label>
        <input type="text" class="form-control my-2" name="membresProjet" id="membresProjet" placeholder="Entrez les noms des membres...">
        <small class="form-text text-muted mb-1">Séparez les noms par des virgules</small>
    </div>

    <div class="form-group">
        <label for="descriptionProjet">Description du projet</label>
        <textarea class="d-block" name="descriptionProjet" id="descriptionProjet" placeholder="En quoi ce projet consiste ?" rows="5" cols="151"></textarea>
    </div>

    <div class="form-group">
        <label for="dateDebut">Date de début</label>
        <input type="date" class="form-control my-2" name="dateDebut" id="dateDebut">
    </div>
    <div class="form-group">
        <label for="dateFin">Date de fin</label>
        <input type="date" class="form-control my-2" name="dateFin" id="dateFin">
    </div>

    <button type="submit" class="btn btn-primary d-block my-4 mx-auto">Créer le projet</button>

</form>
<script src="../pages/scripts/fonction.js"></script>
</div>
</body>