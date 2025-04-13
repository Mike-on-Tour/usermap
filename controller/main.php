<?php
/**
*
* @package Usermap v1.3.0
* @copyright (c) 2020 - 2025 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\controller;

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

	/** @var \phpbb\language\language $language */
	protected $language;

	/** @var \phpbb\extension\manager */
	protected $phpbb_extension_manager;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\notification\manager */
	protected $notification_manager;

	/** @var \phpbb\log\log $log */
	protected $log;

	/** @var \mot\usermap\includes\functions_usermap */
	protected $usermap_functions;

	/** @var string PHP extension */
	protected $php_ext;

	/** @var string phpBB phpbb root path */
	protected $root_path;

	/** @var string mot.usermap.tables.usermap_users */
	protected $mot_usermap_users_table;

	/** @var string mot.usermap.tables.usermap_poi */
	protected $mot_usermap_poi_table;

	/** @var string mot.usermap.tables.usermap_layers */
	protected $mot_usermap_layer_table;

	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\controller\helper $helper,
		\phpbb\template\template $template, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, \phpbb\language\language $language,
		\phpbb\extension\manager $phpbb_extension_manager, \phpbb\request\request_interface $request, \phpbb\notification\manager $notification_manager,
		\phpbb\log\log $log, \mot\usermap\includes\functions_usermap $usermap_functions, $php_ext, $root_path, $mot_usermap_users_table,
		$mot_usermap_poi_table, $mot_usermap_layer_table)
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
		$this->usermap_functions = $usermap_functions;
		$this->php_ext = $php_ext;
		$this->root_path = $root_path;
		$this->usermap_users_table = $mot_usermap_users_table;
		$this->usermap_poi_table = $mot_usermap_poi_table;
		$this->usermap_layer_table = $mot_usermap_layer_table;

		$this->ext_path = $this->phpbb_extension_manager->get_extension_path('mot/usermap', true);
		$this->md_manager = $this->phpbb_extension_manager->create_extension_metadata_manager('mot/usermap');
		$this->ext_data = $this->md_manager->get_metadata();
	}


	/**
	* {@inheritdoc}
	*/
	public function handle()
	{
		$this->google_key = $this->config['mot_usermap_google_apikey'];

		// Add the language variables for BBCodes
		$this->language->add_lang(['posting']);

		// Get permissions
		$add_poi = $this->auth->acl_get('u_add_poi');
		$add_approve_poi = $this->auth->acl_get('u_add_poi_with_mod');
		$view_map = $this->auth->acl_get('u_view_map_always');
		$view_map_subscribed = $this->auth->acl_get('u_view_map_inscribed');
		$view_poi = $this->auth->acl_get('u_view_poi');

		// Get user id
		$user_id = $this->user->data['user_id'];

		add_form_key('poi_edit');

		$usermap_mods = [];

		$flags = OPTION_FLAG_LINKS + OPTION_FLAG_BBCODE;	// === 0b0101   ( this really is of no interest since this variable gets set in the called function according to every flag set to true
		$name_flags = 0;
		$uid = $bitfield = '';
		$usermap_result = [];
		$usermap_result['type'] = 'none';
		$usermap_config = [];

		$action = $this->request->variable('action', '');

		switch ($action)
		{
			case 'submit':
				if (check_form_key('poi_edit'))
				{
					setlocale(LC_ALL, 'C');
					$uid = $bitfield = '';
					// Get the POIs name
					$poi_name = $this->request->variable('usermap_poi_name', '', true);
					// Decode double quotes
					$poi_name = htmlspecialchars_decode($poi_name, ENT_COMPAT);
					// Remove some unwanted characters
					$poi_name = str_replace($this->usermap_functions::MOT_USERMAP_POI_NONECHARS, '', $poi_name);
					$poi_name = trim($poi_name);
					$poi_name = trim($poi_name, ',');

					$popup_value = $this->request->variable('usermap_poi_popup', '', true);
					generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);
					$icon_size = $this->request->variable('usermap_poi_icon_size', '');
					$icon_anchor = $this->request->variable('usermap_poi_icon_anchor', '');

					$sql_arr = [
						'name'			=> $poi_name,
						'popup'			=> $popup_value,
						'icon'			=> $this->request->variable('usermap_poi_icon', ''),
						'lat'			=> $this->request->variable('usermap_poi_lat', 0.0),
						'lng'			=> $this->request->variable('usermap_poi_lng', 0.0),
						'icon_size'		=> $icon_size == '' ? $this->config['mot_usermap_iconsize_default'] : $icon_size,
						'icon_anchor'	=> $icon_anchor == '' ? $this->config['mot_usermap_iconanchor_default'] : $icon_anchor,
						'creator_id'	=> $user_id,
						'layer_id'		=> $this->request->variable('usermap_poi_layer', 0),
					];

					if ($add_poi)
					{
						$sql_arr['disabled'] = 0;
					}
					else if ($add_approve_poi)
					{
						$sql_arr['disabled'] = 1;
					}

					// store the data in the USERMAP_POI_TABLE
					$sql = 'INSERT INTO ' . $this->usermap_poi_table . ' ' . $this->db->sql_build_array('INSERT', $sql_arr);
					$this->db->sql_query($sql);
					$poi_id = $this->db->sql_nextid();	// returns a string

					// get the users supposed to get notified of a new POI
					$query = 'SELECT user_id
							FROM  ' . USERS_TABLE . '
							WHERE ' . $this->db->sql_in_set('user_type', [USER_NORMAL, USER_FOUNDER]) . '
							ORDER BY user_id ASC';
					$result = $this->db->sql_query($query);
					$users_total = $this->db->sql_fetchrowset($result);
					$this->db->sql_freeresult($result);
					$users_all = [];
					foreach ($users_total as $row)
					{
						$users_all[] = $row['user_id'];
					}
					$usermap_mods = $this->auth->acl_get_list($users_all, 'm_release_poi');

					// Make sure we have at least an empty array to prevent errors
					if (empty($usermap_mods))
					{
						$usermap_mods[0]['m_release_poi'] = [];
					}

					// prepare users data for the notification message
					if (!function_exists('get_username_string'))
					{
						include($this->root_path . 'includes/functions_content.' . $this->php_ext);
					}
					$display_username = get_username_string('no_profile', $user_id, $this->user->data['username'], $this->user->data['user_colour']);

					// prepare notification data
					$notification_data = [
						'poi_id'			=> $poi_id,
						'poi_name'			=> $poi_name,
						'creator'			=> $this->user->data['username'],
						'display_username'	=> $display_username,
						'user_ids'			=> $usermap_mods[0]['m_release_poi'],
						'parent'			=> 0,
					];

					if ($add_poi)
					{
						$notification_data = array_merge($notification_data, ['work_mode' => 'notify']);
						// notify moderators that a new POI has been created
						$this->notification_manager->add_notifications('mot.usermap.notification.type.notify_poi', $notification_data);

						// tell user about success
						trigger_error($this->language->lang('POI_NEW_SAVED') . $this->usermap_functions->usermap_back_link($this->helper->route('mot_usermap_route'), $this->language->lang('BACK_TO_PREV')), E_USER_NOTICE);
					}
					else if ($add_approve_poi)
					{
						$notification_data = array_merge($notification_data, ['work_mode' => 'approve']);
						// notify moderators about this new POI awaiting approval
						$this->notification_manager->add_notifications('mot.usermap.notification.type.approve_poi', $notification_data);

						// tell user about success
						trigger_error($this->language->lang('POI_MOD_NOTIFIED') . $this->usermap_functions->usermap_back_link($this->helper->route('mot_usermap_route'), $this->language->lang('BACK_TO_PREV')), E_USER_NOTICE);
					}
				}
				else
				{
					trigger_error($this->language->lang('FORM_INVALID') . $this->usermap_functions->usermap_back_link($this->helper->route('mot_usermap_route'), $this->language->lang('BACK_TO_PREV')), E_USER_WARNING);
				}
				break;

			//	check whether Usermap was called via BBCode
			case 'bbcode_user':
				$look_for = $this->request->variable('look_for', '', true);
				$sql = 'SELECT user_id FROM ' . USERS_TABLE . '
						WHERE username_clean = "' . $this->db->sql_escape(strtolower($look_for)) . '"';
				$result = $this->db->sql_query($sql);
				$look_for_id = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);
				if (!empty($look_for_id) && $look_for_id['user_id'] > 1)	// we got a valid user
				{
					$sql = 'SELECT * FROM ' . $this->usermap_users_table . '
							WHERE user_id = ' . (int) $look_for_id['user_id'];
					$result = $this->db->sql_query($sql);
					$usermap_result = $this->db->sql_fetchrow($result);
					$this->db->sql_freeresult($result);
					if (empty($usermap_result))
					{
						trigger_error($this->language->lang('USERMAP_NO_MATCH_FOUND', $look_for), E_USER_WARNING);
					}
					$usermap_result['type'] = 'User';
				}
				break;

			case 'bbcode_poi':
				$look_for_poi = $look_for = $this->request->variable('look_for', '', true);
				generate_text_for_storage($look_for_poi, $uid, $bitfield, $name_flags);
				$sql = 'SELECT lat, lng, layer_id FROM ' . $this->usermap_poi_table . '
						WHERE name = "' . (string) $look_for_poi . '"';
				$result = $this->db->sql_query($sql);
				$usermap_result = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);
				if (empty($usermap_result))
				{
					trigger_error($this->language->lang('USERMAP_NO_MATCH_FOUND', $look_for), E_USER_WARNING);
				}
				$usermap_result['type'] = 'POI';
				break;

			//	set configuration values to send them to javascript for initialising the map
			case 'bbcode_loc':
			case 'member':
				$lat = $this->request->variable('lat', '');
				$lng = $this->request->variable('lng', '');
				// change comma to full stop
				$lat = str_replace(',', '.', $lat);
				$lng = str_replace(',', '.', $lng);
				$usermap_config = [
					'Lat'			=> $lat,
					'Lng'			=> $lng,
					'Zoom'			=> '13',
					'setMarker'		=> $action == 'bbcode_loc',
				];
				break;

			default:
				$usermap_config = [
					'Lat'			=> $this->config['mot_usermap_lat'],
					'Lng'			=> $this->config['mot_usermap_lon'],
					'Zoom'			=> $this->config['mot_usermap_zoom'],
					'setMarker'		=> false,
				];
				break;
		}

		// Complete the usermap_config array
		$usermap_config = array_merge($usermap_config, [
			'radiusPC'		=> $this->config['mot_usermap_markers_pc'],
			'radiusMobile'	=> $this->config['mot_usermap_markers_mob'],
		]);

		$poi_enabled = $this->config['mot_usermap_poi_enable'];

		/*
		*	Get data of current user
		*/
		$sql_arr = [
			'SELECT'	=> 'u.user_id, u.username, um.user_lat, um.user_lng, um.user_land, um.user_plz',
			'FROM'		=> [
				USERS_TABLE				=> 'u',
				$this->usermap_users_table		=> 'um'
			],
			'WHERE'		=> 'u.user_id = ' . (int) $user_id . ' AND um.user_id = ' . (int) $user_id,
		];
		$sql = $this->db->sql_build_query('SELECT', $sql_arr);
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		if (!empty($row))
		{
			$current_user = $row['user_id'] . "|" . $row['username'] . "|" . $row['user_plz'] . "|" . $row['user_lat'] . "|" . $row['user_lng'];
			$zip_code = '"' . $row['user_land'] . '-' . $row['user_plz'] . '"';
			$valid_user = 1;			// the current user is listed in the usermap_users table and therefore authorized to use the map search - MUST NOT be true since js needs 1 or 0 instead of boolean values
		}
		else
		{
			$current_user = "0|''|0|0|0";
			$zip_code = 0;
			$valid_user = 0;			// the current user is NOT listed in the usermap_users table and therefore NOT authorized to use the map search - MUST NOT be false since js needs 1 or 0 instead of boolean values
		}

		// Get layer data
		$sql = 'SELECT * FROM ' . $this->usermap_layer_table . '
				WHERE layer_active = 1
				ORDER BY layer_position ASC';
		$result = $this->db->sql_query($sql);
		$layers = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		$poi_layers = $member_layers = [];
		foreach ($layers as &$arr)
		{
			// get this layer's permitted groups and check whether this user is permitted to see this layer
			$permitted_groups = json_decode($arr['layer_groups']);
			if (in_array($this->user->data['group_id'], $permitted_groups))
			{
				$lang_vars = json_decode($arr['layer_lang_var'], true);
				// write only current user's language variable into the layers array
				$arr['layer_lang_var'] = array_key_exists ($this->user->data['user_lang'], $lang_vars) ? $lang_vars[$this->user->data['user_lang']] : $lang_vars['en'];
				// and prepare layer_id and layer_name for the modal window
				switch ($arr['layer_type'])
				{
					// Member layer
					case 0:
						$member_layers[] = $arr;
						$this->template->assign_block_vars('member_layer', [
							'LAYER_ID'		=> $arr['layer_id'],
							'LAYER_NAME'	=> $arr['layer_lang_var'],
						]);
						break;

					// POI layer
					case 1:
						$poi_layers[] = $arr;
						$this->template->assign_block_vars('poi_layer', [
							'LAYER_ID'		=> $arr['layer_id'],
							'LAYER_NAME'	=> $arr['layer_lang_var'],
						]);
						break;
				}
			}
		}

		/*
		* Get data to display members only if user is permitted to see this part (performance reasons)
		*/
		if ($view_map || $view_map_subscribed)
		{
			/*
			*	Get usermap users data
			*/
			$sql_arr = [
				'SELECT'	=> 'u.user_id, u.username, u.user_colour, um.user_lat, um.user_lng, um.layer_id',
				'FROM'		=> [
					USERS_TABLE						=> 'u',
					$this->usermap_users_table		=> 'um'
				],
				'WHERE'			=> 'u.user_id = um.user_id',
			];
			$sql = $this->db->sql_build_query('SELECT', $sql_arr);
			$sql .= ' ORDER BY u.user_id DESC';
			$result = $this->db->sql_query($sql);
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

			$usergroup_legend = [];
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

			$this->template->assign_vars([
				'MAP_USERS'			=> $this->language->lang('MAP_USERS', (int) $map_users),
				'USER_COUNT'		=> (int) $map_users,
				'MAP_LEGEND'		=> $usergroup_legend,
				'MEMBERDATA'		=> json_encode($user_data),
				'MEMBER_LAYERDATA'	=> json_encode($member_layers),
			]);
		}

		/*
		*	Get poi data if poi display is enabled and user is permitted to see POIs
		*/
		if ($poi_enabled && $view_poi)
		{
			$poi_legend = generate_text_for_display($this->config_text->get('mot_usermap_poi_legend'), $uid, $bitfield, $flags);

			$sql = 'SELECT * FROM ' . $this->usermap_poi_table . '
					WHERE disabled = 0
					ORDER BY poi_id ASC';
			$result = $this->db->sql_query($sql);
			$poi_data = $this->db->sql_fetchrowset($result);
			$this->db->sql_freeresult($result);

			// Get icons
			$icon_files = [];
			$icon_files = $this->usermap_functions->get_icons($this->ext_path . 'styles/all/theme/images/poi/');
			foreach ($icon_files as $value)
			{
				$this->template->assign_block_vars('poi_icon', [
					'VALUE'		=> $value,
				]);
			}

			foreach ($poi_data as &$row)
			{
				$row['name'] = generate_text_for_display($row['name'], $uid, $bitfield, $name_flags);
				$row['popup'] = generate_text_for_display($row['popup'], $uid, $bitfield, $flags);
			}

			$this->template->assign_vars([
				'POI_NUMBER'				=> $this->language->lang('POI_COUNT', count($poi_data)),
				'POIDATA'					=> json_encode($poi_data),
				'POI_COUNT'					=> count($poi_data),
				'POI_LAYERDATA'				=> json_encode($poi_layers),
				'POI_LEGEND'				=> $poi_legend,
				'POI_ALREADY_APPROVED'		=> false,
				'USERMAP_POI_ICON_SIZE'		=> $this->config['mot_usermap_iconsize_default'],
				'USERMAP_POI_ICON_ANCHOR'	=> $this->config['mot_usermap_iconanchor_default'],
				'DEFAULT_POI_ICON_SIZE'		=> $this->config['mot_usermap_iconsize_default'],
				'DEFAULT_POI_ICON_ANCHOR'	=> $this->config['mot_usermap_iconanchor_default'],
				'USERMAP_POI_ICON'			=> $poi_layers[0]['default_icon'],
				'WORK_MODE'					=> 'modal',
				'S_BBCODE_ALLOWED'			=> $this->config['allow_bbcode'] ? true : false,
				'S_LINKS_ALLOWED'			=> $this->config['allow_post_links'] ? true : false,
				'MAX_FONT_SIZE'				=> (int) $this->config['max_post_font_size'],
				'U_ACTION'					=> $this->helper->route('mot_usermap_route', ['action' => 'submit']),
				'U_CANCEL'					=> $this->helper->route('mot_usermap_route'),
				'ERROR_MSG'					=> $this->language->lang('USERMAP_POI_NAME_ERROR', $this->language->lang('ACP_USERMAP_POI_NAME')),
				'GOOGLE_ENABLED'			=> $this->config['mot_usermap_google_enable'],
				'AJAX_CALL'					=> $this->helper->route('mot_usermap_ajax'),
				'POI_ICON_PATH'				=> json_encode(append_sid("{$this->ext_path}styles/all/theme/images/poi/")),
			]);
		}

		$permission_overview = '';
		if ($view_map)
		{
			$permission_overview .= $this->language->lang('USERMAP_PERM_VIEW_ALWAYS');
		}
		else if ($view_map_subscribed)
		{
			$permission_overview .= $this->language->lang('USERMAP_PERM_VIEW_SUBSCRIBED');
		}
		else if (!$view_map && !$view_map_subscribed)
		{
			$permission_overview .= $this->language->lang('USERMAP_NO_VIEW_SUBSCRIBED');
		}
		if ($view_poi)
		{
			$permission_overview .= $this->language->lang('USERMAP_PERM_VIEW_POI');
		}
		else
		{
			$permission_overview .= $this->language->lang('USERMAP_NO_VIEW_POI');
		}
		if (!$add_poi && !$add_approve_poi)
		{
			$permission_overview .= $this->language->lang('USERMAP_NO_ADD_POI');
		}
		else if ($add_poi)
		{
			$permission_overview .= $this->language->lang('USERMAP_PERM_ADD_POI');
		}
		else if ($add_approve_poi)
		{
			$permission_overview .= $this->language->lang('USERMAP_PERM_ADD_POI_MOD');
		}

		// Select default search tab
		$tab = 1;
		if (!($valid_user && $view_map_subscribed) && ($view_map && !$valid_user))
		{
			$tab = 2;
		}
		if (!($valid_user && $view_map_subscribed) && !$view_map && $poi_enabled && $view_poi)
		{
			$tab = 3;
		}

		$this->template->assign_vars([
			'USER'						=> json_encode($current_user),
			'VALID_USER'				=> $valid_user,
			'MAPCONFIG'					=> json_encode($usermap_config),
			'PROFILE_LINK'				=> json_encode(append_sid("{$this->root_path}memberlist.$this->php_ext?mode=viewprofile")),
			'MAP_SEARCH'				=> $this->language->lang('MAP_SEARCH', $zip_code),
			'POI_ENABLED'				=> $poi_enabled,
			'VIEW_MAP_ALWAYS'			=> $view_map ? 1 : 0,
			'VIEW_MAP_SUBSCRIBED'		=> $view_map_subscribed ? 1 : 0,
			'POI_VIEW'					=> $view_poi ? 1 : 0,
			'POI_CREATE'				=> ($add_poi || $add_approve_poi) ? 1 : 0,
			'DISPLAY_BBCODE'			=> json_encode($usermap_result),
			'DISPLAY_PERMISSIONS'		=> $permission_overview,
			'TAB'						=> $tab,
			'USERMAP_ACTIVE'			=> true,
			'USERMAP_COPYRIGHT'			=> $this->ext_data['extra']['display-name'] . ' ' . $this->ext_data['version'] . ' &copy; Mike-on-Tour (<a href="' . $this->ext_data['homepage'] . '" target="_blank" rel="noopener">' . $this->ext_data['homepage'] . '</a>)',
		]);

		// Add breadcrumbs link
		$this->template->assign_block_vars('navlinks', [
			'FORUM_NAME'	=> $this->language->lang('USERMAP'),
			'U_VIEW_FORUM'	=> $this->helper->route('mot_usermap_route'),
		]);

		return $this->helper->render('@mot_usermap/usermap_main.html', $this->language->lang('USERMAP'));
	}

}
