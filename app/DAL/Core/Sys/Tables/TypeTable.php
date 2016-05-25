<?php

namespace App\DAL\Core\Sys\Tables;

use App\DAL\AbstractTable;
use App\DAL\TableTrait;

class TypeTable extends AbstractTable
{
    use TableTrait;

    public function getSqlSchema()
    {
        return "
CREATE TABLE `core_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ";
    }
}
