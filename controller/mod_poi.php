<?php
/**
*
* @package Usermap v1.3.0
* @copyright (c) 2020 - 2025 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\controller;

//use Symfony\Component\DependencyInjection\Container;

class mod_poi
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

	/** @var \mot\usermap\includes\functions_usermap */
	protected $usermap_functions;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string PHP extension */
	protected $php_ext;

	/** @var string mot.usermap.tables.usermap_poi */
	protected $mot_usermap_poi_table;

	/** @var string mot.usermap.tables.usermap_layers */
	protected $mot_usermap_layer_table;

	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\controller\helper $helper,
		\phpbb\template\template $template, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, \phpbb\language\language $language,
		\phpbb\extension\manager $phpbb_extension_manager, \phpbb\request\request_interface $request, \phpbb\notification\manager $notification_manager,
		\phpbb\log\log $log, \mot\usermap\includes\functions_usermap $usermap_functions, $root_path, $php_ext, $mot_usermap_poi_table,
		$mot_usermap_layer_table)
	{
		$this->auth = $auth;
		$this->config = $config;
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
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
		$this->u_action = $this->u_notify = '';
		$this->usermap_poi_table = $mot_usermap_poi_table;
		$this->usermap_layer_table = $mot_usermap_layer_table;

		$this->ext_path = $this->phpbb_extension_manager->get_extension_path('mot/usermap', true);
		$this->md_manager = $this->phpbb_extension_manager->create_extension_metadata_manager('mot/usermap');
		$this->ext_data = $this->md_manager->get_metadata();
	}

	/**
	*
	*/
	public function handle()
	{
		$uid = $bitfield = '';
		$flags = OPTION_FLAG_LINKS + OPTION_FLAG_BBCODE;	// === 0b0101   ( this really is of no interest since this variable gets set in the called function according to every flag set to true
		$name_flags = 0;

		if (! $this->auth->acl_get('m_release_poi'))
		{
			$this->template->assign_vars([
				'NOT_AUTHORIZED'	=> true,
			]);
		}
		else
		{
			setlocale(LC_ALL, 'C');
			$action = $this->request->variable('action', '');
			$work_mode = $this->request->variable('work_mode', '');
			$poi_id = $this->request->variable('poi_id', 0);

			if ($action != '')
			{
				// Get the POIs name
				$poi_name = $this->request->variable('usermap_poi_name', '', true);
				// Decode double quotes
				$poi_name = htmlspecialchars_decode($poi_name, ENT_COMPAT);
				// Remove some unwanted characters
				$poi_name = str_replace($this->usermap_functions::MOT_USERMAP_POI_NONECHARS, '', $poi_name);
				$poi_name = trim($poi_name);
				$poi_name = trim($poi_name, ',');

				$popup_value = $this->request->variable('usermap_poi_popup', '', true);
				if ($popup_value != '')
				{
					generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);
				}

				$sql_arr = array(
					'name'			=> $poi_name,
					'popup'			=> $popup_value,
					'icon'			=> $this->request->variable('usermap_poi_icon', ''),
					'lat'			=> substr($this->request->variable('usermap_poi_lat', ''), 0, 20),
					'lng'			=> substr($this->request->variable('usermap_poi_lng', ''), 0, 20),
					'icon_size'		=> $this->request->variable('usermap_poi_icon_size', ''),
					'icon_anchor'	=> $this->request->variable('usermap_poi_icon_anchor', ''),
					'disabled'		=> 0,
					'layer_id'		=> $this->request->variable('usermap_poi_layer', 0),
				);
				$sql = 'UPDATE ' . $this->usermap_poi_table . '
						SET ' . $this->db->sql_build_array('UPDATE', $sql_arr) . '
						WHERE poi_id = ' . (int) $poi_id;

				// process the action demanded in the first step
				switch ($action)
				{
					case 'submit_approve':
						$this->db->sql_query($sql);
						$this->log->add('mod', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_POI_APPROVED', false, array($poi_name));
						trigger_error($this->language->lang('POI_APPROVED') . ' ' . $this->language->lang('CHANGES_SUCCESSFUL') . $this->usermap_functions->usermap_back_link($this->helper->route('mot_usermap_route'), $this->language->lang('BACK_TO_USERMAP')), E_USER_NOTICE);
						break;

					case 'submit_notify':
						$this->db->sql_query($sql);
						trigger_error($this->language->lang('ACTION_CONCLUDED') . ' ' . $this->language->lang('CHANGES_SUCCESSFUL') . $this->usermap_functions->usermap_back_link($this->helper->route('mot_usermap_route'), $this->language->lang('BACK_TO_USERMAP')), E_USER_NOTICE);
						break;

					case 'submit_delete':
						if (confirm_box(true))
						{
							$sql = 'SELECT name FROM ' . $this->usermap_poi_table . ' WHERE poi_id = ' . (int) $poi_id;
							$result = $this->db->sql_query($sql);
							$row = $this->db->sql_fetchrow($result);
							$this->db->sql_freeresult($result);
							$sql = 'DELETE FROM ' . $this->usermap_poi_table . ' WHERE poi_id = ' . (int) $poi_id;
							$this->db->sql_query($sql);
							$this->log->add('mod', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_POI_MOD_DELETED', false, array($row['name']));
							trigger_error($this->language->lang('ACP_USERMAP_DATABASE_SUCCESS') . $this->usermap_functions->usermap_back_link($this->helper->route('mot_usermap_route'), $this->language->lang('BACK_TO_USERMAP')), E_USER_NOTICE);
						}
						else
						{
							confirm_box(false, '<p>'.$this->language->lang('ACP_USERMAP_CONFIRM_DELETE').'</p>', build_hidden_fields(array(
								'u_action'	=> append_sid("{$this->root_path}app.$this->php_ext/mod_poi", array('action' => 'submit_delete', 'poi_id' => $poi_id,)),

							)));
						}
						break;

					default:
						break;
				}
			}

			// Add the language variables for BBCodes
			$this->language->add_lang(array('posting'));

			$sql_arr = array(
				'poi_id'	=> $poi_id,
			);
			$sql = 'SELECT * FROM ' . $this->usermap_poi_table . '
					WHERE ' . $this->db->sql_build_array('SELECT', $sql_arr);
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			add_form_key('poi_edit');

			if (!empty($row))
			{
				$poi_already_approved = $row['disabled'] ? false : true;
				if ($work_mode == 'approve')
				{
					$this->u_action = append_sid("{$this->root_path}app.$this->php_ext/mod_poi", array('action' => 'submit_approve', 'poi_id' => $row['poi_id']));
				}
				if ($work_mode == 'notify' || ($work_mode == 'approve' && $poi_already_approved))
				{
					$this->u_action = append_sid("{$this->root_path}app.$this->php_ext/mod_poi", array('action' => 'submit_notify', 'poi_id' => $row['poi_id']));
				}
				$this->u_delete = append_sid("{$this->root_path}app.$this->php_ext/mod_poi", array('action' => 'submit_delete', 'poi_id' => $row['poi_id']));

				// prepare the popup text for editing
				$popup = $row['popup'] != '' ? generate_text_for_edit($row['popup'], $uid, $flags)['text'] : '';
				// prepare the popup text for display
				$row['popup'] = generate_text_for_display($row['popup'], $uid, $bitfield, $flags);

				// Get layer data
				$sql = 'SELECT * FROM ' . $this->usermap_layer_table . '
						WHERE layer_type = 1
						AND layer_active = 1
						ORDER BY layer_position ASC';
				$result = $this->db->sql_query($sql);
				$layers = $this->db->sql_fetchrowset($result);
				$this->db->sql_freeresult($result);

				$layernames = [];
				foreach ($layers as $arr)
				{
					$lang_vars = json_decode($arr['layer_lang_var'], true);
					// write only current user's language variable into the layers array
					$arr['layer_lang_var'] = array_key_exists ($this->user->data['user_lang'], $lang_vars) ? $lang_vars[$this->user->data['user_lang']] : $lang_vars['en'];
					// and prepare layer_id and layer_name for the modal window
					$layernames[$arr['layer_id']] = $arr['layer_name'];
					$this->template->assign_block_vars('poi_layer', [
						'LAYER_ID'		=> $arr['layer_id'],
						'LAYER_NAME'	=> array_key_exists ($this->user->data['user_lang'], $lang_vars) ? $lang_vars[$this->user->data['user_lang']] : $lang_vars['en'],
					]);
				}

				$this->template->assign_vars([
					'NOT_AUTHORIZED'			=> false,
					'POI_EXIST'					=> true,
					'POI_ALREADY_APPROVED'		=> $poi_already_approved,
					'WORK_MODE'					=> $work_mode,
					'POIDATA'					=> json_encode($row),
					'POI_ICON_PATH'				=> json_encode(append_sid("{$this->ext_path}styles/all/theme/images/poi/")),
					'POI_LAYERDATA'				=> json_encode($layers),
					'USERMAP_POI_NAME'			=> generate_text_for_edit($row['name'], $uid, $name_flags)['text'],
					'USERMAP_POI_POPUP'			=> $popup,
					'USERMAP_POI_LAYER_ID'		=> $row['layer_id'],
					'USERMAP_POI_ICON'			=> $row['icon'],
					'USERMAP_POI_ICON_SIZE'		=> $row['icon_size'],
					'USERMAP_POI_ICON_ANCHOR'	=> $row['icon_anchor'],
					'USERMAP_POI_LAT'			=> $row['lat'],
					'USERMAP_POI_LNG'			=> $row['lng'],
					'DEFAULT_POI_ICON_SIZE'		=> $this->config['mot_usermap_iconsize_default'],
					'DEFAULT_POI_ICON_ANCHOR'	=> $this->config['mot_usermap_iconanchor_default'],
					'U_ACTION'					=> $this->u_action,
					'U_DELETE'					=> $this->u_delete,
					'S_BBCODE_ALLOWED'			=> $this->config['allow_bbcode'] ? true : false,
					'S_LINKS_ALLOWED'			=> $this->config['allow_post_links'] ? true : false,
					'MAX_FONT_SIZE'				=> (int) $this->config['max_post_font_size'],
					'ERROR_MSG'					=> $this->language->lang('USERMAP_POI_NAME_ERROR', $this->language->lang('ACP_USERMAP_POI_NAME')),
				]);

				$icon_files = [];
				$icon_files = $this->usermap_functions->get_icons($this->ext_path . 'styles/all/theme/images/poi/');
				foreach ($icon_files as $value)
				{
					$this->template->assign_block_vars('poi_icon', [
						'VALUE'		=> $value,
					]);
				}
			}
		}

		$this->template->assign_vars([
			'USERMAP_ACTIVE'			=> true,
			'USERMAP_COPYRIGHT'			=> $this->ext_data['extra']['display-name'] . ' ' . $this->ext_data['version'] . ' &copy; Mike-on-Tour (<a href="' . $this->ext_data['homepage'] . '" target="_blank" rel="noopener">' . $this->ext_data['homepage'] . '</a>)',
		]);

		// Add breadcrumbs link
		$this->template->assign_block_vars('navlinks', [
			'FORUM_NAME'	=> $this->language->lang('USERMAP'),
			'U_VIEW_FORUM'	=> $this->helper->route('mot_usermap_mod_poi_route'),
		]);

		return $this->helper->render('@mot_usermap/usermap_mod_poi.html', $this->language->lang('USERMAP'));
	}

}
