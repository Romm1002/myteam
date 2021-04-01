<?php
require_once "../traitements/header.php";
require_once "../traitements/planning.php";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet">
</head>
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
            <a href="index.php" class="btnDeconnexion d-flex"> <img src="../pages/images/flecheRetour.png" alt="retour a l'accueil" width="25px"> <p class="my-0 ml-1">Retour</p></a>
            <form action="../pages/planning.php" method='get' id='saisirDate' class="form-group mt-5">
                <input type='date' name='date' id='date' value="<?=!empty($_GET["date"]) ? $_GET["date"] : "";?>" class="form-control"/>
            <table class="calendrier">
                <thead>
                    <th colspan="7" class="text-left"><?=dateMois($date);?></th>
                </thead>
                <tbody>
                    <tr>
                    <?php
                    $a = 1;
                    while ($a != $calendrier[0]['jourDeSemaine']) {
                        $a++;
                    ?>
                        <th></th>
                    <?php
                    }
                    foreach($calendrier as $jour){
                    ?>
                        <th style="border-top: solid red 2px;">
                            <button name="date" value="<?=$jour["date"];?>" class="btn jourCalendrier <?=$jour["date"] == $date ? "btn-info" : "";?>" onclick="btnCalendrier(event,'<?=$jour['date'];?>')">
                                <div class="nbrEvenements<?=(!empty($jour["nbr"]))?" nbrEvenementsUnselected":"";?><?=($jour["date"] == $date && !empty($jour["nbr"])) ? " nbrEvenementsSelected" : "";?>">
                                    <?=(!empty($jour["nbr"]))?$jour["nbr"]:"";?>
                                </div>
                                <?=$jour['jour'];?>
                            </button>
                            
                        </th>
                    <?php
                        if($jour['jourDeSemaine'] == 0){
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


            <form action="../traitements/planning" method="post" class="form-group d-flex flex-column align-items-start" id="ajoutEvenement">
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


        <div id="jour">
        <?php
        for($i=8;$i<18;$i++){
        ?>
            <div class="list-group-item creneau">
                <div class="heure">
                    <?=$i;?>h
                </div>
                <?php
                foreach($evenements as $evenement){
                    $debut = substr($evenement["heureDebut"],0,2);
                    $arrondi = substr($evenement["heureFin"],3,2);
                    $fin = substr($evenement["heureFin"],0,2);
                    if($arrondi == 0 && $debut != $fin){
                        $fin -= 1;
                    }
                    if($debut <= $i && $fin >= $i){
                        ?>
                        <div class="evenement <?php
                            if($debut < $i && $fin > $i){
                                echo "evenement-mid";
                            }elseif($debut < $i){
                                echo "evenement-bot";
                            }elseif($fin > $i){
                                echo "evenement-top";
                            }
                        ?>">
                            <div class="float-right d-flex">
                                <p class="mr-2">
                                    <?php
                                    if($debut == $i){
                                        echo substr($evenement["heureDebut"],0,5);
                                        ?>
                                        <form method="post">
                                        <input type="hidden" name="date" value="<?=$date;?>">
                                        <button name="supprEvenement" class="supprEvenement" value="<?=$evenement["idEvenement"];?>">X</button>
                                        </form>
                                        <?php
                                    }
                                    if($debut != $fin && $fin == $i){
                                        echo substr($evenement["heureFin"],0,5);
                                    }
                                    ?>
                                </p>
                            </div>
                            <?php
                            if($debut == $i){
                                echo "<h5>" . $evenement["designation"] . "</h5>";
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        <?php
        }
        ?>
        </div>
            
        </section>
    </main>
</body>

<script src="fonctionPlanning.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
