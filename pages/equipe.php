<?php
require_once "../traitements/header.php";
require_once "../traitements/equipe.php";
?>

<div class="container">
    <h1 class="mb-3">Liste des utilisateurs </h1>
    <div class="d-flex">
        <!-- ajouter un utilisateur -->
        <a href="ajoutUtilisateur.php" class="nav-item btn btn-info mx-2">Ajouter un utilisateur</a>
        <!-- recherche d'utilisateur -->
        <form method="post">
            <input type="text" class="form-control rounded" name="recherche" id="recherche" placeholder="Recherche" value="<?=(!empty($search) ? $search : "");?>">
        </form>
        <form method="post">
            <input type="text" hidden name="recherche" value="">
            <input type="submit" class="form-control" value="X">
        </form>
    </div>



<!-- affichage des données -->
    <ul class="list-group mt-3">
    <?php
    if(empty($erreur)){
        foreach($utilisateurs as $utilisateur){

        ?>
        <a class="list-group-item list-group-item-action d-flex" href="ficheUtilisateur.php?id=<?=$utilisateur["idUtilisateur"];?>">
        <div>
            <?=$utilisateur["nom"];?>
            <?=$utilisateur["prenom"];?>
        </div>
        <div class="ml-auto">
            <?=$utilisateur["poste"];?>
        </div>
        </a>
        <?php
        }
        
    }else{
        ?>
        <div class="alert alert-danger mx-auto mt-2"><?=$erreur;?></div>
        <?php
    }
?>
</div>
