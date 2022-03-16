<?php
require_once "modeles/ModeleTest.php";
require_once "modeles/Taches.php";

use PHPUnit\Framework\TestCase;

class TachesTest extends TestCase
{
    // ------------------------
    // GETTERS
    // ------------------------
    public function testGetId(){
        $Taches = new Taches();
        $Taches->initialiser("id", "libelle", "idProjet", "idUtilisateur", "idTacheParent", "dateFin", "nom", "prenom");
        $this->assertSame("id", $Taches->getId());
    }
    public function testGetLibelle(){
        $Taches = new Taches();
        $Taches->initialiser("id", "libelle", "idProjet", "idUtilisateur", "idTacheParent", "dateFin", "nom", "prenom");
        $this->assertSame("libelle", $Taches->getLibelle());
    }
    public function testGetIdProjet(){
        $Taches = new Taches();
        $Taches->initialiser("id", "libelle", "idProjet", "idUtilisateur", "idTacheParent", "dateFin", "nom", "prenom");
        $this->assertSame("idProjet", $Taches->getIdProjet());
    }
    public function testGetIdUtilisateur(){
        $Taches = new Taches();
        $Taches->initialiser("id", "libelle", "idProjet", "idUtilisateur", "idTacheParent", "dateFin", "nom", "prenom");
        $this->assertSame("idUtilisateur", $Taches->getIdUtilisateur());
    }
    public function testGetIdTacheParent(){
        $Taches = new Taches();
        $Taches->initialiser("id", "libelle", "idProjet", "idUtilisateur", "idTacheParent", "dateFin", "nom", "prenom");
        $this->assertSame("idTacheParent", $Taches->getIdTacheParent());
    }
    public function testGetDateFin(){
        $Taches = new Taches();
        $Taches->initialiser("id", "libelle", "idProjet", "idUtilisateur", "idTacheParent", "dateFin", "nom", "prenom");
        $this->assertSame("dateFin", $Taches->getDateFin());
    }
    public function testGetNom(){
        $Taches = new Taches();
        $Taches->initialiser("id", "libelle", "idProjet", "idUtilisateur", "idTacheParent", "dateFin", "nom", "prenom");
        $this->assertSame("nom", $Taches->getNom());
    }
    public function testGetPrenom(){
        $Taches = new Taches();
        $Taches->initialiser("id", "libelle", "idProjet", "idUtilisateur", "idTacheParent", "dateFin", "nom", "prenom");
        $this->assertSame("prenom", $Taches->getPrenom());
    }

    // ------------------------
    // MÉTHODES
    // ------------------------
    public function testNouvelleTache(){
        $Taches = new Taches();

        $this->assertIsBool(true, $Taches->nouvelle_tache("test", 1, 1, 1, 0, "2022-05-10"));
    }

    public function testTerminerTache(){
        $Modele = new Modele();
        $Taches = new Taches();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM tachesprojet ORDER BY idTache DESC LIMIT 1");
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);

        $this->assertIsBool(true, $Taches->terminer_tache(1, $result["idTache"]));
    }

    public function testSupprimerTache(){
        $Modele = new Modele();
        $Taches = new Taches();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM tachesprojet ORDER BY idTache DESC LIMIT 1");
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);

        $this->assertIsBool(true, $Taches->supprimer_tache($result["idTache"]));
    }
}
?>