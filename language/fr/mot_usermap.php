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
	'USERMAP'						=> 'Carte des membres',
	'USERMAP_NOT_AUTHORIZED'		=> 'Tu n’es pas autorisé à voir la carte.',
	'USERMAP_SEARCHFORM'			=> 'Chercher',
	'USERMAP_LEGEND'				=> 'Légende',
	'USERMAP_CREDENTIALS'			=> 'Les géodonnées sont mises à disposition par ',
	'USERMAP_LEGEND_TEXT'			=> 'Activez et désactivez le zoom de la carte avec la molette de la souris en un clic dans la carte.',
	'MAP_USERS'						=> array(
		1	=> 'Actuellement %1$s membre s’est inscrit sur la carte.',
		2	=> 'Actuellement %1$s membres se sont inscrits sur la carte.',
	),
	'MAP_SEARCH'					=> 'Recherche des membres pour le CP %1$s dans un rayon de  ',
	'MAP_RESULT'					=> 'donne le résultat suivant:',
	'MAP_NORESULT'					=> 'ne trouve aucun membre dans un rayon de ',
	'POI_LEGEND_TITLE'				=> 'Légende pour la présentation des POIs',
	'STREET_DESC'					=> 'Carte routière',
	'TOPO_DESC'						=> 'Carte topographique',
	'SAT_DESC'						=> 'Carte satellite',
	'USER_DESC'						=> 'Membres',
	'POI_DESC'						=> 'POIs',
	// User POI popup
	'POI_INPUT_EXPL'				=> 'Ici, vous pouvez créer un POI. Ses coordonnées sont tirées du marqueur sur la carte à gauche. Ce marqueur peut être
										déplacé avec la souris pour le mettre dans sa position finale. Le nom, la description et l’icône à utiliser
										ultérieurement peuvent être saisis ou sélectionnés ci-dessous.',
	'POI_NEW_SAVED'					=> 'Le POI créé a été enregistré avec succès dans la base de données et s’affiche sur la carte.',
	'POI_MOD_NOTIFIED'				=> 'Le POI créé a été enregistré avec succès dans la base de données, les modérateurs sont informés que le nouveau POI
										attend son activation.',
	// Notifications
	'NOTIFICATION_USERMAP_MOD'		=> 'Notifications concernant la modération de la carte des membres',
	'USERMAP_SETTING_APPROVE'		=> 'Un POI nouvellement créé doit être activé',
	'USERMAP_SETTING_NOTIFY'		=> 'Un nouveau POI a été ajouté à la carte des membres',
	'USERMAP_NOTIFY_POI_APPROVE'	=> '<strong>Nouveau POI en attente d’activation </strong> <br> Un nouveau POI portant le nom "<strong>%1$s </strong>" a
										été créé par le membre "%2$s" et est en attente d’activation.',
	'USERMAP_NOTIFY_POI'			=> '<strong>POI ajouté </strong> <br> Le membre "%2$s" a ajouté un nouveau POI appelé "<strong>%1$s </strong>" à la carte
										des membres.',
	// Moderation
	'POI_MOD_EXPL'					=> 'Ici, vous pouvez afficher, vérifier et - si nécessaire ou souhaité - modifier les données d’un POI nouvellement créé
										par un membre. Vous pouvez modifier la position du marqueur en le déplaçant avec la souris. Enfin, vous pouvez
										sauvegarder le POI (et donc l’activer) ou le supprimer s’il ne répond pas aux critères de votre forum.',
	'USERMAP_MOD_NOT_AUTHORIZED'	=> '<strong>Vous n’êtes pas autorisé à effectuer cette action!</strong>',
	'POI_NONEXISTENT'				=> 'POI non existant',
	'POI_ALREADY_APPROVED'			=> 'Ce POI a déjà été activé!',
	'APPROVE'						=> 'Activer',
	'DONE'							=> 'Fait',
	'POI_APPROVED'					=> 'Ce POI a été activé.',
	'ACTION_CONCLUDED'				=> 'Processus terminé.',
	'CHANGES_SUCCESSFUL'			=> 'Toutes les modifications ont été enregistrées avec succès.',
	'BACK_TO_USERMAP'				=> 'Retour à la carte des membres',
	// ACP
	'ACP_USERMAP'					=> 'Carte des membres',
	'SUPPORT_USERMAP'				=> 'Si vous souhaitez soutenir le développement de la carte de membre, vous pouvez le faire ici:<br>',
	// Settings tab
	'ACP_USERMAP_SETTINGS'			=> 'Configuration',
	'ACP_USERMAP_SETTINGS_EXPLAIN'	=> 'Ici vous pouvez modifier la configuration de la carte des membres.',
	'ACP_USERMAP_SETTING_SAVED'		=> 'La configuration de la carte des membres a été saisie.',
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
										Pour cela il est nécessaire de s’enregistrer sur
										<a href="https://www.geonames.org/login" target="_blank">
										<span style="text-decoration: underline;">geonames.org/login</span></a>.
										Le nom d’utilisateur enregistré sur Geonames est à indiquqer ici.<br>
										Un point est crédité par requête; dans le service gratuit, un maximum de 1000 points de crédit sont disponibles par
										heure; Pour les forums de plus de 1 000 utilisateurs, il est recommandé d’enregistrer un nom d’utilisateur pour 1 000 à
										1 500 membres. Sinon, un message d’erreur pourrait s’afficher aux utilisateurs lors de la saisie du code postal et du
										pays dans le profil lorsque les coordonnées sont déterminées.<br>
										Les noms d’utilisateurs multiples doivent être séparés par des virgules.<br>
										<strong>ATTENTION:</strong> Après la premoère connexion sur geonames.org, les utilisateurs doivent utiliser ce
										<a href="https://www.geonames.org/manageaccount" target="_blank">
										<span style="text-decoration: underline;">lien</span></a>
										pour activer séparément le service souhaité!!',
	'ACP_USERMAP_GEONAMESUSER'		=> 'Nom(s) d’utilisateur(s) pour geonames.org',
	'ACP_USERMAP_GEONAMESUSER_ERR'	=> 'Vous devez entrer au moins un nom d’utilisateur valide pour geonames.org!',
	'ACP_USERMAP_PROFILE_ERROR'		=> 'Cette action n’a pas pu être effectuée car vous n’avez pas encore spécifié un utilisateur Geonames.org dans les
										paramètres de la carte des membre. Veuillez faire ceci maintenant!',
	'ACP_USERMAP_GOOGLE_TITLE'		=> 'Paramètres pour l’utiilisation du Google Maps API',
	'ACP_USERMAP_GOOGLE_TEXT'		=> 'geonames.org ne livre des résultats que pour les pays mentionnés dans cette
										<a href="https://www.geonames.org/postal-codes/" target="_blank">
										<span style="text-decoration: underline;">liste</span></a>.,
										Si des pays non répertoriés ici doivent être pris en compte dans la requête, le service Google Maps peut être utilisé,
										que tu peux activer ici.<br>
										Cette clé API peut être obtenue ici:
										<a href="https://developers.google.com/maps/documentation/embed/get-api-key" target="_blank">
										<span style="text-decoration: underline;">Google Maps API Key</span></a>. Merci de suivre les instructions et de noter
										que vous devez activer l\'«API de géocodage».',
	'ACP_USERMAP_GOOGLE_ENABLE'		=> 'Activer l’utilisation de la clé API Google Maps?',
	'ACP_USERMAP_GOOGLE_KEY'		=> 'Introduire la clé API Google Maps ici',
	'ACP_USERMAP_APIKEY_ERROR'		=> 'Vous devez fournir une clé API Google Maps lorsque vous activez l’API Google Maps!',
	'ACP_USERMAP_GOOGLE_FORCE'		=> 'Code des pays qui sont toujours recherchés via l’API Google Maps',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'	=> 'Pour des raisons de droits d’auteur, geonames.org n’évalue que des parties du code postal pour certains pays. Cela conduit
										à des résultats très approximatifs lors de la détermination des coordonnées. Les pays concernés sont listés
										<a href="http://download.geonames.org/export/zip/readme.txt" target="_blank">
										<span style="text-decoration: underline;">ici</span></a>nachlesen.<br>
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
	'ACP_USERMAP_DATABASE_LAT'		=> 'Longitude',
	'ACP_USERMAP_DATABASE_LNG'		=> 'Latitude',
	'ACP_USERMAP_DATABASE_EDIT'		=> 'Modifier',
	'ACP_USERMAP_DATABASE_NOENTRY'	=> 'Aucune donnée existante',
	'ACP_USERMAP_DATABASE_NEW'		=> 'Nouvelle entrée da la base de données',
	'ACP_USERMAP_DATABASE_CC_EXP'	=> 'Entrez le code à 2 lettres du pays auquel l’entrée doit être attribuée.',
	'ACP_USERMAP_DATABASE_ZC_EXP'	=> 'Entrez le code postal auquel l’entrée doit être attribuée. Les majuscules, les chiffres et le trait d’union sont autorisés.',
	'ACP_USERMAP_DATABASE_ERROR'	=> 'Le champ >%1$s< doit être renseigné!',
	'ACP_USERMAP_DATABASE_BIG_ERR'	=> 'Le champ doit être renseigné!',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'La modification de la base de données interne a été enregistrée avec succès.',
	'ACP_USERMAP_DATABASE_INVALID'	=> 'La combinaison code pays et code postal existe déjà, il ne faut plus la réutiliser! <br> L’enregistrement dans la base de données interne a échoué!',
	'ACP_USERMAP_CONFIRM_DELETE'	=> 'Voulez-vous vraiment supprimer cette entrée de la base de données? <br> <strong> Cette opération est irréversible!</strong>',
	// POI tab
	'ACP_USERMAP_POI'				=> 'Modification des POIs',
	'ACP_USERMAP_POI_EXPLAIN'		=> 'Les POI créés précédemment sont répertoriés ici dans un tableau. <br> Dans la partie inférieure, de nouvelles entrées
										peuvent être créées. Après avoir sélectionné le lien à modifier dans le tableau, les données précédentes de l’entrée
										sont affichées pour modification. <br> Les entrées individuelles peuvent être supprimées via le lien correspondant dans
										le tableau.',
	'ACP_USERMAP_POI_DATA'			=> 'POIs enregistrés',
	'ACP_USERMAP_POI_NAME'			=> 'Nom du POI enregsistré',
	'ACP_USERMAP_POI_POPUP'			=> 'Description du POI enregistré',
	'ACP_USERMAP_POI_ICON'			=> 'Icône-Fichier',
	'ACP_USERMAP_POI_SIZE'			=> 'Icône-Taille',
	'ACP_USERMAP_POI_ANCHOR'		=> 'Icône-Point d’ancrage',
	'ACP_USERMAP_POI_NEW'			=> 'Enregistrer un nouveau POI',
	'ACP_USERMAP_POI_EDIT'			=> 'Modification d’un POI existant',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'Le nom de l’entrée s’affiche sous la forme d’une info-bulle sur la carte lorsque vous survolez le POI avec le pointeur
										de la souris.',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'La description de l’entrée peut comporter jusqu’à 500 caractères et peut contenir du code BB. <br> S’affiche sur la
										carte sous forme de bulle contextuelle lorsque vous cliquez sur le POI.',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'Différents marqueurs de couleur peuvent être sélectionnés ici pour afficher différentes catégories de POI.',
	'ACP_USERMAP_POI_SIZE_EXP'		=> 'Taille de l’icône en pixels dans la notation «largeur», «hauteur».<br>
										Sont prédéfinies les valeurs standard spécifiées dans les «Paramètres».',
	'ACP_USERMAP_POI_ANCHOR_EXP'	=> 'Point d’ancrage de l’icône en pixels à partir du coin supérieur gauche dans la notation «valeur horizontale», «valeur verticale».<br>
										Sont prédéfinies les valeurs standard spécifiées dans les «Paramètres».',
	// UCP
	'MOT_ZIP'						=> 'Code postal',
	'MOT_ZIP_EXP'					=> 'Saisissez ici le code postal de votre lieu de résidence pour qu’il apparaisse sur la carte des membres. <br> (Seuls les
										majuscules, les chiffres et les tirets sont autorisés)',
	'MOT_LAND'						=> 'Pays',
	'MOT_LAND_EXP'					=> 'Sélectionnez ici le pays dans lequel vous vivez pour apparaître sur la carte des membres.',
	'MOT_UCP_GEONAMES_ERROR'		=> 'Aucun utilisateur Geonames.org n’a été spécifiée par l’administrateur. Les données pour la carte des membres n’ont pas
										pu être déterminées!',
	// Log entries
	'LOG_USERMAP_GOOGLE_ERROR'		=> '<strong>L’API Google Maps a renvoyé le message d’erreur suivant lors de son exécution:</strong><br>» %s',
	'LOG_USERMAP_GEONAMES_ERROR'	=> '<strong>L’API Geonames a renvoyé le message d’erreur suivant lors de son exécution:</strong><br>» %s',
	'LOG_USERMAP_SETTING_UPDATED'	=> '<strong>Les paramètres de la carte des membres ont été modifiés</strong>',
	'LOG_POI_LEGEND_UPDATED'		=> '<strong>Le texte de la légende des POIs a été modifié</strong>',
	'LOG_USERMAP_ZIPCODE_NEW'		=> '<strong>Nouvelle entrée de base de données ajoutée à la carte des membres:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_DELETED'	=> '<strong>Entrée de base de données pour la carte des membre supprimée:</strong><br>» %s',
	'LOG_USERMAP_INSTALL_LANG'		=> '<strong>Pack linguistique ajouté à la carte des membres:</strong><br>» %s',
	'LOG_USERMAP_POI_NEW'			=> '<strong>Ajout d’un nouveau POI à la carte des membres:</strong><br>» %s',
	'LOG_USERMAP_POI_EDITED'		=> '<strong>Les valeurs d’un POI ont été modifiées:</strong><br>» %s',
	'LOG_USERMAP_POI_DELETED'		=> '<strong>POI supprimé de la carte des membres:</strong><br>» %s',
	'LOG_USERMAP_POI_APPROVED'		=> '<strong>POI créé par un membre a été activé:</strong><br>» %s',
	'LOG_USERMAP_POI_MOD_DELETED'	=> '<strong>POI créé par un membre a été supprimé:</strong><br>» %s',
));
