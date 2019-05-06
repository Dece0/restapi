<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once './dbs.class.php';

$db = DB::getInstance();
var_dump($db->getTableList());
// echo"<br>";
// var_dump($db->test());
