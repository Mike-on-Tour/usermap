<?php

/**
*
* @package Usermap v0.5.x
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\acp;

class lang_info
{
	public function module()
	{
		return array(
			'filename'	=> '\mot\usermap\acp\lang_module',
			'title'		=> 'ACP_USERMAP',
			'modes'		=> array(
				'lang'		=> array(
					'title'	=> 'ACP_USERMAP_LANGS',
					'auth'	=> 'ext_mot/usermap && acl_a_board',
					'cat'	=> array('ACP_USERMAP'),
				),
			),
		);
	}
}
