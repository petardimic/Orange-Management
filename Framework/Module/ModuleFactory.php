<?php
namespace Framework\Module;
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
        /**
         * Module instances
         *
         * Reference to module.class
         *
         * @var \Framework\Module\ModuleAbstract[]
         * @since 1.0.0
         */
        public static $loaded = [];

        /**
         * Application instance
         *
         * @var \Framework\WebApplication
         * @since 1.0.0
         */
        public static $app = null;

        /**
         * Gets and initializes modules
         *
         * @param string $module Module ID
         *
         * @return \Framework\Module\ModuleAbstract
         *
         * @var array
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($module)
        {
            if(!isset(self::$loaded[$module])) {
                $class = '\\Modules\\' . $module . '\\Controller';

                /**
                 * @var \Framework\Module\ModuleAbstract $obj
                 */
                $obj                   = new $class(self::$app);
                self::$loaded[$module] = $obj;

                /* TODO: find dependencies or load them inside module? */

                /* Todo: find open dependencies or load them inside module? */

                /* TODO: The following foreach loop finds all providing modules whenever a module gets loaded,
                even if modules are already added to $receiving -> same entries will happen -> array_unique needs to get called.
                Can we make that a little bit smarter? Maybe create a static receiving, providing array here and check if there is
                anything for this module or if this module is providing anything for others?
                If already handled remove from static array to not re-handle it and only loop static arrays*/

                /* Find all providing modules */
                foreach(self::$loaded as $key => $val) {
                    $providing = $val->getProviding();

                    foreach($providing as $key2 => $val2) {
                        if(isset(self::$loaded[$val2])) {
                            /** @var \Framework\Module\ModuleAbstract $receiving */
                            self::$loaded[$val2]->receiving[] = $key;
                            self::$loaded[$val2]->receiving   = array_unique(self::$loaded[$val2]->receiving);
                        }
                    }
                }
            }

            return self::$loaded[$module];
        }
    }