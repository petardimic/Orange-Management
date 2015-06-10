<?php
namespace phpOMS\Module;

/**
 * ModuleFactory class
 *
 * Responsible for initializing modules as singletons
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
class ModuleFactory
{

// region Class Fields
    /**
     * Module instances
     *
     * Reference to module.class
     *
     * @var \phpOMS\Module\ModuleAbstract[]
     * @since 1.0.0
     */
    public static $loaded = [];

    /**
     * Application instance
     *
     * @var \phpOMS\ApplicationAbstract
     * @since 1.0.0
     */
    public static $app = null;

    /**
     * Unassigned providing
     *
     * @var string[][]
     * @since 1.0.0
     */
    public static $providing = [];

// endregion

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function __construct()
    {
    }

    /**
     * Gets and initializes modules
     *
     * @param string $module Module ID
     *
     * @return \phpOMS\Module\ModuleAbstract
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getInstance($module)
    {
        if(!isset(self::$loaded[$module])) {
            $class = '\\Modules\\' . $module . '\\Controller';

            /**
             * @var \phpOMS\Module\ModuleAbstract $obj
             */
            $obj                   = new $class(self::$app);
            self::$loaded[$module] = $obj;

            /** Install providing for */
            foreach($obj->getProviding() as $providing) {
                if(isset(self::$loaded[$providing])) {
                    self::$loaded[$providing]->receiving[] = $obj->getName();
                } else {
                    self::$providing[$providing][] = $obj->getName();
                }
            }

            /** Check if I get provided with */
            $name = $obj->getName();
            if(isset(self::$providing[$name])) {
                foreach(self::$providing[$name] as $providing) {
                    self::$loaded[$name]->receiving[] = $providing;
                }
            }
        }

        return self::$loaded[$module];
    }
}