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
class L11nManager
{

    /**
     * Language
     *
     * @var string[][]
     * @since 1.0.0
     */
    private $language = [];

    /**
     * Verify if language is loaded
     *
     * @param string $language Language iso code
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function isLanguageLoaded($language)
    {
        return isset($this->language[$language]);
    }

    /**
     * Load language
     *
     * One module can only be loaded once. Once the module got loaded it's not
     * possible to load more language files later on.
     *
     * @param string   $language Language iso code
     * @param string   $module   Module name
     * @param string[] $files    Language files content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function loadLanguage($language, $module, $files)
    {
        if(!isset($this->language[$language][$module])) {
            $this->language[$language][$module] = $files;
        } else {
            $this->language[$language][$module] += $files;
        }
    }

    /**
     * Get application language
     *
     * @param string   $language Language iso code
     * @param string   $module   Module name
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLanguage($language, $module = null) {
        if(!isset($module) && isset($this->language[$language])) {
            return $this->langauge[$language];
        } elseif(isset($this->language[$language])) {
            return $htis->language[$language][$module];
        } else {
            throw new \Exception('Unknown language or module');
        }
    }
}
