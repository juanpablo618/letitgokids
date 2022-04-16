<?php
/**
 * Archivo php creado por O-creator
 * 
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla current_account
 * 
 * Esta clase se encarga de la administración de la tabla current_account brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 * 
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Ccurrent_account.php');
 * $current_account = new Ccurrent_account();
 * $current_account->setDbConn($dbConn);
 * ?>
 * </code>
 * 
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:14-06-2019
 */
class Ccurrent_account extends Cbase
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
	 * - Tabla: {@link Cmovement movement}
	 * - Campo: {@link Cmovement::$id id}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
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
	 * Venta
	 * 
	 * - Clave Foránea
	 * - Campo en la base de datos: id_sale
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
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
	 * Descripción
	 * 
	 * - Campo en la base de datos: description
	 * - Tipo de campo en la base de datos: text
	 * 
	 * Ver también: {@link getDescription()}, {@link setDescription()}
	 * @var string
	 * @access private
	 */
	private $description;

	/**
	 * Tipo de Pago
	 * 
	 * - Campo en la base de datos: type_pay
	 * - Tipo de campo en la base de datos: enum('cash','bank','credit','debit','cta_cte')
	 * 
	 * Ver también: {@link getTypePay()}, {@link setTypePay()}
	 * @var string
	 * @access private
	 */
	private $typePay;

	/**
	 * Movimiento
	 * 
	 * - Campo en la base de datos: type_movement
	 * - Tipo de campo en la base de datos: enum('open_box','close_box','expenditure','sale','cta_cte_pay','partner_take_off')
	 * - Campo requerido
	 * 
	 * Ver también: {@link getTypeMovement()}, {@link setTypeMovement()}
	 * @var string
	 * @access private
	 */
	private $typeMovement;

	/**
	 * Usuario
	 * 
	 * - Clave Foránea
	 * - Campo en la base de datos: id_user_add
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
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
	 * Tipo
	 * 
	 * - Campo en la base de datos: type
	 * - Tipo de campo en la base de datos: enum('in','out')
	 * - Campo requerido
	 * 
	 * Ver también: {@link getType()}, {@link setType()}
	 * @var string
	 * @access private
	 */
	private $type;

	/**
	 * Proveedor / Cliente
	 * 
	 * - Clave Foránea
	 * - Campo en la base de datos: id_provider
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
	 * Ver también: {@link getIdProvider()}, {@link setIdProvider()}
	 * @var integer
	 * @access private
	 */
	private $idProvider;

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
	 * Constructor de la clase
	 * 
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('current_account');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Ccurrent_account.php');
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
			$this->addError(CCURRENT_ACCOUNT_SETID_REQUIRED_VALUE);

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
				$this->addError(CCURRENT_ACCOUNT_SETID_VALIDATE_VALUE);

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
	 * $current_account = new Ccurrent_account();
	 * //seteo en el formato que acepta la base de datos (yyyy-mm-dd)
	 * $current_account->setDateAdded('1980-11-24', TRUE);
	 * //seteo en el formato definido en la configuración del script (suponemos que el formato utilizado es dd-mm-yyyy)
	 * $current_account->setDateAdded('24-11-1980', FALSE);
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
			$this->addError(CCURRENT_ACCOUNT_SETDATE_ADDED_REQUIRED_VALUE);

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
					$this->addError(CCURRENT_ACCOUNT_SETDATE_ADDED_VALIDATE_VALUE);

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
					$this->addError(CCURRENT_ACCOUNT_SETDATE_ADDED_VALIDATE_VALUE);

					return FALSE;
				}
			}
			else
			{
				$this->dateAdded = '';
				$this->addError(CCURRENT_ACCOUNT_SETDATE_ADDED_ERROR);

				return FALSE;
			}
		}
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
			$this->addError(CCURRENT_ACCOUNT_SETAMOUNT_REQUIRED_VALUE);

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
				$this->addError(CCURRENT_ACCOUNT_SETAMOUNT_VALIDATE_VALUE);

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
		if ($idSale == '0')
		{
			$idSale = '';
		}
		$this->idSale = setValue($idSale, $gpc);

		if (validateIntValue($this->idSale, '+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CCURRENT_ACCOUNT_SETID_SALE_VALIDATE_VALUE);

			return FALSE;
		}
	}

	/**
	 * Setea el valor {@link $description Descripción}
	 * 
	 * @param string $description indica el valor Descripción
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setDescription($description, $gpc = FALSE)
	{
		$this->description = setValue($description, $gpc);

		return TRUE;
	}

	/**
	 * Setea el valor {@link $typePay Tipo de Pago}
	 * 
	 * @param string $typePay indica el valor Tipo de Pago
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setTypePay($typePay, $gpc = FALSE)
	{
		$this->typePay = setValue($typePay, $gpc);

		return TRUE;
	}

	/**
	 * Setea el valor {@link $typeMovement Movimiento}
	 * 
	 * @param string $typeMovement indica el valor Movimiento
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setTypeMovement($typeMovement, $gpc = FALSE)
	{
		if (validateRequiredValue($typeMovement) === FALSE)
		{
			$this->typeMovement = $typeMovement;
			$this->addError(CCURRENT_ACCOUNT_SETTYPE_MOVEMENT_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->typeMovement = setValue($typeMovement, $gpc);

			return TRUE;
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
		if ($idUserAdd == '0')
		{
			$idUserAdd = '';
		}
		$this->idUserAdd = setValue($idUserAdd, $gpc);

		if (validateIntValue($this->idUserAdd, '+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CCURRENT_ACCOUNT_SETID_USER_ADD_VALIDATE_VALUE);

			return FALSE;
		}
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
		if (validateRequiredValue($type) === FALSE)
		{
			$this->type = $type;
			$this->addError(CCURRENT_ACCOUNT_SETTYPE_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->type = setValue($type, $gpc);

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $idProvider Proveedor / Cliente}
	 * 
	 * @param integer $idProvider indica el valor Proveedor / Cliente
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdProvider($idProvider, $gpc = FALSE)
	{
		if ($idProvider == '0')
		{
			$idProvider = '';
		}
		$this->idProvider = setValue($idProvider, $gpc);

		if (validateIntValue($this->idProvider, '+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CCURRENT_ACCOUNT_SETID_PROVIDER_VALIDATE_VALUE);

			return FALSE;
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
			$this->addError(CCURRENT_ACCOUNT_SETDISCOUNT_VALIDATE_VALUE);

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
	 * $current_account = new Ccurrent_account();
	 * $current_account->setDateAdded('1980-11-24', TRUE);
	 * echo 'Fecha en formato del script: ';
	 * echo $current_account->getDateAdded().'<br />';
	 * echo 'Fecha en el formato que acepta la base de datos: ';
	 * echo $current_account->getDateAdded(TRUE).'<br />';
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
	 * Devuelve el valor {@link $description Descripción}
	 * 
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getDescription($htmlEntities = TRUE)
	{
		return getValue($this->description, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $typePay Tipo de Pago}
	 * 
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getTypePay($htmlEntities = TRUE)
	{
		return getValue($this->typePay, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve la descripción de los valores de {@link $typePay Tipo de Pago}
	 * 
	 * @param string $typePay indica el valor Tipo de Pago
	 * @return string
	 * @access public
	 */
	public function getValuesTypePay($typePay)
	{
		switch ($typePay)
		{
			case 'cash':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_PAY_VALUE_1;
				break;

			case 'bank':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_PAY_VALUE_2;
				break;

			case 'credit':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_PAY_VALUE_3;
				break;

			case 'debit':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_PAY_VALUE_4;
				break;

			case 'cta_cte':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_PAY_VALUE_5;
				break;

			default:
				return '&nbsp;';
		}
	}

	/**
	 * Devuelve el valor {@link $typeMovement Movimiento}
	 * 
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getTypeMovement($htmlEntities = TRUE)
	{
		return getValue($this->typeMovement, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve la descripción de los valores de {@link $typeMovement Movimiento}
	 * 
	 * @param string $typeMovement indica el valor Movimiento
	 * @return string
	 * @access public
	 */
	public function getValuesTypeMovement($typeMovement)
	{
		switch ($typeMovement)
		{
			case 'open_box':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_MOVEMENT_VALUE_1;
				break;

			case 'close_box':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_MOVEMENT_VALUE_2;
				break;

			case 'expenditure':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_MOVEMENT_VALUE_3;
				break;

			case 'sale':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_MOVEMENT_VALUE_4;
				break;

			case 'cta_cte_pay':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_MOVEMENT_VALUE_5;
				break;

			case 'partner_take_off':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_MOVEMENT_VALUE_6;
				break;

			default:
				return '&nbsp;';
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
			case 'in':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_VALUE_1;
				break;

			case 'out':
				return CCURRENT_ACCOUNT_GET_VALUES_TYPE_VALUE_2;
				break;

			default:
				return '&nbsp;';
		}
	}

	/**
	 * Devuelve el valor {@link $idProvider Proveedor / Cliente}
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
	 * Inserta un nuevo registro en la tabla current_account
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

		if (isset($this->description) === TRUE)
		{
			$fields[] = $this->getFieldSql('description');
			$values[] = $this->getValueSql($this->description);
		}

		if (isset($this->typePay) === TRUE)
		{
			$fields[] = $this->getFieldSql('type_pay');
			$values[] = $this->getValueSql($this->typePay);
		}

		if (isset($this->typeMovement) === TRUE)
		{
			$fields[] = $this->getFieldSql('type_movement');
			$values[] = $this->getValueSql($this->typeMovement);
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

		if (isset($this->type) === TRUE)
		{
			$fields[] = $this->getFieldSql('type');
			$values[] = $this->getValueSql($this->type);
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

		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CCURRENT_ACCOUNT_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla current_account
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

			if (isset($this->description) === TRUE)
			{
				$values[] = $this->getFieldSql('description').' = '.$this->getValueSql($this->description);
			}

			if (isset($this->typePay) === TRUE)
			{
				$values[] = $this->getFieldSql('type_pay').' = '.$this->getValueSql($this->typePay);
			}

			if (isset($this->typeMovement) === TRUE)
			{
				$values[] = $this->getFieldSql('type_movement').' = '.$this->getValueSql($this->typeMovement);
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

			if (isset($this->type) === TRUE)
			{
				$values[] = $this->getFieldSql('type').' = '.$this->getValueSql($this->type);
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

			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CCURRENT_ACCOUNT_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CCURRENT_ACCOUNT_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla current_account
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
				$this->addError(CCURRENT_ACCOUNT_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CCURRENT_ACCOUNT_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla current_account
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
				$this->setAmount($row['amount']);
				$this->setIdSale($row['id_sale']);
				$this->setDescription($row['description']);
				$this->setTypePay($row['type_pay']);
				$this->setTypeMovement($row['type_movement']);
				$this->setIdUserAdd($row['id_user_add']);
				$this->setType($row['type']);
				$this->setIdProvider($row['id_provider']);
				$this->setDiscount($row['discount']);
				
				return TRUE;
			}
			else
			{
				$this->addError(CCURRENT_ACCOUNT_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CCURRENT_ACCOUNT_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un conjunto de registros de la tabla current_account
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
		$oIdSale = new Csale();
		$oIdSale->setDbConn($this->getDbConn());

		$oIdUserAdd = new Cuser();
		$oIdUserAdd->setDbConn($this->getDbConn());

		$oIdProvider = new Cprovider();
		$oIdProvider->setDbConn($this->getDbConn());

		$sql = 'SELECT ';
		$sql.= $this->getFieldSql('id', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('date_added', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('amount', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_sale', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('description', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('type_pay', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('type_movement', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_user_add', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('type', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_provider', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('discount', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id', $oIdSale->getTableName(), 'sale_id');
		$sql.= ', '.$this->getFieldSql('date_added', $oIdSale->getTableName(), 'sale_date_added');
		$sql.= ', '.$this->getFieldSql('total_amount_gross', $oIdSale->getTableName(), 'sale_total_amount_gross');
		$sql.= ', '.$this->getFieldSql('discount', $oIdSale->getTableName(), 'sale_discount');
		$sql.= ', '.$this->getFieldSql('total_amount_net', $oIdSale->getTableName(), 'sale_total_amount_net');
		$sql.= ', '.$this->getFieldSql('id_user_add', $oIdSale->getTableName(), 'sale_id_user_add');
		$sql.= ', '.$this->getFieldSql('id_client', $oIdSale->getTableName(), 'sale_id_client');
		$sql.= ', '.$this->getFieldSql('id', $oIdUserAdd->getTableName(), 'user_id');
		$sql.= ', '.$this->getFieldSql('user', $oIdUserAdd->getTableName(), 'user_user');
		$sql.= ', '.$this->getFieldSql('pass', $oIdUserAdd->getTableName(), 'user_pass');
		$sql.= ', '.$this->getFieldSql('id_group', $oIdUserAdd->getTableName(), 'user_id_group');
		$sql.= ', '.$this->getFieldSql('active', $oIdUserAdd->getTableName(), 'user_active');
		$sql.= ', '.$this->getFieldSql('token', $oIdUserAdd->getTableName(), 'user_token');
		$sql.= ', '.$this->getFieldSql('name', $oIdUserAdd->getTableName(), 'user_name');
		$sql.= ', '.$this->getFieldSql('lastname', $oIdUserAdd->getTableName(), 'user_lastname');
		$sql.= ', '.$this->getFieldSql('email', $oIdUserAdd->getTableName(), 'user_email');
		$sql.= ', '.$this->getFieldSql('id', $oIdProvider->getTableName(), 'provider_id');
		$sql.= ', '.$this->getFieldSql('name', $oIdProvider->getTableName(), 'provider_name');
		$sql.= ', '.$this->getFieldSql('email', $oIdProvider->getTableName(), 'provider_email');
		$sql.= ', '.$this->getFieldSql('phone', $oIdProvider->getTableName(), 'provider_phone');
		$sql.= ' FROM '.$this->getTableSql();
		$sql.= ' LEFT JOIN '.$oIdSale->getTableSql().' ON '.$this->getFieldSql('id_sale', $this->getTableName()).' = '.$oIdSale->getFieldSql('id', $oIdSale->getTableName());
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
				$this->addError(CCURRENT_ACCOUNT_GETLIST_ERROR);

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
					$this->setAmount($rs->fields['amount']);
					$this->setIdSale($rs->fields['id_sale']);
					$this->setDescription($rs->fields['description']);
					$this->setTypePay($rs->fields['type_pay']);
					$this->setTypeMovement($rs->fields['type_movement']);
					$this->setIdUserAdd($rs->fields['id_user_add']);
					$this->setType($rs->fields['type']);
					$this->setIdProvider($rs->fields['id_provider']);
					$this->setDiscount($rs->fields['discount']);

					$oIdSale->setDateAdded($rs->fields['sale_date_added'], TRUE);
					$oIdUserAdd->setName($rs->fields['user_name']);
					$oIdProvider->setName($rs->fields['provider_name']);

					$list[] = array(
						'id' => $this->getId($htmlEntities) ,
						'dateAdded' => $this->getDateAdded() ,
						'amount' => $this->getAmount($htmlEntities) ,
						'idSale' => $this->getIdSale($htmlEntities) ,
						'description' => $this->getDescription($htmlEntities) ,
						'typePay' => $this->getTypePay($htmlEntities) ,
						'typeMovement' => $this->getTypeMovement($htmlEntities) ,
						'idUserAdd' => $this->getIdUserAdd($htmlEntities) ,
						'type' => $this->getType($htmlEntities) ,
						'idProvider' => $this->getIdProvider($htmlEntities) ,
						'discount' => $this->getDiscount($htmlEntities) ,
						'saleDateAdded' => $oIdSale->getDateAdded() ,
						'userName' => $oIdUserAdd->getName($htmlEntities) ,
						'providerName' => $oIdProvider->getName($htmlEntities)
					);

					$rs->MoveNext();
				}

				$this->id = NULL;
				$this->dateAdded = NULL;
				$this->amount = NULL;
				$this->idSale = NULL;
				$this->description = NULL;
				$this->typePay = NULL;
				$this->typeMovement = NULL;
				$this->idUserAdd = NULL;
				$this->type = NULL;
				$this->idProvider = NULL;
				$this->discount = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CCURRENT_ACCOUNT_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}

	/**
	 * Me dice si un registro de la tabla current_account puede ser eliminado
	 * 
	 * Este método me dice si un registro de la tabla puede ser eliminado porque existe una relación de la misma con las siguientes tablas:
	 * - {@link Cmovement movement}
	 * 
	 * Si existe al menos un registro que tenga el valor de la clave primaria que se quiere eliminar en los siguientes campos:
	 * - campo {@link Cmovement::$id id} de la tabla {@link Cmovement movement}
	 * el método devuelve FALSE.
	 * 
	 * Ver también: {@link delForm()}, {@link delGroupForm()}
	 * @return boolean
	 * @access public
	 */
	public function canDelete()
	{
		if (validateRequiredValue($this->id) === TRUE)
		{
			$oMovement = new Cmovement();
			$oMovement->setDbConn($this->getDbConn());
			$rsMovement = $oMovement->getList($oMovement->getFieldSql('id', $oMovement->getTableName()).' = '.$oMovement->getValueSql($this->id));

			if ($rsMovement === FALSE)
			{
				$this->addError(CCURRENT_ACCOUNT_CAN_DELETE_ERROR);

				return FALSE;
			}
			else
			{
				$return = TRUE;

				if ($oMovement->getTotalList() > 0)
				{
					$this->addError(CCURRENT_ACCOUNT_CAN_DELETE_CANT_MOVEMENT);

					$return = FALSE;
				}

				return $return;
			}
		}
		else
		{
			$this->addError(CCURRENT_ACCOUNT_CAN_DELETE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Devuelve el último valor ID insertado en la tabla current_account
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
			$this->addError(CCURRENT_ACCOUNT_GET_LAST_ID_ERROR);

			return FALSE;
		}
		else
		{
			return $row['id'];
		}
	}

	/**
	 * Muestra un formulario para dar de alta un registro de la tabla current_account
	 * 
	 * Este método muestra un formulario para dar de alta un registro de la tabla current_account mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,dateAdded,amount,idSale,description,typePay,typeMovement,idUserAdd,type,idProvider,discount';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['addCurrentAccount']) === FALSE)
		{
			$_POST['addCurrentAccount'] = '';
		}

		if ($_POST['addCurrentAccount'] == 'add')
		{
			if (in_array('dateAdded', $arrayFields) === TRUE)
			{
				$this->setDateAdded($_POST['dateAdded'], FALSE);
			}
			if (in_array('amount', $arrayFields) === TRUE)
			{
				$this->setAmount($_POST['amount'], TRUE);
			}
			if (in_array('idSale', $arrayFields) === TRUE)
			{
				$this->setIdSale($_POST['idSale'], TRUE);
			}
			if (in_array('description', $arrayFields) === TRUE)
			{
				$this->setDescription($_POST['description'], TRUE);
			}
			if (in_array('typePay', $arrayFields) === TRUE)
			{
				$this->setTypePay($_POST['typePay'], TRUE);
			}
			if (in_array('typeMovement', $arrayFields) === TRUE)
			{
				$this->setTypeMovement($_POST['typeMovement'], TRUE);
			}
			if (in_array('idUserAdd', $arrayFields) === TRUE)
			{
				$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
			}
			if (in_array('type', $arrayFields) === TRUE)
			{
				$this->setType($_POST['type'], TRUE);
			}
			if (in_array('idProvider', $arrayFields) === TRUE)
			{
				$this->setIdProvider($_POST['idProvider'], TRUE);
			}
			if (in_array('discount', $arrayFields) === TRUE)
			{
				$this->setDiscount($_POST['discount'], TRUE);
			}
			
			if ($this->error() === FALSE)
			{
				$this->add();
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
					<div class="message success"><?php echo CCURRENT_ACCOUNT_ADD_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CCURRENT_ACCOUNT_ADD_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="success" />
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
				<form name="formAddCurrentAccount" id="formAddCurrentAccount" method="post" action="">
				<input name="addCurrentAccount" type="hidden" id="addCurrentAccount" value="back" />
				<div class="fields">
				<?php
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					echo '<input name="dateAdded" type="hidden" id="dateAdded" value="'.$this->getDateAdded().'" />';
				}
				if (in_array('amount', $arrayFields) === TRUE)
				{
					echo '<input name="amount" type="hidden" id="amount" value="'.$this->getAmount().'" />';
				}
				if (in_array('idSale', $arrayFields) === TRUE)
				{
					echo '<input name="idSale" type="hidden" id="idSale" value="'.$this->getIdSale().'" />';
				}
				if (in_array('description', $arrayFields) === TRUE)
				{
					echo '<input name="description" type="hidden" id="description" value="'.$this->getDescription().'" />';
				}
				if (in_array('typePay', $arrayFields) === TRUE)
				{
					echo '<input name="typePay" type="hidden" id="typePay" value="'.$this->getTypePay().'" />';
				}
				if (in_array('typeMovement', $arrayFields) === TRUE)
				{
					echo '<input name="typeMovement" type="hidden" id="typeMovement" value="'.$this->getTypeMovement().'" />';
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					echo '<input name="idUserAdd" type="hidden" id="idUserAdd" value="'.$this->getIdUserAdd().'" />';
				}
				if (in_array('type', $arrayFields) === TRUE)
				{
					echo '<input name="type" type="hidden" id="type" value="'.$this->getType().'" />';
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';
				}
				if (in_array('discount', $arrayFields) === TRUE)
				{
					echo '<input name="discount" type="hidden" id="discount" value="'.$this->getDiscount().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CCURRENT_ACCOUNT_ADD_FORM_BACK_BTN; ?>" class="back" />
				</div>
				</form>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
		else
		{
			if ($_POST['addCurrentAccount'] == 'back')
			{
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					$this->setDateAdded($_POST['dateAdded'], FALSE);
				}
				if (in_array('amount', $arrayFields) === TRUE)
				{
					$this->setAmount($_POST['amount'], TRUE);
				}
				if (in_array('idSale', $arrayFields) === TRUE)
				{
					$this->setIdSale($_POST['idSale'], TRUE);
				}
				if (in_array('description', $arrayFields) === TRUE)
				{
					$this->setDescription($_POST['description'], TRUE);
				}
				if (in_array('typePay', $arrayFields) === TRUE)
				{
					$this->setTypePay($_POST['typePay'], TRUE);
				}
				if (in_array('typeMovement', $arrayFields) === TRUE)
				{
					$this->setTypeMovement($_POST['typeMovement'], TRUE);
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
				}
				if (in_array('type', $arrayFields) === TRUE)
				{
					$this->setType($_POST['type'], TRUE);
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					$this->setIdProvider($_POST['idProvider'], TRUE);
				}
				if (in_array('discount', $arrayFields) === TRUE)
				{
					$this->setDiscount($_POST['discount'], TRUE);
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
				<form name="formAddCurrentAccount" id="formAddCurrentAccount" method="post" action="">
				<input name="addCurrentAccount" type="hidden" id="addCurrentAccount" value="add" />
				<div class="fields">
			<?php
			foreach ($arrayFields as $value)
			{
				if ($value == 'dateAdded')
				{
				?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_ADD_FORM_LABEL_FIELD_DATE_ADDED; ?> <span>*</span></label>
						<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
				<?php
				}
				if ($value == 'amount')
				{
				?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_ADD_FORM_LABEL_FIELD_AMOUNT; ?> <span>*</span></label>
						<input name="amount" type="text" id="amount" value="<?php echo $this->getAmount(); ?>" class="num" />
					</div>
				<?php
				}
				if ($value == 'idSale')
				{
				?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_ADD_FORM_LABEL_FIELD_ID_SALE; ?></label>
					<?php
					$oIdSale = new Csale();
					$oIdSale->setDbConn($this->getDbConn());
					$oIdSale->showList('dateAdded', 'date_added', $this->getIdSale(), 'idSale', 'idSale', 'select');
					?>
					</div>
				<?php
				}
				if ($value == 'description')
				{
				?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_ADD_FORM_LABEL_FIELD_DESCRIPTION; ?></label>
						<textarea name="description" id="description"><?php echo $this->getDescription(); ?></textarea>
					</div>
				<?php
				}
				if ($value == 'typePay')
				{
				?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_ADD_FORM_LABEL_FIELD_TYPE_PAY; ?></label>
						<select name="typePay" id="typePay">
							<option value=""></option>
							<option value="cash" <?php if ($this->getTypePay() == 'cash') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cash'); ?></option>
							<option value="bank" <?php if ($this->getTypePay() == 'bank') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('bank'); ?></option>
							<option value="credit" <?php if ($this->getTypePay() == 'credit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('credit'); ?></option>
							<option value="debit" <?php if ($this->getTypePay() == 'debit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('debit'); ?></option>
							<option value="cta_cte" <?php if ($this->getTypePay() == 'cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cta_cte'); ?></option>
						</select>
					</div>
				<?php
				}
				if ($value == 'typeMovement')
				{
				?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_ADD_FORM_LABEL_FIELD_TYPE_MOVEMENT; ?> <span>*</span></label>
						<select name="typeMovement" id="typeMovement">
							<option value=""></option>
							<option value="open_box" <?php if ($this->getTypeMovement() == 'open_box') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('open_box'); ?></option>
							<option value="close_box" <?php if ($this->getTypeMovement() == 'close_box') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('close_box'); ?></option>
							<option value="expenditure" <?php if ($this->getTypeMovement() == 'expenditure') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('expenditure'); ?></option>
							<option value="sale" <?php if ($this->getTypeMovement() == 'sale') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('sale'); ?></option>
							<option value="cta_cte_pay" <?php if ($this->getTypeMovement() == 'cta_cte_pay') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('cta_cte_pay'); ?></option>
							<option value="partner_take_off" <?php if ($this->getTypeMovement() == 'partner_take_off') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('partner_take_off'); ?></option>
						</select>
					</div>
				<?php
				}
				if ($value == 'idUserAdd')
				{
				?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_ADD_FORM_LABEL_FIELD_ID_USER_ADD; ?></label>
					<?php
					$oIdUserAdd = new Cuser();
					$oIdUserAdd->setDbConn($this->getDbConn());
					$oIdUserAdd->showList('name', 'name', $this->getIdUserAdd(), 'idUserAdd', 'idUserAdd', 'select');
					?>
					</div>
				<?php
				}
				if ($value == 'type')
				{
				?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_ADD_FORM_LABEL_FIELD_TYPE; ?> <span>*</span></label>
						<select name="type" id="type">
							<option value=""></option>
							<option value="in" <?php if ($this->getType() == 'in') echo 'selected="selected"' ?>><?php echo $this->getValuesType('in'); ?></option>
							<option value="out" <?php if ($this->getType() == 'out') echo 'selected="selected"' ?>><?php echo $this->getValuesType('out'); ?></option>
						</select>
					</div>
				<?php
				}
				if ($value == 'idProvider')
				{
				?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_ADD_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
					<?php
					$oIdProvider = new Cprovider();
					$oIdProvider->setDbConn($this->getDbConn());
					$oIdProvider->showList('name', 'name', $this->getIdProvider(), 'idProvider', 'idProvider', 'select');
					?>
					</div>
				<?php
				}
				if ($value == 'discount')
				{
				?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_ADD_FORM_LABEL_FIELD_DISCOUNT; ?></label>
						<input name="discount" type="text" id="discount" value="<?php echo $this->getDiscount(); ?>" class="num" />
					</div>
				<?php
				}
			}
			?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CCURRENT_ACCOUNT_ADD_FORM_SUBMIT_BTN; ?>" class="accept" />
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CCURRENT_ACCOUNT_ADD_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
			<?php
			}
			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CCURRENT_ACCOUNT_ADD_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Muestra un formulario para actualizar un registro existente de la tabla current_account
	 * 
	 * Este método muestra un formulario para actualizar un registro de la tabla current_account mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,dateAdded,amount,idSale,description,typePay,typeMovement,idUserAdd,type,idProvider,discount';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['updateCurrentAccount']) === FALSE)
		{
			$_POST['updateCurrentAccount'] = '';
		}

		if (isset($_GET['p']) === FALSE)
		{
			$_GET['p'] = '';
		}

		if ($_POST['updateCurrentAccount'] == 'update')
		{
			$this->setId($_POST['id'], TRUE);
			if (in_array('dateAdded', $arrayFields) === TRUE)
			{
				$this->setDateAdded($_POST['dateAdded'], FALSE);
			}
			if (in_array('amount', $arrayFields) === TRUE)
			{
				$this->setAmount($_POST['amount'], TRUE);
			}
			if (in_array('idSale', $arrayFields) === TRUE)
			{
				$this->setIdSale($_POST['idSale'], TRUE);
			}
			if (in_array('description', $arrayFields) === TRUE)
			{
				$this->setDescription($_POST['description'], TRUE);
			}
			if (in_array('typePay', $arrayFields) === TRUE)
			{
				$this->setTypePay($_POST['typePay'], TRUE);
			}
			if (in_array('typeMovement', $arrayFields) === TRUE)
			{
				$this->setTypeMovement($_POST['typeMovement'], TRUE);
			}
			if (in_array('idUserAdd', $arrayFields) === TRUE)
			{
				$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
			}
			if (in_array('type', $arrayFields) === TRUE)
			{
				$this->setType($_POST['type'], TRUE);
			}
			if (in_array('idProvider', $arrayFields) === TRUE)
			{
				$this->setIdProvider($_POST['idProvider'], TRUE);
			}
			if (in_array('discount', $arrayFields) === TRUE)
			{
				$this->setDiscount($_POST['discount'], TRUE);
			}
			
			if ($this->error() === FALSE)
			{
				$this->update();
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
					<div class="message success"><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CCURRENT_ACCOUNT_UPDATE_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
				<form name="formUpdateCurrentAccount" id="formUpdateCurrentAccount" method="post" action="">
				<input name="updateCurrentAccount" type="hidden" id="updateCurrentAccount" value="back" />
				<div class="fields">
				<?php
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					echo '<input name="dateAdded" type="hidden" id="dateAdded" value="'.$this->getDateAdded().'" />';
				}
				if (in_array('amount', $arrayFields) === TRUE)
				{
					echo '<input name="amount" type="hidden" id="amount" value="'.$this->getAmount().'" />';
				}
				if (in_array('idSale', $arrayFields) === TRUE)
				{
					echo '<input name="idSale" type="hidden" id="idSale" value="'.$this->getIdSale().'" />';
				}
				if (in_array('description', $arrayFields) === TRUE)
				{
					echo '<input name="description" type="hidden" id="description" value="'.$this->getDescription().'" />';
				}
				if (in_array('typePay', $arrayFields) === TRUE)
				{
					echo '<input name="typePay" type="hidden" id="typePay" value="'.$this->getTypePay().'" />';
				}
				if (in_array('typeMovement', $arrayFields) === TRUE)
				{
					echo '<input name="typeMovement" type="hidden" id="typeMovement" value="'.$this->getTypeMovement().'" />';
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					echo '<input name="idUserAdd" type="hidden" id="idUserAdd" value="'.$this->getIdUserAdd().'" />';
				}
				if (in_array('type', $arrayFields) === TRUE)
				{
					echo '<input name="type" type="hidden" id="type" value="'.$this->getType().'" />';
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';
				}
				if (in_array('discount', $arrayFields) === TRUE)
				{
					echo '<input name="discount" type="hidden" id="discount" value="'.$this->getDiscount().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CCURRENT_ACCOUNT_UPDATE_FORM_BACK_BTN; ?>" class="back" />
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
				if ($_POST['updateCurrentAccount'] == 'back')
				{
					if (in_array('dateAdded', $arrayFields) === TRUE)
					{
						$this->setDateAdded($_POST['dateAdded'], FALSE);
					}
					if (in_array('amount', $arrayFields) === TRUE)
					{
						$this->setAmount($_POST['amount'], TRUE);
					}
					if (in_array('idSale', $arrayFields) === TRUE)
					{
						$this->setIdSale($_POST['idSale'], TRUE);
					}
					if (in_array('description', $arrayFields) === TRUE)
					{
						$this->setDescription($_POST['description'], TRUE);
					}
					if (in_array('typePay', $arrayFields) === TRUE)
					{
						$this->setTypePay($_POST['typePay'], TRUE);
					}
					if (in_array('typeMovement', $arrayFields) === TRUE)
					{
						$this->setTypeMovement($_POST['typeMovement'], TRUE);
					}
					if (in_array('idUserAdd', $arrayFields) === TRUE)
					{
						$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
					}
					if (in_array('type', $arrayFields) === TRUE)
					{
						$this->setType($_POST['type'], TRUE);
					}
					if (in_array('idProvider', $arrayFields) === TRUE)
					{
						$this->setIdProvider($_POST['idProvider'], TRUE);
					}
					if (in_array('discount', $arrayFields) === TRUE)
					{
						$this->setDiscount($_POST['discount'], TRUE);
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
				<form name="formUpdateCurrentAccount" id="formUpdateCurrentAccount" method="post" action="">
				<input name="updateCurrentAccount" type="hidden" id="updateCurrentAccount" value="update" />
				<input name="id" type="hidden" id="id" value="<?php echo $this->getId(); ?>" />
				<div class="fields">
				<?php
				foreach ($arrayFields as $value)
				{
					if ($value == 'id')
					{
					?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
					<?php
					}
					if ($value == 'dateAdded')
					{
					?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_FIELD_DATE_ADDED; ?> <span>*</span></label>
						<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
					<?php
					}
					if ($value == 'amount')
					{
					?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_FIELD_AMOUNT; ?> <span>*</span></label>
						<input name="amount" type="text" id="amount" value="<?php echo $this->getAmount(); ?>" class="num" />
					</div>
					<?php
					}
					if ($value == 'idSale')
					{
					?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_FIELD_ID_SALE; ?></label>
						<?php
						$oIdSale = new Csale();
						$oIdSale->setDbConn($this->getDbConn());
						$oIdSale->showList('dateAdded', 'date_added', $this->getIdSale(), 'idSale', 'idSale', 'select');
						?>
					</div>
					<?php
					}
					if ($value == 'description')
					{
					?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_FIELD_DESCRIPTION; ?></label>
						<textarea name="description" id="description"><?php echo $this->getDescription(); ?></textarea>
					</div>
					<?php
					}
					if ($value == 'typePay')
					{
					?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_FIELD_TYPE_PAY; ?></label>
						<select name="typePay" id="typePay">
							<option value=""></option>
							<option value="cash" <?php if ($this->getTypePay() == 'cash') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cash'); ?></option>
							<option value="bank" <?php if ($this->getTypePay() == 'bank') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('bank'); ?></option>
							<option value="credit" <?php if ($this->getTypePay() == 'credit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('credit'); ?></option>
							<option value="debit" <?php if ($this->getTypePay() == 'debit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('debit'); ?></option>
							<option value="cta_cte" <?php if ($this->getTypePay() == 'cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cta_cte'); ?></option>
						</select>
					</div>
					<?php
					}
					if ($value == 'typeMovement')
					{
					?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_FIELD_TYPE_MOVEMENT; ?> <span>*</span></label>
						<select name="typeMovement" id="typeMovement">
							<option value=""></option>
							<option value="open_box" <?php if ($this->getTypeMovement() == 'open_box') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('open_box'); ?></option>
							<option value="close_box" <?php if ($this->getTypeMovement() == 'close_box') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('close_box'); ?></option>
							<option value="expenditure" <?php if ($this->getTypeMovement() == 'expenditure') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('expenditure'); ?></option>
							<option value="sale" <?php if ($this->getTypeMovement() == 'sale') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('sale'); ?></option>
							<option value="cta_cte_pay" <?php if ($this->getTypeMovement() == 'cta_cte_pay') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('cta_cte_pay'); ?></option>
							<option value="partner_take_off" <?php if ($this->getTypeMovement() == 'partner_take_off') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('partner_take_off'); ?></option>
						</select>
					</div>
					<?php
					}
					if ($value == 'idUserAdd')
					{
					?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_FIELD_ID_USER_ADD; ?></label>
						<?php
						$oIdUserAdd = new Cuser();
						$oIdUserAdd->setDbConn($this->getDbConn());
						$oIdUserAdd->showList('name', 'name', $this->getIdUserAdd(), 'idUserAdd', 'idUserAdd', 'select');
						?>
					</div>
					<?php
					}
					if ($value == 'type')
					{
					?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_FIELD_TYPE; ?> <span>*</span></label>
						<select name="type" id="type">
							<option value=""></option>
							<option value="in" <?php if ($this->getType() == 'in') echo 'selected="selected"' ?>><?php echo $this->getValuesType('in'); ?></option>
							<option value="out" <?php if ($this->getType() == 'out') echo 'selected="selected"' ?>><?php echo $this->getValuesType('out'); ?></option>
						</select>
					</div>
					<?php
					}
					if ($value == 'idProvider')
					{
					?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
						<?php
						$oIdProvider = new Cprovider();
						$oIdProvider->setDbConn($this->getDbConn());
						$oIdProvider->showList('name', 'name', $this->getIdProvider(), 'idProvider', 'idProvider', 'select');
						?>
					</div>
					<?php
					}
					if ($value == 'discount')
					{
					?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_FIELD_DISCOUNT; ?></label>
						<input name="discount" type="text" id="discount" value="<?php echo $this->getDiscount(); ?>" class="num" />
					</div>
					<?php
					}
				}
				?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CCURRENT_ACCOUNT_UPDATE_FORM_SUBMIT_BTN; ?>" class="accept" />
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CCURRENT_ACCOUNT_UPDATE_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="cancel" />
				<?php
				}
				?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CCURRENT_ACCOUNT_UPDATE_FORM_LABEL_REQUIRED; ?></span>
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
					<input type="button" value="<?php echo CCURRENT_ACCOUNT_UPDATE_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
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
	 * Elimina un registro existente de la tabla current_account y muestra el resultado obtenido
	 * 
	 * Este método intenta eliminar un registro de la tabla current_account y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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

		if ($this->canDelete() === TRUE)
		{
			$this->del();
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
					<div class="message success"><?php echo CCURRENT_ACCOUNT_DEL_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CCURRENT_ACCOUNT_DEL_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
					<input type="button" value="<?php echo CCURRENT_ACCOUNT_DEL_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
				</div>
		<?php
		}
		?>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Elimina un grupo de registros existente de la tabla current_account y muestra el resultado obtenido
	 * 
	 * Este método intenta eliminar un grupo de registros de la tabla current_account y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
					if ($this->canDelete() === TRUE)
					{
						if ($this->del() === FALSE)
						{
							$flagGroup = TRUE;
						}
					}
					else
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
			$this->addError(CCURRENT_ACCOUNT_DEL_GROUP_FORM_REQUIRED_PK);
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
					<div class="message success"><?php echo CCURRENT_ACCOUNT_DEL_GROUP_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CCURRENT_ACCOUNT_DEL_GROUP_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="success" />
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
				$this->addError(CCURRENT_ACCOUNT_DEL_GROUP_FORM_CANT_DELETE_ALL);
			}
			?>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="button" value="<?php echo CCURRENT_ACCOUNT_DEL_GROUP_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="back" />
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
			$fields = 'id,dateAdded,amount,idSale,description,typePay,typeMovement,idUserAdd,type,idProvider,discount';
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
						<label><?php echo CCURRENT_ACCOUNT_SHOW_DATA_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'dateAdded')
			{
			?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_SHOW_DATA_LABEL_FIELD_DATE_ADDED; ?></label>
						<strong><?php echo $this->getDateAdded(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'amount')
			{
			?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_SHOW_DATA_LABEL_FIELD_AMOUNT; ?></label>
						<strong><?php echo $this->getAmount(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idSale')
			{
			?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_SHOW_DATA_LABEL_FIELD_ID_SALE; ?></label>
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
			if ($value == 'description')
			{
			?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_SHOW_DATA_LABEL_FIELD_DESCRIPTION; ?></label>
						<strong><?php echo $this->getDescription(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'typePay')
			{
			?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_SHOW_DATA_LABEL_FIELD_TYPE_PAY; ?></label>
						<strong><?php echo $this->getValuesTypePay($this->getTypePay()); ?></strong>
					</div>
			<?php
			}
			if ($value == 'typeMovement')
			{
			?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_SHOW_DATA_LABEL_FIELD_TYPE_MOVEMENT; ?></label>
						<strong><?php echo $this->getValuesTypeMovement($this->getTypeMovement()); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idUserAdd')
			{
			?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_SHOW_DATA_LABEL_FIELD_ID_USER_ADD; ?></label>
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
			if ($value == 'type')
			{
			?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_SHOW_DATA_LABEL_FIELD_TYPE; ?></label>
						<strong><?php echo $this->getValuesType($this->getType()); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idProvider')
			{
			?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_SHOW_DATA_LABEL_FIELD_ID_PROVIDER; ?></label>
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
			if ($value == 'discount')
			{
			?>
					<div class="field">
						<label><?php echo CCURRENT_ACCOUNT_SHOW_DATA_LABEL_FIELD_DISCOUNT; ?></label>
						<strong><?php echo $this->getDiscount(); ?></strong>
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
					<input type="button" value="<?php echo CCURRENT_ACCOUNT_SHOW_DATA_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
		<?php
		}
		?>
				</div>
				<div class="bottom"></div>
			</div>
	<?php
	}

	/**
	 * Muestra un formulario de búsqueda de registros de la tabla current_account
	 * 
	 * Este método muestra un formulario con los campos seteados en el parámetro $fields para realizar una búsqueda de los registros de la tabla current_account.
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
			$fields = 'id,dateAdded,amount,idSale,description,typePay,typeMovement,idUserAdd,type,idProvider,discount';
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
			if (isset($_SESSION['main_tr_search_current_account']) === FALSE)
			{
				$_SESSION['main_tr_search_current_account'] = '';
			}

			$display  = 'display: none;';
			$btnClass = 'closed';
			if ($_SESSION['main_tr_search_current_account'] === 'open')
			{
				$display  = '';
				$btnClass = 'open';
			}
		}
		?>
				<div class="title">
					<div class="ico"><?php if ($showHideBtn === TRUE) { ?><a href="#" onclick="showHideSearch('current_account'); return false;" class="<?php echo $btnClass; ?>"></a><?php } ?></div>
					<div class="label"><a href="#" onclick="showHideSearch('current_account'); return false;"><?php echo $title; ?></a></div>
				</div>
				<div id="container_search_current_account" style="<?php echo $display; ?>">
					<div class="top"></div>
					<form name="formSearchCurrentAccount" id="formSearchCurrentAccount" method="<?php echo $method; ?>" action="">
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
							<label><?php echo CCURRENT_ACCOUNT_SEARCH_FORM_LABEL_FIELD_ID; ?></label>
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
							<label><?php echo CCURRENT_ACCOUNT_SEARCH_FORM_LABEL_FIELD_DATE_ADDED; ?></label>
							<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
						</div>
				<?php
				if (validateRequiredValue($this->getDateAdded()) === TRUE)
				{
					$condition[] = $this->getFieldSql('date_added', $this->getTableName()).' = '.$this->getValueSql($this->dateAdded);
					$params[] = 'dateAdded='.urlencode($this->getDateAdded());
				}
			}
			
			if ($value == 'amount')
			{
				$this->setAmount($values['amount'], TRUE);
				?>
						<div class="field">
							<label><?php echo CCURRENT_ACCOUNT_SEARCH_FORM_LABEL_FIELD_AMOUNT; ?></label>
							<input name="amount" type="text" id="amount" value="<?php echo $this->getAmount(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getAmount()) === TRUE)
				{
					$condition[] = $this->getFieldSql('amount', $this->getTableName()).' = '.$this->getValueSql($this->amount);
					$params[] = 'amount='.urlencode($this->amount);
				}
			}
			
			if ($value == 'idSale')
			{
				$this->setIdSale($values['idSale'], TRUE);
				?>
						<div class="field">
							<label><?php echo CCURRENT_ACCOUNT_SEARCH_FORM_LABEL_FIELD_ID_SALE; ?></label>
				<?php
				$oIdSale = new Csale();
				$oIdSale->setDbConn($this->getDbConn());
				$oIdSale->showList('dateAdded', 'date_added', $this->getIdSale(), 'idSale', 'idSale', 'select_search');
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdSale()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_sale', $this->getTableName()).' = '.$this->getValueSql($this->idSale);
					$params[] = 'idSale='.urlencode($this->idSale);
				}
			}
			
			if ($value == 'description')
			{
				$this->setDescription($values['description'], TRUE);
				?>
						<div class="field">
							<label><?php echo CCURRENT_ACCOUNT_SEARCH_FORM_LABEL_FIELD_DESCRIPTION; ?></label>
							<input name="description" type="text" id="description" value="<?php echo $this->getDescription(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getDescription()) === TRUE)
				{
					$condition[] = $this->getFieldSql('description', $this->getTableName()).' LIKE '.$this->getValueSql($this->description, '%%');
					$params[] = 'description='.urlencode($this->description);
				}
			}
			
			if ($value == 'typePay')
			{
				$this->setTypePay($values['typePay'], TRUE);
				?>
						<div class="field">
							<label><?php echo CCURRENT_ACCOUNT_SEARCH_FORM_LABEL_FIELD_TYPE_PAY; ?></label>
							<select name="typePay" id="typePay">
								<option value=""></option>
								<option value="cash" <?php if ($this->getTypePay() == 'cash') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cash'); ?></option>
								<option value="bank" <?php if ($this->getTypePay() == 'bank') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('bank'); ?></option>
								<option value="credit" <?php if ($this->getTypePay() == 'credit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('credit'); ?></option>
								<option value="debit" <?php if ($this->getTypePay() == 'debit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('debit'); ?></option>
								<option value="cta_cte" <?php if ($this->getTypePay() == 'cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cta_cte'); ?></option>
							</select>
						</div>
				<?php
				if (validateRequiredValue($this->getTypePay()) === TRUE)
				{
					$condition[] = $this->getFieldSql('type_pay', $this->getTableName()).' = '.$this->getValueSql($this->typePay);
					$params[] = 'typePay='.urlencode($this->typePay);
				}
			}
			
			if ($value == 'typeMovement')
			{
				$this->setTypeMovement($values['typeMovement'], TRUE);
				?>
						<div class="field">
							<label><?php echo CCURRENT_ACCOUNT_SEARCH_FORM_LABEL_FIELD_TYPE_MOVEMENT; ?></label>
							<select name="typeMovement" id="typeMovement">
								<option value=""></option>
								<option value="open_box" <?php if ($this->getTypeMovement() == 'open_box') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('open_box'); ?></option>
								<option value="close_box" <?php if ($this->getTypeMovement() == 'close_box') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('close_box'); ?></option>
								<option value="expenditure" <?php if ($this->getTypeMovement() == 'expenditure') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('expenditure'); ?></option>
								<option value="sale" <?php if ($this->getTypeMovement() == 'sale') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('sale'); ?></option>
								<option value="cta_cte_pay" <?php if ($this->getTypeMovement() == 'cta_cte_pay') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('cta_cte_pay'); ?></option>
								<option value="partner_take_off" <?php if ($this->getTypeMovement() == 'partner_take_off') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('partner_take_off'); ?></option>
							</select>
						</div>
				<?php
				if (validateRequiredValue($this->getTypeMovement()) === TRUE)
				{
					$condition[] = $this->getFieldSql('type_movement', $this->getTableName()).' = '.$this->getValueSql($this->typeMovement);
					$params[] = 'typeMovement='.urlencode($this->typeMovement);
				}
			}
			
			if ($value == 'idUserAdd')
			{
				$this->setIdUserAdd($values['idUserAdd'], TRUE);
				?>
						<div class="field">
							<label><?php echo CCURRENT_ACCOUNT_SEARCH_FORM_LABEL_FIELD_ID_USER_ADD; ?></label>
				<?php
				$oIdUserAdd = new Cuser();
				$oIdUserAdd->setDbConn($this->getDbConn());
				$oIdUserAdd->showList('name', 'name', $this->getIdUserAdd(), 'idUserAdd', 'idUserAdd', 'select_search');
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdUserAdd()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_user_add', $this->getTableName()).' = '.$this->getValueSql($this->idUserAdd);
					$params[] = 'idUserAdd='.urlencode($this->idUserAdd);
				}
			}
			
			if ($value == 'type')
			{
				$this->setType($values['type'], TRUE);
				?>
						<div class="field">
							<label><?php echo CCURRENT_ACCOUNT_SEARCH_FORM_LABEL_FIELD_TYPE; ?></label>
							<select name="type" id="type">
								<option value=""></option>
								<option value="in" <?php if ($this->getType() == 'in') echo 'selected="selected"' ?>><?php echo $this->getValuesType('in'); ?></option>
								<option value="out" <?php if ($this->getType() == 'out') echo 'selected="selected"' ?>><?php echo $this->getValuesType('out'); ?></option>
							</select>
						</div>
				<?php
				if (validateRequiredValue($this->getType()) === TRUE)
				{
					$condition[] = $this->getFieldSql('type', $this->getTableName()).' = '.$this->getValueSql($this->type);
					$params[] = 'type='.urlencode($this->type);
				}
			}
			
			if ($value == 'idProvider')
			{
				$this->setIdProvider($values['idProvider'], TRUE);
				?>
						<div class="field">
							<label><?php echo CCURRENT_ACCOUNT_SEARCH_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
				<?php
				$oIdProvider = new Cprovider();
				$oIdProvider->setDbConn($this->getDbConn());
				$oIdProvider->showList('name', 'name', $this->getIdProvider(), 'idProvider', 'idProvider', 'select_search');
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdProvider()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_provider', $this->getTableName()).' = '.$this->getValueSql($this->idProvider);
					$params[] = 'idProvider='.urlencode($this->idProvider);
				}
			}
			
			if ($value == 'discount')
			{
				$this->setDiscount($values['discount'], TRUE);
				?>
						<div class="field">
							<label><?php echo CCURRENT_ACCOUNT_SEARCH_FORM_LABEL_FIELD_DISCOUNT; ?></label>
							<input name="discount" type="text" id="discount" value="<?php echo $this->getDiscount(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getDiscount()) === TRUE)
				{
					$condition[] = $this->getFieldSql('discount', $this->getTableName()).' = '.$this->getValueSql($this->discount);
					$params[] = 'discount='.urlencode($this->discount);
				}
			}
		}
		?>
					</div>
					<div class="middle"></div>
					<div class="buttons">
						<input type="submit" value="<?php echo CCURRENT_ACCOUNT_SEARCH_FORM_SUBMIT_BTN; ?>" class="search" />
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
	 * Muestra el resultado de una consulta a la tabla current_account
	 * 
	 * Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla current_account. Muestra sólo los campos seteados en el parámetro $fields.
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
	 * Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST['currentAccountGroup'] (array)</b>
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
			$fields[2]['field'] = 'amount';
			$fields[3]['field'] = 'idSale';
			$fields[4]['field'] = 'description';
			$fields[5]['field'] = 'typePay';
			$fields[6]['field'] = 'typeMovement';
			$fields[7]['field'] = 'idUserAdd';
			$fields[8]['field'] = 'type';
			$fields[9]['field'] = 'idProvider';
			$fields[10]['field'] = 'discount';
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
			$arrayOrder = array('id', 'date_added', 'amount', 'id_sale', 'description', 'type_pay', 'type_movement', 'id_user_add', 'type', 'id_provider', 'discount');
			array_push($arrayOrder, 'sale_date_added', 'user_name', 'provider_name');
			
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

				$head.= '<div class="col" style="width: '.$arrayWidth['id'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></div>';
				$headers['id'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['dateAdded'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div></div>';
				$headers['dateAdded'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['amount'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_AMOUNT, $arrayStrLen['amount']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_AMOUNT).'</a></div></div>';
				$headers['amount'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_AMOUNT, $arrayStrLen['amount']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_AMOUNT).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['idSale'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_SALE, $arrayStrLen['idSale']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_SALE).'</a></div></div>';
				$headers['idSale'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_SALE, $arrayStrLen['idSale']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_SALE).'</a></div>';
			}
			
			if ($value == 'description')
			{
				if ($_GET['orderby'] == 'description')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=description&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=description&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=description&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['description'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION, $arrayStrLen['description']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION).'</a></div></div>';
				$headers['description'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION, $arrayStrLen['description']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION).'</a></div>';
			}
			
			if ($value == 'typePay')
			{
				if ($_GET['orderby'] == 'type_pay')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=type_pay&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=type_pay&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=type_pay&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['typePay'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE_PAY, $arrayStrLen['typePay']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE_PAY).'</a></div></div>';
				$headers['typePay'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE_PAY, $arrayStrLen['typePay']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE_PAY).'</a></div>';
			}
			
			if ($value == 'typeMovement')
			{
				if ($_GET['orderby'] == 'type_movement')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=type_movement&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=type_movement&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=type_movement&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['typeMovement'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE_MOVEMENT, $arrayStrLen['typeMovement']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE_MOVEMENT).'</a></div></div>';
				$headers['typeMovement'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE_MOVEMENT, $arrayStrLen['typeMovement']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE_MOVEMENT).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['idUserAdd'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div></div>';
				$headers['idUserAdd'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['type'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE, $arrayStrLen['type']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE).'</a></div></div>';
				$headers['type'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE, $arrayStrLen['type']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_TYPE).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['idProvider'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div></div>';
				$headers['idProvider'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['discount'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DISCOUNT, $arrayStrLen['discount']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DISCOUNT).'</a></div></div>';
				$headers['discount'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DISCOUNT, $arrayStrLen['discount']), CCURRENT_ACCOUNT_SHOW_QUERY_HEAD_FIELD_DISCOUNT).'</a></div>';
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
				<form name="formQueryCurrentAccount" id="formQueryCurrentAccount" method="post" action="">
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
				<div class="message warning"><?php echo CCURRENT_ACCOUNT_SHOW_QUERY_NOT_FOUND; ?></div>
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
					<div class="row row<?php echo $class; ?>" id="current_account_tr_<?php echo $row['id']; ?>" data-table-name="current_account" data-id="<?php echo $row['id']; ?>" data-form-id="formQueryCurrentAccount">
				<?php
				if (is_array($groupActions) === TRUE)
				{
				?>
						<div class="col header"></div>
						<div class="col" style="width: <?php echo $widthGroupActions; ?>;"><div class="group-actions"><input name="currentAccountGroup[]" type="checkbox" id="cb_current_account_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="checkboxClick(this)" /></div></div>
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
					
					if ($value == 'amount')
					{
					?>
						<div class="col header"><?php echo $headers['amount']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['amount']; ?>;"><div class="num"><?php echo altText(getCutString($row['amount'], $arrayStrLen['amount']), $row['amount']); ?></div></div>
					<?php
					}
					
					if ($value == 'idSale')
					{
					?>
						<div class="col header"><?php echo $headers['idSale']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idSale']; ?>;"><div class="date"><?php echo altText(getCutString($row['saleDateAdded'], $arrayStrLen['idSale']), $row['saleDateAdded']); ?></div></div>
					<?php
					}
					
					if ($value == 'description')
					{
					?>
						<div class="col header"><?php echo $headers['description']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['description']; ?>;"><div class="str"><?php echo altText(getCutString($row['description'], $arrayStrLen['description']), $row['description']); ?></div></div>
					<?php
					}
					
					if ($value == 'typePay')
					{
					?>
						<div class="col header"><?php echo $headers['typePay']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['typePay']; ?>;"><div class="str"><?php echo altText(getCutString($this->getValuesTypePay($row['typePay']), $arrayStrLen['typePay']), $this->getValuesTypePay($row['typePay'])); ?></div></div>
					<?php
					}
					
					if ($value == 'typeMovement')
					{
					?>
						<div class="col header"><?php echo $headers['typeMovement']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['typeMovement']; ?>;"><div class="str"><?php echo altText(getCutString($this->getValuesTypeMovement($row['typeMovement']), $arrayStrLen['typeMovement']), $this->getValuesTypeMovement($row['typeMovement'])); ?></div></div>
					<?php
					}
					
					if ($value == 'idUserAdd')
					{
					?>
						<div class="col header"><?php echo $headers['idUserAdd']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idUserAdd']; ?>;"><div class="str"><?php echo altText(getCutString($row['userName'], $arrayStrLen['idUserAdd']), $row['userName']); ?></div></div>
					<?php
					}
					
					if ($value == 'type')
					{
					?>
						<div class="col header"><?php echo $headers['type']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['type']; ?>;"><div class="str"><?php echo altText(getCutString($this->getValuesType($row['type']), $arrayStrLen['type']), $this->getValuesType($row['type'])); ?></div></div>
					<?php
					}
					
					if ($value == 'idProvider')
					{
					?>
						<div class="col header"><?php echo $headers['idProvider']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idProvider']; ?>;"><div class="str"><?php echo altText(getCutString($row['providerName'], $arrayStrLen['idProvider']), $row['providerName']); ?></div></div>
					<?php
					}
					
					if ($value == 'discount')
					{
					?>
						<div class="col header"><?php echo $headers['discount']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['discount']; ?>;"><div class="num"><?php echo altText(getCutString($row['discount'], $arrayStrLen['discount']), $row['discount']); ?></div></div>
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
						<input name="current_account_select_all" type="checkbox" id="current_account_select_all" value="" class="checkbox_show_query" onclick="querySelectAll('current_account', 'formQueryCurrentAccount')" />
						<span><?php echo CCURRENT_ACCOUNT_SHOW_QUERY_SELECT_ALL; ?></span>
					</div>
			<?php
			$j = 1;
			foreach ($groupActions as $value)
			{
				if ($value['confirm'] === TRUE)
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryCurrentAccount\', \''.$value['file'].'\', \''.$actionsParams.'\', true, \''.$value['msg'].'\');"';
				}
				else
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryCurrentAccount\', \''.$value['file'].'\', \''.$actionsParams.'\', false, \'\');"';
				}

				if ($value['button'] === TRUE)
				{
					echo '<input type="button" name="current_account_ga_'.$j.'" id="current_account_ga_'.$j.'" value="'.$value['text'].'" class="'.$value['class'].'" '.$onclick.' />';
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
	 * Muestra un listado de la tabla current_account en un campo select
	 * 
	 * @param string $field campo que se muestra en el select
	 * @param string $order [opcional] campo por el cual se ordena el listado
	 * @param string $value [opcional] valor seleccionado
	 * @param string $name [opcional] atributo name del campo select
	 * @param string $id [opcional] atributo id del campo select
	 * @param string $class [opcional] atributo class del campo select
	 * @return string
	 * @access public
	 */
	public function showList($field, $order = '', $value = '', $name = '', $id = '', $class = '')
	{
		$list = $this->getList('', 0, 0, $this->getFieldSql($order));
		?>
		<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="<?php echo $class; ?>">
			<option value=""></option>
		<?php
		foreach ($list as $row)
		{
		?>
			<option value="<?php echo $row['id']; ?>"<?php if ($value == $row['id']) echo ' selected="selected"'; ?>><?php echo $row[$field]; ?></option>
		<?php
		}
		?>
		</select>
		<?php
	}

}
?>