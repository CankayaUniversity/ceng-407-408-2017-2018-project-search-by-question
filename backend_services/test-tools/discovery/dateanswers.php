<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 02.06.2018
 * Time: 21:40
 */

header("Access-Control-Allow-Origin: *");

require dirname(dirname(__DIR__)) . "/services/Discovery.php";
require dirname(dirname(__DIR__)) . "/services/NaturalLanguageUnderstanding.php";
require dirname(dirname(__DIR__)) . "/services/NaturalLanguageClassifier.php";
require dirname(dirname(__DIR__)) . "/controllers/Functions.php";
require dirname(dirname(__DIR__)) . "/controllers/Authorize.php";

$authorize = new Authorize();
$discovery = new Discovery();
$classify = new NaturalLanguageClassifier();
$f = new Functions();

$question = "When was genghis khan born ?";
$qanalyz = json_decode($classify->classify($question));
//$f->printr($qanalyz);

$answers = [];

$topic = $f->cleanText($question);
print_r($topic);

$expQuestion = explode(" ", $topic["focus"]);
$f->printr($expQuestion);
$documents = json_decode($discovery->query($topic["focus"]));
//$f->printr($documents);

$entity = $qanalyz->classes[0]->class_name;
$f->printr($entity);


$nlucredentials = $authorize->returnAuth($entity);

$NLU = new NaturalLanguageUnderstanding($nlucredentials["username"], $nlucredentials["password"], $nlucredentials["modelID"]);


$texts = [];
$textsUP = [];
$i = 0;

foreach ($documents->passages as $document => $value) {
    $exp = explode('|', $value->passage_text);

    foreach ($exp as $item) {
        $item = (string)$item;
        if (strlen(trim(strip_tags($item))) > 10) {
            if (!in_array(strtoupper($item), $textsUP)) {
                if(!empty($topic["action"])){
                    if($f->searchAction($item,$topic["action"]) === 1){
                        array_push($textsUP, strtoupper($item));
                        array_push($texts, $item);
                        $i++;
                    }
                }else{
                    array_push($textsUP, strtoupper($item));
                    array_push($texts, $item);

                }
            }

        }
    }
}

foreach ($texts as $text) {

    $status = 0;
    $text = strtoupper($text);
    $exp = explode(" ", $text);
    if (in_array($topic["action"],$exp)) {
        echo $text . "<br>";
        $analyz = json_decode($NLU->analyzeGet(trim($text)));
        $f->printr($analyz);
        foreach ($analyz->entities as $entities => $ens) {
            $st = 0;
            if ($ens->type == $entity) {
                $status = 1;
            }
        }
        if ($status = 1) {
            foreach ($analyz->entities as $entities => $ens) {
                if ($ens->type == 'Date') {
                    if (!in_array($f->cleanPh($ens->text), $answers))
                        array_push($answers, $f->cleanPh($ens->text));
                }
            }
        }
    }

    echo "---------------------------------------";
}
print_r($answers);