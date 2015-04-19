<?php
namespace Modules\Billing\Admin\Install;

/**
 * Media addition class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class ItemReference
{
    /**
     * Install module
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database instance
     * @param array                             $info   Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'billing_invoice_element`
                        ADD KEY `billing_invoice_element_article` (`billing_invoice_element_article`),
                        ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'billing_invoice_element_ibfk_2` FOREIGN KEY (`billing_invoice_element_article`) REFERENCES `' . $dbPool->get('core')->prefix . 'itemreference` (`itemreference_id`);'
                )->execute();
                break;
        }
    }
}