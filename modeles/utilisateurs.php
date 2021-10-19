<?php
class Utilisateurs extends Modele{
    

    public function insertionInscription($nom, $prenom, $datenaiss, $email, $mdp, $idposte, $photoProfil){
        $requete = $this->getBdd()->prepare("INSERT INTO utilisateurs(nom,prenom,datenaiss,email,mdp,idposte,photoProfil) VALUES (?,?,?,?,?,?,?)");
        $requete->execute([$nom,$prenom,$datenaiss,$email,$mdp,$idposte,$photoProfil]);
    }

    public function inscription($email){
        $requete = $this->getBdd()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
        $requete->execute([$email]);
        return $requete->rowCount();
    }

    public function connexion($email){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes ON utilisateurs.idposte = postes.idposte WHERE email = ?");
        $requete->execute([$email]);
        return $requete->fetch(PDO::FETCH_ASSOC);
        return $requete->rowCount();
    }

    public function profil($idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs INNER JOIN postes USING(idposte) WHERE idUtilisateur = ?");
        $requete->execute([$idUtilisateur]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    
    public function modificationEmail($email){
        $requete = $this->getBdd()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
        $requete->execute([$email]);
        return $requete->rowCount();
    }
    
    public function updateProfil($nom, $prenom, $email, $idUtilisateur){
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?,  email = ? WHERE idUtilisateur = ?");
        $requete->execute([$nom, $prenom, $email, $idUtilisateur]);
    }
    
    public function updatePhotoProfil($target_file, $idUtilisateur){
        $requete = $this->getBdd() ->prepare("UPDATE utilisateurs SET photoProfil = ? WHERE idUtilisateur = ?");
        $requete->execute([$target_file, $idUtilisateur]);
    }
    
    public function updateMdp($mdp, $idUtilisateur){
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET mdp = ? WHERE idUtilisateur = ?");
        $requete->execute([$mdp, $idUtilisateur]);
    }

    public function newUser($nom, $prenom, $admin, $login, $mdp, $email){
        $requete = $this->getBdd()->prepare('INSERT INTO utilisateurs(nom, prenom, admin, login, mdp, email) VALUES(?, ?, ?, ?, ?, ?)');
        $requete->execute([$nom, $prenom, $admin, $login, $mdp, $email]);
    }
    
    public function no_admin(){
        $requete = $this->getBdd()->prepare('SELECT u.*, s.idService, s.nomService FROM utilisateurs AS u LEFT JOIN services USING(idUtilisateur) LEFT JOIN les_services AS s USING(idService) WHERE (s.idUtilisateur = ?) OR (s.idUtilisateur = ? AND u.admin = ?) OR (u.admin = ? AND services.idService = ? AND u.prenom = ?)');
        $requete->execute([$_SESSION['idUtilisateur'], $_SESSION['idUtilisateur'], 0, 0, $_SESSION['idService'], $_SESSION['prenom']]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
        public function users(){
            $requete = $this->getBdd()->prepare('SELECT u.*, s.idService, s.nomService FROM utilisateurs AS u LEFT JOIN services USING(idUtilisateur) LEFT JOIN les_services AS s USING(idService)');
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function affectations($idUtilisateur){
            $requete = $this->getBdd()->prepare("SELECT * FROM affectations LEFT JOIN projets USING(idProjet) WHERE idUtilisateur = ?");
            $requete->execute([$idUtilisateur]);
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function recherche($s1){
            $requete = $this->getBdd()->prepare('SELECT u.*, s.nomService FROM utilisateurs AS u LEFT JOIN services USING(idUtilisateur) LEFT JOIN les_services AS s USING(idService) WHERE prenom LIKE ? OR nom LIKE ?');
            $requete->execute(['%' . $s1 . '%', '%' . $s1 . '%']);
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function selectAll($idUtilisateur){
            $requete = $this->getBdd()->prepare('SELECT * FROM utilisateurs WHERE idUtilisateur = ?');
            $requete->execute([$idUtilisateur]);
            return $requete->fetch(PDO::FETCH_ASSOC);
        }
    
        public function getService($idService){
            $requete = $this->getBdd()->prepare('SELECT * FROM utilisateurs LEFT JOIN services USING(idUtilisateur) LEFT JOIN les_services USING(idService) WHERE idService = ?');
            $requete->execute([$idService]);
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function user($idUtilisateur){
            $requete = $this->getBdd()->prepare('SELECT * FROM utilisateurs WHERE idUtilisateur = ?');
            $requete->execute([$idUtilisateur]);
            return $requete->fetch(PDO::FETCH_ASSOC);
        }
    
        public function service($idUtilisateur){
            $requete = $this->getBdd()->prepare('SELECT * FROM utilisateurs LEFT JOIN services USING(idUtilisateur) LEFT JOIN les_services USING()idService WHERE idUtilisateur = ?');
            $requete->execute([$idUtilisateur]);
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
}