<?php

/**
*
* @package Usermap v1.2.6
* @copyright (c) 2019 - 2024 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap;

class ext extends \phpbb\extension\base
{
	protected $error_message = [];
	protected $phpbb_min_ver = '3.2.0';
	protected $phpbb_below_ver = '3.4.0@dev';
	protected $php_min_ver = '7.2.24';
	protected $php_below_ver = '8.5.0';

	public function is_enableable()
	{
		// Set the language element depending on the phpBB version (3.1.x uses the $user->lang object)
		if (phpbb_version_compare(PHPBB_VERSION, '3.2.0', '<'))
		{
			$language = $this->container->get('user');
			$language->add_lang_ext('mot/usermap', 'mot_usermap_ext_enable_error');
		}
		else
		{
			$language = $this->container->get('language');
			$language->add_lang('mot_usermap_ext_enable_error', 'mot/usermap');
		}
		$ext_name = $language->lang('MOT_USERMAP_NAME');

		// Check requirements
		if (!$this->phpbb_requirement())
		{
			$this->error_message[] = $language->lang('MOT_USERMAP_ERROR_MESSAGE_PHPBB_VERSION', $this->phpbb_min_ver, $this->phpbb_below_ver);
		}

		if (!$this->php_requirement())
		{
			$this->error_message[] = $language->lang('MOT_USERMAP_PHP_VERSION_ERROR', $this->php_min_ver, $this->php_below_ver);
		}

		if (!empty($this->error_message))
		{
			// Insert general message at the beginning
			array_unshift($this->error_message, $language->lang('MOT_USERMAP_ERROR_EXTENSION_NOT_ENABLE', $ext_name));
			// phpBB versions before 3.3.0 must use 'trigger_error'
			if (phpbb_version_compare(PHPBB_VERSION, '3.3.0', '<'))
			{
				$this->error_message = implode('<br>', $this->error_message);
				trigger_error($this->error_message, E_USER_WARNING);
			}
		}
		return empty($this->error_message) ? true : $this->error_message;
	}

	protected function phpbb_requirement()
	{
		return (phpbb_version_compare(PHPBB_VERSION, $this->phpbb_min_ver, '>=') && phpbb_version_compare(PHPBB_VERSION, $this->phpbb_below_ver, '<'));
	}

	protected function php_requirement()
	{
		return phpbb_version_compare(PHP_VERSION, $this->php_min_ver, '>') && phpbb_version_compare(PHP_VERSION, $this->php_below_ver, '<');
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
