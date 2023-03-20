<?php
/**
*
* @package Usermap v1.2.0
* @copyright (c) 2020 - 2022 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class mot_usermap_info
{
	public function module()
	{
		return [
			'filename'	=> '\mot\usermap\acp\main_module',
			'title'		=> 'ACP_USERMAP',
			'modes'		=> [
				'settings'			=> [
					'title'	=> 'ACP_USERMAP_SETTINGS',
					'auth'	=> 'ext_mot/usermap && acl_a_manage_usermap',
					'cat'	=> ['ACP_USERMAP'],
				],
				'langs'			=> [
					'title'	=> 'ACP_USERMAP_LANGS',
					'auth'	=> 'ext_mot/usermap && acl_a_manage_usermap',
					'cat'	=> ['ACP_USERMAP'],
				],
				'database'	=> [
					'title'	=> 'ACP_USERMAP_DATABASE',
					'auth'	=> 'ext_mot/usermap && acl_a_manage_usermap',
					'cat'	=> ['ACP_USERMAP'],
				],
				'poi'		=> [
					'title'	=> 'ACP_USERMAP_POI',
					'auth'	=> 'ext_mot/usermap && acl_a_manage_usermap',
					'cat'	=> ['ACP_USERMAP'],
				],
				'layer'		=> [
					'title'	=> 'ACP_USERMAP_LAYER',
					'auth'	=> 'ext_mot/usermap && acl_a_manage_usermap',
					'cat'	=> ['ACP_USERMAP'],
				],
				'route'		=> [
					'title'	=> 'ACP_USERMAP_ROUTE',
					'auth'	=> 'ext_mot/usermap && acl_a_manage_usermap',
					'cat'	=> ['ACP_USERMAP'],
				],
			],
		];
	}
}
