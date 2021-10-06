<?php

?>

<head>
    <link rel="stylesheet" href="styles/styleMentions_Legales.css">
</head>

<body>
    <img id="logoMYTeam" src="images/logoMYTEAM/logo.svg" alt="Logo MYTeam">

    <div class="circle1"></div>
    <div class="circle2"></div>

    <?php
    if(empty($_GET)){
    ?>
    <div class="mentions_legales">
        <div class="title">
            <h1>
                RESPECT DE LA VIE PRIVÉE<br />
                ET DES DONNÉES PERSONNELLES
            </h1>
        </div>

        <div class="zones">
            <div class="zone">
                <div class="illustration">
                    <img src="images/mentions_légales/img1.png" alt="Image 1">
                </div>
                <div class="texte">Mes données personelles.</div>
                <div class="action">
                    <a href="mentions_legales.php?ml=dp">-></a>
                </div>
            </div>

            <div class="zone">
                <div class="illustration">
                    <img src="images/mentions_légales/img2.png" alt="Image 2">
                </div>
                <div class="texte">Pourquoi MYTeam collecte mes informations ?</div>
                <div class="action">-></div>
            </div>
            <div class="zone">
                <div class="illustration">
                    <img src="images/mentions_légales/img3.png" alt="Image 3">
                </div>
                <div class="texte">Quels moyens sont utilisés pour collecter mes données ?</div>
                <div class="action">-></div>
            </div>
            <div class="zone">
                <div class="illustration">
                    <img src="images/mentions_légales/img4.png" alt="Image 4">
                </div>
                <div class="texte">Que deviennent mes données ?</div>
                <div class="action">-></div>
            </div>
            <div class="zone">
                <div class="illustration">
                    <img src="images/mentions_légales/img5.png" alt="Image 5">
                </div>
                <div class="texte">Quels sont mes droits vis-à-vis de mes données ?</div>
                <div class="action">+</div>
            </div>
            
        </div>
    </div>
    <?php
    }

    if(!empty($_GET)){
        if($_GET["ml"] == "dp"){
            ?>
            <div class="mentions_legales" style="padding: 0px 30px;">
                <div class="title">
                    <h1>Mes données personnelles.</h1>
                </div>

                <div class="texte">
                    <h1>Qu'est-ce qu'une donnée personnelle ?</h1>
                    <p>Une donnée personnelle est toute information se rapportant à une personne physique identifiée ou identifiable. Mais, parce qu’elles concernent des personnes, celles-ci doivent en conserver la maîtrise.</p>
                </div>
            </div>
            <?php
        }
    }
    ?>
</body>