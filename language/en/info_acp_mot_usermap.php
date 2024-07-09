<?php
/**
*
* @package Usermap v1.2.5
* @copyright (c) 2020 - 2024 Mike-on-Tour
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
	$lang = [];
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
$lang = array_merge($lang, [
	// ACP
	'ACP_USERMAP'						=> 'User Map',
	'ACP_USERMAP_VERSION'				=> '<img src="https://img.shields.io/badge/Version-%1$s-green.svg?style=plastic"><br>&copy; 2020 - %2$d by Mike-on-Tour',
	'ACP_SUPPORT_USERMAP'				=> 'If you want to donate to Usermap´s development please use this link:<br>',
	'ACP_USERMAP_PAYPAL_TITLE'			=> 'PayPal - The safer, easier way to pay online!',
	'ACP_USERMAP_PAYPAL_ALT'			=> 'Donate with PayPal button',

	// Settings tab
	'ACP_USERMAP_SETTINGS'				=> 'Settings',
	'ACP_USERMAP_SETTINGS_EXPLAIN'		=> 'This is where you customise your user map.',
	'ACP_USERMAP_ALLOW_URL_FOPEN'		=> 'PHP option `allow_url_fopen` is disabled! It must be enabled in order for Usermap to function!',
	'ACP_USERMAP_SETTING_SAVED'			=> 'Settings for the user map successfully saved.',
	'ACP_USERMAP_GENERAL_SETTINGS'		=> 'General settings',
	'ACP_USERMAP_ROWS_PER_PAGE'			=> 'Rows per table page',
	'ACP_USERMAP_ROWS_PER_PAGE_EXP'		=> 'Choose the number of rows to be displayed per table page on the other tabs.',
	'ACP_USERMAP_MAPSETTING_TITLE'		=> 'Map settings',
	'ACP_USERMAP_MAPSETTING_TEXT'		=> 'Map center and zoom at start of the user map.',
	'ACP_USERMAP_LAT'					=> 'Latitude of the map center',
	'ACP_USERMAP_LAT_EXP'				=> 'Values between 90.0° (North Pole) and -90.0° (South Pole)',
	'ACP_USERMAP_LON'					=> 'Longitude of the map center',
	'ACP_USERMAP_LON_EXP'				=> 'Values between 180.0° (East) and -180.0° (West)',
	'ACP_USERMAP_ZOOM'					=> 'Initial zoom of the user map',
	'ACP_USERMAP_MARKERS_TEXT'			=> 'Here you can select the size of the markers indicating the users` positions on the map independently for the display on
											computer screens (desktop, laptop, notebook, netbook, tablet) as well as on mobile devices (cell phones).<br>
											The size is entered as the radius of the circle used as a marker, measurement unit is pixels.',
	'ACP_USERMAP_MARKERS_PC'			=> 'The circle´s radius on computer screens',
	'ACP_USERMAP_MARKERS_MOB'			=> 'The circle´s radius on the display of mobile devices',
	'ACP_USERMAP_GEONAMES_TITLE'		=> 'Username for geonames.org',
	'ACP_USERMAP_GEONAMES_TEXT'			=> 'User Map relies on the services of geonames.org to get the geographic coordinates
											of the member location identified by the postal code (zip code) and country and additionally
											the provided location in the member\'s profile.
											Therefore a registration at %1$s is mandatory. This registered username has to be entered here.<br>
											Each request costs 1 credit, with the free webservice you are limited to a maximum of
											1,000 credits per hour; if you operate a forum with more than 1,000 members it is recommended to
											register one username per 1,000 - 1,500 members. Otherwise your users may experience an
											error message while entering their profile data (postal code and country).<br>
											Multiple usernames need to be separated by commas.<br>
											<strong>ATTENTION:</strong> You have to enable (activate) your desired service after the first login
											on geonames.org using this %2$slink</span></a>!!',
	'ACP_USERMAP_GEONAMESUSER'			=> 'username(s) for geonames.org',
	'ACP_USERMAP_GEONAMESUSER_ERR'		=> 'It is mandatory to provide at least one valid username for geonames.org!',
	'ACP_USERMAP_PROFILE_ERROR'			=> 'This action could not be concluded successfully since you neglected to provide a Geonames.org user in the Usermap settings tab. Please do so immediately!',
	'ACP_USERMAP_GOOGLE_TITLE'			=> 'Settings for using Google Maps API',
	'ACP_USERMAP_GOOGLE_TEXT'			=> 'geonames.org supports only a limited list of countries (see list %1$shere</span></a>),
											if you need to consider countries not in this list, you might want to use the Google Maps service in addition.
											Using Google Maps service can be enabled here.<br>
											If you choose to use the Google Maps service you need to obtain an API Key by subscribing at %2$sGoogle Maps API Key</span></a>.
											Please follow the instructions there and heed activating the ´Geocoding API´.',
	'ACP_USERMAP_GOOGLE_ENABLE'			=> 'Enable the usage of the Google Maps API?',
	'ACP_USERMAP_GOOGLE_KEY'			=> 'Please enter your Google Maps API Key',
	'ACP_USERMAP_APIKEY_ERROR'			=> 'This action could not be concluded successfully since you neglected to provide a Google Maps API Key after activating this API. Please provide a valid key!',
	'ACP_USERMAP_GOOGLE_FORCE'			=> 'Country code of those countries enforced to look up with Google Maps API',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'		=> 'geonames.org is, for copyright reasons, considering only parts of the postal code for some countries, which leads to
											very appromixate coordinates. For a list of those countries please refer to %1$sthis</span></a>text.<br>
											The Google Maps API should provide more detailed results for those countries. If you wish to enforce the lookup
											at Google Maps API instead of geonames.org, enter the two letter country code of the desired countries, separated
											by commas.',
	'ACP_USERMAP_DATABASE_TITLE'		=> 'Using the internal database',
	'ACP_USERMAP_DATABASE_TEXT'			=> 'Even Google Maps may not provide a valid solution for some countries (e.g. Israel). In this case you can use an
											internal database for which you must provide the data, please choose the tab ´Internal database´ for more information.<br>
											You might want to use this way for users living in a country not supported by geonames.org if you do not wish to use
											the Google Maps API.',
	'ACP_USERMAP_DATABASE_ENABLE'		=> 'Enable the usage of the internal database?',
	'ACP_USERMAP_POI_TITLE'				=> 'Display Points of Interest (POIs)',
	'ACP_USERMAP_POI_TEXT'				=> 'Besides displaying member locations Usermap is capable of displaying additional overlays with locations which might
											be of particular interest to your members, e.g. hangouts and hotels for bikers or locations of sports arenas.
											You can choose the settings for this overlay in this section.<br>
											The following section allows you to write and edit a description defining the meaning of your different POI categories,
											which will be displayed below the map as a legend.<br>
											Input and editing of your POIs is the administrator´s task, all elements necessary to do this are accessible
											through the ´POI handling´ tab.',
	'ACP_USERMAP_POI_ENABLE'			=> 'Enable display of POIs?',
	'ACP_USERMAP_POI_ENABLE_EXP'		=> 'Choosing ´Yes´ enables displaying the POI overlays with the Usermap. It also activates your choice for the following
											setting and displaying the legend which you can write and edit in the section below.',
	'ACP_USERMAP_ICON_TITLE'			=> 'Default values for POI-Icons',
	'ACP_USERMAP_ICON_TEXT'				=> 'Here you can change the POI icons` default values for size and anchor. Preselected are the values for the icons
											shipped with Usermap. Alternatively, if you want to use your own icons you can enter their default values here.<br>
											Please refer to the ´ICONS.md´ file contained in the ´docs´ directory for further information.',
	'ACP_USERMAP_ICONSIZE_EXP'			=> 'Size of the icon in pixels in the notation ´width´,´height´.',
	'ACP_USERMAP_ICONANCHOR_EXP'		=> 'Anchor of the icon in pixels starting in the upper left corner in the notation ´horizontal value´,´vertical value´.',
	'ACP_USERMAP_POI_LEGEND'			=> 'POI legend',
	'ACP_USERMAP_POI_LGND'				=> 'Write and edit the POI legend',
	'ACP_USERMAP_POI_LGND_EXP'			=> 'Text you are entering here must not exceed 1,000 characters including all BBCode and will be displayed below the
											Usermap as legend if displaying of POIs is enabled.<br>
											Writing and editing is independent of all other settings on this tab.',
	// Language packs tab
	'ACP_USERMAP_LANGS'					=> 'Language packs',
	'ACP_USERMAP_LANGS_EXPLAIN'			=> 'This is where you can install additional language packs for the User Map. This might be necessary after adding
											language packs to the User Map after its first activation because their data have not been
											incorporated in the dropdown list to select the country; this you can do here after uploading the language pack
											with a ftp program into the <i>language</i> subdirectory of this extension.',
	'ACP_USERMAP_INSTALLABLE_LANG'		=> 'Language packs ready for installation',
	'ACP_USERMAP_INSTALL_LANG_EXP'		=> 'Usermap language packs waiting for installation.',
	'ACP_USERMAP_MISSING_LANG'			=> 'Missing language packs',
	'ACP_USERMAP_MISSING_LANG_EXP'		=> 'Languages installed within the board but missing in the Usermap extension.',
	'ACP_USERMAP_ADDITIONAL_LANG'		=> 'Additional language packs of Usermap',
	'ACP_USERMAP_ADD_LANG_EXP'			=> 'The extension\'s language packs for which no language exists within this board.',
	'ACP_USERMAP_LANGPACK_NAME'			=> 'Name',
	'ACP_USERMAP_LANGPACK_LOCAL'		=> 'Local Name',
	'ACP_USERMAP_LANGPACK_ISO'			=> 'ISO',
	'ACP_USERMAP_NO_ENTRIES'			=> 'No language packs found',
	// Internal database tab
	'ACP_USERMAP_DATABASE'				=> 'Internal database',
	'ACP_USERMAP_DATABASE_EXPLAIN'		=> 'This table contains all of your previously entered data of country/postal code combinations and their respective
											coordinates. In the rightmost column you find a link to delete the respective line.<br>
											Below this table you can add new data.',
	'ACP_USERMAP_DATABASE_DATA'			=> 'Data currently available',
	'ACP_USERMAP_DATABASE_CC'			=> 'ISO Country Code',
	'ACP_USERMAP_DATABASE_ZIPCODE'		=> 'Postal Code',
	'ACP_USERMAP_DATABASE_NAME'			=> 'Location name',
	'ACP_USERMAP_DATABASE_EDIT'			=> 'Edit database item',
	'ACP_USERMAP_DATABASE_NOENTRY'		=> 'No data available',
	'ACP_USERMAP_DATABASE_NEW'			=> 'Input new item into the database',
	'ACP_USERMAP_DATABASE_CC_EXP'		=> 'Please enter the uppercase 2-letter country code of the country to which this entry is to be allocated.',
	'ACP_USERMAP_DATABASE_ZC_EXP'		=> 'Please enter the postal (zip) code to which this entry is to be allocated, only uppercase letters, digits and the hyphen (dash) is allowed.',
	'ACP_USERMAP_DATABASE_NAME_EXP'		=> 'You can enter a name to better identify and discern this location.',
	'ACP_USERMAP_DATABASE_ERROR'		=> 'The field >%1$s< must not be empty!',
	'ACP_USERMAP_DATABASE_BIG_ERR'		=> 'The field must not be empty!',
	'ACP_USERMAP_DATABASE_INVALID'		=> 'This combination of country code and postal (zip) code already exists, it must not be used a second time!<br>
											Saving this input to the internal database failed!',
	// POI tab
	'ACP_USERMAP_POI'					=> 'POI handling',
	'ACP_USERMAP_POI_EXPLAIN'			=> 'In this table all POIs entered so far into the database are listed.<br>
											Below this table you can insert a new entry, in addition this is where you can edit an existing entry after selecting
											the <i>Edit</i> link in the last column of each line in the table.<br>
											By selecting the <i>Delete</i> link you can delete an entry from your database.',
	'ACP_USERMAP_POI_DATA'				=> 'POI entries currently available',
	'ACP_USERMAP_SELECT_POI_LAYER'		=> 'Overlay selections',
	'ACP_USERMAP_POI_LAYER_ALL'			=> 'All',
	'ACP_USERMAP_POI_CREATOR'			=> 'Creator',
	'ACP_USERMAP_POI_VISIBLE'			=> 'POI visible',
	'ACP_USERMAP_POI_VISIBLE_EXP'		=> 'Select whether this POI should be visible on the selected map overlay.',
	'ACP_USERMAP_POI_NEW'				=> 'Enter a new POI',
	'ACP_USERMAP_POI_EDIT'				=> 'Edit selected POI',
	'ACP_USERMAP_POI_SUCCESS'			=> 'The POI named „<strong>%1$s</strong>“ has been successfully stored.',
	'ACP_USERMAP_POI_DELETE'			=> 'Are you really certain that you want to delete the POI named „<strong>%1$s</strong>“ from the database?<br>
											<strong>This removes the POI permanently from the database and cannot be undone!</strong>',
	'ACP_USERMAP_POI_DEL_SUCCESS'		=> 'The POI named „<strong>%1$s</strong>“ has been removed from the database.',
	'ACP_ERR_POI_NO_NAME'				=> 'The input field named „Name of POI“ must not be empty!',
	'ACP_ERR_POI_NO_LAT'				=> 'The input field named „Latitude“ must not be empty!',
	'ACP_ERR_POI_NO_LNG'				=> 'The input field named „Longitude“ must not be empty!',
	// Layer tab
	'ACP_USERMAP_LAYER'					=> 'Map overlays',
	'ACP_USERMAP_LAYER_EXPLAIN'			=> 'All existing map overlays are listed in this table.<br>
											In the section underneath the table you can create a new map overlay or edit an existing one by clicking on the
											„Edit“ link of the respective table row. The current data of the selected map overlay will then be displayed
											in this section.<br>
											Using the respective link of the table you can delete this item.',
	'ACP_USERMAP_LAYER_SELECT_TYPE'		=> 'Select the overlay type to be displayed',
	'ACP_USERMAP_LAYER_DATA'			=> 'Existing map overlays',
	'ACP_USERMAP_LAYER_NAME'			=> 'Overlay name',
	'ACP_USERMAP_LAYER_NAME_EXP'		=> 'Enter a name to identify this map overlay.',
	'ACP_USERMAP_LAYER_TYPE_USER'		=> 'Users',
	'ACP_USERMAP_LAYER_TYPE_POI'		=> 'POI',
	'ACP_USERMAP_LAYER_ACTIVE'			=> 'Activate overlay',
	'ACP_USERMAP_LAYER_ACTIVE_EXP'		=> 'Choose „Yes“ to activate this map overlay and make it useable to put markers on it. Inactive map overlays are not
											selectable for display.',
	'ACP_USERMAP_SHOW_LAYER'			=> 'Display permanently',
	'ACP_USERMAP_SHOW_LAYER_EXP'		=> 'Choose „Yes“ to always show this map overlay, starting with calling the Usermap.<br>
											If you choose „No“ users need to select this map overlay through the map`s layer control element.',
	'ACP_USERMAP_LAYER_CLUSTERS'		=> 'Cluster markers',
	'ACP_USERMAP_LAYER_CLUSTERS_EXP'	=> 'To avoid cluttering the map with a high number of markers you can activate this setting to build clusters of markers.
											These clusters vary with the zoom.',
	'ACP_USERMAP_LAYER_LANG_VAR'		=> 'Language variables',
	'ACP_USERMAP_LAYER_LANG_VAR_EXP'	=> 'To enable your users to identify map overlays with a term in their native language please enter here for each of the
											languages installed on your board a term to identify this overlay in the layer control element, e.g. „Campgrounds“ as
											a term to identify a map overlay presenting campgrounds.<br>
											Please make sure to use a valid language tag (see your ACP`s Language packs table column „ISO“ on the „Customise“ tab)
											followed by a colon and your desired language term to make sure that the system can use your input.<br>
											<strong>%1$sExample:</span></strong> „en:Campgrounds“<br>
											Each combination of language tag and language term MUST use its own line!<br>
											<strong>%1$sATTENTION: A line with the language tag „en“ is MANDATORY!</span></strong>',
	'ACP_USERMAP_LAYER_DEFAULTICON'		=> 'Default icon',
	'ACP_USERMAP_LAYER_ICON_EXP'		=> 'Select the icon file which will be used as a default on this map overlay. This selection will be presented for all POIs
											created on this overlay.',
	'ACP_USERMAP_GROUPS_VIEWING'		=> 'Permitted groups',
	'ACP_USERMAP_PERMITTED_GROUPS'		=> 'Groups permitted to see this overlay',
	'ACP_USERMAP_PERMITTED_GROUPS_EXP'	=> 'Map overlays for members are displayed only with the permission to view members, map overlays for POIs are displayed
											if POIs are activated and the permission to view POIs is granted.<br>
											With this setting you can further restrict displaying of individual overlays to distinct default groups holding
											one or more of these permissions by selecting the default groups which should be able to see a certain overlay.<br>
											For selecting multiple groups please hold down the Shift or Ctrl key while clicking on the desired groups.',
	'ACP_USERMAP_LAYER_NEW'				=> 'Create new map overlay',
	'ACP_USERMAP_LAYER_EDIT'			=> 'Edit an existing map overlay',
	'ACP_USERMAP_LAYER_SUCCESS'			=> 'The map overlay named „<strong>%1$s</strong>“ has been successfully stored.',
	'ACP_USERMAP_LAYER_DELETE'			=> 'Are you really certain that you want to delete the map overlay named „<strong>%1$s</strong>“ from the database?<br>
											All POIs assigned to this map overlay will no longer be displayed!<br>
											<strong>This removes the map overlay permanently from the database and cannot be undone!</strong>',
	'ACP_USERMAP_LAYER_DEL_SUCCESS'		=> 'The map overlay named „<strong>%1$s</strong>“ has been removed from the database.',
	'ACP_ERR_LAYER_NO_NAME'				=> 'The input field named „Overlay name“ must not be empty!',
	'ACP_ERR_LAYER_NO_LANG'				=> 'The input field named „Language variables“ must not be empty!',
	'ACP_ERR_LAYER_INCORRECT'			=> 'This language variable does not adhere to the rules: ',
	'ACP_ERR_LAYER_NO_EN'				=> 'Language variable „en“ is missing!',
	// Route tab
	'ACP_USERMAP_ROUTE'					=> 'Routes',
	// Logs
	'LOG_USERMAP_LAYER_NEW'				=> '<strong>A new map overlay has been added to the Usermap:</strong><br>» %s',
	'LOG_USERMAP_LAYER_EDITED'			=> '<strong>Edited a map overlay:</strong><br>» %s',
	'LOG_USERMAP_LAYER_DELETED'			=> '<strong>Removed a map overlay from the Usermap:</strong><br>» %s'
]);
