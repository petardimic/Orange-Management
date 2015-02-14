<?php

require_once __DIR__ . '/../../../phpOMS/Autoloader.php';
require_once __DIR__ . '/../../../config.php';

class DatabasePoolTest extends PHPUnit_Framework_TestCase
{
    public function testBasicConnection()
    {
        $pool = new \phpOMS\DataStorage\Database\Pool();
        $pool->create('core', $GLOBALS['CONFIG']['db']);
        $this->assertEquals($pool->get('core')->status, \phpOMS\DataStorage\Database\DatabaseStatus::OK);

        $pool->get('core')->close();
        $this->assertEquals($pool->get('core')->status, \phpOMS\DataStorage\Database\DatabaseStatus::CLOSED);

        $pool->get('core')->connect($GLOBALS['CONFIG']['db']);
        $this->assertEquals($pool->get('core')->status, \phpOMS\DataStorage\Database\DatabaseStatus::OK);
    }
}