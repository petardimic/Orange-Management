<?php
namespace Framework\Utils\RnG;
    /**
     * DateTime generator
     *
     * PHP Version 5.4
     *
     * @category   Framework
     * @package    Utils\RnG
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class DateTime
    {
        /**
         * Get a random string
         *
         * @param string $start Start date
         * @param string $end   End date
         *
         * @return \DateTime
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function generateDateTime($start, $end)
        {
            $startDate = strtotime($start);
            $endDate   = strtotime($end);

            return new \DateTime(date('Y-m-d H:i:s', rand($startDate, $endDate)));
        }
    }