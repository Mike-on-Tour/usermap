<?php
/**
*
* @package Usermap v1.2.5
* @copyright (c) 2020 - 2024 Mike-on-Tour
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
//
// Some characters you may want to copy&paste:
// ’ » „ “ — …
//

$lang = array_merge($lang, [
	// ACP
	'ACP_USERMAP'						=> 'Mitgliederkarte',
	'ACP_USERMAP_VERSION'				=> '<img src="https://img.shields.io/badge/Version-%1$s-green.svg?style=plastic"><br>&copy; 2020 - %2$d by Mike-on-Tour',
	'ACP_SUPPORT_USERMAP'				=> 'Wenn du die Entwicklung der Mitgliederkarte unterstützen möchtest, kannst du das hier tun:<br>',
	'ACP_USERMAP_PAYPAL_TITLE'			=> 'PayPal - Der sicherere, einfachere Weg um online zu bezahlen!',
	'ACP_USERMAP_PAYPAL_ALT'			=> 'Spende mit PayPal Button',

	// Settings tab
	'ACP_USERMAP_SETTINGS'				=> 'Einstellungen',
	'ACP_USERMAP_SETTINGS_EXPLAIN'		=> 'Hier kannst du die Einstellungen für die Mitgliederkarte ändern.',
	'ACP_USERMAP_ALLOW_URL_FOPEN'		=> 'Die PHP-Option `allow_url_fopen` ist deaktiviert! Zur ordnungsgemäßen Funktion von Usermap muss sie aktiviert sein!',
	'ACP_USERMAP_SETTING_SAVED'			=> 'Die Einstellungen für die Mitgliederkarte wurden erfolgreich gesichert.',
	'ACP_USERMAP_GENERAL_SETTINGS'		=> 'Allgemeine Einstellungen',
	'ACP_USERMAP_ROWS_PER_PAGE'			=> 'Zeilen pro Tabellenseite',
	'ACP_USERMAP_ROWS_PER_PAGE_EXP'		=> 'Wähle hier die Anzahl der Zeilen, die pro Tabellenseite in den anderen Reitern angezeigt werden soll.',
	'ACP_USERMAP_MAPSETTING_TITLE'		=> 'Karteneinstellungen',
	'ACP_USERMAP_MAPSETTING_TEXT'		=> 'Einstellungen für das Kartenzentrum und die Vergrößerung beim Start.',
	'ACP_USERMAP_LAT'					=> 'Geogr. Breite des Kartenzentrums',
	'ACP_USERMAP_LAT_EXP'				=> 'Werte zwischen 90.0 (Nordpol) und -90.0 (Südpol)',
	'ACP_USERMAP_LON'					=> 'Geogr. Länge des Kartenzentrums',
	'ACP_USERMAP_LON_EXP'				=> 'Werte zwischen 180.0 (Osten) und -180.0 (Westen)',
	'ACP_USERMAP_ZOOM'					=> 'Zoom-Faktor der Mitgliederkarte beim Aufruf',
	'ACP_USERMAP_MARKERS_TEXT'			=> 'Hier kannst du die Größe der Marker zur Darstellung der Mitglieder in der Karte unabhängig voneinander sowohl für die
											Anzeige auf Computern (Desktop, Laptop, Notebook, Netbook, Tablet) als auch auf mobilen Geräten (Smartphone)
											auswählen.<br>
											Die Größe wird als Radius des als Marker verwendeten Kreises angegeben, die Einheit sind Pixel.',
	'ACP_USERMAP_MARKERS_PC'			=> 'Radius des Kreises auf Computern',
	'ACP_USERMAP_MARKERS_MOB'			=> 'Radius des Kreises auf mobilen Geräten',
	'ACP_USERMAP_GEONAMES_TITLE'		=> 'Benutzername für geonames.org',
	'ACP_USERMAP_GEONAMES_TEXT'			=> 'Die Mitgliederkarte verwendet den Service von geonames.org zum Ermitteln der geogr.
											Koordinaten des über Postleitzahl und Land angegebenen Ortes sowie zur Verfeinerung den
											angegebenen Wohnort.
											Dafür wird eine Registrierung auf %1$s benötigt. Der dort registrierte Benutzername wird hier eingegeben.<br>
											Pro Abfrage wird ein Kredit-Punkt angerechnet, im kostenlosen Service sind pro Stunde
											maximal 1.000 Kredit-Punkte verfügbar; bei Foren mit mehr als 1.000 Benutzern wird empfohlen,
											pro 1.000 - 1.500 Mitgliedern je einen Benutzernamen anzumelden. Ansonsten könnte den
											Benutzern eine Fehlermeldung bei Eingabe von Postleitzahl und Land im Profil angezeigt
											werden, wenn beim Absenden die Koordinate ermittelt wird.<br>
											Mehrere Benutzernamen sind durch Kommata zu trennen.<br>
											<strong>ACHTUNG:</strong> Benutzer müssen nach dem ersten Login auf geonames.org über diesen %2$sLink</span></a>
											gesondert für den gewünschten Service freigeschaltet werden!!',
	'ACP_USERMAP_GEONAMESUSER'			=> 'Benutzername(n) für geonames.org',
	'ACP_USERMAP_GEONAMESUSER_ERR'		=> 'Du musst mindestens einen gültigen Benutzernamen für geonames.org eingeben!',
	'ACP_USERMAP_PROFILE_ERROR'			=> 'Diese Aktion konnte nicht abgeschlossen werden, da du noch keinen Geonames.org Nutzer in den Einstellungen der Mitgliederkarte angegeben hast. Tue dies bitte jetzt!',
	'ACP_USERMAP_GOOGLE_TITLE'			=> 'Einstellungen zur Nutzung der Google Maps API',
	'ACP_USERMAP_GOOGLE_TEXT'			=> 'geonames.org liefert nur für bestimmte Länder ein Ergebnis (vgl. dazu diese %1$sListe</span></a>),
											sollen hier nicht aufgeführte Länder bei der Abfrage berücksichtigt werden, kann hierzu der Service von Google Maps
											genutzt werden. Diese Nutzung kannst du hier einschalten.<br>
											Dazu wird ein API Key benötigt, den du durch Anmeldung bei %2$sGoogle Maps API Key</span></a> erhälst. Folge bitte den
											dortigen Anweisungen und beachte, dass du die ´Geocoding API´ aktivieren musst.',
	'ACP_USERMAP_GOOGLE_ENABLE'			=> 'Nutzung der Google Maps API einschalten?',
	'ACP_USERMAP_GOOGLE_KEY'			=> 'Gib hier den Google Maps API Key ein',
	'ACP_USERMAP_APIKEY_ERROR'			=> 'Du musst einen Google Maps API Key angeben, wenn du die Google Maps API aktivierst!',
	'ACP_USERMAP_GOOGLE_FORCE'			=> 'Ländercode für Länder, die immer bei Google Maps API nachgeschlagen werden',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'		=> 'geonames.org wertet aus Copyright-Gründen für einige Länder nur Teile der Postleitzahl aus, dies führt zu sehr groben
											Ergebnissen beim Feststellen der Koordinaten, die betroffenen Länder kannst du %1$shier</span></a>nachlesen.<br>
											Die Google Maps API kann für diese Länder genauere Ergebnisse liefern. Wenn du für diese Länder die Ergebnisse der
											Google Maps API statt geonames.org erzwingen willst, gib die Ländercodes dieser Länder hier ein, getrennt durch Kommata.',
	'ACP_USERMAP_DATABASE_TITLE'		=> 'Nutzung der internen Datenbank',
	'ACP_USERMAP_DATABASE_TEXT'			=> 'Da auch Google Maps für manche Länder (z.B. Israel) kein Ergebnis liefert, kannst du eine Tabelle der internen Datanbank
											für die Abfrage nutzen, allerdings musst du dafür die Daten bereitstellen. Dies kannst du durch Auswahl des Reiters
											´Interne Datenbank´ tun.<br>
											Du kannst für Nutzer, die in einem von geonames.org nicht unterstützten Land leben, auch ohne Nutzung der Google Maps API
											diese Möglichkeit nutzen.',
	'ACP_USERMAP_DATABASE_ENABLE'		=> 'Nutzung der internen Datenbank einschalten?',
	'ACP_USERMAP_POI_TITLE'				=> 'Anzeige von POIs',
	'ACP_USERMAP_POI_TEXT'				=> 'Neben der Anzeige der eingetragenen Mitglieder kann die Mitgliederkarte weitere Karten-Overlays mit Punkten von
											besonderem Interesse für die Mitglieder anzeigen, z.B. Treffpunkte und Hotels für Motorradfahrer oder die Standorte
											von Fussball-Stadien. In diesem Abschnitt können die Einstellungen dazu vorgenommen werden.<br>
											Im nächsten Abschnitt kann eine Legende zur Bedeutung verschiedener Kategorien eingegeben werden, diese Legende
											wird dann ebenfalls unter der Mitgliederkarte angezeigt.<br>
											Die Eingabe und das Bearbeiten der POIs kann durch den Administrator erfolgen, die Elemente dazu können über den
											Reiter ´POI Bearbeitung´ erreicht werden.',
	'ACP_USERMAP_POI_ENABLE'			=> 'Anzeige der POIs aktivieren?',
	'ACP_USERMAP_POI_ENABLE_EXP'		=> 'Wird hier ´Ja´ ausgewählt, werden POI-Overlays bei der Anzeige der Mitgliederkarte aktiviert. Gleichzeitig werden
											die folgende Einstellung und die Anzeige der Legende aktiviert.',
	'ACP_USERMAP_ICON_TITLE'			=> 'Standardwerte für POI-Icons',
	'ACP_USERMAP_ICON_TEXT'				=> 'Hier kannst du die Standardwerte für die Größe und den Ankerpunkt der POI-Icons verändern. Voreingestellt sind die Werte
											für die mit der Mitgliederkarte ausgelieferten Icons. Verwendest du eigene Icons, kannst du hier stattdessen deren
											Standardwerte eintragen.<br>Weitere Informationen zu Icons, deren Größe und Ankerpunkt enthält die Datei ´ICONS.md´ im
											Verzeichnis ´docs´.',
	'ACP_USERMAP_ICONSIZE_EXP'			=> 'Größe des Icons in Pixeln in der Notation ´Breite´,´Höhe´.',
	'ACP_USERMAP_ICONANCHOR_EXP'		=> 'Ankerpunkt des Icons in Pixeln ausgehend von der linken oberen Ecke in der Notation ´Horizontaler Wert´,´Vertikaler Wert´.',
	'ACP_USERMAP_POI_LEGEND'			=> 'Legende für die POIs',
	'ACP_USERMAP_POI_LGND'				=> 'Erstellen und Bearbeiten der Legende für das POI-Overlay',
	'ACP_USERMAP_POI_LGND_EXP'			=> 'Der hier eingegebene Text (maximale Länge einschließlich der verwendeten BB-Codes beträgt 1.000 Zeichen) wird bei
											aktivierter Anzeige des POI-Overlays als Legende unterhalb der Mitgliederkarte dargestellt.<br>
											Die Bearbeitung ist unabhängig von den übrigen Einstellungen möglich.',
	// Language packs tab
	'ACP_USERMAP_LANGS'					=> 'Sprachpakete',
	'ACP_USERMAP_LANGS_EXPLAIN'			=> 'Hier kannst du nachträglich weitere Sprachpakete für die Mitgliederkarte installieren. Dies kann notwendig werden,
											wenn Sprachpakete für die Mitgliederkarte nach der ersten Aktivierung hinzugefügt werden, weil deren Daten noch nicht
											in die Auswahlliste für die Länderauswahl aufgenommen wurden; das kannst du hier erledigen, nachdem das Sprachpaket
											per FTP in das Unterverzeichnis <i>language</i> dieser Erweiterung kopiert wurde.',
	'ACP_USERMAP_INSTALLABLE_LANG'		=> 'Zur Installation verfügbare Sprachpakete',
	'ACP_USERMAP_INSTALL_LANG_EXP'		=> 'Hier sind alle Sprachpakete der Mitgliederkarte aufgelistet, die noch installiert werden müssen.',
	'ACP_USERMAP_MISSING_LANG'			=> 'Fehlende Sprachpakete',
	'ACP_USERMAP_MISSING_LANG_EXP'		=> 'Hier sind die Sprachpakete aufgelistet, die im Board installiert sind, aber in der Mitgliederkarte fehlen.',
	'ACP_USERMAP_ADDITIONAL_LANG'		=> 'Zusätzliche Sprachpakete der Mitgliederkarte',
	'ACP_USERMAP_ADD_LANG_EXP'			=> 'Hier sind die Sprachpakete der Erweiterung aufgelistet, für die in diesem Board keine Sprache installiert ist.',
	'ACP_USERMAP_LANGPACK_NAME'			=> 'Name',
	'ACP_USERMAP_LANGPACK_LOCAL'		=> 'Lokaler Name',
	'ACP_USERMAP_LANGPACK_ISO'			=> 'ISO',
	'ACP_USERMAP_NO_ENTRIES'			=> 'Keine Sprachpakete gefunden',
	// Internal database tab
	'ACP_USERMAP_DATABASE'				=> 'Interne Datenbank',
	'ACP_USERMAP_DATABASE_EXPLAIN'		=> 'Hier werden tabellarisch alle vorhandenen Einträge der internen Datenbank aufgelistet. Über die Verknüpfungen der rechten
											Spalte können diese Einträge gelöscht werden.<br>
											Unterhalb dieser Tabelle können neue Einträge hinzugefügt werden.',
	'ACP_USERMAP_DATABASE_DATA'			=> 'In der internen Datenbank enthaltene Daten',
	'ACP_USERMAP_DATABASE_CC'			=> 'ISO Ländercode',
	'ACP_USERMAP_DATABASE_ZIPCODE'		=> 'Postleitzahl',
	'ACP_USERMAP_DATABASE_NAME'			=> 'Ortsname',
	'ACP_USERMAP_DATABASE_EDIT'			=> 'Datenbank-Eintrag bearbeiten',
	'ACP_USERMAP_DATABASE_NOENTRY'		=> 'Keine Daten vorhanden',
	'ACP_USERMAP_DATABASE_NEW'			=> 'Neuer Datenbank-Eintrag',
	'ACP_USERMAP_DATABASE_CC_EXP'		=> 'Gib hier den aus 2 Buchstaben bestehenden Ländercode für das Land ein, dem der Eintrag zugeordnet werden soll.',
	'ACP_USERMAP_DATABASE_ZC_EXP'		=> 'Gib hier die Postleitzahl ein, der der Eintrag zugeordnet werden soll, es sind Großbuchstaben, Ziffern und der Bindestrich erlaubt.',
	'ACP_USERMAP_DATABASE_NAME_EXP'		=> 'Du kannst hier zur besseren Unterscheidung einen Namen für diesen Ort vergeben.',
	'ACP_USERMAP_DATABASE_ERROR'		=> 'Das Feld >%1$s< darf nicht leer sein!',
	'ACP_USERMAP_DATABASE_BIG_ERR'		=> 'Das Feld darf nicht leer sein!',
	'ACP_USERMAP_DATABASE_INVALID'		=> 'Die verwendete Kombination aus Ländercode und Postleitzahl existiert bereits, sie darf kein weiteres Mal verwendet werden!<br>
											Das Speichern in der internen Datenbank scheiterte!',
	// POI tab
	'ACP_USERMAP_POI'					=> 'POI Bearbeitung',
	'ACP_USERMAP_POI_EXPLAIN'			=> 'Hier werden die bisher angelegten POIs tabellarisch aufgelistet.<br>
											Im unteren Teil können neue Einträge angelegt werden, hier werden auch nach Auswahl des Links zum Ändern in der Tabelle
											die bisherigen Daten des Eintrages zum Bearbeiten angezeigt.<br>
											Über den entsprechenden Link in der Tabelle können einzelne Einträge gelöscht werden.',
	'ACP_USERMAP_POI_DATA'				=> 'Gespeicherte POI-Einträge',
	'ACP_USERMAP_SELECT_POI_LAYER'		=> 'Auswahl der Kartenebene',
	'ACP_USERMAP_POI_LAYER_ALL'			=> 'Alle',
	'ACP_USERMAP_POI_CREATOR'			=> 'Ersteller',
	'ACP_USERMAP_POI_VISIBLE'			=> 'POI sichtbar',
	'ACP_USERMAP_POI_VISIBLE_EXP'		=> 'Wähle hier, ob dieser POI auf der gewählten Kartenebene angezeigt werden soll.',
	'ACP_USERMAP_POI_NEW'				=> 'Eingabe eines neuen POI',
	'ACP_USERMAP_POI_EDIT'				=> 'Bearbeitung eines vorhandenen POI',
	'ACP_USERMAP_POI_SUCCESS'			=> 'Der POI mit dem Namen „<strong>%1$s</strong>“ wurde erfolgreich gespeichert.',
	'ACP_USERMAP_POI_DELETE'			=> 'Bist du dir sicher, dass du den POI „<strong>%1$s</strong>“ aus der Datenbank löschen möchtest?<br>
											<strong>Dieser Vorgang kann nicht rückgängig gemacht werden!</strong>',
	'ACP_USERMAP_POI_DEL_SUCCESS'		=> 'Der POI „<strong>%1$s</strong>“ wurde aus der Datenbank gelöscht.',
	'ACP_ERR_POI_NO_NAME'				=> 'Das Feld „Name des Eintrages“ darf nicht leer sein!',
	'ACP_ERR_POI_NO_LAT'				=> 'Das Feld „Geogr. Breite“ darf nicht leer sein!',
	'ACP_ERR_POI_NO_LNG'				=> 'Das Feld „Geogr. Länge“ darf nicht leer sein!',
	// Layer tab
	'ACP_USERMAP_LAYER'					=> 'Kartenebenen',
	'ACP_USERMAP_LAYER_EXPLAIN'			=> 'Hier werden vorhandene Kartenebenen (Layer) tabellarisch aufgelistet.<br>
											Im unteren Teil können neue Kartenebenen hinzufügt werden. Hier werden nach Auswahl des Links zum Ändern in der Tabelle
											die bisherigen Daten der Kartenebene zum Bearbeiten angezeigt.<br>
											Über den entsprechenden Link in der Tabelle können einzelne Einträge gelöscht werden.',
	'ACP_USERMAP_LAYER_SELECT_TYPE'		=> 'Auswahl des anzuzeigenden Kartenebenen-Typs',
	'ACP_USERMAP_LAYER_DATA'			=> 'Vorhandene Kartenebenen',
	'ACP_USERMAP_LAYER_NAME'			=> 'Name der Ebene',
	'ACP_USERMAP_LAYER_NAME_EXP'		=> 'Gib hier einen Namen ein, unter dem du diese Kartenebene erkennen kannst.',
	'ACP_USERMAP_LAYER_TYPE_USER'		=> 'Mitglieder',
	'ACP_USERMAP_LAYER_TYPE_POI'		=> 'POI',
	'ACP_USERMAP_LAYER_ACTIVE'			=> 'Ebene aktiviert',
	'ACP_USERMAP_LAYER_ACTIVE_EXP'		=> 'Wähle hier „Ja“, wenn diese Kartenebene aktiv, also benutzbar sein soll. Deaktivierte Kartenebenen können nicht für
											die Anzeige ausgewählt werden.',
	'ACP_USERMAP_SHOW_LAYER'			=> 'Immer anzeigen',
	'ACP_USERMAP_SHOW_LAYER_EXP'		=> 'Wähle hier „Ja“, wenn diese Kartenebene immer sichtbar sein soll, also schon beim Aufruf der Mitgliederkarte.<br>
											Wenn du „Nein“ wählst, muss der Nutzer die Anzeige dieser Kartenebene über die Anzeige-Kontrolle aktivieren.',
	'ACP_USERMAP_LAYER_CLUSTERS'		=> 'Marker bündeln',
	'ACP_USERMAP_LAYER_CLUSTERS_EXP'	=> 'Wenn du diese Einstellung aktivierst, werden die Marker zur Darstellung auf der Karte gebündelt.
											Damit kann eine Überfrachtung der Karte mit Markern verhindert werden.',
	'ACP_USERMAP_LAYER_LANG_VAR'		=> 'Sprachvariablen',
	'ACP_USERMAP_LAYER_LANG_VAR_EXP'	=> 'Gib hier die Begriffe ein, die in den auf deinem Board installierten Sprachen den Nutzern in der Anzeige-Kontrolle
											als Benennung dieser Kartenebene angezeigt werden sollen, beispielsweise „Campingplätze“ zur Bezeichnung einer
											Kartenebene zur Anzeige von Campingplätzen.<br>
											Beachte dabei, dass dazu das Sprachkürzel (Spalte „ISO“ aus der Tabelle der Sprachen-Verwaltung im Reiter „Anpassen“)
											gefolgt von einem Doppelpunkt und der gewünschten Bezeichnung eingegeben werden muss, damit die Eingabe erkannt wird.<br>
											<strong>%1$sBeispiel:</span></strong> „de:Campingplätze“<br>
											Für jede Kombination aus Sprachkürzel und Begriff MUSS eine eigene Zeile benutzt werden!<br>
											<strong>%1$sACHTUNG: Für das Sprachkürzel „en“ MUSS IMMER eine Eingabe erfolgen!</span></strong>',
	'ACP_USERMAP_LAYER_DEFAULTICON'		=> 'Standard-Icon',
	'ACP_USERMAP_LAYER_ICON_EXP'		=> 'Wähle hier die Icon-Datei, die in dieser Kartenebene als Standard gilt. Sie wird automatisch für alle POIs angezeigt,
											die für diese Kartenebene erstellt werden.',
	'ACP_USERMAP_GROUPS_VIEWING'		=> 'Erlaubte Gruppen',
	'ACP_USERMAP_PERMITTED_GROUPS'		=> 'Gruppen, die diese Ebene sehen dürfen',
	'ACP_USERMAP_PERMITTED_GROUPS_EXP'	=> 'Kartenebenen für Mitglieder können angezeigt werden, wenn eine Berechtigung zum Sehen der Mitglieder vergeben wurde,
											Kartenebenen für POIs können angezeigt werden, wenn POIs aktiviert wurden und die Berechtigung zum Sehen von POIs
											vergeben wurde.<br>
											Hier kannst du diese Berechtigungen individuell für jede Kartenebene auf bestimmte Hauptgruppen mit diesen
											Berechtigungen weiter beschränken, indem du die Gruppen auswählst, die diese Kartenebene sehen sollen.<br>
											Mehrfachauswahl durch Halten der Shift- bzw. Strg-Taste und Anklicken der gewünschten Gruppen.',
	'ACP_USERMAP_LAYER_NEW'				=> 'Neue Kartenebene erstellen',
	'ACP_USERMAP_LAYER_EDIT'			=> 'Vorhandene Kartenebene bearbeiten',
	'ACP_USERMAP_LAYER_SUCCESS'			=> 'Die Kartenebene mit dem Namen „<strong>%1$s</strong>“ wurde erfolgreich gespeichert.',
	'ACP_USERMAP_LAYER_DELETE'			=> 'Bist du dir sicher, dass du die Kartenebene „<strong>%1$s</strong>“ aus der Datenbank löschen möchtest?<br>
											Alle dieser Kartenebene zugeordneten POIs können nicht mehr angezeigt werden!<br>
											<strong>Dieser Vorgang kann nicht rückgängig gemacht werden!</strong>',
	'ACP_USERMAP_LAYER_DEL_SUCCESS'		=> 'Die Kartenebene „<strong>%1$s</strong>“ wurde aus der Datenbank gelöscht.',
	'ACP_ERR_LAYER_NO_NAME'				=> 'Das Feld „Name der Ebene“ darf nicht leer sein!',
	'ACP_ERR_LAYER_NO_LANG'				=> 'Das Feld „Sprachvariablen“ darf nicht leer sein!',
	'ACP_ERR_LAYER_INCORRECT'			=> 'Diese Sprachvariable ist nicht korrekt: ',
	'ACP_ERR_LAYER_NO_EN'				=> 'Die Sprachvariable „en“ fehlt!',
	// Route tab
	'ACP_USERMAP_ROUTE'					=> 'Routen',
	// Logs
	'LOG_USERMAP_LAYER_NEW'				=> '<strong>Neue Kartenebene zur Mitgliederkarte hinzugefügt:</strong><br>» %s',
	'LOG_USERMAP_LAYER_EDITED'			=> '<strong>Werte einer Kartenebene geändert:</strong><br>» %s',
	'LOG_USERMAP_LAYER_DELETED'			=> '<strong>Kartenebene aus der Mitgliederkarte gelöscht:</strong><br>» %s'
]);
