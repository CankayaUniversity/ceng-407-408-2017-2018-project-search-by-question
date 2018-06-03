<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 02.06.2018
 * Time: 15:52
*/

header("Access-Control-Allow-Origin: *");


require dirname(dirname(__DIR__)) . "/controllers/Functions.php";
require dirname(dirname(__DIR__)) . "/services/NaturalLanguageClassifier.php";

$functions = new Functions();


$q = "Where was Atuturk born ?";
$classify = new NaturalLanguageClassifier();


$functions->printr($classify->getClassifiers());
//$classify->deleteClassifier("95bdc1x403-nlc-618");
$functions->printr($classify->getClassifier("bc5490x411-nlc-54"));
//$functions->printr($classify->classify($q));