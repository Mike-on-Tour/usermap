<?php
/**
*
* @package Usermap v1.3.0
* @copyright (c) 2020 - 2025 Mike-on-Tour
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
	'USERMAP_COUNTRY_CODE'			=> 'de',		// MUST be set according to the language key of the respective language file BUT MUST NOT include any special denominators indicating a formal or informal honorific (e.g. 'de_x_sie' MUST use 'de'), but supplements like en-US are permitted !!!!
	// Module
	'USERMAP'						=> 'Mitgliederkarte',
	'USERMAP_NOT_AUTHORIZED'		=> 'Du bist nicht befugt, die Mitgliederkarte zu sehen.',
	'USERMAP_SEARCHFORM'			=> 'Sucheingabe',
	'USERMAP_LEGEND'				=> 'Legende',
	'USERMAP_CREDENTIALS'			=> 'Die GeoDaten für die Mitgliederkarte wurden bereitgestellt von ',
	'USERMAP_LEGEND_TEXT'			=> 'Zoomen der Karte mit dem Mausrad mit einem Klick in die Karte ein- und ausschalten.',
	'MAP_USERS'						=> [
		0	=> 'Es ist aktuell kein Mitglied in der Mitgliederkarte erfasst.',
		1	=> 'Es ist aktuell %1$d Mitglied in der Mitgliederkarte erfasst.',
		2	=> 'Es sind aktuell %1$d Mitglieder in der Mitgliederkarte erfasst.',
	],
	'POI_COUNT'						=> [
		0	=> 'Es ist aktuell kein POI in der Karte erfasst.',
		1	=> 'Es ist aktuell %1$d POI in der Karte erfasst.',
		2	=> 'Es sind aktuell %1$d POIs in der Karte erfasst.',
	],
	// Search tabs
	'TAB_RADIUS_SEARCH'				=> 'Suche um deine PLZ',
	'TAB_MEMBER_SEARCH'				=> 'Mitgliedersuche',
	'TAB_POI_SEARCH'				=> 'POI-Suche',
	'TAB_ADDRESS_SEARCH'			=> 'Google Maps Suche',
	'MAP_SEARCH'					=> 'Mitgliedersuche um die PLZ %1$s mit dem Radius ',
	'MAP_RESULT'					=> 'ergab folgendes Ergebnis:',
	'MAP_NORESULT'					=> 'fand keine Mitglieder innerhalb des Radius von ',
	'MAP_KM'						=> 'km',
	'MEMBERNAME_SEARCH'				=> 'Gib den Namen des gesuchten Mitgliedes ein (Platzhalter * möglich)',
	'MEMBERNAME_RESULT'				=> 'Deine Suche fand folgende Mitglieder:',
	'MEMBERNAME_NORESULT'			=> 'Zu deiner Suche wurden keine passenden Mitglieder gefunden.',
	'POINAME_SEARCH'				=> 'Gib den Namen des gesuchten POI ein (Platzhalter * möglich)',
	'POINAME_RESULT'				=> 'Deine Suche fand folgende POIs:',
	'POINAME_NORESULT'				=> 'Zu deiner Suche wurden keine passenden POIs gefunden.',
	'ADDRESS_SEARCH'				=> 'Gib den Suchbegriff (z.B. eine Adresse) ein, der auf der Karte angezeigt werden soll (um Koordinaten z.B.
										zum Erstellen von POIs zu erhalten)',
	'ADDRESS_RESULT'				=> 'Suchbegriff wurde gefunden und ist auf der Karte markiert.',
	'ADDRESS_MULTIPLE_RESULTS'		=> 'Zum angegebenen Suchbegriff wurden folgende Ergebnisse gefunden (Anklicken zeigt Ergebnis auf der Karte):',
	'ADDRESS_NORESULT'				=> 'Zum angegebenen Suchbegriff wurden keine gültigen Koordinaten gefunden.',
	// Legend
	'POI_LEGEND_TITLE'				=> 'Legende für die Darstellung der POIs',
	'STREET_DESC'					=> 'Straßenkarte',
	'TOPO_DESC'						=> 'Topografische Karte',
	'SAT_DESC'						=> 'Satellitenbild',
	// Permission overview
	'USERMAP_PERM_OVERVIEW'			=> 'Berechtigungen auf dieser Seite',
	'USERMAP_PERM_VIEW_ALWAYS'		=> 'Du <strong>darfst</strong> die Mitglieder immer sehen.<br>',
	'USERMAP_PERM_VIEW_SUBSCRIBED'	=> 'Du <strong>darfst</strong> die Mitglieder sehen, wenn du selbst registriert bist.<br>',
	'USERMAP_NO_VIEW_SUBSCRIBED'	=> 'Du darfst die Mitglieder <strong>nicht</strong> sehen.<br>',
	'USERMAP_PERM_VIEW_POI'			=> 'Du <strong>darfst</strong> POIs sehen.<br>',
	'USERMAP_NO_VIEW_POI'			=> 'Du darfst <strong>keine</strong> POIs sehen.<br>',
	'USERMAP_NO_ADD_POI'			=> 'Du darfst <strong>keine</strong> POIs erstellen.<br>',
	'USERMAP_PERM_ADD_POI'			=> 'Du <strong>darfst</strong> POIs ohne Freigabe erstellen.<br>',
	'USERMAP_PERM_ADD_POI_MOD'		=> 'Du <strong>darfst</strong> POIs mit Freigabe erstellen.<br>',
	// Error messages
	'USERMAP_GN_USER_ERROR'			=> ': Dieser Geonames Nutzer existiert nicht oder wurde für diesen Service nicht aktiviert!',
	'USERMAP_NO_MATCH_FOUND'		=> 'Kein Eintrag für <strong>%1$s</strong> gefunden!',
	// User POI popup
	'POI_INPUT_EXPL'				=> 'Hier kannst du einen POI erstellen. Seine Koordinaten werden von dem Marker auf der Karte links übernommen. Dieser
										Marker kann mit der Maus bewegt werden, um ihn an seine endgültige Position zu setzen. Namen, Beschreibung sowie das
										später zu verwendende Icon kannst du nachfolgend eingeben bzw. auswählen.',
	'POI_NEW_SAVED'					=> 'Der angelegte POI wurde erfolgreich in der Datenbank gespeichert und wird auf der Karte angezeigt.',
	'POI_MOD_NOTIFIED'				=> 'Der angelegte POI wurde erfolgreich in der Datenbank gespeichert, die Moderatoren wurden benachrichtigt, dass der neue POI auf Freigabe wartet.',
	'ACP_USERMAP_POI_NAME'			=> 'Name des Eintrages',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'Name des Eintrags, wird in der Karte beim Überfahren des POI mit dem Mauszeiger als Tooltip angezeigt.',
	'ACP_USERMAP_POI_POPUP'			=> 'Beschreibung des Eintrages',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'Beschreibung des Eintrages, kann bis zu 500 Zeichen lang sein und darf BB-Code enthalten.<br>
										Wird in der Karte beim Anklicken des POI als Popup-Blase dargestellt.',
	'ACP_USERMAP_POI_ICON'			=> 'Icon-Datei',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'Zur Darstellung von verschiedenen POI-Kategorien kann hier aus verschiedenfarbigen Markern ausgewählt werden.',
	'ACP_USERMAP_POI_SIZE'			=> 'Icon-Größe',
	'ACP_USERMAP_POI_SIZE_EXP'		=> 'Größe des Icons in Pixeln in der Notation ´Breite´,´Höhe´.<br>
										Voreingestellt sind die in den ´Einstellungen´ angegebenen Standardwerte.',
	'ACP_USERMAP_POI_ANCHOR'		=> 'Icon-Ankerpunkt',
	'ACP_USERMAP_POI_ANCHOR_EXP'	=> 'Ankerpunkt des Icons in Pixeln ausgehend von der linken oberen Ecke in der Notation ´Horizontaler Wert´,´Vertikaler Wert´.<br>
										Voreingestellt sind die in den ´Einstellungen´ angegebenen Standardwerte.',
	'ACP_USERMAP_DATABASE_LAT'		=> 'Geogr. Breite',
	'ACP_USERMAP_DATABASE_LNG'		=> 'Geogr. Länge',
	'ACP_USERMAP_POI_LAYER'			=> 'Kartenebene',
	'ACP_USERMAP_POI_LAYER_EXP'		=> 'Wähle hier die Kartenebene aus, auf der dieser POI angezeigt werden soll.',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'Die Änderung der internen Datenbank wurde erfolgreich gespeichert.',
	'ACP_USERMAP_CONFIRM_DELETE'	=> 'Bist du dir sicher, dass du diesen Eintrag aus der Datenbank löschen möchtest?<br>
										<strong>Dieser Vorgang kann nicht rückgängig gemacht werden!</strong>',
	'USERMAP_POI_NAME_ERROR'		=> 'Das Feld >%1$s< darf nicht leer sein!',
	// Notifications
	'NOTIFICATION_USERMAP_MOD'		=> 'Benachrichtigungen zur Moderation der Mitgliederkarte',
	'USERMAP_SETTING_APPROVE'		=> 'Ein neu erstellter POI muss freigegeben werden',
	'USERMAP_SETTING_NOTIFY'		=> 'Jemand hat einen neuen POI zur Mitgliederkarte hinzugefügt',
	'USERMAP_NOTIFY_POI_APPROVE'	=> '<strong>Neuer POI wartet auf Freigabe</strong><br>Ein neuer POI mit dem Namen „<strong>%1$s</strong>“ wurde vom Mitglied „%2$s“ erstellt und wartet auf Freigabe.',
	'USERMAP_NOTIFY_POI'			=> '<strong>POI hinzugefügt</strong><br>Das Mitglied „%2$s“ hat einen neuen POI mit dem Namen „<strong>%1$s</strong>“ zur Mitgliederkarte hinzugefügt.',
	// Moderation
	'POI_MOD_EXPL'					=> 'Hier kannst du die Daten eines von einem Mitglied neu erstellten POI ansehen, prüfen und - falls notwendig oder
										gewünscht - ändern. Die Position des Markers kannst du durch Bewegen mit der Maus verändern. Abschließend kannst du den
										POI speichern (und so freigeben) oder auch löschen, wenn er Kriterien deines Boards nicht genügen sollte.',
	'USERMAP_MOD_NOT_AUTHORIZED'	=> '<strong>Du bist nicht befugt, diese Aktion durchzuführen!</strong>',
	'POI_NONEXISTENT'				=> 'POI existiert nicht',
	'POI_ALREADY_APPROVED'			=> 'Dieser POI wurde bereits freigegeben!',
	'APPROVE'						=> 'Freigeben',
	'DONE'							=> 'Fertig',
	'POI_APPROVED'					=> 'Der POI wurde freigegeben.',
	'ACTION_CONCLUDED'				=> 'Vorgang abgeschlossen.',
	'CHANGES_SUCCESSFUL'			=> 'Eventuelle Änderungen wurden erfolgreich gespeichert.',
	'BACK_TO_USERMAP'				=> 'zur Mitgliederkarte',
	// UCP
	'MOT_ZIP'						=> 'Postleitzahl',
	'MOT_ZIP_EXP'					=> 'Gib hier die Postleitzahl deines Wohnortes ein, damit du auf der Mitgliederkarte erscheinst.<br>(Nur Großbuchstaben, Ziffern und Bindestrich erlaubt)',
	'MOT_LAND'						=> 'Land',
	'MOT_LAND_EXP'					=> 'Wähle hier das Land aus, in dem du wohnst, damit du auf der Mitgliederkarte erscheinst.',
	'MOT_UCP_GEONAMES_ERROR'		=> 'Es wurde durch den Administrator kein Geonames.org Nutzer angegeben, die Daten für die Mitgliederkarte konnten nicht ermittelt werden!',
	// Log entries
	'LOG_USERMAP_SETTING_UPDATED'	=> '<strong>Einstellungen der Mitgliederkarte geändert</strong>',
	'LOG_POI_LEGEND_UPDATED'		=> '<strong>Text der POI-Legende geändert</strong>',
	'LOG_USERMAP_INSTALL_LANG'		=> '<strong>Sprachpaket zur Mitgliederkarte hnzugefügt:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_NEW'		=> '<strong>Neuen Datenbank-Eintrag zur Mitgliederkarte hinzugefügt:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_DELETED'	=> '<strong>Datenbank-Eintrag zur Mitgliederkarte gelöscht:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_EDIT'		=> '<strong>Werte eines Eintrages der Datenbank zur Mitgliederkarte geändert:</strong><br>» %s',
	'LOG_USERMAP_POI_NEW'			=> '<strong>Neuen POI zur Mitgliederkarte hinzugefügt:</strong><br>» %s',
	'LOG_USERMAP_POI_EDITED'		=> '<strong>Werte eines POI geändert:</strong><br>» %s',
	'LOG_USERMAP_GOOGLE_ERROR'		=> '<strong>Die Google Maps API gab bei der Ausführung folgende Fehlermeldung zurück:</strong><br>» %s',
	'LOG_USERMAP_GEONAMES_ERROR'	=> '<strong>Die Geonames API gab bei der Ausführung folgende Fehlermeldung zurück:</strong><br>» %s',
	'LOG_USERMAP_POI_DELETED'		=> '<strong>POI aus der Mitgliederkarte gelöscht:</strong><br>» %s',
	'LOG_USERMAP_POI_APPROVED'		=> '<strong>Durch Mitglied erstellten POI freigegeben:</strong><br>» %s',
	'LOG_USERMAP_POI_MOD_DELETED'	=> '<strong>Durch Mitglied erstellten POI gelöscht:</strong><br>» %s',
	// Profile
	'USERMAP_PROFILE_LINK'			=> '<strong>Mitglied auf der Mitgliederkarte anzeigen</strong>',
]);
