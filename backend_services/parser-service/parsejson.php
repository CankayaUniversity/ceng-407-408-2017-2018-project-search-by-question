<?php
/**
 * Created by PhpStorm.
 * User: Mehmet Şerefoğlu
 * Date: 22.04.2018
 * Time: 20:19
 */

//incude database
require dirname(__DIR__)."/database-connection/database.php";

//reach datas in the json
$file = file_get_contents(dirname(__DIR__)."/sample-datas/dev-v1.1.json");

//decode json file
$json = json_decode($file);

//select data array
$jdata = $json->data;

//find paragraph count
$paragraphcnt = count($jdata);

$i = 0;

while ($i < $paragraphcnt) {
    foreach ($jdata[$i]->paragraphs as $key => $val) {
        $insert = $db->prepare("insert into datas SET data_parag=:dtp");
        $insert->bindParam(":dtp", $val->context, PDO::PARAM_STR);
        $chk = $insert->execute();
    }
    $i++;
}
