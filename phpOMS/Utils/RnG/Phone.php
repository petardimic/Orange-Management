<?php
namespace phpOMS\Utils\RnG;

/**
 * Phone generator
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
class Phone
{
    /**
     * Get a random phone number
     *
     * @param bool  $isInt     This number uses a country code
     * @param array $layout    Number layout
     * @param array $countries Country codes
     *
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function generatePhone($isInt = true, $layout = ['struct' => '+$1 ($2) $3-$4',
                                                                   'size'   => [null,
                                                                                [3, 4],
                                                                                [3, 5],
                                                                                [3, 8]]], $countries = null)
    {
        $numberString = $layout['struct'];

        if($isInt) {
            if($countries === null) {
                $countries = ['de' => 49, 'us' => 1];
            }

            $numberString = str_replace('$1', $countries[array_keys($countries)[rand(0, count($countries))]], $numberString);
        }

        $numberParts = substr_count($layout['struct'], '$');

        for($i = ($isInt ? 2 : 1); $i < $numberParts; $i++) {
            $numberString = str_replace('$' . $i, \phpOMS\Utils\RnG\String::generateString($layout['size'][$i - 1][0], $layout['size'][$i - 1][1], '0123456789'), $numberString);
        }

        return $numberString;
    }
}