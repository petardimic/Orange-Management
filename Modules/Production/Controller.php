<?php
namespace Modules\Production;

/**
 * Production controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Production
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
            case 'process':
                $this->showBackendProcess($request);
                break;
            case 'guideline':
                $this->showBackendGuideline($request);
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
    public function showBackendProcess($request)
    {
        switch($request->getPath(4)) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $pList = new \Modules\Production\Models\ProductionList($this->app->dbPool);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/process-list.tpl.php';
                break;
            case 'single':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/process-single.tpl.php';
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
    public function showBackendGuideline($request)
    {
        switch($request->getPath(4)) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $pList = new \Modules\Production\Models\ProductionList($this->app->dbPool);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/guideline-list.tpl.php';
                break;
            case 'single':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/guideline-single.tpl.php';
                break;
        }
    }
}