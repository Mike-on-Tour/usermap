<?php
/**
*
* @package Usermap v0.3.x (changed in 1.2.0)
* @copyright (c) 2019 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_3_0 extends \phpbb\db\migration\migration
{

	/**
	* If our config variable already exists in the db
	* skip this migration.
	*/
	public function effectively_installed()
	{
		return isset($this->config['mot_usermap_lat']);
	}

	public function update_data()
	{
		setlocale(LC_ALL, 'C');
		return [

			// Add the config variable we want to be able to set
			['config.add', ['mot_usermap_lat', '50.5']],
			['config.add', ['mot_usermap_lon', '10.0']],
			['config.add', ['mot_usermap_zoom', 5]],

			// Add a parent module (ACP_USERMAP) to the Extensions tab (ACP_CAT_DOT_MODS)
			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_USERMAP'
			]],

			// Add our main_module to the parent module (ACP_USERMAP)
			['module.add', [
				'acp',
				'ACP_USERMAP',
				[
					'module_langname'	=> 'ACP_USERMAP_SETTINGS',
					'module_basename'	=> '\mot\usermap\acp\main_module',
					'module_mode'		=> 'settings',
					'module_auth'       => 'ext_mot/usermap && acl_a_board',
				],
			]],
		];
	}

	public function update_schema()
	{
		return [
			'add_tables'	=> [
				$this->table_prefix . 'usermap_users'	=> [
					'COLUMNS'	=> [
						'user_id'			=> ['UINT:10', 0],
						'username'			=> ['VCHAR:255', ''],
						'user_colour'		=> ['VCHAR:6', ''],
						'user_lat'			=> ['VCHAR:20', ''],
						'user_lng'			=> ['VCHAR:20', ''],
						'user_land'			=> ['VCHAR:2', ''],
						'user_plz'			=> ['VCHAR:8', ''],
						'user_location'		=> ['VCHAR:255', ''],
						'user_change_plz'	=> ['UINT:11', 0],
						'user_change_coord'	=> ['UINT:11', 0],
					],
					'PRIMARY_KEY'	=> 'user_id',
				],
			],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_tables'	=> [
				$this->table_prefix . 'usermap_users',
			],
		];
	}

}
