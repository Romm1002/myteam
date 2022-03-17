<?php
class Utilisateurs extends Modele{

    private $idUtilisateur;
    private $nom;
    private $prenom;
    private $mdp;
    private $dateNaiss;
    private $email;
    private $idposte;
    private $photoProfil;
    private $poste;
    private $grade;
    private $bool;
    private $token;
    private $date;
    private $ip;

    public function __construct($id = null, $nom = null, $prenom = null, $dateNaiss = null, $email = null, $photoProfil = null, $poste = null, $grade = null)
    {
        if ($id != null && $id != null && $nom != null && $prenom != null && $dateNaiss != null && $email != null && $photoProfil != null && $poste != null &&  $grade != null){
            $this->idUtilisateur = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->dateNaiss = $dateNaiss;
            $this->email = $email;
            $this->photoProfil = $photoProfil;
            $this->poste = $poste;
            $this->grade = $grade;
        }
    }

    public function initialiser($nom, $prenom, $photoProfil, $idUtilisateur){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->photoProfil = $photoProfil;
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getNom(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function getPhotoProfil(){
        return $this->photoProfil;
    }
    public function getId(){
        return $this->idUtilisateur;
    }
    public function getPoste(){
        return $this->poste;
    }
    public function getGrade(){
        return $this->grade;
    }
    public function getEmail(){
        return $this->email;
    }

    // Permet l'insertion en BDD des données fournies par l'utilisateur lors de l'inscription
    public function inscription($nom, $prenom, $datenaiss, $email, $mdp, $idposte, $photoProfil, $bool){
        try{
            $requete = $this->getBdd()->prepare("INSERT INTO utilisateurs(nom, prenom, datenaiss, email, mdp, idposte, photoProfil, first_connexion) VALUES (?,?,?,?,?,?,?, ?)");
            $requete->execute([$nom,$prenom,$datenaiss,$email,$mdp,$idposte,$photoProfil, $bool]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    // Récupération des emails présents en BDD pour savoir si il existe déjà pour l'inscription ou pour savoir si il existe juste pour la connexion
    public function verification_email($email){
        $requete = $this->getBdd()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
        $requete->execute([$email]);
        return $requete->rowCount();
    }

    // Permet la connexion
    public function connexion($email){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes ON utilisateurs.idposte = postes.idposte WHERE email = ?");
        $requete->execute([$email]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function logConnexion($idUtilisateur, $date, $ip){
        try{
            $requete = $this->getBdd()->prepare("INSERT INTO logs_connexion(idUtilisateur, date, ip) VALUES(?, ?, ?)");
            $requete->execute([$idUtilisateur, $date, $ip]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    
    // Permet la modification des données ci-dessous
    public function updateProfil($nom, $prenom, $email){
        try{
            $this->nom = $nom;
            $this->nom = $prenom;
            $this->nom = $email;
            $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?,  email = ? WHERE idUtilisateur = ?");
            $requete->execute([$nom, $prenom, $email, $this->idUtilisateur]);
            return true;
        }catch(Exception $e){
            return false;
        }
        
    }
    
    // Permet la modification de sa photo de profil
    public function updatePhotoProfil($target_file){
        try{
            $requete = $this->getBdd() ->prepare("UPDATE utilisateurs SET photoProfil = ? WHERE idUtilisateur = ?");
            $requete->execute([$target_file, $this->idUtilisateur]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    
    // Permet la modification de son mdp
    public function updateMdp($mdp){
        try{
            $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET mdp = ? WHERE idUtilisateur = ?");
            $requete->execute([$mdp, $this->idUtilisateur]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    // Permet le passage du boolean first_connexion à false
    public function update_firstConnexion($bool){
        try{
            $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET first_connexion = ? WHERE idUtilisateur = ?");
            $requete->execute([$bool, $this->idUtilisateur]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    // Permet de récupérer le bool firstconnexion en fonction de la personne connecté
    public function getBoolFirstConnexion(){
        $requete = $this->getBdd()->prepare("SELECT first_connexion FROM utilisateurs WHERE idUtilisateur = ?");
        $requete->execute([$this->idUtilisateur]);
        return $requete->fetch(PDO::FETCH_ASSOC)["first_connexion"];
    }

    
    public function getParticipations(){
        $listProjet = array();
        $requete = $this->getBdd()->prepare("SELECT * FROM participationprojet LEFT JOIN projets USING(idProjet) WHERE idUtilisateur = ?");
        $requete->execute([$this->idUtilisateur]);
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $projet = new Projets;
            $projet->initialiser($value["idProjet"], $value["nomProjet"], $value["descriptionProjet"],  $value["dateDebut"], $value["dateFin"], $value["image"], $value["archive"],);
            if ($projet->getArchive() == 1){
                continue;
            }
            array_push($listProjet, $projet);
        }
        return $listProjet;
    }
    
    // Méthode qui permet la supression d'un compte et qui entraine un trigger pour supprimer les données de l'utilisateur dans toutes les tables
    public function supprimer_compte(){
        try{
            $requete = $this->getBdd()->prepare("DELETE FROM utilisateurs WHERE idUtilisateur = ?");
            $requete->execute([$this->idUtilisateur]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    // Permet la création d'un token quand un utilisateur clique sur "se souvenir de moi" à la connexion (cookies)
    public function token($idUtilisateur, $token){
        try{
            $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET token = ? WHERE idUtilisateur = ?");
            $requete->execute([$token, $idUtilisateur]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    // Permet la connexion grâce au token (cookies)
    public function connexion_token($token){
        $id = substr($token, 0, strpos($token, "-"));
        $token = substr($token, strpos($token, '-') +1);
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes ON utilisateurs.idposte = postes.idposte WHERE token = ? AND idUtilisateur = ?");
        $requete->execute([$token, $id]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    // Permet de récupérer les participations d'un utilisateur pour chaque jour
    public function plannifications($date){
        $requete = $this->getBdd()->prepare('SELECT * FROM plannifications WHERE idUtilisateur = ? AND date = ?');
        // On a formater la date pour quelle soit la même qu'en BDD
        $requete->execute([$this->idUtilisateur, $date->format("Y-m-d")]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    // renvoi un array de tout les evenements correspondant a la date et l'utilisateur
    public function evenementsParDate($date){
        $evenements = array();
        $requete = $this->getBdd() ->prepare("SELECT * FROM evenements WHERE date = ? AND idUtilisateur = ? ORDER BY heureDebut");
        $requete ->execute([$date, $this->idUtilisateur]);
        foreach ($requete-> fetchAll(PDO::FETCH_ASSOC) as $value) {
            $evenement = new Evenements;
            $evenement->initialiser($value["designation"], $value["date"], $value["idUtilisateur"], $value["couleur"], $value["admin"], $value["heureDebut"], $value["heureFin"], $value["idEvenement"]);
            array_push($evenements, $evenement);
        }
        return $evenements;
    }


    /**
     * Set the value of idUtilisateur
     *
     * @return  self
     */ 
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of ip
     */ 
    public function getIp()
    {
        return $this->ip;
    }
}
