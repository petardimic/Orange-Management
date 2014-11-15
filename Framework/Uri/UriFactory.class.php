<?php
namespace Framework\Uri {
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
    class UriFactory {
        private function __construct() {}

        public static function build($data, $scheme = \Framework\Uri\UriScheme::HTTP) {
            switch($scheme) {
                case \Framework\Uri\UriScheme::HTTP:
                    return \Framework\Uri\Http::create($data);
                case \Framework\Uri\UriScheme::FILE:
                    return \Framework\Uri\File::create($data);
                case \Framework\Uri\UriScheme::MAILTO:
                    return \Framework\Uri\Mailto::create($data);
                case \Framework\Uri\UriScheme::FTP:
                    return \Framework\Uri\Ftp::create($data);
                case \Framework\Uri\UriScheme::IRC:
                    return \Framework\Uri\Irc::create($data);
                case \Framework\Uri\UriScheme::TEL:
                    return \Framework\Uri\Tel::create($data);
                case \Framework\Uri\UriScheme::TELNET:
                    return \Framework\Uri\Telnet::create($data);
                case \Framework\Uri\UriScheme::SSH:
                    return \Framework\Uri\Ssh::create($data);
                case \Framework\Uri\UriScheme::SKYPE:
                    return \Framework\Uri\Skype::create($data);
                case \Framework\Uri\UriScheme::SSL:
                    return \Framework\Uri\Ssl::create($data);
                case \Framework\Uri\UriScheme::NFS:
                    return \Framework\Uri\Nfs::create($data);
                case \Framework\Uri\UriScheme::GEO:
                    return \Framework\Uri\Geo::create($data);
                case \Framework\Uri\UriScheme::MARKET:
                    return \Framework\Uri\Market::create($data);
                case \Framework\Uri\UriScheme::ITMS:
                    return \Framework\Uri\Itms::create($data);
            }

            return null;
        }

        public static function isValid($uri, $scheme = \Framework\Uri\UriScheme::HTTP) {
            $uri = null;

            switch($scheme) {
                case \Framework\Uri\UriScheme::HTTP:
                    return \Framework\Uri\Http::isValid($data);
                case \Framework\Uri\UriScheme::FILE:
                    return \Framework\Uri\File::isValid($data);
                case \Framework\Uri\UriScheme::MAILTO:
                    return \Framework\Uri\Mailto::isValid($data);
                case \Framework\Uri\UriScheme::FTP:
                    return \Framework\Uri\Ftp::isValid($data);
                case \Framework\Uri\UriScheme::IRC:
                    return \Framework\Uri\Irc::isValid($data);
                case \Framework\Uri\UriScheme::TEL:
                    return \Framework\Uri\Tel::isValid($data);
                case \Framework\Uri\UriScheme::TELNET:
                    return \Framework\Uri\Telnet::isValid($data);
                case \Framework\Uri\UriScheme::SSH:
                    return \Framework\Uri\Ssh::isValid($data);
                case \Framework\Uri\UriScheme::SKYPE:
                    return \Framework\Uri\Skype::isValid($data);
                case \Framework\Uri\UriScheme::SSL:
                    return \Framework\Uri\Ssl::isValid($data);
                case \Framework\Uri\UriScheme::NFS:
                    return \Framework\Uri\Nfs::isValid($data);
                case \Framework\Uri\UriScheme::GEO:
                    return \Framework\Uri\Geo::isValid($data);
                case \Framework\Uri\UriScheme::MARKET:
                    return \Framework\Uri\Market::isValid($data);
                case \Framework\Uri\UriScheme::ITMS:
                    return \Framework\Uri\Itms::isValid($data);
            }

            return false;
        }
    }
}