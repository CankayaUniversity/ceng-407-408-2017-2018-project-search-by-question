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
require dirname(dirname(__DIR__)) . "/services/NaturalLanguageClassifier.php";
require dirname(dirname(__DIR__)) . "/controllers/Functions.php";

$f = new Functions();
$keywords = "who is Genghis khan ? ";
$topic = $f->cleanText($keywords);
print_r($topic);

$discovery = new Discovery();
$NLU = new NaturalLanguageUnderstanding();
$classify = new NaturalLanguageClassifier();
print_r($classify->getClassifiers());
die();
$res = $discovery->query($topic["focus"]);

echo "<pre>";
//print_r(json_decode($res));
echo "</pre>";

$decodedRes = json_decode($res);
$arr = [];

foreach ($decodedRes->passages as $item => $val) {
    if ($val->passage_score > 5) {
        array_push($arr, $val->passage_text);
    }
}
if (count($arr) > 0) {
    $exp = explode("|", $arr[0]);


    echo "<pre>";
    // print_r($exp);
    echo "</pre>";


    if ($topic["question_type"] == "WHEN") {
        foreach ($exp as $key => $value) {
            echo "<pre>";
            $data = (json_decode($NLU->analyzeGet($value)));
            print_r($data);
            echo "</pre>";
            echo "<br><br><br>";
            echo "------------------------";
            echo "<br><br><br>";
        }
    } else {
        $status = 0;
        foreach ($exp as $key => $value) {
            if (strpos(strtoupper($value), $topic["focus"]) !== false) {
                echo "<pre>";
                echo $value;
                $data = (json_decode($NLU->analyzeGetNormal($value)));
                echo "<br>";
                //print_r($data);
                $entities = $f->analyzentities($data, $topic["question_type"], $topic["focus"]);

                if ($entities["status"] == 1) {
                    $status = 1;
                }

                print_r($entities);
                echo "</pre>";
                echo "<br><br><br>";
                echo "------------------------------------------------------------------------------------------------";
                echo "<br><br><br>";
            }
        }
        if($status == 0){
            foreach ($exp as $key1 => $value1) {
                $data = (json_decode($NLU->analyzeGetNormal($value1)));
                echo "<pre>";

                if(isset($data->semantic_roles)){
                $f->analyzSementicRoles($data);
                break;

                  //  print_r($data->semantic_roles[0]->object->text);

                }
                echo "</pre>";

            }
        }


        }


} else {
    echo "No result";
}




