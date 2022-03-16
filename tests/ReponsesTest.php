<?php
require_once "modeles/ModeleTest.php";
require_once "modeles/Reponses.php";

use PHPUnit\Framework\TestCase;

class ReponsesTest extends TestCase
{
    // ------------------------
    // MÉTHODES
    // ------------------------
    public function testNewReponse(){
        $Reponses = new Reponses();

        $this->assertTrue($Reponses->newReponse(1, "reponse", 1));
    }

    public function testDeleteReponse(){
        $Modele = new Modele();
        $Reponses = new Reponses();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM reponses ORDER BY idReponse DESC LIMIT 1");
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);

        $this->assertTrue($Reponses->deleteReponse($result["idReponse"]));
    }
}
?>