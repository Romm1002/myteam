<?php
require_once "modeles/ModeleTest.php";
require_once "modeles/Projets.php";

use PHPUnit\Framework\TestCase;

class ProjetsTest extends TestCase
{
    public function testSelectionParticipants(){
        $projet = new Projets;
        $this->assertIsArray($projet->selectionParticipants(1));
    }
    public function testGetChatProjet(){
        $projet = new Projets;
        $this->assertIsArray($projet->getChatProjet());
    }
    public function testGetTaches(){
        $projet = new Projets;
        $this->assertIsArray($projet->getTaches());
    }
}
