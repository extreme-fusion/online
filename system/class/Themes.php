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

class Theme extends optClass
{
	public $_sett;
	private $_tpl_file_name;

	protected $_system;
	
	protected $_statistics;


	/**
	 * Przypisuje do zmiennych klasy ustawień oraz bazy danych.
	 *
	 * @param   Sett	  klasa ustawień systemu
	 * @param   Database  klasa bazy danych
	 * @return  void
	 */
	public function __construct(Sett $sett, System $system, $user, $pdo, $request, $route, $head, $tpl_file_name = NULL)
	{
		$this->_sett = $sett;
		$this->_user = $user;
		$this->_pdo = $pdo;
		$this->_system = $system;
		$this->_request = $request;
		$this->_route = $route;
		$this->_head = $head;
		$this->_theme = $sett->get('theme');
		$this->setConfig();
		$this->_tpl_file_name = $tpl_file_name;
		
		$this->_head->set('
			<link href="'.ADDR_COMMON_CSS.'facebox.css" rel="stylesheet">'.PHP_EOL.'
			<script src="'.ADDR_COMMON_JS.'facebox.js"></script>'.PHP_EOL.'
			<script>$(function() {
				$(\'a[rel*=facebox]\').facebox();
			});</script>
		');
	
	}
	
	public function setStatisticsInst($_inst)
	{
		$this->_statistics = $_inst;
	}

	protected function setConfig()
	{
		$this->setCompilePrefix('themes_');
		$this->root            = DIR_THEMES.$this->_theme.DS.'templates'.DS;
		$this->compile         = DIR_CACHE;
		$this->cache           = DIR_SITE.'cache'.DS;
		$this->gzipCompression = 0;
		//$this->httpHeaders(OPT_HTML);
	}

	public function template($iframe)
	{
		$this->assign('ADDR_SITE', ADDR_SITE);
		$this->assign('THEME_ADDRESS', ADDR_SITE.'themes/'.$this->_theme.'/');
		$this->assign('DIR_IMAGES', DIR_IMAGES);
		$this->assign('THEME_IMAGES', THEME_IMAGES);
		$this->assign('BASE_INCLUDES', ADDR_SITE.'system/includes/');
		$this->assign('ADDR_IMAGES', ADDR_SITE.'templates/images/');
		$this->assign('SYSTEM_IMAGES', ADDR_SITE.'images/');
		$this->assign('THEME_TEMPLATE_IMAGES', ADDR_SITE.'themes/'.$this->_theme.'/templates/images/');
		$this->assign('THEME_TEMPLATE_STYLES', ADDR_SITE.'themes/'.$this->_theme.'/templates/stylesheet/');
		$this->assign('THEME_TEMPLATE_JAVA_SCRIPT', ADDR_SITE.'themes/'.$this->_theme.'/templates/js/');
		$this->assign('URL_REQUEST', URL_REQUEST);

		$this->assign('SystemVersion', 'eXtreme-Fusion '.$this->_sett->get('version'));
		$this->assign('getTryLogin', $this->_user->getTryLogin());

		if ($this->_user->isLoggedIn())
		{
			$this->assign('IsLoggedIn', TRUE);
			$this->assign('UserName', $this->_user->getUsername($this->_user->get('id')));
			//Zwraca dane zalogowanego usera
			$this->assign('User', $this->_user->get());

			if ($this->_user->hasPermission('admin.login'))
			{
				$this->assign('IsAdmin', TRUE);
			}
		}
		else
		{
			if ($this->_sett->get('enable_registration'))
			{
				$this->assign('EnableReg', TRUE);
			}
		}

		$count = $this->_pdo->getMatchRowsCount('SELECT `id` FROM [messages] WHERE `to` = :id AND `read` = 0',
			array(
				array(':id', $this->_user->get('id'), PDO::PARAM_INT)
			)
		);
		if ($count)
		{
			$this->assign('Msg', $count);
		}

		if ($this->_request->get('action')->show())
		{
			$this->assign('Action', $this->_request->get('action')->show());
		}

		if ($this->_request->get('page')->show())
		{
			$this->assign('Page', $this->_request->get('page')->show());
		}

		$this->parse($iframe);
		// Usuwanie danych z bufora OPT
		$this->data = array();
	}

	// Sprawdza, czy plik istnieje w katalogu szablonu
	// Opuszczenie pierwszego parametru spowoduje, że poszukiwany bedzie plik aktualnie otwartej podstrony.
	// Drugi parametr pozwala na określenie katalogu przeszukiwania szablonu, np. $_theme->tplExists('file.tpl', 'pages'.DS);
	// UWAGA! Dla elementów nieobsługiwanych przez główny router, np. ajaxa, zmienna klasowa $this->_tpl_file_name ma wartość NULL,
	// więc w takich przypadkach zawsze trzeba podawać parametr pierwszy tej metody
	public function tplExists($file = NULL, $dir = NULL)
	{
		if ($file === NULL)
		{
			$file = $this->_tpl_file_name;
		}

		if ($dir)
		{
			return file_exists(DIR_THEME.str_replace('.', '', $dir).$file);
		}

		return file_exists(DIR_THEME.'templates'.DS.'pages'.DS.$file);
	}

	public function panelState($state, $bname)
	{
		$bname = preg_replace('/[^a-zA-Z0-9\s]/', '_', $bname);

		if (isset($_COOKIE['eXtreme_box_'.$bname]))
		{
			if ($_COOKIE['eXtreme_box_'.$bname] === 'none')
			{
				$state = 'off';
			}
			else
			{
				$state = 'on';
			}
		}

		return '<div id="box_'.$bname.'"'.($state === 'off' ? ' style="display:none"' : '').'>';
	}

	function panelButton($state, $bname)
	{
		$bname = preg_replace('/[^a-zA-Z0-9\s]/', '_', $bname);
		if (isset($_COOKIE['eXtreme_box_'.$bname]))
		{
			if ($_COOKIE['eXtreme_box_'.$bname] == 'none')
			{
				$state = 'off';
			}
			else
			{
				$state = 'on';
			}
		}
		return '<img src="'.ADDR_THEME.'templates/images/panel_'.($state == 'on' ? 'off' : 'on').'.gif" id="box_'.$bname.'" class="panelbutton" alt="" onclick="javascript:flipBox('.$bname.')" />';
	}

	public function showCopyright($license = FALSE, $class = FALSE)
	{
		if ($license)
		{
			return __('Powered by :system under :license License', array(':system' => '<a href="http://extreme-fusion.org/"'.($class ? ' class="'.$class.'"' : '').' rel="copyright">eXtreme-Fusion 5</a>', ':license' => '<a href="'.ADDR_SITE.'LICENSE"'.($class ? ' class="'.$class.'"' : '').' rel="copyright">aGPL v3</a>'))."\n";
		}

		return __('Powered by :system', array(':system' => '<a href="http://extreme-fusion.org/"'.($class ? ' class="'.$class.'"' : '').' rel="copyright">eXtreme-Fusion 5</a>'))."\n";
	}



	public function showAdminLinks($class = FALSE)
	{
		if ($this->_user->hasPermission('admin.login'))
		{
			return '<a href="'.ADDR_ADMIN.'"'.($class ? ' class="'.$class.'"' : '').'><span>'.__('Admin Control Panel').'</span></a>';
		}
	}

	public function showBanners()
	{
		ob_start();
		if ($this->_sett->get('site_banner2'))
		{
			eval("?><div style='float: right;'>".stripslashes($this->_sett->get('site_banner2'))."</div>\n<?php ");
		}
		if ($this->_sett->get('site_banner1'))
		{
			eval("?>".stripslashes($this->_sett->get('site_banner1'))."\n<?php ");
		}
		elseif ($this->_sett->get('site_banner'))
		{
			echo "<a href='".ADDR_SITE."'><img src='".ADDR_SITE.$this->_sett->get('site_banner')."' alt='".$this->_sett->get('site_name')."' style='border: 0;' /></a>\n";
		}
		else
		{
			echo "<a href='".ADDR_SITE."'>".$this->_sett->get('site_name')."</a>\n";
		}

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	public function showSubLinks($sep = "&middot;", $class = "")
	{
		$query = $this->_pdo->getData(
			"SELECT `name`, `url`, `window`, `visibility`, `rewrite` FROM [navigation]
			WHERE `position`='2' OR `position`='3' ORDER BY `order`"
		);
		if ($this->_pdo->getRowsCount($query))
		{
			$i = 0; $menu = array();
			foreach($query as $sdata)
			{
				if ($sdata['url'] != "---" && $this->_user->hasAccess($sdata['visibility']))
				{
					$menu[] = array(
						'sep' => $sep,
						'link' => HELP::createNaviLink($sdata['url'], !$sdata['rewrite']),
						//'name' => HELP::parseBBCode($sdata['name'], "b|i|u|color"),
						'name' => $sdata['name'],
						'target' => $sdata['window'] == '1' ? TRUE : FALSE,
						'class' => ($i == 0 ? 'first-link'.($class ? ' '.$class : '') : ($class ? $class : '')),
						'selected' =>  $this->_route->getFileName() == pathinfo($sdata['url'], PATHINFO_FILENAME) ? TRUE : FALSE
					);
					$i++;
				}
			}
			return $menu;
		}
	}
	
	public function getVisitsCount()
	{
		if ($this->_statistics)
		{
			return $this->_statistics->getUniqueVisitsCount();
		}
		
		return NULL;
	}
}

class TPL
{
	protected static $_obj;

	public static function build($obj)
	{
		self::$_obj = $obj;
	}

	public static function this()
	{
		return self::$_obj;
	}

	public static function get()
	{
		return self::$_obj->data;
	}
}