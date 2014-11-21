<?php
namespace Framework {
    /**
     * Controller class
     *
     * PHP Version 5.4
     *
     * @category   App
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class ApplicationAbstract {
        /**
         * Database object
         *
         * @var \Framework\DataStorage\Database\Database
         * @since 1.0.0
         */
        public $db = null;

        /**
         * Cache instance
         *
         * @var \Framework\DataStorage\Cache\Cache
         * @since 1.0.0
         */
        public $cache = null;

        /**
         * Request instance
         *
         * @var \Framework\Request\RequestAbstract
         * @since 1.0.0
         */
        public $request = null;

        /**
         * Settings instance
         *
         * @var \Framework\Config\Settings
         * @since 1.0.0
         */
        public $settings = null;

        /**
         * ModuleManager instance
         *
         * @var \Framework\Module\ModuleManager
         * @since 1.0.0
         */
        public $modules = null;

        /**
         * Auth instance
         *
         * @var \Framework\Auth\Auth
         * @since 1.0.0
         */
        public $auth = null;

        /**
         * User instance
         *
         * @var \Framework\DataStorage\Database\Objects\User\User
         * @since 1.0.0
         */
        public $user = null;

        /**
         * Server localization
         *
         * @var \Framework\Localization\Localization
         * @since 1.0.0
         */
        public $localization = null;

        /**
         * Server localization
         *
         * @var \Framework\DataStorage\Session\Session
         * @since 1.0.0
         */
        public $session = null;
    }
}