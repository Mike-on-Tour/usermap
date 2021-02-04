<?php

/**
*
* @package Usermap v0.10.1
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class database_info
{
	public function module()
	{
		return array(
			'filename'	=> '\mot\usermap\acp\database_module',
			'title'		=> 'ACP_USERMAP',
			'modes'		=> array(
				'database'		=> array(
					'title'	=> 'ACP_USERMAP_DATABASE',
					'auth'	=> 'ext_mot/usermap && acl_a_manage_usermap',
					'cat'	=> array('ACP_USERMAP'),
				),
			),
		);
	}
}
