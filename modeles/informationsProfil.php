<?php
class InfoProfils extends Modele{
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

}