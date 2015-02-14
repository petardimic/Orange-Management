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
     * {@inheritdoc}
     */
    public function call($type, $request, $response, $data = null)
    {
        switch($request->getType()) {
            case \Framework\Message\Http\WebRequestPage::BACKEND:
                $this->showContentBackend($request, $response);
                break;
            default:
                $response->addHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->addHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows module content
     *
     * @param \Framework\Message\RequestAbstract  $request  Request
     * @param \Framework\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackend($request, $response)
    {
        switch($request->getData()['l3']) {
            case 'dashboard':
                $newsDashboard = new \Framework\Views\ViewAbstract($this->app->user->getL11n());
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
                $newArchive = new \Framework\Views\ViewAbstract($this->app->user->getL11n());
                $newArchive->setTemplate('/Modules/News/Theme/backend/news-archive');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $newArchive->addData('nav', $navigation->nav);
                echo $newArchive->getOutput();
                break;
            case 'create':
                $newsCreate = new \Framework\Views\ViewAbstract($this->app->user->getL11n());
                $newsCreate->setTemplate('/Modules/News/Theme/backend/news-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $newsCreate->addData('nav', $navigation->nav);
                echo $newsCreate->getOutput();
                break;
            default:
                $response->addHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->addHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
        }
    }
}