<?php
class Taches extends Modele{

    private $idTache;
    private $libelle;
    private $terminee;
    private $idUtilisateur;
    private $idTacheParent;
    private $dateFin;
    private $nom;
    private $prenom;

    public function initialiser($idTache, $libelle, $terminee, $idUtilisateur, $idTacheParent, $dateFin, $nom, $prenom){
        $this->idTache = $idTache;
        $this->libelle = $libelle;
        $this->terminee = $terminee;
        $this->idUtilisateur = $idUtilisateur;
        $this->idTacheParent = $idTacheParent;
        $this->dateFin = $dateFin;
        $this->prenom = $prenom;
        $this->nom = $nom;
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
    public function getIdUtilisateur(){
        return $this->idUtilisateur;
    }
    public function getidTacheParent(){
        return $this->idTacheParent;
    }
    public function getDateFin(){
        return $this->dateFin;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function getNom(){
        return $this->nom;
    }

    // Update la valeur de terminee en BDD pour dire qu'une tâche est terminée
    public function terminer_tache($valeur, $idTache){
        $requete = $this->getBdd()->prepare("UPDATE tachesprojet SET terminee = ? WHERE idTache = ?");
        $requete->execute([$valeur, $idTache]);
    }
    
    // Création d'une nouvelle tâche
    public function nouvelle_tache($libelle, $idUtilisateur, $idTacheParent, $dateFin, $terminee, $idProjet){
        $requete = $this->getBdd()->prepare("INSERT INTO tachesprojet(libelle, idUtilisateur, idTacheParent, dateFin, terminee, idProjet) VALUES(?, ?, ?, ?, ?, ?)");
        $requete->execute([$libelle, $idUtilisateur, $idTacheParent, $dateFin, $terminee, $idProjet]);
    }
}
?>