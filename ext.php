<?php

/**
*
* @package Usermap v0.10.0
* @copyright (c) 2019, 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap;

class ext extends \phpbb\extension\base
{
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return phpbb_version_compare($config['version'], '3.2.0', '>=');
	}

	public function enable_step($old_state)
	{
		switch ($old_state)
		{
			case '': // Empty means nothing has run yet
				$phpbb_notifications = $this->container->get('notification_manager');
				$phpbb_notifications->enable_notifications('mot.usermap.notification.type.approve_poi');
				$phpbb_notifications->enable_notifications('mot.usermap.notification.type.notify_poi');

				return 'notifications';
			break;

			default:
				return parent::enable_step($old_state);
			break;
		}
	}

	public function disable_step($old_state)
	{
		switch ($old_state)
		{
			case '': // Empty means nothing has run yet
				$phpbb_notifications = $this->container->get('notification_manager');
				$phpbb_notifications->disable_notifications('mot.usermap.notification.type.approve_poi');
				$phpbb_notifications->disable_notifications('mot.usermap.notification.type.notify_poi');

				return 'notifications';
			break;

			default:
				return parent::disable_step($old_state);
			break;
		}
	}

	public function purge_step($old_state)
	{
		switch ($old_state)
		{
			case '': // Empty means nothing has run yet
				try
				{
					$phpbb_notifications = $this->container->get('notification_manager');
					$phpbb_notifications->purge_notifications('mot.usermap.notification.type.approve_poi');
					$phpbb_notifications->purge_notifications('mot.usermap.notification.type.notify_poi');
				}
				catch (\phpbb\notification\exception $e)
				{
					// continue
				}

				return 'notifications';
			break;

			default:
				return parent::purge_step($old_state);
			break;
		}
	}
}
