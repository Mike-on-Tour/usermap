# **Usermap for phpBB**

![Version: 1.0.1](https://img.shields.io/badge/Version-1.0.1-green)  
  
![phpBB 3.2.x Compatible](https://img.shields.io/badge/phpBB-3.2.x%20Compatible-009BDF)
![phpBB 3.3.x Compatible](https://img.shields.io/badge/phpBB-3.3.x%20Compatible-009BDF)  

[![Build Status](https://github.com/Mike-on-Tour/usermap/workflows/Tests/badge.svg)](https://github.com/Mike-on-Tour/usermap/actions)

### **Description**
Usermap is an extension for phpBB board versions 3.2.x and 3.3.x which adds a map with your users locations - and if you choose so, an additional layer with
points of interest (POI) for your users - to the board. It is accessible through a link in the board's header.  
To determine your users' locations Usermap uses the country and the postal code of the municipality a user lives in and looks up its coordinates primarily in
the database of *[geonames.org][]* which means that it is **mandatory** for you to register an account there. Without this account Usermap will not function!  
Since *[geonames.org][]* does not provide coordinates for every country in the world you can select Google Maps as an additional source and for all countries
even Google Maps does not provide postal code related coordinates you as your board's administrator can provide coordinates for a pair of country and postal
code by filling a table of phpbb's database. For more information please refer to the hints in the `ACP Settings` tab of the extension which provides some
links to important pages of the above mentioned providers.  
The POIs (which could be anything from landmarks to bikers' hangouts to sports arenas or whatever is important to your board) are stored in a table of
phpbb's database which the administrator can fill within the ACP.  

### **Important**
Since there are countries with one postal code (zip code) for more than one location and Geonames.org reflects this by providing all location names under this
postal code Usermap takes into account the content of phpBB's `phpbb_location` profile field to get a more detailed coordinate in those cases. **Therefore ist
is important that you must not delete this profile field for the simple reason that you don't think it necessary!**

### **Installation**
It is strongly recomended that you use the zipped file package for installation since it always provides the latest version: *[download link][]*  
After downloading unzip the file and upload it with a good ftp program (like FileZilla or WinSCP) to your board's `ext` folder where you should find this
directory structure afterwards:  
`/ext/mot/usermap`.  
In this subdirectory all subdirectories and files of the extension must be located.  
Logging into your board's ACP go to the `Customise` tab, find the `Usermap for phpbb` line and enable the extension. Afterwards you should see the
Usermap's four tabs under the `USER MAP` heading in the ACP's `Extensions` tab.

### **Usage**

#### *Users*
Users are effected by Usermap during registration, in the UCP and when they click the link to actually displaying the map itself. If you are asking yourself
now why users are effected during registration, it is quite simple: Usermap creates two new `Custom Profile Fields` which are by default displayed in the
registration process. The first one is a text field for input of the user's postal code and the second one is a dropdown field listing all countries of the
world for the user to easily select the country matching his or her location. If a user provides this data during registration Usermap will try to get a
coordinate from the enabled database(s) during the activation process and adds this user to the Usermap users table if it was successful.  
If a user chooses to not provide this information during registration he or she can do this anytime through the `Profile` tab in the UCP. As soon
as the user hits the enter key Usermap will try to get a coordinate as described above.  
PLEASE NOTE: Users must provide a valid pair of postal code and country, otherwise the lookup in the database will fail and the user is not listed in the
Usermap users table.  
  
Clicking the Usermap link in the header bar will open the map itself, its content is divided in three parts:
1.  Search Form  
In this part the user will find his or her postal code prefixed by his/her country's two letter country code and a hyphen and followed by a dropdown field to
select a range in kilometers which determines the radius around that location in which Usermap will look for other users after the `Submit` button was hit. 
The result will be displayed in the next line(s) and if successful lists all users within the defined circle ordered by ascending distance. The user name
is written in this user main group's colour and is a link to this user's profile which will open in a new browser tab or window depending on the settings
of the browser.
2.  User Map  
This part displays the map itself. It contains two control elements, a scale control element in the upper left corner and a layer control element in the
upper right corner. The first one should be rather self-explanatory, the second one offers the possibility to switch between a road map (default) and a
topographical map and (if points of interest are enabled and the user is viewed as an authorized user with his or her location on the map) select buttons 
for the user and the POI overlay. The user overlay is displayed by default and users can add the POI overlay by ticking this field. Unauthorized users may
see the POI overlay by default if this is enabled by the administrator.  
User locations are displayed with circle markers coloured with the respective user´s main group color and POIs are displayed with a triangle standing on its
point, coloured as the administrator has chosen during input.  
If more than one user selected the same combination of country and postal code all markers at this position would be overlapping entirely with only one user
visible. To prevent this the locations of the second and all subsequent users with identical country/postal code combinations are calculated with a dynamic
offset to spread them around the original position.
3.  Legend  
In this part the user groups are listed with their respective colour and the total number of Usermap users is displayed as well as the POI legend if these
are enabled.
  
If permitted users may create a new POI by right clicking into the map at the selected position (it is strongly recommended to zoom into the map prior to 
right clicking since it is far easier to select the desired spot on the big map). After this click a modal window is openend which shows a small map with
a very high zoom factor on the left side and on the right side a form to input a name and a description as well as a dropdown field to select the icon
representing the POI. The marker is not changed by the selection from the dropdown field but it can be dragged with the mouse to its final position. If
this is allowed in the board functionalities as well as in the post settings it is possible to use BBCodes in the description textarea. Depending on those
settings none of the BBCode buttons or the approbriate selection will be displayed for usage.  
After submitting this form the POI data is stored in the data base and depending on the user's permission the new POI is either visible on the map or put
into the moderator queue. The user is informed which of these two actions has been taken. Moderators and administrators will - depending on their permissions
and notification settings - be notified that a new POI was created.
  
#### *Administrator*
Administrators will find the `User Map` section within the ACP's `Extensions` tab providing itself four tabs:
1.  Settings  
	Please read the descriptions within the sections of this tab carefully since they provide vital information to the individual settings.  
	+  Map Settings  
		to define latitude and longitude of the map's center when opening the Usermap window as well as the initial zoom (aka scale);
		in addition you can set the size of the marker used to display users' locations on the map independently for computers and for mobile devices.
	+  Username for geonames.org  
		should be self-explanatory; if no input was provided, the form keeps going back to this text field when hitting the `Submit` button. Please keep in
		mind that this setting MUST NOT be empty since geonames is the extensions primary means to get coordinates.  
		Usermap DOES NOT check the validity of the provided user name, this is wholly the administrator's responsibility!
	+  Settings for using Google Maps API  
		to provide the API key necessary for using this service. Please keep in mind that you need to activate this key for the `Geocoding API` to operate 
		properly.  
		If you enabled the Google Maps service without providing input in this text field the ACP will keep coming back to this field until you input a key.  
		As well as the input for the geonames user name this input is not checked for its validity!  
		Since Google Maps is for a number of countries more accurate than geonames.org you can additionally select countries by their two-letter country
		code to enforce the lookup in the Google Maps instead of the geonames.org data base.
	+  Using the internal database  
		The internal database (which has to be filled by the administrator, see serial 4. for further information) is kind of a last resort to gain coordinates
		for a given pair of country/postal code. You may want to use this possibility if only a few of your board's users live in countries not listed in the
		geonames database and you don't want to use the Google Maps API service.
	+  Display points of interest (POI)  
		Enabling the display of the POI overlay is done with this setting. **Enabling this setting is a prerequisite for all user permissions regarding POIs
		to be in force!**
	+  Default values for POI-Icons  
		This setting allows you to define your own default values for the POI icon size and anchor. Thus you can change the default setting of the icons
		delivered with Usermap (e.g. make them bigger or smaller) or set the values needed for your own icons in case you omitted the before mentioned icons
		and uploaded your own ones.
	+  POI Legend  
		This setting is only displayed if the POI overlay is enabled (see previous setting). You can enter a description of your POI's colour scheme or
		whatever you wish to say to your users about the POIs.
	
2.  Language packs  
	Usermap checks during installation the languages which are installed with your board and if there is a corresponding language pack in its language
	subdirectory it installs the necessary dropdown field for the country in this language. For all other languages this dropdown field is installed using
	the English language pack. If you later aquire an additional Usermap language pack or install an additional language (for which you have a Usermap
	language pack) you need to install this language to enable your users to see the country dropdown field in this language.  
	This is done through this tab. It shows three tables, the first one containing the Usermap language packs ready for installation, which is done by
	just clicking on the `Install` link in the last column.  
	The second table lists all languages which are installed in your board but are missing in the Usermap package and the third table lists for your
	convenience all Usermap language packs with no language installed in your board.
	
3.  Internal database  
	If you are in need of coordinates for a country unsupported by Geonames and Google Maps APIs you can build your own table to look up these locations.
	Usermap enters a new table into the database at its installation where you can store country and postal code of the location in question together
	with its coordinates. If a user selects this combination and you have enabled the use of the internal database in the settings tab Usermap will fetch
	the coordinates to store with this user's data from this table.  
	The content of the table containing all of your manually entered locations with their ISO two uppercase letter country code and postal code as well as
	the corresponding coordinates with latitude and longitude as decimal degrees (e.g. 52.589°) is displayed at this tab's top. In the options column you
	find a link to delete the selected entry in case you no longer need it.  
	Underneath that table you can input new locations. Each combination of country and postal code must be unique, entering an already existing combination
	a second time will result in an error message, this input will be rejected.
	
4.  POI handling  
	A Point of Interest (POI) could be any landmark you wish to show to your users. Usermap stores them in a table entered into the database at installation.
	If you have enabled the display of POIs you need to enter the data somewhere, this is the place you are looking for.  
	As with the internal database this tab starts with a table displaying the current content of the database table. Every POI has a name which is displayed
	as a tool tip when the mouse pointer hovers over the icon, a description which is displayed in a popup bubble when the user clicks the icon, an icon file
	which holds the icon with which the POI is marked on the map and a pair of coordinates.  
	Underneath this table you find a form to input new POIs or edit existing POIs. The input fields of this form are pretty selfexplanatory, please note
	that you can use bbcodes (including linking to external web sites) in the description text field.  
	Since the icons are scalable vector graphic (SVG) files it is possible for the administrator to build own graphics or acquire them from the internet.
	If the administrator would like to use additional or other icons (they must be stored in Usermap's `styles/all/theme/images/poi` directory) their size
	and anchor point (the coordinate with the upper left corner as 0,0 counting to the right and downwards within the icon which is centered on the map
	coordinates) must be defined. For this purpose there are two fields to input these settings. Since SVG is a scalable format you can even display indivual
	icons smaller or bigger than others.  
	For the convenience of the users who are using the icons shipped with Usermap the initial values for those icons are already pre-selected.
  
Please note that a basic check is done when you input something in the form fields of the ACP, e.g. the coordinates need a dot as decimal separator but in
countries using a comma as separator it is easy to forget this, Usermap checks for a comma and automatically changes it into a dot. Usermap checks most inputs
respectively and either corrects the input or rejects it by deleting your input in this form field.

### **Permissions**
#### *User permissions*
With ver 0.10.0 a permission system was introduced into Usermap. Most of these permissions deal with user permissions which you will find all together in a
new tab called `Usermap` in ACP's permissions setting. These settings are (in order of their appearance):
+	*Can create a new POI w/o approval*  
	If you want users to be able to create new POIs without any further control by a moderator, grant them this permission. The newly created POI is immediately
	visible on the map.  
	This permission overrides the following permission if both are granted.  
	By default the user role **`All Features`** do have this permission.
+	*Can create a new POI only with moderator approval*  
	If you want to have user created POIs being checked by a moderator before they become a permanent part of the data base (and thus being displayed on the
	map) you grant them this permission. Moderators will get a notification when a new POI has been created.
+	*Can always view the Usermap*  
	Users with this permission can always see the map and its user markers, even if they haven't provided their own location for display. Since they do not
	have one, they are not permitted to search for other users around their own location.  
	Be aware that this includes the display of links to user profiles! If you do not want these users to see user profiles through a Usermap link you are
	strongly advised to check and limit the permissions to view user profiles!  
	By default the user role **`All Features`** do have this permission.
+	*Can view the Usermap only if listed on the map*  
	Users granted this permission can see the map and use the user search around their own location if they provided the necessary data (country and postal
	code of their own location). If they have not provided their own (valid) data those users will still see a `You are not authorized to see the user map.`
	message.
+	*Can view POIs*  
	Users can view the POIs on the map after you granted them this permission. This permission is a prerequisit for users to be able to create POIs.  
	By default the user role **`All Features`** do have this permission.
  
Concerning permissions please keep in mind that
1.	users will see the link to the Usermap ONLY if they have one of the three *view* permissions mentioned above, e.g. if you grant the guest group the
	permission to view the POIs every guest can see and follow the link to the Usermap.
2.	all user permissions regarding POIs only apply when the display of POIs is enabled in the ACP and
3.	the two permissions regarding the creation of POIs by a user only apply if the user is permitted to see the POIs (if a user is not permitted to view the
	POIs it really doesn't make any sense to let him create a new one, does it)
  
#### *Administrator and Moderator permissions*
There is one permission each for administrators and moderators which you will find in the respective permission settings page under the `Misc` tab:
+	*Can manage the Usermap* for administrators.  
	This should be pretty self-explanatory, by default full administrators do have this permission.  
	To enable this permission Usermap's ACP tabs will be removed and re-added by two migration files during the enable process.
+	*Can approve user created POIs* for moderators.  
	You should give this permission to all moderator roles you wish to be able to see and approve POIs created by your users (if you enabled your users to
	create POIs which need approval before being displayed on the map). Since moderators had no role in Usermap until now this will work initially.  
	By default full moderators do have this permission.
	
  
### **Icons**
The usage of Usermap makes it necessary to be familiar with icons, especially if used as markers on a map and as SVG (Scalabale Vector Graphics) icons.
To keep this file as simple as possible please refer to [Excursus on icons](./docs/ICONS.md) for more information about SVG marker icons and their usage.
  
### **Requirements**

As mentioned above a (free) account with *[geonames.org][]* is mandatory and if you choose to additionally use Google Maps you need to set up an account
with the *[Google Maps API][]* as well, links are provided within the `ACP Settings` tab of Usermap.  
In order to display member profiles and POI markers as intended it is crucial that the values `Server protocol`, `Domain name` and `Script path` (the last
one only if your board's root is within a subdirectory of the path your domain name points to) are properly set. If you experience any difficulties displaying
the POI markers or the member profiles through the postal code search please check the above mentioned values in the `ACP -> General -> Server Configuration`
tab.

[geonames.org]: http://www.geonames.org
[download link]: https://www.mike-on-tour.com/mot/mot_usermap.php
[Google Maps API]: https://developers.google.com/maps/documentation/javascript/get-api-key 
