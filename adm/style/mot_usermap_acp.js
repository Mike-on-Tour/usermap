/**
*
* package Usermap v1.3.0
* copyright (c) 2020 - 2025 Mike-on-Tour
* license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

(function($) {  // Avoid conflicts with other libraries

'use strict';

/*
* Checks whether the fields for the geonames.org username and the google maps API key are empty when the form is sent. In this case we provide an error message and give the focus back to the respective field
* @params:	mainErrorMsg1, mainErrorMsg2:	string with the error message, provided by the language object
*
* @return:	false if field is empty to prevent the form from being sent
*/
$("#acp_usermap_settings").submit(function() {
	if ($("#mot_usermap_geonamesuser").val() ==	'') {
		alert(motUsermap.mainErrorMsg1);
		$("#mot_usermap_geonamesuser").focus();
		return (false);
	}

	if (($("input[name='mot_usermap_google_enable']:checked").val() == 1) && ($("#mot_usermap_google_key").val() == '')) {
		alert(motUsermap.mainErrorMsg2);
		$("#mot_usermap_google_key").focus();
		return (false);
	}
});

/*
* Checks the value of the latitude input element with a regular expression to make certain we get the value we want
*
* @return:	writes either the default value or - if it matches the pattern and is within the boundaries - the given value into the DOM element's value
*/
$("#mot_usermap_lat,#mot_usermap_poi_lat,#mot_usermap_database_lat").blur(function() {
	var elementValue = $(this).val();
	elementValue = elementValue.replace(/[,]/g, ".");	// replace a comma with a fullstop in case some European hit the key on the num pad
	var result = elementValue.match(/-?\d{1,2}\.*\d*/);	// is this like (-)dd.d(ddd)?
	if ((result == null) || (result[0] < -90.0) || (result[0] > 90.0)) {
		elementValue = 0;
	} else {
		elementValue = result[0];
	}
	$(this).val(elementValue);
});

/*
* Checks the value of the longitude input element with a regular expression to make certain we get the value we want
*
* @return:	writes either the default value or - if it matches the pattern and is within the boundaries - the given value into the DOM element's value
*/
$("#mot_usermap_lon,#mot_usermap_poi_lon,#mot_usermap_database_lon").blur(function() {
	var elementValue = $(this).val();
	elementValue = elementValue.replace(/[,]/g, ".");	// replace a comma with a fullstop in case some European hit the key on the num pad
	var result = elementValue.match(/-?\d{1,3}\.*\d*/);	// is this like (-)ddd.d(ddd)?
	if ((result == null) || (result[0] < -180.0) || (result[0] > 180.0)) {
		elementValue = 0;
	} else {
		elementValue = result[0];
	}
	$(this).val(elementValue);
});

/*
* Cleans the geonames.org username of some superfluous characters
*/
$("#mot_usermap_geonamesuser").blur(function() {
	var elementValue = $(this).val();
	if (elementValue != '') {
		elementValue = elementValue.replace(/[;:-]/g, ",");			// replace some characters with a comma (in case someone fooled while typing) (dashes are not allowed in Geonames user names)
		elementValue = elementValue.replace(/,{2,}/g, ",");			// delete multiple commas,
		elementValue = elementValue.replace(/^,*/, "");				// erase all leading commas
		elementValue = elementValue.replace(/,*$/, "");				// erase all trailing commas
		$(this).val(elementValue);
	}
});

/*
* Cleans the country list (list of country codes) for which the Google search is enforced, should be only uppercase letters seperated by commas
*/
$("#mot_usermap_google_force").blur(function() {
	var elementValue = $(this).val();
	if (elementValue != '') {
		elementValue = elementValue.toUpperCase();
		elementValue = elementValue.replace(/[^,A-Z]/g, "");		// delete all characters which are not either a uppercase letter or a comma
		elementValue = elementValue.replace(/[A-Z]{3,}/g, "");		// delete all uppercase letters grouped in more than two letters
		elementValue = elementValue.replace(/,{2,}/g, ",");			// delete multiple commas,
		elementValue = elementValue.replace(/^,*/, "");				// erase all leading commas
		elementValue = elementValue.replace(/,*$/, "");				// erase all trailing commas
		$(this).val(elementValue);
	}
});

/*
* Checks whether the input fields for the internal data base are empty when the form is sent. In this case we provide an error message and give the focus back to the respective field
*
* @return:	false if field is empty to prevent the form from being sent
*/
$("#acp_usermap_database").submit(function() {
	if ($("#mot_usermap_database_cc").val() == '') {
		alert(motUsermap.databaseError);
		$("#mot_usermap_database_cc").focus();
		return (false);
	}

	if ($("#mot_usermap_database_zc").val() == '') {
		alert(motUsermap.databaseError);
		$("#mot_usermap_database_zc").focus();
		return (false);
	}

	if ($("#mot_usermap_database_lat").val() == '') {
		alert(motUsermap.databaseError);
		$("#mot_usermap_database_lat").focus();
		return (false);
	}

	if ($("#mot_usermap_database_lon").val() == '') {
		alert(motUsermap.databaseError);
		$("#mot_usermap_database_lon").focus();
		return (false);
	}
});

/*
* Checks whether the input field for country code matches the defined pattern and is not empty
*
* @return:	Sets the value according to the search pattern or an error message
*/
$("#mot_usermap_database_cc").blur(function() {
	var elementValue = $(this).val();
	elementValue = elementValue.toUpperCase();
	var result = elementValue.match(/[A-Z]{2}/);
	if (result != null) {
		$(this).val(elementValue);
	} else {
		$(this).val('');
		alert(motUsermap.databaseErrorCC);
	}
});

/*
* Checks whether the input field for postal code matches the defined pattern and is not empty
*
* @return:	Sets the value according to the search pattern or an error message
*/
$("#mot_usermap_database_zc").blur(function() {
	var elementValue = $(this).val();
	elementValue = elementValue.replace(/[ ]/g, "");	// delete all spaces
	elementValue = elementValue.toUpperCase();
	var result = elementValue.match(/[A-Z0-9\-]+/);		// Uppercase letters, digits and hyphens (dash) only
	if (result != null) {
		$(this).val(elementValue);
	} else {
		$(this).val('');
		alert(motUsermap.databaseErrorZC);
	}
});

/*
* Checks whether any of the important input fields for a POI created or edited in the ACP is empty. If an empty field is encountered the form will not be submitted and the empty field receives the focus.
*
* @return:	false if field is empty to prevent the form from being sent
*/
$("#acp_usermap_poi").submit(function() {
	if ($("#mot_usermap_poi_name").val() == '') {
		alert(motUsermap.poiErrorNoName);
		$("#mot_usermap_poi_name").focus();
		return (false);
	}

	if ($("#mot_usermap_poi_lat").val() == '') {
		alert(motUsermap.poiErrorNoLat);
		$("#mot_usermap_poi_lat").focus();
		return (false);
	}

	if ($("#mot_usermap_poi_lon").val() == '') {
		alert(motUsermap.poiErrorNoLng);
		$("#mot_usermap_poi_lon").focus();
		return (false);
	}
});

/*
* Set the POI icon select field to the default icon of the selected layer
*/
$("#mot_usermap_poi_layer").change(function() {
	$("#mot_usermap_poi_icon").val(motUsermap.jsLayersArr[$(this).prop('selectedIndex')]['default_icon']).change();
});

/*
* Submit the form if the layer type of the layer table to be displayed has been changed
*/
$("#mot_usermap_select_layer_type").change(function() {
	$("#layer_select").submit();
});

/*
* Checks whether any of the input fields for a map overlay created or edited in the ACP is empty. If an empty field is encountered the form will not be submitted and the empty field receives the focus.
* In addition this function checks whether the input field for language variables contains only entries complying with the rule (e.g. 'en:My POIs') and whether a variable for the English language exists.
*
*/
$("#acp_usermap_layer").submit(function() {
	// First check if name field is empty
	if ($("#mot_usermap_layer_name").val() == '') {
		alert(motUsermap.layerErrorMsg1);
		$("#mot_usermap_layer_name").focus();
		return (false);
	}

	// Check for empty language variables field
	if ($("#mot_usermap_layer_lang_var").val() == '') {
		alert(motUsermap.layerErrorMsg2);
		$("#mot_usermap_layer_lang_var").focus();
		return (false);
	}

	// Check whether input complies with rules
	var result;
	var isCorrect = true;
	var isEn = false;
	var langVar = $("#mot_usermap_layer_lang_var").val();
	var langVarArr = langVar.split("\n");
	var arrLength = langVarArr.length;
	for (var i = 0; i < arrLength; i++) {
		// check if variable complies with syntax
		result = langVarArr[i].match(/^[a-z_]{2,}:.{1,}/);
		if (result == null) {
			alert(motUsermap.layerErrorMsg3 + langVarArr[i]);
			isCorrect = false;
		}
		// check for English variable since it MUST be present
		result = langVarArr[i].match( /^en:.{1,}/);
		if (result != null) {
			isEn = true;
		}
	}
	if (!isEn) {
		alert(motUsermap.layerErrorMsg4);
	}

	if (!isCorrect || !isEn) {
		$("#mot_usermap_layer_lang_var").focus();
		return (false);
	}
});

})(jQuery); // Avoid conflicts with other libraries

/*
* First replaces some characters with a comma in case somebody hit the wrong key, then erases all characters which are not a digit or a comma, erases all multible, trailing or leading commas
* and checks whether the expression is of 'dd,dd' to make sure we get only two numbers seperated by a comma
*
* @params:	inputName:	string, name of the DOM element we want to check
*		defaultValue: string, the value which gets set if we encounter an invalid input
*
* @return:	a pair of integer numbers seperated by a comma
*/
motUsermap.cleanInput = function(inputName, defaultValue) {
	var pairMatch = /\d{1,2}\,\d{1,2}/;
	var domElement = document.getElementById(inputName);
	var elementValue = domElement.value;
	if (elementValue != '') {
		elementValue = elementValue.replace(/[;:\._-]/g, ",");		// replace some characters with a comma (in case someone fooled while typing)
		elementValue = elementValue.replace(/[^,\d]/g, "");			// erase all characters which are not a digit or a comma
		elementValue = elementValue.replace(/,{2,10}/g, ",");		// erase multiple commas
		elementValue = elementValue.replace(/^,*/, "");				// erase all leading commas
		elementValue = elementValue.replace(/,*$/, "");				// erase all trailing commas
	}
	var result = elementValue.match(pairMatch);
	if (result == null) {
		domElement.value = defaultValue;		// input doesn't match the pattern, we use the default value
	} else {
		domElement.value = result[0];			// input matches th search pattern, we use it
	}
}
