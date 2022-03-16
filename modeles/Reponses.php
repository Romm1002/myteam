<?php
class Reponses extends Modele{
    private $idReponse;
    private $idPublication;
    private $reponse;
    private $utilisateur;

    public function initialiser($idReponse, $idPublication, $reponse, $utilisateur){
        $this->idReponse = $idReponse;
        $this->idPublication = $idPublication;
        $this->reponse = $reponse;
        $this->utilisateur = $utilisateur;
    }

    public function getId(){
        return $this->idReponse;
    }
    public function getIdPublication(){
        return $this->idPublication;
    }
    public function getReponse(){
        return $this->reponse;
    }
    public function getUtilisateur(){
        return $this->utilisateur;
    }

    //Permet d'insérer en BDD la réponse à une publication
    public function newReponse($idPublication, $reponse, $idUtilisateur){
        try{
            $requete = $this->getBdd()->prepare("INSERT INTO reponses(idPublication, reponse, idUtilisateur) VALUES(?, ?, ?)");
            $requete->execute([$idPublication, $reponse, $idUtilisateur]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    // Pour PHPUnit
    public function deleteReponse($idReponse){
        try{
            $requete = $this->getBdd()->prepare("DELETE FROM reponses WHERE idReponse = ? ORDER BY idReponse DESC LIMIT 1");
            $requete->execute([$idReponse]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}
?>