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
	// ACP
	'ACP_USERMAP'						=> 'Gebruikerskaart',
	'ACP_USERMAP_VERSION'				=> '<img src="https://img.shields.io/badge/Version-%1$s-green.svg?style=plastic" /><br>&copy; 2020 - %2$d by Mike-on-Tour',
	'SUPPORT_USERMAP'					=> 'Als je wilt doneren aan de ontwikkeling van Usermap, gebruik dan deze link:<br>',
	// Settings tab
	'ACP_USERMAP_SETTINGS'				=> 'Instellingen',
	'ACP_USERMAP_SETTINGS_EXPLAIN'		=> 'Hier pas je je instellingen voor de gebruikerskaart aan.',
	'ACP_USERMAP_SETTING_SAVED'			=> 'Instellingen voor de gebruikerskaart zijn opgeslagen.',
	'ACP_USERMAP_GENERAL_SETTINGS'		=> 'Algemene instellingen',
	'ACP_USERMAP_ROWS_PER_PAGE'			=> 'Rijen per tabelpagina',
	'ACP_USERMAP_ROWS_PER_PAGE_EXP'		=> 'Kies het aantal rijen dat per tabelpagina op de andere tabbladen moet worden weergegeven.',
	'ACP_USERMAP_MAPSETTING_TITLE'		=> 'Instellingen voor de gebruikerskaart',
	'ACP_USERMAP_MAPSETTING_TEXT'		=> 'Kaartcentrum en zoom aan het begin van de gebruikerskaart.',
	'ACP_USERMAP_LAT'					=> 'Breedtegraad van het kaartcentrum ',
	'ACP_USERMAP_LAT_EXP'				=> 'Waarden tussen 90,0 (Noordpool) en -90,0 (Zuidpool)',
	'ACP_USERMAP_LON'					=> 'Lengtegraad van het centrum van de kaart',
	'ACP_USERMAP_LON_EXP'				=> 'Waarden tussen 180,0 (oost) en -180,0 (west)',
	'ACP_USERMAP_ZOOM'					=> 'Initiële zoom van de gebruikerskaart',
	'ACP_USERMAP_MARKERS_TEXT'			=> 'Hier kan je de grootte van de markeringen selecteren die de posities van de gebruikers op de kaart onafhankelijk van elkaar weergeven voor weergave op
											computerschermen (desktop, laptop, notebook, netbook, tablet) en op mobiele apparaten (mobiele telefoons).<br>
											De grootte wordt ingevoerd als de straal van de cirkel die als markering wordt gebruikt, de maateenheid is pixels.',
	'ACP_USERMAP_MARKERS_PC'			=> 'De straal van de cirkel op computerschermen',
	'ACP_USERMAP_MARKERS_MOB'			=> 'De straal van de cirkel op het scherm van mobiele apparaten ',
	'ACP_USERMAP_GEONAMES_TITLE'		=> 'Gebruikersnaam voor geonames.org ',
	'ACP_USERMAP_GEONAMES_TEXT'			=> 'User Map vertrouwt op de diensten van geonames.org om de geografische coördinaten te krijgen
											van de locatie van het lid geïdentificeerd door de postcode (postcode) en het land en tevens
											de opgegeven locatie in het profiel van het lid.
											Daarom is een registratie bij %1$s verplicht. Deze geregistreerde gebruikersnaam moet hier worden ingevoerd.<br>
											Elke aanvraag kost 1 credit, bij de gratis webservice ben je beperkt tot maximaal
											1.000 credits per uur; als u een forum beheert met meer dan 1.000 leden, is het raadzaam om:
											registreer één gebruikersnaam per 1.000 - 1.500 leden. Anders kunnen uw gebruikers een foutmelding krijgen bij het invoeren van hun profielgegevens (postcode en land).<br>
											Meerdere gebruikersnamen moeten worden gescheiden door kommas.<br>
											<strong>LET OP:</strong> U moet uw gewenste service inschakelen (activeren) na de eerste keer inloggen
											op geonames.org met deze  %2$slink</span></a>!!',
	'ACP_USERMAP_GEONAMESUSER'			=> 'gebruikersnaam(en) voor geonames.org',
	'ACP_USERMAP_GEONAMESUSER_ERR'		=> 'Het is verplicht om ten minste één geldige gebruikersnaam op te geven voor geonames.org!',
	'ACP_USERMAP_PROFILE_ERROR'			=> 'Deze actie kon niet met succes worden afgerond omdat je verzuimd hebt een Geonames.org-gebruiker op te geven in het tabblad Gebruikerskaartinstellingen. Gelieve dit meteen te doen!',
	'ACP_USERMAP_GOOGLE_TITLE'			=> 'Instellingen voor gebruik  Google Maps API',
	'ACP_USERMAP_GOOGLE_TEXT'			=> 'geonames.org ondersteunt slechts een beperkte lijst van landen (zie lijst %1$shere</span></a>),
											als u landen moet overwegen die niet in deze lijst staan, wilt u misschien ook de Google Maps-service gebruiken.
											Het gebruik van de Google Maps-service kan hier worden ingeschakeld.<br>
											Als u ervoor kiest om de Google Maps-service te gebruiken, moet u een API-sleutel verkrijgen door u te abonneren op %2$sGoogle Maps API Key</span></a>.
											Volg de instructies daar en let op het activeren van de ´Geocoding API´.',
	'ACP_USERMAP_GOOGLE_ENABLE'			=> 'Schakel het gebruik in van de Google Maps API?',
	'ACP_USERMAP_GOOGLE_KEY'			=> 'Gelieve uw Google Maps API Key in te voeren',
	'ACP_USERMAP_APIKEY_ERROR'			=> 'Deze actie kon niet met succes worden afgerond omdat u na het activeren van deze API heeft nagelaten een Google Maps API Key op te geven. Geef een geldige sleutel op!',
	'ACP_USERMAP_GOOGLE_FORCE'			=> 'Landcode van die landen die geforceerd geconsulteerd moeten worden met de Google Maps API',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'		=> 'geonames.org houdt om reden van copyright enkel rekening met delen van de postcode voor sommige landen, hetgeen leidt tot een approximatieve benadering van de coördinaten. Voor een lijst van die landen wordt verwezen u naar %1$sthis</span></a>tekst.<br>
											De Google Maps API zou voor die landen meer gedetailleerde resultaten moeten opleveren. Als u de zoekopdracht wilt afdwingen bij Google Maps API i.p.v. bij geonames.org:
											Voer bij Google Maps API de tweeletterige landcode van de gewenste landen in, gescheiden door kommas.',
	'ACP_USERMAP_DATABASE_TITLE'		=> 'Gebruik de interne data base',
	'ACP_USERMAP_DATABASE_TEXT'			=> 'Zelfs Google Maps biedt mogelijk geen geldige oplossing voor sommige landen (bijvoorbeeld Israël). In dit geval kunt u een
											interne database gebruiken waarvoor u zelf de gegevens moet aanleveren, kies het tabblad ´Interne database´ voor meer informatie.<br>
											Misschien wilt u deze manier gebruiken voor gebruikers die in een land wonen dat niet wordt ondersteund door geonames.org als u geen gebruik wilt maken van
											de Google Maps-API.',
	'ACP_USERMAP_DATABASE_ENABLE'		=> 'Schakel het gebruik in van de interne database?',
	'ACP_USERMAP_POI_TITLE'				=> 'Toon Points of Interest (POIs)',
	'ACP_USERMAP_POI_TEXT'				=> 'Naast het weergeven van locaties van leden kan Usermap extra overlays weergeven met locaties die mogelijk van bijzonder belang kunnen zijn voor uw leden, b.v. hangouts en hotels voor motorrijders of locaties van sportarenas.
											U kunt de instellingen voor deze overlay in dit gedeelte kiezen.<br>
											In het volgende gedeelte kunt u een beschrijving schrijven en bewerken die de betekenis van uw verschillende POI-categorieën definieert,
											die als een legende onder de kaart wordt weergegeven.<br>
											Het invoeren en bewerken van uw POIs is de taak van de beheerder, alle elementen die nodig zijn om dit te doen zijn toegankelijk via
											het tabblad ´POI-verwerking´ .',
	'ACP_USERMAP_POI_ENABLE'			=> 'Weergave van POIs inschakelen?',
	'ACP_USERMAP_POI_ENABLE_EXP'		=> 'Als u ´Ja´ kiest, wordt de POI-overlay met de gebruikerskaart weergegeven. Het activeert ook uw keuze voor het daaropvolgend instellen en weergeven van de legende die u in de onderstaande sectie kunt schrijven en bewerken.',
	'ACP_USERMAP_ICON_TITLE'			=> 'Standaardwaarden voor POI-Icons',
	'ACP_USERMAP_ICON_TEXT'				=> 'Hier kunt u de standaardwaarden voor grootte en anker van de POI-pictogrammen wijzigen. Voorgeselecteerd zijn de waarden voor de pictogrammen
											geleverd met Usermap. Indien u uw eigen pictogrammen wilt gebruiken, kunt u de standaardwaarden hier invoeren.<br>
											Raadpleeg het bestand ´ICONS.md´ in de directory ´docs´ voor meer informatie.',
	'ACP_USERMAP_ICONSIZE_EXP'			=> 'Grootte van het pictogram in pixels in de notatie ´breedte´,´hoogte´.',
	'ACP_USERMAP_ICONANCHOR_EXP'		=> 'Anker van het pictogram in pixels beginnend in de linkerbovenhoek in de notatie ´horizontale waarde´,´verticale waarde´.',
	'ACP_USERMAP_POI_LEGEND'			=> 'POI legenda',
	'ACP_USERMAP_POI_LGND'				=> 'Schrijf en bewerk de POI-legenda',
	'ACP_USERMAP_POI_LGND_EXP'			=> 'De tekst die u hier invoert, mag maximaal 1.000 tekens bevatten, inclusief alle BBCodes en wordt weergegeven onder de
											Gebruikerskaart als legenda indien de weergave van POIs is ingeschakeld.<br>
											Schrijven en bewerken is onafhankelijk van alle andere instellingen op dit tabblad.',
	// Language packs tab
	'ACP_USERMAP_LANGS'					=> 'Taalpakketten',
	'ACP_USERMAP_LANGS_EXPLAIN'			=> 'Hier kunt u extra taalpakketten voor de gebruikerskaart installeren. Dit kan nodig zijn na het toevoegen van
											taalpakketten aan de gebruikerskaart na de eerste activering omdat hun gegevens niet zijn
											opgenomen in de vervolgkeuzelijst om het land te selecteren; dit kun je hier doen na het uploaden van het taalpakket
											met een ftp-programma in de <i>taal</i>-submap van deze extensie.',
	'ACP_USERMAP_INSTALLABLE_LANG'		=> 'Taalpakketten klaar voor installatie ',
	'ACP_USERMAP_INSTALL_LANG_EXP'		=> 'Gebruikerskaart-taalpakketten wachtend op installatie.',
	'ACP_USERMAP_MISSING_LANG'			=> 'Ontbrekende taalpakketten ',
	'ACP_USERMAP_MISSING_LANG_EXP'		=> 'Talen die op het board zijn geïnstalleerd, maar ontbreken in de Usermap-extensie.',
	'ACP_USERMAP_ADDITIONAL_LANG'		=> 'Extra taalpakketten van Usermap',
	'ACP_USERMAP_ADD_LANG_EXP'			=> 'De taalpakketten van de extensie waarvoor geen taal bestaat op dit bord.',
	'ACP_USERMAP_LANGPACK_NAME'			=> 'Naam',
	'ACP_USERMAP_LANGPACK_LOCAL'		=> 'Lokale Naam',
	'ACP_USERMAP_LANGPACK_ISO'			=> 'ISO',
	'ACP_USERMAP_NO_ENTRIES'			=> 'Geen taalpakketten gevonden',
	// Internal database tab
	'ACP_USERMAP_DATABASE'				=> 'Interne database',
	'ACP_USERMAP_DATABASE_EXPLAIN'		=> 'Deze tabel bevat al uw eerder ingevoerde gegevens van land-/postcodecombinaties en hun respectievelijke
											coördinaten. In de meest rechtse kolom vindt u een link om de betreffende regel te verwijderen.<br>
											Onder deze tabel kun je nieuwe gegevens toevoegen.',
	'ACP_USERMAP_DATABASE_DATA'			=> 'Gegevens momenteel beschikbaar',
	'ACP_USERMAP_DATABASE_CC'			=> 'ISO Landen Code',
	'ACP_USERMAP_DATABASE_ZIPCODE'		=> 'Postcode',
	'ACP_USERMAP_DATABASE_NAME'			=> 'Locatie naam',
	'ACP_USERMAP_DATABASE_EDIT'			=> 'Pas database item aan',
	'ACP_USERMAP_DATABASE_NOENTRY'		=> 'Geen data beschikbaar',
	'ACP_USERMAP_DATABASE_NEW'			=> 'Nieuw item invoeren in de database ',
	'ACP_USERMAP_DATABASE_CC_EXP'		=> 'Voer de twee hoofdletters van de landcode in van het land waaraan deze vermelding moet worden toegewezen.',
	'ACP_USERMAP_DATABASE_ZC_EXP'		=> 'Voer de postcode in waaraan deze invoer moet worden toegewezen, alleen hoofdletters, cijfers en het koppelteken (streepje) zijn toegestaan.',
	'ACP_USERMAP_DATABASE_NAME_EXP'		=> 'U kunt een naam invoeren om deze locatie beter te identificeren en te onderscheiden.',
	'ACP_USERMAP_DATABASE_ERROR'		=> 'Het veld >%1$s< mag niet leeg zijn!',
	'ACP_USERMAP_DATABASE_BIG_ERR'		=> 'Het veld mag niet leeg zijn! ',
	'ACP_USERMAP_DATABASE_INVALID'		=> 'Deze combinatie van landcode en postcode bestaat al, deze mag geen tweede keer worden gebruikt!<br>
											Het opslaan van deze invoer in de interne database is mislukt! ',
	// POI tab
	'ACP_USERMAP_POI'					=> 'POI bewerking',
	'ACP_USERMAP_POI_EXPLAIN'			=> 'In deze tabel worden alle POIs weergegeven die tot nu toe in de database zijn ingevoerd.<br>
											Onder deze tabel kunt u een nieuw item invoegen, daarnaast kunt u hier een bestaand item bewerken na het selecteren
											de link <i>Bewerken</i> in de laatste kolom van elke regel in de tabel.<br>
											Door de link <i>Verwijderen</i> te selecteren, kunt u een item uit uw database verwijderen.',
	'ACP_USERMAP_POI_DATA'				=> 'Momenteel beschikbare POI inzendingen ',
	'ACP_USERMAP_SELECT_POI_LAYER'		=> 'Overlay selecties',
	'ACP_USERMAP_POI_LAYER_ALL'			=> 'Alle',
	'ACP_USERMAP_POI_CREATOR'			=> 'Maker',
	'ACP_USERMAP_POI_VISIBLE'			=> 'POI zichtbaar',
	'ACP_USERMAP_POI_VISIBLE_EXP'		=> 'Selecteer of deze POI zichtbaar moet zijn op de geselecteerde kaartoverlay.',
	'ACP_USERMAP_POI_NEW'				=> 'Maak een nieuwe POI',
	'ACP_USERMAP_POI_EDIT'				=> 'Pas de geselecteerde POI aan',
	'ACP_USERMAP_POI_SUCCESS'			=> 'De POI genaamd „<strong>%1$s</strong>“ is met succes opgeslagen .',
	'ACP_USERMAP_POI_DELETE'			=> 'Weet je echt zeker dat je de POI met de naam „<strong>%1$s</strong>“ wilt verwijderen uit de database?<br>
											<strong>Dit verwijdert de POI permanent uit de database en kan niet ongedaan worden gemaakt! </strong>',
	'ACP_USERMAP_POI_DEL_SUCCESS'		=> 'De POI met de naam „<strong>%1$s</strong>“ is uit de database verwijderd. ',
	'ACP_ERR_POI_NO_NAME'				=> 'Het invoerveld met de naam „Naam van POI“ mag niet leeg zijn! ',
	'ACP_ERR_POI_NO_LAT'				=> 'Het invoerveld met de naam „Breedtegraad“ mag niet leeg zijn! ',
	'ACP_ERR_POI_NO_LNG'				=> 'Het invoerveld met de naam „Lengtegraad“ mag niet leeg zijn!',
	// Layer tab
	'ACP_USERMAP_LAYER'					=> 'Kaartoverlays ',
	'ACP_USERMAP_LAYER_EXPLAIN'			=> 'Alle bestaande kaartoverlays worden in deze tabel weergegeven.<br>
											In het gedeelte onder de tabel kunt u een nieuwe kaartoverlay maken of een bestaande bewerken door op de
											"Bewerken" link van de betreffende tabelrij. De huidige gegevens van de geselecteerde kaartoverlay worden dan weergegeven
											in deze sectie.<br>
											Met behulp van de respectievelijke link van de tabel kunt u dit item verwijderen.',
	'ACP_USERMAP_LAYER_SELECT_TYPE'		=> 'Selecteer het overlay type om weer te geven',
	'ACP_USERMAP_LAYER_DATA'			=> 'Bestaande kaartoverlays ',
	'ACP_USERMAP_LAYER_NAME'			=> 'Overlay naam',
	'ACP_USERMAP_LAYER_NAME_EXP'		=> 'Voer een naam in om deze kaartoverlay te identificeren.',
	'ACP_USERMAP_LAYER_TYPE_USER'		=> 'Gebruikers',
	'ACP_USERMAP_LAYER_TYPE_POI'		=> 'POI',
	'ACP_USERMAP_LAYER_ACTIVE'			=> 'Activeer overlay',
	'ACP_USERMAP_LAYER_ACTIVE_EXP'		=> 'Kies „Ja“ om deze kaartoverlay te activeren en bruikbaar te maken om POIs erop te plaatsen. Inactieve kaartoverlays kunnen niet worden geselecteerd
											terwijl u een nieuwe POI aanmaakt.',
	'ACP_USERMAP_SHOW_LAYER'			=> 'Permanent weergeven',
	'ACP_USERMAP_SHOW_LAYER_EXP'		=> 'Kies „Ja“ om deze kaartoverlay altijd weer te geven, te beginnen met het oproepen van de gebruikerskaart.<br>
											Als u "Nee" kiest, moeten gebruikers deze kaartoverlay selecteren via het besturingselement voor de kaartlaag.',
	'ACP_USERMAP_LAYER_CLUSTERS'		=> 'Cluster markeringen',
	'ACP_USERMAP_LAYER_CLUSTERS_EXP'	=> 'Om te vermijden dat de kaart een rommelig beeld heeft door een hoog aantal markeringen, kan je deze instelling activeren om clusters van markeringen in te stellen.
											Deze clusters worden aangepast aan de zoominstellingen.',
	'ACP_USERMAP_LAYER_LANG_VAR'		=> 'Taal variabelen',
	'ACP_USERMAP_LAYER_LANG_VAR_EXP'	=> 'Om uw gebruikers in staat te stellen kaartoverlays te identificeren met een term in hun moedertaal, voert u hier voor elk van de
											geïnstalleerde talen op uw board een term om deze overlay te identificeren in het laagbesturingselement, b.v. „Campings“ als
											een term om een kaartoverlay aan te duiden waarop campings worden weergegeven.<br>
											Zorg ervoor dat u een geldige taaltag gebruikt (zie de kolom "ISO" van uw ACP-taalpakkettentabel op het tabblad "Aanpassen")
											gevolgd door een dubbele punt en uw gewenste taalterm om ervoor te zorgen dat het systeem uw invoer kan gebruiken.<br>
											<strong>%1$sVoorbeeld:</span></strong> „nl:Campings“<br>
											Elke combinatie van taaltag en taalterm MOET zijn eigen regel gebruiken!<br>
											<strong>%1$sATTENTIE: een regel met de taaltag „en“ is VERPLICHT!</span></strong>',
	'ACP_USERMAP_LAYER_DEFAULTICON'		=> 'Standaard icon',
	'ACP_USERMAP_LAYER_ICON_EXP'		=> 'Selecteer het pictogrambestand dat als standaard op deze kaartoverlay wordt gebruikt. Deze selectie wordt weergegeven voor alle POIs
											gemaakt op deze overlay.',
	'ACP_USERMAP_GROUPS_VIEWING'		=> 'Toegelaten groepen',
	'ACP_USERMAP_PERMITTED_GROUPS'		=> 'Groepen die deze overlay kunnen zien',
	'ACP_USERMAP_PERMITTED_GROUPS_EXP'	=> 'Kaart overlays van leden worden enkel weergegeven indien de permissie om leden te bekijken toegekend is, kaart overlays voor POIs worden weergegeven indien POIs geactiveerd zijn en de nodige permissies om POI`s te zien geactiveerd en toegekend zijn.<br>
											Via deze instelling kan het weergeven van individuele overlays beperkt worden tot het weergeven van individuele overlays voor specifieke standaard groepen aan dewelke één of meerdere vereiste permissies toegekend zijn. Selecteer de standaard groepen die een specifiek overlay zouden moeten zien.<br>
											Om meerdere groepen te selecteren houd Shift of Ctrl key terwijl je op de gewenste gropeen klikt.',
	'ACP_USERMAP_LAYER_NEW'				=> 'Nieuwe kaartoverlay maken',
	'ACP_USERMAP_LAYER_EDIT'			=> 'Een bestaande kaartoverlay bewerken',
	'ACP_USERMAP_LAYER_SUCCESS'			=> 'De kaartoverlay met de naam „<strong>%1$s</strong>“ is succesvol opgeslagen.',
	'ACP_USERMAP_LAYER_DELETE'			=> 'Weet u echt zeker dat u de kaartoverlay met de naam „<strong>%1$s</strong>“ uit de database wilt verwijderen?<br>
											Alle POIs die aan deze kaartoverlay zijn toegewezen, worden niet langer weergegeven!<br>
											<strong>Hiermee wordt de kaartoverlay permanent uit de database verwijderd. Dit kan niet ongedaan worden gemaakt!</strong>',
	'ACP_USERMAP_LAYER_DEL_SUCCESS'		=> 'De kaartoverlay met de naam „<strong>%1$s</strong>“ is uit de database verwijderd.',
	'ACP_ERR_LAYER_NO_NAME'				=> 'Het invoerveld met de naam "Overlay Name" mag niet leeg zijn!',
	'ACP_ERR_LAYER_NO_LANG'				=> 'Het invoerveld met de naam „Taalvariabelen“ mag niet leeg zijn!',
	'ACP_ERR_LAYER_INCORRECT'			=> 'Deze taalvariabele voldoet niet aan de regels:',
	'ACP_ERR_LAYER_NO_EN'				=> 'Language variable „nl“ is missing! ',
	// Route tab
	'ACP_USERMAP_ROUTE'					=> 'Routes',
	// Logs
	'LOG_USERMAP_LAYER_NEW'				=> '<strong>Er is een nieuwe kaartoverlay toegevoegd aan de gebruikerskaart:</strong><br>» %s',
	'LOG_USERMAP_LAYER_EDITED'			=> '<strong>Een kaartoverlay bewerkt: </strong><br>» %s',
	'LOG_USERMAP_LAYER_DELETED'			=> '<strong>Een kaartoverlay verwijderd van de gebruikerskaart:</strong><br>» %s'
]);
