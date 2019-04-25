<?php

function printJSON(array $array):void {
    echo json_encode($array, JSON_UNESCAPED_UNICODE);
}

function printMessage(string $message, bool $success = false, $data = null): void {
    $response = [
        'success' => $success,
        'message' => $message
    ];
    if(!empty($data)) $response['data'] = $data;
    printJSON($response);
}
