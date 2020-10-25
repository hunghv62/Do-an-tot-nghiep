<?php

function responseError($code, $message, $errors = [], $messageInternal = '')
{
    return response()->json([
        "message" => $message,
        'messageInternal' => $messageInternal,
        "errors" => $errors,
    ], $code);
}

function responseOK($data = null)
{
    if (is_null($data)) {
        return response(null, 200)->header('Content-Type', 'application/json');
    }
    return response()->json($data, 200);
}
