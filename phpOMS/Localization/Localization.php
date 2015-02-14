<?php
namespace phpOMS\Localization;

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
     * Language ISO code
     *
     * @var string
     * @since 1.0.0
     */
    public $language = 'en';

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
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param string $datetime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getNumberformat()
    {
        return $this->numberformat;
    }

    /**
     * @param string $numberformat
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setNumberformat($numberformat)
    {
        $this->numberformat = $numberformat;
    }



    public function loadCoreLanguage($language = 'en')
    {
        if(!file_exists(__DIR__ . '/lang/' . $language . '.lang.php')) {
            $language = 'en'; // TODO: maybe load server default
        }

        /** @noinspection PhpIncludeInspection */
        /** @var string[] $CORELANG */
        require __DIR__ . '/lang/' . $language . '.lang.php';
        /** @noinspection PhpUndefinedVariableInspection */
        $this->lang += $CORELANG;
    }

    public function loadThemeLanguage($language = 'en', $theme)
    {
        if(!file_exists(__DIR__ . '/../../Web/Theme/' . $theme . '/lang/' . $language . '.lang.php')) {
            $language = 'en'; // TODO: maybe load server default
        }

        /** @noinspection PhpIncludeInspection */
        /** @var string[] $CORELANG */
        require __DIR__ . '/../../Web/Theme/' . $theme . '/lang/' . $language . '.lang.php';
        /** @noinspection PhpUndefinedVariableInspection */
        $this->lang[0] += $THEMELANG[0];
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
    public function loadLanguage($language = 'en', $files = [], $modules = [])
    {
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