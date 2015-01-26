weather-station server
===============

This folder contains some php script which store and display the weather information.

Create the following tables in mysql:

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL,
  `pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1234',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `metrics` (
  `id` bigint(20) NOT NULL,
  `when` datetime NOT NULL,
  `key` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `value` float NOT NULL,
  PRIMARY KEY (`id`,`when`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

