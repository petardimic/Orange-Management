<?php
namespace Modules\Sales;

/**
 * Sales class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Sales
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
        'Warehousing'
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
                $this->showContentBackend($request);
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
    public function showContentBackend($request)
    {
        switch($request->getPath(3)) {
            case 'client':
                $this->showBackendClient($request);
                break;
            case 'invoice':
                $this->showBackendInvoice($request);
                break;
            case 'article':
                $this->showBackendArticle($request);
                break;
            case 'analysis':
                $this->showBackendAnalysis($request);
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
    public function showBackendClient($request)
    {
        switch($request->getPath(4)) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $clientList = new \Modules\Sales\Models\ClientList($this->app->dbPool);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/clients-list.tpl.php';
                break;
            case 'single':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/clients-single.tpl.php';
                break;
            case 'create':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/clients-create.tpl.php';
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
    public function showBackendInvoice($request)
    {
        switch($request->getPath(4)) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $invoiceList = new \Modules\Sales\Models\InvoiceList($this->app->dbPool);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/invoice-list.tpl.php';
                break;
            case 'single':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/invoice-single.tpl.php';
                break;
            case 'create':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/invoice-create.tpl.php';
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
    public function showBackendArticle($request)
    {
        switch($request->getPath(4)) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $articleList = new \Modules\Sales\Models\ArticleList($this->app->dbPool);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/article-list.tpl.php';
                break;
            case 'single':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/article-single.tpl.php';
                break;
            case 'create':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/article-create.tpl.php';
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
    public function showBackendAnalysis($request)
    {
        switch($request->getPath(4)) {
            case 'dashboard':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/analysis-dashboard.tpl.php';
                break;
        }
    }
}