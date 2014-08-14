<?php
namespace Framework\Model {

    /**
     * Request class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Model {
        /**
         * Application instance
         *
         * @var \Framework\Application
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

        /**
         * Set content variables for this view
         *
         * @param $key
         * @param $value
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public static function set_content($pair) {
            foreach($pair as $key => $val) {
                self::$content[$key] = $val;
            }
        }

        /**
         * Loading html header
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function load_header() {
            echo '<title>' . self::$content['page:title'] . '</title>';
            echo '<meta name="viewport" content="initial-scale=1.0,width=device-width,height=device-height,user-scalable=yes">';

            /* TODO: Create page specific meta keyword tags */

            echo '<script>var URL = "' . self::$content['page:addr:url'] . '";</script>';

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
        public static function load_style_small() {
            /** @noinspection PhpIncludeInspection */
            include __DIR__ . '/../../Content/Themes' . self::$content['theme:path'] . '/css/' . self::$content['core:layout'] . '-small.css';
        }

        /**
         * Loading html footer
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function load_footer() {
            echo '<link rel="stylesheet" href="' . self::$content['page:addr:url'] . '/Content/themes' . self::$content['theme:path'] . '/css/' . self::$content['core:layout'] . '.css">';

            /* Load module stylesheet */
            /* TODO: Cache this as array for this page, just like for js */
            foreach (\Framework\Module\ModuleFactory::$initialized as $key => $val) {
                $class = get_class(\Framework\Module\ModuleFactory::$initialized[$key]);
                if ($class::$css) {
                    echo '<link rel="stylesheet" href="' . self::$content['page:addr:url'] . '/' . \Framework\Module\ModuleFactory::$initialized[$key]->theme_path . '/css/styles.css">';
                }
            }

            echo '<link rel="stylesheet" href="' . self::$content['page:addr:url'] . '/Framework/Libs/fonts/font-awesome/css/font-awesome.min.css">';

            echo '<script src="' . self::$content['page:addr:url'] . '/Framework/Libs/jquery/jquery.min.js"></script>';
            echo '<script src="' . self::$content['page:addr:url'] . '/Framework/JavaScript/oms.min.js"></script>';

            /* Load page javascript */
            echo '<script src="' . self::$content['page:addr:url'] . '/Content/themes' . self::$content['theme:path'] . '/js/' . self::$content['core:layout'] . '.js"></script>';

            /* Load module javascript */
            $jsArray = self::$app->cache->pull('js:' . self::$app->request->uri['l0']);


            if (!$jsArray) {
                /*
                foreach (ModuleFactory::$initialized as $val) {

                    if ($val->info['js']) {
                        $js = self::$content['page:addr:url'] . '/' . $val->info['name']['internal'] . '/module.js';
                        echo '<script src="' . $js . '"></script>';

                        if (self::$app->cache->active) {
                            $jsArray[] = $js;
                        }
                    }
                }*/

                self::$app->cache->push('js:' . self::$app->request->uri['l0'], $jsArray);
            } else {
                foreach ($jsArray as $val) {
                    echo '<script src="' . $val . '"></script>';
                }
            }

            ob_flush();
        }

        /**
         * Generates a filter for query
         *
         * @param int $current Current page
         * @param int $count   Amount of elements
         * @param int $limit   Amount of elements per page
         *
         * @return array Pagination array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public static function generate_pagination($current, $count, $limit = 100) {
            $pagination = [];

            $pages   = (int)\ceil($count / $limit);
            $space   = 2;
            $start   = ($current - $space > 0 ? $current - $space : 1);
            $end     = ($pages - $current - $space > 0 ? $current + $space : $pages);
            $p_space = ($current - $space - 1 > 0 ? true : false);
            $n_space = ($pages - $current - $space - 1 > 0 ? true : false);

            if ($p_space) {
                array_push($pagination, 1, -1);
            }

            for ($i = $start; $i <= $end; $i++) {
                $pagination[] = $i;
            }

            if ($n_space) {
                array_push($pagination, -2, $pages);
            }

            return $pagination;
        }

        /** [TABLE] ------------------------------------------------------ */
        /* TODO: MAYBE create a table module??? - don't think so but should keep this in mind - Table.class.php could be another solution. (sounds good!!) */

        /**
         * Generates table header view
         *
         * @param array $title Array of column heads
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public static function generate_table_header_view($title) {
            foreach ($title as $head) {
                echo '<td' . (isset($head['full']) ? ' class="full"' : '') . '>'
                    . '<span>' . $head['name'] . '</span>';

                if ($head['sort'] > -1) {
                    echo '<i class="fa fa-sort' . ($head['sort'] == 1 ? '' : ' vh') . '"></i>'
                        . '<i class="fa fa-caret-up' . ($head['sort'] == 2 ? '' : ' vh') . '"></i>'
                        . '<i class="fa fa-caret-down' . ($head['sort'] == 3 ? '' : ' vh') . '"></i>'
                        . '<i class="fa fa-times' . ($head['sort'] > 0 ? '' : ' vh') . '"></i>';
                }
                echo '</td>';
            }
        }

        /**
         * Generate table content view
         *
         * @param array $data    Date to visualize (associated)
         * @param array $cols    Name of the cols
         * @param array $url     URL used for the row elements
         * @param array $replace Replacements for values inside $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function generate_table_content_view($data, $cols, $url = null, $replace = null) {
            foreach ($data as $ele) {
                /* TODO handle 'no url' differently, this isn't nice */
                $url_t = ($url != null ? self::$app->request->generate_uri($url['level'], [['id', $ele[$url['id']]]]) : '#');

                /* TODO: Replace is to slow (most likely) */
                echo '<tr>';
                foreach ($cols as $col) {
                    if ($replace == null || !isset($replace[$col])) {
                        echo '<td><a href="' . $url_t . '">' . $ele[$col] . '</a></td>';
                    } elseif (isset($replace[$col])) {
                        echo '<td><a href="' . $url_t . '">' . (isset($replace[$col][$ele[$col]]) ? $replace[$col][$ele[$col]] : $ele[$col]) . '</a></td>';
                    }
                }
                echo '</tr>';
            }
        }

        /**
         * Generate pagination view
         *
         * @param int $count Amount of pages
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function generate_table_pagination_view($count) {
            $pages   = self::generate_pagination(self::$app->request->uri['page'], $count);

            echo '<ul>';
            foreach ($pages as $page) {
                if ($page > 0) {
                    $url = self::$app->request->generate_uri(self::$app->request->uri, [['page', $page]]);
                } else {
                    $url = '';
                }

                echo '<li><a href="' . $url
                    . '"' . ($page == self::$app->request->uri['page'] ? ' class="a"' : '') . '>'
                    . ($page < 0 ? '<i class="fa fa-ellipsis-h"></i>' : $page)
                    . '</a></li>';
            }
            echo '</ul>';
        }

        /**
         * Generate table filter view
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function generate_table_filter_view() {
            echo '<div class="b pop vh" id="t-f">
                    <h1>' . \Framework\Localization\Localization::$lang[0]['Filter'] . '<span><i class="fa fa-times close"></i></span></h1>
                    <div class="bc-1">
                        <ul class="l-1">

                        </ul>
                        <div class="bt cT">
                            <button class="save">' . \Framework\Localization\Localization::$lang[0]['Save'] . '</button>
                            <button class="close">' . \Framework\Localization\Localization::$lang[0]['Close'] . '</button>
                        </div>
                    </div>
                </div>';
        }
    }
}
