<?php
/**
*
* @package Usermap v1.2.0
* @copyright (c) 2020 - 2022 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_1_2_0_0 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_1_1_3 to be installed
	*/
	public static function depends_on()
	{
		return ['\mot\usermap\migrations\v_1_1_3'];
	}

	public function update_schema()
	{
		return [
			'add_columns' => [
				$this->table_prefix . 'usermap_layers' => [
					'enable_clusters'	=> ['TINT:1', 0],
					'layer_type'		=> ['TINT:1', 0],
					'layer_position'	=> ['TINT:1', 0],
					'layer_groups'		=> ['VCHAR:128', json_encode([])],
				],
			],
		];
	}

	public function update_data()
	{
		return [
			// copy the values for new column 'layer_type' from column 'member_layer' in usermap_layers table
			['custom', [[$this, 'copy_column']]],
			// set the initial values for new column 'layer_position' to the sequence of layer_ids within the seperate layer types
			['custom', [[$this, 'set_positions']]],
			// set the initial values for new column 'layer_groups' to all main groups from the users table
			['custom', [[$this, 'set_groups']]],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_columns' => [
				$this->table_prefix . 'usermap_layers' => [
					'enable_clusters',
					'layer_type',
					'layer_position',
					'layer_groups',
				],
			],
		];
	}

	public function copy_column()
	{
		$sql = 'SELECT layer_id, member_layer FROM ' . $this->table_prefix . 'usermap_layers';
		$result = $this->db->sql_query($sql);
		$layers = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);
		foreach ($layers as $row)
		{
			if ($row['member_layer'] == 0)
			{
				$sql = 'UPDATE ' . $this->table_prefix . 'usermap_layers
						SET layer_type = 1
						WHERE layer_id = ' . (int) $row['layer_id'];
			}
			else
			{
				$sql = 'UPDATE ' . $this->table_prefix . 'usermap_layers
						SET layer_type = 0
						WHERE layer_id = ' . (int) $row['layer_id'];
			}
			$this->db->sql_query($sql);
		}
	}

	public function set_positions()
	{
		$layer_types = [0, 1];
		foreach ($layer_types as $value)
		{
			$sql = 'SELECT layer_id FROM ' . $this->table_prefix . 'usermap_layers
					WHERE layer_type = ' . (int) $value . '
					ORDER BY layer_id ASC';
			$result = $this->db->sql_query($sql);
			$layers = $this->db->sql_fetchrowset($result);
			$this->db->sql_freeresult($result);
			$i = 1;
			foreach ($layers as $row)
			{
				$sql = 'UPDATE ' . $this->table_prefix . 'usermap_layers
						SET layer_position = ' . (int) $i . '
						WHERE layer_id = ' . (int) $row['layer_id'];
				$this->db->sql_query($sql);
				$i++;
			}
		}
	}

	public function set_groups()
	{
		$used_groups = [];
		$sql = 'SELECT group_id FROM ' . USERS_TABLE . '
				GROUP BY group_id';
		$result = $this->db->sql_query($sql);
		$group_ids = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);
		foreach ($group_ids as $row)
		{
			$used_groups[] = (int) $row['group_id'];
		}
		$sql = "UPDATE " . $this->table_prefix . "usermap_layers
				SET layer_groups = '" . json_encode($used_groups) . "'";
		$this->db->sql_query($sql);
	}
}
