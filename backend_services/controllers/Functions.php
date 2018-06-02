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
            "BORN", "YEAR", "MONTH", "DAY", "WON", "LOST","LOSE","CURRENCY","NATIONALITY","ETHNICITY","COLOR"
        ),
        "WHERE" => array(
            "DIE", "BORN", "DIED","WON", "LOST","LOSE"
        )
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

    public function sksort(&$array, $subkey, $sort_ascending=false) {
        $temp_array = null;
        if (count($array))
            $temp_array[key($array)] = array_shift($array);

        foreach($array as $key => $val){
            $offset = 0;
            $found = false;
            foreach($temp_array as $tmp_key => $tmp_val)
            {
                if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
                {
                    $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                        array($key => $val),
                        array_slice($temp_array,$offset)
                    );
                    $found = true;
                }
                $offset++;
            }
            if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
        }

        if ($sort_ascending) $array = array_reverse($temp_array);

        else $array = $temp_array;

        return $array;
    }

    public function analyzKeywords($data){
        $res[] = null;
        $dt = array();
        $ans = null;
        $i = 0;
        //print_r($data);
        foreach ($data as $key => $value) {
            $dt[$i] = array(
                "relevance" =>floatval($value[0]->relevance),
                "text" =>$value[0]->text
            );
            $i++;

        }
        $dt = $this->sksort($dt,"relevance",false);

        $res = $dt[0];
        return $res;
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

    public function cleanPh($text){
        $text = str_replace("]","",$text);
        $text = str_replace("[","",$text);
        $text = str_replace("(","",$text);
        $text = str_replace(")","",$text);
        return $text;
    }


    public function checkOldQuestions($question){

        $jsondt = file_get_contents(dirname(__DIR__) . "/cache/cache_file.json");
        $arr = json_decode($jsondt);
        $res["qid"] = null;
        $res["status"] = 0;

        foreach ($arr as $key => $val){
            if(trim(strtoupper($val->datas->question)) == trim(strtoupper($question))){
                $res["qid"] = $val->id;
                $res["status"] = 1;
            }
        }


        return $res;
    }

    public function printr($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    public function searchAction($arr,$text){
        $exp = explode(" ",$arr);
        $exp = array_map("strtoupper",$exp);
        $status = 0;
        if(in_array(strtoupper($text),$exp)){
            $status = 1;
        }

        return $status;


    }
}