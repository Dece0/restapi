<?php

require_once '_includes/helpers.php';

function handlePostRequest(array $request, array $input) {
    if(empty($input['name'])) {
        printMessage("Supplied JSON has empty key 'name'");
        return;
    }

    $type = array_shift($request);
    if($type !== 'meniny') {
        printMessage("No type '$type' allowed");
        return;
    }

    if(!count($request)) {
        printMessage('No date specified');
        return;
    }

    $date = array_shift($request);

    if(!empty($request)) {
        printMessage('Too many arguments in URL');
        return;
    }

    if(!preg_match('/^\d{4}$/m', $date)) return printMessage('Wrong date format supplied');

    $result = addName($input['name'], $date);
    printMessage($result['message'], $result['success']);
}