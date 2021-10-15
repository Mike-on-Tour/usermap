<?php
/**
*
* @package Usermap v1.1.2
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
	'USERMAP'						=> 'Mapa Użytkowników',
	'USERMAP_NOT_AUTHORIZED'		=> 'Nie masz wystarczających uprawnień do przeglądania Mapy Użytkowników. Wpisz Kod Pocztowy w Profilu!',
	'USERMAP_SEARCHFORM'			=> 'Wyszukiwanie',
	'USERMAP_LEGEND'				=> 'Legenda',
	'USERMAP_CREDENTIALS'			=> 'Odniesienia geograficzne używane przez Mapę Użytkowników dzięki uprzejmości: ',
	'USERMAP_LEGEND_TEXT'			=> 'Zmień powiększenie kółkiem myszy, klikając mapę lub użyj +/- w lewym górnym rogu mapy',
	'MAP_USERS'						=> [
		0	=> 'Obecnie na Mapie Użytkowników nie widać żadnego Użytkownika forum.',
		1	=> 'Obecnie na Mapie Użytkowników jest %1$d Użytkownik forum.',
		2	=> 'Obecnie na Mapie Użytkowników jest %1$d Użytkowników forum.',
	],
	'POI_COUNT'						=> [
		0	=> 'Obecnie na Mapie Użytkowników nie ma żadnego punktu POI.',
		1	=> 'Obecnie na Mapie Użytkowników jest pokazany %1$d POI.',
		2	=> 'Obecnie na Mapie Użytkowników pokazujemy %1$d POI.',
	],
	// Search tabs
	'TAB_RADIUS_SEARCH'				=> 'Szukaj w okolicy według kodu pocztowego',
	'TAB_MEMBER_SEARCH'				=> 'Wyszukaj użytkowników',
	'TAB_POI_SEARCH'				=> 'Wyszukaj POI',
	'TAB_ADDRESS_SEARCH'			=> 'Wyszukiwarka w Mapach Google',
	'MAP_SEARCH'					=> 'Szukaj Użytkowników po kodzie pocztowym %1$s w zasięgu ',
	'MAP_RESULT'					=> 'Pokazuje następujący wynik:',
	'MAP_NORESULT'					=> 'Nie znaleziono użytkowników w zasięgu ',
	'MAP_KM'						=> 'km',
	'MEMBERNAME_SEARCH'				=> 'Wprowadź nazwę użytkownika (dozwolone są symbole wieloznaczne *)',
	'MEMBERNAME_RESULT'				=> 'Znaleziono następujących użytkowników:',
	'MEMBERNAME_NORESULT'			=> 'Nie ma użytkowników o nazwie odpowiadającej Twojemu żądaniu.',
	'POINAME_SEARCH'				=> 'Wpisz nazwę punktu POI (dozwolone są symbole wieloznaczne *)',
	'POINAME_RESULT'				=> 'Znaleziono następujące punkty POI:',
	'POINAME_NORESULT'				=> 'Nie ma punktów POI o nazwie odpowiadającej Twojemu żądaniu.',
	'ADDRESS_SEARCH'				=> 'Wprowadź wyszukiwane hasło (np. adres), dla którego chcesz znaleźć współrzędne (np. w celu utworzenia POI)',
	'ADDRESS_RESULT'				=> 'Wyszukiwane hasło zostało znalezione i jest wyświetlane ze znacznikiem na mapie.',
	'ADDRESS_NORESULT'				=> 'Nie można pobrać współrzędnych pasujących do podanego wyszukiwanego hasła.',
	// Legend
	'POI_LEGEND_TITLE'				=> 'Legenda do POIs',
	'STREET_DESC'					=> 'Mapa ulic',
	'TOPO_DESC'						=> 'Mapa topograficzna',
	'SAT_DESC'						=> 'Mapa satelitarna',
	// Permission overview
	'USERMAP_PERM_OVERVIEW'			=> 'Uprawnienia na tej stronie',
	'USERMAP_PERM_VIEW_ALWAYS'		=> '<strong>Możesz</strong> zawsze widzieć użytkowników.<br>',
	'USERMAP_PERM_VIEW_SUBSCRIBED'	=> '<strong>Możesz</strong> widzieć użtkowników tylko wtedy, gdy jesteś zarejestrowany w Mapie Użytkowników.<br>',
	'USERMAP_NO_VIEW_SUBSCRIBED'	=> '<strong>Nie możesz</strong> widzieć użytkowników.<br>',
	'USERMAP_PERM_VIEW_POI'			=> '<strong>Możesz</strong> widzieć POI.<br>',
	'USERMAP_NO_VIEW_POI'			=> '<strong>Nie możesz</strong> widzieć POI.<br>',
	'USERMAP_NO_ADD_POI'			=> '<strong>Nie możesz</strong> tworzyć punktów POI.<br>',
	'USERMAP_PERM_ADD_POI'			=> '<strong>Możesz</strong> tworzyć punkty POI bez zgody moderatora.<br>',
	'USERMAP_PERM_ADD_POI_MOD'		=> '<strong>Możesz</strong> tworzyć punkty POI za zgodą moderatora.<br>',
	// Error messages
	'USERMAP_GN_USER_ERROR'			=> ': Użytkownik Geonames nie istnieje lub nie jest aktywowany w tej usłudze!',
	// User POI popup
	'POI_INPUT_EXPL'				=> 'W tym formularzu możesz utworzyć nowe POI. Jego współrzędne zostaną przejęte ze znacznika na mapie po lewej stronie tego formularza.
										Ten znacznik można przeciągać, można go przesuwać myszą do miejsca docelowego. Jego nazwę, opis, a także
										ikonę, za pomocą której później będzie przedstawiony znacznik, można wprowadzić lub wybrać w kolejnych polach formularza.',
	'POI_NEW_SAVED'					=> 'Utworzony punkt POI został pomyślnie zapisany w bazie danych i jest wyświetlany na mapie.',
	'POI_MOD_NOTIFIED'				=> 'Utworzony punkt POI został pomyślnie zapisany w bazie danych, moderatorzy zostali o tym powiadomieni, oczekuje na akceptację.',
	'ACP_USERMAP_POI_NAME'			=> 'Nazwa POI',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'Nazwa tego punktu POI jest wyświetlana jako dymek podpowiedzi, gdy wskaźnik myszy przesuwa się nad znacznikiem POI.',
	'ACP_USERMAP_POI_POPUP'			=> 'Opis POI',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'Opis tego POI, może zawierać do 500 znaków i może zawierać kod BBCode.<br>
										Ten tekst jest wyświetlany w wyskakującym okienku po kliknięciu znacznika POI wskaźnikiem myszy.',
	'ACP_USERMAP_POI_ICON'			=> 'Plik ikon',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'Aby ułatwić podstawową kategoryzację punktów POI, możesz wybrać ikony znaczników w różnych kolorach.',
	'ACP_USERMAP_POI_SIZE'			=> 'Rozmiar ikony',
	'ACP_USERMAP_POI_SIZE_EXP'		=> 'Rozmiar ikony w pikselach w notacji „szerokość”, „wysokość”.<br>
										Wartość początkowa to domyślny rozmiar podany w zakładce „Ustawienia”.',
	'ACP_USERMAP_POI_ANCHOR'		=> 'Kotwica ikony',
	'ACP_USERMAP_POI_ANCHOR_EXP'	=> 'Zakotwiczenie ikony w pikselach, począwszy od lewego górnego rogu w notacji „wartość pozioma”, „wartość pionowa”.<br>
										Wartość początkowa to wartość domyślna podana w zakładce „Ustawienia”.',
	'ACP_USERMAP_DATABASE_LAT'		=> 'Szerokość geograficzna',
	'ACP_USERMAP_DATABASE_LNG'		=> 'Długość geograficzna',
	'ACP_USERMAP_POI_LAYER'			=> 'Nakładka mapy',
	'ACP_USERMAP_POI_LAYER_EXP'		=> 'Wybierz nakładkę mapy, na której ten punkt POI będzie wyświetlany.',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'Zmiany wewnętrznej bazy danych zostały pomyślnie zapisane.',
	'ACP_USERMAP_CONFIRM_DELETE'	=> 'Czy na pewno chcesz usunąć ten element z bazy danych?<br>
										<strong>Spowoduje to trwałe usunięcie elementu z bazy danych i nie można tego cofnąć!</strong>',
	'USERMAP_POI_NAME_ERROR'		=> 'Pole >%1$s< nie może być puste!',
	// Notifications
	'NOTIFICATION_USERMAP_MOD'		=> 'Powiadomienia o moderacji dla Mapy Użytkowników',
	'USERMAP_SETTING_APPROVE'		=> 'Nowo utworzony punkt POI oczekuje na zatwierdzenie',
	'USERMAP_SETTING_NOTIFY'		=> 'Ktoś dodał nowy punkt POI do Mapy Użytkowników',
	'USERMAP_NOTIFY_POI_APPROVE'	=> '<strong>Nowy punkt POI czeka na zatwierdzenie</strong><br>Nowy punkt POI o nazwie „<strong>%1$s</strong>“ został utworzony przez użytkownika „%2$s“ i czeka na zatwierdzenie.',
	'USERMAP_NOTIFY_POI'			=> '<strong>POI dodane.</strong><br>Użytkownik „%2$s“ dodał nowy POI nazwany „<strong>%1$s</strong>“ do Mapy Użytkowników.',
	// Moderation
	'POI_MOD_EXPL'					=> 'Tutaj możesz sprawdzić dane użytkownika, który utworzył nowe POI i edytować je, jeśli uznasz to za konieczne lub chcesz to zrobić z
										innych powód. Możesz ustawić marker, przeciągając go myszą. Po zakończeniu tego procesu możesz albo zapisać punkt POI (i
										zatwierdzić go), albo usunąć go, jeśli nie pasuje do polityki forum.',
	'USERMAP_MOD_NOT_AUTHORIZED'	=> '<strong>Nie możesz rozpocząć tej czynności!</strong>',
	'POI_NONEXISTENT'				=> 'POI nie istnieje',
	'POI_ALREADY_APPROVED'			=> 'Ten punkt POI został już zatwierdzony!',
	'APPROVE'						=> 'Zatwierdź',
	'DONE'							=> 'Gotowe',
	'POI_APPROVED'					=> 'POI zatwierdzono pomyślnie.',
	'ACTION_CONCLUDED'				=> 'Działanie zakończone.',
	'CHANGES_SUCCESSFUL'			=> 'Ewentualne zmiany zostały pomyślnie zapisane.',
	'BACK_TO_USERMAP'				=> 'Powrót do Mapy Użytkowników',
	// UCP
	'MOT_ZIP'						=> 'Kod pocztowy',
	'MOT_ZIP_EXP'					=> 'Wpisz, proszę Kod Pocztowy swojej lokalizacji żeby została wyświetlona na Mapie Użytkowników.<br>(Format Kodu Pocztowego: XX-XXX)',
	'MOT_LAND'						=> 'Kraj',
	'MOT_LAND_EXP'					=> 'Proszę, wybierz kraj, w którym mieszkasz żeby wyświetlić na Mapie Użytkowników.',
	'MOT_UCP_GEONAMES_ERROR'		=> 'Administrator nie udostępnił użytkownika Geonames.org, dlatego nie można pobrać danych Mapy Użytkowników!',
	// Log entries
	'LOG_USERMAP_SETTING_UPDATED'	=> '<strong>Zmieniono ustawienia Mapy Użytkowników</strong>',
	'LOG_POI_LEGEND_UPDATED'		=> '<strong>Legenda POI została zmieniona</strong>',
	'LOG_USERMAP_INSTALL_LANG'		=> '<strong>Dodano pakiet językowy do Mapy Użytkowników:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_NEW'		=> '<strong>Dodano nowy wpis w bazie danych do Mapy Użytkowników:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_DELETED'	=> '<strong>Usunięto wpis bazy danych z Mapy Użytkowników:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_EDIT'		=> '<strong>Edytowano wpis bazy danych w Mapie Użytkowników:</strong><br>» %s',
	'LOG_USERMAP_POI_NEW'			=> '<strong>Dodano nowy punkt POI do Mapy Użytkowników:</strong><br>» %s',
	'LOG_USERMAP_POI_EDITED'		=> '<strong>Zmienione dane POI:</strong><br>» %s',
	'LOG_USERMAP_GOOGLE_ERROR'		=> '<strong>Interfejs API Map Google nie wykonał się z następującym komunikatem o błędzie:</strong><br>» %s',
	'LOG_USERMAP_GEONAMES_ERROR'	=> '<strong>Interfejs API Geonames nie wykonał się z następującym komunikatem o błędzie:</strong><br>» %s',
	'LOG_USERMAP_POI_DELETED'		=> '<strong>Usunięto punkt POI z Mapy Użytkowników:</strong><br>» %s',
	'LOG_USERMAP_POI_APPROVED'		=> '<strong>Zatwierdzono POI utworzony przez użytkownika:</strong><br>» %s',
	'LOG_USERMAP_POI_MOD_DELETED'	=> '<strong>Usunięto POI utworzone przez użytkownika:</strong><br>» %s',
	// Profile
	'USERMAP_PROFILE_LINK'			=> '<strong>Pokaż tego użytkownika na Mapie Użytkowników</strong>',
]);
