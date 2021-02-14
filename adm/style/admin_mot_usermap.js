'use strict';

/*
* Define the search patterns for lat(itude) as a 2-digit floating point value with a possible leading minus (-)dd.d and for lon(gitude) as a 3-digit value (-)ddd.d
*/
var latMatch = /-?\d{1,2}\.*\d*/;
var lonMatch = /-?\d{1,3}\.*\d*/;
/*
* Define the search patterns for country code (2 uppercase letters) and postal (zip) code
*/
var ccMatch = /[A-Z]+/;
var zipMatch = /[A-Z0-9\-]+/;	// Uppercase letters, digits and hyphens (dash) only

/*
* Checks whether the fields for the geonames.org username and the google maps API key are empty when the form is sent. In this case we provide an error message and give the focus back to the respective field
* @params:	errorMsg1, errorMsg2:	string with the error message, provided by the language object
*
* @return:	false if field is empty to prevent the form from being sent
*/
function chkUsermapEmptyFields(errorMsg1, errorMsg2)
{
	var domElement = document.getElementById('mot_usermap_geonamesuser');
	if (domElement.value ==	'') {
		alert(errorMsg1);
		domElement.focus();
		return (false);
	}

	var domEnableGoogle = document.getElementById('mot_usermap_google_enable');
	domChecked = domEnableGoogle.checked;
	domValue = domEnableGoogle.value;
//	alert(domEnableGoogle.checked + ' / ' + domEnableGoogle.value);
	var domAPIKey = document.getElementById('mot_usermap_google_key');
	if (((domChecked && domValue == 1) || (!domChecked && domValue == 0)) && (domAPIKey.value == '')) {
		alert(errorMsg2);
		domAPIKey.focus();
		return (false);
	}
}

/*
* Checks whether the input fields for the internal data base are empty when the form is sent. In this case we provide an error message and give the focus back to the respective field
* @params:	errorMsg:	string with the error message, provided by the language object
*
* @return:	false if field is empty to prevent the form from being sent
*/
function chkDatabaseEntry(errorMsg)
{
	var domElement = document.getElementById('mot_usermap_database_cc');
	if (domElement.value == '') {
		alert(errorMsg);
		domElement.focus();
		return (false);
	}

	var domElement = document.getElementById('mot_usermap_database_zc');
	if (domElement.value == '') {
		alert(errorMsg);
		domElement.focus();
		return (false);
	}

	var domElement = document.getElementById('mot_usermap_database_lat');
	if (domElement.value == '') {
		alert(errorMsg);
		domElement.focus();
		return (false);
	}

	var domElement = document.getElementById('mot_usermap_database_lon');
	if (domElement.value == '') {
		alert(errorMsg);
		domElement.focus();
		return (false);
	}
}

/*
* Checks the value of an input element with a regular expression to make certain we get the value we want
*
* @params:	inputName:	string, name of the DOM element we want to check
*		matchString: string, contains the pre-defined search pattern
*		defaultValue: value to use in case the provided value isn't valid
*		minValue: lowest value allowed
*		maxValue: highest value allowed
*
* @return:	writes either the default value or - if it matches the pattern and is within the boundaries - th given value into the DOM element's value
*/
function chkUsermapCoords(inputName, matchString, defaultValue, minValue, maxValue)
{
	var domElement = document.getElementById(inputName);
	var elementValue = domElement.value;
	elementValue = elementValue.replace(/[,]/g, ".");	// replace a comma with a fullstop in case some European hit the key on the num pad
	var result = elementValue.match(matchString);
	if (result == null) {
		domElement.value = defaultValue;		// input doesn't match the pattern, we use the default value
	} else {
		if ((result[0] < minValue) || (result[0] > maxValue)) {
			domElement.value = defaultValue;	// input matches the search pattern but is outside the given boundaries, we use the default value
		} else {
			domElement.value = result[0];		// input matches th search pattern und is within the boundaries, we use it
		}
	}
}

/*
* Cleans the geonames.org username of some superfluous charachters
* @params:	inputName:	string with the id of the input text field
*
* @return:	Sets the value of the given field
*/
function cleanUsermapUser(inputName)
{
	var domElement = document.getElementById(inputName);
	var elementValue = domElement.value;
	if (elementValue != '') {
		elementValue = elementValue.replace(/[;:-]/g, ",");			// replace some characters with a comma (in case someone fooled while typing) (dashes are not allowed in Geonames user names)
		elementValue = elementValue.replace(/,{2,}/g, ",");			// delete multiple commas,
		elementValue = elementValue.replace(/^,*/, "");				// erase all leading commas
		elementValue = elementValue.replace(/,*$/, "");				// erase all trailing commas
		domElement.value = elementValue;
	}
}

/*
* Cleans the country list (list of country codes) for which the Google search is enforced, should be only uppercase letters seperated by commas
* @params:	inputName:	string with the id of the input text field
*
* @return:	Sets the value of the given field
*/
function cleanGoogleCountries(inputName)
{
	var domElement = document.getElementById(inputName);
	var elementValue = domElement.value;
	if (elementValue != '') {
		elementValue = elementValue.toUpperCase();
		elementValue = elementValue.replace(/[^,A-Z]/g, "");		// delete all characters which are not either a uppercase letter or a comma
		elementValue = elementValue.replace(/[A-Z]{3,}/g, "");		// delete all uppercase letters grouped in more than two letters
		elementValue = elementValue.replace(/,{2,}/g, ",");			// delete multiple commas,
		elementValue = elementValue.replace(/^,*/, "");				// erase all leading commas
		elementValue = elementValue.replace(/,*$/, "");				// erase all trailing commas
		domElement.value = elementValue;
	}
}

/*
* Checks whether the input fields for country and postal code matches the defined pattern and are not empty
* @params:	inputName:	string, name of the DOM element we want to check
*		matchString: string, contains the pre-defined search pattern
*		errorMsg: string, contains the error message in case the field is empty (which is enforced if the length is <2)
*
* @return:	Sets the value according to the search pattern or an error message
*/
function checkCountryAndZipCode(inputName, matchString, errorMsg)
{
	var domElement = document.getElementById(inputName);
	var elementValue = domElement.value;
	if (elementValue != '') {
		elementValue = elementValue.toUpperCase();
		var result = elementValue.match(matchString);
		if (result != null) {
			domElement.value = (result[0].length > 1 ? result[0] : '');
		} else {
			domElement.value = '';
		}
	}
	if (domElement.value == '') {
		alert(errorMsg);
		domElement.focus();
		return false;
	}
}

/*
* First replaces some characters with a comma in case somebody hit the wrong key, then erases all characters which are not a digit or a comma, erases all multible, trailing or leading commas
* and checks whether the expression is of 'dd,dd' to make sure we get only two numbers seperated by a comma
*
* @params:	inputName:	string, name of the DOM element we want to check
*		defaultValue: string, the value which gets set if we encounter an invalid input
*
* @return:	a pair of integer numbers seperated by a comma
*/
function cleanInput(inputName, defaultValue)
{
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
