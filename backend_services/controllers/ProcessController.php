<?php
/**
 * Created by PhpStorm.
 * User: mehmetserefoglu
 * Date: 12/05/2018
 * Time: 17:12
 */

header("Access-Control-Allow-Origin: *");

$access_token = "3a1c8ba7ca3daeb79f61504cef285146";

require dirname(__DIR__)."/services/Discovery.php";
require dirname(__DIR__)."/services/NaturalLanguageUnderstanding.php";
require __DIR__."/Functions.php";

$functions = new Functions();

if(isset($_POST["data"])){

    $jsonData = json_decode($_POST["data"]);
    $question = $functions->cleanCode($jsonData->question);

    if($access_token == $jsonData->token){

        if($functions->checkQuestion($question) == 1){

            $discovery = new Discovery();


            $res = $discovery->query($question);

            echo $res;

        }else{
            echo json_encode(array("status" => 0, "message" => "Please choose a question type!"));
        }


    }else{
        echo json_encode(array("status" => 0,"message" => "Not Authorized!"));
        exit();
    }

}else{
    echo json_encode(array("status" => 0,"message" => "Invalid Request!"));
    exit();
}