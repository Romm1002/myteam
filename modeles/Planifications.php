<?php
class Plannifications extends Modele{

    private $idPlannification;
    private $idUtilisateur;
    private $date;
    private $idProjet;
    private $ratio;

    
    // Permet d'afficher la somme des ratio
    public function ratio($date, $idUtilisateur){
        $requete = $this->getBdd()->prepare('CALL ratio(?, ?)');
        $requete->execute([$date, $idUtilisateur]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function insert_ratio($idUtilisateur, $idProjet, $date, $ratio){
        try{
            $requete = $this->getBdd()->prepare('INSERT INTO plannifications(idUtilisateur, idProjet, date, ratio) VALUES(?, ?, ?, ?)');
            $requete->execute([$idUtilisateur, $idProjet, $date, $ratio]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function update_ratio($ratio, $idUtilisateur, $idProjet, $date){
        try{
            $requete = $this->getBdd()->prepare('UPDATE plannifications SET ratio = ? WHERE idUtilisateur = ? AND idProjet = ? AND date = ?');
            $requete->execute([$ratio, $idUtilisateur, $idProjet, $date]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    // Pour PHPUnit
    public function delete_ratio($idUtilisateur, $idProjet, $date){
        try{
            $requete = $this->getBdd()->prepare('DELETE FROM plannifications WHERE idUtilisateur = ? AND idProjet = ? AND date = ? ORDER BY idPlannification DESC LIMIT 1');
            $requete->execute([$idUtilisateur, $idProjet, $date]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    /**
     * Get the value of idPlannification
     */ 
    public function getIdPlannification()
    {
        return $this->idPlannification;
    }

    /**
     * Set the value of idPlannification
     *
     * @return  self
     */ 
    public function setIdPlannification($idPlannification)
    {
        $this->idPlannification = $idPlannification;

        return $this;
    }

    /**
     * Get the value of idUtilisateur
     */ 
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
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
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of idProjet
     */ 
    public function getIdProjet()
    {
        return $this->idProjet;
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

    /**
     * Get the value of ratio
     */ 
    public function getRatio()
    {
        return $this->ratio;
    }

    /**
     * Set the value of ratio
     *
     * @return  self
     */ 
    public function setRatio($ratio)
    {
        $this->ratio = $ratio;

        return $this;
    }
}
?>