<?php
namespace Modules\HumanResourceManagement;

/**
 * Human Resources controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\HumanResourceManagement
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Controller extends \phpOMS\Module\ModuleAbstract implements \phpOMS\Module\WebInterface
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
     * @param \phpOMS\ApplicationAbstract $app Application reference
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * {@inheritdoc}
     */
    public function call($type, $request, $response, $data = null)
    {
        switch($request->getType()) {
            case \phpOMS\Message\Http\WebRequestPage::BACKEND:
                $this->showContentBackend($request);
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \phpOMS\Message\RequestAbstract $request Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackend($request)
    {
        switch($request->getData()['l3']) {
            case 'structure':
                $this->showContentBackendStrcture();
                break;
            case 'staff':
                $this->showContentBackendStaff();
                break;
            case 'planning':
                $this->showContentBackendPlanning();
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \phpOMS\Message\RequestAbstract $request Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackendStrcture()
    {
        switch($request->getData()['l4']) {
            case 'department':
                $this->showContentBackendDepartment();
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \phpOMS\Message\RequestAbstract $request Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackendDepartment()
    {
        switch($request->getData()['l5']) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $departments = new \Modules\HumanResourceManagement\DepartmentList($this->app->dbPool);
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/department-list.tpl.php';
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \phpOMS\Message\RequestAbstract $request Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackendStaff()
    {
        switch($request->getData()['l4']) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $staff = new \Modules\HumanResourceManagement\Models\StaffList($this->app->dbPool);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/staff-list.tpl.php';
                break;
            case 'single':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/staff-single.tpl.php';
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \phpOMS\Message\RequestAbstract $request Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackendPlanning()
    {
        switch($request->getData()['l4']) {
            case 'dashboard':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/planning-dashboard.tpl.php';
                break;
        }
    }
}