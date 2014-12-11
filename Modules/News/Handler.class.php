<?php
namespace Modules\News {
    /**
     * News class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    News
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Handler extends \Framework\Module\ModuleAbstract implements \Framework\Module\WebInterface {
        /**
         * Providing
         *
         * @var string
         * @since 1.0.0
         */
        public static $providing = [
            'Content',
            1004400000
        ];

        /**
         * Dependencies
         *
         * @var string
         * @since 1.0.0
         */
        public static $dependencies = [
        ];

        /**
         * Constructor
         *
         * @param string                    $themePath
         * @param \Framework\WebApplication $app Application reference
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app, $themePath) {
            parent::__construct($app, $themePath);
        }

        /**
         * Get modules this module is providing for
         *
         * @return array Providing
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getProviding() {
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
        public function getDependencies() {
            return self::$dependencies;
        }

        /**
         * Shows module content
         *
         * @para   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function callWeb() {
            switch($this->app->request->getType()) {
                case \Framework\Request\WebRequestPage::BACKEND:
                    $this->showContentBackend();
                    break;
            }
        }

        public function showContentBackend() {
            switch($this->app->request->request['l3']) {
                case 'dashboard':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $newsList = new \Modules\News\NewsList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/news-dashboard.tpl.php';
                    break;
                case 'single':
                    $article = new \Modules\News\Article($this->app->db);
                    $article->init($this->app->request->request['id']);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/news-single.tpl.php';
                    break;
                case 'archive':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $newsList = new \Modules\News\NewsList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/news-archive.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/news-create.tpl.php';
                    break;
            }
        }
    }
}