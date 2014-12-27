<?php
namespace Modules\Navigation {
    /**
     * Navigation class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Handler extends \Framework\Module\ModuleAbstract implements \Framework\Module\WebInterface
    {
        /**
         * Providing
         *
         * @var string[]
         * @since 1.0.0
         */
        public static $providing = [
        ];

        /**
         * Dependencies
         *
         * @var string[]
         * @since 1.0.0
         */
        public static $dependencies = [
        ];

        /**
         * JavaScript files
         *
         * @var string[]
         * @since 1.0.0
         */
        public static $js = [
            'backend',
        ];

        /**
         * CSS files
         *
         * @var string[]
         * @since 1.0.0
         */
        public static $css = [
        ];

        /**
         * Navigation array
         *
         * Array of all navigation elements sorted by type->parent->id
         *
         * @var array
         * @since 1.0.0
         */
        public $nav = [];

        /**
         * Navigation array
         *
         * Array of all navigation elements by id
         *
         * @var array
         * @since 1.0.0
         */
        public $nid = null;

        /**
         * Parent links of the current page
         *
         * @var array
         * @since 1.0.0
         */
        public $nav_parents = null;

        /**
         * Constructor
         *
         * @param string $themePath
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app, $themePath)
        {
            parent::__construct($app, $themePath);

            if(!$this->nav) {
                $temp_nav  = null;
                $this->nav = [];

                $uri_hash = $this->app->request->getHash();

                $sth = $this->app->db->con->prepare('SELECT * FROM `' . $this->app->db->prefix . 'nav` WHERE `pid` IN(:pidA, :pidB, :pidC, :pidD, :pidE) ORDER BY `order` ASC');
                $sth->bindValue(':pidA', $uri_hash[0], \PDO::PARAM_STR);
                $sth->bindValue(':pidB', $uri_hash[1], \PDO::PARAM_STR);
                $sth->bindValue(':pidC', $uri_hash[2], \PDO::PARAM_STR);
                $sth->bindValue(':pidD', $uri_hash[3], \PDO::PARAM_STR);
                $sth->bindValue(':pidE', $uri_hash[4], \PDO::PARAM_STR);
                $sth->execute();
                $temp_nav = $sth->fetchAll();

                foreach($temp_nav as $link) {
                    $this->nav[$link['type']][$link['subtype']][$link['NavigationID']] = $link;
                }
            }
        }

        /**
         * Get modules this module is providing for
         *
         * @return array Providing
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getProviding()
        {
            return self::$providing;
        }

        /**
         * Get dependencies for this module
         *
         * @return array Dependencies
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getDependencies()
        {
            return self::$dependencies;
        }

        /**
         * Shows module content
         *
         * @param   array $data Navigation data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function callWeb($data = null)
        {
            switch($data[0]) {
                case \Modules\Navigation\NavigationType::TOP:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/themes/' . $this->themePath . '/' . $this->app->request->getType() . '/top.tpl.php';
                    break;
                case \Modules\Navigation\NavigationType::SIDE:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/themes/' . $this->themePath . '/' . $this->app->request->getType() . '/side.tpl.php';
                    break;
                case \Modules\Navigation\NavigationType::CONTENT:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/themes/' . $this->themePath . '/' . $this->app->request->getType() . '/mid.tpl.php';
                    break;
                case \Modules\Navigation\NavigationType::CONTENT_SIDE:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/themes/' . $this->themePath . '/' . $this->app->request->getType() . '/mid-side.tpl.php';
                    break;
            }
        }
    }
}