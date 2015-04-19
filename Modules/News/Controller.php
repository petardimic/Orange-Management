<?php
namespace Modules\News;

/**
 * News controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\News
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
    protected static $module = 'News';

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
    public function showContentBackend($request, $response)
    {
        switch($request->getData()['l3']) {
            case 'dashboard':
                $newsDashboard = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $newsDashboard->setTemplate('/Modules/News/Theme/backend/news-dashboard');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $newsDashboard->addData('nav', $navigation->nav);
                echo $newsDashboard->getOutput();
                break;
            case 'single':
                $article = new \Modules\News\Models\Article($this->app->dbPool);
                $article->init($request->getData()['id']);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/news-single.tpl.php';
                break;
            case 'archive':
                $newArchive = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $newArchive->setTemplate('/Modules/News/Theme/backend/news-archive');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $newArchive->addData('nav', $navigation->nav);
                echo $newArchive->getOutput();
                break;
            case 'create':
                $newsCreate = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $newsCreate->setTemplate('/Modules/News/Theme/backend/news-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $newsCreate->addData('nav', $navigation->nav);
                echo $newsCreate->getOutput();
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
    public function showAPI($request, $response)
    {
        switch($request->getRequestDestination()) {
            case \phpOMS\Message\RequestMethod::POST:
                $newsOBJ = new \Modules\News\Models\NewsArticle($this->app->dbPool);
                $newsOBJ->setAuthor($request->getData()['author']);
                $newsOBJ->setCreated(new \DateTime('now'));
                $newsOBJ->setPublish(new \DateTime($request->getData()['publish']));
                $newsOBJ->setTitle($request->getData()['title']);
                $newsOBJ->setContent($request->getData()['content']);
                $newsOBJ->setLang($request->getData()['language']);
                $newsOBJ->setType($request->getData()['type']);
                $created = $newsOBJ->create();

                $response->get('GLOBAL')->add($request->__toString(), $created);
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                $response->setHeader('Status', 'Status:406 Not acceptable');

                return;
        }
    }
}