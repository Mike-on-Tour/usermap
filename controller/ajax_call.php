<?php
/**
*
* @package Usermap v1.1.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\controller;

class ajax_call
{

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\request\request_interface */
	protected $request;

	public function __construct(\phpbb\config\config $config, \phpbb\request\request_interface $request)
	{
		$this->config = $config;
		$this->request = $request;
	}

	public function main()
	{
		$address = $this->request->variable('address', '', true);
		$json_request = "https://maps.googleapis.com/maps/api/geocode/json?key=" . $this->config['mot_usermap_google_apikey'] . "&address=" . urlencode($address);
		$json = file_get_contents($json_request);
		$xml = $json != '' ? json_decode($json, true) : ['status' => 'notOK',];
		if ($xml['status'] == 'OK')
		{
			$result = [
				'success'	=> true,
				'lat'		=> $xml['results']['0']['geometry']['location']['lat'],
				'lng'		=> $xml['results']['0']['geometry']['location']['lng'],
			];
		}
		else
		{
			$result = ['success' => false,];
		}
		return new \Symfony\Component\HttpFoundation\JsonResponse($result);
	}
}
