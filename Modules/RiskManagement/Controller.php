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
        switch($request->getWebRequestType()) {
            case \phpOMS\Message\Http\WebRequestPage::BACKEND:
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
                $riskMgmtDashboard = new \phpOMS\Views\ViewAbstract($this->app->user->getL11n(), $this->app);
                $riskMgmtDashboard->setTemplate('/Modules/RiskManagement/Theme/backend/cockpit');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $riskMgmtDashboard->addData('nav', $navigation->nav);
                echo $riskMgmtDashboard->getOutput();
                break;
            case 'risk':
                $this->show_backend_risk();
                break;
            case 'cause':
                $this->show_backend_cause();
                break;
            case 'solution':
                $this->show_backend_solution();
                break;
            case 'settings':
                $this->show_backend_settings();
                break;
            case 'unit':
                $this->showContentBackendUnit($request, $response);
                break;
            case 'department':
                $this->show_backend_department();
                break;
            case 'category':
                $this->show_backend_category();
                break;
            case 'project':
                $this->show_backend_project();
                break;
            case 'process':
                $this->show_backend_process();
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
        $unitView = new \phpOMS\Views\ViewAbstract($this->app->user->getL11n(), $this->app);
        $unitView->setTemplate('/Modules/RiskManagement/Theme/backend/unit-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $unitView->addData('nav', $navigation->nav);
        echo $unitView->getOutput();
    }
}