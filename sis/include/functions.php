<?php
/**
 * Archivo de funciones generales
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.2:04-08-2016
 */

/**
 * Valida variables requeridas
 *
 * Esta función se utiliza para validar variables que son requeridas o que no pueden estar vacías.
 *
 * @param mixed $value valor de la variable que se valida
 * @return boolean
 */
function validateRequiredValue($value)
{
	if (isset($value) === FALSE or trim($value) === '')
	{
		return FALSE;
	}
	else
	{
		return TRUE;
	}
}

/**
 * Procesa el valor de variables para las funciones get
 *
 * @param string $value valor de la variable
 * @param boolean $htmlEntities indica si se convierten o no los caracteres a su entidad HTML
 * @param string $charset [opcional] juego de caracteres utilizado para la conversión
 * @return string
 */
function getValue($value, $htmlEntities, $charset = '')
{
	if ($htmlEntities === TRUE)
	{
		return htmlentities($value, ENT_QUOTES, $charset);
	}
	else
	{
		return $value;
	}
}

/**
 * Procesa el valor de variables para las funciones set
 *
 * @param string $value valor de la variable
 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
 * @return string
 */
function setValue($value, $gpc)
{
	if (get_magic_quotes_gpc() and $gpc === TRUE)
	{
		return stripslashes($value);
	}
	else
	{
		return $value;
	}
}

/**
 * Valida variables de valores enteros
 *
 * Esta función se utiliza para validar variables que deben contener valores numéricos enteros.
 * El parámetro $range puede contener los siguientes valores:
 * - '-+': Enteros positivos y negativos (se incluye el cero)
 * - '0+': Enteros positivos con el cero
 * - '+' : Enteros positivos sin el cero
 * - '-0': Enteros negativos con el cero
 * - '-' : Enteros negativos sin el cero
 * Si el parámetro $num no está seteado o es un valor vacío la función devuelve TRUE.
 *
 * @param mixed $num valor de la variable que se valida
 * @param string $range [opcional] rango numérico que debe validarse
 * @return boolean
 */
function validateIntValue($num, $range = '-+')
{
	if (validateRequiredValue($num) === TRUE)
	{
		switch($range)
		{
			case '-+':
				//positivos y negativos
				$pattern = '^[+-]?[0-9]+$';
				break;

			case '0+':
				//positivos con el cero
				$pattern = '^[+]?[0-9]+$';
				break;

			case '+':
				//positivos sin el cero
				$pattern = '^[+]?[0-9]+$';
				$pattern2 = '^[+]?[0]+$';
				break;

			case '-0':
				//negativos con el cero
				$pattern = '(^[-]{1}[0-9]+$|^0+$)';
				break;

			case '-':
				//negativos sin el cero
				$pattern = '^[-]{1}[0-9]+$';
				$pattern2 = '^[-]{1}[0]+$';
				break;

			default:
				//positivos y negativos
				$pattern = '^[+-]?[0-9]+$';
		}

		if ($range == '-+' or $range == '0+' or $range == '-0')
		{
			//con el cero
			if (preg_match ('/'.$pattern.'/', $num))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		elseif ($range == '+' or $range == '-')
		{
			//sin el cero '^[0]+$'
			if (preg_match ('/'.$pattern.'/', $num) and !preg_match ('/'.$pattern2.'/', $num))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	else
	{
		return TRUE;
	}
}

/**
 * Valida variables de valores decimales
 *
 * Esta función se utiliza para validar variables que deben contener valores numéricos decimales.
 * El parámetro $range puede contener los siguientes valores:
 * - '-+': Decimales positivos y negativos (se incluye el cero)
 * - '0+': Decimales positivos con el cero
 * - '+' : Decimales positivos sin el cero
 * - '-0': Decimales negativos con el cero
 * - '-' : Decimales negativos sin el cero
 * Si el parámetro $num no está seteado o es un valor vacío la función devuelve TRUE.
 *
 * @param mixed $num valor de la variable que se valida
 * @param string $range [opcional] rango numérico que debe validarse
 * @return boolean
 */
function validateDecimalValue($num, $range = '-+')
{
	if (validateRequiredValue($num) === TRUE)
	{
		switch($range)
		{
			case '-+':
				//positivos y negativos
				$pattern = '^[+-]?[0-9]+([.]{1}[0-9]*)?$';
				break;

			case '0+':
				//positivos con el cero
				$pattern = '^[+]?[0-9]+([.]{1}[0-9]*)?$';
				break;

			case '+':
				//positivos sin el cero
				$pattern = '^[+]?[0-9]+([.]{1}[0-9]*)?$';
				$pattern2 = '^[+]?[0]+([.]{1}[0]*)?$';
				break;

			case '-0':
				//negativos con el cero
				$pattern = '(^[-]{1}[0-9]+([.]{1}[0-9]*)?$|^0+([.]{1}[0-9]*)?$)';
				break;

			case '-':
				//negativos sin el cero
				$pattern = '^[-]{1}[0-9]+([.]{1}[0-9]*)?$';
				$pattern2 = '^[-]{1}[0]+([.]{1}[0]*)?$';
				break;

			default:
				//positivos y negativos
				$pattern = '^[+-]?[0-9]+([.]{1}[0-9]*)?$';
		}

		if ($range == '-+' or $range == '0+' or $range == '-0')
		{
			//con el cero
			if (preg_match ('/'.$pattern.'/', $num))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		elseif ($range == '+' or $range == '-')
		{
			//sin el cero '^[0]+$'
			if (preg_match ('/'.$pattern.'/', $num) and !preg_match ('/'.$pattern2.'/', $num))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	else
	{
		return TRUE;
	}
}

/**
 * Valida variables con cadenas de caracteres
 *
 * Esta función se utiliza para validar variables que deben contener cadenas de caracteres.
 * El parámetro $type puede contener los siguientes valores:
 * - 'alpha': Alfabético (sólo letras)
 * - 'alphanumeric': Alfanumérico (letras y números)
 * - 'numeric' : Numérico (sólo números)
 * Si el parámetro $str no está seteado o es un valor vacío la función devuelve TRUE.
 *
 * @param mixed $str valor de la variable que se valida
 * @param string $type [opcional] tipos de cadenas de caracteres a validarse
 * @param boolean $allowBlanks [opcional] si se permiten espacios en blancos
 * @return boolean
 */
function validateStringValue($str, $type = 'alpha', $allowBlanks = TRUE)
{
	if (validateRequiredValue($str) === TRUE)
	{
		if ($allowBlanks === TRUE)
		{
			$blanks = ' ';
		}
		else
		{
			$blanks = '';
		}

		switch ($type)
		{
			case 'alpha':
				//sólo letras
				$pattern = '^[a-zA-Z'.$blanks.'ñÑáéíóúÁÉÍÓÚüÜ.]+$';
				break;

			case 'alphanumeric':
				//sólo letras y números
				$pattern = '^[a-zA-Z0-9'.$blanks.'ñÑáéíóúÁÉÍÓÚüÜ.]+$';
				break;

			case 'numeric':
				//sólo números
				$pattern = '^[0-9'.$blanks.']+$';
				break;

			default:
				//sólo letras
				$pattern = '^[a-zA-Z0-9'.$blanks.'ñÑáéíóúÁÉÍÓÚüÜ.]+$';
		}

		if (preg_match ('/'.$pattern.'/', $str))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	else
	{
		return TRUE;
	}
}

/**
 * Valida URLs
 *
 * Esta función se utiliza para validar variables que deben contener URLs.
 * Si el parámetro $url no está seteado o es un valor vacío la función devuelve TRUE.
 *
 * @param string $url valor de la variable que se valida
 * @return boolean
 */
function validateUrlValue($url)
{
	if (validateRequiredValue($url) === TRUE)
	{
		$pattern_array = array (
			'protocol' => '((http|https|ftp)://)',
			'access' => '(([a-z0-9_]+):([a-z0-9-_]*)@)?',
			'sub_domain' => '(([a-z0-9_-]+\.)*)',
			'domain' => '(([a-z0-9-]{2,})\.)',
			'tld' =>'(com|net|org|edu|gov|mil|int|arpa|aero|biz|coop|info|museum|name|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cf|cd|cg|ch|ci|ck|cl|cm|cn|co|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|eh|er|es|et|fi|fj|fk|fm|fo|fr|fx|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zr|zw)',
			'port' =>'(:(\d+))?',
			'path' =>'((/[a-z0-9-_.%~]*)*)?',
			'query' =>'(\?[^? ]*)?'
			);

			$pattern = '`^'
			.$pattern_array['protocol']
			.$pattern_array['access']
			.$pattern_array['sub_domain']
			.$pattern_array['domain']
			.$pattern_array['tld']
			.$pattern_array['port']
			.$pattern_array['path']
			.$pattern_array['query']
			.'$`iU';

			if (preg_match($pattern, $url))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
	}
	else
	{
		return TRUE;
	}
}

/**
 * Valida Emails
 *
 * Esta función se utiliza para validar variables que deben contener Emails.
 * Si el parámetro $email no está seteado o es un valor vacío la función devuelve TRUE.
 *
 * @param string $email valor de la variable que se valida
 * @return boolean
 */
function validateEmailValue($email)
{
	if (validateRequiredValue($email) === TRUE)
	{
		//characters allowed on name: 0-9a-Z-._ on host: 0-9a-Z-. on between: @
		if (!preg_match('/^[0-9a-zA-Z\.\-\_]+\@[0-9a-zA-Z\.\-]+$/', $email))
		return FALSE;

		//must start or end with alpha or num
		if ( preg_match('/^[^0-9a-zA-Z]|[^0-9a-zA-Z]$/', $email))
		return FALSE;

		//name must end with alpha or num
		if (!preg_match('/([0-9a-zA-Z_]{1})\@./',$email) )
		return FALSE;

		//host must start with alpha or num
		if (!preg_match('/.\@([0-9a-zA-Z_]{1})/',$email) )
		return FALSE;

		//pair .- or -. or -- or .. not allowed
		if ( preg_match('/.\.\-.|.\-\..|.\.\..|.\-\-./',$email) )
		return FALSE;

		//pair ._ or -_ or _. or _- or __ not allowed
		if ( preg_match('/.\.\_.|.\-\_.|.\_\..|.\_\-.|.\_\_./',$email) )
		return FALSE;

		//host must end with '.' plus 2-5 alpha for TopLevelDomain
		if (!preg_match('/\.([a-zA-Z]{2,5})$/',$email) )
		return FALSE;

		return TRUE;
	}
	else
	{
		return TRUE;
	}
}

/**
 * Elimina caracteres inválidos de una cadena
 *
 * Esta función se utiliza para eliminar los caracters inválidos de una cadena.
 * Es muy común utilizarla cuando se manejan nombres de archivos y carpetas.
 *
 * @param string $char cadena a corregir
 * @return string
 */
function deleteWrongCharts($char)
{
	$cadena = preg_replace('/á/', 'a', $char);
	$cadena = preg_replace('/é/', 'e', $cadena);
	$cadena = preg_replace('/í/', 'i', $cadena);
	$cadena = preg_replace('/ó/', 'o', $cadena);
	$cadena = preg_replace('/ú/', 'u', $cadena);
	$cadena = preg_replace('/Á/', 'A', $cadena);
	$cadena = preg_replace('/É/', 'E', $cadena);
	$cadena = preg_replace('/Í/', 'I', $cadena);
	$cadena = preg_replace('/Ó/', 'O', $cadena);
	$cadena = preg_replace('/Ú/', 'U', $cadena);
	$cadena = preg_replace('/Ñ/', 'N', $cadena);
	$cadena = preg_replace('/ñ/', 'n', $cadena);
	$cadena = preg_replace('/ü/', 'u', $cadena);
	$cadena = preg_replace('/Ü/', 'U', $cadena);

	while (preg_match('/[^A-Za-z0-9._\-\(\)[)p(|]|]]/', $cadena, $reg))
	{
		$cadena = str_replace($reg[0], '_', $cadena);
	}

	$cadena = str_replace('\\', '_', $cadena);

	return $cadena;
}

/**
 * Corta cadenas de caracteres
 *
 * Esta función se utiliza para cortar cadenas de caracteres muy largas.
 * Es muy común usarla cuando se muestran los resultados de una consulta en forma tabulada.
 *
 * @param string $string cadena de caracteres que se corta
 * @param integer $lenght largo con el que queda la cadena
 * @param string $lastString [opcional] caracteres que se muestran al final de la cadena si la misma es cortada
 * @param boolean $html [opcional] indica si se convierten o no las entidades HTML a su correspondiente caracter para contar el largo de la cadena y determinar si hay que cortarla
 * @return string
 */
function getCutString($string, $lenght, $lastString = '...', $html = TRUE)
{
	if ($html === TRUE)
	{
        $string = html_entity_decode($string, ENT_QUOTES, CHARSET);
	}

	if (mb_strlen($string, CHARSET) <= $lenght or $lenght == 0)
	{
		if ($html === TRUE)
		{
			return htmlentities($string, ENT_QUOTES, CHARSET);
		}
		else
		{
			return $string;
		}
	}
	else
	{
        if (mb_strlen($string, CHARSET) < mb_strlen($lastString, CHARSET) + $lenght)
		{
			if ($html === TRUE)
			{
				return htmlentities($string, ENT_QUOTES, CHARSET);
			}
			else
			{
				return $string;
			}
		}
		else
		{
            $str = mb_substr($string, 0, $lenght, CHARSET).$lastString;

			if ($html === TRUE)
			{
				return htmlentities($str, ENT_QUOTES, CHARSET);
			}
			else
			{
				return $str;
			}
		}
	}
}

/**
 * Agrega un 'title' a una cadena de caracteres
 *
 * @param string $string cadena de caracteres a la que se le agrega el 'title'
 * @param string $alt 'title' que se agrega a la cadena de caracteres
 * @return string
 */
function altText($string, $alt)
{
	return '<span title="'.$alt.'">'.$string.'</span>';
}

/**
 * Función que se utiliza para encriptar cadenas de caracteres
 *
 * Para encriptar una cadena se debe utilizar la función {@link md5_encrypt()} la cual llama a esta función para lograr la encriptación.
 *
 * @param mixed $ivlen
 * @return mixed
 */
function getRndIv($ivlen)
{
	$iv = '';
	while ($ivlen-- > 0)
	{
		$iv .= chr(mt_rand() & 0xff);
	}
	return $iv;
}

/**
 * Función para la encriptación de cadenas de caracteres
 *
 * @param string $plainText cadena de caracteres a encriptar
 * @param string $password contraseña para encriptar
 * @param integer $ivlen [opcional]
 * @return string
 */
function md5Encrypt($plainText, $password, $ivlen = 16)
{
	$plainText .= "\x13";
	$n = strlen($plainText);
	if ($n % 16) $plainText .= str_repeat("\0", 16 - ($n % 16));
	$i = 0;
	$encText = getRndIv($ivlen);
	$iv = substr($password ^ $encText, 0, 512);
	while ($i < $n)
	{
		$block = substr($plainText, $i, 16) ^ pack('H*', md5($iv));
		$encText .= $block;
		$iv = substr($block . $iv, 0, 512) ^ $password;
		$i += 16;
	}

	return base64_encode($encText);
}

/**
 * Función para la desencriptación de cadenas de caracteres
 *
 * @param string $encText cadena de caracteres a desencriptar
 * @param string $password contraseña para desencriptar
 * @param integer $ivlen [opcional]
 * @return string
 */
function md5Decrypt($encText, $password, $ivlen = 16)
{
	$encText = base64_decode($encText);
	$n = strlen($encText);
	$i = $ivlen;
	$plainText = '';
	$iv = substr($password ^ substr($encText, 0, $ivlen), 0, 512);
	while ($i < $n)
	{
		$block = substr($encText, $i, 16);
		$plainText .= $block ^ pack('H*', md5($iv));
		$iv = substr($block . $iv, 0, 512) ^ $password;
		$i += 16;
	}

	return preg_replace('/\\x13\\x00*$/', '', $plainText);
}


/**
 * Indica si el S.O. utilizado es Windows
 *
 * @return boolean
 */
function isWindows()
{
	if (strtoupper(substr(php_uname('s'), 0, 3)) == 'WIN')
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}


/**
 * Esta función limpia una cadena de posibles scripts
 *
 * @return string
 */
function showTextInTags($text)
{
	$text = preg_replace('/(\<script)(.*?)(script>)/si', ' ', "$text");
	$text = strip_tags($text);
	$text = str_replace('<!--', '&lt;!--', $text);
	$text = preg_replace('/(\<)(.*?)(--\>)/mi', ''.nl2br('\\2').'', $text);
	$text = str_replace("'",' ',$text);

	return $text;
}

/**
 * Instala una cookie que luego es revisada (getcheck_cookies_are_enabled())
 * para verificar si tiene habilitadas las cookies.
 */
function setCheckCookiesAreEnabled()
{
	setcookie('svCookiesAreEnabledEv', 1);
}

/**
 * Verifica que la cookie previamente creada (setCheckCookiesAreEnabled()) existe.
 */
function getCheckCookiesAreEnabled()
{
	if (!isset($_COOKIE['svCookiesAreEnabledEv']))
	{
		return FALSE;
	}
	else
	{
		return TRUE;
	}
}

/**
 * Verifica que no exista un valor/valores dentro de un array
 *
 * Verifica que no exista un valor/valores dentro de un array. Devuelve TRUE si lo encuentra y FALSE de otro modo.
 *
 * El formato del parámetro $values es el siguiente:
 * <code>
 * <?php
 * $i = 0;
 * $values[$i]['value'] = 'campaña1';
 * $values[$i]['field'] = 'name';
 * $i++;
 * ?>
 * </code>
 *
 * @param array $array Es el array en el que estamos buscando
 * @param array $values Es un array que tiene los valores que necesitamos encontrar.
 * @return boolean
 */
function isInArray($array, $values)
{
	if (is_array($array) === TRUE and count($array) > 0 and is_array($values) === TRUE and count($values) > 0)
	{
		$amount = count($values);

		foreach ($array as $valueArray)
		{
			$cantFounded = 0;

			foreach ($values as $valueValues)
			{
				if (isset($valueArray[$valueValues['field']]) == TRUE and trim(strtolower($valueArray[$valueValues['field']])) == trim(strtolower($valueValues['value'])))
				{
					$cantFounded++;
				}

				if ($cantFounded == $amount)
				{
					return TRUE;
				}
			}
		}

		return FALSE;
	}
	else
	{
		return FALSE;
	}
}

/**
 * Conexión a la base de datos
 *
 */
function DBConnect()
{
	$dbConn = ADONewConnection(DB_TYPE);

	$dbConn->debug = DB_DEBUG;

	if ($dbConn->Connect(DB_HOST, DB_NAME, DB_PASS, DB_DBASE) === FALSE)
	{
		//echo $dbConn->ErrorMsg().'<br />';

		return FALSE;
	}
	else
	{
		$dbConn->Execute("SET NAMES 'utf8'");

		return $dbConn;
	}
}

/**
 * Convierte una cadena en lowerCamelCase
 *
 * @param string $str cadena a transformar
 */
function lowerCamelCase($str)
{
    $str = str_replace(' ', '_', $str);

	// underscored to lower-camelcase
	// e.g. "this_method_name" -> "thisMethodName"

    $result = preg_replace_callback('/_(.?)/', function($m) { return strtoupper($m[1]); }, $str);

    //si no anda la linea de arriba usar esta más la función que sigue lowerCamelCaseAux()
    //$result = preg_replace_callback('/_(.?)/', 'lowerCamelCaseAux', $str);

    return $result;
}
function lowerCamelCaseAux($m)
{
	return strtoupper($m[1]);
}

/**
 * Imprime una consulta SQL
 *
 * @param string $sql consulta SQL
 * @return HTML
 */
function printSql($sql)
{
    echo '<div style="border: 1px solid #000; background-color: #000; padding: 10px; margin: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #0F0; line-height: 18px">';

    $color = '#0F0';

    $sql = preg_replace('/SELECT/', '<b style="color: '.$color.';">SELECT</b>', $sql);
    $sql = preg_replace('/INSERT/', '<b style="color: '.$color.';">INSERT</b>', $sql);
    $sql = preg_replace('/UPDATE/', '<b style="color: '.$color.';">UPDATE</b>', $sql);
    $sql = preg_replace('/DELETE/', '<b style="color: '.$color.';">DELETE</b>', $sql);
    $sql = preg_replace('/FROM/', '<br /><b style="color: '.$color.';">FROM</b>', $sql);
    $sql = preg_replace('/LEFT JOIN/', '<br /><b style="color: '.$color.';">LEFT J</b><b style="color: '.$color.';">OIN</b>', $sql);
    $sql = preg_replace('/JOIN/', '<br /><b style="color: '.$color.';">JOIN</b>', $sql);
    $sql = preg_replace('/WHERE/', '<br /><b style="color: '.$color.';">WHERE</b>', $sql);
    $sql = preg_replace('/AND/', '<br /><b style="color: '.$color.';">AND</b>', $sql);
    $sql = preg_replace('/BETWEEN/', '<b style="color: '.$color.';">BETWEEN</b>', $sql);
    $sql = preg_replace('/ORDER BY/', '<br /><b style="color: '.$color.';">ORDER BY</b>', $sql);
    $sql = preg_replace('/ASC/', '<b style="color: '.$color.';">ASC</b>', $sql);
    $sql = preg_replace('/DESC/', '<b style="color: '.$color.';">DESC</b>', $sql);
    $sql = preg_replace('/GROUP BY/', '<br /><b style="color: '.$color.';">GROUP BY</b>', $sql);
    $sql = preg_replace('/ON/', '<b style="color: '.$color.';">ON</b>', $sql);
    $sql = preg_replace('/AS/', '<b style="color: '.$color.';">AS</b>', $sql);
    $sql = preg_replace('/SUM/', '<b style="color: '.$color.';">SUM</b>', $sql);
    $sql = preg_replace('/IF/', '<b style="color: '.$color.';">IF</b>', $sql);
    $sql = preg_replace('/HAVING/', '<br /><b style="color: '.$color.';">HAVING</b>', $sql);
    $sql = preg_replace('/COUNT/', '<b style="color: '.$color.';">COUNT</b>', $sql);


    echo $sql;

    echo '</div>';
}

/**
 * Genera una cadena aleatoria
 *
 * Source: http://ar2.php.net/rand
 *
 * @param integer $length [opcional] longitud de la cadena
 * @param string $chars [opcional] caracteres
 */
function randStr($length = 32, $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890')
{
    // Length of character list
    $charsLength = (strlen($chars) - 1);

    // Start our string
    $string = $chars{rand(0, $charsLength)};

    // Generate random string
    for ($i = 1; $i < $length; $i = strlen($string))
    {
        // Grab a random character from our list
        $r = $chars{rand(0, $charsLength)};

        // Make sure the same two characters don't appear next to each other
        if ($r != $string{$i - 1}) $string .=  $r;
    }

    // Return the string
    return $string;
}

/**
 * Reemplaza al var_dump para el debug
 *
 * @param mixed $var Variable a mostrar
 */
function dump($var)
{
    if (function_exists('xdebug_var_dump'))
    {
        xdebug_var_dump($var);
    }
    else
    {
        echo '<pre>';
    	var_dump($var);
    	echo '</pre>';
    }
}

/**
 * Esta función formatea los números
 *
 * @param float $num
 * @param int $amountDecimals
 * @return float
 */
function numberFormat($num, $amountDecimals = NUMBER_FORMAT_AMOUNT_DECIMALS, $thousandSeparator = NUMBER_FORMAT_THOUSAND_SEPARATOR, $decimalSparator = NUMBER_FORMAT_DECIMAL_SEPARATOR)
{
    return number_format($num, $amountDecimals, $decimalSparator, $thousandSeparator);
}

/**
* Campos para ingresar una fecha
*
* Esta función imprime los campos para ingresar una fecha. Un select para los días, un select para los meses y
* un campo de texto para los años
*
*/
function dateFields($name, $dbFormat, $valueFrom = '', $valueTo = '')
{
    $nameFrom	= $name.'From';
    $nameTo	= $name.'To';

    $oDateInfo = new Cdate(FORMAT_DATE, $dbFormat);
    ?>
    <input name="<?php echo $nameFrom; ?>" type="text" id="<?php echo $nameFrom; ?>" value="<?php echo $valueFrom; ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btn<?php echo $nameFrom; ?>" class="calendar"></a><script> $(document).ready(function () { showCalendar('#<?php echo $nameFrom; ?>', '#btn<?php echo $nameFrom; ?>', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
    &nbsp;&nbsp;-&nbsp;&nbsp;
    <input name="<?php echo $nameTo; ?>" type="text" id="<?php echo $nameTo; ?>" value="<?php echo $valueTo; ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btn<?php echo $nameTo; ?>" class="calendar"></a><script> $(document).ready(function () { showCalendar('#<?php echo $nameTo; ?>', '#btn<?php echo $nameTo; ?>', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
    <?php
}

/**
 * Esta función devuelve la hora con el formato para usar en las queries
 *
 * Ejemplo:
 * Ingresa: 15
 * Devuelve: 15:00:00
 */
function getHourFormated($hour)
{
    $return = $hour.':00:00';

    $return = substr($return, 0, 8);

    return $return;
}
?>