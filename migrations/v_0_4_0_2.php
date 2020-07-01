<?php
/**
*
* @package Usermap v0.4.x
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\migrations;

class v_0_4_0_2 extends \phpbb\db\migration\migration
{

	/**
	* Check for migration v_0_4_0_1 to be installed
	*/
	static public function depends_on()
	{
		return array('\mot\usermap\migrations\v_0_4_0_1');
	}

	public function update_data()
	{
		return array(
			//  Create an array with the two letter countrycodes, JSON encode and inset it into the config_text table
			array('custom', array(array($this, 'create_countrycodes'))),
			//  Insert an emptyJSON-encoded array into the config_text table
			array('custom', array(array($this, 'create_doubles'))),
		);
	}

	public function create_countrycodes()
	{
		global $phpbb_root_path, $phpEx;
		$lang_dir = $phpbb_root_path . 'ext/mot/usermap/language/';

		/*
		* Get the two letter country code from the 'en' file, store it in an array, convert array into JSON and save it in config_text variable
		* We use the file from the English language pack since it MUST exist as this is the standard (and fallback) language
		*/
		$country_codes = $matches = array();
		$country_codes[] = '';
		$handle = fopen($lang_dir . 'en/countrycode.' . $phpEx, "rb");
		while (!feof($handle))
		{
			$line = fgets($handle);
			if ($line != '')
			{
				$matches = preg_split('[-]', $line);
				$country_codes[] = ($matches[0] != 'xx') ? $matches[0] : '';
			}
		}
		fclose($handle);

		$sql = "UPDATE " . CONFIG_TEXT_TABLE . " SET config_value = '" . json_encode($country_codes) . "' WHERE config_name = 'mot_usermap_countrycodes'";
		$this->db->sql_query($sql);
	}

	public function create_doubles()
	{
		$doubles = array();
		$sql = "UPDATE " . CONFIG_TEXT_TABLE . " SET config_value = '" . json_encode($doubles) . "' WHERE config_name = 'mot_usermap_doublesarray'";
		$this->db->sql_query($sql);
	}
}
