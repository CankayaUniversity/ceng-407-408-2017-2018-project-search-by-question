<?php
/**
 * Created by PhpStorm.
 * User: mehmetserefoglu
 * Date: 12/05/2018
 * Time: 17:22
 */

class Functions
{

    public $questionTypes = array("WHAT", "WHERE", "WHICH", "WHY", "WHO", "WHEN", "HOW");

    public $actions = [
        "WHO" => array(
            "FOUNDER", "CREATOR"
        ),
        "WHEN" => array(
            "DIE", "BORN", "DIED"
        ),
        "WHAT" => array(
            "BORN", "YEAR", "MONTH", "DAY"
        ),
    ];

    public $ToBe = array("?", "IS", "ARE", "WAS", "WERE", "IN");

    public function cleanCode($input)
    {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    public function cleanTobe($input)
    {
        $strUp = strtoupper($input);
        $nstr = null;
        $expQuestion = explode(" ", $strUp);

        foreach ($this->ToBe as $key => $val) {
            if (in_array($val, $expQuestion)) {
                unset($expQuestion[array_search($val,$expQuestion)]);
            }
        }
        foreach ($expQuestion as $k => $v){
            $nstr.=$v;
            $nstr.=" ";
        }
        return trim($nstr);
    }


    public function cleanText($input)
    {
        $strUp = strtoupper($input);
        $res = array();
        $res["action"] = null;
        $expQuestion = explode(" ", $strUp);
        $i = 0;
        foreach ($this->questionTypes as $questionType => $val) {

            if (in_array($val, $expQuestion)) {
                if (isset($this->actions[$val])) {
                    foreach ($this->actions[$val] as $action => $aval) {
                        if (in_array($aval, $expQuestion)) {
                            $res["action"] = $aval;
                            $strUp = str_replace($aval, " ", $strUp);
                            $i++;
                        }

                    }
                }
                $res["question_type"] = $val;
                $strUp = str_replace($val, " ", $strUp);
            }

            $res["focus"] = trim($strUp);
        }
        $res["focus"] = $this->cleanTobe($res["focus"]);

        return $res;
    }

    public function checkQuestion($input)
    {
        $status = 0;
        $question = strtoupper($this->cleanCode($input));
        $expQuestion = explode(" ", $question);


        foreach ($this->questionTypes as $key => $val) {
            if (in_array($val, $expQuestion)) {
                $status = 1;
            }
        }


        return $status;
    }

    public function analyzentities($input, $qtype, $focus)
    {
        $res["results"] = [];
        $status = false;
        $statusForOther = false;

        if ($qtype == "WHO") {
            foreach ($input->entities as $item => $value) {

                if (strpos(strtoupper($value->text), $focus) !== false && $value->type == 'Person') {
                    $status = true;
                }
            }

            if($status === true){
                foreach ($input->entities as $entity => $eval) {
                    if ( $eval->type == 'JobTitle') {
                        array_push($res["results"], $eval->text);
                        $statusForOther = true;
                    }
                }
            }


        }


        $res["status"] = $status===true&&$statusForOther===true?true:false;

        return $res;
    }

    public function analyzSementicRoles($input){

        return $input->semantic_roles[0]->object->text;

    }

    public function checkOldQuestions($question){

        $jsondt = file_get_contents(dirname(__DIR__) . "/cache/cache_file.json");
        $arr = json_decode($jsondt);
        $res["qid"] = null;
        $res["status"] = 0;

        foreach ($arr as $key => $val){
            if(trim($val->datas->question) == trim($question)){
                $res["qid"] = $val->id;
                $res["status"] = 1;
            }
        }


        return $res;
    }
}