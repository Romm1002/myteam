<head>
    <link rel="stylesheet" href="../pages/styles/styleCookies.css">
</head>

<?php
    if(isset($_POST["accepter_cookie"]) && $_POST["accepter_cookie"] == 1 || isset($_COOKIE["accept_cookie"]) && $_COOKIE["accept_cookie"] == 1){
        $accept_cookie = 1;
    }else{
        $accept_cookie = 0;
    }

    if($accept_cookie == 1){
        setcookie("accept_cookie", $accept_cookie, time()+60*60*24, "/", "myteam.ipssi-sio.fr", true, true);
    }else{
        ?>
        <form method="post" style="<?=$accept_cookie == 1 ? "display: none;" : "";?>" id="popup-cookies">
            <div>
                <div class="header">
                    <img src="../pages/images/cookies.png" alt="Image cookies">
                </div>
                <div class="title">
                    <h1>Heya ! Ce site utilise les cookies.</h1>
                </div>
                <div class="content">
                    <p>Les cookies permettent à l'éditeur du site Web de faire des choses utiles comme découvrir si l'ordinateur (et probablement cet utilisateur) a déjà visité le site.</p>
                </div>
                <div class="button">
                    <button type="submit" name="accepter_cookie" value="1">J'accepte les cookies</button>
                </div>
            </div>
        </form>
        <?php
    }
?>