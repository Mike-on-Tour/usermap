/**
*
* package Usermap v1.1.0
* copyright (c) 2020 - 2021 Mike-on-Tour
* license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

(function($) {  // Avoid conflicts with other libraries

'use strict';

/* ---------------------------------------------------------------------------------------	Create map	--------------------------------------------------------------------------------------- */

// Get POI coordinates from template and set them for map and in the input fields
motUsermap.poiPos = new L.latLng;

motUsermap.poiPos.lat = motUsermap.jsPoiData['lat'];
motUsermap.poiPos.lng = motUsermap.jsPoiData['lng'];

$("#usermap_poi_lat").val(motUsermap.poiPos.lat);
$("#usermap_poi_lng").val(motUsermap.poiPos.lng);

// Set map options and create map with
motUsermap.mapOptions = {
	center: motUsermap.poiPos,
	zoom: 16,
	attributionControl: false,
	scrollWheelZoom: false,
};

motUsermap.modMap = new L.map('map_box', motUsermap.mapOptions);

motUsermap.modMap.on('click', function() {
	if (motUsermap.modMap.scrollWheelZoom.enabled()) {
		motUsermap.modMap.scrollWheelZoom.disable();
	}
	else {
		motUsermap.modMap.scrollWheelZoom.enable();
	}
});

motUsermap.layer = new L.TileLayer('https://\{s\}.tile.openstreetmap.org/\{z\}/\{x\}/\{y\}.png');	// International map colors
motUsermap.topoLayer = new L.TileLayer('https://\{s\}.tile.opentopomap.org/\{z\}/\{x\}/\{y\}.png');	// Topo map
motUsermap.satLayer = new L.TileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/\{z\}/\{y\}/\{x\}');

motUsermap.modMap.addLayer(motUsermap.layer);

new L.control.attribution().addAttribution('Map Data &copy; <a href="https://www.openstreetmap.org/copyright" target=_blank" rel="noopener noreferrer">OpenStreetMap</a>').addTo(motUsermap.modMap);

new L.control.scale({imperial: false}).addTo(motUsermap.modMap);

motUsermap.baseMap = {
	[motUsermap.jsStreetDesc]	: motUsermap.layer,
	[motUsermap.jsTopoDesc]	: motUsermap.topoLayer,
	[motUsermap.jsSatDesc]		: motUsermap.satLayer,
}

new L.control.layers(motUsermap.baseMap, null).addTo(motUsermap.modMap);

motUsermap.iconOptions = {
	iconUrl:	motUsermap.poiIconPath + motUsermap.jsPoiData['icon'],
	iconAnchor:	motUsermap.jsPoiData['icon_anchor'].split(","),
	iconSize:	motUsermap.jsPoiData['icon_size'].split(","),
}
motUsermap.customIcon = new L.icon(motUsermap.iconOptions);
motUsermap.markerOptions = {
	clickable:	true,
	draggable:	true,
	icon: motUsermap.customIcon
}
motUsermap.marker = new L.Marker(motUsermap.poiPos, motUsermap.markerOptions);

motUsermap.marker.bindTooltip(motUsermap.jsPoiData['name']);

if (motUsermap.jsPoiData['popup'] != '') {
	motUsermap.marker.bindPopup(motUsermap.jsPoiData['popup']);
}

motUsermap.marker.on('move', function (evt) {
	var curPos = evt.latlng;
	$("#usermap_poi_lat").val(curPos.lat);
	$("#usermap_poi_lng").val(curPos.lng);
});

motUsermap.marker.addTo(motUsermap.modMap);

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
* Changes the POI name (tooltip)  at approval
*/
$("#usermap_poi_name").blur(function() {
	var name = $(this).val();
	motUsermap.marker.unbindTooltip();
	if (name != '') {
		motUsermap.marker.bindTooltip(name);
	}
});

/*
* Change the popup after editing the text
*/
$("#usermap_poi_popup").blur(function() {
	var popupString = $(this).val();
	var html = bbcodeParser.bbcodeToHtml(popupString);
	var popup = motUsermap.marker.getPopup();
	if ((typeof popup == 'undefined') && (html != '')) {
		motUsermap.marker.bindPopup(html);
	}
	if (html != '') {
		motUsermap.marker.bindPopup(html);
	}
	if (html == '') {
		motUsermap.marker.unbindPopup();
	}
});

/*
* Set the POI icon select field to the default icon of the selected layer
*/
$("#usermap_poi_layer").change(function() {
	$("#usermap_poi_icon").val(motUsermap.jsPoiLayers[$(this).prop('selectedIndex')]['default_icon']).change();
});

/*
*  Change the POI icon image, size or anchor after the respective field gets changed
*/
$("#usermap_poi_icon, #usermap_poi_icon_size, #usermap_poi_icon_anchor").change(function() {
	motUsermap.markerIconOptions = {
		iconUrl:	motUsermap.poiIconPath + $("#usermap_poi_icon").val(),
		iconSize:	$("#usermap_poi_icon_size").val().split(","),
		iconAnchor:	$("#usermap_poi_icon_anchor").val().split(","),
	}
	motUsermap.markerIcon = new L.icon(motUsermap.markerIconOptions);
	motUsermap.marker.setIcon(motUsermap.markerIcon);
});

/*
* First replaces some characters with a comma in case somebody hit the wrong key, then erases all characters which are not a digit or a comma, erases all multible, trailing or leading commas
* and checks whether the expression is of 'dd,dd' to make sure we get only two numbers seperated by a comma and then writes either the entered value or the default into the input
*
*/
$("#usermap_poi_icon_size, #usermap_poi_icon_anchor").blur(function() {
	var elementValue = $(this).val();
	if (elementValue != '') {
		elementValue = elementValue.replace(/[;:\._-]/g, ",");		// replace some characters with a comma (in case someone fooled while typing)
		elementValue = elementValue.replace(/[^,\d]/g, "");			// erase all characters which are not a digit or a comma
		elementValue = elementValue.replace(/,{2,10}/g, ",");		// erase multiple commas
		elementValue = elementValue.replace(/^,*/, "");				// erase all leading commas
		elementValue = elementValue.replace(/,*$/, "");				// erase all trailing commas
	}
	var result = elementValue.match(/\d{1,2}\,\d{1,2}/);
	if (result == null) {
		if ($(this).attr('id') == 'usermap_poi_icon_size') {
			$(this).val(motUsermap.defaultPoiIconSize);		// input doesn't match the pattern, we use the default value for icon size
		}
		if ($(this).attr('id') == 'usermap_poi_icon_anchor') {
			$(this).val(motUsermap.defaultPoiIconAnchor);		// input doesn't match the pattern, we use the default value for icon anchor
		}
	} else {
		$(this).val(result[0]);			// input matches th search pattern, we use it
	}
});

})(jQuery); // Avoid conflicts with other libraries
