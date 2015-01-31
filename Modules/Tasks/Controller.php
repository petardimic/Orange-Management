<?php
namespace Modules\Tasks;

/**
 * Task class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Tasks
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Controller extends \Framework\Module\ModuleAbstract implements \Framework\Module\WebInterface
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
     * @param \Framework\WebApplication $app Application reference
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * Shows module content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function callWeb()
    {
        switch($this->app->request->getType()) {
            case \Framework\Message\Http\WebRequestPage::BACKEND:
                $this->showContentBackend();
                break;
        }
    }

    /**
     * Shows module content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackend()
    {
        switch($this->app->request->getData()['l3']) {
            case 'dashboard':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $tasks = new \Modules\Tasks\Models\TaskList($this->app->dbPool);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/task-dashboard.tpl.php';
                break;
            case 'single':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $task = new \Modules\Tasks\Models\Task($this->app->dbPool);
                $task->init($this->app->request->getData()['id']);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/task-single.tpl.php';
                break;
            case 'create':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/task-create.tpl.php';
                break;
            case 'analysis':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/task-analysis.tpl.php';
                break;
        }
    }
}