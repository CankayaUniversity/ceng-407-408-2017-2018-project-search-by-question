<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 03.06.2018
 * Time: 13:03
 */

require dirname(dirname(__DIR__)) . "/services/NaturalLanguageClassifier.php";
require dirname(dirname(__DIR__)) . "/services/NaturalLanguageUnderstanding.php";
require dirname(dirname(__DIR__)) . "/services/Discovery.php";
require dirname(dirname(__DIR__)) . "/controllers/Functions.php";
require dirname(dirname(__DIR__)) . "/controllers/Authorize.php";
$discovery = new Discovery();
$authorize = new Authorize();
$f = new Functions();
$classify = new NaturalLanguageClassifier();

$question = "What is the the most spoken language in the world ?";

$qanalyz = json_decode($classify->classify($question));
$entity = $qanalyz->classes[0]->class_name;
$answers = [];

$topic = $f->cleanText($question);
$f->printr($topic);

$expQuestion = explode(" ", $topic["focus"]);
$f->printr($expQuestion);
$documents = json_decode($discovery->query($topic["focus"]));


$nlucredentials = $authorize->returnAuth($entity);

$NLU = new NaturalLanguageUnderstanding($nlucredentials["username"], $nlucredentials["password"], $nlucredentials["modelID"]);
$possibleAnswer = [];
$possibleAnswerFrequency = [];
$texts = [];
$i = 0;

foreach ($documents->passages as $document => $value) {
    $exp = explode('|', $value->passage_text);

    foreach ($exp as $item) {
        $item = trim(strip_tags($item));
        if (strlen($item) > 10) {
            if (!in_array($item, $texts)) {
                if (!empty(strip_tags($topic["action"]))) {
                    if ($f->searchAction($item, $topic["action"]) === 1) {
                        array_push($texts, $item);
                    }
                } else {
                    array_push($texts, $item);
                }
            }

        }
    }
}
$f->printr($texts);
if ($entity == 'Person') {
    $look = 'Job';
} else {
    $look = $entity;
}
$i = 0;
if ($entity == 'JobTitle') {
    foreach ($texts as $text) {
        $analyz = json_decode($NLU->analyzeGet(trim($text)));
        foreach ($analyz->semantic_roles as $entities => $ens) {
            if (isset($ens->object->text)) {
                if (strpos(strtoupper($ens->sentence), strtoupper($topic["focus"]))) {
                    if (!in_array($ens->object->text, $answers)) {
                        array_push($possibleAnswer, $ens->sentence);
                        array_push($answers, $ens->object->text);
                        $i++;
                    }
                }

            }

        }

        if ($i == 5) {
            break;
        }
    }
} else {
        $iteration = 0;
        foreach ($texts as $text) {
            $analyz = json_decode($NLU->analyzeGet(trim($text)));
            foreach ($analyz->entities as $entities => $ens) {
                if ($ens->type == $entity) {
                    $status = 1;
                }
            }
            if ($status = 1) {
                $frequecy = 0;
                foreach ($analyz->entities as $entities => $ens) {
                    $st = 0;
                    if ($ens->type == $look) {
                        if (!in_array($ens->text, $answers)) {
                            array_push($answers, $ens->text);
                            $frequecy++;
                        }

                    }
                }
                if($frequecy>0){
                    if (!in_array($text, $possibleAnswer)){
                        array_push($possibleAnswer, $text);
                        $possibleAnswerFrequency[$iteration]["text"] = $text;
                        $possibleAnswerFrequency[$iteration]["frequency"] = $frequecy;
                        $iteration++;
                    }
                }


            }


        }
}

$f->printr($answers);
$f->printr($possibleAnswer);
$f->printr($f->sksort($possibleAnswerFrequency,"frequency"));