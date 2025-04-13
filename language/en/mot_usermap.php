<?php
/**
*
* @package Usermap v1.3.0
* @copyright (c) 2020 - 2025 Mike-on-Tour
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
	'USERMAP_COUNTRY_CODE'			=> 'en',		// MUST be set according to the language key of the respective language file BUT MUST NOT include any special denominators indicating a formal or informal honorific (e.g. 'de_x_sie' MUST use 'de'), but supplements like en-US are permitted !!!!
	// Module
	'USERMAP'						=> 'User Map',
	'USERMAP_NOT_AUTHORIZED'		=> 'You are not authorised to see the user map.',
	'USERMAP_SEARCHFORM'			=> 'Search Form',
	'USERMAP_LEGEND'				=> 'Legend',
	'USERMAP_CREDENTIALS'			=> 'Geo references used by Usermap courtesy of ',
	'USERMAP_LEGEND_TEXT'			=> 'Toggle mousewheel zoom by clicking on the map',
	'MAP_USERS'						=> [
		0	=> 'There is currently no member shown on the map.',
		1	=> 'There is currently %1$d member shown on the map.',
		2	=> 'There are currently %1$d members shown on the map.',
	],
	'POI_COUNT'						=> [
		0	=> 'There is currently no POI shown on the map.',
		1	=> 'There is currently %1$d POI shown on the map.',
		2	=> 'There are currently %1$d POIs shown on the map.',
	],
	// Search tabs
	'TAB_RADIUS_SEARCH'				=> 'Search in postal code vicinity',
	'TAB_MEMBER_SEARCH'				=> 'Search for members',
	'TAB_POI_SEARCH'				=> 'Search for POI',
	'TAB_ADDRESS_SEARCH'			=> 'Google Maps Search',
	'MAP_SEARCH'					=> 'Search for members at postal (zip) code %1$s within a range of ',
	'MAP_RESULT'					=> 'shows the following result:',
	'MAP_NORESULT'					=> 'found no members within the range of ',
	'MAP_KM'						=> 'km',
	'MEMBERNAME_SEARCH'				=> 'Enter the username of the member (wildcard * available)',
	'MEMBERNAME_RESULT'				=> 'The following members were found:',
	'MEMBERNAME_NORESULT'			=> 'There are no members with a username matching your request.',
	'POINAME_SEARCH'				=> 'Enter the name of the POI (wildcard * available)',
	'POINAME_RESULT'				=> 'The following POIs were found:',
	'POINAME_NORESULT'				=> 'There are no POIs with a name matching your request.',
	'ADDRESS_SEARCH'				=> 'Enter the search term (e.g. an address) for which you want to find coordinates (e.g. to create a POI)',
	'ADDRESS_RESULT'				=> 'Search term has been found and is displayed with a marker on the map.',
	'ADDRESS_MULTIPLE_RESULTS'		=> 'Found the following matches with the search term (click to display on the map):',
	'ADDRESS_NORESULT'				=> 'Unable to retrieve coordinates matching the given search term.',
	// Legend
	'POI_LEGEND_TITLE'				=> 'Legend for the POIs',
	'STREET_DESC'					=> 'Street map',
	'TOPO_DESC'						=> 'Topographical map',
	'SAT_DESC'						=> 'Satellite image',
	// Permission overview
	'USERMAP_PERM_OVERVIEW'			=> 'Permissions on this page',
	'USERMAP_PERM_VIEW_ALWAYS'		=> 'You <strong>can</strong> always see members.<br>',
	'USERMAP_PERM_VIEW_SUBSCRIBED'	=> 'You <strong>can</strong> only see members if registered yourself on the Usermap.<br>',
	'USERMAP_NO_VIEW_SUBSCRIBED'	=> 'You <strong>cannot</strong> see the members.<br>',
	'USERMAP_PERM_VIEW_POI'			=> 'You <strong>can</strong> see POIs.<br>',
	'USERMAP_NO_VIEW_POI'			=> 'You <strong>cannot</strong> see POIs.<br>',
	'USERMAP_NO_ADD_POI'			=> 'You <strong>cannot</strong> create POIs.<br>',
	'USERMAP_PERM_ADD_POI'			=> 'You <strong>can</strong> create POIs without moderator approval.<br>',
	'USERMAP_PERM_ADD_POI_MOD'		=> 'You <strong>can</strong> create POIs with moderator approval.<br>',
	// Error messages
	'USERMAP_GN_USER_ERROR'			=> ': Geonames user does not exist or is not activated for this service!',
	'USERMAP_NO_MATCH_FOUND'		=> 'No match found for <strong>%1$s</strong>!',
	// User POI popup
	'POI_INPUT_EXPL'				=> 'In this form you can create a new POI. Its coordinates will be adopted from the marker on the map left of this form.
										This marker is draggable, you can move it with the mouse to its final destination. Its name, description as well as
										the icon by which the marker will be represented later can be input or selected in the following form fields.',
	'POI_NEW_SAVED'					=> 'The created POI was successfully saved in the database and is displayed on the map.',
	'POI_MOD_NOTIFIED'				=> 'The created POI was successfully saved in the database, the moderators have been notified of it awaiting approval.',
	'ACP_USERMAP_POI_NAME'			=> 'Name of POI',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'Name of this POI, is displayed as a tooltip bubble when the mouse pointer moves over the POI marker.',
	'ACP_USERMAP_POI_POPUP'			=> 'Description of POI',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'Description of this POI, can use up to 500 characters and may contain BBCode.<br>
										This text is displayed in a popup bubble when the POI marker is clicked with the mouse pointer.',
	'ACP_USERMAP_POI_ICON'			=> 'Icon file',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'To facilitate a rudimentary categorisation of your POIs you can select from marker icons with different colours.',
	'ACP_USERMAP_POI_SIZE'			=> 'Icon size',
	'ACP_USERMAP_POI_SIZE_EXP'		=> 'Size of the icon in pixels in the notation ´width´,´height´.<br>
										Initial value is the default size given in the ´Settings´ tab.',
	'ACP_USERMAP_POI_ANCHOR'		=> 'Icon anchor',
	'ACP_USERMAP_POI_ANCHOR_EXP'	=> 'Anchor of the icon in pixels starting in the upper left corner in the notation ´horizontal value´,´vertical value´.<br>
										Initial value is the default value given in the ´Settings´ tab.',
	'ACP_USERMAP_DATABASE_LAT'		=> 'Latitude',
	'ACP_USERMAP_DATABASE_LNG'		=> 'Longitude',
	'ACP_USERMAP_POI_LAYER'			=> 'Map overlay',
	'ACP_USERMAP_POI_LAYER_EXP'		=> 'Select the map overlay on which this POI will be displayed.',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'Changes of the internal database successfully saved.',
	'ACP_USERMAP_CONFIRM_DELETE'	=> 'Are you really certain that you want to delete this item from the database?<br>
										<strong>This removes the item permanently from the database and cannot be undone!</strong>',
	'USERMAP_POI_NAME_ERROR'		=> 'The field >%1$s< must not be empty!',
	// Notifications
	'NOTIFICATION_USERMAP_MOD'		=> 'Moderation Notifications for the Usermap',
	'USERMAP_SETTING_APPROVE'		=> 'A recently created POI awaits approval',
	'USERMAP_SETTING_NOTIFY'		=> 'Somebody added a new POI to the Usermap',
	'USERMAP_NOTIFY_POI_APPROVE'	=> '<strong>A new POI awaits approval</strong><br>A new POI named „<strong>%1$s</strong>“ was created by the user „%2$s“ and awaits approval.',
	'USERMAP_NOTIFY_POI'			=> '<strong>POI added</strong><br>The user „%2$s“ has added a new POI named „<strong>%1$s</strong>“ to the Usermap.',
	// Moderation
	'POI_MOD_EXPL'					=> 'Here you can check the data of a user created new POI and edit it if you find this necessary or wish to do this for
										another reason. You can position the marker by dragging it with the mouse. After finishing this process you can either
										save the POI (and approve it) or delete it if it does not fit your boards policy.',
	'USERMAP_MOD_NOT_AUTHORIZED'	=> '<strong>You are not permitted to commence this activity!</strong>',
	'POI_NONEXISTENT'				=> 'POI does not exist',
	'POI_ALREADY_APPROVED'			=> 'This POI has already been approved!',
	'APPROVE'						=> 'Approve',
	'DONE'							=> 'Done',
	'POI_APPROVED'					=> 'POI successfully approved.',
	'ACTION_CONCLUDED'				=> 'Activity concluded.',
	'CHANGES_SUCCESSFUL'			=> 'Possible changes successfully saved.',
	'BACK_TO_USERMAP'				=> 'To the Usermap',
	// UCP
	'MOT_ZIP'						=> 'Postal code / Zip code',
	'MOT_ZIP_EXP'					=> 'Please enter the postal code / zip code of your location in order to be listed on the usermap.<br>(Uppercase letters, numbers and dashes/hyphens only)',
	'MOT_LAND'						=> 'Country',
	'MOT_LAND_EXP'					=> 'Please select the country where you live in order to be listed on the usermap.',
	'MOT_UCP_GEONAMES_ERROR'		=> 'The administrator didn\'t provide a Geonames.org user, therefore the data for the usermap could not be retrieved!',
	// Log entries
	'LOG_USERMAP_SETTING_UPDATED'	=> '<strong>Usermap settings changed</strong>',
	'LOG_POI_LEGEND_UPDATED'		=> '<strong>Edited the POI legend</strong>',
	'LOG_USERMAP_INSTALL_LANG'		=> '<strong>Added a language pack to the Usermap:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_NEW'		=> '<strong>Added a new database entry to the Usermap:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_DELETED'	=> '<strong>Deleted a database entry to the Usermap:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_EDIT'		=> '<strong>Edited a database entry to the Usermap:</strong><br>» %s',
	'LOG_USERMAP_POI_NEW'			=> '<strong>Added a new POI to the Usermap:</strong><br>» %s',
	'LOG_USERMAP_POI_EDITED'		=> '<strong>Changed POI data:</strong><br>» %s',
	'LOG_USERMAP_GOOGLE_ERROR'		=> '<strong>The Google Maps API failed the execution with the following error message:</strong><br>» %s',
	'LOG_USERMAP_GEONAMES_ERROR'	=> '<strong>The Geonames API failed the execution with the following error message:</strong><br>» %s',
	'LOG_USERMAP_POI_DELETED'		=> '<strong>Deleted a POI from the Usermap:</strong><br>» %s',
	'LOG_USERMAP_POI_APPROVED'		=> '<strong>User created POI approved:</strong><br>» %s',
	'LOG_USERMAP_POI_MOD_DELETED'	=> '<strong>User created POI deleted:</strong><br>» %s',
	// Profile
	'USERMAP_PROFILE_LINK'			=> '<strong>Show this member on the Usermap</strong>',
]);
