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

    public function membresInscrits(){
        $requete = $this->getBdd()->prepare("SELECT COUNT(idUtilisateur) FROM utilisateurs");
        $requete->execute();
        return implode($requete->fetch(PDO::FETCH_ASSOC));
    }

    public function ProjetsEnCours(){
        $requete = $this->getBdd()->prepare("SELECT COUNT(idProjet) FROM projets");
        $requete->execute();
        return implode($requete->fetch(PDO::FETCH_ASSOC));
    }

    public function MessagesEchanges(){
        $requete = $this->getBdd()->prepare("SELECT COUNT(idMessage) FROM messagerie");
        $requete->execute();
        return implode($requete->fetch(PDO::FETCH_ASSOC));
    }

    public function publicationEnvoyees(){
        $requete = $this->getBdd()->prepare("SELECT COUNT(idPublication) FROM publications");
        $requete->execute();
        return implode($requete->fetch(PDO::FETCH_ASSOC));
    }

    public function membres(){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function dateMois($month){
        switch($month){
            case "01" : 
                return "Janvier";
            case "02" : 
                return "Février";
            case "03" : 
                return "Mars";
            case "04" : 
                return "Avril";
            case "05" : 
                return "Mai";
            case "06" : 
                return "Juin";
            case "07" : 
                return "Juillet";
            case "08" : 
                return "Août";
            case "09" : 
                return "Septembre";
            case "10" : 
                return "Octobre";
            case "11" : 
                return "Novembre";
            case "12" : 
                return "Décembre";
        }
    }

    public function recherche($s1){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes USING(idposte) WHERE prenom LIKE ? OR nom LIKE ?");
        $requete->execute(["%" . $s1 . "%", "%" . $s1 . "%"]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recuperationContacts(){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN postes USING(idposte)");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recuperationMessages(){
        $requete = $this->getBdd()->prepare("SELECT * FROM messagerie ORDER BY idMessage DESC");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}