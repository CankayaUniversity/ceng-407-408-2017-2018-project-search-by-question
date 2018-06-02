<?php
/**
 * Created by PhpStorm.
 * User: mehmetserefoglu
 * Date: 12/05/2018
 * Time: 10:45
 */

header("Access-Control-Allow-Origin: *");

require dirname(dirname(__DIR__)) . "/services/Discovery.php";
require dirname(dirname(__DIR__)) . "/services/NaturalLanguageUnderstanding.php";
require dirname(dirname(__DIR__)) . "/services/NaturalLanguageClassifier.php";
require dirname(dirname(__DIR__)) . "/controllers/Functions.php";


$f = new Functions();
$keywords = " How did Tesla lose his tuition money?";
$topic = $f->cleanText($keywords);
//print_r($topic);

$discovery = new Discovery();
$NLU = new NaturalLanguageUnderstanding();
$classify = new NaturalLanguageClassifier();
//print_r($classify->getClassifier());
echo "<pre>";
//print_r($classify->classify("Where did Tesla return to in 1873?"));
echo "</pre>";


$res = $discovery->query($topic["focus"]);
echo "<pre>";
print_r(json_decode($res));
echo "</pre>";
die();

$text = "| Nikola Tesla 10 July 1856 7 January 1943) was a Serbian American inventor, electrical engineer, mechanical engineer, physicist, and futurist best known for his contributions to the design of the modern alternating current (AC) electricity supply system.";
echo "<pre>";
//print_r(json_decode($res));
echo "</pre>";
$dres = json_decode($res);


foreach ($dres->passages as $item => $val) {
    //echo $val->passage_text . "<br>";
}
echo "<pre>";

print_r($NLU->analyzeGetNormal($text));
echo "</pre>";

