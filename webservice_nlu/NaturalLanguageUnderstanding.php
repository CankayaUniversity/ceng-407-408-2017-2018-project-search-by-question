<?php
class NaturalLanguageUnderstanding {

	const BASE_URL = "https://gateway.watsonplatform.net/natural-language-understanding/api/v1";

	function __construct() {
       
    }

	function analyze($username, $password, $features, $input, $inputType) {

		$url = self::BASE_URL . "/analyze?version=2017-02-27";
		$data = $features;
		$data[$inputType]=$input;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		curl_close($ch);

		return $result;

	}


	function analyzeGet($username, $password) {

		$url = self::BASE_URL . "/analyze?version=2017-02-27";
		$url = $url . "&url=www.ibm.com&features=keywords&entities.emotion=true&entities.sentiment=true&keywords.emotion=true&keywords.sentiment=true";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		curl_close($ch);

		return $result;

	}
	

	function getModels($username, $password) {

		$url = self::BASE_URL . "/models?version=2017-02-27";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		curl_close($ch);

		return $result;

	}


	function deleteModel($username, $password, $modelId) {

		$url = self::BASE_URL . "/models/{model_id}?version=2017-02-27";
		$url = str_replace("{model_id}", $modelId, $url);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array (
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		curl_close($ch);

		return $result;

	}

}

?>
