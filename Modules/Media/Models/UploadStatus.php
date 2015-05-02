<?php
namespace Modules\Media\Models;

/**
 * Upload status
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\DataStorage\Database
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class UploadStatus extends \phpOMS\Datatypes\Enum
{

    const OK = 0;
    const WRONG_PARAMETERS = -1;
    const NOTHING_UPLOADED = -2;
    const UPLOAD_SIZE = -3;
    const UNKNOWN_ERROR = -4;
    const CONFIG_SIZE = -5;
    const WRONG_FORMAT = -6;
    const NOT_MOVABLE = -7;
}
