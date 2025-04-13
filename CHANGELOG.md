# Change Log
All changes to `Usermap for phpBB` will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [1.3.0] - 2025-04-12

### Added
-	Code to show multiple results with the Google Maps Search

### Changed
-	The HTML encoded select input fields used in `adm/style/acp_usermap_layer.html` to a macro stored in `adm/style/acp_mot_usermap_macro.html` (Many thanks to LukeWCS for the
	macro and the PHP function to create its content)
-	The Google Maps Search to include the user language key with the Google API call since without it the Google API assumes that the user language is en and does show only results
	for the en language
-	The storage of POI names because of problems with German "Umlaute"

### Fixed
-	A bug in the `controller/mot_usermap_acp.php` file's function `layer()` that prevented the layer editing function from "remembering" the permitted user groups for this layer
-	A bug in the `styles/all/template/mot_usermap.js` file's function `motUsermap.addPoiLayer()` that panned the map at the first click on a POI marker

### Removed
  
  
## [1.2.6] - 2024-11-23

### Added

### Changed
-	Maximum PHP version raised to 8.4.x
-	Some code improvements

### Fixed

### Removed
-	E_USER_ERROR for compatibility with PHP 8.4
  
  
## [1.2.5] - 2024-06-17

### Added

### Changed
-	Maximum PHP version raised to 8.3.x
-	Some code improvements

### Fixed
-	A problem with selecting the visibility of a POI in the ACP "POI handling" tab

### Removed
  
  
## [1.2.4] - 2024-01-05

### Added

### Changed
-	The usage of either toggles, checkboxes or radio buttons according to a general template variable called `TOGGLECTRL_TYPE` which is implemented with the
	`lukewcs/togglectrl` extension, default is still 'toggles'

### Fixed
-	A missing marker for the location BBCode

### Removed
-	All language packs except en, de and de_x_sie
-	All remnants of XHTML
  
  
## [1.2.3] - 2023-10-21

### Added
-	A check for the maximum PHP version allowed in the `ext.php` file
-	A link in the breadcrumbs line
-	A check for enabled PHP option `allow_url_fopen` in the `controller/mot_usermap_acp.php` file including an error box to be displayed in the
	`adm/style/acp_mot_usermap_settings.html` file if this option is disabled

### Changed

### Fixed
-	Permissions for displaying the link to a user in his profile in order that a user who is not on the Usermap can not see the link

### Removed
  
  
## [1.2.2] - 2022-11-28

### Added

### Changed
-	The Yes/No radio buttons in the ACP settings, POI and layer pages to a toggle

### Fixed
-	Two missing lines in `controller/mot_usermap_acp.php` which prevented the database tab from selecting entries for editing and deleting

### Removed
  
  
## [1.2.1] - 2022-09-27

### Added
-	A check for unwanted characters in POI names in `controller/main.php`, `controller/mod_poi.php` and `controller/mot_usermap_acp.php`
	including the definition of those characters in `includes/functions_usermap.php`
-	A new migration file `migrations/v_1_2_1.php` to change the length of the "name" field in the `USERMAP_POI_TABLE` from 50 to 60 characters and to change
	all existing POI names to a storage format using the `generate_text_for_storage()` function to prevent errors with old formats while using the BBCode to
	link to a POI

### Changed
-	Leaflet back to version 1.7.1 due to a bug (?) resulting in just moving the map while opening the popup of a POI

### Fixed
-	A type mismatch while looking for a POI name to display the POI via BBCode

### Removed
  
  
## [1.2.0] - 2022-07-20

### Added
-	The leaflet.markercluster class in order to enable clustering the markers if selected in the layer tab. A new settings option has been added to the layer
	tab to individually cluster markers for each layer.
	Affected files are `acp/layer_module.php`, `adm/style/acp_usermap_layer.html`, `adm/style/admin_mot_usermap.js`, `controller/main.php`,
	`styles/all/template/mot_usermap.js`, `styles/prosilver/template/usermap_main.html` and all `info_acp_mot_usermap.php` language files.
-	A new migration file `migrations/v_1_2_0_0.php` to add the new columns to the `usermap_layers` table for marker clusters, more layer types, layer_positions
	within the individual layer types and groups permitted to see the individual layers
-	Code to handle actions initialised by BBCodes to show a user, a POI or a location on Usermap
-	To the layers the ability within the individual layer types to have a position and to change those positions in the ACP in order to show them to the users
	in the sequence preferred by the admin
-	The property of groups permitted to see individual layers in order to enable admins to control what user groups can see individual layers if the group
	permissions permit seeing the map (members) and/or POIs
-	An overlay selection field to reduce the number of listed POIs to one or all overlays.
-	A copyright in the overall footer if Usermap is displayed
-	A loading image to be displayed in the searches
-	A Dutch language pack

### Changed
-	The minimum PHP version required to run Usermap is now set to PHP 7.2
-	The map div height from fixed 600px to the screen height minus 50 pixels in order to use the full screen height for the map
-	The ACP modules to one ACP module and one info file for it in order to enable a new controller file (`controller/mot_usermap_acp.php`), this made
	necessary two new migration files (`migrations/v_1_2_0_1.php` and `migrations/v_1_2_0_2.php`) to remove the old modules and insert the new modules
-	The names of ACP HTML files to a common prefix of `acp_mot_usermap_` followed by the mode name
-	The options in the 'Internal database', 'POI handling' and 'Map overlays' tabs from words to icons
-	The `ext.php` file to output error messages and to be compatible with 'Extension Manager Plus', including a new language file to hold the error messages
-	Inactive overlays will be displayed on an orange background in the respective ACP table
-	Code improvements within the ACP POI table
-	Leaflet to new version 1.8.0

### Fixed
-	The assignment of permissions to admin, moderator and user roles in the `migrations/v_0_10_0_0.php` migration file to check whether those roles really
	exist

### Removed
  
  
## [1.1.3] - 2021-12-28

### Added
-	Migration file `migrations/v_1_1_3.php`
-	Generating the version number in the ACP tabs from the `composer.json` file

### Changed
-	`composer.json` and `README.md` to show new version number
-	Length of `user_plz` column in the `phpbb_usermap_users` table from 8 to 10 characters to prevent errors while saving a postal code with the maximum length
	of 8 characters but including a dash (e.g. Brasilian postal codes like 68721-000) and thus exceeding the maximum column length

### Fixed
-	A possible source for a bad HTML request because of address string wasn't properly URL encoded in `event/main_listener.php`, line 650
-	A possible source for spammers to save POIs through the modal window if guests are permitted to see the map
  
### Removed
-	Config variable holding the version number
  
  
## [1.1.2] - 2021-10-12

### Added
-	Migration file `migrations/v_1_1_2.php` to set the new version number in `CONFIG_TABLE`
-	Javascript command to delete possible SID characters in POI path in `styles/prosilver/template/usermap_main.html`, line 168

### Changed
-	`composer.json` and `README.md` to show new version number
-	Including phpBB's editor is now done with TWIG command instead of `<script src=....` in `styles/prosilver/template/usermap_poi_input_box.html`

### Fixed
-	A possible SQL injection in `acp/database_module.php` line 138
-	Hard coded language in all ACP module files
-	Usage of router helper in `controller/main.php` and `controller/mod_poi.php`
-	Two instances of hard-coded language in `styles/all/template/mot_usermap.js`
  
### Removed
-	Unused array `layernames` from `controller/main.php`
-	'Plural mode' from all language files
  
  
## [1.1.1] - 2021-07-07

### Added
-	Migration file `migrations/v_1_1_1.php` to set the new version number in `CONFIG_TABLE`

### Changed
-	'click' event handlers for search tabs moved from `styles/prosilver/template/usermap_search.html` to `styles/all/template/mot_usermap_tabs.js`
-	The path to the phpBB editor from `./../assets/javascript/editor.js` to `./assets/javascript/editor.js` in
	`styles/prosilver/template/usermap_poi_input_bbcode.html`
-	`composer.json` and `README.md` to show new version number

### Fixed
-	A wrong path to the English countrycode file in `migrations/v_0_6_0_0.php`
-	Undefined permissions variables to hand over to javascript in `styles/prosilver/template/usermap_main.html` due to defining them in the wrong if-clause
	within `controller/main.php` (`POI_VIEW` and `POI_CREATE` never got defined if POIs were disabled)

### Removed
  
  
## [1.1.0] - 2021-06-30

### Added
-	Migration file `migrations/v_1_1_0_0.php` to set the new version number in `CONFIG_TABLE`, insert a new config variable `mot_usermap_rows_per_page`,
	remove the no longer needed columns `username` and `user_colour` from the `USERMAP_USERS_TABLE`, insert a new column into `USERMAP_ZIPCODES_TABLE`,
	insert a new table `USERMAP_LAYERS_TABLE` and a new column `layer_id` into `USERMAP_POI_TABLE` and `USERMAP_USERS_TABLE`
-	Migration file `migrations/v_1_1_0_1.php` to add a new ACP tab `Map layers`and to run a custom function to insert a member and a POI layer into the
	new `USERMAP_LAYERS_TABLE` and the respective `layer_id` into the `USERMAP_USERS_TABLE` and `USERMAP_POI_TABLE`
-	A new general setting to choose the number of rows to be displayed per table page on the ACP tabs "Internal database", "POI handling" and
	"Map overlays"
-	All ACP language variables are now contained in a new language file (`info_acp_mot_usermap.php`)
-	`setlocale(LC_ALL, 'C')` to prevent loss of decimal point while saving coordinates into the database (error occurred with one user), affected files are
	`acp/database_module.php`, `acp/main_module.php`, `acp/poi_module.php`, `controller/main.php`, `controller/mod_poi.php` and `event/main_listener.php`
-	Link from a user's profile to the usermap (only if user is listed on the usermap) to display this user's location, affected files are
	`controller/main.php`, `event/main_listener.php`, (new) `styles/prosilver/template/event/memberlist_view_zebra_after.html` and all `mot_usermap.php`
	language files
-	A 'name' field to the `USERMAP_ZIPCODES_TABLE` to improve readability of entries, affected files are `acp/database_module.php` and
	`adm/style/acp_usermap_database.html`
-	Function to edit database entries, affected files are `acp/database_module.php`, `adm/style/acp_usermap_database.html` and all language files
-	List with current permissions beneath the Usermap legends box
-	Search options for member and POI names and an option to search for addresses and other stuff using the Google Maps API
-	Tabs for the four search options to prevent this part of the display to become cluttered and "crowded"
-	Multible, admin defined map layers for POIs
-	ACP tab to administer map layers

### Changed
-	Version number and release date in `composer.json`
-	Version number in `README.md`
-	The amount of digits after the decimal point of map center's latitude and longitude in `acp/main_module.php` to enable a more finely adjusted map center
-	The Usermap menu icon from 'Globe' to 'Map'
-	`username` and `user_colour` are no longer stored in the `USERMAP_USERS_TABLE` and will be retrieved from the `USERS_TABLE` at run time in
	`controller/main.php`, also affected is `event/main_listener.php`
-	The path to get the links to memberlist and to the POI icons is no longer defined from the server configuration values but uses the `root_path`
	variable, affected files are `controller/main.php` and `styles/all/template/mot_usermap.js`
-	The ACP tab to handle POIs, the modal window to create POIs and the moderator page to approve/deny user-created POIs now contain a dropdown field to select
	a layer (if the admin created more than one) on which the POI will be dislayed. In addition the POI icon selector is preset to the default icon defined
	for this layer.
-	`controller/main.php` now checks with the current user's permissions whether the member data is needed and loads it only if permissions allow in order to
	improve performance; same happens within the `styles/all/template/mot_usermap.js`
-	Storage and search for POI names now includes special characters like quotes, affected files are `acp/poi_module.php`, `controller/main.php`,
	`controller/mod_poi.php` and `styles/all/template/mot_usermap.js`
-	All DOM operations are now done using jQuery or uniquely identified object functions
-	Extension tables are now defined in the `config/table.yml` file, no longer in a `*.php` file and injected through the `config/services.yml` file
-	Functions are defined in a new class and injected via service injection instead of using `include`
-	All `countrycode.txt` files are no contained within an additional subdirectory to prevent possible confusions with phpBB language files

### Fixed
-	Fatal errors due to an empty array supposed to hold users permitted to moderate POIs which results in an undefined array given to the notification data
	in `controller/main.php` on (new) line 187. Prevented with a check and defining an empty array in added lines 169 - 172
-	Function declaration `depends_on()` from `static public` to `public static` in all migration files to adhere to PHP Standards

### Removed
-	Function to set `user_colour` in `event/main_listener.php` is no longer needed and was removed
  
  
## [1.0.1] - 2021-02-14

### Added
-	A migration file `migrations/v_1_0_1.php` to update version number in `CONFIG_TABLE`

### Changed
-	All `countrycode.php` files into `countrycode.txt` files
-	All references to `countrycode.php` into `countrycode.txt` in `acp/lang_module.php`, `migrations/v_0_4_0_1.php`, `migrations/v_0_4_0_2.php`,
	`migrations/v_0_6_0_0.php` and `migrations/v_0_10_0_4.php`

### Fixed

### Removed
  
  
## [1.0.0] - 2021-02-12

### Added
-	The `rel="noopener noreferrer"` tag to PayPal link in `adm/style/acp_usermap_main.html`
-	A migration file to update version number in `CONFIG_TABLE`

### Changed
-	Version number and release date in `composer.json`
-	Version number in `README.md`
-	Using a `COUNT` SQL command to get number of entries in database instead of calling twice the `SELECT` SQL command in `acp/database_module.php`
-	Scrolling to POI legend preview in `adm/style/acp_usermap_main.html` and to POI edit in `adm/style/acp_usermap_poi.html`
-	Now using `strict` in `adm/style/admin_mot_usermap.js`
-	Replaced a constant defined as variable with a class constant in `event/main_listener.php`
-	The logic to determine a valid user in `controller/main.php`, line 233
-	The logic who can see the map in `styles/prosilver/template/usermap_main.html`, line 15

### Fixed

### Removed
-	Superfluous public variables from `acp/database_module.php`, `acp/lang_module.php` and `acp/main_module.php`
-	Superfluous javascript variables from `adm/style/acp_usermap_main.html` and `adm/style/acp_usermap_poi.html`
  

## [0.10.0] - 2021-02-04

### Added
-	A satellite image map layer, affected files are `styles/all/template/mot_usermap.js`, `styles/prosilver/template/usermap_main.html` and all front end
	language files
-	A php file `includes/functions_usermap.php` to hold all functions needed in more than one script
-	Three new config variables (`mot_usermap_version`, `mot_usermap_iconsize_default` and `mot_usermap_iconanchor_default`)
-	A permission system adding a new language file `permissions_mot_usermap.php` into every ISO language directory and affecting the files `acp/*_info.php`,
	`config/services.yml`, `controller/main.php`, `event/main_listener.php`, `language/'ISO'/mot_usermap.php`, `style/all/template/mot_usermap.js`,
	`styles/prosilver/template/usermap_main.html` and `styles/prosilver/template/event/overall_header_navigation_append.html`
-	A new migration file `migrations/v_0_10_0_0.php` to introduce the permissions.
-	Settings for POI icons using the two new config variables `mot_usermap_iconsize_default` and `mot_usermap_iconanchor_default`, affected files are
	`acp/main_module.php`, `acp/poi_module.php`, `adm/style/acp_usermap_main.html`, `adm/style/acp_usermap_poi.html`, `controller/main.php` and
	`mot_usermap.php` within all language packs.
-	A popup to user markers containing a link to the user's profile which will open in a new browser tab or window. Affected file is
	`styles/all/template/mot_usermap.js`
-	The possibility for users to create new POIs by right-clicking into the map at the desired location. Depending on the permissions the new POI is
	instantly saved in the data base or is held back until approved by a moderator. Therefore two new columns (`creator_id` and `disabled`) were added to
	the `USERMAP_POI_TABLE`.
	New files are `controller/mod_poi.php`, `styles/prosilver/template/usermap_poi_input.html` and `styles/prosilver/template/usermap_poi_input_bbcode.html`.
	Affected files are `controller/main.php`, `language/'ISO'/mot_usermap.php`, `style/all/template/mot_usermap.js`,
	`styles/prosilver/template/usermap_main.html`, `styles/prosilver/theme/usermap.css`
-	A new migration file `migrations/v_0_10_0_1.php` to insert the new columns to the `USERMAP_POI_TABLE`
-	A footer line with version and copyright information on each of the ACP tabs, affected files are all ACP module and html files. For formatting the new
	file `adm/style/mot_usermap_acp.css` was added.
-	A notification system in order to notify moderators that a new POI has been created by a user.
	New files are `notification/approve_poi.php`, `notification/notify_poi.php` and the e-mail text files in the language packs
	Affected files are `ext.php`, `config/routing.yml`, `config/services.yml`, `controller/main.php`, `controller/mod_poi.php` and all major language files
-	A class to check and approve/disapprove user created POIs with the new files `controller/mod_poi.php`, `styles/prosilver/template/usermap_mod_poi.html`
	as well as `styles/all/template/mot_usermap_mod_poi.js` and `styles/all/template/bbcode.js` to handle the Javascript side of moderating user created POIs
-	Two new migration files `migrations/v_0_10_0_2.php` and `migrations/v_0_10_0_3.php` to remove Usermap's ACP tabs and to re-add them again with the new
	administrator permission
-	A Polish language pack
-	A migration file (`migrations/v_0_10_0_4.php`) to handle the correction of the language entries in the PROFILE_FIELDS_LANG_TABLE
-	Log commands to all ACP module files and to the "moderation" file `controller/mod_poi.php`, affected are all major language files

### Changed
-	Moved the default definitions for POI icon size and anchor from `acp/poi_module.php` to new config variables. Affected files for usage are
	`acp/main_module.php`, `acp/poi_module.php`, `adm/style/acp_usermap_main.html`, `adm/style/acp_usermap_poi.html` and `controller/main.php`.
-	The display of POIs in the ACP's `POI Handling` tab regarding disabled (not yet approved) POIs, these are displayed on a light orange background.
	Affected files are `acp/poi_module.php` and `adm/style/acp_usermap_poi.html`
-	Use PHP's `file` command instead of `fopen()`, `fgets()` and `fclose()` functions to read the countrycode files in `acp/lang_module.php` and
	`migrations/v_0_4_0_1.php` files (first implemented with `migrations/v_0_10_0_4.php`)
-	The check for valid geonames.org usernames by allowing dots in usernames (until now a dot was assumed to be a "misplaced" comma and was exchanged
	accordingly), affected file is `adm/style/admin_mot_usermap.js`

### Fixed
-	Added a missing paragraph end tag in `adm/style/acp_usermap_poi.html`, line 143 (new line 144)
-	Wrong entries in the fr `countrycode.php` file (CU was 'Serbie et Montenegro' instead of 'Cuba' which was shifted one line down as well as all
	entries until CX which was 'Curaçao' instead of the missing 'Île Christmas'.
-	All strings in the PROFILE_FIELDS_LANG_TABLE since these were entered by `migrations/v_0_4_0_1.php` with an ending line feed character
  
### Removed
-	The config variable `mot_usermap_poi_showtoall` which became superfluous by introducing the permission system. Affected files are `acp/main_module.php`
	and `adm/style/acp_usermap_main.html`. The variable was removed from the `phpbb_config` table with the migration file `migrations/v_0_10_0_1.php`. All
	language variables concerning this variable have been removed from the language files.
  
  
## [0.9.2] - 2020-12-01

### Added
-	French language pack

### Changed

### Fixed

### Removed
  
  
## [0.9.1] - 2020-10-29

### Added
	
### Changed
	
### Fixed
-	Faulty SQL query in `event/main_listener.php`, line 390 which led to an undesired result (ALL users got selected and the first to be processed was
	the anonymous [guest] user).
	
### Removed

  
## [0.9.0] - 2020-10-26
**Please note:** Due to changes regarding the `$language` variable in the ACP files Usermap is now compatible with ALL versions of phpBB 3.2.x and 3.3.x!

### Added
-	A check for the user agent to enable two settings for marker sizes (mobile devices and all other) in `style/all/template/mot_usermap.js`
-	Two new settings to allow the admin to define the radius of the markers showing user locations on the map, one for PCs, laptops, notebooks, netbooks etc.
	and one for mobile devices. Affected files are `acp/main_module.php`, `adm/style/acp_usermap_main.html`, `controller/main.php`,
	`styles/all/template/mot_usermap.js` and all language files.
-	The facility to define the size and the anchor of POI icons in order to better generate user defined icons or to set size and anchor point of individual
	icons. Affected files are `acp/poi_module.php`, `adm/style/acp_usermap_poi.html`, `adm/style/admin_mot_usermap.js`, `styles/all/template/mot_usermap.js`
	and all language files.
-	Two new migration files, `v_0_9_0_0` to add the new config variables for marker sizes and the two additional columns in the `phpbb_usermap_poi` table
	and `v_0_9_0_1` to fill those new columns with the so far static values for all icons delivered with Usermap
	
### Changed
-	Leaflet from version 1.6 to version 1.7.1
-	If a POI has no description `styles/all/template/mot_usermap.js` will no longer open an empty popup window.
-	In the files `acp/database_module.php`, `acp/lang_module.php`, `acp/main_module.php` and `acp/poi_module.php` the global variable `$language` was used.
	Since this global variable was introduced in phpBB 3.2.6 with Usermap 0.8.0 an `ext.php` file was added to prevent installation on phpBB version 3.2.5
	and earlier. In Usermap 0.9.0 the variable `$language` is no longer acquired from the global variable but instead from the `phpbb_container` where it
	was introduced with phpBB 3.2.0. So the four ACP files are changed accordingly and the `ext.php` file checks now for phpBB versions later or equal to
	3.2.0.
-	The `README.md` file according to the new features.

### Fixed
-	Quick links and user dropdown menus are partially hidden by the Usermap's map object due to high numbers for z-index for several leaflet elements
	(as high as 1000). Solved by assigning a z-index of 1024 to phpBB's `.dropdown` class in `styles/prosilver/theme/usermap.css`
-	In answering some reports of SQL errors with `user_id` and `username` set to NULL whilst writing new users to the `usermap_users` table after
	editing user profiles in the ACP or UCP it is now checked whether this user is already in the `profile_fields_data` table in the `event/main_listener.php`
	files `process_user_profile_data` function; if he is not then no data from this table is queried to prevent an empty result (and thus NULL values for
	`user_id` and `username`.

### Removed
-	An unnecessary check for BOTs while building the user group list in `controller/main.php`


## [0.8.0] - 2020-09-02
**Please note:** Due to switching from the (deprecated) usage of the `user` classes `lang` element to the `$language->lang` class methods Usermap completely
lost the (never intended anyway) backwards compatibility with phpBB 3.1.x and phpBB versions prior to version 3.2.6. This is the main reason for the minor
version increment otherwise it would only be a patch version increment.

### Added
-	A check for a closing '/' character in the `jsServerConfig` variable in `mot_usermap.js` to prevent double slashes which could lead to a read error
	when loading the POI marker files
-	Added an `if` clause in the ACP template `acp_usermap_main.html` to show POI legend settings only if POIs are enabled
-	Added a javascript function and a variable set by the calling ACP script to ACP templates `acp_usermap_main.html` and `acp_usermap_poi.html` to enable
	the windows to scroll to the approbiate form in case the `Edit` or `Preview` button was hit
-	`README.md` file
-	`CHANGELOG.md` file
-	`ext.php` file to check the phpBB version to prevent installation/enabling on boards with phpBB versions prior to 3.2.6

### Changed
-	All references to `$user->lang` have been replaced with `$language->lang`, Usermap is therefore not backwards compatible with phpBB 3.1.x (which it
	was never intended to anyway), files subject to this change are `controller/main.php`, `event/main_listener.php` and `config/services.yml`
-	Converted all `prosilver` templates to [TWIG](https://twig.symfony.com/) syntax
-	Replaced the use of php comparison operator `<>` with `!=` in all php files to adhere to phpBB coding guidelines
-	Changed the use of `sizeof()` to `count()` in all php files
-	Changed the use of double quotes inside the language strings to `´` in all language files 

### Fixed
-	Corrected typos in en language file
-	Corrected a typo in de language file
-	Fixed two possible SQL injections in `event/main_listener.php`
-	Changed a twice used name (once for the form and secondly for a textarea) in `adm/style/acp_usermap_main.html` by renaming the textarea from `mot_usermap_poi_legend`
	to `mot_usermap_poi_legend_text`
-	Inserted a check for inactive users in the function that is called when an administrator edits user profile data in `event/main_listener.php` to prevent
	inactive users being inserted into the USERMAP_USERS_TABLE prior to activation which will then cause a SQL error during activation (double primary key)

### Removed
-	Text file `version_history.txt`
-	`functions_user.php` was included in `controller/main.php` but not used -> removed


## [0.7.0] - 2020-06-29

### Added
-	New feature to show additional POI on the map
-	New table `usermap_poi` to store the data base input
-	New `config` variables `mot_usermap_poi_enable` and `mot_usermap_poi_showtoall` and new `config_text` variable `mot_usermap_poi_legend`
-	New migration file `v_0_7_0.php` 
-	New ACP tab to list and amend the internal POI data base

### Changed
-	Converted all ACP templates to [TWIG](https://twig.symfony.com/) syntax
-	javascript file `mot_usermap.js` is now included in the template files only, no longer within `acp_overall_footer_after.html` and thus to be included
	in ALL ACP templates
-	ACP template file `acp_usermap_body.html` renamed `acp_usermap_main.html` to fit to ACP module `main_module.php`
-	Changed line 361 in `main_listener.php` from `if ($user_colour !== '') . . .` to a ternary operator setting this value to either black (#000000) if the
	string is empty or leave the original value. Change was necessary due to unchanged colours if the `REGISTERED` group wasn't given a colour when the
	default group was changed (either by admin or by reaching the necessary number of posts to leave the `NEWLY_REGISTERED` group

### Fixed

### Removed
-	Subdirectory `mot/usermap/adm/style/event` and the template file `acp_overall_footer_after.html` within this subdirectory are removed


## [0.6.2] - 2020-06-07

### Added

### Changed
-	Changed the OSM map server to https instead of http

### Fixed
-	`controller/main.php`: Changed the test whether a user is part of the usermap in line 94 from `if (isset($row))` to `if (!empty($row))` because the
	updated sql query always sets $row but leaves it empty if no user row is found within the usermap_users table


## [0.6.1] - 2020-06-04

### Added

### Changed

### Fixed
-	Corrected sql errors in migration file `v_0_6_0_0.php` which in combination with `language/en/countrycode.php` led to ajax and data base errors
	during activation (unescaped characters in country names)


## [0.6.0] - 2020-05-30

### Added
-	Additional search for coordinates with Google Maps API by country and zip code
-	Additional search for coordinates within an internal data base
-	Corresponding `config` and `config_text` keys to the settings tab
-	New table `usermap_zipcodes` to store the data base input
-	New ACP tab to list and amend the internal data base
-	New functions to search with Google Maps API (`google_search()`) and in the data base table (`db_search()`) in `main_listener.php`

### Changed
-	Updated sql queries in `main_listener.php`, `lang_module.php` and `main.php`

### Fixed

### Removed
-	Unused variables in ACP modules `database_module.php`, `lang_module.php` and `main_module.php`


## [0.5.2] - 2020-05-16

### Added
-	Spanish language pack (courtesy of Jorge (Jorup16 at www.phpbb.com))

### Changed

### Fixed


## [0.5.1] - 2020-05-09

### Added
-	Additional event `core.ucp_register_register_after` in `main_listener.php` to process user data for the Usermap if no further activation after
	registration is needed
-	Error messages in all functions in `main_listener.php` where user data is processed to add a user to the Usermap in case no Geonames user is defined
	and therefore no data could be acquired
	Error messages related to missing Geonames.org user
-	Error message text to all language files

### Changed

### Fixed


## [0.5.0] - 2020-05-06

### Added
-	ACP tab to install or update extension language packs
-	javascript file `admin_mot_usermap.js` to check the ACP Settings input and correct it if necessary

### Changed

### Fixed
-	Corrected some bugs in `mot_usermap.js` after inserting strict mode


## [0.4.0] - 2020-04-24

### Added
-	Event listener `core.acp_users_profile_modify_sql_ary` to `main_listener.php` in order to take care of changes made by the admin
	within the ACP profile tab of a user
-	Language files with the Country Code (two letter denominator, eg. DE) and the full name with all (currently) 250 countries in order to get rid of the
	former Custom Profile Field inherited from an old 3.0.x modification
-	Migration files `v_0_4_0_0.php` and `v_0_4_0_1.php` to create custom profile fields `mot_zip` and `mot_land`
-	New `config_text` variable `mot_usermap_countrycodes` to hold the 250 two uppercase letter country codes
-	Migration file `v_0_4_0_2.php` to fill the `config_text` variable `mot_usermap_countrycodes` from the language file

### Changed
-	Optimized sql queries in files `main.php` and `main_listener.php`
-	Leaflet from version 1.4 to version 1.6

### Fixed
-	Corrected errors from `serialize` and `unserialize` by changing to `json_encode` and `json_decode` respectively in the file `main_listener.php`
	for writing and reading `config` and `config_text` varaibles

### Removed
-	`config` variable `mot_usermap_countrycodes` since it won't be able to hold 250 new country codes due to structure (255 characters only)
  
  
## [0.3.1] - 2019-09-28

### Added
-	Event listeners `core.group_add_user_after` and `core.user_set_default_group` to `main_listener.php` in order to 
	adjust the user's colour in the `usermap_users table` after a user is added to a new default (main) group

### Changed

### Fixed


## [0.3.0] - 2019-06-03
-	First working version
