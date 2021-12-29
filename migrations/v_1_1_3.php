<?php
/**
*
* @package Usermap v1.1.3
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_1_1_3 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_1_1_2 to be installed
	*/
	public static function depends_on()
	{
		return ['\mot\usermap\migrations\v_1_1_2'];
	}

	public function update_schema()
	{
		return [
			'change_columns' => [
				$this->table_prefix . 'usermap_users' => [
					'user_plz'	=> ['VCHAR:10', ''],
				],
			],
		];
	}

	public function update_data()
	{
		return [
			['config.remove', ['mot_usermap_version']],
		];
	}

	public function revert_data()
	{
		return [
			// add old config values
			['config.add', ['mot_usermap_version', '']],
		];
	}

	public function revert_schema()
	{
		return [];
	}
}
