<?php

// Online Employee Management App

require_once "./autoload.php";
require_once "./utils/helper.php";

$employee = new Employee();

echo "<pre>";
var_dump($employee->getEmployee());

# echo "Pesquisar pelo nome";
# echo "<pre>";
# var_dump($employee->getByName("Evaristo Pascoal"));

$handlerResult = $employee->save(
    "Jidlaf Tiago",
    "jidlaftiago2@gmail.com",
    "Analista de sistemas"
);

if ($handlerResult->status <> 200) {
    echo <<<TEXT
    [ERROR]: $handlerResult->message 
    TEXT;
}

echo $handlerResult->message;