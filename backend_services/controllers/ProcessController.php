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
require __DIR__ . "/Functions.php";

$f = new Functions();

if (isset($_POST["data"])) {
    $ans = null;
    $jsonData = json_decode($_POST["data"]);
    $targetData = null;
    $question = $f->cleanCode($jsonData->question);

    if ($access_token == $jsonData->token) {

        if ($f->checkQuestion($question) == 1) {
            $oldquestion = $f->checkOldQuestions($question);

            if($oldquestion["status"] == 1){
                echo json_encode(array("id"=>$oldquestion["qid"]));
                exit();
            }

            $discovery = new Discovery();
            $NLU = new NaturalLanguageUnderstanding();

            $topic = $f->cleanText($question);
            $res = $discovery->query($topic["focus"]);

            $decodedRes = json_decode($res);

            $arr = [];
            $relatedDatas = [];

            foreach ($decodedRes->passages as $item => $val) {
                if ($val->passage_score > 5) {
                    array_push($arr, $val->passage_text);
                }
            }

            if (count($arr) > 0) {
                $exp = explode("|", $arr[0]);


                if ($topic["question_type"] == "WHEN") {
                    foreach ($exp as $key => $value) {
                        $data = (json_decode($NLU->analyzeGet($value)));
                    }
                } else {
                    $status = 0;
                    foreach ($exp as $key => $value) {
                        if (strpos(strtoupper($value), $topic["focus"]) !== false) {
                            array_push($relatedDatas, $value);
                            $data = (json_decode($NLU->analyzeGetNormal($value)));
                            $entities = $f->analyzentities($data, $topic["question_type"], $topic["focus"]);
                            if($entities["status"] == 1){
                                foreach ($entities["results"] as $entity => $entityVal) {
                                    $ans .= $entityVal;


                                    if (count($entities["results"]) > 1)
                                        $ans .= ",";
                                }
                                $status = 1;
                                $targetData = $value;

                            }
                        }
                    }

                    if ($status == 0) {
                        foreach ($exp as $key1 => $value1) {
                            $data = (json_decode($NLU->analyzeGetNormal($value1)));

                            if (isset($data->semantic_roles)) {
                                $ans = $f->analyzSementicRoles($data);
                                break;


                            }

                        }
                    }
                }

                $res = array("id" => md5(sha1(uniqid(microtime()))),
                    "datas" => array(
                        "answer" => $ans, "question" => $question,"target_data"=>$targetData,
                        "relatatedDatas" => array(
                            "d" => $relatedDatas
                        )
                    ));
                $jsondt = file_get_contents(dirname(__DIR__) . "/cache/cache_file.json");
                $arr_data = json_decode($jsondt, true);
                array_push($arr_data, $res);
                $jsondt = json_encode($arr_data, JSON_PRETTY_PRINT);

                file_put_contents(dirname(__DIR__) . "/cache/cache_file.json", $jsondt);

                echo json_encode($res);

            } else {
                echo "No result";
            }


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