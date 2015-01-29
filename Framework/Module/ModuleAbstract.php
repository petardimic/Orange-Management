<?php
namespace Framework\Module;

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
abstract class ModuleAbstract implements \Framework\Module\ModuleInterface
{
    /**
     * Application instance
     *
     * @var \Framework\ApplicationAbstract
     * @since 1.0.0
     */
    protected $app = null;

    /**
     * Receiving modules from?
     *
     * @var string[]
     * @since 1.0.0
     */
    public $receiving = [];

    /**
     * Constructor
     *
     * @param \Framework\ApplicationAbstract $app Application instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function callPull()
    {
        foreach($this->receiving as $mid) {
            /** @noinspection PhpUndefinedMethodInspection */
            \Framework\Module\ModuleFactory::$loaded[$mid]->callPush();
        }
    }

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

    /**
     * Install external
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function installExternal() {
        return false;
    }
}