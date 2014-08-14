<?php
ob_start();
$PACCESS = true;

//<editor-fold desc="Require/Include">
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Framework/Autoloader.class.php';
//</editor-fold>

/** TODO: make $app static in group and user?!?!?! */

$logHOBJ = \Framework\Log\Logging::getInstance(__DIR__ . '/Admin/Log');

$logHOBJ->startTimeLog('global');
$App = \Framework\Application::getInstance($DBDATA, $PAGE);
$logHOBJ->endTimeLog('global');

ob_end_flush();
