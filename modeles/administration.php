<?php
class Administration extends Modele{
    public function rechercheEmploye($search){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes ON utilisateurs.idposte = postes.idposte WHERE nom LIKE '?%' OR nom LIKE '%?%' OR nom LIKE '%?' OR prenom LIKE '?%' OR prenom LIKE '%?%' OR prenom LIKE '%?'");
        $requete -> execute([$search]);
        $requete->rowCount();
        $requete->fetchAll(PDO :: FETCH_ASSOC);
    }
    
    public function rechercheOK(){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes ON utilisateurs.idposte = postes.idposte");
        $requete -> execute();
        $requete->rowCount();
        $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function recuperationPostes(){
        //recupération des postes
        $requete=$this->getBdd()->prepare("SELECT * FROM postes");
        $requete->execute();
        return $requete->fetch(PDO :: FETCH_ASSOC);
    }
    
    public function recuperationEmail($email){
        $requete = $this->getBdd()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
        $requete->execute([$email]);
        $requete->rowCount();
    }
    
    public function newUtilisateur($nom, $prenom, $datenaiss, $email, $mdp, $idposte, $pdp){
        $requete=$this->getBdd()->prepare("INSERT INTO utilisateurs(nom,prenom,datenaiss,email,mdp,idposte, photoProfil) VALUES (?,?,?,?,?, ?, ?)");
        $requete->execute([$nom,$prenom,$datenaiss,$email,$mdp, $idposte, $pdp]);
    }
    
    public function utilisateurs($idUtilisateur){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes ON utilisateurs.idposte = postes.idposte WHERE idutilisateur = ?");
        $requete->execute([$idUtilisateur]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

}