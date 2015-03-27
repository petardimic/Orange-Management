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
     * @param \phpOMS\ApplicationAbstract $app Application instance
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
        switch($request->getRequestDestination()) {
            case \phpOMS\Message\RequestDestination::BACKEND:
                $this->showContentBackend($request, $response);
                break;
            case \phpOMS\Message\RequestDestination::API:
                $this->showAPI($request, $response);
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
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
    private function showContentBackend($request, $response)
    {
        switch($request->getData()['l3']) {
            case 'single':
                $media = new \Modules\Media\Models\Media($this->app->dbPool);
                $media->init($request->getData()['id']);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/media-single.tpl.php';
                break;
            case 'list':
                $mediaList = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $mediaList->setTemplate('/Modules/Media/Theme/backend/media-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $mediaList->addData('nav', $navigation->nav);
                echo $mediaList->getOutput();
                break;
            case 'create':
                $mediaCreate = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $mediaCreate->setTemplate('/Modules/Media/Theme/backend/media-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $mediaCreate->addData('nav', $navigation->nav);
                echo $mediaCreate->getOutput();
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows api content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function showAPI($request, $response)
    {
        switch($request->getRequestDestination()) {
            case \phpOMS\Message\RequestMethod::POST:
                $this->apiUpload($request, $response);
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                $response->setHeader('Status', 'Status:406 Not acceptable');

                return;
        }
    }

    /**
     * Shows api content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function apiUpload($request, $response)
    {
        $upload  = new \Modules\Media\Models\Upload();
        $rndPath = str_pad(dechex(rand(0, 65535)), 4, '0', STR_PAD_LEFT);
        $upload->setOutputDir('/Modules/Media/Files/' . $rndPath[0] . $rndPath[1] . '/' . $rndPath[2] . $rndPath[3]);
        $upload->setFileName(false);
        $status = $upload->upload($_FILES);
    }
}