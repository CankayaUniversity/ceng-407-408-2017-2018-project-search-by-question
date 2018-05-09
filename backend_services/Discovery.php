<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 09.05.2018
 * Time: 23:42
 */

Class Discovery {
    private $username;
    private $password;
    const BASE_URL = "https://gateway.watsonplatform.net/discovery/api/v1/environments";

    function __construct() {
        $this->username = "";
        $this->password = "";
    }


    public function createEnvironment($environmentName, $environmentDesc, $size) {

        $url = self::BASE_URL . "?version=2016-12-01";

        $data["name"] = $environmentName;
        $data["description"] = $environmentDesc;
        $data["size"] = $size;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function getEnvironments() {

        $url = self::BASE_URL . "?version=2016-12-01";

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


    public function getEnvironment($environmentId) {

        $url = self::BASE_URL . "/{environment_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);

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


    public function updateEnvironment($environmentId, $environmentName, $environmentDesc, $size) {

        $url = self::BASE_URL . "/{environment_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);

        $data["name"] = $environmentName;
        $data["description"] = $environmentDesc;
        $data["size"] = $size;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function deleteEnvironment($environmentId) {

        $url = self::BASE_URL . "/{environment_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
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


    public function createConfiguration($environmentId, $configurationName) {

        $url = self::BASE_URL . "/{environment_id}/configurations?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);

        $data["name"] = $configurationName;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function getConfigurations($environmentId) {

        $url = self::BASE_URL . "/{environment_id}/configurations?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);

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


    public function getConfiguration($environmentId, $configurationId) {

        $url = self::BASE_URL . "/{environment_id}/configurations/{configuration_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{configuration_id}", $configurationId, $url);

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


    public function updateConfiguration($environmentId, $configurationId, $configurationName) {

        $url = self::BASE_URL . "/{environment_id}/configurations/{configuration_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{configuration_id}", $configurationId, $url);

        $data["name"] = $configurationName;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function deleteConfiguration($environmentId, $configurationId) {

        $url = self::BASE_URL . "/{environment_id}/configurations/{configuration_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{configuration_id}", $configurationId, $url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
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


    public function createCollection($environmentId, $collectionName, $collectionDesc, $configurationId) {

        $url = self::BASE_URL . "/{environment_id}/collections?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);

        $data["name"] = $collectionName;
        $data["description"] = $collectionDesc;
        $data["configuration_id"] = $configurationId;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function getCollections($environmentId) {

        $url = self::BASE_URL . "/{environment_id}/collections?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);

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


    public function getCollection($environmentId, $collectionId) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{collection_id}", $collectionId, $url);

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


    public function updateCollection($environmentId, $collectionId, $collectionName, $collectionDesc, $configurationId) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{collection_id}", $collectionId, $url);

        $data["name"] = $collectionName;
        $data["description"] = $collectionDesc;
        $data["configuration_id"] = $configurationId;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function getCollectionFields($environmentId, $collectionId) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/fields?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{collection_id}", $collectionId, $url);

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


    public function deleteCollection($environmentId, $collectionId) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{collection_id}", $collectionId, $url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
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

    public function createDocument($environmentId, $collectionId, $documentUrl) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/documents?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{collection_id}", $collectionId, $url);

        $data["file"] = $documentUrl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function updateDocument($environmentId, $collectionId, $documentId, $documentUrl) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/documents/{document_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{collection_id}", $collectionId, $url);
        $url = str_replace("{document_id}", $documentId, $url);

        $data["file"] = $documentUrl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function getDocument($environmentId, $collectionId, $documentId) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/documents/{document_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{collection_id}", $collectionId, $url);
        $url = str_replace("{document_id}", $documentId, $url);

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


    public function deleteDocument($environmentId, $collectionId, $documentId) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/documents/{document_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{collection_id}", $collectionId, $url);
        $url = str_replace("{document_id}", $documentId, $url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
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


    public function query($environmentId, $collectionId, $keywords, $count, $filter, $return) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/query?version=2016-12-01";
        $url = str_replace("{environment_id}", $environmentId, $url);
        $url = str_replace("{collection_id}", $collectionId, $url);

        $data["query"] = $keywords;
        $data["count"] = $count;
        $data["filter"] = $filter;
        $data["return"] = $return;

        $url = $url . "&query=" . $data["query"] . "&count=" . $data["count"] . "&filter=" . $data["filter"] . "&return=" . $data["return"];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            "Content_type: application/json"
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
}
?>

