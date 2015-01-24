<?php
namespace Modules\Navigation;
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
    class Controller extends \Framework\Module\ModuleAbstract implements \Framework\Module\WebInterface
    {
        /**
         * Providing
         *
         * @var string[]
         * @since 1.0.0
         */
        protected static $providing = [
        ];

        /**
         * Dependencies
         *
         * @var string[]
         * @since 1.0.0
         */
        protected static $dependencies = [
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
         * @param \Framework\ApplicationAbstract $app Application
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app)
        {
            parent::__construct($app);

            if(!$this->nav) {
                $temp_nav  = null;
                $this->nav = [];

                $uri_hash = $this->app->request->getHash();

                $sth = $this->app->db->con->prepare('SELECT * FROM `' . $this->app->db->prefix . 'nav` WHERE `nav_pid` IN(:pidA, :pidB, :pidC, :pidD, :pidE) ORDER BY `nav_order` ASC');
                $sth->bindValue(':pidA', $uri_hash[0], \PDO::PARAM_STR);
                $sth->bindValue(':pidB', $uri_hash[1], \PDO::PARAM_STR);
                $sth->bindValue(':pidC', $uri_hash[2], \PDO::PARAM_STR);
                $sth->bindValue(':pidD', $uri_hash[3], \PDO::PARAM_STR);
                $sth->bindValue(':pidE', $uri_hash[4], \PDO::PARAM_STR);
                $sth->execute();
                $temp_nav = $sth->fetchAll();

                foreach($temp_nav as $link) {
                    $this->nav[$link['nav_type']][$link['nav_subtype']][$link['nav_id']] = $link;
                }
            }
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
                case \Modules\Navigation\Models\NavigationType::TOP:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/Theme/' . $this->app->request->getType() . '/top.tpl.php';
                    break;
                case \Modules\Navigation\Models\NavigationType::SIDE:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/Theme/' . $this->app->request->getType() . '/side.tpl.php';
                    break;
                case \Modules\Navigation\Models\NavigationType::CONTENT:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/Theme/' . $this->app->request->getType() . '/mid.tpl.php';
                    break;
                case \Modules\Navigation\Models\NavigationType::CONTENT_SIDE:
                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/Theme/' . $this->app->request->getType() . '/mid-side.tpl.php';
                    break;
            }
        }
    }