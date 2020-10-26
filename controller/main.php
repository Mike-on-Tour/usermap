<?php
/**
*
* @package Usermap v0.9.x
* @copyright (c) 2020 Mike-on-Tour
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

	/* @var \phpbb\extension\manager */
	protected $phpbb_extension_manager;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string PHP extension */
	protected $php_ext;

	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\controller\helper $helper,
		\phpbb\template\template $template, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, \phpbb\language\language $language,
		\phpbb\extension\manager $phpbb_extension_manager, $root_path, $php_ext)
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
			'user_id'	=> $this->user->data['user_id'],
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
			$poi_showtoall = $this->config['mot_usermap_poi_showtoall'];
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
				'POIDATA'		=> json_encode($poi_data, true),
				'POI_SHOWTOALL'	=> $poi_showtoall,
				'POI_LEGEND'	=> $poi_legend,
			));
		}

		$this->template->assign_vars(array(
			'USER'			=> json_encode($current_user),
			'AUTH_USER'		=> $valid_user,
			'MAPCONFIG'		=> json_encode($usermap_config),
			'SERVERCONFIG'	=> json_encode($server_config),
			'MAPDATA'		=> json_encode($user_data),
			'MAP_USERS'		=> $this->language->lang('MAP_USERS', (int) $map_users),
			'MAP_LEGEND'	=> $usergroup_legend,
			'MAP_SEARCH'	=> $this->language->lang('MAP_SEARCH', $zip_code),
			'POI_ENABLED'	=> $poi_enabled,
			)
		);
		return $this->helper->render('usermap_main.html');
	}

}
