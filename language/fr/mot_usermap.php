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
	'USERMAP'						=> 'Carte des membres',
	'USERMAP_NOT_AUTHORIZED'		=> 'Tu n’es pas autorisé à voir la carte.',
	'USERMAP_SEARCHFORM'			=> 'Chercher',
	'USERMAP_LEGEND'				=> 'Légende',
	'USERMAP_CREDENTIALS'			=> 'Les géodonnées sont mises à disposition par ',
	'USERMAP_LEGEND_TEXT'			=> 'Activez et désactivez le zoom de la carte avec la molette de la souris en un clic dans la carte.',
	'MAP_USERS'						=> [
		0	=> 'Il n´y a actuellement aucun membre affiché sur la carte.',
		1	=> 'Actuellement %1$d membre s`est inscrit sur la carte.',
		2	=> 'Actuellement %1$d membres se sont inscrits sur la carte.',
	],
	'POI_COUNT'						=> [
		0	=> 'Il ny a actuellement aucun POI affiché sur la carte.',
		1	=> 'Il y a actuellement %1$d POI affiché sur la carte.',
		2	=> 'Il y a actuellement %1$d POI affichés sur la carte.',
	],
	// Search tabs
	'TAB_RADIUS_SEARCH'				=> 'Rechercher dans le voisinage du code postal',
	'TAB_MEMBER_SEARCH'				=> 'Rechercher des membres',
	'TAB_POI_SEARCH'				=> 'Rechercher des POI',
	'TAB_ADDRESS_SEARCH'			=> 'Recherche Google Maps',
	'MAP_SEARCH'					=> 'Recherche des membres pour le CP %1$s dans un rayon de  ',
	'MAP_RESULT'					=> 'donne le résultat suivant:',
	'MAP_NORESULT'					=> 'ne trouve aucun membre dans un rayon de ',
	'MAP_KM'						=> 'km',
	'MEMBERNAME_SEARCH'				=> 'Entrez le nom d´utilisateur du membre (le joker * est disponible)',
	'MEMBERNAME_RESULT'				=> 'Les membres suivants ont été trouvés:',
	'MEMBERNAME_NORESULT'			=> 'Il n´y a aucun membre avec un nom d´utilisateur correspondant à votre demande.',
	'POINAME_SEARCH'				=> 'Entrez le nom du POI (le joker * est disponible)',
	'POINAME_RESULT'				=> 'Les POI suivants ont été trouvés:',
	'POINAME_NORESULT'				=> 'Il n´y a pas de POI dont le nom correspond à votre demande.',
	'ADDRESS_SEARCH'				=> 'Saisissez le terme de recherche (par exemple une adresse) pour lequel vous souhaitez trouver les coordonnées (par exemple pour créer un POI)',
	'ADDRESS_RESULT'				=> 'Le terme de recherche a été trouvé et saffiche avec un marqueur sur la carte.',
	'ADDRESS_NORESULT'				=> 'Impossible de trouver les coordonnées correspondant au terme de recherche donné.',
	// Legend
	'POI_LEGEND_TITLE'				=> 'Légende pour la présentation des POIs',
	'STREET_DESC'					=> 'Carte routière',
	'TOPO_DESC'						=> 'Carte topographique',
	'SAT_DESC'						=> 'Carte satellite',
	// Permission overview
	'USERMAP_PERM_OVERVIEW'			=> 'Autorisations sur cette page',
	'USERMAP_PERM_VIEW_ALWAYS'		=> 'Vous <strong>pouvez</strong> voyez toujours les membres.<br>',
	'USERMAP_PERM_VIEW_SUBSCRIBED'	=> 'Vous <strong>pouvez</strong> voyez uniquement les membres si vous vous êtes inscrit sur la carte d´utilisateur.<br>',
	'USERMAP_NO_VIEW_SUBSCRIBED'	=> 'Vous <strong>ne pouvez pas</strong> voyez les membres.<br>',
	'USERMAP_PERM_VIEW_POI'			=> 'Vous <strong>pouvez</strong> voyez les POI.<br>',
	'USERMAP_NO_VIEW_POI'			=> 'Vous <strong>ne pouvez pas</strong> voyez les POIs.<br>',
	'USERMAP_NO_ADD_POI'			=> 'Vous <strong>ne pouvez pas</strong> créez des POI.<br>',
	'USERMAP_PERM_ADD_POI'			=> 'Vous <strong>pouvez</strong> créez des POI sans l´approbation du modérateur.<br>',
	'USERMAP_PERM_ADD_POI_MOD'		=> 'Vous <strong>pouvez</strong> créez des POI avec l´approbation du modérateur.<br>',
	// Error messages
	'USERMAP_GN_USER_ERROR'			=> ': L´utilisateur Geonames n´existe pas ou n´est pas activé pour ce service!',
	// User POI popup
	'POI_INPUT_EXPL'				=> 'Ici, vous pouvez créer un POI. Ses coordonnées sont tirées du marqueur sur la carte à gauche. Ce marqueur peut être
										déplacé avec la souris pour le mettre dans sa position finale. Le nom, la description et l’icône à utiliser
										ultérieurement peuvent être saisis ou sélectionnés ci-dessous.',
	'POI_NEW_SAVED'					=> 'Le POI créé a été enregistré avec succès dans la base de données et s’affiche sur la carte.',
	'POI_MOD_NOTIFIED'				=> 'Le POI créé a été enregistré avec succès dans la base de données, les modérateurs sont informés que le nouveau POI
										attend son activation.',
	'ACP_USERMAP_POI_NAME'			=> 'Nom du POI enregsistré',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'Le nom de l’entrée s’affiche sous la forme d’une info-bulle sur la carte lorsque vous survolez le POI avec le pointeur
										de la souris.',
	'ACP_USERMAP_POI_POPUP'			=> 'Description du POI enregistré',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'La description de l’entrée peut comporter jusqu’à 500 caractères et peut contenir du code BB. <br> S’affiche sur la
										carte sous forme de bulle contextuelle lorsque vous cliquez sur le POI.',
	'ACP_USERMAP_POI_ICON'			=> 'Icône-Fichier',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'Différents marqueurs de couleur peuvent être sélectionnés ici pour afficher différentes catégories de POI.',
	'ACP_USERMAP_POI_SIZE'			=> 'Icône-Taille',
	'ACP_USERMAP_POI_SIZE_EXP'		=> 'Taille de l’icône en pixels dans la notation «largeur», «hauteur».<br>
										Sont prédéfinies les valeurs standard spécifiées dans les «Paramètres».',
	'ACP_USERMAP_POI_ANCHOR'		=> 'Icône-Point d’ancrage',
	'ACP_USERMAP_POI_ANCHOR_EXP'	=> 'Point d’ancrage de l’icône en pixels à partir du coin supérieur gauche dans la notation «valeur horizontale», «valeur verticale».<br>
										Sont prédéfinies les valeurs standard spécifiées dans les «Paramètres».',
	'ACP_USERMAP_DATABASE_LAT'		=> 'Longitude',
	'ACP_USERMAP_DATABASE_LNG'		=> 'Latitude',
	'ACP_USERMAP_POI_LAYER'			=> 'Superposition de carte',
	'ACP_USERMAP_POI_LAYER_EXP'		=> 'Sélectionnez la superposition de carte sur laquelle ce POI sera affiché.',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'La modification de la base de données interne a été enregistrée avec succès.',
	'ACP_USERMAP_CONFIRM_DELETE'	=> 'Voulez-vous vraiment supprimer cette entrée de la base de données? <br> <strong> Cette opération est irréversible!</strong>',
	'USERMAP_POI_NAME_ERROR'		=> 'Le champ >%1$s< doit être renseigné!',
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
	// UCP
	'MOT_ZIP'						=> 'Code postal',
	'MOT_ZIP_EXP'					=> 'Saisissez ici le code postal de votre lieu de résidence pour qu’il apparaisse sur la carte des membres. <br> (Seuls les
										majuscules, les chiffres et les tirets sont autorisés)',
	'MOT_LAND'						=> 'Pays',
	'MOT_LAND_EXP'					=> 'Sélectionnez ici le pays dans lequel vous vivez pour apparaître sur la carte des membres.',
	'MOT_UCP_GEONAMES_ERROR'		=> 'Aucun utilisateur Geonames.org n’a été spécifiée par l’administrateur. Les données pour la carte des membres n’ont pas
										pu être déterminées!',
	// Log entries
	'LOG_USERMAP_SETTING_UPDATED'	=> '<strong>Les paramètres de la carte des membres ont été modifiés</strong>',
	'LOG_POI_LEGEND_UPDATED'		=> '<strong>Le texte de la légende des POIs a été modifié</strong>',
	'LOG_USERMAP_INSTALL_LANG'		=> '<strong>Pack linguistique ajouté à la carte des membres:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_NEW'		=> '<strong>Nouvelle entrée de base de données ajoutée à la carte des membres:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_DELETED'	=> '<strong>Entrée de base de données pour la carte des membre supprimée:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_EDIT'		=> '<strong>Modification d´une entrée de base de données dans la carte utilisateur:</strong><br>» %s',
	'LOG_USERMAP_POI_NEW'			=> '<strong>Ajout d’un nouveau POI à la carte des membres:</strong><br>» %s',
	'LOG_USERMAP_POI_EDITED'		=> '<strong>Les valeurs d’un POI ont été modifiées:</strong><br>» %s',
	'LOG_USERMAP_GOOGLE_ERROR'		=> '<strong>L’API Google Maps a renvoyé le message d’erreur suivant lors de son exécution:</strong><br>» %s',
	'LOG_USERMAP_GEONAMES_ERROR'	=> '<strong>L’API Geonames a renvoyé le message d’erreur suivant lors de son exécution:</strong><br>» %s',
	'LOG_USERMAP_POI_DELETED'		=> '<strong>POI supprimé de la carte des membres:</strong><br>» %s',
	'LOG_USERMAP_POI_APPROVED'		=> '<strong>POI créé par un membre a été activé:</strong><br>» %s',
	'LOG_USERMAP_POI_MOD_DELETED'	=> '<strong>POI créé par un membre a été supprimé:</strong><br>» %s',
	// Profile
	'USERMAP_PROFILE_LINK'			=> '<strong>Afficher ce membre sur la carte d´utilisateur</strong>',
]);
