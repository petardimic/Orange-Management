<?php
namespace Framework\Utils\RnG {
    class DateTime {
        public static function generateRandomDate($start, $end) {
            $startDate = strtotime($start);
            $endDate = strtotime($end);

            return new \DateTime(date('Y-m-d H:i:s', rand($startDate, $endDate)));
        }
    }
}