<?php

/**
*
* @package Usermap v0.10.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_10_0_2 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_10_0_1 to be installed
	*/
	static public function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_10_0_1');
	}

	public function update_data()
	{
		return array(
			// Remove the old ACP modules
			array('if', array(
				array('module.exists', array('acp', 'ACP_USERMAP', 'ACP_USERMAP_SETTINGS')),
				array('module.remove', array('acp', 'ACP_USERMAP', 'ACP_USERMAP_SETTINGS')),
			)),
			array('if', array(
				array('module.exists', array('acp', 'ACP_USERMAP', 'ACP_USERMAP_LANGS')),
				array('module.remove', array('acp', 'ACP_USERMAP', 'ACP_USERMAP_LANGS')),
			)),
			array('if', array(
				array('module.exists', array('acp', 'ACP_USERMAP', 'ACP_USERMAP_DATABASE')),
				array('module.remove', array('acp', 'ACP_USERMAP', 'ACP_USERMAP_DATABASE')),
			)),
			array('if', array(
				array('module.exists', array('acp', 'ACP_USERMAP', 'ACP_USERMAP_POI')),
				array('module.remove', array('acp', 'ACP_USERMAP', 'ACP_USERMAP_POI')),
			)),
		);
	}
}
