<?php
class Utilisateurs extends Modele{

    private $idUtilisateur;
    private $nom;
    private $prenom;
    private $dateNaiss;
    private $email;
    private $couleur;
    private $idposte;
    private $photoProfil;
    private $poste;
    private $grade;

    public function __construct($id = null, $nom = null,$prenom = null,$dateNaiss = null,$email = null, $photoProfil = null, $poste = null, $grade = null)
    {
        if ($id != null && $id != null && $nom != null && $prenom != null && $dateNaiss != null && $email != null &&  $photoProfil != null &&  $poste != null &&  $grade != null){
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

    public function initialiser($nom, $prenom, $photoProfil, $idUtilisateur, $couleur = null){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->photoProfil = $photoProfil;
        $this->idUtilisateur = $idUtilisateur;
        $this->couleur = $couleur;
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
    public function getCouleur(){
        return $this->couleur;
    }




    // Permet l'insertion en BDD des données fournies par l'utilisateur lors de l'inscription
    public function inscription($nom, $prenom, $datenaiss, $email, $mdp, $idposte, $photoProfil, $bool){
        $requete = $this->getBdd()->prepare("INSERT INTO utilisateurs(nom, prenom, datenaiss, email, mdp, idposte, photoProfil, first_connexion) VALUES (?,?,?,?,?,?,?, ?)");
        $requete->execute([$nom,$prenom,$datenaiss,$email,$mdp,$idposte,$photoProfil, $bool]);
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
    
    // Permet la modification des données ci-dessous
    public function updateProfil($nom, $prenom, $email, $couleur){
        $this->nom = $nom;
        $this->nom = $prenom;
        $this->nom = $email;
        $this->couleur = $couleur;
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?,  email = ?, color = ? WHERE idUtilisateur = ?");
        $requete->execute([$nom, $prenom, $email, $couleur, $this->idUtilisateur]);

    }
    
    // Permet la modification de sa photo de profil
    public function updatePhotoProfil($target_file){
        $requete = $this->getBdd() ->prepare("UPDATE utilisateurs SET photoProfil = ? WHERE idUtilisateur = ?");
        $requete->execute([$target_file, $this->idUtilisateur]);
    }
    
    // Permet la modification de son mdp
    public function updateMdp($mdp){
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET mdp = ? WHERE idUtilisateur = ?");
        $requete->execute([$mdp, $this->idUtilisateur]);
    }

    // Permet le passage du boolean first_connexion à false
    public function update_firstConnexion($bool){
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET first_connexion = ? WHERE idUtilisateur = ?");
        $requete->execute([$bool, $this->idUtilisateur]);
    }

    // Permet de récupérer le bool firstconnexion en fonction de la personne connecté
    public function getBoolFirstConnexion(){
        $requete = $this->getBdd()->prepare("SELECT first_connexion FROM utilisateurs WHERE idUtilisateur = ?");
        $requete->execute([$this->idUtilisateur]);
        return $requete->fetch(PDO::FETCH_ASSOC)["first_connexion"];
    }

    
    // NE PLUS UTTILISER LA TABLE AFFECTATION MAIS PLANNIFICATION
    public function getParticipations(){
        $listProjet = array();
        $requete = $this->getBdd()->prepare("SELECT * FROM participationprojet LEFT JOIN projets USING(idProjet) WHERE idUtilisateur = ?");
        $requete->execute([$this->idUtilisateur]);
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $key => $value) {
            $projet = new Projets;
            $projet->initialiser($value["idProjet"], $value["nomProjet"], $value["descriptionProjet"],  $value["dateDebut"], $value["dateFin"], $value["image"], $value["archive"],);
            array_push($listProjet, $projet);
        }
        return $listProjet;
    }
    
    // Méthode qui permet la supression d'un compte et qui entraine un trigger pour supprimer les données de l'utilisateur dans toutes les tables
    public function supprimer_compte(){
        $requete = $this->getBdd()->prepare("DELETE FROM utilisateurs WHERE idUtilisateur = ?");
        $requete->execute([$this->idUtilisateur]);
    }

    // Permet la création d'un token quand un utilisateur clique sur "se souvenir de moi" à la connexion (cookies)
    public function token($idUtilisateur, $token){
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET token = ? WHERE idUtilisateur = ?");
        $requete->execute([$token, $idUtilisateur]);
    }

    // Permet la connexion grâce au token (cookies)
    public function connexion_token($token){
        $id = substr($token, 0, strpos($token, "-"));
        $token = substr($token, strpos($token, '-') +1);
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes ON utilisateurs.idposte = postes.idposte WHERE token = ? AND idUtilisateur = ?");
        $requete->execute([$token, $id]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
}