<?php
class Publication extends Modele{

    private $idPublication;
    private $contenuPublication;
    private $datePublication;
    private $utilisateur;
    private $typePublication;
    private $jaime;

    public function __construct($idPublication = null){
        if ($idPublication != null){
            $requete = $this->getBdd()->prepare("SELECT * FROM publications WHERE idPublication = ?");
            $requete->execute([$idPublication]);
            $value = $requete->fetch(PDO::FETCH_ASSOC);
            $this->idPublication = $value["idPublication"];
            $this->contenuPublication = $value["contenuPublication"];
            $this->datePublication = $value["datePublication"];
            $this->utilisateur = $value["utilisateur"];
            $this->typePublication = $value["typePublication"];
            $this->jaime = $value["jaime"];
        }
    }

    public function initialiser($idPublication, $contenuPublication, $datePublication, $utilisateur, $typePublication, $jaime){
        $this->idPublication = $idPublication;
        $this->contenuPublication = $contenuPublication;
        $this->datePublication = $datePublication;
        $this->utilisateur = $utilisateur;
        $this->typePublication = $typePublication;
        $this->jaime = $jaime;
    }

    public function getId(){
        return $this->idPublication;
    }
    public function getDate(){
        return $this->datePublication;
    }
    public function getContenu(){
        return $this->contenuPublication;
    }
    public function getUtilisateur(){
        return $this->utilisateur;
    }
    public function getType(){
        return $this->typePublication;
    }
    public function getJaime(){
        return $this->jaime;
    }

    // Permet de créer une nouvelle publication et de gérer son BG en fonction du type de publication
    public function newPublication($contenu, $date, $idUtilisateur, $typePublication){
        try{
            $requete = $this->getBdd()->prepare("INSERT INTO publications(contenuPublication, datePublication, idUtilisateur, typePublication) VALUES(?, ?, ?, ?)");
            $requete->execute([$contenu, $date, $idUtilisateur, $typePublication]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    // Pour PHPUnit
    public function deletePublication($idPublication){
        try{
            $requete = $this->getBdd()->prepare("DELETE FROM publications WHERE idPublication = ? ORDER BY idPublication DESC LIMIT 1");
            $requete->execute([$idPublication]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    // Permet l'affichage des commentaires d'une publication
    public function reponses(){
        $listReponse = array();
        $requete = $this->getBdd()->prepare("SELECT * FROM reponses LEFT JOIN utilisateurs USING(idUtilisateur) WHERE idPublication = ?");
        $requete->execute([$this->idPublication]);
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $utilisateur = new Utilisateurs;
            $utilisateur->initialiser($value["nom"], $value["prenom"], $value["photoProfil"], $value["idUtilisateur"]);
            $reponse = new Reponses;
            $reponse->initialiser($value["idReponse"], $value["idPublication"], $value["reponse"], $utilisateur);
            array_push($listReponse, $reponse);
        }
        return $listReponse;
    }

    // Permet de savoir si la publication a été aimé par l'utilisateur connécté
    public function isLiked($idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT * FROM `jaime` WHERE idPublication = ? AND idUtilisateur = ?;");
        $requete->execute([$this->idPublication, $idUtilisateur]);
        if ($requete->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    // Permet d'incrémenter un j'aime en BDD si l'utilisateur n'a pas déjà liké
    public function jaime($idPublication, $idUtilisateur){
        $requete = $this->getBdd()->prepare("UPDATE publications SET jaime = ? WHERE idPublication = ?");
        $requete->execute([$this->jaime+1 ,$idPublication]);

        $requete = $this->getBdd()->prepare("INSERT INTO jaime(idUtilisateur, idPublication) VALUES(?, ?)");
        $requete->execute([$idUtilisateur, $_POST["buttonJaime"]]);
    }

    // Permet de soustraire 1 en BDD si l'utilisateur à déjà liké la publication
    public function removeJaime($idPublication, $idUtilisateur){
        $requete = $this->getBdd()->prepare("UPDATE publications SET jaime = ? WHERE idPublication = ?");
        $requete->execute([$this->jaime-1 ,$idPublication]);

        $requete = $this->getBdd()->prepare("DELETE FROM jaime WHERE idUtilisateur = ? AND idPublication = ?");
        $requete->execute([$idUtilisateur, $_POST["buttonJaime"]]);
    }

    /**
     * Set the value of idPublication
     *
     * @return  self
     */ 
    public function setIdPublication($idPublication)
    {
        $this->idPublication = $idPublication;

        return $this;
    }
}

