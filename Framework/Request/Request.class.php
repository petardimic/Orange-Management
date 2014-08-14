<?php
namespace Framework\Request {
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
    class Request {
        /**
         * URL
         *
         * @var string[]
         * @since 1.0.0
         */
        public $uri = [
            'l0' => '',
            'l1' => '',
            'l2' => '',
            'l3' => '',
            'l4' => '',
            'l5' => '',
            'l6' => '',
            'l7' => '',
        ];

        public $type = null;

        /**
         * Post data
         *
         * @var string[]
         * @since 1.0.0
         */
        public $post = null;

        /**
         * Put data
         *
         * @var string[]
         * @since 1.0.0
         */
        public $put = null;

        /**
         * URL hash
         *
         * @var string[]
         * @since 1.0.0
         */
        public $uri_hash = null;

        public $request_type = null;

        /**
         * Request localization
         *
         * @var string
         * @since 1.0.0
         */
        public $request_lang = null;

        /**
         * Constructor
         *
         * @param array $f_url Forced URL
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($f_url = null) {
            $this->type = $_SERVER['REQUEST_METHOD'];

            if ($f_url == null) {
                $data      = ($this->type !== RequestType::GET ? json_decode(file_get_contents('php://input'), true) : $_GET);
                $this->uri = $data + $this->uri;
            } else {
                $this->uri = $f_url + $this->uri;
            }

            /* TODO: is this required?
            foreach ($this->uri as &$val) {
                $val = $this->clean($val);
            }
            unset($val);*/
            //</editor-fold>

            $this->request_lang = (!empty($this->uri['l0']) ? $this->uri['l0'] : 'en');
            $this->request_type = (!empty($this->uri['l1']) ? $this->uri['l1'] : 'website');

            $this->uri_hash = [
                $this->generate_uri_hash([$this->uri['l1']]),
                $this->generate_uri_hash([$this->uri['l1'], $this->uri['l2']]),
                $this->generate_uri_hash([$this->uri['l1'], $this->uri['l2'], $this->uri['l3']]),
                $this->generate_uri_hash([$this->uri['l1'], $this->uri['l2'], $this->uri['l3'], $this->uri['l4']]),
                $this->generate_uri_hash([$this->uri['l1'], $this->uri['l2'], $this->uri['l3'], $this->uri['l4'], $this->uri['l5']]),
            ];
        }

        /**
         * Cleaning variable
         *
         * @param string $val Variable to clean
         *
         * @return string clean value
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function clean($val) {
            return trim(htmlentities($val, ENT_QUOTES, 'UTF-8'));
        }

        /**
         * Generate URL hash
         *
         * @param array $url URL array
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function generate_uri_hash($url) {
            return sha1(implode('', $url));
        }

        /**
         * Generates a URL based on parameters
         *
         * @param array $paras URL parameters for page level.
         *                     Maximum of levels are 5.
         * @param array $query URL parameters for functionality.
         *                     Will be added at the end of the levels.
         *                     Maximum of levels are 23.
         *
         * @return string URL
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public static function generate_uri($paras, $query = null) {
            $uri = '/' . rtrim(implode('/', $paras), '/') . '.php';

            if (isset($query)) {
                $i = 0;
                foreach ($query as $para) {
                    if ($i == 0) {
                        $uri .= '?' . $para[0] . '=' . $para[1];
                        $i++;
                        continue;
                    }

                    $uri .= '&' . $para[0] . '=' . $para[1];
                }
            }

            return $uri;
        }
    }
}
