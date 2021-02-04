<?php

/**
*
* @package Usermap v0.10.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class main_info
{
	public function module()
	{
		return array(
			'filename'	=> '\mot\usermap\acp\main_module',
			'title'		=> 'ACP_USERMAP',
			'modes'		=> array(
				'settings'	=> array(
					'title'	=> 'ACP_USERMAP_SETTINGS',
					'auth'	=> 'ext_mot/usermap && acl_a_manage_usermap',
					'cat'	=> array('ACP_USERMAP'),
				),
			),
		);
	}
}
