<?php
@session_start();
date_default_timezone_set('Europe/Moscow');
//session_unset();

if (!isset($_SESSION["rows"])) $_SESSION["rows"] = array();

$start = microtime(true);
$changex = $_POST["changex"];
$x = preg_replace("/,/", ".", $changex);

$y = (int) $_POST["changey"];
$r = (float) $_POST["changer"];

$time = date("H:i:s");

function checkX($x){
    if (!is_numeric($x) || $x < -3 || $x > 5){
        return false;
    }
    return true;
}


$possibleY = array("-5", "-4", "-3", "-2", "-1", "0", "1", "2", "3");
function checkY($y){
    global $possibleY;
    if (!in_array($y, $possibleY)){
        return false;
    }
    return true;
}
$possibleR = array("1", "1.5", "2", "2.5", "3");
function checkR($r){
    global $possibleR;
    if (!in_array($r, $possibleR)){
        return false;
    }
    return true;
}


function checkCoordinate($x, $y, $r){
    if ($x>0 && $y<0 && $y >= $r*(-2*$x/$r-1)){
        return true;
    }
    elseif ($x<0 && $y<0 && $x*$x+$y*$y <= $r*$r/4){
        return true;
    }
    elseif ($x>0 && $y<0 && $x<=$r && $y>=-$r){
        return true;
    }
    else {
        return false;
    }
}

function echoHtml(){
    $html = file_get_contents('index.html');
    echo $html;
    echo "<table id='out' align='center'>";
    echo "<thead><tr><th>Значение X</th><th>Значение Y</th><th>Значение R</th><th>Текущее время</th><th>Время выполнения</th><th>Попадание</th></tr></thead>";
    echo "<tbody>";
    foreach ($_SESSION["rows"] as $row){
        echo "<tr>$row</tr>";
    }
    echo "</tbody></table>";
}

$answer = "";

if (checkX($x) && checkY($y) && checkR($r)){
    if (checkCoordinate($x, $y, $r)){
        $answer = "IN";
    }
    else {
        $answer = "OUT";
    }
    $end = microtime(true) - $start;
    array_push($_SESSION['rows'],"<td>$x</td><td>$y</td><td>$r</td><td>$time</td><td>$end</td><td>$answer</td>");
}
echoHtml();