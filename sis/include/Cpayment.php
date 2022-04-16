<?php
/**
 * Archivo php creado por O-creator
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla payment
 *
 * Esta clase se encarga de la administración de la tabla payment brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Cpayment.php');
 * $payment = new Cpayment();
 * $payment->setDbConn($dbConn);
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:28-05-2020
 */
class Cpayment extends Cbase
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
	 * <b>Relación</b>
	 * Este campo es usado como clave foránea en:
	 * - Tabla: {@link Cdetail_payment detail_payment}
	 * - Campo: {@link Cdetail_payment::$idPayment idPayment}
	 * - Interfaz: dependiente
	 * - Eliminar: cascada
	 * - Detalle requerido: Sí
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
	 * Devuelto
	 *
	 * - Campo en la base de datos: total_amount_back
	 * - Tipo de campo en la base de datos: int(11)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * Ver también: {@link getTotalAmountBack()}, {@link setTotalAmountBack()}
	 * @var integer
	 * @access private
	 */
	private $totalAmountBack;

	/**
	 * Pagado
	 *
	 * - Campo en la base de datos: total_amount_pay
	 * - Tipo de campo en la base de datos: decimal(10,2)
	 * - Extra: Decimal, positivo sin el cero [+] (ver {@link validateDecimalValue()})
	 * - Número de decimales: 2
	 *
	 * Ver también: {@link getTotalAmountPay()}, {@link setTotalAmountPay()}
	 * @var float
	 * @access private
	 */
	private $totalAmountPay;

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
	 * Proveedor
	 *
	 * - Clave Foránea
	 * - Campo en la base de datos: id_provider
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 * - Campo requerido
	 *
	 * <b>Relación</b>
	 * Este campo es clave foránea a:
	 * - Tabla: {@link Cprovider provider}
	 * - Campo: {@link Cprovider::$id id}
	 * - Campo que se muestra: {@link Cprovider::$name name}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * Ver también: {@link getIdProvider()}, {@link setIdProvider()}
	 * @var integer
	 * @access private
	 */
	private $idProvider;

	/**
	 * Donado
	 *
	 * - Campo en la base de datos: total_amount_donate
	 * - Tipo de campo en la base de datos: int(11)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * Ver también: {@link getTotalAmountDonate()}, {@link setTotalAmountDonate()}
	 * @var integer
	 * @access private
	 */
	private $totalAmountDonate;
	/**
	 * Constructor de la clase
	 *
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('payment');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cpayment.php');
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
			$this->addError(CPAYMENT_SETID_REQUIRED_VALUE);

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
				$this->addError(CPAYMENT_SETID_VALIDATE_VALUE);

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
	 * $payment = new Cpayment();
	 * //seteo en el formato que acepta la base de datos (yyyy-mm-dd)
	 * $payment->setDateAdded('1980-11-24', TRUE);
	 * //seteo en el formato definido en la configuración del script (suponemos que el formato utilizado es dd-mm-yyyy)
	 * $payment->setDateAdded('24-11-1980', FALSE);
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
			$this->addError(CPAYMENT_SETDATE_ADDED_REQUIRED_VALUE);

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
					$this->addError(CPAYMENT_SETDATE_ADDED_VALIDATE_VALUE);

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
					$this->addError(CPAYMENT_SETDATE_ADDED_VALIDATE_VALUE);

					return FALSE;
				}
			}
			else
			{
				$this->dateAdded = '';
				$this->addError(CPAYMENT_SETDATE_ADDED_ERROR);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $totalAmountBack Devuelto}
	 *
	 * @param integer $totalAmountBack indica el valor Devuelto
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setTotalAmountBack($totalAmountBack, $gpc = FALSE)
	{
		if ($totalAmountBack == '0')
		{
			$totalAmountBack = '';
		}
		$this->totalAmountBack = setValue($totalAmountBack, $gpc);

		if (validateIntValue($this->totalAmountBack, '+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CPAYMENT_SETTOTAL_AMOUNT_BACK_VALIDATE_VALUE);

			return FALSE;
		}
	}

	/**
	 * Setea el valor {@link $totalAmountPay Pagado}
	 *
	 * @param float $totalAmountPay indica el valor Pagado
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setTotalAmountPay($totalAmountPay, $gpc = FALSE)
	{
		if ($totalAmountPay == '0')
		{
			$totalAmountPay = '';
		}
		$this->totalAmountPay = setValue($totalAmountPay, $gpc);

		if (validateDecimalValue($this->totalAmountPay, '+') === TRUE)
		{
			if (validateRequiredValue($totalAmountPay) === TRUE)
			{
				$this->totalAmountPay = numberFormat($totalAmountPay, 2);
			}
			return TRUE;
		}
		else
		{
			$this->addError(CPAYMENT_SETTOTAL_AMOUNT_PAY_VALIDATE_VALUE);

			return FALSE;
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
			$this->addError(CPAYMENT_SETID_USER_ADD_REQUIRED_VALUE);

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
				$this->addError(CPAYMENT_SETID_USER_ADD_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $idProvider Proveedor}
	 *
	 * @param integer $idProvider indica el valor Proveedor
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdProvider($idProvider, $gpc = FALSE)
	{
		if (validateRequiredValue($idProvider) === FALSE)
		{
			$this->idProvider = $idProvider;
			$this->addError(CPAYMENT_SETID_PROVIDER_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->idProvider = setValue($idProvider, $gpc);

			if (validateIntValue($this->idProvider, '+') === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CPAYMENT_SETID_PROVIDER_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $totalAmountDonate Donado}
	 *
	 * @param integer $totalAmountDonate indica el valor Donado
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setTotalAmountDonate($totalAmountDonate, $gpc = FALSE)
	{
		if ($totalAmountDonate == '0')
		{
			$totalAmountDonate = '';
		}
		$this->totalAmountDonate = setValue($totalAmountDonate, $gpc);
		if (validateIntValue($this->totalAmountDonate, '+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CPAYMENT_SETTOTAL_AMOUNT_DONATE_VALIDATE_VALUE);
			return FALSE;
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
	 * $payment = new Cpayment();
	 * $payment->setDateAdded('1980-11-24', TRUE);
	 * echo 'Fecha en formato del script: ';
	 * echo $payment->getDateAdded().'<br />';
	 * echo 'Fecha en el formato que acepta la base de datos: ';
	 * echo $payment->getDateAdded(TRUE).'<br />';
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
	 * Devuelve el valor {@link $totalAmountBack Devuelto}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getTotalAmountBack($htmlEntities = TRUE)
	{
		return getValue($this->totalAmountBack, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $totalAmountPay Pagado}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return float
	 * @access public
	 */
	public function getTotalAmountPay($htmlEntities = TRUE)
	{
		return getValue($this->totalAmountPay, $htmlEntities, $this->getCharset());
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
	 * Devuelve el valor {@link $idProvider Proveedor}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdProvider($htmlEntities = TRUE)
	{
		return getValue($this->idProvider, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $totalAmountDonate Donado}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getTotalAmountDonate($htmlEntities = TRUE)
	{
		return getValue($this->totalAmountDonate, $htmlEntities, $this->getCharset());
	}
	/**
	 * Inserta un nuevo registro en la tabla payment
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

		if (isset($this->totalAmountBack) === TRUE)
		{
			$fields[] = $this->getFieldSql('total_amount_back');

			if (validateRequiredValue($this->totalAmountBack) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->totalAmountBack);
			}
		}

		if (isset($this->totalAmountPay) === TRUE)
		{
			$fields[] = $this->getFieldSql('total_amount_pay');

			if (validateRequiredValue($this->totalAmountPay) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->totalAmountPay);
			}
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

		if (isset($this->idProvider) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_provider');

			if (validateRequiredValue($this->idProvider) === FALSE)
			{
				$values[] = 'NULL';
			}
			else
			{
				$values[] = $this->getValueSql($this->idProvider);
			}
		}
		if (isset($this->totalAmountDonate) === TRUE)
		{
			$fields[] = $this->getFieldSql('total_amount_donate');
			if (validateRequiredValue($this->totalAmountDonate) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->totalAmountDonate);
			}
		}

		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CPAYMENT_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla payment
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

			if (isset($this->totalAmountBack) === TRUE)
			{
				if (validateRequiredValue($this->totalAmountBack) === FALSE)
				{
					$values[] = $this->getFieldSql('total_amount_back').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('total_amount_back').' = '.$this->getValueSql($this->totalAmountBack);
				}
			}

			if (isset($this->totalAmountPay) === TRUE)
			{
				if (validateRequiredValue($this->totalAmountPay) === FALSE)
				{
					$values[] = $this->getFieldSql('total_amount_pay').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('total_amount_pay').' = '.$this->getValueSql($this->totalAmountPay);
				}
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

			if (isset($this->idProvider) === TRUE)
			{
				if (validateRequiredValue($this->idProvider) === FALSE)
				{
					$values[] = $this->getFieldSql('id_provider').' = NULL';
				}
				else
				{
					$values[] = $this->getFieldSql('id_provider').' = '.$this->getValueSql($this->idProvider);
				}
			}

			if (isset($this->totalAmountDonate) === TRUE)
			{
				if (validateRequiredValue($this->totalAmountDonate) === FALSE)
				{
					$values[] = $this->getFieldSql('total_amount_donate').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('total_amount_donate').' = '.$this->getValueSql($this->totalAmountDonate);
				}
			}
			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CPAYMENT_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CPAYMENT_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla payment
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
				$this->addError(CPAYMENT_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CPAYMENT_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla payment
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
				$this->setTotalAmountBack($row['total_amount_back']);
				$this->setTotalAmountPay($row['total_amount_pay']);
				$this->setIdUserAdd($row['id_user_add']);
				$this->setIdProvider($row['id_provider']);
				$this->setTotalAmountDonate($row['total_amount_donate']);

				return TRUE;
			}
			else
			{
				$this->addError(CPAYMENT_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CPAYMENT_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un conjunto de registros de la tabla payment
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

		$oIdProvider = new Cprovider();
		$oIdProvider->setDbConn($this->getDbConn());

		$sql = 'SELECT ';
		$sql.= $this->getFieldSql('id', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('date_added', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('total_amount_back', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('total_amount_pay', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_user_add', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_provider', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('total_amount_donate', $this->getTableName());
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
		$sql.= ', '.$this->getFieldSql('id', $oIdProvider->getTableName(), 'provider_id');
		$sql.= ', '.$this->getFieldSql('name', $oIdProvider->getTableName(), 'provider_name');
		$sql.= ', '.$this->getFieldSql('email', $oIdProvider->getTableName(), 'provider_email');
		$sql.= ', '.$this->getFieldSql('phone', $oIdProvider->getTableName(), 'provider_phone');
		$sql.= ' FROM '.$this->getTableSql();
		$sql.= ' LEFT JOIN '.$oIdUserAdd->getTableSql().' ON '.$this->getFieldSql('id_user_add', $this->getTableName()).' = '.$oIdUserAdd->getFieldSql('id', $oIdUserAdd->getTableName());
		$sql.= ' LEFT JOIN '.$oIdProvider->getTableSql().' ON '.$this->getFieldSql('id_provider', $this->getTableName()).' = '.$oIdProvider->getFieldSql('id', $oIdProvider->getTableName());
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
				$this->addError(CPAYMENT_GETLIST_ERROR);

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
					$this->setTotalAmountBack($rs->fields['total_amount_back']);
					$this->setTotalAmountPay($rs->fields['total_amount_pay']);
					$this->setIdUserAdd($rs->fields['id_user_add']);
					$this->setIdProvider($rs->fields['id_provider']);
					$this->setTotalAmountDonate($rs->fields['total_amount_donate']);

					$oIdUserAdd->setName($rs->fields['user_name']);
					$oIdProvider->setName($rs->fields['provider_name']);

					$list[] = array(
						'id' => $this->getId($htmlEntities) ,
						'dateAdded' => $this->getDateAdded() ,
						'totalAmountBack' => $this->getTotalAmountBack($htmlEntities) ,
						'totalAmountPay' => $this->getTotalAmountPay($htmlEntities) ,
						'idUserAdd' => $this->getIdUserAdd($htmlEntities) ,
						'idProvider' => $this->getIdProvider($htmlEntities) ,
						'totalAmountDonate' => $this->getTotalAmountDonate($htmlEntities) ,
						'userName' => $oIdUserAdd->getName($htmlEntities) ,
						'providerName' => $oIdProvider->getName($htmlEntities)
					);

					$rs->MoveNext();
				}

				$this->id = NULL;
				$this->dateAdded = NULL;
				$this->totalAmountBack = NULL;
				$this->totalAmountPay = NULL;
				$this->idUserAdd = NULL;
				$this->idProvider = NULL;
				$this->totalAmountDonate = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CPAYMENT_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}

	/**
	 * Devuelve el último valor ID insertado en la tabla payment
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
			$this->addError(CPAYMENT_GET_LAST_ID_ERROR);

			return FALSE;
		}
		else
		{
			return $row['id'];
		}
	}

	/**
	 * Muestra un formulario para dar de alta un registro de la tabla payment
	 *
	 * Este método muestra un formulario para dar de alta un registro de la tabla payment mostrando sólo los campos seteados en el parámetro $fields.
	 *
	 * El parámetro $configDetail es un array asociativo con el siguiente formato:
	 * <code>
	 * <?php
	 * $configDetail['table']['control_file'] = 'table_control_file.php';
	 * $configDetail['table']['fields']       = $fieldsDetail;
	 * $configDetail['table']['update']       = $updateAction;
	 * $configDetail['table']['delete']       = $delAction;
	 * $configDetail['table']['title']        = 'Detalle';
	 * ?>
	 * </code>
	 * - 'control_file' : url del archivo que realiza las validaciones correspondientes
	 * - 'fields' : array con los campos que se van a mostrar de la relación
	 * - 'update' : array con la configuración de la acción modificar ítem de la relación
	 * - 'delete' : array con la configuración de la acción eliminar ítem de la relación
	 * - 'title' : título del formulario de la relación
	 *
	 * El primer índice indica la tabla de la relación
	 *
	 * Para ver información más detallada:
	 * - {@link Cdetail_payment::formDetail() Cdetail_payment: formDetail}
	 *
	 * Ver también: {@link add()}, {@link updateForm()}
	 * @param string $fields [opcional] cadena con los campos (separados con comas) que se van a mostrar en el formulario. Ej: "campo1,campo2,campo3, ... ,campoN"
	 * @param string $href [opcional] indica la página a la que se redirecciona cuando se cancela el formulario o cuando el registro es insertado en forma correcta
	 * @param boolean $autoRedirect [opcional] indica si se debe auto redireccionar a la página definida en $href una vez que se insertó en forma correcta el registro
	 * @param string $title [opcional] título
	 * @param array $configDetail [opcional] array con la configuración de las relaciones con otras tablas
	 * @return mixed
	 * @access public
	 */
	public function addForm($fields = '', $href = '', $autoRedirect = FALSE, $title = '', $configDetail = '')
	{
		if (validateRequiredValue($fields) === FALSE)
		{
			$fields = 'id,dateAdded,totalAmountBack,totalAmountPay,idUserAdd,idProvider,totalAmountDonate';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['addPayment']) === FALSE)
		{
			$_POST['addPayment'] = '';
		}
		if (isset($_POST['uniqueIDdetail_payment']) === FALSE)
		{
			$_POST['uniqueIDdetail_payment'] = '';
		}
		$detail_payment = new Cdetail_payment();
		$detail_payment->setDbConn($this->getDbConn());
		if (isset($configDetail['detail_payment']['control_file']) === FALSE)
		{
			$configDetail['detail_payment']['control_file'] = 'detail_payment.php';
		}
		if (isset($configDetail['detail_payment']['fields']) === FALSE)
		{
			$configDetail['detail_payment']['fields'] = '';
		}
		if (isset($configDetail['detail_payment']['update']) === FALSE)
		{
			$configDetail['detail_payment']['update'] = '';
		}
		if (isset($configDetail['detail_payment']['delete']) === FALSE)
		{
			$configDetail['detail_payment']['delete'] = '';
		}
		if (isset($configDetail['detail_payment']['title']) === FALSE)
		{
			$configDetail['detail_payment']['title'] = '&nbsp;';
		}

		if ($_POST['addPayment'] == 'add')
		{
			if (in_array('dateAdded', $arrayFields) === TRUE)
			{
				$this->setDateAdded($_POST['dateAdded'], FALSE);
			}
			if (in_array('totalAmountBack', $arrayFields) === TRUE)
			{
				$this->setTotalAmountBack($_POST['totalAmountBack'], TRUE);
			}
			if (in_array('totalAmountPay', $arrayFields) === TRUE)
			{
				$this->setTotalAmountPay($_POST['totalAmountPay'], TRUE);
			}
			if (in_array('idUserAdd', $arrayFields) === TRUE)
			{
				$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
			}
			if (in_array('idProvider', $arrayFields) === TRUE)
			{
				$this->setIdProvider($_POST['idProvider'], TRUE);
			}
			if (in_array('totalAmountDonate', $arrayFields) === TRUE)
			{
				$this->setTotalAmountDonate($_POST['totalAmountDonate'], TRUE);
			}
			if ($detail_payment->validateRequiredDetail($_POST['uniqueIDdetail_payment']) === FALSE)
			{
				$this->addError(CPAYMENT_ADD_FORM_REQUIRED_DETAIL_DETAIL_PAYMENT);
			}
			if ($this->error() === FALSE)
			{
				$this->add();

				if ($this->error() === FALSE)
				{
					$id = $this->getLastId();
					$detail_payment->setIdPayment($id);
					$detail_payment->addDetail($configDetail['detail_payment']['fields'], $_POST['uniqueIDdetail_payment']);
				}
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
					<div class="message success"><?php echo CPAYMENT_ADD_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CPAYMENT_ADD_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="success" />
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
				<form name="formAddPayment" id="formAddPayment" method="post" action="">
				<input name="addPayment" type="hidden" id="addPayment" value="back" />
				<div class="fields">
				<?php
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					echo '<input name="dateAdded" type="hidden" id="dateAdded" value="'.$this->getDateAdded().'" />';
				}
				if (in_array('totalAmountBack', $arrayFields) === TRUE)
				{
					echo '<input name="totalAmountBack" type="hidden" id="totalAmountBack" value="'.$this->getTotalAmountBack().'" />';
				}
				if (in_array('totalAmountPay', $arrayFields) === TRUE)
				{
					echo '<input name="totalAmountPay" type="hidden" id="totalAmountPay" value="'.$this->getTotalAmountPay().'" />';
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					echo '<input name="idUserAdd" type="hidden" id="idUserAdd" value="'.$this->getIdUserAdd().'" />';
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';
				}
				if (in_array('totalAmountDonate', $arrayFields) === TRUE)
				{
					echo '<input name="totalAmountDonate" type="hidden" id="totalAmountDonate" value="'.$this->getTotalAmountDonate().'" />';
				}
				echo '<input name="uniqueIDdetail_payment" type="hidden"  value="'.$_POST['uniqueIDdetail_payment'].'" />';
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPAYMENT_ADD_FORM_BACK_BTN; ?>" class="back" />
				</div>
				</form>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
		else
		{
			if ($_POST['addPayment'] == 'back')
			{
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					$this->setDateAdded($_POST['dateAdded'], FALSE);
				}
				if (in_array('totalAmountBack', $arrayFields) === TRUE)
				{
					$this->setTotalAmountBack($_POST['totalAmountBack'], TRUE);
				}
				if (in_array('totalAmountPay', $arrayFields) === TRUE)
				{
					$this->setTotalAmountPay($_POST['totalAmountPay'], TRUE);
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					$this->setIdProvider($_POST['idProvider'], TRUE);
				}
				if (in_array('totalAmountDonate', $arrayFields) === TRUE)
				{
					$this->setTotalAmountDonate($_POST['totalAmountDonate'], TRUE);
				}
				$uniqueIDdetail_payment = $_POST['uniqueIDdetail_payment'];
			}
			else
			{
				$uniqueIDdetail_payment = uniqid('detail_payment_');
				$_SESSION[$uniqueIDdetail_payment] = array();
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
				<form name="formAddPayment" id="formAddPayment" method="post" action="">
				<input name="addPayment" type="hidden" id="addPayment" value="add" />
				<div class="fields">
			<?php
			foreach ($arrayFields as $value)
			{
				if ($value == 'dateAdded')
				{
				?>
					<div class="field">
						<label><?php echo CPAYMENT_ADD_FORM_LABEL_FIELD_DATE_ADDED; ?> <span>*</span></label>
						<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
				<?php
				}
				if ($value == 'totalAmountBack')
				{
				?>
					<div class="field">
						<label><?php echo CPAYMENT_ADD_FORM_LABEL_FIELD_TOTAL_AMOUNT_BACK; ?></label>
						<input name="totalAmountBack" type="text" id="totalAmountBack" value="<?php echo $this->getTotalAmountBack(); ?>" class="num" />
					</div>
				<?php
				}
				if ($value == 'totalAmountPay')
				{
				?>
					<div class="field">
						<label><?php echo CPAYMENT_ADD_FORM_LABEL_FIELD_TOTAL_AMOUNT_PAY; ?></label>
						<input name="totalAmountPay" type="text" id="totalAmountPay" value="<?php echo $this->getTotalAmountPay(); ?>" class="num" />
					</div>
				<?php
				}
				if ($value == 'idUserAdd')
				{
				?>
					<div class="field">
						<label><?php echo CPAYMENT_ADD_FORM_LABEL_FIELD_ID_USER_ADD; ?> <span>*</span></label>
					<?php
					$oIdUserAdd = new Cuser();
					$oIdUserAdd->setDbConn($this->getDbConn());
					$oIdUserAdd->showList('name', 'name', $this->getIdUserAdd(), 'idUserAdd', 'idUserAdd', 'select');
					?>
					</div>
				<?php
				}
				if ($value == 'idProvider')
				{
				?>
					<div class="field">
						<label><?php echo CPAYMENT_ADD_FORM_LABEL_FIELD_ID_PROVIDER; ?> <span>*</span></label>
					<?php
					$oIdProvider = new Cprovider();
					$oIdProvider->setDbConn($this->getDbConn());
					$oIdProvider->showList('name', 'name', $this->getIdProvider(), 'idProvider', 'idProvider', 'select');
					?>
					</div>
				<?php
				}
				if ($value == 'totalAmountDonate')
				{
				?>
					<div class="field">
						<label><?php echo CPAYMENT_ADD_FORM_LABEL_FIELD_TOTAL_AMOUNT_DONATE; ?></label>
						<input name="totalAmountDonate" type="text" id="totalAmountDonate" value="<?php echo $this->getTotalAmountDonate(); ?>" class="num" />
					</div>
				<?php
				}
			}
			?>
				</div>
				<div class="detail">
					<input name="uniqueIDdetail_payment" value="<?php echo $uniqueIDdetail_payment; ?>" type="hidden" />
			<?php
			$detail_payment->formDetail($configDetail['detail_payment']['control_file'], $configDetail['detail_payment']['fields'], $configDetail['detail_payment']['update'], $configDetail['detail_payment']['delete'], $configDetail['detail_payment']['title'], $uniqueIDdetail_payment);
			?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPAYMENT_ADD_FORM_SUBMIT_BTN; ?>" class="accept" />
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CPAYMENT_ADD_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
			<?php
			}
			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CPAYMENT_ADD_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Muestra un formulario para actualizar un registro existente de la tabla payment
	 *
	 * Este método muestra un formulario para actualizar un registro de la tabla payment mostrando sólo los campos seteados en el parámetro $fields.
	 * Debe estar seteada la clave primaria del registro que se quiere modificar.
	 *
	 * El parámetro $configDetail es un array asociativo con el siguiente formato:
	 * <code>
	 * <?php
	 * $configDetail['table']['control_file'] = 'table_control_file.php';
	 * $configDetail['table']['fields']       = $fieldsDetail;
	 * $configDetail['table']['update']       = $updateAction;
	 * $configDetail['table']['delete']       = $delAction;
	 * $configDetail['table']['title']        = 'Detalle';
	 * ?>
	 * </code>
	 * - 'control_file' : url del archivo que realiza las validaciones correspondientes
	 * - 'fields' : array con los campos que se van a mostrar de la relación
	 * - 'update' : array con la configuración de la acción modificar ítem de la relación
	 * - 'delete' : array con la configuración de la acción eliminar ítem de la relación
	 * - 'title' : título del formulario de la relación
	 *
	 * El primer índice indica la tabla de la relación
	 *
	 * Para ver información más detallada:
	 * - {@link Cdetail_payment::formDetail() Cdetail_payment: formDetail}
	 *
	 * Ver también: {@link update()}, {@link addForm()}
	 * @param string $fields [opcional] cadena con los campos (separados con comas) que se van a mostrar en el formulario. Ej: "campo1,campo2,campo3, ... ,campoN"
	 * @param string $href [opcional] indica la página a la que se redirecciona cuando se cancela el formulario o cuando el registro es modificado en forma correcta
	 * @param boolean $autoRedirect [opcional] indica si se debe auto redireccionar a la página definida en $href una vez que se modificó en forma correcta el registro
	 * @param string $title [opcional] título
	 * @param array $configDetail [opcional] array con la configuración de las relaciones con otras tablas
	 * @return mixed
	 * @access public
	 */
	public function updateForm($fields = '', $href = '', $autoRedirect = FALSE, $title = '', $configDetail = '')
	{
		if (validateRequiredValue($fields) === FALSE)
		{
			$fields = 'id,dateAdded,totalAmountBack,totalAmountPay,idUserAdd,idProvider,totalAmountDonate';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['updatePayment']) === FALSE)
		{
			$_POST['updatePayment'] = '';
		}

		if (isset($_POST['uniqueIDdetail_payment']) === FALSE)
		{
			$_POST['uniqueIDdetail_payment'] = '';
		}
		if (isset($_GET['p']) === FALSE)
		{
			$_GET['p'] = '';
		}
		$detail_payment = new Cdetail_payment();
		$detail_payment->setDbConn($this->getDbConn());
		if (isset($configDetail['detail_payment']['control_file']) === FALSE)
		{
			$configDetail['detail_payment']['control_file'] = 'detail_payment.php';
		}
		if (isset($configDetail['detail_payment']['fields']) === FALSE)
		{
			$configDetail['detail_payment']['fields'] = '';
		}
		if (isset($configDetail['detail_payment']['update']) === FALSE)
		{
			$configDetail['detail_payment']['update'] = '';
		}
		if (isset($configDetail['detail_payment']['delete']) === FALSE)
		{
			$configDetail['detail_payment']['delete'] = '';
		}
		if (isset($configDetail['detail_payment']['title']) === FALSE)
		{
			$configDetail['detail_payment']['title'] = '&nbsp;';
		}

		if ($_POST['updatePayment'] == 'update')
		{
			$this->setId($_POST['id'], TRUE);
			if (in_array('dateAdded', $arrayFields) === TRUE)
			{
				$this->setDateAdded($_POST['dateAdded'], FALSE);
			}
			if (in_array('totalAmountBack', $arrayFields) === TRUE)
			{
				$this->setTotalAmountBack($_POST['totalAmountBack'], TRUE);
			}
			if (in_array('totalAmountPay', $arrayFields) === TRUE)
			{
				$this->setTotalAmountPay($_POST['totalAmountPay'], TRUE);
			}
			if (in_array('idUserAdd', $arrayFields) === TRUE)
			{
				$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
			}
			if (in_array('idProvider', $arrayFields) === TRUE)
			{
				$this->setIdProvider($_POST['idProvider'], TRUE);
			}
			if (in_array('totalAmountDonate', $arrayFields) === TRUE)
			{
				$this->setTotalAmountDonate($_POST['totalAmountDonate'], TRUE);
			}
			if ($detail_payment->validateRequiredDetail($_POST['uniqueIDdetail_payment']) === FALSE)
			{
				$this->addError(CPAYMENT_UPDATE_FORM_REQUIRED_DETAIL_DETAIL_PAYMENT);
			}
			if ($this->error() === FALSE)
			{
				$this->update();
				if ($this->error() === FALSE)
				{
					$detail_payment->setIdPayment($this->getId(FALSE));
					$detail_payment->updateDetail($configDetail['detail_payment']['fields'], $_POST['uniqueIDdetail_payment']);
				}
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
					<div class="message success"><?php echo CPAYMENT_UPDATE_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CPAYMENT_UPDATE_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
				<form name="formUpdatePayment" id="formUpdatePayment" method="post" action="">
				<input name="updatePayment" type="hidden" id="updatePayment" value="back" />
				<div class="fields">
				<?php
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					echo '<input name="dateAdded" type="hidden" id="dateAdded" value="'.$this->getDateAdded().'" />';
				}
				if (in_array('totalAmountBack', $arrayFields) === TRUE)
				{
					echo '<input name="totalAmountBack" type="hidden" id="totalAmountBack" value="'.$this->getTotalAmountBack().'" />';
				}
				if (in_array('totalAmountPay', $arrayFields) === TRUE)
				{
					echo '<input name="totalAmountPay" type="hidden" id="totalAmountPay" value="'.$this->getTotalAmountPay().'" />';
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					echo '<input name="idUserAdd" type="hidden" id="idUserAdd" value="'.$this->getIdUserAdd().'" />';
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';
				}
				if (in_array('totalAmountDonate', $arrayFields) === TRUE)
				{
					echo '<input name="totalAmountDonate" type="hidden" id="totalAmountDonate" value="'.$this->getTotalAmountDonate().'" />';
				}
				echo '<input name="uniqueIDdetail_payment" type="hidden"  value="'.$_POST['uniqueIDdetail_payment'].'" />';
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPAYMENT_UPDATE_FORM_BACK_BTN; ?>" class="back" />
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
				if ($_POST['updatePayment'] == 'back')
				{
					if (in_array('dateAdded', $arrayFields) === TRUE)
					{
						$this->setDateAdded($_POST['dateAdded'], FALSE);
					}
					if (in_array('totalAmountBack', $arrayFields) === TRUE)
					{
						$this->setTotalAmountBack($_POST['totalAmountBack'], TRUE);
					}
					if (in_array('totalAmountPay', $arrayFields) === TRUE)
					{
						$this->setTotalAmountPay($_POST['totalAmountPay'], TRUE);
					}
					if (in_array('idUserAdd', $arrayFields) === TRUE)
					{
						$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
					}
					if (in_array('idProvider', $arrayFields) === TRUE)
					{
						$this->setIdProvider($_POST['idProvider'], TRUE);
					}
					if (in_array('totalAmountDonate', $arrayFields) === TRUE)
					{
						$this->setTotalAmountDonate($_POST['totalAmountDonate'], TRUE);
					}
					$uniqueIDdetail_payment = $_POST['uniqueIDdetail_payment'];
				}
				else
				{
					$uniqueIDdetail_payment = uniqid('detail_payment_');
					$_SESSION[$uniqueIDdetail_payment] = array();
					$detail_payment->setIdPayment($this->getId(FALSE));
					$detail_payment->loadDetail($uniqueIDdetail_payment);
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
				<form name="formUpdatePayment" id="formUpdatePayment" method="post" action="">
				<input name="updatePayment" type="hidden" id="updatePayment" value="update" />
				<input name="id" type="hidden" id="id" value="<?php echo $this->getId(); ?>" />
				<div class="fields">
				<?php
				foreach ($arrayFields as $value)
				{
					if ($value == 'id')
					{
					?>
					<div class="field">
						<label><?php echo CPAYMENT_UPDATE_FORM_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
					<?php
					}
					if ($value == 'dateAdded')
					{
					?>
					<div class="field">
						<label><?php echo CPAYMENT_UPDATE_FORM_LABEL_FIELD_DATE_ADDED; ?> <span>*</span></label>
						<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
					<?php
					}
					if ($value == 'totalAmountBack')
					{
					?>
					<div class="field">
						<label><?php echo CPAYMENT_UPDATE_FORM_LABEL_FIELD_TOTAL_AMOUNT_BACK; ?></label>
						<input name="totalAmountBack" type="text" id="totalAmountBack" value="<?php echo $this->getTotalAmountBack(); ?>" class="num" />
					</div>
					<?php
					}
					if ($value == 'totalAmountPay')
					{
					?>
					<div class="field">
						<label><?php echo CPAYMENT_UPDATE_FORM_LABEL_FIELD_TOTAL_AMOUNT_PAY; ?></label>
						<input name="totalAmountPay" type="text" id="totalAmountPay" value="<?php echo $this->getTotalAmountPay(); ?>" class="num" />
					</div>
					<?php
					}
					if ($value == 'idUserAdd')
					{
					?>
					<div class="field">
						<label><?php echo CPAYMENT_UPDATE_FORM_LABEL_FIELD_ID_USER_ADD; ?> <span>*</span></label>
						<?php
						$oIdUserAdd = new Cuser();
						$oIdUserAdd->setDbConn($this->getDbConn());
						$oIdUserAdd->showList('name', 'name', $this->getIdUserAdd(), 'idUserAdd', 'idUserAdd', 'select');
						?>
					</div>
					<?php
					}
					if ($value == 'idProvider')
					{
					?>
					<div class="field">
						<label><?php echo CPAYMENT_UPDATE_FORM_LABEL_FIELD_ID_PROVIDER; ?> <span>*</span></label>
						<?php
						$oIdProvider = new Cprovider();
						$oIdProvider->setDbConn($this->getDbConn());
						$oIdProvider->showList('name', 'name', $this->getIdProvider(), 'idProvider', 'idProvider', 'select');
						?>
					</div>
					<?php
					}
					if ($value == 'totalAmountDonate')
					{
					?>
					<div class="field">
						<label><?php echo CPAYMENT_UPDATE_FORM_LABEL_FIELD_TOTAL_AMOUNT_DONATE; ?></label>
						<input name="totalAmountDonate" type="text" id="totalAmountDonate" value="<?php echo $this->getTotalAmountDonate(); ?>" class="num" />
					</div>
					<?php
					}
				}
				?>
				</div>
				<div class="detail">
					<input name="uniqueIDdetail_payment" value="<?php echo $uniqueIDdetail_payment; ?>" type="hidden" />
					<?php
					$detail_payment->formDetail($configDetail['detail_payment']['control_file'], $configDetail['detail_payment']['fields'], $configDetail['detail_payment']['update'], $configDetail['detail_payment']['delete'], $configDetail['detail_payment']['title'], $uniqueIDdetail_payment);
					?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPAYMENT_UPDATE_FORM_SUBMIT_BTN; ?>" class="accept" />
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CPAYMENT_UPDATE_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="cancel" />
				<?php
				}
				?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CPAYMENT_UPDATE_FORM_LABEL_REQUIRED; ?></span>
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
					<input type="button" value="<?php echo CPAYMENT_UPDATE_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
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
	 * Elimina un registro existente de la tabla payment y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un registro de la tabla payment y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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

		if ($this->del() === TRUE)
		{
			/*$detail_payment = new Cdetail_payment();
			$detail_payment->setIdPayment($this->getId(FALSE));
			$detail_payment->delDetail();*/

		    $this->delPaymentDetail();
		}

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
					<div class="message success"><?php echo CPAYMENT_DEL_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CPAYMENT_DEL_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
					<input type="button" value="<?php echo CPAYMENT_DEL_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
				</div>
		<?php
		}
		?>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Elimina un grupo de registros existente de la tabla payment y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un grupo de registros de la tabla payment y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
					if ($this->del() === FALSE)
					{
						$flagGroup = TRUE;
					}
					else
					{
					    $this->delPaymentDetail();
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
			$this->addError(CPAYMENT_DEL_GROUP_FORM_REQUIRED_PK);
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
					<div class="message success"><?php echo CPAYMENT_DEL_GROUP_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CPAYMENT_DEL_GROUP_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="success" />
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
				$this->addError(CPAYMENT_DEL_GROUP_FORM_CANT_DELETE_ALL);
			}
			?>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="button" value="<?php echo CPAYMENT_DEL_GROUP_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="back" />
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
	 * El parámetro $configDetail es un array asociativo con el siguiente formato:
	 * <code>
	 * <?php
	 * $configDetail['table']['fields'] = $fieldsDetail;
	 * $configDetail['table']['title']  = 'Detalle';
	 * ?>
	 * </code>
	 * - 'fields' : array con los campos que se van a mostrar de la relación
	 * - 'title' : título del listado de la relación
	 *
	 * El primer índice indica la tabla de la relación
	 *
	 * Para ver información más detallada:
	 * - {@link Cdetail_payment::showDetail() Cdetail_payment: showDetail}
	 *
	 * Ver también: {@link getData()}
	 * @param string $fields [opcional] cadena con los campos (separados con comas) que se van a mostrar. Ej: "campo1,campo2,campo3, ... ,campoN"
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML sólo de los campos que son Extra: HTML
	 * @param string $href [opcional] indica la página a la que se redirecciona cuando se hace clic en el botón volver de este método
	 * @param string $title [opcional] título
	 * @param array $configDetail [opcional] array con la configuración de las relaciones con otras tablas
	 * @return mixed
	 * @access public
	 */
	public function showData($fields = '', $htmlEntities = TRUE, $href = '', $title = '', $configDetail = '')
	{
		if (isset($_GET['p']) === FALSE)
		{
			$_GET['p'] = '';
		}

		if (validateRequiredValue($fields) === FALSE)
		{
			$fields = 'id,dateAdded,totalAmountBack,totalAmountPay,idUserAdd,idProvider,totalAmountDonate';
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
						<label><?php echo CPAYMENT_SHOW_DATA_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'dateAdded')
			{
			?>
					<div class="field">
						<label><?php echo CPAYMENT_SHOW_DATA_LABEL_FIELD_DATE_ADDED; ?></label>
						<strong><?php echo $this->getDateAdded(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'totalAmountBack')
			{
			?>
					<div class="field">
						<label><?php echo CPAYMENT_SHOW_DATA_LABEL_FIELD_TOTAL_AMOUNT_BACK; ?></label>
						<strong><?php echo $this->getTotalAmountBack(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'totalAmountPay')
			{
			?>
					<div class="field">
						<label><?php echo CPAYMENT_SHOW_DATA_LABEL_FIELD_TOTAL_AMOUNT_PAY; ?></label>
						<strong><?php echo $this->getTotalAmountPay(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idUserAdd')
			{
			?>
					<div class="field">
						<label><?php echo CPAYMENT_SHOW_DATA_LABEL_FIELD_ID_USER_ADD; ?></label>
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
			if ($value == 'idProvider')
			{
			?>
					<div class="field">
						<label><?php echo CPAYMENT_SHOW_DATA_LABEL_FIELD_ID_PROVIDER; ?></label>
				<?php
				$oIdProvider = new Cprovider();
				$oIdProvider->setDbConn($this->getDbConn());
				$oIdProvider->setId($this->getIdProvider(FALSE));
				$oIdProvider->getData();
				?>
						<strong><?php echo $oIdProvider->getName(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'totalAmountDonate')
			{
			?>
					<div class="field">
						<label><?php echo CPAYMENT_SHOW_DATA_LABEL_FIELD_TOTAL_AMOUNT_DONATE; ?></label>
						<strong><?php echo $this->getTotalAmountDonate(); ?></strong>
					</div>
			<?php
			}
		}
		?>
				</div>
				<div class="detail">
		<?php
		$detail_payment = new Cdetail_payment();
		$detail_payment->setDbConn($this->getDbConn());
		if (isset($configDetail['detail_payment']['fields']) === FALSE)
		{
			$configDetail['detail_payment']['fields'] = '';
		}
		if (isset($configDetail['detail_payment']['title']) === FALSE)
		{
			$configDetail['detail_payment']['title'] = '&nbsp;';
		}
		$detail_payment->setIdPayment($this->getId(FALSE));
		$detail_payment->showDetail($configDetail['detail_payment']['fields'], $configDetail['detail_payment']['title']);
		?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
		<?php
		if (validateRequiredValue($href) === TRUE)
		{
		?>
					<input type="button" value="<?php echo CPAYMENT_SHOW_DATA_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
		<?php
		}
		?>
				</div>
				<div class="bottom"></div>
			</div>
	<?php
	}

	/**
	 * Muestra un formulario de búsqueda de registros de la tabla payment
	 *
	 * Este método muestra un formulario con los campos seteados en el parámetro $fields para realizar una búsqueda de los registros de la tabla payment.
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
			$fields = 'id,dateAdded,totalAmountBack,totalAmountPay,idUserAdd,idProvider,totalAmountDonate';
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
			if (isset($_SESSION['main_tr_search_payment']) === FALSE)
			{
				$_SESSION['main_tr_search_payment'] = '';
			}

			$display  = 'display: none;';
			$btnClass = 'closed';
			if ($_SESSION['main_tr_search_payment'] === 'open')
			{
				$display  = '';
				$btnClass = 'open';
			}
		}
		?>
				<div class="title">
					<div class="ico"><?php if ($showHideBtn === TRUE) { ?><a href="#" onclick="showHideSearch('payment'); return false;" class="<?php echo $btnClass; ?>"></a><?php } ?></div>
					<div class="label"><a href="#" onclick="showHideSearch('payment'); return false;"><?php echo $title; ?></a></div>
				</div>
				<div id="container_search_payment" style="<?php echo $display; ?>">
					<div class="top"></div>
					<form name="formSearchPayment" id="formSearchPayment" method="<?php echo $method; ?>" action="">
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
							<label><?php echo CPAYMENT_SEARCH_FORM_LABEL_FIELD_ID; ?></label>
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
							<label><?php echo CPAYMENT_SEARCH_FORM_LABEL_FIELD_DATE_ADDED; ?></label>
							<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
						</div>
				<?php
				if (validateRequiredValue($this->getDateAdded()) === TRUE)
				{
					$condition[] = $this->getFieldSql('date_added', $this->getTableName()).' = '.$this->getValueSql($this->dateAdded);
					$params[] = 'dateAdded='.urlencode($this->getDateAdded());
				}
			}

			if ($value == 'totalAmountBack')
			{
				$this->setTotalAmountBack($values['totalAmountBack'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPAYMENT_SEARCH_FORM_LABEL_FIELD_TOTAL_AMOUNT_BACK; ?></label>
							<input name="totalAmountBack" type="text" id="totalAmountBack" value="<?php echo $this->getTotalAmountBack(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getTotalAmountBack()) === TRUE)
				{
					$condition[] = $this->getFieldSql('total_amount_back', $this->getTableName()).' = '.$this->getValueSql($this->totalAmountBack);
					$params[] = 'totalAmountBack='.urlencode($this->totalAmountBack);
				}
			}

			if ($value == 'totalAmountPay')
			{
				$this->setTotalAmountPay($values['totalAmountPay'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPAYMENT_SEARCH_FORM_LABEL_FIELD_TOTAL_AMOUNT_PAY; ?></label>
							<input name="totalAmountPay" type="text" id="totalAmountPay" value="<?php echo $this->getTotalAmountPay(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getTotalAmountPay()) === TRUE)
				{
					$condition[] = $this->getFieldSql('total_amount_pay', $this->getTableName()).' = '.$this->getValueSql($this->totalAmountPay);
					$params[] = 'totalAmountPay='.urlencode($this->totalAmountPay);
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
							<label><?php echo CPAYMENT_SEARCH_FORM_LABEL_FIELD_ID_USER_ADD; ?></label>
							<input name="idUserAddAutocomplete" id="idUserAddAutocomplete" value="<?php echo $auxUserName; ?>" class="str autocomplete" maxlength="255" type="text" />
							<input name="idUserAdd" id="idUserAdd" value="<?php echo $this->getIdUserAdd(); ?>" type="hidden" />
				<?php
				/*$oIdUserAdd = new Cuser();
				$oIdUserAdd->setDbConn($this->getDbConn());
				$oIdUserAdd->showList('name', 'name', $this->getIdUserAdd(), 'idUserAdd', 'idUserAdd', 'select_search');*/
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdUserAdd()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_user_add', $this->getTableName()).' = '.$this->getValueSql($this->idUserAdd);
					$params[] = 'idUserAdd='.urlencode($this->idUserAdd);
				}
			}

			if ($value == 'idProvider')
			{
				$this->setIdProvider($values['idProvider'], TRUE);

				$auxProviderName = '';
				if(empty($this->getIdProvider(FALSE)) == FALSE)
				{
				    $auxProvider = new Cprovider($this->getDbConn());
				    $auxProvider->setId($this->getIdProvider(FALSE));
				    if($auxProvider->getData() == TRUE)
				    {
					$auxProviderName = $auxProvider->getName(FALSE);
				    }
				}
				?>
						<div class="field autocompleteWrapper">
							<label><?php echo CPAYMENT_SEARCH_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
							<input name="idProviderAutocomplete" id="idProviderAutocomplete" value="<?php echo $auxProviderName; ?>" class="str autocomplete" maxlength="255" type="text" />
							<input name="idProvider" id="idProvider" value="<?php echo $this->getIdProvider(FALSE); ?>" type="hidden" />
				<?php
				/*$oIdProvider = new Cprovider();
				$oIdProvider->setDbConn($this->getDbConn());
				$oIdProvider->showList('name', 'name', $this->getIdProvider(), 'idProvider', 'idProvider', 'select_search');*/
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdProvider()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_provider', $this->getTableName()).' = '.$this->getValueSql($this->idProvider);
					$params[] = 'idProvider='.urlencode($this->idProvider);
				}
			}
			if ($value == 'totalAmountDonate')
			{
				$this->setTotalAmountDonate($values['totalAmountDonate'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPAYMENT_SEARCH_FORM_LABEL_FIELD_TOTAL_AMOUNT_DONATE; ?></label>
							<input name="totalAmountDonate" type="text" id="totalAmountDonate" value="<?php echo $this->getTotalAmountDonate(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getTotalAmountDonate()) === TRUE)
				{
					$condition[] = $this->getFieldSql('total_amount_donate', $this->getTableName()).' = '.$this->getValueSql($this->totalAmountDonate);
					$params[] = 'totalAmountDonate='.urlencode($this->totalAmountDonate);
				}
			}
		}
		?>
					</div>
					<div class="middle"></div>
					<div class="buttons">
						<input type="submit" value="<?php echo CPAYMENT_SEARCH_FORM_SUBMIT_BTN; ?>" class="search" />
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
	 * Muestra el resultado de una consulta a la tabla payment
	 *
	 * Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla payment. Muestra sólo los campos seteados en el parámetro $fields.
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
	 * Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST['paymentGroup'] (array)</b>
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
			$fields[2]['field'] = 'totalAmountBack';
			$fields[3]['field'] = 'totalAmountPay';
			$fields[4]['field'] = 'idUserAdd';
			$fields[5]['field'] = 'idProvider';
			$fields[6]['field'] = 'totalAmountDonate';
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
			$arrayOrder = array('id', 'date_added', 'total_amount_back', 'total_amount_pay', 'id_user_add', 'id_provider', 'total_amount_donate');
			array_push($arrayOrder, 'user_name', 'provider_name');

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

				$head.= '<div class="col" style="width: '.$arrayWidth['id'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></div>';
				$headers['id'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['dateAdded'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div></div>';
				$headers['dateAdded'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div>';
			}

			if ($value == 'totalAmountBack')
			{
				if ($_GET['orderby'] == 'total_amount_back')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=total_amount_back&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=total_amount_back&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=total_amount_back&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['totalAmountBack'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_BACK, $arrayStrLen['totalAmountBack']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_BACK).'</a></div></div>';
				$headers['totalAmountBack'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_BACK, $arrayStrLen['totalAmountBack']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_BACK).'</a></div>';
			}

			if ($value == 'totalAmountPay')
			{
				if ($_GET['orderby'] == 'total_amount_pay')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=total_amount_pay&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=total_amount_pay&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=total_amount_pay&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['totalAmountPay'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_PAY, $arrayStrLen['totalAmountPay']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_PAY).'</a></div></div>';
				$headers['totalAmountPay'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_PAY, $arrayStrLen['totalAmountPay']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_PAY).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['idUserAdd'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div></div>';
				$headers['idUserAdd'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div>';
			}

			if ($value == 'idProvider')
			{
				if ($_GET['orderby'] == 'provider_name')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=provider_name&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=provider_name&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=provider_name&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['idProvider'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div></div>';
				$headers['idProvider'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div>';
			}

			if ($value == 'products')
			{
			    $head.= '<div class="col" style="width: '.$arrayWidth['products'].';"><div class="str">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_PRODUCTS, $arrayStrLen['products']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_PRODUCTS).'</div></div>';
			    $headers['products'] = '<div class="str">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_PRODUCTS, $arrayStrLen['products']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_PRODUCTS).'</div>';
			}

			if ($value == 'totalAmountDonate')
			{
				if ($_GET['orderby'] == 'total_amount_donate')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=total_amount_donate&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=total_amount_donate&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=total_amount_donate&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['totalAmountDonate'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_DONATE, $arrayStrLen['totalAmountDonate']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_DONATE).'</a></div></div>';
				$headers['totalAmountDonate'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_DONATE, $arrayStrLen['totalAmountDonate']), CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_DONATE).'</a></div>';
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
				<form name="formQueryPayment" id="formQueryPayment" method="post" action="">
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
				<div class="message warning"><?php echo CPAYMENT_SHOW_QUERY_NOT_FOUND; ?></div>
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
					<div class="row row<?php echo $class; ?>" id="payment_tr_<?php echo $row['id']; ?>" data-table-name="payment" data-id="<?php echo $row['id']; ?>" data-form-id="formQueryPayment">
				<?php
				if (is_array($groupActions) === TRUE)
				{
				?>
						<div class="col header"></div>
						<div class="col" style="width: <?php echo $widthGroupActions; ?>;"><div class="group-actions"><input name="paymentGroup[]" type="checkbox" id="cb_payment_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="checkboxClick(this)" /></div></div>
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

					if ($value == 'totalAmountBack')
					{
					?>
						<div class="col header"><?php echo $headers['totalAmountBack']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['totalAmountBack']; ?>;"><div class="num"><?php echo altText(getCutString($row['totalAmountBack'], $arrayStrLen['totalAmountBack']), $row['totalAmountBack']); ?></div></div>
					<?php
					}

					if ($value == 'totalAmountPay')
					{
					?>
						<div class="col header"><?php echo $headers['totalAmountPay']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['totalAmountPay']; ?>;"><div class="num"><?php echo altText(getCutString($row['totalAmountPay'], $arrayStrLen['totalAmountPay']), $row['totalAmountPay']); ?></div></div>
					<?php
					}

					if ($value == 'idUserAdd')
					{
					?>
						<div class="col header"><?php echo $headers['idUserAdd']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idUserAdd']; ?>;"><div class="str"><?php echo altText(getCutString($row['userName'], $arrayStrLen['idUserAdd']), $row['userName']); ?></div></div>
					<?php
					}

					if ($value == 'idProvider')
					{
					?>
						<div class="col header"><?php echo $headers['idProvider']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idProvider']; ?>;"><div class="str"><?php echo altText(getCutString($row['providerName'], $arrayStrLen['idProvider']), $row['providerName']); ?></div></div>
					<?php
					}

					if ($value == 'products')
					{
					    $auxDetailPayment  = new Cdetail_payment($this->getDbConn());
					    //$auxProduct	       = new Cproduct($this->getDbConn());
					    $searchDetail      = $auxDetailPayment->getFieldSql('id_payment', $auxDetailPayment->getTableName()).' = '.$auxDetailPayment->getvalueSql($row['id']);
					    $resDetailPayment  = $auxDetailPayment->getList($searchDetail);
					    $auxContent	       = '';
					    if($resDetailPayment != FALSE)
					    {
    						foreach ($resDetailPayment as $val)
    						{
    						    $auxContent .= '<div>- '.$val['productName'].'</div>';
    						}
					    }

					?>
						<div class="col header"><?php echo $headers['products']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['products']; ?>;"><div class="str"><?php echo $auxContent; ?></div></div>
					<?php
					}

					if ($value == 'totalAmountDonate')
					{
					?>
						<div class="col header"><?php echo $headers['totalAmountDonate']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['totalAmountDonate']; ?>;"><div class="num"><?php echo altText(getCutString($row['totalAmountDonate'], $arrayStrLen['totalAmountDonate']), $row['totalAmountDonate']); ?></div></div>
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

						if ($value['image'] == '')
						{
							echo '<div class="col action" style="width: '.$value['width'].';"><div class="action '.$value['class'].'"><a href="'.$value['file'].'?id='.$row['id'].''.$auxActionsParams.'" onclick="'.$onclick.'" title="'.$value['title'].'">'.$value['text'].'</a></div></div>';
						}
						else
						{
							echo '<div class="col action" style="width: '.$value['width'].';"><div class="action '.$value['class'].'"><a href="'.$value['file'].'?id='.$row['id'].''.$auxActionsParams.'" onclick="'.$onclick.'" title="'.$value['title'].'"><img src="'.$value['image'].'" alt="'.$value['title'].'" class="out" /><img src="'.$value['image-over'].'" alt="'.$value['title'].'" class="over" /></a></div></div>';
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
						<input name="payment_select_all" type="checkbox" id="payment_select_all" value="" class="checkbox_show_query" onclick="querySelectAll('payment', 'formQueryPayment')" />
						<span><?php echo CPAYMENT_SHOW_QUERY_SELECT_ALL; ?></span>
					</div>
			<?php
			$j = 1;
			foreach ($groupActions as $value)
			{
				if ($value['confirm'] === TRUE)
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryPayment\', \''.$value['file'].'\', \''.$actionsParams.'\', true, \''.$value['msg'].'\');"';
				}
				else
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryPayment\', \''.$value['file'].'\', \''.$actionsParams.'\', false, \'\');"';
				}

				if ($value['button'] === TRUE)
				{
					echo '<input type="button" name="payment_ga_'.$j.'" id="payment_ga_'.$j.'" value="'.$value['text'].'" class="'.$value['class'].'" '.$onclick.' />';
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
	 * Para acentar las rendiciones de productos
	 *
	 * @param string $fields
	 * @param string $href
	 * @param boolean $autoRedirect
	 * @param string $title
	 */
	public function payProductsForm($href = '', $autoRedirect = FALSE, $title = '')
	{
	    $action = 'add';
	    if (empty($_GET['id']) === FALSE)
	    {
	        $this->setId($_GET['id'], TRUE);

	        if($this->getData() == FALSE)
	        {
	            echo CPAYMENT_PAY_PRODUCT_FORM_NOT_ALLOWED;
	            return FALSE;
	        }

	        $action = 'update';
	    }

	    if (isset($_POST['addPayment']) === FALSE)
	    {
	        $_POST['addPayment'] = '';
	    }

	    if(isset($_GET['ascdesc']) === FALSE)
	    {
	        $_GET['ascdesc'] = '';
	    }
	    if(isset($_POST['productsBackGroup']) === FALSE)
	    {
	        $_POST['productsBackGroup'] = '';
	    }
	    if(isset($_POST['productsPayGroup']) === FALSE)
	    {
	        $_POST['productsPayGroup'] = '';
	    }

	    $movement      = new Cmovement($this->getDbConn());
	    $product       = new Cproduct($this->getDbConn());
	    $detailPayment = new Cdetail_payment($this->getDbConn());
	    $detail        = new Cdetail($this->getDbConn());
	    $oDate         = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);

	    if ($_POST['addPayment'] == 'add')
	    {
	        $this->setIdProvider($_POST['idProvider'], TRUE);
	        $this->setDateAdded($_POST['dateAdded'], FALSE);
	        $this->setIdUserAdd($_SESSION['userId'], TRUE);

	        $movement->setIdProvider($_POST['idProvider'], TRUE);
	        $movement->setDateAdded($_POST['dateAdded'], FALSE);
	        $movement->setIdUserAdd($_SESSION['userId'], TRUE);
	        $movement->setTypeMovement('payment_to_provider');
	        $movement->setDescription(CPAYMENT_PAY_PRODUCT_FORM_MOVEMENT_DESCRIPTION);

	        $amountBackControl    = FALSE;
	        $amountPayControl     = FALSE;

	        if(isset($_POST['productsBackGroup']) == FALSE or is_array($_POST['productsBackGroup']) == FALSE or count($_POST['productsBackGroup']) == 0)
	        {
	            $amountBackControl = TRUE;
	        }

	        if(isset($_POST['productsPayGroup']) == FALSE or is_array($_POST['productsPayGroup']) == FALSE or count($_POST['productsPayGroup']) == 0)
	        {
	            $amountPayControl = TRUE;
	        }

	        if($amountBackControl == TRUE and $amountPayControl == TRUE)
	        {
	            $this->addError(CPAYMENT_PAY_PRODUCT_FORM_REQUIRED_ITEM);
	        }

	        //Verifico que no exista errores en el movement
	        if ($movement->error() === FALSE)
	        {
	            foreach ($movement->getErrors() as $err)
	            {
	                $this->addError($err);
	            }
	        }

	        if ($this->error() === FALSE)
	        {
	            $amountPayed   = 0;
	            $amountBack    = 0;
	            $amountDonated = 0;
	            $idPayment    = NULL;

	            if($action == 'add')
	            {
                    $this->add();

                    $idPayment = $this->getLastId();
	            }
	            else
	            {
	                $idPayment = $this->getId(FALSE);

	                //Si es un update primero borro el detalle
	                $this->delPaymentDetail();

	                $this->update();
	            }

                $this->setId($idPayment);

                $movement->setIdPayment($idPayment);

	            //Productos devueltos
	            if(isset($_POST['productsBackGroup']) == TRUE and is_array($_POST['productsBackGroup']) == TRUE and count($_POST['productsBackGroup']) > 0)
	            {
	                foreach($_POST['productsBackGroup'] as $val)
	                {
	                    $product->setId($val);
	                    if($product->getData() == TRUE)
	                    {
	                        if($product->getStatus(FALSE) != 'returned' and $product->getStatus(FALSE) != 'donate')
	                        {
	                            if(empty($_POST['donar_'.$val]) == FALSE and $_POST['donar_'.$val] == 'yes')
	                            {
	                                $product->setStatus('donate');

	                                $amountDonated++;
	                            }
	                            else
	                            {
	                                $product->setStatus('returned');

	                                $amountBack++;
	                            }

                                $product->setDateChangeStatus(date($oDate->getDbFormat()), TRUE);

                                $product->update();
	                        }

	                        $detailPayment->setIdPayment($idPayment);
	                        $detailPayment->setIdProduct($product->getId(FALSE));

	                        if(empty($_POST['donar_'.$val]) == FALSE and $_POST['donar_'.$val] == 'yes')
	                        {
                                $detailPayment->setType('donate');
	                        }
	                        else
	                        {
	                            $detailPayment->setType('give_back');
	                        }

                            //Busco el último id de sale de este producto
	                        $sql = 'SELECT MAX('.$detail->getFieldSql('id_sale').') AS idSale FROM '.$detail->getTableSql().' WHERE '.$detail->getFieldSql('id_product').'='.$detail->getValueSql($product->getId(FALSE));
	                        $row = $detail->getDbConn()->GetRow($sql);

	                        if (is_array($row) === TRUE and count($row) > 0 and $row['idSale'] > 0)
	                        {
	                            $detailPayment->setIdSale($row['idSale']);
	                        }

	                        $detailPayment->add();
	                    }
	                }
	            }
	            $this->setTotalAmountBack($amountBack);
	            $this->setTotalAmountDonate($amountDonated);

	            //Productos pagos
	            if(isset($_POST['productsPayGroup']) == TRUE and is_array($_POST['productsPayGroup']) == TRUE and count($_POST['productsPayGroup']) > 0)
	            {
	                foreach($_POST['productsPayGroup'] as $val)
	                {
	                    $product->setId($val);
	                    if($product->getData() == TRUE)
	                    {
	                        if($product->getStatus(FALSE) != 'paid_out')
	                        {
	                           $product->setStatus('paid_out');

	                           $product->setDateChangeStatus(date($oDate->getDbFormat()), TRUE);

	                           $product->update();
	                        }

	                        $auxAmount = 0;
	                        if(empty($_POST['amount_'.$product->getId(FALSE)]) == FALSE and $_POST['amount_'.$product->getId(FALSE)] > 0)
	                        {
	                            if($_POST['type_pay'] == 'cash')
	                            {
	                                $auxAmount = $_POST['amount_'.$product->getId(FALSE)] * CASH_COMMISSION;
	                            }
	                            else
	                            {
	                                $auxAmount = $_POST['amount_'.$product->getId(FALSE)] * CURRENT_ACCOUNT_COMMISSION;
	                            }
	                        }

	                        $amountPayed += $auxAmount;

	                        $detailPayment->setIdPayment($idPayment);
	                        $detailPayment->setIdProduct($product->getId(FALSE));
	                        $detailPayment->setType('payed');
	                        $detailPayment->setAmount($auxAmount);

	                        //Busco el último id de sale de este producto
	                        $sql = 'SELECT MAX('.$detail->getFieldSql('id_sale').') AS idSale FROM '.$detail->getTableSql().' WHERE '.$detail->getFieldSql('id_product').'='.$detail->getValueSql($product->getId(FALSE));
	                        $row = $detail->getDbConn()->GetRow($sql);

	                        if (is_array($row) === TRUE and count($row) > 0 and $row['idSale'] > 0)
	                        {
	                            $detailPayment->setIdSale($row['idSale']);
	                        }

	                        $detailPayment->add();
	                    }
	                }
	            }
	            $this->setTotalAmountPay($amountPayed);

	            //Guardo los totales
	            if($this->error() === FALSE)
	            {
	                $this->update();
	            }

	            //Agrego los movimientos
	            if(empty($_POST['type_pay']) == FALSE and ($_POST['total_cash'] > 0 or $_POST['total_cta_cte'] > 0))
	            {
	                if($_POST['type_pay'] == 'cash' and $_POST['total_cash'] > 0)
	                {
	                    $movement->setAmount($_POST['total_cash']);
	                    $movement->setTypePay('cash');
	                }
	                elseif($_POST['type_pay'] == 'cta_cte' and $_POST['total_cta_cte'] > 0)
	                {
	                    $movement->setAmount($_POST['total_cta_cte']);
	                    $movement->setTypePay('cta_cte');
	                }
	                $movement->autoSetType();

	                if ($movement->error() === FALSE)
	                {
	                    $movement->add();
	                }
	            }
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
				    <div class="message success"><?php echo CMOVEMENT_ADD_FORM_OK; ?></div>
			    </div>
			    <div class="middle"></div>
			    <div class="buttons">
			    <?php
			    if (validateRequiredValue($href) === TRUE)
			    {
			    ?>
				    <input type="button" value="<?php echo CMOVEMENT_ADD_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="success" />
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
				<form name="formAddPayment" id="formAddPayment" method="post" action="">
				<input name="addPayment" type="hidden" id="addPayment" value="back" />
				<div class="fields">
				    <?php
				    echo '<input name="dateAdded" type="hidden" id="dateAdded" value="'.$this->getDateAdded().'" />';
				    echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';

				    if(is_array($_POST['productsBackGroup']) == TRUE and count($_POST['productsBackGroup']) > 0)
				    {
				        echo '<input name="productsBackGroup" type="hidden" id="productsBackGroup" value="'.implode(',', $_POST['productsBackGroup']).'" />';
				    }
				    if(is_array($_POST['productsPayGroup']) == TRUE and count($_POST['productsPayGroup']) > 0)
				    {
				        echo '<input name="productsPayGroup" type="hidden" id="productsPayGroup" value="'.implode(',', $_POST['productsPayGroup']).'" />';
				    }
				    echo '<input name="type_pay" type="hidden" id="type_pay" value="'.$_POST['type_pay'].'" />';
				    ?>
				    <div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CMOVEMENT_ADD_FORM_BACK_BTN; ?>" class="back" />
				</div>
				</form>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
		else
		{
			if ($_POST['addPayment'] == 'back')
			{
			    $this->setDateAdded($_POST['dateAdded'], FALSE);
			    $this->setIdProvider($_POST['idProvider'], TRUE);
			}
			else
			{
			    if(empty($_POST['dateAdded']) == TRUE and empty($this->getDateAdded()) == TRUE)
			    {
				    $this->setDateAdded(date(FORMAT_DATE), FALSE);
			    }
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
				<form name="formAddPayment" id="formAddPayment" method="post" action="">
				<input name="addPayment" type="hidden" id="addPayment" value="add" />
				<div class="fields">

				    <div class="field">
					    <label><?php echo CPAYMENT_PAY_PRODUCT_FORM_LABEL_FIELD_DATE; ?> <span>*</span></label>
					    <input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
				    </div>

				    <?php
				    $auxProviderName = '';
				    if(empty($this->getIdProvider(FALSE)) == FALSE)
				    {
    					$auxProvider = new Cprovider($this->getDbConn());
    					$auxProvider->setId($this->getIdProvider(FALSE));

    					if($auxProvider->getData() == TRUE)
    					{
    					    $auxProviderName = $auxProvider->getName(FALSE);
    					}
				    }

				    $auxClass       = '';
				    $extraClass     = '';
				    $wrapperClass   = '';
				    if($action == 'update')
				    {
				        $auxClass = 'readonly="readonly"';
				    }
				    else
				    {
				        $extraClass     = ' autocomplete';
				        $wrapperClass   = ' autocompleteWrapper';
				    }

				    ?>
				    <div class="field<?php echo $wrapperClass; ?>">
    					<label><?php echo CPAYMENT_PAY_PRODUCT_FORM_LABEL_FIELD_PROVIDER; ?></label>
    					<input name="idProviderAutocomplete" id="idProviderAutocomplete" value="<?php echo $auxProviderName; ?>" class="str<?php echo $extraClass; ?>" maxlength="255" type="text" <?php echo $auxClass; ?>/>
    					<input name="idProvider" id="idProvider" value="<?php echo $this->getIdProvider(FALSE); ?>" type="hidden" />
				    </div>
				</div>
				<input type="hidden" id="orderHidden" value="" />
				<input type="hidden" id="ascDescHidden" value="<?php echo $_GET['ascdesc']; ?>" />
				<div id="providerProductList"></div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPAYMENT_PAY_PRODUCT_FORM_SUBMIT_BTN; ?>" class="accept" />
        			<?php
        			if (validateRequiredValue($href) === TRUE)
        			{
                        ?>
        				<input type="button" value="<?php echo CPAYMENT_PAY_PRODUCT_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
        				<?php
        			}
        			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CPAYMENT_PAY_PRODUCT_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Borra las tablas relacionadas al payment
	 *
	 * @return boolean
	 */
	public function delPaymentDetail()
	{
	    if(empty($this->getId(FALSE)) == TRUE)
	    {
	        return FALSE;
	    }
	    else
	    {
	        $detailPayment = new Cdetail_payment($this->getDbConn());
	        $movement      = new Cmovement($this->getDbConn());

	        $movement->setIdPayment($this->getId(FALSE));
	        $movement->delPaymentMovement();

	        $detailPayment->setIdPayment($this->getId(FALSE));
	        $detailPayment->delDetail();

            return TRUE;
	    }
	}

	/**
	 * Borra los payment de una sale
	 */
	public function delSalePayment($idSale)
	{
	    if(empty($idSale) == TRUE)
	    {
	        return FALSE;
	    }
	    else
	    {
	        $detailPayment = new Cdetail_payment($this->getDbConn());

	        $search    = $detailPayment->getFieldSql('id_sale').'='.$detailPayment->getValueSql($idSale);
	        $list      = $detailPayment->getList($search);

	        if ($detailPayment->getTotalList() > 0)
	        {
	            foreach ($list as $row)
	            {
                    $this->setId($row['idPayment']);
                    if($this->del() == TRUE)
                    {
                        $this->delPaymentDetail();
                    }
	            }
	        }

	        return TRUE;
	    }
	}
}
?>