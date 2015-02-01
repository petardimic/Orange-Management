<?php
namespace Modules\Surveys;

/**
 * Surveys controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Surveys
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
     * @para   array $data
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function call(\Framework\Module\CallType::WEB, )
    {
        switch($this->app->request->getType()) {
            case \Framework\Message\Http\WebRequestPage::BACKEND:
                $this->show_content_backend();
                break;
        }
    }

    public function show_content_backend()
    {
        switch($this->app->request->getData()['l3']) {
            case 'dashboard':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/surveys-dashboard.tpl.php';
                break;
            case 'create':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/surveys-create.tpl.php';
                break;
        }
    }
}