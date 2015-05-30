<?php

$date                = new \phpOMS\Datatypes\SmartDateTime();
$export_deliver_days = 10;
$m_value             = [];
$items               = [];
$vouchers            = [];

$file = fopen(__DIR__ . '/NOGIT.csv', 'r');
static $length;
fgetcsv($file, 0, ';');
while(($line = fgetcsv($file, 0, ';')) !== false) {
    $items[$line[0]] = $line;
}
fclose($file);

$file = fopen(__DIR__ . '/NOGIT.csv', 'r');
static $length;
fgetcsv($file, 0, ';');
while(($line = fgetcsv($file, 0, ';')) !== false) {
    $items[$line[0]] = $line;
}
fclose($file);