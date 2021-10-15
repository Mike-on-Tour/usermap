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
	// ACP
	'ACP_USERMAP'					=> 'Mapa Użytkowników',
	'ACP_USERMAP_VERSION'			=> '<img src="https://img.shields.io/badge/Version-%1$s-green.svg?style=plastic" /><br>&copy; 2020 - %2$d by Mike-on-Tour',
	'SUPPORT_USERMAP'				=> 'Jeśli chcesz wesprzeć rozwój Mapy Użytkowników, użyj tego linku:<br>',
	// Settings tab
	'ACP_USERMAP_SETTINGS'			=> 'Ustawienia',
	'ACP_USERMAP_SETTINGS_EXPLAIN'	=> 'Tutaj możesz dostosować swoją Mapę Użytkownika.',
	'ACP_USERMAP_SETTING_SAVED'		=> 'Ustawienia Mapy Użytkowników zostały pomyślnie zapisane.',
	'ACP_USERMAP_GENERAL_SETTINGS'	=> 'Ustawienia główne',
	'ACP_USERMAP_ROWS_PER_PAGE'		=> 'Ilość wierszy na stronę tabeli',
	'ACP_USERMAP_ROWS_PER_PAGE_EXP'	=> 'Wybierz liczbę wierszy, które mają być wyświetlane na stronie tabeli na innych kartach.',
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
										Dlatego rejestracja w serwisie %1$s jest obowiązkowa. Tą zarejestrowaną nazwę użytkownika należy wprowadzić tutaj.<br>
										Każde zapytanie Mapy Użytkowników to 1 kredyt, a bezpłatna usługa internetowa jest ograniczona do maksymalnie 1000 kredytów na godzinę; jeśli prowadzisz forum, które ma więcej niż 1000 Użytkowników, to jest zalecane zarejestrować jedną nazwę użytkownika na 1000 - 1500 Użytkowników. W przeciwnym razie użytkownicy mogą napotkać
										komunikat o błędzie podczas wprowadzania danych profilu (kod pocztowy i kraj). <br>
										Każdą z nazw użytkowników należy oddzielić przecinkami.<br>
										<strong>UWAGA!:</strong> Musisz włączyć (aktywować) wymaganą usługę po pierwszym zalogowaniu
										na geonames.org, korzystając z tego %2$slinku</span></a>!!',
	'ACP_USERMAP_GEONAMESUSER'		=> 'Nazwa użytkownika(-ów) dla geonames.org',
	'ACP_USERMAP_GEONAMESUSER_ERR'	=> 'Podanie przynajmniej jednej prawidłowej nazwy użytkownika jest obowiązkowe dla geonames.org!',
	'ACP_USERMAP_PROFILE_ERROR'		=> 'Nie udało się zakończyć tej czynności, ponieważ zapomniałeś podać użytkownika Geonames.org na karcie Ustawienia Mapy Użytkowników. Proszę to zrobić teraz!',
	'ACP_USERMAP_GOOGLE_TITLE'		=> 'Ustawienia do używania Google Maps API',
	'ACP_USERMAP_GOOGLE_TEXT'		=> 'geonames.org obsługuje tylko ograniczoną listę krajów (zobacz listę %1$stutaj</span></a>),
										a jeśli chcesz wziąć pod uwagę kraje, których nie ma na tej liście, możesz dodatkowo skorzystać z usługi Google Maps.
										Korzystanie z usługi Google Maps można włączyć tutaj.<br>
										Jeśli zdecydujesz się skorzystać z usługi Google Maps, musisz uzyskać klucz API, subskrybując pod adresem
										%2$sGoogle Maps API Key</span></a>. Postępuj zgodnie z podanymi tam instrukcjami
										i uważaj na aktywację ´Geocoding API´.',
	'ACP_USERMAP_GOOGLE_ENABLE'		=> 'Włączyć korzystanie z Google Maps API?',
	'ACP_USERMAP_GOOGLE_KEY'		=> 'Wprowadź swój klucz API Map Google',
	'ACP_USERMAP_APIKEY_ERROR'		=> 'Nie udało się zakończyć tej czynności, ponieważ po aktywacji tego interfejsu API nie podano klucza interfejsu API Map Google. Podaj prawidłowy klucz!',
	'ACP_USERMAP_GOOGLE_FORCE'		=> 'Kody tych krajów będą wymuszone w celu wyszukiwania dostępu za pomocą interfejsu API Map Google',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'	=> 'geonames.org, ze względu na prawa autorskie, bierze pod uwagę tylko części kodu pocztowego w niektórych krajach, co prowadzi do
										odpowiednich współrzędnych. Listę tych krajów można znaleźć pod tym adresem %1$stutaj</span></a>.<br>
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
	'ACP_USERMAP_DATABASE_NAME'		=> 'Nazwa lokalizacji',
	'ACP_USERMAP_DATABASE_EDIT'		=> 'Edytuj element bazy danych',
	'ACP_USERMAP_DATABASE_NOENTRY'	=> 'Brak dostępnych danych',
	'ACP_USERMAP_DATABASE_NEW'		=> 'Nowe dane do bazy danych',
	'ACP_USERMAP_DATABASE_CC_EXP'	=> 'Proszę wprowadzić dwie wielkie litery kodu kraju, do którego ma zostać przyporządkowany ten wpis.',
	'ACP_USERMAP_DATABASE_ZC_EXP'	=> 'Proszę podać kod pocztowy, do którego ma być przypisany ten wpis, dozwolone są tylko wielkie litery, cyfry i myślnik.',
	'ACP_USERMAP_DATABASE_NAME_EXP'	=> 'Możesz wprowadzić nazwę, aby lepiej zidentyfikować i rozpoznać tę lokalizację.',
	'ACP_USERMAP_DATABASE_ERROR'	=> 'Pole >%1$s< nie może być puste!',
	'ACP_USERMAP_DATABASE_BIG_ERR'	=> 'Pole nie może być puste!',
	'ACP_USERMAP_DATABASE_INVALID'	=> 'Ta kombinacja kodu kraju i kodu pocztowego już istnieje, nie można jej użyć ponownie!<br>
										Zapisanie tych danych do wewnętrznej bazy danych nie powiodło się!',
	// POI tab
	'ACP_USERMAP_POI'				=> 'Obsługa POI',
	'ACP_USERMAP_POI_EXPLAIN'		=> 'W tej tabeli wymienione są wszystkie POI wprowadzone do tej pory w bazie danych.<br>
										Pod tą tabelą możesz wstawić nowy wpis, dodatkowo w tym miejscu możesz edytować istniejący wpis po wybraniu
										linku <i>Edycja</i> w ostatniej kolumnie każdego wiersza tabeli.<br>
										Wybierając łącze <i>Usuń</i>, możesz usunąć wpis ze swojej bazy danych.',
	'ACP_USERMAP_POI_DATA'			=> 'Aktualnie dostępne pozycje POI',
	'ACP_USERMAP_POI_CREATOR'		=> 'Twórca',
	'ACP_USERMAP_POI_VISIBLE'		=> 'Widoczne POI',
	'ACP_USERMAP_POI_VISIBLE_EXP'	=> 'Wybierz, czy ten punkt POI powinien być widoczny na wybranej nakładce mapy.',
	'ACP_USERMAP_POI_NEW'			=> 'Wprowadź nowy POI',
	'ACP_USERMAP_POI_EDIT'			=> 'Eytuj wybrane POI',
	'ACP_USERMAP_POI_SUCCESS'		=> 'Punkt POI nazwany „<strong>%1$s</strong>“ został pomyślnie zapisany.',
	'ACP_USERMAP_POI_DELETE'		=> 'Czy na pewno chcesz usunąć POI o nazwie „<strong>%1$s</strong>“ z bazy danych?<br>
										<strong>Powoduje to trwałe usunięcie punktu POI z bazy danych i nie można tego cofnąć!</strong>',
	'ACP_USERMAP_POI_DEL_SUCCESS'	=> 'Punkt POI nazwany „<strong>%1$s</strong>“ został usunięty z bazy danych.',
	'ACP_ERR_POI_NO_NAME'			=> 'Pole wejściowe o nazwie „Nazwa POI” nie może być puste!',
	'ACP_ERR_POI_NO_LAT'			=> 'Pole wejściowe o nazwie „Szerokość geograficzna” nie może być puste!',
	'ACP_ERR_POI_NO_LNG'			=> 'Pole wejściowe o nazwie „Długość geograficzna” nie może być puste!',
	// Layer tab
	'ACP_USERMAP_LAYER'				=> 'Nakładki mapy',
	'ACP_USERMAP_LAYER_EXPLAIN'		=> 'Wszystkie istniejące nakładki mapy są wymienione w tej tabeli.<br>
										W sekcji pod tabelą możesz utworzyć nową nakładkę mapy lub edytować istniejącą, klikając na
										link „Edytuj” w odpowiednim wierszu tabeli. Zostaną wyświetlone aktualne dane wybranej nakładki mapy
										w tej sekcji.<br>
										Korzystając z odpowiedniego łącza w tabeli, możesz usunąć ten element.',
	'ACP_USERMAP_LAYER_DATA'		=> 'Istniejące nakładki mapy',
	'ACP_USERMAP_LAYER_NAME'		=> 'Nazwa nakładki',
	'ACP_USERMAP_LAYER_NAME_EXP'	=> 'Wprowadź nazwę, aby zidentyfikować tę nakładkę mapy.',
	'ACP_USERMAP_MEMBER_LAYER'		=> 'Nakładka Użytkowników',
	'ACP_USERMAP_MEMBER_LAYER_EXP'	=> 'Wybierz „Tak”, aby użyć tej nakładki mapy do wyświetlania znaczników Użtkowników lub „Nie”, aby użyć jej do wyświetlania znaczników POI.<br>
										Nakładki Mapy Użytkowników są wyświetlane tylko dla uprawnienionych do przeglądania Użytkowników, nakładki dla POI są wyświetlane
										jeśli POI są aktywowane i uprawnienia do przeglądania POI są włączone.',
	'ACP_USERMAP_LAYER_ACTIVE'		=> 'Aktywuj nakładkę',
	'ACP_USERMAP_LAYER_ACTIVE_EXP'	=> 'Wybierz „Tak”, aby aktywować tę nakładkę mapy i umożliwić umieszczanie na niej punktów POI. Nieaktywnych nakładek mapy nie można wybrać
										podczas tworzenia nowego POI.',
	'ACP_USERMAP_SHOW_LAYER'		=> 'Wyświetlaj na stałe',
	'ACP_USERMAP_SHOW_LAYER_EXP'	=> 'Wybierz „Tak”, aby zawsze wyświetlać tę nakładkę mapy, startując od wywołania Mapy Użytkowników.<br>
										Jeśli wybierzesz opcję „Nie”, użytkownicy muszą wybrać tę nakładkę mapy za pomocą elementu kontrolnego nakładki mapy.',
	'ACP_USERMAP_LAYER_LANG_VAR'	=> 'Zmienne językowe',
	'ACP_USERMAP_LAYER_LANG_VAR_EXP' => 'Aby umożliwić użytkownikom identyfikowanie nakładek mapy w ich ojczystym języku, wprowadź tutaj każdy z
										języków zainstalowanych na tym forum identyfikujący tę nakładkę w elemencie kontrolnym warstwy, np. „Pola kempingowe“ jako
										termin określający nakładkę mapy przedstawiającą pola kempingowe.<br>
										Upewnij się, że używasz prawidłowego tagu językowego (zobacz oznaczenie pakietów językowych w panelu ACP „ISO” na karcie „Dostosuj”)
										po którym następuje dwukropek i żądany termin językowy, aby być pewnym, że system może użyć wprowadzonych danych.<br>
										<strong>%1$sPrzykład:</span></strong> „en:Campgrounds“<br>
										Każda kombinacja znacznika językowego i terminu językowego MUSI mieć własną linię!<br>
										<strong>%1$sUWAGA: Wiersz ze znacznikiem języka „en“ jest OBOWIĄZKOWY!</span></strong>',
	'ACP_USERMAP_LAYER_DEFAULTICON'	=> 'Ikona domyślna',
	'ACP_USERMAP_LAYER_ICON_EXP'	=> 'Wybierz plik ikony, który będzie używany jako domyślny na tej nakładce mapy. Ten wybór zostanie użyty dla wszystkich POI
										stworzonych w tej.',
	'ACP_USERMAP_LAYER_NEW'			=> 'Utwórz nową nakładkę mapy',
	'ACP_USERMAP_LAYER_EDIT'		=> 'Edytuj istniejącą nakładkę mapy',
	'ACP_USERMAP_LAYER_SUCCESS'		=> 'Nakładka mapy o nazwie „<strong>%1$s</strong>“ została pomyślnie zapisana.',
	'ACP_USERMAP_LAYER_DELETE'		=> 'Czy na pewno chcesz usunąć nakładkę mapy nazwaną „<strong>%1$s</strong>“ z bazy danych?<br>
										Wszystkie POI przypisane do tej nakładki mapy nie będą już wyświetlane!<br>
										<strong>Spowoduje to trwałe usunięcie nakładki mapy z bazy danych i nie można tego cofnąć!</strong>',
	'ACP_USERMAP_LAYER_DEL_SUCCESS'	=> 'Nakładka mapy o nazwie „<strong>%1$s</strong>“ została usunięta z bazy danych.',
	'ACP_ERR_LAYER_NO_NAME'			=> 'Pole wejściowe o nazwie „Nazwa nakładki” nie może być puste!',
	'ACP_ERR_LAYER_NO_LANG'			=> 'Pole wejściowe o nazwie „Zmienne językowe” nie może być puste!',
	'ACP_ERR_LAYER_INCORRECT'		=> 'Ta zmienna językowa nie jest zgodna z zasadami: ',
	'ACP_ERR_LAYER_NO_EN'			=> 'Brak zmiennej językowej „en”!',
	// Logs
	'LOG_USERMAP_LAYER_NEW'			=> '<strong>Do Mapy Użytkowników dodano nową nakładkę mapy:</strong><br>» %s',
	'LOG_USERMAP_LAYER_EDITED'		=> '<strong>Edytowano nakładkę mapy:</strong><br>» %s',
	'LOG_USERMAP_LAYER_DELETED'		=> '<strong>Usunięto następującą nakładkę mapy z Mapy Użytkownika:</strong><br>» %s'
]);
