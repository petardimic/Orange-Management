<?php
namespace phpOMS\Contract;

/**
 * This is contract expects a class to be serializable via json
 *
 * This is used in order to distinguish between serialize and json_encode
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Contract
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface JsonableInterface extends \phpOMS\Contract\ArrayableInterface
{
    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function toJson($options = 0);
}
