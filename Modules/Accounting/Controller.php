<?php
namespace Modules\Accounting;

/**
 * Accounting class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Framework
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
        'Media'
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
        switch($request->getData()['l3']) {
            case 'creditor':
                $this->showBackendCreditor($request, $response);
                break;
            case 'debitor':
                $this->showBackendDebitor($request, $response);
                break;
            case 'account':
                $this->showBackendAccount($request, $response);
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
    public function showBackendAccount($request, $response)
    {
        switch($request->getData()['l4']) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $accountList = new \Modules\Accounting\Models\AccountList($this->app->dbPool);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/account-list.tpl.php';
                break;
            case 'postings':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/account-postings.tpl.php';
                break;
            case 'balance':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/account-balance.tpl.php';
                break;
            case 'single':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/account-single.tpl.php';
                break;
            case 'create':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/account-create.tpl.php';
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
    public function showBackendCreditor($request, $response)
    {
        switch($request->getData()['l4']) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $creditorList = new \Modules\Accounting\Models\CreditorList($this->app->dbPool);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/creditor-list.tpl.php';
                break;
            case 'single':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/creditor-single.tpl.php';
                break;
            case 'create':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/creditor-create.tpl.php';
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
    public function showBackendDebitor($request, $response)
    {
        switch($request->getData()['l4']) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $debitorList = new \Modules\Accounting\Models\DebitorList($this->app->dbPool);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/debitor-list.tpl.php';
                break;
            case 'single':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/debitor-single.tpl.php';
                break;
            case 'create':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/debitor-create.tpl.php';
                break;
        }
    }
}