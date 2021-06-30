<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_4_0_0 extends \phpbb\db\migration\profilefield_base_migration
{

	/**
	* Check for migration v_0_3_2 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_3_2');
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
				'lang_explain'			=> 'MOT_ZIP_EXP',
				'lang_default_value'	=> '',
			));
		}
		$this->db->sql_freeresult($result);

		$insert_buffer->flush();
	}

	protected $profilefield_name = 'mot_zip';
	protected $profilefield_database_type = array('VCHAR', '');
	protected $profilefield_data = array(
		'field_name'			=> 'mot_zip',
		'field_type'			=> 'profilefields.type.string',
		'field_ident'			=> 'mot_zip',
		'field_length'			=> '10',
		'field_minlen'			=> '3',
		'field_maxlen'			=> '10',
		'field_novalue'			=> '',
		'field_default_value'	=> '',
		'field_validation'		=> '[\p{Lu}0-9\-]+',	// uppercase letters, numbers and dashes (hyphens) only
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
