<?php
namespace OMS\Modules {
    require_once __DIR__ . '/../Module.class.php';
    require_once __DIR__ . '/../../core/Account.class.php';

    /**
     * Navigation class
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
    class Markdown extends Module {
        /**
         * Dependencies
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $dependencies = null;

        /**
         * Receiving
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $receiving = null;

        /**
         * Providing
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $providing = [
            1004100000 => true
        ];

        /**
         * Installed Modules
         *
         * @var array
         * @since 1.0.0
         */
        private $installed = null;

        /**
         * Constructor
         *
         * @param \Framework\DataStorage\Database\Database          $db    Database instance
         * @param \Framework\Model\Model                            $model Model instance
         * @param \Framework\DataStorage\Database\Objects\User\User $user  User instance
         * @param \Framework\DataStorage\Cache\Cache                $cache Cache instance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct(&$db, &$model, &$user, &$cache) {
            parent::initialize($db, $model, $user, $cache);
        }

        /**
         * Install module
         *
         * @param \Framework\DataStorage\Database\Database $db   Database instance
         * @param array                                    $info Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install(&$db, $info) {
            parent::install_providing($db, __DIR__ . '/install/nav.install.json', 1000500000);
        }

        /**
         * Initializes object
         *
         * @param string $theme_path
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function init($theme_path) {
            $this->theme_path = $theme_path;
        }

        public function markdown($text) {
            /* Standardize line breaks */
            $text = str_replace('\r\n', '\n', $text);
            $text = str_replace('\r', '\n', $text);

            /* Standardize tabs */
            $text = str_replace('\t', '    ', $text);

            /* Remove surroundings */
            $text = rtrim($text);
            $text = trim($text, '\n');

            $lines = explode('\n', $text);

            $markup = $this->markdown_lines($lines);

            /* Remove surroundings after */
            $markup = rtrim($markup);
            $markup = trim($markup, '\n');

            return $markup;
        }

        public function markdown_lines($lines) {
            $markup = '';

            $block_current = null;

            foreach ($lines as $line) {
                /* Empty line ends opened block */
                if (rtrim($line) === '') {
                    if (isset($block_current)) {
                        $block_current['end'] = true;
                    }

                    continue;
                }

                /* Count indents */
                $indent_count = 0;
                while (isset($line[$indent_count]) && $line[$indent_count] === ' ') {
                    $indent_count++;
                }
            }

            return $markup;
        }
    }
}