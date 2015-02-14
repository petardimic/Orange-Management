<?php
namespace Modules\Budgeting;

/**
 * Budgeting controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Budgeting
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
     * @param \Framework\ApplicationAbstract $app Application reference
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * Get modules this module is providing for
     *
     * @return array Providing
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getProviding()
    {
        return self::$providing;
    }

    /**
     * Get dependencies for this module
     *
     * @return array Dependencies
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDependencies()
    {
        return self::$dependencies;
    }

    /**
     * {@inheritdoc}
     */
    public function call($type, $request, $response, $data = null)
    {
        switch($request->getType()) {
            case \Framework\Message\Http\WebRequestPage::BACKEND:
                $this->show_content_backend();
                break;
        }
    }

    public function show_content_backend()
    {
        switch($request->getData()['l3']) {
        }
    }
}