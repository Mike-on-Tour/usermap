<?php
/**
*
* @package Usermap v0.6.x
* @copyright (c) 2020 Mike-on-Tour
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
	$lang = array();
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
$lang = array_merge($lang, array(
	'PLURAL_RULE'					=> 1,
	// Module
	'USERMAP'						=> 'Mitgliederkarte',
	'USERMAP_NOT_AUTHORIZED'		=> 'Du bist nicht befugt, die Mitgliederkarte zu sehen.',
	'USERMAP_SEARCHFORM'			=> 'Sucheingabe',
	'USERMAP_LEGEND'				=> 'Legende',
	'USERMAP_CREDENTIALS'			=> 'Die GeoDaten für die Mitgliederkarte wurden bereitgestellt von ',
	'USERMAP_LEGEND_TEXT'			=> 'Zoomen der Karte mit dem Mausrad mit einem Klick in die Karte ein- und ausschalten.',
	'MAP_USERS'						=> array(
		1	=> 'Es ist aktuell %1$s Mitglied in der Mitgliederkarte erfasst.',
		2	=> 'Es sind aktuell %1$s Mitglieder in der Mitgliederkarte erfasst.',
	),
	'MAP_SEARCH'					=> 'Mitgliedersuche um die PLZ %1$s mit dem Radius ',
	'MAP_RESULT'					=> 'ergab folgendes Ergebnis:',
	'MAP_NORESULT'					=> 'fand keine Mitglieder innerhalb des Radius von ',
	'POI_LEGEND_TITLE'				=> 'Legende für die Darstellung der POIs',
	'STREET_DESC'					=> 'Straßenkarte',
	'TOPO_DESC'						=> 'Topografische Karte',
	'USER_DESC'						=> 'Mitglieder',
	'POI_DESC'						=> 'POIs',
	// ACP
	'ACP_USERMAP'					=> 'Mitgliederkarte',
	// Settings tab
	'ACP_USERMAP_SETTINGS'			=> 'Einstellungen',
	'ACP_USERMAP_SETTINGS_EXPLAIN'	=> 'Hier kannst du die Einstellungen für die Mitgliederkarte ändern.',
	'ACP_USERMAP_SETTING_SAVED'		=> 'Die Einstellungen für die Mitgliederkarte wurden erfolgreich gesichert.',
	'ACP_USERMAP_MAPSETTING_TITLE'	=> 'Karteneinstellungen',
	'ACP_USERMAP_MAPSETTING_TEXT'	=> 'Einstellungen für das Kartenzentrum und die Vergrößerung beim Start.',
	'ACP_USERMAP_LAT'				=> 'Geogr. Breite des Kartenzentrums',
	'ACP_USERMAP_LAT_EXP'			=> 'Werte zwischen 90.0 (Nordpol) und -90.0 (Südpol)',
	'ACP_USERMAP_LON'				=> 'Geogr. Länge des Kartenzentrums',
	'ACP_USERMAP_LON_EXP'			=> 'Werte zwischen 180.0 (Osten) und -180.0 (Westen)',
	'ACP_USERMAP_ZOOM'				=> 'Zoom-Faktor der Mitgliederkarte beim Aufruf',
	'ACP_USERMAP_GEONAMES_TITLE'	=> 'Benutzername für geonames.org',
	'ACP_USERMAP_GEONAMES_TEXT'		=> 'Die Mitgliederkarte verwendet den Service von geonames.org zum Ermitteln der geogr.
										Koordinaten des über Postleitzahl und Land angegebenen Ortes sowie zur Verfeinerung den
										angegebenen Wohnort.
										Dafür wird eine Registrierung auf
										<a href="https://www.geonames.org/login" target="_blank">
										<span style="text-decoration: underline;">geonames.org/login</span></a>
										benötigt. Der dort registrierte Benutzername wird hier eingegeben.<br>
										Pro Abfrage wird ein Kredit-Punkt angerechnet, im kostenlosen Service sind pro Stunde
										maximal 1.000 Kredit-Punkte verfügbar; bei Foren mit mehr als 1.000 Benutzern wird empfohlen,
										pro 1.000 - 1.500 Mitgliedern je einen Benutzernamen anzumelden. Ansonsten könnte den
										Benutzern eine Fehlermeldung bei Eingabe von Postleitzahl und Land im Profil angezeigt
										werden, wenn beim Absenden die Koordinate ermittelt wird.<br>
										Mehrere Benutzernamen sind durch Kommata zu trennen.<br>
										<strong>ACHTUNG:</strong> Benutzer müssen nach dem ersten Login auf geonames.org über diesen
										<a href="https://www.geonames.org/manageaccount" target="_blank">
										<span style="text-decoration: underline;">Link</span></a>
										gesondert für den gewünschten Service freigeschaltet werden!!',
	'ACP_USERMAP_GEONAMESUSER'		=> 'Benutzername(n) für geonames.org',
	'ACP_USERMAP_GEONAMESUSER_ERR'	=> 'Du musst mindestens einen gültigen Benutzernamen für geonames.org eingeben!',
	'ACP_USERMAP_PROFILE_ERROR'		=> 'Diese Aktion konnte nicht abgeschlossen werden, da du noch keinen Geonames.org Nutzer in den Einstellungen der Mitgliederkarte angegeben hast. Tue dies bitte jetzt!',
	'ACP_USERMAP_GOOGLE_TITLE'		=> 'Einstellungen zur Nutzung der Google Maps API',
	'ACP_USERMAP_GOOGLE_TEXT'		=> 'geonames.org liefert nur für bestimmte Länder ein Ergebnis (vgl. dazu diese
										<a href="https://www.geonames.org/postal-codes/" target="_blank">
										<span style="text-decoration: underline;">Liste</span></a>),
										sollen hier nicht aufgeführte Länder bei der Abfrage berücksichtigt werden, kann hierzu der Service von Google Maps genutzt werden.
										Diese Nutzung kannst du hier einschalten.<br>
										Dazu wird ein API Key benötigt, den du durch Anmeldung bei
										<a href="https://developers.google.com/maps/documentation/embed/get-api-key" target="_blank">
										<span style="text-decoration: underline;">Google Maps API Key</span></a> erhälst. Folge bitte den dortigen Anweisungen
										und beachte, dass du die "Geocoding API" aktivieren musst.',
	'ACP_USERMAP_GOOGLE_ENABLE'		=> 'Nutzung der Google Maps API einschalten?',
	'ACP_USERMAP_GOOGLE_KEY'		=> 'Gib hier den Google Maps API Key ein',
	'ACP_USERMAP_APIKEY_ERROR'		=> 'Du musst einen Google Maps API Key angeben, wenn du die Google Maps API aktivierst!',
	'ACP_USERMAP_GOOGLE_FORCE'		=> 'Ländercode für Länder, die immer bei Google Maps API nachgeschlagen werden',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'	=> 'geonames.org wertet aus Copyright-Gründen für einige Länder nur Teile der Postleitzahl aus, dies führt zu sehr groben
										Ergebnissen beim Feststellen der Koordinaten, die betroffenen Länder kannst du
										<a href="http://download.geonames.org/export/zip/readme.txt" target="_blank">
										<span style="text-decoration: underline;">hier</span></a>nachlesen.<br>
										Die Google Maps API kann für diese Länder genauere Ergebnisse liefern. Wenn du für diese Länder die Ergebnisse der
										Google Maps API statt geonames.org erzwingen willst, gib die Ländercodes dieser Länder hier ein, getrennt durch Kommata.',
	'ACP_USERMAP_DATABASE_TITLE'	=> 'Nutzung der internen Datenbank',
	'ACP_USERMAP_DATABASE_TEXT'		=> 'Da auch Google Maps für manche Länder (z.B. Israel) kein Ergebnis liefert, kannst du eine Tabelle der internen Datanbank
										für die Abfrage nutzen, allerdings musst du dafür die Daten bereitstellen. Dies kannst du durch Auswahl des Reiters
										"Interne Datenbank" tun.<br>
										Du kannst für Nutzer, die in einem von geonames.org nicht unterstützten Land leben, auch ohne Nutzung der Google Maps API
										diese Möglichkeit nutzen.',
	'ACP_USERMAP_DATABASE_ENABLE'	=> 'Nutzung der internen Datenbank einschalten?',
	'ACP_USERMAP_POI_TITLE'			=> 'Anzeige von POIs',
	'ACP_USERMAP_POI_TEXT'			=> 'Neben der Anzeige der eingetragenen Mitglieder kann die Mitgliederkarte ein zweites Karten-Overlay mit Punkten von
										besonderem Interesse für die Mitglieder anzeigen, z.B. Treffpunkte und Hotels für Motorradfahrer oder die Standorte
										von Fussball-Stadien. In diesem Abschnitt können die Einstellungen dazu vorgenommen werden.<br>
										Im nächsten Abschnitt kann eine Legende zur Bedeutung verschiedener Kategorien eingegeben werden, diese Legende
										wird dann ebenfalls unter der Mitgliederkarte angezeigt.<br>
										Die Eingabe und das Bearbeiten der POIs muss durch den Administrator erfolgen, die Elemente dazu können über den
										Reiter "POI Bearbeitung" erreicht werden.',
	'ACP_USERMAP_POI_ENABLE'		=> 'Anzeige der POIs aktivieren?',
	'ACP_USERMAP_POI_ENABLE_EXP'	=> 'Wird hier "Ja" ausgewählt, wird das POI-Overlay bei der Anzeige der Mitgliederkarte aktiviert. Gleichzeitig werden
										die folgende Einstellung und die Anzeige der Legende aktiviert.',
	'ACP_USERMAP_POI_SHOWTOALL'		=> 'Soll das POI-Overlay allen Mitgliedern angezeigt werden?',
	'ACP_USERMAP_POI_SHOWTOALL_EXP'	=> 'Die Mitgliederkarte und das POI-Overlay wird nur den Mitgliedern angezeigt, die sich in die Mitgliederkarte eingetragen
										haben. Wenn auch Mitglieder, die sich nicht eingetragen haben, das POI-Overlay sehen sollen, kann dies hier aktiviert
										werden. Diese Mitglieder sehen dann das POI-Overlay, aber nicht die Standorte der anderen Mitglieder.',
	'ACP_USERMAP_POI_LEGEND'		=> 'Legende für die POIs',
	'ACP_USERMAP_POI_LGND'			=> 'Erstellen und Bearbeiten der Legende für das POI-Overlay',
	'ACP_USERMAP_POI_LGND_EXP'		=> 'Der hier eingegebene Text (maximale Länge einschließlich der verwendeten BB-Codes beträgt 1.000 Zeichen) wird bei
										aktivierter Anzeige des POI-Overlays als Legende unterhalb der Mitgliederkarte dargestellt.<br>
										Die Bearbeitung ist unabhängig von den übrigen Einstellungen möglich.',
	// Language packs tab
	'ACP_USERMAP_LANGS'				=> 'Sprachpakete',
	'ACP_USERMAP_LANGS_EXPLAIN'		=> 'Hier kannst du nachträglich weitere Sprachpakete für die Mitgliederkarte installieren. Dies kann notwendig werden,
										wenn Sprachpakete für die Mitgliederkarte nach der ersten Aktivierung hinzugefügt werden, weil deren Daten noch nicht
										in die Auswahlliste für die Länderauswahl aufgenommen wurden; das kannst du hier erledigen, nachdem das Sprachpaket
										per ftp-Transfer in das Unterverzeichnis <i>language</i> dieser Erweiterung kopiert wurde.',
	'ACP_USERMAP_INSTALLABLE_LANG'	=> 'Zur Installation verfügbare Sprachpakete',
	'ACP_USERMAP_INSTALL_LANG_EXP'	=> 'Hier sind alle Sprachpakete der Mitgliederkarte aufgelistet, die noch installiert werden müssen.',
	'ACP_USERMAP_MISSING_LANG'		=> 'Fehlende Sprachpakete',
	'ACP_USERMAP_MISSING_LANG_EXP'	=> 'Hier sind die Sprachpakete aufgelistet, die im Board installiert sind, aber in der Mitgliederkarte fehlen.',
	'ACP_USERMAP_ADDITIONAL_LANG'	=> 'Zusätzliche Sprachpakete der Mitgliederkarte',
	'ACP_USERMAP_ADD_LANG_EXP'		=> 'Hier sind die Sprachpakete der Erweiterung aufgelistet, für die in diesem Board keine Sprache installiert ist.',
	'ACP_USERMAP_LANGPACK_NAME'		=> 'Name',
	'ACP_USERMAP_LANGPACK_LOCAL'	=> 'Lokaler Name',
	'ACP_USERMAP_LANGPACK_ISO'		=> 'ISO',
	'ACP_USERMAP_NO_ENTRIES'		=> 'Keine Sprachpakete gefunden',
	// Internal database tab
	'ACP_USERMAP_DATABASE'			=> 'Interne Datenbank',
	'ACP_USERMAP_DATABASE_EXPLAIN'	=> 'Hier werden tabellarisch alle vorhandenen Einträge der internen Datenbank aufgelistet. Über die Verknüpfungen der rechten
										Spalte können diese Einträge gelöscht werden.<br>
										Unterhalb dieser Tabelle können neue Einträge hinzugefügt werden.',
	'ACP_USERMAP_DATABASE_DATA'		=> 'In der internen Datenbank enthaltene Daten',
	'ACP_USERMAP_DATABASE_CC'		=> 'ISO Ländercode',
	'ACP_USERMAP_DATABASE_ZIPCODE'	=> 'Postleitzahl',
	'ACP_USERMAP_DATABASE_LAT'		=> 'Geogr. Breite',
	'ACP_USERMAP_DATABASE_LNG'		=> 'Geogr. Länge',
	'ACP_USERMAP_DATABASE_EDIT'		=> 'Bearbeiten',
	'ACP_USERMAP_DATABASE_NOENTRY'	=> 'Keine Daten vorhanden',
	'ACP_USERMAP_DATABASE_NEW'		=> 'Neuer Datenbank-Eintrag',
	'ACP_USERMAP_DATABASE_CC_EXP'	=> 'Gib hier den aus 2 Buchstaben bestehenden Ländercode für das Land ein, dem der Eintrag zugeordnet werden soll.',
	'ACP_USERMAP_DATABASE_ZC_EXP'	=> 'Gib hier die Postleitzahl ein, der der Eintrag zugeordnet werden soll, es sind Großbuchstaben, Ziffern und der Bindestrich erlaubt.',
	'ACP_USERMAP_DATABASE_ERROR'	=> 'Das Feld >%1$s<darf nicht leer sein!',
	'ACP_USERMAP_DATABASE_BIG_ERR'	=> 'Das Feld darf nicht leer sein!',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'Die Änderung der internen Datenbank wurde erfolgreich gespeichert.',
	'ACP_USERMAP_DATABASE_INVALID'	=> 'Die verwendete Kombination aus Ländercode und Postleitzahl existiert bereits, sie darf kein weiteres Mal verwendet werden!<br>
										Das Speichern in der internen Datenbank scheiterte!',
	'ACP_USERMAP_CONFIRM_DELETE'	=> 'Bist du dir sicher, dass du diesen Eintrag aus der Datenbank löschen möchtest?<br>
										<strong>Dieser Vorgang kann nicht rückgängig gemacht werden!</strong>',
	// POI tab
	'ACP_USERMAP_POI'				=> 'POI Bearbeitung',
	'ACP_USERMAP_POI_EXPLAIN'		=> 'Hier werden die bisher angelegten POIs tabellarisch aufgelistet.<br>
										Im unteren Teil können neue Einträge angelegt werden, hier werden auch nach Auswahl des Links zum Ändern in der Tabelle
										die bisherigen Daten des Eintrages zum Bearbeiten angezeigt.<br>
										Über den entsprechenden Link in der Tabelle können einzelne Einträge gelöscht werden.',
	'ACP_USERMAP_POI_DATA'			=> 'Gespeicherte POI-Einträge',
	'ACP_USERMAP_POI_NAME'			=> 'Name des Eintrages',
	'ACP_USERMAP_POI_POPUP'			=> 'Beschreibung des Eintrages',
	'ACP_USERMAP_POI_ICON'			=> 'Icon-Datei',
	'ACP_USERMAP_POI_NEW'			=> 'Eingabe eines neuen POI',
	'ACP_USERMAP_POI_EDIT'			=> 'Bearbeitung eines vorhandenen POI',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'Name des Eintrags, wird in der Karte beim Überfahren des POI mit dem Mauszeiger als Tooltip angezeigt.',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'Beschreibung des Eintrages, kann bis zu 500 Zeichen lang sein und darf BB-Code enthalten.<br>
										Wird in der Karte beim Anklicken des POI als Popup-Blase dargestellt.',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'Zur Darstellung von verschiedenen POI-Kategorien kann hier aus verschiedenfarbigen Markern ausgewählt werden.',
	// ERROR LOG
	'LOG_USERMAP_GOOGLE_ERROR'		=> 'Die Google Maps API gab bei der Ausführung folgende Fehlermeldung zurück<br>» %s',
	// UCP
	'MOT_ZIP'						=> 'Postleitzahl',
	'MOT_ZIP_EXP'					=> 'Gib hier die Postleitzahl deines Wohnortes ein, damit du auf der Mitgliederkarte erscheinst.<br>(Nur Großbuchstaben, Ziffern und Bindestrich erlaubt)',
	'MOT_LAND'						=> 'Land',
	'MOT_LAND_EXP'					=> 'Wähle hier das Land aus, in dem du wohnst, damit du auf der Mitgliederkarte erscheinst.',
	'MOT_UCP_GEONAMES_ERROR'		=> 'Es wurde durch den Administrator kein Geonames.org Nutzer angegeben, die Daten für die Mitgliederkarte konnten nicht ermittelt werden!',
));
