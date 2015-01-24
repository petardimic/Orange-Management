<?php
namespace Modules\Content {
    /**
     * Navigation class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Controller extends \Framework\Module\ModuleAbstract implements \Framework\Module\WebInterface
    {
        /**
         * Providing
         *
         * @var string
         * @since 1.0.0
         */
        protected static $providing = [
            1004400000
        ];

        /**
         * Dependencies
         *
         * @var string
         * @since 1.0.0
         */
        protected static $dependencies = [
        ];

        /**
         * Shows module content
         *
         * @param   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function callWeb($data = null)
        {
            if(isset($this->receiving)) {
                foreach($this->receiving as $mid) {
                    /** @noinspection PhpUndefinedMethodInspection */
                    \Framework\Module\ModuleFactory::$loaded[$mid]->callWeb();
                }
            }
        }
    }
}