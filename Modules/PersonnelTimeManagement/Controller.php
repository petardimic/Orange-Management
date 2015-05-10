<?php
namespace Modules\PersonnelTimeManagement;

/**
 * Support controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Support
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

// region Class Fields
    /**
     * Module name
     *
     * @var string
     * @since 1.0.0
     */
    protected static $module = 'PersonnelTimeManagement';

    /**
     * Localization files
     *
     * @var string
     * @since 1.0.0
     */
    protected static $localization = [
        \phpOMS\Message\RequestDestination::BACKEND => 'backend',
    ];

    /**
     * Providing
     *
     * @var string
     * @since 1.0.0
     */
    protected static $providing = [
        'Content',
    ];

    /**
     * Dependencies
     *
     * @var string
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];
// endregion

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
    public function call($request, $response, $data = null)
    {
        switch($request->getRequestDestination()) {
            case \phpOMS\Message\RequestDestination::BACKEND:
                $this->showContentBackend($request, $response);
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackend($request, $response)
    {
        // TODO: pull abstract view creation and output out. let error be a view as well -> less code writing
        switch($request->getRequest('l2')) {
            case 'hr':
                $this->showContentTimemgmtBackend($request, $response);
                break;
            case 'private':
                $this->showContentBackendPrivate($request, $response);
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentTimemgmtBackend($request, $response)
    {
        if($request->getRequest('l3') === 'timemgmt') {
            switch($request->getRequest('l4')) {
                case 'dashboard':
                    $timemgmtDashboardView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $this->app);
                    $timemgmtDashboardView->setTemplate('/Modules/PersonnelTimeManagement/Theme/backend/timemanagement-list');

                    $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                    $timemgmtDashboardView->addData('nav', $navigation->nav);
                    echo $timemgmtDashboardView->getOutput();
                    break;
                case 'single':
                    $timemgmtSingleView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $this->app);
                    $timemgmtSingleView->setTemplate('/Modules/PersonnelTimeManagement/Theme/backend/timemanagement-single');

                    $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                    $timemgmtSingleView->addData('nav', $navigation->nav);
                    echo $timemgmtSingleView->getOutput();
                    break;
            }
        }
    }

    /**
     * Shows module content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackendPrivate($request, $response)
    {
        switch($request->getRequest('l4')) {
            case 'dashboard':
                $timemgmtDashboardView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $this->app);
                $timemgmtDashboardView->setTemplate('/Modules/PersonnelTimeManagement/Theme/backend/user-timemanagement-dashboard');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $timemgmtDashboardView->addData('nav', $navigation->nav);
                echo $timemgmtDashboardView->getOutput();
                break;
        }
    }
}