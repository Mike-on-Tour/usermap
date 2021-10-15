<?php
/**
*
* @package Usermap v1.1.2
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_1_1_2 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_1_1_1 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_1_1_1');
	}

	public function update_data()
	{
		return array(
			array('config.update', array('mot_usermap_version', '1.1.2')),
		);
	}

}
