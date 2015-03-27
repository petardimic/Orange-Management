<?php
namespace Modules\RiskManagement;

/**
 * Risk Management class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\RiskManagement
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
        switch($request->getRequestDestination()) {
            case \phpOMS\Message\RequestDestination::BACKEND:
                $this->showContentBackend($request, $response);
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
    public function showContentBackend($request, $response)
    {
        switch($request->getData()['l4']) {
            case 'cockpit':
                $riskMgmtDashboard = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $riskMgmtDashboard->setTemplate('/Modules/RiskManagement/Theme/backend/cockpit');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $riskMgmtDashboard->addData('nav', $navigation->nav);
                echo $riskMgmtDashboard->getOutput();
                break;
            case 'risk':
                $this->showContentBackendRisk($request, $response);
                break;
            case 'cause':
                $this->showContentBackendCause($request, $response);
                break;
            case 'solution':
                $this->showContentBackendSolution($request, $response);
                break;
            case 'settings':
                $this->show_backend_settings();
                break;
            case 'unit':
                $this->showContentBackendUnit($request, $response);
                break;
            case 'department':
                $this->showContentBackendDepartment($request, $response);
                break;
            case 'category':
                $this->showContentBackendCategory($request, $response);
                break;
            case 'project':
                $this->showContentBackendProject($request, $response);
                break;
            case 'process':
                $this->showContentBackendProcess($request, $response);
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
    public function showContentBackendUnit($request, $response)
    {
        $unitView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
        $unitView->setTemplate('/Modules/RiskManagement/Theme/backend/unit-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $unitView->addData('nav', $navigation->nav);
        echo $unitView->getOutput();
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
    public function showContentBackendDepartment($request, $response)
    {
        $departmentView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
        $departmentView->setTemplate('/Modules/RiskManagement/Theme/backend/department-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $departmentView->addData('nav', $navigation->nav);
        echo $departmentView->getOutput();
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
    public function showContentBackendCategory($request, $response)
    {
        $categoryView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
        $categoryView->setTemplate('/Modules/RiskManagement/Theme/backend/category-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $categoryView->addData('nav', $navigation->nav);
        echo $categoryView->getOutput();
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
    public function showContentBackendProject($request, $response)
    {
        $projectView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
        $projectView->setTemplate('/Modules/RiskManagement/Theme/backend/project-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $projectView->addData('nav', $navigation->nav);
        echo $projectView->getOutput();
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
    public function showContentBackendProcess($request, $response)
    {
        $processView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
        $processView->setTemplate('/Modules/RiskManagement/Theme/backend/process-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $processView->addData('nav', $navigation->nav);
        echo $processView->getOutput();
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
    public function showContentBackendRisk($request, $response)
    {
        $riskView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
        $riskView->setTemplate('/Modules/RiskManagement/Theme/backend/risk-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $riskView->addData('nav', $navigation->nav);
        echo $riskView->getOutput();
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
    public function showContentBackendCause($request, $response)
    {
        $causeView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
        $causeView->setTemplate('/Modules/RiskManagement/Theme/backend/cause-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $causeView->addData('nav', $navigation->nav);
        echo $causeView->getOutput();
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
    public function showContentBackendSolution($request, $response)
    {
        $solutionView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
        $solutionView->setTemplate('/Modules/RiskManagement/Theme/backend/solution-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $solutionView->addData('nav', $navigation->nav);
        echo $solutionView->getOutput();
    }
}