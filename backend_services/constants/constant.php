<?php
/**
 * Created by PhpStorm.
 * User: Mehmet Şerefoğlu
 * Date: 22.04.2018
 * Time: 21:29
 */

$base = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$base .= '://'.$_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
// $base =  '/';

define('PREFIX', $base);