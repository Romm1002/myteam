<?php
require_once "modeles/ModeleTest.php";
require_once "modeles/Evenements.php";

use PHPUnit\Framework\TestCase;

class EvenementsTest extends TestCase
{
    public function testGetId()
    {
        $evenement = new Evenements();
        $evenement->initialiser("designation", "2022-03-15", 1, "couleur", 0, "10:10:10", "10:10:10", 1);
        $this->assertSame(1, $evenement->getId());
    }
    public function testGetDesignation()
    {
        $evenement = new Evenements();
        $evenement->initialiser("designation", "2022-03-15", 1, "couleur", 0, "10:10:10", "10:10:10", 1);
        $this->assertSame("designation", $evenement->getDesignation());
    }
    public function testGetDate()
    {
        $evenement = new Evenements();
        $evenement->initialiser("designation", "2022-03-15", 1, "couleur", 0, "10:10:10", "10:10:10", 1);
        $this->assertSame("2022-03-15", $evenement->getDate());
    }
    public function testGetDebut()
    {
        $evenement = new Evenements();
        $evenement->initialiser("designation", "2022-03-15", 1, "couleur", 0, "10:10:10", "10:10:10", 1);
        $this->assertSame("10:10:10", $evenement->getHeureDebut());
    }
    public function testGetFin()
    {
        $evenement = new Evenements();
        $evenement->initialiser("designation", "2022-03-15", 1, "couleur", 0, "10:10:10", "10:10:10", 1);
        $this->assertSame("10:10:10", $evenement->getHeureFin());
    }
    public function testGetIdUtilisateur()
    {
        $evenement = new Evenements();
        $evenement->initialiser("designation", "2022-03-15", 1, "couleur", 0, "10:10:10", "10:10:10", 1);
        $this->assertSame(1, $evenement->getIdUtilisateur());
    }
    public function testGetCouleur()
    {
        $evenement = new Evenements();
        $evenement->initialiser("designation", "2022-03-15", 1, "couleur", 0, "10:10:10", "10:10:10", 1);
        $this->assertSame("couleur", $evenement->getCouleur());
    }
    public function testGetAdmin()
    {
        $evenement = new Evenements();
        $evenement->initialiser("designation", "2022-03-15", 1, "couleur", 0, "10:10:10", "10:10:10", 1);
        $this->assertSame(0, $evenement->getAdmin());
    }

    public function testAjoutEvenement()
    {
        $evenement = new Evenements;
        $evenement->initialiser("designation", "2022-03-15", 1, "couleur", 0, "10:10:10", "10:10:10");
        $this->assertTrue($evenement->ajoutEvenement());
    }

    public function testModifEvenement()
    {
        $app = new Modele;
        $requete = $app->getBdd()->prepare("SELECT idEvenement FROM evenements ORDER BY idEvenement DESC LIMIT 1;");
        $requete->execute();
        $id = $requete->fetch(PDO::FETCH_ASSOC)["idEvenement"];

        $evenement = new Evenements;
        $evenement->initialiser("designation", "2022-03-15", 1, "couleur", 0, "10:10:10", "10:10:10", $id);
        
        $evenement = new Evenements;
        $this->assertTrue($evenement->modifEvenement());
    }
    public function testSupprEvenement()
    {
        $app = new Modele;
        $requete = $app->getBdd()->prepare("SELECT idEvenement FROM evenements ORDER BY idEvenement DESC LIMIT 1;");
        $requete->execute();
        $id = $requete->fetch(PDO::FETCH_ASSOC)["idEvenement"];

        $evenement = new Evenements;
        $this->assertTrue($evenement->supprEvenement($id));
    }
}
