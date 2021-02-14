<?php
/**
*
* @package Usermap v0.10.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\controller;

//use Symfony\Component\HttpFoundation\Response;

class main
{

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\language\language $language Language object */
	protected $language;

	/** @var \phpbb\extension\manager */
	protected $phpbb_extension_manager;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\notification\manager */
	protected $notification_manager;

	/** @var \phpbb\log\log $log */
	protected $log;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string PHP extension */
	protected $php_ext;

	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\controller\helper $helper,
		\phpbb\template\template $template, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, \phpbb\language\language $language,
		\phpbb\extension\manager $phpbb_extension_manager, \phpbb\request\request_interface $request, \phpbb\notification\manager $notification_manager,
		\phpbb\log\log $log, $root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->helper = $helper;
		$this->template = $template;
		$this->db = $db;
		$this->user = $user;
		$this->language = $language;
		$this->phpbb_extension_manager 	= $phpbb_extension_manager;
		$this->request = $request;
		$this->notification_manager = $notification_manager;
		$this->log = $log;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;

		$this->ext_path = $this->phpbb_extension_manager->get_extension_path('mot/usermap', true);
		include_once($this->ext_path . 'includes/um_constants.' . $this->php_ext);
	}


	/**
	* {@inheritdoc}
	*/
	public function handle()
	{
		page_header($this->language->lang('USERMAP'));

		// Add the language variables for BBCodes
		$this->language->add_lang(array('posting'));

		// Get permissions
		$add_poi = $this->auth->acl_get('u_add_poi');
		$add_approve_poi = $this->auth->acl_get('u_add_poi_with_mod');
		$view_map = $this->auth->acl_get('u_view_map_always');
		$view_map_subscribed = $this->auth->acl_get('u_view_map_inscribed');
		$view_poi = $this->auth->acl_get('u_view_poi');

		// Get user id
		$user_id = $this->user->data['user_id'];

		add_form_key('poi_edit');
		$this->u_action = append_sid("{$this->root_path}app.$this->php_ext/usermap", "action=submit");
		$this->u_cancel = append_sid("{$this->root_path}app.$this->php_ext/usermap");

		if (!function_exists('usermap_back_link'))
		{
			include($this->ext_path . 'includes/functions_usermap.' . $this->php_ext);
		}

		$action = $this->request->variable('action', '');
		if ($action == 'submit')
		{
			if (check_form_key('poi_edit'))
			{
				$uid = $bitfield = '';
				$flags = OPTION_FLAG_LINKS + OPTION_FLAG_BBCODE;	// === 0b0101   ( this really is of no interest since this variable gets set in the called function according to every flag set to true
				$poi_name = $this->request->variable('usermap_poi_name', '', true);
				$popup_value = $this->request->variable('usermap_poi_popup', '', true);
				generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);
				$icon_size = $this->request->variable('usermap_poi_icon_size', '');
				$icon_anchor = $this->request->variable('usermap_poi_icon_anchor', '');

				$sql_arr = array(
					'name'			=> $poi_name,
					'popup'			=> $popup_value,
					'icon'			=> $this->request->variable('usermap_poi_icon', ''),
					'lat'			=> substr($this->request->variable('usermap_poi_lat', ''), 0, 20),
					'lng'			=> substr($this->request->variable('usermap_poi_lng', ''), 0, 20),
					'icon_size'		=> $icon_size == '' ? $this->config['mot_usermap_iconsize_default'] : $icon_size,
					'icon_anchor'	=> $icon_anchor == '' ? $this->config['mot_usermap_iconanchor_default'] : $icon_anchor,
					'creator_id'	=> $user_id,
				);

				if ($add_poi)
				{
					$sql_arr['disabled'] = 0;
				}
				else if ($add_approve_poi)
				{
					$sql_arr['disabled'] = 1;
				}

				// store the data in the USERMAP_POI_TABLE
				$sql = 'INSERT INTO ' . USERMAP_POI_TABLE . ' ' . $this->db->sql_build_array('INSERT', $sql_arr);
				$this->db->sql_query($sql);
				$poi_id = $this->db->sql_nextid();	// returns a string

				// log the action
//				$this->log->add('user', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_POI_NEW', false, array($poi_name));

				// get the users supposed to get notified of a new POI
				$query = 'SELECT user_id
						FROM  ' . USERS_TABLE . '
						WHERE ' . $this->db->sql_in_set('user_type', array(USER_NORMAL, USER_FOUNDER)) . '
						ORDER BY user_id ASC';
				$result = $this->db->sql_query($query);
				$users_total = $this->db->sql_fetchrowset($result);
				$this->db->sql_freeresult($result);
				$users_all = array();
				foreach ($users_total as $row)
				{
					$users_all[] = $row['user_id'];
				}
				$usermap_mods = $this->auth->acl_get_list($users_all, 'm_release_poi');

				// prepare users data for the notification message
				if (!function_exists('get_username_string'))
				{
					include($this->root_path . 'includes/functions_content.' . $this->php_ext);
				}
				$display_username = get_username_string('no_profile', $user_id, $this->user->data['username'], $this->user->data['user_colour']);

				// prepare notification data
				$notification_data = array(
					'poi_id'			=> $poi_id,
					'poi_name'			=> $poi_name,
					'creator'			=> $this->user->data['username'],
					'display_username'	=> $display_username,
					'user_ids'			=> $usermap_mods[0]['m_release_poi'],
				);

				if ($add_poi)
				{
					$notification_data = array_merge($notification_data, array('work_mode' => 'notify'));
					// notify moderators that a new POI has been created
					$this->notification_manager->add_notifications('mot.usermap.notification.type.notify_poi', $notification_data);

					// tell user about success
					trigger_error($this->language->lang('POI_NEW_SAVED') . usermap_back_link($this->root_path."usermap", $this->language->lang('BACK_TO_PREV')), E_USER_NOTICE);
				}
				else if ($add_approve_poi)
				{
					$notification_data = array_merge($notification_data, array('work_mode' => 'approve'));
					// notify moderators about this new POI awaiting approval
					$this->notification_manager->add_notifications('mot.usermap.notification.type.approve_poi', $notification_data);

					// tell user about success
					trigger_error($this->language->lang('POI_MOD_NOTIFIED') . usermap_back_link($this->root_path."usermap", $this->language->lang('BACK_TO_PREV')), E_USER_NOTICE);
				}
			}
			else
			{
				trigger_error($this->language->lang('FORM_INVALID') . usermap_back_link("{$this->root_path}usermap", $this->language->lang('BACK_TO_PREV')), E_USER_WARNING);
			}
		}

		/*
		*	get configuration values to send them to javascript for initialising the map
		*/
		$usermap_config = $this->config['mot_usermap_lat'] . '|' .$this->config['mot_usermap_lon'] . '|' . $this->config['mot_usermap_zoom'] . '|' .
						$this->config['mot_usermap_markers_pc'] . '|' . $this->config['mot_usermap_markers_mob'];
		$server_config = $this->config['server_protocol'] . $this->config['server_name'] . $this->config['script_path'];
		$poi_enabled = $this->config['mot_usermap_poi_enable'];

		/*
		*	Get data of current user
		*/
		$sql_arr = array(
			'user_id'	=> $user_id,
		);
		$query = 'SELECT * FROM ' . USERMAP_USERS_TABLE . '
				WHERE ' . $this->db->sql_build_array('SELECT', $sql_arr);
		$result = $this->db->sql_query($query);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		if (!empty($row))
		{
			$current_user = $row['user_id']."|".$row['username']."|".$row['user_plz']."|".$row['user_lat']."|".$row['user_lng'];
			$zip_code = '"'.$row['user_land'].'-'.$row['user_plz'].'"';
			$valid_user = 1;			// the current user is listed in the usermap_users table and therefore authorized to use the map search - MUST NOT be true since js needs 1 or 0 instead of boolean values
		}
		else
		{
			$current_user = "0|''|0|0|0";
			$zip_code = 0;
			$valid_user = 0;			// the current user is NOT listed in the usermap_users table and therefore NOT authorized to use the map search - MUST NOT be false since js needs 1 or 0 instead of boolean values
		}

		/*
		*	Get usermap users data
		*/
		$query = 'SELECT user_id, username, user_colour, user_lat, user_lng FROM ' . USERMAP_USERS_TABLE . ' ORDER BY user_id DESC';
		$result = $this->db->sql_query($query);
		$user_data = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		$map_users = count($user_data);

		/*
		*	Get user groups for the map legend
		*/
		$order_legend = ($this->config['legend_sort_groupname']) ? 'group_name' : 'group_legend';
		$sql = 'SELECT group_id, group_name, group_colour, group_type
			FROM ' . GROUPS_TABLE . '
			WHERE group_legend > 0
			ORDER BY ' . $order_legend . ' ASC';
		$result = $this->db->sql_query($sql);

		$usergroup_legend = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$colour_text = ($row['group_colour']) ? ' style="color:#' . $row['group_colour'] . '"' : '';
			$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $this->language->lang('G_' . $row['group_name']) : $row['group_name'];

			if ($this->user->data['user_id'] == ANONYMOUS && !$this->auth->acl_get('u_viewprofile'))
			{
				$usergroup_legend[] = '<span' . $colour_text . '>' . $group_name . '</span>';
			}
			else
			{
				$usergroup_legend[] = '<a' . $colour_text . ' href="' . append_sid("{$this->root_path}memberlist.{$this->php_ext}", 'mode=group&amp;g=' . $row['group_id']) . '">' . $group_name . '</a>';
			}
		}
		$this->db->sql_freeresult($result);

		$usergroup_legend = implode(', ', $usergroup_legend);

		/*
		*	Get poi data if poi display is enabled
		*/
		if ($poi_enabled)
		{
			$uid = $bitfield = '';
			$flags = OPTION_FLAG_LINKS + OPTION_FLAG_BBCODE;	// === 0b0101   ( this really is of no interest since this variable gets set in the called function according to every flag set to true
			$poi_legend = generate_text_for_display($this->config_text->get('mot_usermap_poi_legend'), $uid, $bitfield, $flags);

			$query = 'SELECT * FROM ' . USERMAP_POI_TABLE . ' ORDER BY poi_id ASC';
			$result = $this->db->sql_query($query);
			$poi_data = $this->db->sql_fetchrowset($result);
			$this->db->sql_freeresult($result);

			foreach ($poi_data as &$row)
			{
				$row['popup'] = generate_text_for_display($row['popup'], $uid, $bitfield, $flags);
			}

			$this->template->assign_vars(array(
				'POIDATA'					=> json_encode($poi_data, true),
				'POI_VIEW'					=> $view_poi ? 1 : 0,
				'POI_CREATE'				=> ($add_poi || $add_approve_poi) ? 1 : 0,
				'POI_LEGEND'				=> $poi_legend,
				'POI_ALREADY_APPROVED'		=> false,
				'USERMAP_POI_ICON_SIZE'		=> $this->config['mot_usermap_iconsize_default'],
				'USERMAP_POI_ICON_ANCHOR'	=> $this->config['mot_usermap_iconanchor_default'],
				'DEFAULT_POI_ICON_SIZE'		=> $this->config['mot_usermap_iconsize_default'],
				'DEFAULT_POI_ICON_ANCHOR'	=> $this->config['mot_usermap_iconanchor_default'],
				'WORK_MODE'					=> 'modal',
				'S_BBCODE_ALLOWED'			=> $this->config['allow_bbcode'] ? true : false,
				'S_LINKS_ALLOWED'			=> $this->config['allow_post_links'] ? true : false,
				'MAX_FONT_SIZE'				=> (int) $this->config['max_post_font_size'],
				'U_ACTION'					=> $this->u_action,
				'U_CANCEL'					=> $this->u_cancel,
				'ERROR_MSG'					=> $this->language->lang('ACP_USERMAP_DATABASE_ERROR', $this->language->lang('ACP_USERMAP_POI_NAME')),
			));
		}

		$this->template->assign_vars(array(
			'USER'						=> json_encode($current_user),
			'VALID_USER'				=> $valid_user,
			'MAPCONFIG'					=> json_encode($usermap_config),
			'SERVERCONFIG'				=> json_encode($server_config),
			'MAPDATA'					=> json_encode($user_data),
			'MAP_USERS'					=> $this->language->lang('MAP_USERS', (int) $map_users),
			'MAP_LEGEND'				=> $usergroup_legend,
			'MAP_SEARCH'				=> $this->language->lang('MAP_SEARCH', $zip_code),
			'POI_ENABLED'				=> $poi_enabled,
			'VIEW_MAP_ALWAYS'			=> $view_map ? 1 : 0,
			'VIEW_MAP_SUBSRIBED'		=> $view_map_subscribed ? 1 : 0,
			)
		);

		if (!function_exists('get_icons'))
		{
			include($this->ext_path . 'includes/functions_usermap.' . $this->php_ext);
		}
		$icon_files = array();
		$icon_files = get_icons($this->ext_path . 'styles/all/theme/images/poi/');
		foreach ($icon_files as $value)
		{
			$this->template->assign_block_vars('poi_icon', array(
				'VALUE'		=> $value,
			));
		}

		return $this->helper->render('usermap_main.html');
	}

}
