<?php

/**
*
* @package Usermap v1.1.2
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class database_module
{
	public $u_action;

	public function main()
	{
		global $template, $request, $db, $phpbb_container, $config, $user;

		setlocale(LC_ALL, 'C');
		$language = $phpbb_container->get('language');
		$log = $phpbb_container->get('log');
		$this->md_manager = $phpbb_container->get('ext.manager')->create_extension_metadata_manager('mot/usermap');
		$this->tpl_name = 'acp_usermap_database';
		$this->page_title = $language->lang('ACP_USERMAP') . ' ' . $language->lang('ACP_USERMAP_DATABASE');
		$this->usermap_zipcode_table = $phpbb_container->getParameter('mot.usermap.tables.usermap_zipcodes');

		$new_zipcode = true;
		$act = '';

		// set parameters for pagination
		$start = $request->variable('start', 0);
		$limit = (int) $config['mot_usermap_rows_per_page'];	// max lines per page (default is 25)

		add_form_key('acp_usermap_database');

		$action = $request->variable('action', '');

		switch ($action)
		{
			case 'edit':
				$cc = substr($request->variable('country_code', ''), 0, 2);
				$zc = substr($request->variable('zip_code', ''), 0, 10);

				$sql_arr = [
						'country_code'	=> $cc,
						'zip_code'		=> $zc,
				];
				$sql = 'SELECT * FROM ' . $this->usermap_zipcode_table . '
						WHERE ' . $db->sql_build_array('SELECT', $sql_arr);
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$template->assign_vars([
					'ACP_USERMAP_DATABASE_CC'	=> $row['country_code'],
					'ACP_USERMAP_DATABASE_ZC'	=> $row['zip_code'],
					'ACP_USERMAP_DATABASE_NAME'	=> $row['loc_name'],
					'ACP_USERMAP_DATABASE_LAT'	=> $row['lat'],
					'ACP_USERMAP_DATABASE_LON'	=> $row['lng'],
				]);
				$new_zipcode = false;
				$act = '&amp;action=submit_changes';
				break;

			case 'delete':
				$cc = substr($request->variable('country_code', ''), 0, 2);
				$zc = substr($request->variable('zip_code', ''), 0, 10);
				if (confirm_box(true))
				{
					$sql_arr = array(
						'country_code'	=> $cc,
						'zip_code'		=> $zc,
					);
					$sql = 'DELETE FROM ' . $this->usermap_zipcode_table . '
							WHERE ' . $db->sql_build_array('DELETE', $sql_arr);
					$db->sql_query($sql);
					$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_USERMAP_ZIPCODE_DELETED', false, array(implode(', ', array($cc, $zc))));
					trigger_error($language->lang('ACP_USERMAP_DATABASE_SUCCESS') . adm_back_link($this->u_action), E_USER_NOTICE);
				}
				else
				{
					confirm_box(false, '<p>'.$language->lang('ACP_USERMAP_CONFIRM_DELETE').'</p>', build_hidden_fields(array(
						'u_action'	=> $this->u_action . '&amp;action=delete&amp;country_code=' . $cc . '$amp;zip_code=' . $zc,
					)));
				}
				break;

			case 'submit':
				if (!check_form_key('acp_usermap_database'))
				{
					trigger_error($language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$cc = substr($request->variable('mot_usermap_database_cc', ''), 0, 2);
				$zc = substr($request->variable('mot_usermap_database_zc', ''), 0, 10);
				$sql_arr = array(
					'country_code'	=> $cc,
					'zip_code'		=> $zc,
					'loc_name'		=> substr($request->variable('mot_usermap_database_name', ''), 0, 25),
					'lat'			=> $request->variable('mot_usermap_database_lat', 0.0),
					'lng'			=> $request->variable('mot_usermap_database_lon', 0.0),
				);
				$sql = 'INSERT INTO ' . $this->usermap_zipcode_table . ' ' . $db->sql_build_array('INSERT', $sql_arr);
				$db->sql_return_on_error(true);
				$db->sql_query($sql);
				if ($db->get_sql_error_triggered())
				{
					$sql_error = $db->get_sql_error_returned();
					if ($sql_error['code'] == 1062)
					{
						trigger_error($language->lang('ACP_USERMAP_DATABASE_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
					}
				}
				else
				{
					$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_USERMAP_ZIPCODE_NEW', false, array(implode(', ', array($cc, $zc))));
					trigger_error($language->lang('ACP_USERMAP_DATABASE_SUCCESS') . adm_back_link($this->u_action));
				}
				$db->sql_return_on_error();
				break;

			case 'submit_changes':
				if (!check_form_key('acp_usermap_database'))
				{
					trigger_error($language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$cc = substr($request->variable('mot_usermap_database_cc', ''), 0, 2);
				$zc = substr($request->variable('mot_usermap_database_zc', ''), 0, 10);
				$sql_arr = array(
					'loc_name'		=> substr($request->variable('mot_usermap_database_name', ''), 0, 25),
					'lat'			=> $request->variable('mot_usermap_database_lat', 0.0),
					'lng'			=> $request->variable('mot_usermap_database_lon', 0.0),
				);
				$sql = "UPDATE " . $this->usermap_zipcode_table . "
						SET " . $db->sql_build_array('UPDATE', $sql_arr) . "
						WHERE country_code = '" . $db->sql_escape($cc) . "' AND zip_code = '" . $db->sql_escape($zc) . "'";

				$db->sql_query($sql);

				$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_USERMAP_ZIPCODE_EDIT', false, array(implode(', ', array($cc, $zc))));
				trigger_error($language->lang('ACP_USERMAP_DATABASE_SUCCESS') . adm_back_link($this->u_action));
				break;

			default:
				break;
		}

		// get the total number of zip codes
		$count_query = "SELECT COUNT(zip_code) AS 'zip_count' FROM " . $this->usermap_zipcode_table;
		$result = $db->sql_query($count_query);
		$row = $db->sql_fetchrow($result);
		$db_size = $row['zip_count'];
		$db->sql_freeresult($result);

		// load the 'usermap_zipcodes' table
		$query = 'SELECT * FROM ' . $this->usermap_zipcode_table;
		$result = $db->sql_query_limit( $query, $limit, $start );
		$codes = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);

		//base url for pagination
		$base_url = $this->u_action;

		// Load pagination
		$pagination = $phpbb_container->get('pagination');
		$start = $pagination->validate_start($start, $limit, $db_size);
		$pagination->generate_template_pagination($base_url, 'pagination', 'start', $db_size, $limit, $start);

		foreach ($codes as $row)
		{
			$template->assign_block_vars('database', array(
				'COUNTRYCODE'	=> $row['country_code'],
				'ZIPCODE'		=> $row['zip_code'],
				'LOCNAME'		=> $row['loc_name'],
				'LAT'			=> $row['lat'],
				'LNG'			=> $row['lng'],
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;country_code=' . urlencode($row['country_code']) . '&amp;zip_code=' . urlencode($row['zip_code']),
				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;country_code=' . urlencode($row['country_code']) . '&amp;zip_code=' . urlencode($row['zip_code']),
			));
		}

		$act = ($act == '') ? '&amp;action=submit' : $act;
		$mot_usermap_version = $this->md_manager->get_metadata('version');
		$template->assign_vars(array(
			'NEW_ZIPCODE'		=> $new_zipcode,
			'U_ACTION'			=> $this->u_action . $act,
			'ERROR_CC'			=> $language->lang('ACP_USERMAP_DATABASE_ERROR', $language->lang('ACP_USERMAP_DATABASE_CC')),
			'ERROR_ZC'			=> $language->lang('ACP_USERMAP_DATABASE_ERROR', $language->lang('ACP_USERMAP_DATABASE_ZIPCODE')),
			'USERMAP_VERSION'	=> $language->lang('ACP_USERMAP_VERSION', $mot_usermap_version, date('Y')),
		));
	}
}
