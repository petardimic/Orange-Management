<?php

namespace phpOMS\DataStorage\Database;

abstract class Grammar {
    protected $tablePrefix = '';

    public function getDateFormat() {
        return 'Y-m-d H:i:s';
    }

    public function getTablePrefix() {
        return $this->prefix;
    }

    public function setTablePrefix($prefix) {
        $this->prefix = $prefix;
    }
}
