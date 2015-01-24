<?php
namespace Modules\Media {
    /**
     * Media class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Modules\Media
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
         * @var string
         * @since 1.0.0
         */
        protected static $providing = [
            'Content',
            1004400000
        ];

        /**
         * Dependencies
         *
         * @var string
         * @since 1.0.0
         */
        protected static $dependencies = [
        ];

        /**
         * Constructor
         *
         * @param \Framework\ApplicationAbstract $app Application instance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app)
        {
            parent::__construct($app);
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function callWeb()
        {
            switch($this->app->request->getType()) {
                case \Framework\Request\WebRequestPage::BACKEND:
                    $this->show_content_backend();
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_content_backend()
        {
            switch($this->app->request->request['l3']) {
                case 'single':
                    $media = new \Modules\Media\Models\Media($this->app->db);
                    $media->init($this->app->request->request['id']);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/media-single.tpl.php';
                    break;
                case 'list':
                    if(!isset($this->app->request->request['page'])) {
                        $this->app->request->request['page'] = 1;
                    }

                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $mList = new \Modules\Media\Models\MediaList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/media-list.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/media-create.tpl.php';
                    break;
            }
        }

        public function callPush()
        {
            switch($this->app->request->request['l2']) {
                case 'admin':
                    break;
                case 'profile':
                    break;
            }
        }

        /**
         * Handle api call
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_api()
        {
            switch($this->app->request->getType()) {
                case \Framework\RequestType::PUT:
                    $this->api_media_put();
                    break;
                default:
                    return false;
            }

            return true;
        }

        private function api_media_put()
        {
            $this->upload_file();
        }

        private function upload_file()
        {
            $upload_dir = './tmp/';
            $file_count = count($_FILES['user_file']['name']);

            for($i = 0; $i < $file_count; $i++) {
                $upload_file = $upload_dir . basename($_FILES['user_file']['name'][$i]);

                if(!preg_match('/(gif|jpg|jpeg|png)$/', $_FILES['user_file']['name'][$i])) {
                    // not allowed
                } else {
                    if(is_uploaded_file($_FILES['user_file']['tmp_name'][$i])) {
                        if(!move_uploaded_file($_FILES['user_file']['tmp_name'][$i], $upload_file)) {
                            // Failure
                        }
                    } else {
                        // ERROR
                    }
                }
            }
        }
    }
}