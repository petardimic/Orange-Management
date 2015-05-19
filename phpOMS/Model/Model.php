<?php
namespace phpOMS\Model;

// TODO: THIS IS COMPLETELY OUTDATED change it to current structure
/**
 * Model class
 *
 * Providing core page elements
 *
 * PHP Version 5.4
 *
 * @category   Model
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Model
{

// region Class Fields
    /**
     * Application instance
     *
     * @var \phpOMS\ApplicationAbstract
     * @since 1.0.0
     */
    public static $app = null;

    /**
     * Content
     *
     * @var array
     * @since 1.0.0
     */
    public static $content = [];

// endregion

    /**
     * Loading html header
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function load_header()
    {
        /* Everyone */
        echo '<title>' . self::$content['page:title'] . '</title>'
             . '<meta name="viewport" content="initial-scale=1.0,width=device-width,height=device-height,user-scalable=yes">'
             . '<meta charset="UTF-8">';

        /* TODO: Create page specific meta keyword tags maybe even create a meta tag class */
        self::$content['page:desc']     = '';
        self::$content['page:keywords'] = '';

        /* Everyone */
        echo '<meta name="application-name" content="' . self::$content['core:oname'] . '"/>'
             . '<meta name="description" content="' . self::$content['page:desc'] . '">'
             . '<meta name="keywords" content="' . self::$content['page:keywords'] . '">';

        /** @noinspection PhpUndefinedMethodInspection */
        $os = self::$app->request->getOS();

        /* OS specific */
        if($os === \phpOMS\Message\Http\OSType::WINDOWS_8 || $os === \phpOMS\Message\Http\OSType::WINDOWS_81) {
            echo '<meta name="msapplication-TileColor" content="#ffffff"/>'
                 . '<meta name="msapplication-square70x70logo" content="/Web/Theme/Startup/win_tiny.png"/>'
                 . '<meta name="msapplication-square150x150logo" content="/Web/Theme/Startup/win_square.png"/>'
                 . '<meta name="msapplication-wide310x150logo" content="/Web/Theme/Startup/win_wide.png"/>'
                 . '<meta name="msapplication-square310x310logo" content="/Web/Theme/Startup/win_large.png"/>';
        } elseif($os === \phpOMS\Message\Http\OSType::IPHONE || $os === \phpOMS\Message\Http\OSType::MAC_OS_X || $os === \phpOMS\Message\Http\OSType::MAC_OS_X_2 || $os === \phpOMS\Message\Http\OSType::IPAD) {
            echo '<link rel="apple-touch-icon" href="/Web/Theme/Startup/apple_icon.png">'
                 . '<link rel="apple-touch-startup-image" href="/Web/Theme/Startup/apple_startup.png">'
                 . '<meta name="apple-mobile-web-app-capable" content="yes">'
                 . '<meta name="apple-mobile-web-app-status-bar-style" content="black">';
        }

        /* Everyone */
        echo '<link rel="shortcut icon" href="/Web/Theme/Startup/favicon.ico">'
             . '<link rel="stylesheet" href="' . self::$content['page:addr:url'] . '/Web/Theme/' . self::$content['core:layout'] . '/css/' . self::$content['core:layout'] . '.css">'
             . '<link rel="stylesheet" href="' . self::$content['page:addr:url'] . '/External/fontawesome/css/font-awesome.min.css">'
             . '<script>var URL = "' . self::$content['page:addr:url'] . '";</script>'
             . '<script src="' . self::$content['page:addr:url'] . '/External/d3/d3.min.js"></script>'
             . '<script src="' . self::$content['page:addr:url'] . '/jsOMS/oms.min.js"></script>';

        ob_flush();
    }

    /**
     * Loading inline styles
     *
     * This only loads critical css styles, that are required to fool the user to believe the page got loaded
     * instantaneously.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function load_style_small()
    {
        /** @noinspection PhpIncludeInspection */
        include __DIR__ . '/../../Web/Theme/' . self::$content['core:layout'] . '/css/' . self::$content['core:layout'] . '-small.css';
    }

    /**
     * Loading html footer
     *
     * @todo   Load css and js of modules
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function load_footer()
    {
        echo '<script src="' . self::$content['page:addr:url'] . '/jsOMS/oms.min.js"></script>';

        //var_dump(self::$app->modules->running);

        //foreach(self::$app->modules->running as $key => $val) {
        //var_dump($val);
        //}

        ob_flush();
    }

    /**
     * Generate table filter view
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function generate_table_filter_view()
    {
        echo '<div class="b pop vh" id="t-f">
                    <h1>' . self::$app->user->getL11n()->lang[0]['Filter'] . '<span><i class="fa fa-times close"></i></span></h1>
                    <div class="bc-1">
                        <ul class="l-1">

                        </ul>
                        <div class="bt cT">
                            <button class="save">' . self::$app->user->getL11n()->lang[0]['Save'] . '</button>
                            <button class="close">' . self::$app->user->getL11n()->lang[0]['Close'] . '</button>
                        </div>
                    </div>
                </div>';
    }
}
