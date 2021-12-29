<?php

/**
*
* @package Usermap v1.1.3
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class main_module
{
	public $u_action;

	public function main()
	{
		global $template, $request, $config, $phpbb_container, $user, $phpbb_root_path;

		$language = $phpbb_container->get('language');
		$log = $phpbb_container->get('log');
		$this->md_manager = $phpbb_container->get('ext.manager')->create_extension_metadata_manager('mot/usermap');
		$this->tpl_name = 'acp_usermap_main';
		$this->page_title = $language->lang('ACP_USERMAP') . ' ' . $language->lang('ACP_USERMAP_SETTINGS');
		$this->config_text = $phpbb_container->get('config_text');

		$uid = $bitfield = '';
		$flags = OPTION_FLAG_BBCODE;	// === 0b0001   ( this really is of no interest since this variable gets set in the called function according to every flag set to true
		$preview_text = '';
		$jump_to_poi_legend = false;	// to prevent scrolling to the legend edit section if not in edit mode

		$language->add_lang(array('posting'));

		add_form_key('mot_usermap_settings');

		$action = $request->variable('action', '');
		$action_legend = $request->variable('action_legend', '');

		switch ($action_legend)
		{
			case 'submit':
				if (!check_form_key('mot_usermap_settings'))
				{
					trigger_error($language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$config_value = $request->variable('mot_usermap_poi_legend_text', '', true);
				generate_text_for_storage($config_value, $uid, $bitfield, $flags, true);
				$this->config_text->set('mot_usermap_poi_legend', $config_value);
				$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_POI_LEGEND_UPDATED', false);
				trigger_error($language->lang('ACP_USERMAP_SETTING_SAVED') . adm_back_link($this->u_action), E_USER_NOTICE);
				break;

			case 'preview':
				$config_value = $request->variable('mot_usermap_poi_legend_text', '', true);
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
				trigger_error($language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}

			setlocale(LC_ALL, 'C');
			// save the settings to the phpbb_config table
			$config->set('mot_usermap_rows_per_page', $request->variable('mot_usermap_rows_per_page', 0));
			$config->set('mot_usermap_lat', substr($request->variable('mot_usermap_lat', ''), 0, 10));
			$config->set('mot_usermap_lon', substr($request->variable('mot_usermap_lon', ''), 0, 11));
			$config->set('mot_usermap_zoom', $request->variable('mot_usermap_zoom', 0));
			$config->set('mot_usermap_markers_pc', $request->variable('mot_usermap_markers_pc', 0));
			$config->set('mot_usermap_markers_mob', $request->variable('mot_usermap_markers_mob', 0));
			$geonames_user = $request->variable('mot_usermap_geonamesuser', '', true);
			$geonames_user = preg_replace('/[ ]/', '', $geonames_user); // get rid of any spaces
			$config->set('mot_usermap_geonamesuser', $geonames_user);
			$config->set('mot_usermap_google_enable', ($request->variable('mot_usermap_google_enable', false)) ? '1' : '0');
			$config->set('mot_usermap_google_apikey', $request->variable('mot_usermap_google_key', '', true));
			$config->set('mot_usermap_google_countries', $request->variable('mot_usermap_google_force', '', true));
			$config->set('mot_usermap_database_enable', ($request->variable('mot_usermap_database_enable', false)) ? '1' : '0');
			$config->set('mot_usermap_poi_enable', ($request->variable('mot_usermap_poi_enable', false)) ? '1' : '0');
			$config->set('mot_usermap_iconsize_default', $request->variable('mot_usermap_iconsize_default', ''));
			$config->set('mot_usermap_iconanchor_default', $request->variable('mot_usermap_iconanchor_default', ''));
			$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_USERMAP_SETTING_UPDATED', false);
			trigger_error($language->lang('ACP_USERMAP_SETTING_SAVED') . adm_back_link($this->u_action));
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
		$mot_usermap_version = $this->md_manager->get_metadata('version');
		$template->assign_vars(array(
			'USERMAP_VERSION'					=> $language->lang('ACP_USERMAP_VERSION', $mot_usermap_version, date('Y')),
			'ACP_USERMAP_ROWS_PER_PAGE'			=> $config['mot_usermap_rows_per_page'],
			'ACP_USERMAP_LAT'					=> $config['mot_usermap_lat'],
			'ACP_USERMAP_LON'					=> $config['mot_usermap_lon'],
			'ACP_USERMAP_ZOOM'					=> $config['mot_usermap_zoom'],
			'ACP_USERMAP_MARKERS_PC'			=> $config['mot_usermap_markers_pc'],
			'ACP_USERMAP_MARKERS_MOB'			=> $config['mot_usermap_markers_mob'],
			'ACP_USERMAP_GEONAMESUSER'			=> $config['mot_usermap_geonamesuser'],
			'ACP_USERMAP_GOOGLE_ENABLE'			=> $config['mot_usermap_google_enable'] ? true : false,
			'ACP_USERMAP_GOOGLE_KEY'			=> $config['mot_usermap_google_apikey'],
			'ACP_USERMAP_GOOGLE_FORCE'			=> $config['mot_usermap_google_countries'],
			'ACP_USERMAP_DATABASE_ENABLE'		=> $config['mot_usermap_database_enable'] ? true : false,
			'ACP_USERMAP_POI_ENABLE'			=> $config['mot_usermap_poi_enable'] ? true : false,
			'MOT_USERMAP_ICONSIZE_DEFAULT'		=> $config['mot_usermap_iconsize_default'],
			'ACP_USERMAP_ICONANCHOR_DEFAULT'	=> $config['mot_usermap_iconanchor_default'],
			'U_ACTION'							=> $this->u_action . '&amp;action=submit',
			'U_ACTION_LEGEND'					=> $this->u_action . '&amp;action_legend=submit',
			'U_ACTION_LGND_PREVIEW'				=> $this->u_action . '&amp;action_legend=preview',
			'ACP_USERMAP_POI_LGND'				=> $config_value,
			'PREVIEW_TEXT'						=> $preview_text,
			'JUMP_TO_POI_LEGEND'				=> $jump_to_poi_legend,
			'GEONAMES_TEXT'						=> $language->lang('ACP_USERMAP_GEONAMES_TEXT', $geonames_login, $geonames_account),
			'GOOGLE_TEXT'						=> $language->lang('ACP_USERMAP_GOOGLE_TEXT', $geonames_list, $google_key),
			'GOOGLE_FORCE'						=> $language->lang('ACP_USERMAP_GOOGLE_FORCE_TXT', $geonames_readme),
			'ICON_PAYPAL'						=> '<img src="' . $phpbb_root_path . 'ext/mot/usermap/adm/images/Paypal.svg" />',
		));
	}
}
