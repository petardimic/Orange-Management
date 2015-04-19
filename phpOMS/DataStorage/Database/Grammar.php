<?php

namespace phpOMS\DataStorage\Database;

abstract class Grammar
{

// region Class Fields
    protected $tablePrefix = '';
// endregion

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }

    public function getTablePrefix()
    {
        return $this->tablePrefix;
    }

    public function setTablePrefix($prefix)
    {
        $this->tablePrefix = $prefix;
    }
}
