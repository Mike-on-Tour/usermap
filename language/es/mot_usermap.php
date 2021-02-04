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
	'USERMAP'						=> 'Mapa del Usuario',
	'USERMAP_NOT_AUTHORIZED'		=> 'No estás autorizado para ver el Mapa del Usuario.',
	'USERMAP_SEARCHFORM'			=> 'Formulario de búsqueda',
	'USERMAP_LEGEND'				=> 'Leyenda',
	'USERMAP_CREDENTIALS'			=> 'Las georeferencias usadas por Mapa del Usuario son cortesía de ',
	'USERMAP_LEGEND_TEXT'			=> 'Haz zoom utilizando los botones de enfoque.',
	'MAP_USERS'						=> array(
		1	=> 'Actualmente hay %1$s miembro mostrado en el mapa.',
		2	=> 'Actualmente hay %1$s miembros mostrados en el mapa.',
	),
	'MAP_SEARCH'					=> 'Buscar miembros en el código postal %1$s en un rango de ',
	'MAP_RESULT'					=> 'muestra el siguiente resultado: ',
	'MAP_NORESULT'					=> 'No se encontraron miembros dentro del rango de ',
	'POI_LEGEND_TITLE'				=> 'Leyenda para los Puntos de Interés',
	'STREET_DESC'					=> 'Mapa de la calle',
	'TOPO_DESC'						=> 'Mapa topográfico',
	'SAT_DESC'						=> 'Imagen de satélite',
	'USER_DESC'						=> 'Usuarios',
	'POI_DESC'						=> 'Puntos de Interés',
	// User POI popup
	'POI_INPUT_EXPL'				=> 'En este formulario puedes crear un nuevo PDI. Tus coordenadas se adoptarán a partir del marcador que aparece en el mapa a la izquierda de este formulario.
										Este marcador es arrastrable, puede moverlo con el ratón hasta su destino final. Su nombre, descripción y
										el icono con el que se representará el marcador posteriormente puede introducirse o seleccionarse en los siguientes campos del formulario.',
	'POI_NEW_SAVED'					=> 'El PDI creado se ha guardado correctamente en la base de datos y se mostrará en el mapa.',
	'POI_MOD_NOTIFIED'				=> 'El PDI creado se ha guardado con éxito en la base de datos, los moderadores han sido notificados a la espera de su aprobación.',
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
	// ACP
	'ACP_USERMAP'					=> 'Mapa del Usuario',
	'SUPPORT_USERMAP'				=> 'Si quieres donar al desarrollo de Usermap, utiliza este enlace:<br>',
	// Settings tab
	'ACP_USERMAP_SETTINGS'			=> 'Opciones',
	'ACP_USERMAP_SETTINGS_EXPLAIN'	=> 'Aquí es donde personalizas tu Mapa del Usuario.',
	'ACP_USERMAP_SETTING_SAVED'		=> 'Configuración para el Mapa del Usuario guardada con éxito.',
	'ACP_USERMAP_MAPSETTING_TITLE'	=> 'Configuraciones del mapa',
	'ACP_USERMAP_MAPSETTING_TEXT'	=> 'Centro y enfoque al inicio del Mapa del Usuario.',
	'ACP_USERMAP_LAT'				=> 'Latitud del centro del mapa',
	'ACP_USERMAP_LAT_EXP'			=> 'Valores entre 90.0 (Polo Norte) y -90.0 (Polo Sur)',
	'ACP_USERMAP_LON'				=> 'Longitud del centro del mapa',
	'ACP_USERMAP_LON_EXP'			=> 'Valores entre 180.0 (Este) y -180.0 (Oeste)',
	'ACP_USERMAP_ZOOM'				=> 'Zoom inicial del Mapa del Usuario',
	'ACP_USERMAP_MARKERS_TEXT'		=> 'Aquí se puede seleccionar el tamaño de los marcadores que indican las posiciones de los usuarios en el mapa de forma independiente para la visualización en
										pantallas de computadoras (de escritorio, portátiles, notebook, netbook, tablet) así como en dispositivos móviles (teléfonos celulares).<br>
										El tamaño es ingresado como el radio del círculo usado como marcador, la unidad de medida son los píxeles.',
	'ACP_USERMAP_MARKERS_PC'		=> 'El radio del círculo en las pantallas de los ordenadores',
	'ACP_USERMAP_MARKERS_MOB'		=> 'El radio del círculo en la pantalla de los dispositivos móviles',
	'ACP_USERMAP_GEONAMES_TITLE'	=> 'Nombre de usuario para geonames.org',
	'ACP_USERMAP_GEONAMES_TEXT'		=> 'Mapa del Usuario se basa en los servicios de geonames.org para obtener las coordenadas geográficas de la ubicación del miembro identificado por el código postal y el país, además de la ubicación proporcionada en el perfil del miembro.
										Por lo tanto hay que registrarse en
										<a href="https://www.geonames.org/login" target="_blank">
										<span style="text-decoration: underline;">geonames.org/login</span></a>
										de forma obligatoria. El nombre de usuario registrado debe de ingresarse aquí.<br>
										Cada solicitud cuesta 1 crédito, con el servicio gratuito está limitado a un máximo de
										1,000 crédito por hora; si tienes un foro con más de 1,000 miembros se recomienda
										registrar un usuario por 1,000 a 1,500 miembros. De lo contrario, tus usuarios puede que vean un
										mensaje de error al ingresar sus datos de perfil (código postal y país).<br>
										Múltiples nombres de usuario deben estar separados por comas.<br>
										<strong>¡ATENCIÓN:</strong> debes habilitar (activar) el servicio deseado después del primer inicio de sesión
										en geonames.org usando el
										<a href="https://www.geonames.org/manageaccount" target="_blank">
										<span style="text-decoration: underline;">enlace</span></a>!!',
	'ACP_USERMAP_GEONAMESUSER'		=> 'Nombre(s) de usuario(s) para geonames.org',
	'ACP_USERMAP_GEONAMESUSER_ERR'	=> '¡Es obligatorio proporcionar al menos un nombre de usuario válido para geonames.org!',
	'ACP_USERMAP_PROFILE_ERROR'		=> 'Esta acción no pudo concluirse con éxito ya que no se proporcionó un usuario de Geonames.org en la pestaña de configuración de Mapa del usuario. ¡Por favor hazlo inmediatamente!',
	'ACP_USERMAP_GOOGLE_TITLE'		=> 'Configuración para usar la API de Google Maps',
	'ACP_USERMAP_GOOGLE_TEXT'		=> 'geonames.org solo admite una lista limitada de países (ver lista
										<a href="https://www.geonames.org/postal-codes/" target="_blank">
										<span style="text-decoration: underline;">aquí</span></a>),
										si necesitas considerar países que no están en esta lista, es posible que desees utilizar adicionalmente el servicio de Google Maps.
										El uso del servicio Google Maps se puede habilitar aquí.<br>
										Si eliges utilizar el servicio Google Maps, necesitas obtener una clave API suscribiéndote en
										<a href="https://developers.google.com/maps/documentation/embed/get-api-key" target="_blank">
										<span style="text-decoration: underline;">Clave API de Google Maps</span></a>. Por favor sigue las instrucciones
										y presta atención a la activación de la ´API de geocodificación´.',
	'ACP_USERMAP_GOOGLE_ENABLE'		=> '¿Habilitar el uso de la API de Google Maps?',
	'ACP_USERMAP_GOOGLE_KEY'		=> 'Ingresa tu clave de API de Google Maps',
	'ACP_USERMAP_APIKEY_ERROR'		=> '¡Esta acción no se pudo concluir con éxito ya que no se proporcionó una clave API de Google Maps después de activar esta API. ¡Por favor proporciona una clave válida!',
	'ACP_USERMAP_GOOGLE_FORCE'		=> 'Código de países forzados a ser buscados con la API de Google Maps',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'	=> 'geonames.org por razones de derechos de autor, considera solo algunos códigos postales para algunos países, lo que conlleva a
										coordenadas muy aproximadas. Para obtener una lista de esos países, consulta
										<a href="http://download.geonames.org/export/zip/readme.txt" target="_blank">
										<span style="text-decoration: underline;">este</span></a>texto.<br>
										La API de Google Maps debería proporcionar resultados más detallados para esos países. Si deseas hacer cumplir la búsqueda
										usando la API de Google Maps en lugar de geonames.org, ingresa las dos letras del país del código que deseas, seperadas
										por comas.',
	'ACP_USERMAP_DATABASE_TITLE'	=> 'Usando la base de datos interna',
	'ACP_USERMAP_DATABASE_TEXT'		=> 'Incluso Google Maps puede no proporcionar una solución válida para algunos países (por ejemplo Israel). En este caso puedes usar una
										base de datos interna para la cual debe proporcionar los datos, por favor elige la pestaña ´Base de datos interna´ para obtener más información.<br>
										Es posible que desees utilizarlo de esta manera para los usuarios que viven en un país no compatible con geonames.org si no deseas utilizar
										la API de Google Maps.',
	'ACP_USERMAP_DATABASE_ENABLE'	=> '¿Habilitar el uso de la base de datos interna?',
	'ACP_USERMAP_POI_TITLE'			=> 'Mostrar puntos de interés (PDI)',
	'ACP_USERMAP_POI_TEXT'			=> 'Además de mostrar ubicaciones de miembros, El mapa del usuario es capaz de mostrar una superposición adicional con ubicaciones que podrían
										ser de particular interés para tus miembros, por ejemplo, lugares de reunión y hoteles para ciclistas o arenas deportivas.
										Puedes elegir la configuración de esta superposición en esta sección.<br>
										La siguiente sección le permite escribir y editar una descripción que define el significado de sus diferentes categorías de PDI,
										que se mostrará debajo del mapa como una leyenda.<br>
										El ingreso y edición de los PDI es tarea de los administradores, todos los elementos necesarios para hacer esto están accesibles a través
										de la pestaña ´Administración de PDI´.',
	'ACP_USERMAP_POI_ENABLE'		=> '¿Habilitar visualización de PDI?',
	'ACP_USERMAP_POI_ENABLE_EXP'	=> 'Elegir "Sí" permite mostrar la superposición de puntos de interés con el mapa de usuario. También activa su elección para lo siguiente
										ajuste y la visualización de la leyenda que puede escribir y editar en la sección de abajo.',
	'ACP_USERMAP_ICON_TITLE'		=> 'Valores por defecto de los iconos de PDI',
	'ACP_USERMAP_ICON_TEXT'			=> 'Aquí puedes cambiar los valores por defecto de los iconos de PDI en cuanto a tamaño y anclaje. Los valores de los iconos están preseleccionados
										a los que trae el Mapa de Usuario. Si deseas utilizar tus propios iconos, puedes en su lugar introducir aquí tus valores por defecto.<br>
										Consulta el archivo ´ICONS.md´ que se encuentra en el directorio ´docs´ para mayor información.',
	'ACP_USERMAP_ICONSIZE_EXP'		=> 'El tamaño del icono en píxeles según la notación ´ancho´, ´alto´.',
	'ACP_USERMAP_ICONANCHOR_EXP'	=> 'El icono de anclaje en píxeles comenzando en la esquina superior izquierda en la notación ´valor horizontal´, ´valor vertical´.',
	'ACP_USERMAP_POI_LEGEND'		=> 'Leyenda de PDI',
	'ACP_USERMAP_POI_LGND'			=> 'Escribir y editar la leyenda de PDI',
	'ACP_USERMAP_POI_LGND_EXP'		=> 'El texto que ingreses aquí no debe exceder los 1,000 caracteres, incluidos todos los códigos BBCode y se mostrará debajo del
										Mapa de usuarios como leyenda si la visualización de PDI está habilitada.<br>
										Escribir y editar es independiente de todas las demás configuraciones en esta pestaña.',
	// Language packs tab
	'ACP_USERMAP_LANGS'				=> 'Paquetes de idiomas',
	'ACP_USERMAP_LANGS_EXPLAIN'		=> 'Aquí es donde puedes instalar los paquetes de idiomas adicionales para el Mapa del Usuario. Esto puede ser necesario después de agregar
										paquetes de idiomas para el Mapa del Usuario después de su primera activación porque los datos no han sido
										incorporados en la lista desplegable para seleccionar el país; esto puedes hacerlo aquí después de cargar el paquete de idioma
										con un programa ftp en el subdirectorio <i>language</i>  de esta extensión.',
	'ACP_USERMAP_INSTALLABLE_LANG'	=> 'Paquetes de idiomas listos para la instalación',
	'ACP_USERMAP_INSTALL_LANG_EXP'	=> 'Paquetes de idioma de Mapa del Usuario esperando para instalarse.',
	'ACP_USERMAP_MISSING_LANG'		=> 'Paquetes de idiomas faltantes',
	'ACP_USERMAP_MISSING_LANG_EXP'	=> 'Idiomas instalados dentro del foro pero que faltan en la extensión de Mapa del Usuario.',
	'ACP_USERMAP_ADDITIONAL_LANG'	=> 'Paquetes de idiomas adicionales para Mapa del Usuario',
	'ACP_USERMAP_ADD_LANG_EXP'		=> 'Paquetes de idiomas de la extensión para los que no existe ningún idioma dentro de este foro.',
	'ACP_USERMAP_LANGPACK_NAME'		=> 'Nombre',
	'ACP_USERMAP_LANGPACK_LOCAL'	=> 'Nombre local',
	'ACP_USERMAP_LANGPACK_ISO'		=> 'ISO',
	'ACP_USERMAP_NO_ENTRIES'		=> 'No se han encontrado paquetes de idiomas',
	// Internal database tab
	'ACP_USERMAP_DATABASE'			=> 'Base de datos interna',
	'ACP_USERMAP_DATABASE_EXPLAIN'	=> 'Esta tabla contiene todos los datos disponibles de la base de datos interna. En la columna de la derecha encontrarás un enlace a
										para eliminar la línea respectiva.<br>
										Debajo de esta tabla puede agregar nuevos datos.',
	'ACP_USERMAP_DATABASE_DATA'		=> 'Datos disponibles actualmente',
	'ACP_USERMAP_DATABASE_CC'		=> 'Código ISO del país',
	'ACP_USERMAP_DATABASE_ZIPCODE'	=> 'Código Postal',
	'ACP_USERMAP_DATABASE_LAT'		=> 'Latitud',
	'ACP_USERMAP_DATABASE_LNG'		=> 'Longitud',
	'ACP_USERMAP_DATABASE_EDIT'		=> 'Editar',
	'ACP_USERMAP_DATABASE_NOENTRY'	=> 'Datos no disponibles',
	'ACP_USERMAP_DATABASE_NEW'		=> 'Nueva entrada en la base de datos',
	'ACP_USERMAP_DATABASE_CC_EXP'	=> 'Ingresa el código de país con las dos letras mayúsculas del país al que se asignará esta entrada.',
	'ACP_USERMAP_DATABASE_ZC_EXP'	=> 'Por favor ingresa el código postal al que se asignará esta entrada, solo se permiten letras mayúsculas, dígitos y guión.',
	'ACP_USERMAP_DATABASE_ERROR'	=> '¡El campo >%1$s< no debe de estar vacío!',
	'ACP_USERMAP_DATABASE_BIG_ERR'	=> '¡El campo no debe estar vacío!',
	'ACP_USERMAP_DATABASE_SUCCESS'	=> 'Los cambios en la base de datos interna han sido guardados con éxito.',
	'ACP_USERMAP_DATABASE_INVALID'	=> 'Esta combinación de código de país y código postal ya existe, ¡no debe usarse por segunda vez!<br>
										¡No se pudo guardar esta entrada en la base de datos interna!',
	'ACP_USERMAP_CONFIRM_DELETE'	=> '¿Estás realmente seguro de que desea eliminar este elemento de la base de datos?<br>
										<strong>¡Esto elimina el elemento permanentemente de la base de datos y no se puede deshacer!</strong>',
	// POI tab
	'ACP_USERMAP_POI'				=> 'Administración de PDI',
	'ACP_USERMAP_POI_EXPLAIN'		=> 'En esta tabla se enumeran todos los PDI ingresados hasta ahora en la base de datos.<br>
										Debajo de esta tabla puedes insertar una nueva entrada, además, aquí es donde puedes editar una entrada existente después de seleccionar
										el enlace de <i>Edit</i> en la última columna de cada línea en la tabla.<br>
										Al seleccionar el enlace de <i>Eliminar</i> puedes eliminar una entrada de la base de datos.',
	'ACP_USERMAP_POI_DATA'			=> 'Entradas de PDI actualmente disponibles',
	'ACP_USERMAP_POI_NAME'			=> 'Nombre de PDI',
	'ACP_USERMAP_POI_POPUP'			=> 'Descripción de PDI',
	'ACP_USERMAP_POI_ICON'			=> 'Archivo de icono',
	'ACP_USERMAP_POI_SIZE'			=> 'Tamaño del icono',
	'ACP_USERMAP_POI_ANCHOR'		=> 'Icono de anclaje',
	'ACP_USERMAP_POI_NEW'			=> 'Ingrese un nuevo PDI',
	'ACP_USERMAP_POI_EDIT'			=> 'Editar PDI seleccionado',
	'ACP_USERMAP_POI_NAME_EXP'		=> 'El nombre de este PDI se muestra como una burbuja de información sobre herramientas cuando el puntero del mouse se mueve sobre el marcador de PDI.',
	'ACP_USERMAP_POI_POPUP_EXP'		=> 'La descripción de este PDI puede usar hasta 500 caracteres y puede contener BBCode.<br>
										Este texto se muestra en una burbuja emergente cuando se hace clic en el marcador de PDI con el puntero del mouse.',
	'ACP_USERMAP_POI_ICON_EXP'		=> 'Para facilitar una categorización básica de tus PDI, puedes seleccionar entre los iconos de marcadores con diferentes colores.',
	'ACP_USERMAP_POI_SIZE_EXP'		=> 'El tamaño del icono en píxeles según la notación ´ancho´, ´alto´.<br>
										El valor inicial es el tamaño por defecto dado en la pestaña "Configuración".',
	'ACP_USERMAP_POI_ANCHOR_EXP'	=> 'El icono de anclaje en píxeles comenzando en la esquina superior izquierda en la notación ´valor horizontal´, ´valor vertical´.<br>
										El valor inicial es el valor por defecto que se da en la pestaña "Configuración".',
	// UCP
	'MOT_ZIP'						=> 'Código Postal',
	'MOT_ZIP_EXP'					=> 'Por favor ingresa el código postal de tu ubicación para ser listado en el Mapa del Usuario.<br>(Solo mayúsculas, números y guiones)',
	'MOT_LAND'						=> 'País',
	'MOT_LAND_EXP'					=> 'Por favor selecciona el país dondes vives para ser listado en el Mapa del Usuario.',
	'MOT_UCP_GEONAMES_ERROR'		=> '¡El administrador no proporcionó un usuario de Geonames.org, por lo tanto, no se pudieron recuperar los datos del mapa de usuario!',
	// Log entries
	'LOG_USERMAP_GOOGLE_ERROR'		=> '<strong>La API de Google Maps falló durante la ejecución con el siguiente mensaje de error:</strong><br>» %s',
	'LOG_USERMAP_GEONAMES_ERROR'	=> '<strong>La API de Geonames falló durante la ejecución con el siguiente mensaje de error:</strong><br>» %s',
	'LOG_USERMAP_SETTING_UPDATED'	=> '<strong>Opciones de Mapa de Usuario cambiadas</strong>',
	'LOG_POI_LEGEND_UPDATED'		=> '<strong>Se ha cambiado la leyenda del PDI</strong>',
	'LOG_USERMAP_ZIPCODE_NEW'		=> '<strong>Se ha añadido una nueva entrada en la base de datos del mapa de usuarios:</strong><br>» %s',
	'LOG_USERMAP_ZIPCODE_DELETED'	=> '<strong>Se ha eliminado una entrada en la base de datos del mapa de usuarios:</strong><br>» %s',
	'LOG_USERMAP_INSTALL_LANG'		=> '<strong>Se ha añadido un paquete de idiomas al mapa de usuario:</strong><br>» %s',
	'LOG_USERMAP_POI_NEW'			=> '<strong>Se ha añadido un nuevo PDI al mapa de usuario:</strong><br>» %s',
	'LOG_USERMAP_POI_EDITED'		=> '<strong>Datos de PDI modificados:</strong><br>» %s',
	'LOG_USERMAP_POI_DELETED'		=> '<strong>Se ha eliminado un PDI del mapa de usuario:</strong><br>» %s',
	'LOG_USERMAP_POI_APPROVED'		=> '<strong>PDI creado por el usuario aprobado:</strong><br>» %s',
	'LOG_USERMAP_POI_MOD_DELETED'	=> '<strong>PDI creado por el usuario eliminado:</strong><br>» %s',
));
