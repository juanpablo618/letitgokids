<?php
/**
 * Archivo php creado por O-creator
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla sale
 *
 * Esta clase se encarga de la administración de la tabla sale brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Csale.php');
 * $sale = new Csale();
 * $sale->setDbConn($dbConn);
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:28-09-2019
 */
class Csale extends Cbase
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
	 * - Tabla: {@link Cdetail detail}
	 * - Campo: {@link Cdetail::$idSale idSale}
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
	 * Bruto
	 *
	 * - Campo en la base de datos: total_amount_gross
	 * - Tipo de campo en la base de datos: decimal(10,2)
	 * - Extra: Decimal, positivo sin el cero [+] (ver {@link validateDecimalValue()})
	 * - Número de decimales: 2
	 * - Campo requerido
	 *
	 * Ver también: {@link getTotalAmountGross()}, {@link setTotalAmountGross()}
	 * @var float
	 * @access private
	 */
	private $totalAmountGross;

	/**
	 * Descuento
	 *
	 * - Campo en la base de datos: discount
	 * - Tipo de campo en la base de datos: decimal(10,2)
	 * - Extra: Decimal, positivo sin el cero [+] (ver {@link validateDecimalValue()})
	 * - Número de decimales: 2
	 *
	 * Ver también: {@link getDiscount()}, {@link setDiscount()}
	 * @var float
	 * @access private
	 */
	private $discount;

	/**
	 * Neto
	 *
	 * - Campo en la base de datos: total_amount_net
	 * - Tipo de campo en la base de datos: decimal(10,2)
	 * - Extra: Decimal, positivo sin el cero [+] (ver {@link validateDecimalValue()})
	 * - Número de decimales: 2
	 *
	 * Ver también: {@link getTotalAmountNet()}, {@link setTotalAmountNet()}
	 * @var float
	 * @access private
	 */
	private $totalAmountNet;

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
	 * Cliente
	 *
	 * - Clave Foránea
	 * - Campo en la base de datos: id_client
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * <b>Relación</b>
	 * Este campo es clave foránea a:
	 * - Tabla: {@link Cprovider provider}
	 * - Campo: {@link Cprovider::$id id}
	 * - Campo que se muestra: {@link Cprovider::$name name}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * Ver también: {@link getIdClient()}, {@link setIdClient()}
	 * @var integer
	 * @access private
	 */
	private $idClient;
	/**
	 * Nombre
	 *
	 * - Campo en la base de datos: casual_customer
	 * - Tipo de campo en la base de datos: varchar(255)
	 *
	 * Ver también: {@link getCasualCustomer()}, {@link setCasualCustomer()}
	 * @var string
	 * @access private
	 */
	private $casualCustomer;
	/**
	 * Constructor de la clase
	 *
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('sale');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Csale.php');
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
			$this->addError(CSALE_SETID_REQUIRED_VALUE);

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
				$this->addError(CSALE_SETID_VALIDATE_VALUE);

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
	 * $sale = new Csale();
	 * //seteo en el formato que acepta la base de datos (yyyy-mm-dd)
	 * $sale->setDateAdded('1980-11-24', TRUE);
	 * //seteo en el formato definido en la configuración del script (suponemos que el formato utilizado es dd-mm-yyyy)
	 * $sale->setDateAdded('24-11-1980', FALSE);
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
			$this->addError(CSALE_SETDATE_ADDED_REQUIRED_VALUE);

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
					$this->addError(CSALE_SETDATE_ADDED_VALIDATE_VALUE);

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
					$this->addError(CSALE_SETDATE_ADDED_VALIDATE_VALUE);

					return FALSE;
				}
			}
			else
			{
				$this->dateAdded = '';
				$this->addError(CSALE_SETDATE_ADDED_ERROR);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $totalAmountGross Bruto}
	 *
	 * @param float $totalAmountGross indica el valor Bruto
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setTotalAmountGross($totalAmountGross, $gpc = FALSE)
	{
		if (validateRequiredValue($totalAmountGross) === FALSE)
		{
			$this->totalAmountGross = $totalAmountGross;
			$this->addError(CSALE_SETTOTAL_AMOUNT_GROSS_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->totalAmountGross = setValue($totalAmountGross, $gpc);

			if (validateDecimalValue($this->totalAmountGross, '+') === TRUE)
			{
				if (validateRequiredValue($totalAmountGross) === TRUE)
				{
					$this->totalAmountGross = numberFormat($totalAmountGross, 2);
				}
				return TRUE;
			}
			else
			{
				$this->addError(CSALE_SETTOTAL_AMOUNT_GROSS_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $discount Descuento}
	 *
	 * @param float $discount indica el valor Descuento
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setDiscount($discount, $gpc = FALSE)
	{
		if ($discount == '0')
		{
			$discount = '';
		}
		$this->discount = setValue($discount, $gpc);

		if (validateDecimalValue($this->discount, '+') === TRUE)
		{
			if (validateRequiredValue($discount) === TRUE)
			{
				$this->discount = numberFormat($discount, 2);
			}
			return TRUE;
		}
		else
		{
			$this->addError(CSALE_SETDISCOUNT_VALIDATE_VALUE);

			return FALSE;
		}
	}

	/**
	 * Setea el valor {@link $totalAmountNet Neto}
	 *
	 * @param float $totalAmountNet indica el valor Neto
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setTotalAmountNet($totalAmountNet, $gpc = FALSE)
	{
		if ($totalAmountNet == '0')
		{
			$totalAmountNet = '';
		}
		$this->totalAmountNet = setValue($totalAmountNet, $gpc);

		if (validateDecimalValue($this->totalAmountNet, '+') === TRUE)
		{
			if (validateRequiredValue($totalAmountNet) === TRUE)
			{
				$this->totalAmountNet = numberFormat($totalAmountNet, 2);
			}
			return TRUE;
		}
		else
		{
			$this->addError(CSALE_SETTOTAL_AMOUNT_NET_VALIDATE_VALUE);

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
			$this->addError(CSALE_SETID_USER_ADD_REQUIRED_VALUE);

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
				$this->addError(CSALE_SETID_USER_ADD_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $idClient Cliente}
	 *
	 * @param integer $idClient indica el valor Cliente
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdClient($idClient, $gpc = FALSE)
	{
		if ($idClient == '0')
		{
			$idClient = '';
		}
		$this->idClient = setValue($idClient, $gpc);
		if (validateIntValue($this->idClient, '+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CSALE_SETID_CLIENT_VALIDATE_VALUE);
			return FALSE;
		}
	}
	/**
	 * Setea el valor {@link $casualCustomer Nombre}
	 *
	 * @param string $casualCustomer indica el valor Nombre
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setCasualCustomer($casualCustomer, $gpc = FALSE)
	{
		$this->casualCustomer = setValue($casualCustomer, $gpc);
		return TRUE;
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
	 * $sale = new Csale();
	 * $sale->setDateAdded('1980-11-24', TRUE);
	 * echo 'Fecha en formato del script: ';
	 * echo $sale->getDateAdded().'<br />';
	 * echo 'Fecha en el formato que acepta la base de datos: ';
	 * echo $sale->getDateAdded(TRUE).'<br />';
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
	 * Devuelve el valor {@link $totalAmountGross Bruto}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return float
	 * @access public
	 */
	public function getTotalAmountGross($htmlEntities = TRUE)
	{
		return getValue($this->totalAmountGross, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $discount Descuento}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return float
	 * @access public
	 */
	public function getDiscount($htmlEntities = TRUE)
	{
		return getValue($this->discount, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $totalAmountNet Neto}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return float
	 * @access public
	 */
	public function getTotalAmountNet($htmlEntities = TRUE)
	{
		return getValue($this->totalAmountNet, $htmlEntities, $this->getCharset());
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
	 * Devuelve el valor {@link $idClient Cliente}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdClient($htmlEntities = TRUE)
	{
		return getValue($this->idClient, $htmlEntities, $this->getCharset());
	}
	/**
	 * Devuelve el valor {@link $casualCustomer Nombre}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getCasualCustomer($htmlEntities = TRUE)
	{
		return getValue($this->casualCustomer, $htmlEntities, $this->getCharset());
	}
	/**
	 * Inserta un nuevo registro en la tabla sale
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

		if (isset($this->totalAmountGross) === TRUE)
		{
			$fields[] = $this->getFieldSql('total_amount_gross');

			if (validateRequiredValue($this->totalAmountGross) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->totalAmountGross);
			}
		}

		if (isset($this->discount) === TRUE)
		{
			$fields[] = $this->getFieldSql('discount');

			if (validateRequiredValue($this->discount) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->discount);
			}
		}

		if (isset($this->totalAmountNet) === TRUE)
		{
			$fields[] = $this->getFieldSql('total_amount_net');

			if (validateRequiredValue($this->totalAmountNet) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->totalAmountNet);
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

		if (isset($this->idClient) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_client');
			if (validateRequiredValue($this->idClient) === FALSE)
			{
				$values[] = 'NULL';
			}
			else
			{
				$values[] = $this->getValueSql($this->idClient);
			}
		}
		if (isset($this->casualCustomer) === TRUE)
		{
			$fields[] = $this->getFieldSql('casual_customer');
			$values[] = $this->getValueSql($this->casualCustomer);
		}
		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CSALE_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla sale
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

			if (isset($this->totalAmountGross) === TRUE)
			{
				if (validateRequiredValue($this->totalAmountGross) === FALSE)
				{
					$values[] = $this->getFieldSql('total_amount_gross').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('total_amount_gross').' = '.$this->getValueSql($this->totalAmountGross);
				}
			}

			if (isset($this->discount) === TRUE)
			{
				if (validateRequiredValue($this->discount) === FALSE)
				{
					$values[] = $this->getFieldSql('discount').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('discount').' = '.$this->getValueSql($this->discount);
				}
			}

			if (isset($this->totalAmountNet) === TRUE)
			{
				if (validateRequiredValue($this->totalAmountNet) === FALSE)
				{
					$values[] = $this->getFieldSql('total_amount_net').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('total_amount_net').' = '.$this->getValueSql($this->totalAmountNet);
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

			if (isset($this->idClient) === TRUE)
			{
				if (validateRequiredValue($this->idClient) === FALSE)
				{
					$values[] = $this->getFieldSql('id_client').' = NULL';
				}
				else
				{
					$values[] = $this->getFieldSql('id_client').' = '.$this->getValueSql($this->idClient);
				}
			}
			if (isset($this->casualCustomer) === TRUE)
			{
				$values[] = $this->getFieldSql('casual_customer').' = '.$this->getValueSql($this->casualCustomer);
			}
			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CSALE_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CSALE_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla sale
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
				$this->addError(CSALE_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CSALE_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla sale
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
				$this->setTotalAmountGross($row['total_amount_gross']);
				$this->setDiscount($row['discount']);
				$this->setTotalAmountNet($row['total_amount_net']);
				$this->setIdUserAdd($row['id_user_add']);
				$this->setIdClient($row['id_client']);
				$this->setCasualCustomer($row['casual_customer']);

				return TRUE;
			}
			else
			{
				$this->addError(CSALE_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CSALE_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un conjunto de registros de la tabla sale
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

		$oIdClient = new Cprovider();
		$oIdClient->setDbConn($this->getDbConn());
		$sql = 'SELECT ';
		$sql.= $this->getFieldSql('id', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('date_added', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('total_amount_gross', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('discount', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('total_amount_net', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_user_add', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_client', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('casual_customer', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id', $oIdUserAdd->getTableName(), 'user_id');
		$sql.= ', '.$this->getFieldSql('user', $oIdUserAdd->getTableName(), 'user_user');
		$sql.= ', '.$this->getFieldSql('pass', $oIdUserAdd->getTableName(), 'user_pass');
		$sql.= ', '.$this->getFieldSql('id_group', $oIdUserAdd->getTableName(), 'user_id_group');
		$sql.= ', '.$this->getFieldSql('active', $oIdUserAdd->getTableName(), 'user_active');
		$sql.= ', '.$this->getFieldSql('token', $oIdUserAdd->getTableName(), 'user_token');
		$sql.= ', '.$this->getFieldSql('name', $oIdUserAdd->getTableName(), 'user_name');
		$sql.= ', '.$this->getFieldSql('lastname', $oIdUserAdd->getTableName(), 'user_lastname');
		$sql.= ', '.$this->getFieldSql('email', $oIdUserAdd->getTableName(), 'user_email');
		$sql.= ', '.$this->getFieldSql('id', $oIdClient->getTableName(), 'provider_id');
		$sql.= ', '.$this->getFieldSql('name', $oIdClient->getTableName(), 'provider_name');
		$sql.= ', '.$this->getFieldSql('email', $oIdClient->getTableName(), 'provider_email');
		$sql.= ', '.$this->getFieldSql('phone', $oIdClient->getTableName(), 'provider_phone');
		$sql.= ' FROM '.$this->getTableSql();
		$sql.= ' LEFT JOIN '.$oIdUserAdd->getTableSql().' ON '.$this->getFieldSql('id_user_add', $this->getTableName()).' = '.$oIdUserAdd->getFieldSql('id', $oIdUserAdd->getTableName());
		$sql.= ' LEFT JOIN '.$oIdClient->getTableSql().' ON '.$this->getFieldSql('id_client', $this->getTableName()).' = '.$oIdClient->getFieldSql('id', $oIdClient->getTableName());
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
				$this->addError(CSALE_GETLIST_ERROR);

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
					$this->setTotalAmountGross($rs->fields['total_amount_gross']);
					$this->setDiscount($rs->fields['discount']);
					$this->setTotalAmountNet($rs->fields['total_amount_net']);
					$this->setIdUserAdd($rs->fields['id_user_add']);
					$this->setIdClient($rs->fields['id_client']);
					$this->setCasualCustomer($rs->fields['casual_customer']);

					$oIdUserAdd->setName($rs->fields['user_name']);
					$oIdClient->setName($rs->fields['provider_name']);

					$list[] = array(
						'id' => $this->getId($htmlEntities) ,
						'dateAdded' => $this->getDateAdded() ,
						'totalAmountGross' => $this->getTotalAmountGross($htmlEntities) ,
						'discount' => $this->getDiscount($htmlEntities) ,
						'totalAmountNet' => $this->getTotalAmountNet($htmlEntities) ,
						'idUserAdd' => $this->getIdUserAdd($htmlEntities) ,
						'idClient' => $this->getIdClient($htmlEntities) ,
						'casualCustomer' => $this->getCasualCustomer($htmlEntities) ,
						'userName' => $oIdUserAdd->getName($htmlEntities) ,
						'providerName' => $oIdClient->getName($htmlEntities)
					);

					$rs->MoveNext();
				}

				$this->id = NULL;
				$this->dateAdded = NULL;
				$this->totalAmountGross = NULL;
				$this->discount = NULL;
				$this->totalAmountNet = NULL;
				$this->idUserAdd = NULL;
				$this->idClient = NULL;
				$this->casualCustomer = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CSALE_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}

	/**
	 * Devuelve el último valor ID insertado en la tabla sale
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
			$this->addError(CSALE_GET_LAST_ID_ERROR);

			return FALSE;
		}
		else
		{
			return $row['id'];
		}
	}

	/**
	 * Muestra un formulario para dar de alta un registro de la tabla sale
	 *
	 * Este método muestra un formulario para dar de alta un registro de la tabla sale mostrando sólo los campos seteados en el parámetro $fields.
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
	 * - {@link Cdetail::formDetail() Cdetail: formDetail}
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
			$fields = 'id,dateAdded,totalAmountGross,discount,totalAmountNet,idUserAdd,idClient,casualCustomer';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['addSale']) === FALSE)
		{
			$_POST['addSale'] = '';
		}
		if (isset($_POST['is_client']) === FALSE)
		{
		    $_POST['is_client'] = '';
		}

		if (isset($_POST['uniqueIDdetail']) === FALSE)
		{
			$_POST['uniqueIDdetail'] = '';
		}
		if (isset($_POST['uniqueIDmovement']) === FALSE)
		{
			$_POST['uniqueIDmovement'] = '';
		}

		$detail = new Cdetail();
		$detail->setDbConn($this->getDbConn());

		$movement = new Cmovement();
		$movement->setDbConn($this->getDbConn());

		if (isset($configDetail['detail']['control_file']) === FALSE)
		{
			$configDetail['detail']['control_file'] = 'detail.php';
		}
		if (isset($configDetail['detail']['fields']) === FALSE)
		{
			$configDetail['detail']['fields'] = '';
		}
		if (isset($configDetail['detail']['update']) === FALSE)
		{
			$configDetail['detail']['update'] = '';
		}
		if (isset($configDetail['detail']['delete']) === FALSE)
		{
			$configDetail['detail']['delete'] = '';
		}
		if (isset($configDetail['detail']['title']) === FALSE)
		{
			$configDetail['detail']['title'] = '&nbsp;';
		}

		if ($_POST['addSale'] == 'add')
		{
			if (in_array('dateAdded', $arrayFields) === TRUE)
			{
				$this->setDateAdded($_POST['dateAdded'], FALSE);
			}
			if (in_array('totalAmountGross', $arrayFields) === TRUE)
			{
				$this->setTotalAmountGross($_POST['totalAmountGross'], TRUE);
			}
			if (in_array('discount', $arrayFields) === TRUE)
			{
				$this->setDiscount($_POST['discount'], TRUE);
			}
			if (in_array('totalAmountNet', $arrayFields) === TRUE)
			{
				$this->setTotalAmountNet($_POST['totalAmountNet'], TRUE);
			}
			
			/*Siempre es el usuario actual*/
			$this->setIdUserAdd($_SESSION['userId'], TRUE);
			if (in_array('idClient', $arrayFields) === TRUE)
			{
				$this->setIdClient($_POST['idClient'], TRUE);
			}
			if (in_array('casualCustomer', $arrayFields) === TRUE)
			{
				$this->setCasualCustomer($_POST['casualCustomer'], TRUE);
			}

			if ($detail->validateRequiredDetail($_POST['uniqueIDdetail']) === FALSE)
			{
				$this->addError(CSALE_ADD_FORM_REQUIRED_DETAIL_DETAIL);
			}
			if ($movement->validateRequiredDetail($_POST['uniqueIDmovement']) === FALSE)
			{
				$this->addError(CSALE_ADD_FORM_REQUIRED_DETAIL_MOVEMENT);
			}

			//Verifico que si elije un pago en cta cte haya seleccionado un cliente
			if($movement->validateDataDetail($_POST['uniqueIDmovement'], $_POST['idClient']) === FALSE)
			{
			    $this->addError(CSALE_ADD_FORM_ID_CLIENT_DETAIL_MOVEMENT);
			}

			if ($this->validateSaleAmount($_POST['uniqueIDdetail'], $_POST['uniqueIDmovement']) === FALSE)
			{
				$this->addError(CSALE_ADD_FORM_NOT_MATCH_DETAIL_MOVEMENT);
			}

			if ($this->error() === FALSE)
			{
			    $auxResults = $movement->getTotalAmount($_POST['uniqueIDmovement']);

			    $this->setTotalAmountGross($auxResults[0]);
			    $this->setTotalAmountNet($auxResults[1]);

			    $this->add();

			    if ($this->error() === FALSE)
			    {
				    $id = $this->getLastId();

				    $detail->setIdSale($id);
				    $detail->addDetail($this->getDateAdded(TRUE), $configDetail['detail']['fields'], $_POST['uniqueIDdetail']);

				    $movement->setIdSale($id);
				    $movement->addDetail($this->getDateAdded(TRUE), $this->getIdClient(FALSE),  $_POST['uniqueIDmovement']);
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
					<div class="message success"><?php echo CSALE_ADD_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				    ?>
				    <input type="button" value="<?php echo CSALE_ADD_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="success" />
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
				<form name="formAddSale" id="formAddSale" method="post" action="">
				<input name="addSale" type="hidden" id="addSale" value="back" />
				<div class="fields">
				<?php
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					echo '<input name="dateAdded" type="hidden" id="dateAdded" value="'.$this->getDateAdded().'" />';
				}
				if (in_array('totalAmountGross', $arrayFields) === TRUE)
				{
					echo '<input name="totalAmountGross" type="hidden" id="totalAmountGross" value="'.$this->getTotalAmountGross().'" />';
				}
				if (in_array('discount', $arrayFields) === TRUE)
				{
					echo '<input name="discount" type="hidden" id="discount" value="'.$this->getDiscount().'" />';
				}
				if (in_array('totalAmountNet', $arrayFields) === TRUE)
				{
					echo '<input name="totalAmountNet" type="hidden" id="totalAmountNet" value="'.$this->getTotalAmountNet().'" />';
				}
				if (in_array('idClient', $arrayFields) === TRUE)
				{
					echo '<input name="idClient" type="hidden" id="idClient" value="'.$this->getIdClient().'" />';
				}
				if (in_array('casualCustomer', $arrayFields) === TRUE)
				{
					echo '<input name="casualCustomer" type="hidden" id="casualCustomer" value="'.$this->getCasualCustomer().'" />';
				}

				echo '<input name="is_client" type="hidden"  value="'.$_POST['is_client'].'" />';

				echo '<input name="uniqueIDdetail" type="hidden"  value="'.$_POST['uniqueIDdetail'].'" />';

				echo '<input name="uniqueIDmovement" type="hidden"  value="'.$_POST['uniqueIDmovement'].'" />';
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CSALE_ADD_FORM_BACK_BTN; ?>" class="back" />
				</div>
				</form>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
		else
		{
			if ($_POST['addSale'] == 'back')
			{
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					$this->setDateAdded($_POST['dateAdded'], FALSE);
				}
				if (in_array('totalAmountGross', $arrayFields) === TRUE)
				{
					$this->setTotalAmountGross($_POST['totalAmountGross'], TRUE);
				}
				if (in_array('discount', $arrayFields) === TRUE)
				{
					$this->setDiscount($_POST['discount'], TRUE);
				}
				if (in_array('totalAmountNet', $arrayFields) === TRUE)
				{
					$this->setTotalAmountNet($_POST['totalAmountNet'], TRUE);
				}
				if (in_array('idClient', $arrayFields) === TRUE)
				{
					$this->setIdClient($_POST['idClient'], TRUE);
				}
				if (in_array('casualCustomer', $arrayFields) === TRUE)
				{
					$this->setCasualCustomer($_POST['casualCustomer'], TRUE);
				}
				$uniqueIDdetail = $_POST['uniqueIDdetail'];

				$uniqueIDmovement = $_POST['uniqueIDmovement'];
			}
			else
			{
				$uniqueIDdetail = uniqid('detail_');
				$_SESSION[$uniqueIDdetail] = array();

				$uniqueIDmovement = uniqid('movement_');
				$_SESSION[$uniqueIDmovement] = array();

				$this->setDateAdded(date(FORMAT_DATE), FALSE);
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
				<form name="formAddSale" id="formAddSale" method="post" action="">
				<input name="addSale" type="hidden" id="addSale" value="add" />
				<div class="fields">
			<?php
			foreach ($arrayFields as $value)
			{
				if ($value == 'dateAdded')
				{
				?>
					<div class="field">
						<label><?php echo CSALE_ADD_FORM_LABEL_FIELD_DATE_ADDED; ?> <span>*</span></label>
						<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
				<?php
				}
				if ($value == 'totalAmountGross')
				{
				?>
					<div class="field">
						<label><?php echo CSALE_ADD_FORM_LABEL_FIELD_TOTAL_AMOUNT_GROSS; ?> <span>*</span></label>
						<input name="totalAmountGross" type="text" id="totalAmountGross" value="<?php echo $this->getTotalAmountGross(); ?>" class="num" />
					</div>
				<?php
				}
				if ($value == 'discount')
				{
				?>
					<div class="field">
						<label><?php echo CSALE_ADD_FORM_LABEL_FIELD_DISCOUNT; ?></label>
						<input name="discount" type="text" id="discount" value="<?php echo $this->getDiscount(); ?>" class="num" />
					</div>
				<?php
				}
				if ($value == 'totalAmountNet')
				{
				?>
					<div class="field">
						<label><?php echo CSALE_ADD_FORM_LABEL_FIELD_TOTAL_AMOUNT_NET; ?></label>
						<input name="totalAmountNet" type="text" id="totalAmountNet" value="<?php echo $this->getTotalAmountNet(); ?>" class="num" />
					</div>
				<?php
				}
				if ($value == 'idClient')
				{
				    $auxClientName = '';
				    if(empty($this->getIdClient(FALSE)) == FALSE)
				    {
    					$auxClient = new Cprovider($this->getDbConn());
    					$auxClient->setId($this->getIdClient(FALSE));

    					if($auxClient->getData() == TRUE)
    					{
    					    $auxClientName = $auxClient->getName(FALSE);
    					}
				    }

				    $auxIsClient    = '';
				    $auxIsNotClient = '';
				    ?>
				    <div class="field">
						<label></label>
						<fieldset class="option-client">
            			    <label for="true">Cliente</label>
            			    <?php
            			    $selectedTrue = '';
            			    if(empty($_POST['is_client']) == TRUE or $_POST['is_client'] == 'client')
            			    {
            			        $selectedTrue = ' checked="checked"';
            			        $auxIsNotClient = ' style="display: none;"';
            			    }
            			    ?>
            			    <input type="radio" name="is_client" id="true" class="btnClient" value="client"<?php echo $selectedTrue; ?>/>

            			    <label for="false">Ocasional</label>
            			    <?php
            			    $selectedFalse = '';
            			    if($_POST['is_client'] == 'no_client')
            			    {
            			        $selectedFalse = ' checked="checked"';
            			        $auxIsClient = ' style="display: none;"';
            			    }
            			    ?>
            			    <input type="radio" name="is_client" id="false" class="btnClient" value="no_client"<?php echo $selectedFalse; ?>/>
            			</fieldset>
            			<script type="text/javascript">
                		$(document).ready(function() {
                		    $( ".btnClient" ).checkboxradio({
                				icon: false
                		    });
                		    $( "fieldset" ).controlgroup();

                		    $( ".btnClient" ).on("change", function(event){
                    		    if(this.value == "no_client")
                    		    {
                    		    	$( "#loadClient" ).hide();
                    		    	$( "#loadNotClient" ).show();

                    		    	//Limpio
                    		    	$("#idClientAutocomplete").val("");
                    		    	$("#idClient").val("");
                    		    	$("#ctaCteClient").hide();
                    		    }
                    		    else
                    		    {
                    		    	$( "#loadClient" ).show();
                    		    	$( "#loadNotClient" ).hide();

                    		    	$("#casualCustomer").val("");
                    		    }
                    		});
                		});
                		</script>
					</div>
					<div id="loadClient" class="field autocompleteWrapper"<?php echo $auxIsClient;?>>
						<label><?php echo CSALE_ADD_FORM_LABEL_FIELD_ID_CLIENT; ?></label>
						<input name="idClientAutocomplete" id="idClientAutocomplete" value="<?php echo $auxClientName; ?>" class="str autocomplete" maxlength="255" type="text" />
						<input name="idClient" id="idClient" value="<?php echo $this->getIdClient(FALSE); ?>" type="hidden" />
					</div>
					<div id="loadNotClient" class="field"<?php echo $auxIsNotClient; ?>>
						<label><?php echo CSALE_ADD_FORM_LABEL_FIELD_CASUAL_CUSTOMER; ?></label>
						<input name="casualCustomer" type="text" id="casualCustomer" value="<?php echo $this->getCasualCustomer(); ?>" class="str" maxlength="255" />
					</div>
					<div id="ctaCteClient"></div>
				<?php
				}
			}
			?>
				</div>
				<div class="detail">
				    <input name="uniqueIDdetail" value="<?php echo $uniqueIDdetail; ?>" type="hidden" />
				    <input name="uniqueIDmovement" value="<?php echo $uniqueIDmovement; ?>" type="hidden" />
				    <?php
				    $detail->formDetail($configDetail['detail']['control_file'], $configDetail['detail']['fields'], $configDetail['detail']['update'], $configDetail['detail']['delete'], $configDetail['detail']['title'], $uniqueIDdetail);

				    echo '<br /><br /><br />';

				    $movement->formDetail('sale-movement.php', $uniqueIDmovement);
				    ?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CSALE_ADD_FORM_SUBMIT_BTN; ?>" class="accept" />
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CSALE_ADD_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
			<?php
			}
			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CSALE_ADD_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Muestra un formulario para actualizar un registro existente de la tabla sale
	 *
	 * Este método muestra un formulario para actualizar un registro de la tabla sale mostrando sólo los campos seteados en el parámetro $fields.
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
	 * - {@link Cdetail::formDetail() Cdetail: formDetail}
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
	        $fields = 'id,dateAdded,totalAmountGross,discount,totalAmountNet,idUserAdd,idClient,casualCustomer';
	    }

	    $arrayFields = explode(',', $fields);
	    foreach ($arrayFields as $key => $value)
	    {
	        $arrayFields[$key] = trim($value);
	    }

	    if (isset($_POST['updateSale']) === FALSE)
	    {
	        $_POST['updateSale'] = '';
	    }
	    if (isset($_POST['is_client']) === FALSE)
	    {
	        $_POST['is_client'] = '';
	    }

	    if (isset($_POST['uniqueIDdetail']) === FALSE)
	    {
	        $_POST['uniqueIDdetail'] = '';
	    }
	    if (isset($_POST['uniqueIDmovement']) === FALSE)
	    {
	        $_POST['uniqueIDmovement'] = '';
	    }
	    if (isset($_GET['p']) === FALSE)
	    {
	        $_GET['p'] = '';
	    }

	    $detail = new Cdetail();
	    $detail->setDbConn($this->getDbConn());

	    $movement = new Cmovement();
	    $movement->setDbConn($this->getDbConn());

	    if (isset($configDetail['detail']['control_file']) === FALSE)
	    {
	        $configDetail['detail']['control_file'] = 'detail.php';
	    }
	    if (isset($configDetail['detail']['fields']) === FALSE)
	    {
	        $configDetail['detail']['fields'] = '';
	    }
	    if (isset($configDetail['detail']['update']) === FALSE)
	    {
	        $configDetail['detail']['update'] = '';
	    }
	    if (isset($configDetail['detail']['delete']) === FALSE)
	    {
	        $configDetail['detail']['delete'] = '';
	    }
	    if (isset($configDetail['detail']['title']) === FALSE)
	    {
	        $configDetail['detail']['title'] = '&nbsp;';
	    }

	    if ($_POST['updateSale'] == 'update')
	    {
	        $this->setId($_POST['id'], TRUE);
	        if (in_array('dateAdded', $arrayFields) === TRUE)
	        {
	            $this->setDateAdded($_POST['dateAdded'], FALSE);
	        }
	        if (in_array('totalAmountGross', $arrayFields) === TRUE)
	        {
	            $this->setTotalAmountGross($_POST['totalAmountGross'], TRUE);
	        }
	        if (in_array('discount', $arrayFields) === TRUE)
	        {
	            $this->setDiscount($_POST['discount'], TRUE);
	        }
	        if (in_array('totalAmountNet', $arrayFields) === TRUE)
	        {
	            $this->setTotalAmountNet($_POST['totalAmountNet'], TRUE);
	        }
	        if (in_array('idClient', $arrayFields) === TRUE)
	        {
	            $this->setIdClient($_POST['idClient'], TRUE);
	        }
	        if (in_array('casualCustomer', $arrayFields) === TRUE)
	        {
	            $this->setCasualCustomer($_POST['casualCustomer'], TRUE);
	        }

	        if ($detail->validateRequiredDetail($_POST['uniqueIDdetail']) === FALSE)
	        {
	            $this->addError(CSALE_UPDATE_FORM_REQUIRED_DETAIL_DETAIL);
	        }
	        if ($movement->validateRequiredDetail($_POST['uniqueIDmovement']) === FALSE)
	        {
	            $this->addError(CSALE_ADD_FORM_REQUIRED_DETAIL_MOVEMENT);
	        }

	        //Verifico que si elije un pago en cta cte haya seleccionado un cliente
	        if($movement->validateDataDetail($_POST['uniqueIDmovement'], $_POST['idClient']) === FALSE)
	        {
	            $this->addError(CSALE_ADD_FORM_ID_CLIENT_DETAIL_MOVEMENT);
	        }

	        if ($this->validateSaleAmount($_POST['uniqueIDdetail'], $_POST['uniqueIDmovement']) === FALSE)
	        {
	            $this->addError(CSALE_ADD_FORM_NOT_MATCH_DETAIL_MOVEMENT);
	        }

	        if ($this->error() === FALSE)
	        {
	            $auxResults = $movement->getTotalAmount($_POST['uniqueIDmovement']);
	            $this->setTotalAmountGross($auxResults[0]);
	            $this->setTotalAmountNet($auxResults[1]);

	            $this->update();

	            if ($this->error() === FALSE)
	            {
	                $detail->setIdSale($this->getId(FALSE));
	                $detail->updateDetail($this->getDateAdded(TRUE), $configDetail['detail']['fields'], $_POST['uniqueIDdetail']);

	                $movement->setIdSale($this->getId(FALSE));
	                $movement->updateDetail($this->getDateAdded(TRUE), $this->getIdClient(FALSE), $_POST['uniqueIDmovement']);
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
					<div class="message success"><?php echo CSALE_UPDATE_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CSALE_UPDATE_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
				<form name="formUpdateSale" id="formUpdateSale" method="post" action="">
				<input name="updateSale" type="hidden" id="updateSale" value="back" />
				<div class="fields">
				<?php
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					echo '<input name="dateAdded" type="hidden" id="dateAdded" value="'.$this->getDateAdded().'" />';
				}
				if (in_array('totalAmountGross', $arrayFields) === TRUE)
				{
					echo '<input name="totalAmountGross" type="hidden" id="totalAmountGross" value="'.$this->getTotalAmountGross().'" />';
				}
				if (in_array('discount', $arrayFields) === TRUE)
				{
					echo '<input name="discount" type="hidden" id="discount" value="'.$this->getDiscount().'" />';
				}
				if (in_array('totalAmountNet', $arrayFields) === TRUE)
				{
					echo '<input name="totalAmountNet" type="hidden" id="totalAmountNet" value="'.$this->getTotalAmountNet().'" />';
				}
				if (in_array('idClient', $arrayFields) === TRUE)
				{
					echo '<input name="idClient" type="hidden" id="idClient" value="'.$this->getIdClient().'" />';
				}
				if (in_array('casualCustomer', $arrayFields) === TRUE)
				{
					echo '<input name="casualCustomer" type="hidden" id="casualCustomer" value="'.$this->getCasualCustomer().'" />';
				}
				echo '<input name="is_client" type="hidden"  value="'.$_POST['is_client'].'" />';
				echo '<input name="uniqueIDdetail" type="hidden"  value="'.$_POST['uniqueIDdetail'].'" />';
				echo '<input name="uniqueIDmovement" type="hidden"  value="'.$_POST['uniqueIDmovement'].'" />';
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CSALE_UPDATE_FORM_BACK_BTN; ?>" class="back" />
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
				if ($_POST['updateSale'] == 'back')
				{
					if (in_array('dateAdded', $arrayFields) === TRUE)
					{
						$this->setDateAdded($_POST['dateAdded'], FALSE);
					}
					if (in_array('totalAmountGross', $arrayFields) === TRUE)
					{
						$this->setTotalAmountGross($_POST['totalAmountGross'], TRUE);
					}
					if (in_array('discount', $arrayFields) === TRUE)
					{
						$this->setDiscount($_POST['discount'], TRUE);
					}
					if (in_array('totalAmountNet', $arrayFields) === TRUE)
					{
						$this->setTotalAmountNet($_POST['totalAmountNet'], TRUE);
					}
					if (in_array('idClient', $arrayFields) === TRUE)
					{
						$this->setIdClient($_POST['idClient'], TRUE);
					}
					if (in_array('casualCustomer', $arrayFields) === TRUE)
					{
						$this->setCasualCustomer($_POST['casualCustomer'], TRUE);
					}
					$uniqueIDdetail	    = $_POST['uniqueIDdetail'];
					$uniqueIDmovement   = $_POST['uniqueIDmovement'];
				}
				else
				{
					$uniqueIDdetail = uniqid('detail_');
					$_SESSION[$uniqueIDdetail] = array();

					$uniqueIDmovement = uniqid('movement_');
					$_SESSION[$uniqueIDmovement] = array();

					$detail->setIdSale($this->getId(FALSE));
					$detail->loadDetail($uniqueIDdetail);

					$movement->setIdSale($this->getId(FALSE));
					$movement->loadDetail($uniqueIDmovement);

					if(empty($this->getIdClient(FALSE)) == FALSE)
					{
					    $_POST['is_client'] = 'client';
					}
					elseif(empty($this->getCasualCustomer()) == FALSE)
					{
					    $_POST['is_client'] = 'no_client';
					}
					else
					{
					    $_POST['is_client'] = 'client';
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
				<form name="formUpdateSale" id="formUpdateSale" method="post" action="">
				<input name="updateSale" type="hidden" id="updateSale" value="update" />
				<input name="id" type="hidden" id="id" value="<?php echo $this->getId(); ?>" />
				<div class="fields">
				<?php
				foreach ($arrayFields as $value)
				{
					if ($value == 'id')
					{
					?>
					<div class="field">
						<label><?php echo CSALE_UPDATE_FORM_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
					<?php
					}
					if ($value == 'dateAdded')
					{
					?>
					<div class="field">
						<label><?php echo CSALE_UPDATE_FORM_LABEL_FIELD_DATE_ADDED; ?> <span>*</span></label>
						<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
					<?php
					}
					if ($value == 'totalAmountGross')
					{
					?>
					<div class="field">
						<label><?php echo CSALE_UPDATE_FORM_LABEL_FIELD_TOTAL_AMOUNT_GROSS; ?> <span>*</span></label>
						<input name="totalAmountGross" type="text" id="totalAmountGross" value="<?php echo $this->getTotalAmountGross(); ?>" class="num" />
					</div>
					<?php
					}
					if ($value == 'discount')
					{
					?>
					<div class="field">
						<label><?php echo CSALE_UPDATE_FORM_LABEL_FIELD_DISCOUNT; ?></label>
						<input name="discount" type="text" id="discount" value="<?php echo $this->getDiscount(); ?>" class="num" />
					</div>
					<?php
					}
					if ($value == 'totalAmountNet')
					{
					?>
					<div class="field">
						<label><?php echo CSALE_UPDATE_FORM_LABEL_FIELD_TOTAL_AMOUNT_NET; ?></label>
						<input name="totalAmountNet" type="text" id="totalAmountNet" value="<?php echo $this->getTotalAmountNet(); ?>" class="num" />
					</div>
					<?php
					}
					if ($value == 'idClient')
					{
					    $auxClientName = '';
					    if(empty($this->getIdClient(FALSE)) == FALSE)
					    {
    						$auxClient = new Cprovider($this->getDbConn());
    						$auxClient->setId($this->getIdClient(FALSE));
    						if($auxClient->getData() == TRUE)
    						{
    						    $auxClientName = $auxClient->getName(FALSE);
    						}
					    }
				        $auxIsClient    = '';
				        $auxIsNotClient = '';
    					?>
    				    <div class="field">
    						<label></label>
    						<fieldset class="option-client">
                			    <label for="true">Cliente</label>
                			    <?php
                			    $selectedTrue = '';
                			    if(empty($_POST['is_client']) == TRUE or $_POST['is_client'] == 'client')
                			    {
                			        $selectedTrue = ' checked="checked"';
                			        $auxIsNotClient = ' style="display: none;"';
                			    }
                			    ?>
                			    <input type="radio" name="is_client" id="true" class="btnClient" value="client"<?php echo $selectedTrue; ?>/>
                			    <label for="false">Ocasional</label>
                			    <?php
                			    $selectedFalse = '';
                			    if($_POST['is_client'] == 'no_client')
                			    {
                			        $selectedFalse = ' checked="checked"';
                			        $auxIsClient = ' style="display: none;"';
                			    }
                			    ?>
                			    <input type="radio" name="is_client" id="false" class="btnClient" value="no_client"<?php echo $selectedFalse; ?>/>
                			</fieldset>
                			<script type="text/javascript">
                    		$(document).ready(function() {
                    		    $( ".btnClient" ).checkboxradio({
                    				icon: false
                    		    });
                    		    $( "fieldset" ).controlgroup();
                    		    $( ".btnClient" ).on("change", function(event){
                        		    if(this.value == "no_client")
                        		    {
                        		    	$( "#loadClient" ).hide();
                        		    	$( "#loadNotClient" ).show();
                        		    	//Limpio
                        		    	$("#idClientAutocomplete").val("");
                        		    	$("#idClient").val("");
                        		    	$("#ctaCteClient").hide();
                        		    }
                        		    else
                        		    {
                        		    	$( "#loadClient" ).show();
                        		    	$( "#loadNotClient" ).hide();
                        		    	$("#casualCustomer").val("");
                        		    }
                        		});
                    		});
                    		</script>
    					</div>
    					<div id="loadClient" class="field autocompleteWrapper"<?php echo $auxIsClient;?>>
    						<label><?php echo CSALE_UPDATE_FORM_LABEL_FIELD_ID_CLIENT; ?></label>
    						<input name="idClientAutocomplete" id="idClientAutocomplete" value="<?php echo $auxClientName; ?>" class="str autocomplete" maxlength="255" type="text" />
    						<input name="idClient" id="idClient" value="<?php echo $this->getIdClient(FALSE); ?>" type="hidden" />
    					</div>
    					<div id="loadNotClient" class="field"<?php echo $auxIsNotClient; ?>>
    						<label><?php echo CSALE_ADD_FORM_LABEL_FIELD_CASUAL_CUSTOMER; ?></label>
    						<input name="casualCustomer" type="text" id="casualCustomer" value="<?php echo $this->getCasualCustomer(); ?>" class="str" maxlength="255" />
    					</div>
    					<div id="ctaCteClient"></div>
    					<?php
					}
				}
				?>
				</div>
				<div class="detail">
					<input name="uniqueIDdetail" value="<?php echo $uniqueIDdetail; ?>" type="hidden" />
				    <input name="uniqueIDmovement" value="<?php echo $uniqueIDmovement; ?>" type="hidden" />
				<?php
					$detail->formDetail($configDetail['detail']['control_file'], $configDetail['detail']['fields'], $configDetail['detail']['update'], $configDetail['detail']['delete'], $configDetail['detail']['title'], $uniqueIDdetail);
				    echo '<br /><br /><br />';
				    $movement->formDetail('sale-movement.php', $uniqueIDmovement);
				?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CSALE_UPDATE_FORM_SUBMIT_BTN; ?>" class="accept" />
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CSALE_UPDATE_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="cancel" />
				<?php
				}
				?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CSALE_UPDATE_FORM_LABEL_REQUIRED; ?></span>
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
					<input type="button" value="<?php echo CSALE_UPDATE_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
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
	 * Elimina un registro existente de la tabla sale y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un registro de la tabla sale y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
		    $refund = new Crefund($this->getDbConn());
		    $refund->setIdSale($this->getId(FALSE));
		    $refund->delSaleRefund();

		    $payment = new Cpayment($this->getDbConn());
		    $payment->delSalePayment($this->getId(FALSE));

		    $detail = new Cdetail($this->getDbConn());
		    $detail->setIdSale($this->getId(FALSE));
		    $detail->delDetail();

		    $movement = new Cmovement($this->getDbConn());
		    $movement->setIdSale($this->getId(FALSE));
		    $movement->delSaleMovement();

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
					<div class="message success"><?php echo CSALE_DEL_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CSALE_DEL_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
					<input type="button" value="<?php echo CSALE_DEL_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
				</div>
		<?php
		}
		?>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Elimina un grupo de registros existente de la tabla sale y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un grupo de registros de la tabla sale y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
			$detail = new Cdetail();
			$detail->setDbConn($this->getDbConn());

			$movement = new Cmovement();
			$movement->setDbConn($this->getDbConn());

			$refund = new Crefund();
			$refund->setDbConn($this->getDbConn());

			$payment = new Cpayment();
			$payment->setDbConn($this->getDbConn());


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
					    $refund->setIdSale($this->getId(FALSE));
					    $refund->delSaleRefund();

					    $payment->delSalePayment($this->getId(FALSE));

					    $detail->setIdSale($this->getId(FALSE));
					    $detail->delDetail();

					    $movement->setIdSale($this->getId(FALSE));
					    $movement->delSaleMovement();
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
			$this->addError(CSALE_DEL_GROUP_FORM_REQUIRED_PK);
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
					<div class="message success"><?php echo CSALE_DEL_GROUP_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CSALE_DEL_GROUP_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="success" />
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
				$this->addError(CSALE_DEL_GROUP_FORM_CANT_DELETE_ALL);
			}
			?>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="button" value="<?php echo CSALE_DEL_GROUP_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="back" />
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
	 * - {@link Cdetail::showDetail() Cdetail: showDetail}
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
			$fields = 'id,dateAdded,totalAmountGross,discount,totalAmountNet,idUserAdd,idClient,casualCustomer';
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
						<label><?php echo CSALE_SHOW_DATA_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'dateAdded')
			{
			?>
					<div class="field">
						<label><?php echo CSALE_SHOW_DATA_LABEL_FIELD_DATE_ADDED; ?></label>
						<strong><?php echo $this->getDateAdded(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'totalAmountGross')
			{
			?>
					<div class="field">
						<label><?php echo CSALE_SHOW_DATA_LABEL_FIELD_TOTAL_AMOUNT_GROSS; ?></label>
						<strong><?php echo $this->getTotalAmountGross(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'discount')
			{
			?>
					<div class="field">
						<label><?php echo CSALE_SHOW_DATA_LABEL_FIELD_DISCOUNT; ?></label>
						<strong><?php echo $this->getDiscount(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'totalAmountNet')
			{
			?>
					<div class="field">
						<label><?php echo CSALE_SHOW_DATA_LABEL_FIELD_TOTAL_AMOUNT_NET; ?></label>
						<strong><?php echo $this->getTotalAmountNet(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idUserAdd')
			{
			?>
					<div class="field">
						<label><?php echo CSALE_SHOW_DATA_LABEL_FIELD_ID_USER_ADD; ?></label>
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
			if ($value == 'idClient')
			{
			?>
					<div class="field">
						<label><?php echo CSALE_SHOW_DATA_LABEL_FIELD_ID_CLIENT; ?></label>
				<?php
				$oIdClient = new Cprovider();
				$oIdClient->setDbConn($this->getDbConn());
				$oIdClient->setId($this->getIdClient(FALSE));
				$oIdClient->getData();
				?>
						<strong><?php echo $oIdClient->getName(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'casualCustomer')
			{
			?>
					<div class="field">
						<label><?php echo CSALE_SHOW_DATA_LABEL_FIELD_CASUAL_CUSTOMER; ?></label>
						<strong><?php echo $this->getCasualCustomer(); ?></strong>
					</div>
			<?php
			}
		}
		?>
				</div>
				<div class="detail">
		<?php
		$detail = new Cdetail();
		$detail->setDbConn($this->getDbConn());

		if (isset($configDetail['detail']['fields']) === FALSE)
		{
			$configDetail['detail']['fields'] = '';
		}
		if (isset($configDetail['detail']['title']) === FALSE)
		{
			$configDetail['detail']['title'] = '&nbsp;';
		}

		$detail->setIdSale($this->getId(FALSE));
		$detail->showDetail($configDetail['detail']['fields'], $configDetail['detail']['title']);
		?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
		<?php
		if (validateRequiredValue($href) === TRUE)
		{
		?>
					<input type="button" value="<?php echo CSALE_SHOW_DATA_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
		<?php
		}
		?>
				</div>
				<div class="bottom"></div>
			</div>
	<?php
	}

	/**
	 * Muestra un formulario de búsqueda de registros de la tabla sale
	 *
	 * Este método muestra un formulario con los campos seteados en el parámetro $fields para realizar una búsqueda de los registros de la tabla sale.
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
			$fields = 'id,dateAdded,totalAmountGross,discount,totalAmountNet,idUserAdd,idClient,casualCustomer';
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
			if (isset($_SESSION['main_tr_search_sale']) === FALSE)
			{
				$_SESSION['main_tr_search_sale'] = '';
			}

			$display  = 'display: none;';
			$btnClass = 'closed';
			if ($_SESSION['main_tr_search_sale'] === 'open')
			{
				$display  = '';
				$btnClass = 'open';
			}
		}
		?>
				<div class="title">
					<div class="ico"><?php if ($showHideBtn === TRUE) { ?><a href="#" onclick="showHideSearch('sale'); return false;" class="<?php echo $btnClass; ?>"></a><?php } ?></div>
					<div class="label"><a href="#" onclick="showHideSearch('sale'); return false;"><?php echo $title; ?></a></div>
				</div>
				<div id="container_search_sale" style="<?php echo $display; ?>">
					<div class="top"></div>
					<form name="formSearchSale" id="formSearchSale" method="<?php echo $method; ?>" action="">
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
							<label><?php echo CSALE_SEARCH_FORM_LABEL_FIELD_ID; ?></label>
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
							<label><?php echo CSALE_SEARCH_FORM_LABEL_FIELD_DATE_ADDED; ?></label>
							<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
						</div>
				<?php
				if (validateRequiredValue($this->getDateAdded()) === TRUE)
				{
					$condition[] = $this->getFieldSql('date_added', $this->getTableName()).' = '.$this->getValueSql($this->dateAdded);
					$params[] = 'dateAdded='.urlencode($this->getDateAdded());
				}
			}

			if ($value == 'totalAmountGross')
			{
				$this->setTotalAmountGross($values['totalAmountGross'], TRUE);
				?>
						<div class="field">
							<label><?php echo CSALE_SEARCH_FORM_LABEL_FIELD_TOTAL_AMOUNT_GROSS; ?></label>
							<input name="totalAmountGross" type="text" id="totalAmountGross" value="<?php echo $this->getTotalAmountGross(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getTotalAmountGross()) === TRUE)
				{
					$condition[] = $this->getFieldSql('total_amount_gross', $this->getTableName()).' = '.$this->getValueSql($this->totalAmountGross);
					$params[] = 'totalAmountGross='.urlencode($this->totalAmountGross);
				}
			}

			if ($value == 'discount')
			{
				$this->setDiscount($values['discount'], TRUE);
				?>
						<div class="field">
							<label><?php echo CSALE_SEARCH_FORM_LABEL_FIELD_DISCOUNT; ?></label>
							<input name="discount" type="text" id="discount" value="<?php echo $this->getDiscount(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getDiscount()) === TRUE)
				{
					$condition[] = $this->getFieldSql('discount', $this->getTableName()).' = '.$this->getValueSql($this->discount);
					$params[] = 'discount='.urlencode($this->discount);
				}
			}

			if ($value == 'totalAmountNet')
			{
				$this->setTotalAmountNet($values['totalAmountNet'], TRUE);
				?>
						<div class="field">
							<label><?php echo CSALE_SEARCH_FORM_LABEL_FIELD_TOTAL_AMOUNT_NET; ?></label>
							<input name="totalAmountNet" type="text" id="totalAmountNet" value="<?php echo $this->getTotalAmountNet(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getTotalAmountNet()) === TRUE)
				{
					$condition[] = $this->getFieldSql('total_amount_net', $this->getTableName()).' = '.$this->getValueSql($this->totalAmountNet);
					$params[] = 'totalAmountNet='.urlencode($this->totalAmountNet);
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
							<label><?php echo CSALE_SEARCH_FORM_LABEL_FIELD_ID_USER_ADD; ?></label>
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
			if ($value == 'idClient')
			{
				$this->setIdClient($values['idClient'], TRUE);

				$auxClientName = '';
				if(empty($this->getIdClient(FALSE)) == FALSE)
				{
				    $auxClient = new Cprovider($this->getDbConn());
				    $auxClient->setId($this->getIdClient(FALSE));
				    if($auxClient->getData() == TRUE)
				    {
					$auxClientName = $auxClient->getName(FALSE);
				    }
				}
				?>
						<div class="field autocompleteWrapper">
							<label><?php echo CSALE_SEARCH_FORM_LABEL_FIELD_ID_CLIENT; ?></label>
							<input name="idClientAutocomplete" id="idClientAutocomplete" value="<?php echo $auxClientName; ?>" class="str autocomplete" maxlength="255" type="text" />
							<input name="idClient" id="idClient" value="<?php echo $this->getIdClient(FALSE); ?>" type="hidden" />
				<?php
				/*$oIdClient = new Cprovider();
				$oIdClient->setDbConn($this->getDbConn());
				$oIdClient->showList('name', 'name', $this->getIdClient(), 'idClient', 'idClient', 'select_search');*/
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdClient()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_client', $this->getTableName()).' = '.$this->getValueSql($this->idClient);
					$params[] = 'idClient='.urlencode($this->idClient);
				}
			}
			if ($value == 'casualCustomer')
			{
				$this->setCasualCustomer($values['casualCustomer'], TRUE);
				?>
						<div class="field">
							<label><?php echo CSALE_SEARCH_FORM_LABEL_FIELD_CASUAL_CUSTOMER; ?></label>
							<input name="casualCustomer" type="text" id="casualCustomer" value="<?php echo $this->getCasualCustomer(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getCasualCustomer()) === TRUE)
				{
					$condition[] = $this->getFieldSql('casual_customer', $this->getTableName()).' LIKE '.$this->getValueSql($this->casualCustomer, '%%');
					$params[] = 'casualCustomer='.urlencode($this->casualCustomer);
				}
			}
		}
		?>
					</div>
					<div class="middle"></div>
					<div class="buttons">
						<input type="submit" value="<?php echo CSALE_SEARCH_FORM_SUBMIT_BTN; ?>" class="search" />
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
	 * Muestra el resultado de una consulta a la tabla sale
	 *
	 * Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla sale. Muestra sólo los campos seteados en el parámetro $fields.
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
	 * Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST['saleGroup'] (array)</b>
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
			$fields[2]['field'] = 'totalAmountGross';
			$fields[3]['field'] = 'discount';
			$fields[4]['field'] = 'totalAmountNet';
			$fields[5]['field'] = 'idUserAdd';
			$fields[6]['field'] = 'idClient';
			$fields[7]['field'] = 'casualCustomer';
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
			$arrayOrder = array('id', 'date_added', 'total_amount_gross', 'discount', 'total_amount_net', 'id_user_add', 'id_client', 'casual_customer');
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

				$head.= '<div class="col" style="width: '.$arrayWidth['id'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CSALE_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></div>';
				$headers['id'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CSALE_SHOW_QUERY_HEAD_FIELD_ID).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['dateAdded'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CSALE_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div></div>';
				$headers['dateAdded'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CSALE_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div>';
			}

			if ($value == 'totalAmountGross')
			{
				if ($_GET['orderby'] == 'total_amount_gross')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=total_amount_gross&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=total_amount_gross&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=total_amount_gross&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['totalAmountGross'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_GROSS, $arrayStrLen['totalAmountGross']), CSALE_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_GROSS).'</a></div></div>';
				$headers['totalAmountGross'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_GROSS, $arrayStrLen['totalAmountGross']), CSALE_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_GROSS).'</a></div>';
			}

			if ($value == 'discount')
			{
				if ($_GET['orderby'] == 'discount')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=discount&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=discount&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=discount&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['discount'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_DISCOUNT, $arrayStrLen['discount']), CSALE_SHOW_QUERY_HEAD_FIELD_DISCOUNT).'</a></div></div>';
				$headers['discount'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_DISCOUNT, $arrayStrLen['discount']), CSALE_SHOW_QUERY_HEAD_FIELD_DISCOUNT).'</a></div>';
			}

			if ($value == 'totalAmountNet')
			{
				if ($_GET['orderby'] == 'total_amount_net')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=total_amount_net&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=total_amount_net&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=total_amount_net&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['totalAmountNet'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_NET, $arrayStrLen['totalAmountNet']), CSALE_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_NET).'</a></div></div>';
				$headers['totalAmountNet'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_NET, $arrayStrLen['totalAmountNet']), CSALE_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_NET).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['idUserAdd'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CSALE_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div></div>';
				$headers['idUserAdd'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CSALE_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div>';
			}
			if ($value == 'idClient')
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
				$head.= '<div class="col" style="width: '.$arrayWidth['idClient'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_ID_CLIENT, $arrayStrLen['idClient']), CSALE_SHOW_QUERY_HEAD_FIELD_ID_CLIENT).'</a></div></div>';
				$headers['idClient'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_ID_CLIENT, $arrayStrLen['idClient']), CSALE_SHOW_QUERY_HEAD_FIELD_ID_CLIENT).'</a></div>';
			}
			if ($value == 'casualCustomer')
			{
				if ($_GET['orderby'] == 'casual_customer')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=casual_customer&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=casual_customer&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=casual_customer&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['casualCustomer'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_CASUAL_CUSTOMER, $arrayStrLen['casualCustomer']), CSALE_SHOW_QUERY_HEAD_FIELD_CASUAL_CUSTOMER).'</a></div></div>';
				$headers['casualCustomer'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_CASUAL_CUSTOMER, $arrayStrLen['casualCustomer']), CSALE_SHOW_QUERY_HEAD_FIELD_CASUAL_CUSTOMER).'</a></div>';
			}

			if ($value == 'products')
			{
				$head.= '<div class="col" style="width: '.$arrayWidth['products'].';"><div class="str">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_PRODUCTS, $arrayStrLen['products']), CSALE_SHOW_QUERY_HEAD_FIELD_PRODUCTS).'</div></div>';
				$headers['products'] = '<div class="str">'.altText(getCutString(CSALE_SHOW_QUERY_HEAD_FIELD_PRODUCTS, $arrayStrLen['products']), CSALE_SHOW_QUERY_HEAD_FIELD_PRODUCTS).'</div>';
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
				<form name="formQuerySale" id="formQuerySale" method="post" action="">
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
				<div class="message warning"><?php echo CSALE_SHOW_QUERY_NOT_FOUND; ?></div>
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
					<div class="row row<?php echo $class; ?>" id="sale_tr_<?php echo $row['id']; ?>" data-table-name="sale" data-id="<?php echo $row['id']; ?>" data-form-id="formQuerySale">
				<?php
				if (is_array($groupActions) === TRUE)
				{
				?>
						<div class="col header"></div>
						<div class="col" style="width: <?php echo $widthGroupActions; ?>;"><div class="group-actions"><input name="saleGroup[]" type="checkbox" id="cb_sale_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="checkboxClick(this)" /></div></div>
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

					if ($value == 'totalAmountGross')
					{
					?>
						<div class="col header"><?php echo $headers['totalAmountGross']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['totalAmountGross']; ?>;"><div class="num"><?php echo altText(getCutString($row['totalAmountGross'], $arrayStrLen['totalAmountGross']), $row['totalAmountGross']); ?></div></div>
					<?php
					}

					if ($value == 'discount')
					{
					?>
						<div class="col header"><?php echo $headers['discount']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['discount']; ?>;"><div class="num"><?php echo altText(getCutString($row['discount'], $arrayStrLen['discount']), $row['discount']); ?></div></div>
					<?php
					}

					if ($value == 'totalAmountNet')
					{
					?>
						<div class="col header"><?php echo $headers['totalAmountNet']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['totalAmountNet']; ?>;"><div class="num"><?php echo altText(getCutString($row['totalAmountNet'], $arrayStrLen['totalAmountNet']), $row['totalAmountNet']); ?></div></div>
					<?php
					}

					if ($value == 'idUserAdd')
					{
					?>
						<div class="col header"><?php echo $headers['idUserAdd']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idUserAdd']; ?>;"><div class="str"><?php echo altText(getCutString($row['userName'], $arrayStrLen['idUserAdd']), $row['userName']); ?></div></div>
					<?php
					}
					if ($value == 'idClient')
					{
					?>
						<div class="col header"><?php echo $headers['idClient']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idClient']; ?>;"><div class="str"><?php echo altText(getCutString($row['providerName'], $arrayStrLen['idClient']), $row['providerName']); ?></div></div>
					<?php
					}
					if ($value == 'casualCustomer')
					{
					?>
						<div class="col header"><?php echo $headers['casualCustomer']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['casualCustomer']; ?>;"><div class="str"><?php echo altText(getCutString($row['casualCustomer'], $arrayStrLen['casualCustomer']), $row['casualCustomer']); ?></div></div>
					<?php
					}
					if ($value == 'products')
					{
					    $auxProduct	    = new Cproduct($this->getDbConn());
					    $auxRefund      = new Crefund($this->getDbConn());
					    $auxDetail	    = new Cdetail($this->getDbConn());
					    $searchDetail   = $auxDetail->getFieldSql('id_sale', $auxDetail->getTableName()).' = '.$auxDetail->getvalueSql($row['id']);
					    $resDetail	    = $auxDetail->getList($searchDetail);
					    $auxContent	    = '';
					    if($resDetail != FALSE)
					    {
    						foreach ($resDetail as $val)
    						{
                                $auxProduct->setId($val['idProduct']);
                                $auxText = '';
                                if($auxProduct->isPayed($row['id']) == TRUE)
                                {
                                    $auxText .= ' [pagado]';
                                }
                                if($auxProduct->isRefunded($row['id']) == TRUE)
                                {
                                    $auxText .= ' [devuelto]';
                                }


                                $auxContent .= '<div>&bull; #'.$val['idProduct'].' - '.$val['productName'].$auxText.'</div>';
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

						$auxSale = new Csale($this->getDbConn());
						$auxSale->setId($row['id']);
						if(($value['file'] == 'refund-add.php' and $this->canRefund($row['id']) == FALSE) or ($value['file'] == 'sale-update.php' and $auxSale->hasRefund() == TRUE))
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
						<input name="sale_select_all" type="checkbox" id="sale_select_all" value="" class="checkbox_show_query" onclick="querySelectAll('sale', 'formQuerySale')" />
						<span><?php echo CSALE_SHOW_QUERY_SELECT_ALL; ?></span>
					</div>
			<?php
			$j = 1;
			foreach ($groupActions as $value)
			{
				if ($value['confirm'] === TRUE)
				{
					$onclick = 'onclick="formQuerySubmit(\'formQuerySale\', \''.$value['file'].'\', \''.$actionsParams.'\', true, \''.$value['msg'].'\');"';
				}
				else
				{
					$onclick = 'onclick="formQuerySubmit(\'formQuerySale\', \''.$value['file'].'\', \''.$actionsParams.'\', false, \'\');"';
				}

				if ($value['button'] === TRUE)
				{
					echo '<input type="button" name="sale_ga_'.$j.'" id="sale_ga_'.$j.'" value="'.$value['text'].'" class="'.$value['class'].'" '.$onclick.' />';
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
	 * Valida que los montos de los pagos sean igual a los de la venta
	 *
	 * @param string $uniqueIDdetail
	 * @param string $uniqueIDmovement
	 */
	public function validateSaleAmount($uniqueIDdetail, $uniqueIDmovement)
	{
	    if (isset($uniqueIDdetail) === TRUE and isset($uniqueIDmovement) == TRUE)
	    {
		if (is_array($_SESSION[$uniqueIDdetail]) === TRUE and is_array($_SESSION[$uniqueIDmovement]) === TRUE)
		{
		    $amountDetail = 0;
		    foreach ($_SESSION[$uniqueIDdetail] as $item)
		    {
			$amountDetail += $item['amount'];
		    }

		    $amountMovement = 0;
		    foreach ($_SESSION[$uniqueIDmovement] as $item)
		    {
			$amountMovement += $item['amount'];
		    }

		    if(round($amountDetail) == round($amountMovement))
		    {
			return TRUE;
		    }
		}
	    }

	    return FALSE;
	}

	/**
	 * Muestra un listado de la tabla user en un campo select
	 *
	 * @param string $field campo que se muestra en el select
	 * @param string $order [opcional] campo por el cual se ordena el listado
	 * @param string $value [opcional] valor seleccionado
	 * @param string $name [opcional] atributo name del campo select
	 * @param string $id [opcional] atributo id del campo select
	 * @param string $class [opcional] atributo class del campo select
	 * @param string $filter [opcional] Filtro para el llenado del combo
	 * @return string
	 * @access public
	 */
	public function showList($field, $order = '', $value = '', $name = '', $id = '', $class = '', $filter = '')
	{
	    $provider = new Cprovider($this->getDbConn());
	    $list = $this->getList($filter, 0, 0, $this->getFieldSql($order));
	    ?>
		<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="<?php echo $class; ?>">
			<option value=""></option>
		<?php
		if(strpos($field, ',') !== FALSE)
		{
		    $parts = explode(',', $field);
		}
		else
		{
		    $parts = array($field);
		}
		foreach ($list as $row)
		{
		    $providerName = '';
		    $provider->setId($row['id']);
		    if($provider->getData() == TRUE)
		    {
		        $providerName = $provider->getName();
		    }
		    ?>
		    <option value="<?php echo $row['id']; ?>"<?php if ($value == $row['id']) echo ' selected="selected"' ?>>
			<?php
			$space = '';
			foreach($parts as $val)
			{
			    if($val == 'id')
			    {
			        echo '#';
			    }

			    echo $space.$row[trim($val)];
			    $space = ' ';
			}
			if(empty($providerName) == FALSE)
			{
			    echo $space.$providerName;
			}
			?>
		    </option>
		    <?php
		}
		?>
		</select>
		<?php
	}

	/**
	 * Revisa que el producto no tenga devolución
	 */
	public function canRefund($idSale = '')
	{
	    if(empty($idSale) == FALSE)
	    {
	        //$refund  = new Crefund($this->getDbConn());
	        $sale    = new Csale($this->getDbConn());
	        $detail  = new Cdetail($this->getDbConn());

	        $sale->setId($idSale);

	        $search  = $detail->getFieldSql('id_sale', $detail->getTableName()).' = '.$detail->getValueSql($idSale);
	        $rs      = $detail->getList($search, 0, 0, '', FALSE);

	        if ($detail->getTotalList() > 0)
	        {
	            foreach ($rs as $item)
	            {
	                $product = new Cproduct($this->getDbConn());

	                $product->setId($item['idProduct']);

	                $product->getData();

	                if(($product->getStatus() == 'sold' or $product->getStatus() == 'to_pay' or $product->getStatus() == 'paid_out') and $sale->productHasSaleAfterRefund($item['idProduct']) == FALSE)
	                {
	                    return TRUE;
	                }
	            }
	        }
	    }

	    return FALSE;
	}

	/**
	 * Determina si un producto se vendio de nuevo luego de una venta.
	 *
	 * La única forma de que se peuda vender dos o más vces un producto es haber hecho un refund
	 *
	 * Recordemos que un producto puede tener una venta, luego un refund y luego ventas de nuevo.
	 *
	 * @param int $idSale ID de la venta
	 * @param int $idProduct ID del producto
	 *
	 * @return boolean
	 */
	public function productHasSaleAfterRefund($idProduct)
	{
	    if(empty($this->getId(FALSE)) == FALSE or empty($idProduct) == FALSE)
	    {
	        $detail = new Cdetail($this->getDbConn());

	        //Consigo la última venta
	        $sql = 'SELECT MAX(id_sale) AS idSale FROM '.$detail->getTableSql().' WHERE '.$detail->getFieldSql('id_sale').' > '.$detail->getValueSql($this->getId(FALSE)).' AND '.$detail->getFieldSql('id_product').' = '.$detail->getValueSql($idProduct);

	        $row = $detail->getDbConn()->GetRow($sql);

	        if (is_array($row) === TRUE and count($row) > 0 and $row['idSale'] > 0)
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
	        $this->addError(CREFUND_PRODUCT_HAS_SALE_AFTER_REFUND);

	        return FALSE;
	    }
	}

	/**
	 * Verifica si la sale tiene al menos un refund
	 */
	public function hasRefund()
	{
	    if(empty($this->getId(FALSE)) == FALSE)
	    {
	        $refund = new Crefund($this->getDbConn());
	        $search = $refund->getFieldSql('id_sale').'='.$refund->getValueSql($this->getId(FALSE));
	        $list   = $refund->getList($search);

	        if ($refund->getTotalList() > 0)
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
	        $this->addError(CREFUND_PRODUCT_HAS_SALE_AFTER_REFUND);

	        return FALSE;
	    }
	}
}
?>