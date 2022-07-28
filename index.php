<?php

// Online Employee Management App

require_once "./autoload.php";
require_once "./utils/helper.php";

$employee = new Employee();

echo "<pre>";
var_dump($employee->getEmployee());

// echo "Pesquisar pelo nome";
// echo "<pre>";
// var_dump($employee->getByName("Jidlaf Tiago"));

$handlerResult = $employee->save(
    "Kiala Daniel",
    "kialadaniel@gmail.com",
    "Programador"
);

if ($handlerResult->status <> 200) {
    echo <<<TEXT
    [ERROR]: $handlerResult->message 
    TEXT;

    die;
}

echo $handlerResult->message;
