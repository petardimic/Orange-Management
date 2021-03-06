<?php
namespace phpOMS;

/**
 * Application class
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
class ApplicationAbstract
{

// region Class Fields
    /**
     * Database object
     *
     * @var \phpOMS\DataStorage\Database\Pool
     * @since 1.0.0
     */
    public $dbPool = null;

    /**
     * Application settings object
     *
     * @var \Model\CoreSettings
     * @since 1.0.0
     */
    public $appSettings = null;

    /**
     * Account manager instance
     *
     * @var \phpOMS\Account\AccountManager
     * @since 1.0.0
     */
    public $accountManager = null;

    /**
     * Cache instance
     *
     * @var \phpOMS\DataStorage\Cache\CacheManager
     * @since 1.0.0
     */
    public $cacheManager = null;

    /**
     * ModuleManager instance
     *
     * @var \phpOMS\Module\ModuleManager
     * @since 1.0.0
     */
    public $moduleManager = null;

    /**
     * Router instance
     *
     * @var \phpOMS\Router\Router
     * @since 1.0.0
     */
    public $router = null;

    /**
     * Dispatcher instance
     *
     * @var \phpOMS\Dispatcher\Dispatcher
     * @since 1.0.0
     */
    public $dispatcher = null;

    /**
     * Session instance
     *
     * @var \phpOMS\DataStorage\Session\SessionInterface
     * @since 1.0.0
     */
    public $sessionManager = null;

    /**
     * Server localization
     *
     * @var \phpOMS\Localization\Localization
     * @since 1.0.0
     */
    public $l11nServer = null;

    /**
     * L11n manager
     *
     * @var \phpOMS\Localization\L11nManager
     * @since 1.0.0
     */
    public $l11nManager = null;

    /**
     * Event manager
     *
     * @var \phpOMS\Event\EventManager
     * @since 1.0.0
     */
    public $eventManager = null;

// endregion

}
