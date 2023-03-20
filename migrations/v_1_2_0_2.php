<?php
/**
*
* @package Usermap v1.2.0
* @copyright (c) 2020 - 2022 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_1_2_0_2 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_1_2_0_1 to be installed
	*/
	public static function depends_on()
	{
		return ['\mot\usermap\migrations\v_1_2_0_1'];
	}

	public function update_data()
	{
		return [
			// add new modules
			['module.add', [
				'acp',
				'ACP_USERMAP',
				[
					'module_basename'	=> '\mot\usermap\acp\mot_usermap_module',
					'modes'				=> ['settings', 'langs', 'database', 'poi', 'layer',],
				]
			]],
		];
	}

	public function revert_data()
	{
		return [
			// Remove extension modules
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
			['if', [
				['module.exists', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_LAYER']],
				['module.remove', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_LAYER']],
			]],
			['if', [
				['module.exists', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_ROUTE']],
				['module.remove', ['acp', 'ACP_USERMAP', 'ACP_USERMAP_ROUTE']],
			]],
		];
	}
}
