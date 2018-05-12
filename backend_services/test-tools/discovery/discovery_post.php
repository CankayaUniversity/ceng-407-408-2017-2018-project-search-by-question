<?php
/**
 * Created by PhpStorm.
 * User: mehmetserefoglu
 * Date: 12/05/2018
 * Time: 10:45
 */

header("Access-Control-Allow-Origin: *");

require dirname(dirname(__DIR__)) . "/services/Discovery.php";

$discovery = new Discovery();
$keywords = "Tesla";
$res = $discovery->query($keywords);
echo "<pre>";
print_r(json_decode($res));
echo "</pre>";