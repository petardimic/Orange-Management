<?php
namespace Framework\Uri;

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
    public static function build($data, $query = null, $scheme = \Framework\Uri\UriScheme::HTTP)
    {
        switch($scheme) {
            case \Framework\Uri\UriScheme::HTTP:
                return \Framework\Uri\Http::create($data, $query);
            case \Framework\Uri\UriScheme::FILE:
                return \Framework\Uri\File::create($data, $query);
            case \Framework\Uri\UriScheme::MAILTO:
                return \Framework\Uri\Mailto::create($data, $query);
            case \Framework\Uri\UriScheme::FTP:
                return \Framework\Uri\Ftp::create($data, $query);
            case \Framework\Uri\UriScheme::IRC:
                return \Framework\Uri\Irc::create($data, $query);
            case \Framework\Uri\UriScheme::TEL:
                return \Framework\Uri\Tel::create($data, $query);
            case \Framework\Uri\UriScheme::TELNET:
                return \Framework\Uri\Telnet::create($data, $query);
            case \Framework\Uri\UriScheme::SSH:
                return \Framework\Uri\Ssh::create($data, $query);
            case \Framework\Uri\UriScheme::SKYPE:
                return \Framework\Uri\Skype::create($data, $query);
            case \Framework\Uri\UriScheme::SSL:
                return \Framework\Uri\Ssl::create($data, $query);
            case \Framework\Uri\UriScheme::NFS:
                return \Framework\Uri\Nfs::create($data, $query);
            case \Framework\Uri\UriScheme::GEO:
                return \Framework\Uri\Geo::create($data, $query);
            case \Framework\Uri\UriScheme::MARKET:
                return \Framework\Uri\Market::create($data, $query);
            case \Framework\Uri\UriScheme::ITMS:
                return \Framework\Uri\Itms::create($data, $query);
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
    public static function isValid($uri, $scheme = \Framework\Uri\UriScheme::HTTP)
    {
        switch($scheme) {
            case \Framework\Uri\UriScheme::HTTP:
                return \Framework\Uri\Http::isValid($uri);
            case \Framework\Uri\UriScheme::FILE:
                return \Framework\Uri\File::isValid($uri);
            case \Framework\Uri\UriScheme::MAILTO:
                return \Framework\Uri\Mailto::isValid($uri);
            case \Framework\Uri\UriScheme::FTP:
                return \Framework\Uri\Ftp::isValid($uri);
            case \Framework\Uri\UriScheme::IRC:
                return \Framework\Uri\Irc::isValid($uri);
            case \Framework\Uri\UriScheme::TEL:
                return \Framework\Uri\Tel::isValid($uri);
            case \Framework\Uri\UriScheme::TELNET:
                return \Framework\Uri\Telnet::isValid($uri);
            case \Framework\Uri\UriScheme::SSH:
                return \Framework\Uri\Ssh::isValid($uri);
            case \Framework\Uri\UriScheme::SKYPE:
                return \Framework\Uri\Skype::isValid($uri);
            case \Framework\Uri\UriScheme::SSL:
                return \Framework\Uri\Ssl::isValid($uri);
            case \Framework\Uri\UriScheme::NFS:
                return \Framework\Uri\Nfs::isValid($uri);
            case \Framework\Uri\UriScheme::GEO:
                return \Framework\Uri\Geo::isValid($uri);
            case \Framework\Uri\UriScheme::MARKET:
                return \Framework\Uri\Market::isValid($uri);
            case \Framework\Uri\UriScheme::ITMS:
                return \Framework\Uri\Itms::isValid($uri);
        }

        return false;
    }
}