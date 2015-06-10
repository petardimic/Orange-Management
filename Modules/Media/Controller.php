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

// region Class Fields
    /**
     * Module name
     *
     * @var string
     * @since 1.0.0
     */
    protected static $module = 'Media';

    /**
     * Localization files
     *
     * @var string
     * @since 1.0.0
     */
    protected static $localization = [
        \phpOMS\Message\RequestDestination::BACKEND => 'backend',
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
    public function call($request, $response, $data = null)
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
        switch($request->getPath(3)) {
            case 'single':
                $media = new \Modules\Media\Models\Media($this->app->dbPool);
                $media->init($request->getData('id'));

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/media-single.tpl.php';
                break;
            case 'list':
                $mediaList = new \phpOMS\Views\View($this->app, $request, $response);
                $mediaList->setTemplate('/Modules/Media/Theme/backend/media-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $mediaList->addData('nav', $navigation->nav);
                echo $mediaList->render();
                break;
            case 'create':
                $mediaCreate = new \phpOMS\Views\View($this->app, $request, $response);
                $mediaCreate->setTemplate('/Modules/Media/Theme/backend/media-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $mediaCreate->addData('nav', $navigation->nav);
                echo $mediaCreate->render();
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
        switch($request->getMethod()) {
            case \phpOMS\Message\RequestMethod::POST:
                $this->apiUpload($request, $response);
                break;
            case \phpOMS\Message\RequestMethod::GET:
                $this->apiShow($request, $response);
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
    private function apiShow($request, $response)
    {
        if($request->getPath(3) === 'download') {
            // TODO: check permissions + load data from database + if request = virtual directory -> zip all files and download + cache zip

            $file = $_GET["file"] . ".pdf";
            $response->setHeader('Content-Disposition', 'Content-Disposition: attachment; filename=' . urlencode($file));
            $response->setHeader('Content-Type', 'Content-Type: application/octet-stream');
            $response->setHeader('Content-Description', 'Content-Description: File Transfer');
            $response->setHeader('Content-Length', 'Content-Length: ' . filesize($file));

            $fp = fopen($file, "r");
            while(!feof($fp)) {
                echo fread($fp, 65536);
                flush();
            }
            fclose($fp);
        } else {
            // TODO: check permissions + load data from database

            switch($extension) {
                case 'jpeg':
                case 'png':
                case 'bmp':
                case 'tiff':
                case 'gif':
                    $response->setHeader('Content-Type', 'Content-Type: image/' . $extension);
                    break;
                case 'jpg':
                    $response->setHeader('Content-Type', 'Content-Type: image/jpeg');
                    break;
                case 'svg':
                    $response->setHeader('Content-Type', 'Content-Type: image/svg+xml');
                    break;
                case 'pdf':
                    $response->setHeader('Content-Type', 'Content-Type: application/pdf');
                    break;
                case 'txt':
                case 'csv':
                case 'css':
                case 'xml':
                case 'html':
                    $response->setHeader('Content-Type', 'Content-Type: text/' . $extension);
                    break;
                case 'htm':
                    $response->setHeader('Content-Type', 'Content-Type: text/html');
                    break;
                case 'md':
                    $response->setHeader('Content-Type', 'Content-Type: text/markdown');
                    break;
                case 'json':
                    $response->setHeader('Content-Type', 'Content-Type: application/json');
                    break;
                case 'js':
                    $response->setHeader('Content-Type', 'Content-Type: application/javascript');
                    break;
                case 'avi':
                case 'mpeg':
                case 'mp4':
                case 'ogg':
                    $response->setHeader('Content-Type', 'Content-Type: video/' . $extension);
                    break;
                case 'mp3':
                    $response->setHeader('Content-Type', 'Content-Type: audio/' . $extension);
                    break;
                default:
                    $response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                    $response->setHeader('Status', 'Status:406 Not acceptable');
                    return;
            }

            $response->setHeader('Content-Length', 'Content-Length: ' . filesize($file));
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

        if($status['success'] === \Modules\Media\Models\UploadStatus::OK) {
            $media = new \Modules\Media\Models\Media($this->app->dbPool->get());
            /* TODO: fill data */
            $media->insert();
        }
    }
}