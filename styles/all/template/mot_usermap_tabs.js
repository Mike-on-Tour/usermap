/**
*
* package Usermap v1.1.1
* copyright (c) 2020 - 2021 Mike-on-Tour
* license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

(function($) {  // Avoid conflicts with other libraries

'use strict';

/*
* Event handlers for search tabs
*/
$("#usermap_tab_1").click(function() {
	motUsermap.selectTab('1');
});

$("#usermap_tab_2").click(function() {
	motUsermap.selectTab('2');
});

$("#usermap_tab_3").click(function() {
	motUsermap.selectTab('3');
});

$("#usermap_tab_4").click(function() {
	motUsermap.selectTab('4');
});

/*
* Select the tab as active and the corresponding content box after a tab was selected
*
* @params	string	index		the numerical descriptor of the selected tab
*
* @return	none
*/
motUsermap.selectTab = function(index) {
	// Hide loading indicator
	$("#loading_indicator").hide();

	var elementId = "";

	// Hide all boxes
	$("div.inner").each(function() {
		elementId = $(this).attr('id');
		if ((typeof elementId !== 'undefined') && (elementId.substr(0,12) == 'usermap_box_')) {
			$(this).attr("hidden", true);
		}
	});

	// Set all tabs to inactive
	$("li.tab").each(function() {
		elementId = $(this).attr('id');
		if ((typeof elementId !== 'undefined') && (elementId.substr(0,12) == 'usermap_tab_')) {
			$(this).attr("class", 'tab');
		}
	});

	// Delete all former search results
	$("#seperation_hr").html('');
	$("#solution").html('');
	// Reset dropdown select field in zipcode search
	$("#plz_choice").val(1);
	// Clear input fields in member, POI and address search
	$("#member_choice").val('');;
	$("#poi_choice").val('');
	$("#address_choice").val('');

	// Set selected tab to active
	$("#usermap_tab_" + index).attr("class", 'tab activetab');

	// Show selected box
	$("#usermap_box_" + index).attr("hidden", false);
}

motUsermap.selectTab(motUsermap.tab);

})(jQuery); // Avoid conflicts with other libraries
