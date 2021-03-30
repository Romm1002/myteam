<?php
require_once "../traitements/header.php";
require_once "../traitements/calendrier.php";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/styleAccueil.css">
</head>
<body>
    <main>
        <div class="circle1"></div>
        <div class="circle2"></div>
        <section class="glass">
        <div class="dashboard">
            <form method='post' id='good'>
                Entrer une date: <input type='date' name='date' id='date' />
            <table id="calendrier">
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
                        <th>
                            <button name="date" value="<?=$jour["date"];?>" class="btn"><?=$jour['jour'];?></button>
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
                        <div class="evenement">
                            <div class="float-right d-flex">
                                <p class="mr-2">
                                    <?php
                                    if($debut == $i){
                                        echo substr($evenement["heureDebut"],0,5);
                                    }
                                    if($debut != $fin && $fin == $i){
                                        echo substr($evenement["heureFin"],0,5);
                                    }
                                    ?>
                                </p>
                                <form method="post">
                                    <input type="hidden" name="date" value="<?=$date;?>">
                                    <button name="supprEvenement" value="<?=$evenement["idEvenement"];?>">X</button>
                                </form>
                            </div>
                                <h5><?=$evenement["designation"];?></h5>
                            
                            <p><?=$evenement["contenu"];?></p>
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

<script src="fonctionCalendrier.js"></script>
