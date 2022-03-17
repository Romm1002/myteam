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

    public function testAccepterConge(){
        $Modele = new Modele();
        $Conges = new Conges();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM conges ORDER BY idConge DESC LIMIT 1");
        $requete->execute();
        $idConge = $requete->fetch(PDO::FETCH_ASSOC)["idConge"];

        $this->assertTrue($Conges->accepterConge(1, $idConge));
    }

    public function testRefuserConge(){
        $Modele = new Modele();
        $Conges = new Conges();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM conges ORDER BY idConge DESC LIMIT 1");
        $requete->execute();
        $idConge = $requete->fetch(PDO::FETCH_ASSOC)["idConge"];

        $this->assertTrue($Conges->refuserConge(2, "raison de test", $idConge));
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

        $this->assertGreaterThanOrEqual(0, count($Conges->getConges(1, 2)));
    }
}
?>