<?php
namespace Module\Admin {
	abstract class Version extends \Framework\Datatypes\Enum {
		const VER_FRAMEWORK = '1.0.0';
		const VER_DB = '1.0.0';
		const VER_DB_MYSQL = '5.0.27';
		const VER_DB_SQLITE = '3.0.0';
		const VER_PHP = '5.4.0';
		const VER_FONTAWESOME = '4.1.0';
		const VER_DTHREE = '3.4.11';
		const VER_JQUERY = '2.1.1';
		const VER_BOOTSTRAP = '3.2.0';
	}
}