<?php
namespace Modules\BackendDashboard;

/**
 * Dashboard class
 *
 * PHP Version 5.4
 *
 * @category   Base
 * @package    Framework
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
        if(isset($this->receiving)) {
            foreach($this->receiving as $mid) {
                /** @noinspection PhpUndefinedMethodInspection */
                \Framework\Module\ModuleFactory::$initialized[$mid]->show_dashboard();
            }
        } else {
            /** @noinspection PhpIncludeInspection */
            include __DIR__ . '/Theme/default.php';
        }
    }
}