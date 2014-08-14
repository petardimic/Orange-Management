<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ob_start();
$PACCESS = true;

require __DIR__ . '/config.php';

//<editor-fold desc="Require/Include">
require_once __DIR__ . '/Framework/Utils/Core.php';
require_once __DIR__ . '/Framework/Autoloader.class.php';
//</editor-fold>

/** TODO: make $app static in group and user?!?!?! */

$logHOBJ = \Framework\Log\Logging::getInstance(__DIR__ . '/Admin/Log');

$logHOBJ->startTimeLog('global');
$ctrlHOBJ = \Framework\Application::getInstance($DBDATA, $PAGE);
$logHOBJ->endTimeLog('global');

ob_end_flush();
