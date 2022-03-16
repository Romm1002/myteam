<?php
class Taches extends Modele{

    private $idTache;
    private $libelle;
    private $terminee;
    private $idProjet;
    private $idUtilisateur;
    private $idTacheParent;
    private $dateFin;
    private $nom;
    private $prenom;

    public function initialiser($idTache, $libelle, $idProjet, $idUtilisateur, $idTacheParent, $dateFin, $nom, $prenom){
        $this->idTache = $idTache;
        $this->libelle = $libelle;
        $this->idProjet = $idProjet;
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
    public function getIdTacheParent(){
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
    public function getIdProjet(){
        return $this->idProjet;
    }

    // Update la valeur de terminee en BDD pour dire qu'une tâche est terminée
    public function terminer_tache($valeur, $idTache){
        try{
            $requete = $this->getBdd()->prepare("UPDATE tachesprojet SET terminee = ? WHERE idTache = ?");
            $requete->execute([$valeur, $idTache]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    
    // Création d'une nouvelle tâche
    public function nouvelle_tache($libelle, $idProjet, $idUtilisateur, $idTacheParent, $terminee, $dateFin){
        try{
            $requete = $this->getBdd()->prepare("INSERT INTO tachesprojet(libelle, idProjet, idUtilisateur, idTacheParent, terminee, dateFin) VALUES(?, ?, ?, ?, ?, ?)");
            $requete->execute([$libelle, $idProjet, $idUtilisateur, $idTacheParent, $terminee, $dateFin]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    // Pour PHPUnit
    public function supprimer_tache(){
        try{
            $requete = $this->getBdd()->prepare("DELETE FROM tachesprojet ORDER BY idTache DESC LIMIT 1");
            $requete->execute();
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}
?>