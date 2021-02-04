# Change Log
All changes to `Usermap for phpBB` will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

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
