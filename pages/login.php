<?php defined('EF5_SYSTEM') || exit;
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
| 
**********************************************************
                ORIGINALLY BASED ON
---------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Author: Nick Jones (Digitanium)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
$_head->set('<meta name="robots" content="noindex" />');

if ($_user->isLoggedIn())
{
	$theme = array(
		'Title' => 'Panel użytkownika - '.$_user->get('username').' &raquo; '.$_sett->get('site_name'),
		'Keys' => 'Wyloguj, edycja konta, prywatne wiadomości, konta użytkowników',
		'Desc' => 'Łatwy dostęp do najpotrzebniejszych miejsc na stronie.'
	);

	if ($_route->getAction())
	{
		HELP::redirect(base64_decode($_route->getAction()));
	}

	$_tpl->assign('is_logged_in', TRUE);

	$count = $_pdo->getMatchRowsCount('SELECT `id` FROM [messages] WHERE `to` = :id AND `read` = 0',
		array(
			array(':id', $_user->get('id'), PDO::PARAM_INT)
		)
	);

	if ($count)
	{
		$_tpl->assign('messages', __('Nieprzeczytanych wiadomości: :msg', array(':msg' => $count)));
	}

	if ($_user->hasPermission('admin.login'))
	{
		$_tpl->assign('is_admin', TRUE);
	}

	$_tpl->assign('url_logout', $_route->path(array('controller' => 'account', 'action' => 'logout')));
	$_tpl->assign('url_account', $_route->path(array('controller' => 'account')));
	$_tpl->assign('url_messages', $_route->path(array('controller' => 'messages')));
	$_tpl->assign('url_users', $_route->path(array('controller' => 'users')));
}
else
{
	$theme = array(
		'Title' => $_sett->get('site_name').' &raquo; Panel logowania',
		'Keys' => 'Zaloguj się, logowanie, rejestracja',
		'Desc' => 'Przez poniższy formularz możesz zalogować się do '.$_sett->get('site_name')
	);

	if ($_sett->get('enable_registration'))
	{
		$_tpl->assign('enable_reg', TRUE);

		$_tpl->assign('url_register', $_route->path(array('controller' => 'register')));
		$_tpl->assign('url_password', $_route->path(array('controller' => 'password')));
	}
}
