<?php

/**
*
* @package Usermap v1.0.2
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class layer_info
{
	public function module()
	{
		return array(
			'filename'	=> '\mot\usermap\acp\layer_module',
			'title'		=> 'ACP_USERMAP',
			'modes'		=> array(
				'poi'		=> array(
					'title'	=> 'ACP_USERMAP_LAYER',
					'auth'	=> 'ext_mot/usermap && acl_a_manage_usermap',
					'cat'	=> array('ACP_USERMAP'),
				),
			),
		);
	}
}
