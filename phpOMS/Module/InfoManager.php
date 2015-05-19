<?php
namespace phpOMS\Module;

/**
 * InfoManager class
 *
 * Handling the info files for modules
 *
 * PHP Version 5.4
 *
 * @category   Module
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class InfoManager
{

// region Class Fields
    /**
     * File pointer
     *
     * @var mixed
     * @since 1.0.0
     */
    private $fp = null;

    /**
     * Module path
     *
     * @var string
     * @since 1.0.0
     */
    private static $module_path = __DIR__ . '/../../Modules/';

// endregion

    /**
     * Object constructor
     *
     * @param string $module Module name
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function __construct($module)
    {
        if(file_exists(self::$module_path . $module . '/info.json')) {
            $this->fp = fopen(self::$module_path . $module . '/info.json', 'r');
        }
    }

    public function update()
    {
        // TODO: update file (convert to json)
    }

    /**
     * Object destructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function __destruct()
    {
        $this->fp->close();
    }
}