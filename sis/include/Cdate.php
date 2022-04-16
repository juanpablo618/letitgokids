<?php
/**
 * Archivo php creado por EVO I.T.
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Manejo y control de datos tipo Fecha
 *
 * Esta clase se encarga de manipular y validar datos tipo fecha como date, time, datetime, etc.
 * Pasa las fechas del formato que acepta la base de datos (MySql, PostgreSQL, etc.) a el formato elegido por el usuario y viceversa.
 *
 * Soporta los siguientes formatos de fecha:
 * - 'dd-mm-yyyy' -> d-m-Y
 * - 'mm-dd-yyyy' -> m-d-Y
 * - 'yyyy-mm-dd' -> Y-m-d
 *
 * Soporta formato de hora 'HH:mm:ss' -> H:i:s
 *
 * Separador de fecha soportado: '-'
 *
 * Separador de hora soportado: ':'
 *
 * Separador entre fecha y hora: ' ' (espacio)
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Cdate.php');
 * $date = new Cdate();
 * $date->setStrFormat('d-m-Y');
 * $date->setDbFormat('Y-m-d');
 * $date->setdbDate('1980-11-24');
 * echo $date->getStrDate(); 
 * //devuelve 24-11-1980
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.2:25-08-2015
 */
class Cdate
{
	/**
	 * Formato de fecha definido en la configuración del script
	 *
	 * Ver también: {@link setStrFormat()}, {@link getStrFormat()}
	 * @var string
	 * @access private 
	 */
	private $strFormat;

	/**
	 * Formato de fecha que acepta la base de datos
	 *
	 * Ver también: {@link setDbFormat()}, {@link getDbFormat()}
	 * @var string
	 * @access private 
	 */
	private $dbFormat;
    	
    	/**
	 * Fecha en formato definido en la configuración del script
	 *
	 * Esta propiedad es una fecha que se encuentra seteada en el formato definido en la configuración del script: {@link $strFormat strFormat}.
	 *
	 * Ver también: {@link setStrDate()}, {@link getStrDate()}
	 * @var string
	 * @access private 
	 */
	private $strDate;

	/**
	 * Fecha en formato que acepta la base de datos (MySql, PostgreSQL, etc.)
	 *
	 * Esta propiedad es una fecha que se encuentra seteada en el formato que acepta la base de datos (Por ejemplo en MySQL es 'Y-m-d').
	 *
	 * Ver también: {@link setDbDate()}, {@link getDbDate()}
	 * @var string
	 * @access private  
	 */
	private $dbDate;
    
	/**
	 * Lista de formatos de fechas permitidos
	 *
	 * @var array
	 * @access private 
	 */
	private $allowedFormats = array('d-m-Y', 'm-d-Y', 'Y-m-d');    

	/**
	 * Array donde se almacenan los errores
	 *
	 * Ver también: {@link addError()}, {@link getErrors()}, {@link error()}, {@link showErrors()}, {@link deleteErrors()}
	 * @var array
	 * @access private
	 */
	private $errors = array();

	/**
	 * Constructor de la clase
	 *
	 * @param string $strFormat [opcional] indica el formato de fecha definido en la configuración del script
	 * @param string $dbFormat [opcional] indica el formato de fecha que acepta la base de datos
	 */
	function __construct($strFormat = '', $dbFormat = '')
	{
		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cdate.php');
        
        if (isset($strFormat) === TRUE and trim($strFormat) !== '')
		{
			$this->setStrFormat($strFormat);
		}
        
		if (isset($dbFormat) === TRUE and trim($dbFormat) !== '')
		{
			$this->setDbFormat($dbFormat);
		}
	}
    
	/**
	 * Destructor de la clase
	 */
	function __destruct()
	{

	}
    
	/**
	 * Setea el valor {@link $strFormat strFormat}
	 *
	 * @param string $strFormat indica el valor de strFormat
	 * @return boolean
	 * @access public  
	 */
	public function setStrFormat($strFormat)
	{
		$strFormat = str_replace("'", '', $strFormat);
		
        if (in_array($strFormat, $this->getAllowedFormats()) === TRUE)
		{
			$this->strFormat = $strFormat;
            
            return TRUE;
		}
		else
		{
			$this->addError(CDATE_SETFORMAT_WRONG_FORMAT);
			
            return FALSE;
		}
	}

	/**
	 * Setea el valor {@link $dbFormat dbFormat}
	 *
	 * @param string $dbFormat indica el valor de dbFormat
	 * @return boolean
	 * @access public  
	 */
	public function setDbFormat($dbFormat)
	{
		$dbFormat = str_replace("'", '', $dbFormat);
		
        	if (in_array($dbFormat, $this->getAllowedFormats()) === TRUE)
		{
			$this->dbFormat = $dbFormat;
            
            		return TRUE;
		}
		else
		{
			$this->addError(CDATE_SETFORMAT_WRONG_FORMAT);
			
            		return FALSE;
		}
	}

	/**
	 * Setea el valor {@link $strDate strDate}
	 *
	 * @param string $StrDate indica el valor de strDate
	 * @return boolean
	 * @access public 
	 */
	public function setStrDate($strDate)
	{
		$this->strDate = $strDate;
        
        	$this->dbDate = $this->strDateToDbDate();
        
        	return TRUE;
	}

	/**
	 * Setea el valor {@link $strDate strDate}
	 *
	 * @param string $dbDate indica el valor de dbDate
	 * @return boolean
	 * @access public 
	 */
	public function setDbDate($dbDate)
	{
		$this->dbDate = $dbDate;
        
        	$this->strDate = $this->dbDateToStrDate();
        
        	return TRUE;
	}
    
	/**
	 * Devuelve el valor {@link $strFormat strFormat}
	 *
	 * @return string
	 * @access public 
	 */
	public function getStrFormat()
	{
		return $this->strFormat;
	}

	/**
	 * Devuelve el valor {@link $dbFormat dbFormat}
	 *
	 * @return string
	 * @access public 
	 */
	public function getDbFormat()
	{
		return $this->dbFormat;
	}    

	/**
	 * Devuelve el valor {@link $strDate strDate}
	 *
	 * @return string
     	 * @access public
	 */
	public function getStrDate()
	{
		return $this->strDate;
	}
   
	/**
	 * Devuelve el valor {@link $dbDate dbDate}
	 *
	 *
	 * @return string
     	 * @access public
	 */    
	public function getDbDate()
	{
		return $this->dbDate;
	}
    
	/**
	 * Devuelve el valor {@link $allowedFormats allowedFormats}
	 *
	 *
	 * @return array
     	 * @access public
	 */    
	public function getAllowedFormats()
    	{
        	return $this->allowedFormats;
    	}
    
	/**
	 * Agrega un error en el array de errores
	 *
	 * Ver también: {@link getErrors()}, {@link error()}, {@link showErrors()}, {@link deleteErrors()}
	 * @param string $error Error
	 * @access public
	 */
	public function addError($error)
	{
		$this->errors[] = $error;
	}

	/**
	 * Devuelve los errores acumulados en {@link $errors errors}
	 *
	 * Ver también: {@link addError()}, {@link error()}, {@link showErrors()}, {@link deleteErrors()}
	 * @return array
	 * @access public
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Indica si se produjo algún error
	 *
	 * Este método devuelve TRUE sin en el array {@link $errors errors} existe al menos un error cargado.
	 *
	 * Ver también: {@link addError()}, {@link getErrors()}, {@link showErrors()}, {@link deleteErrors()}
	 * @return boolean
	 * @access public
	 */
	public function error()
	{
		if (is_array($this->errors) === TRUE)
		{
			if (count($this->errors) == 0)
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Imprime los errores acumulados en {@link $errors errors}
	 *
	 * Ver también: {@link addError()}, {@link getErrors()}, {@link error()}, {@link deleteErrors()}
	 * @param string $li [opcional] indica que caracter o que caracteres se muestran al inicio de cada línea de error.
	 * @return string
	 * @access public
	 */
	public function showErrors($li = '&#8226;&#160;')
	{
		if (is_array($this->errors) === TRUE)
		{
			foreach ($this->errors as $err)
			{
				echo '<div class="error_item">'.$li.$err.'</div>';
			}
		}
	}

	/**
	 * Elimina los errores acumulados en {@link $errors errors}
	 *
	 * Ver también: {@link addError()}, {@link getErrors()}, {@link error()}, {@link showErrors()}
	 * @return void
	 * @access public
	 */
	public function deleteErrors()
	{
		$this->errors = array();
	}    

	/**
	 * Devuelve una descripción del formato de fecha definido en la configuración del script
	 *
	 * @return string
	 * @access public 
	 */
	public function getDescStrFormat()
	{
		switch ($this->strFormat)
		{
			case 'd-m-Y':
				$descStrFormat = 'dd-mm-aaaa';
				break;
                
			case 'm-d-Y':
				$descStrFormat = 'mm-dd-aaaa';
				break;
                
			case 'Y-m-d':
				$descStrFormat = 'aaaa-mm-dd';
				break;
                
			default:
				$descStrFormat = '';
		}
        
		return $descStrFormat;
	}

	/**
	 * Devuelve una descripción del formato de fecha que acepta la base de datos
	 *
	 * @return string
	 * @access public 
	 */
	public function getDescDbFormat()
	{
		switch ($this->dbFormat)
		{
			case 'd-m-Y':
				$descDbFormat = 'dd-mm-aaaa';
				break;
                
			case 'm-d-Y':
				$descDbFormat = 'mm-dd-aaaa';
				break;
                
			case 'Y-m-d':
				$descDbFormat = 'aaaa-mm-dd';
				break;
                
			default:
				$descDbFormat = '';
		}
        
		return $descDbFormat;
	}

	/**
	 * Devuelve el formato de fecha definido en la configuración del script para setear el script Calendar
	 *
	 * @return string
	 * @access public 
	 */
	public function getCalendarStrFormat()
	{
		switch ($this->strFormat)
		{
			case 'd-m-Y':
				$calendarStrFormat = 'dd-mm-yy';
				break;
                
			case 'm-d-Y':
				$calendarStrFormat = 'mm-dd-yy';
				break;
                
			case 'Y-m-d':
				$calendarStrFormat = 'yy-mm-dd';
				break;
		}
        
		return $calendarStrFormat;
	}
   
	/**
	 * Convierte una fecha en formato base de datos a una fecha en el formato definido en la configuración del script
	 *
	 * @return string
     * @access public
	 */
	public function dbDateToStrDate()
	{
		if (validateRequiredValue($this->dbDate) === FALSE or $this->dbDate == '0000-00-00' or $this->dbDate == '00-00-0000' or $this->dbDate == '0000-00-00 00:00:00' or $this->dbDate == '00-00-0000 00:00:00')
		{
			return '';
		}
		else
        {
			$_date = trim($this->dbDate);

			//separo los valores de la fecha, separo la hora (si hubiese)
			$aux  = explode(' ', $_date, 2);
            
			if (isset($aux[0]) === TRUE)
			{
				//solo fecha
                $date = $aux[0];
			}
			else
			{
				$date = '';
			}
			
            if (isset($aux[1]) === TRUE)
			{
				//solo hora
                $time = $aux[1];
			}
			else
			{
				$time = '';
			}
            
			//separo año, mes y día
            switch ($this->dbFormat)
			{
				case 'd-m-Y':
					preg_match('/([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})/', $date, $dateArray);
					$year  = $dateArray[3];
					$month = $dateArray[2];
					$day   = $dateArray[1];
					break;
                    
				case 'm-d-Y':
					preg_match('/([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})/', $date, $dateArray);
					$year  = $dateArray[3];
					$month = $dateArray[1];
					$day   = $dateArray[2];
					break;
                    
				case 'Y-m-d':
					preg_match('/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/', $date, $dateArray);
					$year  = $dateArray[1];
					$month = $dateArray[2];
					$day   = $dateArray[3];
					break;
                    
				default:
					$year  = '';
					$month = '';
					$day   = '';
			}

			switch ($this->strFormat)
			{
				case 'd-m-Y':
					$date = $day.'-'.$month.'-'.$year;
					break;
                    
				case 'm-d-Y':
					$date = $month.'-'.$day.'-'.$year;
					break;
                    
				case 'Y-m-d':
					$date = $year.'-'.$month.'-'.$day;
					break;
                    
				default:
					$date = '';
			}

			if (validateRequiredValue($time) === FALSE)
			{
				return $date;
			}
			else
			{
				return $date.' '.$time;
			}
		}
	}
   
	/**
	 * Convierte una fecha en formato definido en la configuración del script en el formato de la base de datos 
	 *
	 * @return string
     * @access public
	 */
	public function strDateToDbDate()
	{
		if (validateRequiredValue($this->strDate) === FALSE or $this->strDate == '0000-00-00' or $this->strDate == '00-00-0000' or $this->strDate == '0000-00-00 00:00:00' or $this->strDate == '00-00-0000 00:00:00')
		{
			return '';
		}
		else
        {
			$_date = trim($this->strDate);

			//separo los valores de la fecha, separo la hora (si hubiese)
			$aux  = explode(' ', $_date, 2);
            
			if (isset($aux[0]) === TRUE)
			{
				//sólo fecha
                $date = $aux[0];
			}
			else
			{
				$date = '';
			}
            
			if (isset($aux[1]) === TRUE)
			{
				//sólo hora
                $time = $aux[1];
			}
			else
			{
				$time = '';
			}

			//separo año, mes y día
	    		switch ($this->strFormat)
			{
				case 'd-m-Y':
					preg_match('/([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})/', $date, $dateArray);
					$year  = $dateArray[3];
					$month = $dateArray[2];
					$day   = $dateArray[1];
					break;
                    
				case 'm-d-Y':
					preg_match('/([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})/', $date, $dateArray);
					$year  = $dateArray[3];
					$month = $dateArray[1];
					$day   = $dateArray[2];
					break;
                    
				case 'Y-m-d':
					preg_match('/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/', $date, $dateArray);
					$year  = $dateArray[1];
					$month = $dateArray[2];
					$day   = $dateArray[3];
					break;
                    
				default:
					$year  = '';
					$month = '';
					$day   = '';
			}

			switch ($this->dbFormat)
			{
				case 'd-m-Y':
					$date = $day.'-'.$month.'-'.$year;
					break;
                    
				case 'm-d-Y':
					$date = $month.'-'.$day.'-'.$year;
					break;
                    
				case 'Y-m-d':
					$date = $year.'-'.$month.'-'.$day;
					break;
                    
				default:
					$date = '';
			}

			if (validateRequiredValue($time) === FALSE)
			{
				return $date;
			}
			else
			{
				return $date.' '.$time;
			}
		}
	}

	/**
	 * Valida una fecha de acuerdo al formato de fecha seleccionado
	 *
	 * Una fecha es considerada válida si:
     * - año está entre 1 y 32767 inclusive
     * - mes está entre 1 y 12 inclusive
     * - día está entre el número permitido de días para el mes dado. Los años bisiestos son tomados en cuenta.
	 *
	 * @param string $date Fecha que se tiene que validar
	 * @param string $format Define si se valida la fecha en el formato definido en la configuración del script o en el formato de la base de datos [db | str]
	 * @return boolean
     * @access public 
	 */
	public function validateDate($date, $format = 'db')
	{
        if (validateRequiredValue($date) === FALSE)
		{
			return TRUE;
		}
		else
		{
			$date = trim($date);

			//separo los valores de la fecha, separo la hora (si hubiese)
			$aux  = explode(' ', $date, 2);
			
            if (isset($aux[0]) === TRUE)
			{
				//sólo fecha
                $date = $aux[0];
			}
			else
			{
				$date = '';
			}
            
			if (isset($aux[1]) === TRUE)
			{
				//sólo hora
                $time = $aux[1];
			}
			else
			{
				$time = '';
			}

            //separo año, mes y día
			$auxDate = explode('-', $date, 3);
            
			if (isset($auxDate[0]) === FALSE)
			{
				$auxDate[0] = '';
			}
			if (isset($auxDate[1]) === FALSE)
			{
				$auxDate[1] = '';
			}
			if (isset($auxDate[2]) === FALSE)
			{
				$auxDate[2] = '';
			}

			//decido en qué formato voy a validar la fecha
			if ($format === 'db')
			{
				$auxFormat = $this->dbFormat;
			}
			else
			{
				$auxFormat = $this->strFormat;
			}
            
			switch ($auxFormat)
			{
				case 'd-m-Y':
					$year  = $auxDate[2];
					$month = $auxDate[1];
					$day   = $auxDate[0];
					break;
                    
				case 'm-d-Y':
					$year  = $auxDate[2];
					$month = $auxDate[0];
					$day   = $auxDate[1];
					break;
                    
				case 'Y-m-d':
					$year  = $auxDate[0];
					$month = $auxDate[1];
					$day   = $auxDate[2];
					break;
			}

			//valido la fecha
			if ($this->checkValue($year) === TRUE and $this->checkValue($month) === TRUE and $this->checkValue($day) === TRUE)
			{
				if (checkdate($month, $day, $year))
				{
                    if (validateRequiredValue($time) === TRUE)
					{
						//valido la hora
						if ($this->validateTime($time) === TRUE)
						{
							return TRUE;
						}
						else
						{
							$this->addError(CDATE_VALIDATE_DATE_WRONG_TIME);
                            
							return FALSE;
						}
					}
					else
					{
						return TRUE;
					}
				}
				else
				{
					$this->addError(CDATE_VALIDATE_DATE_WRONG_DATE);
                    
					return FALSE;
				}
			}
			else
			{
				$this->addError(CDATE_VALIDATE_DATE_WRONG_DATE);
                
				return FALSE;
			}
		}
	}

	/**
	 * Valida una hora del tipo 23:59:59
	 *
	 * @param string $time hora que se tiene que validar
	 * @return boolean
     * @access public  
	 */
	public function validateTime($time)
	{
        if (validateRequiredValue($time) === FALSE)
		{
			return TRUE;
		}
		else
		{
			//separo los componentes de la hora
            $auxTime = explode(':', $time, 3);
            
			if (isset($auxTime[0]) === FALSE)
			{
				$auxTime[0] = '';
			}
			if (isset($auxTime[1]) === FALSE)
			{
				$auxTime[1] = '';
			}
			if (isset($auxTime[2]) === FALSE)
			{
				$auxTime[2] = '';
			}

			$hour   = $auxTime[0];
			$minute = $auxTime[1];
			$second = $auxTime[2];

			if ($this->checkValue($hour) === TRUE and $this->checkValue($minute) === TRUE and $this->checkValue($second) === TRUE)
			{
				if ($hour >= 0 and $hour <= 23)
				{
					if ($minute >= 0 and $minute <= 59)
					{
						if ($second >= 0 and $second <= 59)
						{
							return TRUE;
						}
						else
						{
							$this->addError(CDATE_VALIDATE_TIME_WRONG_TIME);
							
                            return FALSE;
						}
					}
					else
					{
						$this->addError(CDATE_VALIDATE_TIME_WRONG_TIME);
						
                        return FALSE;
					}
				}
				else
				{
					$this->addError(CDATE_VALIDATE_TIME_WRONG_TIME);
					
                    return FALSE;
				}
			}
			else
			{
				$this->addError(CDATE_VALIDATE_TIME_WRONG_TIME);
				
                return FALSE;
			}
		}
	}

	/**
	 * Valida un campo del tipo "year"
	 *
	 * A year in two-digit or four-digit format. The default is four-digit format.
	 * In four-digit format, the allowable values are 1901 to 2155, and 0000.
	 * In two-digit format, the allowable values are 70 to 69, representing years from 1970 to 2069.
	 *
	 * Fuente: {@link http://dev.mysql.com/doc/refman/4.1/en/date-and-time-type-overview.html}, {@link http://dev.mysql.com/doc/refman/4.1/en/year.html}
	 *
	 * @param string $year Año que se tiene que validar
	 * @param integer $format [opcional] formato del año (2 ó 4 dígitos)
	 * @return boolean
     * @access public 
	 */
	public function validateYear($year, $format = 4)
	{
        if (validateRequiredValue($year) === FALSE)
		{
			return TRUE;
		}
		else
		{
			if ($this->checkValue($year) === TRUE)
			{
				if ($format == 2)
				{
					//formato de 2 dígitos
					if ($year >= 0 and $year <= 99)
					{
						return TRUE;
					}
					else
					{
						$this->addError(CDATE_VALIDATE_YEAR_WRONG_YEAR);
                        
						return FALSE;
					}
				}
				else
				{
					//formato de 4 dígitos
					if ($year >= 1901 and $year <= 2155)
					{
						return TRUE;
					}
					else
					{
						$this->addError(CDATE_VALIDATE_YEAR_WRONG_YEAR);
                        
						return FALSE;
					}
				}
			}
			else
			{
				$this->addError(CDATE_VALIDATE_YEAR_WRONG_YEAR);
                
				return FALSE;
			}
		}
	}

	/**
	 * Valida un valor entero
	 *
	 * @param string $value valor que se tiene que validar
	 * @return boolean
     * @access public 
	 */
	public function checkvalue($value)
	{
		$pattern = '/^[0-9]+$/';
        
		if (preg_match($pattern, $value))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
?>