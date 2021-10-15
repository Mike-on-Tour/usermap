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
	'ACP_USERMAP'					=> 'Mapa del Usuario',
	'ACP_USERMAP_VERSION'			=> '<img src="https://img.shields.io/badge/Version-%1$s-green.svg?style=plastic" /><br>&copy; 2020 - %2$d by Mike-on-Tour',
	'SUPPORT_USERMAP'				=> 'Si quieres donar al desarrollo de Usermap, utiliza este enlace:<br>',
	// Settings tab
	'ACP_USERMAP_SETTINGS'			=> 'Opciones',
	'ACP_USERMAP_SETTINGS_EXPLAIN'	=> 'Aquí es donde personalizas tu Mapa del Usuario.',
	'ACP_USERMAP_SETTING_SAVED'		=> 'Configuración para el Mapa del Usuario guardada con éxito.',
	'ACP_USERMAP_GENERAL_SETTINGS'	=> 'Ajustes generales',
	'ACP_USERMAP_ROWS_PER_PAGE'		=> 'Filas por página de tabla',
	'ACP_USERMAP_ROWS_PER_PAGE_EXP'	=> 'Elige el número de filas que se mostrarán por página de tabla en las otras fichas.',
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
										Por lo tanto hay que registrarse en %1$s de forma obligatoria. El nombre de usuario registrado debe de ingresarse aquí.<br>
										Cada solicitud cuesta 1 crédito, con el servicio gratuito está limitado a un máximo de
										1,000 crédito por hora; si tienes un foro con más de 1,000 miembros se recomienda
										registrar un usuario por 1,000 a 1,500 miembros. De lo contrario, tus usuarios puede que vean un
										mensaje de error al ingresar sus datos de perfil (código postal y país).<br>
										Múltiples nombres de usuario deben estar separados por comas.<br>
										<strong>¡ATENCIÓN:</strong> debes habilitar (activar) el servicio deseado después del primer inicio de sesión
										en geonames.org usando el %2$senlace</span></a>!!',
	'ACP_USERMAP_GEONAMESUSER'		=> 'Nombre(s) de usuario(s) para geonames.org',
	'ACP_USERMAP_GEONAMESUSER_ERR'	=> '¡Es obligatorio proporcionar al menos un nombre de usuario válido para geonames.org!',
	'ACP_USERMAP_PROFILE_ERROR'		=> 'Esta acción no pudo concluirse con éxito ya que no se proporcionó un usuario de Geonames.org en la pestaña de configuración de Mapa del usuario. ¡Por favor hazlo inmediatamente!',
	'ACP_USERMAP_GOOGLE_TITLE'		=> 'Configuración para usar la API de Google Maps',
	'ACP_USERMAP_GOOGLE_TEXT'		=> 'geonames.org solo admite una lista limitada de países (ver lista %1$saquí</span></a>),
										si necesitas considerar países que no están en esta lista, es posible que desees utilizar adicionalmente el servicio de Google Maps.
										El uso del servicio Google Maps se puede habilitar aquí.<br>
										Si eliges utilizar el servicio Google Maps, necesitas obtener una clave API suscribiéndote en
										%2$sClave API de Google Maps</span></a>. Por favor sigue las instrucciones
										y presta atención a la activación de la ´API de geocodificación´.',
	'ACP_USERMAP_GOOGLE_ENABLE'		=> '¿Habilitar el uso de la API de Google Maps?',
	'ACP_USERMAP_GOOGLE_KEY'		=> 'Ingresa tu clave de API de Google Maps',
	'ACP_USERMAP_APIKEY_ERROR'		=> '¡Esta acción no se pudo concluir con éxito ya que no se proporcionó una clave API de Google Maps después de activar esta API. ¡Por favor proporciona una clave válida!',
	'ACP_USERMAP_GOOGLE_FORCE'		=> 'Código de países forzados a ser buscados con la API de Google Maps',
	'ACP_USERMAP_GOOGLE_FORCE_TXT'	=> 'geonames.org por razones de derechos de autor, considera solo algunos códigos postales para algunos países, lo que conlleva a
										coordenadas muy aproximadas. Para obtener una lista de esos países, consulta %1$seste</span></a>texto.<br>
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
	'ACP_USERMAP_POI_ENABLE_EXP'	=> 'Elegir ´Sí´ permite mostrar la superposición de puntos de interés con el mapa de usuario. También activa su elección para lo siguiente
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
	'ACP_USERMAP_DATABASE_NAME'		=> 'Nombre de la ubicación',
	'ACP_USERMAP_DATABASE_EDIT'		=> 'Editar elemento de la base de datos',
	'ACP_USERMAP_DATABASE_NOENTRY'	=> 'Datos no disponibles',
	'ACP_USERMAP_DATABASE_NEW'		=> 'Nueva entrada en la base de datos',
	'ACP_USERMAP_DATABASE_CC_EXP'	=> 'Ingresa el código de país con las dos letras mayúsculas del país al que se asignará esta entrada.',
	'ACP_USERMAP_DATABASE_ZC_EXP'	=> 'Por favor ingresa el código postal al que se asignará esta entrada, solo se permiten letras mayúsculas, dígitos y guión.',
	'ACP_USERMAP_DATABASE_NAME_EXP'	=> 'Puedes introducir un nombre para identificar y distinguir mejor esta ubicación.',
	'ACP_USERMAP_DATABASE_ERROR'	=> '¡El campo >%1$s< no debe de estar vacío!',
	'ACP_USERMAP_DATABASE_BIG_ERR'	=> '¡El campo no debe estar vacío!',
	'ACP_USERMAP_DATABASE_INVALID'	=> 'Esta combinación de código de país y código postal ya existe, ¡no debe usarse por segunda vez!<br>
										¡No se pudo guardar esta entrada en la base de datos interna!',
	// POI tab
	'ACP_USERMAP_POI'				=> 'Administración de PDI',
	'ACP_USERMAP_POI_EXPLAIN'		=> 'En esta tabla se enumeran todos los PDI ingresados hasta ahora en la base de datos.<br>
										Debajo de esta tabla puedes insertar una nueva entrada, además, aquí es donde puedes editar una entrada existente después de seleccionar
										el enlace de <i>Edit</i> en la última columna de cada línea en la tabla.<br>
										Al seleccionar el enlace de <i>Eliminar</i> puedes eliminar una entrada de la base de datos.',
	'ACP_USERMAP_POI_DATA'			=> 'Entradas de PDI actualmente disponibles',
	'ACP_USERMAP_POI_CREATOR'		=> 'Creador',
	'ACP_USERMAP_POI_VISIBLE'		=> 'PDI visible',
	'ACP_USERMAP_POI_VISIBLE_EXP'	=> 'Selecciona si este PDI debe ser visible en la superposición de mapa seleccionada.',
	'ACP_USERMAP_POI_NEW'			=> 'Ingrese un nuevo PDI',
	'ACP_USERMAP_POI_EDIT'			=> 'Editar PDI seleccionado',
	'ACP_USERMAP_POI_SUCCESS'		=> 'El PDI llamado „<strong>%1$s</strong>“ ha sido almacenado con éxito.',
	'ACP_USERMAP_POI_DELETE'		=> '¿Estás realmente seguro de que quieres borrar el PDI llamado „<strong>%1$s</strong>“ de la base de datos?<br>
										<strong>¡Esto elimina el PDI de forma permanente de la base de datos y no se puede deshacer!</strong>',
	'ACP_USERMAP_POI_DEL_SUCCESS'	=> 'El PDI llamado „<strong>%1$s</strong>“ ha sido eliminado de la base de datos.',
	'ACP_ERR_POI_NO_NAME'			=> 'El campo de entrada llamado „Nombre de PDI“ ¡no debe estar vacío!',
	'ACP_ERR_POI_NO_LAT'			=> 'El campo de entrada llamado „Latitud“ ¡no debe estar vacío!',
	'ACP_ERR_POI_NO_LNG'			=> 'El campo de entrada llamado „Longitud“ ¡no debe estar vacío!',
	// Layer tab
	'ACP_USERMAP_LAYER'				=> 'Superposición de mapas',
	'ACP_USERMAP_LAYER_EXPLAIN'		=> 'Todas las superposiciones cartográficas existentes figuran en este cuadro.<br>
										En la sección debajo de la tabla puede crear una nueva superposición de mapa o editar una existente haciendo clic en el enlace
										„Editar“ de la fila de la tabla correspondiente. A continuación, se mostrarán los datos actuales de la superposición de mapas seleccionada
										en esta sección.<br>
										Utilizando el enlace correspondiente de la tabla puede eliminar este elemento.',
	'ACP_USERMAP_LAYER_DATA'		=> 'Superposición de mapas existentes',
	'ACP_USERMAP_LAYER_NAME'		=> 'Nombre de la superposición',
	'ACP_USERMAP_LAYER_NAME_EXP'	=> 'Introduce un nombre para identificar esta superposición de mapas.',
	'ACP_USERMAP_MEMBER_LAYER'		=> 'Superposición de miembro',
	'ACP_USERMAP_MEMBER_LAYER_EXP'	=> 'Escoge „Sí“ para utilizar esta superposición de mapas para mostrar los marcadores de los miembros y „No“ para utilizarlo para mostrar los marcadores de PDI.<br>
										Las superposiciones de mapas para los miembros se muestran solo con el permiso para ver a los miembros, las superposiciones de mapas para los PDI se muestran
										si los PDI están activados y el permiso para ver los PDI es válido.',
	'ACP_USERMAP_LAYER_ACTIVE'		=> 'Activar superposición',
	'ACP_USERMAP_LAYER_ACTIVE_EXP'	=> 'Escoge „Sí“ para activar esta superposición de mapas y hacerla utilizable para poner PDIs en ella. Las superposiciones de mapas inactivas no son seleccionables
										al crear un nuevo PDI.',
	'ACP_USERMAP_SHOW_LAYER'		=> 'Mostrar permanentemente',
	'ACP_USERMAP_SHOW_LAYER_EXP'	=> 'Escoge „Sí“ para mostrar siempre este mapa superpuesto, empezando por llamar al Mapa de Usuario.<br>
										Si escoges que „No“ los usuarios deben seleccionar esta superposición de mapas a través del elemento de control de capas del mapa.',
	'ACP_USERMAP_LAYER_LANG_VAR'	=> 'variables de idiomas',
	'ACP_USERMAP_LAYER_LANG_VAR_EXP' => 'Para que tus usuarios puedan identificar las superposiciones de mapas con un término en su lengua materna, introduce aquí cada uno de los
										idiomas instalados en su foro, un término para identificar esta superposición en el elemento de control de la capa, ejemplo. „Campamentos“ como
										un término para identificar un mapa superpuesto que presenta los campamentos.<br>
										Asegúrate de utilizar una etiqueta de idioma válida (revisa la tabla de paquetes de idiomas de tu ACP „ISO“ en la sección „Personalizar“)
										seguido de dos puntos y el término de idioma deseado para asegurarse de que el sistema puede utilizar tu entrada.<br>
										<strong>%1$sEjemplo:</span></strong> „es:Campamentos“<br>
										¡Cada combinación de etiqueta lingüística y término lingüístico DEBE utilizar su propia línea!<br>
										<strong>%1$s¡ATENCIÓN: Una línea con la etiqueta de idioma „es“ es OBLIGATORIA!</span></strong>',
	'ACP_USERMAP_LAYER_DEFAULTICON'	=> 'Icono por defecto',
	'ACP_USERMAP_LAYER_ICON_EXP'	=> 'Selecciona el archivo de iconos que se utilizará por defecto en esta superposición de mapas. Esta selección se presentará para todos los PDI
										creado en esta superposición.',
	'ACP_USERMAP_LAYER_NEW'			=> 'Crear una nueva superposición de mapas',
	'ACP_USERMAP_LAYER_EDIT'		=> 'Editar una superposición de mapa existente',
	'ACP_USERMAP_LAYER_SUCCESS'		=> 'La superposición de mapas llamada „<strong>%1$s</strong>“ ha sido almacenada con éxito.',
	'ACP_USERMAP_LAYER_DELETE'		=> '¿Estás realmente seguro de que quieres eliminar el mapa superpuesto llamado „<strong>%1$s</strong>“ de la base de datos?<br>
										¡Todos los PDI asignados a esta superposición de mapas dejarán de mostrarse!<br>
										<strong>¡Esto elimina la superposición del mapa de forma permanente de la base de datos y no se puede deshacer!</strong>',
	'ACP_USERMAP_LAYER_DEL_SUCCESS'	=> 'El mapa superpuesto llamado „<strong>%1$s</strong>“ ha sido eliminado de la base de datos.',
	'ACP_ERR_LAYER_NO_NAME'			=> 'El campo de entrada llamado „Nombre de la superposición“ ¡no debe estar vacío!',
	'ACP_ERR_LAYER_NO_LANG'			=> 'El campo de entrada llamado „variables de idiomas“ ¡no debe estar vacío!',
	'ACP_ERR_LAYER_INCORRECT'		=> 'Esta variable de idioma no se ajusta a las normas: ',
	'ACP_ERR_LAYER_NO_EN'			=> 'Variable de idioma „es“ ¡no se encuentra!',
	// Logs
	'LOG_USERMAP_LAYER_NEW'			=> '<strong>Se ha añadido una nueva superposición de mapas al mapa de usuario:</strong><br>» %s',
	'LOG_USERMAP_LAYER_EDITED'		=> '<strong>Editado un mapa superpuesto:</strong><br>» %s',
	'LOG_USERMAP_LAYER_DELETED'		=> '<strong>Se ha eliminado un mapa superpuesto del mapa de usuario:</strong><br>» %s'
]);
