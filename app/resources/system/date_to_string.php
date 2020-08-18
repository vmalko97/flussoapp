<?php
function dateToString($date)
{
    //2020-04-11
    $date_arr = explode('-', $date);
    $day = $date_arr[2];
    $month = $date_arr[1];
    $year = $date_arr[0];
    $result = NULL;
    switch ($month) {
        case '01':
            $month_s = "січня";
            break;
        case '02':
            $month_s = "лютого";
            break;
        case '03':
            $month_s = "березня";
            break;
        case '04':
            $month_s = "квітня";
            break;
        case '05':
            $month_s = "травня";
            break;
        case '06':
            $month_s = "червня";
            break;
        case '07':
            $month_s = "липня";
            break;
        case '08':
            $month_s = "серпня";
            break;
        case '09':
            $month_s = "вересня";
            break;
        case '10':
            $month_s = "жовтня";
            break;
        case '11':
            $month_s = "листопада";
            break;
        case '12':
            $month_s = "грудня";
            break;
    }
    $result = $day . " " . $month_s . " " . $year;
    return $result;
}
function dateToDMY($date){
    $result = NULL;
    $date_arr = explode('-', $date);
    $day = $date_arr[2];
    $month = $date_arr[1];
    $year = $date_arr[0];
    $result = $day.".".$month.".".$year;
    return $result;
}