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
}