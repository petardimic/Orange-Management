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
     * Build uri
     *
     * @param array         $data   Path data
     * @param array         $query  Query data
     * @param UriScheme|int $scheme Scheme type
     *
     * @return null|string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function build($data, $query = null, $scheme = \phpOMS\Uri\UriScheme::HTTP)
    {
        switch($scheme) {
            case \phpOMS\Uri\UriScheme::HTTP:
                return \phpOMS\Uri\Http::create($data, $query);
            case \phpOMS\Uri\UriScheme::FILE:
                return \phpOMS\Uri\File::create($data, $query);
            case \phpOMS\Uri\UriScheme::MAILTO:
                return \phpOMS\Uri\Mailto::create($data, $query);
            case \phpOMS\Uri\UriScheme::FTP:
                return \phpOMS\Uri\Ftp::create($data, $query);
            case \phpOMS\Uri\UriScheme::IRC:
                return \phpOMS\Uri\Irc::create($data, $query);
            case \phpOMS\Uri\UriScheme::TEL:
                return \phpOMS\Uri\Tel::create($data, $query);
            case \phpOMS\Uri\UriScheme::TELNET:
                return \phpOMS\Uri\Telnet::create($data, $query);
            case \phpOMS\Uri\UriScheme::SSH:
                return \phpOMS\Uri\Ssh::create($data, $query);
            case \phpOMS\Uri\UriScheme::SKYPE:
                return \phpOMS\Uri\Skype::create($data, $query);
            case \phpOMS\Uri\UriScheme::SSL:
                return \phpOMS\Uri\Ssl::create($data, $query);
            case \phpOMS\Uri\UriScheme::NFS:
                return \phpOMS\Uri\Nfs::create($data, $query);
            case \phpOMS\Uri\UriScheme::GEO:
                return \phpOMS\Uri\Geo::create($data, $query);
            case \phpOMS\Uri\UriScheme::MARKET:
                return \phpOMS\Uri\Market::create($data, $query);
            case \phpOMS\Uri\UriScheme::ITMS:
                return \phpOMS\Uri\Itms::create($data, $query);
        }

        return null;
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
            case \phpOMS\Uri\UriScheme::FILE:
                return \phpOMS\Uri\File::isValid($uri);
            case \phpOMS\Uri\UriScheme::MAILTO:
                return \phpOMS\Uri\Mailto::isValid($uri);
            case \phpOMS\Uri\UriScheme::FTP:
                return \phpOMS\Uri\Ftp::isValid($uri);
            case \phpOMS\Uri\UriScheme::IRC:
                return \phpOMS\Uri\Irc::isValid($uri);
            case \phpOMS\Uri\UriScheme::TEL:
                return \phpOMS\Uri\Tel::isValid($uri);
            case \phpOMS\Uri\UriScheme::TELNET:
                return \phpOMS\Uri\Telnet::isValid($uri);
            case \phpOMS\Uri\UriScheme::SSH:
                return \phpOMS\Uri\Ssh::isValid($uri);
            case \phpOMS\Uri\UriScheme::SKYPE:
                return \phpOMS\Uri\Skype::isValid($uri);
            case \phpOMS\Uri\UriScheme::SSL:
                return \phpOMS\Uri\Ssl::isValid($uri);
            case \phpOMS\Uri\UriScheme::NFS:
                return \phpOMS\Uri\Nfs::isValid($uri);
            case \phpOMS\Uri\UriScheme::GEO:
                return \phpOMS\Uri\Geo::isValid($uri);
            case \phpOMS\Uri\UriScheme::MARKET:
                return \phpOMS\Uri\Market::isValid($uri);
            case \phpOMS\Uri\UriScheme::ITMS:
                return \phpOMS\Uri\Itms::isValid($uri);
        }

        return false;
    }
}