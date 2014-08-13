<?php
namespace Framework\Module {
    /**
     * ModuleFactory class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class ModuleFactory {
        /**
         * Available modules
         *
         * Reference to module.class
         *
         * @var array
         * @since 1.0.0
         */
        public static $available = [];

        /**
         * Module instances
         *
         * Reference to module.class
         *
         * @var \Framework\Module\ModuleAbstract[]
         * @since 1.0.0
         */
        public static $initialized = [];

        /**
         * Gets and initializes modules
         *
         * @param int $mid Module ID
         *
         * @return \Framework\Module\ModuleAbstract
         *
         * @var array
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($mid) {
            if (!isset(self::$initialized[$mid])) {
                $class = '\\Modules\\' . self::$available[$mid]['class'] . '\\' . self::$available[$mid]['class'];

                /**
                 * @var \Framework\Module\ModuleAbstract $obj
                 */
                $obj                     = new $class(self::$available[$mid]['path']);
                self::$initialized[$mid] = $obj;

                /* TODO: find dependencies or load them inside module? */

                /* Todo: find open dependencies or load them inside module? */

                /* TODO: The following foreach loop finds all providing modules whenever a module gets initialized,
                even if modules are already added to $receiving -> same entries will happen -> array_unique needs to get called.
                Can we make that a little bit smarter? Maybe create a static receiving, providing array here and check if there is
                anything for this module or if this module is providing anything for others?
                If already handled remove from static array to not re-handle it and only loop static arrays*/

                /* Find all providing modules */
                foreach (self::$initialized as $key => $val) {
                    $t_class2 = get_class(self::$initialized[$key]);

                    if (isset($t_class2::$providing)) {
                        foreach ($t_class2::$providing as $key2 => $val2) {
                            if (isset(self::$initialized[$key2])) {
                                $t_class = get_class(self::$initialized[$key2]);
                                /** @var \Framework\Module\ModuleAbstract $receiving */
                                $t_class::$receiving[] = $key;
                                $t_class::$receiving   = array_unique($t_class::$receiving);
                            }
                        }
                    }
                }
            }

            return self::$initialized[$mid];
        }
    }
}