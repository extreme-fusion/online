<?php
/*********************************************************
| eXtreme-Fusion 5
| Content Management System
|
| Copyright (c) 2005-2013 eXtreme-Fusion Crew
| http://extreme-fusion.org/
|
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
*********************************************************/
define('DIR_BASE', realpath(dirname(__FILE__).DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR);

require DIR_BASE.'config.php';
require DIR_SITE.'bootstrap.php';
require_once DIR_CLASS.'Exception.php';
require_once OPT_DIR.'opt.class.php';
require_once DIR_SYSTEM.'helpers/main.php';

	$_locale = new Locales('English', DIR_LOCALE);

	$charset = 'utf8';
	$collate = 'utf8_general_ci';

	ob_start();

    $ec = new Container(array('pdo.config' => $_dbconfig));

	# PHP Data Object
    $_pdo = $ec->pdo;
	
	# System
	$_system = $ec->system;
	
	# Files
	$_files = $ec->files;
	
	$_system->clearCache();
	$_system->clearCache('cookies');
	$_system->clearCache('navigation_panel');
	$_system->clearCache('news');
	$_system->clearCache('profiles');
	$_system->clearCache('statistics');
	$_system->clearCache('synchro');
	$_system->clearCache('system');
	$_system->clearCache('users');

	$query = $_pdo->exec('DROP TABLE IF EXISTS [admin_favourites]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [users]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [admin]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [bbcodes]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [boards]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [board_categories]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [blacklist]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [comments]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [cookies]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [entries]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [groups]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [links]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [logs]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [messages]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [modules]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [navigation]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [news]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [news_cats]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [notes]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [pages]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [pages_categories]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [pages_custom_settings]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [pages_types]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [panels]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [permissions]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [permissions_sections]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [settings]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [smileys]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [statistics]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [tags]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [threads]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [time_formats]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [users_data]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [users_online]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [user_fields]');
	$query = $_pdo->exec('DROP TABLE IF EXISTS [user_field_cats]');
	
	$_files->rmDirRecursive(DIR_UPLOAD);
	
	$_files->rmDirRecursive(DIR_SITE.'tmp');

	
	// REINSTALL
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [admin] (
	  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	  `permissions` varchar(127) NOT NULL DEFAULT '',
	  `image` varchar(120) NOT NULL DEFAULT '',
	  `title` varchar(50) NOT NULL DEFAULT '',
	  `link` varchar(100) NOT NULL DEFAULT 'reserved',
	  `page` tinyint(3) unsigned NOT NULL DEFAULT '1',
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=31 ;");
	
	$query = $_pdo->exec("INSERT INTO [admin] (`id`, `permissions`, `image`, `title`, `link`, `page`) VALUES
		(1, 'admin.bbcodes', 'bbcodes.png', 'BBCodes', 'bbcodes.php', 3),
		(2, 'admin.blacklist', 'blacklist.png', 'Blacklist', 'blacklist.php', 2),
		(3, 'admin.comments', 'comments.png', 'Comments', 'comments.php', 2),
		(4, 'admin.groups', 'groups.png', 'Groups', 'groups.php', 2),
		(5, 'admin.pages', 'pages.png', 'Content Pages', 'pages.php', 1),
		(6, 'admin.logs', 'logs.png', 'Logs', 'logs.php', 2),
		(7, 'admin.urls', 'urls.png', 'URLs Generator', 'urls.php', 3),
		(8, 'admin.news', 'news.png', 'News', 'news.php', 1),
		(9, 'admin.panels', 'panels.png', 'Panels', 'panels.php', 3),
		(10, 'admin.permissions', 'permissions.png', 'Permissions', 'permissions.php', 2),
		(11, 'admin.phpinfo', 'phpinfo.png', 'PHP Info', 'phpinfo.php', 3),
		(12, 'admin.security', 'security.png', 'Security Politics', 'settings_security.php', 4),
		(13, 'admin.settings', 'settings.png', 'General', 'settings_general.php', 4),
		(14, 'admin.settings_banners', 'settings_banners.png', 'Banners', 'settings_banners.php', 4),
		(15, 'admin.settings_cache', 'settings_cache.png', 'Cache', 'settings_cache.php', 4),
		(16, 'admin.settings_time', 'settings_time.png', 'Time and Date', 'settings_time.php', 4),
		(17, 'admin.settings_registration', 'registration.png', 'Registration', 'settings_registration.php', 4),
		(18, 'admin.settings_misc', 'settings_misc.png', 'Miscellaneous', 'settings_misc.php', 4),
		(19, 'admin.settings_users', 'settings_users.png', 'User Management', 'settings_users.php', 4),
		(20, 'admin.settings_ipp', 'settings_ipp.png', 'Item per Page', 'settings_ipp.php', 4),
		(21, 'admin.settings_logs', 'logs.png', 'Logs', 'settings_logs.php', 4),
		(22, 'admin.settings_login', 'login.png', 'Login', 'settings_login.php', 4),
		(23, 'admin.settings_synchro', 'synchro.png', 'Synchronization', 'settings_synchro.php', 4),
		(24, 'admin.settings_routing', 'router.png', 'Router', 'settings_routing.php', 4),
		(25, 'admin.navigations', 'navigations.png', 'Site Links', 'navigations.php', 3),
		(26, 'admin.smileys', 'smileys.png', 'Smileys', 'smileys.php', 3),
		(27, 'admin.user_fields', 'user_fields.png', 'User Fields', 'user_fields.php', 2),
		(28, 'admin.user_fields_cats', 'user_fields_cats.png', 'User Field Categories', 'user_field_cats.php', 2),
		(29, 'admin.users', 'users.png', 'Users', 'users.php', 2),
		(30, 'module.cookies.admin', 'cookies/templates/images/cookies.png', 'Pliki cookies', 'cookies/admin/cookies.php', 5);
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [users] (
	  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	  `username` varchar(30) NOT NULL DEFAULT '',
	  `password` char(129) NOT NULL DEFAULT '',
	  `salt` char(5) NOT NULL DEFAULT '',
	  `algo` varchar(10) NOT NULL DEFAULT 'sha512',
	  `user_hash` varchar(10) NOT NULL DEFAULT '',
	  `user_last_logged_in` int(10) unsigned NOT NULL DEFAULT '0',
	  `user_remember_me` tinyint(3) unsigned NOT NULL DEFAULT '0',
	  `admin_hash` varchar(10) NOT NULL DEFAULT '',
	  `admin_last_logged_in` int(10) unsigned NOT NULL DEFAULT '0',
	  `browser_info` varchar(100) NOT NULL DEFAULT '',
	  `link` varchar(30) NOT NULL DEFAULT '',
	  `email` varchar(100) NOT NULL DEFAULT '',
	  `hide_email` tinyint(3) unsigned NOT NULL DEFAULT '1',
	  `valid_code` varchar(32) NOT NULL DEFAULT '',
	  `valid` tinyint(4) NOT NULL DEFAULT '0',
	  `offset` char(5) NOT NULL DEFAULT '0',
	  `avatar` varchar(100) NOT NULL DEFAULT '',
	  `joined` int(10) unsigned NOT NULL DEFAULT '0',
	  `lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
	  `datestamp` int(10) unsigned NOT NULL DEFAULT '0',
	  `ip` varchar(20) NOT NULL DEFAULT '0.0.0.0',
	  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
	  `actiontime` int(10) unsigned NOT NULL DEFAULT '0',
	  `theme` varchar(100) NOT NULL DEFAULT 'Default',
	  `roles` text NOT NULL,
	  `role` int(11) NOT NULL DEFAULT '2',
	  `lastupdate` int(11) NOT NULL DEFAULT '0',
	  `lang` varchar(20) NOT NULL,
	  PRIMARY KEY (`id`),
	  KEY `username` (`username`),
	  KEY `joined` (`joined`),
	  KEY `lastvisit` (`lastvisit`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;");
	
	$query = $_pdo->exec("INSERT INTO [users] (`id`, `username`, `password`, `salt`, `algo`, `user_hash`, `user_last_logged_in`, `user_remember_me`, `admin_hash`, `admin_last_logged_in`, `browser_info`, `link`, `email`, `hide_email`, `valid_code`, `valid`, `offset`, `avatar`, `joined`, `lastvisit`, `datestamp`, `ip`, `status`, `actiontime`, `theme`, `roles`, `role`, `lastupdate`, `lang`) VALUES
		(1, 'Admin', 'd82c1e3cf6d63d3efc55e849da6a54cd4ac997f95ae99a32cd25abd6a879105abe56487a79f9ab39a0671d785f2d98ed52898fa00271934d71bb901619e9a335', '66292', 'sha512', '2da1606a', ".time().", 0, 'b1f79b8f', ".time().", '', 'admin', 'admin@extreme-fusion.org', 1, '', 1, '0', '', ".time().", ".time().", 0, '0.0.0.0', 0, 0, 'Default', 'a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}', 1, 0, 'English');
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [bbcodes] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`name` varchar(20) NOT NULL DEFAULT '',
		`order` smallint(5) unsigned NOT NULL,
		PRIMARY KEY (`id`),
		KEY `order` (`order`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=11 ;");
	
	$query = $_pdo->exec("INSERT INTO [bbcodes] (`id`, `name`, `order`) VALUES
		(1, 'b', 1),
		(2, 'i', 2),
		(3, 'u', 3),
		(4, 'url', 4),
		(5, 'mail', 5),
		(6, 'img', 6),
		(7, 'center', 7),
		(8, 'small', 8),
		(9, 'code', 9),
		(10, 'quote', 10);
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [blacklist] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
		`ip` varchar(45) NOT NULL DEFAULT '',
		`type` tinyint(3) unsigned NOT NULL DEFAULT '4',
		`email` varchar(100) NOT NULL DEFAULT '',
		`reason` text NOT NULL,
		`datestamp` int(10) unsigned NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`),
		KEY `type` (`type`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [boards] (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `title` varchar(255) NOT NULL,
	  `order` int(10) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=2 ;");
	
	$query = $_pdo->exec("INSERT INTO [boards] (`id`, `title`, `order`) VALUES
		(1, 'Testowy dział', 1);
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [board_categories] (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `board_id` int(11) NOT NULL,
	  `title` varchar(255) NOT NULL,
	  `description` text,
	  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
	  `order` int(10) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=2 ;");
	
	$query = $_pdo->exec("INSERT INTO [board_categories] (`id`, `board_id`, `title`, `description`, `is_locked`, `order`) VALUES
		(1, 1, 'Kategoria', 'Forum dyskusyjne dzieli się na działy, natomiast działy na kategorie.', 0, 1);
	");
	
	$query = $_pdo->exec("CREATE TABLE [comments] (
		`id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
		`content_id` MEDIUMINT UNSIGNED NOT NULL DEFAULT '0',
		`content_type` VARCHAR(20) NOT NULL DEFAULT '',
		`author` VARCHAR(50) NOT NULL DEFAULT '',
		`author_type` VARCHAR(1) NOT NULL DEFAULT '',
		`post` TEXT NOT NULL,
		`datestamp` INT UNSIGNED NOT NULL DEFAULT '0',
		`ip` VARCHAR(20) NOT NULL DEFAULT '0.0.0.0',
		PRIMARY KEY (`id`),
		KEY `datestamp` (`datestamp`)
	) ENGINE = InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [cookies] (
	  `message` varchar(255) NOT NULL,
	  `policy` text NOT NULL
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate.";");
	
	$query = $_pdo->exec("INSERT INTO [cookies] (`message`, `policy`) VALUES
		('Strona ta korzysta z plików cookies w celu zapewnienia lepszej jakości usług.', '');
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [entries] (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `thread_id` int(11) NOT NULL,
	  `user_id` int(11) NOT NULL,
	  `content` text NOT NULL,
	  `is_main` tinyint(1) NOT NULL DEFAULT '0',
	  `timestamp` int(10) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=2 ;");
	
	$query = $_pdo->exec("INSERT INTO [entries] (`id`, `thread_id`, `user_id`, `content`, `is_main`, `timestamp`) VALUES
		(1, 1, 1, 'CZ: Toto je test příspěvek ve vaší fóru.\r\n\r\nEN: This is a test post in your forum.\r\n\r\nPL: Jest to testowy post na Twoim nowym forum.', 1, 1376321849);
	");

	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [groups] (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`title` varchar(127) NOT NULL,
		`description` varchar(255) DEFAULT NULL,
		`format` varchar(255) NOT NULL DEFAULT '{username}',
		`permissions` text NOT NULL,
		`team` tinyint(1) NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=4 ;");
	
	$query = $_pdo->exec("INSERT INTO [groups] (`id`, `title`, `description`, `format`, `permissions`, `team`) VALUES
		(1, 'Administrator', 'Administratorzy są to ludzie, którzy cały czas czuwają nad stroną.', '<span style=\"color:#99bb00\">{username}</span>', 'a:1:{i:0;s:1:\"*\";}', 0),
		(2, 'Użytkownik', 'Uprawnienie to posiada podstawowe zezwolenia m.in. Możliwość logowania się.', '{username}', 'a:4:{i:0;s:10:\"site.login\";i:1;s:12:\"site.comment\";i:2;s:16:\"site.comment.add\";i:3;s:17:\"site.comment.edit\";}', 0),
		(3, 'Gość', 'Osoba odwiedzająca stronę bez logowania się.', '{username}', 'a:0:{}', 0);
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [links] (
		`id` int(7) unsigned NOT NULL AUTO_INCREMENT,
		`link` varchar(200) NOT NULL DEFAULT '',
		`file` varchar(100) NOT NULL DEFAULT '',
		`full_path` varchar(200) NOT NULL DEFAULT '',
		`short_path` varchar(100) NOT NULL DEFAULT '',
		`datestamp` int(10) unsigned NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`),
		KEY `datestamp` (`datestamp`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [logs] (
		`id` int(7) unsigned NOT NULL AUTO_INCREMENT,
		`action` text NOT NULL,
		`datestamp` int(10) unsigned NOT NULL,
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [messages] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`item_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
		`to` mediumint(8) unsigned NOT NULL DEFAULT '0',
		`from` mediumint(8) unsigned NOT NULL DEFAULT '0',
		`subject` varchar(100) NOT NULL DEFAULT '',
		`message` text NOT NULL,
		`read` tinyint(3) unsigned NOT NULL DEFAULT '0',
		`datestamp` int(10) unsigned NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`),
		KEY `datestamp` (`datestamp`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [modules] (
	  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	  `title` varchar(100) NOT NULL DEFAULT '',
	  `folder` varchar(100) NOT NULL DEFAULT '',
	  `category` varchar(100) NOT NULL DEFAULT '',
	  `version` varchar(10) NOT NULL DEFAULT '0',
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=3 ;");
	
	$query = $_pdo->exec("INSERT INTO [modules] (`id`, `title`, `folder`, `category`, `version`) VALUES
		(1, 'Pliki cookies', 'cookies', '', '1.0'),
		(2, 'Forum', 'forum', '', '1.0');
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [navigation] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`name` varchar(100) NOT NULL DEFAULT '',
		`url` varchar(200) NOT NULL DEFAULT '',
		`visibility` varchar(255) NOT NULL DEFAULT '',
		`position` tinyint(3) unsigned NOT NULL DEFAULT '1',
		`window` tinyint(3) unsigned NOT NULL DEFAULT '0',
		`order` smallint(2) unsigned NOT NULL DEFAULT '0',
		`rewrite` tinyint(3) unsigned NOT NULL DEFAULT '1',
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=10 ;");
	
	$query = $_pdo->exec("INSERT INTO [navigation] (`id`, `name`, `url`, `visibility`, `position`, `window`, `order`, `rewrite`) VALUES
		(1, 'Main Page', '', '3', 3, 0, 1, 1),
		(2, 'News cats', 'news_cats.html', '3', 3, 0, 2, 1),
		(3, 'Users', 'users.html', '3', 3, 0, 3, 1),
		(4, 'Team', 'team.html', '3', 2, 0, 3, 1),
		(5, 'Rules', 'rules.html', '3', 2, 0, 4, 1),
		(6, 'Tags', 'tags.html', '3', 1, 0, 4, 1),
		(7, 'Pages', 'pages.html', '3', 3, 0, 5, 1),
		(8, 'Search', 'search.html', '3', 3, 0, 6, 1);
		(9, 'Forum', 'forum.html', '3', 3, 0, 6, 1);
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [news] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`title` varchar(255) NOT NULL DEFAULT '',
		`link` varchar(255) NOT NULL DEFAULT '',
		`category` mediumint(8) unsigned NOT NULL DEFAULT '0',
		`language` varchar(255) NOT NULL DEFAULT 'English',
		`content` text NOT NULL,
		`content_extended` text NOT NULL,
		`author` mediumint(8) unsigned NOT NULL DEFAULT '0',
		`source` text NOT NULL,
		`description` text NOT NULL,
		`breaks` char(1) NOT NULL DEFAULT '',
		`datestamp` int(10) unsigned NOT NULL DEFAULT '0',
		`access` varchar(255) NOT NULL DEFAULT '',
		`reads` int(10) unsigned NOT NULL DEFAULT '0',
		`draft` tinyint(3) unsigned NOT NULL DEFAULT '0',
		`sticky` tinyint(3) unsigned NOT NULL DEFAULT '0',
		`allow_comments` tinyint(3) unsigned NOT NULL DEFAULT '1',
		`allow_ratings` tinyint(3) unsigned NOT NULL DEFAULT '1',
		PRIMARY KEY (`id`),
		KEY `datestamp` (`datestamp`),
		KEY `reads` (`reads`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=2 ;");
	
	$news = '<div style="text-align: center;">\r\n	<img alt="eXtreme-Fusion 5 :: Demo :: EN" src="http://localhost/extreme/demo/templates/images/ef_demo/gb.png" style="width: 66px; height: 83px; float: left;" /></div>\r\n<div style="text-align: center;">\r\n	<em><img alt="eXtreme-Fusion 5 :: DEMO : EN" src="http://localhost/extreme/demo/templates/images/ef_demo/gb.png" style="width: 66px; height: 83px; float: right;" /></em></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<em>You don&#39;t have <a href="http://extreme-fusion.org">eXtreme-Fusion 5: Ninja Edition</a>?</em><br />\r\n	<em>Do you want to get familiar with it before you download it?&nbsp;</em><br />\r\n	<em>We have prepared special demo version of eXtreme-Fusion 5!</em></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div>\r\n	<span style="color:#ffa500;"><strong>We are giving you a&nbsp;possibility to test the most of system functions!</strong></span><br />\r\n	News writing, adding accounts from Admin Panel, managing of groups permissions, settings, panel system, adding new pages and installing new modules with ability to manage them.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong><span style="color:#ffa500;">Do you want to see how it looks? Get familiar with system today!</span></strong><br />\r\n	Only thing to do is login using following user data:</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<strong><span style="color:#ffa500;">Username:</span> Admin</strong><br />\r\n	<strong><span style="color:#ffa500;">Password:</span> administrator5</strong></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<hr />\r\n<div style="text-align: center;">\r\n	<img alt="eXtreme-Fusion 5 :: Demo :: PL" src="http://localhost/extreme/demo/templates/images/ef_demo/pl.png" style="width: 66px; height: 83px; float: left;" /></div>\r\n<div style="text-align: center;">\r\n	<em><img alt="eXtreme-Fusion 5 :: DEMO : PL" src="http://localhost/extreme/demo/templates/images/ef_demo/pl.png" style="width: 66px; height: 83px; float: right;" /></em></div>\r\n<div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div style="text-align: center;">\r\n		<em>Nie posiadasz jeszcze <a href="http://extreme-fusion.org">eXtreme-Fusion 5: Ninja Edition</a>?&nbsp;</em><br />\r\n		<em>Przed pobraniem chcesz zapoznać się z&nbsp;systemem?</em><br />\r\n		<em>Przygotowaliśmy dla Ciebie wersję demonstracyjną eXtreme-Fusion 5!</em></div>\r\n	<div style="text-align: center;">\r\n		&nbsp;</div>\r\n	<div style="text-align: center;">\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style="color:#ffa500;"><strong>Dajemy Ci praktycznie wszystkie możliwości sprawdzenia systemu!</strong></span><br />\r\n		Pisanie news&oacute;w, dodawanie kont z&nbsp;poziomu administratora, zarządzanie grupami uprawnień, ustawieniami, układem paneli, dodawanie stron treści oraz instalowanie systemowych moduł&oacute;w i&nbsp;zabawa nimi.</div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<strong><span style="color:#ffa500;">Chesz zobaczyć jak to wygląda? Zapoznaj się z&nbsp;systemem już dziś!&nbsp;</span></strong><br />\r\n		Wystarczy tylko, że się zalogujesz korzystając z&nbsp;poniższych danych:</div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div style="text-align: center;">\r\n		<strong><span style="color:#ffa500;">Nazwa użytkownika:</span> Admin</strong><br />\r\n		<strong><span style="color:#ffa500;">Hasło:</span> administrator5</strong></div>\r\n</div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<hr />\r\n<div style="text-align: center;">\r\n	<img alt="eXtreme-Fusion 5 :: Demo :: CZ" src="http://localhost/extreme/demo/templates/images/ef_demo/cz.png" style="width: 66px; height: 83px; float: left;" /></div>\r\n<div style="text-align: center;">\r\n	<em><img alt="eXtreme-Fusion 5 :: DEMO : CZ" src="http://localhost/extreme/demo/templates/images/ef_demo/cz.png" style="width: 66px; height: 83px; float: right;" /></em></div>\r\n<div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div style="text-align: center;">\r\n		<em>Ještě nemáte <a href="http://extreme-fusion.org">eXtreme-Fusion 5: Ninja Edition</a>?&nbsp;</em><br />\r\n		<em>Chcete se s ním seznámit ještě dřív než ho stáhnete?</em><br />\r\n		<em>Připravili jsme speciální demo verzi eXtreme-Fusion 5!</em></div>\r\n	<div style="text-align: center;">\r\n		&nbsp;</div>\r\n	<div style="text-align: center;">\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style="color:#ffa500;"><strong>Dáváme Vám možnost vyzkoušet si většinu funkcí systému!</strong></span><br />\r\n		Psaní novinek, přidávání účtů přes Admin Panel, spravování skupin oprávnění, nastavení či panelů systému, přidávání nových stránek a&nbsp;instalování nových modulů s možností jejich řízení.</div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<strong><span style="color:#ffa500;">Chcete vidět jak to všechno vypadá? Seznamte se systémem ještě dnes!</span></strong><br />\r\n		Jediné, co musíte udělat, je přihlásit se pomocí následujících uživatelských údajů:</div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div style="text-align: center;">\r\n		<strong><span style="color:#ffa500;">Název uživatele:</span> Admin</strong><br />\r\n		<strong><span style="color:#ffa500;">Heslo:</span> administrator5</strong></div>\r\n</div>\r\n';
	
	$query = $_pdo->exec("INSERT INTO [news] (`id`, `title`, `link`, `category`, `language`, `content`, `content_extended`, `author`, `source`, `description`, `breaks`, `datestamp`, `access`, `reads`, `draft`, `sticky`, `allow_comments`, `allow_ratings`) VALUES
		(1, 'eXtreme-Fusion 5 :: Demo', 'extreme-fusion_5_demo', 3, 'Polish', '".$news."', '', 1, 'http://extreme-fusion.org', 'EN: This site is a demonstration of Content Management System (CMS) - eXtreme-Fusion 5: Ninja Edition.\r\n\r\nPL: Ta strona jest demonstracją Systemu Zarządzania Treścią (CMS) - eXtreme-Fusion 5: Ninja Edition', '0', 1369995541, '3', 1, 0, 1, 1, 0);");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [news_cats] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`name` varchar(100) NOT NULL DEFAULT '',
		`link` varchar(100) NOT NULL DEFAULT '',
		`image` varchar(100) NOT NULL DEFAULT '',
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=16 ;");
	
	$query = $_pdo->exec("INSERT INTO [news_cats] (`id`, `name`, `link`, `image`) VALUES
		(1, 'Bugs', 'bledy', 'bugs.png'),
		(2, 'Downloads', 'download', 'downloads.png'),
		(3, 'eXtreme-Fusion', 'extreme-fusion', 'eXtreme-fusion.png'),
		(4, 'Games', 'gry', 'games.png'),
		(5, 'Graphics', 'grafika', 'graphics.png'),
		(6, 'Hardware', 'sprzet', 'hardware.png'),
		(7, 'Journal', 'dziennik', 'journal.png'),
		(8, 'Users', 'uzytkownicy', 'users.png'),
		(9, 'Mods', 'modyfikacje', 'mods.png'),
		(10, 'Movies', 'filmy', 'movies.png'),
		(11, 'Network', 'siec', 'network.png'),
		(12, 'News', 'newsy', 'news.png'),
		(13, 'Security', 'bezpieczenstwo', 'security.png'),
		(14, 'Software', 'oprogramowanie', 'software.png'),
		(15, 'Themes', 'skorki', 'themes.png');
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [notes] (
		`id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
		`title` varchar(64) NOT NULL,
		`note` text NOT NULL,
		`author` mediumint(8) unsigned NOT NULL,
		`block` smallint(5) unsigned NOT NULL DEFAULT '0',
		`datestamp` int(10) unsigned NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [pages] (
		`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
		`title` varchar(255) NOT NULL DEFAULT '',
		`content` text NOT NULL,
		`preview` mediumtext NOT NULL,
		`description` varchar(255) NOT NULL DEFAULT '',
		`type` smallint(5) unsigned NOT NULL DEFAULT '0',
		`categories` varchar(255) NOT NULL DEFAULT '',
		`author` smallint(5) unsigned NOT NULL DEFAULT '0',
		`date` int(10) unsigned NOT NULL DEFAULT '0',
		`url` varchar(255) NOT NULL DEFAULT '',
		`thumbnail` varchar(255) NOT NULL DEFAULT '',
		`settings` tinyint(3) unsigned NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`),
		KEY `type` (`type`) USING BTREE,
		KEY `categories` (`categories`) USING BTREE,
		KEY `date` (`date`) USING BTREE,
		KEY `url` (`url`) USING BTREE
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [pages_categories] (
		`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
		`name` varchar(255) NOT NULL DEFAULT '',
		`description` mediumtext NOT NULL,
		`submitting_groups` varchar(255) NOT NULL DEFAULT '',
		`thumbnail` varchar(255) NOT NULL DEFAULT '',
		`is_system` tinyint(3) unsigned NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`),
		KEY `name` (`name`) USING BTREE
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=2 ;");
	
	$query = $_pdo->exec("INSERT INTO [pages_categories] (`id`, `name`, `description`, `submitting_groups`, `thumbnail`, `is_system`) VALUES
		(1, 'Bez kategorii', 'Kategoria dla materiałów nieprzypisanych do żadnej kategorii', '0', '', 1);
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [pages_custom_settings] (
		`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
		`settings` mediumtext NOT NULL,
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [pages_types] (
		`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
		`name` varchar(255) NOT NULL DEFAULT '',
		`for_news_page` tinyint(3) unsigned NOT NULL DEFAULT '0',
		`user_allow_edit_own` tinyint(3) unsigned NOT NULL DEFAULT '0',
		`user_allow_use_wysiwyg` tinyint(3) unsigned NOT NULL DEFAULT '0',
		`insight_groups` varchar(255) NOT NULL DEFAULT '',
		`editing_groups` varchar(255) NOT NULL DEFAULT '',
		`submitting_groups` varchar(255) NOT NULL DEFAULT '',
		`show_preview` tinyint(3) unsigned NOT NULL DEFAULT '1',
		`add_author` tinyint(3) unsigned NOT NULL DEFAULT '1',
		`change_author` tinyint(3) unsigned NOT NULL DEFAULT '0',
		`add_last_editing_date` tinyint(3) unsigned NOT NULL DEFAULT '0',
		`change_date` tinyint(3) unsigned NOT NULL DEFAULT '0',
		`show_author` tinyint(3) unsigned NOT NULL DEFAULT '1',
		`show_category` tinyint(3) unsigned NOT NULL DEFAULT '1',
		`show_date` tinyint(3) unsigned NOT NULL DEFAULT '1',
		`show_tags` tinyint(3) unsigned NOT NULL DEFAULT '1',
		`show_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
		`user_allow_comments` tinyint(3) unsigned NOT NULL DEFAULT '1',
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [panels] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`name` varchar(100) NOT NULL DEFAULT '',
		`filename` varchar(100) NOT NULL DEFAULT '',
		`content` text NOT NULL,
		`side` tinyint(3) unsigned NOT NULL DEFAULT '1',
		`order` smallint(5) unsigned NOT NULL DEFAULT '0',
		`type` varchar(20) NOT NULL DEFAULT '',
		`access` varchar(255) NOT NULL DEFAULT '',
		`display` tinyint(3) unsigned NOT NULL DEFAULT '0',
		`status` tinyint(3) unsigned NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`),
		KEY `order` (`order`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=5 ;");
	
	$query = $_pdo->exec("INSERT INTO [panels] (`id`, `name`, `filename`, `content`, `side`, `order`, `type`, `access`, `display`, `status`) VALUES
		(1, 'Nawigacja', 'navigation_panel', '', 1, 1, 'file', '3', 0, 1),
		(2, 'Aktualnie online', 'online_users_panel', '', 1, 2, 'file', '3', 0, 1),
		(3, 'Powitanie', 'welcome_message_panel', '', 2, 1, 'file', '3', 0, 0),
		(4, 'Panel Użytkownika', 'user_info_panel', '', 4, 1, 'file', '3', 0, 1);
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [permissions] (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(127) CHARACTER SET latin1 NOT NULL,
		`section` int(11) NOT NULL,
		`description` varchar(255) NOT NULL,
		`is_system` tinyint(1) NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`),
		UNIQUE KEY `name` (`name`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=37 ;");
	
	$query = $_pdo->exec("INSERT INTO [permissions] (`id`, `name`, `section`, `description`, `is_system`) VALUES
		(1, 'admin.login', 1, 'Logowanie do Panelu Admina.', 1),
		(2, 'site.login', 2, 'Logowanie do serwisu.', 1),
		(3, 'site.comment.add', 2, 'Zamieszczenie komentarzy', 1),
		(4, 'site.comment.edit', 2, 'Modyfikowanie własnego komentarza w określonym przedziale czasowym od jego dodania.', 1),
		(5, 'site.comment.edit.all', 2, 'Modyfikowanie komentarzy swoich oraz innych użytkowników', 1),
		(6, 'site.comment.delete', 2, 'Usuwanie własnego komentarza w określonym przedziale czasowym od jego dodania.', 1),
		(7, 'site.comment.delete.all', 2, 'Usuwanie komentarzy swoich oraz innych uzytkowników', 1),
		(8, 'admin.bbcodes', 1, 'Zarządzanie tagami BBCodes.', 1),
		(9, 'admin.blacklist', 1, 'Dostęp do czarnej listy.', 1),
		(10, 'admin.comments', 1, 'Dostęp do zarządzania komentarzami.', 1),
		(11, 'admin.logs', 1, 'Dostęp do logów strony.', 1),
		(12, 'admin.urls', 1, 'Dostęp do generatora linków.', 1),
		(13, 'admin.news_cats', 1, 'Dostęp do kategorii newsów.', 1),
		(14, 'admin.news', 1, 'Dodawanie newsów z poziomu administratora.', 1),
		(15, 'admin.panels', 1, 'Dostęp do zarządzania panelami.', 1),
		(16, 'admin.permissions', 1, 'Możliwość dodawania nowych uprawnień.', 1),
		(17, 'admin.phpinfo', 1, 'Informacje PHP serwera.', 1),
		(18, 'admin.groups', 1, 'Dodawanie nowych grup użytkownika.', 1),
		(19, 'admin.security', 1, 'Polityka bezpieczeństwa', 1),
		(20, 'admin.settings', 1, 'Ustawienia główne systemu.', 1),
		(21, 'admin.settings_banners', 1, 'Zarządzanie banerami', 1),
		(22, 'admin.settings_cache', 1, 'Pamięć podręczna', 1),
		(23, 'admin.settings_time', 1, 'Zarządzanie datą i godziną.', 1),
		(24, 'admin.settings_registration', 1, 'Dostęp do ustawień rejestracji.', 1),
		(25, 'admin.settings_misc', 1, 'Dostęp do ustawień różnych.', 1),
		(26, 'admin.settings_users', 1, 'Dostęp do ustawień użytkowników.', 1),
		(27, 'admin.settings_ipp', 1, 'Ilość elementów na stronie.', 1),
		(28, 'admin.settings_logs', 1, 'Dostęp do ustawień logów admina.', 1),
		(29, 'admin.navigations', 1, 'Nawigacja strony', 1),
		(30, 'admin.smileys', 1, 'Dostęp do emotikon na stronie', 1),
		(31, 'admin.upgrade', 1, 'Możliwość aktualizowania systemu.', 1),
		(32, 'admin.user_fields', 1, 'Możliwość dodawania nowych pól użytkownika.', 1),
		(33, 'admin.user_fields_cats', 1, 'Możliwość dodawania kategorii pól użytkownika.', 1),
		(34, 'admin.users', 1, 'Możliwość zarządzania kontami użytkowników.', 1),
		(35, 'module.cookies.admin', 3, 'Dostęp do zarządzania modułem Pliki cookies.', 1),
		(36, 'module.forum.admin', 4, 'Zarządzanie forum dyskusyjnym.', 1);
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [permissions_sections] (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(128) NOT NULL,
		`description` varchar(255) NOT NULL,
		`is_system` tinyint(1) NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=5 ;");
	
	$query = $_pdo->exec("INSERT INTO [permissions_sections] (`id`, `name`, `description`, `is_system`) VALUES
		(1, 'admin', 'Administracja', 1),
		(2, 'site', 'Strona', 1),
		(3, 'module.cookies', 'Moduł - Pliki cookies', 1),
		(4, 'module.forum', 'Moduł - Forum', 1);
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [settings] (
		`key` varchar(100) NOT NULL DEFAULT '',
		`value` text NOT NULL,
		PRIMARY KEY (`key`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate.";");
	
	$query = $_pdo->exec("INSERT INTO [settings] (`key`, `value`) VALUES
		('admin_activation', '0'),
		('algorithm', 'sha512'),
		('avatar_filesize', '102400'),
		('avatar_height', '100'),
		('avatar_width', '100'),
		('bad_words', ''),
		('bad_words_enabled', '1'),
		('bad_word_replace', '****'),
		('cache', 'a:7:{s:11:\"expire_news\";s:4:\"3600\";s:16:\"expire_news_cats\";s:4:\"3600\";s:12:\"expire_pages\";s:4:\"3600\";s:14:\"expire_profile\";s:4:\"3600\";s:11:\"expire_tags\";s:4:\"3600\";s:11:\"expire_team\";s:4:\"3600\";s:12:\"expire_users\";s:4:\"3600\";}'),
		('cache_active', '0'),
		('cache_expire', '86400'),
		('change_name', '0'),
		('comments_per_page', '11'),
		('contact_email', 'admin@extreme-fusion.org'),
		('cookie_domain', 'demo.extreme-fusion.org'),
		('cookie_patch', '/'),
		('cookie_secure', '0'),
		('cronjob_day', '1369995540'),
		('cronjob_hour', '1369995540'),
		('cronjob_templates_clean', '1369995540'),
		('deactivation_action', '0'),
		('deactivation_period', '365'),
		('deactivation_response', '14'),
		('default_search', 'all'),
		('demo_last_reset', '".time()."'),
		('description', ''),
		('email_verification', '1'),
		('enable_deactivation', '0'),
		('enable_registration', '1'),
		('enable_terms', '0'),
		('footer', 'Copyright © 2005 - 2013 by the eXtreme-Fusion Crew'),
		('hide_userprofiles', '0'),
		('keywords', 'extreme-fusion, demo, version, cms, ef5, ninja edition, extremo'),
		('language_detection', '0'),
		('license_agreement', ''),
		('license_lastupdate', '0'),
		('locale', 'English'),
		('logger_active', '1'),
		('logger_expire_days', '50'),
		('logger_optimize_active', '1'),
		('logger_save_removal_action', '1'),
		('loging', 'a:4:{s:23:\"site_normal_loging_time\";i:18000;s:25:\"site_remember_loging_time\";i:1814400;s:17:\"admin_loging_time\";i:1800;s:16:\"user_active_time\";i:300;}'),
		('login_method', 'sessions'),
		('longdate', '%B %d %Y %H:%M:%S'),
		('maintenance', '0'),
		('maintenance_form', '1'),
		('maintenance_level', '1'),
		('maintenance_message', 'Dziękujemy za korzystanie z systemu eXtreme-Fusion. Tryb prac na serwerze można wyłączyć w Panelu Administratora w dziale Polityki bezpieczeństwa.'),
		('news_cats_item_per_page', '10'),
		('news_image_frontpage', '0'),
		('news_image_readmore', '0'),
		('news_per_page', '11'),
		('news_photo_h', '300'),
		('news_photo_w', '400'),
		('notes', ''),
		('notes_per_page', '4'),
		('offset_timezone', '1.0'),
		('opening_page', 'news'),
		('routing', 'a:6:{s:9:\"param_sep\";s:1:\"/\";s:8:\"main_sep\";s:1:\"/\";s:7:\"url_ext\";s:5:\".html\";s:7:\"tpl_ext\";s:4:\".tpl\";s:9:\"logic_ext\";s:4:\".php\";s:11:\"ext_allowed\";s:1:\"1\";}'),
		('shortdate', '%d/%m/%Y %H:%M'),
		('site_banner', 'themes/eXtreme-Fusion-5/templates/images/header_logo.png'),
		('site_banner1', ''),
		('site_banner2', ''),
		('site_intro', '<div style=\"text-align:center\">EN: Welcome to the website with demo version of eXtreme-Fusion 5: Ninja Edition</div>\r\n<div style=\"text-align:center\">PL: Witaj na stronie z wersją demo eXtreme-Fusion 5: Ninja Edition</div>\r\n<div style=\"text-align:center\">CZ: Vítejte na stránkách s demoverzí eXtreme-Fusion 5: Ninja Edition</div>'),
		('site_name', 'DEMO:: eXtreme-Fusion 5 - Ninja Edition'),
		('site_username', 'Admin'),
		('smtp_host', ''),
		('smtp_password', ''),
		('smtp_port', '587'),
		('smtp_username', ''),
		('theme', 'eXtreme-Fusion-5'),
		('timezone', 'Europe/London'),
		('users_per_page', '10'),
		('userthemes', '1'),
		('user_custom_offset_timezone', '0'),
		('validation', 'a:1:{s:8:\"register\";s:1:\"0\";}'),
		('version', '5.0.4-unstable-demo'),
		('visits_counter_enabled', '1');
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [smileys] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`code` varchar(50) NOT NULL,
		`image` varchar(100) NOT NULL,
		`text` varchar(100) NOT NULL,
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=16 ;");
	
	$query = $_pdo->exec("INSERT INTO [smileys] (`id`, `code`, `image`, `text`) VALUES
		(1, ':)', 'smile.png', 'Smile'),
		(2, ';)', 'wink.png', 'Wink'),
		(3, ':(', 'sad.png', 'Sad'),
		(4, ';(', 'cry.png', 'Cry'),
		(5, ':|', 'frown.png', 'Frown'),
		(6, ':o', 'shock.png', 'Shock'),
		(7, 'Oo', 'blink.png', 'Blink'),
		(8, ':P', 'pfft.png', 'Pfft'),
		(9, 'B)', 'cool.png', 'Cool'),
		(10, ';/', 'annoyed.png', 'Annoyed'),
		(11, ':D', 'grin.png', 'Grin'),
		(12, ':@', 'angry.png', 'Angry'),
		(13, '^^', 'joyful.png', 'Joyful'),
		(14, '-.-', 'pinch.png', 'Pinch'),
		(15, ':extreme:', '../favicon.ico', 'eXtreme-Fusion');
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [statistics] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`ip` varchar(20) NOT NULL DEFAULT '0.0.0.0',
		PRIMARY KEY (`id`),
		UNIQUE KEY `ip` (`ip`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [tags] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`supplement` varchar(100) NOT NULL DEFAULT '',
		`supplement_id` mediumint(8) unsigned NOT NULL,
		`value` text NOT NULL,
		`value_for_link` text NOT NULL,
		`access` varchar(255) NOT NULL DEFAULT '',
		PRIMARY KEY (`id`),
		KEY `supplement` (`supplement`) USING BTREE,
		KEY `supplement_id` (`supplement_id`) USING BTREE
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=8 ;");
	
	$query = $_pdo->exec("INSERT INTO [tags] (`id`, `supplement`, `supplement_id`, `value`, `value_for_link`, `access`) VALUES
		(1, 'NEWS', 1, 'Ninja Edition', 'ninja_edition', '3'),
		(2, 'NEWS', 1, 'eXtreme-Fusion Ninja Edition', 'extreme-fusion_ninja_edition', '3'),
		(3, 'NEWS', 1, 'http://extreme-fusion.org', 'http//extreme-fusionorg', '3'),
		(4, 'NEWS', 1, 'eXtreme-Fusion CMS', 'extreme-fusion_cms', '3'),
		(5, 'NEWS', 1, 'eXtreme-Fusion 5', 'extreme-fusion_5', '3'),
		(6, 'NEWS', 1, 'eXtreme-Fusion', 'extreme-fusion', '3'),
		(7, 'NEWS', 1, 'demo', 'demo', '3');
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [threads] (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `category_id` int(11) NOT NULL,
	  `user_id` int(11) NOT NULL,
	  `title` varchar(255) NOT NULL,
	  `is_pinned` tinyint(1) NOT NULL DEFAULT '0',
	  `timestamp` int(10) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=2 ;");
	
	$query = $_pdo->exec("INSERT INTO [threads] (`id`, `category_id`, `user_id`, `title`, `is_pinned`, `timestamp`) VALUES
		(1, 1, 1, 'Test post', 0, ".time().");
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [time_formats] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`value` varchar(100) NOT NULL DEFAULT '',
		PRIMARY KEY (`id`),
		UNIQUE KEY `value` (`value`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [users_data] (
		`user_id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(200) NOT NULL DEFAULT '',
		`old` varchar(200) NOT NULL DEFAULT '',
		`gg` varchar(200) NOT NULL DEFAULT '',
		`skype` varchar(200) NOT NULL DEFAULT '',
		`www` varchar(200) NOT NULL DEFAULT '',
		`location` varchar(200) NOT NULL DEFAULT '',
		`sig` text NOT NULL,
		PRIMARY KEY (`user_id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=2 ;");
	
	$query = $_pdo->exec("INSERT INTO [users_data] (`user_id`, `name`, `old`, `gg`, `skype`, `www`, `location`, `sig`) VALUES
		(1, '', '', '', '', '', '', '');
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [users_online] (
		`user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
		`ip` varchar(20) NOT NULL DEFAULT '0.0.0.0',
		`last_activity` int(10) unsigned NOT NULL DEFAULT '0',
		UNIQUE KEY `user` (`user_id`,`ip`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate.";");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [user_fields] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`name` varchar(50) NOT NULL,
		`index` varchar(50) NOT NULL,
		`cat` mediumint(8) unsigned NOT NULL DEFAULT '1',
		`type` smallint(6) NOT NULL DEFAULT '0',
		`option` text NOT NULL,
		`register` tinyint(4) NOT NULL DEFAULT '0',
		`hide` tinyint(4) NOT NULL DEFAULT '0',
		`edit` tinyint(4) NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=8 ;");
	
	$query = $_pdo->exec("INSERT INTO [user_fields] (`id`, `name`, `index`, `cat`, `type`, `option`, `register`, `hide`, `edit`) VALUES
		(1, 'Imię', 'name', 1, 1, '', 0, 0, 0),
		(2, 'Data urodzenia', 'old', 1, 1, '', 0, 0, 0),
		(3, 'Gadu-Gadu', 'gg', 2, 1, '', 0, 0, 0),
		(4, 'Skype', 'skype', 2, 1, '', 0, 0, 0),
		(5, 'Strona WWW', 'www', 2, 1, '', 0, 0, 0),
		(6, 'Miejscowość', 'location', 2, 1, '', 0, 0, 0),
		(7, 'Podpis', 'sig', 3, 2, '', 0, 0, 0);
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [user_field_cats] (
		`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		`name` varchar(200) NOT NULL,
		`order` smallint(5) unsigned NOT NULL,
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=4 ;");
	
	$query = $_pdo->exec("INSERT INTO [user_field_cats] (`id`, `name`, `order`) VALUES
		(1, 'Informacje', 1),
		(2, 'Informacje kontaktowe', 2),
		(3, 'Różne', 3);
	");
	
	$query = $_pdo->exec("CREATE TABLE IF NOT EXISTS [admin_favourites] (
	  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	  `user_id` mediumint(8) unsigned NOT NULL,
	  `page_id` mediumint(8) unsigned NOT NULL,
	  `count` mediumint(9) NOT NULL,
	  `time` int(10) unsigned NOT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY(`page_id`, `user_id`),
	CONSTRAINT FOREIGN KEY (`page_id`) REFERENCES [admin](`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES [users](`id`) ON DELETE CASCADE ON UPDATE CASCADE
	) ENGINE=InnoDB CHARACTER SET ".$charset." COLLATE ".$collate." AUTO_INCREMENT=1 ;");