<?php
ob_start();
$PACCESS = true;

//<editor-fold desc="Require/Include">
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Framework/Autoloader.class.php';
//</editor-fold>

$App = \Framework\Application::getInstance($DBDATA, $PAGE);
ob_end_flush();
