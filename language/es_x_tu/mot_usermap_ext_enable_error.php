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
	'MOT_USERMAP_NAME'							=> 'Mapa del Usuario',
	'MOT_USERMAP_ERROR_EXTENSION_NOT_ENABLE'	=> 'La extensión „%1$s“ no se puede habilitar. Comprueba si se cumplen los requisitos necesarios para esta extensión.',
	'MOT_USERMAP_ERROR_MESSAGE_PHPBB_VERSION'	=> 'La versión mínima de phpBB requerida es „%1$s“ pero inferior a „%2$s“',
	'MOT_USERMAP_PHP_VERSION_ERROR'				=> 'La versión mínima de PHP es „%1$s“',
]);
