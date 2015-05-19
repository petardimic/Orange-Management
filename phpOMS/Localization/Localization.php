<?php
namespace phpOMS\Localization;

/**
 * Localization class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Localization
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

// region Class Fields
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
     * Localized strings
     *
     * @var string[]
     * @since 1.0.0
     */
    public $lang = [];

// endregion

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        // TODO: implement!!!
        setlocale(LC_TIME, '');
        setlocale(LC_NUMERIC, '');
        setlocale(LC_MONETARY, '');
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
     * @param string $file     Language array
     * @param string $module   Available modules
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function loadLanguage($language = 'en', $file, $module)
    {
        /** @noinspection PhpIncludeInspection */
        /* TODO: change, store name inside instead of id */
        if(file_exists(($path = __DIR__ . '/../../Modules/' . $module . '/Theme/lang/' . $file . '.' . $language . '.lang.php'))) {
            /** @noinspection PhpIncludeInspection */
            require $path;
            /** @var string[] $MODLANG */
            $key = array_keys($MODLANG);

            if(!isset($this->lang[$key[0]])) {
                $this->lang += $MODLANG;
            } else {
                /** @noinspection PhpWrongStringConcatenationInspection */
                $this->lang[$key[0]] += $MODLANG[$key[0]];
            }
        }
    }
}
