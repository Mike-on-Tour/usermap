<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_10_0_0 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_9_0_1 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_9_0_1');
	}

	public function update_data()
	{
		return array(
			// set the new config values
			array('config.add', array('mot_usermap_version', '0.10.0')),
			array('config.add', array('mot_usermap_iconsize_default', '11,10')),
			array('config.add', array('mot_usermap_iconanchor_default', '5,9')),

			// set the permission values
			array('permission.add', array('a_manage_usermap')),
			array('permission.add', array('m_release_poi')),
			array('permission.add', array('u_view_map_always')),
			array('permission.add', array('u_view_map_inscribed')),
			array('permission.add', array('u_view_poi')),
			array('permission.add', array('u_add_poi')),
			array('permission.add', array('u_add_poi_with_mod')),

			// set (at least some) role permissions
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_manage_usermap')),
			array('permission.permission_set', array('ROLE_MOD_FULL', 'm_release_poi')),
			array('permission.permission_set', array('ROLE_USER_FULL', 'u_view_map_always')),
			array('permission.permission_set', array('ROLE_USER_FULL', 'u_view_poi')),
			array('permission.permission_set', array('ROLE_USER_FULL', 'u_add_poi')),
		);
	}

}
