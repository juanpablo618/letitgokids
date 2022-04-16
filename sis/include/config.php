<?php
/**
 * Archivo de configuración principal del sistema
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.2:25-08-2015
 */

/**
 * Reporte de errores
 */
//error_reporting(E_ALL|E_STRICT);
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//error_reporting(0);

/**#@+
 * Configuración de la base de datos
 */
/**
 * Motor de base de datos
 */
define('DB_TYPE', 'mysqli');
/**
 * Host
 */
define('DB_HOST', 'localhost');
/**
 * Usuario
 */
define('DB_NAME', 'letitgok_juancuello');

/**
 * Contraseña
 */
define('DB_PASS', 'Bas61814319');

/**
 * Nombre de la base de datos
 */
define('DB_DBASE', 'letitgok_desmadre_sistema');
/**
 * Modo debug
 */
define('DB_DEBUG', FALSE);
/**#@-*/

/**
 * Juego de caracteres de la base de datos y de los documentos
 *
 * Ejemplo: UTF-8, ISO-8859-1, etc.
 */
define('CHARSET', 'UTF-8');

/**
 * Barra separadora de carpetas y archivos
 *
 * Windows = "\\"
 * <br>
 * Linux = "/"
 */
define('FILE_SLASH', '/');

/**#@+
 * Formato de los números
 */
/**
 * Cantidad de decimales
 */
define('NUMBER_FORMAT_AMOUNT_DECIMALS', 2);

/**
 * Separador de miles
 */
define('NUMBER_FORMAT_THOUSAND_SEPARATOR', '');

/**
 * Separador de decimales
 */
define('NUMBER_FORMAT_DECIMAL_SEPARATOR', '.');
/**#@-*/

/**
 * Path del sitio
 */
define('SITE_PATH', preg_replace('/include/', '', dirname(__FILE__)));
/**
 * URL del sitio
 */
define('SITE_URL', 'http://letitgokids.com/sis/');


/**
 * Path del administrador
 */
define('ADMIN_PATH', SITE_PATH.'administrador'.FILE_SLASH);
/**
 * URL del administrador
 */
define('ADMIN_URL', SITE_URL.'administrador/');
/**
 * URL del login del administrador
 */
define('ADMIN_LOGIN_URL', ADMIN_URL.'index.php');

/**
 * Path de los archivos de lenguage de las clases
 */
define('CLASS_LANGUAGE_PATH', SITE_PATH.'include'.FILE_SLASH.'lang'.FILE_SLASH);
/**
 * Lenguage de las clases
 */
define('CLASS_LANGUAGE', 'es');

/**
 * Formato de fechas
 *
 * - "d-m-Y" -> dd-mm-yyyy
 * - "m-d-Y" -> mm-dd-yyyy
 * - "Y-m-d" -> yyyy-mm-dd (MySql)
 */
define('FORMAT_DATE', 'd-m-Y');

/**#@+
 * Configuraciones de Cnavigator para el administrador
 */
/**
 * Cantidad de páginas que muestra el navegador
 */
define('NAV_AMOUNT_PAGES', 10);
/**
 * Cantidad de resultados (filas) por página
 */
define('NAV_RESULTS_PER_PAGE', 20);
/**#@-*/

/**#@+
 * Títulos del administrador
 */
/**
 * Cliente
 */
define('ADMIN_CLIENT', 'Desmadre');
/**
 * Tag <title> del administrador
 */
define('ADMIN_TITLE', 'Administrador: Desmadre');
/**#@-*/

/**#@+
 * Configuraciones sección de contacto
 */
/**
 * Nombre bajo el cual se envía el email de contacto
 */
define('CONTACT_NAME', 'letitgok');
/**
 * Email bajo el cual se hace el envío del email de contacto
 */
define('CONTACT_EMAIL', 'letitgok@letitgokids.com');
/**
 * Email que realiza el envío de email de contacto
 */
define('CONTACT_SENDER', 'manialiaga@gmail.com');
/**
 * Host SMTP
 */
define('CONTACT_SMTP_HOST', 'mail.letitgokids.com');
/**
 * User SMTP
 */
define('CONTACT_SMTP_USER', 'manialiaga@letitgokids.com');
/**
 * Password SMTP
 */
define('CONTACT_SMTP_PASS', 'Bas61814319');
/**
 * Port SMTP
 */
define('CONTACT_SMTP_PORT', '995');
/**#@-*/

/**#@+
 * Configuraciones de Productos: Cproducto()
 */
/**
 * Path físico de las fotos temporales
 */
define('PRODUCT_TEMP_PATH', SITE_PATH.'producto'.FILE_SLASH.'temp'.FILE_SLASH);
/**
 * Path físico de las fotos
 */
define('PRODUCT_PATH', SITE_PATH.'producto'.FILE_SLASH);
/**
 * Path físico de los thumbs de las fotos temporales
 */
define('PRODUCT_THUMBS_TEMP_PATH', SITE_PATH.'producto'.FILE_SLASH.'temp'.FILE_SLASH.'thumbs'.FILE_SLASH);
/**
 * Path físico de los thumbs de las fotos
 */
define('PRODUCT_THUMBS_PATH', PRODUCT_PATH.'thumbs'.FILE_SLASH);
/**
 * URL de las fotos temporales
 */
define('PRODUCT_TEMP_URL', SITE_URL.'producto/temp/');
/**
 * URL de las fotos
 */
define('PRODUCT_URL', SITE_URL.'producto/');
/**
 * URL de los thumbs de las fotos temporales
 */
define('PRODUCT_THUMBS_TEMP_URL', SITE_URL.'producto/temp/thumbs/');
/**
 * URL de los thumbs de las fotos
 */
define('PRODUCT_THUMBS_URL', PRODUCT_URL.'thumbs/');
/**
 * Ancho de los thumbs de las fotos
 */
define('PRODUCT_THUMBS_WIDTH', 150);
/**
 * Alto de los thumbs de las fotos
 */
define('PRODUCT_THUMBS_HEIGHT', 100);
/**
 * Ancho de los thumbs temporales de las fotos (se ven en el admin)
 */
define('PRODUCT_TEMP_THUMBS_WIDTH', 160);
/**#@-*/

//Comisión en efectivo
define('CASH_COMMISSION', 0.5);

//Comisión en cta cte
define('CURRENT_ACCOUNT_COMMISSION', 0.7);

//Cantidad de días para devolver
define('AMOUNT_DAYS_TO_GIVE_BACK', 15);

//Día en el que disponibilizo para cobrar
define('DAY_TO_PAY', '10');

//Cantida de días en la que se vence una cta cte
define('DAY_TO_CTA_CTE', '05');

/**
 * Path para los templates HTML
 */
define ('HTML_PATH', SITE_PATH.'templates'.FILE_SLASH);
//Template para el envío  de email con el usuario y contraseña
define ('HTML_USER_TEMPLATE', 'email_user.html');
//Template para el envío a los proveedores con los productos
define ('HTML_PROVIDER_TEMPLATE', 'email_providers.html');
?>
