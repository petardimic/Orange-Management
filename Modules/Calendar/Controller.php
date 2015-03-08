<?php
namespace Modules\Calendar;

/**
 * Calendar controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Calendar
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
                $this->showBackendContent($request);
                break;
        }
    }

    public function showBackendContent($request)
    {
        switch($request->getData()['l3']) {
            case 'dashboard':
                $calendarView = new \phpOMS\Views\ViewAbstract($this->app->user->getL11n(), $this->app);
                $calendarView->setTemplate('/Modules/Calendar/Theme/backend/calendar-dashboard');

                echo $calendarView->getOutput();
                break;
        }
    }
}