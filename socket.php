<?php
//<editor-fold desc="Require/Include">
require_once __DIR__ . '/Framework/Autoloader.class.php';
require_once __DIR__ . '/config.php';
//</editor-fold>

$App = new \Framework\SocketApplication($CONFIG, $argv[1]);
