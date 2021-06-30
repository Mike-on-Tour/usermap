<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_9_0_0 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_7_0 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_7_0');
	}

	public function update_data()
	{
		return array(
			// Add the config variables we want to be able to set
			array('config.add', array('mot_usermap_markers_pc', 4)),
			array('config.add', array('mot_usermap_markers_mob', 4)),
		);
	}

	public function update_schema()
	{
		return array(
			'add_columns' => array(
				$this->table_prefix . 'usermap_poi' => array(
					'icon_size'		=> array('VCHAR:10', ''),
					'icon_anchor'	=> array('VCHAR:10', ''),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns' => array(
				$this->table_prefix . 'usermap_poi' => array(
					'icon_size',
					'icon_anchor',
				),
			),
		);
	}

}
