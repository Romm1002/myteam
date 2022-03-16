<?php
require_once "modeles/ModeleTest.php";
require_once "modeles/Utilisateurs.php";

use PHPUnit\Framework\TestCase;

class UtilisateursTest extends TestCase
{
        // ------------------------
        // GETTERS
        // ------------------------
    public function testGetNom(){
        $Utilisateurs = new Utilisateurs();
        $Utilisateurs->initialiser("nom", "prenom", "photo", 1, "couleur");
        $this->assertSame("nom", $Utilisateurs->getNom());
    }
    public function testGetPrenom(){
        $Utilisateurs = new Utilisateurs();
        $Utilisateurs->initialiser("nom", "prenom", "photo", 1, "couleur");
        $this->assertSame("prenom", $Utilisateurs->getPrenom());
    }
    public function testGetPhoto(){
        $Utilisateurs = new Utilisateurs();
        $Utilisateurs->initialiser("nom", "prenom", "photo", 1, "couleur");
        $this->assertSame("photo", $Utilisateurs->getPhotoProfil());
    }
    public function testGetId(){
        $Utilisateurs = new Utilisateurs();
        $Utilisateurs->initialiser("nom", "prenom", "photo", 1, "couleur");
        $this->assertIsInt(1, $Utilisateurs->getId());
    }
    public function testGetCouleur(){
        $Utilisateurs = new Utilisateurs();
        $Utilisateurs->initialiser("nom", "prenom", "photo", 1, "couleur");
        $this->assertSame("couleur", $Utilisateurs->getCouleur());
    }

    // ------------------------
    // MÉTHODES
    // ------------------------
    public function testInscription(){
        $Utilisateurs = new Utilisateurs();

        $this->assertIsBool(true, $Utilisateurs->inscription("nom", "prenom", "2002-02-10", "email2@email.fr", "mdp", 1, "photoProfil", 0));
    }

    public function testVerificationEmail(){
        $Modele = new Modele();
        $Utilisateurs = new Utilisateurs();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM utilisateurs ORDER BY idUtilisateur DESC LIMIT 1");
        $requete->execute();
        $fetch = $requete->fetch(PDO::FETCH_ASSOC)["email"];

        $this->assertEquals(1, $Utilisateurs->verification_email($fetch));
    }

    public function testConnexion(){
        $Modele = new Modele();
        $Utilisateurs = new Utilisateurs();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM utilisateurs ORDER BY idUtilisateur DESC LIMIT 1");
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC)["email"];
        
        $Utilisateurs->setEmail($result);

        $this->assertGreaterThanOrEqual(1, count($Utilisateurs->connexion($result)));
    }

    public function testUpdateFirstConnexion(){
        $Modele = new Modele();
        $Utilisateurs = new Utilisateurs();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM utilisateurs ORDER BY idUtilisateur DESC LIMIT 1");
        $requete->execute();

        $Utilisateurs->setIdUtilisateur($requete->fetch(PDO::FETCH_ASSOC)["idUtilisateur"]);

        $this->assertIsBool(true, $Utilisateurs->update_firstConnexion(0));
    }

    public function testUpdateProfil(){
        $Modele = new Modele();
        $Utilisateurs = new Utilisateurs();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM utilisateurs ORDER BY idUtilisateur DESC LIMIT 1");
        $requete->execute();
        
        $Utilisateurs->setIdUtilisateur($requete->fetch(PDO::FETCH_ASSOC)["idUtilisateur"]);

        $this->assertIsBool(true, $Utilisateurs->updateProfil("admin", "admin", "admin@myteam.fr", "#ffffff"));
    }

    public function testUpdatePhotoProfil(){
        $Modele = new Modele();
        $Utilisateurs = new Utilisateurs();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM utilisateurs ORDER BY idUtilisateur DESC LIMIT 1");
        $requete->execute();

        $Utilisateurs->setIdUtilisateur($requete->fetch(PDO::FETCH_ASSOC)["idUtilisateur"]);

        $this->assertIsBool(true, $Utilisateurs->updatePhotoProfil("newPhoto"));

    }

    public function testUpdateMdp(){
        $Modele = new Modele();
        $Utilisateurs = new Utilisateurs();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM utilisateurs ORDER BY idUtilisateur DESC LIMIT 1");
        $requete->execute();

        $Utilisateurs->setIdUtilisateur($requete->fetch(PDO::FETCH_ASSOC)["idUtilisateur"]);

        $this->assertIsBool(true, $Utilisateurs->updateMdp("newMdp"));
    }

    public function testUpdateToken(){
        $Modele = new Modele();
        $Utilisateurs = new Utilisateurs();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM utilisateurs ORDER BY idUtilisateur DESC LIMIT 1");
        $requete->execute();

        $Utilisateurs->setIdUtilisateur($requete->fetch(PDO::FETCH_ASSOC)["idUtilisateur"]);

        $this->assertIsBool(true, $Utilisateurs->token($requete->fetch(PDO::FETCH_ASSOC), "0"));
    }

    public function testDeleteProfil(){
        $Modele = new Modele();
        $Utilisateurs = new Utilisateurs();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM utilisateurs ORDER BY idUtilisateur DESC LIMIT 1");
        $requete->execute();

        $Utilisateurs->setIdUtilisateur($requete->fetch(PDO::FETCH_ASSOC)["idUtilisateur"]);

        $this->assertIsBool(true, $Utilisateurs->supprimer_compte());
    }
}
?>