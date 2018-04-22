<?php

class NaturalLanguageUnderstanding
{

    public $username;
    public $password;
    public $modelID;

    const BASE_URL = "https://gateway.watsonplatform.net/natural-language-understanding/api/v1";

    public function __construct()
    {
        $this->username = "76261f9c-c0c9-4be8-a0a6-1e5a4723d04d";
        $this->password = "NdVnDDvtuDry";
        $this->modelID = "10:bb72e6f4-18a8-4d4e-8f9f-c08d467428e1";
    }

    public function analyzeGet($input)
    {

        $url = self::BASE_URL . "/analyze?version=2017-02-27";
        $encodedText = urlencode($input);
        $encodedID = urlencode($this->modelID);
		$url = $url . "&text={text_input}&features=entities%2Csentiment%2Crelations%2Csemantic_roles&return_analyzed_text=false&clean=true&fallback_to_raw=true&concepts.limit=8&emotion.document=true&entities.limit=50&entities.mentions=false&entities.model={model_id}&entities.emotion=false&entities.sentiment=false&keywords.limit=50&keywords.emotion=false&keywords.sentiment=false&relations.model=en-news&semantic_roles.limit=50&semantic_roles.entities=false&semantic_roles.keywords=false&sentiment.document=true";
        $url = str_replace("{text_input}", $encodedText, $url);
        $url = str_replace("{model_id}", $encodedID, $url);
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;

    }


    public function getModels()
    {

        $url = self::BASE_URL . "/models?version=2017-02-27";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;

    }


    public function deleteModel($modelId)
    {

        $url = self::BASE_URL . "/models/{model_id}?version=2017-02-27";
        $url = str_replace("{model_id}", $modelId, $url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;

    }

}

?>
