<?php
namespace Framework\Version {
    /**
     * Version class
     *
     * Responsible for handling versions
     *
     * PHP Version 5.4
     *
     * @category   Version
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Version {
        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function __construct() {
        }

        /**
         * Loading version file
         *
         * @param string $path Path to version file
         *
         * @return string[]
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getVersion($path) {
            return json_decode(file_get_contents($path), true);
        }

        /**
         * Save version file
         *
         * @param string $type    Lib or tool name
         * @param string $version Version
         * @param string $path    Path to version file
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function setVersion($type, $version, $path) {
            $versions        = self::getVersion($path);
            $versions[$type] = $version;
            file_put_contents($path, json_encode($versions));
        }

        /**
         * Comparing two versions
         *
         * @param string $ver1 Version
         * @param string $ver2 Version
         *
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function compare($ver1, $ver2) {
            $split1 = explode('.', $ver1);
            $split2 = explode('.', $ver2);

            if (count($split1) > count($split2)) {
                return 1;
            } elseif (count($split1) < count($split2)) {
                return -1;
            }

            foreach ($split1 as $key => $val) {
                if ($val > $split2[$key]) {
                    return 1;
                } elseif ($val < $split2[$key]) {
                    return -1;
                }
            }

            return 0;
        }
    }
}