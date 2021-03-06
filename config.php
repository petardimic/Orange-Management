<?php
/**
 * Global config file
 *
 * @category   Framework
 * @package    phpOMS\Config
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */

define('ROOT_PATH', __DIR__);

$CONFIG = [
    "db"       => [
        "db"       => "mysql", /* db type */
        "host"     => "127.0.0.1", /* db host address */
        "login"    => "root", /* db login name */
        "password" => "s4b3r?", /* db login password */
        "database" => "orange_management", /* db name */
        "prefix"   => "oms_" /* db table prefix */
    ],
    'page'     => [
        'root' => '/',
        __DIR__ /* root of the web application */
    ],
    'socket'   => [
        'limit' => 300,
        'port'  => 4310
    ],
    'language' => [
        'en', 'de'
    ]
];
