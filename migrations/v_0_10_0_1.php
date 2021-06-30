<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_10_0_1 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_10_0_0 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_10_0_0');
	}

	public function update_data()
	{
		return array(
			// remove old config values
			array('config.remove', array('mot_usermap_poi_showtoall')),
		);
	}

	public function update_schema()
	{
		return array(
			'add_columns' => array(
				$this->table_prefix . 'usermap_poi' => array(
					'creator_id'	=> array('UINT:10', 0),
					'disabled'		=> array('UINT:1', 0),
				),
			),
		);
	}

	public function revert_data()
	{
		return array(
			// re-add a removed variable in order to have a clean deinstall
			array('config.add', array('mot_usermap_poi_showtoall', 0)),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns' => array(
				$this->table_prefix . 'usermap_poi' => array(
					'creator_id',
					'disabled',
				),
			),
		);
	}
}
