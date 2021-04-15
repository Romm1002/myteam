<?php
class Calendrier extends Modele{
    public function getDaysInMonth($year,$month){
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }
    
    public function dayOfWeek($date){
        return  date('w', strtotime($date));
    }
}
?>