<?php
/**
 * Archivo php creado por O-creator
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla refund
 *
 * Esta clase se encarga de la administración de la tabla refund brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Crefund.php');
 * $refund = new Crefund();
 * $refund->setDbConn($dbConn);
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:17-10-2019
 */
class Crefund extends Cbase
{
	/**
	 * ID
	 *
	 * - Clave Primaria
	 * - Auto Increment: campo auto_increment
	 * - Campo en la base de datos: id
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * Ver también: {@link getId()}, {@link setId()}
	 * @var integer
	 * @access private
	 */
	private $id;

	/**
	 * Fecha
	 *
	 * - Campo en la base de datos: date_added
	 * - Tipo de campo en la base de datos: date
	 * - Campo requerido
	 * - Utiliza la clase {@link Cdate}
	 *
	 * Ver también: {@link getDateAdded()}, {@link setDateAdded()}
	 * @var string
	 * @access private
	 */
	private $dateAdded;

	/**
	 * Usuario
	 *
	 * - Clave Foránea
	 * - Campo en la base de datos: id_user_add
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 * - Campo requerido
	 *
	 * <b>Relación</b>
	 * Este campo es clave foránea a:
	 * - Tabla: {@link Cuser user}
	 * - Campo: {@link Cuser::$id id}
	 * - Campo que se muestra: {@link Cuser::$name name}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * Ver también: {@link getIdUserAdd()}, {@link setIdUserAdd()}
	 * @var integer
	 * @access private
	 */
	private $idUserAdd;

	/**
	 * Venta
	 *
	 * - Clave Foránea
	 * - Campo en la base de datos: id_sale
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 * - Campo requerido
	 *
	 * <b>Relación</b>
	 * Este campo es clave foránea a:
	 * - Tabla: {@link Csale sale}
	 * - Campo: {@link Csale::$id id}
	 * - Campo que se muestra: {@link Csale::$dateAdded dateAdded}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * Ver también: {@link getIdSale()}, {@link setIdSale()}
	 * @var integer
	 * @access private
	 */
	private $idSale;

	/**
	 * Motivo
	 *
	 * - Campo en la base de datos: reason
	 * - Tipo de campo en la base de datos: enum('faulty','various')
	 * - Campo requerido
	 *
	 * Ver también: {@link getReason()}, {@link setReason()}
	 * @var string
	 * @access private
	 */
	private $reason;

	/**
	 * Descripción
	 *
	 * - Campo en la base de datos: detail
	 * - Tipo de campo en la base de datos: text
	 *
	 * Ver también: {@link getDetail()}, {@link setDetail()}
	 * @var string
	 * @access private
	 */
	private $detail;

	/**
	 * Tipo
	 *
	 * - Campo en la base de datos: type
	 * - Tipo de campo en la base de datos: enum('cash','cta_cte')
	 *
	 * Ver también: {@link getType()}, {@link setType()}
	 * @var string
	 * @access private
	 */
	private $type;
	/**
	 * Monto
	 *
	 * - Campo en la base de datos: amount
	 * - Tipo de campo en la base de datos: decimal(10,2)
	 * - Extra: Decimal, positivo sin el cero [+] (ver {@link validateDecimalValue()})
	 * - Número de decimales: 2
	 * - Campo requerido
	 *
	 * Ver también: {@link getAmount()}, {@link setAmount()}
	 * @var float
	 * @access private
	 */
	private $amount;
	/**
	 * Constructor de la clase
	 *
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('refund');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Crefund.php');
	}

	/**
	 * Destructor de la clase
	 *
	 * @return void
	 */
	function __destruct()
	{
		parent::__destruct();
	}

	/**
	 * Setea el valor {@link $id ID}
	 *
	 * @param integer $id indica el valor ID
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setId($id, $gpc = FALSE)
	{
		if (validateRequiredValue($id) === FALSE)
		{
			$this->id = $id;
			$this->addError(CREFUND_SETID_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->id = setValue($id, $gpc);

			if (validateIntValue($this->id, '+') === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CREFUND_SETID_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $dateAdded Fecha}
	 *
	 * Setea el valor Fecha. Si el parámetro $dbFormat es TRUE se está indicando que el parámetro $dateAdded se encuentra en el formato de la base de datos,
	 * sino, se está indicando que se encuentra en el formato definido en el archivo de configuración del script (FORMAT_DATE).
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $refund = new Crefund();
	 * //seteo en el formato que acepta la base de datos (yyyy-mm-dd)
	 * $refund->setDateAdded('1980-11-24', TRUE);
	 * //seteo en el formato definido en la configuración del script (suponemos que el formato utilizado es dd-mm-yyyy)
	 * $refund->setDateAdded('24-11-1980', FALSE);
	 * ?>
	 * </code>
	 *
	 * @param string $dateAdded indica el valor Fecha
	 * @param boolean $dbFormat indica si el valor Fecha está dado en el formato de la base de datos
	 * @return boolean
	 * @access public
	 */
	public function setDateAdded($dateAdded, $dbFormat)
	{
		if (validateRequiredValue($dateAdded) === FALSE)
		{
			$this->dateAdded = $dateAdded;
			$this->addError(CREFUND_SETDATE_ADDED_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$oDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
			if ($dbFormat === TRUE)
			{
				if ($oDate->validateDate($dateAdded, 'db'))
				{
					$this->dateAdded = $dateAdded;

					return TRUE;
				}
				else
				{
					$this->dateAdded = '';
					$this->addError(CREFUND_SETDATE_ADDED_VALIDATE_VALUE);

					return FALSE;
				}
			}
			elseif ($dbFormat === FALSE)
			{
				if ($oDate->validateDate($dateAdded, 'str'))
				{
					$oDate->setStrDate($dateAdded);
					$this->dateAdded = $oDate->getDbDate();

					return TRUE;
				}
				else
				{
					$this->dateAdded = '';
					$this->addError(CREFUND_SETDATE_ADDED_VALIDATE_VALUE);

					return FALSE;
				}
			}
			else
			{
				$this->dateAdded = '';
				$this->addError(CREFUND_SETDATE_ADDED_ERROR);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $idUserAdd Usuario}
	 *
	 * @param integer $idUserAdd indica el valor Usuario
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdUserAdd($idUserAdd, $gpc = FALSE)
	{
		if (validateRequiredValue($idUserAdd) === FALSE)
		{
			$this->idUserAdd = $idUserAdd;
			$this->addError(CREFUND_SETID_USER_ADD_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->idUserAdd = setValue($idUserAdd, $gpc);

			if (validateIntValue($this->idUserAdd, '+') === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CREFUND_SETID_USER_ADD_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $idSale Venta}
	 *
	 * @param integer $idSale indica el valor Venta
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdSale($idSale, $gpc = FALSE)
	{
		if (validateRequiredValue($idSale) === FALSE)
		{
			$this->idSale = $idSale;
			$this->addError(CREFUND_SETID_SALE_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->idSale = setValue($idSale, $gpc);

			if (validateIntValue($this->idSale, '+') === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CREFUND_SETID_SALE_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $reason Motivo}
	 *
	 * @param string $reason indica el valor Motivo
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setReason($reason, $gpc = FALSE)
	{
		if (validateRequiredValue($reason) === FALSE)
		{
			$this->reason = $reason;
			$this->addError(CREFUND_SETREASON_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->reason = setValue($reason, $gpc);

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $detail Descripción}
	 *
	 * @param string $detail indica el valor Descripción
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setDetail($detail, $gpc = FALSE)
	{
		$this->detail = setValue($detail, $gpc);

		return TRUE;
	}

	/**
	 * Setea el valor {@link $type Tipo}
	 *
	 * @param string $type indica el valor Tipo
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setType($type, $gpc = FALSE)
	{
		$this->type = setValue($type, $gpc);
		return TRUE;
	}
	/**
	 * Setea el valor {@link $amount Monto}
	 *
	 * @param float $amount indica el valor Monto
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setAmount($amount, $gpc = FALSE)
	{
		if (validateRequiredValue($amount) === FALSE)
		{
			$this->amount = $amount;
			$this->addError(CREFUND_SETAMOUNT_REQUIRED_VALUE);
			return FALSE;
		}
		else
		{
			$this->amount = setValue($amount, $gpc);
			if (validateDecimalValue($this->amount, '+') === TRUE)
			{
				if (validateRequiredValue($amount) === TRUE)
				{
					$this->amount = numberFormat($amount, 2);
				}
				return TRUE;
			}
			else
			{
				$this->addError(CREFUND_SETAMOUNT_VALIDATE_VALUE);
				return FALSE;
			}
		}
	}
	/**
	 * Devuelve el valor {@link $id ID}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getId($htmlEntities = TRUE)
	{
		return getValue($this->id, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $dateAdded Fecha}
	 *
	 * Devuelve el valor Fecha de acuerdo al valor del parámetro $dbFormat.
	 * Si $dbFormat es TRUE devuelve el valor en el formato que acepte la base de datos, sino, lo devuelve en el formato definido en el archivo de configuración del script (FORMAT_DATE).
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $refund = new Crefund();
	 * $refund->setDateAdded('1980-11-24', TRUE);
	 * echo 'Fecha en formato del script: ';
	 * echo $refund->getDateAdded().'<br />';
	 * echo 'Fecha en el formato que acepta la base de datos: ';
	 * echo $refund->getDateAdded(TRUE).'<br />';
	 * ?>
	 * </code>
	 *
	 * @param boolean $dbFormat [opcional] indica si el valor Fecha se devuelve en el formato que acepta la base de datos
	 * @return string
	 * @access public
	 */
	public function getDateAdded($dbFormat = FALSE)
	{
		if ($dbFormat === TRUE)
		{
			return $this->dateAdded;
		}
		else
		{
			$oDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
			$oDate->setDbDate($this->dateAdded);

			return $oDate->getStrDate();
		}
	}

	/**
	 * Devuelve el valor {@link $idUserAdd Usuario}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdUserAdd($htmlEntities = TRUE)
	{
		return getValue($this->idUserAdd, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $idSale Venta}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdSale($htmlEntities = TRUE)
	{
		return getValue($this->idSale, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $reason Motivo}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getReason($htmlEntities = TRUE)
	{
		return getValue($this->reason, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve la descripción de los valores de {@link $reason Motivo}
	 *
	 * @param string $reason indica el valor Motivo
	 * @return string
	 * @access public
	 */
	public function getValuesReason($reason)
	{
		switch ($reason)
		{
			case 'faulty':
				return CREFUND_GET_VALUES_REASON_VALUE_1;
				break;

			case 'various':
				return CREFUND_GET_VALUES_REASON_VALUE_2;
				break;

			default:
				return '&nbsp;';
		}
	}

	/**
	 * Devuelve el valor {@link $detail Descripción}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getDetail($htmlEntities = TRUE)
	{
		return getValue($this->detail, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $type Tipo}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getType($htmlEntities = TRUE)
	{
		return getValue($this->type, $htmlEntities, $this->getCharset());
	}
	/**
	 * Devuelve la descripción de los valores de {@link $type Tipo}
	 *
	 * @param string $type indica el valor Tipo
	 * @return string
	 * @access public
	 */
	public function getValuesType($type)
	{
		switch ($type)
		{
			case 'cash':
				return CREFUND_GET_VALUES_TYPE_VALUE_1;
				break;
			case 'cta_cte':
				return CREFUND_GET_VALUES_TYPE_VALUE_2;
				break;
			default:
				return '&nbsp;';
		}
	}
	/**
	 * Devuelve el valor {@link $amount Monto}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return float
	 * @access public
	 */
	public function getAmount($htmlEntities = TRUE)
	{
		return getValue($this->amount, $htmlEntities, $this->getCharset());
	}
	/**
	 * Inserta un nuevo registro en la tabla refund
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"INSERT INTO `tabla` (`campo1`, `campo2`) VALUES ('valor1', 'valor2')"</b>.
	 * Para armar la consulta sólo tiene en cuenta los campos que están seteados. Devuelve TRUE si se pudo insertar el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link addForm()}
	 * @return boolean
	 * @access public
	 */
	public function add()
	{
		$fields = array();
		$values = array();

		if (isset($this->id) === TRUE)
		{
			$fields[] = $this->getFieldSql('id');
			$values[] = $this->getValueSql($this->id);
		}

		if (isset($this->dateAdded) === TRUE)
		{
			$fields[] = $this->getFieldSql('date_added');
			$values[] = $this->getValueSql($this->dateAdded);
		}

		if (isset($this->idUserAdd) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_user_add');

			if (validateRequiredValue($this->idUserAdd) === FALSE)
			{
				$values[] = 'NULL';
			}
			else
			{
				$values[] = $this->getValueSql($this->idUserAdd);
			}
		}

		if (isset($this->idSale) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_sale');

			if (validateRequiredValue($this->idSale) === FALSE)
			{
				$values[] = 'NULL';
			}
			else
			{
				$values[] = $this->getValueSql($this->idSale);
			}
		}

		if (isset($this->reason) === TRUE)
		{
			$fields[] = $this->getFieldSql('reason');
			$values[] = $this->getValueSql($this->reason);
		}

		if (isset($this->detail) === TRUE)
		{
			$fields[] = $this->getFieldSql('detail');
			$values[] = $this->getValueSql($this->detail);
		}
		if (isset($this->type) === TRUE)
		{
			$fields[] = $this->getFieldSql('type');
			$values[] = $this->getValueSql($this->type);
		}
		if (isset($this->amount) === TRUE)
		{
			$fields[] = $this->getFieldSql('amount');
			if (validateRequiredValue($this->amount) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->amount);
			}
		}

		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CREFUND_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla refund
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"UPDATE `tabla` SET `campo1` = 'valor1', `campo2` = 'valor2' WHERE `id_tabla` = '1'"</b>.
	 * Para armar la consulta sólo tiene en cuenta los campos que están seteados. Debe estar seteada la clave primaria del registro que se quiere modificar. Devuelve TRUE si se pudo modificar el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link updateForm()}
	 * @return boolean
	 * @access public
	 */
	public function update()
	{
		if (validateRequiredValue($this->id) === TRUE)
		{
			$values = array();

			if (isset($this->dateAdded) === TRUE)
			{
				$values[] = $this->getFieldSql('date_added').' = '.$this->getValueSql($this->dateAdded);
			}

			if (isset($this->idUserAdd) === TRUE)
			{
				if (validateRequiredValue($this->idUserAdd) === FALSE)
				{
					$values[] = $this->getFieldSql('id_user_add').' = NULL';
				}
				else
				{
					$values[] = $this->getFieldSql('id_user_add').' = '.$this->getValueSql($this->idUserAdd);
				}
			}

			if (isset($this->idSale) === TRUE)
			{
				if (validateRequiredValue($this->idSale) === FALSE)
				{
					$values[] = $this->getFieldSql('id_sale').' = NULL';
				}
				else
				{
					$values[] = $this->getFieldSql('id_sale').' = '.$this->getValueSql($this->idSale);
				}
			}

			if (isset($this->reason) === TRUE)
			{
				$values[] = $this->getFieldSql('reason').' = '.$this->getValueSql($this->reason);
			}

			if (isset($this->detail) === TRUE)
			{
				$values[] = $this->getFieldSql('detail').' = '.$this->getValueSql($this->detail);
			}
			if (isset($this->type) === TRUE)
			{
				$values[] = $this->getFieldSql('type').' = '.$this->getValueSql($this->type);
			}
			if (isset($this->amount) === TRUE)
			{
				if (validateRequiredValue($this->amount) === FALSE)
				{
					$values[] = $this->getFieldSql('amount').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('amount').' = '.$this->getValueSql($this->amount);
				}
			}

			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CREFUND_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CREFUND_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla refund
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"DELETE FROM `tabla` WHERE id_tabla = '1'"</b>.
	 * Para poder eliminar el registro debe estar seteada la clave primaria de la tabla. Devuelve TRUE si se pudo eliminar el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link delForm()}
	 * @return boolean
	 * @access public
	 */
	public function del()
	{
		if (validateRequiredValue($this->id) === TRUE)
		{
			$sql = 'DELETE FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CREFUND_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CREFUND_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla refund
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"SELECT * FROM `tabla` WHERE id_tabla = '1'"</b>.
	 * Debe estar seteada la clave primaria del registro que se quiere obtener. Devuelve TRUE si se pudo obtener el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link showData()}
	 * @return boolean
	 * @access public
	 */
	public function getData()
	{
		if (validateRequiredValue($this->id) === TRUE)
		{
			$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			$row = $this->getDbConn()->GetRow($sql);

			if (is_array($row) === TRUE and count($row) > 0)
			{
				$this->setId($row['id']);
				$this->setDateAdded($row['date_added'], TRUE);
				$this->setIdUserAdd($row['id_user_add']);
				$this->setIdSale($row['id_sale']);
				$this->setReason($row['reason']);
				$this->setDetail($row['detail']);
				$this->setType($row['type']);
				$this->setAmount($row['amount']);

				return TRUE;
			}
			else
			{
				$this->addError(CREFUND_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CREFUND_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un conjunto de registros de la tabla refund
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"SELECT * FROM `tabla`"</b>.
	 * Devuelve los registros obtenidos en un array asociativo usando los nombres de los campos como clave en formato lowerCamelCase.
	 *
	 * Ver también: {@link searchForm()}, {@link showQuery()}
	 * @param string $search [opcional] condición de búsqueda para filtrar el resultado obtenido (se agrega al WHERE de la consulta)
	 * @param integer $numRows [opcional] indica la cantidad de registros a obtener en el array de resultado
	 * @param integer $offset [opcional] indica el registro de la consulta por el que empezar a obtener el array de resultado
	 * @param string $order [opcional] indica el orden en el que se obtienen los registros (cláusula ORDER BY de la consulta)
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return array|boolean
	 * @access public
	 */
	public function getList($search = '', $numRows = 0, $offset = 0, $order = '', $htmlEntities = TRUE)
	{
		$oIdUserAdd = new Cuser();
		$oIdUserAdd->setDbConn($this->getDbConn());

		$oIdSale = new Csale();
		$oIdSale->setDbConn($this->getDbConn());

		$sql = 'SELECT ';
		$sql.= $this->getFieldSql('id', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('date_added', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_user_add', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_sale', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('reason', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('detail', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('type', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('amount', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id', $oIdUserAdd->getTableName(), 'user_id');
		$sql.= ', '.$this->getFieldSql('user', $oIdUserAdd->getTableName(), 'user_user');
		$sql.= ', '.$this->getFieldSql('pass', $oIdUserAdd->getTableName(), 'user_pass');
		$sql.= ', '.$this->getFieldSql('id_group', $oIdUserAdd->getTableName(), 'user_id_group');
		$sql.= ', '.$this->getFieldSql('active', $oIdUserAdd->getTableName(), 'user_active');
		$sql.= ', '.$this->getFieldSql('token', $oIdUserAdd->getTableName(), 'user_token');
		$sql.= ', '.$this->getFieldSql('name', $oIdUserAdd->getTableName(), 'user_name');
		$sql.= ', '.$this->getFieldSql('lastname', $oIdUserAdd->getTableName(), 'user_lastname');
		$sql.= ', '.$this->getFieldSql('email', $oIdUserAdd->getTableName(), 'user_email');
		$sql.= ', '.$this->getFieldSql('id_provider', $oIdUserAdd->getTableName(), 'user_id_provider');
		$sql.= ', '.$this->getFieldSql('id', $oIdSale->getTableName(), 'sale_id');
		$sql.= ', '.$this->getFieldSql('date_added', $oIdSale->getTableName(), 'sale_date_added');
		$sql.= ', '.$this->getFieldSql('total_amount_gross', $oIdSale->getTableName(), 'sale_total_amount_gross');
		$sql.= ', '.$this->getFieldSql('discount', $oIdSale->getTableName(), 'sale_discount');
		$sql.= ', '.$this->getFieldSql('total_amount_net', $oIdSale->getTableName(), 'sale_total_amount_net');
		$sql.= ', '.$this->getFieldSql('id_user_add', $oIdSale->getTableName(), 'sale_id_user_add');
		$sql.= ', '.$this->getFieldSql('id_client', $oIdSale->getTableName(), 'sale_id_client');
		$sql.= ', '.$this->getFieldSql('casual_customer', $oIdSale->getTableName(), 'sale_casual_customer');
		$sql.= ' FROM '.$this->getTableSql();
		$sql.= ' LEFT JOIN '.$oIdUserAdd->getTableSql().' ON '.$this->getFieldSql('id_user_add', $this->getTableName()).' = '.$oIdUserAdd->getFieldSql('id', $oIdUserAdd->getTableName());
		$sql.= ' LEFT JOIN '.$oIdSale->getTableSql().' ON '.$this->getFieldSql('id_sale', $this->getTableName()).' = '.$oIdSale->getFieldSql('id', $oIdSale->getTableName());
		$sql.= ' WHERE true';

		if (validateRequiredValue($search) === TRUE)
		{
			$sql.= ' AND '.$search;
		}

		if (validateRequiredValue($order) === TRUE)
		{
			$sql.= ' ORDER BY '.$order;
		}

		$rs = $this->getDbConn()->Execute($sql);

		if ($rs !== FALSE)
		{
			$this->setTotalList($rs->RecordCount());

			settype ($numRows, 'integer');
			settype ($offset, 'integer');

			if ($numRows > 0)
			{
				$rs = $this->getDbConn()->SelectLimit($sql, $numRows, $offset);
			}

			if ($rs === FALSE)
			{
				$this->addError(CREFUND_GETLIST_ERROR);

				return FALSE;
			}
			else
			{
				settype ($htmlEntities, 'boolean');

				$list = array();

				$this->setTotalQuery($rs->RecordCount());

				while (!$rs->EOF)
				{
					$this->setId($rs->fields['id']);
					$this->setDateAdded($rs->fields['date_added'], TRUE);
					$this->setIdUserAdd($rs->fields['id_user_add']);
					$this->setIdSale($rs->fields['id_sale']);
					$this->setReason($rs->fields['reason']);
					$this->setDetail($rs->fields['detail']);
					$this->setType($rs->fields['type']);
					$this->setAmount($rs->fields['amount']);

					$oIdUserAdd->setName($rs->fields['user_name']);
					$oIdSale->setDateAdded($rs->fields['sale_date_added'], TRUE);

					$list[] = array(
						'id' => $this->getId($htmlEntities) ,
						'dateAdded' => $this->getDateAdded() ,
						'idUserAdd' => $this->getIdUserAdd($htmlEntities) ,
						'idSale' => $this->getIdSale($htmlEntities) ,
						'reason' => $this->getReason($htmlEntities) ,
						'detail' => $this->getDetail($htmlEntities) ,
						'type' => $this->getType($htmlEntities) ,
						'amount' => $this->getAmount($htmlEntities) ,
						'userName' => $oIdUserAdd->getName($htmlEntities) ,
						'saleDateAdded' => $oIdSale->getDateAdded()
					);

					$rs->MoveNext();
				}

				$this->id = NULL;
				$this->dateAdded = NULL;
				$this->idUserAdd = NULL;
				$this->idSale = NULL;
				$this->reason = NULL;
				$this->detail = NULL;
				$this->type = NULL;
				$this->amount = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CREFUND_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}

	/**
	 * Devuelve el último valor ID insertado en la tabla refund
	 *
	 * @return integer|boolean
	 * @access public
	 */
	public function getLastId()
	{
		$sql = 'SELECT MAX('.$this->getFieldSql('id').') AS '.$this->getFieldSql('id').' FROM '.$this->getTableSql();

		$row = $this->getDbConn()->GetRow($sql);

		if ($row === FALSE)
		{
			$this->addError(CREFUND_GET_LAST_ID_ERROR);

			return FALSE;
		}
		else
		{
			return $row['id'];
		}
	}

	/**
	 * Muestra un formulario para dar de alta un registro de la tabla refund
	 *
	 * Este método muestra un formulario para dar de alta un registro de la tabla refund mostrando sólo los campos seteados en el parámetro $fields.
	 *
	 * Ver también: {@link add()}, {@link updateForm()}
	 * @param string $fields [opcional] cadena con los campos (separados con comas) que se van a mostrar en el formulario. Ej: "campo1,campo2,campo3, ... ,campoN"
	 * @param string $href [opcional] indica la página a la que se redirecciona cuando se cancela el formulario o cuando el registro es insertado en forma correcta
	 * @param boolean $autoRedirect [opcional] indica si se debe auto redireccionar a la página definida en $href una vez que se insertó en forma correcta el registro
	 * @param string $title [opcional] título
	 * @return mixed
	 * @access public
	 */
	public function addForm($fields = '', $href = '', $autoRedirect = FALSE, $title = '')
	{
		if (validateRequiredValue($fields) === FALSE)
		{
			$fields = 'id,dateAdded,idUserAdd,idSale,reason,detail,type,amount';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['addRefund']) === FALSE)
		{
			$_POST['addRefund'] = '';
		}
		if (isset($_POST['productsRefundGroup']) === FALSE)
		{
		    $_POST['productsRefundGroup'] = '';
		}

		if ($_POST['addRefund'] == 'add')
		{
		    $sale           = new Csale($this->getDbConn());
		    $product        = new Cproduct($this->getDbConn());
		    $detail         = new Cdetail($this->getDbConn());
		    $detailRefund   = new Cdetail_refund($this->getDbConn());
		    $movement       = new Cmovement($this->getDbConn());

			if (in_array('dateAdded', $arrayFields) === TRUE)
			{
				$this->setDateAdded($_POST['dateAdded'], FALSE);
			}
			/*Siempre es el usuario actual*/
			$this->setIdUserAdd($_SESSION['userId'], TRUE);
			if (in_array('idSale', $arrayFields) === TRUE)
			{
				$this->setIdSale($_POST['idSale'], TRUE);

				$sale->setId($this->getIdSale(FALSE));
				if($sale->getData() == FALSE)
				{
				    $this->addError(CREFUND_ADD_FORM_SALE_NOT_FOUND);
				}
			}
			if (in_array('reason', $arrayFields) === TRUE)
			{
				$this->setReason($_POST['reason'], TRUE);
			}
			if (in_array('detail', $arrayFields) === TRUE)
			{
				$this->setDetail($_POST['detail'], TRUE);
			}
			if (in_array('type', $arrayFields) === TRUE)
			{
				$this->setType($_POST['type'], TRUE);
			}
			/*Calculo el amount debajo
			if (in_array('amount', $arrayFields) === TRUE)
			{
				$this->setAmount($_POST['amount'], TRUE);
			}*/

			if($this->getType() == 'cta_cte' and empty($sale->getIdClient(FALSE)) == TRUE)
			{
			    $this->addError(CREFUND_ADD_FORM_CTA_CTE_MUST_BE_CLIENT);
			}

			if(empty($_POST['productsRefundGroup']) == TRUE or is_array($_POST['productsRefundGroup']) == FALSE or count($_POST['productsRefundGroup']) <= 0)
			{
			    $this->addError(CREFUND_ADD_FORM_REQUIRED_DETAIL);
			}

			if ($this->error() === FALSE)
			{
				$this->add();

				$idRefund = $this->getLastId();

				$detailRefund->setIdRefund($idRefund);

			    $auxAmount = 0;

				//1) Movimiento para devolverle el dinero al Cliente
			    $movement->setDateAdded($this->getDateAdded(TRUE), TRUE);
			    if(empty($sale->getIdClient(FALSE)) == FALSE)
			    {
				    $movement->setIdClient($sale->getIdClient(FALSE));
			    }
				$movement->setIdSale($sale->getId(FALSE));
				$movement->setDescription(CREFUND_ADD_DETAIL_MOVEMENT_DESCRIPTION.' '.$idRefund);
				$movement->setIdRefund($idRefund);
				$movement->setIdUserAdd($_SESSION['userId'], TRUE);

				if($this->getType() == 'cash')
				{
				    $movement->setTypePay('cash');
				    $movement->setTypeMovement('payment_to_provider');
				}
				else
				{
				    $movement->setTypePay('cta_cte');
				    $movement->setTypeMovement('add_cta_cte');
				}
				$movement->autoSetType();

				foreach ($_POST['productsRefundGroup'] as $val)
				{
				    $product->setId($val);

				    if($product->getData() == TRUE)
				    {
    				    $amounPayed = 0;
    				    //Calculo el porcentaje del producto respecto del total
				        $detail->setIdProduct($product->getId(FALSE));
    				    $detail->setIdSale($this->getIdSale(FALSE));
    				    if($detail->getData() == TRUE)
    				    {
    				        $amounPayed = ($sale->getTotalAmountNet() * (($detail->getAmount() * 100) / $sale->getTotalAmountGross())) / 100;
                            $auxAmount += $amounPayed;
    				    }

    				    $detailRefund->setIdProduct($product->getId(FALSE));
    				    $detailRefund->setAmount($amounPayed);
    				    $detailRefund->add();

    				    if($product->getStatus() == 'paid_out')
    				    {
    				        //2) Si ya le pagué al proveedor el producto debo sacarselo de su cta cte.
    				        $movement2 = new Cmovement($this->getDbConn());

    				        $movement2->setDateAdded($this->getDateAdded(TRUE), TRUE);
    				        $movement2->setIdProvider($product->getIdProvider(FALSE));
    				        $movement2->setIdSale($sale->getId(FALSE));
    				        $movement2->setDescription(CREFUND_ADD_DETAIL_MOVEMENT_DESCRIPTION.' '.$idRefund);
    				        $movement2->setTypePay('cta_cte');
    				        $movement2->setTypeMovement('del_cta_cte');
    				        $movement2->setIdUserAdd($_SESSION['userId'], TRUE);
    				        $movement2->setIdRefund($idRefund);
    				        $movement2->autoSetType();


    				        $detailPayment = new Cdetail_payment($this->getDbConn());
    				        $searchPayment = $detailPayment->getFieldSql('id_product', $detailPayment->getTableName()).' = '.$detailPayment->getValueSql($product->getId(FALSE));
    				        $orderPayment  = $detailPayment->getFieldSql('id_payment', $detailPayment->getTableName()).' DESC';
    				        $rsPayment     = $detailPayment->getList($searchPayment, 1, 0, $orderPayment, FALSE);

    				        if ($detailPayment->getTotalList() > 0)
    				        {
    				            foreach ($rsPayment as $item)
    				            {
    				                $movement2->setAmount($item['amount']);
    				            }
    				        }

    				        $movement2->add();
    				    }

                        if($this->getReason() == 'faulty')
                        {
                            $detailRefund->uptateProductStatus($product->getId(FALSE), 'give_back', $this->getDateAdded(TRUE));
                        }
                        else
                        {
                            $detailRefund->uptateProductStatus($product->getId(FALSE), 'exhibited', $this->getDateAdded(TRUE));
                        }
				    }
				}

				//Le agrego a la devolución el monto
				$this->setId($idRefund);
				$this->setAmount($auxAmount);
				$this->update();

				$movement->setAmount($auxAmount);
				$movement->add();

			}

			if ($this->error() === FALSE)
			{
				if ($autoRedirect === TRUE and validateRequiredValue($href) === TRUE)
				{
				?>
			<script>
				location.href = '<?php echo $href; ?>';
			</script>
				<?php
				}
				?>
			<div class="form add">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<div class="fields">
					<div class="message success"><?php echo CREFUND_ADD_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CREFUND_ADD_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="success" />
				<?php
				}
				?>
				</div>
				<div class="bottom"></div>
			</div>
			<?php
			}
			else
			{
			?>
			<div class="form add">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<form name="formAddRefund" id="formAddRefund" method="post" action="">
				<input name="addRefund" type="hidden" id="addRefund" value="back" />
				<div class="fields">
				<?php
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					echo '<input name="dateAdded" type="hidden" id="dateAdded" value="'.$this->getDateAdded().'" />';
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					echo '<input name="idUserAdd" type="hidden" id="idUserAdd" value="'.$this->getIdUserAdd().'" />';
				}
				if (in_array('idSale', $arrayFields) === TRUE)
				{
					echo '<input name="idSale" type="hidden" id="idSale" value="'.$this->getIdSale().'" />';
				}
				if (in_array('reason', $arrayFields) === TRUE)
				{
					echo '<input name="reason" type="hidden" id="reason" value="'.$this->getReason().'" />';
				}
				if (in_array('detail', $arrayFields) === TRUE)
				{
					echo '<input name="detail" type="hidden" id="detail" value="'.$this->getDetail().'" />';
				}
				if (in_array('type', $arrayFields) === TRUE)
				{
					echo '<input name="type" type="hidden" id="type" value="'.$this->getType().'" />';
				}
				if (in_array('amount', $arrayFields) === TRUE)
				{
					echo '<input name="amount" type="hidden" id="amount" value="'.$this->getAmount().'" />';
				}
				if(is_array($_POST['productsRefundGroup']) == TRUE and count($_POST['productsRefundGroup']) > 0)
				{
				    echo '<input name="productsRefundGroup" type="hidden" id="productsRefundGroup" value="'.implode(',', $_POST['productsRefundGroup']).'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CREFUND_ADD_FORM_BACK_BTN; ?>" class="back" />
				</div>
				</form>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
		else
		{
			if ($_POST['addRefund'] == 'back')
			{
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					$this->setDateAdded($_POST['dateAdded'], FALSE);
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
				}
				if (in_array('idSale', $arrayFields) === TRUE)
				{
					$this->setIdSale($_POST['idSale'], TRUE);
				}
				if (in_array('reason', $arrayFields) === TRUE)
				{
					$this->setReason($_POST['reason'], TRUE);
				}
				if (in_array('detail', $arrayFields) === TRUE)
				{
					$this->setDetail($_POST['detail'], TRUE);
				}
				if (in_array('type', $arrayFields) === TRUE)
				{
					$this->setType($_POST['type'], TRUE);
				}
				if (in_array('amount', $arrayFields) === TRUE)
				{
					$this->setAmount($_POST['amount'], TRUE);
				}
				if(empty($_POST['productsRefundGroup']) == FALSE)
				{
				    $_POST['productsRefundGroup'] = explode(',',$_POST['productsRefundGroup']);
				}

			}
			else
			{
			    $this->setDateAdded(date(FORMAT_DATE), FALSE);
			    $this->setReason('various');
			    $this->setType('cta_cte');
			}
			$oDateInfo = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
			?>
			<div class="form add">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<form name="formAddRefund" id="formAddRefund" method="post" action="">
				<input name="addRefund" type="hidden" id="addRefund" value="add" />
				<div class="fields">
			<?php
			foreach ($arrayFields as $value)
			{
				if ($value == 'dateAdded')
				{
				?>
					<div class="field">
						<label><?php echo CREFUND_ADD_FORM_LABEL_FIELD_DATE_ADDED; ?> <span>*</span></label>
						<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
				<?php
				}
				if ($value == 'idUserAdd')
				{
				?>
					<div class="field">
						<label><?php echo CREFUND_ADD_FORM_LABEL_FIELD_ID_USER_ADD; ?> <span>*</span></label>
					<?php
					$oIdUserAdd = new Cuser();
					$oIdUserAdd->setDbConn($this->getDbConn());
					$oIdUserAdd->showList('name', 'name', $this->getIdUserAdd(), 'idUserAdd', 'idUserAdd', 'select');
					?>
					</div>
				<?php
				}
				if ($value == 'idSale')
				{
				    ?>
					<input name="idSale" type="hidden" id="idSale" value="<?php echo $_GET['id']; ?>" />
					<?php
				}
				if ($value == 'reason')
				{
				?>
					<div class="field">
						<label><?php echo CREFUND_ADD_FORM_LABEL_FIELD_REASON; ?> <span>*</span></label>
						<select name="reason" id="reason">
							<option value=""></option>
							<option value="faulty" <?php if ($this->getReason() == 'faulty') echo 'selected="selected"' ?>><?php echo $this->getValuesReason('faulty'); ?></option>
							<option value="various" <?php if ($this->getReason() == 'various') echo 'selected="selected"' ?>><?php echo $this->getValuesReason('various'); ?></option>
						</select>
					</div>
				<?php
				}
				if ($value == 'detail')
				{
				?>
					<div class="field">
						<label><?php echo CREFUND_ADD_FORM_LABEL_FIELD_DETAIL; ?></label>
						<textarea name="detail" id="detail"><?php echo $this->getDetail(); ?></textarea>
					</div>
				<?php
				}
				if ($value == 'type')
				{
				?>
					<div class="field">
						<label><?php echo CREFUND_ADD_FORM_LABEL_FIELD_TYPE; ?></label>
						<select name="type" id="type">
							<option value=""></option>
							<option value="cash" <?php if ($this->getType() == 'cash') echo 'selected="selected"' ?>><?php echo $this->getValuesType('cash'); ?></option>
							<option value="cta_cte" <?php if ($this->getType() == 'cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesType('cta_cte'); ?></option>
						</select>
					</div>
				<?php
				}
				if ($value == 'amount')
				{
				?>
					<div class="field">
						<label><?php echo CREFUND_ADD_FORM_LABEL_FIELD_AMOUNT; ?> <span>*</span></label>
						<input name="amount" type="text" id="amount" value="<?php echo $this->getAmount(); ?>" class="num" />
					</div>
				<?php
				}
			}
			?>
				</div>
				<?php
				$product = new Cproduct();
				$product->setDbConn($this->getDbConn());
				$product->showSaleProductTable($_GET['id'], $_POST['productsRefundGroup']);
				?>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CREFUND_ADD_FORM_SUBMIT_BTN; ?>" class="accept" />
        			<?php
        			if (validateRequiredValue($href) === TRUE)
        			{
        			?>
        					<input type="button" value="<?php echo CREFUND_ADD_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
        			<?php
        			}
        			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CREFUND_ADD_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Muestra un formulario para actualizar un registro existente de la tabla refund
	 *
	 * Este método muestra un formulario para actualizar un registro de la tabla refund mostrando sólo los campos seteados en el parámetro $fields.
	 * Debe estar seteada la clave primaria del registro que se quiere modificar.
	 *
	 * Ver también: {@link update()}, {@link addForm()}
	 * @param string $fields [opcional] cadena con los campos (separados con comas) que se van a mostrar en el formulario. Ej: "campo1,campo2,campo3, ... ,campoN"
	 * @param string $href [opcional] indica la página a la que se redirecciona cuando se cancela el formulario o cuando el registro es modificado en forma correcta
	 * @param boolean $autoRedirect [opcional] indica si se debe auto redireccionar a la página definida en $href una vez que se modificó en forma correcta el registro
	 * @param string $title [opcional] título
	 * @return mixed
	 * @access public
	 */
    public function updateForm($fields = '', $href = '', $autoRedirect = FALSE, $title = '')
	{
	    if (validateRequiredValue($fields) === FALSE)
	    {
	        $fields = 'id,dateAdded,idUserAdd,idSale,reason,detail,type,amount';
	    }

	    $arrayFields = explode(',', $fields);
	    foreach ($arrayFields as $key => $value)
	    {
	        $arrayFields[$key] = trim($value);
	    }

	    if (isset($_POST['updateRefund']) === FALSE)
	    {
	        $_POST['updateRefund'] = '';
	    }

	    if (isset($_POST['productsRefundGroup']) === FALSE)
	    {
	        $_POST['productsRefundGroup'] = '';
	    }

	    if (isset($_GET['p']) === FALSE)
	    {
	        $_GET['p'] = '';
	    }

	    if ($_POST['updateRefund'] == 'update')
	    {
	        $this->setId($_POST['id'], TRUE);

	        $sale           = new Csale($this->getDbConn());
	        $product        = new Cproduct($this->getDbConn());
	        $detail         = new Cdetail($this->getDbConn());
	        $detailRefund   = new Cdetail_refund($this->getDbConn());
	        $movement       = new Cmovement($this->getDbConn());
	        if (in_array('dateAdded', $arrayFields) === TRUE)
	        {
	            $this->setDateAdded($_POST['dateAdded'], FALSE);
	        }
	        if (in_array('idSale', $arrayFields) === TRUE)
	        {
	            $this->setIdSale($_POST['idSale'], TRUE);
	            $sale->setId($this->getIdSale(FALSE));
	            if($sale->getData() == FALSE)
	            {
	                $this->addError(CREFUND_ADD_FORM_SALE_NOT_FOUND);
	            }
	        }
	        if (in_array('reason', $arrayFields) === TRUE)
	        {
	            $this->setReason($_POST['reason'], TRUE);
	        }
	        if (in_array('detail', $arrayFields) === TRUE)
	        {
	            $this->setDetail($_POST['detail'], TRUE);
	        }
	        if (in_array('type', $arrayFields) === TRUE)
	        {
	            $this->setType($_POST['type'], TRUE);
	        }
	        /*Calculo el amount debajo
	         if (in_array('amount', $arrayFields) === TRUE)
	         {
	         $this->setAmount($_POST['amount'], TRUE);
	         }*/
	        if($this->getType() == 'cta_cte' and empty($sale->getIdClient(FALSE)) == TRUE)
	        {
	            $this->addError(CREFUND_ADD_FORM_CTA_CTE_MUST_BE_CLIENT);
	        }
	        if(empty($_POST['productsRefundGroup']) == TRUE or is_array($_POST['productsRefundGroup']) == FALSE or count($_POST['productsRefundGroup']) <= 0)
	        {
	            $this->addError(CREFUND_ADD_FORM_REQUIRED_DETAIL);
	        }
	        if ($this->error() === FALSE)
	        {
	            $this->update();
	            $idRefund = $this->getId(FALSE);
	            $detailRefund->setIdRefund($idRefund);
	            $auxAmount = 0;

	            //1) Movimiento para devolverle el dinero al Cliente
	            $movement->setDateAdded($this->getDateAdded(TRUE), TRUE);
	            if(empty($sale->getIdClient(FALSE)) == FALSE)
	            {
	                $movement->setIdClient($sale->getIdClient(FALSE));
	            }
	            $movement->setIdSale($sale->getId(FALSE));
	            $movement->setDescription(CREFUND_ADD_DETAIL_MOVEMENT_DESCRIPTION.' '.$idRefund);
	            $movement->setIdRefund($idRefund);
	            $movement->setIdUserAdd($_SESSION['userId'], TRUE);

	            if($this->getType() == 'cash')
	            {
	                $movement->setTypePay('cash');
	                $movement->setTypeMovement('payment_to_provider');
	            }
	            else
	            {
	                $movement->setTypePay('cta_cte');
	                $movement->setTypeMovement('add_cta_cte');
	            }

	            $movement->autoSetType();

	            foreach ($_POST['productsRefundGroup'] as $val)
	            {
	                $product->setId($val);
	                if($product->getData() == TRUE)
	                {
	                    $amounPayed = 0;
	                    //Calculo el porcentaje del producto respecto del total
	                    $detail->setIdProduct($product->getId(FALSE));
	                    $detail->setIdSale($this->getIdSale(FALSE));
	                    if($detail->getData() == TRUE)
	                    {
	                        $amounPayed = ($sale->getTotalAmountNet() * (($detail->getAmount() * 100) / $sale->getTotalAmountGross())) / 100;
	                        $auxAmount += $amounPayed;
	                    }
	                    $detailRefund->setIdProduct($product->getId(FALSE));
	                    $detailRefund->setAmount($amounPayed);
	                    $detailRefund->add();
	                    if($product->getStatus() == 'paid_out')
	                    {
	                        //2) Si ya le pagué al proveedor el producto debo sacarselo de su cta cte.
	                        $movement2 = new Cmovement($this->getDbConn());
	                        $movement2->setDateAdded($this->getDateAdded(TRUE), TRUE);
	                        $movement2->setIdProvider($product->getIdProvider(FALSE));
	                        $movement2->setIdSale($sale->getId(FALSE));
	                        $movement2->setDescription(CREFUND_ADD_DETAIL_MOVEMENT_DESCRIPTION.' '.$idRefund);
	                        $movement2->setTypePay('cta_cte');
	                        $movement2->setTypeMovement('del_cta_cte');
	                        $movement2->setIdUserAdd($_SESSION['userId'], TRUE);
	                        $movement2->setIdRefund($idRefund);
	                        $movement2->autoSetType();
	                        $detailPayment = new Cdetail_payment($this->getDbConn());
	                        $searchPayment = $detailPayment->getFieldSql('id_product', $detailPayment->getTableName()).' = '.$detailPayment->getValueSql($product->getId(FALSE));
	                        $orderPayment  = $detailPayment->getFieldSql('id_payment', $detailPayment->getTableName()).' DESC';
	                        $rsPayment     = $detailPayment->getList($searchPayment, 1, 0, $orderPayment, FALSE);
	                        if ($detailPayment->getTotalList() > 0)
	                        {
	                            foreach ($rsPayment as $item)
	                            {
	                                $movement2->setAmount($item['amount']);
	                            }
	                        }
	                        $movement2->add();
	                    }
	                    if($this->getReason() == 'faulty')
	                    {
	                        $detailRefund->uptateProductStatus($product->getId(FALSE), 'give_back', $this->getDateAdded(TRUE));
	                    }
	                    else
	                    {
	                        $detailRefund->uptateProductStatus($product->getId(FALSE), 'exhibited', $this->getDateAdded(TRUE));
	                    }
	                }
	            }
	            //Le agrego a la devolución el monto
	            $this->setId($idRefund);
	            $this->setAmount($auxAmount);
	            $this->update();
	            $movement->setAmount($auxAmount);
	            $movement->add();
	        }

	        if ($this->error() === FALSE)
	        {
	            if ($autoRedirect === TRUE and validateRequiredValue($href) === TRUE)
	            {
	                ?>
			<script>
				location.href = '<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>';
			</script>
				<?php
				}
				?>
			<div class="form update">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<div class="fields">
					<div class="message success"><?php echo CREFUND_UPDATE_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CREFUND_UPDATE_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
				<?php
				}
				?>
				</div>
				<div class="bottom"></div>
			</div>
			<?php
			}
			else
			{
			?>
			<div class="form update">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<form name="formUpdateRefund" id="formUpdateRefund" method="post" action="">
				<input name="updateRefund" type="hidden" id="updateRefund" value="back" />
				<div class="fields">
				<?php
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					echo '<input name="dateAdded" type="hidden" id="dateAdded" value="'.$this->getDateAdded().'" />';
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					echo '<input name="idUserAdd" type="hidden" id="idUserAdd" value="'.$this->getIdUserAdd().'" />';
				}
				if (in_array('idSale', $arrayFields) === TRUE)
				{
					echo '<input name="idSale" type="hidden" id="idSale" value="'.$this->getIdSale().'" />';
				}
				if (in_array('reason', $arrayFields) === TRUE)
				{
					echo '<input name="reason" type="hidden" id="reason" value="'.$this->getReason().'" />';
				}
				if (in_array('detail', $arrayFields) === TRUE)
				{
					echo '<input name="detail" type="hidden" id="detail" value="'.$this->getDetail().'" />';
				}
				if (in_array('type', $arrayFields) === TRUE)
				{
					echo '<input name="type" type="hidden" id="type" value="'.$this->getType().'" />';
				}
				if (in_array('amount', $arrayFields) === TRUE)
				{
					echo '<input name="amount" type="hidden" id="amount" value="'.$this->getAmount().'" />';
				}
				if(is_array($_POST['productsRefundGroup']) == TRUE and count($_POST['productsRefundGroup']) > 0)
				{
				    echo '<input name="productsRefundGroup" type="hidden" id="productsRefundGroup" value="'.implode(',', $_POST['productsRefundGroup']).'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CREFUND_UPDATE_FORM_BACK_BTN; ?>" class="back" />
				</div>
				</form>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
		else
		{
			if ($this->getData() === TRUE)
			{
				if ($_POST['updateRefund'] == 'back')
				{
					if (in_array('dateAdded', $arrayFields) === TRUE)
					{
						$this->setDateAdded($_POST['dateAdded'], FALSE);
					}
					if (in_array('idUserAdd', $arrayFields) === TRUE)
					{
						$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
					}
					if (in_array('idSale', $arrayFields) === TRUE)
					{
						$this->setIdSale($_POST['idSale'], TRUE);
					}
					if (in_array('reason', $arrayFields) === TRUE)
					{
						$this->setReason($_POST['reason'], TRUE);
					}
					if (in_array('detail', $arrayFields) === TRUE)
					{
						$this->setDetail($_POST['detail'], TRUE);
					}
					if (in_array('type', $arrayFields) === TRUE)
					{
						$this->setType($_POST['type'], TRUE);
					}
					if (in_array('amount', $arrayFields) === TRUE)
					{
						$this->setAmount($_POST['amount'], TRUE);
					}
					if(empty($_POST['productsRefundGroup']) == FALSE)
					{
					    $_POST['productsRefundGroup'] = explode(',',$_POST['productsRefundGroup']);
					}
				}
				$oDateInfo = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
				?>
			<div class="form update">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<form name="formUpdateRefund" id="formUpdateRefund" method="post" action="">
				<input name="updateRefund" type="hidden" id="updateRefund" value="update" />
				<input name="id" type="hidden" id="id" value="<?php echo $this->getId(); ?>" />
				<div class="fields">
				<?php
				foreach ($arrayFields as $value)
				{
					if ($value == 'id')
					{
					?>
					<div class="field">
						<label><?php echo CREFUND_UPDATE_FORM_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
					<?php
					}
					if ($value == 'dateAdded')
					{
					?>
					<div class="field">
						<label><?php echo CREFUND_UPDATE_FORM_LABEL_FIELD_DATE_ADDED; ?> <span>*</span></label>
						<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
					<?php
					}
					if ($value == 'idUserAdd')
					{
					?>
					<div class="field">
						<label><?php echo CREFUND_UPDATE_FORM_LABEL_FIELD_ID_USER_ADD; ?> <span>*</span></label>
						<?php
						$oIdUserAdd = new Cuser();
						$oIdUserAdd->setDbConn($this->getDbConn());
						$oIdUserAdd->showList('name', 'name', $this->getIdUserAdd(), 'idUserAdd', 'idUserAdd', 'select');
						?>
					</div>
					<?php
					}
					if ($value == 'idSale')
					{
					?>
					<input name="idSale" type="hidden" id="idSale" value="<?php echo $_GET['id']; ?>" />
					<?php
					}
					if ($value == 'reason')
					{
					?>
					<div class="field">
						<label><?php echo CREFUND_UPDATE_FORM_LABEL_FIELD_REASON; ?> <span>*</span></label>
						<select name="reason" id="reason">
							<option value=""></option>
							<option value="faulty" <?php if ($this->getReason() == 'faulty') echo 'selected="selected"' ?>><?php echo $this->getValuesReason('faulty'); ?></option>
							<option value="various" <?php if ($this->getReason() == 'various') echo 'selected="selected"' ?>><?php echo $this->getValuesReason('various'); ?></option>
						</select>
					</div>
					<?php
					}
					if ($value == 'detail')
					{
					?>
					<div class="field">
						<label><?php echo CREFUND_UPDATE_FORM_LABEL_FIELD_DETAIL; ?></label>
						<textarea name="detail" id="detail"><?php echo $this->getDetail(); ?></textarea>
					</div>
					<?php
					}
					if ($value == 'type')
					{
					?>
					<div class="field">
						<label><?php echo CREFUND_UPDATE_FORM_LABEL_FIELD_TYPE; ?></label>
						<select name="type" id="type">
							<option value=""></option>
							<option value="cash" <?php if ($this->getType() == 'cash') echo 'selected="selected"' ?>><?php echo $this->getValuesType('cash'); ?></option>
							<option value="cta_cte" <?php if ($this->getType() == 'cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesType('cta_cte'); ?></option>
						</select>
					</div>
					<?php
					}
					if ($value == 'amount')
					{
					?>
					<div class="field">
						<label><?php echo CREFUND_UPDATE_FORM_LABEL_FIELD_AMOUNT; ?> <span>*</span></label>
						<input name="amount" type="text" id="amount" value="<?php echo $this->getAmount(); ?>" class="num" />
					</div>
					<?php
					}
				}
				?>
				</div>
				<?php
				$product = new Cproduct();
				$product->setDbConn($this->getDbConn());
				$product->showSaleProductTable($_GET['id'], $_POST['productsRefundGroup']);
				?>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CREFUND_UPDATE_FORM_SUBMIT_BTN; ?>" class="accept" />
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CREFUND_UPDATE_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="cancel" />
				<?php
				}
				?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CREFUND_UPDATE_FORM_LABEL_REQUIRED; ?></span>
			</div>
			<?php
			}
			else
			{
			?>
			<div class="form update">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CREFUND_UPDATE_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
				<?php
				}
				?>
				</div>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
	}

	/**
	 * Elimina un registro existente de la tabla refund y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un registro de la tabla refund y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
	 * Para realizar esto debe estar seteada la clave primaria del registro a eliminar.
	 *
	 * Ver también: {@link del()}, {@link delGroupForm()}
	 * @param string $href [opcional] indica la página a la que se redirecciona una vez que fue mostrado el resultado de la eliminación del registro
	 * @param boolean $autoRedirect [opcional] indica si se debe auto redireccionar a la página definida en $href una vez que se eliminó el registro en forma correcta
	 * @param string $title [opcional] título
	 * @return mixed
	 * @access public
	 */
	public function delForm($href = '', $autoRedirect = FALSE, $title = '')
	{
		if (isset($_GET['p']) === FALSE)
		{
			$_GET['p'] = '';
		}


		$this->delRefund();

		if ($this->error() === FALSE and validateRequiredValue($href) === TRUE and $autoRedirect === TRUE)
		{
			echo '<script>';
			if ($_GET['p'] != '')
			{
				echo 'location.href=\''.$href.'?p='.$_GET['p'].'\';';
			}
			else
			{
				echo 'location.href=\''.$href.'\';';
			}
			echo '</script>';

			return TRUE;
		}
		?>
			<div class="form del">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
		<?php
		if ($this->error() === FALSE)
		{
		?>
				<div class="fields">
					<div class="message success"><?php echo CREFUND_DEL_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CREFUND_DEL_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
			<?php
			}
			?>
				</div>
			<?php
		}
		else
		{
		?>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="button" value="<?php echo CREFUND_DEL_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
				</div>
		<?php
		}
		?>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Elimina un grupo de registros existente de la tabla refund y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un grupo de registros de la tabla refund y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
	 *
	 * Ver también: {@link del()}, {@link delForm()}
	 * @param array $group array con las claves primarias de los registros a eliminarse
	 * @param string $href [opcional] indica la página a la que se redirecciona una vez que fue mostrado el resultado de la eliminación de los registros
	 * @param boolean $autoRedirect [opcional] indica si se debe auto redireccionar a la página definida en $href una vez que se eliminaron los registros en forma correcta
	 * @param string $title [opcional] título
	 * @return mixed
	 * @access public
	 */
	public function delGroupForm($group, $href = '', $autoRedirect = FALSE, $title = '')
	{
		if (isset($_POST['p']) === FALSE)
		{
			$_POST['p'] = '';
		}

		$flagGroup = FALSE;

		if (is_array($group) === TRUE)
		{
			foreach ($group as $value)
			{
				if ($this->setId($value, TRUE) === TRUE)
				{
					if ($this->delRefund() === FALSE)
					{
						$flagGroup = TRUE;
					}
				}
				else
				{
					$flagGroup = TRUE;
				}
			}
		}
		else
		{
			$this->addError(CREFUND_DEL_GROUP_FORM_REQUIRED_PK);
		}

		if ($this->error() === FALSE and validateRequiredValue($href) === TRUE and $autoRedirect === TRUE)
		{
			echo '<script>';
			if ($_POST['p'] != '')
			{
				echo 'location.href=\''.$href.'?p='.$_POST['p'].'\';';
			}
			else
			{
				echo 'location.href=\''.$href.'\';';
			}
			echo '</script>';

			return TRUE;
		}
		?>
			<div class="form del-group">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
		<?php
		if ($this->error() === FALSE)
		{
		?>
				<div class="fields">
					<div class="message success"><?php echo CREFUND_DEL_GROUP_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CREFUND_DEL_GROUP_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="success" />
			<?php
			}
			?>
				</div>
			<?php
		}
		else
		{
			if ($flagGroup === TRUE)
			{
				$this->deleteErrors();
				$this->addError(CREFUND_DEL_GROUP_FORM_CANT_DELETE_ALL);
			}
			?>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="button" value="<?php echo CREFUND_DEL_GROUP_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="back" />
				</div>
		<?php
		}
		?>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Muestra los campos seteados
	 *
	 * Este método muestra los valores de los campos seteados en el parámetro $fields.
	 *
	 * Ver también: {@link getData()}
	 * @param string $fields [opcional] cadena con los campos (separados con comas) que se van a mostrar. Ej: "campo1,campo2,campo3, ... ,campoN"
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML sólo de los campos que son Extra: HTML
	 * @param string $href [opcional] indica la página a la que se redirecciona cuando se hace clic en el botón volver de este método
	 * @param string $title [opcional] título
	 * @return mixed
	 * @access public
	 */
	public function showData($fields = '', $htmlEntities = TRUE, $href = '', $title = '')
	{
		if (isset($_GET['p']) === FALSE)
		{
			$_GET['p'] = '';
		}

		if (validateRequiredValue($fields) === FALSE)
		{
			$fields = 'id,dateAdded,idUserAdd,idSale,reason,detail,type,amount,products';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		settype ($htmlEntities, 'boolean');
		?>
			<div class="form show">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<div class="fields">
		<?php
		foreach ($arrayFields as $value)
		{
			if ($value == 'id')
			{
			?>
					<div class="field">
						<label><?php echo CREFUND_SHOW_DATA_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'dateAdded')
			{
			?>
					<div class="field">
						<label><?php echo CREFUND_SHOW_DATA_LABEL_FIELD_DATE_ADDED; ?></label>
						<strong><?php echo $this->getDateAdded(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idUserAdd')
			{
			?>
					<div class="field">
						<label><?php echo CREFUND_SHOW_DATA_LABEL_FIELD_ID_USER_ADD; ?></label>
				<?php
				$oIdUserAdd = new Cuser();
				$oIdUserAdd->setDbConn($this->getDbConn());
				$oIdUserAdd->setId($this->getIdUserAdd(FALSE));
				$oIdUserAdd->getData();
				?>
						<strong><?php echo $oIdUserAdd->getName(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idSale')
			{
			?>
					<div class="field">
						<label><?php echo CREFUND_SHOW_DATA_LABEL_FIELD_ID_SALE; ?></label>
				<?php
				$oIdSale = new Csale();
				$oIdSale->setDbConn($this->getDbConn());
				$oIdSale->setId($this->getIdSale(FALSE));
				$oIdSale->getData();
				?>
						<strong><?php echo $oIdSale->getDateAdded(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'reason')
			{
			?>
					<div class="field">
						<label><?php echo CREFUND_SHOW_DATA_LABEL_FIELD_REASON; ?></label>
						<strong><?php echo $this->getValuesReason($this->getReason()); ?></strong>
					</div>
			<?php
			}
			if ($value == 'detail')
			{
			?>
					<div class="field">
						<label><?php echo CREFUND_SHOW_DATA_LABEL_FIELD_DETAIL; ?></label>
						<strong><?php echo $this->getDetail(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'type')
			{
			?>
					<div class="field">
						<label><?php echo CREFUND_SHOW_DATA_LABEL_FIELD_TYPE; ?></label>
						<strong><?php echo $this->getValuesType($this->getType()); ?></strong>
					</div>
			<?php
			}
			if ($value == 'amount')
			{
			?>
					<div class="field">
						<label><?php echo CREFUND_SHOW_DATA_LABEL_FIELD_AMOUNT; ?></label>
						<strong><?php echo $this->getAmount(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'products')
			{
			    ?>
					<div class="field">
						<label><?php echo CREFUND_SHOW_DATA_LABEL_FIELD_PRODUCTS; ?></label>
						<strong>
						<?php
						$detailRefund = new Cdetail_refund($this->getDbConn());
						$product      = new Cproduct($this->getDbConn());


						$search = $detailRefund->getFieldSql('id_refund', $detailRefund->getTableName()).' = '.$detailRefund->getValueSql($this->getId(FALSE));
						$rs = $detailRefund->getList($search, 0, 0, '', FALSE);

						if ($detailRefund->getTotalList() > 0)
						{
						    foreach ($rs as $item)
						    {
						        $product->setId($item['idProduct']);

						        $product->getData();

						        echo '<div class="row-show">#'.$product->getId().' - '.$product->getName().'</div>';
						    }
						}
						?>
						</strong>
					</div>
			<?php
			}
		}
		?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
		<?php
		if (validateRequiredValue($href) === TRUE)
		{
		?>
					<input type="button" value="<?php echo CREFUND_SHOW_DATA_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
		<?php
		}
		?>
				</div>
				<div class="bottom"></div>
			</div>
	<?php
	}

	/**
	 * Muestra un formulario de búsqueda de registros de la tabla refund
	 *
	 * Este método muestra un formulario con los campos seteados en el parámetro $fields para realizar una búsqueda de los registros de la tabla refund.
	 *
	 * Ver también: {@link getList()}, {@link showQuery()}
	 * @param string $method [opcional] indica el método de envío del formulario de búsqueda: get o post
	 * @param string $fields [opcional] cadena con los campos (separados con comas) que se van a mostrar en el formulario de búsqueda. Ej: "campo1,campo2,campo3, ... ,campoN"
	 * @param string $params [opcional] parámetros que vienen desde otras páginas
	 * @param string $title [opcional] título
	 * @param boolean $showHideBtn [opcional] indica si se muestra o no el botón para ocultar o mostrar el formulario de búsqueda
	 * @return mixed
	 * @access public
	 */
	public function searchForm($method = 'get', $fields = '', $params = '', $title = '', $showHideBtn = FALSE)
	{
		if ($method != 'get' and $method != 'post')
		{
			$method = 'get';
		}

		if (validateRequiredValue($fields) === FALSE)
		{
			$fields = 'id,dateAdded,idUserAdd,idSale,reason,detail,type,amount';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $field)
		{
			$arrayFields[$key] = trim($field);
		}

		if (validateRequiredValue($params) === TRUE)
		{
			$arrayParams = explode('&', base64_decode($params));

			foreach ($arrayParams as $param)
			{
				$arrayParamValue = explode('=', $param);

				if ($method == 'post')
				{
					$_POST[$arrayParamValue[0]] = urldecode($arrayParamValue[1]);
				}
				else
				{
					$_GET[$arrayParamValue[0]] = urldecode($arrayParamValue[1]);
				}
			}
		}

		if ($method == 'post')
		{
			$values = $_POST;
		}
		else
		{
			$values = $_GET;
		}

		foreach ($arrayFields as $field)
		{
			if (isset($values[$field]) === FALSE)
			{
				$values[$field] = '';
			}
		}

		$oDateInfo = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
		?>
			<div class="form search">
				<div class="aux"></div>
		<?php
		$display = '';
		if ($showHideBtn === TRUE)
		{
			if (isset($_SESSION['main_tr_search_refund']) === FALSE)
			{
				$_SESSION['main_tr_search_refund'] = '';
			}

			$display  = 'display: none;';
			$btnClass = 'closed';
			if ($_SESSION['main_tr_search_refund'] === 'open')
			{
				$display  = '';
				$btnClass = 'open';
			}
		}
		?>
				<div class="title">
					<div class="ico"><?php if ($showHideBtn === TRUE) { ?><a href="#" onclick="showHideSearch('refund'); return false;" class="<?php echo $btnClass; ?>"></a><?php } ?></div>
					<div class="label"><a href="#" onclick="showHideSearch('refund'); return false;"><?php echo $title; ?></a></div>
				</div>
				<div id="container_search_refund" style="<?php echo $display; ?>">
					<div class="top"></div>
					<form name="formSearchRefund" id="formSearchRefund" method="<?php echo $method; ?>" action="">
					<div class="fields">
		<?php
		$condition = array();
		$params = array();

		foreach ($arrayFields as $value)
		{
			if ($value == 'id')
			{
				$this->setId($values['id'], TRUE);
				?>
						<div class="field">
							<label><?php echo CREFUND_SEARCH_FORM_LABEL_FIELD_ID; ?></label>
							<input name="id" type="text" id="id" value="<?php echo $this->getId(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getId()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id', $this->getTableName()).' = '.$this->getValueSql($this->id);
					$params[] = 'id='.urlencode($this->id);
				}
			}

			if ($value == 'dateAdded')
			{
				$this->setDateAdded($values['dateAdded'], FALSE);
				?>
						<div class="field">
							<label><?php echo CREFUND_SEARCH_FORM_LABEL_FIELD_DATE_ADDED; ?></label>
							<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
						</div>
				<?php
				if (validateRequiredValue($this->getDateAdded()) === TRUE)
				{
					$condition[] = $this->getFieldSql('date_added', $this->getTableName()).' = '.$this->getValueSql($this->dateAdded);
					$params[] = 'dateAdded='.urlencode($this->getDateAdded());
				}
			}

			if ($value == 'idUserAdd')
			{
				$this->setIdUserAdd($values['idUserAdd'], TRUE);

				$auxUserName = '';
				if(empty($this->getIdUserAdd(FALSE)) == FALSE)
				{
				    $auxUser = new Cuser($this->getDbConn());
				    $auxUser->setId($this->getIdUserAdd(FALSE));
				    if($auxUser->getData() == TRUE)
				    {
				        $auxUserName = $auxUser->getLastname(FALSE).' '.$auxUser->getName(FALSE);
				    }
				}
				?>
						<div class="field autocompleteWrapper">
							<label><?php echo CREFUND_SEARCH_FORM_LABEL_FIELD_ID_USER_ADD; ?></label>
							<input name="idUserAddAutocomplete" id="idUserAddAutocomplete" value="<?php echo $auxUserName; ?>" class="str autocomplete" maxlength="255" type="text" />
							<input name="idUserAdd" id="idUserAdd" value="<?php echo $this->getIdUserAdd(); ?>" type="hidden" />
						</div>
				<?php
				if (validateRequiredValue($this->getIdUserAdd()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_user_add', $this->getTableName()).' = '.$this->getValueSql($this->idUserAdd);
					$params[] = 'idUserAdd='.urlencode($this->idUserAdd);
				}
			}

			if ($value == 'idSale')
			{
				$this->setIdSale($values['idSale'], TRUE);
				?>
						<div class="field">
							<label><?php echo CREFUND_SEARCH_FORM_LABEL_FIELD_ID_SALE; ?></label>
				<?php
				$oIdSale = new Csale();
				$oIdSale->setDbConn($this->getDbConn());
				$oIdSale->showList('id,dateAdded', 'date_added', $this->getIdSale(), 'idSale', 'idSale', 'select_search');
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdSale()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_sale', $this->getTableName()).' = '.$this->getValueSql($this->idSale);
					$params[] = 'idSale='.urlencode($this->idSale);
				}
			}

			if ($value == 'reason')
			{
				$this->setReason($values['reason'], TRUE);
				?>
						<div class="field">
							<label><?php echo CREFUND_SEARCH_FORM_LABEL_FIELD_REASON; ?></label>
							<select name="reason" id="reason">
								<option value=""></option>
								<option value="faulty" <?php if ($this->getReason() == 'faulty') echo 'selected="selected"' ?>><?php echo $this->getValuesReason('faulty'); ?></option>
								<option value="various" <?php if ($this->getReason() == 'various') echo 'selected="selected"' ?>><?php echo $this->getValuesReason('various'); ?></option>
							</select>
						</div>
				<?php
				if (validateRequiredValue($this->getReason()) === TRUE)
				{
					$condition[] = $this->getFieldSql('reason', $this->getTableName()).' = '.$this->getValueSql($this->reason);
					$params[] = 'reason='.urlencode($this->reason);
				}
			}

			if ($value == 'detail')
			{
				$this->setDetail($values['detail'], TRUE);
				?>
						<div class="field">
							<label><?php echo CREFUND_SEARCH_FORM_LABEL_FIELD_DETAIL; ?></label>
							<input name="detail" type="text" id="detail" value="<?php echo $this->getDetail(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getDetail()) === TRUE)
				{
					$condition[] = $this->getFieldSql('detail', $this->getTableName()).' LIKE '.$this->getValueSql($this->detail, '%%');
					$params[] = 'detail='.urlencode($this->detail);
				}
			}
			if ($value == 'type')
			{
				$this->setType($values['type'], TRUE);
				?>
						<div class="field">
							<label><?php echo CREFUND_SEARCH_FORM_LABEL_FIELD_TYPE; ?></label>
							<select name="type" id="type">
								<option value=""></option>
								<option value="cash" <?php if ($this->getType() == 'cash') echo 'selected="selected"' ?>><?php echo $this->getValuesType('cash'); ?></option>
								<option value="cta_cte" <?php if ($this->getType() == 'cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesType('cta_cte'); ?></option>
							</select>
						</div>
				<?php
				if (validateRequiredValue($this->getType()) === TRUE)
				{
					$condition[] = $this->getFieldSql('type', $this->getTableName()).' = '.$this->getValueSql($this->type);
					$params[] = 'type='.urlencode($this->type);
				}
			}
			if ($value == 'amount')
			{
				$this->setAmount($values['amount'], TRUE);
				?>
						<div class="field">
							<label><?php echo CREFUND_SEARCH_FORM_LABEL_FIELD_AMOUNT; ?></label>
							<input name="amount" type="text" id="amount" value="<?php echo $this->getAmount(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getAmount()) === TRUE)
				{
					$condition[] = $this->getFieldSql('amount', $this->getTableName()).' = '.$this->getValueSql($this->amount);
					$params[] = 'amount='.urlencode($this->amount);
				}
			}
		}
		?>
					</div>
					<div class="middle"></div>
					<div class="buttons">
						<input type="submit" value="<?php echo CREFUND_SEARCH_FORM_SUBMIT_BTN; ?>" class="search" />
					</div>
					</form>
					<div class="bottom"></div>
				</div>
			</div>
		<?php
		$this->setCondition(implode(' AND ', $condition));

		$this->setParams(implode('&', $params));
	}

	/**
	 * Muestra el resultado de una consulta a la tabla refund
	 *
	 * Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla refund. Muestra sólo los campos seteados en el parámetro $fields.
	 *
	 * El parámetro $fields es un array bidimensional con el siguiente formato:
	 * <code>
	 * <?php
	 * $fields[0]['field']  = 'campo1';
	 * $fields[0]['width']  = '45%';
	 * $fields[0]['strlen'] = '30';
	 * $fields[1]['field']  = 'campo2';
	 * $fields[1]['width']  = '45%';
	 * $fields[1]['strlen'] = '30';
	 * ?>
	 * </code>
	 * - 'field'  : nombre del campo a mostrar
	 * - 'width'  : ancho que tiene la columna de ese campo
	 * - 'strlen' : cantidad de caracteres que se van a mostrar de ese campo
	 *
	 * El parámetro $actions es un array bidimensional con el siguiente formato:
	 * <code>
	 * <?php
	 * $actions[0]['file']         = 'update.php';
	 * $actions[0]['image']        = 'img/update.png';
	 * $actions[0]['image-over']   = 'img/update-over.png';
	 * $actions[0]['image-head']   = 'img/update-head.png';
	 * $actions[0]['class']        = 'update';
	 * $actions[0]['text']         = 'Modificar';
	 * $actions[0]['title']        = 'Modificar Registro';
	 * $actions[0]['confirm']      = 'FALSE';
	 * $actions[0]['msg']          = '';
	 * $actions[0]['width']        = '5%';
	 * $actions[1]['file']         = 'del.php';
	 * $actions[1]['image']        = 'img/delete.png';
	 * $actions[1]['image-over']   = 'img/delete-over.png';
	 * $actions[1]['image-head']   = 'img/delete-head.png';
	 * $actions[1]['class']        = 'del';
	 * $actions[1]['text']         = 'Eliminar';
	 * $actions[1]['title']        = 'Eliminar Registro';
	 * $actions[1]['confirm']      = 'TRUE';
	 * $actions[1]['msg']          = '¿Eliminar el registro?';
	 * $actions[1]['width']        = '5%';
	 * ?>
	 * </code>
	 * - 'file'       : nombre del archivo donde se realiza la acción
	 * - 'image'      : url de la imagen del link de la acción
	 * - 'image-over' : url de la imagen del link de la acción, estado over
	 * - 'image-head' : url de la imagen de la cabecera de la acción
	 * - 'class'      : clase css
	 * - 'text'       : texto del link de la acción (si se define una imagen no se muestra)
	 * - 'title'      : title o alt del link de la acción
	 * - 'confirm'    : si se necesita una confirmación antes de realizar la acción
	 * - 'msg'        : mensaje que aparece en la confirmación
	 * - 'width'      : ancho que tiene la columna de la acción
	 *
	 * El parámetro $groupActions es un array bidimensional con el siguiente formato:
	 * <code>
	 * <?php
	 * $groupActions[0]['file']    = 'del_group.php';
	 * $groupActions[0]['image']   = 'img/delete.gif';
	 * $groupActions[0]['text']    = 'Eliminar';
	 * $groupActions[0]['title']   = 'Eliminar registros seleccionados';
	 * $groupActions[0]['confirm'] = TRUE;
	 * $groupActions[0]['msg']     = '¿Eliminar los registros seleccionados?';
	 * $groupActions[0]['button']  = TRUE;
	 * $groupActions[0]['class']   = 'del'
	 * $groupActions[1]['file']    = 'show_group.php';
	 * $groupActions[1]['image']   = 'img/show.gif';
	 * $groupActions[1]['text']    = 'Ver';
	 * $groupActions[1]['title']   = 'Ver registros seleccionados';
	 * $groupActions[1]['confirm'] = FALSE;
	 * $groupActions[1]['msg']     = '';
	 * $groupActions[1]['button']  = TRUE;
	 * $groupActions[1]['class']   = 'show'
	 * ?>
	 * </code>
	 * - 'file'    : nombre del archivo donde se realiza la acción
	 * - 'image'   : url de la imagen del link de la acción
	 * - 'text'    : texto del link de la acción (si se define una imagen no se muestra) o del botón de la acción
	 * - 'title'   : title o alt del link de la acción
	 * - 'confirm' : si se necesita una confirmación antes de realizar la acción
	 * - 'msg'     : mensaje que aparece en la confirmación
	 * - 'button'  : si se utiliza un botón en lugar de un link
	 * - 'class'   : clase css
	 * Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST['refundGroup'] (array)</b>
	 *
	 * Ver también: {@link getList()}, {@link searchForm()}
	 * @param array $fields [opcional] contiene los campos que se van a mostrar
	 * @param array $actions [opcional] contiene los archivos a los que se puede redireccionar con la clave primaria de cada registro para realizar una acción determinada
	 * @param array $groupActions [opcional] contiene los archivos a los que se puede redireccionar con la clave primaria de cada registro seleccionado para realizar una acción determinada
	 * @param string $widthGroupActions [opcional] ancho de la columna con los checkbox para las acciones grupales
	 * @param boolean $showNavTop [opcional] indica si se muestra o no el navegador de arriba
	 * @param boolean $showNavBottom [opcional] indica si se muestra o no el navegador de abajo
	 * @param string $imagesNav [opcional] url donde se almacenan las imágenes que se utilizan para el Cnavigator
	 * @param boolean $showNavPages [opcional] indica si se muestran o no las páginas del navegador (Ej.: 1 2 3)
	 * @param boolean $showNavInfo [opcional] indica si se muestra o no la información del navegador (Ej.: Resultados: 1 al 10 de 100)
	 * @param string $title [opcional] título
	 * @param integer $amountPages [opcional] cantidad de páginas que muestra el navegador
	 * @param integer $resultsPerPage [opcional] cantidad de resultados (filas) por página de la consulta
	 * @return mixed
	 * @access public
	 */
	public function showQuery($fields = '', $actions = '', $groupActions = '', $widthGroupActions = '', $showNavTop = TRUE, $showNavBottom = TRUE, $imagesNav = '', $showNavPages = TRUE, $showNavInfo = TRUE, $title = '', $amountPages = 0, $resultsPerPage = 0)
	{
		if (is_array($fields) === FALSE)
		{
			unset($fields);
			$fields[0]['field'] = 'id';
			$fields[1]['field'] = 'dateAdded';
			$fields[2]['field'] = 'idUserAdd';
			$fields[3]['field'] = 'idSale';
			$fields[4]['field'] = 'reason';
			$fields[5]['field'] = 'detail';
			$fields[6]['field'] = 'type';
			$fields[7]['field'] = 'amount';
		}

		foreach ($fields as $field)
		{
			$arrayField[] = $field['field'];

			settype ($field['strlen'], 'integer');
			$arrayStrLen[$field['field']] = $field['strlen'];

			if (isset($field['width']) === FALSE)
			{
				$field['width'] = '';
			}
			$arrayWidth[$field['field']] = $field['width'];
		}

		settype ($_GET['i'], 'integer');

		if (isset($_GET['orderby']) === FALSE)
		{
			$_GET['orderby'] = '';
		}
		else
		{
			$arrayOrder = array('id', 'date_added', 'id_user_add', 'id_sale', 'reason', 'detail', 'type', 'amount');
			array_push($arrayOrder, 'user_name', 'sale_date_added');

			if (in_array($_GET['orderby'], $arrayOrder) === FALSE)
			{
				$_GET['orderby'] = '';
			}
		}
		if (isset($_GET['ascdesc']) === FALSE)
		{
			$_GET['ascdesc'] = '';
		}
		else
		{
			if (in_array(strtoupper($_GET['ascdesc']), array('ASC', 'DESC')) === FALSE)
			{
				$_GET['ascdesc'] = '';
			}
		}
		if ($_GET['orderby'] != '' and $_GET['ascdesc'] != '')
		{
			$orderby = $this->getFieldSql($_GET['orderby']).' '.$_GET['ascdesc'];
		}
		else
		{
			$orderby = '';
		}

		$head = '';
		$headers = array();

		if (is_array($groupActions) === TRUE)
		{
			$head.= '<div class="col" style="width: '.$widthGroupActions.';"></div>';
		}

		foreach ($arrayField as $value)
		{
			if ($value == 'id')
			{
				if ($_GET['orderby'] == 'id')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=id&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=id&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=id&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['id'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CREFUND_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></div>';
				$headers['id'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CREFUND_SHOW_QUERY_HEAD_FIELD_ID).'</a></div>';
			}

			if ($value == 'dateAdded')
			{
				if ($_GET['orderby'] == 'date_added')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=date_added&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=date_added&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=date_added&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['dateAdded'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CREFUND_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div></div>';
				$headers['dateAdded'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CREFUND_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div>';
			}

			if ($value == 'idUserAdd')
			{
				if ($_GET['orderby'] == 'user_name')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=user_name&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=user_name&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=user_name&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['idUserAdd'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CREFUND_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div></div>';
				$headers['idUserAdd'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CREFUND_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div>';
			}

			if ($value == 'idSale')
			{
				if ($_GET['orderby'] == 'sale_date_added')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=sale_date_added&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=sale_date_added&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=sale_date_added&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['idSale'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_ID_SALE, $arrayStrLen['idSale']), CREFUND_SHOW_QUERY_HEAD_FIELD_ID_SALE).'</a></div></div>';
				$headers['idSale'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_ID_SALE, $arrayStrLen['idSale']), CREFUND_SHOW_QUERY_HEAD_FIELD_ID_SALE).'</a></div>';
			}

			if ($value == 'reason')
			{
				if ($_GET['orderby'] == 'reason')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=reason&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=reason&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=reason&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['reason'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_REASON, $arrayStrLen['reason']), CREFUND_SHOW_QUERY_HEAD_FIELD_REASON).'</a></div></div>';
				$headers['reason'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_REASON, $arrayStrLen['reason']), CREFUND_SHOW_QUERY_HEAD_FIELD_REASON).'</a></div>';
			}

			if ($value == 'detail')
			{
				if ($_GET['orderby'] == 'detail')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=detail&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=detail&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=detail&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['detail'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_DETAIL, $arrayStrLen['detail']), CREFUND_SHOW_QUERY_HEAD_FIELD_DETAIL).'</a></div></div>';
				$headers['detail'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_DETAIL, $arrayStrLen['detail']), CREFUND_SHOW_QUERY_HEAD_FIELD_DETAIL).'</a></div>';
			}

			if ($value == 'type')
			{
				if ($_GET['orderby'] == 'type')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=type&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=type&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=type&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}
				$head.= '<div class="col" style="width: '.$arrayWidth['type'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_TYPE, $arrayStrLen['type']), CREFUND_SHOW_QUERY_HEAD_FIELD_TYPE).'</a></div></div>';
				$headers['type'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_TYPE, $arrayStrLen['type']), CREFUND_SHOW_QUERY_HEAD_FIELD_TYPE).'</a></div>';
			}

			if ($value == 'amount')
			{
				if ($_GET['orderby'] == 'amount')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=amount&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=amount&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=amount&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}
				$head.= '<div class="col" style="width: '.$arrayWidth['amount'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_AMOUNT, $arrayStrLen['amount']), CREFUND_SHOW_QUERY_HEAD_FIELD_AMOUNT).'</a></div></div>';
				$headers['amount'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_AMOUNT, $arrayStrLen['amount']), CREFUND_SHOW_QUERY_HEAD_FIELD_AMOUNT).'</a></div>';
			}

			if ($value == 'products')
			{
			    $head.= '<div class="col" style="width: '.$arrayWidth['products'].';"><div class="str">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_PRODUCTS, $arrayStrLen['products']), CREFUND_SHOW_QUERY_HEAD_FIELD_PRODUCTS).'</div></div>';
			    $headers['products'] = '<div class="str">'.altText(getCutString(CREFUND_SHOW_QUERY_HEAD_FIELD_PRODUCTS, $arrayStrLen['products']), CREFUND_SHOW_QUERY_HEAD_FIELD_PRODUCTS).'</div>';
			}
		}

		if (is_array($actions) === TRUE)
		{
			foreach ($actions as $value)
			{
				$actionHead = '';
				if (validateRequiredValue($value['image-head']) === TRUE)
				{
					$actionHead = '<img src="'.$value['image-head'].'" alt="'.$value['title'].'" />';
				}
				$head.= '<div class="col" style="width: '.$value['width'].';"><div class="action">'.$actionHead.'</div></div>';
			}
		}

		settype ($amountPages, 'integer');
		settype ($resultsPerPage, 'integer');

		$nav = new Cnavigator();
		$nav->setPage('');
		$nav->setAmountPages($amountPages);
		$nav->setResultsPerPage($resultsPerPage);
		$nav->setCssText('nav-text');
		$nav->setCssLink('nav-link');
		$nav->setCssInfo('nav-info');
		$nav->setCssImg('nav-img');
		$nav->setIndex($_GET['i']);
		if ($imagesNav != '')
		{
			$nav->setUrlToImages($imagesNav);
		}

		$list = $this->getList($this->getCondition(), $nav->getResultsPerPage(), $_GET['i'], $orderby);

		$nav->setTotalResults($this->getTotalList());

		$params = $this->getParams();
		if (validateRequiredValue($_GET['orderby']) === TRUE and validateRequiredValue($_GET['ascdesc']) === TRUE)
		{
			if (validateRequiredValue($this->getParams()) === TRUE)
			{
				$params.= '&';
			}
			$params.= 'orderby='.$_GET['orderby'].'&ascdesc='.$_GET['ascdesc'];
		}
		$nav->setParameters($params);

		$actionsParams = '';
		if (validateRequiredValue($_GET['i']) === TRUE)
		{
			$actionsParams = 'i='.$_GET['i'];
		}
		if (validateRequiredValue($params) === TRUE)
		{
			if (validateRequiredValue($actionsParams) === TRUE)
			{
				$actionsParams.= '&';
			}
			$actionsParams.= $params;
		}
		if (validateRequiredValue($actionsParams) === TRUE)
		{
			$actionsParams = base64_encode($actionsParams);
		}
		?>
			<div class="form query">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<form name="formQueryRefund" id="formQueryRefund" method="post" action="">
				<input type="hidden" name="p" id="p" value="" />
		<?php
		if ($showNavTop === TRUE)
		{
		?>
				<div class="nav">
					<div class="pages">
			<?php
			if ($this->getTotalList() > $nav->getResultsPerPage())
			{
				$nav->showNavigator($showNavPages);
			}
			?>
					</div>
					<div class="info">
			<?php
			if ($showNavInfo === TRUE)
			{
				$nav->showNavigatorInfo();
			}
			?>
					</div>
					<div class="clear"></div>
				</div>
		<?php
		}

		if ($this->getTotalList() < 1)
		{
		?>
				<div class="message warning"><?php echo CREFUND_SHOW_QUERY_NOT_FOUND; ?></div>
		<?php
		}
		else
		{
		?>
				<div class="data">
					<div class="row header">
						<?php echo $head; ?>
						<div class="clear"></div>
					</div>
			<?php
			$class = '1';
			foreach ($list as $row)
			{
				?>
					<div class="row row<?php echo $class; ?>" id="refund_tr_<?php echo $row['id']; ?>" data-table-name="refund" data-id="<?php echo $row['id']; ?>" data-form-id="formQueryRefund">
				<?php
				if (is_array($groupActions) === TRUE)
				{
				?>
						<div class="col header"></div>
						<div class="col" style="width: <?php echo $widthGroupActions; ?>;"><div class="group-actions"><input name="refundGroup[]" type="checkbox" id="cb_refund_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="checkboxClick(this)" /></div></div>
				<?php
				}

				foreach ($arrayField as $value)
				{
					if ($value == 'id')
					{
					?>
						<div class="col header"><?php echo $headers['id']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['id']; ?>;"><div class="num"><?php echo altText(getCutString($row['id'], $arrayStrLen['id']), $row['id']); ?></div></div>
					<?php
					}

					if ($value == 'dateAdded')
					{
					?>
						<div class="col header"><?php echo $headers['dateAdded']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['dateAdded']; ?>;"><div class="date"><?php echo altText(getCutString($row['dateAdded'], $arrayStrLen['dateAdded']), $row['dateAdded']); ?></div></div>
					<?php
					}

					if ($value == 'idUserAdd')
					{
					?>
						<div class="col header"><?php echo $headers['idUserAdd']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idUserAdd']; ?>;"><div class="str"><?php echo altText(getCutString($row['userName'], $arrayStrLen['idUserAdd']), $row['userName']); ?></div></div>
					<?php
					}

					if ($value == 'idSale')
					{
					?>
						<div class="col header"><?php echo $headers['idSale']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idSale']; ?>;"><div class="date"><?php echo altText(getCutString($row['saleDateAdded'], $arrayStrLen['idSale']), $row['saleDateAdded']); ?></div></div>
					<?php
					}

					if ($value == 'reason')
					{
					?>
						<div class="col header"><?php echo $headers['reason']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['reason']; ?>;"><div class="str"><?php echo altText(getCutString($this->getValuesReason($row['reason']), $arrayStrLen['reason']), $this->getValuesReason($row['reason'])); ?></div></div>
					<?php
					}

					if ($value == 'detail')
					{
					?>
						<div class="col header"><?php echo $headers['detail']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['detail']; ?>;"><div class="str"><?php echo altText(getCutString($row['detail'], $arrayStrLen['detail']), $row['detail']); ?></div></div>
					<?php
					}

					if ($value == 'type')
					{
					?>
						<div class="col header"><?php echo $headers['type']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['type']; ?>;"><div class="str"><?php echo altText(getCutString($this->getValuesType($row['type']), $arrayStrLen['type']), $this->getValuesType($row['type'])); ?></div></div>
					<?php
					}

					if ($value == 'amount')
					{
					?>
						<div class="col header"><?php echo $headers['amount']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['amount']; ?>;"><div class="num"><?php echo altText(getCutString($row['amount'], $arrayStrLen['amount']), $row['amount']); ?></div></div>
					<?php
					}

					if ($value == 'products')
					{
					    $auxDetailRefund  = new Cdetail_refund($this->getDbConn());
					    //$auxProduct	       = new Cproduct($this->getDbConn());
					    $searchDetail      = $auxDetailRefund->getFieldSql('id_refund', $auxDetailRefund->getTableName()).' = '.$auxDetailRefund->getvalueSql($row['id']);
					    $resDetailPayment  = $auxDetailRefund->getList($searchDetail);
					    $auxContent	       = '';
					    if($resDetailPayment != FALSE)
					    {
					        foreach ($resDetailPayment as $val)
					        {
					            $auxContent .= '<div>&bull; #'.$val['idProduct'].' - '.$val['productName'].'</div>';
					        }
					    }

					    ?>
						<div class="col header"><?php echo $headers['products']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['products']; ?>;"><div class="str"><?php echo $auxContent; ?></div></div>
					<?php
					}
				}

				if (is_array($actions) === TRUE)
				{
					$auxActionsParams = '';
					if (validateRequiredValue($actionsParams) === TRUE)
					{
						$auxActionsParams = '&p='.$actionsParams;
					}

					$actionHead = '';
					$actionsBtns = '';

					foreach ($actions as $value)
					{
						if (validateRequiredValue($value['image-head']) === TRUE)
						{
							$actionHead.= '<img src="'.$value['image-head'].'" alt="'.$value['title'].'" />';
						}

						if ($value['confirm'] === TRUE)
						{
							$onclick = 'return confirm(\''.$value['msg'].'\')';

							$onclickBtn = 'queryAction(\''.$value['file'].'?id='.$row['id'].''.$auxActionsParams.'\', true, \''.$value['msg'].'\');';
						}
						else
						{
							$onclick = '';

							$onclickBtn = 'queryAction(\''.$value['file'].'?id='.$row['id'].''.$auxActionsParams.'\', false, \'\');';
						}

						$this->setId($row['id']);
						if($value['file'] == 'refund-del.php' and $this->canDelete() == FALSE)
						{
						    echo '<div class="col action" style="width: '.$value['width'].';"><div class="action '.$value['class'].'">&nbsp;</div></div>';
						}
						else
						{
    						if ($value['image'] == '')
    						{
    							echo '<div class="col action" style="width: '.$value['width'].';"><div class="action '.$value['class'].'"><a href="'.$value['file'].'?id='.$row['id'].''.$auxActionsParams.'" onclick="'.$onclick.'" title="'.$value['title'].'">'.$value['text'].'</a></div></div>';
    						}
    						else
    						{
    							echo '<div class="col action" style="width: '.$value['width'].';"><div class="action '.$value['class'].'"><a href="'.$value['file'].'?id='.$row['id'].''.$auxActionsParams.'" onclick="'.$onclick.'" title="'.$value['title'].'"><img src="'.$value['image'].'" alt="'.$value['title'].'" class="out" /><img src="'.$value['image-over'].'" alt="'.$value['title'].'" class="over" /></a></div></div>';
    						}
						}

						$actionsBtns.= '<input type="button" value="" onclick="'.$onclickBtn.'" class="'.$value['class'].'" />';
					}

					echo '<div class="col header"><div class="action">'.$actionHead.'</div></div>';
					echo '<div class="col action-vertical"><div class="action">'.$actionsBtns.'</div></div>';
				}
				?>
						<div class="clear"></div>
					</div>
				<?php
				if ($class == '1')
				{
					$class = '2';
				}
				else
				{
					$class = '1';
				}
			}
			?>
				</div>
			<?php
		}

		if ($showNavBottom === TRUE)
		{
		?>
				<div class="nav">
					<div class="pages">
			<?php
			if ($this->getTotalList() > $nav->getResultsPerPage())
			{
				$nav->showNavigator($showNavPages);
			}
			?>
					</div>
					<div class="info">
			<?php
			if ($showNavInfo === TRUE)
			{
				$nav->showNavigatorInfo();
			}
			?>
					</div>
					<div class="clear"></div>
				</div>
		<?php
		}
		?>
				<div class="middle"></div>
		<?php
		if (is_array($groupActions) === TRUE)
		{
		?>
				<div class="buttons">
					<div class="group-actions">
						<input name="refund_select_all" type="checkbox" id="refund_select_all" value="" class="checkbox_show_query" onclick="querySelectAll('refund', 'formQueryRefund')" />
						<span><?php echo CREFUND_SHOW_QUERY_SELECT_ALL; ?></span>
					</div>
			<?php
			$j = 1;
			foreach ($groupActions as $value)
			{
				if ($value['confirm'] === TRUE)
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryRefund\', \''.$value['file'].'\', \''.$actionsParams.'\', true, \''.$value['msg'].'\');"';
				}
				else
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryRefund\', \''.$value['file'].'\', \''.$actionsParams.'\', false, \'\');"';
				}

				if ($value['button'] === TRUE)
				{
					echo '<input type="button" name="refund_ga_'.$j.'" id="refund_ga_'.$j.'" value="'.$value['text'].'" class="'.$value['class'].'" '.$onclick.' />';
				}
				else
				{
					if ($value['image'] == '')
					{
						echo '<a href="#" title="'.$value['title'].'" '.$onclick.' class="'.$value['class'].'">'.$value['text'].'</a>';
					}
					else
					{
						echo '<a href="#" title="'.$value['title'].'" '.$onclick.' class="'.$value['class'].'"><img src="'.$value['image'].'" alt="'.$value['title'].'" /></a>';
					}
				}
				$j++;
			}
			?>
					<div class="clear"></div>
				</div>
		<?php
		}
		?>
				</form>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Elimina los registros de la tabla movement que están relacionados con una sale
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"DELETE FROM `tabla` WHERE id_sale = '1'"</b>.
	 * Para poder eliminar el registro debe estar seteada la clave primaria de la sale. Devuelve TRUE si se pudo eliminar el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link delForm()}
	 * @return boolean
	 * @access public
	 */
	public function delSaleRefund()
	{
	    if (validateRequiredValue($this->idSale) === TRUE)
	    {
            //Traigo todos los refund de una venta
	        $sql = 'SELECT id FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_sale').' = '.$this->getValueSql($this->idSale);

	        $rs = $this->getDbConn()->Execute($sql);

	        if ($rs !== FALSE)
	        {
	            while (!$rs->EOF)
	            {
	                $this->setId($rs->fields['id']);
	                $this->delRefund();

	               $rs->MoveNext();
	            }
	        }

	        return TRUE;
	    }
	    else
	    {
	        $this->addError(CREFUND_DEL_REQUIRED_PK);

	        return FALSE;
	    }
	}

	/**
	 * Borra el refund
	 *
	 * @return boolean
	 */
	public function delRefund()
	{
	    if (validateRequiredValue($this->id) === TRUE)
	    {
	        if($this->del() == TRUE)
	        {
    	        $sale          = new Csale($this->getDbConn());
    	        $payment       = new Cpayment($this->getDbConn());
    	        $detail        = new Cdetail($this->getDbConn());
    	        $detailRefund  = new Cdetail_refund($this->getDbConn());
    	        $detailPayment = new Cdetail_payment($this->getDbConn());
    	        $movement      = new Cmovement($this->getDbConn());

    	        $idMovementSale    = 0;
    	        $idMovementPayment = 0;

    	        //Cambiar estado a los productos devueltos. Ver si estaban antes vendidos o pagados

    	        /**
    	         * Si tengo un refund posterior no cambiar estados
    	         */


    	        $search = $detailRefund->getFieldSql('id_refund', $detailRefund->getTableName()).' = '.$detailRefund->getValueSql($this->getId(FALSE));

    	        $rs = $detailRefund->getList($search, 0, 0, '', FALSE);

    	        if ($detailRefund->getTotalList() > 0)
    	        {
    	            foreach ($rs as $item)
    	            {
    	                $search2 = $detailRefund->getFieldSql('id_product', $detailRefund->getTableName()).' = '.$detailRefund->getValueSql($item['idProduct']).' AND '.$detailRefund->getFieldSql('id_refund', $detailRefund->getTableName()).' > '.$detailRefund->getValueSql($this->getId(FALSE));

    	                $rs2 = $detailRefund->getList($search2, 0, 0, '', FALSE);

    	                //Si no hay un refund que se haya hecho después del que estoy borrando hago los cambios de estado de los productos
                        if(is_array($rs2) == TRUE and count($rs2) == 0)
                        {
        	                //Consigo la última venta
        	                $sql = 'SELECT MAX(id_sale) AS idSale FROM '.$detail->getTableSql().' WHERE '.$detail->getFieldSql('id_product').' = '.$detail->getValueSql($item['idProduct']);

        	                $row = $detail->getDbConn()->GetRow($sql);

        	                if (is_array($row) === TRUE and count($row) > 0 and $row['idSale'] > 0)
        	                {
        	                    $sale->setId($row['idSale']);
        	                    $sale->getData();
        	                }

        	                //Consigo el último pago al proveedor
        	                $sql = 'SELECT MAX(id_payment) AS idPayment FROM '.$detailPayment->getTableSql().' WHERE '.$detailPayment->getFieldSql('id_product').' = '.$detailPayment->getValueSql($item['idProduct']);

        	                $row = $detailPayment->getDbConn()->GetRow($sql);

        	                if (is_array($row) === TRUE and count($row) > 0 and $row['idPayment'] > 0)
        	                {
        	                    $payment->setId($row['idPayment']);
        	                    $payment->getData();
        	                }

        	                $sql = 'SELECT MAX(id) AS id FROM '.$movement->getTableSql().' WHERE '.$movement->getFieldSql('id_sale').' = '.$movement->getValueSql($sale->getId(FALSE)).' AND '.$movement->getFieldSql('type_movement').' = '.$movement->getValueSql('sale');
        	                $row = $detailPayment->getDbConn()->GetRow($sql);

        	                if (is_array($row) === TRUE and count($row) > 0 and $row['id'] > 0)
        	                {
        	                    $idMovementSale = $row['id'];
        	                }

        	                $sql = 'SELECT MAX(id) AS id FROM '.$movement->getTableSql().' WHERE '.$movement->getFieldSql('id_payment').' = '.$movement->getValueSql($payment->getId(FALSE)).' AND '.$movement->getFieldSql('type_movement').' = '.$movement->getValueSql('payment_to_provider');
        	                $row = $detailPayment->getDbConn()->GetRow($sql);

        	                if (is_array($row) === TRUE and count($row) > 0 and $row['id'] > 0)
        	                {
        	                    $idMovementPayment = $row['id'];
        	                }

        	                //Si la venta tiene un ID de movimiento mayor es que fue lo último que se hizo y por ende pongo al producto como sold. Sino lo pongo como pagado.
        	                if($idMovementSale > $idMovementPayment)
        	                {
        	                    $detailRefund->uptateProductStatus($item['idProduct'], 'sold', date($this->getDbConn()->fmtDate));
        	                }
        	                else
        	                {
        	                    $detailRefund->uptateProductStatus($item['idProduct'], 'paid_out', date($this->getDbConn()->fmtDate));
        	                }
                        }
    	            }
    	        }

    	        //Borrar los movements que ocasionó el refund.
    	        $movement->setIdRefund($this->getId(FALSE));
    	        $movement->delRefundMovement();

    	        //Borro todos los detalles de este refund
    	        $detailRefund->setIdRefund($this->id);
    	        $detailRefund->delDetail();

    	        return TRUE;
	        }
	        else
	        {
	            $this->addError(CREFUND_DEL_ERROR);

	            return FALSE;
	        }
	    }
	    else
	    {
	        $this->addError(CREFUND_DEL_REQUIRED_PK);

	        return FALSE;
	    }

	}

	/**
	 * Verifica si un refund se puede borrar.
	 *
	 * Si existe una venta posterior de un producto que estaba en un refund no se permite borrar.
	 */
	public function canDelete()
	{
	    if (validateRequiredValue($this->id) === TRUE)
	    {
	        if($this->getData() == TRUE)
	        {
    	        $detailRefund = new Cdetail_refund($this->getDbConn());
    	        $sale         = new Csale($this->getDbConn());
    	        $sale->setId($this->getIdSale(FALSE));

    	        $search       = $detailRefund->getFieldSql('id_refund', $detailRefund->getTableName()).' = '.$detailRefund->getValueSql($this->id);
    	        $rs           = $detailRefund->getList($search, 0, 0, '', FALSE);

    	        if ($detailRefund->getTotalList() > 0)
    	        {
    	            foreach ($rs as $item)
    	            {
    	                if($sale->productHasSaleAfterRefund($item['idProduct']) == TRUE)
    	                {
    	                    return FALSE;
    	                }
    	            }
    	        }

    	        return TRUE;
	        }
	        else
	        {
	            $this->addError(CREFUND_GETDATA_ERROR);

	            return FALSE;
	        }
	    }
        else
        {
            $this->addError(CREFUND_DEL_REQUIRED_PK);

            return FALSE;
        }
	}
}
?>