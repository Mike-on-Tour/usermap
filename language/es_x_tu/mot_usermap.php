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
	'USERMAP'						=> 'Mapa del Usuario',
	'USERMAP_NOT_AUTHORIZED'		=> 'No estás autorizado para ver el Mapa del Usuario.',
	'USERMAP_SEARCHFORM'			=> 'Formulario de búsqueda',
	'USERMAP_LEGEND'				=> 'Leyenda',
	'USERMAP_CREDENTIALS'			=> 'Las georeferencias usadas por Mapa del Usuario son cortesía de ',
	'USERMAP_LEGEND_TEXT'			=> 'Haz zoom utilizando los botones de enfoque.',
	'MAP_USERS'						=> [
		0	=> 'Actualmente no hay ningún miembro mostrado en el mapa.',
		1	=> 'Actualmente hay %1$d miembro mostrado en el mapa.',
		2	=> 'Actualmente hay %1$d miembros mostrados en el mapa.',
	],
	'POI_COUNT'						=> [
		0	=> 'Actualmente no se muestra ningún PDI en el mapa.',
		1	=> 'Actualmente hay %1$d PDI mostrado en el mapa.',
		2	=> 'Actualmente hay %1$d PDIs mostrados en el mapa.',
	],
	// Search tabs
	'TAB_RADIUS_SEARCH'				=> 'Buscar en los alrededores del código postal',
	'TAB_MEMBER_SEARCH'				=> 'Buscar miembros',
	'TAB_POI_SEARCH'				=> 'Buscar PDI',
	'TAB_ADDRESS_SEARCH'			=> 'Búsqueda de Google Maps',
	'MAP_SEARCH'					=> 'Buscar miembros en el código postal %1$s en un rango de ',
	'MAP_RESULT'					=> 'Muestra el siguiente resultado: ',
	'MAP_NORESULT'					=> 'No se encontraron miembros dentro del rango de ',
	'MAP_KM'						=> 'km',
	'MEMBERNAME_SEARCH'				=> 'Introduce el nombre de usuario del socio (comodín * disponible)',
	'MEMBERNAME_RESULT'				=> 'Se encontraron los siguientes miembros:',
	'MEMBERNAME_NORESULT'			=> 'No hay miembros con un nombre de usuario que coincida con tu solicitud.',
	'POINAME_SEARCH'				=> 'Introduce el nombre del punto de interés (comodín * disponible)',
	'POINAME_RESULT'				=> 'Se encontraron los siguientes PDI:',
	'POINAME_NORESULT'				=> 'No hay PDI con un nombre que coincida con tu solicitud.',
	'ADDRESS_SEARCH'				=> 'Introduce el término de búsqueda (por ejemplo, una dirección) para el que deseas encontrar las coordenadas (por ejemplo, para crear un PDI)',
	'ADDRESS_RESULT'				=> 'Se ha encontrado el término de búsqueda y se muestra con un marcador en el mapa.',
	'ADDRESS_NORESULT'				=> 'No se pueden recuperar las coordenadas que coinciden con el término de búsqueda dado.',
	// Legend
	'POI_LEGEND_TITLE'				=> 'Leyenda para los Puntos de Interés',
	'STREET_DESC'					=> 'Mapa de la calle',
	'TOPO_DESC'						=> 'Mapa topográfico',
	'SAT_DESC'						=> 'Imagen de satélite',
	// Permission overview
	'USERMAP_PERM_OVERVIEW'			=> 'Permisos en esta página',
	'USERMAP_PERM_VIEW_ALWAYS'		=> 'Tú <strong>puedes</strong> ver siempre a los miembros.<br>',
	'USERMAP_PERM_VIEW_SUBSCRIBED'	=> 'Tú <strong>puedes</strong> solo ver a los miembros si están registrados en el mapa de usuarios.<br>',
	'USERMAP_NO_VIEW_SUBSCRIBED'	=> 'Tú <strong>no puedes</strong> ver a los miembros.<br>',
	'USERMAP_PERM_VIEW_POI'			=> 'Tú <strong>puedes</strong> ver PDI.<br>',
	'USERMAP_NO_VIEW_POI'			=> 'Tú <strong>no puedes</strong> ver PDI.<br>',
	'USERMAP_NO_ADD_POI'			=> 'Tú <strong>no puedes</strong> crear PDI.<br>',
	'USERMAP_PERM_ADD_POI'			=> 'Tú <strong>puedes</strong> crear PDI sin la aprobación del moderador.<br>',
	'USERMAP_PERM_ADD_POI_MOD'		=> 'Tú <strong>puedes</strong> crear PDI con la aprobación del moderador.<br>',
	// Error messages
	'USERMAP_GN_USER_ERROR'			=> ': ¡El usuario de Geonames no existe o no está activado para este servicio.',
	// User POI popup
	'POI_INPUT_EXPL'				=> 'En este formulario puedes crear un nuevo PDI. Tus coordenadas se adoptarán a partir del marcador que aparece en el mapa a la izquierda de este formulario.
										Este marcador es arrastrable, puede moverlo con el ratón hasta su destino final. Su nombre, descripción y
										el icono con el que se representará el marcador posteriormente puede introducirse o seleccionarse en los siguientes campos del formulario.',
	'POI_NEW_SAVED'					=> 'El PDI creado se ha guardado correctamente en la base de datos y se mostrará en el mapa.',
	'POI_MOD_NOTIFIED'				=> 'El PDI creado se ha guardado con éxito en la base de datos, los moderadores han sido notificados a la espera de su aprobación.',
	'ACP_USERMAP_POI_NAME'			=> 'Nombre de PDI',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'El nombre de este PDI se muestra como una burbuja de información sobre herramientas cuando el puntero del mouse se mueve sobre el marcador de PDI.',
	'ACP_USERMAP_POI_POPUP'			=> 'Descripción de PDI',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'La descripción de este PDI puede usar hasta 500 caracteres y puede contener BBCode.<br>
										Este texto se muestra en una burbuja emergente cuando se hace clic en el marcador de PDI con el puntero del mouse.',
	'ACP_USERMAP_POI_ICON'			=> 'Archivo de icono',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'Para facilitar una categorización básica de tus PDI, puedes seleccionar entre los iconos de marcadores con diferentes colores.',
	'ACP_USERMAP_POI_SIZE'			=> 'Tamaño del icono',
	'ACP_USERMAP_POI_SIZE_EXP'		=> 'El tamaño del icono en píxeles según la notación ´ancho´, ´alto´.<br>
										El valor inicial es el tamaño por defecto dado en la pestaña "Configuración".',
	'ACP_USERMAP_POI_ANCHOR'		=> 'Icono de anclaje',
	'ACP_USERMAP_POI_ANCHOR_EXP'	=> 'El icono de anclaje en píxeles comenzando en la esquina superior izquierda en la notación ´valor horizontal´, ´valor vertical´.<br>
										El valor inicial es el valor por defecto que se da en la pestaña "Configuración".',
	'ACP_USERMAP_DATABASE_LAT'		=> 'Latitud',
	'ACP_USERMAP_DATABASE_LNG'		=> 'Longitud',
	'ACP_USERMAP_POI_LAYER'			=> 'Superposición del mapa',
	'ACP_USERMAP_POI_LAYER_EXP'		=> 'Selecciona la superposición del mapa en la que se mostrará este PDI.',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'Los cambios en la base de datos interna han sido guardados con éxito.',
	'ACP_USERMAP_CONFIRM_DELETE'	=> '¿Estás realmente seguro de que desea eliminar este elemento de la base de datos?<br>
										<strong>¡Esto elimina el elemento permanentemente de la base de datos y no se puede deshacer!</strong>',
	'USERMAP_POI_NAME_ERROR'		=> '¡El campo >%1$s< no debe de estar vacío!',
	// Notifications
	'NOTIFICATION_USERMAP_MOD'		=> 'Notificaciones de moderación para el Mapa de Usuario',
	'USERMAP_SETTING_APPROVE'		=> 'Un PDI de reciente creación está a la espera de ser aprobado',
	'USERMAP_SETTING_NOTIFY'		=> 'Alguien ha añadido un nuevo PDI al Mapa de usuario',
	'USERMAP_NOTIFY_POI_APPROVE'	=> '<strong>Un nuevo PDI espera ser aprobado</strong><br>Un nuevo PDI llamado „<strong>%1$s</strong>“ fue creado por el usuario „%2$s“ y está a la espera de su aprobación.',
	'USERMAP_NOTIFY_POI'			=> '<strong>PDI añadido</strong><br>El usuario „%2$s“ ha añadido un nuevo PDI llamado „<strong>%1$s</strong>“ al mapa de usuario.',
	// Moderation
	'POI_MOD_EXPL'					=> 'Aquí puedes comprobar los datos de un nuevo PDI creado por el usuario y editarlo si lo consideras necesario o deseas hacerlo por
										otra razón. Puedes posicionar el marcador arrastrándolo con el ratón. Después de terminar este proceso puedes
										guardar el PDI (y aprobarlo) o eliminarlo si no se ajusta a la política del foro.',
	'USERMAP_MOD_NOT_AUTHORIZED'	=> '<strong>¡No estás autorizado a iniciar esta actividad!</strong>',
	'POI_NONEXISTENT'				=> 'El PDI no existe',
	'POI_ALREADY_APPROVED'			=> '¡Este PDI ya ha sido aprobado!',
	'APPROVE'						=> 'Aprobar',
	'DONE'							=> 'Listo',
	'POI_APPROVED'					=> 'PDI aprobado con éxito.',
	'ACTION_CONCLUDED'				=> 'Actividad concluida.',
	'CHANGES_SUCCESSFUL'			=> 'Posibles cambios guardados con éxito.',
	'BACK_TO_USERMAP'				=> 'Al mapa de usuario',
	// UCP
	'MOT_ZIP'						=> 'Código Postal',
	'MOT_ZIP_EXP'					=> 'Por favor, ingresa el código postal de tu ubicación para ser listado en el Mapa del Usuario.<br>(Solo mayúsculas, números y guiones)',
	'MOT_LAND'						=> 'País',
	'MOT_LAND_EXP'					=> 'Por favor, selecciona el país dondes vives para ser listado en el Mapa del Usuario.',
	'MOT_UCP_GEONAMES_ERROR'		=> '¡El administrador no proporcionó un usuario de Geonames.org, por lo tanto, no se pudieron recuperar los datos del mapa de usuario!',
	// Log entries
	'LOG_USERMAP_SETTING_UPDATED'	=> '<strong>Opciones de Mapa de Usuario cambiadas</strong>',
	'LOG_POI_LEGEND_UPDATED'		=> '<strong>Se ha cambiado la leyenda del PDI</strong>',
	'LOG_USERMAP_INSTALL_LANG'		=> '<strong>Se ha añadido un paquete de idiomas al mapa de usuario:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_NEW'		=> '<strong>Se ha añadido una nueva entrada en la base de datos del mapa de usuarios:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_DELETED'	=> '<strong>Se ha eliminado una entrada en la base de datos del mapa de usuarios:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_EDIT'		=> '<strong>Se ha editado una entrada en la base de datos del mapa de usuarios:</strong><br>» %s',
	'LOG_USERMAP_POI_NEW'			=> '<strong>Se ha añadido un nuevo PDI al mapa de usuario:</strong><br>» %s',
	'LOG_USERMAP_POI_EDITED'		=> '<strong>Datos de PDI modificados:</strong><br>» %s',
	'LOG_USERMAP_GOOGLE_ERROR'		=> '<strong>La API de Google Maps falló durante la ejecución con el siguiente mensaje de error:</strong><br>» %s',
	'LOG_USERMAP_GEONAMES_ERROR'	=> '<strong>La API de Geonames falló durante la ejecución con el siguiente mensaje de error:</strong><br>» %s',
	'LOG_USERMAP_POI_DELETED'		=> '<strong>Se ha eliminado un PDI del mapa de usuario:</strong><br>» %s',
	'LOG_USERMAP_POI_APPROVED'		=> '<strong>PDI creado por el usuario aprobado:</strong><br>» %s',
	'LOG_USERMAP_POI_MOD_DELETED'	=> '<strong>PDI creado por el usuario eliminado:</strong><br>» %s',
	// Profile
	'USERMAP_PROFILE_LINK'			=> '<strong>Mostrar este miembro en el mapa de usuario</strong>',
]);
