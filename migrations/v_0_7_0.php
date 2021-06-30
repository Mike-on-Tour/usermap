<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_7_0 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_6_0_1 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_6_0_1');
	}

	public function update_data()
	{
		return array(
			// Add the config variables we want to be able to set
			array('config.add', array('mot_usermap_poi_enable', 0)),
			array('config.add', array('mot_usermap_poi_showtoall', 0)),

			// Add the config text variable we want to be able to set
			array('config_text.add', array('mot_usermap_poi_legend', '')),

			// Add the poi_module to the parent module (ACP_USERMAP)
			array('module.add', array(
				'acp',
				'ACP_USERMAP',
				array(
					'module_basename'		=> '\mot\usermap\acp\poi_module',
					'modes'					=> array('poi'),
				),
			)),
		);
	}

	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'usermap_poi'	=> array(
					'COLUMNS'	=> array(
						'poi_id'		=> array('UINT', null, 'auto_increment'),
						'name'			=> array('VCHAR:50', ''),
						'popup'			=> array('VCHAR:1000', ''),
						'icon'			=> array('VCHAR:40', ''),
						'lat'			=> array('VCHAR:20', ''),
						'lng'			=> array('VCHAR:20', ''),
					),
					'PRIMARY_KEY'	=> 'poi_id',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'usermap_poi',
			),
		);
	}

}
