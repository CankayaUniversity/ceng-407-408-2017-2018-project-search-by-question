<?php
/**
 * Created by PhpStorm.
 * User: mehmetserefoglu
 * Date: 12/05/2018
 * Time: 17:12
 */

header("Access-Control-Allow-Origin: *");

$access_token = "3a1c8ba7ca3daeb79f61504cef285146";


require __DIR__ . "/Functions.php";
require __DIR__."/Authorize.php";
require __DIR__."/Getanswers.php";
$f = new Functions();

if (isset($_POST["data"])) {
    $getanswer = new Getanswers();
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

            $qanalyz = json_decode($classify->classify($question));
            $entity = $qanalyz->classes[0]->class_name;
            $res = $getanswer->IDONE($question,$entity);

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