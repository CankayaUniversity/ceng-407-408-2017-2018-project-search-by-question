<?php

class NaturalLanguageUnderstanding
{

    public $username;
    public $password;
    public $modelID;

    const BASE_URL = "https://gateway.watsonplatform.net/natural-language-understanding/api/v1";

    public function __construct()
    {
        $this->username = "d1d6e0cf-aab4-4c45-80e6-ebf1b43821ca";
        $this->password = "vtAYwy4Jawsd";
        $this->modelID = "10:a09ad454-95b9-4e1f-b1f9-70fb913e7ae7";
    }

    public function analyzeGet($input)
    {

        $url = self::BASE_URL . "/analyze?version=2017-02-27";

		$url = $url . "&text={text_input}&features={features}&return_analyzed_text={return_text}&clean={clean}&fallback_to_raw={fallback_to_raw}&concepts.limit={concept_limit}&emotion.document={emotion_document}&entities.limit={entities_limit}&entities.mentions={entities_mentions}&entities.model={entities_model}&entities.emotion={entities_emotion}&entities.sentiment={entities_sentiment}&keywords.limit={keywords_limit}&keywords.emotion={keywords_emotion}&keywords.sentiment={keywords_sentiment}&relations.model={relations_model}&semantic_roles.limit={semantic_roles_limit}&semantic_roles.entities={semantic_roles_entities}&semantic_roles.keywords={semantic_roles_keywords}&sentiment.document={sentiment_document}";

		$url = str_replace("{text_input}", urlencode($input), $url);
        $url = str_replace("{features}", urlencode("entities,keywords,relations,semantic_roles"), $url);
        $url = str_replace("{clean}", "true", $url);
        $url = str_replace("{fallback_to_raw}", "true", $url);
        $url = str_replace("{concept_limit}", 8, $url);
        $url = str_replace("{emotion_document}", "true", $url);
        $url = str_replace("{entities_limit}", 50, $url);
        $url = str_replace("{entities_mentions}", "false", $url);
        $url = str_replace("{entities_model}", urlencode($this->modelID), $url);
        $url = str_replace("{entities_emotion}", "false", $url);
        $url = str_replace("{entities_sentiment}", "false", $url);
        $url = str_replace("{keywords_emotion}", "false", $url);
        $url = str_replace("{keywords_sentiment}", "false", $url);
        $url = str_replace("{keywords_limit}", 50, $url);
        $url = str_replace("{relations_model}", urlencode("en-news"), $url);
        $url = str_replace("{semantic_roles_limit}", 50, $url);
        $url = str_replace("{semantic_roles_entities}", "true", $url);
        $url = str_replace("{semantic_roles_keywords}", "false", $url);
        $url = str_replace("{sentiment_document}", "true", $url);
        $url = str_replace("{return_text}", "false", $url);

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
