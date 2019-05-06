<?php
require_once '_includes/helpers.php';
require_once '_includes/database.php';

function handlePostRequest(array $request, array $input) {
    if(
        empty($input['stationName']) &&
        empty($input['settings'])
    ) {
        printMessage("Supplied JSON has empty key 'stationName'");
        return;
    }

    $type = array_shift($request);
    if($type !== 'settings') {
        printMessage("No type '$type' allowed");
        return;
    }

    $result = updateSettings($input['stationName'], $input['settings']);
    printMessage($result['message'], $result['success']);
}