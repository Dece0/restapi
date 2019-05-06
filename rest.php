<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '_includes/get.php';
require_once '_includes/post.php';
require_once '_includes/helpers.php';

header('Content-Type: application/json; charset=UTF-8');
$method = $_SERVER['REQUEST_METHOD'];
if(empty($_SERVER['PATH_INFO'])) {
    printMessage("Not enough arguments in URL");
    die();
}
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGetRequest($request);
        break;

    case 'POST':
        handlePostRequest($request, $input);
        break;
    
    default:
        printMessage("Unsupported HTTP request method '$method'");
        break;
}