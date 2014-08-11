<?php
/* WARNING: EXPERIMENTAL */
namespace Framework\Base {
    class Table {
        public function __construct() {}

        public function set_table() {}

        public function set_header($header) {}

        public function set_table_data($data) {}

        public function add_header($header) {}

        public function remove_header($header) {}

        public function add_dataset($header, $data) {}

        public function remove_dataset($header) {}

        public function render_header() {}

        public function render_content() {}

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

        public function render_pagination() {}
    }
}
