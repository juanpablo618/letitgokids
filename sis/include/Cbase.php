<?php
/**
 * Archivo php creado por EVO I.T.
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Clase base para las clases creadas por O-creator
 *
 * Esta es la clase padre de la que heredan las clases creadas por O-creator.
 *
 * Ejemplo:
 * <code>
 * <?php
 * class Ctable extends Cbase
 * {
 *
 * }
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.2:25-08-2015
 */
class Cbase
{
	/**
	 * Charset
	 *
	 * Conjunto de caracteres que serán utilizados en la conversión. Tener en cuenta el cotejamiento de la base de datos. Ej: ISO-8859-1, UTF-8. Ver: {@link http://www.php.net/htmlentities/}
	 *
	 * Ver también: {@link getCharset()}, {@link setCharset()}
	 * @var string
	 * @access private
	 */
	private $charset;

	/**
	 * Conexión a la base de datos
	 *
	 * Ver también: {@link getDbConn()}, {@link setDbConn()}
	 * @var object (ADODB PHP)
	 * @access private
	 */
	private $dbConn = NULL;

	/**
	 * Nombre de la tabla (de la base de datos) que maneja la clase
	 *
	 * Ver también: {@link getTableName()}, {@link setTableName()}
	 * @var string
	 * @access private
	 */
	private $tableName;

	/**
	 * Cantidad de registros obtenidos con el método {@link getList()} con el LIMIT
	 *
	 * Ver también: {@link getTotalQuery()}, {@link setTotalQuery()}
	 * @var integer
	 * @access private
	 */
	private $totalQuery;

	/**
	 * Cantidad de registros obtenidos con el método {@link getList()} sin el LIMIT
	 *
	 * Ver también: {@link getTotalList()}, {@link setTotalList()}
	 * @var integer
	 * @access private
	 */
	private $totalList;

	/**
	 * Condición del WHERE de la consulta SQL
	 *
	 * Esta condición es armada por el método {@link searchForm()} y se utiliza en el método {@link showQuery()} para filtrar la consulta y mostrar los registros correspondientes.
	 *
	 * Ver también: {@link getCondition()}, {@link setCondition()}
	 * @var string
	 * @access private
	 */
	private $condition;

	/**
	 * Parámetros que genera el método {@link searchForm()}
	 *
	 * Estos parámetros generados por el método {@link searchForm()} se utilizan en el método {@link showQuery()} para pasarlos por url en los links de ordenamiento y en los links de las acciones.
	 *
	 * Ver también: {@link getParams()}, {@link setParams()}
	 * @var string
	 * @access private
	 */
	private $params;

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
	 * En el constructor se setea por defecto el {@link $charset charset} de la clase.
	 * Toma el valor de la constante CHARSET definida en el archivo de configuración del script.
	 * Si no se le pasa como parámetro un conexión a la base de datos, intenta tomar una global ($GLOBALS['dbConn'])
	 *
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		$this->charset = CHARSET;

		if (is_object($dbConn) === TRUE and strpos(get_class($dbConn), 'ADODB_') === 0)
		{
			$this->setDbConn($dbConn);
	    }
	    elseif (is_object($GLOBALS['dbConn']) === TRUE and strpos(get_class($GLOBALS['dbConn']), 'ADODB_') === 0)
	    {
	    	$this->setDbConn($GLOBALS['dbConn']);
	    }
	}

	/**
	 * Destructor de la clase
	 */
	function __destruct()
	{

	}

	/**
	 * Setea el valor {@link $charset charset}
	 *
	 * @param string $charset indica el charset utilizado. Ejemplo: "ISO-8859-1", "UTF-8".
	 * @return boolean
	 * @access public
	 */
	public function setCharset($charset)
	{
		$this->charset = $charset;

		return TRUE;
	}

	/**
	 * Setea el valor {@link $dbConn dbConn}
	 *
	 * @param object (ADODB PHP) $dbConn Conexión a la base de datos
	 * @return boolean
	 * @access public
	 */
	public function setDbConn($dbConn)
	{
		$this->dbConn = $dbConn;

		return TRUE;
	}

	/**
	 * Setea el valor {@link $tableName tableName}
	 *
	 * @param string $tableName Nombre de la tabla
	 * @return boolean
	 * @access protected
	 */
	protected function setTableName($tableName)
	{
		$this->tableName = $tableName;

		return TRUE;
	}

	/**
	 * Setea el valor {@link $totalQuery totalQuery}
	 *
	 * @param integer $totalQuery Cantidad de registros obtenidos con el LIMIT
	 * @return boolean
	 * @access protected
	 */
	protected function setTotalQuery($totalQuery)
	{
		$this->totalQuery = $totalQuery;

		return TRUE;
	}

	/**
	 * Setea el valor {@link $totalList totalList}
	 *
	 * @param integer $totalList Cantidad de registros obtenidos sin el LIMIT
	 * @return boolean
	 * @access protected
	 */
	protected function setTotalList($totalList)
	{
		$this->totalList = $totalList;

		return TRUE;
	}

	/**
	 * Setea el valor {@link $condition condition}
	 *
	 * @param string $condition Condición de la consulta SQL
	 * @return boolean
	 * @access public
	 */
	public function setCondition($condition)
	{
		$this->condition = $condition;

		return TRUE;
	}

	/**
	 * Setea el valor {@link $params params}
	 *
	 * @param string $params Parámetros
	 * @return boolean
	 * @access public
	 */
	public function setParams($params)
	{
		$this->params = $params;

		return TRUE;
	}

	/**
	 * Devuelve el valor {@link $charset charset}
	 *
	 * @return string
	 * @access public
	 */
	public function getCharset()
	{
		return $this->charset;
	}

	/**
	 * Devuelve el valor {@link $dbConn dbConn}
	 *
	 * @return object (ADOBD PHP)
	 * @access public
	 */
	public function getDbConn()
	{
		return $this->dbConn;
	}

	/**
	 * Devuelve el valor {@link $tableName tableName}
	 *
	 * @return string
	 * @access public
	 */
	public function getTableName()
	{
		return $this->tableName;
	}

	/**
	 * Devuelve el valor {@link $totalQuery totalQuery}
	 *
	 * @return integer
	 * @access public
	 */
	public function getTotalQuery()
	{
		return $this->totalQuery;
	}

	/**
	 * Devuelve el valor {@link $totalList totalList}
	 *
	 * @return integer
	 * @access public
	 */
	public function getTotalList()
	{
		return $this->totalList;
	}

	/**
	 * Devuelve el valor {@link $condition condition}
	 *
	 * @return string
	 * @access public
	 */
	public function getCondition()
	{
		return $this->condition;
	}

	/**
	 * Devuelve el valor {@link $params params}
	 *
	 * @return string
	 * @access public
	 */
	public function getParams()
	{
		return $this->params;
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
	 * Este método devuelve TRUE si en el array {@link $errors errors} existe al menos un error cargado.
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
	 * @return string
	 * @access public
	 */
	public function showErrors()
	{
		if (is_array($this->errors) === TRUE)
		{
			echo '<ul>';
            foreach ($this->errors as $err)
			{
				echo '<li>'.$err.'</li>';
			}
            echo '</ul>';
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
	 * Procesa la tabla para las consultas SQL
	 *
	 * @param string $tableAlias [opcional] alias de la tabla
	 * @return string
	 * @access public
	 */
	public function getTableSql($tableAlias = '')
	{
		$tableSql = $this->dbConn->nameQuote.$this->tableName.$this->dbConn->nameQuote;

		if (validateRequiredValue($tableAlias) === TRUE)
		{
			$tableSql.= ' '.$this->dbConn->nameQuote.$tableAlias.$this->dbConn->nameQuote;
		}

		return $tableSql;
	}

	/**
	 * Procesa el campo para las consultas SQL
	 *
	 * @param string $field campo a procesar
	 * @param string $tableAlias [opcional] alias de la tabla del campo
	 * @param string $fieldAlias [opcional] alias del campo
	 * @return string
	 * @access public
	 */
	public function getFieldSql($field, $tableAlias = '', $fieldAlias = '')
	{
		$fieldSql = $this->dbConn->nameQuote.$field.$this->dbConn->nameQuote;

		if (validateRequiredValue($tableAlias))
		{
			$fieldSql = $this->dbConn->nameQuote.$tableAlias.$this->dbConn->nameQuote.'.'.$fieldSql;
		}

		if (validateRequiredValue($fieldAlias))
		{
			$fieldSql.= ' AS '.$this->dbConn->nameQuote.$fieldAlias.$this->dbConn->nameQuote;
		}

		return $fieldSql;
	}

	/**
	 * Procesa el valor del campo para las consultas SQL
	 *
	 * @param string $value valor del campo a procesar
	 * @param string $wildcard [opcional] comodín utilizado en la consulta
	 * @return string
	 * @access public
	 */
	public function getValueSql($value, $wildcard = '')
	{
		if ($wildcard === '%%')
		{
			return $this->dbConn->Quote('%'.$value.'%');
		}
	        elseif ($wildcard === '%')
	        {
			return $this->dbConn->Quote($value.'%');
	        }
		else
		{
			return $this->dbConn->Quote($value);
		}
	}

}
?>