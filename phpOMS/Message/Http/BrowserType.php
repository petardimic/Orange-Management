<?php
namespace phpOMS\Message\Http;

/**
 * Browser type enum
 *
 * Browser types can be used for statistics or in order to deliver browser specific content.
 *
 * PHP Version 5.4
 *
 * @category   Request
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class BrowserType extends \phpOMS\Datatypes\Enum
{

    const IE        = 'msie'; /* Internet Explorer */
    const FIREFOX   = 'firefox'; /* Firefox */
    const SAFARI    = 'safari'; /* Safari */
    const CHROME    = 'chrome'; /* Chrome */
    const OPERA     = 'opera'; /* Opera */
    const NETSCAPE  = 'netscape'; /* Netscape */
    const MAXTHON   = 'maxthon'; /* Maxthon */
    const KONQUEROR = 'konqueror'; /* Konqueror */
    const HANDHELD  = 'mobile'; /* Handheld Browser */

}