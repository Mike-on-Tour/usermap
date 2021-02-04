'use strict';

// Check whether a user created POI has a name and if not, go back to the input
function checkPoiName(errorMsg) {
	var poiName = document.getElementById('usermap_poi_name');
	if (poiName.value == '') {
		alert(errorMsg);
		poiName.focus();
		return (false);
	}
}


// Event handler for search field
document.getElementById('plz_search').onsubmit = function (evt) {
	getSurroundingUsers();
	evt.preventDefault();
}

/*
*	Adds a new user marker to the map
*
*	@params
*
*	@return	nothing
*/
function addUserLayer(myLayerGroup, lat, lng, colour, myName, myId, circleRadius) {
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
	circleMarker.bindPopup('<a href="' + jsServerConfig + '/memberlist.php?mode=viewprofile&u=' + myId + '" target="_blank">'+ myName + '</a>');
	myLayerGroup.addLayer(circleMarker);
}

/*
*	Adds a POI marker to the map layer
*/
function addPoiLayer(myLayerGroup, iconName, lat, lng, myName, myPopup, myIconSize, myIconAnchor) {
	var iconOptions = {
		iconUrl:	iconName,
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

function jumpTo(map, lat, lng, zoom) {
	var latlng = new L.latLng(lat, lng);
	map.setView(latlng, zoom);
}

function distanceInKm(lat1, lon1, lat2, lon2) {
	var lat = ((lat1 + lat2) / 2) * 0.01745;
	var dx = 111.3 * Math.cos(lat) * (lon1 - lon2);
	var dy = 111.3 * (lat1 - lat2)
	var distance = Math.sqrt((dx * dx) + (dy * dy));

	return Math.abs(distance);
}

function getSurroundingUsers() {
	var currentUser = jsCurrentUser.split("|");
	var userID = currentUser[0];
	var userPLZ = currentUser[2];
	var userLat = parseFloat(currentUser[3]);
	var userLng = parseFloat(currentUser[4]);
	var jDistance;
	var umRadius = document.querySelector("#plz_choice").value;
	var outPut = "";
	var j = 0;
	var userData;
	var searchResult = new Array();
	while (j < mapDataLength) {
		userData = jsMapData[j];
		var userResult = new Array();
		jDistance = distanceInKm(userLat, userLng, parseFloat(userData['user_lat']), parseFloat(userData['user_lng']));
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
		if (outPut != "") { outPut = outPut + ', '; }
		outPut = outPut + '<a href="' + jsServerConfig + '/memberlist.php?mode=viewprofile&u=' + searchResult[i][3] + '" target="_blank">'
						+ '<span style="color:#' + searchResult[i][1] + ';">'
						+ searchResult[i][0] + '</span>' + '</a>'
						+ ': '
						+ searchResult[i][2] + 'km';
	}

	if (outPut != "") {
		document.getElementById('seperation_hr').innerHTML = '<hr>' + jsMapResult + '<br />';
		document.getElementById('solution').innerHTML = outPut;
	} else {
		document.getElementById('seperation_hr').innerHTML = '<hr>' + jsMapNoResult + umRadius + 'km';
		document.getElementById('solution').innerHTML = outPut;
	}
	jumpTo(map, userLat, userLng, zoomFactor[umRadius]);
}

/* -------------------	main functions	--------------  */

var zoomFactor = new Array();
zoomFactor[1] = 13;
zoomFactor[2] = 13;
zoomFactor[5] = 12;
zoomFactor[10] = 11;
zoomFactor[25] = 10;
zoomFactor[50] = 9;
zoomFactor[100] = 8;

var mapConfig, Lat, Lng, Zoom, radiusPC, radiusMobile;	// variables used to initialize the map

mapConfig = jsConfig.split("|");
Lat = parseFloat(mapConfig[0]);
Lng = parseFloat(mapConfig[1]);
Zoom = mapConfig[2];
radiusPC = mapConfig[3];
radiusMobile = mapConfig[4];

var userAgent = navigator.userAgent.toLowerCase();
if(userAgent.match('iphone') || userAgent.match('android') || userAgent.match('windows phone')) {
	var markerRadius = radiusMobile;
} else {
	var markerRadius = radiusPC;
}

var mapOptions = {
	center: [Lat, Lng],
	zoom: Zoom,
	attributionControl: false,
	scrollWheelZoom: false,
}

var map = new L.map('map_container', mapOptions);

map.on('click', function() {
	if (map.scrollWheelZoom.enabled()) {
		map.scrollWheelZoom.disable();
	}
	else {
		map.scrollWheelZoom.enable();
	}
});

var layer = new L.TileLayer('https://\{s\}.tile.openstreetmap.org/\{z\}/\{x\}/\{y\}.png');	// International map colors
//	var layer = new L.TileLayer('https://\{s\}.tile.openstreetmap.de/\{z\}/\{x\}/\{y\}.png');	// German map colors
var topoLayer = new L.TileLayer('https://\{s\}.tile.opentopomap.org/\{z\}/\{x\}/\{y\}.png');	// Topo map
var satLayer = new L.TileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/\{z\}/\{y\}/\{x\}');

map.addLayer(layer);

var attribution = new L.control.attribution().addAttribution('Map Data &copy; <a href="https://www.openstreetmap.org/copyright" target=_blank">OpenStreetMap</a>').addTo(map);

var scale = new L.control.scale({imperial: false}).addTo(map);

// prepare the layer with user locations, skip this for performance reasons if we have a user not in the map and poi display is set to show to all (no user locations are displayed in this case, so no need to waste time)
if (jsAuthUser || jsMapViewAlways) {
	var userLayer = new L.layerGroup();
	var i = 0;
	var userLocation;
	var mapDataLength = jsMapData.length;								// get the number of user markers in the list
	while (i < mapDataLength) {											// show all user markers on the map
		userLocation = jsMapData[i];
		addUserLayer(userLayer, parseFloat(userLocation['user_lat']), parseFloat(userLocation['user_lng']), '#'+userLocation['user_colour'], userLocation['username'], userLocation['user_id'], markerRadius);
		i++;
	}
}

var poiSeperator = (jsServerConfig[jsServerConfig.length - 1] == '/') ? '' : '/';

// prepare the layer with POI locations
if (jsPoiEnabled && jsPoiView) {
	var poiLayer = new L.layerGroup();
	var i = 0;
	var jsIconPath = jsServerConfig + poiSeperator + 'ext/mot/usermap/styles/all/theme/images/poi/';
	var poiLocation;
	var poiIconPath = '';
	var poiDataLength = jsPoiData.length;
	while (i < poiDataLength) {
		poiLocation = jsPoiData[i];
		if (poiLocation['disabled'] != 1 && poiLocation['lat'] != '' && poiLocation['lng'] != '' && poiLocation['icon'] != '') { // the latter three to prevent the script from crashing through empty values
			poiIconPath = jsIconPath + poiLocation['icon'];
			addPoiLayer(poiLayer, poiIconPath, parseFloat(poiLocation['lat']), parseFloat(poiLocation['lng']), poiLocation['name'], poiLocation['popup'], poiLocation['icon_size'], poiLocation['icon_anchor']);
		}
		i++;
	}
}

var baseMap = {
	[jsStreetDesc]	: layer,
	[jsTopoDesc]	: topoLayer,
	[jsSatDesc]		: satLayer,
}

if (jsAuthUser || jsMapViewAlways) {
	userLayer.addTo(map);

	if (jsPoiEnabled && jsPoiView) {
		var userOverlays = {
			[jsUserDesc]	: userLayer,
			[jsPoiDesc]		: poiLayer,
		};
		var layerControl = new L.control.layers(baseMap, userOverlays).addTo(map);
	} else {
		var layerControl = new L.control.layers(baseMap, null).addTo(map);
	}
}

if (!(jsAuthUser || jsMapViewAlways) && jsPoiEnabled && jsPoiView) {
	poiLayer.addTo(map);
	var layerControl = new L.control.layers(baseMap, null).addTo(map);
}

/*
*	Get a new marker position by right clicking on the map and open modal box to edit the properties
*/
function modalBox(poiPos) {
	let modal = document.querySelector(".modal");

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

	var poiLat = document.getElementById('usermap_poi_lat');
	poiLat.value = poiPos.lat;
	var poiLng = document.getElementById('usermap_poi_lng');
	poiLng.value = poiPos.lng;

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
	var boxMarker = new L.Marker(poiPos, boxMarkerOptions);//.addTo(boxMap);

	boxMarker.on('move', function (evt) {
		var curPos = evt.latlng;
		poiLat.value = curPos.lat;
		$("#poiLat").load(location.href + " #poiLat" );
		poiLng.value = curPos.lng;
		$("#poiLng").load(location.href + " #poiLng" );
	});

	boxMarker.addTo(boxMap);

}

/*
*	If POIs are generally enabled and the user can view them and the user can create a new one this function will be available
*/
if (jsPoiEnabled && jsPoiView && jsPoiCreate) {
	var poiLatLng = new L.latLng;

	map.addEventListener('contextmenu', function (evt) {
		poiLatLng.lat = evt.latlng.lat;
		poiLatLng.lng = evt.latlng.lng;
		modalBox(poiLatLng);
	});
}

function mod_poi() {alert('Hier');

}
