<?php
/**
 * Created by PhpStorm.
 * User: mehmetserefoglu
 * Date: 12/05/2018
 * Time: 10:45
 */

header("Access-Control-Allow-Origin: *");

require dirname(dirname(__DIR__)) . "/services/Discovery.php";
require dirname(dirname(__DIR__))."/services/NaturalLanguageUnderstanding.php";

$discovery = new Discovery();
$NLU = new NaturalLanguageUnderstanding();

$keywords = "Which NFL team represented the AFC at Super Bowl 50 ?";
$res = $discovery->query($keywords);

$decodedRes = json_decode($res);
$arr = [];

foreach ($decodedRes->passages as $item => $val) {
    if($val->passage_score > 8){
        array_push($arr,$val->passage_text);
    }
}
$exp = explode("|",$arr[0]);


echo "<pre>";
//print_r($exp);
echo "</pre>";



foreach ($exp as $key => $value) {
    echo "<pre>";
    print_r(json_decode($NLU->analyzeGet($value)));
    echo "</pre>";
    echo "<br><br><br>";
    echo "------------------------";
    echo "<br><br><br>";
}
