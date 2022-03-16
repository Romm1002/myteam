<?php
require_once "header.php";
?>

<head>
    <link rel="stylesheet" href="styles/styleRaisonRefus.css">
</head>

<body>
    <div class="circle1"></div>
    <div class="circle2"></div>

    <div class="container">
        <div class="container-header">
            <h1>Raison du refus</h1>
        </div>

        <div class="container-content">
            <form action="../traitements/refuserConge.php" method="POST">
                <input type="text" name="raison_refus" placeholder="Raison du refus (optionnel)">
                <input type="hidden" name="idConge" value="<?=$_GET["id"];?>">
                <button type="submit">VALIDER</button>
            </form>
        </div>
    </div>
</body>