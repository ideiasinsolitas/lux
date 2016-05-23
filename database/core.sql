/* user management
 */
DROP TABLE IF EXISTS `core_users`;
CREATE TABLE `core_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
<<<<<<< HEAD
  `first_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
=======
>>>>>>> core-develop
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

<<<<<<< HEAD
INSERT INTO `core_users` (`id`,`username`,`email`,`first_name`,`last_name`,`display_name`,`password`,`activity`,`created`,`modified`) VALUES
(1, 'pedrokoblitz', 'pedrokoblitz@gmail.com', 'Pedro', 'Koblitz', 'Pedro Koblitz', '', 1, NOW(), NOW());
=======
INSERT INTO `core_users` (`id`,`username`,`email`,`display_name`,`password`,`activity`,`created`,`modified`) VALUES
(1, 'pedrokoblitz', 'pedrokoblitz@gmail.com', 'Pedro Koblitz', '', 1, NOW(), NOW());

DROP TABLE IF EXISTS `core_user_profiles`;
CREATE TABLE `core_user_profiles` (
  `user_id` int(10) unsigned NOT NULL,
  `first_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
>>>>>>> core-develop

/* Everything that has a type id points here */
DROP TABLE IF EXISTS `core_types`;
CREATE TABLE `core_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `core_types` (name, class) VALUES
("Image", "File"),
("Document", "File"),
("Url", "Resource"),
("Embed", "Resource"),
("Work", "Content"),
("Book", "Content"),
("Page", "Content"),
("Article", "Content"),
("Album", "Collection"),
("Folder", "Collection"),
("Category", "Term"),
("Taxonomy", "Term"),
("Folksonomy", "Term"),
("Pagseguro", "Payment"),
("Boleto", "Payment"),
("Credito", "Payment"),
("Encomenda", "Shipping"),
("Sedex", "Shipping"),
("Sedex10", "Shipping"),
("InHands", "Shipping"),
("Residence", "Place"),
("Public", "Place"),
("Business", "Place"),
("Apartment", "Estate"),
("House", "Estate"),
("Office", "Estate"),
("Client", "Project"),
("Personal", "Project"),
("Feature", "Ticket"),
("Emergency", "Ticket"),
("Support", "Ticket"),
("SignUp", "Token"),
("Invitation", "Token");

/* App config with default values */
DROP TABLE IF EXISTS `core_config`;
CREATE TABLE `core_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
<<<<<<< HEAD
  `key` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `value` BLOB NOT NULL,
  `format` tinyint(1) unsigned NOT NULL DEFAULT 0, -- 0 = string, 1 = serialized, 2 = json
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = active, 1 = autoload, 
=======
  `user_id` int(11) unsigned NOT NULL DEFAULT 0,
  `key` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `value` BLOB NOT NULL,
  `format` tinyint(1) unsigned NOT NULL DEFAULT 0, -- 0 = string, 1 = serialized, 2 = json
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 2, -- 0 = active, 1 = autoload, 
>>>>>>> core-develop
  PRIMARY KEY (`id`),
  UNIQUE(`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `core_config` (`key`, `value`) VALUES 
("site.title", "bla bla bla"),
("site.tagline", "bla bla bla bla bla"),
("system.email", "pedrokoblitz@gmail.com"),
("per.page", "12"),
("upload.dir", "/public/media"),
("app.web.root", "/"),
("app.abs.path", "/var/www/html/"),
("panel.log.quantity", "15"),
("panel.content.quantity", "10"),
("panel.collection.quantity", "5"),
("panel.resource.quantity", "5"),
("panel.term.quantity", "5"),
("facebook.app.id", ""),
("facebook.app.key", ""),
("facebook.app.secret", ""),
("twitter.app.id", ""),
("twitter.app.key", ""),
("twitter.app.secret", ""),
("flickr.profile.url", "http://flickr.com.br/photos/pedrokoblitz"),
("tumblr.profile.url", "http://pedrokoblitz.tumblr.com"),
("facebook.profile.url", "https://facebook.com/pedrokoblitz"),
("facebook.page.url", "https://facebook.com/ideiasinsolitas"),
("twitter.profile.url", "http://twitter.com/pedrokoblitz"),
("linkedin.profile.url", "http://br.linkedin.com/pedrokoblitz"),
("pinterest.profile.url", "http://pinterest.com/pedrokoblitz");

/* authentication tokens */
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

/*
store text based content for all entities and group by language
Polymorphic
 */
DROP TABLE IF EXISTS `core_translations`;
CREATE TABLE `core_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `translatable_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `translatable_id` int(10) unsigned NOT NULL,
  `language` varchar(5) COLLATE utf8_unicode_ci DEFAULT "pt-br",
  `slug` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` TINYBLOB DEFAULT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tagline` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `excerpt` TINYBLOB DEFAULT NULL,
  `body` BLOB DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`language`,`translatable_type`,`translatable_id`),
  UNIQUE(`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* nodes */
DROP TABLE IF EXISTS `core_nodes`;
CREATE TABLE `core_nodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
<<<<<<< HEAD
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `class` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
=======
  `class` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
>>>>>>> core-develop
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* Polymorphic */
DROP TABLE IF EXISTS `core_likes`;
CREATE TABLE `core_likes` (
  `user_id` int(10) unsigned NOT NULL,
  `likeable_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `likeable_id` int(10) unsigned NOT NULL,
  UNIQUE(`user_id`, `likeable_type`, `likeable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* Polymorphic */
DROP TABLE IF EXISTS `core_votes`;
CREATE TABLE `core_votes` (
  `user_id` int(10) unsigned NOT NULL,
  `votable_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `votable_id` int(10) unsigned NOT NULL,
  `vote` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE(`user_id`, `votable_type`, `votable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* Polymorphic */
DROP TABLE IF EXISTS `core_ownership`;
CREATE TABLE `core_ownership` (
  `user_id` int(10) unsigned NOT NULL,
  `ownable_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `ownable_id` int(10) unsigned NOT NULL,
  UNIQUE(`ownable_type`, `ownable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* Polymorphic */
DROP TABLE IF EXISTS `core_collaborations`;
CREATE TABLE `core_collaborations` (
  `user_id` int(10) unsigned NOT NULL,
  `collaborative_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `collaborative_id` int(10) unsigned NOT NULL,
  UNIQUE(`user_id`, `collaborative_type`, `collaborative_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* files */
DROP TABLE IF EXISTS `core_files`;
CREATE TABLE `core_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NULL,
  `description` TINYBLOB NULL,
  `filepath` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `mimetype` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `width` int(10) unsigned DEFAULT NULL,
  `height` int(10) unsigned DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* links */
DROP TABLE IF EXISTS `core_resources`;
CREATE TABLE `core_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
<<<<<<< HEAD
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `description` TINYBLOB NULL,
=======
  `type_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL,
>>>>>>> core-develop
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `embed` BLOB DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `created` datetime NOT NULL,
<<<<<<< HEAD
=======
  `modified` datetime NULL,
>>>>>>> core-develop
  `deleted` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* collection nodes */
DROP TABLE IF EXISTS `core_collections`;
CREATE TABLE `core_collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `collector_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `collector_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`collector_type`, `collector_id`),
  UNIQUE(`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Many To Many Polymorphic
DROP TABLE IF EXISTS `core_collectables`;
CREATE TABLE `core_collectables` (
  `collection_id` int(10) unsigned NOT NULL DEFAULT 0,
  `collectable_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `collectable_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  UNIQUE(`collection_id`, `collectable_type`, `collectable_id`),
  UNIQUE(`collection_id`, `order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* user comments */
DROP TABLE IF EXISTS `core_comments`;
CREATE TABLE `core_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned DEFAULT NULL,
<<<<<<< HEAD
  `comment` BLOB NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`node_id`)
=======
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
>>>>>>> core-develop
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* Polymorphic many2many */
DROP TABLE IF EXISTS `core_commenting`;
CREATE TABLE `core_commenting` (
  `comment_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `commentable_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `commentable_id` int(10) unsigned DEFAULT NULL,
  UNIQUE(`comment_id`,`user_id`,`commentable_type`,`commentable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* term */
DROP TABLE IF EXISTS `core_terms`;
CREATE TABLE `core_terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `type_id` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Polymorphic many2many
DROP TABLE IF EXISTS `core_folksonomy`;
CREATE TABLE `core_folksonomy` (
  `term_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `usertaggable_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `usertaggable_id` int(10) unsigned DEFAULT NULL,
  UNIQUE(`term_id`,`user_id`,`usertaggable_type`,`usertaggable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Polymorphic many2many
DROP TABLE IF EXISTS `core_taxonomy`;
CREATE TABLE `core_taxonomy` (
  `term_id` int(10) unsigned DEFAULT NULL,
  `ownertaggable_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `ownertaggable_id` int(10) unsigned DEFAULT NULL,
  UNIQUE(`term_id`,`ownertaggable_type`,`ownertaggable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* areas contain and ordered list of blocks */
DROP TABLE IF EXISTS `core_areas`;
CREATE TABLE `core_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = off, 1 = on
  PRIMARY KEY (`id`),
  UNIQUE(`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* blocks contain a dropdown with widgets? */
DROP TABLE IF EXISTS `core_blocks`;
CREATE TABLE `core_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* blocks contain a dropdown with widgets? */
DROP TABLE IF EXISTS `core_menus`;
CREATE TABLE `core_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

<<<<<<< HEAD
DROP TABLE IF EXISTS `core_menus_resources`;
CREATE TABLE `core_menus_resources` (
  `menu_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


=======
>>>>>>> core-develop
DROP TABLE IF EXISTS `core_notifications`;
CREATE TABLE `core_node_stats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
<<<<<<< HEAD
  `message` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
=======
  `notification` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
>>>>>>> core-develop
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `core_interaction_stats`;
CREATE TABLE `core_interaction_stats` (
  `interaction_type` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `interaction_id` int(10) unsigned NOT NULL,
  `count_type` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `core_node_stats`;
CREATE TABLE `core_node_stats` (
  `node_id` int(10) unsigned NOT NULL,
  `count_type` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
