
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);


echo $date1 = 0 . "\n <br>";
echo $date2 = time() . "<br>";

###################################################################################################################3####################################################################
#Как вариант
####################################################################################################################3#######################################################################################################################################################################################3####################################################################
//$time1 = strftime('%d.%m.%Y %H:%M:%S', mt_rand((int) $date1, (int) $date2)) . "\n";
//$time2 = strftime('%d.%m.%Y %H:%M:%S', mt_rand((int) $date1, (int) $date2)) . "\n";
//$time3 = strftime('%d.%m.%Y %H:%M:%S', mt_rand((int) $date1, (int) $date2)) . "\n";
//$time4 = strftime('%d.%m.%Y %H:%M:%S', mt_rand((int) $date1, (int) $date2)) . "\n";
//$time5 = strftime('%d.%m.%Y %H:%M:%S', mt_rand((int) $date1, (int) $date2)) . "<br>";
//
//$date = array($time1,$time2,$time3,$time4,$time5);
//var_dump($date);       
//$dates1 = date_parse_from_format("j.m.Y H:i:s", $time1);
//$dates2 = date_parse_from_format("j.m.Y H:i:s", $time2);
//$dates3 = date_parse_from_format("j.m.Y H:i:s", $time3);
//$dates4 = date_parse_from_format("j.m.Y H:i:s", $time4);
//$dates5 = date_parse_from_format("j.m.Y H:i:s", $time5);
//
//
//$dates = array($dates1, $dates2, $dates3, $dates4, $dates5);
//
//var_dump($dates);
//
//
//$minday = min($dates[0]['day'], $dates[1]['day'], $dates[2]['day'], $dates[3]['day'], $dates[4]['day']);
//
//$maxmes = max($dates[0]['month'], $dates[1]['month'], $dates[2]['month'], $dates[3]['month'], $dates[4]['month']);
//
//
//$month = array("12", "11", "10", "9", "8", "7", "6", "5", "4", "3", "4", "3", "2", "1");
//
//$ds = array(" декабрь ", " ноябрь ", " октябрь ", " сентябрь ", " август ", " июль ", " июнь ", " май ", " апрель ", " март ", " февраль ", " январь ");
//$newdate = str_replace($month, $ds, $maxmes);
//echo 'Наименьший день в массиве: '.$minday .'<br>';
//echo 'Наибольший месяц в массиве: ' .  $newdate .'<br>';
//
////array_multisort($date,SORT_ASC );
//asort($dates,SORT_ASC );
//var_dump($dates);
//
//$selected = array_pop($dates);
//
//print_r($selected)."<br>";
//
//echo $newtime = $selected ['day']. '.' .$selected ['month']. '.' .$selected ['year']. "\n" .$selected ['hour']. ':' .$selected['minute']. ':' .$selected ['second'];
//

###################################################################################################################3####################################################################



$time1 = mt_rand((int) $date1, (int) $date2) . "\n";
$time2 = mt_rand((int) $date1, (int) $date2) . "\n";
$time3 = mt_rand((int) $date1, (int) $date2) . "\n";
$time4 = mt_rand((int) $date1, (int) $date2) . "\n";
$time5 = mt_rand((int) $date1, (int) $date2) . "\n" . "<br>";

$date = array($time1, $time2, $time3, $time4, $time5);
var_dump($date);
$mes1 = strftime("%m - %B", (int) $time1) . "\n";
$mes2 = strftime("%m - %B ", (int) $time2) . "\n";
$mes3 = strftime("%m - %B", (int) $time3) . "\n";
$mes4 = strftime("%m - %B", (int) $time4) . "\n";
$mes5 = strftime("%m - %B", (int) $time5) . "\n";

$mes = array($mes1, $mes2, $mes3, $mes4, $mes5);

var_dump($mes);

echo 'Наибольший месяц в массиве:' . max($mes);

$day1 = strftime("%d", (int) $time1) . "\n";
$day2 = strftime("%d", (int) $time2) . "\n";
$day3 = strftime("%d", (int) $time3) . "\n";
$day4 = strftime("%d", (int) $time4) . "\n";
$day5 = strftime("%d", (int) $time5) . "\n";

$day = array($day1, $day2, $day3, $day4, $day5);

var_dump($day);

echo 'Наименьший день в массиве:' . min($day);

asort($date, SORT_NUMERIC);
var_dump($date);

$selected = array_pop($date);

echo date("Y-m-d H:i:s", (int) $selected).'<br>';


date_default_timezone_set("America/New_York"); 


echo 'В Нью-Йорке: '.date("Y-m-d H:i:s", (int) $selected);
?>