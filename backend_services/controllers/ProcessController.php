<?php
/**
 * Created by PhpStorm.
 * User: mehmetserefoglu
 * Date: 12/05/2018
 * Time: 17:12
 */

header("Access-Control-Allow-Origin: *");

$access_token = "3a1c8ba7ca3daeb79f61504cef285146";
require dirname(__DIR__) . "/services/Discovery.php";
require dirname(__DIR__) . "/services/NaturalLanguageUnderstanding.php";
require dirname(__DIR__) . "/services/NaturalLanguageClassifier.php";
require __DIR__ . "/Functions.php";
require __DIR__ . "/Authorize.php";

$f = new Functions();
$discovery = new Discovery();
$authorize = new Authorize();
$f = new Functions();
$classify = new NaturalLanguageClassifier();

if (isset($_POST["data"])) {
    $answers = [];
    $possibleAnswer = [];
    $possibleAnswerFrequency = [];
    $jsonData = json_decode($_POST["data"]);
    $targetData = null;
    $question = $f->cleanCode($jsonData->question);
    $ans = null;
    $res = [];

    if ($access_token == $jsonData->token) {

        if ($f->checkQuestion($question) == 1) {
            $oldquestion = $f->checkOldQuestions($question);

            if ($oldquestion["status"] == 1) {
                echo json_encode(array("id" => $oldquestion["qid"]));
                exit();
            }


            $qanalyz = json_decode($classify->classify($question));
            $entity = $qanalyz->classes[0]->class_name;

            $topic = $f->cleanText($question);

            $expQuestion = explode(" ", $topic["focus"]);
            $documents = json_decode($discovery->query($topic["focus"]));

            $nlucredentials = $authorize->returnAuth($entity);

            $NLU = new NaturalLanguageUnderstanding($nlucredentials["username"], $nlucredentials["password"], $nlucredentials["modelID"]);
            $possibleAnswer = [];
            $texts = [];
            $textsUP = [];
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

            if ($entity == 'Person') {
                $look = 'Job';
            } else {
                $look = $entity;
            }
            $i = 0;
            if ($entity == 'JobTitle' || $entity == 'Definition') {
                foreach ($texts as $text) {
                    $analyz = json_decode($NLU->analyzeGetDefault(trim($text)));
                    if (isset($analyz->semantic_roles)) {
                        foreach ($analyz->semantic_roles as $entities => $ens) {
                            if (isset($ens->object->text)) {
                                if (!in_array(trim(strip_tags($ens->object->text)), $answers)) {
                                    array_push($possibleAnswer, $ens->sentence);
                                    array_push($answers, $ens->object->text);
                                    $i++;
                                }

                            }
                        }
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
                        if ($frequecy > 0) {
                            if (!in_array($text, $possibleAnswer)) {
                                array_push($possibleAnswer, $text);
                                $possibleAnswerFrequency[$iteration]["text"] = $text;
                                $possibleAnswerFrequency[$iteration]["frequency"] = $frequecy;
                                $iteration++;
                            }
                        }


                    }

                }
            }

            if (count($answers) > 7) {
                $answers = $f->fixResult($answers);
            }


            if (count($answers) > 0) {
                foreach ($answers as $answer) {
                    $ans .= $answer . ",";
                }

                if (count($possibleAnswerFrequency) > 0) {
                    $possibleAnswerFrequency = $f->sksort($possibleAnswerFrequency, 'frequency');
                } else {
                    $possibleAnswerFrequency[0]["text"] = $possibleAnswer[0];
                }

                $res = array("id" => md5(sha1(uniqid(microtime()))),
                    "datas" => array(
                        "answer" => $ans, "question" => $question, "target_data" => $possibleAnswerFrequency[0]["text"],
                        "answer_keys" => $answers,
                        "relatatedDatas" => array(
                            "d" => $possibleAnswer
                        ),
                        "question_keys" => $expQuestion
                    ));

                $jsondt = file_get_contents(dirname(__DIR__) . "/cache/cache_file.json");
                $arr_data = json_decode($jsondt, true);
                array_push($arr_data, $res);
                $jsondt = json_encode($arr_data, JSON_PRETTY_PRINT);
                file_put_contents(dirname(__DIR__) . "/cache/cache_file.json", $jsondt);

                $jsondt = file_get_contents(dirname(__DIR__) . "/cache/answers.json");
                $arr_data = json_decode($jsondt, true);
                array_push($arr_data, $res);
                $jsondt = json_encode($arr_data, JSON_PRETTY_PRINT);
                file_put_contents(dirname(__DIR__) . "/cache/answers.json", $jsondt);

            } else {
                $ans = "We couldn't find answer";
                $res = array("id" => md5(sha1(uniqid(microtime()))),
                    "datas" => array(
                        "answer" => $ans, "question" => $question, "target_data" => null,
                        "answer_keys" => null,
                        "relatatedDatas" => array(
                            "d" => null
                        ),
                        "question_keys" => null
                    ));
                $jsondt = file_get_contents(dirname(__DIR__) . "/cache/answers.json");
                $arr_data = json_decode($jsondt, true);
                array_push($arr_data, $res);
                $jsondt = json_encode($arr_data, JSON_PRETTY_PRINT);
                file_put_contents(dirname(__DIR__) . "/cache/answers.json", $jsondt);
            }


            echo json_encode($res);

        } else {
            echo json_encode(array("status" => 0, "message" => "Please choose a question type!"));
        }


    } else {
        echo json_encode(array("status" => 0, "message" => "Not Authorized!"));
        exit();
    }

} else {
    echo json_encode(array("status" => 0, "message" => "Invalid Request!"));
    exit();
}