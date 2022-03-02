<?php
class Evenements extends Modele{

    private $id;
    private $designation;
    private $date;
    private $heureDebut;
    private $heureFin;
    private $idUtilisateur;
    private $couleur;
    private $admin;

    public function initialiser($designation, $date, $idUtilisateur, $couleur, $admin, $heureDebut, $heureFin = null, $id = null ){
        $this->designation = $designation;
        $this->date = $date;
        $this->idUtilisateur = $idUtilisateur;
        $this->couleur = $couleur;
        $this->admin = $admin;
        $this->heureDebut = $heureDebut;
        if ($heureFin != null){
            $this->heureFin = $heureFin;
        }else{
            $this->heureFin = $heureDebut;
        }
        if ($id != null){
            $this->id = $id;
        }
    }

    public function getId(){
        return $this->id;
    }
    public function getDesignation(){
        return $this->designation;
    }
    public function getDate(){
        return $this->date;
    }
    public function getHeureDebut(){
        return $this->heureDebut;
    }
    public function getHeureFin(){
        return $this->heureFin;
    }
    public function getIdUtilisateur(){
        return $this->idUtilisateur;
    }
    public function getCouleur(){
        return $this->couleur;
    }
    public function getAdmin(){
        return $this->admin;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setDesignation($designation){
        $this->designation = $designation;
    }
    

    public function ajoutEvenement($designation = null, $date = null, $idUtilisateur = null, $couleur = null, $heureDebut = null, $heureFin = null){
        if($designation != null AND $date != null AND $idUtilisateur != null AND $couleur != null AND $heureDebut != null AND $heureFin != null){
            $this->initialiser($designation, $date, $idUtilisateur, $couleur, $heureDebut, $heureFin);
        }
        $requete = $this->getBdd()->prepare("INSERT INTO evenements(designation,date,heureDebut,heureFin,idUtilisateur,couleur) VALUES(?,?,?,?,?,?)");
        $requete ->execute([$this->designation,$this->date,$this->heureDebut,$this->heureFin,$this->idUtilisateur,$this->couleur]);
    }

    public function supprEvenement($idEvenement){
        $requete = $this->getBdd()->prepare("DELETE FROM evenements WHERE idEvenement = ?");
        $requete ->execute([$idEvenement]);
    }
    
    public function modifEvenement($id = null, $designation = null){
        if ($id != null AND $designation != null){
            $this->setId($id);
            $this->setDesignation($designation);
        }
        $requete = $this->getBdd()->prepare("UPDATE evenements SET designation = ? WHERE idEvenement = ?");
        $requete->execute([$this->designation, $this->id]);
    }
}