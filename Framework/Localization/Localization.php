<?php
namespace Framework\Localization;

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
class Localization
{
    /**
     * Country ID
     *
     * @var string
     * @since 1.0.0
     */
    public $country = null;

    /**
     * Timezone
     *
     * @var string
     * @since 1.0.0
     */
    public $timezone = null;

    /**
     * Currency
     *
     * @var string
     * @since 1.0.0
     */
    public $currency = null;

    /**
     * Number format
     *
     * @var string
     * @since 1.0.0
     */
    public $numberformat = null;

    /**
     * Time format
     *
     * @var string
     * @since 1.0.0
     */
    public $datetime = null;

    /**
     * Locals
     *
     * @var array[]
     * @since 1.0.0
     */
    private static $locals = null;

    /**
     * Localization ID
     *
     * > 0 = User
     * -1 = Server
     *
     * @var int
     * @since 1.0.0
     */
    public $localization_id = -1;

    /**
     * Localized strings
     *
     * @var string[]
     * @since 1.0.0
     */
    public $lang = [];

    /**
     * Constructor
     *
     * @param string $id Localization ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($id)
    {
        $this->localization_id = $id;

        // TODO: implement!!!
        setlocale(LC_TIME, '');
        setlocale(LC_NUMERIC, '');
        setlocale(LC_MONETARY, '');
    }

    /**
     * Load local arrays
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getLocals()
    {
        if(!isset(self::$locals)) {
            include_once __DIR__ . '/Localization.array.php';

            /** @var array[] $LOCALS */
            self::$locals = $LOCALS;
        }

        return self::$locals;
    }

    /**
     * Returns instance
     *
     * @param string $language Language ID
     * @param array  $files    Language array
     * @param array  $modules  Available modules
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function loadLanguage($language, $files, $modules)
    {
        if(!$this->lang && !empty($files)) {
            $this->lang = [];

            if(!file_exists(__DIR__ . '/lang/' . $language . '.lang.php')) {
                $language = 'en'; // TODO: maybe load server default
            }

            /** @noinspection PhpIncludeInspection */
            /** @var string[] $CORELANG */
            require __DIR__ . '/lang/' . $language . '.lang.php';
            /** @noinspection PhpUndefinedVariableInspection */
            $this->lang += $CORELANG;

            foreach($files as $file) {
                /** @noinspection PhpIncludeInspection */
                /** @var string[] $MODLANG */
                /* TODO: change, store name inside instead of id */
                require __DIR__ . '/../../Modules/' . $modules[$file['from']][0]['class'] . '/Theme/lang/' . $file['file'] . '.' . $language . '.lang.php';
                /** @noinspection PhpUndefinedVariableInspection */
                $key = (int) ($file['for'] / 100000 - 10000);
                if(!isset($this->lang[$key])) {
                    $this->lang += $MODLANG;
                } else {
                    /** @noinspection PhpWrongStringConcatenationInspection */
                    $this->lang[$key] += $MODLANG[$key];
                }
            }
        }
    }
}