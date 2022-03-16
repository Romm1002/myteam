<?php
require_once "modeles/ModeleTest.php";
require_once "modeles/Conges.php";

use PHPUnit\Framework\TestCase;

class CongesTest extends TestCase
{
    // ------------------------
    // MÉTHODES
    // ------------------------
    public function testNouveauConge(){
        $Conges = new Conges();

        $this->assertIsBool(true, $Conges->nouveauConge(1, "2022-02-10", "2022-06-20", "commentaire", 1, "raison"));
    }

    public function testSupprimerConge(){
        $Modele = new Modele();
        $Conges = new Conges();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM conges ORDER BY idConge DESC LIMIT 1");
        $requete->execute();
        $fetch = $requete->fetch(PDO::FETCH_ASSOC)["idConge"];

        $this->assertTrue($Conges->supprimerConge($fetch));
    }

    public function testGetConges(){
        $Conges = new Conges();

        $this->assertGreaterThanOrEqual(1, count($Conges->getConges()));
    }
}
?>