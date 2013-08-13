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
try
{
	require_once '../../../system/sitecore.php';
        include DIR_MODULES.'google_analytics/class/gapi.php';
        
	if ($_user->isLoggedIn())
	{
		if ($_user->hasPermission('module.google_analytics.preview'))
		{
			$google_analytics_list = $_system->cache('google_analytics_data', NULL, 'google_analytics', 86700);
			
			if ($google_analytics_list === NULL)
			{
				$row = $_pdo->getRow('SELECT * FROM [google_analytics_sett]');
                        
				$google_analytics = new Gapi($row['email'], $row['password']);

				$dimensions = array(
								'source',
								'networkDomain',
								'browser',
								'browserVersion',
								'operatingSystem',
								'operatingSystemVersion',
								'country'
				);

				$metrics = array(
								'pageviews',
								'visits'
				);

				$google_analytics->requestReportData($row['account_id'], $dimensions, $metrics, '-visits');

				$google_analytics_list = '{"aaData":[';
				if ( ! is_array($google_analytics->_error))
				{
						foreach ($google_analytics->getResults() as $result)
						{
								$google_analytics_list .= '["'.$result->networkDomain().'","'.$result->source().'","'.$result->browser().' '.$result->browserVersion().'","'.$result->operatingSystem().' '.$result->operatingSystemVersion().'","'. $result->country().'","'.number_format($result->getPageviews(), 0, '', '.').'","'.number_format($result->getVisits(), 0, '', '.').'"],';
						}
				}
				$google_analytics_list .= ']}';
				$google_analytics_list = str_replace(',]}', ']}', $google_analytics_list);

				$_system->cache('google_analytics_data', $google_analytics_list, 'google_analytics');
			}
                        
			_e($google_analytics_list);
		}
                
		$google_analytics_list = '{"aaData":[';
		$google_analytics_list .= ']}';
		_e($google_analytics_list);
	}
}
catch(optException $exception)
{
    optErrorHandler($exception);
}
catch(systemException $exception)
{
    systemErrorHandler($exception);
}
catch(userException $exception)
{
    userErrorHandler($exception);
}
catch(PDOException $exception)
{
    PDOErrorHandler($exception);
}