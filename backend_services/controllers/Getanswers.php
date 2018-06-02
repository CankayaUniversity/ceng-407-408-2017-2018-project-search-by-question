<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 02.06.2018
 * Time: 23:51
 */
require dirname(__DIR__) . "/services/NaturalLanguageClassifier.php";
require dirname(__DIR__) . "/services/NaturalLanguageUnderstanding.php";
require dirname(__DIR__) . "/services/Discovery.php";
require __DIR__ . "/Functions.php";
require __DIR__ . "/Authorize.php";

class Getanswers
{

    public function IDONE($question, $entity)
    {
        $discovery = new Discovery();
        $classify = new NaturalLanguageClassifier();
        $authorize = new Authorize();
        $f = new Functions();

        $answers = [];

        $topic = $f->cleanText($question);


        $expQuestion = explode(" ", $topic["focus"]);
        $f->printr($expQuestion);
        $documents = json_decode($discovery->query($topic["focus"]));

        $nlucredentials = $authorize->returnAuth($entity);

        $NLU = new NaturalLanguageUnderstanding($nlucredentials["username"], $nlucredentials["password"], $nlucredentials["modelID"]);

        $texts = [];
        $textsUP = [];
        $i = 0;

        foreach ($documents->passages as $document => $value) {
            $exp = explode('|', $value->passage_text);

            foreach ($exp as $item) {
                $item = (string)$item;
                if (strlen(trim(strip_tags($item))) > 10) {
                    if (!in_array(strtoupper($item), $textsUP)) {
                        if (!empty($topic["action"])) {
                            if ($f->searchAction($item, $topic["action"]) === 1) {
                                array_push($textsUP, strtoupper($item));
                                array_push($texts, $item);
                                $i++;
                            }
                        } else {
                            array_push($textsUP, strtoupper($item));
                            array_push($texts, $item);

                        }
                    }

                }
            }
        }

        foreach ($texts as $text) {
            $analyz = json_decode($NLU->analyzeGet(trim($text)));
            $status = 0;

            foreach ($analyz->entities as $entities => $ens) {
                if ($ens->type == $entity) {
                    $status = 1;
                }
            }

            if ($status = 1) {
                foreach ($analyz->entities as $entities => $ens) {
                    if ($ens->type == 'Job') {
                        if (!in_array($ens->text, $answers))
                            array_push($answers, $ens->text);
                    }
                }
            }

        }
        return $answers;
    }

}