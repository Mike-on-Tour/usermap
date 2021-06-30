<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_1_1_0_0 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_1_0_1 to be installed
	*/
	public static function depends_on()
	{
		return ['\mot\usermap\migrations\v_1_0_1'];
	}

	public function update_data()
	{
		return [
			// Add the config variables we want to be able to set
			['config.add', ['mot_usermap_rows_per_page', 25]],
			// Update the version number
			['config.update', ['mot_usermap_version', '1.1.0']],
		];
	}

	public function update_schema()
	{
		return [
			'drop_columns' => [
				$this->table_prefix . 'usermap_users' => [
					'username',
					'user_colour',
				],
			],
			'add_columns' => [
				$this->table_prefix . 'usermap_zipcodes' => [
					'loc_name'	=> ['VCHAR:25', ''],
				],
				$this->table_prefix . 'usermap_users' => [
					'layer_id'	=> ['UINT:10', 0],
				],
				$this->table_prefix . 'usermap_poi' => [
					'layer_id'	=> ['UINT:10', 0],
				],
			],
			'add_tables' => [
				$this->table_prefix . 'usermap_layers' => [
					'COLUMNS'	=> [
						'layer_id'			=> ['UINT:10', null, 'auto_increment'],
						'layer_name'		=> ['VCHAR:255', ''],
						'member_layer'		=> ['TINT:1', 0],
						'layer_active'		=> ['TINT:1', 0],
						'show_layer'		=> ['TINT:1', 0],
						'layer_lang_var'	=> ['TEXT', ''],
						'default_icon'		=> ['VCHAR:40', ''],
					],
					'PRIMARY_KEY'	=> 'layer_id',
				],
			],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_tables'	=> [
				$this->table_prefix . 'usermap_layers',
			],
		];
	}
}
