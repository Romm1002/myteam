<?php
class Taches extends Modele{

    private $idTache;
    private $libelle;
    private $terminee;

    public function initialiser($idTache, $libelle, $terminee){
        $this->idTache = $idTache;
        $this->libelle = $libelle;
        $this->terminee = $terminee;
    }

    public function getId(){
        return $this->idTache;
    }
    public function getLibelle(){
        return $this->libelle;
    }
    public function getTerminee(){
        return $this->terminee;
    }

    // Update la valeur de terminee en BDD pour dire qu'une tâche est terminée
    public function terminer_tache($valeur, $idTache){
        $requete = $this->getBdd()->prepare("UPDATE tachesprojet SET terminee = ? WHERE idTache = ?");
        $requete->execute([$valeur, $idTache]);
    }
    
    // Création d'une nouvelle tâche
    public function nouvelle_tache($libelle, $terminee, $idProjet){
        $requete = $this->getBdd()->prepare("INSERT INTO tachesprojet(libelle, terminee, idProjet) VALUES(?, ?, ?)");
        $requete->execute([$libelle, $terminee, $idProjet]);
    }
}
?>