<?php
/* WARNING: EXPERIMENTAL AND NOT WORKING/IMPLEMENTED */
namespace Framework\HTML {
    class Table {
        public $header = [];
        public $dataset = [];

        public function __construct() {}

        public function set_table_data($data) {}

        public function add_header($header) {}

        public function remove_header($header) {}

        public function add_dataset($header, $data) {}

        public function remove_dataset($header) {}

        public function render_header() {
            foreach ($this->header as $head) {
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
        public function render_content() {
            $request = \Framework\Request\Request::getInstance();
            foreach ($data as $ele) {
                /* TODO handle 'no url' differently, this isn't nice */
                $url_t = ($url != null ? $request->generate_uri($url['level'], [['id', $ele[$url['id']]]]) : '#');

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

        /**
         * Generate pagination view
         *
         * @param int $count Amount of pages
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function render_pagination() {
            $request = \Framework\Request\Request::getInstance();
            $pages   = self::generate_pagination($request->uri['page'], $count);

            echo '<ul>';
            foreach ($pages as $page) {
                if ($page > 0) {
                    $url = $request->generate_uri($request->uri, [['page', $page]]);
                } else {
                    $url = '';
                }

                echo '<li><a href="' . $url
                    . '"' . ($page == $request->uri['page'] ? ' class="a"' : '') . '>'
                    . ($page < 0 ? '<i class="fa fa-ellipsis-h"></i>' : $page)
                    . '</a></li>';
            }
            echo '</ul>';
        }
    }
}
