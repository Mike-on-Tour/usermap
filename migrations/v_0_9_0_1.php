<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_9_0_1 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_9_0_0 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_9_0_0');
	}

	public function update_data()
	{
		return array(
			// set the values for columns 'icon_size' and 'icon_anchor' in usermap_poi table for all poi icons which came with this package
			array('custom', array(array($this, 'set_icon_values'))),
		);
	}

	public function set_icon_values()
	{
		if (!defined('USERMAP_POI_TABLE'))
		{
			define("USERMAP_POI_TABLE", $this->table_prefix . 'usermap_poi');
		}

		$sql_arr = array(
			'icon_size'		=> '11,10',
			'icon_anchor'	=> '5,9',
		);
		$icon_arr = array('motTriangleBlue.svg', 'motTriangleCyan.svg', 'motTriangleGreen.svg', 'motTriangleMagenta.svg', 'motTriangleRed.svg', 'motTriangleYellow.svg');

		$query = 'UPDATE ' . USERMAP_POI_TABLE . '
				SET ' . $this->db->sql_build_array('UPDATE', $sql_arr) . '
				WHERE ' . $this->db->sql_in_set('icon', $icon_arr);
		$this->db->sql_query($query);
	}

}
