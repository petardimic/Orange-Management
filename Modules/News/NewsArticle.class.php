<?php
namespace Modules\News {
    abstract class NewsType extends \Framework\Base\Enum {
        const NEWS = 0;
        const LINK = 1;
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
    class NewsArticle implements \Framework\Core\Database\ObjectInterface {
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
         * @var \Framewrok\Core\User
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
         * @var \Framewrok\Core\User
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
         * @var \Framework\Core\Group[]
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

        public function serialize() {}
        public function unserialize($serialized) {}

        public function create() {}
        public function delete() {}
    }
}