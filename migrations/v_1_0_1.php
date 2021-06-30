<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_1_0_1 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_1_0_0 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_1_0_0');
	}

	public function update_data()
	{
		return array(
			array('config.update', array('mot_usermap_version', '1.0.1')),
		);
	}

}
