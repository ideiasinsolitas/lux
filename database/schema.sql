-- SYS
/*
Everything that has a type id points here
 */
DROP TABLE IF EXISTS `types`;
CREATE TABLE `core_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `types` (name, item_name) VALUES
("image", "resource"),
("document", "resource"),
("url", "resource"),
("embed", "resource"),
("work", "node"),
("book", "node"),
("page", "node"),
("article", "node"),
("album", "collection"),
("folder", "collection"),
("menu", "collection"),
("category", "term"),
("tag", "term"),
("vote", "term"),
("pagseguro", "payment"),
("boleto", "payment"),
("credito", "payment"),
("encomenda", "shipment"),
("sedex", "shipment"),
("sedex10", "shipment"),
("residence", "place"),
("public", "place"),
("business", "place"),
("apartment", "estate"),
("house", "estate"),
("office", "estate"),
("client", "project"),
("personal", "project"),
("feature", "ticket"),
("emergency", "ticket"),
("support", "ticket");

/*
App config with default values
 */
DROP TABLE IF EXISTS `config`;
CREATE TABLE `core_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `value` BLOB NOT NULL,
  `format` tinyint(1) unsigned NOT NULL DEFAULT 0, -- 0 = string, 1 = serialized, 2 = json, 3 = csv, 4 = xml, 5 = rss, 6 = atom
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = active, 1 = autoload, 2 = package specific, 3 = ...
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `config` (`key`, `value`, `activity`, `created`, `modified`) VALUES 
("site.title", "bla bla bla", 2, NOW(), NOW()),
("site.tagline", "bla bla bla bla bla", 2, NOW(), NOW()),
("system.email", "pedrokoblitz@gmail.com", 2, NOW(), NOW()),
("per.page", "12", 2, NOW(), NOW()),
("upload.dir", "/public/media", 2, NOW(), NOW()),
("app.web.root", "/", 2, NOW(), NOW()),
("app.abs.path", "/var/www/html/", 2, NOW(), NOW()),
("panel.log.quantity", "15", 2, NOW(), NOW()),
("panel.content.quantity", "10", 2, NOW(), NOW()),
("panel.collection.quantity", "5", 2, NOW(), NOW()),
("panel.resource.quantity", "5", 2, NOW(), NOW()),
("panel.term.quantity", "5", 2, NOW(), NOW()),
("facebook.app.id", "", 2, NOW(), NOW()),
("facebook.app.key", "", 2, NOW(), NOW()),
("facebook.app.secret", "", 2, NOW(), NOW()),
("twitter.app.id", "", 2, NOW(), NOW()),
("twitter.app.key", "", 2, NOW(), NOW()),
("twitter.app.secret", "", 2, NOW(), NOW()),
("flickr.profile.url", "http://flickr.com.br/photos/pedrokoblitz", 2, NOW(), NOW()),
("tumblr.profile.url", "http://pedrokoblitz.tumblr.com", 2, NOW(), NOW()),
("facebook.profile.url", "https://facebook.com/pedrokoblitz", 2, NOW(), NOW()),
("facebook.page.url", "https://facebook.com/ideiasinsolitas", 2, NOW(), NOW()),
("twitter.profile.url", "http://twitter.com/pedrokoblitz", 2, NOW(), NOW()),
("linkedin.profile.url", "http://br.linkedin.com/pedrokoblitz", 2, NOW(), NOW()),
("pinterest.profile.url", "http://pinterest.com/pedrokoblitz", 2, NOW(), NOW());

-- END SYS

-- BEGIN USERS
/*
user management
 */
DROP TABLE IF EXISTS `users`;
CREATE TABLE `core_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = inactive, 1 = active
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`username`),
  UNIQUE(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`,`username`,`email`,`first_name`,`last_name`,`display_name`,`password`,`activity`,`created`,`modified`) VALUES
(1, 'pedrokoblitz', 'pedrokoblitz@gmail.com', 'Pedro', 'Koblitz', 'Pedro Koblitz', '', 1, NOW(), NOW());

/*
user owns entity
 */
DROP TABLE IF EXISTS `ownership`;
CREATE TABLE `core_ownership` (
  `user_id` int(10) unsigned NOT NULL,
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  UNIQUE(`item_name`, `item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*
user collaborates in entity
 */
DROP TABLE IF EXISTS `collaborations`;
CREATE TABLE `core_collaborations` (
  `user_id` int(10) unsigned NOT NULL,
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  UNIQUE(`user_id`, `item_name`, `item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*
user contact information
possible types: email, phone1, phone2, fax, cell
 */
DROP TABLE IF EXISTS `user_contacts`;
CREATE TABLE `core_user_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*
facebook info log
 */
DROP TABLE IF EXISTS `core_user_facebook_info`;
CREATE TABLE `core_user_facebook_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
user legally issued identification
rg, dnh, cpf, cnpj, inscricao estadual
 */
DROP TABLE IF EXISTS `core_user_identifications`;
CREATE TABLE `core_user_identifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*
authentication tokens
 */
DROP TABLE IF EXISTS `core_tokens`;
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
-- END USERS

-- USER INTERACTION
/*
user comments
 */
DROP TABLE IF EXISTS `core_comments`;
CREATE TABLE `core_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned DEFAULT NULL,
  `comment` BLOB NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
one2many relationship between comments and entities
enforced by unique key
 */
DROP TABLE IF EXISTS `core_commenting`;
CREATE TABLE `core_commenting` (
  `comment_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  UNIQUE(`comment_id`,`user_id`,`item_name`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
many2many relationships between user, term and other entities 
 */
DROP TABLE IF EXISTS `core_folksonomy`;
CREATE TABLE `core_folksonomy` (
  `term_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `usertaggable_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `usertaggable_id` int(10) unsigned DEFAULT NULL,
  UNIQUE(`term_id`,`user_id`,`item_name`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `folksonomy` (`term_id`, `user_id`, `item_name`, `item_id`) VALUES
(1, 1, '', 1);

-- END USER INTERACTION

-- BEGIN CONTENT
/*
store text based content for all entities and group by language
 */
DROP TABLE IF EXISTS `core_translations`;
CREATE TABLE `core_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(5) COLLATE utf8_unicode_ci DEFAULT "pt-br",
  `translatable_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `translatable_id` int(10) unsigned NOT NULL,
  `slug` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tagline` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `excerpt` TINYBLOB DEFAULT NULL,
  `description` BLOB DEFAULT NULL,
  `body` BLOB DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`language`,`item_name`,`item_id`),
  UNIQUE(`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- BEGIN ATTRIBUTES
/*
collection nodes
(album, folder)
 */
DROP TABLE IF EXISTS `core_collections`;
CREATE TABLE `core_collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- BEGIN ATTRIBUTES


/*
term
(tag, section, menu)
 */
DROP TABLE IF EXISTS `core_terms`;
CREATE TABLE `core_terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END ATTRIBUTES

-- BEGIN SITE BUILDING
/*
areas contain and ordered list of blocks
 */
DROP TABLE IF EXISTS `core_areas`;
CREATE TABLE `core_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = off, 1 = on
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `areas` (`id`, `name`, `activity`) VALUES ;

/*
blocks contain a dropdown with widgets?
 */
DROP TABLE IF EXISTS `core_blocks`;
CREATE TABLE `core_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blocks` (`id`, `name`, `area_id`) VALUES ;


-- END SITE BUILDING

/*
content nodes
(articles,pages)
 */
DROP TABLE IF EXISTS `publishing_nodes`;
CREATE TABLE `publishing_nodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `date_pub` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
resource nodes
(file, link, embed)
 */
DROP TABLE IF EXISTS `publishing_resources`;
CREATE TABLE `publishing_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `url` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filepath` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mimetype` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `embed` BLOB DEFAULT NULL,
  `width` int(10) unsigned DEFAULT NULL,
  `height` int(10) unsigned DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- END CONTENT

-- PROJECT MANAGEMENT
/*
project can be a site issue or a client
 */
DROP TABLE IF EXISTS `business_projects`;
CREATE TABLE `business_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `description` TINYBLOB NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `projects` (`id`, `title`, `description`, `activity`) VALUES ;


/*
each task of the project
 */
DROP TABLE IF EXISTS `business_tickets`;
CREATE TABLE `business_tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dev_id` int(10) unsigned DEFAULT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `problem_url` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` BLOB NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 2, /* 0 = deleted, 1 = unassigned, 2 = open, 3 = active, 4 = closed, 5 = charged */
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tickets` (`id`, `dev_id`, `project_id`, `problem_url`, `description`, `activity`, `created`, `modified`) VALUES ;

/*
tracks worked hours
 */
DROP TABLE IF EXISTS `business_time_tracking`;
CREATE TABLE `business_time_tracking` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) unsigned NOT NULL,
  `start` datetime NOT NULL,
  `stop` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ticket_time_tracking` (`id`, `ticket_id`, `start`, `stop`) VALUES ;


-- END PROJECT MANAGEMENT


-- CALENDAR
/*
each event
 */
DROP TABLE IF EXISTS `business_events`;
CREATE TABLE `business_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `events` (`id`, `place_id`, `start`, `end`) VALUES ;

-- END CALENDAR



-- E-COMMERCE
/*

 */
DROP TABLE IF EXISTS `business_shops`;
CREATE TABLE `business_shops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seller_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `stores` (`id`, `seller_id`) VALUES ;

/*
stock and properties
product specific properties are stored in metadata or in product_info table as needed
 */
DROP TABLE IF EXISTS `business_products`;
CREATE TABLE `business_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(10) unsigned NOT NULL,
  `in_stock` int(10) unsigned NOT NULL DEFAULT 0,
  `price` decimal(10,2) unsigned NOT NULL,
  `weigth` decimal(10,2) unsigned DEFAULT NULL,
  `height` decimal(10,2) unsigned DEFAULT NULL,
  `width` decimal(10,2) unsigned DEFAULT NULL,
  `depth` decimal(10,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
save cart if user is logged in
 */
DROP TABLE IF EXISTS `business_cart`;
CREATE TABLE `business_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `project_id` int(10) unsigned NOT NULL,
  `hours` DECIMAL(10,2) unsigned NOT NULL,
  `rate` DECIMAL(10,2) NOT NULL,
  `total` DECIMAL(10,2) NOT NULL,
  `activity` DECIMAL(10,2) NOT NULL DEFAULT 1, -- 0 = deleted, 1 = active, 2 = sent, 3 = contested, 4 = paid
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
track orders
 */
DROP TABLE IF EXISTS `business_orders`;
CREATE TABLE `business_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `payment_method_id` int(10) unsigned NOT NULL,
  `shipping_method_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
relationship orders, stores and product
 */
DROP TABLE IF EXISTS `business_order_items`;
CREATE TABLE `business_order_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
track payments
 */
DROP TABLE IF EXISTS `business_payments`;
CREATE TABLE `business_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `amount` decimal(10,2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
 */
DROP TABLE IF EXISTS `business_shippings`;
CREATE TABLE `business_shippings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `tracking_ref` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- REAL ESTATE
-- RADAR DO ALUGUEL
/*
apartamentos, casas, salas
 */
DROP TABLE IF EXISTS `business_estates`;
CREATE TABLE `business_estates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `area` int(10) unsigned NOT NULL DEFAULT 0,
  `rooms` int(10) unsigned NOT NULL DEFAULT 0,
  `suites` int(10) unsigned NOT NULL DEFAULT 0,
  `parking_spots` int(10) unsigned NOT NULL DEFAULT 0,
  `price` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `charges` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `taxes` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- END REAL ESTATE RADAR DO ALUGUEL

-- END E-COMMERCE

-- GEOLOCATION
/*
places can have same address
 */
DROP TABLE IF EXISTS `geo_places`;
CREATE TABLE `geo_places` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `address_line` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `address_id` int(10) unsigned DEFAULT NULL,
  `description` BLOB NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
adresses have coordinates
 */
DROP TABLE IF EXISTS `geo_addresses`;
CREATE TABLE `geo_addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `district_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `coordinate_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*

 */
DROP TABLE IF EXISTS `geo_districts`;
CREATE TABLE `geo_districts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*

 */
DROP TABLE IF EXISTS `geo_cities`;
CREATE TABLE `geo_cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `province_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*

 */
DROP TABLE IF EXISTS `geo_provinces`;
CREATE TABLE `geo_provinces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*

 */
DROP TABLE IF EXISTS `geo_countries`;
CREATE TABLE `geo_countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*

 */
DROP TABLE IF EXISTS `geo_coordinates`;
CREATE TABLE `geo_coordinates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lat` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `lon` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- END GEOLOCATION

