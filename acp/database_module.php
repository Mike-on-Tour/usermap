<?php

/**
*
* @package Usermap v0.6.x
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class database_module
{
	public $u_action;
	public $tpl_name;
	public $page_title;

	public function main()
	{
		global $language, $template, $request, $db, $phpbb_container, $phpbb_root_path, $phpEx;

		$this->tpl_name = 'acp_usermap_database';
		$this->page_title = $language->lang('ACP_USERMAP') . ' ' . $language->lang('ACP_USERMAP_DATABASE');
		$this->include_path = $phpbb_root_path . 'ext/mot/usermap/includes/';
		include_once($this->include_path . 'um_constants.' . $phpEx);

		// set parameters for pagination
		$start = (null !== ($request->variable('start', 0))) ? $request->variable('start', 0) : 0;
		$limit = 25;	// max 25 lines per page

		add_form_key('acp_usermap_database');

		$action = $request->variable('action', '');

		switch ($action)
		{
			case 'delete':
				$cc = substr($request->variable('country_code', ''), 0, 2);
				$zc = substr($request->variable('zip_code', ''), 0, 10);
				if (confirm_box(true))
				{
					$sql_arr = array(
						'country_code'	=> $cc,
						'zip_code'		=> $zc,
					);
					$sql = 'DELETE FROM ' . USERMAP_ZIPCODE_TABLE . '
							WHERE ' . $db->sql_build_array('DELETE', $sql_arr);
					$db->sql_query($sql);
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

				$sql_arr = array(
					'country_code'	=> substr($request->variable('mot_usermap_database_cc', ''), 0, 2),
					'zip_code'		=> substr($request->variable('mot_usermap_database_zc', ''), 0, 10),
					'lat'			=> substr($request->variable('mot_usermap_database_lat', ''), 0, 10),
					'lng'			=> substr($request->variable('mot_usermap_database_lon', ''), 0, 11),
				);
				$sql = 'INSERT INTO ' . USERMAP_ZIPCODE_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_arr);
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
					trigger_error($language->lang('ACP_USERMAP_DATABASE_SUCCESS') . adm_back_link($this->u_action));
				}
				$db->sql_return_on_error();
				break;

			default:
				break;
		}

		// load the 'usermap_zipcodes' table
		$query = 'SELECT * FROM ' . USERMAP_ZIPCODE_TABLE;
		$result = $db->sql_query($query);
		$codes = $db->sql_fetchrowset($result);
		$db_size = sizeof($codes);
		$db->sql_freeresult($result);

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
				'LAT'			=> $row['lat'],
				'LNG'			=> $row['lng'],
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;country_code=' . urlencode($row['country_code']) . '&amp;zip_code=' . urlencode($row['zip_code']),
			));
		}

		$template->assign_vars(array(
			'U_ACTION'			=> $this->u_action . '&amp;action=submit',
			'ERROR_CC'			=> $language->lang('ACP_USERMAP_DATABASE_ERROR', $language->lang('ACP_USERMAP_DATABASE_CC')),
			'ERROR_ZC'			=> $language->lang('ACP_USERMAP_DATABASE_ERROR', $language->lang('ACP_USERMAP_DATABASE_ZIPCODE')),
		));
	}
}
