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
                $reportList = new \phpOMS\Views\View($this->app, $request, $response);
                $reportList->setTemplate('/Modules/Reporter/Theme/Backend/reporter-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $reportList->addData('nav', $navigation->nav);
                echo $reportList->render();
                break;
            case 'create':
                $reportCreate = new \phpOMS\Views\View($this->app, $request, $response);
                $reportCreate->setTemplate('/Modules/Reporter/Theme/Backend/reporter-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $reportCreate->addData('nav', $navigation->nav);
                echo $reportCreate->render();
                break;
            case 'edit':
                $reportEdit = new \phpOMS\Views\View($this->app, $request, $response);
                $reportEdit->setTemplate('/Modules/Reporter/Theme/Backend/reporter-edit');

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

                $reportSingle = new \phpOMS\Views\View($this->app, $request, $response);
                $reportSingle->setTemplate('/Modules/Reporter/Theme/Backend/reporter-single');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $reportSingle->addData('nav', $navigation->nav);

                $dataView = new \phpOMS\Views\View($this->app, $request, $response);
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

                $reportSingle = new \phpOMS\Views\View($this->app, $request, $response);
                $reportSingle->setTemplate('/Modules/Reporter/Theme/reporter/reporter-single');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $reportSingle->addData('nav', $navigation->nav);

                $dataView = new \phpOMS\Views\View($this->app, $request, $response);
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
        switch($request->getPath(3)) {
            case 'export':
                switch($request->getData('type')) {
                    case 'pdf':
                        $response->setHeader('Content-Type', \phpOMS\System\MimeType::M_PDF, true);
                        break;
                    case 'csv':
                        $response->setHeader('Content-Type', \phpOMS\System\MimeType::M_CONF, true);
                        break;
                    case 'xlsx':
                        $response->setHeader('Content-Type', \phpOMS\System\MimeType::M_XLSX, true);
                        break;
                    case 'json':
                        $response->setHeader('Content-Type', \phpOMS\System\MimeType::M_JSON, true);
                        break;
                    default:
                        // TODO handle bad request
                }

                if($request->getData('download') !== null) {
                    $response->setHeader('Content-Type', \phpOMS\System\MimeType::M_BIN, true);
                    $response->setHeader('Content-Transfer-Encoding', 'Binary', true);
                    $response->setHeader('Content-disposition', 'attachment; filename="' . $request->getData('id') . '.' . $request->getData('type') . '"', true);
                }

                /** @var array $reportLanguage */
                /** @noinspection PhpIncludeInspection */
                include_once __DIR__ . '/Templates/' . $request->getData('id') . '/' . $request->getData('id') . '.lang.php';

                $pdfView = new \phpOMS\Views\View($this->app, $request, $response);
                $pdfView->addData('lang', $reportLanguage[$this->app->accountManager->get($request->getAccount())->getL11n()->getLanguage()]);
                $pdfView->setTemplate('/Modules/Reporter/Templates/' . $request->getData('id') . '/' . $request->getData('id') . '.' . $request->getData('type'));
                $response->set('GLOBAL', $pdfView->render());
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
                $reportList = new \phpOMS\Views\View($this->app, $request, $response);
                $reportList->setTemplate('/Modules/Reporter/Theme/reporter/reporter-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $reportList->addData('nav', $navigation->nav);
                echo $reportList->render();
        }
    }
}