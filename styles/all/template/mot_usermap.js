/**
*
* package Usermap v1.1.2
* copyright (c) 2020 - 2021 Mike-on-Tour
* license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

(function($) {  // Avoid conflicts with other libraries

'use strict';

/*
* Check whether a user created POI has a name and if not, go back to the name input
*/
$("#poi_edit").submit(function() {
	if ($("#usermap_poi_name").val() == '') {
		alert(motUsermap.errorMsg);
		$("#usermap_poi_name").focus();
		return (false);
	}
});

/*
* Changes the POI name (tooltip)
*/
$("#usermap_poi_name").blur(function() {
	var name = $(this).val();
	motUsermap.boxMarker.unbindTooltip();
	if (name != '') {
		motUsermap.boxMarker.bindTooltip(name);
	}
});

/*
* Change the popup after editing the text
*/
$("#usermap_poi_popup").blur(function() {
	var popupString = $(this).val();
	var html = bbcodeParser.bbcodeToHtml(popupString);
	var popup = motUsermap.boxMarker.getPopup();
	if ((typeof popup == 'undefined') && (html != '')) {
		motUsermap.boxMarker.bindPopup(html);
	}
	if (html != '') {
		motUsermap.boxMarker.bindPopup(html);
	}
	if (html == '') {
		motUsermap.boxMarker.unbindPopup();
	}
});

/*
* Set the POI icon select field to the default icon of the selected layer
*/
$("#usermap_poi_layer").change(function() {
	$("#usermap_poi_icon").val(motUsermap.jsPoiLayers[$(this).prop('selectedIndex')]['default_icon']).change();
});

/*
*  Change the POI icon image when the field gets changed
*/
$("#usermap_poi_icon").change(function() {
	motUsermap.markerIconOptions = {
		iconUrl:	motUsermap.poiIconPath + $(this).val(),
		iconSize:	motUsermap.defaultPoiIconSize.split(","),
		iconAnchor:	motUsermap.defaultPoiIconAnchor.split(","),
	}
	motUsermap.markerIcon = new L.icon(motUsermap.markerIconOptions);
	motUsermap.boxMarker.setIcon(motUsermap.markerIcon);
});

/* ---------------------------------------------------------------------------------------	Event handlers for search forms	--------------------------------------------------------------------------------------- */
// Event handler for plz search field
$("#plz_search").submit(function(evt) {
	motUsermap.getSurroundingUsers();
	evt.preventDefault();
});

// Event handler for member search field
$("#membername_search").submit(function(evt) {
	motUsermap.searchUserByName();
	evt.preventDefault();
});

// Event handler for POI search field
$("#poi_search").submit(function(evt) {
	motUsermap.searchPoiByName();
	evt.preventDefault();
});

// Event handler for address search field
$("#address_search_button").click(function(evt) {
	var address = $("#address_choice").val().toLowerCase();
	$(this).blur();
	$.post(motUsermap.jsAjaxCall,
			{address: address},
			function(result) {
				if (result['success']) {
					var lat = parseFloat(result['lat']);
					var lng = parseFloat(result['lng']);
					$("#seperation_hr").html('<hr>' + motUsermap.jsAddressResult + '<br>');
					L.marker([lat, lng]).addTo(motUsermap.map);
					motUsermap.jumpTo(motUsermap.map, lat, lng, 13);
				} else {
					$("#seperation_hr").html('<hr>' + motUsermap.jsAddressNoResult);
				}
			}
	);
	evt.preventDefault();
});

/* --------------------------------------------------------------------------------------- 	Search functions	--------------------------------------------------------------------------------------- */

/*
* Jump to a given location on the map and display it with the given zoom
*
* @params	object	map	the map object to be used
*		decimal	lat	latitude of the map center
*		decimal	lng	longitude of the map center
*		integer	zoom	map zoom factor
*
* @return	none
*/
motUsermap.jumpTo = function(map, lat, lng, zoom) {
	var latlng = new L.latLng(lat, lng);
	map.setView(latlng, zoom);
}

motUsermap.distanceInKm = function(lat1, lon1, lat2, lon2) {
	var lat = ((lat1 + lat2) / 2) * 0.01745;
	var dx = 111.3 * Math.cos(lat) * (lon1 - lon2);
	var dy = 111.3 * (lat1 - lat2)
	var distance = Math.sqrt((dx * dx) + (dy * dy));

	return Math.abs(distance);
}

motUsermap.getSurroundingUsers = function() {
	var currentUser = motUsermap.jsCurrentUser.split("|");
	var userID = currentUser[0];
	var userPLZ = currentUser[2];
	var userLat = parseFloat(currentUser[3]);
	var userLng = parseFloat(currentUser[4]);
	var jDistance;
	var umRadius = $("#plz_choice").val();
	var outPut = '<ul class="links">';
	var j = 0;
	var userData;
	var searchResult = new Array();

	$("#plz_search_button").blur();
	while (j < memberDataLength) {
		userData = motUsermap.jsMemberData[j];
		var userResult = new Array();
		jDistance = this.distanceInKm(userLat, userLng, parseFloat(userData['user_lat']), parseFloat(userData['user_lng']));
		if ((userID != userData['user_id']) && (jDistance <= umRadius)) {
			userResult.push(userData['username']);
			userResult.push(userData['user_colour']);
			userResult.push(parseInt(jDistance, 10));
			userResult.push(userData['user_id']);
			searchResult.push(userResult);
		}
		j++;
	}

	searchResult.sort(function(a, b){
		return a[2] - b[2];
	});

	var len = searchResult.length;
	for (i = 0; i < len; i++) {
		if (outPut != '<ul class="links">') {
			outPut = outPut + ', ';
		}
		outPut = outPut + '<li><a class="username-coloured" href="' + motUsermap.jsProfileLink + '&u=' + searchResult[i][3] + '" target="_blank">'
						+ '<span style="color:#' + searchResult[i][1] + ';">'
						+ searchResult[i][0] + '</span></a></li>'
						+ ': '
						+ searchResult[i][2] + motUsermap.jsMapKm;
	}
	outPut = outPut + '</ul>';

	if (outPut != '<ul class="links"></ul>') {
		$("#seperation_hr").html('<hr>' + motUsermap.jsMapResult + '<br>');
		$("#solution").html(outPut);
	} else {
		$("#seperation_hr").html('<hr>' + motUsermap.jsMapNoResult + umRadius + motUsermap.jsMapKm);
		$("#solution").html('');
	}
	this.jumpTo(this.map, userLat, userLng, this.zoomFactor[umRadius]);
}

/*
* Searches for user and POI names matching needle including wildcard '*'
*
* @params:	string	needle	string to be found, can include one or two wildcard characters '*', more than two will be handled as two
*		string	haystack	string to be searched
*
* @return	boolean	true if haystack contains or is identical to needle, false in all other cases
*/
motUsermap.searchRegEx = function(needle, haystack) {
	var returnValue = false;
	var matches = new Array();
	var result;
	var regex = /\*/g;

	// Escape parenthesis and the like
	needle = needle.replace(/\(/g, "\\(");
	needle = needle.replace(/\)/g, "\\)");

	while ((result = regex.exec(needle)) !== null) {
		matches.push(result.index);
	}

	// delete all wildcards from needle
	var needleBlank = needle.replace(/\*/g, "");

	var mLen = matches.length;
	switch (mLen) {
		case 0:
			if (needle == haystack) {
				returnValue = true;
			}
			break;

		case 1:
			if (matches[0] == 0) {
				var re = new RegExp('^[\\d*\\W*\\w*-_ ]+' + needleBlank);
			}

			if (matches[0] == needle.length - 1) {
				var re = new RegExp(needleBlank + '[\\d*\\W*\\w*-_ ]+');
			}

			var found = haystack.match(re);
			if (found != null) {
				returnValue = true;
			}
			break;

		case 2:
		default:
			var re = new RegExp('^[\\d*\\W*\\w*-_ ]+' + needleBlank + '[\\d*\\W*\\w*-_ ]+');

			var found = haystack.match(re);
			if (found != null) {
				returnValue = true;
			}
			break;
	}
	return returnValue;
}

/*
* Function called as the link from a member name from the search result to display the selected member. It centers on the given location, zooms into the map by a factor of 13 and activates the layer group this member belongs to
*
* @params	float	lat		latitude of the member's geographical location
*		float	lng		longitude of the member's geographical location
*		int	layer_id	Id of the layer group this member belongs to
*/
motUsermap.goToUser = function(lat, lng, layer_id) {
	layersLength = motUsermap.jsMemberLayers.length;
	for (var i = 0; i < layersLength; i++) {
		if (motUsermap.jsMemberLayers[i]['layer_id'] == layer_id) {
			motUsermap.jsMemberLayers[i]['layer_group'].addTo(this.map);
		}
	}
	this.jumpTo(this.map, parseFloat(lat), parseFloat(lng), 13);
}

/*
* Function to search for members by name. Usage of wildcard '*' is permitted. Members matching the search string are listed as links by name, sort order is by user_id ascending.
* Clicking on a name (link) centers the map onto the respective member marker and zooms into the map, the layer group this meber belongs to is added to the map (see function goToUser())
*/
motUsermap.searchUserByName = function() {
	var userName = $("#member_choice").val().toLowerCase();
	var outPut = '<ul class="username-coloured links">';
	var j = 0;
	var userResult;
	var searchResult = new Array();

	$("#membername_search_button").blur();
	while (j < memberDataLength) {
		userResult = new Array();
		if (this.searchRegEx(userName, this.jsMemberData[j]['username'].toLowerCase())) {
			userResult.push(this.jsMemberData[j]['user_id']);
			userResult.push(this.jsMemberData[j]['username']);
			userResult.push(this.jsMemberData[j]['user_colour']);
			userResult.push(this.jsMemberData[j]['user_lat']);
			userResult.push(this.jsMemberData[j]['user_lng']);
			userResult.push(this.jsMemberData[j]['layer_id']);
			searchResult.push(userResult);
		}
		j++;
	}

	// Sort result by user_id ascending
	searchResult.sort(function(a, b){
		return a[0] - b[0];
	});

	var len = searchResult.length;
	for (i = 0; i < len; i++) {
		if (outPut != '<ul class="username-coloured links">') {
			outPut = outPut + ', ';
		}
		outPut = outPut + '<li onclick="motUsermap.goToUser(' + searchResult[i][3] + ', ' + searchResult[i][4] + ', ' + searchResult[i][5] + ');"><a><span style="color:#' + searchResult[i][2] + ';">'
						+ searchResult[i][1] + '</span></a></li>';
	}
	outPut = outPut + '</ul>';

	if (outPut != '<ul class="username-coloured links"></ul>') {
		$("#seperation_hr").html('<hr>' + motUsermap.jsMemberResult + '<br>');
		$("#solution").html(outPut);
	} else {
		$("#seperation_hr").html('<hr>' + motUsermap.jsMemberNoResult);
		$("#solution").html('');
	}
}

/*
* Function called as the link from a POI name from the search result to display the selected POI. It centers on the given location, zooms into the map by a factor of 13 and activates the layer group this POI belongs to
*
* @params	float	lat		latitude of the POI's geographical location
*		float	lng		longitude of the POI's geographical location
*		int	layer_id	Id of the layer group this POI belongs to
*/
motUsermap.goToPoi = function(lat, lng, layer_id) {
	layersLength = this.jsPoiLayers.length;
	for (var i = 0; i < layersLength; i++) {
		if (this.jsPoiLayers[i]['layer_id'] == layer_id) {
			this.jsPoiLayers[i]['layer_group'].addTo(this.map);
		}
	}
	this.jumpTo(this.map, parseFloat(lat), parseFloat(lng), 13);
}

/*
* Function to search for POIs by name. Usage of wildcard '*' is permitted. POIs matching the search string are listed as links by name, sort order is by poi_id ascending.
* Clicking on a name (link) centers the map onto the respective POI marker and zooms into the map, the layer group this POI belongs to is added to the map (see function goToPoi())
*/
motUsermap.searchPoiByName = function() {
	var poiName = document.getElementById('poi_choice').value.toLowerCase();
	var outPut = '<ul class="username-coloured links">';
	var j = 0;
	var poiResult;
	var searchResult = new Array();

	document.getElementById('poi_search_button').blur();
	while (j < poiDataLength) {
		poiResult = new Array();
		if (this.jsPoiData[j]['disabled'] == 0 && this.searchRegEx(poiName, this.jsPoiData[j]['name'].toLowerCase())) {
			poiResult.push(this.jsPoiData[j]['poi_id']);
			poiResult.push(this.jsPoiData[j]['name']);
			poiResult.push(this.jsPoiData[j]['lat']);
			poiResult.push(this.jsPoiData[j]['lng']);
			poiResult.push(this.jsPoiData[j]['layer_id']);
			searchResult.push(poiResult);
		}
		j++;
	}

	var len = searchResult.length;
	for (i = 0; i < len; i++) {
		if (outPut != '<ul class="username-coloured links">') {
			outPut = outPut + ', ';
		}
		outPut = outPut + '<li onclick="motUsermap.goToPoi(' + searchResult[i][2] + ', ' + searchResult[i][3] + ', ' +  searchResult[i][4] + ');"><a>'
						+ searchResult[i][1] + '</a></li>';
	}
	outPut = outPut + '</ul>';

	if (outPut != '<ul class="username-coloured links"></ul>') {
		$("#seperation_hr").html('<hr>' + motUsermap.jsPoiResult + '<br>');
		$("#solution").html(outPut);
	} else {
		$("#seperation_hr").html('<hr>' + motUsermap.jsPoiNoResult);
		$("#solution").html('');
	}
}

/* ---------------------------------------------------------------------------------------	Function to display member and POI markers	--------------------------------------------------------------------------------------- */
/*
*	Adds a new user marker to the map
*
*	@params	L.layerGroup	myLayerGroup	layer object to which this marker is to be added
*			decimal		lat			the marker's latitude
*			decimal		lng			the marker's longitude
*			string		colour		the user's default group colour to fill the marker
*			string		myName		the user's name to be displayed with a tooltip while resting the mouse pointer on it and in the popup as link to the profile
*			string		myId			the user's user_id  to generate the lnk to the profile
*			integer		circleRadius	the marker's radius in pixels
*
*	@return	none
*/
motUsermap.addUserLayer = function(myLayerGroup, lat, lng, colour, myName, myId, circleRadius) {
	var circleMarkerOptions = {
		radius:			circleRadius,
		color:			'black',
		weight:			1,
		opacity:		1.0,
		fillColor:		colour,
		fillOpacity:	1.0,
	}
	var circleMarker = new L.circleMarker([lat, lng], circleMarkerOptions);
	circleMarker.bindTooltip(myName);
	circleMarker.bindPopup('<a href="' + motUsermap.jsProfileLink + '&u=' + myId + '" target="_blank">'+ myName + '</a>');
	myLayerGroup.addLayer(circleMarker);
}

/*
*	Adds a POI marker to the map layer
*
*	@params	L.layerGroup	myLayerGroup	layer object to which this marker is to be added
*			string		myIconPath		relative path to the icon file
*			decimal		lat			the marker's latitude
*			decimal		lng			the marker's longitude
*			string		myName		the POI name to be displayed with a tooltip while resting the mouse pointer on it
*			string		myPopup		POI description to be displayed in a popup
*			array (x, y)		myIconSize	size of the icon image in pixels
*			array (x, y)		myIconAnchor	coordinates of the "tip" of the icon (relative to its top left corner), icon will be aligned so that this point is at the marker's geographical location
*
*	@return	none
*/
motUsermap.addPoiLayer = function(myLayerGroup, myIconPath, lat, lng, myName, myPopup, myIconSize, myIconAnchor) {
	var iconOptions = {
		iconUrl:	myIconPath,
		iconAnchor:	myIconAnchor.split(","),
		iconSize:	myIconSize.split(","),
	}
	var customIcon = L.icon(iconOptions);
	var markerOptions = {
		title:		myName,
		clickable:	true,
		draggable:	false,
		icon: customIcon
	}
	var marker = new L.Marker([lat, lng], markerOptions);
	if (myPopup != '') {
		marker.bindPopup(myPopup);
	}
	myLayerGroup.addLayer(marker);
}

/* ---------------------------------------------------------------------------------------	main functions	---------------------------------------------------------------------------------------  */

motUsermap.zoomFactor = new Array();
motUsermap.zoomFactor[1] = 13;
motUsermap.zoomFactor[2] = 13;
motUsermap.zoomFactor[5] = 12;
motUsermap.zoomFactor[10] = 11;
motUsermap.zoomFactor[25] = 10;
motUsermap.zoomFactor[50] = 9;
motUsermap.zoomFactor[100] = 8;

var userAgent = navigator.userAgent.toLowerCase();
if(userAgent.match('iphone') || userAgent.match('android') || userAgent.match('windows phone')) {
	motUsermap.markerRadius = motUsermap.jsMapConfig['radiusMobile'];
} else {
	motUsermap.markerRadius = motUsermap.jsMapConfig['radiusPC'];
}

motUsermap.mapOptions = {
	center: [motUsermap.jsMapConfig['Lat'], motUsermap.jsMapConfig['Lng']],
	zoom: motUsermap.jsMapConfig['Zoom'],
	attributionControl: false,
	scrollWheelZoom: false,
}

motUsermap.map = new L.map('map_container', motUsermap.mapOptions);

motUsermap.map.on('click', function() {
	if (motUsermap.map.scrollWheelZoom.enabled()) {
		motUsermap.map.scrollWheelZoom.disable();
	}
	else {
		motUsermap.map.scrollWheelZoom.enable();
	}
});

motUsermap.layer = new L.TileLayer('https://\{s\}.tile.openstreetmap.org/\{z\}/\{x\}/\{y\}.png');	// International map colors
//	motUsermap.layer = new L.TileLayer('https://\{s\}.tile.openstreetmap.de/\{z\}/\{x\}/\{y\}.png');	// German map colors
motUsermap.topoLayer = new L.TileLayer('https://\{s\}.tile.opentopomap.org/\{z\}/\{x\}/\{y\}.png');	// Topo map
motUsermap.satLayer = new L.TileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/\{z\}/\{y\}/\{x\}');

motUsermap.map.addLayer(motUsermap.layer);

motUsermap.baseMap = {
	[motUsermap.jsStreetDesc]	: motUsermap.layer,
	[motUsermap.jsTopoDesc]	: motUsermap.topoLayer,
	[motUsermap.jsSatDesc]		: motUsermap.satLayer,
}

motUsermap.attribution = new L.control.attribution().addAttribution('Map Data &copy; <a href="https://www.openstreetmap.org/copyright" target=_blank">OpenStreetMap</a>').addTo(motUsermap.map);

motUsermap.scale = new L.control.scale({imperial: false}).addTo(motUsermap.map);

var userOverlays = {};
var layersLength;

// prepare the layer with user locations, skip this for performance reasons if we have a user not in the map and poi display is permitted (no user locations are displayed in this case, so no need to waste time)
if (motUsermap.jsAuthUser || motUsermap.jsMapViewAlways && motUsermap.jsMemberLayers.length > 0) {
	var i;
	var memberDataLength = motUsermap.jsMemberData.length;								// get the number of user markers in the list
	var l = 0;
	layersLength = motUsermap.jsMemberLayers.length;

	while (l < layersLength) {
		motUsermap.jsMemberLayers[l]['layer_group'] = new L.layerGroup();
		userOverlays[motUsermap.jsMemberLayers[l]['layer_lang_var']] = motUsermap.jsMemberLayers[l]['layer_group'];
		i = 0;
		while (i < memberDataLength) {											// show all user markers on the map
			motUsermap.addUserLayer(motUsermap.jsMemberLayers[l]['layer_group'], parseFloat(motUsermap.jsMemberData[i]['user_lat']), parseFloat(motUsermap.jsMemberData[i]['user_lng']), '#' + motUsermap.jsMemberData[i]['user_colour'], motUsermap.jsMemberData[i]['username'], motUsermap.jsMemberData[i]['user_id'], motUsermap.markerRadius);
			i++;
		}

		if (motUsermap.jsMemberLayers[l]['show_layer'] == 1) {
			motUsermap.jsMemberLayers[l]['layer_group'].addTo(motUsermap.map);
		}
		l++;
	}
}

// prepare the layers with POI locations (if there are any and POIs are enabled and permitted to see)
if (motUsermap.jsPoiEnabled && motUsermap.jsPoiView && motUsermap.jsPoiLayers.length > 0) {
	var i;
	var poiDataLength = motUsermap.jsPoiData.length;
	var poiIconPath = '';

	var l = 0;
	layersLength = motUsermap.jsPoiLayers.length;

	while (l < layersLength) {
		motUsermap.jsPoiLayers[l]['layer_group'] = new L.layerGroup();
		userOverlays[motUsermap.jsPoiLayers[l]['layer_lang_var']] = motUsermap.jsPoiLayers[l]['layer_group'];
		i = 0;

		while (i < poiDataLength) {
			if (motUsermap.jsPoiData[i]['layer_id'] == motUsermap.jsPoiLayers[l]['layer_id'] && motUsermap.jsPoiData[i]['lat'] != '' && motUsermap.jsPoiData[i]['lng'] != '' && motUsermap.jsPoiData[i]['icon'] != '') { // the latter three to prevent the script from crashing through empty values
				motUsermap.addPoiLayer(motUsermap.jsPoiLayers[l]['layer_group'], motUsermap.poiIconPath + motUsermap.jsPoiData[i]['icon'], parseFloat(motUsermap.jsPoiData[i]['lat']), parseFloat(motUsermap.jsPoiData[i]['lng']), motUsermap.jsPoiData[i]['name'], motUsermap.jsPoiData[i]['popup'], motUsermap.jsPoiData[i]['icon_size'], motUsermap.jsPoiData[i]['icon_anchor']);
			}
			i++;
		}

		if (motUsermap.jsPoiLayers[l]['show_layer'] == 1) {
			motUsermap.jsPoiLayers[l]['layer_group'].addTo(motUsermap.map);
		}
		l++;
	}
}

if (!(motUsermap.jsAuthUser || motUsermap.jsMapViewAlways) && motUsermap.jsPoiEnabled && motUsermap.jsPoiView) {
	// Display first POI layer as default if nothing else is displayable
	motUsermap.jsPoiLayers[0]['layer_group'].addTo(motUsermap.map);
}

motUsermap.layerControl = new L.control.layers(motUsermap.baseMap, userOverlays).addTo(motUsermap.map);

/* ---------------------------------------------------------------------------------------	Functions for the modal POI input	--------------------------------------------------------------------------------------- */
/*
*	Get a new marker position by right clicking on the map and open modal box to edit the properties
*/
motUsermap.modalBox = function(poiPos) {
	let modal = document.querySelector("#poi_modal");
	let poiLat = document.querySelector("#usermap_poi_lat");
	let poiLng = document.querySelector("#usermap_poi_lng");

	poiLat.value = poiPos.lat;
	poiLng.value = poiPos.lng;

	window.onclick = function(e){
		if(e.target == modal){
			modal.style.display = "none"
		}
	};

	$(document).keydown(function(event) {
		if (event.keyCode == 27) {
			modal.style.display = "none"
		}
	});

	modal.style.display = "block";

	var mapOptions = {
		center: poiPos,
		zoom: 16,
		attributionControl: false,
		scrollWheelZoom: false,
	};

	var boxMap = new L.map('map_box', mapOptions);

	boxMap.on('click', function() {
		if (boxMap.scrollWheelZoom.enabled()) {
			boxMap.scrollWheelZoom.disable();
		}
		else {
			boxMap.scrollWheelZoom.enable();
		}
	});

	var boxLayer = new L.TileLayer('https://\{s\}.tile.openstreetmap.org/\{z\}/\{x\}/\{y\}.png');	// International map colors
	boxMap.addLayer(boxLayer);

	var boxScale = new L.control.scale({imperial: false}).addTo(boxMap);

	// Add marker
	var boxMarkerOptions = {
		draggable:	true,
		autoPan:	true,
	};
	motUsermap.boxMarker = new L.Marker(poiPos, boxMarkerOptions);

	motUsermap.boxMarker.on('move', function (evt) {
		var curPos = evt.latlng;
		poiLat.value = curPos.lat;
		poiLng.value = curPos.lng;
	});

	motUsermap.boxMarker.addTo(boxMap);

}

/*
*	If POIs are generally enabled and the user can view them and the user can create a new one this function will be available
*/
if (motUsermap.jsPoiEnabled && motUsermap.jsPoiView && motUsermap.jsPoiCreate) {
	motUsermap.poiLatLng = new L.latLng;

	motUsermap.map.addEventListener('contextmenu', function (evt) {
		motUsermap.poiLatLng.lat = evt.latlng.lat;
		motUsermap.poiLatLng.lng = evt.latlng.lng;
		motUsermap.modalBox(motUsermap.poiLatLng);
	});
}

})(jQuery); // Avoid conflicts with other libraries
