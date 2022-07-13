<?php

function response(int $status, string $msg)
{
    return (object)[
        "status" => $status,
        "message" => $msg
    ];
}

function getStoragePath(string $file)
{
    return dirname(__DIR__) .
        DIRECTORY_SEPARATOR .
        "storage" .
        DIRECTORY_SEPARATOR . $file;
}

function generateId(array $employees)
{
    $id = array_map(
        fn ($values) => intval($values["id"]),
        $employees
    );

    $lastInsertedId = end($id);
    
    return $lastInsertedId + 1;
}
