<?php
require_once "../traitements/header.php";
require_once "../traitements/planning.php";
?>

<link rel="stylesheet" href="stylePlanning.css">
<body>
    <?php
    if(!empty($_GET["ajout"])){
        if($_GET["ajout"] == "OK"){
            ?>
            <div class="alert alert-success alert-dismissible fade show mt-3 p-1 index-50 position-absolute w-50 d-flex justify-content-center" role="alert">
                <p class="m-0 my-auto">L'évènement a bien été ajouté.</p>
                <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close"> X</button>
            </div>
            <?php
        }elseif($_GET["ajout"] == 2){
            ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3 p-1 index-50 position-absolute w-50 d-flex justify-content-center" role="alert">
                <p class="m-0 my-auto">L'évènement ne peut être définit en dehors des horaires de travail.</p>
                <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close"> X</button>
            </div>
            <?php
        }elseif($_GET["ajout"] == 1){
            ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3 p-1 index-50 position-absolute w-50 d-flex justify-content-center" role="alert">
                <p class="m-0 my-auto">L'évènement ne peut finir avant de commencer.</p>
                <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close"> X</button>
            </div>
            <?php
        }
        
    }
    ?>
    <main>
        <div class="circle1"></div>
        <div class="circle2"></div>
        <section class="glass">
        <div class="dashboard">
            <a href="index.php" class="btnDeconnexion d-flex"> <img src="../pages/images/flecheRetour.png" width="25px"> <p class="my-0 ml-1">Retour</p></a>
            <form action="../pages/planning.php" method='get' id='saisirDate' class="form-group mt-5">
                <input type='date' name='date' id='date' value="<?=$date;?>" class="form-control"/>
            <table class="calendrier">
                <thead>
                    <th colspan="7" class="text-left"><?=$calendrier->getMois();?></th>
                </thead>
                <tbody>
                    <tr>
                    <?php
                    $a = 1;
                    while ($a != $calendrier->getJours()[0]->getJourSemaine()) {
                        $a++;
                    ?>
                        <th></th>
                    <?php
                    }
                    foreach($calendrier->getJours() as $jour){
                    ?>
                        <th style="<?=$jour->getProjet() == true ? 'border-top:solid red 1px' : 'border-top:solid black 1px';?>">
                            <button name="date" value="<?=$jour->getDate();?>" class="btn jourCalendrier <?=$jour->getDate() == $date ? "btn-info" : "";?>" onclick="btnCalendrier(event,'<?=$jour->getDate();?>')">
                                <div class="nbrEvenements<?=(!empty($jour->getNbrEvenements()))?" nbrEvenementsUnselected":"";?><?=($jour->getDate() == $date && !empty($jour->getNbrEvenements())) ? " nbrEvenementsSelected" : "";?>">
                                    <?=(!empty($jour->getNbrEvenements()))?$jour->getNbrEvenements():"";?>
                                </div>
                                <?=$jour->getJour();?>
                            </button>
                            
                        </th>
                    <?php
                        if($jour->getJourSemaine() == 0){
                            ?>
                            </tr><tr>
                            <?php

                        }
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
            </form >


            <form action="../traitements/planning" method="post" class="form-group d-flex flex-column align-items-start px-1 w-75" id="ajoutEvenement">
                <h5 class=" titre mb-3">Ajouter un évenement</h5>
                <label for="designation" class="form-label">Titre</label>
                <input type="text" id="designation" name="designation" placeholder="Saisir un titre" class="form-control" required>
                <div class="d-flex">
                    <div class="mr-2 d-flex flex-column align-items-start">
                        <label for="heureDebut" class="form-label">Début</label>
                        <input type="time" id="heureDebut" name="heureDebut" class="form-control" required>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <label for="heureFin" class="form-label">Fin</label>
                        <input type="time" id="heureFin" name="heureFin" class="form-control">
                        <small class="text-secondary">Optionel</small>
                    </div>
                </div>
                <button name="date" value="<?=$date;?>" class="btn btn-primary" >Enregistrer</button>
            </form>
        </div>
                    
        <div id="planning">
            <?php
            $j=0;
            for($i=8;$i<=18;$i++){
                echo "<div class='horaire' style='top:". $j*10 ."%;'>".$i."</div>";
                $j+= 1;
            }
            ?>
            
        </div>
            
        </section>
    </main>
</body>

<script src="fonctionPlanning.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
