<?php

header("Access-Control-Allow-Origin: *");

$token = "3a1c8ba7ca3daeb79f61504cef285146";

require dirname(dirname(__DIR__)) . "/services/NaturalLanguageUnderstanding.php";

$nlu = new NaturalLanguageUnderstanding();


if (isset($_POST["data"])) {
    $json = json_decode($_POST["data"]);

    if ($json->token == $token) {
        $text = trim($json->question);

        $result = $nlu->analyzeGet($text);

        echo json_encode(array("status" => $result,"text"=> $text));
    } else {
        echo json_encode(array("status" => "Not authorized"));
    }


}else{
    echo json_encode(array("status" => "Not authorized"));
}

?>