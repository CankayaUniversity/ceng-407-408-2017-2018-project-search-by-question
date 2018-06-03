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
    private $collectionID;
    private $invID;
    private $confid;
    private $documentID;


    const BASE_URL = "https://gateway.watsonplatform.net/discovery/api/v1/environments";

    function __construct() {
        $this->username = "fbeb6764-d3a9-4714-83a7-870d7cd028ca";
        $this->password = "AgpuodfC3QkD";
        $this->collectionID = "508929cc-734b-426b-9a91-efe51d969127";
        $this->confid = "bc9d3a77-fcef-4f33-9a74-05343cc45aa5";
        $this->invID = "5e00737a-cb86-486f-87ed-74919560a60d";
        $this->documentID = "982df4f69f46be1577703d3d7856596c";


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


    public function getEnvironment() {

        $url = self::BASE_URL . "/{environment_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);

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


    public function updateEnvironment($environmentName, $environmentDesc, $size) {

        $url = self::BASE_URL . "/{environment_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);

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


    public function deleteEnvironment() {

        $url = self::BASE_URL . "/{environment_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);

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


    public function createConfiguration($configurationName) {

        $url = self::BASE_URL . "/{environment_id}/configurations?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);

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


    public function getConfigurations() {

        $url = self::BASE_URL . "/{environment_id}/configurations?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);

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


    public function getConfiguration() {

        $url = self::BASE_URL . "/{environment_id}/configurations/{configuration_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{configuration_id}", $this->confid, $url);

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


    public function updateConfiguration($configurationName) {

        $url = self::BASE_URL . "/{environment_id}/configurations/{configuration_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{configuration_id}", $this->confid, $url);

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


    public function deleteConfiguration() {

        $url = self::BASE_URL . "/{environment_id}/configurations/{configuration_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{configuration_id}", $this->confid, $url);

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


    public function createCollection($collectionName, $collectionDesc) {

        $url = self::BASE_URL . "/{environment_id}/collections?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);

        $data["name"] = $collectionName;
        $data["description"] = $collectionDesc;
        $data["configuration_id"] = $this->confid;

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


    public function getCollections() {

        $url = self::BASE_URL . "/{environment_id}/collections?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);

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


    public function getCollection() {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{collection_id}", $this->collectionID, $url);

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


    public function updateCollection( $collectionName, $collectionDesc, $configurationId) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{collection_id}", $this->collectionID, $url);

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


    public function getCollectionFields() {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/fields?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{collection_id}", $this->collectionID, $url);

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


    public function deleteCollection() {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{collection_id}", $this->collectionID, $url);

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
/*
    public function createDocument($documentUrl) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/documents?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{collection_id}", $this->collectionID, $url);

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
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{collection_id}", $this->collectionID, $url);
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
*/


    public function getDocument($docid) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/documents/{document_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{collection_id}", $this->collectionID, $url);
        $url = str_replace("{document_id}", $docid, $url);

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


    public function deleteDocument() {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/documents/{document_id}?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{collection_id}", $this->collectionID, $url);
        $url = str_replace("{document_id}", $this->documentID, $url);

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


    public function query($keywords) {

        $url = self::BASE_URL . "/{environment_id}/collections/{collection_id}/query?version=2016-12-01";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{collection_id}", $this->collectionID, $url);
        $url = $url . "&natural_language_query={natural_language_query}&passages={passages}&count={count}&passages.count={passages_count}&return={return}&passages.characters={passages_characters}";
        $url = str_replace("{environment_id}", $this->invID, $url);
        $url = str_replace("{collection_id}", $this->collectionID, $url);
        $url = str_replace("{natural_language_query}", urlencode(trim($keywords)), $url);
        $url = str_replace("{passages}", "true", $url);
        $url = str_replace("{count}", 5, $url);
        $url = str_replace("{passages_count}", 5, $url);
        $url = str_replace("{return}", "text", $url);
        $url = str_replace("{passages_characters}", 2000, $url);
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

