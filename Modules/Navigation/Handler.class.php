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
    class Handler extends \Framework\Module\ModuleAbstract {
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
         * @param string $theme_path
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($theme_path, $app) {
            parent::initialize($theme_path, $app);

            $this->nav = $this->app->cache->pull('nav::' . $this->app->request->uri_hash[2]);

            if (!$this->nav) {
                $temp_nav  = null;
                $this->nav = [];

                $sth = $this->app->db->con->prepare('SELECT * FROM `' . $this->app->db->prefix . 'nav` WHERE `pid` IN(:pidA, :pidB, :pidC, :pidD, :pidE) ORDER BY `order` ASC');
                $sth->bindValue(':pidA', $this->app->request->uri_hash[0], \PDO::PARAM_STR);
                $sth->bindValue(':pidB', $this->app->request->uri_hash[1], \PDO::PARAM_STR);
                $sth->bindValue(':pidC', $this->app->request->uri_hash[2], \PDO::PARAM_STR);
                $sth->bindValue(':pidD', $this->app->request->uri_hash[3], \PDO::PARAM_STR);
                $sth->bindValue(':pidE', $this->app->request->uri_hash[4], \PDO::PARAM_STR);
                $sth->execute();
                $temp_nav = $sth->fetchAll();

                foreach ($temp_nav as $link) {
                    $this->nav[$link['type']][$link['subtype']][$link['id']] = $link;
                }

                $this->app->cache->push('nav::' . $this->app->request->uri_hash[2], $this->nav);
            }
        }

        /**
         * Shows module content
         *
         * @para   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show($data = null) {
            switch ($data[0]) {
                case \Modules\Navigation\NavigationType::TOP:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/themes' . $this->theme_path . '/' . $this->app->request->request_type . '/top.tpl.php';
                    break;
                case \Modules\Navigation\NavigationType::SIDE:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/themes' . $this->theme_path . '/' . $this->app->request->request_type . '/side.tpl.php';
                    break;
                case \Modules\Navigation\NavigationType::CONTENT:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/themes' . $this->theme_path . '/' . $this->app->request->request_type . '/mid.tpl.php';
                    break;
                case \Modules\Navigation\NavigationType::CONTENT_SIDE:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/themes' . $this->theme_path . '/' . $this->app->request->request_type . '/mid-side.tpl.php';
                    break;
            }
        }
    }
}