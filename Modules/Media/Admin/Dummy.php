<?php
namespace Modules\Media\Admin;

/**
 * Dummy class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Media
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Dummy implements \Framework\Install\DummyInterface
{
    /**
     * {@inheritdoc}
     */
    public static function generate($db, $amount)
    {
        $dataString = '';

        for($i = 0; $i < $amount; $i++) {
            $dataString .= " ( '" . \Framework\Utils\RnG\String::generateString(5, 15) . "', '', '" . \Framework\Utils\RnG\File::generateExtension() . "', " . rand(13, 1000000) . ", 1, '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "' ),";
        }

        $dataString = rtrim($dataString, ',');

        $db->con->prepare('INSERT INTO `' . $db->prefix . 'media` (`name`, `file`, `type`, `size`, `creator`, `created`) VALUES ' . $dataString)->execute();
    }
}