<?php
/**
*
* @package Usermap v1.1.0 (changed in 1.2.0)
* @copyright (c) 2019 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_5_0 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_4_0_2 to be installed
	*/
	public static function depends_on()
	{
		return ['\mot\usermap\migrations\v_0_4_0_2'];
	}

	public function update_data()
	{
		return [

			// Add the lang_module to the parent module (ACP_USERMAP)
			['module.add', [
				'acp',
				'ACP_USERMAP',
				[
					'module_langname'	=> 'ACP_USERMAP_LANGS',
					'module_basename'	=> '\mot\usermap\acp\lang_module',
					'module_mode'		=> 'lang',
					'module_auth'       => 'ext_mot/usermap && acl_a_board',
				],
			]],
		];
	}

}
