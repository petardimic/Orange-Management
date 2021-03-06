<?php
namespace phpOMS\Message\Http;

/**
 * OS type enum
 *
 * OS Types which could be useful in order to create statistics or deliver OS specific content.
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
abstract class OSType extends \phpOMS\Datatypes\Enum
{

    const WINDOWS_81     = 'windows nt 6.3'; /* Windows 8.1 */
    const WINDOWS_8      = 'windows nt 6.2'; /* Windows 8 */
    const WINDOWS_7      = 'windows nt 6.1'; /* Windows 7 */
    const WINDOWS_VISTA  = 'windows nt 6.0'; /* Windows Vista */
    const WINDOWS_SERVER = 'windows nt 5.2'; /* Windows Server 2003/XP x64 */
    const WINDOWS_XP     = 'windows nt 5.1'; /* Windows XP */
    const WINDOWS_XP_2   = 'windows xp'; /* Windows XP */
    const WINDOWS_2000   = 'windows nt 5.0'; /* Windows 2000 */
    const WINDOWS_ME     = 'windows me'; /* Windows ME */
    const WINDOWS_98     = 'win98'; /* Windows 98 */
    const WINDOWS_95     = 'win95'; /* Windows 95 */
    const WINDOWS_311    = 'win16'; /* Windows 3.11 */
    const MAC_OS_X       = 'macintosh'; /* Mac OS X */
    const MAC_OS_X_2     = 'mac os x'; /* Mac OS X */
    const MAC_OS_9       = 'mac_powerpc'; /* Mac OS 9 */
    const LINUX          = 'linux'; /* Linux */
    const UBUNTU         = 'ubuntu'; /* Ubuntu */
    const IPHONE         = 'iphone'; /* IPhone */
    const IPOD           = 'ipod'; /* IPod */
    const IPAD           = 'ipad'; /* IPad */
    const ANDROID        = 'android'; /* Android */
    const BLACKBERRY     = 'blackberry'; /* Blackberry */
    const MOBILE         = 'webos'; /* Mobile */

}