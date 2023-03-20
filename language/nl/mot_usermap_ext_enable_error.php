<?php
/**
*
* @package Usermap v1.2.0
* @copyright (c) 2020 - 2022 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'MOT_USERMAP_NAME'							=> 'Gebruikerskaart',
	'MOT_USERMAP_ERROR_EXTENSION_NOT_ENABLE'	=> 'The extension „%1$s“ kan niet ingeschakeld worden. Gelieve na te gaan of aan de nodige vereisten voor deze extensie voldaan is.',
	'MOT_USERMAP_ERROR_MESSAGE_PHPBB_VERSION'	=> 'Minimum vereiste phpBB versie is „%1$s“ maar lager dan „%2$s“',
	'MOT_USERMAP_PHP_VERSION_ERROR'				=> 'Minimum PHP versie is „%1$s“',
]);
