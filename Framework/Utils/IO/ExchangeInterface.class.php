<?php
namespace Framework\Utils\IO {
    /**
     * Exchange interface
     *
     * PHP Version 5.4
     *
     * @category   Framework
     * @package    Utils
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    interface ExchangeInterface extends \Framework\Utils\IO\Cvs\CvsInterface, \Framework\Utils\IO\Json\JsonInterface, \Framework\Utils\IO\Excel\ExcelInterface, \Framework\Utils\IO\Pdf\PdfInterface {
    }
}