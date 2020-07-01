<?php
/**
*
* @package Usermap v0.3.x
* @copyright (c) 2019 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_3_0 extends \phpbb\db\migration\migration
{

	/**
	* If our config variable already exists in the db
	* skip this migration.
	*/
	public function effectively_installed()
	{
		return isset($this->config['mot_usermap_lat']);
	}
/*
	// Für die nächste Version:
	static public function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_3_0');
	}
*/
	public function update_data()
	{
		return array(

			// Add the config variable we want to be able to set
			array('config.add', array('mot_usermap_lat', 50.5)),
			array('config.add', array('mot_usermap_lon', 10.0)),
			array('config.add', array('mot_usermap_zoom', 5)),

			// Add a parent module (ACP_USERMAP) to the Extensions tab (ACP_CAT_DOT_MODS)
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_USERMAP'
			)),

			// Add our main_module to the parent module (ACP_USERMAP)
			array('module.add', array(
				'acp',
				'ACP_USERMAP',
				array(
					'module_basename'		=> '\mot\usermap\acp\main_module',
					'modes'					=> array('settings'),
				),
			)),
		);
	}

	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'usermap_users'	=> array(
					'COLUMNS'	=> array(
						'user_id'			=> array('UINT:10', 0),
						'username'			=> array('VCHAR:255', ''),
						'user_colour'		=> array('VCHAR:6', ''),
						'user_lat'			=> array('VCHAR:20', ''),
						'user_lng'			=> array('VCHAR:20', ''),
						'user_land'			=> array('VCHAR:2', ''),
						'user_plz'			=> array('VCHAR:8', ''),
						'user_location'		=> array('VCHAR:255', ''),
						'user_change_plz'	=> array('UINT:11', 0),
						'user_change_coord'	=> array('UINT:11', 0),
					),
					'PRIMARY_KEY'	=> 'user_id',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'usermap_users',
			),
		);
	}

}
