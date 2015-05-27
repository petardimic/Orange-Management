<?php
namespace Modules\Reporter;

/**
 * Reporter controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Admin
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
    protected static $module = 'Reporter';

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
     * @param \phpOMS\ApplicationAbstract $app Application instance
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
            case \phpOMS\Message\RequestDestination::API:
                $this->showAPI($request, $response);
                break;
            case \phpOMS\Message\RequestDestination::REPORTER:
                $this->showContentReporter($request, $response);
                break;
            case \phpOMS\Message\RequestDestination::RAW:
                $this->showContentReporter($request, $response);
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
        switch($request->getPath(3)) {
            case 'single':
                $this->showSingleBackend($request, $response);
                break;
            case 'list':
                $reportList = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $reportList->setTemplate('/Modules/Reporter/Theme/backend/reporter-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $reportList->addData('nav', $navigation->nav);
                echo $reportList->render();
                break;
            case 'create':
                $reportCreate = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $reportCreate->setTemplate('/Modules/Reporter/Theme/backend/reporter-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $reportCreate->addData('nav', $navigation->nav);
                echo $reportCreate->render();
                break;
            case 'edit':
                $reportEdit = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $reportEdit->setTemplate('/Modules/Reporter/Theme/backend/reporter-edit');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $reportEdit->addData('nav', $navigation->nav);
                $reportEdit->addData('name', $request->getData('id'));
                echo $reportEdit->render();
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
    public function showSingleBackend($request, $response)
    {
        switch($request->getPath(4)) {
            case '':
                if(file_exists(__DIR__ . '/Templates/' . $request->getData('id') . '.tpl.php')) {
                }

                $reportSingle = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $reportSingle->setTemplate('/Modules/Reporter/Theme/backend/reporter-single');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $reportSingle->addData('nav', $navigation->nav);

                $dataView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $dataView->setTemplate('/Modules/Reporter/Templates/' . $request->getData('id') . '/' . $request->getData('id'));
                $reportSingle->addData('name', $request->getData('id'));
                $reportSingle->addView('DataView', $dataView);
                echo $reportSingle->render();
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
    public function showSingleReporter($request, $response)
    {
        switch($request->getPath(4)) {
            case '':
                if(file_exists(__DIR__ . '/Templates/' . $request->getData('id') . '.tpl.php')) {
                }

                $reportSingle = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $reportSingle->setTemplate('/Modules/Reporter/Theme/reporter/reporter-single');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $reportSingle->addData('nav', $navigation->nav);

                $dataView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $dataView->setTemplate('/Modules/Reporter/Templates/' . $request->getData('id') . '/' . $request->getData('id'));
                $reportSingle->addData('name', $request->getData('id'));
                $reportSingle->addView('DataView', $dataView);
                echo $reportSingle->render();
                break;
        }
    }

    /**
     * Shows api content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showAPI($request, $response)
    {
    }

    /**
     * Shows api content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showRaw($request, $response)
    {
        switch($request->getPath(3)) {
            case 'export':
                $pdfView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $pdfView->setTemplate('/Modules/Reporter/Templates/' . $request->getData('id') . '/' . $request->getData('id') . '.pdf');
                echo $pdfView->render();
                break;
        }
    }

    /**
     * Shows api content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showRawExport($request, $response)
    {
        switch($request->getPath(4)) {
            case 'pdf':

                break;
        }
    }

    public function showContentReporter($request, $response)
    {
        switch($request->getPath(2)) {
            case 'single':
                $this->showSingleReporter($request, $response);
                break;
            default:
                $reportList = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $reportList->setTemplate('/Modules/Reporter/Theme/reporter/reporter-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $reportList->addData('nav', $navigation->nav);
                echo $reportList->render();
        }
    }
}