<?php

namespace App\DAL\Business\Logistics;

class ShippingTable
{
    use TableTrait;

    protected $tableNames = array(
        'business_shippings',
    );

    public function getSqlSchema()
    {
        return "
DROP TABLE IF EXISTS `business_shippings`;
CREATE TABLE `business_shippings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `tracking_ref` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `activity` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `shipped` datetime NULL,
  `delivered` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ";
    }
}
