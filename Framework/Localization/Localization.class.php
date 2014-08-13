<?php
namespace Framework\Localization {
    /**
     * Localization class
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

    include_once __DIR__ . '/Localization.array.php';

    class Localization {
        /**
         * Database object
         *
         * @var \Framework\DataStorage\Database\Database
         * @since 1.0.0
         */
        private $db = null;

        /**
         * Cache instance
         *
         * @var \Framework\DataStorage\Cache\Cache
         * @since 1.0.0
         */
        public $cache = null;

        /**
         * Language ID
         *
         * @var string
         * @since 1.0.0
         */
        public $language = null;

        /**
         * Country ID
         *
         * @var string
         * @since 1.0.0
         */
        public $country = null;

        /**
         * Timezone
         *
         * @var string
         * @since 1.0.0
         */
        public $timezone = null;

        /**
         * Currency
         *
         * @var string
         * @since 1.0.0
         */
        public $currency = null;

        /**
         * Number format
         *
         * @var string
         * @since 1.0.0
         */
        public $numberformat = null;

        /**
         * Time format
         *
         * @var string
         * @since 1.0.0
         */
        public $timeformat = null;

        /**
         * Localization ID
         *
         * > 0 = User
         * -1 = Server
         *
         * @var int
         * @since 1.0.0
         */
        public $localization_id = -1;

        /**
         * Localized strings
         *
         * @var string[]
         * @since 1.0.0
         */
        public static $lang = [];

        /**
         * Instance
         *
         * @var \Framework\DataStorage\Cache\Cache
         * @since 1.0.0
         */
        protected static $instance = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($id) {
            $this->localization_id = $id;
            $this->db              = \Framework\DataStorage\Database\Database::getInstance();
            $this->cache           = \Framework\DataStorage\Cache\Cache::getInstance();
            $this->language        = \Framework\Request\Request::getInstance()->uri['l0'];
        }

        /**
         * Returns instance
         *
         * @param int $id
         *
         * @return \Framework\Localization\Localization
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($id) {
            if (self::$instance === null) {
                self::$instance = new self($id);
            }

            return self::$instance;
        }

        /**
         * Protect instance from getting copied from outside
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        protected function __clone() {
        }

        /**
         * Returns instance
         *
         * @param string $language Language ID
         * @param array  $files    Language array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function language_load($language, $files) {
            $request            = \Framework\Request\Request::getInstance();
            $cache              = \Framework\DataStorage\Cache\Cache::getInstance();
            $modules            = \Framework\Module\Modules::getInstance();
            self::$lang = $cache->pull('lang:' . $language . ':' . $request->uri_hash[3]);

            if (!self::$lang && !empty($files)) {
                self::$lang = [];

                /** @noinspection PhpIncludeInspection */
                /** @var string[] $CORELANG */
                require __DIR__ . '/lang/' . $language . '.lang.php';
                /** @noinspection PhpUndefinedVariableInspection */
                self::$lang += $CORELANG;

                foreach ($files as $file) {
                    /** @noinspection PhpIncludeInspection */
                    /** @var string[] $MODLANG */
                    require __DIR__ . '/../../Modules/' . $modules->active[$file['from']]['class'] . '/themes/' . $modules->active[$file['from']]['theme'] . '/lang/' . $file['file'] . '.' . $language . '.lang.php';
                    /** @noinspection PhpUndefinedVariableInspection */
                    $key = (int) ($file['for']/100000 - 10000);
                    if(!isset(self::$lang[$key])) {
                        self::$lang += $MODLANG;
                    } else {
                        /** @noinspection PhpWrongStringConcatenationInspection */
                        self::$lang[$key] += $MODLANG[$key];
                    }

                }

                $cache->push('lang:' . $language . ':' . $request->uri_hash[3], self::$lang);
            }
        }
    }
}