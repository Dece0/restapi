<?php
require_once './dbs.class.php';

function getAll(): array {
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
