<?php
require_once "modeles/ModeleTest.php";
require_once "modeles/Planifications.php";

use PHPUnit\Framework\TestCase;

class PlanificationsTest extends TestCase
{
    // ------------------------
    // MÉTHODES
    // ------------------------
    public function testInsertRatio(){
        $Plannifications = new Plannifications();

        $this->assertTrue($Plannifications->insert_ratio(1, 1, "2022-02-10", 1));
    }

    public function testUpdateratio(){
        $Modele = new Modele();
        $Plannifications = new Plannifications();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM plannifications ORDER BY idPlannification DESC LIMIT 1");
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);

        $Plannifications->setIdUtilisateur($result["idUtilisateur"]);
        $Plannifications->setIdProjet($result["idProjet"]);
        $Plannifications->setDate($result["date"]);

        $this->assertTrue($Plannifications->update_ratio(1, 1, 1, "2022-02-10"));
    }

    public function testDeleteRatio(){
        $Modele = new Modele();
        $Plannifications = new Plannifications();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM plannifications ORDER BY idPlannification DESC LIMIT 1");
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);

        $this->assertTrue($Plannifications->delete_ratio($result["idUtilisateur"], $result["idProjet"], $result["date"]));
    }
}
?>