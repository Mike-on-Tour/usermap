<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_6_0_1 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_6_0_0 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_6_0_0');
	}

	public function update_data()
	{
		return array(

			// Add the database_module to the parent module (ACP_USERMAP)
			array('module.add', array(
				'acp',
				'ACP_USERMAP',
				array(
					'module_basename'		=> '\mot\usermap\acp\database_module',
					'modes'					=> array('database'),
				),
			)),
		);
	}

	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'usermap_zipcodes'	=> array(
					'COLUMNS'	=> array(
						'country_code'	=> array('VCHAR:2', ''),
						'zip_code'		=> array('VCHAR:10', ''),
						'lat'			=> array('VCHAR:20', ''),
						'lng'			=> array('VCHAR:20', ''),
					),
					'KEYS'		=> array(
						'country_zip'	=> array('UNIQUE', array('country_code', 'zip_code')),
					),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'usermap_zipcodes',
			),
		);
	}

}
