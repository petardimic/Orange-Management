<?php
namespace Modules\Content;

/**
 * Content controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Content
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
     * {@inheritdoc}
     */
    public function call($type, $request, $response, $data = null)
    {
        foreach($this->receiving as $mid) {
            /** @noinspection PhpUndefinedMethodInspection */
            \phpOMS\Module\ModuleFactory::$loaded[$mid]->call(\phpOMS\Module\CallType::WEB, $request, $response);
        }
    }
}