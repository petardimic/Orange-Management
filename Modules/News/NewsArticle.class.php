<?php
namespace Modules\News {
    abstract class NewsType extends \Framework\Datatypes\Enum {
        const NEWS     = 0;
        const LINK     = 1;
        const HEADLINE = 2;
    }

    /**
     * News article class
     *
     * PHP Version 5.4
     *
     * @category   Module
     * @package    OMS Core
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class NewsArticle implements \Framework\Pattern\Multition, \Framework\DataStorage\Database\Objects\ObjectInterface {
        /**
         * Article ID
         *
         * @var int
         * @since 1.0.0
         */
        public $id = null;

        /**
         * Author
         *
         * @var \Framework\DataStorage\Database\Objects\User\User
         * @since 1.0.0
         */
        public $author = null;

        /**
         * Created date
         *
         * @var \Datetime
         * @since 1.0.0
         */
        public $created = null;

        /**
         * Published date
         *
         * @var \Datetime
         * @since 1.0.0
         */
        public $publish = null;

        /**
         * Last editor
         *
         * @var \Framework\DataStorage\Database\Objects\User\User
         * @since 1.0.0
         */
        public $last_editor = null;

        /**
         * Last time edited
         *
         * @var \Datetime
         * @since 1.0.0
         */
        public $last_edited = null;

        /**
         * Is featured
         *
         * @var boolean
         * @since 1.0.0
         */
        public $featured = false;

        /**
         * Category of the article
         *
         * @var int
         * @since 1.0.0
         */
        public $category = null;

        /**
         * Groups that can see this article
         *
         * @var \Framewrok\DataStorage\Database\Objects\Group\Group[]
         * @since 1.0.0
         */
        public $groups = [];

        /**
         * Article title
         *
         * @var string
         * @since 1.0.0
         */
        public $title = null;

        /**
         * Article content
         *
         * @var string
         * @since 1.0.0
         */
        public $content = null;

        /**
         * Cache
         *
         * @var \Framework\DataStorage\Cache\Cache
         * @since 1.0.0
         */
        private $cache = null;

        /**
         * Instances
         *
         * @var \Modules\News\NewsArticle[]
         * @since 1.0.0
         */
        protected static $instances = [];

        /**
         * Constructor
         *
         * @param int $id Article ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($id) {
            $this->id    = $id;
            $this->db    = \Framework\DataStorage\Database\Database::getInstance();
            $this->cache = \Framework\DataStorage\Cache\Cache::getInstance();
        }

        /**
         * Returns instance
         *
         * @param int $id Article ID
         *
         * @return \Modules\News\NewsArticle
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($id) {
            if (!isset(self::$instances[$id])) {
                self::$instances[$id] = new self($id);
            }

            return self::$instances[$id];
        }

        /**
         * Protect instance from getting copied from outside
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        protected function __clone() {
        }

        public function serialize() {
        }

        public function unserialize($serialized) {
        }

        public function create() {
        }

        public function edit() {}

        public function delete() {
        }
    }
}
