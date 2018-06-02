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
$keywords = "who is tesla ?";
$topic = $f->cleanText($keywords);
print_r($topic);

$discovery = new Discovery();
$NLU = new NaturalLanguageUnderstanding();
$classify = new NaturalLanguageClassifier();

$res = $discovery->query($topic["focus"]);
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

