<?php
require_once "../traitements/header.php";
require_once "../traitements/planning.php";
if(!empty($_GET["ajout"])){
    switch($_GET["ajout"]){
        case "OK":
            echo "<div class='alert alert-success'>L'évènement a bien été enregistré</div>";
            break;
        case "HS":
            echo "<div class='alert alert-danger'>ERREUR : L'évènement n'a pas été enregistré</div>";
            break;
        case 1:
            echo "<div class='alert alert-danger'>ERREUR : Un évenement ne peut commencer avant de finir</div>";
            break;
        case 2 :
            echo "<div class='alert alert-danger'>ERREUR : Un évenement ne peut être créé en dehors des horeurs de travail</div>";
            break;
    }
}
    ?>
<div class="container d-flex">
    <a href="calendrier.php" class="mr-3">Retour</a>
    <div class="list-group my-3 mx-3" style="min-width:300px">
        <?php
        for($i=8;$i<18;$i++){
        ?>
            <div class="list-group-item" style="min-height : 50px">
                <div style="margin-left:-50px;margin-top : -30px">
                    <?=$i;?>
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
                        <div class="alert alert-primary">
                            <div class="float-right"><a href="../traitements/supprEvenement.php?id=<?=$evenement["idEvenement"];?>&jour=<?=$_GET["jour"];?>" class="text-info">X</a></div>
                                <p class="float-right mr-3">
                                    <?php
                                    if($debut == $i){
                                        echo substr($evenement["heureDebut"],0,5);
                                    }
                                    if($debut != $fin && $fin == $i){
                                        echo substr($evenement["heureFin"],0,5);
                                    }
                                    ?>
                                </p>
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
    
    <div>
        <form action="../traitements/planning.php?jour=<?=$_GET["jour"];?>" method="post">
            <div>
                <h5>Titre</h5>
                <input type="text" name="designation" id="designation" placeholder="Titre" required class="form-control">
            </div>
            <div>
                <h5>Détails</h5>
                <input type="text" name="contenu" id="contenu" placeholder="détails" class="form-control">
                <samll class="form-text text-secondary">Optionel</samll>
            </div>
            <div class="d-flex">
                <div>
                    <h5>Heure de début</h5>
                    <input type="time" id="heureDebut" name="heureDebut" required>
                </div>
                <div class="ml-2">
                    <h5>Heure de fin</h5>
                    <input type="time" id="heureFin" name="heureFin">
                <samll id="contenuHelp" class="form-text text-secondary">Optionel</samll>
                </div>
            </div>
            <button type="submit" class="btn btn-primary text-white">Valider</button>
        </form>
    </div>
</div>