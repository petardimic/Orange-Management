<?php
namespace Modules\Admin {
    /**
     * Navigation class
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
    class Admin extends \Framework\Modules\ModuleAbstract {
        /**
         * Dependencies
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $dependencies = null;

        /**
         * Receiving
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $receiving = null;

        /**
         * Providing
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $providing = [
            1004100000 => true,
            1004400000 => true
        ];

        /**
         * Users instance
         *
         * @var \Modules\Admin\Users
         * @since 1.0.0
         */
        protected $users = null;

        /**
         * Request instance
         *
         * @var \Framework\Core\Settings
         * @since 1.0.0
         */
        public $settings = null;

        /**
         * Constructor
         *
         * @param string $theme_path
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($theme_path) {
            /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
            $this->users = \Modules\Admin\Users::getInstance();
            /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
            $this->settings = \Framework\Core\Settings::getInstance();

            parent::initialize($theme_path);
        }

        /**
         * Install module
         *
         * @param \Framework\Core\Database $db   Database instance
         * @param array              $info Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install(&$db, $info) {
            parent::install_providing($db, __DIR__ . '/install/nav.install.json', 'Navigation');
        }

        /**
         * Activate module
         *
         * This function activates a inactive module
         *
         * @param int $id Account ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function module_active_set($id) {
            \Framework\Modules\ModuleAbstract::activate($this->db, $id);
        }

        /**
         * Deactivate module
         *
         * This function deactivates a active module
         *
         * @param int $id Account ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function module_inactive_set($id) {
            \Framework\Modules\ModuleAbstract::deactivate($this->db, $id);
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_content() {
            switch ($this->request->uri['l3']) {
                case 'account':
                    $this->show_account();
                    break;
                case 'group':
                    $this->show_group();
                    break;
                case 'settings':
                    $this->show_settings();
                    break;
                case 'module':
                    $this->show_module();
                    break;
                default:
                    return false;
            }

            return true;
        }

        /**
         * Shows module content
         *
         * @para   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_settings() {
            $this->settings->settings_load([
                1000000006,
                1000000007,
                1000000008,
                1000000012,
                1000000013,
                1000000014,
                1000000016,
                1000000017,
                1000000018,
                1000000019,
                1000000023,
                1000000024,
                1000000025,
                1000000026
            ]);

            switch ($this->request->uri[4]) {
                case 'general':
                    \Framework\Core\Model::$content['page::title'] = \Framework\Localization\Localization::$lang[1]['SettingsGeneral'];

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->theme_path . '/settings-general.tpl.php';
                    break;
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
        public function show_account() {
            switch ($this->request->uri['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $accounts = \Modules\Admin\Users::getInstance();

                    if (!isset($this->request->uri['page'])) {
                        $this->request->uri['page'] = 1;
                    }

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/accounts-list.tpl.php';
                    break;
                case 'single':
                    $this->show_account_single();
                    $this->show_push();

                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/accounts-create.tpl.php';
                    break;
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
        public function show_account_single() {
            switch ($this->request->uri['l5']) {
                case 'front':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/accounts-single.tpl.php';
                    break;
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
        public function show_module() {
            if (empty($this->request->uri['l4'])) {
                $this->request->uri['l5'] = 'front';
            }

            /** @noinspection PhpUnusedLocalVariableInspection */
            $modules = \Framework\Modules\Modules::getInstance();

            switch ($this->request->uri['l4']) {
                case 'list':
                    if (!isset($this->request->uri['page'])) {
                        $this->request->uri['page'] = 1;
                    }

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/modules-list.tpl.php';
                    break;
                case 'front':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $info = \Framework\Modules\Module::getInstance((int)$this->request->uri['id'])->module_info_get();

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/modules-single.tpl.php';
                    break;
            }
        }

        /**
         * Shows group content
         *
         * @para   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_group() {
            switch ($this->request->uri['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $groups = \Modules\Admin\Groups::getInstance();

                    if (!isset($this->request->uri['page'])) {
                        $this->request->uri['page'] = 1;
                    }

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/groups-list.tpl.php';
                    break;
                case 'single':
                    $this->show_group_single();
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/groups-create.tpl.php';
                    break;
            }
        }

        /**
         * Shows group single content
         *
         * @para   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_group_single() {
            switch ($this->request->uri['l5']) {
                case 'front':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $accounts = \Modules\Admin\Users::getInstance();

                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $group = \Framework\Core\Group::getInstance((int)$this->request->uri['id']);

                    if (!isset($this->request->uri['page'])) {
                        $this->request->uri['page'] = 1;
                    }

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/groups-single.tpl.php';
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
            switch ($this->request->uri['l3']) {
                case 'account':
                    $this->api_account();
                    break;
                case 'group':
                    $this->api_group();
                    break;
                case 'settings':
                    $this->api_settings();
                    break;
                case 'module':
                    $this->api_module();
                    break;
                default:
                    return false;
            }

            return true;
        }

        /**
         * Handle api account call
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function api_account() {
            switch ($this->request->type) {
                case \Framework\Core\RequestType::PUT:
                    $this->api_account_put();
                    break;
                case \Framework\Core\RequestType::DELETE:
                    $this->api_account_delete();
                    break;
                case \Framework\Core\RequestType::POST:
                    break;
                case \Framework\Core\RequestType::GET:
                    break;
                default:
                    return false;
            }

            return true;
        }

        /**
         * Handle api account create
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function api_account_put() {
            $accounts = \Modules\Admin\Users::getInstance();

            switch ($this->request->uri['l4']) {
                case 'user':
                    break;
                default:
                    $accounts->account_create($this->request->post['name'], $this->request->post['pass'], $this->request->post['email']);
                    break;
            }
        }

        /**
         * Handle api account delete
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function api_account_delete() {
            $accounts = \Modules\Admin\Users::getInstance();

            switch ($this->request->uri['l4']) {
                case 'user':
                    break;
                default:
                    $accounts->account_delete((int)$this->request->post['id']);
                    break;
            }
        }

        /**
         * Handle api group call
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function api_group() {
            switch ($this->request->type) {
                case \Framework\Core\RequestType::PUT:
                    $this->api_group_put();
                    break;
                case \Framework\Core\RequestType::DELETE:
                    $this->api_group_delete();
                    break;
                case \Framework\Core\RequestType::POST:
                    $this->api_group_post();
                    break;
                case \Framework\Core\RequestType::GET:
                    break;
                default:
                    return false;
            }

            return true;
        }

        /**
         * Handle api group create
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function api_group_put() {
            $groups = \Modules\Admin\Groups::getInstance();

            switch ($this->request->uri['l4']) {
                case 'user':
                    break;
                default:
                    $groups->group_create($this->request->post['name'], $this->request->post['desc'], $this->request->post['perm']);
                    break;
            }
        }

        /**
         * Handle api group delete
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function api_group_delete() {
            $groups = \Modules\Admin\Groups::getInstance();

            switch ($this->request->uri['l4']) {
                case 'user':
                    break;
                default:
                    $groups->group_edit((int)$this->request->post['id'], $this->request->post['name'], $this->request->post['desc']);
                    break;
            }
        }

        /**
         * Handle api group modification
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function api_group_post() {
            $groups = \Modules\Admin\Groups::getInstance();

            switch ($this->request->uri['l4']) {
                case 'user':
                    break;
                default:
                    $groups->group_delete((int)$this->request->post['id']);
                    break;
            }
        }

        /**
         * Handle api settings call
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function api_settings() {
            $settings = \Framework\Core\Settings::getInstance();

            switch ($this->request->uri['l4']) {
                case 'core':
                    $settings->settings_set($this->request->post['settigns']);

                    $json_ret = [
                        'type' => 1,
                        'status' => 1,
                        'msg' => \Framework\Localization\Localization::$lang[1]['i:SettingsSet']
                    ];

                    echo json_encode($json_ret);
                    break;
                case 'modules':
                    break;
                default:
                    return false;
            }

            return true;
        }

        /**
         * Handle api module call
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function api_module() {
            switch ($this->request->type) {
                case \Framework\Core\RequestType::PUT:
                    \Framework\Modules\ModuleAbstract::install($this->db, $this->request->uri['id']);

                    $json_ret = [
                        'type' => 1,
                        'status' => 1,
                        'msg' => str_replace('{$1}', $this->request->uri['id'], \Framework\Localization\Localization::$lang[1]['i:ModuleInstalled'])
                    ];

                    echo json_encode($json_ret);
                    break;
                case \Framework\Core\RequestType::DELETE:
                    echo '1';
                    break;
                case \Framework\Core\RequestType::POST:
                    echo '2';
                    break;
                case \Framework\Core\RequestType::GET:
                    break;
                default:
                    echo '3';
                    return false;
            }

            return true;
        }
    }
}