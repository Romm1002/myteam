<?php
require_once "../traitements/header.php";
?>

<body id="bodyVisiteur">
    <video style="z-index: -1" muted autoplay loop id="BgInscription">
        <source src="images/bg2.mp4" type="video/mp4">
    </video>

    <nav>
        <img src="images/logo.png" width="350">
    </nav>

    <hr>

    <div id="global" class="border border-dark w-75 p-3 rounded mr-5 mr-auto ml-auto mb-4">
        <div class="alert alert-danger alert-dismissible fade show text-center ml-auto mr-auto w-75" role="alert">
            <h1 class="h5">
                Vous n'êtes pas encore affilié(e) à une entreprise !
                <br>
                Cette page est donc le l'unique intérêt de vous présenter My Team !
            </h1>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class=" container w-75 rounded text-dark mb-4">
            <div id="carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel" data-slide-to="1"></li>
                    <li data-target="#carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="images/slide1.png" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h2>Gestion d'entreprise</h2>
                            <p>Ma gestion d'entreprise n'a jamais été si facile !</p>
                        </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/slide2.png" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                            <h2>Administration facile</h2>
                            <p>Pas besoin d'être développeur pour gérer le contenu de My Team !</p>
                        </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/slide3.png" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                            <h2>Accessibilité</h2>
                            <p>La prise en main de My Team vous prendra très peu de temps !</p>
                        </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

        <div class="row p-3 ml-auto mr-auto">
        <div class="col-3">
            <div class="card mr-3 border border-dark jauge" style="width: 13rem; height: 13rem">
                <img class="card-img-top ml-auto mr-auto mt-5" src="images/planning.png" id="imagesFonctionnalites" alt="Planning">
                <div class="card-body text-center">
                    <h5 class="card-title">Gestion de planning & de congé</h5>
                    <span class="jauge-remplissage"></span>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card mr-3 border border-dark jauge" style="width: 13rem; height: 13rem">
            <img class="card-img-top ml-auto mr-auto mt-5" src="images/messagerie.png" id="imagesFonctionnalites" alt="Messagerie">
                <div class="card-body text-center">
                    <h5 class="card-title">Messagerie instantanée</h5>
                    <span class="jauge-remplissage"></span>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card mr-3 border border-dark jauge" style="width: 13rem; height: 13rem">
            <img class="card-img-top ml-auto mr-auto mt-5" src="images/risks.png" id="imagesFonctionnalites" alt="Projets">
                <div class="card-body text-center">
                    <h5 class="card-title">Gestion de projet</h5>
                    <span class="jauge-remplissage"></span>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card mr-3 border border-dark jauge" style="width: 13rem; height: 13rem">
            <img class="card-img-top ml-auto mr-auto mt-5" src="images/rating.png" id="imagesFonctionnalites" alt="Posts">
                <div class="card-body text-center">
                    <h5 class="card-title">Réseau social</h5>
                    <span class="jauge-remplissage"></span>
                </div>
            </div>
        </div>
        </div>
    </div>

    

    <div class="text-center p-3 text-black" style="background-color: rgba(0, 0, 0, 0.5); color: white">
        © 2021 Copyright
    </div>
</body>

<?php
if(!empty($_SESSION["email"])){
    ?>
    <a href="deconnexion.php" id="deconnexion" class="btn btn-outline-danger position-absolute">Déconnexion</a>
    <?php
}
?>