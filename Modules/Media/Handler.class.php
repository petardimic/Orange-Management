<?php
namespace Modules\Media {
    /**
     * Media class
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
         * Providing
         *
         * @var int[]
         * @since 1.0.0
         */
        public $providing = [
            1004100000,
            1004400000
        ];

        /**
         * Constructor
         */
        public function __construct($theme_path, $app) {
            parent::initialize($theme_path, $app);
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_content() {
            switch ($this->app->request->request_type) {
                case \Framework\Http\RequestPage::BACKEND:
                    $this->show_content_backend();
                    break;
            }
        }

        public function show_content_backend() {
            switch ($this->app->request->uri['l3']) {
                case 'single':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/media-single.tpl.php';
                    break;
                case 'list':
                    if (!isset($this->app->request->uri['page'])) {
                        $this->app->request->uri['page'] = 1;
                    }

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/media-list.tpl.php';
                    break;
            }
        }

        public function show_content_push() {
            switch ($this->app->request->uri['l2']) {
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
        public function show_api() {
            switch ($this->app->request->type) {
                case \Framework\Http\RequestType::PUT:
                    $this->api_media_put();
                    break;
                default:
                    return false;
            }

            return true;
        }

        private function api_media_put() {
            $this->upload_file();
        }

        private function upload_file() {
            $upload_dir = './tmp/';
            $file_count = count($_FILES['user_file']['name']);

            for ($i = 0; $i < $file_count; $i++) {
                $upload_file = $upload_dir . basename($_FILES['user_file']['name'][$i]);

                if (!preg_match('/(gif|jpg|jpeg|png)$/', $_FILES['user_file']['name'][$i])) {
                    // not allowed
                } else {
                    if (is_uploaded_file($_FILES['user_file']['tmp_name'][$i])) {
                        if (!move_uploaded_file($_FILES['user_file']['tmp_name'][$i], $upload_file)) {
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