<?php

/**
*
* @package Usermap v1.1.3
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class layer_module
{
	public $u_action;

	public function main()
	{
		global $template, $request, $db, $config, $phpbb_container, $user, $phpbb_root_path;

		$language = $phpbb_container->get('language');
		$log = $phpbb_container->get('log');
		$this->md_manager = $phpbb_container->get('ext.manager')->create_extension_metadata_manager('mot/usermap');
		$this->tpl_name = 'acp_usermap_layer';
		$this->page_title = $language->lang('ACP_USERMAP') . ' ' . $language->lang('ACP_USERMAP_LAYER');
		$this->icon_path = $phpbb_root_path . 'ext/mot/usermap/styles/all/theme/images/poi/';
		$this->usermap_layer_table = $phpbb_container->getParameter('mot.usermap.tables.usermap_layers');
		$this->usermap_functions = $phpbb_container->get('mot.usermap.functions_usermap');

		$act = '';
		$new_layer = true;

		$language->add_lang(array('posting'));

		// set parameters for pagination
		$start = $request->variable('start', 0);
		$limit = (int) $config['mot_usermap_rows_per_page'];	// max lines per page (default is 25)

		add_form_key('acp_usermap_layer');

		$action = $request->variable('action', '');

		switch ($action)
		{
			case 'edit':
				$layer_id = $request->variable('layer_id', 0);
				$sql = 'SELECT * FROM ' . $this->usermap_layer_table . '
						WHERE layer_id=' . (int) $layer_id;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$lang_vars = json_decode($row['layer_lang_var'], true);
				$lang_str = '';
				foreach ($lang_vars as $key => $value)
				{
					$lang_str .= $key . ':' . $value . "\n";
				}
				$lang_str = trim($lang_str);

				$template->assign_vars(array(
					'ACP_USERMAP_LAYER_NAME'			=> $row['layer_name'],
					'ACP_USERMAP_MEMBER_LAYER'			=> $row['member_layer'] == 1 ? true : false,
					'ACP_USERMAP_LAYER_ACTIVE'			=> $row['layer_active'] == 1 ? true : false,
					'ACP_USERMAP_SHOW_LAYER'			=> $row['show_layer'] == 1 ? true : false,
					'ACP_USERMAP_LAYER_LANG_VAR'		=> $lang_str,
					'ACP_USERMAP_LAYER_DEFAULT_ICON'	=> $row['default_icon'],
				));
				$act = '&amp;action=submit_changes&amp;layer_id='.$layer_id;
				$new_layer = false;
				break;

			case 'submit_changes':
				if (!check_form_key('acp_usermap_layer'))
				{
					trigger_error($language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$layer_id = $request->variable('layer_id', 0);
				$name = $request->variable('mot_usermap_layer_name', '', true);
				$lang_str = explode("\n", trim($request->variable('mot_usermap_layer_lang_var', '', true)));

				$lang_vars = [];
				foreach ($lang_str as $value)
				{
					$temp = explode(':', trim($value));
					$lang_vars[$temp[0]] = $temp[1];
				}

				$sql_arr = array(
					'layer_name'		=> $name,
					'member_layer'		=> $request->variable('mot_usermap_layer_member', 0),
					'layer_active'		=> $request->variable('mot_usermap_layer_active', 0),
					'show_layer'		=> $request->variable('mot_usermap_show_layer', 0),
					'layer_lang_var'	=> json_encode($lang_vars),
					'default_icon'		=> $request->variable('mot_usermap_layer_member', 0) == 0 ? $request->variable('mot_usermap_layer_default_icon', '') : '',
				);
				$sql = 'UPDATE ' . $this->usermap_layer_table . '
						SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
						WHERE layer_id = ' . (int) $layer_id;
				$db->sql_query($sql);
				$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_USERMAP_LAYER_EDITED', false, array($name));
				trigger_error($language->lang('ACP_USERMAP_LAYER_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				break;

			case 'delete':
				$layer_id = $request->variable('layer_id', 0);
				$name = $request->variable('layer_name', '', true);
				if (confirm_box(true))
				{
					$sql = 'DELETE FROM ' . $this->usermap_layer_table . '
							WHERE layer_id=' . (int) $layer_id;
					$db->sql_query($sql);
					$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_USERMAP_LAYER_DELETED', false, array($name));
					trigger_error($language->lang('ACP_USERMAP_LAYER_DEL_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				}
				else
				{
					confirm_box(false, '<p>'.$language->lang('ACP_USERMAP_LAYER_DELETE', $name).'</p>', build_hidden_fields(array(
						'u_action'	=> $this->u_action . '&amp;action=delete&amp;layer_id=' . $layer_id . '&amp;layer_name=' . $name,
					)));
				}
				break;

			case 'submit':
				if (!check_form_key('acp_usermap_layer'))
				{
					trigger_error($language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$layer_id = $request->variable('layer_id', 0);
				$name = $request->variable('mot_usermap_layer_name', '', true);
				$lang_str = explode("\n", trim($request->variable('mot_usermap_layer_lang_var', '', true)));

				$lang_vars = [];
				foreach ($lang_str as $value)
				{
					$temp = explode(':', trim($value));
					$lang_vars[$temp[0]] = $temp[1];
				}

				$sql_arr = array(
					'layer_name'		=> $name,
					'member_layer'		=> $request->variable('mot_usermap_layer_member', 0),
					'layer_active'		=> $request->variable('mot_usermap_layer_active', 0),
					'show_layer'		=> $request->variable('mot_usermap_show_layer', 0),
					'layer_lang_var'	=> json_encode($lang_vars),
					'default_icon'		=> $request->variable('mot_usermap_layer_member', 0) == 0 ? $request->variable('mot_usermap_layer_default_icon', '') : '',
				);
				$sql = 'INSERT INTO ' . $this->usermap_layer_table . ' ' . $db->sql_build_array('INSERT', $sql_arr);
				$db->sql_query($sql);
				$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_USERMAP_LAYER_NEW', false, array($name));
				trigger_error($language->lang('ACP_USERMAP_LAYER_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				break;

			default:
				break;
		}

		// get the total number of layers
		$count_query = "SELECT COUNT(layer_id) AS 'layer_count' FROM " . $this->usermap_layer_table . '
						WHERE member_layer = 0';
		$result = $db->sql_query($count_query);
		$row = $db->sql_fetchrow($result);
		$layer_count = $row['layer_count'];
		$db->sql_freeresult($result);

		// load the 'usermap_layer' table
		$query = 'SELECT * FROM ' . $this->usermap_layer_table . '
				WHERE member_layer = 0 ORDER BY layer_id ASC';
		$result = $db->sql_query_limit($query, $limit, $start);
		$layers = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);

		//base url for pagination
		$base_url = $this->u_action;

		// Load pagination
		$pagination = $phpbb_container->get('pagination');
		$start = $pagination->validate_start($start, $limit, $layer_count);
		$pagination->generate_template_pagination($base_url, 'pagination', 'start', $layer_count, $limit, $start);

		foreach ($layers as $row)
		{
			$lang_vars = json_decode($row['layer_lang_var'], true);
			$lang_str = '';
			foreach ($lang_vars as $key => $value)
			{
				$lang_str .= '<b>[' . $key . ']</b>: ' . $value . '   ';
			}
			$template->assign_block_vars('layer', array(
				'NAME'				=> $row['layer_name'],
				'MEMBER_LAYER'		=> $row['member_layer'] == 1 ? true : false,
				'LAYER_ACTIVE'		=> $row['layer_active'] == 1 ? true : false,
				'SHOW_LAYER'		=> $row['show_layer'] == 1 ? true : false,
				'LAYER_LANG_VAR'	=> $lang_str,
				'DEFAULT_ICON'		=> $row['default_icon'],
				'U_DELETE'			=> $this->u_action . '&amp;action=delete&amp;layer_id=' . ($row['layer_id'] . '&amp;layer_name=' . $row['layer_name']),
				'U_EDIT'			=> $this->u_action . '&amp;action=edit&amp;layer_id=' . ($row['layer_id']),
			));
		}

		$icon_files = array();
		$icon_files = $this->usermap_functions->get_icons($this->icon_path);
		foreach ($icon_files as $value)
		{
			$template->assign_block_vars('poi_icon', array(
				'VALUE'		=> $value,
			));
		}

		$act = ($act == '') ? '&amp;action=submit' : $act;

		if ($new_layer)
		{
			$template->assign_vars(array(
				'ACP_USERMAP_MEMBER_LAYER'	=> 0,
				'ACP_USERMAP_LAYER_ACTIVE'	=> 1,
			));
		}

		$red_span = '<span style="color:red">';
		$mot_usermap_version = $this->md_manager->get_metadata('version');
		$template->assign_vars(array(
			'NEW_LAYER'					=> $new_layer,
			'U_ACTION'					=> $this->u_action . $act,
			'LAYER_LANG_VAR_EXP'		=> $language->lang('ACP_USERMAP_LAYER_LANG_VAR_EXP', $red_span),
			'USERMAP_VERSION'			=> $language->lang('ACP_USERMAP_VERSION', $mot_usermap_version, date('Y')),
		));
	}

}
