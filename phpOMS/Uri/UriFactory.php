<?php
namespace phpOMS\Uri;

/**
 * UriFactory class
 *
 * Used in order to create a uri
 *
 * PHP Version 5.4
 *
 * @category   Uri
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class UriFactory
{

// region Class Fields
    /**
     * Dynamic query elements
     *
     * @var string[]
     * @since 1.0.0
     */
    private static $uri = [];

// endregion

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    private function __construct()
    {
    }

    /**
     * Set global query replacements
     *
     * @param string $key Replacement key
     *
     * @return false|string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getQuery($key)
    {
        if(isset(self::$uri[$key])) {
            return self::$uri[$key];
        }

        return false;
    }

    /**
     * Set global query replacements
     *
     * @param string  $key       Replacement key
     * @param string  $value     Replacement value
     * @param boolean $overwrite Overwrite if already exists
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function setQuery($key, $value, $overwrite = true)
    {
        if($overwrite || !isset(self::$uri[$key])) {
            self::$uri[$key] = $value;
        }
    }

    /**
     * Build uri
     *
     * @param array         $uri    Path data
     * @param UriScheme|int $scheme Scheme type
     *
     * @return null|string
     *
     * @throws \Exception
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function build($uri, $scheme = \phpOMS\Uri\UriScheme::HTTP)
    {
        /* Overwriting dynamic link elements if they are defined */
        // TODO: maybe set $query = null for performance as default value and make isset check here
        //preg_match_all('\{[\/#\?@\.][a-zA-Z0-9]*\}', $uri, $matches);

        preg_replace_callback('\{[\/#\?@\.][a-zA-Z0-9]*\}', function ($match) {
            return isset(self::$uri[$match]) ? self::$uri[$match] : '???';
        }, $uri);

        return $uri;
    }

    /**
     * Validate uri
     *
     * @param string        $uri    URI to validate
     * @param UriScheme|int $scheme Scheme type
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function isValid($uri, $scheme = \phpOMS\Uri\UriScheme::HTTP)
    {
        switch($scheme) {
            case \phpOMS\Uri\UriScheme::HTTP:
                return \phpOMS\Uri\Http::isValid($uri);
        }

        return false;
    }
}
