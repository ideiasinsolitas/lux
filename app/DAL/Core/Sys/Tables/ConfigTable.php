<?php

namespace App\Models\Core\Sys\Tables;

use App\Models\Core\Sys\AbstractTable;
use App\Models\Core\Sys\TableTrait;

class ConfigTable extends AbstractTable
{
    use TableTrait;

    protected $tableNames = array('core_config');

    public function getSqlSchema()
    {
        return "
CREATE TABLE `core_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT 0,
  `key` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `value` BLOB NOT NULL,
  `format` tinyint(1) unsigned NOT NULL DEFAULT 0, -- 0 = string, 1 = serialized, 2 = json
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 2, -- 0 = active, 1 = autoload, 
  PRIMARY KEY (`id`),
  UNIQUE(`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ";
    }
}
