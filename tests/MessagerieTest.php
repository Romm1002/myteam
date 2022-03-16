<?php
require_once "modeles/ModeleTest.php";
require_once "modeles/Messagerie.php";

use PHPUnit\Framework\TestCase;

class MessagerieTest extends TestCase
{
    public function testRecuperationInformationsContact(){
        $messagerie = new Messagerie;

        $this->assertGreaterThanOrEqual(1, count($messagerie->recuperationInformationsContact(1)));
    }

    public function testNewMessage(){
        $messagerie = new Messagerie;
        $messagerie->recuperationInformationsContact(1);
        $this->assertTrue($messagerie->newMessage(1, "contenu"));
    }

    public function testSignalerMessage(){
        $Modele = new Modele();
        $Messagerie = new Messagerie();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM messagerie ORDER BY idMessage DESC LIMIT 1");
        $requete->execute();

        $idMessage = $requete->fetch(PDO::FETCH_ASSOC)["idMessage"];

        $this->assertTrue($Messagerie->signalerMessage($idMessage, "contenu", 0, 1, 1));
    }

    public function testDeleteMessage(){
        $messagerie = new Messagerie;
        $app = new Modele;
        
        $requete = $app->getBdd()->prepare("SELECT * FROM messagerie ORDER BY idMessage DESC LIMIT 1;");
        $requete->execute();
        $idMessage = $requete->fetch(PDO::FETCH_ASSOC)["idMessage"];

        $this->assertTrue($messagerie->deleteMessage($idMessage));
    }

    public function testDeleteMessageSignale(){
        $Modele = new Modele();
        $Messagerie = new Messagerie();

        $requete = $Modele->getBdd()->prepare("SELECT * FROM messages_signales ORDER BY idMessageSignaler DESC LIMIT 1");
        $requete->execute();
        $idMessageSignale = $requete->fetch(PDO::FETCH_ASSOC)["idMessageSignaler"];

        $this->assertTrue($Messagerie->deleteMessageSignale($idMessageSignale));
    }
}
