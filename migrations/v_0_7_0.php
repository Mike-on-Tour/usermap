<?php
/**
*
* @package Usermap v1.1.0 (changed in 1.2.0)
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_7_0 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_6_0_1 to be installed
	*/
	public static function depends_on()
	{
		return ['\mot\usermap\migrations\v_0_6_0_1'];
	}

	public function update_data()
	{
		return [
			// Add the config variables we want to be able to set
			['config.add', ['mot_usermap_poi_enable', 0]],
			['config.add', ['mot_usermap_poi_showtoall', 0]],

			// Add the config text variable we want to be able to set
			['config_text.add', ['mot_usermap_poi_legend', '']],

			// Add the poi_module to the parent module (ACP_USERMAP)
			['module.add', [
				'acp',
				'ACP_USERMAP',
				[
					'module_langname'	=> 'ACP_USERMAP_POI',
					'module_basename'	=> '\mot\usermap\acp\poi_module',
					'module_mode'		=> 'poi',
					'module_auth'       => 'ext_mot/usermap && database_module',
				],
			]],
		];
	}

	public function update_schema()
	{
		return [
			'add_tables'	=> [
				$this->table_prefix . 'usermap_poi'	=> [
					'COLUMNS'	=> [
						'poi_id'		=> ['UINT', null, 'auto_increment'],
						'name'			=> ['VCHAR:50', ''],
						'popup'			=> ['VCHAR:1000', ''],
						'icon'			=> ['VCHAR:40', ''],
						'lat'			=> ['VCHAR:20', ''],
						'lng'			=> ['VCHAR:20', ''],
					],
					'PRIMARY_KEY'	=> 'poi_id',
				],
			],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_tables'	=> [
				$this->table_prefix . 'usermap_poi',
			],
		];
	}

}
