<?php
namespace Modules\News {
    abstract class NewsType extends \Framework\Base\Enum {
        const NEWS = 0;
        const LINK = 1;
        const HEADLINE = 2;
    }

    class NewsArticle implements \Framework\Core\Database\ObjectInterface {
        public $id = null;
        public $author = null;
        public $created = null;
        public $publish = null;
        public $last_editor = null;
        public $last_edited = null;

        public $featured = false;
        public $category = null;
        public $groups = [];
        public $title = null;
        public $content = null;

        public function serialize() {}
        public function unserialize($serialized) {}

        public function create() {}
        public function delete() {}
    }
}