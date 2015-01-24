<?php
namespace Framework\Views;
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
    abstract class ViewAbstract
    {
        /**
         * Template
         *
         * @var string
         * @since 1.0.0
         */
        protected $template = null;

        /**
         * Views
         *
         * @var \Framework\Views\ViewAbstract[]
         * @since 1.0.0
         */
        protected $views = null;

        /**
         * Get the template
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getTemplate()
        {
            return $this->template;
        }

        /**
         * Set the template
         *
         * @param string $template
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setTemplate($template)
        {
            $this->template = $template;
        }

        /**
         * @return ViewAbstract[]
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getViews()
        {
            return $this->views;
        }

        /**
         * @param string $id View ID
         *
         * @return ViewAbstract
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getView($id)
        {
            return $this->views[$id];
        }

        /**
         * Remove view
         *
         * @param string $id View ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function removeView($id)
        {
            unset($this->views[$id]);
        }

        /**
         * @param string $id View ID
         *
         * @param ViewAbstract $view
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function addView($id, $view)
        {
            $this->views[$id] = $view;
        }

        /**
         * Get view/template response
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getResponse()
        {
            ob_start();
            /** @noinspection PhpIncludeInspection */
            include __DIR__ . '/../'. $this->template;

            return ob_get_clean();
        }
    }
