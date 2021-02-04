<?php
/**
*
* @package Usermap v0.10.0
* @copyright (c) 2020 - 2021 Mike-on-Tour
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
	'USERMAP_NOT_AUTHORIZED'		=> 'Sie sind nicht befugt, die Mitgliederkarte zu sehen.',
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
	'SAT_DESC'						=> 'Satellitenbild',
	'USER_DESC'						=> 'Mitglieder',
	'POI_DESC'						=> 'POIs',
	// User POI popup
	'POI_INPUT_EXPL'				=> 'Hier können Sie einen POI erstellen. Seine Koordinaten werden von dem Marker auf der Karte links übernommen. Dieser
										Marker kann mit der Maus bewegt werden, um ihn an seine endgültige Position zu setzen. Namen, Beschreibung sowie das
										später zu verwendende Icon können Sie nachfolgend eingeben bzw. auswählen.',
	'POI_NEW_SAVED'					=> 'Der angelegte POI wurde erfolgreich in der Datenbank gespeichert und wird auf der Karte angezeigt.',
	'POI_MOD_NOTIFIED'				=> 'Der angelegte POI wurde erfolgreich in der Datenbank gespeichert, die Moderatoren wurden benachrichtigt, dass der neue POI auf Freigabe wartet.',
	// Notifications
	'NOTIFICATION_USERMAP_MOD'		=> 'Benachrichtigungen zur Moderation der Mitgliederkarte',
	'USERMAP_SETTING_APPROVE'		=> 'Ein neu erstellter POI muss freigegeben werden',
	'USERMAP_SETTING_NOTIFY'		=> 'Jemand hat einen neuen POI zur Mitgliederkarte hinzugefügt',
	'USERMAP_NOTIFY_POI_APPROVE'	=> '<strong>Neuer POI wartet auf Freigabe</strong><br>Ein neuer POI mit dem Namen „<strong>%1$s</strong>“ wurde vom Mitglied „%2$s“ erstellt und wartet auf Freigabe.',
	'USERMAP_NOTIFY_POI'			=> '<strong>POI hinzugefügt</strong><br>Das Mitglied „%2$s“ hat einen neuen POI mit dem Namen „<strong>%1$s</strong>“ zur Mitgliederkarte hinzugefügt.',
	// Moderation
	'POI_MOD_EXPL'					=> 'Hier können Sie die Daten eines von einem Mitglied neu erstellten POI ansehen, prüfen und - falls notwendig oder
										gewünscht - ändern. Die Position des Markers können Sie durch Bewegen mit der Maus verändern. Abschließend können Sie den
										POI speichern (und so freigeben) oder auch löschen, wenn er Kriterien deines Boards nicht genügen sollte.',
	'USERMAP_MOD_NOT_AUTHORIZED'	=> '<strong>Sie sind nicht befugt, diese Aktion durchzuführen!</strong>',
	'POI_NONEXISTENT'				=> 'POI existiert nicht',
	'POI_ALREADY_APPROVED'			=> 'Dieser POI wurde bereits freigegeben!',
	'APPROVE'						=> 'Freigeben',
	'DONE'							=> 'Fertig',
	'POI_APPROVED'					=> 'Der POI wurde freigegeben.',
	'ACTION_CONCLUDED'				=> 'Vorgang abgeschlossen.',
	'CHANGES_SUCCESSFUL'			=> 'Eventuelle Änderungen wurden erfolgreich gespeichert.',
	'BACK_TO_USERMAP'				=> 'zur Mitgliederkarte',
	// ACP
	'ACP_USERMAP'					=> 'Mitgliederkarte',
	'SUPPORT_USERMAP'				=> 'Wenn Sie die Entwicklung der Mitgliederkarte unterstützen möchten, können Sie das hier tun:<br>',
	// Settings tab
	'ACP_USERMAP_SETTINGS'			=> 'Einstellungen',
	'ACP_USERMAP_SETTINGS_EXPLAIN'	=> 'Hier können Sie die Einstellungen für die Mitgliederkarte ändern.',
	'ACP_USERMAP_SETTING_SAVED'		=> 'Die Einstellungen für die Mitgliederkarte wurden erfolgreich gesichert.',
	'ACP_USERMAP_MAPSETTING_TITLE'	=> 'Karteneinstellungen',
	'ACP_USERMAP_MAPSETTING_TEXT'	=> 'Einstellungen für das Kartenzentrum und die Vergrößerung beim Start.',
	'ACP_USERMAP_LAT'				=> 'Geogr. Breite des Kartenzentrums',
	'ACP_USERMAP_LAT_EXP'			=> 'Werte zwischen 90.0 (Nordpol) und -90.0 (Südpol)',
	'ACP_USERMAP_LON'				=> 'Geogr. Länge des Kartenzentrums',
	'ACP_USERMAP_LON_EXP'			=> 'Werte zwischen 180.0 (Osten) und -180.0 (Westen)',
	'ACP_USERMAP_ZOOM'				=> 'Zoom-Faktor der Mitgliederkarte beim Aufruf',
	'ACP_USERMAP_MARKERS_TEXT'		=> 'Hier können Sie die Größe der Marker zur Darstellung der Mitglieder in der Karte unabhängig voneinander sowohl für die
										Anzeige auf Computern (Desktop, Laptop, Notebook, Netbook, Tablet) als auch auf mobilen Geräten (Smartphone)
										auswählen.<br>
										Die Größe wird als Radius des als Marker verwendeten Kreises angegeben, die Einheit sind Pixel.',
	'ACP_USERMAP_MARKERS_PC'		=> 'Radius des Kreises auf Computern',
	'ACP_USERMAP_MARKERS_MOB'		=> 'Radius des Kreises auf mobilen Geräten',
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
	'ACP_USERMAP_GEONAMESUSER_ERR'	=> 'Sie müssen mindestens einen gültigen Benutzernamen für geonames.org eingeben!',
	'ACP_USERMAP_PROFILE_ERROR'		=> 'Diese Aktion konnte nicht abgeschlossen werden, da Sie noch keinen Geonames.org Nutzer in den Einstellungen der Mitgliederkarte angegeben haben. Tun Sie dies bitte jetzt!',
	'ACP_USERMAP_GOOGLE_TITLE'		=> 'Einstellungen zur Nutzung der Google Maps API',
	'ACP_USERMAP_GOOGLE_TEXT'		=> 'geonames.org liefert nur für bestimmte Länder ein Ergebnis (vgl. dazu diese
										<a href="https://www.geonames.org/postal-codes/" target="_blank">
										<span style="text-decoration: underline;">Liste</span></a>),
										sollen hier nicht aufgeführte Länder bei der Abfrage berücksichtigt werden, kann hierzu der Service von Google Maps genutzt werden.
										Diese Nutzung können Sie hier einschalten.<br>
										Dazu wird ein API Key benötigt, den Sie durch Anmeldung bei
										<a href="https://developers.google.com/maps/documentation/embed/get-api-key" target="_blank">
										<span style="text-decoration: underline;">Google Maps API Key</span></a> erhalten. Folgen Sie bitte den dortigen Anweisungen
										und beachten Sie, dass Sie die ´Geocoding API´ aktivieren müssen.',
	'ACP_USERMAP_GOOGLE_ENABLE'		=> 'Nutzung der Google Maps API einschalten?',
	'ACP_USERMAP_GOOGLE_KEY'		=> 'Geben Sie hier den Google Maps API Key ein',
	'ACP_USERMAP_APIKEY_ERROR'		=> 'Sie müssen einen Google Maps API Key angeben, wenn Sie die Google Maps API aktivieren!',
	'ACP_USERMAP_GOOGLE_FORCE'		=> 'Ländercode für Länder, die immer bei Google Maps API nachgeschlagen werden',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'	=> 'geonames.org wertet aus Copyright-Gründen für einige Länder nur Teile der Postleitzahl aus, dies führt zu sehr groben
										Ergebnissen beim Feststellen der Koordinaten, die betroffenen Länder können Sie
										<a href="http://download.geonames.org/export/zip/readme.txt" target="_blank">
										<span style="text-decoration: underline;">hier</span></a>nachlesen.<br>
										Die Google Maps API kann für diese Länder genauere Ergebnisse liefern. Wenn Sie für diese Länder die Ergebnisse der
										Google Maps API statt geonames.org erzwingen wollen, geben Sie die Ländercodes dieser Länder hier ein, getrennt durch Kommata.',
	'ACP_USERMAP_DATABASE_TITLE'	=> 'Nutzung der internen Datenbank',
	'ACP_USERMAP_DATABASE_TEXT'		=> 'Da auch Google Maps für manche Länder (z.B. Israel) kein Ergebnis liefert, können Sie eine Tabelle der internen Datanbank
										für die Abfrage nutzen, allerdings müssen Sie dafür die Daten bereitstellen. Dies können Sie durch Auswahl des Reiters
										´Interne Datenbank´ tun.<br>
										Sie können für Nutzer, die in einem von geonames.org nicht unterstützten Land leben, auch ohne Nutzung der Google Maps API
										diese Möglichkeit nutzen.',
	'ACP_USERMAP_DATABASE_ENABLE'	=> 'Nutzung der internen Datenbank einschalten?',
	'ACP_USERMAP_POI_TITLE'			=> 'Anzeige von POIs',
	'ACP_USERMAP_POI_TEXT'			=> 'Neben der Anzeige der eingetragenen Mitglieder kann die Mitgliederkarte ein zweites Karten-Overlay mit Punkten von
										besonderem Interesse für die Mitglieder anzeigen, z.B. Treffpunkte und Hotels für Motorradfahrer oder die Standorte
										von Fussball-Stadien. In diesem Abschnitt können die Einstellungen dazu vorgenommen werden.<br>
										Im nächsten Abschnitt kann eine Legende zur Bedeutung verschiedener Kategorien eingegeben werden, diese Legende
										wird dann ebenfalls unter der Mitgliederkarte angezeigt.<br>
										Die Eingabe und das Bearbeiten der POIs muss durch den Administrator erfolgen, die Elemente dazu können über den
										Reiter ´POI Bearbeitung´ erreicht werden.',
	'ACP_USERMAP_POI_ENABLE'		=> 'Anzeige der POIs aktivieren?',
	'ACP_USERMAP_POI_ENABLE_EXP'	=> 'Wird hier ´Ja´ ausgewählt, wird das POI-Overlay bei der Anzeige der Mitgliederkarte aktiviert. Gleichzeitig werden
										die folgende Einstellung und die Anzeige der Legende aktiviert.',
	'ACP_USERMAP_ICON_TITLE'		=> 'Standardwerte für POI-Icons',
	'ACP_USERMAP_ICON_TEXT'			=> 'Hier können Sie die Standardwerte für die Größe und den Ankerpunkt der POI-Icons verändern. Voreingestellt sind die Werte
										für die mit der Mitgliederkarte ausgelieferten Icons. Verwenden Sie eigene Icons, können Sie hier stattdessen deren
										Standardwerte eintragen.<br>Weitere Informationen zu Icons, deren Größe und Ankerpunkt enthält die Datei ´ICONS.md´ im
										Verzeichnis ´docs´.',
	'ACP_USERMAP_ICONSIZE_EXP'		=> 'Größe des Icons in Pixeln in der Notation ´Breite´,´Höhe´.',
	'ACP_USERMAP_ICONANCHOR_EXP'	=> 'Ankerpunkt des Icons in Pixeln ausgehend von der linken oberen Ecke in der Notation ´Horizontaler Wert´,´Vertikaler Wert´.',
	'ACP_USERMAP_POI_LEGEND'		=> 'Legende für die POIs',
	'ACP_USERMAP_POI_LGND'			=> 'Erstellen und Bearbeiten der Legende für das POI-Overlay',
	'ACP_USERMAP_POI_LGND_EXP'		=> 'Der hier eingegebene Text (maximale Länge einschließlich der verwendeten BB-Codes beträgt 1.000 Zeichen) wird bei
										aktivierter Anzeige des POI-Overlays als Legende unterhalb der Mitgliederkarte dargestellt.<br>
										Die Bearbeitung ist unabhängig von den übrigen Einstellungen möglich.',
	// Language packs tab
	'ACP_USERMAP_LANGS'				=> 'Sprachpakete',
	'ACP_USERMAP_LANGS_EXPLAIN'		=> 'Hier können Sie nachträglich weitere Sprachpakete für die Mitgliederkarte installieren. Dies kann notwendig werden,
										wenn Sprachpakete für die Mitgliederkarte nach der ersten Aktivierung hinzugefügt werden, weil deren Daten noch nicht
										in die Auswahlliste für die Länderauswahl aufgenommen wurden; das können Sie hier erledigen, nachdem das Sprachpaket
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
	'ACP_USERMAP_DATABASE_CC_EXP'	=> 'Geben Sie hier den aus 2 Buchstaben bestehenden Ländercode für das Land ein, dem der Eintrag zugeordnet werden soll.',
	'ACP_USERMAP_DATABASE_ZC_EXP'	=> 'Geben Sie hier die Postleitzahl ein, der der Eintrag zugeordnet werden soll, es sind Großbuchstaben, Ziffern und der Bindestrich erlaubt.',
	'ACP_USERMAP_DATABASE_ERROR'	=> 'Das Feld >%1$s< darf nicht leer sein!',
	'ACP_USERMAP_DATABASE_BIG_ERR'	=> 'Das Feld darf nicht leer sein!',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'Die Änderung der internen Datenbank wurde erfolgreich gespeichert.',
	'ACP_USERMAP_DATABASE_INVALID'	=> 'Die verwendete Kombination aus Ländercode und Postleitzahl existiert bereits, sie darf kein weiteres Mal verwendet werden!<br>
										Das Speichern in der internen Datenbank scheiterte!',
	'ACP_USERMAP_CONFIRM_DELETE'	=> 'Sind Sie sicher, dass Sie diesen Eintrag aus der Datenbank löschen möchten?<br>
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
	'ACP_USERMAP_POI_SIZE'			=> 'Icon-Größe',
	'ACP_USERMAP_POI_ANCHOR'		=> 'Icon-Ankerpunkt',
	'ACP_USERMAP_POI_NEW'			=> 'Eingabe eines neuen POI',
	'ACP_USERMAP_POI_EDIT'			=> 'Bearbeitung eines vorhandenen POI',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'Name des Eintrags, wird in der Karte beim Überfahren des POI mit dem Mauszeiger als Tooltip angezeigt.',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'Beschreibung des Eintrages, kann bis zu 500 Zeichen lang sein und darf BB-Code enthalten.<br>
										Wird in der Karte beim Anklicken des POI als Popup-Blase dargestellt.',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'Zur Darstellung von verschiedenen POI-Kategorien kann hier aus verschiedenfarbigen Markern ausgewählt werden.',
	'ACP_USERMAP_POI_SIZE_EXP'		=> 'Größe des Icons in Pixeln in der Notation ´Breite´,´Höhe´.<br>
										Voreingestellt sind die in den ´Einstellungen´ angegebenen Standardwerte.',
	'ACP_USERMAP_POI_ANCHOR_EXP'	=> 'Ankerpunkt des Icons in Pixeln ausgehend von der linken oberen Ecke in der Notation ´Horizontaler Wert´,´Vertikaler Wert´.<br>
										Voreingestellt sind die in den ´Einstellungen´ angegebenen Standardwerte.',
	// UCP
	'MOT_ZIP'						=> 'Postleitzahl',
	'MOT_ZIP_EXP'					=> 'Geben Sie hier die Postleitzahl Ihres Wohnortes ein, damit Sie auf der Mitgliederkarte erscheinen.<br>(Nur Großbuchstaben, Ziffern und Bindestrich erlaubt)',
	'MOT_LAND'						=> 'Land',
	'MOT_LAND_EXP'					=> 'Wählen Sie hier das Land aus, in dem Sie wohnen, damit Sie auf der Mitgliederkarte erscheinen.',
	'MOT_UCP_GEONAMES_ERROR'		=> 'Es wurde durch den Administrator kein Geonames.org Nutzer angegeben, die Daten für die Mitgliederkarte konnten nicht ermittelt werden!',
	// Log entries
	'LOG_USERMAP_GOOGLE_ERROR'		=> '<strong>Die Google Maps API gab bei der Ausführung folgende Fehlermeldung zurück:</strong><br>» %s',
	'LOG_USERMAP_GEONAMES_ERROR'	=> '<strong>Die Geonames API gab bei der Ausführung folgende Fehlermeldung zurück:</strong><br>» %s',
	'LOG_USERMAP_SETTING_UPDATED'	=> '<strong>Einstellungen der Mitgliederkarte geändert</strong>',
	'LOG_POI_LEGEND_UPDATED'		=> '<strong>Text der POI-Legende geändert</strong>',
	'LOG_USERMAP_ZIPCODE_NEW'		=> '<strong>Neuen Datenbank-Eintrag zur Mitgliederkarte hinzugefügt:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_DELETED'	=> '<strong>Datenbank-Eintrag zur Mitgliederkarte gelöscht:</strong><br>» %s',
	'LOG_USERMAP_INSTALL_LANG'		=> '<strong>Sprachpaket zur Mitgliederkarte hnzugefügt:</strong><br>» %s',
	'LOG_USERMAP_POI_NEW'			=> '<strong>Neuen POI zur Mitgliederkarte hinzugefügt:</strong><br>» %s',
	'LOG_USERMAP_POI_EDITED'		=> '<strong>Werte eines POI geändert:</strong><br>» %s',
	'LOG_USERMAP_POI_DELETED'		=> '<strong>POI aus der Mitgliederkarte gelöscht:</strong><br>» %s',
	'LOG_USERMAP_POI_APPROVED'		=> '<strong>Durch Mitglied erstellten POI freigegeben:</strong><br>» %s',
	'LOG_USERMAP_POI_MOD_DELETED'	=> '<strong>Durch Mitglied erstellten POI gelöscht:</strong><br>» %s',
));
