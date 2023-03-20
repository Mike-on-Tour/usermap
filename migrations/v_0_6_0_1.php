<?php
/**
*
* @package Usermap v1.1.0 (changed in 1.2.0)
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_6_0_1 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_6_0_0 to be installed
	*/
	public static function depends_on()
	{
		return ['\mot\usermap\migrations\v_0_6_0_0'];
	}

	public function update_data()
	{
		return [

			// Add the database_module to the parent module (ACP_USERMAP)
			['module.add', [
				'acp',
				'ACP_USERMAP',
				[
					'module_langname'	=> 'ACP_USERMAP_DATABASE',
					'module_basename'	=> '\mot\usermap\acp\database_module',
					'module_mode'		=> 'database',
					'module_auth'       => 'ext_mot/usermap && acl_a_board',
				],
			]],
		];
	}

	public function update_schema()
	{
		return [
			'add_tables'	=> [
				$this->table_prefix . 'usermap_zipcodes'	=> [
					'COLUMNS'	=> [
						'country_code'	=> ['VCHAR:2', ''],
						'zip_code'		=> ['VCHAR:10', ''],
						'lat'			=> ['VCHAR:20', ''],
						'lng'			=> ['VCHAR:20', ''],
					],
					'KEYS'		=> [
						'country_zip'	=> ['UNIQUE', ['country_code', 'zip_code']],
					],
				],
			],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_tables'	=> [
				$this->table_prefix . 'usermap_zipcodes',
			],
		];
	}

}
