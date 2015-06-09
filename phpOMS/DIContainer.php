<?php
namespace phpOMS;

/**
 * DIContainer class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class DIContainer
{
    private $dbPool = null;
    private $moduleManager = null;
    private $accountManager = null;
    private $cacheManager = null;
    private $sessionManager = null;
    private $assetManager = null;
    private $eventManager = null;
    private $settingsManager = null;

    public function __construct() {

    }
}