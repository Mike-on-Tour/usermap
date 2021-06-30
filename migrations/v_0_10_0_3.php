<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_10_0_3 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_10_0_2 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_10_0_2');
	}

	public function update_data()
	{
		return array(
			array('if', array(
				$this->check_module('acp', 'ACP_USERMAP', 'ACP_USERMAP_SETTINGS'),
				array('module.add', array(
					'acp',
					'ACP_USERMAP',
					array(
						'module_basename'	=> '\mot\usermap\acp\main_module',
						'module_langname'	=> 'ACP_USERMAP_SETTINGS',
						'module_mode'		=> 'settings',
						'module_auth'		=> 'ext_mot/usermap && acl_a_manage_usermap',
				))),
			)),
			array('if', array(
				$this->check_module('acp', 'ACP_USERMAP', 'ACP_USERMAP_LANGS'),
				array('module.add', array(
					'acp',
					'ACP_USERMAP',
					array(
						'module_basename'	=> '\mot\usermap\acp\lang_module',
						'module_langname'	=> 'ACP_USERMAP_LANGS',
						'module_mode'		=> 'lang',
						'module_auth'		=> 'ext_mot/usermap && acl_a_manage_usermap',
				))),
			)),
			array('if', array(
				$this->check_module('acp', 'ACP_USERMAP', 'ACP_USERMAP_DATABASE'),
				array('module.add', array(
					'acp',
					'ACP_USERMAP',
					array(
						'module_basename'	=> '\mot\usermap\acp\database_module',
						'module_langname'	=> 'ACP_USERMAP_DATABASE',
						'module_mode'		=> 'database',
						'module_auth'		=> 'ext_mot/usermap && acl_a_manage_usermap',
				))),
			)),
			array('if', array(
				$this->check_module('acp', 'ACP_USERMAP', 'ACP_USERMAP_POI'),
				array('module.add', array(
					'acp',
					'ACP_USERMAP',
					array(
						'module_basename'	=> '\mot\usermap\acp\poi_module',
						'module_langname'	=> 'ACP_USERMAP_POI',
						'module_mode'		=> 'poi',
						'module_auth'		=> 'ext_mot/usermap && acl_a_manage_usermap',
				))),
			)),
		);
	}

	/*
	*	Checks whether a modul identified by it's module_langname exists under a given parent (also identified by the module_langname) and in a given module class
	*
	*	@params	string	$class	Name of the module class, e.g.' acp'
	*			string	$parent	Langname of the parent to be checked
	*			string	$module	Langname of the module to be checked
	*
	*	@return	boolean			True if the module doesn't exist, false if either the parent doesn't exist or the module already exists
	*/
	private function check_module($class, $parent, $module)
	{
		// check if parent exists
		$sql = 'SELECT module_id FROM ' . MODULES_TABLE . "
			WHERE module_class = '" . $this->db->sql_escape($class) . "'
			AND module_langname = '" . $this->db->sql_escape($parent) . "'";
		$result = $this->db->sql_query($sql);
		$parent_id = $this->db->sql_fetchfield('module_id', false, $result); // sql_fetchfield() returns either the id or false if this module doesn't exist
		$this->db->sql_freeresult($result);
		// Parent doesn't exist -> module can not be given to this parent so we return a false
		if (!$parent_id)
		{
			return false;
		}

		// Parent exists, now check if this module already exists under this parent
		$sql = 'SELECT module_id FROM ' . MODULES_TABLE . "
			WHERE module_class = '" . $this->db->sql_escape($class) . "'
			AND parent_id = " . (int) $parent_id . "
			AND module_langname = '" . $this->db->sql_escape($module) . "'";
		$result = $this->db->sql_query($sql);
		$module_id = $this->db->sql_fetchfield('module_id', false, $result);
		$this->db->sql_freeresult($result);

		if (!$module_id)
		{
			return true;	// Module doesn't exist -> return true to enable adding this module
		}
		else
		{
			return false;	// Module already exists -> no need to adding it a second time
		}
	}
}
