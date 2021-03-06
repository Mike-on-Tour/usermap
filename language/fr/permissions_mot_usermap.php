<?php
/**
*
* @package Usermap v0.10.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	// Admin permissions
	'ACL_A_MANAGE_USERMAP'		=> 'Vous pouvez administrer la carte des membres',
	// Moderator permissions
	'ACL_M_RELEASE_POI'			=> 'Vous pouvez activer des POIs',
	// User permissions
	'ACL_U_VIEW_MAP_ALWAYS'		=> 'Vous pouvez toujours voir la carte des membres',
	'ACL_U_VIEW_MAP_INSCRIBED'	=> 'Vous ne pouvez voir la carte des membres que si vous êtes inscrit',
	'ACL_U_VIEW_POI'			=> 'Vous pouvez voir les POIs',
	'ACL_U_ADD_POI'				=> 'Vous pouvez créer des POIs sans activation',
	'ACL_U_ADD_POI_WITH_MOD'	=> 'Vous pouvez créer des POIs avec activation',
));
