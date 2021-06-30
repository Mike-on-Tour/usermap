<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_4_0_1 extends \phpbb\db\migration\profilefield_base_migration
{

	/**
	* Check for migration v_0_3_2 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_4_0_0');
	}

	public function update_data()
	{
		return array(
			//  Add a custom function to insert a custom profile field
			array('custom', array(array($this, 'create_custom_field'))),
		);
	}

	/*
	*	Code borrowed from Kirk
	*/
	public function create_custom_field()
	{
		global $phpbb_root_path;
		$lang_dir = $phpbb_root_path . 'ext/mot/usermap/language/';

		$sql = 'SELECT MAX(field_order) as max_field_order
			FROM ' . PROFILE_FIELDS_TABLE;
		$result = $this->db->sql_query($sql);
		$max_field_order = (int) $this->db->sql_fetchfield('max_field_order');
		$this->db->sql_freeresult($result);

		$sql_ary = array_merge($this->profilefield_data, array(
			'field_order'			=> $max_field_order + 1,
		));

		$sql = 'INSERT INTO ' . PROFILE_FIELDS_TABLE . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
		$this->db->sql_query($sql);
		$field_id = (int) $this->db->sql_nextid();

		// fill the values of our new  custum profile field into the phpbb_profile_lang table
		$insert_buffer = new \phpbb\db\sql_insert_buffer($this->db, PROFILE_LANG_TABLE);

		$sql = 'SELECT lang_id
				FROM ' . LANG_TABLE;
		$result = $this->db->sql_query($sql);
		$lang_name = (strpos($this->profilefield_name, 'phpbb_') === 0) ? strtoupper(substr($this->profilefield_name, 6)) : strtoupper($this->profilefield_name);
		while ($lang_id = (int) $this->db->sql_fetchfield('lang_id'))
		{
			$insert_buffer->insert(array(
				'field_id'				=> (int) $field_id,
				'lang_id'				=> (int) $lang_id,
				'lang_name'				=> $lang_name,
				'lang_explain'			=> 'MOT_LAND_EXP',
				'lang_default_value'	=> '',
			));
		}
		$this->db->sql_freeresult($result);

		$insert_buffer->flush();

		// fill the dropdown values for each language into the  phpbb_profile_fields_lang table
		$insert_buffer = new \phpbb\db\sql_insert_buffer($this->db, PROFILE_FIELDS_LANG_TABLE);

		$sql = 'SELECT lang_id, lang_dir
				FROM ' . LANG_TABLE;
		$result = $this->db->sql_query($sql);
		$languages = $this->db->sql_fetchrowset($result);
		foreach ($languages as $row)
		{
			$lang_id = $row['lang_id'];
			$option_id = 0;
			// First we check whether a language directory exists for this language. If it doesn't exist, we use the English language file as a fallback solution
			$cc = (file_exists($lang_dir . $row['lang_dir'])) ? $row['lang_dir'] : 'en';
			$handle = fopen($lang_dir . $cc . '/countrycode/countrycode.txt', "rb");
			while (!feof($handle))
			{
				$line = fgets($handle);
				if ($line != '')
				{
					$insert_buffer->insert(array(
						'field_id'		=> (int) $field_id,
						'lang_id'		=> (int) $lang_id,
						'option_id'		=> (int) $option_id,
						'field_type'	=> 'profilefields.type.dropdown',
						'lang_value'	=> $line,
					));
					$option_id++;
				}
			}
			fclose($handle);
		}
		$this->db->sql_freeresult($result);

		$insert_buffer->flush();
	}

	protected $profilefield_name = 'mot_land';
	protected $profilefield_database_type = array('VCHAR', '');
	protected $profilefield_data = array(
		'field_name'			=> 'mot_land',
		'field_type'			=> 'profilefields.type.dropdown',
		'field_ident'			=> 'mot_land',
		'field_length'			=> '0',
		'field_minlen'			=> '0',
		'field_maxlen'			=> '251',
		'field_novalue'			=> '1',
		'field_default_value'	=> '1',
		'field_validation'		=> '',
		'field_required'		=> 0,
		'field_show_novalue'	=> 0,
		'field_show_on_reg'		=> 1,
		'field_show_on_pm'		=> 0,
		'field_show_on_vt'		=> 0,
		'field_show_profile'	=> 1,
		'field_hide'			=> 0,
		'field_no_view'			=> 1,
		'field_active'			=> 1,
		'field_is_contact'		=> 0,
		'field_contact_desc'	=> '',
		'field_contact_url'		=> '',
	);
}
