<?php

/**
*
* @package Usermap v0.7.x
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class poi_module
{
	public $u_action;
	public $tpl_name;
	public $page_title;

	public function main()
	{
		global $language, $template, $request, $db, $phpbb_container, $phpbb_root_path, $phpEx;

		$this->tpl_name = 'acp_usermap_poi';
		$this->page_title = $language->lang('ACP_USERMAP') . ' ' . $language->lang('ACP_USERMAP_POI');
		$this->icon_path = $phpbb_root_path . 'ext/mot/usermap/styles/all/theme/images/poi/';
		$this->include_path = $phpbb_root_path . 'ext/mot/usermap/includes/';
		include_once($this->include_path . 'um_constants.' . $phpEx);
		$uid = $bitfield = '';
		$flags = OPTION_FLAG_LINKS + OPTION_FLAG_BBCODE;	// === 0b0101   ( this really is of no interest since this variable gets set in the called function according to every flag set to true
		$preview_text = '';
		$act = '';
		$new_poi = true;
		$poi_popup_preview = false;
		$this->u_action_preview = $this->u_action . '&amp;action=preview';

		$language->add_lang(array('posting'));

		// set parameters for pagination
		$start = (null !== ($request->variable('start', 0))) ? $request->variable('start', 0) : 0;
		$limit = 25;	// max 25 lines per page

		add_form_key('acp_usermap_poi');

		$action = $request->variable('action', '');

		switch ($action)
		{
			case 'edit':
				$poi_id = $request->variable('poi_id', 0);
				$sql = 'SELECT * FROM ' . USERMAP_POI_TABLE . '
						WHERE poi_id=' . (int) $poi_id;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);
				$preview_text = generate_text_for_display($row['popup'], $uid, $bitfield, $flags);
				$result = generate_text_for_edit($row['popup'], $uid, $flags);
				$popup = $result['text'];
				$template->assign_vars(array(
					'ACP_USERMAP_POI_NAME'		=> $row['name'],
					'ACP_USERMAP_POI_POPUP'		=> $row['popup'],
					'ACP_USERMAP_POI_POPUP'		=> $popup,
					'MOT_USERMAP_POI_ICON'		=> $row['icon'],
					'ACP_USERMAP_POI_LAT'		=> $row['lat'],
					'ACP_USERMAP_POI_LON'		=> $row['lng'],
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

				$poi_id = $request->variable('poi_id', 0);
				$popup_value = $request->variable('mot_usermap_poi_popup', '', true);
				generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);

				$sql_arr = array(
					'name'		=> $request->variable('mot_usermap_poi_name', '', true),
					'popup'		=> $popup_value,
					'icon'		=> $request->variable('mot_usermap_poi_icon', ''),
					'lat'		=> $request->variable('mot_usermap_poi_lat', ''),
					'lng'		=> $request->variable('mot_usermap_poi_lon', ''),
				);
				$sql = 'UPDATE ' . USERMAP_POI_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
						WHERE poi_id = ' . (int) $poi_id;
				$db->sql_query($sql);
				trigger_error($language->lang('ACP_USERMAP_DATABASE_SUCCESS') . adm_back_link($this->u_action), E_USER_NOTICE);
				break;

			case 'delete':
				$poi_id = substr($request->variable('poi_id', ''), 0);
				if (confirm_box(true))
				{
					$sql = 'DELETE FROM ' . USERMAP_POI_TABLE . '
							WHERE poi_id=' . (int) $poi_id;
					$db->sql_query($sql);
					trigger_error($language->lang('ACP_USERMAP_DATABASE_SUCCESS') . adm_back_link($this->u_action), E_USER_NOTICE);
				}
				else
				{
					confirm_box(false, '<p>'.$language->lang('ACP_USERMAP_CONFIRM_DELETE').'</p>', build_hidden_fields(array(
						'u_action'	=> $this->u_action . '&amp;action=delete&amp;poi_id=' . $poi_id,
					)));
				}
				break;

			case 'submit':
				if (!check_form_key('acp_usermap_poi'))
				{
					trigger_error($language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$popup_value = $request->variable('mot_usermap_poi_popup', '', true);
				generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);

				$sql_arr = array(
					'name'		=> $request->variable('mot_usermap_poi_name', '', true),
					'popup'		=> $popup_value,
					'icon'		=> $request->variable('mot_usermap_poi_icon', ''),
					'lat'		=> $request->variable('mot_usermap_poi_lat', ''),
					'lng'		=> $request->variable('mot_usermap_poi_lon', ''),
				);
				$sql = 'INSERT INTO ' . USERMAP_POI_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_arr);
				$db->sql_query($sql);
				trigger_error($language->lang('ACP_USERMAP_DATABASE_SUCCESS') . adm_back_link($this->u_action), E_USER_NOTICE);
				break;

			case 'preview':
				$poi_id = $request->variable('poi_id', 0);
				$name_value = $request->variable('mot_usermap_poi_name', '', true);
				$popup_value = $request->variable('mot_usermap_poi_popup', '', true);
				$icon = $request->variable('mot_usermap_poi_icon', '');
				$lat = $request->variable('mot_usermap_poi_lat', '');
				$lng = $request->variable('mot_usermap_poi_lon', '');

				generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);
				$preview_text = generate_text_for_display($popup_value, $uid, $bitfield, $flags);
				$result = generate_text_for_edit($popup_value, $uid, $flags);
				$popup_value = $result['text'];
				$poi_popup_preview = true;

				$template->assign_vars(array(
					'ACP_USERMAP_POI_NAME'		=> $name_value,
					'ACP_USERMAP_POI_POPUP'		=> $popup_value,
					'MOT_USERMAP_POI_ICON'		=> $icon,
					'ACP_USERMAP_POI_LAT'		=> $lat,
					'ACP_USERMAP_POI_LON'		=> $lng,
					'ACP_USERMAP_POPUP_PREVIEW'	=> $poi_popup_preview,
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

		// load the 'usermap_poi' table
		$query = 'SELECT * FROM ' . USERMAP_POI_TABLE . ' ORDER BY poi_id ASC';
		$count_query = "SELECT COUNT(poi_id) AS 'poi_count' FROM " . USERMAP_POI_TABLE;
		$result = $db->sql_query($count_query);
		$row = $db->sql_fetchrow($result);
		$poi_count = $row['poi_count'];
		$db->sql_freeresult($result);

		$result = $db->sql_query_limit($query, $limit, $start);
		$pois = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);

		//base url for pagination
		$base_url = $this->u_action;

		// Load pagination
		$pagination = $phpbb_container->get('pagination');
		$start = $pagination->validate_start($start, $limit, $poi_count);
		$pagination->generate_template_pagination($base_url, 'pagination', 'start', $poi_count, $limit, $start);

		foreach ($pois as $row)
		{
			$popup = generate_text_for_display($row['popup'], $uid, $bitfield, $flags);
			$template->assign_block_vars('poi', array(
				'NAME'			=> $row['name'],
				'POPUP'			=> $popup,
				'LAT'			=> $row['lat'],
				'LNG'			=> $row['lng'],
				'ICON'			=> $row['icon'],
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;poi_id=' . ($row['poi_id']),
				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;poi_id=' . ($row['poi_id']),
			));
		}

		$icon_files = array();
		$icon_files = $this->get_icons($this->icon_path);
		foreach ($icon_files as $value)
		{
			$template->assign_block_vars('poi_icon', array(
				'VALUE'		=> $value,
			));
		}

		$act = ($act == '') ? '&amp;action=submit' : $act;
		$template->assign_vars(array(
			'NEW_POI'					=> $new_poi,
			'U_ACTION'					=> $this->u_action . $act,
			'U_ACTION_PREVIEW'			=> $this->u_action_preview,
			'PREVIEW_TEXT'				=> $preview_text,
		));
	}

	function get_icons($dir)
	{
		$return = array();
		$path = scandir($dir);

		foreach ($path as $element)
		{
			if (is_file ($dir.'/'.$element))
			{
				$return[] = $element;
			}
		}

		return $return;
	}
}
