
DROP TABLE IF EXISTS `publishing_publishers`;
CREATE TABLE `publishing_publishers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `publishing_publications`;
CREATE TABLE `publishing_publications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `publisher_id` int(10) unsigned DEFAULT NULL,
  `theme_view` varchar(32) DEFAULT NULL,
  `frequency` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `publishing_issues`;
CREATE TABLE `publishing_issues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL,
  `publication_id` int(10) unsigned NOT NULL,
  `number` int(10) unsigned NOT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `date_pub` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `publishing_contents`;
CREATE TABLE `publishing_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL,
  `publication_id` int(10) unsigned NOT NULL,
  `issue_id` int(10) unsigned DEFAULT NULL,
  `activity` tinyint(1) unsigned NOT NULL DEFAULT 1, -- 0 = trash, 1 = ...
  `date_pub` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime NULL,
  PRIMARY KEY (`id`),
  UNIQUE(`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
