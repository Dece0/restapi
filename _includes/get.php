<?php
require_once '_includes/helpers.php';
require_once '_includes/database.php';

function handleGetRequest(array $request) {
    $type = array_shift($request);
    switch($type) {
        case 'measurements':
            handleMeasurementsGetRequest($request);
            break;
        case 'sensors':
            handleSensorsGetRequest($request);
            break;
        case 'quantities':
            handleQuantitiesGetRequest($request);
            break;
        case 'settings':
            handleSettingsGetRequest($request);
            break;
        case 'station':
            handleStationGetRequest($request);
            break;
        case 'download':
            handleDownloadGetRequest($request);
            break;
        default:
            printMessage("Unknown request type '$type'");
            break;
    }
}

function handleMeasurementsGetRequest(array $request) {
    if(empty($request)) return printMessage("No measurements specified.");

    $type = array_shift($request);
    $allowedTypes = ['all', 'pressure', 'humidity', 'temperature', 'air', 'last'];
    if(!in_array($type, $allowedTypes)) return printMessage("Unknown request for id '{$type}'");

    if(!empty($request)) return printMessage('Too many arguments in URL');
    
    switch($type) {
        case 'all':
            $result = getAllMeasurements();
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;
            
        case 'pressure':
            $result = getMeasurementsByQuantityName($type);
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;

        case 'humidity':
            $result = getMeasurementsByQuantityName($type);
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;

        case 'temperature':
            $result = getMeasurementsByQuantityName($type);
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;

        case 'last':
            $result = getLastMeasurements($type);
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;

        default:
            printMessage('Wrong format of type supplied.');
            break;
    }
}

function handleQuantitiesGetRequest($request) {
    if(empty($request)) return printMessage("No quantities specified.");
    $type = array_shift($request);
    if(!empty($request)) return printMessage('Too many arguments in URL');

    switch($type) {
        case 'all':
            $result = getAllQuantities();
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;
            
        default:
            printMessage('Wrong format of type supplied.');
            break;
    }
}

function handleSettingsGetRequest($request) {
    if(empty($request)) return printMessage("No settings attributes specified.");
    $type = array_shift($request);
    if(!empty($request)) return printMessage('Too many arguments in URL');

    switch($type) {
        case 'all':
            $result = getAllSettings();
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;
            
        default:
            printMessage('Wrong format of type supplied.');
            break;
    }
}

function handleStationGetRequest($request) {
    if(empty($request)) return printMessage("No station attributes specified.");
    $type = array_shift($request);
    if(!empty($request)) return printMessage('Too many arguments in URL');

    switch($type) {
        case 'all':
            $result = getAllStationAttributes();
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;

        case 'coords':
            $result = getCoords();
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;

        case 'name':
            $result = getStationName();
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;
            
        default:
            printMessage('Wrong format of type supplied.');
            break;
    }
}

function handleDownloadGetRequest($request) {
    if(empty($request)) return printMessage("No download attributes specified.");
    $type = array_shift($request);
    if(!empty($request)) return printMessage('Too many arguments in URL');

    switch($type) {
        case 'all':
            $result = downloadAllData();
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;

        case 'selected':
            $result = getCoords();
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;

        case 'quantity':
            $result = getStationName();
            if($result['success']) 
                printMessage($result['message'], $result['success'], $result['data']);
            else 
                printMessage($result['message']);
            break;
            
        default:
            printMessage('Wrong format of type supplied.');
            break;
    }
}