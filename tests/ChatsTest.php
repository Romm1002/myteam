<?php
require_once "modeles/ModeleTest.php";
require_once "modeles/Utilisateurs.php";
require_once "modeles/Chats.php";

use PHPUnit\Framework\TestCase;

class ChatsTest extends TestCase
{
    public function testGetId()
    {
        $utilisateur = new Utilisateurs();
        $utilisateur->initialiser("nom", "prenom", "photo", 1, "couleur");
        $chat = new Chats();
        $chat->initialiser(1, $utilisateur, "2022-03-15 10:10:10", "message", 1);
        $this->assertSame(1, $chat->getId());
    }
    public function testGetUtilisateur()
    {
        $utilisateur = new Utilisateurs();
        $utilisateur->initialiser("nom", "prenom", "photo", 1, "couleur");
        $chat = new Chats();
        $chat->initialiser(1, $utilisateur, "2022-03-15 10:10:10", "message", 1);
        $this->assertSame($utilisateur, $chat->getUtilisateur());
    }
    public function testGetDate()
    {
        $utilisateur = new Utilisateurs();
        $utilisateur->initialiser("nom", "prenom", "photo", 1, "couleur");
        $chat = new Chats();
        $chat->initialiser(1, $utilisateur, "2022-03-15 10:10:10", "message", 1);
        $this->assertSame("2022-03-15 10:10:10", $chat->getDateMessage());
    }
    public function testGetMessage()
    {
        $utilisateur = new Utilisateurs();
        $utilisateur->initialiser("nom", "prenom", "photo", 1, "couleur");
        $chat = new Chats();
        $chat->initialiser(1, $utilisateur, "2022-03-15 10:10:10", "message", 1);
        $this->assertSame("message", $chat->getMessage());
    }
    public function testGetIdProjet()
    {
        $utilisateur = new Utilisateurs();
        $utilisateur->initialiser("nom", "prenom", "photo", 1, "couleur");
        $chat = new Chats();
        $chat->initialiser(1, $utilisateur, "2022-03-15 10:10:10", "message", 1);
        $this->assertSame(1, $chat->getIdProjet());
    }
    public function testNew_chat()
    {
        $chat = new Chats;
        $this->assertTrue($chat->new_chat(1, "2022-03-15 10:10:10", "message", 1));
    }
    public function testDelete_chat()
    {
        $chat = new Chats;
        $app = new Modele;
        $requete = $app->getBdd()->prepare("SELECT idMessage FROM chatprojet ORDER BY idMessage DESC LIMIT 1;");
        $requete->execute();
        $this->assertTrue($chat->delete_chat($requete->fetch(PDO::FETCH_ASSOC)["idMessage"]));
    }
    public function testRecuperationInformationsContact()
    {
        $chat = new Chats;

        $this->assertGreaterThanOrEqual(1 , count($chat->recuperationInformationsContact(1)));


    }
}
