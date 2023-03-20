<?php
/**
*
* @package Usermap v1.2.0
* @copyright (c) 2020 - 2022 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, [
	// Module
	'USERMAP'						=> 'Gebruikerskaart',
	'USERMAP_NOT_AUTHORIZED'		=> 'U bent niet gemachtigd om de gebruikerskaart te zien .',
	'USERMAP_SEARCHFORM'			=> 'Zoekformulier',
	'USERMAP_LEGEND'				=> 'Legenda',
	'USERMAP_CREDENTIALS'			=> 'Geo-referenties gebruikt door Usermap met dank aan  ',
	'USERMAP_LEGEND_TEXT'			=> 'Schakel zoomen met het muiswiel in, door op de kaart te klikken',
	'MAP_USERS'						=> [
		0	=> 'Er is momenteel geen lid getoond op de kaart. ',
		1	=> 'Er wordt momenteel %1$d lid op de kaart getoond.',
		2	=> 'Er worden momenteel %1$d leden op de kaart getoond.',
	],
	'POI_COUNT'						=> [
		0	=> 'Er wordt momenteel geen POI op de kaart weergegeven. ',
		1	=> 'Er wordt momenteel %1$d POI op de kaart getoond.',
		2	=> 'Er worden momenteel %1$d POIs op de kaart getoond.',
	],
	// Search tabs
	'TAB_RADIUS_SEARCH'				=> 'Zoeken in de omgeving van de postcode',
	'TAB_MEMBER_SEARCH'				=> 'Zoeken naar leden',
	'TAB_POI_SEARCH'				=> 'Zoeken naar POI',
	'TAB_ADDRESS_SEARCH'			=> 'Google Maps Search',
	'MAP_SEARCH'					=> 'Zoek naar leden op postcode %1$s binnen een bereik van ',
	'MAP_RESULT'					=> 'geeft het volgende resultaat weer:',
	'MAP_NORESULT'					=> 'Geen leden gevonden binnen het bereik van  ',
	'MAP_KM'						=> 'km',
	'MEMBERNAME_SEARCH'				=> 'Voer de gebruikersnaam van het lid in (jokerteken * beschikbaar) ',
	'MEMBERNAME_RESULT'				=> 'De volgende leden zijn gevonden :',
	'MEMBERNAME_NORESULT'			=> 'Er zijn geen leden met een gebruikersnaam die overeenkomt met uw verzoek.',
	'POINAME_SEARCH'				=> 'Voer de naam van de POI in (jokerteken * beschikbaar) ',
	'POINAME_RESULT'				=> 'De volgende POIs zijn gevonden:',
	'POINAME_NORESULT'				=> 'Er zijn geen POIs met een naam die overeenkomt met uw verzoek.',
	'ADDRESS_SEARCH'				=> 'Voer de zoekterm in (bijv. een adres) waarvoor u coördinaten wilt vinden (bijv. om een POI aan te maken) ',
	'ADDRESS_RESULT'				=> 'Zoekterm is gevonden en wordt weergegeven met een markering op de kaart.',
	'ADDRESS_NORESULT'				=> 'Kan coördinaten niet ophalen die overeenkomen met de opgegeven zoekterm.',
	// Legend
	'POI_LEGEND_TITLE'				=> 'Legenda for the POIs',
	'STREET_DESC'					=> 'Straten kaart',
	'TOPO_DESC'						=> 'Topografische kaart',
	'SAT_DESC'						=> 'Satelliet beeld',
	// Permission overview
	'USERMAP_PERM_OVERVIEW'			=> 'Permissies op deze pagina ',
	'USERMAP_PERM_VIEW_ALWAYS'		=> 'Je <strong>kan</strong> de leden altijd zien.<br>',
	'USERMAP_PERM_VIEW_SUBSCRIBED'	=> 'Je <strong>kan</strong> enkel leden zien indien je zelf op de Usermap geregistreed bent.<br>',
	'USERMAP_NO_VIEW_SUBSCRIBED'	=> 'Je <strong>kan geen</strong> leden zien.<br>',
	'USERMAP_PERM_VIEW_POI'			=> 'Je <strong>kan</strong> POIs zien.<br>',
	'USERMAP_NO_VIEW_POI'			=> 'Je <strong>kan geen</strong> POIs zien.<br>',
	'USERMAP_NO_ADD_POI'			=> 'Je <strong>kan geen</strong> POIs maken.<br>',
	'USERMAP_PERM_ADD_POI'			=> 'Je <strong>kan</strong> POIs maken zonder goedkeuring van een moderator.<br>',
	'USERMAP_PERM_ADD_POI_MOD'		=> 'Je <strong>kan</strong> POIs maken met moderator goedkeuring.<br>',
	// Error messages
	'USERMAP_GN_USER_ERROR'			=> ': Geonames gebruiker bestaat niet of is niet geactiveerd  voor deze dienst!',
	'USERMAP_NO_MATCH_FOUND'		=> 'Geen overeenkomst gevonden voor <strong>%1$s</strong>!',
	// User POI popup
	'POI_INPUT_EXPL'				=> 'In dit formulier kun je een nieuwe POI aanmaken. De coördinaten worden overgenomen van de markering op de kaart links van dit formulier.
										Deze marker is versleepbaar, je kunt deze met de muis naar zijn eindbestemming verplaatsen. De naam, beschrijving evenals het pictogram waarmee de markering later wordt weergegeven, kan worden ingevoerd of geselecteerd in de volgende formuliervelden.',
	'POI_NEW_SAVED'					=> 'De gemaakte POI is succesvol opgeslagen in de database en wordt weergegeven op de kaart.',
	'POI_MOD_NOTIFIED'				=> 'De aangemaakte POI is succesvol opgeslagen in de database, de moderators zijn hiervan op de hoogte gesteld in afwachting van goedkeuring.',
	'ACP_USERMAP_POI_NAME'			=> 'Naam van de POI',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'De naam van deze POI, wordt weergegeven als een tooltip wanneer de muisaanwijzer over de POI-markering beweegt .',
	'ACP_USERMAP_POI_POPUP'			=> 'Omschrijving van de POI',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'De omschrijving van deze POI, kan maximaal 500 tekens bevatten en kan BBCode bevatten.<br>
										Deze tekst wordt weergegeven in een pop-upballon wanneer op de POI-markering wordt geklikt met de muisaanwijzer .',
	'ACP_USERMAP_POI_ICON'			=> 'Icon bestand',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'Om een rudimentaire indeling van uw POIs te vergemakkelijken, kunt u kiezen uit markeringspictogrammen met verschillende kleuren.',
	'ACP_USERMAP_POI_SIZE'			=> 'Icon afmeting',
	'ACP_USERMAP_POI_SIZE_EXP'		=> 'Grootte van het icoon in pixels in de notatie ´breedte´,´hoogte´.<br>
										De initiële waarde is de standaardgrootte die wordt gegeven op het tabblad ´Instellingen´. ',
	'ACP_USERMAP_POI_ANCHOR'		=> 'Icon anker',
	'ACP_USERMAP_POI_ANCHOR_EXP'	=> 'Anker van het icoon in pixels beginnend in de linker bovenhoek in de notatie ´horizontale waarde´,´verticale waarde´ .<br>
										De beginwaarde is de standaardwaarde die op het tabblad ´Instellingen´ wordt gegeven. ',
	'ACP_USERMAP_DATABASE_LAT'		=> 'Breedtegraad',
	'ACP_USERMAP_DATABASE_LNG'		=> 'Lengtegraad',
	'ACP_USERMAP_POI_LAYER'			=> 'Kaartoverlay ',
	'ACP_USERMAP_POI_LAYER_EXP'		=> 'Selecteer de kaart-overlay waarop deze POI zal worden weergegeven.',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'Wijzigingen van de interne database succesvol opgeslagen .',
	'ACP_USERMAP_CONFIRM_DELETE'	=> 'Weet u echt zeker dat u dit item uit de database wilt verwijderen?<br>
										<strong>Dit verwijdert het item permanent uit de database en kan niet ongedaan worden gemaakt!</strong>',
	'USERMAP_POI_NAME_ERROR'		=> 'Het veld >%1$s< mag niet leeg zijn!',
	// Notifications
	'NOTIFICATION_USERMAP_MOD'		=> 'Moderatiemeldingen voor de gebruikerskaart',
	'USERMAP_SETTING_APPROVE'		=> 'Een recent aangemaakte POI wacht op goedkeuring',
	'USERMAP_SETTING_NOTIFY'		=> 'Iemand heeft een nieuwe POI aan de gebruikerskaart toegevoegd',
	'USERMAP_NOTIFY_POI_APPROVE'	=> '<strong>Een nieuwe POI wacht op goedkeuring</strong><br>Een nieuwe POI met de naam „<strong>%1$s</strong>“ werd aangemaakt door de gebruiker „%2$s“ en wacht op goedkeuring. ',
	'USERMAP_NOTIFY_POI'			=> '<strong>POI toegevoegd</strong><br>De gebruiker „%2$s“ heeft een nieuwe POI met de naam „<strong>%1$s</strong>“ aan de gebruikerskaart toegevoegd.',
	// Moderation
	'POI_MOD_EXPL'					=> 'Hier kunt u de gegevens controleren van een door een gebruiker aangemaakte nieuwe POI en deze bewerken indien u dit nodig vindt of wilt doen	omwille van een andere reden. U kunt de markering positioneren door deze met de muis te slepen. Nadat u dit proces hebt voltooid, kunt u ofwel:
										sla de POI op (en keur deze goed) of verwijder deze als deze niet past in het beleid van je boards.',
	'USERMAP_MOD_NOT_AUTHORIZED'	=> '<strong>Je hebt geen toelating om deze activiteit aan te vangen! </strong>',
	'POI_NONEXISTENT'				=> 'POI bestaat niet',
	'POI_ALREADY_APPROVED'			=> 'Deze POI is al goedgekeurd!',
	'APPROVE'						=> 'Goedkeuren',
	'DONE'							=> 'Klaar',
	'POI_APPROVED'					=> 'POI succesvol goedgekeurd.',
	'ACTION_CONCLUDED'				=> 'Activiteit beëindigd.',
	'CHANGES_SUCCESSFUL'			=> 'Mogelijke wijzigingen succesvol opgeslagen.',
	'BACK_TO_USERMAP'				=> 'Naar de gebruikerskaart ',
	// UCP
	'MOT_ZIP'						=> 'Postcode',
	'MOT_ZIP_EXP'					=> 'Gelieve de postcode van uw lokatie in te voeren om op de gebruikerskaart weergegeven te worden.<br>(Voor NL en BE enkel cijfers)',
	'MOT_LAND'						=> 'Land',
	'MOT_LAND_EXP'					=> 'Gelieve het land waarin u woont te selecteren om op de gebruikerskaart te worden vermeld.',
	'MOT_UCP_GEONAMES_ERROR'		=> 'De beheerder heeft geen gebruiker van Geonames.org opgegeven, daardoor konden de gegevens voor de gebruikerskaart niet worden opgehaald!',
	// Log entries
	'LOG_USERMAP_SETTING_UPDATED'	=> '<strong>Gebruikerskaartinstellingen gewijzigd</strong>',
	'LOG_POI_LEGEND_UPDATED'		=> '<strong>De POI-legenda bewerkt</strong>',
	'LOG_USERMAP_INSTALL_LANG'		=> '<strong>Een taalpakket toegevoegd aan de gebruikerskaart:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_NEW'		=> '<strong>Een nieuw database-item toegevoegd aan de gebruikerskaart:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_DELETED'	=> '<strong>Een databasevermelding naar de gebruikerskaart verwijderd:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_EDIT'		=> '<strong>Een databasevermelding in de gebruikerskaart bewerkt:</strong><br>» %s',
	'LOG_USERMAP_POI_NEW'			=> '<strong>Een nieuwe POI toegevoegd aan de gebruikerskaart:</strong><br>» %s',
	'LOG_USERMAP_POI_EDITED'		=> '<strong>Gewijzigde POI-datum: </strong><br>» %s',
	'LOG_USERMAP_GOOGLE_ERROR'		=> '<strong>De Google Maps API is mislukt met de volgende foutmelding:</strong><br>» %s',
	'LOG_USERMAP_GEONAMES_ERROR'	=> '<strong>De Geonames API is mislukt met de volgende foutmelding:</strong><br>» %s',
	'LOG_USERMAP_POI_DELETED'		=> '<strong>Een POI verwijderd van de gebruikerskaart:</strong><br>» %s',
	'LOG_USERMAP_POI_APPROVED'		=> '<strong>Door gebruiker gemaakte POI goedgekeurd:</strong><br>» %s',
	'LOG_USERMAP_POI_MOD_DELETED'	=> '<strong>Door gebruiker gemaakte POI verwijderd:</strong><br>» %s',
	// Profile
	'USERMAP_PROFILE_LINK'			=> '<strong>Toon dit lid op de gebruikerskaart </strong>',
]);
