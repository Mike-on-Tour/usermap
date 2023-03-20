<?php
/**
*
* @package Usermap v1.1.0
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
	public static function depends_on()
	{
		return ['\mot\usermap\migrations\v_0_10_0_1'];
	}

	public function update_data()
	{
		return [
			// Remove the old ACP modules
			['if', [
				['module.exists', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_SETTINGS']],
				['module.remove', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_SETTINGS']],
			]],
			['if', [
				['module.exists', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_LANGS']],
				['module.remove', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_LANGS']],
			]],
			['if', [
				['module.exists', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_DATABASE']],
				['module.remove', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_DATABASE']],
			]],
			['if', [
				['module.exists', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_POI']],
				['module.remove', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_POI']],
			]],
		];
	}
}
