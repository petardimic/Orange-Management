<?php
namespace Framework\Localization\Number;

/**
 * Localization class
 *
 * PHP Version 5.4
 *
 * @category   Localization
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Number
{
    /**
     * Local Id
     *
     * @var string
     * @since 1.0.0
     */
    private $local = 'US';

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __constructor()
    {
    }

    /**
     * Format number
     *
     * @param float|int $number Number to format
     * @param int       $digits Amount of digits
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function format($number, $digits = 0)
    {
        if($this->local === 'US') {
        }
    }
}