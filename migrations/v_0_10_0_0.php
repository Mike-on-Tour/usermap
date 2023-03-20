<?php
/**
*
* @package Usermap v1.2.0
* @copyright (c) 2020 - 2022 Mike-on-Tour
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
		return ['\mot\usermap\migrations\v_0_9_0_1'];
	}

	public function update_data()
	{
		$data = [
			// set the new config values
			['config.add', ['mot_usermap_version', '0.10.0']],
			['config.add', ['mot_usermap_iconsize_default', '11,10']],
			['config.add', ['mot_usermap_iconanchor_default', '5,9']],

			// set the permission values
			['permission.add', ['a_manage_usermap']],
			['permission.add', ['m_release_poi']],
			['permission.add', ['u_view_map_always']],
			['permission.add', ['u_view_map_inscribed']],
			['permission.add', ['u_view_poi']],
			['permission.add', ['u_add_poi']],
			['permission.add', ['u_add_poi_with_mod']],
		];

		// set (at least some) role permissions
		if ($this->role_exists('ROLE_ADMIN_FULL'))
		{
			$data[] = ['permission.permission_set', ['ROLE_ADMIN_FULL', 'a_manage_usermap']];
		}
		if ($this->role_exists('ROLE_ADMIN_FULL'))
		{
			$data[] = ['permission.permission_set', ['ROLE_ADMIN_FULL', 'm_release_poi']];
		}
		if ($this->role_exists('ROLE_USER_FULL'))
		{
			$data[] = ['permission.permission_set', ['ROLE_USER_FULL', 'u_view_map_always']];
			$data[] = ['permission.permission_set', ['ROLE_USER_FULL', 'u_view_poi']];
			$data[] = ['permission.permission_set', ['ROLE_USER_FULL', 'u_add_poi']];
		}

		return $data;
	}

	private function role_exists($role)
	{
		$sql = 'SELECT role_id
			FROM ' . ACL_ROLES_TABLE . "
			WHERE role_name = '" . $this->db->sql_escape($role) . "'";
		$result = $this->db->sql_query_limit($sql, 1);
		$role_id = $this->db->sql_fetchfield('role_id');
		$this->db->sql_freeresult($result);
		return $role_id;
	}
}
