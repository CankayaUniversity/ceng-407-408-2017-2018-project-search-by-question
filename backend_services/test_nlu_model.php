<?php

require "NaturalLanguageUnderstanding.php";

$nlu = new NaturalLanguageUnderstanding();

if(isset($_POST)){

    $text = trim($_POST["text"]);
    $modelid = trim($_POST["modelid"]);

    $result = $nlu->analyzeGet($text,$modelid);

    echo "<pre>";
    print_r($result);
    echo "</pre>";
    
}

?>