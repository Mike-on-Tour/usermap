<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\includes;

class functions_usermap
{

	public function __construct()
	{

	}


	/**
	 * Generate back link for main controller
	 * @param	$u_action
	 *		$language	language variable
	 *
	 * @return	string
	 */
	public function usermap_back_link($u_action, $lang_str)
	{
		return '<br /><br /><a href="' . $u_action . '">&laquo; ' . $lang_str . '</a>';
	}

	/*
	* Searches a given directory for all files (no subdirectories)
	*
	* @params	string	$dir contaioning the path to the directory to search in_array
	*
	* @return	array		the names of all files found as array of strings
	*/
	public function get_icons($dir)
	{
		$return = array();
		$path = scandir($dir);

		foreach ($path as $element)
		{
			if (is_file ($dir.'/'.$element))
			{
				$return[] = $element;
			}
		}

		return $return;
	}

}
