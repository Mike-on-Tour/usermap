<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_10_0_4 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_10_0_3 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_10_0_3');
	}

	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'correct_langs'))),
		);
	}

	/*
	*	Corrects faulty language entries by first deleting the existing entries and then inserting the new, correct ones
	*
	*	@params	none
	*
	*/
	public function correct_langs()
	{
		global $phpbb_root_path;
		$lang_dir = $phpbb_root_path . 'ext/mot/usermap/language/';

		// create a data base insert buffer
		$insert_buffer = new \phpbb\db\sql_insert_buffer($this->db, PROFILE_FIELDS_LANG_TABLE);

		// get the field_id of CPF 'mot_land'
		$sql_arr = array(
			'field_name' => 'mot_land',
		);
		$sql = 'SELECT field_id FROM ' . PROFILE_FIELDS_TABLE . '
				WHERE ' . $this->db->sql_build_array('SELECT', $sql_arr);
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		$field_id = $row['field_id'];

		// get all installed languages
		$sql = 'SELECT lang_id, lang_dir
				FROM ' . LANG_TABLE;
		$result = $this->db->sql_query($sql);
		$languages = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		// now do the following for all installed languages
		foreach ($languages as $row)
		{
			// start with deleting the existing values
			$sql_arr = array(
				'field_id'	=> $field_id,
				'lang_id'	=> $row['lang_id'],
			);
			$sql = 'DELETE FROM ' . PROFILE_FIELDS_LANG_TABLE . '
					WHERE ' . $this->db->sql_build_array('DELETE', $sql_arr);
			$this->db->sql_query($sql);

			// first we check whether a language directory exists in Usermap for this language. If it doesn't exist, we use the English language file as a fallback solution
			$cc = file_exists($lang_dir . $row['lang_dir']) ? $row['lang_dir'] : 'en';
			// and load this files content into an array
			$countrycodes = file($lang_dir . $cc . '/countrycode/countrycode.txt', FILE_IGNORE_NEW_LINES + FILE_SKIP_EMPTY_LINES);

			// fill the insert buffer
			$max_i = count($countrycodes);
			for ($i = 0; $i < $max_i; $i++)
			{
				$insert_buffer->insert(array(
					'field_id'		=> (int) $field_id,
					'lang_id'		=> (int) $row['lang_id'],
					'option_id'		=> (int) $i,
					'field_type'	=> 'profilefields.type.dropdown',
					'lang_value'	=> $countrycodes[$i],
				));
			}

			// and flush the buffer into the table
			$insert_buffer->flush();	// DONE
		}
	}
}
