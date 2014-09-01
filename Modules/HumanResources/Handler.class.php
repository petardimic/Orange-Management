<?php
namespace Modules\HumanResources {
    /**
     * Sales class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
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
         *
         * @param string                 $theme_path
         * @param \Framework\Application $app Application reference
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($theme_path, $app) {
            parent::initialize($theme_path, $app);
        }

        /**
         * Shows module content
         *
         * @para   array $data
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
            }
        }
    }
}