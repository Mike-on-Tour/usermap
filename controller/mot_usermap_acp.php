<?php
/**
*
* @package Usermap v1.3.0
* @copyright (c) 2020 - 2025 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\controller;

class mot_usermap_acp
{
	const MEMBER_LAYER = 0;
	const POI_LAYER = 1;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/* @var \phpbb\group\helper */
	protected $group_helper;

	/** @var \phpbb\language\language $language Language object */
	protected $language;

	/** @var \phpbb\log\log $log */
	protected $log;

	/** @var \phpbb\pagination  */
	protected $pagination;

	/** @var \phpbb\extension\manager */
	protected $phpbb_extension_manager;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \mot\usermap\includes\functions_usermap */
	protected $usermap_functions;

	/** @var string mot.usermap.tables.usermap_layers */
	protected $mot_usermap_layer_table;

	/** @var string mot.usermap.tables.usermap_poi */
	protected $mot_usermap_poi_table;

	/** @var string mot.usermap.tables.usermap_poi */
	protected $mot_usermap_zipcode_table;

	/**
	 * {@inheritdoc
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\db\driver\driver_interface $db,
								\phpbb\group\helper $group_helper, \phpbb\language\language $language, \phpbb\log\log $log, \phpbb\pagination $pagination,
								\phpbb\extension\manager $phpbb_extension_manager, \phpbb\request\request_interface $request, \phpbb\template\template $template,
								\phpbb\user $user, \mot\usermap\includes\functions_usermap $usermap_functions, $mot_usermap_layer_table, $mot_usermap_poi_table,
								$mot_usermap_zipcode_table)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->db = $db;
		$this->group_helper = $group_helper;
		$this->language = $language;
		$this->log = $log;
		$this->pagination = $pagination;
		$this->phpbb_extension_manager = $phpbb_extension_manager;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->usermap_functions = $usermap_functions;
		$this->usermap_layer_table = $mot_usermap_layer_table;
		$this->usermap_poi_table = $mot_usermap_poi_table;
		$this->usermap_zipcode_table = $mot_usermap_zipcode_table;

		$this->md_manager = $this->phpbb_extension_manager->create_extension_metadata_manager('mot/usermap');
		$this->usermap_version = $this->md_manager->get_metadata('version');
		$this->ext_path = $this->phpbb_extension_manager->get_extension_path('mot/usermap', true);
	}


	public function settings()
	{
		$uid = $bitfield = '';
		$flags = OPTION_FLAG_BBCODE;	// === 0b0001   ( this really is of no interest since this variable gets set in the called function according to every flag set to true
		$preview_text = '';
		$jump_to_poi_legend = false;	// to prevent scrolling to the legend edit section if not in edit mode

		$this->language->add_lang(['posting']);

		add_form_key('mot_usermap_settings');

		$action = $this->request->variable('action', '');
		$action_legend = $this->request->variable('action_legend', '');

		switch ($action_legend)
		{
			case 'submit':
				if (!check_form_key('mot_usermap_settings'))
				{
					trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$config_value = $this->request->variable('mot_usermap_poi_legend_text', '', true);
				generate_text_for_storage($config_value, $uid, $bitfield, $flags, true);
				$this->config_text->set('mot_usermap_poi_legend', $config_value);
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_POI_LEGEND_UPDATED', false);
				trigger_error($this->language->lang('ACP_USERMAP_SETTING_SAVED') . adm_back_link($this->u_action), E_USER_NOTICE);
				break;

			case 'preview':
				$config_value = $this->request->variable('mot_usermap_poi_legend_text', '', true);
				generate_text_for_storage($config_value, $uid, $bitfield, $flags, true);
				$preview_text = generate_text_for_display($config_value, $uid, $bitfield, $flags);
				$result = generate_text_for_edit($config_value, $uid, $flags);
				$config_value = $result['text'];
				$jump_to_poi_legend = true;
				break;

			default:
				break;
		}

		if ($action == 'submit')
		{
			if (!check_form_key('mot_usermap_settings'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}

			setlocale(LC_ALL, 'C');
			// save the settings to the phpbb_config table
			$this->config->set('mot_usermap_rows_per_page', $this->request->variable('mot_usermap_rows_per_page', 0));
			$this->config->set('mot_usermap_lat', substr($this->request->variable('mot_usermap_lat', ''), 0, 10));
			$this->config->set('mot_usermap_lon', substr($this->request->variable('mot_usermap_lon', ''), 0, 11));
			$this->config->set('mot_usermap_zoom', $this->request->variable('mot_usermap_zoom', 0));
			$this->config->set('mot_usermap_markers_pc', $this->request->variable('mot_usermap_markers_pc', 0));
			$this->config->set('mot_usermap_markers_mob', $this->request->variable('mot_usermap_markers_mob', 0));
			$geonames_user = $this->request->variable('mot_usermap_geonamesuser', '', true);
			$geonames_user = preg_replace('/[ ]/', '', $geonames_user); // get rid of any spaces
			$this->config->set('mot_usermap_geonamesuser', $geonames_user);
			$this->config->set('mot_usermap_google_enable', $this->request->variable('mot_usermap_google_enable', false) ? '1' : '0');
			$this->config->set('mot_usermap_google_apikey', $this->request->variable('mot_usermap_google_key', '', true));
			$this->config->set('mot_usermap_google_countries', $this->request->variable('mot_usermap_google_force', '', true));
			$this->config->set('mot_usermap_database_enable', $this->request->variable('mot_usermap_database_enable', false) ? '1' : '0');
			$this->config->set('mot_usermap_poi_enable', $this->request->variable('mot_usermap_poi_enable', false) ? '1' : '0');
			$this->config->set('mot_usermap_iconsize_default', $this->request->variable('mot_usermap_iconsize_default', ''));
			$this->config->set('mot_usermap_iconanchor_default', $this->request->variable('mot_usermap_iconanchor_default', ''));
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_SETTING_UPDATED', false);
			trigger_error($this->language->lang('ACP_USERMAP_SETTING_SAVED') . adm_back_link($this->u_action));
		}

		if ($action_legend != 'preview')
		{
			$config_value = $this->config_text->get('mot_usermap_poi_legend');
			$preview_text = ($preview_text == '') ? generate_text_for_display($config_value, $uid, $bitfield, $flags) : $preview_text;
			$result = generate_text_for_edit($config_value, $uid, $flags);
			$config_value = $result['text'];
		}

		$geonames_login = '<a href="https://www.geonames.org/login" target="_blank"><span style="text-decoration: underline;">geonames.org/login</span></a>';
		$geonames_account = '<a href="https://www.geonames.org/enablefreewebservice" target="_blank"><span style="text-decoration: underline;">';
		$geonames_list = '<a href="https://www.geonames.org/postal-codes/" target="_blank"><span style="text-decoration: underline;">';
		$google_key = '<a href="https://developers.google.com/maps/documentation/embed/get-api-key" target="_blank"><span style="text-decoration: underline;">';
		$geonames_readme = '<a href="http://download.geonames.org/export/zip/readme.txt" target="_blank"><span style="text-decoration: underline;">';
		$this->template->assign_vars([
			'ACP_USERMAP_ALLOW_URL_FOPEN'		=> ini_get('allow_url_fopen'),
			'USERMAP_VERSION'					=> $this->language->lang('ACP_USERMAP_VERSION', $this->usermap_version, date('Y')),
			'ACP_USERMAP_ROWS_PER_PAGE'			=> $this->config['mot_usermap_rows_per_page'],
			'ACP_USERMAP_LAT'					=> $this->config['mot_usermap_lat'],
			'ACP_USERMAP_LON'					=> $this->config['mot_usermap_lon'],
			'ACP_USERMAP_ZOOM'					=> $this->config['mot_usermap_zoom'],
			'ACP_USERMAP_MARKERS_PC'			=> $this->config['mot_usermap_markers_pc'],
			'ACP_USERMAP_MARKERS_MOB'			=> $this->config['mot_usermap_markers_mob'],
			'ACP_USERMAP_GEONAMESUSER'			=> $this->config['mot_usermap_geonamesuser'],
			'ACP_USERMAP_GOOGLE_ENABLE'			=> $this->config['mot_usermap_google_enable'] ? true : false,
			'ACP_USERMAP_GOOGLE_KEY'			=> $this->config['mot_usermap_google_apikey'],
			'ACP_USERMAP_GOOGLE_FORCE'			=> $this->config['mot_usermap_google_countries'],
			'ACP_USERMAP_DATABASE_ENABLE'		=> $this->config['mot_usermap_database_enable'] ? true : false,
			'ACP_USERMAP_POI_ENABLE'			=> $this->config['mot_usermap_poi_enable'] ? true : false,
			'MOT_USERMAP_ICONSIZE_DEFAULT'		=> $this->config['mot_usermap_iconsize_default'],
			'ACP_USERMAP_ICONANCHOR_DEFAULT'	=> $this->config['mot_usermap_iconanchor_default'],
			'U_ACTION'							=> $this->u_action . '&amp;action=submit',
			'U_ACTION_LEGEND'					=> $this->u_action . '&amp;action_legend=submit',
			'U_ACTION_LGND_PREVIEW'				=> $this->u_action . '&amp;action_legend=preview',
			'ACP_USERMAP_POI_LGND'				=> $config_value,
			'PREVIEW_TEXT'						=> $preview_text,
			'JUMP_TO_POI_LEGEND'				=> $jump_to_poi_legend,
			'GEONAMES_TEXT'						=> $this->language->lang('ACP_USERMAP_GEONAMES_TEXT', $geonames_login, $geonames_account),
			'GOOGLE_TEXT'						=> $this->language->lang('ACP_USERMAP_GOOGLE_TEXT', $geonames_list, $google_key),
			'GOOGLE_FORCE'						=> $this->language->lang('ACP_USERMAP_GOOGLE_FORCE_TXT', $geonames_readme),
		]);
	}

	public function langs()
	{
		$this->lang_path = $this->ext_path . 'language/';

		add_form_key('acp_usermap_langs');

		// Set some variables first
		$langs_2_install = [];		// array holding the languages waiting for installation
		$missing_langs = [];		// array with the languages which are installed on the board but without a language pack within the extension

		// Get the field_id of the 'mot_land' field from the profile_fields table
		$sql = "SELECT field_id FROM " . PROFILE_FIELDS_TABLE . "
				WHERE field_name = 'mot_land'";
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$mot_land_id = $row['field_id'];			// integer with the field_id of the custom profile field 'mot_land'
		$this->db->sql_freeresult($result);

		// then we load the 'lang' table
		$sql = 'SELECT * FROM ' . LANG_TABLE;
		$result = $this->db->sql_query($sql);
		$langs = $this->db->sql_fetchrowset($result);		// array holding the installed languages of the board
		$this->db->sql_freeresult($result);

		// then we get the names of the subdirectories in the 'language' directory
		$lang_dirs = $this->usermap_functions->dir_counter($this->lang_path);

		$action = $this->request->variable('action', '');
		$iso = $this->request->variable('iso', '');
		$lang_id = $this->request->variable('lang_id', 0);	// integer with the lang_id of the language to be installed

		switch ($action)
		{
			case 'install':
				// at this point we do know: field_id of mot_land ($mot_land_id), iso code  and language id of the language to install and therefore it's subdirectory (ISO) name
				// first we have to delete the current lines for this field_id and lang_id in the profile_fields_lang table since it may contain the en language variables if the language to be installed wasn't available at activation
				$sql_arr = [
					'field_id'	=> $mot_land_id,
					'lang_id'	=> $lang_id,
				];
				$sql = 'DELETE FROM ' . PROFILE_FIELDS_LANG_TABLE . '
						WHERE ' . $this->db->sql_build_array('DELETE', $sql_arr);
				$this->db->sql_query($sql);

				// now we read the content of the approbriate countrycode file
				$countrycodes = file($this->lang_path . $iso . '/countrycode/countrycode.txt', FILE_IGNORE_NEW_LINES + FILE_SKIP_EMPTY_LINES);

				// and insert it into the profile_fields_lang table
				$max_i = count($countrycodes);
				$insert_buffer = new \phpbb\db\sql_insert_buffer($this->db, PROFILE_FIELDS_LANG_TABLE);
				for ($i = 0; $i < $max_i; $i++)
				{
					$insert_buffer->insert([
						'field_id'		=> $mot_land_id,
						'lang_id'		=> $lang_id,
						'option_id'		=> $i,
						'field_type'	=> 'profilefields.type.dropdown',
						'lang_value'	=> $countrycodes[$i],
					]);
				}
				$insert_buffer->flush();
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_INSTALL_LANG', false, [$iso]);
			break;
		}

		// we start by iterating through the 'lang' table content to check for missing language packs
		foreach ($langs as $row)
		{
			$nr = array_search($row['lang_dir'], $lang_dirs);
			if ($nr !== false)
			{			// at least there is a directory with this language iso code, now we check whether this language pack is successfully installed with usermap
				$handle = fopen($this->lang_path . $row['lang_dir'] . '/countrycode/countrycode.txt', "rb");
				$line_file = trim(fgets($handle));	// get the first line from the file (reads 'xx-Select your country' in the English version)
				fclose($handle);

				$sql_arr = [
					'field_id'	=> $mot_land_id,
					'lang_id'	=> $row['lang_id'],
					'option_id'	=> 0,
				];
				$sql = 'SELECT lang_value FROM ' . PROFILE_FIELDS_LANG_TABLE . '
						WHERE ' . $this->db->sql_build_array('SELECT', $sql_arr);
				$result = $this->db->sql_query($sql);
				$entry = $this->db->sql_fetchrow($result);
				$line_db = trim($entry['lang_value']);	// get the first line from the database
				$this->db->sql_freeresult($result);

				// compare the 2 lines, if they differ, this language wasn't installed, e.g. it was installed with the en version during activation of the usermap or with the boards default language during installation of this language
				if ($line_file != $line_db)
				{
					$langs_2_install[] = $row;
				}

				array_splice($lang_dirs, $nr, 1);	// delete this language from the directory list
			}
			else
			{			// no directory with this language iso code found -> assume it is a missing language pack
				$missing_langs[] = $row;
			}
		}

		foreach ($langs_2_install as $row)
		{
			$this->template->assign_block_vars('notinst', [
				'NAME'			=> $row['lang_english_name'],
				'LOCAL_NAME'	=> $row['lang_local_name'],
				'ISO'			=> $row['lang_iso'],
				'U_INSTALL'		=> $this->u_action . '&amp;action=install&amp;iso=' . urlencode($row['lang_iso']) . '&amp;lang_id=' . urlencode($row['lang_id']),
			]);
		}

		foreach ($missing_langs as $row)
		{
			$this->template->assign_block_vars('missing', [
				'NAME'			=> $row['lang_english_name'],
				'LOCAL_NAME'	=> $row['lang_local_name'],
				'ISO'			=> $row['lang_iso'],
			]);
		}

		// if there still is some content in the lang_dirs array we've got languages in the extension without a corresponding language installed in the board
		// possible future improvement: Delete those subdirectories from the mot/usermap/language directory (only reason so far would be that they no longer 'disturb')
		foreach ($lang_dirs as $row)
		{
			$this->template->assign_block_vars('additional', [
				'ISO'			=> $row,
			]);
		}

		$this->template->assign_vars([
			'U_ACTION'				=> $this->u_action,
			'USERMAP_VERSION'		=> $this->language->lang('ACP_USERMAP_VERSION', $this->usermap_version, date('Y')),
		]);
	}

	public function database()
	{
		setlocale(LC_ALL, 'C');

		$new_zipcode = true;
		$act = '';

		// set parameters for pagination
		$start = $this->request->variable('start', 0);
		$limit = (int) $this->config['mot_usermap_rows_per_page'];

		add_form_key('acp_usermap_database');

		$action = $this->request->variable('action', '');

		switch ($action)
		{
			case 'edit':
				$cc = substr($this->request->variable('country_code', ''), 0, 2);
				$zc = substr($this->request->variable('zip_code', ''), 0, 10);

				$sql_arr = [
						'country_code'	=> $cc,
						'zip_code'		=> $zc,
				];
				$sql = 'SELECT * FROM ' . $this->usermap_zipcode_table . '
						WHERE ' . $this->db->sql_build_array('SELECT', $sql_arr);
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				$this->template->assign_vars([
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
				$cc = substr($this->request->variable('country_code', ''), 0, 2);
				$zc = substr($this->request->variable('zip_code', ''), 0, 10);
				if (confirm_box(true))
				{
					$sql_arr = [
						'country_code'	=> $cc,
						'zip_code'		=> $zc,
					];
					$sql = 'DELETE FROM ' . $this->usermap_zipcode_table . '
							WHERE ' . $this->db->sql_build_array('DELETE', $sql_arr);
					$this->db->sql_query($sql);
					$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_ZIPCODE_DELETED', false, [implode(', ', [$cc, $zc])]);
					trigger_error($this->language->lang('ACP_USERMAP_DATABASE_SUCCESS') . adm_back_link($this->u_action), E_USER_NOTICE);
				}
				else
				{
					confirm_box(false, '<p>'.$this->language->lang('ACP_USERMAP_CONFIRM_DELETE').'</p>', build_hidden_fields([
						'u_action'	=> $this->u_action . '&amp;action=delete&amp;country_code=' . $cc . '$amp;zip_code=' . $zc,
					]));
				}
				break;

			case 'submit':
				if (!check_form_key('acp_usermap_database'))
				{
					trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$cc = substr($this->request->variable('mot_usermap_database_cc', ''), 0, 2);
				$zc = substr($this->request->variable('mot_usermap_database_zc', ''), 0, 10);
				$sql_arr = [
					'country_code'	=> $cc,
					'zip_code'		=> $zc,
					'loc_name'		=> substr($this->request->variable('mot_usermap_database_name', ''), 0, 25),
					'lat'			=> $this->request->variable('mot_usermap_database_lat', 0.0),
					'lng'			=> $this->request->variable('mot_usermap_database_lon', 0.0),
				];
				$sql = 'INSERT INTO ' . $this->usermap_zipcode_table . ' ' . $this->db->sql_build_array('INSERT', $sql_arr);
				$this->db->sql_return_on_error(true);
				$this->db->sql_query($sql);
				if ($this->db->get_sql_error_triggered())
				{
					$sql_error = $this->db->get_sql_error_returned();
					if ($sql_error['code'] == 1062)
					{
						trigger_error($this->language->lang('ACP_USERMAP_DATABASE_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
					}
				}
				else
				{
					$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_ZIPCODE_NEW', false, [implode(', ', [$cc, $zc])]);
					trigger_error($this->language->lang('ACP_USERMAP_DATABASE_SUCCESS') . adm_back_link($this->u_action));
				}
				$this->db->sql_return_on_error();
				break;

			case 'submit_changes':
				if (!check_form_key('acp_usermap_database'))
				{
					trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$cc = substr($this->request->variable('mot_usermap_database_cc', ''), 0, 2);
				$zc = substr($this->request->variable('mot_usermap_database_zc', ''), 0, 10);
				$sql_arr = [
					'loc_name'		=> substr($this->request->variable('mot_usermap_database_name', ''), 0, 25),
					'lat'			=> $this->request->variable('mot_usermap_database_lat', 0.0),
					'lng'			=> $this->request->variable('mot_usermap_database_lon', 0.0),
				];
				$sql = "UPDATE " . $this->usermap_zipcode_table . "
						SET " . $this->db->sql_build_array('UPDATE', $sql_arr) . "
						WHERE country_code = '" . $this->db->sql_escape($cc) . "' AND zip_code = '" . $this->db->sql_escape($zc) . "'";

				$this->db->sql_query($sql);

				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_ZIPCODE_EDIT', false, [implode(', ', [$cc, $zc])]);
				trigger_error($this->language->lang('ACP_USERMAP_DATABASE_SUCCESS') . adm_back_link($this->u_action));
				break;

			default:
				break;
		}

		// get the total number of zip codes
		$count_query = "SELECT COUNT(zip_code) AS 'zip_count' FROM " . $this->usermap_zipcode_table;
		$result = $this->db->sql_query($count_query);
		$db_size = $this->db->sql_fetchfield('zip_count');
		$this->db->sql_freeresult($result);

		// load the 'usermap_zipcodes' table
		$sql = 'SELECT * FROM ' . $this->usermap_zipcode_table;
		$result = $this->db->sql_query_limit( $sql, $limit, $start );
		$codes = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		//base url for pagination
		$base_url = $this->u_action;

		// Load pagination
		$start = $this->pagination->validate_start($start, $limit, $db_size);
		$this->pagination->generate_template_pagination($base_url, 'pagination', 'start', $db_size, $limit, $start);

		foreach ($codes as $row)
		{
			$this->template->assign_block_vars('database', [
				'COUNTRYCODE'	=> $row['country_code'],
				'ZIPCODE'		=> $row['zip_code'],
				'LOCNAME'		=> $row['loc_name'],
				'LAT'			=> $row['lat'],
				'LNG'			=> $row['lng'],
				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;country_code=' . $row['country_code'] . '&amp;zip_code=' . $row['zip_code'],
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;country_code=' . $row['country_code'] . '&amp;zip_code=' . $row['zip_code'],
			]);
		}

		$act = ($act == '') ? '&amp;action=submit' : $act;
		$this->template->assign_vars([
			'NEW_ZIPCODE'		=> $new_zipcode,
			'U_ACTION'			=> $this->u_action . $act,
			'ERROR_CC'			=> $this->language->lang('ACP_USERMAP_DATABASE_ERROR', $this->language->lang('ACP_USERMAP_DATABASE_CC')),
			'ERROR_ZC'			=> $this->language->lang('ACP_USERMAP_DATABASE_ERROR', $this->language->lang('ACP_USERMAP_DATABASE_ZIPCODE')),
			'USERMAP_VERSION'	=> $this->language->lang('ACP_USERMAP_VERSION', $this->usermap_version, date('Y')),
		]);
	}

	public function poi()
	{
		$this->icon_path = $this->ext_path . 'styles/all/theme/images/poi/';

		// set parameters for pagination
		$start = $this->request->variable('start', 0);
		$limit = (int) $this->config['mot_usermap_rows_per_page'];

		$uid = $bitfield = '';
		$flags = OPTION_FLAG_LINKS + OPTION_FLAG_BBCODE;	// === 0b0101   ( this really is of no interest since this variable gets set in the called function according to every flag set to true
		$name_flags = 0;
		$preview_text = '';
		$act = '';
		$new_poi = true;
		$poi_popup_preview = false;

		$selected_layer = $this->request->variable('acp_usermap_select_poi_layer', 0);
		$former_layer = $this->request->variable('acp_usermap_former_poi_layer', 0);

		if ($selected_layer != $former_layer)
		{
			$start = 0;
			$former_layer = $selected_layer;
		}

		$this->u_action .= '&amp;acp_usermap_select_poi_layer=' . $selected_layer . '&amp;acp_usermap_former_poi_layer=' . $former_layer;
		$this->u_action_preview = $this->u_action . '&amp;action=preview';

		$this->language->add_lang(['posting',]);

		$form_key = 'acp_usermap_poi';
		add_form_key($form_key);

		$action = $this->request->variable('action', '');

		switch ($action)
		{
			case 'edit':
				$poi_id = $this->request->variable('poi_id', 0);
				$sql = 'SELECT * FROM ' . $this->usermap_poi_table . '
						WHERE poi_id=' . (int) $poi_id;
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);
				$preview_text = generate_text_for_display($row['popup'], $uid, $bitfield, $flags);

				$this->template->assign_vars([
					'ACP_USERMAP_POI_NAME'			=> generate_text_for_edit($row['name'], $uid, $name_flags)['text'],
					'ACP_USERMAP_POI_POPUP'			=> generate_text_for_edit($row['popup'], $uid, $flags)['text'],
					'MOT_USERMAP_POI_ICON'			=> $row['icon'],
					'ACP_USERMAP_POI_ICON_SIZE'		=> $row['icon_size'],
					'ACP_USERMAP_POI_ICON_ANCHOR'	=> $row['icon_anchor'],
					'ACP_USERMAP_POI_LAT'			=> $row['lat'],
					'ACP_USERMAP_POI_LON'			=> $row['lng'],
					'MOT_USERMAP_POI_LAYER_ID'		=> $row['layer_id'],
					'ACP_USERMAP_SHOW_POI'			=> $row['disabled'] == 1 ? false : true,
				]);
				$this->u_action_preview = $this->u_action_preview . '&amp;poi_id=' . $poi_id;
				$act = '&amp;action=submit_changes&amp;poi_id=' . $poi_id;
				$new_poi = false;
				break;

			case 'submit_changes':
				if (!check_form_key($form_key))
				{
					trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				setlocale(LC_ALL, 'C');
				$poi_id = $this->request->variable('poi_id', 0);
				// Get the POIs name
				$name = $this->request->variable('mot_usermap_poi_name', '', true);
				// Decode double quotes
				$name = htmlspecialchars_decode($name, ENT_COMPAT);
				// Remove some unwanted characters
				$name = str_replace($this->usermap_functions::MOT_USERMAP_POI_NONECHARS, '', $name);
				$name = trim($name);
				$name = trim($name, ',');

				$popup_value = $this->request->variable('mot_usermap_poi_popup', '', true);
				generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);

				$sql_arr = [
					'name'			=> $name,
					'popup'			=> $popup_value,
					'icon'			=> $this->request->variable('mot_usermap_poi_icon', ''),
					'lat'			=> $this->request->variable('mot_usermap_poi_lat', 0.0),
					'lng'			=> $this->request->variable('mot_usermap_poi_lon', 0.0),
					'icon_size'		=> $this->request->variable('mot_usermap_poi_icon_size', ''),
					'icon_anchor'	=> $this->request->variable('mot_usermap_poi_icon_anchor', ''),
					'disabled'		=> $this->request->variable('mot_usermap_show_poi', 0) == 0 ? 1 : 0,
					'layer_id'		=> $this->request->variable('mot_usermap_poi_layer', 0),
				];
				$sql = 'UPDATE ' . $this->usermap_poi_table . '
						SET ' . $this->db->sql_build_array('UPDATE', $sql_arr) . '
						WHERE poi_id = ' . (int) $poi_id;
				$this->db->sql_query($sql);
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_POI_EDITED', false, [$name]);
				trigger_error($this->language->lang('ACP_USERMAP_POI_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				break;

			case 'delete':
				$name = $this->request->variable('poi_name', '', true);
				$poi_id = substr($this->request->variable('poi_id', ''), 0);
				if (confirm_box(true))
				{
					$sql = 'DELETE FROM ' . $this->usermap_poi_table . '
							WHERE poi_id=' . (int) $poi_id;
					$this->db->sql_query($sql);
					$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_POI_DELETED', false, [$name]);
					trigger_error($this->language->lang('ACP_USERMAP_POI_DEL_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				}
				else
				{
					confirm_box(false, '<p>'.$this->language->lang('ACP_USERMAP_POI_DELETE', $name).'</p>', build_hidden_fields([
						'u_action'	=> $this->u_action . '&amp;action=delete&amp;poi_id=' . $poi_id,
					]));
				}
				break;

			case 'submit':
				if (!check_form_key($form_key))
				{
					trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				setlocale(LC_ALL, 'C');
				// Get the POIs name
				$name = $this->request->variable('mot_usermap_poi_name', '', true);
				// Decode double quotes
				$name = htmlspecialchars_decode($name, ENT_COMPAT);
				// Remove some unwanted characters
				$name = str_replace($this->usermap_functions::MOT_USERMAP_POI_NONECHARS, '', $name);
				$name = trim($name);
				$name = trim($name, ',');

				$popup_value = $this->request->variable('mot_usermap_poi_popup', '', true);
				generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);

				$sql_arr = [
					'name'			=> $name,
					'popup'			=> $popup_value,
					'icon'			=> $this->request->variable('mot_usermap_poi_icon', ''),
					'lat'			=> $this->request->variable('mot_usermap_poi_lat', 0.0),
					'lng'			=> $this->request->variable('mot_usermap_poi_lon', 0.0),
					'icon_size'		=> $this->request->variable('mot_usermap_poi_icon_size', ''),
					'icon_anchor'	=> $this->request->variable('mot_usermap_poi_icon_anchor', ''),
					'creator_id'	=> $this->user->data['user_id'],
					'disabled'		=> $this->request->variable('mot_usermap_show_poi', 0) == 0 ? 1 : 0,
					'layer_id'		=> $this->request->variable('mot_usermap_poi_layer', 0),
				];
				$sql = 'INSERT INTO ' . $this->usermap_poi_table . ' ' . $this->db->sql_build_array('INSERT', $sql_arr);
				$this->db->sql_query($sql);
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_POI_NEW', false, [$name]);
				trigger_error($this->language->lang('ACP_USERMAP_POI_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				break;

			case 'preview':
				$poi_id = $this->request->variable('poi_id', 0);
				$popup_value = $this->request->variable('mot_usermap_poi_popup', '', true);

				generate_text_for_storage($popup_value, $uid, $bitfield, $flags, true, true);
				$preview_text = generate_text_for_display($popup_value, $uid, $bitfield, $flags);
				$result = generate_text_for_edit($popup_value, $uid, $flags);
				$popup_value = $result['text'];
				$poi_popup_preview = true;

				$this->template->assign_vars([
					'ACP_USERMAP_POI_NAME'			=> $this->request->variable('mot_usermap_poi_name', '', true),
					'ACP_USERMAP_POI_POPUP'			=> $popup_value,
					'MOT_USERMAP_POI_ICON'			=> $this->request->variable('mot_usermap_poi_icon', ''),
					'ACP_USERMAP_POI_ICON_SIZE'		=> $this->request->variable('mot_usermap_poi_icon_size', ''),
					'ACP_USERMAP_POI_ICON_ANCHOR'	=> $this->request->variable('mot_usermap_poi_icon_anchor', ''),
					'ACP_USERMAP_POI_LAT'			=> $this->request->variable('mot_usermap_poi_lat', ''),
					'ACP_USERMAP_POI_LON'			=> $this->request->variable('mot_usermap_poi_lon', ''),
					'MOT_USERMAP_POI_LAYER_ID'		=> $this->request->variable('mot_usermap_poi_layer', 0),
					'ACP_USERMAP_SHOW_POI'			=> $this->request->variable('mot_usermap_show_poi', 0) == 1 ? false : true,
				]);

				if ($poi_id > 0)		// Preview was called from inside the Edit mode
				{
					$this->u_action_preview = $this->u_action_preview . '&amp;poi_id=' . $poi_id;
					$act = '&amp;action=submit_changes&amp;poi_id=' . $poi_id;
					$new_poi = false;
				}
				break;

			default:
				break;
		}

		// Get layer data
		$layernames = $layer_icons = [];
		$sql = 'SELECT layer_id, layer_name, default_icon, layer_active FROM ' . $this->usermap_layer_table . '
				WHERE layer_type = ' . self::POI_LAYER . '
				ORDER BY layer_position ASC';
		$result = $this->db->sql_query($sql);
		$layers = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		// Set the first select element
		$this->template->assign_block_vars('layer_selection', [
			'VALUE'		=> 0,
			'NAME'		=> $this->language->lang('ACP_USERMAP_POI_LAYER_ALL'),
			'ACTIVE'	=> 1,
		]);
		foreach ($layers as $arr)
		{
			$layernames[$arr['layer_id']] = $arr['layer_name'];
			// prevent errors due to missing key '0' and set the value to the first (the topmost) layers icon
			if (empty($layer_icons))
			{
				$layer_icons[0] = $arr['default_icon'];
			}
			$layer_icons[$arr['layer_id']] = $arr['default_icon'];
			$this->template->assign_block_vars('poi_layer', [
				'LAYER_ID'		=> $arr['layer_id'],
				'LAYER_NAME'	=> $arr['layer_name'],
				'ACTIVE'		=> $arr['layer_active'],
			]);
			$this->template->assign_block_vars('layer_selection', [
				'VALUE'		=> $arr['layer_id'],
				'NAME'		=> $arr['layer_name'],
				'ACTIVE'	=> $arr['layer_active'],
			]);
		}

		// get the total number of POIs
		$count_query = "SELECT COUNT(poi_id) AS 'poi_count' FROM " . $this->usermap_poi_table;
		if ($selected_layer != 0)
		{
			$count_query .= ' WHERE layer_id = ' . (int) $selected_layer;
		}
		$result = $this->db->sql_query($count_query);
		$poi_count = $this->db->sql_fetchfield('poi_count');
		$this->db->sql_freeresult($result);

		// load the 'usermap_poi' table
		$query = 'SELECT * FROM ' . $this->usermap_poi_table;
		if ($selected_layer != 0)
		{
			$query .= ' WHERE layer_id = ' . (int) $selected_layer;
		}
		$query .= ' ORDER BY poi_id ASC';
		$result = $this->db->sql_query_limit($query, $limit, $start);
		$pois = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		//base url for pagination
		$base_url = $this->u_action;

		// Load pagination
		$start = $this->pagination->validate_start($start, $limit, $poi_count);
		$this->pagination->generate_template_pagination($base_url, 'pagination', 'start', $poi_count, $limit, $start);

		// Get all users who created a POI from USERS_TABLE
		$usernames = [];
		$sql = 'SELECT user_id, username FROM ' . USERS_TABLE . '
				WHERE user_id IN (SELECT creator_id FROM ' . $this->usermap_poi_table . ')';
		$result = $this->db->sql_query($sql);
		$users = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);
		$usernames[0] = '';		// prevent warnings or error messages where no creator is stored
		foreach ($users as $arr)
		{
			$usernames[$arr['user_id']] = $arr['username'];
		}

		foreach ($pois as $row)
		{
			$popup = generate_text_for_display($row['popup'], $uid, $bitfield, $flags);
			$poi_name = generate_text_for_display($row['name'], $uid, $bitfield, $name_flags);
			$this->template->assign_block_vars('poi', [
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
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;poi_id=' . $row['poi_id'] . '&amp;poi_name=' . urlencode($poi_name),
				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;poi_id=' . $row['poi_id'],
			]);
		}

		$icon_files = $this->usermap_functions->get_icons($this->icon_path);
		foreach ($icon_files as $value)
		{
			$this->template->assign_block_vars('poi_icon', [
				'VALUE'		=> $value,
			]);
		}

		$act = ($act == '') ? '&amp;action=submit' : $act;
		$this->template->assign_vars([
			'ACP_USERMAP_SELECT_POI_LAYER'	=> $selected_layer,
			'NEW_POI'						=> $new_poi,
			'ACP_USERMAP_POPUP_PREVIEW'		=> $poi_popup_preview,
			'U_ACTION'						=> $this->u_action . $act,
			'U_ACTION_PREVIEW'				=> $this->u_action_preview,
			'U_UM_SELECT_ACTION'			=> $this->u_action . '&amp;action=select_layer',
			'PREVIEW_TEXT'					=> $preview_text,
			'USERMAP_VERSION'				=> $this->language->lang('ACP_USERMAP_VERSION', $this->usermap_version, date('Y')),
			'DEFAULT_POI_ICON_SIZE'			=> $this->config['mot_usermap_iconsize_default'],
			'DEFAULT_POI_ICON_ANCHOR'		=> $this->config['mot_usermap_iconanchor_default'],
			'LAYERS_ARR'					=> json_encode($layers),
		]);

		if ($new_poi)
		{
			$this->template->assign_vars([
				'MOT_USERMAP_POI_LAYER_ID'		=> $selected_layer,
				'MOT_USERMAP_POI_ICON'			=> $layer_icons[$selected_layer],
				'ACP_USERMAP_POI_ICON_SIZE'		=> $this->config['mot_usermap_iconsize_default'],
				'ACP_USERMAP_POI_ICON_ANCHOR'	=> $this->config['mot_usermap_iconanchor_default'],
				'MOT_USERMAP_POI_ICON'			=> $layers[0]['default_icon'],
			]);
		}
	}

	public function layer()
	{
		$this->icon_path = $this->ext_path . 'styles/all/theme/images/poi/';
		$this->layer_names = [$this->language->lang('ACP_USERMAP_LAYER_TYPE_USER'), $this->language->lang('ACP_USERMAP_LAYER_TYPE_POI')];

		$act = '';
		$new_layer = true;

		$this->language->add_lang(['posting']);

		// set parameters for pagination
		$start = $this->request->variable('start', 0);
		$limit = (int) $this->config['mot_usermap_rows_per_page'];

		add_form_key('acp_usermap_layer');

		// get some parameters we need
		$action = $this->request->variable('action', '');
		$layer_id = $this->request->variable('layer_id', 0);
		$layer_type_selected = $this->request->variable('mot_usermap_select_layer_type', self::POI_LAYER);
		$layer_position = $this->request->variable('layer_position', 0);
		$this->u_action .= '&amp;mot_usermap_select_layer_type=' . $layer_type_selected;

		// Get the group properties of those groups used as default
		$sql_arr = [
			'SELECT'	=> 'g.group_id, g.group_type, g.group_name, u.group_id',
			'FROM'		=> [
					GROUPS_TABLE	=> 'g',
					USERS_TABLE		=> 'u',
			],
			'WHERE'		=> 'g.group_id = u.group_id',
			'GROUP_BY'	=> 'u.group_id',
			'ORDER_BY'	=> 'g.group_type DESC, g.group_name ASC',
		];
		$sql = $this->db->sql_build_query('SELECT', $sql_arr);
		$result = $this->db->sql_query($sql);
		$groups = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		$group_acl = [
			self::MEMBER_LAYER	=> ['u_view_map_always', 'u_view_map_inscribed',],
			self::POI_LAYER		=> ['u_view_poi'],
		];

		$icon_arr = [];
		$icon_files = $this->usermap_functions->get_icons($this->icon_path);
		foreach ($icon_files as $value)
		{
			$icon_arr += [
				$value	=> $value
			];
		}
		$layer_icons = $this->select_struct('', $icon_arr);

		$permitted_groups = [];
		foreach ($groups as $option)
		{
			if (!empty($this->auth->acl_group_raw_data($option['group_id'], $group_acl[$layer_type_selected])))
			{
				$permitted_groups += [
					$this->group_helper->get_name($option['group_name']) => [
						$option['group_id'],
						$option['group_type'] == GROUP_SPECIAL,
					],
				];
			}
		}
		$group_count = count($permitted_groups);
		$groups_available = $this->select_struct([], $permitted_groups);

		switch ($action)
		{
			case 'edit':
				$sql = 'SELECT * FROM ' . $this->usermap_layer_table . '
						WHERE layer_id=' . (int) $layer_id;
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				$lang_vars = json_decode($row['layer_lang_var'], true);
				$lang_str = '';
				foreach ($lang_vars as $key => $value)
				{
					$lang_str .= $key . ':' . $value . "\n";
				}
				$lang_str = trim($lang_str);

				$layer_icons = $this->select_struct($row['default_icon'], $icon_arr);
				$groups_available = $this->select_struct(json_decode($row['layer_groups']), $permitted_groups);

				$this->template->assign_vars([
					'ACP_USERMAP_LAYER_NAME'			=> $row['layer_name'],
					'ACP_USERMAP_LAYER_TYPE'			=> $row['layer_type'],
					'ACP_USERMAP_LAYER_ACTIVE'			=> $row['layer_active'] == 1 ? true : false,
					'ACP_USERMAP_SHOW_LAYER'			=> $row['show_layer'] == 1 ? true : false,
					'ACP_USERMAP_LAYER_CLUSTERS'		=> $row['enable_clusters'] == 1 ? true : false,
					'ACP_USERMAP_LAYER_LANG_VAR'		=> $lang_str,
				]);
				$act = '&amp;action=submit_changes&amp;layer_id=' . $layer_id;
				$new_layer = false;
				break;

			case 'submit_changes':
				if (!check_form_key('acp_usermap_layer'))
				{
					trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$layer_id = $this->request->variable('layer_id', 0);
				$name = $this->request->variable('mot_usermap_layer_name', '', true);
				$lang_str = explode("\n", trim($this->request->variable('mot_usermap_layer_lang_var', '', true)));

				$lang_vars = [];
				foreach ($lang_str as $value)
				{
					$temp = explode(':', trim($value));
					$lang_vars[$temp[0]] = $temp[1];
				}

				$sql_arr = [
					'layer_name'		=> $name,
					'layer_active'		=> $this->request->variable('mot_usermap_layer_active', 0),
					'show_layer'		=> $this->request->variable('mot_usermap_show_layer', 0),
					'enable_clusters'	=> $this->request->variable('mot_usermap_enable_clusters', 0),
					'layer_lang_var'	=> json_encode($lang_vars),
					'default_icon'		=> $this->request->variable('mot_usermap_select_layer_type', 0) != 0 ? $this->request->variable('mot_usermap_layer_default_icon', '') : '',
					'layer_groups'		=> json_encode($this->request->variable('mot_usermap_permitted_groups', [0])),
				];

				$sql = 'UPDATE ' . $this->usermap_layer_table . '
						SET ' . $this->db->sql_build_array('UPDATE', $sql_arr) . '
						WHERE layer_id = ' . (int) $layer_id;
				$this->db->sql_query($sql);
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_LAYER_EDITED', false, [$name]);
				trigger_error($this->language->lang('ACP_USERMAP_LAYER_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				break;

			case 'delete':
				$name = $this->request->variable('layer_name', '', true);

				if (confirm_box(true))
				{
					$this->usermap_functions->delete_layer($layer_id, $layer_type_selected, $layer_position);
					$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_LAYER_DELETED', false, [$name]);
					trigger_error($this->language->lang('ACP_USERMAP_LAYER_DEL_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				}
				else
				{
					confirm_box(false, '<p>'.$this->language->lang('ACP_USERMAP_LAYER_DELETE', $name).'</p>', build_hidden_fields([
						'u_action'	=> $this->u_action . '&amp;action=delete&amp;layer_id=' . $layer_id . '&amp;layer_name=' . $name,
					]));
				}
				break;

			case 'submit':
				if (!check_form_key('acp_usermap_layer'))
				{
					trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$name = $this->request->variable('mot_usermap_layer_name', '', true);
				$lang_str = explode("\n", trim($this->request->variable('mot_usermap_layer_lang_var', '', true)));

				$lang_vars = [];
				foreach ($lang_str as $value)
				{
					$temp = explode(':', trim($value));
					$lang_vars[$temp[0]] = $temp[1];
				}

				// We need to get the current maximum layer position within the desired layer type in order to put the new layer to the bottom of the list
				$layer_count = $this->usermap_functions->get_layer_count($layer_type_selected);

				$sql_arr = [
					'layer_name'		=> $name,
					'layer_type'		=> $layer_type_selected,
					'layer_active'		=> $this->request->variable('mot_usermap_layer_active', 0),
					'show_layer'		=> $this->request->variable('mot_usermap_show_layer', 0),
					'enable_clusters'	=> $this->request->variable('mot_usermap_enable_clusters', 0),
					'layer_lang_var'	=> json_encode($lang_vars),
					'default_icon'		=> $this->request->variable('mot_usermap_layer_type', 0) != 0 ? $this->request->variable('mot_usermap_layer_default_icon', '') : '',
					'layer_position'	=> $layer_count + 1,
					'layer_groups'		=> json_encode($this->request->variable('mot_usermap_permitted_groups', [0])),
				];
				$sql = 'INSERT INTO ' . $this->usermap_layer_table . ' ' . $this->db->sql_build_array('INSERT', $sql_arr);
				// As of ver 1.2.0 we do not permit more than one member layer so if someone tries to safe a member layer we will skip the query
				if ($layer_type_selected > self::MEMBER_LAYER)
				{
					$this->db->sql_query($sql);
					$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_LAYER_NEW', false, [$name]);
					trigger_error($this->language->lang('ACP_USERMAP_LAYER_SUCCESS', $name) . adm_back_link($this->u_action), E_USER_NOTICE);
				}
				break;

			case 'move_up':
				$this->usermap_functions->move_layer_vertically($layer_id, $layer_type_selected, $layer_position, $this->usermap_functions::MOT_USERMAP_MOVE_UP);
				break;

			case 'move_down':
				$this->usermap_functions->move_layer_vertically($layer_id, $layer_type_selected, $layer_position, $this->usermap_functions::MOT_USERMAP_MOVE_DOWN);
				break;

			default:
				break;
		}

		// get the total number of layers
		$layer_count = $this->usermap_functions->get_layer_count($layer_type_selected);

		// load the 'usermap_layer' table
		$sql = 'SELECT * FROM ' . $this->usermap_layer_table . '
				WHERE layer_type = ' . (int) $layer_type_selected . '
				ORDER BY layer_position ASC';
		$result = $this->db->sql_query_limit($sql, $limit, $start);
		$layers = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		//base url for pagination
		$base_url = $this->u_action;

		// Load pagination
		$start = $this->pagination->validate_start($start, $limit, $layer_count);
		$this->pagination->generate_template_pagination($base_url, 'pagination', 'start', $layer_count, $limit, $start);

		foreach ($layers as $row)
		{
			// get and process the language variables
			$lang_vars = json_decode($row['layer_lang_var'], true);
			$lang_str = '';
			foreach ($lang_vars as $key => $value)
			{
				$lang_str .= '<b>[' . $key . ']</b>: ' . $value . '   ';
			}

			// get and process the groups permitted to see this layer
			$groups_permitted = '';
			$layer_groups = json_decode($row['layer_groups']);
			foreach ($groups as $option)
			{
				if (in_array($option['group_id'], $layer_groups))
				{
					$group_found = $this->group_helper->get_name($option['group_name']);
					$groups_permitted .= ($groups_permitted !== '' ? ', ' . $group_found : $group_found);
				}
			}

			$u_layer_position = '&amp;layer_position=' . $row['layer_position'];
			$move_up = $row['layer_position'] == 1 ? '' : $this->u_action . '&amp;action=move_up&amp;layer_id=' . $row['layer_id'] . '&amp;layer_name=' . $row['layer_name'] . $u_layer_position;
			$move_down = $row['layer_position'] == $layer_count ? '' : $this->u_action . '&amp;action=move_down&amp;layer_id=' . $row['layer_id'] . '&amp;layer_name=' . $row['layer_name'] . $u_layer_position;
			// as of ver 1.2.0 we prevent the member layer from being deleted
			$u_delete = $row['layer_type'] != 0 ? $this->u_action . '&amp;action=delete&amp;layer_id=' . $row['layer_id'] . '&amp;layer_name=' . $row['layer_name'] . '&amp;layer_position=' . $row['layer_position'] : '';
			$this->template->assign_block_vars('layer', [
				'NAME'				=> $row['layer_name'],
				'LAYER_TYPE'		=> $this->layer_names[$row['layer_type']],
				'LAYER_ACTIVE'		=> $row['layer_active'] == 1 ? true : false,
				'SHOW_LAYER'		=> $row['show_layer'] == 1 ? true : false,
				'ENABLE_CLUSTERS'	=> $row['enable_clusters'] == 1 ? true : false,
				'LAYER_LANG_VAR'	=> $lang_str,
				'DEFAULT_ICON'		=> $row['default_icon'],
				'GROUPS_VIEWING'	=> $groups_permitted,
				'U_MOVE_UP'			=> $move_up,
				'U_MOVE_DOWN'		=> $move_down,
				'U_DELETE'			=> $u_delete,
				'U_EDIT'			=> $this->u_action . '&amp;action=edit&amp;layer_id=' . $row['layer_id'],
			]);
		}

		$act = ($act == '') ? '&amp;action=submit' : $act;

		if ($new_layer)
		{
			$this->template->assign_vars([
				'ACP_USERMAP_LAYER_ACTIVE'		=> 1,
				'ACP_USERMAP_LAYER_CLUSTERS'	=> 0,
			]);
		}

		$red_span = '<span style="color:red">';
		$this->template->assign_vars([
			'ACP_USERMAP_SELECT_LAYER_TYPE'	=> $layer_type_selected,
			'ACP_USERMAP_LAYER_TYPE'		=> $this->select_struct($layer_type_selected, [
				$this->layer_names[self::MEMBER_LAYER]	=> self::MEMBER_LAYER,
				$this->layer_names[self::POI_LAYER]		=> self::POI_LAYER,
			]),
			'NEW_LAYER'						=> $new_layer,
			'ACP_USERMAP_LAYER_ICON'		=> $layer_icons,
			'ACP_USERMAP_GROUP_COUNT'		=> $group_count,
			'ACP_USERMAP_PERMITTED_GROUPS'	=> $groups_available,
			'U_ACTION'						=> $this->u_action . $act,
			'U_UM_SELECT_ACTION'			=> $this->u_action . '&amp;action=select_layer',
			'LAYER_LANG_VAR_EXP'			=> $this->language->lang('ACP_USERMAP_LAYER_LANG_VAR_EXP', $red_span),
			'USERMAP_VERSION'				=> $this->language->lang('ACP_USERMAP_VERSION', $this->usermap_version, date('Y')),
		]);
	}

// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	/**
	 * Set custom form action.
	 *
	 * @param	string		$u_action	Custom form action
	 * @return	acp		$this		This controller for chaining calls
	 */
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;

		return $this;
	}

	private function select_struct($cfg_value, array $options): array
	{
		$options_tpl = [];

		foreach ($options as $opt_key => $opt_value)
		{
			if (!is_array($opt_value))
			{
				$opt_value = [$opt_value];
			}
			$options_tpl[] = [
				'label'		=> $opt_key,
				'value'		=> $opt_value[0],
				'bold'		=> $opt_value[1] ?? false,
				'selected'	=> is_array($cfg_value) ? in_array($opt_value[0], $cfg_value) : $opt_value[0] == $cfg_value,
			];
		}

		return $options_tpl;
	}
}
