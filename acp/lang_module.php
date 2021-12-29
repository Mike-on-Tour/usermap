<?php

/**
*
* @package Usermap v1.1.3
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class lang_module
{
	public $u_action;

	public function main()
	{
		global $template, $request, $db, $phpbb_container, $user, $phpbb_root_path;

		$language = $phpbb_container->get('language');
		$log = $phpbb_container->get('log');
		$this->md_manager = $phpbb_container->get('ext.manager')->create_extension_metadata_manager('mot/usermap');
		$this->tpl_name = 'acp_usermap_lang';
		$this->page_title = $language->lang('ACP_USERMAP') . ' ' . $language->lang('ACP_USERMAP_LANGS');
		$this->lang_path = $phpbb_root_path . 'ext/mot/usermap/language/';

		add_form_key('acp_usermap_langs');

		// Set some variables first
		$langs_2_install = [];		// array holding the languages waiting for installation
		$missing_langs = [];		// array with the languages which are installed on the board but without a language pack within the extension

		// Get the field_id of the 'mot_land' field from the profile_fields table
		$query = "SELECT field_id FROM " . PROFILE_FIELDS_TABLE . " WHERE field_name = 'mot_land'";
		$result = $db->sql_query($query);
		$row = $db->sql_fetchrow($result);
		$mot_land_id = $row['field_id'];			// integer with the field_id of the custom profile field 'mot_land'
		$db->sql_freeresult($result);

		// then we load the 'lang' table
		$query = 'SELECT * FROM ' . LANG_TABLE;
		$result = $db->sql_query($query);
		$langs = $db->sql_fetchrowset($result);		// array holding the installed languages of the board
		$db->sql_freeresult($result);

		// then we get the names of the subdirectories in the 'language' directory
		$lang_dirs = $this->dir_counter($this->lang_path);

		$action = $request->variable('action', '');
		$iso = $request->variable('iso', '');
		$lang_id = $request->variable('lang_id', 0);	// integer with the lang_id of the language to be installed

		switch ($action)
		{
			case 'install':
				// at this point we do know: field_id of mot_land ($mot_land_id), iso code  and language id of the language to install and therefore it's subdirectory (ISO) name
				// first we have to delete the current lines for this field_id and lang_id in the profile_fields_lang table since it may contain the en language variables if the language to be installed wasn't available at activation
				$sql_arr = array(
					'field_id'	=> $mot_land_id,
					'lang_id'	=> $lang_id,
				);
				$query = 'DELETE FROM ' . PROFILE_FIELDS_LANG_TABLE . '
						WHERE ' . $db->sql_build_array('DELETE', $sql_arr);
				$db->sql_query($query);

				// now we read the content of the approbriate countrycode file
				$countrycodes = file($this->lang_path . $iso . '/countrycode/countrycode.txt', FILE_IGNORE_NEW_LINES + FILE_SKIP_EMPTY_LINES);

				// and insert it into the profile_fields_lang table
				$max_i = count($countrycodes);
				$insert_buffer = new \phpbb\db\sql_insert_buffer($db, PROFILE_FIELDS_LANG_TABLE);
				for ($i = 0; $i < $max_i; $i++)
				{
					$insert_buffer->insert(array(
						'field_id'		=> $mot_land_id,
						'lang_id'		=> $lang_id,
						'option_id'		=> $i,
						'field_type'	=> 'profilefields.type.dropdown',
						'lang_value'	=> $countrycodes[$i],
					));
				}
				$insert_buffer->flush();
				$log->add('admin', $user->data['user_id'], $user->ip, 'LOG_USERMAP_INSTALL_LANG', false, array($iso));
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

				$sql_arr = array(
					'field_id'	=> $mot_land_id,
					'lang_id'	=> $row['lang_id'],
					'option_id'	=> 0,
				);
				$query = 'SELECT lang_value FROM ' . PROFILE_FIELDS_LANG_TABLE . '
							WHERE ' . $db->sql_build_array('SELECT', $sql_arr);
				$result = $db->sql_query($query);
				$entry = $db->sql_fetchrow($result);
				$line_db = trim($entry['lang_value']);	// get the first line from the database
				$db->sql_freeresult($result);

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
			$template->assign_block_vars('notinst', array(
				'NAME'			=> $row['lang_english_name'],
				'LOCAL_NAME'	=> $row['lang_local_name'],
				'ISO'			=> $row['lang_iso'],
				'U_INSTALL'		=> $this->u_action . '&amp;action=install&amp;iso=' . urlencode($row['lang_iso']) . '&amp;lang_id=' . urlencode($row['lang_id']),
			));
		}

		foreach ($missing_langs as $row)
		{
			$template->assign_block_vars('missing', array(
				'NAME'			=> $row['lang_english_name'],
				'LOCAL_NAME'	=> $row['lang_local_name'],
				'ISO'			=> $row['lang_iso'],
			));
		}

		// if there still is some content in the lang_dirs array we've got languages in the extension without a corresponding language installed in the board
		// possible future improvement: Delete those subdirectories from the mot/usermap/language directory (only reason so far would be that they no longer 'disturb')
		foreach ($lang_dirs as $row)
		{
			$template->assign_block_vars('additional', array(
				'ISO'			=> $row,
			));
		}

		$mot_usermap_version = $this->md_manager->get_metadata('version');
		$template->assign_vars(array(
			'U_ACTION'				=> $this->u_action,
			'USERMAP_VERSION'		=> $language->lang('ACP_USERMAP_VERSION', $mot_usermap_version, date('Y')),
		));
	}

	function dir_counter($dir)
	{
		$return = array();
		$path = scandir($dir);

		foreach ($path as $element)
		{
			if ($element != '.' && $element != '..' && is_dir ($dir.'/'.$element))
			{
				$return[] = $element;
			}
		}

		return $return;
	}
}
