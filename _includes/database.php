<?php
require_once './dbs.class.php';

function getAllMeasurements(): array {
    $db = DB::getInstance();
    return [
        'success' => true,
        'message' => 'Data succesfully loaded',
        'data' => $db->getAllMeasurements()
    ];
}

function getMeasurementsByQuantityName(string $quantityName): array {
    $db = DB::getInstance();
    return [
        'success' => true,
        'message' => 'Data succesfully loaded',
        'data' => $db->getMeasurementsByQuantityName(ucfirst($quantityName))
    ];
}

function getLastMeasurements(): array {
    $db = DB::getInstance();
    return [
        'success' => true,
        'message' => 'Data succesfully loaded',
        'data' => $db->getLastMeasurements()
    ];
}

function getAllQuantities(): array {
    $db = DB::getInstance();
    return [
        'success' => true,
        'message' => 'Data succesfully loaded',
        'data' => $db->getAllQuantities()
    ];
}

function getAllStationAttributes(): array {
    $db = DB::getInstance();
    return [
        'success' => true,
        'message' => 'Data succesfully loaded',
        'data' => $db->getAllStationAttributes()
    ];
}

function getCoords(): array {
    $db = DB::getInstance();
    return [
        'success' => true,
        'message' => 'Data succesfully loaded',
        'data' => $db->getCoords()
    ];
}

function getStationName():array {
    $db = DB::getInstance();
    return [
        'success' => true,
        'message' => 'Data succesfully loaded',
        'data' => $db->getStationName()
    ];
}

function getAllSettings():array {
    $db = DB::getInstance();
    return [
        'success' => true,
        'message' => 'Data succesfully loaded',
        'data' => $db->getAllSettings()
    ];
}

function updateSettings($stationName, $settings) {
    $db = DB::getInstance();

    $nameResponse = $db->saveStationName($stationName); 
    $db->saveSettings($settings); 
    if(!$nameResponse) return [
        'success' => false,
        'message' => "Problem bro.",
    ];
    else return [
        'success' => true,
        'message' => 'Data succesfully saved',
        'data' => "$nameResponse"
    ];
}

function downloadAllData() {
    $file_url = './data.txt';
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
    readfile($file_url);
}