<?php
namespace Framework\Version {
    class Version {
        private function __construct() {
        }

        public static function compare($ver1, $ver2) {
            $split1 = explode('.', $ver1);
            $split2 = explode('.', $ver2);

            if (count($split1) > count($split2)) {
                return 1;
            } elseif (count($split1) < count($split2)) {
                return -1;
            }

            foreach ($split1 as $key => $val) {
                if ($val > $split2[$key]) {
                    return 1;
                } elseif ($val < $split2[$key]) {
                    return -1;
                }
            }

            return 0;
        }
    }
}