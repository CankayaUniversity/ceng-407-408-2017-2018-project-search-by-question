<?php
/**
 * Created by PhpStorm.
 * User: mehmetserefoglu
 * Date: 12/05/2018
 * Time: 10:45
 */

header("Access-Control-Allow-Origin: *");

require dirname(dirname(__DIR__)) . "/services/Discovery.php";
require dirname(dirname(__DIR__)) . "/services/NaturalLanguageUnderstanding.php";
require dirname(dirname(__DIR__)) . "/controllers/Functions.php";

$f = new Functions();
$keywords = " Nikola Tesla 10 July 1856  7 January 1943) was a Serbian American inventor, electrical engineer, mechanical engineer, physicist, and futurist best known for his contributions to the design of the modern alternating current (AC) electricity supply system.";
$topic = $f->cleanText($keywords);
//print_r($topic);


$discovery = new Discovery();
$NLU = new NaturalLanguageUnderstanding();
echo "<pre>";
print_r($NLU->analyzeGetNormal($keywords));
    echo "</pre>";
    die();

$res = $discovery->query($topic["focus"]);

echo "<pre>";
print_r(json_decode($res));
echo "</pre>";
die();
$decodedRes = json_decode($res);
$arr = [];

foreach ($decodedRes->passages as $item => $val) {
        array_push($arr, $val->passage_text);
}
if (count($arr) > 0) {
    $exp = explode("|", $arr[0]);


    echo "<pre>";
    print_r($exp);
    echo "</pre>";


    if ($topic["question_type"] == "WHEN" || ($topic["question_type"] == "WHAT" && $topic["action"] == "YEAR" )) {
        foreach ($exp as $key => $value) {
            echo "<pre>";
            $data = (json_decode($NLU->analyzeGet($value)));
            //print_r($data);
            echo "</pre>";
            echo "<br><br><br>";
            echo "------------------------";
            echo "<br><br><br>";
        }
    } else {
        $status = 0;
        $keys[] =null;
         $i = 0;
        foreach ($exp as $key => $value) {
                echo "<pre>";
                echo $value;
                $data = (json_decode($NLU->analyzeGetNormal($value)));
                echo "<pre>";
                echo "-----------------------------------------------------------------------";
                    //print_r($data);
                echo "</pre>";

                if(isset($data->keywords)){
                    $keys[$i] = $data->keywords;
                    $i++;
                }
        }

        echo "<pre>";
        print_r($f->analyzKeywords($keys));
        echo "</pre>";

        /*
         *
                foreach ($keys as $k => $v){
                    echo "<pre>";
                    print_r($v);
                    echo "</pre>";

                }*/


        }


} else {
    echo "No result";
}




