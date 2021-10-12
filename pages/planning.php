<?php
require_once "../traitements/header.php";
require_once "../traitements/planning.php";
require_once "../traitements/notConnected.php";
?>
<head>
    <link rel="stylesheet" href="../pages/styles/stylePlanning.css">
</head>

<body>
    <?php
    // alertes
    if(!empty($_GET["ajout"])){
        if($_GET["ajout"] == "OK"){
            ?>
            <div class="alert alert-success alert-dismissible fade show alerte" role="alert">
                <p class="m-0 my-auto">L'évènement a bien été ajouté.</p>
                <button type="button" class="btn bouton-dismiss" data-bs-dismiss="alert" aria-label="Close"> X</button>
            </div>
            <?php
        }elseif($_GET["ajout"] == 2){
            ?>
            <div class="alert alert-danger alert-dismissible fade show alerte" role="alert">
                <p class="m-0 my-auto">L'évènement ne peut être définit en dehors des horaires de travail.</p>
                <button type="button" class="btn bouton-dismiss" data-bs-dismiss="alert" aria-label="Close"> X</button>
            </div>
            <?php
        }elseif($_GET["ajout"] == 1){
            ?>
            <div class="alert alert-danger alert-dismissible fade show alerte" role="alert">
                <p class="m-0 my-auto">L'évènement ne peut finir avant de commencer.</p>
                <button type="button" class="btn bouton-dismiss" data-bs-dismiss="alert" aria-label="Close"> X</button>
            </div>
            <?php
        }elseif($_GET["ajout"] == "modif"){
            ?>
            <div class="alert alert-success alert-dismissible fade show alerte" role="alert">
                <p class="m-0 my-auto">L'évènement a bien été modifié.</p>
                <button type="button" class="btn bouton-dismiss" data-bs-dismiss="alert" aria-label="Close"> X</button>
            </div>
            <?php
        }
    }
    ?>
    <div class="circle1"></div>
    <div class="circle2"></div>
    <div class="container-accueil">
        <div class="accueil-left">
            <!-- bouton retour -->
            <a href="index.php" class="btnDeconnexion d-flex"> <img src="../pages/images/flecheRetour.png" width="25px"></a>
            
            <form action="../pages/planning.php" method='get' id='saisirDate' class="form-group m-3">
                <input  style="display:none" type='date' name='date' id='date' value="<?=!empty($_GET["date"]) ? $_GET["date"] : "";?>" class="form-control"/>
                <table class="calendrier">
                    <thead>
                        <tr>
                            <th>
                                <button name="date" value="<?=$moisPrec?>" class="bouton-mois"><</button>
                            </th>
                            <th colspan="5" class="text-center">
                                <?=dateMois($date);?>
                            </th>
                            <th>
                                <button name="date" value="<?=$moisSuiv?>" class="bouton-mois">></button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                        $a = 1;
                        while ($a != $calendrier[0]['jourDeSemaine']){
                            if($a == 6){
                                $a = -1;
                            }
                            $a++;
                            ?>
                            <th></th>
                        <?php
                        }
                        foreach($calendrier as $jour){
                        ?>
                            <th>
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
            <!-- Ajouter un evenement -->
            <form action="../traitements/planning.php" method="post" class="form-group d-flex flex-column align-items-start px-1 w-75" id="ajoutEvenement">
                <h5 class=" titre mb-3">Ajouter un évenement</h5>
                <input type="text" id="designation" name="designation" placeholder="Saisir un titre" class="form-control" required>
                <div class="d-flex">
                    <div class="mr-2 d-flex flex-column align-items-start">
                        <label for="heureDebut" class="form-label">Début</label>
                        <input type="time" id="heureDebut" name="heureDebut" class="form-control" required min="08:00" max="19:00">
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <label for="heureFin" class="form-label">Fin</label>
                        <input type="time" id="heureFin" name="heureFin" class="form-control" min="08:00" max="19:00">
                        <small class="text-secondary">Optionel</small>
                    </div>
                </div>
                <div class="d-flex">
                    <button name="date" value="<?=$date;?>" class="btn btn-primary" >Enregistrer</button>
                    <div id="button-color-choice">
                        <div class="color-button mt-1" id="color-button-preview" style="background-color: #97c7eeb3;" onclick="expandColor()"></div>
                        <div id="color-choice">
                            <!-- default -->
                            <label for="couleur-1">
                                <div class="color-button" style="background-color: #97c7eeb3;" onclick="preview(event)"></div>
                            </label>
                            <input type="radio" name="couleur" id="couleur-1" value="#97c7eeb3" checked="checked">
                            <!-- bleu -->
                            <label for="couleur-2">
                                <div class="color-button" style="background-color: #7b60f5b3;" onclick="preview(event)"></div>
                            </label>
                            <input type="radio" name="couleur" id="couleur-2" value="#7b60f5b3">
                            <!-- bleu sombre-->
                            <label for="couleur-3">
                                <div class="color-button" style="background-color: #4a2fc7b3;" onclick="preview(event)"></div>
                            </label>
                            <input type="radio" name="couleur" id="couleur-3" value="#4a2fc7b3">
                            <!-- violet-->
                            <label for="couleur-4">
                                <div class="color-button" style="background-color: #9346d3b3;" onclick="preview(event)"></div>
                            </label>
                            <input type="radio" name="couleur" id="couleur-4" value="#9346d3b3">
                            <!-- rose-->
                            <label for="couleur-5">
                                <div class="color-button" style="background-color: #d954b3b3;" onclick="preview(event)"></div>
                            </label>
                            <input type="radio" name="couleur" id="couleur-5" value="#d954b3b3">
                            <!-- saumon-->
                            <label for="couleur-6">
                                <div class="color-button" style="background-color: #ed5454b3;" onclick="preview(event)"></div>
                            </label>
                            <input type="radio" name="couleur" id="couleur-6" value="#ed5454b3">
                            <!-- rouge-->
                            <label for="couleur-7">
                                <div class="color-button" style="background-color: #e30e0eb3;" onclick="preview(event)"></div>
                            </label>
                            <input type="radio" name="couleur" id="couleur-7" value="#e30e0eb3">
                            <!-- orange-->
                            <label for="couleur-8">
                                <div class="color-button" style="background-color: #e3760eb3;" onclick="preview(event)"></div>
                            </label>
                            <input type="radio" name="couleur" id="couleur-8" value="#e3760eb3">
                            <!-- jaune-->
                            <label for="couleur-9">
                                <div class="color-button" style="background-color: #c6cd25b3;" onclick="preview(event)"></div>
                            </label>
                            <input type="radio" name="couleur" id="couleur-9" value="#c6cd25b3">
                            <!-- vert-->
                            <label for="couleur-10">
                                <div class="color-button" style="background-color: #4acd25b3;" onclick="preview(event)"></div>
                            </label>
                            <input type="radio" name="couleur" id="couleur-10" value="#4acd25b3">
                            <!-- vert sombre-->
                            <label for="couleur-11">
                                <div class="color-button" style="background-color: #398d21b3;" onclick="preview(event)"></div>
                            </label>
                            <input type="radio" name="couleur" id="couleur-11" value="#398d21b3">
                        </div>
                    </div>
                </div>
            </form>
        </div>          

        <!-- afficher le planning -->
        <div class="accueil-right">
            <table id="planning-jour">
                <?php
                    for($i = 8; $i<=18; $i++){
                        ?>
                        <tr>
                            <td class="horaire">
                                <?=$i,"h"?>
                            </td>
                            <?php
                                foreach($evenements as $evenement){
                                    if(substr($evenement["heureDebut"], 0, 2) == $i){
                                        ?>
                                        <td rowspan="<?=substr($evenement["heureFin"],0,2) - substr($evenement["heureDebut"],0,2) +1 +(substr($evenement["heureFin"],3,2)>0 ? 1 : 0) ?>">
                                            <div class="evenement" style="background-color : <?= !empty($evenement["couleur"]) ? $evenement["couleur"] : "";?>">
                                                <!-- modifier un evenement -->
                                                <form action="../traitements/planning.php?date=<?=$date?>" method="POST">
                                                    <input type="hidden" name="modif" value="<?=$evenement["idEvenement"];?>">
                                                    <input type="text" class="editEvenement" id="designation<?=$evenement["idEvenement"];?>" name="designation" value="<?=$evenement["designation"];?>" readonly onclick="editEvenement('designation<?=$evenement['idEvenement'];?>')" autocomplete="off">
                                                </form>
                                                <p>
                                                    <?php
                                                        echo substr($evenement["heureDebut"],0,5);
                                                        if($evenement["heureDebut"] != $evenement["heureFin"]){
                                                            echo " - " , substr($evenement["heureFin"],0,5);
                                                        }
                                                    ?>
                                                </p>
                                                <!-- supprimer un evenement -->
                                                <form action="../traitements/planning.php?date=<?=$date?>" method="post">
                                                    <button name="supprEvenement" value="<?=$evenement["idEvenement"];?>" class="btn-supr">x</button>
                                                </form>
                                            </div>
                                        </td>
                                        <?php
                                    }
                                }
                            ?>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
</body>

<script src="fonctionPlanning.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
