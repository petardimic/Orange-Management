<?php
namespace Modules\Media;

/**
 * Media class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Media
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
            case \Framework\Message\Http\WebRequestPage::API:
                $this->showAPI($request);
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
    private function showContentBackend($request)
    {
        switch($request->getData()['l3']) {
            case 'single':
                $media = new \Modules\Media\Models\Media($this->app->dbPool);
                $media->init($request->getData()['id']);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/media-single.tpl.php';
                break;
            case 'list':
                $mediaList = new \Framework\Views\ViewAbstract($this->app->user->getL11n());
                $mediaList->setTemplate('/Modules/Media/Theme/backend/media-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $mediaList->addData('nav', $navigation->nav);
                echo $mediaList->getResponse();
                break;
            case 'create':
                $mediaCreate = new \Framework\Views\ViewAbstract($this->app->user->getL11n());
                $mediaCreate->setTemplate('/Modules/Media/Theme/backend/media-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $mediaCreate->addData('nav', $navigation->nav);
                echo $mediaCreate->getResponse();
                break;
        }
    }

    private function showAPI($request)
    {
        switch($request->getRequestType()) {
            case \Framework\Message\RequestType::POST:
                $this->apiUpload($request);
                break;
            default:
                $this->app->response->addHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                $this->app->response->addHeader('Status', 'Status:406 Not acceptable');
                return;
        }
    }

    private function apiUpload($request)
    {
        $upload = new \Modules\Media\Models\Upload();
        $rndPath = str_pad(dechex(rand(0, 65535)), 4, '0', STR_PAD_LEFT);
        $upload->setOutputDir('/Modules/Media/Files/'.$rndPath[0].$rndPath[1].'/'.$rndPath[2].$rndPath[3]);
        $upload->setFileName(false);
        $status = $upload->upload($_FILES);
    }
}