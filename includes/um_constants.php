<?php
/**
*
* @package Usermap v0.7.x
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

global $table_prefix;

define('USERMAP_USERS_TABLE',			$table_prefix . 'usermap_users');
define('USERMAP_ZIPCODE_TABLE',			$table_prefix . 'usermap_zipcodes');
define('USERMAP_POI_TABLE',				$table_prefix . 'usermap_poi');
