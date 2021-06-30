<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2019 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_3_2 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_3_1 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_3_1');
	}

	public function update_data()
	{
		return array(

			// Add the config text variable we want to be able to set
			array('config_text.add', array('mot_usermap_countrycodes', '')),

			// Add the config text variable we want to be able to set
			array('config_text.add', array('mot_usermap_doublesarray', '')),
		);
	}

}
