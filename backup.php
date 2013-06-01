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
require_once DIR_SYSTEM.'helpers/main.php';


	ob_start();

    $ec = new Container(array('pdo.config' => $_dbconfig));

	# PHP Data Object
    $_pdo = $ec->pdo;
	
	# System
	$_system = $ec->system;
	
	$_system->clearCache();
	$_system->clearCache('news');
	$_system->clearCache('statistics');
	$_system->clearCache('system');

	/*$query = $_pdo->exec('DROP TABLE [admin]');
	$query = $_pdo->exec('DROP TABLE [bbcodes]');
	$query = $_pdo->exec('DROP TABLE [blacklist]');
	$query = $_pdo->exec('DROP TABLE [comments]');
	$query = $_pdo->exec('DROP TABLE [groups]');
	$query = $_pdo->exec('DROP TABLE [links]');
	$query = $_pdo->exec('DROP TABLE [logs]');
	$query = $_pdo->exec('DROP TABLE [messages]');
	$query = $_pdo->exec('DROP TABLE [modules]');
	$query = $_pdo->exec('DROP TABLE [navigation]');
	$query = $_pdo->exec('DROP TABLE [news]');
	$query = $_pdo->exec('DROP TABLE [news_cats]');
	$query = $_pdo->exec('DROP TABLE [notes]');
	$query = $_pdo->exec('DROP TABLE [pages]');
	$query = $_pdo->exec('DROP TABLE [pages_categories]');
	$query = $_pdo->exec('DROP TABLE [pages_custom_settings]');
	$query = $_pdo->exec('DROP TABLE [pages_types]');
	$query = $_pdo->exec('DROP TABLE [panels]');
	$query = $_pdo->exec('DROP TABLE [permissions]');
	$query = $_pdo->exec('DROP TABLE [permissions_sections]');
	$query = $_pdo->exec('DROP TABLE [setings]');
	$query = $_pdo->exec('DROP TABLE [smileys]');
	$query = $_pdo->exec('DROP TABLE [statistics]');
	$query = $_pdo->exec('DROP TABLE [tags]');
	$query = $_pdo->exec('DROP TABLE [time_formats]');
	$query = $_pdo->exec('DROP TABLE [users]');
	$query = $_pdo->exec('DROP TABLE [users_data]');
	$query = $_pdo->exec('DROP TABLE [users_online]');
	$query = $_pdo->exec('DROP TABLE [user_fields]');
	$query = $_pdo->exec('DROP TABLE [user_field_cats]');*/
	
	
	
	print_r(' tak');
