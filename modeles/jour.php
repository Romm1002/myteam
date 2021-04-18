<?php
class Jour extends Modele
{
    private $date; //string
    private $jourSemaine; //string
    private $jour; //entier
    private $nbr; //entier
    private $projet; //booleen

    public function __construct($date,$nbr="",$projet=0)
    {
        $this->date = $date;
        $this->jourSemaine = date('w', strtotime($date));
        $this->jour = intval(substr($date,8,2));
        $this->nbr = $nbr;
        $this->projet = $projet;
    }
    public function setNbrEvenements($nbr)
    {
        $this->nbr = $nbr;
    }
    public function getDate(){
        return $this->date;
    }
    public function getJourSemaine(){
        return $this->jourSemaine;
    }
    public function getJour(){
        return $this->jour;
    }
    public function getNbrEvenements(){
        return $this->nbr;
    }
    public function getProjet(){
        return $this->projet;
    }
}
?>