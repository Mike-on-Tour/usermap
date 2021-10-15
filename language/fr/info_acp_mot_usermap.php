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
	'ACP_USERMAP'					=> 'Carte des membres',
	'ACP_USERMAP_VERSION'			=> '<img src="https://img.shields.io/badge/Version-%1$s-green.svg?style=plastic" /><br>&copy; 2020 - %2$d by Mike-on-Tour',
	'SUPPORT_USERMAP'				=> 'Si vous souhaitez soutenir le développement de la carte de membre, vous pouvez le faire ici:<br>',
	// Settings tab
	'ACP_USERMAP_SETTINGS'			=> 'Configuration',
	'ACP_USERMAP_SETTINGS_EXPLAIN'	=> 'Ici vous pouvez modifier la configuration de la carte des membres.',
	'ACP_USERMAP_SETTING_SAVED'		=> 'La configuration de la carte des membres a été saisie.',
	'ACP_USERMAP_GENERAL_SETTINGS'	=> 'Réglages généraux',
	'ACP_USERMAP_ROWS_PER_PAGE'		=> 'Lignes par page de tableau',
	'ACP_USERMAP_ROWS_PER_PAGE_EXP'	=> 'Choisissez le nombre de lignes à afficher par page de tableau dans les autres onglets.',
	'ACP_USERMAP_MAPSETTING_TITLE'	=> 'Configuration de la carte',
	'ACP_USERMAP_MAPSETTING_TEXT'	=> 'Configuration du centre de la carte et de l’agrandissement au départ.',
	'ACP_USERMAP_LAT'				=> 'Latitude du centre de la carte',
	'ACP_USERMAP_LAT_EXP'			=> 'Valeurs entre 90.0 (Pôle Nord) und -90.0 (Pôle Sud)',
	'ACP_USERMAP_LON'				=> 'Latitude du centre de la carte',
	'ACP_USERMAP_LON_EXP'			=> 'Valeurs entre 180.0 (Est) und -180.0 (Ouest)',
	'ACP_USERMAP_ZOOM'				=> 'Facteur Zoom de la carte au départ',
	'ACP_USERMAP_MARKERS_TEXT'		=> 'Ici, vous pouvez modifier la taille des marqueurs pour représenter les membres de la carte indépendamment les uns des
										autres, à la fois pour l’affichage sur les ordinateurs (ordinateur de bureau, ordinateur portable, notebook, netbook,
										tablette) ainsi que sur les appareils mobiles (smartphone).<br>
										La taille est conforme au rayon du cercle utilisé comme marqueur, l’unité est le pixel.',
	'ACP_USERMAP_MARKERS_PC'		=> 'Rayon du cercle sur ordinateurs',
	'ACP_USERMAP_MARKERS_MOB'		=> 'Rayon du cercle sur mobiles',
	'ACP_USERMAP_GEONAMES_TITLE'	=> 'Nom d’utilisateur pour geonames.org',
	'ACP_USERMAP_GEONAMES_TEXT'		=> 'La carte des membres utilise le service de geonames.org pour déterminer les coordonnées géographiques du lieu, spécifié
										par le code postal et le pays et pour affiner le lieu de résidence spécifié.
										Pour cela il est nécessaire de s’enregistrer sur %1$s.
										Le nom d’utilisateur enregistré sur Geonames est à indiquqer ici.<br>
										Un point est crédité par requête; dans le service gratuit, un maximum de 1000 points de crédit sont disponibles par
										heure; Pour les forums de plus de 1 000 utilisateurs, il est recommandé d’enregistrer un nom d’utilisateur pour 1 000 à
										1 500 membres. Sinon, un message d’erreur pourrait s’afficher aux utilisateurs lors de la saisie du code postal et du
										pays dans le profil lorsque les coordonnées sont déterminées.<br>
										Les noms d’utilisateurs multiples doivent être séparés par des virgules.<br>
										<strong>ATTENTION:</strong> Après la premoère connexion sur geonames.org, les utilisateurs doivent utiliser ce
										%2$slien</span></a> pour activer séparément le service souhaité!!',
	'ACP_USERMAP_GEONAMESUSER'		=> 'Nom(s) d’utilisateur(s) pour geonames.org',
	'ACP_USERMAP_GEONAMESUSER_ERR'	=> 'Vous devez entrer au moins un nom d’utilisateur valide pour geonames.org!',
	'ACP_USERMAP_PROFILE_ERROR'		=> 'Cette action n’a pas pu être effectuée car vous n’avez pas encore spécifié un utilisateur Geonames.org dans les
										paramètres de la carte des membre. Veuillez faire ceci maintenant!',
	'ACP_USERMAP_GOOGLE_TITLE'		=> 'Paramètres pour l’utiilisation du Google Maps API',
	'ACP_USERMAP_GOOGLE_TEXT'		=> 'geonames.org ne livre des résultats que pour les pays mentionnés dans cette %1$sliste</span></a>.,
										Si des pays non répertoriés ici doivent être pris en compte dans la requête, le service Google Maps peut être utilisé,
										que tu peux activer ici.<br>
										Cette clé API peut être obtenue ici:
										%2$sGoogle Maps API Key</span></a>. Merci de suivre les instructions et de noter
										que vous devez activer l\'«API de géocodage».',
	'ACP_USERMAP_GOOGLE_ENABLE'		=> 'Activer l’utilisation de la clé API Google Maps?',
	'ACP_USERMAP_GOOGLE_KEY'		=> 'Introduire la clé API Google Maps ici',
	'ACP_USERMAP_APIKEY_ERROR'		=> 'Vous devez fournir une clé API Google Maps lorsque vous activez l’API Google Maps!',
	'ACP_USERMAP_GOOGLE_FORCE'		=> 'Code des pays qui sont toujours recherchés via l’API Google Maps',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'	=> 'Pour des raisons de droits d’auteur, geonames.org n’évalue que des parties du code postal pour certains pays. Cela conduit
										à des résultats très approximatifs lors de la détermination des coordonnées. Les pays concernés sont listés
										%1$sici</span></a>.<br>
										L’API Google Maps peut fournir des résultats plus précis pour ces pays. Si vous souhaitez trouver les résultats de l’API
										Google Maps pour ces pays au lieu de geonames.org, saisissez ici les codes de pays de ces pays, séparés par des virgules.',
	'ACP_USERMAP_DATABASE_TITLE'	=> 'Utilisation de la base de données interne',
	'ACP_USERMAP_DATABASE_TEXT'		=> 'Étant donné que Google Maps ne fournit pas de résultat pour certains pays (par exemple Israël), vous pouvez utiliser une
										table dans la base de données interne pour la requête, mais vous devez fournir les données pour cela. Vous pouvez le faire
										en sélectionnant l’onglet «Base de données interne». <br> Pour les utilisateurs qui vivent dans un pays non pris en charge
										par geonames.org, vous pouvez utiliser cette option sans utiliser l’API Google Maps.',
	'ACP_USERMAP_DATABASE_ENABLE'	=> 'Activer l’utilisation de la base de données interne?',
	'ACP_USERMAP_POI_TITLE'			=> 'Afficher des POIs',
	'ACP_USERMAP_POI_TEXT'			=> 'En plus d’afficher les membres enregistrés, la carte des membres peut afficher des points d’intérêt particulier pour les
										membres, par ex. Points de rendez-vous et hôtels pour motards ou emplacements des stades de football. Les paramètres à
										cet effet peuvent être définis dans cette section. <br> Dans la section suivante, une légende pour la signification des
										différentes catégories peut être saisie. Cette légende est alors également affichée sous la carte de membre.<br>
										La saisie et l’édition des POI doivent être effectuées par l’administrateur, les éléments à cet effet sont accessibles
										via l’onglet «Édition des POI».',
	'ACP_USERMAP_POI_ENABLE'		=> 'Activer l’affichage des POIs?',
	'ACP_USERMAP_POI_ENABLE_EXP'	=> 'Si vous sélectionnez «Oui» ici, la superposition de POI sera activée lorsque la carte de membre sera affichée. En même
										temps, le réglage suivant et l’affichage de la légende sont activés.',
	'ACP_USERMAP_ICON_TITLE'		=> 'Valeurs par défaut des icônes de POI',
	'ACP_USERMAP_ICON_TEXT'			=> 'Ici, vous pouvez modifier les valeurs par défaut pour la taille et le point d’ancrage des icônes de POI. Les valeurs
										des icônes fournies avec la carte des membres sont prédéfinies. Si vous utilisez vos propres icônes, vous pouvez saisir
										ici leurs valeurs par défaut. <br> Pour plus d’informations sur les icônes, leur taille et leur point d’ancrage,
										consultez le fichier ´ICONS.md´ dans le répertoire ´docs´.',
	'ACP_USERMAP_ICONSIZE_EXP'		=> 'Taille de l’icône en pixels dans la notation «largeur», «hauteur».',
	'ACP_USERMAP_ICONANCHOR_EXP'	=> 'Point d’ancrage de l’icône en pixels à partir du coin supérieur gauche dans la notation «valeur horizontale», «valeur verticale».',
	'ACP_USERMAP_POI_LEGEND'		=> 'Légende pour les POIs',
	'ACP_USERMAP_POI_LGND'			=> 'Créer et modifier la légende pour les POIs',
	'ACP_USERMAP_POI_LGND_EXP'		=> 'Le texte saisi ici (longueur maximale, y compris les codes BB utilisés, est de 1 000 caractères) est affiché sous forme
										de légende sous la carte de membre lorsque l’affichage des POIs est activée. <br> La modification est possible quels
										que soient les autres paramètres.',
	// Language packs tab
	'ACP_USERMAP_LANGS'				=> 'Packs linguistiques',
	'ACP_USERMAP_LANGS_EXPLAIN'		=> 'Vous pouvez installer des modules linguistiques supplémentaires pour la carte de membre ici. Cela peut être nécessaire
										si des packs de langue pour la carte de membre sont ajoutés après la première activation car leurs données n’ont pas
										encore été incluses dans la liste de sélection des pays; vous pouvez le faire ici après que le package de langue ait
										été copié dans le sous-répertoire <i> language </i> de cette extension via un transfert ftp.',
	'ACP_USERMAP_INSTALLABLE_LANG'	=> 'Packs linguistiques disponibles pour l’installation.',
	'ACP_USERMAP_INSTALL_LANG_EXP'	=> 'Sont listés ici tous les packs linquistiques de la carte des membres qui doivent encore être installés.',
	'ACP_USERMAP_MISSING_LANG'		=> 'Packs linguistiques manquants',
	'ACP_USERMAP_MISSING_LANG_EXP'	=> 'Sont listés ici tous les packs linguistiques du forum qui manquent encore pour la carte des membres.',
	'ACP_USERMAP_ADDITIONAL_LANG'	=> 'Packs linguistiques supplémentaires pour la carte des membres',
	'ACP_USERMAP_ADD_LANG_EXP'		=> 'Sont listés ico tous les packs linguistiques de la carte des membres qui n’exitent pas pour le forum.',
	'ACP_USERMAP_LANGPACK_NAME'		=> 'Nom',
	'ACP_USERMAP_LANGPACK_LOCAL'	=> 'Nom local',
	'ACP_USERMAP_LANGPACK_ISO'		=> 'ISO',
	'ACP_USERMAP_NO_ENTRIES'		=> 'Aucun pack linguistique trouvé',
	// Internal database tab
	'ACP_USERMAP_DATABASE'			=> 'Base de données interne',
	'ACP_USERMAP_DATABASE_EXPLAIN'	=> 'Toutes les entrées existantes dans la base de données interne sont répertoriées ici dans un tableau. Ces entrées
										peuvent être supprimées à l’aide des liens dans la colonne de droite. <br> De nouvelles entrées peuvent être ajoutées
										sous ce tableau.',
	'ACP_USERMAP_DATABASE_DATA'		=> 'Contenu de la base de données',
	'ACP_USERMAP_DATABASE_CC'		=> 'ISO Code pays',
	'ACP_USERMAP_DATABASE_ZIPCODE'	=> 'Code postal',
	'ACP_USERMAP_DATABASE_NAME'		=> 'Nom du lieu',
	'ACP_USERMAP_DATABASE_EDIT'		=> 'Modifier l´élément de la base de données',
	'ACP_USERMAP_DATABASE_NOENTRY'	=> 'Aucune donnée existante',
	'ACP_USERMAP_DATABASE_NEW'		=> 'Nouvelle entrée da la base de données',
	'ACP_USERMAP_DATABASE_CC_EXP'	=> 'Entrez le code à 2 lettres du pays auquel l’entrée doit être attribuée.',
	'ACP_USERMAP_DATABASE_ZC_EXP'	=> 'Entrez le code postal auquel l’entrée doit être attribuée. Les majuscules, les chiffres et le trait d’union sont autorisés.',
	'ACP_USERMAP_DATABASE_NAME_EXP'	=> 'Vous pouvez entrer un nom pour mieux identifier et discerner cet emplacement.',
	'ACP_USERMAP_DATABASE_ERROR'	=> 'Le champ >%1$s< doit être renseigné!',
	'ACP_USERMAP_DATABASE_BIG_ERR'	=> 'Le champ doit être renseigné!',
	'ACP_USERMAP_DATABASE_INVALID'	=> 'La combinaison code pays et code postal existe déjà, il ne faut plus la réutiliser! <br> L’enregistrement dans la base de données interne a échoué!',
	// POI tab
	'ACP_USERMAP_POI'				=> 'Modification des POIs',
	'ACP_USERMAP_POI_EXPLAIN'		=> 'Les POI créés précédemment sont répertoriés ici dans un tableau. <br> Dans la partie inférieure, de nouvelles entrées
										peuvent être créées. Après avoir sélectionné le lien à modifier dans le tableau, les données précédentes de l’entrée
										sont affichées pour modification. <br> Les entrées individuelles peuvent être supprimées via le lien correspondant dans
										le tableau.',
	'ACP_USERMAP_POI_DATA'			=> 'POIs enregistrés',
	'ACP_USERMAP_POI_CREATOR'		=> 'Créateur',
	'ACP_USERMAP_POI_VISIBLE'		=> 'POI visible',
	'ACP_USERMAP_POI_VISIBLE_EXP'	=> 'Sélectionnez si ce POI doit être visible sur la superposition de la carte sélectionnée.',
	'ACP_USERMAP_POI_NEW'			=> 'Enregistrer un nouveau POI',
	'ACP_USERMAP_POI_EDIT'			=> 'Modification d’un POI existant',
	'ACP_USERMAP_POI_SUCCESS'		=> 'Le POI nommé «<strong>%1$s</strong>» a bien été enregistré.',
	'ACP_USERMAP_POI_DELETE'		=> 'Êtes-vous vraiment certain de vouloir supprimer le POI nommé «<strong>%1$s</strong>» de la base de données?<br>
											<strong>Cela supprime définitivement le POI de la base de données et ne peut pas être annulé!</strong>',
	'ACP_USERMAP_POI_DEL_SUCCESS'	=> 'Le POI nommé «<strong>%1$s</strong>» a été supprimé de la base de données.',
	'ACP_ERR_POI_NO_NAME'		=> 'Le champ de saisie «Nom du POI» ne doit pas être vide!',
	'ACP_ERR_POI_NO_LAT'		=> 'Le champ de saisie nommé «Latitude» ne doit pas être vide!',
	'ACP_ERR_POI_NO_LNG'		=> 'Le champ de saisie nommé «Longitude» ne doit pas être vide!',
	// Layer tab
	'ACP_USERMAP_LAYER'				=> 'Superpositions de carte',
	'ACP_USERMAP_LAYER_EXPLAIN'		=> 'Toutes les superpositions de carte existantes sont répertoriées dans ce tableau.<br>
										Dans la section sous le tableau, vous pouvez créer une nouvelle superposition de carte ou en modifier une existante en
										cliquant sur le lien «Modifier» de la ligne de tableau respective. Les données actuelles de la superposition de carte
										sélectionnée seront alors affichées dans cette section.<br>
										En utilisant le lien respectif du tableau, vous pouvez supprimer cet élément.',
	'ACP_USERMAP_LAYER_DATA'		=> 'Superpositions de carte existantes',
	'ACP_USERMAP_LAYER_NAME'		=> 'Nom de la superposition',
	'ACP_USERMAP_LAYER_NAME_EXP'	=> 'Entrez un nom pour identifier cette superposition de carte.',
	'ACP_USERMAP_MEMBER_LAYER'		=> 'Superposition de carte membres',
	'ACP_USERMAP_MEMBER_LAYER_EXP'	=> 'Choisissez «Oui» pour utiliser cette superposition de carte pour afficher les marqueurs de membre et «Non» pour l´utiliser
										pour afficher les marqueurs de POI.<br>
										Les superpositions de carte pour les membres sont affichées uniquement avec l´autorisation de voir les membres, les
										superpositions de carte pour les POI sont affichées si les POI sont activés et l´autorisation de voir les POI est valide.',
	'ACP_USERMAP_LAYER_ACTIVE'		=> 'Activer la superposition de carte',
	'ACP_USERMAP_LAYER_ACTIVE_EXP'	=> 'Choisissez «Oui» pour activer cette superposition de carte et la rendre utilisable pour y placer des POI. Les superpositions
										de carte inactives ne peuvent pas être sélectionnées lors de la création d´un nouveau POI.',
	'ACP_USERMAP_SHOW_LAYER'		=> 'Afficher en permanence',
	'ACP_USERMAP_SHOW_LAYER_EXP'	=> 'Choisissez «Oui» pour toujours afficher cette superposition de carte, en commençant par appeler la carte d´utilisateur.<br>
										Si vous choisissez «Non», les utilisateurs doivent sélectionner cette superposition de carte via l´élément de contrôle de la carte.',
	'ACP_USERMAP_LAYER_LANG_VAR'	=> 'Variables des versions linguistiques',
	'ACP_USERMAP_LAYER_LANG_VAR_EXP' => 'Pour permettre à vos utilisateurs didentifier les superpositions de carte avec un terme dans leur langue maternelle,
										veuillez entrer ici pour chacune des langues installées sur votre carte un terme pour identifier cette superposition
										dans l´élément de contrôle de couche, par exemple «Campings» comme terme pour identifier une superposition de carte
										présentant les terrains de camping.<br>
										Veuillez vous assurer d´utiliser une balise de langue valide (voir la ligne «ISO» du tableau des packs de langue de
										votre ACP dans l´onglet «Personnaliser») suivie de deux points et du terme de langue souhaité pour vous assurer que le
										système peut utiliser votre entrée.<br>
										<strong>%1$sExemple:</span></strong> „en:Campgrounds“<br>
										Chaque combinaison de mot clé de langue et de terme de langue DOIT utiliser sa propre ligne<br>
										<strong>%1$sATTENTION: Une ligne avec le mot clé de langue «en» est OBLIGATOIRE!</span></strong>',
	'ACP_USERMAP_LAYER_DEFAULTICON'	=> 'Icône par défaut',
	'ACP_USERMAP_LAYER_ICON_EXP'	=> 'Sélectionnez le fichier d´icône qui sera utilisé par défaut sur cette superposition de carte. Cette sélection sera
										présentée pour tous les POI créés sur cette superposition de carte.',
	'ACP_USERMAP_LAYER_NEW'			=> 'Créer une nouvelle superposition de cartey',
	'ACP_USERMAP_LAYER_EDIT'		=> 'Modifier une superposition de carte existante',
	'ACP_USERMAP_LAYER_SUCCESS'		=> 'La superposition de carte nommée «<strong>%1$s</strong>» a été correctement sauvée.',
	'ACP_USERMAP_LAYER_DELETE'		=> 'Voulez-vous vraiment supprimer la superposition de carte nommée «<strong>%1$s</strong>» de la base de données?<br>
										Tous les POI attribués à cette superposition de carte ne seront plus affichés!<br>
										<strong>Cela supprime la superposition de carte de manière permanente de la base de données et ne peut pas être annulée!</strong>',
	'ACP_USERMAP_LAYER_DEL_SUCCESS'	=> 'La superposition de carte nommée «<strong>%1$s</strong>» a été supprimée de la base de données.',
	'ACP_ERR_LAYER_NO_NAME'		=> 'Le champ de saisie «Nom de la superposition de carte» ne doit pas être vide!',
	'ACP_ERR_LAYER_NO_LANG'		=> 'Le champ de saisie «Variables de langue» ne doit pas être vide!',
	'ACP_ERR_LAYER_INCORRECT'	=> 'Cette variable de langue ne respecte pas les règles: ',
	'ACP_ERR_LAYER_NO_EN'		=> 'La variable de langue «en» est manquante!',
	// Logs
	'LOG_USERMAP_LAYER_NEW'			=> '<strong>Une nouvelle superposition de carte a été ajoutée à la carte d´utilisateur:</strong><br>» %s',
	'LOG_USERMAP_LAYER_EDITED'		=> '<strong>Modification d´une superposition de carte:</strong><br>» %s',
	'LOG_USERMAP_LAYER_DELETED'		=> '<strong>Suppression d´une superposition de carte de la carte d´utilisateur:</strong><br>» %s'
]);
