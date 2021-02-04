'use strict';

var poiPos = new L.latLng;

poiPos.lat = jsPoiData['lat'];
poiPos.lng = jsPoiData['lng'];

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

var modMap = new L.map('map_box', mapOptions);

modMap.on('click', function() {
	if (modMap.scrollWheelZoom.enabled()) {
		modMap.scrollWheelZoom.disable();
	}
	else {
		modMap.scrollWheelZoom.enable();
	}
});

var layer = new L.TileLayer('https://\{s\}.tile.openstreetmap.org/\{z\}/\{x\}/\{y\}.png');	// International map colors
var topoLayer = new L.TileLayer('https://\{s\}.tile.opentopomap.org/\{z\}/\{x\}/\{y\}.png');	// Topo map
var satLayer = new L.TileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/\{z\}/\{y\}/\{x\}');

modMap.addLayer(layer);

var attribution = new L.control.attribution().addAttribution('Map Data &copy; <a href="https://www.openstreetmap.org/copyright" target=_blank" rel="noopener noreferrer">OpenStreetMap</a>').addTo(modMap);

var scale = new L.control.scale({imperial: false}).addTo(modMap);

var baseMap = {
	[jsStreetDesc]	: layer,
	[jsTopoDesc]	: topoLayer,
	[jsSatDesc]		: satLayer,
}

var layerControl = new L.control.layers(baseMap, null).addTo(modMap);

var poiSeperator = (jsServerConfig[jsServerConfig.length - 1] == '/') ? '' : '/';
var poiIconPath = jsServerConfig + poiSeperator + 'ext/mot/usermap/styles/all/theme/images/poi/';
var iconOptions = {
	iconUrl:	poiIconPath + jsPoiData['icon'],
	iconAnchor:	jsPoiData['icon_anchor'].split(","),
	iconSize:	jsPoiData['icon_size'].split(","),
}
var customIcon = L.icon(iconOptions);
var markerOptions = {
//	title:		jsPoiData['name'],
	clickable:	true,
	draggable:	true,
	icon: customIcon
}
var marker = new L.Marker(poiPos, markerOptions);

marker.bindTooltip(jsPoiData['name']);

if (jsPoiData['popup'] != '') {
	marker.bindPopup(jsPoiData['popup']);
}

marker.on('move', function (evt) {
	var curPos = evt.latlng;
	poiLat.value = curPos.lat;
	$("#poiLat").load(location.href + " #poiLat" );
	poiLng.value = curPos.lng;
	$("#poiLng").load(location.href + " #poiLng" );
});

marker.addTo(modMap);

/*
*	The following functions change the POI icon while changing properties at approval
*/
function changePoiName(elementId) {
	var name = document.getElementById(elementId).value;
	marker.unbindTooltip();
	if (name != '') {
		marker.bindTooltip(name);
	}
}

function changePoiPopup(elementId) {
	var popupString = document.getElementById(elementId).value;
	var html = bbcodeParser.bbcodeToHtml(popupString);
	var popup = marker.getPopup();
	if ((typeof popup == 'undefined') && (html != '')) {
		marker.bindPopup(html);
	}
	if (html != '') {
		marker.bindPopup(html);
	}
	if (html == '') {
		marker.unbindPopup();
	}
}

function changePoiIcon(iconUrlElement, iconSizeElement, iconAnchorElement) {

	var markerIconOptions = {
		iconUrl:	poiIconPath + document.getElementById(iconUrlElement).value,
		iconSize:	document.getElementById(iconSizeElement).value.split(","),
		iconAnchor:	document.getElementById(iconAnchorElement).value.split(","),
	}
	var markerIcon = L.icon(markerIconOptions);
	marker.setIcon(markerIcon);
}

// Check whether a user created POI has a name and if not, go back to the input
function checkPoiName(errorMsg) {
	var poiName = document.getElementById('usermap_poi_name');
	if (poiName.value == '') {
		alert(errorMsg);
		poiName.focus();
		return (false);
	}
}
