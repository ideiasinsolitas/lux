<?php

namespace App\DAL\Business\Logistics;

class StorageTable
{
    use TableTrait;

    protected $tableNames = array(
        'business_storages',
        'business_storages_products'
    );

    public function getSqlSchema()
    {
        return "
DROP TABLE IF EXISTS `business_storages`;
CREATE TABLE `business_storages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` TINYBLOB NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `business_storages_products`;
CREATE TABLE `business_storages_products` (
  `storage_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `tracking_ref` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ";
    }
}
