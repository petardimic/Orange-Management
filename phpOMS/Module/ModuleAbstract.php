<?php
namespace phpOMS\Module;

/**
 * Module abstraction class
 *
 * PHP Version 5.4
 *
 * @category   Module
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class ModuleAbstract implements \phpOMS\Module\ModuleInterface
{

// region Class Fields
    /**
     * Receiving modules from?
     *
     * @var string[]
     * @since 1.0.0
     */
    public $receiving = [];

    /**
     * Module name
     *
     * @var string
     * @since 1.0.0
     */
    protected static $module = null;

    /**
     * Localization files
     *
     * @var string
     * @since 1.0.0
     */
    protected static $localization = [
    ];

    /**
     * Application instance
     *
     * @var \phpOMS\ApplicationAbstract
     * @since 1.0.0
     */
    protected $app = null;

// endregion

    /**
     * Constructor
     *
     * @param \phpOMS\ApplicationAbstract $app Application instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->loadLanguage($this->app->user->getL11n()->getLanguage(), \phpOMS\Message\RequestDestination::BACKEND);
    }

    /**
     * Load module language
     *
     * @param string $language    ISO language code
     * @param string $destination Destination language file to load
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function loadLanguage($language, $destination)
    {
        /** @noinspection PhpUndefinedFieldInspection */
        if(isset(static::$localization[\phpOMS\Message\RequestDestination::BACKEND])) {
            /** @noinspection PhpUndefinedFieldInspection */
            $this->app->user->getL11n()->loadLanguage($language, static::$localization[$destination], static::$module);
        }
    }

    /**
     * Install external
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function installExternal()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function callPull()
    {
        foreach($this->receiving as $mid) {
            /** @noinspection PhpUndefinedMethodInspection */
            \phpOMS\Module\ModuleFactory::$loaded[$mid]->callPush();
        }
    }

    /**
     * {@inheritdoc}
     */
    abstract public function call($request, $response, $data = null);

    /**
     * Get modules this module is providing for
     *
     * @return array Providing
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getProviding()
    {
        /** @noinspection PhpUndefinedFieldInspection */
        return static::$providing;
    }

    /**
     * Get dependencies for this module
     *
     * @return array Dependencies
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDependencies()
    {
        /** @noinspection PhpUndefinedFieldInspection */
        return static::$dependencies;
    }
}