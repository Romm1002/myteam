<?php
class Projets extends Modele{

    private $idProjet;
    private $nom;
    private $description;
    private $dateDebut;
    private $dateFin;
    private $image;
    private $archive;

    public function __construct($idProjet = null)
    {
        if ($idProjet != null){
            $requete = $this->getBdd()->prepare('SELECT * FROM projets WHERE idProjet = ?');
            $requete->execute([$idProjet]);
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            $this->idProjet = $result["idProjet"];
            $this->nom = $result["nomProjet"];
            $this->description = $result["descriptionProjet"];
            $this->dateDebut = $result["dateDebut"];
            $this->dateFin = $result["dateFin"];
            $this->image = $result["image"];
            $this->archive = $result["archive"];
        }
    }
    public function initialiser($idProjet, $nom, $description, $dateDebut, $dateFin, $image, $archive){
        
        $this->idProjet = $idProjet;
        $this->nom = $nom;
        $this->description = $description;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->image = $image;
        $this->archive = $archive;
    }

    public function getId(){
        return $this->idProjet;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getImage(){
        return $this->image;
    }
    public function getDateDebut(){
        return $this->dateDebut;
    }
    public function getDateFin(){
        return $this->dateFin;
    }
    public function getArchive(){
        return $this->archive;
    }

    
    // Séléctionne les utilisateurs présents dans un projet pour les afficher dedans
    public function selectionParticipants($idProjet){
        $listParticipants = array();
        $requete = $this->getBdd()->prepare("SELECT utilisateurs.nom, utilisateurs.prenom, utilisateurs.photoProfil, utilisateurs.idUtilisateur, participationprojet.* FROM participationprojet LEFT JOIN utilisateurs USING(idUtilisateur) WHERE idProjet = ?");
        $requete->execute([$idProjet]);
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $utilisateur = new Utilisateurs;
            $utilisateur->initialiser($value["nom"], $value["prenom"], $value["photoProfil"], $value["idUtilisateur"]);
            array_push($listParticipants, $utilisateur);
        }
        return $listParticipants;
    }
    

    public function getChatProjet(){
        $listChat = array();
        $requete = $this->getBdd()->prepare('SELECT * FROM chatprojet LEFT JOIN utilisateurs USING(idUtilisateur) WHERE idProjet = ?');
        $requete->execute([$this->idProjet]);
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $chat = new Chats();
            $envoyeur = new Utilisateurs;
            $envoyeur->initialiser($value["nom"], $value["prenom"], $value["photoProfil"], $value["idUtilisateur"]);
            $chat->initialiser($value["idMessage"], $envoyeur, $value["dateMessage"], $value["message"], $value["idProjet"]);
            array_push($listChat, $chat);
        }
        return $listChat;
    }

    

    public function getTaches(){
        $listTache = array();
        $requete = $this->getBdd()->prepare("SELECT * FROM tachesprojet LEFT JOIN utilisateurs USING(idUtilisateur) WHERE idProjet = ?");
        $requete->execute([$this->idProjet]);
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $tache = new Taches;
            $tache->initialiser($value["idTache"], $value["libelle"], $value["idProjet"], $value["idUtilisateur"], $value["idTacheParent"], $value["dateFin"], $value["nom"], $value["prenom"]);
            array_push($listTache, $tache);
        }
        return $listTache;
    }

    /**
     * Set the value of idProjet
     *
     * @return  self
     */ 
    public function setIdProjet($idProjet)
    {
        $this->idProjet = $idProjet;

        return $this;
    }
}