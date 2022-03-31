<?php
require_once "header.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="styles/styleMentions_Legales.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>

<body>
    <main>
        <img id="logoMYTeam" src="images/logoMYTEAM/logo.svg" alt="Logo MYTeam">

        <div class="circle1"></div>
        <div class="circle2"></div>

        <?php
        if (empty($_GET)) {
        ?>
            <div class="mentions_legales">
                <div>
                    <a href="accueil.php"><i class="fas fa-arrow-circle-left"></i> Retour</a>
                </div>
                <div class="title">
                    <h1>
                        MENTIONS LÉGALES
                    </h1>
                </div>

                <div class="zones">
                    <div class="zone">
                        <div class="illustration">
                            <img src="images/mentions_legales/img1.png" alt="Image 1">
                        </div>
                        <div class="texte">Mes donn&#233es personelles.</div>
                        <div class="action">
                            <a href="mentions_legales.php?ml=dp">></a>
                        </div>
                    </div>

                    <div class="zone">
                        <div class="illustration">
                            <img src="images/mentions_legales/img2.png" alt="Image 2">
                        </div>
                        <div class="texte">Pourquoi MYTeam collecte mes informations ?</div>
                        <div class="action">
                            <a href="mentions_legales.php?ml=pourquoi">></a>
                        </div>
                    </div>
                    <div class="zone">
                        <div class="illustration">
                            <img src="images/mentions_legales/img3.png" alt="Image 3">
                        </div>
                        <div class="texte">Quels moyens sont utilis&#233s pour collecter mes donn&#233es ?</div>
                        <div class="action">
                            <a href="mentions_legales.php?ml=moyens">></a>
                        </div>
                    </div>
                    <div class="zone">
                        <div class="illustration">
                            <img src="images/mentions_legales/img4.png" alt="Image 4">
                        </div>
                        <div class="texte">Que deviennent mes donn&#233es ?</div>
                        <div class="action">
                            <a href="mentions_legales.php?ml=dp2">></a>
                        </div>
                    </div>
                    <div class="zone">
                        <div class="illustration">
                            <img src="images/mentions_legales/img5.png" alt="Image 5">
                        </div>
                        <div class="texte">Quels sont mes droits vis-&#224-vis de mes donn&#233es ?</div>
                        <div class="action">
                            <a href="mentions_legales.php?ml=droits">></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        if (!empty($_GET)) {
            switch ($_GET["ml"]) {
                case "dp":
            ?>
                    <div class="mentions_legales" style="padding: 0px 30px;">
                        <a href="mentions_legales.php"><i class="fas fa-arrow-circle-left"></i> Retour</a>
                        <div class="title">
                            <h1>Mes donn&#233es personnelles.</h1>
                        </div>

                        <div class="texte">
                            <h1>Qu&#39est-ce qu&#39une donn&#233e personnelle ?</h1>
                            <p>Une donn&#233e personnelle est toute information se rapportant &#38 une personne physique identifi&#233e ou identifiable. Mais, parce qu’elles concernent des personnes, celles-ci doivent en conserver la maîtrise.</p>
                        </div>
                        <div class="texte">
                            <h1>Quelles sont mes donn&#233es personnelles collect&#233es ?</h1>
                            <p>MYTeam peut &#234tre amen&#233 &#38 collecter vos nom, pr&#233nom, adresse email, mot de passe ainsi que vos date de naissance.</p>
                        </div>
                        <div class="texte">
                            <h1>Qui est responsable du traitement sur mes donn&#233es ?</h1>
                            <p>Le responsable de traitement est la personne, l’autorit&#233 publique ou l’organisme qui d&#233termine les finalit&#233s c’est-&#38-dire &#38 quoi servent les donn&#233es et les moyens.</p>
                            <p>Romain Chaumont est l&#39unique responsable de traitement de MYTeam.</p>
                        </div>
                    </div>
                <?php
                    break;

                case "pourquoi":
                ?>
                    <div class="mentions_legales" style="padding: 0px 30px;">
                        <a href="mentions_legales.php"><i class="fas fa-arrow-circle-left"></i> Retour</a>
                        <div class="title">
                            <h1>Pourquoi MYTeam collecte mes informations ?</h1>
                        </div>

                        <div class="texte">
                            <h1>Identit&#233 des personnes</h1>
                            <p>Nom, pr&#233nom, adresse de courrier &#233lectronique, date de naissance, code interne de traitement permettant l’identification du client.</p>
                            <p>Ces donn&#233es seront conserv&#233es pendant 3 ans apres le dernier contact ou la fin de la relation professionelle.</p>
                        </div>
                    </div>
                <?php
                    break;

                case "moyens":
                ?>
                    <div class="mentions_legales" style="padding: 0px 30px;">
                        <a href="mentions_legales.php"><i class="fas fa-arrow-circle-left"></i> Retour</a>
                        <div class="title">
                            <h1>Quels moyens sont utilis&#233s pour collecter mes donn&#233es ?</h1>
                        </div>

                        <div class="texte">
                            <h1>Sur le site MYTeam</h1>
                            <p>Sur notre site, par le biais de nos formulaires en ligne, vous allez &#234tre amen&#233 &#38 nous fournir des informations. Une information sur vos droits relatifs &#38 la loi informatique et libert&#233 est pr&#233cis&#233e sur chaque formulaire.</p>
                        </div>
                    </div>
                <?php
                    break;

                case "dp2":
                ?>
                    <div class="mentions_legales" style="padding: 0px 30px;">
                        <a href="mentions_legales.php"><i class="fas fa-arrow-circle-left"></i> Retour</a>
                        <div class="title">
                            <h1>Que deviennent mes donn&#233es ?</h1>
                        </div>

                        <div class="texte">
                            <h1>S&#233curit&#233</h1>
                            <p>MYTeam est attentif &#38 la s&#233curit&#233 de vos donn&#233es personnelles et met en œuvre toutes les mesures techniques et organisationnelles appropri&#233es au regard de la nature, de la port&#233e et du contexte des donn&#233es que vous nous communiquez.</p>
                            <p>Ces mesures visent &#38 pr&#233server la s&#233curit&#233 de vos donn&#233es et emp&#234cher toute destruction, perte, alt&#233ration, divulgation, intrusion ou acc&#xE8s non autoris&#233 &#38 ces donn&#233es, de mani&#xE8re accidentelle ou illicite.</p>
                            <p>Vos donn&#233es personnelles sont stock&#233es sur des serveurs s&#233curis&#233s, accessibles &#38 un nombre limit&#233 de personnes ayant des droits d&#39acc&#xE8s sp&#233cifiques &#38 ces syst&#xE8mes.</p>
                        </div>
                    </div>
                <?php
                    break;

                case "droits":
                ?>
                    <div class="mentions_legales" style="padding: 0px 30px;">
                        <a href="mentions_legales.php"><i class="fas fa-arrow-circle-left"></i> Retour</a>
                        <div class="title">
                            <h1>Quels sont mes droits vis-&#224-vis de mes donn&#233es ?</h1>
                        </div>

                        <div class="texte">
                            <h1>D&#39un droit d&#39acc&#xE8s :</h1>
                            <p>Le droit pour toute personne d&#39obtenir la communication de toutes les informations la concernant d&#233tenues par MYTeam.</p>
                        </div>
                        <div class="texte">
                            <h1>D&#39un droit de rectification :</h1>
                            <p>Le droit pour toute personne d&#39obtenir la rectification des informations inexactes la concernant d&#233tenues par MYTeam.</p>
                        </div>
                        <div class="texte">
                            <h1>D&#39un droit d&#39opposition :</h1>
                            <p>Le droit d&#39opposition s&#39exerce soit au moment de la collecte d&#39informations, soit plus tard, en s&#39adressant au responsable du fichier. Il se d&#233cline en deux possibilit&#233s :</p>
                            <p>
                                Le droit pour toute personne &#38 s&#39opposer, pour des motifs l&#233gitimes, &#38 figurer dans un fichier. C’est le droit de suppression.<br />
                                Le droit pour toute personne &#38 s’opposer, pour des motifs l&#233gitimes, &#38 un traitement bas&#233 sur l’int&#233r&#234t l&#233gitime de MYTeam.<br />
                                En mati&#xE8re de prospection commerciale, toute personne peut s&#39opposer &#38 tout moment &#38 ce que ses donn&#233es soient diffus&#233es, transmises ou conserv&#233es. Ce droit peut s&#39exercer sans avoir &#38 justifier d&#39un motif l&#233gitime.
                            </p>
                        </div>
                        <div class="texte">
                            <h1>D&#39un droit de d&#233finir des directives relatives au sort de mes donn&#233es &#38 caract&#xE8re personnel apr&#xE8s mon d&#233c&#xE8s.</h1>
                            <p>En l&#39absence de directives ou de mention contraire dans lesdites directives, les h&#233ritiers de la personne concern&#233e peuvent apr&#xE8s son d&#233c&#xE8s exercer les droits sur les donn&#233es personnelles du d&#233funt.</p>
                        </div>
                        <div class="texte">
                            <h1>D&#39un droit de limitation du traitement.</h1>
                            <p>C&#39est le droit de faire suspendre un traitement le temps qu&#39une v&#233rification puisse avoir lieu (v&#233rifier l&#39exactitude des donn&#233es personnelles, v&#233rifier si les motifs l&#233gitimes donn&#233s par la personne pr&#233valent sur ceux du responsable de traitement dans le cas d&#39une demande d&#39opposition etc.)</p>
                        </div>
                        <div class="texte">
                            <h1>D&#39un droit de portabilit&#233.</h1>
                            <p>La personne a le droit d&#39obtenir que ses donn&#233es &#38 caract&#xE8re personnel soient transmises dans un format structur&#233</p>
                            <p>
                                A elle-m&#234me<br />
                                Directement d&#39un responsable du traitement &#38 un autre, lorsque cela est techniquement possible
                            </p>
                        </div>
                        <div class="texte">
                            <h1>D&#39un droit d&#39introduire une r&#233clamation aupr&#xE8s d&#39une autorit&#233 de contrôle.</h1>
                            <p>Pour plus d&#39informations concernant l&#39exercice de vos droits : <br /> <a href="https://www.cnil.fr/fr/comprendre-vos-droits" target="_blank" rel="noreferrer noopener">https://www.cnil.fr/fr/comprendre-vos-droits</a></p>
                        </div>
                    </div>
        <?php
                    break;
            }
        }
        ?>
    </main>
</body>

</html>