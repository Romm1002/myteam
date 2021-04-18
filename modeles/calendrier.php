<?php
class Calendrier extends Modele
{
    private $date; // string du jour appartenant au mois a afficher
    private $jours= []; //tableau d'objets
    private $mois; //string
    public function __construct($date,$idUtilisateur)
    {
        $year = substr($date,0,4);
        $month = substr($date,5,2);
        $this->mois = $this->dateMois($month);
        $this->date = $date;

        $requete = $this->getBdd()->prepare("SELECT date, COUNT(idEvenement) AS 'nbr' FROM `evenements` WHERE date LIKE ? AND idUtilisateur = ? GROUP BY date");
        $requete->execute([$year."-".$month. "%",$idUtilisateur]);
        $nbrEvenements = $requete->fetchAll(PDO::FETCH_ASSOC);

        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for($i=1; $i<=$days ; $i++){
            if($i<10){
                $dateJour = $year . "-" . $month . "-0" . $i;
            }else{
                $dateJour = $year . "-" . $month . "-" . $i;

            }
            $objetJour = new Jour($dateJour);
            $this->jours[] = $objetJour;
            foreach($nbrEvenements as $nbr){
                if($nbr["date"] == $dateJour){
                    $objetJour->setNbrEvenements($nbr["nbr"]);
                }
            }
        }
    }
    private function dateMois($month){
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
    public function getJours(){
        return $this->jours;
    }
    public function getMois(){
        return $this->mois;
    }
    public function getDate(){
        return $this->date;
    }
}

?>