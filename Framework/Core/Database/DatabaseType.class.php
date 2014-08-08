<?php
namespace Framework\Core\Database {
    abstract class DatabaseType extends \Framework\Base\Enum {
        const MYSQL = 0;
        const SQLITE = 1;
    }
}