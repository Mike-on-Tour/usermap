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
	'USERMAP'						=> 'Mapa Użytkowników',
	'USERMAP_NOT_AUTHORIZED'		=> 'Nie masz wystarczających uprawnień do przeglądania Mapy Użytkowników. Wpisz Kod Pocztowy w Profilu!',
	'USERMAP_SEARCHFORM'			=> 'Wyszukiwanie',
	'USERMAP_LEGEND'				=> 'Legenda',
	'USERMAP_CREDENTIALS'			=> 'Odniesienia geograficzne używane przez Mapę Użytkowników dzięki uprzejmości: ',
	'USERMAP_LEGEND_TEXT'			=> 'Zmień powiększenie kółkiem myszy, klikając mapę lub użyj +/- w lewym górnym rogu mapy',
	'MAP_USERS'						=> array(
		1	=> 'Obecnie na Mapie Użytkowników jest %1$s Użytkownik forum.',
		2	=> 'Obecnie na Mapie Użytkowników jest %1$s Użytkowników forum.',
	),
	'MAP_SEARCH'					=> 'Szukaj Użytkowników po kodzie pocztowym %1$s w zasięgu ',
	'MAP_RESULT'					=> 'Pokazuje następujący wynik:',
	'MAP_NORESULT'					=> 'Nie znaleziono użytkowników w zasięgu ',
	'POI_LEGEND_TITLE'				=> 'Legenda do POIs',
	'STREET_DESC'					=> 'Mapa ulic',
	'TOPO_DESC'						=> 'Mapa topograficzna',
	'SAT_DESC'						=> 'Mapa satelitarna',
	'USER_DESC'						=> 'Użytkownicy',
	'POI_DESC'						=> 'POIs',
	// User POI popup
	'POI_INPUT_EXPL'				=> 'W tym formularzu możesz utworzyć nowe POI. Jego współrzędne zostaną przejęte ze znacznika na mapie po lewej stronie tego formularza.
										Ten znacznik można przeciągać, można go przesuwać myszą do miejsca docelowego. Jego nazwę, opis, a także
										ikonę, za pomocą której później będzie przedstawiony znacznik, można wprowadzić lub wybrać w kolejnych polach formularza.',
	'POI_NEW_SAVED'					=> 'Utworzony punkt POI został pomyślnie zapisany w bazie danych i jest wyświetlany na mapie.',
	'POI_MOD_NOTIFIED'				=> 'Utworzony punkt POI został pomyślnie zapisany w bazie danych, moderatorzy zostali o tym powiadomieni, oczekuje na akceptację.',
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
	// ACP
	'ACP_USERMAP'					=> 'Mapa Użytkowników',
	'SUPPORT_USERMAP'				=> 'Jeśli chcesz wesprzeć rozwój Mapy Użytkowników, użyj tego linku:<br>',
	// Settings tab
	'ACP_USERMAP_SETTINGS'			=> 'Ustawienia',
	'ACP_USERMAP_SETTINGS_EXPLAIN'	=> 'Tutaj możesz dostosować swoją Mapę Użytkownika.',
	'ACP_USERMAP_SETTING_SAVED'		=> 'Ustawienia Mapy Użytkowników zostały pomyślnie zapisane.',
	'ACP_USERMAP_MAPSETTING_TITLE'	=> 'Ustawienia mapy',
	'ACP_USERMAP_MAPSETTING_TEXT'	=> 'Centrum mapy i powiększenie po włączeniu Mapy Użytkowników.',
	'ACP_USERMAP_LAT'				=> 'Szerokość geograficzna środka mapy',
	'ACP_USERMAP_LAT_EXP'			=> 'Wartości od 90,0 (Półkula Północna) do -90,0 (Półkula Południowa)',
	'ACP_USERMAP_LON'				=> 'Długość geograficzna środka mapy',
	'ACP_USERMAP_LON_EXP'			=> 'Wartości od 180,0 (Wschód) do -180,0 (Zachód)',
	'ACP_USERMAP_ZOOM'				=> 'Początkowe powiększenie Mapy Użytkowników',
	'ACP_USERMAP_MARKERS_TEXT'		=> 'Tutaj można wybrać rozmiar znaczników wskazujących pozycje użytkowników na mapie niezależnie od ich wyświetlania bądź na
										ekranie komputerowym (komputery stacjonarne, laptopy, notebooki, netbooki, tablety), bądź w urządzeniach mobilnych (telefony komórkowe).<br>
										Rozmiar wprowadza się jako promień okręgu używanego jako znacznik, jednostką miary są piksele.',
	'ACP_USERMAP_MARKERS_PC'		=> 'Promień znacznika na ekranach komputerów',
	'ACP_USERMAP_MARKERS_MOB'		=> 'Promień okręgu na wyświetlaczu urządzeń mobilnych',
	'ACP_USERMAP_GEONAMES_TITLE'	=> 'Nazwa użytkownika dla geonames.org',
	'ACP_USERMAP_GEONAMES_TEXT'		=> 'Mapa Użytkowników opiera się na usługach geonames.org, aby uzyskać współrzędne geograficzne lokalizacji Użytkownika określonej kodem pocztowym i krajem oraz dodatkowo podać lokalizację w profilu Użytkownika.
										Dlatego rejestracja w serwisie
										<a href="https://www.geonames.org/login" target="_blank">
										<span style="text-decoration: underline;">geonames.org/login</span></a>
										jest obowiązkowa. Tą zarejestrowaną nazwę użytkownika należy wprowadzić tutaj.<br>
										Każde zapytanie Mapy Użytkowników to 1 kredyt, a bezpłatna usługa internetowa jest ograniczona do maksymalnie 1000 kredytów na godzinę; jeśli prowadzisz forum, które ma więcej niż 1000 Użytkowników, to jest zalecane zarejestrować jedną nazwę użytkownika na 1000 - 1500 Użytkowników. W przeciwnym razie użytkownicy mogą napotkać
										komunikat o błędzie podczas wprowadzania danych profilu (kod pocztowy i kraj). <br>
										Każdą z nazw użytkowników należy oddzielić przecinkami.<br>
										<strong>UWAGA!:</strong> Musisz włączyć (aktywować) wymaganą usługę po pierwszym zalogowaniu
										na geonames.org, korzystając z tego
										<a href="https://www.geonames.org/manageaccount" target="_blank">
										<span style="text-decoration: underline;">linku</span></a>!!',
	'ACP_USERMAP_GEONAMESUSER'		=> 'Nazwa użytkownika(-ów) dla geonames.org',
	'ACP_USERMAP_GEONAMESUSER_ERR'	=> 'Podanie przynajmniej jednej prawidłowej nazwy użytkownika jest obowiązkowe dla geonames.org!',
	'ACP_USERMAP_PROFILE_ERROR'		=> 'Nie udało się zakończyć tej czynności, ponieważ zapomniałeś podać użytkownika Geonames.org na karcie Ustawienia Mapy Użytkowników. Proszę to zrobić teraz!',
	'ACP_USERMAP_GOOGLE_TITLE'		=> 'Ustawienia do używania Google Maps API',
	'ACP_USERMAP_GOOGLE_TEXT'		=> 'geonames.org obsługuje tylko ograniczoną listę krajów (zobacz listę
										<a href="https://www.geonames.org/postal-codes/" target="_blank">
										<span style="text-decoration: underline;">tutaj</span></a>),
										a jeśli chcesz wziąć pod uwagę kraje, których nie ma na tej liście, możesz dodatkowo skorzystać z usługi Google Maps.
										Korzystanie z usługi Google Maps można włączyć tutaj.<br>
										Jeśli zdecydujesz się skorzystać z usługi Google Maps, musisz uzyskać klucz API, subskrybując pod adresem
										<a href="https://developers.google.com/maps/documentation/embed/get-api-key" target="_blank">
										<span style="text-decoration: underline;">Google Maps API Key</span></a>. Postępuj zgodnie z podanymi tam instrukcjami
										i uważaj na aktywację ´Geocoding API´.',
	'ACP_USERMAP_GOOGLE_ENABLE'		=> 'Włączyć korzystanie z Google Maps API?',
	'ACP_USERMAP_GOOGLE_KEY'		=> 'Wprowadź swój klucz API Map Google',
	'ACP_USERMAP_APIKEY_ERROR'		=> 'Nie udało się zakończyć tej czynności, ponieważ po aktywacji tego interfejsu API nie podano klucza interfejsu API Map Google. Podaj prawidłowy klucz!',
	'ACP_USERMAP_GOOGLE_FORCE'		=> 'Kody tych krajów będą wymuszone w celu wyszukiwania dostępu za pomocą interfejsu API Map Google',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'	=> 'geonames.org, ze względu na prawa autorskie, bierze pod uwagę tylko części kodu pocztowego w niektórych krajach, co prowadzi do
										odpowiednich współrzędnych. Listę tych krajów można znaleźć pod tym adresem
										<a href="http://download.geonames.org/export/zip/readme.txt" target="_blank">
										<span style="text-decoration: underline;">tutaj</span></a>.<br>
										Interfejs API Map Google powinien zapewniać bardziej szczegółowe wyniki dla tych krajów. Jeśli chcesz wymusić wyszukiwanie w Google Maps API zamiast geonames.org, wprowadź dwuliterowe kody żądanych krajów, oddzielając je przecinkami.',
	'ACP_USERMAP_DATABASE_TITLE'	=> 'Korzystanie z wewnętrznej bazy danych',
	'ACP_USERMAP_DATABASE_TEXT'		=> 'Nawet Mapy Google mogą nie zapewniać prawidłowego rozwiązania w niektórych krajach (np. w Izraelu). W takim przypadku możesz skorzystać z wewnętrznej bazy danych, dla której musisz podać dane, wybierz zakładkę „Wewnętrzna baza danych”, aby uzyskać więcej informacji. <br>
										Możesz użyć tego sposobu dla użytkowników mieszkających w kraju nieobsługiwanym przez geonames.org, jeśli nie chcesz korzystać z
										interfejsu API Google Map.',
	'ACP_USERMAP_DATABASE_ENABLE'	=> 'Włączyć korzystanie z wewnętrznej bazy danych?',
	'ACP_USERMAP_POI_TITLE'			=> 'Wyświetl interesujące miejsca (POI)',
	'ACP_USERMAP_POI_TEXT'			=> 'Oprócz wyświetlania lokalizacji użytkowników Mapa Użytkowników może wyświetlać dodatkową nakładkę z lokalizacjami, które mogą
										być szczególne interesujące dla użytkowników, np. miejsca odpoczynku i hotele dla rowerzystów lub lokalizacje aren sportowych.
										W tej sekcji możesz wybrać ustawienia tej nakładki.<br>
										Poniższa sekcja umożliwia pisanie i edycję opisu określającego znaczenie różnych kategorii punktów POI,
										która zostanie wyświetlona pod mapą jako legenda.<br>
										Wprowadzanie i edytowanie punktów POI jest zadaniem administratora, wszystkie niezbędne do tego elementy są dostępne przez
										zakładkę „obsługa POI”.',
	'ACP_USERMAP_POI_ENABLE'		=> 'Włączyć wyświetlanie punktów POI?',
	'ACP_USERMAP_POI_ENABLE_EXP'	=> 'Wybranie „Tak” umożliwia wyświetlenie nakładki POI z Mapą Użytkowników. Aktywuje również Twój wybór w następujących przypadkach
										ustawianie i wyświetlanie legendy, którą możesz pisać i edytować w sekcji poniżej.',
	'ACP_USERMAP_ICON_TITLE'		=> 'Domyślne wartości ikon POI',
	'ACP_USERMAP_ICON_TEXT'			=> 'Tutaj możesz zmienić domyślne wartości ikon POI, ich rozmiaru i kotwicy. Wstępnie wybrane są wartości ikon
										dostarczane z Mapą Użytkowników. Jeśli chcesz użyć własnych ikon, możesz zamiast tego wprowadzić ich domyślne wartości.<br>
										Więcej informacji można znaleźć w pliku ´ICONS.md´ zawartym w katalogu ´docs´.',
	'ACP_USERMAP_ICONSIZE_EXP'		=> 'Rozmiar ikony w pikselach w notacji „szerokość”, „wysokość”.',
	'ACP_USERMAP_ICONANCHOR_EXP'	=> 'Zakotwiczenie ikony w pikselach, począwszy od lewego górnego rogu w notacji „wartość pozioma”, „wartość pionowa”.',
	'ACP_USERMAP_POI_LEGEND'		=> 'Legenda POI',
	'ACP_USERMAP_POI_LGND'			=> 'Napisz i edytuj legendę POI',
	'ACP_USERMAP_POI_LGND_EXP'		=> 'Tekst, który tu wpisujesz, nie może przekraczać 1000 znaków, łącznie ze wszystkimi kodami BBCode i będzie wyświetlany pod
										Mapą Użytkowników jako legenda, jeśli wyświetlanie punktów POI jest włączone.<br>
										Pisanie i edycja jest niezależne od wszystkich innych ustawień na tej karcie.',
	// Language packs tab
	'ACP_USERMAP_LANGS'				=> 'Pakiety językowe',
	'ACP_USERMAP_LANGS_EXPLAIN'		=> 'Tutaj możesz zainstalować dodatkowe pakiety językowe dla Mapy Użytkowników. Może to być konieczne po dodaniu pakietów językowych do Mapy Użytkowników, po jej pierwszej aktywacji, ponieważ te dane nie zostały włączone do rozwijanej listy z wyborem kraju; możesz to zrobić tutaj po załadowaniu pakietu językowego poprzez FTP do podkatalogu <i>language</i> tego rozszerzenia.',
	'ACP_USERMAP_INSTALLABLE_LANG'	=> 'Pakiety językowe gotowe do instalacji',
	'ACP_USERMAP_INSTALL_LANG_EXP'	=> 'Pakiety językowe Mapy Użytkowników oczekujące na instalację.',
	'ACP_USERMAP_MISSING_LANG'		=> 'Brakujące pakiety językowe',
	'ACP_USERMAP_MISSING_LANG_EXP'	=> 'Języki zainstalowane na forum, ale Pominięte w rozszerzeniu Mapy Użytkowników.',
	'ACP_USERMAP_ADDITIONAL_LANG'	=> 'Dodatkowe pakiety językowe Mapy Użytkowników',
	'ACP_USERMAP_ADD_LANG_EXP'		=> 'Pakiety językowe rozszerzenia, dla których nie istnieje język na tym forum.',
	'ACP_USERMAP_LANGPACK_NAME'		=> 'Nazwa języka',
	'ACP_USERMAP_LANGPACK_LOCAL'	=> 'Lokalna nazwa',
	'ACP_USERMAP_LANGPACK_ISO'		=> 'ISO',
	'ACP_USERMAP_NO_ENTRIES'		=> 'Nie znaleziono pakietów językowych',
	// Internal database tab
	'ACP_USERMAP_DATABASE'			=> 'Wewnętrzna baza danych',
	'ACP_USERMAP_DATABASE_EXPLAIN'	=> 'Ta tabela zawiera wszystkie wcześniej wprowadzone dane dotyczące kombinacji kraju / kodu pocztowego i ich odpowiednich
										współrzędnych. W skrajnej prawej kolumnie znajduje się link do usunięcia odpowiedniego wiersza.<br>
										Pod tą tabelą możesz dodać nowe dane.',
	'ACP_USERMAP_DATABASE_DATA'		=> 'Aktualnie dostępne dane',
	'ACP_USERMAP_DATABASE_CC'		=> 'ISO Kod Kraju',
	'ACP_USERMAP_DATABASE_ZIPCODE'	=> 'Kod pocztowy',
	'ACP_USERMAP_DATABASE_LAT'		=> 'Szerokość geograficzna',
	'ACP_USERMAP_DATABASE_LNG'		=> 'Długość geograficzna',
	'ACP_USERMAP_DATABASE_EDIT'		=> 'Edycja',
	'ACP_USERMAP_DATABASE_NOENTRY'	=> 'Brak dostępnych danych',
	'ACP_USERMAP_DATABASE_NEW'		=> 'Nowe dane do bazy danych',
	'ACP_USERMAP_DATABASE_CC_EXP'	=> 'Proszę wprowadzić dwie wielkie litery kodu kraju, do którego ma zostać przyporządkowany ten wpis.',
	'ACP_USERMAP_DATABASE_ZC_EXP'	=> 'Proszę podać kod pocztowy, do którego ma być przypisany ten wpis, dozwolone są tylko wielkie litery, cyfry i myślnik.',
	'ACP_USERMAP_DATABASE_ERROR'	=> 'Pole >%1$s< nie może być puste!',
	'ACP_USERMAP_DATABASE_BIG_ERR'	=> 'Pole nie może być puste!',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'Zmiany wewnętrznej bazy danych zostały pomyślnie zapisane.',
	'ACP_USERMAP_DATABASE_INVALID'	=> 'Ta kombinacja kodu kraju i kodu pocztowego już istnieje, nie można jej użyć ponownie!<br>
										Zapisanie tych danych do wewnętrznej bazy danych nie powiodło się!',
	'ACP_USERMAP_CONFIRM_DELETE'	=> 'Czy na pewno chcesz usunąć ten element z bazy danych?<br>
										<strong>Spowoduje to trwałe usunięcie elementu z bazy danych i nie można tego cofnąć!</strong>',
	// POI tab
	'ACP_USERMAP_POI'				=> 'Obsługa POI',
	'ACP_USERMAP_POI_EXPLAIN'		=> 'W tej tabeli wymienione są wszystkie POI wprowadzone do tej pory w bazie danych.<br>
										Pod tą tabelą możesz wstawić nowy wpis, dodatkowo w tym miejscu możesz edytować istniejący wpis po wybraniu
										linku <i>Edycja</i> w ostatniej kolumnie każdego wiersza tabeli.<br>
										Wybierając łącze <i>Usuń</i>, możesz usunąć wpis ze swojej bazy danych.',
	'ACP_USERMAP_POI_DATA'			=> 'Aktualnie dostępne pozycje POI',
	'ACP_USERMAP_POI_NAME'			=> 'Nazwa POI',
	'ACP_USERMAP_POI_POPUP'			=> 'Opis POI',
	'ACP_USERMAP_POI_ICON'			=> 'Plik ikon',
	'ACP_USERMAP_POI_SIZE'			=> 'Rozmiar ikony',
	'ACP_USERMAP_POI_ANCHOR'		=> 'Kotwica ikony',
	'ACP_USERMAP_POI_NEW'			=> 'Wprowadź nowy POI',
	'ACP_USERMAP_POI_EDIT'			=> 'Eytuj wybrane POI',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'Nazwa tego punktu POI jest wyświetlana jako dymek podpowiedzi, gdy wskaźnik myszy przesuwa się nad znacznikiem POI.',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'Opis tego POI, może zawierać do 500 znaków i może zawierać kod BBCode.<br>
										Ten tekst jest wyświetlany w wyskakującym okienku po kliknięciu znacznika POI wskaźnikiem myszy.',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'Aby ułatwić podstawową kategoryzację punktów POI, możesz wybrać ikony znaczników w różnych kolorach.',
	'ACP_USERMAP_POI_SIZE_EXP'		=> 'Rozmiar ikony w pikselach w notacji „szerokość”, „wysokość”.<br>
										Wartość początkowa to domyślny rozmiar podany w zakładce „Ustawienia”.',
	'ACP_USERMAP_POI_ANCHOR_EXP'	=> 'Zakotwiczenie ikony w pikselach, począwszy od lewego górnego rogu w notacji „wartość pozioma”, „wartość pionowa”.<br>
										Wartość początkowa to wartość domyślna podana w zakładce „Ustawienia”.',
	// UCP
	'MOT_ZIP'						=> 'Kod pocztowy',
	'MOT_ZIP_EXP'					=> 'Wpisz, proszę Kod Pocztowy swojej lokalizacji żeby została wyświetlona na Mapie Użytkowników.<br>(Format Kodu Pocztowego: XX-XXX)',
	'MOT_LAND'						=> 'Kraj',
	'MOT_LAND_EXP'					=> 'Proszę, wybierz kraj, w którym mieszkasz żeby wyświetlić na Mapie Użytkowników.',
	'MOT_UCP_GEONAMES_ERROR'		=> 'Administrator nie udostępnił użytkownika Geonames.org, dlatego nie można pobrać danych Mapy Użytkowników!',
	// Log entries
	'LOG_USERMAP_GOOGLE_ERROR'		=> '<strong>Interfejs API Map Google nie wykonał się z następującym komunikatem o błędzie:</strong><br>» %s',
	'LOG_USERMAP_GEONAMES_ERROR'	=> '<strong>Interfejs API Geonames nie wykonał się z następującym komunikatem o błędzie:</strong><br>» %s',
	'LOG_USERMAP_SETTING_UPDATED'	=> '<strong>Zmieniono ustawienia Mapy Użytkowników</strong>',
	'LOG_POI_LEGEND_UPDATED'		=> '<strong>Legenda POI została zmieniona</strong>',
	'LOG_USERMAP_ZIPCODE_NEW'		=> '<strong>Dodano nowy wpis w bazie danych do Mapy Użytkowników:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_DELETED'	=> '<strong>Usunięto wpis bazy danych z Mapy Użytkowników:</strong><br>» %s',
	'LOG_USERMAP_INSTALL_LANG'		=> '<strong>Dodano pakiet językowy do Mapy Użytkowników:</strong><br>» %s',
	'LOG_USERMAP_POI_NEW'			=> '<strong>Dodano nowy punkt POI do Mapy Użytkowników:</strong><br>» %s',
	'LOG_USERMAP_POI_EDITED'		=> '<strong>Zmienione dane POI:</strong><br>» %s',
	'LOG_USERMAP_POI_DELETED'		=> '<strong>Usunięto punkt POI z Mapy Użytkowników:</strong><br>» %s',
	'LOG_USERMAP_POI_APPROVED'		=> '<strong>Zatwierdzono POI utworzony przez użytkownika:</strong><br>» %s',
	'LOG_USERMAP_POI_MOD_DELETED'	=> '<strong>Usunięto POI utworzone przez użytkownika:</strong><br>» %s',
));
