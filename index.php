<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();

//<editor-fold desc="Require/Include">
require_once __DIR__ . '/phpOMS/Autoloader.php';
require_once __DIR__ . '/config.php';
//</editor-fold>

$App = new \Web\WebApplication($CONFIG);

ob_end_flush();
