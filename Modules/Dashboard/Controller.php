<?php
namespace Modules\Dashboard;

/**
 * Dashboard controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\BackendDashboard
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
    protected static $module = 'BackendDashboard';

    /**
     * Localization files
     *
     * @var string
     * @since 1.0.0
     */
    protected static $localization = [
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
        if(isset($this->receiving)) {
            foreach($this->receiving as $mid) {
                /** @noinspection PhpUndefinedMethodInspection */
                \phpOMS\Module\ModuleFactory::$initialized[$mid]->show_dashboard();
            }
        } else {
            /** @noinspection PhpIncludeInspection */
            include __DIR__ . '/Theme/default.php';
        }
    }
}