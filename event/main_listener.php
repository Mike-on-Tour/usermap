<?php
/**
*
* @package Usermap v1.2.6
* @copyright (c) 2020 - 2024 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface
{

	public static function getSubscribedEvents()
	{
		return array(
			'core.user_setup'						=> 'load_language_on_setup',
			'core.page_header'						=> 'add_page_header_link',
			'core.user_active_flip_after'			=> 'user_active_flip_after',			// Perform additional actions after the users have been activated/deactivated
			'core.delete_user_after'				=> 'delete_user_after',					// Event after a user is deleted
			'core.ucp_profile_info_modify_sql_ary'	=> 'ucp_profile_info_modify_sql_ary',	// Modify profile data in UCP before submitting to the database
			'core.acp_users_profile_modify_sql_ary'	=> 'acp_modify_users_profile',			// Modify profile data in ACP before submitting to the database
			'core.ucp_register_register_after'		=> 'ucp_register_register_after',		// Event after registration, used to process user data for the Usermap if no activation after registration is needed
			'core.memberlist_view_profile'			=> 'memberlist_view_profile',			// Event to insert a link to the usermap into a member's profile
			'core.permissions'						=> 'load_permissions',
		);
	}

	const RADIUS = 0.002;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\log\log $log */
	protected $log;

	/* @var \phpbb\extension\manager */
	protected $phpbb_extension_manager;

	/** @var \phpbb\language\language $language Language object */
	protected $language;

	/** @var string PHP extension */
	protected $php_ext;

	/** @var string phpBB phpbb root path */
	protected $root_path;

	/** @var string mot.usermap.tables.usermap_users */
	protected $mot_usermap_users_table;

	/** @var string mot.usermap.tables.usermap_poi */
	protected $mot_usermap_zipcode_table;

	/**
	 * Constructor
	 *
	 * @param \phpbb\controller\helper $helper   Controller helper object
	 * @param \phpbb\template\template $template Template object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\controller\helper $helper,
								\phpbb\template\template $template, \phpbb\db\driver\driver_interface $db, \phpbb\user $user,
								\phpbb\log\log $log, \phpbb\extension\manager $phpbb_extension_manager, \phpbb\language\language $language, $php_ext,
								$root_path, $mot_usermap_users_table, $mot_usermap_zipcode_table)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->helper = $helper;
		$this->template = $template;
		$this->db = $db;
		$this->user = $user;
		$this->log = $log;
		$this->phpbb_extension_manager = $phpbb_extension_manager;
		$this->language = $language;
		$this->php_ext = $php_ext;
		$this->root_path = $root_path;
		$this->usermap_users_table = $mot_usermap_users_table;
		$this->usermap_zipcode_table = $mot_usermap_zipcode_table;

		$this->doubles_ary = array();
		$this->u_action = '';
	}

	/**
	 * Load language files
	 *
	 * @param \phpbb\event\data $event
	 */
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'mot/usermap',
			'lang_set' => 'mot_usermap',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * Add a page header nav bar link
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function add_page_header_link()
	{
		$this->template->assign_vars(array(
			'U_USERMAP' 			=> $this->helper->route('mot_usermap_route', []),
			'U_VIEW_MAP_ALWAYS'		=> $this->auth->acl_get('u_view_map_always'),
			'U_VIEW_MAP_INSCRIBED'	=> $this->auth->acl_get('u_view_map_inscribed'),
			'U_VIEW_POI'			=> $this->auth->acl_get('u_view_poi'),
		));
	}

	/*
	* Called after a user has finished registration. Three possible scenarios:
	* 1. w/o activation: Data for the Usermap must be obtained here
	* 2. and 3.: Activation by eMail confirmation or by an administrator: Data for the Usermap will be processed within the function 'user_active_flip_after'
	* -> selection for registration w/o later activation must be done here!
	*
	* @param:	cp_data, data, message, server_url, user_actkey, user_id, user_row
	*/
	function ucp_register_register_after($event)
	{
		$gn_username = explode(",", $this->config['mot_usermap_geonamesuser']);	// get Geonames user(s) from config and make it an array
		$this->country_codes = (array) json_decode($this->config_text->get('mot_usermap_countrycodes'), false);
		$this->cc_size = count($this->country_codes);
		$cp_data = $event['cp_data'];
		$cp_data['user_id'] = $event['user_id'];
		$user_row = $event['user_row'];
		if ($user_row['user_actkey'] == '' && $user_row['user_inactive_reason'] == 0 && $user_row['user_inactive_time'] == 0)	// conditions if user registration w/o activation
		{
			$j = 0;		// start with first geonames user
			// set the error message for missing geonames users
			$message = $this->language->lang('MOT_UCP_GEONAMES_ERROR') . '<br><br>' . sprintf($this->language->lang('RETURN_UCP'), '<a href="' . $this->u_action . '">', '</a>');
			if ($gn_username[0] == '')
			{
				trigger_error($message, E_USER_WARNING);
			}

			// check if location was provided during registration
			if (!array_key_exists('pf_phpbb_location', $cp_data))
			{
				$cp_data['pf_phpbb_location'] = '';	// if not set it to empty string
			}

			if ($cp_data['pf_mot_zip'] != '' and $cp_data['pf_mot_land'] > 1 and $cp_data['pf_mot_land'] < $this->cc_size)	// check whether the profile fields data is correctly set
			{
				$this->add_user($cp_data, $j);
			}
		}
	}

	/**
	* Called after a user got activated/deactivated; check for country and zip code profile fields to add them to usermap_users table and doubles array
	*
	* @params:	activated, deactivated, mode, reason, sql_statements, user_id_ary
	*/
	public function user_active_flip_after($event)
	{
		$this->country_codes = (array) json_decode($this->config_text->get('mot_usermap_countrycodes'), false);
		$this->cc_size = count($this->country_codes);
		$gn_username = explode(",", $this->config['mot_usermap_geonamesuser']);	// get Geonames user(s) from config and make it an array
		$user_id_ary = $event['user_id_ary'];
		// check if user(s) got activated
		if ($event['activated'] > 0)
		{
			$j = 0;		// start with first geonames user
			// set the error message for missing geonmaes user according to activation mode
			if ($event['mode'] == 'activate')	// activation by email
			{
				$message = $this->language->lang('MOT_UCP_GEONAMES_ERROR') . '<br><br>' . sprintf($this->language->lang('RETURN_UCP'), '<a href="' . $this->u_action . '">', '</a>');
			}
			if ($event['mode'] == 'flip')	// activation by administrator
			{
				$message = $this->language->lang('ACP_USERMAP_PROFILE_ERROR') . adm_back_link($this->u_action);
			}
			if ($gn_username[0] == '')
			{
				trigger_error($message, E_USER_WARNING);
			}
			// check if user(s) filled in the profile fields land, plz and location
			foreach ($user_id_ary as $value)
			{
				$sql = 'SELECT user_id, pf_phpbb_location, pf_mot_zip, pf_mot_land FROM ' . PROFILE_FIELDS_DATA_TABLE . '
						WHERE user_id = ' . (int) $value;
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);
				if ($row['pf_mot_zip'] != '' and $row['pf_mot_land'] > 1 and $row['pf_mot_land'] < $this->cc_size)	// check whether the profile fields data is correctly set
				{
					$this->add_user($row, $j);
				}
			}
		}

		// check if user(s) got deactivated
		if ($event['deactivated'] > 0)
		{
			$cc = $zc = '';
			// if user(s) got deactivated we need to delete them from usermap_users table and from the doubles array
			$this->doubles_ary = json_decode($this->config_text->get('mot_usermap_doublesarray'), true);
			foreach ($user_id_ary as &$value)
			{
				if ($this->check_user_id ($this->doubles_ary, $value, $cc, $zc))	// prevent php warnings and errors
				{
					$this->delete_user($value);
				}
			}
		}
	}

	/**
	* Delete a user from usermap_users table after he was deleted from the users table
	*
	* @params:	mode, retain_username, user_ids, user_rows
	*/
	public function delete_user_after($event)
	{
		$cc = $zc = '';
		$this->doubles_ary = json_decode($this->config_text->get('mot_usermap_doublesarray'), true);
		// get the user_id's stored in an indexed array
		$user_id_ary = $event['user_ids'];
		// if user(s) got deleted we need to delete them from table _usermap_users and from the $doubles array
		foreach ($user_id_ary as &$value)
		{
			if ($this->check_user_id ($this->doubles_ary, $value, $cc, $zc))	// prevent php warnings and errors
			{
				$this->delete_user($value);
			}
		}
	}

	/**
	* Update data in usermap_users table and doubles array after user edited data in the UCP profile fields
	* cp_data is not yet submitted to the database, thus we can check against the database whether country, zip code or location have been edited
	*
	* @params:	cp_data, data, sql_ary
	*		'cp_data' holds the custom profile fields as associative array
	*			Array ( [pf_phpbb_location] => value ... pf_mot_zip] => value [pf_mot_land] => value ... )
	*		'data': Array ( [jabber] =>  [bday_year] => y [bday_month] => m [bday_day] => d [user_birthday] => dd-mm-yy [notify] => 0/1 )
	*		'sql_ary': Array ( [user_jabber] =>  [user_notify_type] => 0 [user_birthday] => d-m-y )
	*
	* The user is identified by $this->user
	*/
	public function ucp_profile_info_modify_sql_ary($event)
	{
		$message = $this->language->lang('MOT_UCP_GEONAMES_ERROR') . '<br><br>' . sprintf($this->language->lang('RETURN_UCP'), '<a href="' . $this->u_action . '">', '</a>');
		$this->process_user_profile_data($this->user->data['user_id'], $event['cp_data'], $message, E_USER_WARNING);
	}


	/**
	* Update data in usermap_users table and doubles array after admin edited user profile data in the ACP (only called from 'Profile' tab when 'Submit' button is hit)
	* cp_data is not yet submitted to the database, thus we can check against the database whether country, zip code or location have been edited
	*
	* @params:	cp_data, data, sql_ary, user_id, user_row
	*		'cp_data' holds the custom profile fields as associative array (for details see function above)
	*		'data': Array ( [jabber] =>  [bday_year] => y [bday_month] => m [bday_day] => d [user_birthday] => dd-mm-yy)
	*		'sql_ary': Array ( [user_jabber] =>  [user_birthday] => d-m-y )
	*		'user_id': user_id of the user whose profile is currently edited
	*		'user_row': Array with user data from users table plus session data
	*
	*/
	public function acp_modify_users_profile($event)
	{
		// to prevent errors during activation if the admin edited the user profile prior to activation (e.g. to correct or delete the content of a CPF) we check here if the user in question is a new (and so far not activated) user;
		// errors to occur during activation are e.g. sql errors due to inserting an already existing user into the usermap_users table
		if ($event['user_row']['user_type'] != USER_INACTIVE)
		{
			$message = $this->language->lang('ACP_USERMAP_PROFILE_ERROR') . adm_back_link($this->u_action);
			$this->process_user_profile_data($event['user_id'], $event['cp_data'], $message, E_USER_WARNING);
		}
	}


	/**
	* Create a link to the usermap if member is listed on the usermap
	*/
	public function memberlist_view_profile($event)
	{
		$member = $event['member'];
		$show_link = false;
		$sql = 'SELECT * FROM ' . $this->usermap_users_table . '
				WHERE user_id = ' . (int) $member['user_id'];
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		if (!empty($row))	// Okay, this user is on the map so we can show him
		{
			$this->template->assign_vars([
				'U_USERMAP_SHOW_MEMBER'	=> $this->helper->route('mot_usermap_route', ['action' => 'member', 'lat' => $row['user_lat'], 'lng' => $row['user_lng'],]),
			]);
			// And now we check whether the requesting user is on the map and allow or deny him to see this link
			$sql = 'SELECT * FROM ' . $this->usermap_users_table . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);
			$show_link = !empty($row);
		}
		$this->template->assign_vars([
			'USERMAP_SHOW_LINK'	=> $show_link,
		]);
	}


	/**
	* Load permissions
	*/
	public function load_permissions($event)
	{
		$permissions_cat = $event['categories'];
		$permissions_cat['usermap'] = 'ACP_USERMAP';
		$event['categories'] = $permissions_cat;

		$permissions = $event['permissions'];
		$permissions['a_manage_usermap'] = array('lang' => 'ACL_A_MANAGE_USERMAP', 'cat' => 'misc');
		$permissions['m_release_poi'] = array('lang' => 'ACL_M_RELEASE_POI', 'cat' => 'misc');
		$permissions['u_view_map_always'] = array('lang' => 'ACL_U_VIEW_MAP_ALWAYS', 'cat' => 'usermap');
		$permissions['u_view_map_inscribed'] = array('lang' => 'ACL_U_VIEW_MAP_INSCRIBED', 'cat' => 'usermap');
		$permissions['u_view_poi'] = array('lang' => 'ACL_U_VIEW_POI', 'cat' => 'usermap');
		$permissions['u_add_poi'] = array('lang' => 'ACL_U_ADD_POI', 'cat' => 'usermap');
		$permissions['u_add_poi_with_mod'] = array('lang' => 'ACL_U_ADD_POI_WITH_MOD', 'cat' => 'usermap');
		$event['permissions'] = $permissions;
	}

/*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

	/**
	* Function to process the data from a changed user profile. Since this task has to be done from the UCP (the user changed it)
	* as well as from the ACP (the admin changed it) and this are two different events, this task was put in a function to be called from both
	*
	* @params:	user_id: id of the user whose data has to be processed
	*		cp_data: array with the profile_fields_data prior to its submision to the database
	*
	* @return:	none
	*/
	function process_user_profile_data($user_id, $cp_data, $error_msg, $error_type)
	{
		$this->country_codes = (array) json_decode($this->config_text->get('mot_usermap_countrycodes'), false);
		$this->cc_size = count($this->country_codes);
		$gn_username = explode(",", $this->config['mot_usermap_geonamesuser']);	// get Geonames user(s) from config and make it an array
		if ($gn_username[0] == '')
		{
			trigger_error($error_msg, $error_type);
		}
		$cc = $zc = '';
		$j = 0;	// start with first entry in the geonames user array

		$this->doubles_ary = json_decode($this->config_text->get('mot_usermap_doublesarray'), true);
		/* First we check whether this user is already in the doubles array (and thus in the usermap_users table as well) , if yes we use brute force and delete this user from both
		*   and afterwards generate a new entry if we get a valid response from geonames.org (then we certainly don't have any corpse in both in case we don't get a valid coordinate)
		*/
		if ($this->check_user_id ($this->doubles_ary, $user_id, $cc, $zc))
		{
			// user exists, delete from usermap_users table and doubles array
			$this->delete_user($user_id);
		}
		// user has been deleted from usermap_users table and doubles array, now we can check the new values (country, zip code, location) with geonames database
		// (and even if user wasn't listed in the usermap_users table and doubles array we have to assume the correct data was entered and must be processed here)

		$cp_data['user_id'] = $user_id;

		// and now we can do the necessary checks
		if ($cp_data['pf_mot_zip'] != '' and $cp_data['pf_mot_land'] > 1 and $cp_data['pf_mot_land'] < $this->cc_size)	// check whether the profile fields data is correctly set
		{
			$this->add_user($cp_data, $j);
		}
	}

	/**
	* Add a user to the doubles array and to the usermap_users table
	*
	* @param:	userrow: array with data from the profile_fields_data tables
	*		j: integer value which points to a user in the geonames users array, given as reference so in a later version we can use it for error handling (if necessary)
	*
	* @return: none
	*/
	function add_user($userrow, &$j)
	{
		$lat = $lng = 0.0;
		$radius = self::RADIUS;
		$google_key = $this->config['mot_usermap_google_apikey'];
		$this->country_codes = (array) json_decode($this->config_text->get('mot_usermap_countrycodes'), false);
		$this->country_names = (array) json_decode($this->config_text->get('mot_usermap_countrynames'), false);
		$country_code = $this->country_codes[$userrow['pf_mot_land']];
		$country_name = $this->country_names[$userrow['pf_mot_land']];
		$google_enable = $this->config['mot_usermap_google_enable'];
		$google_cc = explode(",", $this->config['mot_usermap_google_countries']);
		$db_enable = $this->config['mot_usermap_database_enable'];
		$gn_gotit = $google_gotit = $db_gotit = false;
		// okay, for this user id we have a valid set of pf_phpbb_location, pf_mot_zip and pf_mot_land -> proceed with request
		// first we check whether the country code is in the forced google search array and whether we have google enabled and an API key; if all is positive we skip the geonames request, otherwise we start with geonames
		if (!(in_array($country_code, $google_cc) && $google_enable && $google_key != ''))
		{
			$gn_gotit = $this->gn_search($j, $userrow['pf_mot_zip'], $country_code, $userrow['pf_phpbb_location'], $lat, $lng);
		}
		// if geonames haven't got us a solution and google search is enabled and we have an API key we start the google search (this is also the case if geonames search was skipped due to enforced google search)
		if (!$gn_gotit && $google_enable && $google_key != '')
		{
			$google_gotit = $this->google_search($userrow['pf_mot_zip'], $country_name, $userrow['pf_phpbb_location'], $lat, $lng, $radius);
		}
		// if searching the internal data base is enabled and neither geonames nor google provided a solution we look up the data base
		if ($db_enable && !$gn_gotit && !$google_gotit)
		{
			$db_gotit = $this->db_search($userrow['pf_mot_zip'], $country_code, $lat, $lng);
		}
		// if one of the up to three search requests above found a solution we proceed with those coordinates, insert this user into the doubles array, compute the exact coords and insert the data into the usermap users table
		if ($gn_gotit || $google_gotit || $db_gotit)
		{
			setlocale(LC_ALL, 'C');
			// get doubles array from config_text table, update it and save it back
			$doubles = json_decode($this->config_text->get('mot_usermap_doublesarray'), true);
			$factor = $this->build_doubles($doubles, $userrow['user_id'], $country_code, $userrow['pf_mot_zip']);
			$this->config_text->set('mot_usermap_doublesarray', json_encode($doubles));

			if ($factor > 0)
			{
				// calculate the offset angle, the number of the circle we are filling and - if appropriate - the additions to latitude and longitude to discriminate the new marker from any others with this zip code
				$angle = $factor * 30;
				$circle = (int) (($angle / 361) + 1);
				$lat = $lat + ($radius * $circle * cos(deg2rad($angle)));
				$lng = $lng + ($radius * $circle * sin(deg2rad($angle)));
			}

			// and now we can finally add this user to the usermap_users table
			$location = $this->db->sql_escape($userrow['pf_phpbb_location']);
			$sql_arr = array(
				'user_id'			=> $userrow['user_id'],
				'user_lat'			=> $lat,
				'user_lng'			=> $lng,
				'user_land'			=> $country_code,
				'user_plz'			=> $userrow['pf_mot_zip'],
				'user_location'		=> $location,
				'user_change_plz'	=> 0,
				'user_change_coord'	=> 0,
				'layer_id'			=> 1,
			);
			$sql = 'INSERT INTO ' . $this->usermap_users_table . ' ' . $this->db->sql_build_array('INSERT', $sql_arr);
			$this->db->sql_query($sql);
		}
	}

	/**
	* Delete a user from the doubles array and from the usermap_users table
	*
	* @param: user2delete: user_id of the user to be deleted
	*
	* @return: none
	*/
	function delete_user($user2delete)
	{
		// check if user_id is in usermap_users table and get country and zip code
		$sql_arr = array(
			'user_id'	=> $user2delete,
		);
		$query = 'SELECT * FROM ' . $this->usermap_users_table . '
				WHERE ' . $this->db->sql_build_array('SELECT', $sql_arr);
		$result = $this->db->sql_query($query);
		$row = $this->db->sql_fetchrow($result);	// $row['user_land'] and $row['user_plz'] hold the country code and respectively the zip code
		// remove this user_id from the doubles array (which holds all user_id's for a specific zipcode)
		$doubles = json_decode($this->config_text->get('mot_usermap_doublesarray'), true);
		$this->remove_doubles_value($doubles, $user2delete, $row['user_land'], $row['user_plz']);
		// save array again in config_text table
		$this->config_text->set('mot_usermap_doublesarray', json_encode($doubles));
		// and remove this user from usermap_users table
		$sql_in = array($user2delete);
		$query = 'DELETE FROM ' . $this->usermap_users_table . '
				WHERE ' . $this->db->sql_in_set('user_id', $sql_in);
		$this->db->sql_query($query);
	}

	/**
	* Check given location (city), zip code and country against the geonames data base and hopefully get back some coordinates to display on the map
	*
	* @params	j: an integer pointer into the gn_username array (as reference for a possible later error handling)
	*		postal_code: a string with the zip code
	*		country_code: a string with the an uppercase two letter denomination, e.g. DE for Germany
	*		city: a string with the location name
	*		gn_lat, gn_lng: a floating point value as reference, is set if return value is true
	*
	* @return  true if geonames.org gives a valid solution -> lat and lng are set, otherwise false, lat and lng do not contain a valid value
	*/
	function gn_search(&$j, $postal_code, $country, $city, &$gn_lat, &$gn_lng)
	{
		global $http_response_header;

		$gn_username = explode(",", $this->config['mot_usermap_geonamesuser']);	// get Geonames user(s) from config and make it an array
		if ($gn_username[$j] == '')
		{
			return false;
		}
		$city_name = '';
		// retrieve only letters from the city name
		$city = preg_replace('/[^A-Za-zaäöüßÄÖÜôáàâé]+/', '', $city);
		// call to geonames.org
		$json_request = "http://api.geonames.org/postalCodeSearchJSON?username=" . $gn_username[$j] . "&style=short&postalcode=" . $postal_code . "&country=" . $country;
		$json = @file_get_contents($json_request);
		if (!$json)
		{
			/*
			*	In case of an unauthorized user (status['value'] == 10) geonames throws a 401 error (and maybe in other cases, too?) so we have to do something if the request answer is FALSE.
			*	Response header looks like:
			*	Array ( [0] => HTTP/1.1 401 Unauthorized [1] => Date: Mon, 08 Jun 2020 11:54:27 GMT [2] => Server: Apache/2.4.6 (CentOS) mod_jk/1.2.41 OpenSSL/1.0.1e-fips PHP/5.4.16 [3] => Cache-Control: no-cache
			*	[4] => Access-Control-Allow-Origin: * [5] => Content-Length: 56 [6] => Connection: close [7] => Content-Type: application/json;charset=UTF-8 )
			*/
			$error_msg = $http_response_header[0];
			$msg = '';	// prevent errors at line 534 due to an undefined variable
			if ($error_msg == 'HTTP/1.1 401 Unauthorized')
			{
				$msg = $this->language->lang('USERMAP_GN_USER_ERROR');
			}
			trigger_error($error_msg . $msg, E_USER_WARNING);
		}
		$xml = json_decode($json, true);

		// geonames api returns either a 'status' array with an error code or a 'postal Codes' array with at least one valid solution or an empty array if no match was found
		// if there is a status we've gotten an error and must deal with it
		if (array_key_exists('status', $xml))
		{
			$xml_array = $xml['status'];
			switch ($xml_array['value'])
			{
				// This case doesn't work because in this case geonames throws a 401 error
				case 10:								// account not enabled or user does not exist
					$message = $xml_array['message'];
					trigger_error($message, E_USER_WARNING);
					break;

				// These cases do function because geonames gives back a status array
				case 18:								// daily limit of credits exceeded
				case 19:								// hourly limit of credits exceeded
				case 20:								// weekly limit of credits exceeded
					$j++;
					if ($j <= count($gn_username))	// try with another username for geonames.org if one is available?
					{
						$json_request = "http://api.geonames.org/postalCodeSearchJSON?username=".$gn_username[$j]."&style=short&postalcode=".$postal_code."&country=".$country;
						$json=file_get_contents($json_request);
						$xml = json_decode($json, true);
					}
					else								// another username is not available(, save variables for cron job or notify user (in a later version))
					{
						return false;	// for now we return with a false value to signal that something went wrong
					}
					break;

				default:
					$this->log->add('critical', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_GEONAMES_ERROR', false, array($json));
					return false;
					break;
			}
		}

		if (array_key_exists('postalCodes', $xml))
		{
			$xml_array = $xml['postalCodes'];
			$ary_size = count($xml_array);
			switch ($ary_size)
			{
				case 0:
					// no solution for this country/zip code combination -> we return false
					$return = false;
				break;

				case 1:
					// there is only one solution, so thats it -> set lat and lng and a return value of true
					$solution = $xml_array[0];
					$gn_lat = $solution['lat'];			// We do have a solution so we can return the latitude
					$gn_lng = $solution['lng'];			// and longitude
					$return = true;
				break;

				default:
					// there is more than one solution so we have to check the placeName of each of them against our given city name
					for ($i = 0; $i < $ary_size; $i++)
					{
						$solution = $xml_array[$i];
						$temp_city = preg_replace('/[^A-Za-zaäöüßÄÖÜôáàâé]+/', '', $solution['placeName']);
						// if both names are equal we have found our solution -> set lat and lng
						if ($temp_city == $city)
						{
							$city_name = $solution['placeName'];
							$gn_lat = $solution['lat'];			// We do have a solution so we can return the latitude
							$gn_lng = $solution['lng'];			// and longitude
						}
					}
					// no match found so we fall back to the first solution -> set lat and lng
					if ($city_name == '' )	// no match found
					{
						$solution = $xml_array[0];
						$gn_lat = $solution['lat'];			// We do have a solution so we can return the latitude
						$gn_lng = $solution['lng'];			// and longitude
					}
					// we've found a valid solution so we can set the return value to true
					$return = true;
				break;
			}
		}
		return $return;
	}

	/**
	* Check given zip code and country against the google data base and hopefully get back some coordinates to display on the map
	*
	* @params	postal_code: a string with the zip code
	*		country: a string with the country name, e.g. Germany
	*		google_lat, google_lng: a floating point value as reference, is set if return value is true
	*
	* @return  true if geonames.org gives a valid solution -> lat and lng are set, otherwise false, lat and lng do not contain a valid value
	*/
	function google_search($postal_code, $country, $city, &$google_lat, &$google_lng, &$google_radius)
	{
		$google_key = $this->config['mot_usermap_google_apikey'];
		// set an array with status messages we are not listing into the error log
		$status_ary = ['OK','ZERO_RESULTS'];

		// set the default return value (no match found or something went wrong)
		$return = false;

		// send the request
		$address = $postal_code . "," . $country;
		if ($city != '')
		{
			$address .= "," . $city;
		}
		$json_request = "https://maps.googleapis.com/maps/api/geocode/json?key=" . $google_key . "&address=" . urlencode($address);
		$json = file_get_contents($json_request);
		$xml = json_decode($json, true);

		$status = $xml['status'];

		if ($status == 'OK')	// we've gotten a valid response
		{
			$loc = $xml['results']['0']['geometry']['location'];
			$google_lat = $loc['lat'];
			$google_lng = $loc['lng'];
			switch ($xml['results']['0']['geometry']['location_type'])
			{
				case 'GEOMETRIC_CENTER':
					$google_radius = $google_radius/25;	// Street level, reduce distance between two markers on the same street
					break;

				case 'ROOFTOP':
					$google_radius = $google_radius/50;	// Address level, reduce distance even more
					break;
			}
			$return = true;
		}

		if (!in_array($status, $status_ary))	// something went wrong
		{
			$error_msg = $status . ': ' . $xml['error_message'];
			$this->log->add('critical', $this->user->data['user_id'], $this->user->ip, 'LOG_USERMAP_GOOGLE_ERROR', false, array($error_msg));
		}

		return $return;
	}

	/**
	* Check given zip code and country against the internal data base and hopefully get back some coordinates to display on the map
	*
	* @params	postal_code: a string with the zip code
	*		country_code: a string with the an uppercase two letter denomination, e.g. DE for Germany
	*		db_lat, db_lng: a floating point value as reference, is set if return value is true
	*
	* @return  true if geonames.org gives a valid solution -> lat and lng are set, otherwise false, lat and lng do not contain a valid value
	*/
	function db_search($postal_code, $country_code, &$db_lat, &$db_lng)
	{
		$return = false;
		$sql_array = [
			'country_code'	=> $country_code,
			'zip_code'		=> $postal_code,
		];
		$sql = 'SELECT * FROM ' . $this->usermap_zipcode_table . '
				WHERE ' . $this->db->sql_build_array('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		if ($row)
		{
			$db_lat = $row['lat'];
			$db_lng = $row['lng'];
			$return = true;
		}
		return $return;
	}

	/**
	* Add a user id to the doubles array which holds the country codes and within the country code the zip codes and there all the users living there
	* The purpose of this array is to get an integer value to compute the offset for latitude and longitude to discriminate several users within the same location on the map
	*
	* @params:	doubles: multidimensional array with all country codes and within those a set of zip codes and within each zip code the user_ids of users with that zip code
	*			(given as reference because it gets altered)
	*		user:id: integer with the user's id
	*		country: two letter string with the international country code (e.g. DE for Germany)
	*		zip_code: string with user's zip code
	*
	* @return:	Return value is an integer between Zero and Infinite (well, not really, since not all mankind resides in the same town) to compute the offset from the original lat and lng
	*		of the location identified by country and zip code (0 means no offset, map marker will be displayed in the center)
	*/
	function build_doubles(&$doubles, $user_id, $country, $zip_code)
	{
		if (array_key_exists($country, $doubles))						// do we already have this country code?
		{
			if (array_key_exists($zip_code, $doubles[$country]))		// yes, country code already exists, now we check for existence of the zip code
			{
				// yes, country code and zip code already exist, now we have to check for empty entry (user_id equals 0)
				$i = 0;
				$size = count($doubles[$country][$zip_code])-1;
				while ($i <= $size)										// for all stored user_ids:
				{
					if ($doubles[$country][$zip_code][$i] == 0)			// do we have user_id = 0 (earlier deleted user)?
					{
						$doubles[$country][$zip_code][$i] = $user_id;	// yes, overwrite it with this user
						return $i;										// and return the offset
					}
					$i++;
				}
				array_push($doubles[$country][$zip_code], $user_id);	// if we get here there was no empty slot and we have to add the user at the end
				return count($doubles[$country][$zip_code])-1;			// and return the new offset
			}
			else
			{
				$doubles[$country][$zip_code] = array();				// no, zip code doesn't exist within in this country code, so we generate it . . .
				array_push($doubles[$country][$zip_code], $user_id);	// and save the user id
				return 0;												// first user with this zip code, so the offset will be zero
			}
		}
		else
		{
			$doubles[$country] = array();								// country code doesn't exist, generate it
			$doubles[$country][$zip_code] = array();					// generate the zip code as well
			array_push($doubles[$country][$zip_code], $user_id);		// and save the user id
			return 0;													// first user with this zip code, so the offset will be zero
		}
	}

	/**
	*	Remove a user_id from $doubles array (e.g. when user gets deleted or deactivated)
	*
	* @params: refer to function  build_doubles (above)
	*
	* @return: none
	*/
	function remove_doubles_value(&$doubles, $user_id, $country, $zip_code)
	{
		// does this zipcode array really exist?
		if (!array_key_exists($zip_code, $doubles[$country]))
		{
			return;		// no, it doesn't exist, there is no known user, so we leave the function
		}
		// first we check whether there is a single user for this country / zipcode pair
		if (count($doubles[$country][$zip_code]) == 1)
		{
			if ($user_id != $doubles[$country][$zip_code][0])	// is this really the user we want to remove?
			{
				return;											// no, leave the function
			}
			else
			{
				unset($doubles[$country][$zip_code]);			// YES, delete the user array for this zipcode
			}
		}
		else	// there is more than one user at this zipcode
		{
			// if all other users have been deleted earlier we can simply delete the user array for this zipcode
			$deletable = true;
			foreach ($doubles[$country][$zip_code] as $value)
			{
				if ($value != 0 or $value != $user_id)
				{
					$deletable = false;
				}
			}
			if ($deletable)	// $user_id is the last remaining user, delete the array
			{
				unset($doubles[$country][$zip_code]);	// delete the user array for this zipcode
			}
			else		// there are other users, so we have to set the entry to 0 which signales an empty value
			{
				$size = count($doubles[$country][$zip_code]);
				$i = 0;
				foreach ($doubles[$country][$zip_code] as $value)
				{
					if ($value == $user_id)
					{
						if ($i == ($size - 1)) // if this is the last entry in the array, dump it
						{
							unset($doubles[$country][$zip_code][$i]);					// last entry, remove it ...
						$this->remove_doubles_value($doubles, 0, $country, $zip_code);	// and check, whether there are deleted entries before this one (user_id set to 0)
						}
						else
						{
							$doubles[$country][$zip_code][$i] = 0;		// not the last entry, set it to Zero (no valid user_id)
						}
					}
					$i++;
				}
			}
		}
	}

	/**
	* Checks whether a user identified by the user_id is part of the doubles array
	*
	* @params:	array2check: a doubles array to check for an instance of the -> user_id
	*		user_id: id of the user we are looking for
	*		key_cc: reference to a string which holds the country code in case of successful search
	*		key_zc: reference to a string which holds the zip code in case of successful search
	*
	* @return:	true if user is in the array (and therefore in the usermap_users table as well), false if not
	*		if true key_cc holds the country code and key_zc the zip code of this user (array2check is not changed)
	*/
	function check_user_id ($array2check, $user_id, &$key_cc, &$key_zc)
	{
		foreach ($array2check as $key_cc => $val_cc)
		{
			foreach ($val_cc as $key_zc => $val_zc)
			{
				$i = 0;
				foreach ((array) $array2check[$key_cc][$key_zc] as $val)
				{
					if ($val == $user_id)
					{
						return true;
					}
					$i++;
				}
			}
		}
		return false;
	}

}
