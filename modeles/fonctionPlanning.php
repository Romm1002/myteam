<?php

function getDaysInMonth($year,$month){
    
    return cal_days_in_month(CAL_GREGORIAN, $month, $year);
}

function dayOfWeek($date){
    return  date('w', strtotime($date));
}
?>