<?php
/**
*
* @package Usermap v0.9.x
* @copyright (c) 2020 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
$lang = array_merge($lang, array(
	'PLURAL_RULE'					=> 1,
	// Module
	'USERMAP'						=> 'User Map',
	'USERMAP_NOT_AUTHORIZED'		=> 'You are not authorized to see the user map.',
	'USERMAP_SEARCHFORM'			=> 'Search Form',
	'USERMAP_LEGEND'				=> 'Legend',
	'USERMAP_CREDENTIALS'			=> 'Geo references used by Usermap courtesy of ',
	'USERMAP_LEGEND_TEXT'			=> 'Toggle mousewheel zoom by clicking on the map',
	'MAP_USERS'						=> array(
		1	=> 'There is currently %1$s member shown on the user map.',
		2	=> 'There are currently %1$s members shown on the user map.',
	),
	'MAP_SEARCH'					=> 'Search for members at postal (zip) code %1$s within a range of ',
	'MAP_RESULT'					=> 'shows the following result:',
	'MAP_NORESULT'					=> 'found no members within the range of ',
	'POI_LEGEND_TITLE'				=> 'Legend for the POIs',
	'STREET_DESC'					=> 'Street map',
	'TOPO_DESC'						=> 'Topografical map',
	'USER_DESC'						=> 'Users',
	'POI_DESC'						=> 'POIs',
	// ACP
	'ACP_USERMAP'					=> 'User Map',
	// Settings tab
	'ACP_USERMAP_SETTINGS'			=> 'Settings',
	'ACP_USERMAP_SETTINGS_EXPLAIN'	=> 'This is where you customize your user map.',
	'ACP_USERMAP_SETTING_SAVED'		=> 'Settings for the user map successfully saved.',
	'ACP_USERMAP_MAPSETTING_TITLE'	=> 'Map Settings',
	'ACP_USERMAP_MAPSETTING_TEXT'	=> 'Map center and zoom at start of the user map.',
	'ACP_USERMAP_LAT'				=> 'Latitude of the map center',
	'ACP_USERMAP_LAT_EXP'			=> 'Values between 90.0 (North Pole) and -90.0 (South Pole)',
	'ACP_USERMAP_LON'				=> 'Longitude of the map center',
	'ACP_USERMAP_LON_EXP'			=> 'Values between 180.0 (East) and -180.0 (West)',
	'ACP_USERMAP_ZOOM'				=> 'Initial zoom of the user map',
	'ACP_USERMAP_MARKERS_TEXT'		=> 'Here you can select the size of the markers indicating the users` positions on the map independently for the display on
										computer screens (desktop, laptop, notebook, netbook, tablet) as well as on mobile devices (cell phones).<br>
										The size is entered as the radius of the circle used as a marker, measurement unit is pixels.',
	'ACP_USERMAP_MARKERS_PC'		=> 'The circle´s radius on computer screens',
	'ACP_USERMAP_MARKERS_MOB'		=> 'The circle´s radius on the display of mobile devices',
	'ACP_USERMAP_GEONAMES_TITLE'	=> 'Username for geonames.org',
	'ACP_USERMAP_GEONAMES_TEXT'		=> 'User Map relies on the services of geonames.org to get the geographical coordinates
										of the member location identified by the postal code (zip code) and country and additionally
										the provided location in the member\'s profile.
										Therefore a registration at
										<a href="https://www.geonames.org/login" target="_blank">
										<span style="text-decoration: underline;">geonames.org/login</span></a>
										is mandatory. This registered username has to be entered here.<br>
										Each request costs 1 credit, with the free webservice you are limited to a maximum of
										1,000 credits per hour; if you operate a forum with more than 1,000 members it is recommended to
										register one username per 1,000 - 1,500 members. Otherwise your users may experience an
										error message while entering their profile data (postal code and country).<br>
										Multiple usernames need to be separated by commas.<br>
										<strong>ATTENTION:</strong> You have to enable (activate) your desired service after the first login
										on geonames.org using this
										<a href="https://www.geonames.org/manageaccount" target="_blank">
										<span style="text-decoration: underline;">link</span></a>!!',
	'ACP_USERMAP_GEONAMESUSER'		=> 'username(s) for geonames.org',
	'ACP_USERMAP_GEONAMESUSER_ERR'	=> 'It is mandatory to provide at least one valid username for geonames.org!',
	'ACP_USERMAP_PROFILE_ERROR'		=> 'This action could not be concluded successfully since you neglected to provide a Geonames.org user in the Usermap settings tab. Please do so immediately!',
	'ACP_USERMAP_GOOGLE_TITLE'		=> 'Settings for using Google Maps API',
	'ACP_USERMAP_GOOGLE_TEXT'		=> 'geonames.org does support only a limited list of countries (see list
										<a href="https://www.geonames.org/postal-codes/" target="_blank">
										<span style="text-decoration: underline;">here</span></a>),
										if you need to consider countries not in this list, you might want to use the Google Maps service in addition.
										Using Google Maps service can be enabled here.<br>
										If you choose to use the Google Maps service you need to obtain an API Key by subscribing at
										<a href="https://developers.google.com/maps/documentation/embed/get-api-key" target="_blank">
										<span style="text-decoration: underline;">Google Maps API Key</span></a>. Please follow the instructions there
										and heed activating the ´Geocoding API´.',
	'ACP_USERMAP_GOOGLE_ENABLE'		=> 'Enable the usage of the Google Maps API?',
	'ACP_USERMAP_GOOGLE_KEY'		=> 'Please enter your Google Maps API Key',
	'ACP_USERMAP_APIKEY_ERROR'		=> 'This action could not be concluded successfully since you neglected to provide a Google Maps API Key after activating this API. Please provide a valid key!',
	'ACP_USERMAP_GOOGLE_FORCE'		=> 'Country code of those countries enforced to look up with Google Maps API',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'	=> 'geonames.org is, for copyright reasons, considering only parts of the postal code for some countries, which leads to
										very appromixate coordinates. For a list of those countries please refer to
										<a href="http://download.geonames.org/export/zip/readme.txt" target="_blank">
										<span style="text-decoration: underline;">this</span></a>text.<br>
										The Google Maps API should provide more detailed results for those countries. If you wish to enforce the lookup
										at Google Maps API instead of geonames.org, enter the two letter country code of the desired countries, seperated
										by commas.',
	'ACP_USERMAP_DATABASE_TITLE'	=> 'Using the internal data base',
	'ACP_USERMAP_DATABASE_TEXT'		=> 'Even Google Maps may not provide a valid solution for some countries (e.g. Israel). In this case you can use an
										internal data base for which you must provide the data, please choose the tab ´Internal database´ for more information.<br>
										You might want to use this way for users living in a country not supported by geonames.org if you do not wish to use
										the Google Maps API.',
	'ACP_USERMAP_DATABASE_ENABLE'	=> 'Enable the usage of the internal data base?',
	'ACP_USERMAP_POI_TITLE'			=> 'Display points of Interest (POIs)',
	'ACP_USERMAP_POI_TEXT'			=> 'Besides displaying member locations Usermap is capable of displaying an additional overlay with locations which might
										be of particular interest to your members, e.g. hangouts and hotels for bikers or locations of sports arenas.
										You can choose the settings for this overlay in this section.<br>
										The following section allows you to write and edit a description defining the meaning of your different POI categories,
										which will be displayed below the map as a legend.<br>
										Input and editing of your POIs is the administrators task, all elements necessary to do this are accessible through
										the ´POI handling´ tab.',
	'ACP_USERMAP_POI_ENABLE'		=> 'Enable display of POIs?',
	'ACP_USERMAP_POI_ENABLE_EXP'	=> 'Choosing ´Yes´ enables displaying the POI overlay with the Usermap. It also activates your choice for the following
										setting and displaying the legend which you can write and edit in the section below.',
	'ACP_USERMAP_POI_SHOWTOALL'		=> 'Enable display of POIs to all members?',
	'ACP_USERMAP_POI_SHOWTOALL_EXP'	=> 'The Usermap and the POI overlay are shown by default only to those members who have put their location into the
										Usermap. If you want all other members to see the POI overlay, too, you can enable this here; those members then can
										see the POI overlay only but not the member locations.',
	'ACP_USERMAP_POI_LEGEND'		=> 'POI legend',
	'ACP_USERMAP_POI_LGND'			=> 'Write and edit the POI legend',
	'ACP_USERMAP_POI_LGND_EXP'		=> 'Text you are entering here must not exceed 1,000 characters including all BBCode and will be displayed below the
										Usermap as legend if displaying of POIs is enabled.<br>
										Writing and editing is independent of all other settings on this tab.',
	// Language packs tab
	'ACP_USERMAP_LANGS'				=> 'Language packs',
	'ACP_USERMAP_LANGS_EXPLAIN'		=> 'This is where you can install additional language packs for the User Map. This might be necessary after adding
										language packs to the User Map after its first activation because their data have not been
										incorporated in the dropdown list to select the country; this you can do here after uploading the language pack
										with a ftp program into the <i>language</i> subdirectory of this extension.',
	'ACP_USERMAP_INSTALLABLE_LANG'	=> 'Language packs ready for installation',
	'ACP_USERMAP_INSTALL_LANG_EXP'	=> 'Usermap language packs waiting for installation.',
	'ACP_USERMAP_MISSING_LANG'		=> 'Missing language packs',
	'ACP_USERMAP_MISSING_LANG_EXP'	=> 'Languages installed within the board but missing in the Usermap extension.',
	'ACP_USERMAP_ADDITIONAL_LANG'	=> 'Additional language packs of Usermap',
	'ACP_USERMAP_ADD_LANG_EXP'		=> 'The extension\'s language packs for which no language exists within this board.',
	'ACP_USERMAP_LANGPACK_NAME'		=> 'Name',
	'ACP_USERMAP_LANGPACK_LOCAL'	=> 'Local Name',
	'ACP_USERMAP_LANGPACK_ISO'		=> 'ISO',
	'ACP_USERMAP_NO_ENTRIES'		=> 'No language packs found',
	// Internal database tab
	'ACP_USERMAP_DATABASE'			=> 'Internal database',
	'ACP_USERMAP_DATABASE_EXPLAIN'	=> 'This table contains all of your previously entered data of country/postal code combinations and their respective
										coordinates. In the rightmost column you find a link to delete the respective line.<br>
										Below this table you can add new data.',
	'ACP_USERMAP_DATABASE_DATA'		=> 'Data currently available',
	'ACP_USERMAP_DATABASE_CC'		=> 'ISO Country Code',
	'ACP_USERMAP_DATABASE_ZIPCODE'	=> 'Postal Code',
	'ACP_USERMAP_DATABASE_LAT'		=> 'Latitude',
	'ACP_USERMAP_DATABASE_LNG'		=> 'Longitude',
	'ACP_USERMAP_DATABASE_EDIT'		=> 'Edit',
	'ACP_USERMAP_DATABASE_NOENTRY'	=> 'No data available',
	'ACP_USERMAP_DATABASE_NEW'		=> 'New input into the data base',
	'ACP_USERMAP_DATABASE_CC_EXP'	=> 'Please enter the two uppercase letter country code of the country to which this entry is to be allocated.',
	'ACP_USERMAP_DATABASE_ZC_EXP'	=> 'Please enter the postal (zip) code to which this entry is to be allocated, only uppercase letters, digits and the hyphen (dash) is allowed.',
	'ACP_USERMAP_DATABASE_ERROR'	=> 'The field >%1$s< must not be empty!',
	'ACP_USERMAP_DATABASE_BIG_ERR'	=> 'The field must not be empty!',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'Changes of the internal data base successfully saved.',
	'ACP_USERMAP_DATABASE_INVALID'	=> 'This combination of country code and postal (zip) code already exists, it must not be used a second time!<br>
										Saving this input to the internal data base failed!',
	'ACP_USERMAP_CONFIRM_DELETE'	=> 'Are you really certain that you want to delete this item from the database?<br>
										<strong>This removes the item permenantly from the data base and cannot be undone!</strong>',
	// POI tab
	'ACP_USERMAP_POI'				=> 'POI handling',
	'ACP_USERMAP_POI_EXPLAIN'		=> 'In this table all POIs entered so far into the database are listed.<br>
										Below this table you can insert a new entry, in addition this is where you can edit an existing entry after selecting
										the <i>Edit</i> link in the last column of each line in the table.<br>
										By selecting the <i>Delete</i> link you can delete an entry from your database.',
	'ACP_USERMAP_POI_DATA'			=> 'POI entries currently available',
	'ACP_USERMAP_POI_NAME'			=> 'Name of POI',
	'ACP_USERMAP_POI_POPUP'			=> 'Description of POI',
	'ACP_USERMAP_POI_ICON'			=> 'Icon file',
	'ACP_USERMAP_POI_SIZE'			=> 'Icon size',
	'ACP_USERMAP_POI_ANCHOR'		=> 'Icon anchor',
	'ACP_USERMAP_POI_NEW'			=> 'Enter a new POI',
	'ACP_USERMAP_POI_EDIT'			=> 'Edit selected POI',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'Name of this POI, is displayed as a tooltip bubble when the mouse pointer moves over the POI marker.',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'Description of this POI, can use up to 500 characters and may contain BBCode.<br>
										This text is displayed in a popup bubble when the POI marker gets clicked with the mouse pointer.',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'To facilitate a rudimentary categorisation of your POIs you can select from marker icons with different colours.',
	'ACP_USERMAP_POI_SIZE_EXP'		=> 'Size of the icon in pixels in the notation ´width´,´height´. Initial value is the default size
										of the icons shipped with Usermap.',
	'ACP_USERMAP_POI_ANCHOR_EXP'	=> 'Anchor of the icon in pixels starting in the upper left corner in the notation ´horizontal value´,´vertical value´.
										Initial value is the default anchor of the icons shipped with Usermap.',
	// ERROR LOG
	'LOG_USERMAP_GOOGLE_ERROR'		=> 'The Google Maps API failed the execution with the following error message<br>» %s',
	// UCP
	'MOT_ZIP'						=> 'Postal code / Zip code',
	'MOT_ZIP_EXP'					=> 'Please enter the postal code / zip code of your location in order to be listed on the usermap.<br>(Uppercase letters, numbers and dashes/hyphens only)',
	'MOT_LAND'						=> 'Country',
	'MOT_LAND_EXP'					=> 'Please select the country where you live in order to be listed on the usermap.',
	'MOT_UCP_GEONAMES_ERROR'		=> 'The administrator didn\'t provide a Geonames.org user, therefore the data for the usermap could not be retrieved!',
));
