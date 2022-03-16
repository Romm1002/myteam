<?php
require_once "modeles/ModeleTest.php";
require_once "modeles/Publications.php";

use PHPUnit\Framework\TestCase;

class PublicationsTest extends TestCase
{
    // ------------------------
    // MÉTHODES
    // ------------------------
    public function testNewPublication(){
        $Publication = new Publication();

        $this->assertTrue($Publication->newPublication("contenu", "2022-02-10", 1, "annonce"));
    }

    public function testDeletePublication(){
        $Modele = new Modele();
        $Publication = new Publication();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM publications ORDER BY idPublication DESC LIMIT 1");
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);

        $this->assertTrue($Publication->deletePublication($result["idPublication"]));
    }
}
?>