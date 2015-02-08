<?php

require_once __DIR__ . '/../../../Framework/Autoloader.php';
require_once __DIR__ . '/../../../config.php';

class DatabasePoolTest extends PHPUnit_Framework_TestCase
{
    public function testBasicConnection()
    {
        $pool = new \Framework\DataStorage\Database\Pool();
        $pool->create('core', $GLOBALS['CONFIG']['db']);
        $this->assertEquals($pool->get('core')->status, \Framework\DataStorage\Database\DatabaseStatus::OK);

        $pool->get('core')->close();
        $this->assertEquals($pool->get('core')->status, \Framework\DataStorage\Database\DatabaseStatus::CLOSED);

        $pool->get('core')->connect($GLOBALS['CONFIG']['db']);
        $this->assertEquals($pool->get('core')->status, \Framework\DataStorage\Database\DatabaseStatus::OK);
    }
}