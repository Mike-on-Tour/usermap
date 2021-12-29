<?php

/**
*
* @package Usermap v1.1.3
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class poi_module
{
	public $u_action;

	public function main()
	{
		global $template, $request, $db, $config, $phpbb_container, $user, $phpbb_root_path;

		$language = $phpbb_container->get('language');
		$log = $phpbb_container->get('log');
		$this->md_manager = $phpbb_container->get('ext.manager')->create_extension_metadata_manager('mot/usermap');
		$this->tpl_name = 'acp_usermap_poi';
		$this->page_title = $language->lang('ACP_USERMAP') . ' ' . $language->lang('ACP_USERMAP_POI');
		$this->icon_path = $phpbb_root_path . 'ext/mot/usermap/styles/all/theme/images/poi/';
		$this->usermap_functions = $phpbb_container->get('mot.usermap.functions_usermap');
		$this->usermap_poi_table = $phpbb_container->getParameter('mot.usermap.tables.usermap_poi');
		$this->usermap_layer_table = $phpbb_container->getParameter('mot.usermap.tables.usermap_layers');

		$uid = $bitfield = '';
		$flags = OPTION_FLAG_LINKS + OPTION_FLAG_BBCODE;	// === 0b0101   ( this really is of no interest since this variable gets set in the called function according to every flag set to true
		$name_flags = 0;
		$preview_text = '';
		$act = '';
		$new_poi = true;
		$poi_popup_preview = false;
		$this->u_action_preview = $this->u_action . '&amp;action=preview';

		$language->add_lang(array('posting'));

		// set parameters for pagination
		$start = $request->variable('start', 0);
		$limit = (int) $config['mot_usermap_rows_per_page'];	// max lines per page (default is 25)

		add_form_key('acp_usermap_poi');

		$action = $request->variable('action', '');

		switch ($action)
		{
			case 'edit':
				$poi_id = $request->variable('poi_id', 0);
				$sql = 'SELECT * FROM ' . $this->usermap_poi_table . '
						WHERE poi_id=' . (int) $poi_id;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);
				$preview_text = generate_text_for_display($row['popup'], $uid, $bitfield, $flags);

				$template->assign_vars(array(
					'ACP_USERMAP_POI_NAME'			=> generate_text_for_edit($row['name'], $uid, $name_flags)['text'],
					'ACP_USERMAP_POI_POPUP'			=> generate_text_for_edit($row['popup'], $uid, $flags)['text'],
					'MOT_USERMAP_POI_ICON'			=> $row['icon'],
					'ACP_USERMAP_POI_ICON_SIZE'		=> $row['icon_size'],
					'ACP_USERMAP_POI_ICON_ANCHOR'	=> $row['icon_anchor'],
					'ACP_USERMAP_POI_LAT'			=> $row['lat'],
					'ACP_USERMAP_POI_LON'			=> $row['lng'],
					'MOT_USERMAP_POI_LAYER_ID'		=> $row['layer_id'],
					'ACP_USERMAP_SHOW_POI'			=> $row['disabled'],
				));
				$this->u_action_preview = $this->u_action_preview . '&amp;poi_id='.$poi_id;
				$act = '&amp;action=submit_changes&amp;poi_id='.$poi_id;
				$new_poi = false;
				break;

			case 'submit_changes':
				if (!check_form_key('acp_usermap_poi'))
				{
					trigger_error($language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				setlocale(LC_ALL, 'C');
				$poi_id = $request->variable('poi_id', 0);
				$name = $request->variable('mot_usermap_poi_name', '', true);
				generate_text_for_storage($name, $uid, $bitfield, $name_flags);
				$popup_value = $request->variable('mot_usermap_poi_popup', '', true);
				generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);

				$sql_arr = array(
					'name'			=> $name,
					'popup'			=> $popup_value,
					'icon'			=> $request->variable('mot_usermap_poi_icon', ''),
					'lat'			=> $request->variable('mot_usermap_poi_lat', 0.0),
					'lng'			=> $request->variable('mot_usermap_poi_lon', 0.0),
					'icon_size'		=> $request->variable('mot_usermap_poi_icon_size', ''),
					'icon_anchor'	=> $request->variable('mot_usermap_poi_icon_anchor', ''),
					'disabled'		=> $request->variable('mot_usermap_show_poi', 0),
					'layer_id'		=> $request->variable('mot_usermap_poi_layer', 0),
				);
				$sql = 'UPDATE ' . $this->usermap_poi_table . '
						SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
						WHERE poi_id = ' . (int) $poi_id;
				$db->sql_query($sql);
				$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_USERMAP_POI_EDITED', false, array($name));
				trigger_error($language->lang('ACP_USERMAP_POI_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				break;

			case 'delete':
				$name = $request->variable('poi_name', '', true);
				$poi_id = substr($request->variable('poi_id', ''), 0);
				if (confirm_box(true))
				{
					$sql = 'DELETE FROM ' . $this->usermap_poi_table . '
							WHERE poi_id=' . (int) $poi_id;
					$db->sql_query($sql);
					$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_USERMAP_POI_DELETED', false, array($name));
					trigger_error($language->lang('ACP_USERMAP_POI_DEL_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				}
				else
				{
					confirm_box(false, '<p>'.$language->lang('ACP_USERMAP_POI_DELETE', $name).'</p>', build_hidden_fields(array(
						'u_action'	=> $this->u_action . '&amp;action=delete&amp;poi_id=' . $poi_id,
					)));
				}
				break;

			case 'submit':
				if (!check_form_key('acp_usermap_poi'))
				{
					trigger_error($language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				setlocale(LC_ALL, 'C');
				$name = $request->variable('mot_usermap_poi_name', '', true);
				generate_text_for_storage($name, $uid, $bitfield, $name_flags);
				$popup_value = $request->variable('mot_usermap_poi_popup', '', true);
				generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);

				$sql_arr = array(
					'name'			=> $name,
					'popup'			=> $popup_value,
					'icon'			=> $request->variable('mot_usermap_poi_icon', ''),
					'lat'			=> $request->variable('mot_usermap_poi_lat', 0.0),
					'lng'			=> $request->variable('mot_usermap_poi_lon', 0.0),
					'icon_size'		=> $request->variable('mot_usermap_poi_icon_size', ''),
					'icon_anchor'	=> $request->variable('mot_usermap_poi_icon_anchor', ''),
					'creator_id'	=> $user->data['user_id'],
					'disabled'		=> $request->variable('mot_usermap_show_poi', 0),
					'layer_id'		=> $request->variable('mot_usermap_poi_layer', 0),
				);
				$sql = 'INSERT INTO ' . $this->usermap_poi_table . ' ' . $db->sql_build_array('INSERT', $sql_arr);
				$db->sql_query($sql);
				$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_USERMAP_POI_NEW', false, array($name));
				trigger_error($language->lang('ACP_USERMAP_POI_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				break;

			case 'preview':
				$poi_id = $request->variable('poi_id', 0);
				$popup_value = $request->variable('mot_usermap_poi_popup', '', true);

				generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);
				$preview_text = generate_text_for_display($popup_value, $uid, $bitfield, $flags);
				$result = generate_text_for_edit($popup_value, $uid, $flags);
				$popup_value = $result['text'];
				$poi_popup_preview = true;

				$template->assign_vars(array(
					'ACP_USERMAP_POI_NAME'			=> $request->variable('mot_usermap_poi_name', '', true),
					'ACP_USERMAP_POI_POPUP'			=> $popup_value,
					'MOT_USERMAP_POI_ICON'			=> $request->variable('mot_usermap_poi_icon', ''),
					'ACP_USERMAP_POI_ICON_SIZE'		=> $request->variable('mot_usermap_poi_icon_size', ''),
					'ACP_USERMAP_POI_ICON_ANCHOR'	=> $request->variable('mot_usermap_poi_icon_anchor', ''),
					'ACP_USERMAP_POI_LAT'			=> $request->variable('mot_usermap_poi_lat', ''),
					'ACP_USERMAP_POI_LON'			=> $request->variable('mot_usermap_poi_lon', ''),
					'MOT_USERMAP_POI_LAYER_ID'		=> $request->variable('mot_usermap_poi_layer', 0),
					'ACP_USERMAP_SHOW_POI'			=> $request->variable('mot_usermap_show_poi', 0),
				));

				if ($poi_id > 0)		// Preview was called from inside the Edit mode
				{
					$this->u_action_preview = $this->u_action_preview . '&amp;poi_id='.$poi_id;
					$act = '&amp;action=submit_changes&amp;poi_id='.$poi_id;
					$new_poi = false;
				}

				break;

			default:
				break;
		}

		// get the total number of POIs
		$count_query = "SELECT COUNT(poi_id) AS 'poi_count' FROM " . $this->usermap_poi_table;
		$result = $db->sql_query($count_query);
		$row = $db->sql_fetchrow($result);
		$poi_count = $row['poi_count'];
		$db->sql_freeresult($result);

		// load the 'usermap_poi' table
		$query = 'SELECT * FROM ' . $this->usermap_poi_table . ' ORDER BY poi_id ASC';
		$result = $db->sql_query_limit($query, $limit, $start);
		$pois = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);

		//base url for pagination
		$base_url = $this->u_action;

		// Load pagination
		$pagination = $phpbb_container->get('pagination');
		$start = $pagination->validate_start($start, $limit, $poi_count);
		$pagination->generate_template_pagination($base_url, 'pagination', 'start', $poi_count, $limit, $start);

		// Get all users who created a POI from USERS_TABLE
		$usernames = [];
		$sql = 'SELECT user_id, username FROM ' . USERS_TABLE . '
				WHERE user_id IN (SELECT creator_id FROM ' . $this->usermap_poi_table . ')';
		$result = $db->sql_query($sql);
		$users = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);
		$usernames[0] = '';		// prevent warnings or error messages where no creator is stored
		foreach ($users as $arr)
		{
			$usernames[$arr['user_id']] = $arr['username'];
		}

		// Get layer data
		$layernames = [];
		$sql = 'SELECT layer_id, layer_name, default_icon FROM ' . $this->usermap_layer_table . '
				WHERE member_layer = 0
				AND layer_active = 1';
		$result = $db->sql_query($sql);
		$layers = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);
		foreach ($layers as $arr)
		{
			$layernames[$arr['layer_id']] = $arr['layer_name'];
			$template->assign_block_vars('poi_layer', [
				'LAYER_ID'		=> $arr['layer_id'],
				'LAYER_NAME'	=> $arr['layer_name'],
			]);
		}

		foreach ($pois as $row)
		{
			$popup = generate_text_for_display($row['popup'], $uid, $bitfield, $flags);
			$poi_name = generate_text_for_display($row['name'], $uid, $bitfield, $name_flags);
			$template->assign_block_vars('poi', array(
				'NAME'			=> $poi_name,
				'POPUP'			=> $popup,
				'LAT'			=> $row['lat'],
				'LNG'			=> $row['lng'],
				'ICON'			=> $row['icon'],
				'SIZE'			=> $row['icon_size'],
				'ANCHOR'		=> $row['icon_anchor'],
				'CREATOR'		=> $usernames[$row['creator_id']],
				'LAYER'			=> empty($layernames[$row['layer_id']]) ? '' : $layernames[$row['layer_id']],
				'DISABLED'		=> $row['disabled'] == 1 ? true : false,
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;poi_id=' . ($row['poi_id'] . '&amp;poi_name=' . urlencode($poi_name)),
				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;poi_id=' . ($row['poi_id']),
			));
		}

		$icon_files = $this->usermap_functions->get_icons($this->icon_path);
		foreach ($icon_files as $value)
		{
			$template->assign_block_vars('poi_icon', array(
				'VALUE'		=> $value,
			));
		}

		$act = ($act == '') ? '&amp;action=submit' : $act;
		$mot_usermap_version = $this->md_manager->get_metadata('version');
		$template->assign_vars(array(
			'NEW_POI'						=> $new_poi,
			'ACP_USERMAP_POPUP_PREVIEW'		=> $poi_popup_preview,
			'U_ACTION'						=> $this->u_action . $act,
			'U_ACTION_PREVIEW'				=> $this->u_action_preview,
			'PREVIEW_TEXT'					=> $preview_text,
			'USERMAP_VERSION'				=> $language->lang('ACP_USERMAP_VERSION', $mot_usermap_version, date('Y')),
			'DEFAULT_POI_ICON_SIZE'			=> $config['mot_usermap_iconsize_default'],
			'DEFAULT_POI_ICON_ANCHOR'		=> $config['mot_usermap_iconanchor_default'],
			'LAYERS_ARR'					=> json_encode($layers),
		));
		if ($new_poi)
		{
			$template->assign_vars(array(
				'ACP_USERMAP_POI_ICON_SIZE'		=> $config['mot_usermap_iconsize_default'],
				'ACP_USERMAP_POI_ICON_ANCHOR'	=> $config['mot_usermap_iconanchor_default'],
				'MOT_USERMAP_POI_ICON'			=> $layers[0]['default_icon'],
			));
		}
	}

}
