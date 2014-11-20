<?php
namespace Modules\Admin {
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
    class Handler extends \Framework\Module\ModuleAbstract implements \Framework\Module\WebInterface {
        /**
         * Providing
         *
         * @var string
         * @since 1.0.0
         */
        public $providing = [
            1004100000,
            1004400000
        ];

        /**
         * Dependencies
         *
         * @var string
         * @since 1.0.0
         */
        public $dependencies = [
        ];

        /**
         * Constructor
         *
         * @param string                 $theme_path
         * @param \Framework\WebApplication $app Application instance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app, $theme_path) {
            parent::__construct($app, $theme_path);
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
            return $this->providing;
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
            return $this->dependencies;
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
            \Framework\Module\ModuleAbstract::activate($this->db, $id);
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
            \Framework\Module\ModuleAbstract::deactivate($this->db, $id);
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function callWeb() {
            switch ($this->app->request->getType()) {
                case \Framework\Request\WebRequestPage::BACKEND:
                    $this->show_content_backend();
                    break;
            }
        }

        public function show_content_backend() {
            switch ($this->app->request->uri['l3']) {
                case 'account':
                    $this->show_backend_account();
                    break;
                case 'group':
                    $this->show_backend_group();
                    break;
                case 'settings':
                    $this->show_backend_settings();
                    break;
                case 'module':
                    $this->show_backend_module();
                    break;
                default:
                    return false;
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
        public function show_backend_settings() {
            $this->app->settings->load_settings([
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
                1000000020,
                1000000021,
                1000000022,
                1000000023,
                1000000024,
                1000000025,
                1000000026
            ]);

            switch ($this->app->request->uri['l4']) {
                case 'general':
                    \Framework\Model\Model::$content['page::title'] = $this->app->user->localization->lang[1]['SettingsGeneral'];

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->theme_path . '/backend/settings-general.tpl.php';
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
        public function show_backend_account() {
            switch ($this->app->request->uri['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $accounts = new \Modules\Admin\Users($this->app);

                    if (!isset($this->app->request->uri['page'])) {
                        $this->app->request->uri['page'] = 1;
                    }

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/accounts-list.tpl.php';
                    break;
                case 'single':
                    $this->show_backend_account_single();
                    $this->show_push();

                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/accounts-create.tpl.php';
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
        public function show_backend_account_single() {
            switch ($this->app->request->uri['l5']) {
                case 'front':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/accounts-single.tpl.php';
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
        public function show_backend_module() {
            if (empty($this->app->request->uri['l4'])) {
                $this->app->request->uri['l5'] = 'front';
            }

            switch ($this->app->request->uri['l4']) {
                case 'list':
                    if (!isset($this->app->request->uri['page'])) {
                        $this->app->request->uri['page'] = 1;
                    }

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/modules-list.tpl.php';
                    break;
                case 'front':
                    $info = $this->app->modules->module_info_get((int)$this->app->request->uri['id']);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/modules-single.tpl.php';
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
        public function show_backend_group() {
            switch ($this->app->request->uri['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $groups = new \Modules\Admin\Groups($this->app);

                    if (!isset($this->app->request->uri['page'])) {
                        $this->app->request->uri['page'] = 1;
                    }

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/groups-list.tpl.php';
                    break;
                case 'single':
                    $this->show_backend_group_single();
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/groups-create.tpl.php';
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
        public function show_backend_group_single() {
            switch ($this->app->request->uri['l5']) {
                case 'front':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $accounts = new \Modules\Admin\Users($this->app);

                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $group = new \Framework\DataStorage\Database\Objects\Group\Group((int)$this->app->request->uri['id'], $this->app);

                    if (!isset($this->app->request->uri['page'])) {
                        $this->app->request->uri['page'] = 1;
                    }

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/groups-single.tpl.php';
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
            switch ($this->app->request->uri['l3']) {
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
            switch ($this->app->request->type) {
                case \Framework\RequestType::PUT:
                    $this->api_account_put();
                    break;
                case \Framework\RequestType::DELETE:
                    $this->api_account_delete();
                    break;
                case \Framework\RequestType::POST:
                    break;
                case \Framework\RequestType::GET:
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

            switch ($this->app->request->uri['l4']) {
                case 'user':
                    break;
                default:
                    $accounts->account_create($this->app->request->post['name'], $this->app->request->post['pass'], $this->app->request->post['email']);
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

            switch ($this->app->request->uri['l4']) {
                case 'user':
                    break;
                default:
                    $accounts->account_delete((int)$this->app->request->post['id']);
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
            switch ($this->app->request->type) {
                case \Framework\RequestType::PUT:
                    $this->api_group_put();
                    break;
                case \Framework\RequestType::DELETE:
                    $this->api_group_delete();
                    break;
                case \Framework\RequestType::POST:
                    $this->api_group_post();
                    break;
                case \Framework\RequestType::GET:
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

            switch ($this->app->request->uri['l4']) {
                case 'user':
                    break;
                default:
                    $groups->group_create($this->app->request->post['name'], $this->app->request->post['desc'], $this->app->request->post['perm']);
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

            switch ($this->app->request->uri['l4']) {
                case 'user':
                    break;
                default:
                    $groups->group_edit((int)$this->app->request->post['id'], $this->app->request->post['name'], $this->app->request->post['desc']);
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

            switch ($this->app->request->uri['l4']) {
                case 'user':
                    break;
                default:
                    $groups->group_delete((int)$this->app->request->post['id']);
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
            $settings = \Framework\Config\Settings::getInstance();

            switch ($this->app->request->uri['l4']) {
                case 'core':
                    $settings->settings_set($this->app->request->post['settigns']);

                    $json_ret = [
                        'type'   => 1,
                        'status' => 1,
                        'msg'    => $this->app->user->localization->lang[1]['i:SettingsSet']
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
            switch ($this->app->request->type) {
                case \Framework\RequestType::PUT:
                    \Framework\Install\Module::install($this->app->db, $this->app->request->data['id']);

                    $json_ret = [
                        'type'   => 1,
                        'status' => 1,
                        'msg'    => str_replace('{$1}', $this->app->request->data['id'], $this->app->user->localization->lang[1]['i:ModuleInstalled'])
                    ];

                    echo json_encode($json_ret);
                    break;
                case \Framework\RequestType::DELETE:
                    echo '1';
                    break;
                case \Framework\RequestType::POST:
                    echo '2';
                    break;
                case \Framework\RequestType::GET:
                    break;
                default:
                    echo '3';

                    return false;
            }

            return true;
        }
    }
}