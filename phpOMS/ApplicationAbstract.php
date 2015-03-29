<?php
namespace phpOMS;
/**
 * Controller class
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
    /**
     * Database object
     *
     * @var \phpOMS\DataStorage\Database\Pool
     * @since 1.0.0
     */
    public $dbPool = null;
    /**
     * Cache instance
     *
     * @var \phpOMS\DataStorage\Cache\Cache
     * @since 1.0.0
     */
    public $cache = null;

    /**
     * Settings instance
     *
     * @var \phpOMS\Config\CoreSettings
     * @since 1.0.0
     */
    public $settings = null;

    /**
     * ModuleManager instance
     *
     * @var \phpOMS\Module\ModuleManager
     * @since 1.0.0
     */
    public $modules = null;

    /**
     * Auth instance
     *
     * @var \phpOMS\Auth\AuthInterface
     * @since 1.0.0
     */
    public $auth = null;

    /**
     * User instance
     *
     * @var \phpOMS\Models\User\User
     * @since 1.0.0
     */
    public $user = null;

    /**
     * Server localization
     *
     * @var \phpOMS\Localization\Localization
     * @since 1.0.0
     */
    public $localization = null;

    /**
     * Event manager
     *
     * @var \phpOMS\Event\EventManager
     * @since 1.0.0
     */
    public $event = null;
}
