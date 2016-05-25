<?php

namespace App\DAL\Core\Sys\Tables;

use App\DAL\AbstractTable;
use App\DAL\TableTrait;

class TokenTable extends AbstractTable
{
    use TableTrait;

    public function getSqlSchema()
    {
        return "
CREATE TABLE `core_tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `token` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `used` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ";
    }
}
