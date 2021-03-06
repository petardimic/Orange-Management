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
    protected static $module = '';

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
    }

    public function getLocalization($language, $destination) {
        $language = [];
        if(isset(static::$localization[$destination])) {
            foreach(static::$localization[$destination] as $file) {
                include $file . '.' . $language . '.lang.php';
                $language += $MODLANG;
            }
        }

        return $language;
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
            $this->app->moduleManager->running[$mid]->callPush();
        }
    }

    /**
     * {@inheritdoc}
     */
    abstract public function call($request, $response, $data = null);

    /**
     * {@inheritdoc}
     */
    public function getProviding()
    {
        /** @noinspection PhpUndefinedFieldInspection */
        return static::$providing;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        /** @noinspection PhpUndefinedFieldInspection */
        return static::$module;
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        /** @noinspection PhpUndefinedFieldInspection */
        return static::$dependencies;
    }
}