<?php
class Projets extends Modele{

    private $idProjet;
    private $nom;
    private $description;
    private $dateDebut;
    private $dateFin;
    private $image;
    private $archive;

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
    public function getImage(){
        return $this->image;
    }
    public function getDateDebut(){
        return $this->dateDebut;
    }

    // Permet la création d'un nouveau projet
    public function newProjet($nomProjet, $membresProjet, $descriptionProjet, $dateDebut, $dateFin){
        $requete = $this->getBdd()->prepare("INSERT INTO projets(nomProjet, membresProjet, descriptionProjet, dateDebut, dateFin, image) VALUES(?, ?, ?, ?, ?, ?)");
        $requete->execute([$nomProjet, $membresProjet, $descriptionProjet, $dateDebut, $dateFin, "../pages/images/projets/projet" . rand(1, 7) . ".jpg"]);
    }
    
    // Séléctionne les utilisateurs présents dans un projet pour les afficher dedans
    public function selectionParticipants($idProjet){
        $requete = $this->getBdd()->prepare("SELECT utilisateurs.nom, utilisateurs.prenom, utilisateurs.photoProfil, utilisateurs.email,  participationprojet.* FROM participationprojet LEFT JOIN utilisateurs USING(idUtilisateur) WHERE idProjet = ?");
        $requete->execute([$idProjet]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // public function detailsProjets($idProjet){
    //     $requete = $this->getBdd()->prepare("SELECT * FROM projets WHERE idProjet = ?");
    //     $requete->execute([$idProjet]);
    //     return $requete->fetch(PDO::FETCH_ASSOC);
    // }

    public function getDate(){
        $requete = $this->getBdd()->prepare('SELECT date FROM plannifications');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function plannifications($idUtilisateur, $date){
        $requete = $this->getBdd()->prepare('SELECT * FROM plannifications WHERE idUtilisateur = ? AND date = ?');
        // On a formater la date pour quelle soit la même qu'en BDD
        $requete->execute([$idUtilisateur, $date->format("Y-m-d")]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    

    // public function recherche_projet($s1){
    //     $requete = $this->getBdd()->prepare('SELECT * FROM projets WHERE libelle LIKE ?');
    //     $requete->execute(['%' . $s1 . '%', '%' . $s1 . '%']);
    //     return $requete->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function selection_projets_getid($id){
        $requete = $this->getBdd()->prepare('SELECT * FROM projets WHERE idProjet = ?');
        $requete->execute([$id]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function chat_projet($id){
        $requete = $this->getBdd()->prepare('SELECT * FROM chatprojet LEFT JOIN utilisateurs USING(idUtilisateur) WHERE idProjet = ?');
        $requete->execute([$id]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function new_chat($idAuteur, $date, $message, $idProjet){
        $requete = $this->getBdd()->prepare('INSERT INTO chatprojet(idUtilisateur, dateMessage, message, idProjet) VALUES(?, ?, ?, ?)');
        $requete->execute([$idAuteur, $date, $message, $idProjet]);
    }

    public function taches($idProjet){
        $requete = $this->getBdd()->prepare("CALL taches(?)");
        $requete->execute([$idProjet]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
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