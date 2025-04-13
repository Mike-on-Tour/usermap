<?php
/**
*
* @package Usermap v1.3.0
* @copyright (c) 2020 - 2025 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\controller;

class ajax_call
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\language\language $language */
	protected $language;

	/** @var \phpbb\request\request_interface */
	protected $request;

	public function __construct(\phpbb\config\config $config, \phpbb\language\language $language, \phpbb\request\request_interface $request)
	{
		$this->config = $config;
		$this->language = $language;
		$this->request = $request;
	}

	public function main()
	{
		if ($this->request->is_ajax())
		{
			$address = $this->request->variable('address', '', true);
			$json_request = "https://maps.googleapis.com/maps/api/geocode/json?key=" . $this->config['mot_usermap_google_apikey'] . "&address=" . urlencode($address) . "&language=" . $this->language->lang('USERMAP_COUNTRY_CODE');
			$json = file_get_contents($json_request);

			$xml = ($json != '' || !empty($json)) ? json_decode($json, true) : ['status' => 'notOK',];

			if ($xml['status'] == 'OK')
			{
				$result = [
					'success'	=> true,
					'items'		=> [],
				];
				foreach ($xml['results'] as $row)
				{
					$result['items'][] = [
						'name'	=> $row['formatted_address'],
						'lat'	=> $row['geometry']['location']['lat'],
						'lng'	=> $row['geometry']['location']['lng'],
					];
				}
			}
			else
			{
				$result = ['success' => false,];
			}

			return new \Symfony\Component\HttpFoundation\JsonResponse($result);
		}
	}
}
