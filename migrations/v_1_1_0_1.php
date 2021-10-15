<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_1_1_0_1 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_1_1_0_0 to be installed
	*/
	public static function depends_on()
	{
		return ['\mot\usermap\migrations\v_1_1_0_0'];
	}

	public function update_data()
	{
		return [
			// Add the layer_module to the parent module (ACP_USERMAP)
			['module.add', [
				'acp',
				'ACP_USERMAP',
				[
					'module_basename'	=> '\mot\usermap\acp\layer_module',
					'module_langname'	=> 'ACP_USERMAP_LAYER',
					'module_mode'		=> 'layer',
					'module_auth'		=> 'ext_mot/usermap && acl_a_manage_usermap',
				],
			]],
			// Execute a custom function to prefill the layer_table
			['custom', [[$this, 'prefill_layer_table']]],
		];
	}

	public function prefill_layer_table()
	{
		if (!defined('USERMAP_LAYER_TABLE'))
		{
			define("USERMAP_LAYER_TABLE",	$this->table_prefix . 'usermap_layers');
			define('USERMAP_USERS_TABLE',	$this->table_prefix . 'usermap_users');
		}
		if (!defined('USERMAP_POI_TABLE'))
		{
			define('USERMAP_POI_TABLE',		$this->table_prefix . 'usermap_poi');
		}

		$member_layer_lang = [
			'de'		=> 'Mitglieder',
			'de_x_sie'	=> 'Mitglieder',
			'en'		=> 'Users',
			'es'		=> 'Usuarios',
			'fr'		=> 'Membres',
			'pl'		=> 'Użytkownicy',
		];
		$poi_layer_lang = [
			'de'		=> 'POIs',
			'de_x_sie'	=> 'POIs',
			'en'		=> 'POIs',
			'es'		=> 'Puntos de Interés',
			'fr'		=> 'POIs',
			'pl'		=> 'POIs',
		];

		$sql_arr = [
			[
				'layer_name'		=> 'Mitglieder',
				'member_layer'		=> true,
				'layer_active'		=> true,
				'show_layer'		=> true,
				'layer_lang_var'	=> json_encode($member_layer_lang),
				'default_icon'		=> '',
			],
			[
				'layer_name'		=> 'POIs',
				'member_layer'		=> false,
				'layer_active'		=> true,
				'show_layer'		=> false,
				'layer_lang_var'	=> json_encode($poi_layer_lang),
				'default_icon'		=> 'motTriangleBlue.svg',
			],
		];

		// Add pre-defined layers to all users in the USERMAP_LAYER_TABLE
		$this->db->sql_multi_insert(USERMAP_LAYER_TABLE ,$sql_arr);

		// Set pre-defined member layer for all users in USERMAP_USERS_TABLE
		$sql_arr = [
			'layer_id'	=> 1,
		];
		$sql = 'UPDATE ' . USERMAP_USERS_TABLE . '
				SET ' . $this->db->sql_build_array('UPDATE', $sql_arr);
		$this->db->sql_query($sql);

		// Set pre-defined POI layer to all POIs in the USERMAP_POI_TABLE
		$sql_arr = [
			'layer_id'	=> 2,
		];
		$sql = 'UPDATE ' . USERMAP_POI_TABLE . '
				SET ' . $this->db->sql_build_array('UPDATE', $sql_arr);
		$this->db->sql_query($sql);
	}
}
