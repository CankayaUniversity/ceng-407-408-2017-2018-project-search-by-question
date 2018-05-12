<?php
/**
 * Created by PhpStorm.
 * User: mehmetserefoglu
 * Date: 12/05/2018
 * Time: 17:22
 */

class Functions{

    public function cleanCode($input){
        return htmlspecialchars(strip_tags(trim($input)));
    }


    public function checkQuestion($input){
        $status = 0;
        $question = strtoupper($this->cleanCode($input));
        $expQuestion = explode(" ",$question);

        $questionTypes = array("WHAT","WHERE","WHICH","WHY","WHO","HOW");

        foreach ($questionTypes as $key => $val){
            if(in_array($val,$expQuestion)){
                $status = 1;
            }
        }


        return $status;
    }
}