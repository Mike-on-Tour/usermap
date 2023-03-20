<?php
/**
*
* @package Usermap v1.2.1
* @copyright (c) 2020 - 2022 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_1_2_1 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_1_2_0_2 to be installed
	*/
	public static function depends_on()
	{
		return ['\mot\usermap\migrations\v_1_2_0_2'];
	}

	public function update_schema()
	{
		return [
			'change_columns' => [
				$this->table_prefix . 'usermap_poi' => [
					'name'	=> ['VCHAR:60', ''],
				],
			],
		];
	}

	public function update_data()
	{
		return [
			// Execute a custom function to set the POI names to a text generated for storage
			['custom', [[$this, 'transfer_poi_names']]],
		];
	}

	public function revert_schema()
	{
		return [];
	}

	public function transfer_poi_names()
	{
		if (!defined('USERMAP_POI_TABLE'))
		{
			define('USERMAP_POI_TABLE',		$this->table_prefix . 'usermap_poi');
		}

		$name_flags = 0;
		$uid = $bitfield = '';

		$sql = 'SELECT poi_id, name FROM ' . USERMAP_POI_TABLE . '
				ORDER BY poi_id ASC';
		$result = $this->db->sql_query($sql);
		$poi_data = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		foreach ($poi_data as &$row)
		{
			$row['name'] = generate_text_for_display($row['name'], $uid, $bitfield, $name_flags);
			$row['name'] = str_replace(['"', "'", ';', ':', '#', '*', '´', '`', '/', '(', ')', '{', '}', '[', ']', '=', '!', '?', '§', '$', '%', '&'], '', $row['name']);
		}

		foreach ($poi_data as $row)
		{
			generate_text_for_storage($row['name'], $uid, $bitfield, $name_flags);
			$sql = 'UPDATE ' . USERMAP_POI_TABLE . '
					SET name = "' . $this->db->sql_escape($row['name']) . '"
					WHERE poi_id = ' . (int) $row['poi_id'];
			$this->db->sql_query($sql);
		}

	}
}
