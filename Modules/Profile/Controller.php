<?php
namespace Modules\Profile;

/**
 * Profile controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Profile
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
     * @param \Framework\ApplicationAbstract $app Application instance
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
    public function call($type, $request, $data = null)
    {
        switch($request->getType()) {
            case \Framework\Message\Http\WebRequestPage::BACKEND:
                $this->showContentBackend($request);
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \Framework\Message\RequestAbstract $request Request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackend($request)
    {
        switch($request->getData()['l3']) {
            case 'single':
                /** TODO: request navigation access in order to modify navigation. remove (temporary) settings link if not own profile */
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/profile-single.tpl.php';

                $this->callPull();
                break;
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $accounts = new \Modules\Profile\Models\ProfileList($this->app->dbPool);

                if(!isset($request->getData()['page'])) {
                    $request->getData()['page'] = 1;
                }

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/profile-list.tpl.php';
                break;
        }
    }
}