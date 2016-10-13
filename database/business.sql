-- store

DROP TABLE IF EXISTS `business_customer_profiles`;
CREATE TABLE `business_customer_profiles` (
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `business_seller_pf_profiles`;
CREATE TABLE `business_seller_pf_profiles` (
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `business_seller_pj_profiles`;
CREATE TABLE `business_seller_pj_profiles` (
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*  */
DROP TABLE IF EXISTS `business_projects`;
CREATE TABLE `business_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` TINYBLOB NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  PRIMARY KEY (`id`),
  UNIQUE(`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* each task of the project */
DROP TABLE IF EXISTS `business_tickets`;
CREATE TABLE `business_tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `responsible_id` int(10) unsigned DEFAULT NULL,
  `customer_id` int(10) unsigned DEFAULT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `problem_url` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` BLOB NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 2, /* 0 = deleted, 1 = unassigned, 2 = open, 3 = active, 4 = closed, 5 = charged */
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* tracks worked hours */
DROP TABLE IF EXISTS `business_time_tracking`;
CREATE TABLE `business_time_tracking` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) unsigned NOT NULL,
  `start` datetime NOT NULL,
  `stop` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* */
DROP TABLE IF EXISTS `business_shops`;
CREATE TABLE `business_shops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL,
  `seller_id` int(10) unsigned NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` TINYBLOB NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 2, /* 0 = deleted, 1 = unassigned, 2 = open, 3 = active, 4 = closed, 5 = charged */
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
stock and properties
product specific properties are stored in metadata or in product_info table as needed
 */
DROP TABLE IF EXISTS `business_products`;
CREATE TABLE `business_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL,
  `shop_id` int(10) unsigned NOT NULL,
  `in_stock` int(10) unsigned NOT NULL DEFAULT 0,
  `price` decimal(10,2) unsigned NOT NULL,
  `weight` decimal(10,2) unsigned DEFAULT NULL,
  `height` decimal(10,2) unsigned DEFAULT NULL,
  `width` decimal(10,2) unsigned DEFAULT NULL,
  `depth` decimal(10,2) unsigned DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 2, /* 0 = deleted, 1 = unassigned, 2 = open, 3 = active, 4 = closed, 5 = charged */
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
save cart if user is logged in
 */
DROP TABLE IF EXISTS `business_carts`;
CREATE TABLE `business_carts` (
<<<<<<< HEAD
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
=======
>>>>>>> develop
  `customer_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*
how much the work is worth
 */
DROP TABLE IF EXISTS `business_invoices`;
CREATE TABLE `business_invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
<<<<<<< HEAD
  `hours` DECIMAL(10,2) unsigned NOT NULL,
  `rate` DECIMAL(10,2) NOT NULL,
  `total` DECIMAL(10,2) NOT NULL,
=======
  `amount` DECIMAL(10,2) NOT NULL,
>>>>>>> develop
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 2, /* 0 = deleted, 1 = unassigned, 2 = open, 3 = active, 4 = closed, 5 = charged */
  `created` datetime NOT NULL,
  `paid` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
track orders
 */
DROP TABLE IF EXISTS `business_orders`;
CREATE TABLE `business_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `seller_id` int(10) unsigned NOT NULL,
  `invoice_id` int(10) unsigned DEFAULT NULL,
  `payment_method` int(10) unsigned NOT NULL,
  `shipping_method` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `taxes` int(10) unsigned NOT NULL,
  `extra_cost` int(10) unsigned NOT NULL
  `closed` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
-- Polymorphic
relationship orders, stores and product
 */
DROP TABLE IF EXISTS `business_orderables`;
CREATE TABLE `business_orderables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `orderable_type` varchar(100) NOT NULL,
  `orderable_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `unit_price` int(10) unsigned NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* track payments */
DROP TABLE IF EXISTS `business_payments`;
CREATE TABLE `business_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `amount` decimal(10,2) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* */
DROP TABLE IF EXISTS `business_shippings`;
CREATE TABLE `business_shippings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `cost` decimal(10,2) unsigned NOT NULL,
  `tracking_ref` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `activity` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `shipped` datetime NULL,
  `delivered` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* */
DROP TABLE IF EXISTS `business_storages`;
CREATE TABLE `business_storages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` TINYBLOB NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
<<<<<<< HEAD

/*--many2many*/
DROP TABLE IF EXISTS `business_storages_products`;
CREATE TABLE `business_storages_products` (
  `storage_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `tracking_ref` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
=======
>>>>>>> develop
