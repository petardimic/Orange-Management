<?php
namespace Web\Views {
    /**
     * List view
     *
     * PHP Version 5.4
     *
     * @category   Theme
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class ListView extends \Framework\Views\ViewAbstract
    {
        /**
         * List title
         *
         * @var string
         * @since 1.0.0
         */
        private $title = null;

        /**
         * Navigation
         *
         * @var array
         * @since 1.0.0
         */
        private $navigation = [];

        /**
         * Pagination
         *
         * @var \Web\Views\PaginationView
         * @since 1.0.0
         */
        private $pagination = null;

        /**
         * Header
         *
         * @var array
         * @since 1.0.0
         */
        private $header = null;

        /**
         * List elements
         *
         * @var array
         * @since 1.0.0
         */
        private $elements = null;

        /**
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * @param string $title
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setTitle($title)
        {
            $this->title = $title;
        }

        /**
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getNavigation()
        {
            return $this->navigation;
        }

        /**
         * @param array $navigation
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setNavigation($navigation)
        {
            $this->navigation = $navigation;
        }

        /**
         * @return PaginationView
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getPagination()
        {
            return $this->pagination;
        }

        /**
         * @param PaginationView $pagination
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setPagination($pagination)
        {
            $this->pagination = $pagination;
        }

        /**
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getHeader()
        {
            return $this->header;
        }

        /**
         * @param array $header
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setHeader($header)
        {
            $this->header = $header;
        }

        /**
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getElements()
        {
            return $this->elements;
        }

        /**
         * @param array $elements
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setElements($elements)
        {
            $this->elements = $elements;
        }
    }
}
