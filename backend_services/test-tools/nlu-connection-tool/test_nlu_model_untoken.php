<?php

header("Access-Control-Allow-Origin: *");


require dirname(dirname(__DIR__)) . "/services/NaturalLanguageUnderstanding.php";

$nlu = new NaturalLanguageUnderstanding();


if (isset($_POST["data"])) {

        $text = trim($_POST["text"]);

        $result = $nlu->analyzeGet($text);

        $decodedRes = json_decode($result);
        echo "<pre>";
        print_r($decodedRes);
        echo "</pre>";



}else{
    echo json_encode(array("status" => "Not authorized"));
}

?>