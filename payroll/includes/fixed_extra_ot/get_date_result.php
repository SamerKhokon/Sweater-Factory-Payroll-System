<?php
session_start();
require '../../includes/db.php';
//echo cal_days_in_month(CAL_GREGORIAN, 8, 2012);

$date_str	=$_POST['date_str'];
$date_str = trim(PREG_REPLACE("/[\/,\s-]/i", ',', $date_str));
$date_str=explode(",",$date_str);
// format Month/Date/Year
function getMonthName($m,$d,$y){
return date('F',mktime(0,0,0,$m,$d,$y));
}
//echo cal_days_in_month(CAL_GREGORIAN, 8, 2012);

function getDayName($month,$date,$year) {
return date("l", mktime(0,0,0,$month,$date,$year)).'-'.substr(getMonthName($month,$date,$year),0,3).'-'.$year;
}
$num_daysval	= getDayName($date_str[0],$date_str[1],$date_str[2]);

$num_daysval	=explode("-",$num_daysval);


$year=$num_daysval[2];
$month=$num_daysval[1];
$day="Fri";

echo cal_days_in_month(CAL_GREGORIAN, (int)$date_str[0], (int)$date_str[2]);
echo '!@#$';
echo num_days ($day, $month, $year);

function num_days ($day, $month, $year) { 
    $day_array = array("Mon" => "Monday", "Tue" => "Tuesday", "Wed" => "Wednesday", "Thu" => "Thursday", "Fri" => "Friday", "Sat" => "Saturday", "Sun" => "Sunday");

    $month_array = array(1 => "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

    /* * Check our arguments are valid. */

    /* * $day must be either a full day string or the 3 letter abbreviation. */ 
    if (!(in_array($day, $day_array) || array_key_exists($day, $day_array))) { 
        return 0; 
    }

    /* * $month must be either a full month name or its 3 letter abrreviation */ 
    if (($mth = array_search(substr($month,0,3), $month_array)) <= 0) { 
        return 0; 
    }

    /* * Now fetch the previous $day of $month+1 in $year; * this will give us the last $day of $month. */

    /* * Calculate the timestamp of the 01/$mth+1/$year. */ 

    $time = mktime(0,0,0,$mth+1,1,$year);
    $str = strtotime("last $day", $time);

    /* * Return nth day of month. */ 

    $date = date("j", $str);

    /* * If the difference between $date1 and $date2 is 28 then * there are 5 occurences of $day in $month/$year, otherwise * there are just 4. */ 

    if ($date <= 28) { 
        return 4; 
    } else { 
        return 5; 
    } 
} 
?>