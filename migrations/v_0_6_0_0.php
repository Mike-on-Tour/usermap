<?php
/**
*
* @package Usermap v1.1.1
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_6_0_0 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_5_0 to be installed
	*/
	public static function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_5_0');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('mot_usermap_google_enable', 0)),
			array('config.add', array('mot_usermap_google_apikey', '')),
			array('config.add', array('mot_usermap_google_countries', '')),
			array('config.add', array('mot_usermap_database_enable', 0)),
			//  Create an array with the countrynames, JSON encode and insert it into the config_text table
			array('custom', array(array($this, 'create_countrynames'))),
		);
	}

	public function revert_data()
	{
		return array(
			array('custom', array(array($this, 'delete_countrynames'))),
		);
	}

	public function create_countrynames()
	{
		global $phpbb_root_path;
		$lang_dir = $phpbb_root_path . 'ext/mot/usermap/language/';

		/*
		* Get the country name from the 'en' file, store it in an array, convert array into JSON and save it in config_text variable
		* We use the file from the English language pack since it MUST exist as this is the standard (and fallback) language
		*/
		$country_names = $matches = array();
		$country_names[] = '';
		$handle = fopen($lang_dir . 'en/countrycode/countrycode.txt', "rb");
		while (!feof($handle))
		{
			$line = fgets($handle);
			if ($line != '')
			{
				$matches = preg_split('[-]', $line);
				$matches = preg_split('[\\n]', $matches[1]);
				$country_names[] = ($matches[0] != 'Select your country') ? $matches[0] : '';
			}
		}
		fclose($handle);

		$sql = "INSERT INTO " . CONFIG_TEXT_TABLE . " (config_name, config_value) VALUES ('mot_usermap_countrynames', '" . json_encode($country_names) . "')";
		$this->db->sql_query($sql);
	}

	public function delete_countrynames()
	{
		$sql = "DELETE FROM " . CONFIG_TEXT_TABLE . " WHERE config_name = 'mot_usermap_countrynames'";
		$this->db->sql_query($sql);
	}

}
