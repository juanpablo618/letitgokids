<?php
/**
 * Archivo php creado por O-creator
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla movement
 *
 * Esta clase se encarga de la administración de la tabla movement brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Cmovement.php');
 * $movement = new Cmovement();
 * $movement->setDbConn($dbConn);
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:14-10-2019
 */
class Cmovement extends Cbase
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
	 * Venta
	 *
	 * - Campo en la base de datos: id_sale
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
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
	 * Tipo
	 *
	 * - Campo en la base de datos: type_pay
	 * - Tipo de campo en la base de datos: enum('cash','bank','credit','debit','cta_cte','mercado_pago')
	 * - Campo requerido
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
	 * - Tipo de campo en la base de datos: enum('box_in','box_out','expenditure','sale','cta_cte_pay','partner_take_off','payment_to_provider','investment','add_cta_cte','del_cta_cte')
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
	 * Ingreso/Egreso
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
	 * Proveedor
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
	 * Descuento (+) / Recargo (-)
	 *
	 * - Campo en la base de datos: discount
	 * - Tipo de campo en la base de datos: decimal(10,2)
	 * - Extra: Decimal, positivo y negativo (se incluye el cero) [-,+] (ver {@link validateDecimalValue()})
	 * - Número de decimales: 2
	 *
	 * Ver también: {@link getDiscount()}, {@link setDiscount()}
	 * @var float
	 * @access private
	 */
	private $discount;

	/**
	 * Rendición
	 *
	 * - Clave Foránea
	 * - Campo en la base de datos: id_payment
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * <b>Relación</b>
	 * Este campo es clave foránea a:
	 * - Tabla: {@link Cpayment payment}
	 * - Campo: {@link Cpayment::$id id}
	 * - Campo que se muestra: {@link Cpayment::$dateAdded dateAdded}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * Ver también: {@link getIdPayment()}, {@link setIdPayment()}
	 * @var integer
	 * @access private
	 */
	private $idPayment;

	/**
	 * Devolución
	 *
	 * - Clave Foránea
	 * - Campo en la base de datos: id_refund
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * <b>Relación</b>
	 * Este campo es clave foránea a:
	 * - Tabla: {@link Crefund refund}
	 * - Campo: {@link Crefund::$id id}
	 * - Campo que se muestra: {@link Crefund::$dateAdded dateAdded}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * Ver también: {@link getIdRefund()}, {@link setIdRefund()}
	 * @var integer
	 * @access private
	 */
	private $idRefund;

	/**
	 * Extra param
	 *
	 * Parámetro extra que necesito pasar
	 */
	public $extraParam;

	/**
	 * Constructor de la clase
	 *
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('movement');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cmovement.php');
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
			$this->addError(CMOVEMENT_SETID_REQUIRED_VALUE);

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
				$this->addError(CMOVEMENT_SETID_VALIDATE_VALUE);

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
	 * $movement = new Cmovement();
	 * //seteo en el formato que acepta la base de datos (yyyy-mm-dd)
	 * $movement->setDateAdded('1980-11-24', TRUE);
	 * //seteo en el formato definido en la configuración del script (suponemos que el formato utilizado es dd-mm-yyyy)
	 * $movement->setDateAdded('24-11-1980', FALSE);
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
			$this->addError(CMOVEMENT_SETDATE_ADDED_REQUIRED_VALUE);

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
					$this->addError(CMOVEMENT_SETDATE_ADDED_VALIDATE_VALUE);

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
					$this->addError(CMOVEMENT_SETDATE_ADDED_VALIDATE_VALUE);

					return FALSE;
				}
			}
			else
			{
				$this->dateAdded = '';
				$this->addError(CMOVEMENT_SETDATE_ADDED_ERROR);

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
			$this->addError(CMOVEMENT_SETAMOUNT_REQUIRED_VALUE);

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
				$this->addError(CMOVEMENT_SETAMOUNT_VALIDATE_VALUE);

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
			$this->addError(CMOVEMENT_SETID_CLIENT_VALIDATE_VALUE);

				return FALSE;
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
			$this->addError(CMOVEMENT_SETID_SALE_VALIDATE_VALUE);

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
	 * Setea el valor {@link $typePay Tipo}
	 *
	 * @param string $typePay indica el valor Tipo
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setTypePay($typePay, $gpc = FALSE)
	{
		if (validateRequiredValue($typePay) === FALSE)
		{
			$this->typePay = $typePay;
			$this->addError(CMOVEMENT_SETTYPE_PAY_REQUIRED_VALUE);
			return FALSE;
		}
		else
		{
		$this->typePay = setValue($typePay, $gpc);

		return TRUE;
		}
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
			$this->addError(CMOVEMENT_SETTYPE_MOVEMENT_REQUIRED_VALUE);
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
			$this->addError(CMOVEMENT_SETID_USER_ADD_VALIDATE_VALUE);

			return FALSE;
		}
	}

	/**
	 * Setea el valor {@link $type Ingreso/Egreso}
	 *
	 * @param string $type indica el valor Ingreso/Egreso
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setType($type, $gpc = FALSE)
	{
		if (validateRequiredValue($type) === FALSE)
		{
			$this->type = $type;
			$this->addError(CMOVEMENT_SETTYPE_REQUIRED_VALUE);
			return FALSE;
		}
		else
		{
		$this->type = setValue($type, $gpc);

		return TRUE;
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
		    $this->addError(CMOVEMENT_SETID_PROVIDER_VALIDATE_VALUE);

		    return FALSE;
		}
	}
	/**
	 * Setea el valor {@link $discount Descuento (+) / Recargo (-)}
	 *
	 * @param float $discount indica el valor Descuento (+) / Recargo (-)
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setDiscount($discount, $gpc = FALSE)
	{
		$this->discount = setValue($discount, $gpc);
		if (validateDecimalValue($this->discount, '-+') === TRUE)
		{
			if (validateRequiredValue($discount) === TRUE)
			{
				$this->discount = numberFormat($discount, 2);
			}
			return TRUE;
		}
		else
		{
			$this->addError(CMOVEMENT_SETDISCOUNT_VALIDATE_VALUE);

				return FALSE;
		}
	}

	/**
	 * Setea el valor {@link $idPayment Rendición}
	 *
	 * @param integer $idPayment indica el valor Rendición
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdPayment($idPayment, $gpc = FALSE)
	{
		if ($idPayment == '0')
		{
			$idPayment = '';
		}
		$this->idPayment = setValue($idPayment, $gpc);
		if (validateIntValue($this->idPayment, '+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CMOVEMENT_SETID_PAYMENT_VALIDATE_VALUE);
			return FALSE;
		}
	}
	/**
	 * Setea el valor {@link $idRefund Devolución}
	 *
	 * @param integer $idRefund indica el valor Devolución
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdRefund($idRefund, $gpc = FALSE)
	{
		if ($idRefund == '0')
		{
			$idRefund = '';
		}
		$this->idRefund = setValue($idRefund, $gpc);
		if (validateIntValue($this->idRefund, '+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CMOVEMENT_SETID_REFUND_VALIDATE_VALUE);
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
	 * $movement = new Cmovement();
	 * $movement->setDateAdded('1980-11-24', TRUE);
	 * echo 'Fecha en formato del script: ';
	 * echo $movement->getDateAdded().'<br />';
	 * echo 'Fecha en el formato que acepta la base de datos: ';
	 * echo $movement->getDateAdded(TRUE).'<br />';
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
	 * Devuelve el valor {@link $typePay Tipo}
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
	 * Devuelve la descripción de los valores de {@link $typePay Tipo}
	 *
	 * @param string $typePay indica el valor Tipo
	 * @return string
	 * @access public
	 */
	public function getValuesTypePay($typePay)
	{
		switch ($typePay)
		{
			case 'cash':
				return CMOVEMENT_GET_VALUES_TYPE_PAY_VALUE_1;
				break;

			case 'bank':
				return CMOVEMENT_GET_VALUES_TYPE_PAY_VALUE_2;
				break;

			case 'credit':
				return CMOVEMENT_GET_VALUES_TYPE_PAY_VALUE_3;
				break;

			case 'debit':
				return CMOVEMENT_GET_VALUES_TYPE_PAY_VALUE_4;
				break;

			case 'cta_cte':
				return CMOVEMENT_GET_VALUES_TYPE_PAY_VALUE_5;
				break;

			case 'mercado_pago':
				return CMOVEMENT_GET_VALUES_TYPE_PAY_VALUE_6;
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
			case 'box_in':
				return CMOVEMENT_GET_VALUES_TYPE_MOVEMENT_VALUE_1;
				break;

			case 'box_out':
				return CMOVEMENT_GET_VALUES_TYPE_MOVEMENT_VALUE_2;
				break;

			case 'expenditure':
				return CMOVEMENT_GET_VALUES_TYPE_MOVEMENT_VALUE_3;
				break;

			case 'sale':
				return CMOVEMENT_GET_VALUES_TYPE_MOVEMENT_VALUE_4;
				break;

			case 'cta_cte_pay':
				return CMOVEMENT_GET_VALUES_TYPE_MOVEMENT_VALUE_5;
				break;

			case 'partner_take_off':
				return CMOVEMENT_GET_VALUES_TYPE_MOVEMENT_VALUE_6;
				break;

			case 'payment_to_provider':
				return CMOVEMENT_GET_VALUES_TYPE_MOVEMENT_VALUE_7;
				break;
			case 'investment':
				return CMOVEMENT_GET_VALUES_TYPE_MOVEMENT_VALUE_8;
				break;
			case 'add_cta_cte':
				return CMOVEMENT_GET_VALUES_TYPE_MOVEMENT_VALUE_9;
				break;
			case 'del_cta_cte':
				return CMOVEMENT_GET_VALUES_TYPE_MOVEMENT_VALUE_10;
				break;
			default:
				return '&nbsp;';
		}
	}

	/**
	 * Sobreescribo el método del Cbase
	 */
	public function getParams()
	{
	    $res = parent::getParams();

	    if(empty($this->extraParam) == FALSE)
	    {
		$res .= str_replace('idProvider', 'id', $this->extraParam);
	    }

	    return $res;
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
	 * Devuelve el valor {@link $type Ingreso/Egreso}
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
	 * Devuelve la descripción de los valores de {@link $type Ingreso/Egreso}
	 *
	 * @param string $type indica el valor Ingreso/Egreso
	 * @return string
	 * @access public
	 */
	public function getValuesType($type)
	{
		switch ($type)
		{
			case 'in':
				return CMOVEMENT_GET_VALUES_TYPE_VALUE_1;
				break;

			case 'out':
				return CMOVEMENT_GET_VALUES_TYPE_VALUE_2;
				break;

			default:
				return '&nbsp;';
		}
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
	 * Devuelve el valor {@link $discount Descuento (+) / Recargo (-)}
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
	 * Devuelve el valor {@link $idPayment Rendición}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdPayment($htmlEntities = TRUE)
	{
		return getValue($this->idPayment, $htmlEntities, $this->getCharset());
	}
	/**
	 * Devuelve el valor {@link $idRefund Devolución}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdRefund($htmlEntities = TRUE)
	{
		return getValue($this->idRefund, $htmlEntities, $this->getCharset());
	}
	/**
	 * Inserta un nuevo registro en la tabla movement
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

		if (isset($this->idSale) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_sale');

			if (validateRequiredValue($this->idSale) === FALSE)
			{
				$values[] = $this->getValueSql(0);
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
		if (isset($this->idPayment) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_payment');
			if (validateRequiredValue($this->idPayment) === FALSE)
			{
				$values[] = 'NULL';
			}
			else
			{
				$values[] = $this->getValueSql($this->idPayment);
			}
		}
		if (isset($this->idRefund) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_refund');
			if (validateRequiredValue($this->idRefund) === FALSE)
			{
				$values[] = 'NULL';
			}
			else
			{
				$values[] = $this->getValueSql($this->idRefund);
			}
		}
		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CMOVEMENT_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla movement
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

			if (isset($this->idSale) === TRUE)
			{
				if (validateRequiredValue($this->idSale) === FALSE)
				{
					$values[] = $this->getFieldSql('id_sale').' = '.$this->getValueSql(0);
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
			if (isset($this->idPayment) === TRUE)
			{
				if (validateRequiredValue($this->idPayment) === FALSE)
				{
					$values[] = $this->getFieldSql('id_payment').' = NULL';
				}
				else
				{
					$values[] = $this->getFieldSql('id_payment').' = '.$this->getValueSql($this->idPayment);
				}
			}
			if (isset($this->idRefund) === TRUE)
			{
				if (validateRequiredValue($this->idRefund) === FALSE)
				{
					$values[] = $this->getFieldSql('id_refund').' = NULL';
				}
				else
				{
					$values[] = $this->getFieldSql('id_refund').' = '.$this->getValueSql($this->idRefund);
				}
			}
			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CMOVEMENT_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CMOVEMENT_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla movement
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
				$this->addError(CMOVEMENT_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CMOVEMENT_DEL_REQUIRED_PK);

			return FALSE;
		}
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
	public function delSaleMovement()
	{
		if (validateRequiredValue($this->idSale) === TRUE)
		{
			$sql = 'DELETE FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_sale').' = '.$this->getValueSql($this->idSale);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CMOVEMENT_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CMOVEMENT_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina los registros de la tabla movement que están relacionados con un refund
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"DELETE FROM `tabla` WHERE id_refund = '1'"</b>.
	 * Para poder eliminar el registro debe estar seteada la clave primaria del refund. Devuelve TRUE si se pudo eliminar el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link delForm()}
	 * @return boolean
	 * @access public
	 */
	public function delRefundMovement()
	{
	    if (validateRequiredValue($this->idRefund) === TRUE)
	    {
	        $sql = 'DELETE FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_refund').' = '.$this->getValueSql($this->idRefund);

	        if ($this->getDbConn()->Execute($sql) === FALSE)
	        {
	            $this->addError(CMOVEMENT_DEL_ERROR);

	            return FALSE;
	        }
	        else
	        {
	            return TRUE;
	        }
	    }
	    else
	    {
	        $this->addError(CMOVEMENT_DEL_REQUIRED_PK);

	        return FALSE;
	    }
	}

	/**
	 * Elimina los registros de la tabla movement que están relacionados con un payment
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"DELETE FROM `tabla` WHERE id_payment = '1'"</b>.
	 * Para poder eliminar el registro debe estar seteada la clave primaria del payment. Devuelve TRUE si se pudo eliminar el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link delForm()}
	 * @return boolean
	 * @access public
	 */
	public function delPaymentMovement()
	{
	    if (validateRequiredValue($this->idPayment) === TRUE)
	    {
	        $sql = 'DELETE FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_payment').' = '.$this->getValueSql($this->idPayment);

	        if ($this->getDbConn()->Execute($sql) === FALSE)
	        {
	            $this->addError(CMOVEMENT_DEL_ERROR);

	            return FALSE;
	        }
	        else
	        {
	            return TRUE;
	        }
	    }
	    else
	    {
	        $this->addError(CMOVEMENT_DEL_REQUIRED_PK);

	        return FALSE;
	    }
	}

	/**
	 * Obtiene un registro de la tabla movement
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
				$this->setIdClient($row['id_client']);
				$this->setIdSale($row['id_sale']);
				$this->setDescription($row['description']);
				$this->setTypePay($row['type_pay']);
				$this->setTypeMovement($row['type_movement']);
				$this->setIdUserAdd($row['id_user_add']);
				$this->setType($row['type']);
				$this->setIdProvider($row['id_provider']);
				$this->setDiscount($row['discount']);
				$this->setIdPayment($row['id_payment']);
				$this->setIdRefund($row['id_refund']);
				return TRUE;
			}
			else
			{
				$this->addError(CMOVEMENT_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CMOVEMENT_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}
	public function getDataByIdPayment()
	{
	    if (validateRequiredValue($this->idPayment) === TRUE)
	    {
	        $sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_payment').' = '.$this->getValueSql($this->idPayment);

	        $row = $this->getDbConn()->GetRow($sql);

	        if (is_array($row) === TRUE and count($row) > 0)
	        {
	            $this->setId($row['id']);
	            $this->setDateAdded($row['date_added'], TRUE);
	            $this->setAmount($row['amount']);
	            $this->setIdClient($row['id_client']);
	            $this->setIdSale($row['id_sale']);
	            $this->setDescription($row['description']);
	            $this->setTypePay($row['type_pay']);
	            $this->setTypeMovement($row['type_movement']);
	            $this->setIdUserAdd($row['id_user_add']);
	            $this->setType($row['type']);
	            $this->setIdProvider($row['id_provider']);
	            $this->setDiscount($row['discount']);
	            $this->setIdPayment($row['id_payment']);
		        $this->setIdRefund($row['id_refund']);

	            return TRUE;
	        }
	        else
	        {
	            $this->addError(CMOVEMENT_GETDATA_ERROR);

	            return FALSE;
	        }
	    }
	    else
	    {
	        $this->addError(CMOVEMENT_GETDATA_REQUIRED_PK);

	        return FALSE;
	    }
	}

	/**
	 * Obtiene un conjunto de registros de la tabla movement
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
		$oIdClient = new Cprovider();
		$oIdClient->setDbConn($this->getDbConn());

		$oIdUserAdd = new Cuser();
		$oIdUserAdd->setDbConn($this->getDbConn());

		$oIdProvider = new Cprovider();
		$oIdProvider->setDbConn($this->getDbConn());

		$oIdPayment = new Cpayment();
		$oIdPayment->setDbConn($this->getDbConn());
		$oIdRefund = new Crefund();
		$oIdRefund->setDbConn($this->getDbConn());
		$sql = 'SELECT ';
		$sql.= $this->getFieldSql('id', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('date_added', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('amount', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_client', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_sale', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('description', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('type_pay', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('type_movement', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_user_add', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('type', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_provider', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('discount', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_payment', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_refund', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id', 'client', 'client_id');
		$sql.= ', '.$this->getFieldSql('name', 'client', 'client_name');
		$sql.= ', '.$this->getFieldSql('email', 'client', 'client_email');
		$sql.= ', '.$this->getFieldSql('phone', 'client', 'client_phone');
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
		$sql.= ', '.$this->getFieldSql('id', $oIdPayment->getTableName(), 'payment_id');
		$sql.= ', '.$this->getFieldSql('date_added', $oIdPayment->getTableName(), 'payment_date_added');
		$sql.= ', '.$this->getFieldSql('total_amount_back', $oIdPayment->getTableName(), 'payment_total_amount_back');
		$sql.= ', '.$this->getFieldSql('total_amount_pay', $oIdPayment->getTableName(), 'payment_total_amount_pay');
		$sql.= ', '.$this->getFieldSql('id_user_add', $oIdPayment->getTableName(), 'payment_id_user_add');
		$sql.= ', '.$this->getFieldSql('id_provider', $oIdPayment->getTableName(), 'payment_id_provider');
		$sql.= ', '.$this->getFieldSql('id', $oIdRefund->getTableName(), 'refund_id');
		$sql.= ', '.$this->getFieldSql('date_added', $oIdRefund->getTableName(), 'refund_date_added');
		$sql.= ', '.$this->getFieldSql('id_user_add', $oIdRefund->getTableName(), 'refund_id_user_add');
		$sql.= ', '.$this->getFieldSql('id_sale', $oIdRefund->getTableName(), 'refund_id_sale');
		$sql.= ', '.$this->getFieldSql('reason', $oIdRefund->getTableName(), 'refund_reason');
		$sql.= ', '.$this->getFieldSql('detail', $oIdRefund->getTableName(), 'refund_detail');
		$sql.= ', '.$this->getFieldSql('type', $oIdRefund->getTableName(), 'refund_type');
		$sql.= ', ('.$this->getFieldSql('amount', $this->getTableName()).' - (('.$this->getFieldSql('amount', $this->getTableName()).' * '.$this->getFieldSql('discount', $this->getTableName()).') / 100)) AS realAmount';
		$sql.= ' FROM '.$this->getTableSql();
		$sql.= ' LEFT JOIN '.$oIdClient->getTableSql().' AS '.$this->getDbConn()->nameQuote.'client'.$this->getDbConn()->nameQuote.' ON '.$this->getFieldSql('id_client', $this->getTableName()).' = '.$oIdClient->getFieldSql('id', 'client');
		$sql.= ' LEFT JOIN '.$oIdUserAdd->getTableSql().' ON '.$this->getFieldSql('id_user_add', $this->getTableName()).' = '.$oIdUserAdd->getFieldSql('id', $oIdUserAdd->getTableName());
		$sql.= ' LEFT JOIN '.$oIdProvider->getTableSql().' ON '.$this->getFieldSql('id_provider', $this->getTableName()).' = '.$oIdProvider->getFieldSql('id', $oIdProvider->getTableName());
		$sql.= ' LEFT JOIN '.$oIdPayment->getTableSql().' ON '.$this->getFieldSql('id_payment', $this->getTableName()).' = '.$oIdPayment->getFieldSql('id', $oIdPayment->getTableName());
		$sql.= ' LEFT JOIN '.$oIdRefund->getTableSql().' ON '.$this->getFieldSql('id_refund', $this->getTableName()).' = '.$oIdRefund->getFieldSql('id', $oIdRefund->getTableName());
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
				$this->addError(CMOVEMENT_GETLIST_ERROR);

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
					$this->setIdClient($rs->fields['id_client']);
					$this->setIdSale($rs->fields['id_sale']);
					$this->setDescription($rs->fields['description']);
					$this->setTypePay($rs->fields['type_pay']);
					$this->setTypeMovement($rs->fields['type_movement']);
					$this->setIdUserAdd($rs->fields['id_user_add']);
					$this->setType($rs->fields['type']);
					$this->setIdProvider($rs->fields['id_provider']);
					$this->setDiscount($rs->fields['discount']);
					$this->setIdPayment($rs->fields['id_payment']);
					$this->setIdRefund($rs->fields['id_refund']);

					$oIdClient->setName($rs->fields['provider_name']);
					$oIdUserAdd->setName($rs->fields['user_name']);
					$oIdProvider->setName($rs->fields['provider_name']);
					$oIdPayment->setDateAdded($rs->fields['payment_date_added'], TRUE);
					$oIdRefund->setDateAdded($rs->fields['refund_date_added'], TRUE);

					$list[] = array(
						'id'		=> $this->getId($htmlEntities) ,
						'dateAdded'	=> $this->getDateAdded() ,
						'amount'	=> $this->getAmount($htmlEntities) ,
						'idClient'	=> $this->getIdClient($htmlEntities) ,
						'idSale'	=> $this->getIdSale($htmlEntities) ,
						'description'	=> $this->getDescription($htmlEntities) ,
						'typePay'	=> $this->getTypePay($htmlEntities) ,
						'typeMovement'	=> $this->getTypeMovement($htmlEntities) ,
						'idUserAdd'	=> $this->getIdUserAdd($htmlEntities) ,
						'type'		=> $this->getType($htmlEntities) ,
						'idProvider'	=> $this->getIdProvider($htmlEntities) ,
						'discount'	=> $this->getDiscount($htmlEntities) ,
						'idPayment' => $this->getIdPayment($htmlEntities) ,
						'idRefund' => $this->getIdRefund($htmlEntities) ,
						'clientName'	=> $oIdClient->getName($htmlEntities) ,
						'userName'	=> $oIdUserAdd->getName($htmlEntities) ,
						'providerName' => $oIdProvider->getName($htmlEntities) ,
						'paymentDateAdded' => $oIdPayment->getDateAdded() ,
						'refundDateAdded' => $oIdRefund->getDateAdded(),
					    'realAmount' => numberFormat($rs->fields['realAmount'])
					);

					$rs->MoveNext();
				}

				$this->id	          = NULL;
				$this->dateAdded      = NULL;
				$this->amount	      = NULL;
				$this->idClient	      = NULL;
				$this->idSale	      = NULL;
				$this->description    = NULL;
				$this->typePay	      = NULL;
				$this->typeMovement   = NULL;
				$this->idUserAdd      = NULL;
				$this->type	          = NULL;
				$this->idProvider     = NULL;
				$this->discount	      = NULL;
				$this->idPayment      = NULL;
				$this->idRefund       = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CMOVEMENT_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}

	/**
	 * Devuelve el último valor ID insertado en la tabla movement
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
			$this->addError(CMOVEMENT_GET_LAST_ID_ERROR);

			return FALSE;
		}
		else
		{
			return $row['id'];
		}
	}

	/**
	 * Muestra un formulario para dar de alta un registro de la tabla movement
	 *
	 * Este método muestra un formulario para dar de alta un registro de la tabla movement mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,dateAdded,amount,idClient,idSale,description,typePay,typeMovement,idUserAdd,type,idProvider,discount,idPayment,idRefund';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['addMovement']) === FALSE)
		{
			$_POST['addMovement'] = '';
		}

		if ($_POST['addMovement'] == 'add')
		{
			if (in_array('dateAdded', $arrayFields) === TRUE)
			{
				$this->setDateAdded($_POST['dateAdded'], FALSE);
			}
			if (in_array('amount', $arrayFields) === TRUE)
			{
				$this->setAmount($_POST['amount'], TRUE);
			}
			if (in_array('idClient', $arrayFields) === TRUE)
			{
				$this->setIdClient($_POST['idClient'], TRUE);
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
			$this->setIdUserAdd($_SESSION['userId'], TRUE);
			if (in_array('type', $arrayFields) === TRUE)
			{
			    $this->autoSetType();
			}
			if (in_array('idProvider', $arrayFields) === TRUE)
			{
				$this->setIdProvider($_POST['idProvider'], TRUE);
			}
			if (in_array('discount', $arrayFields) === TRUE)
			{
				$this->setDiscount($_POST['discount'], TRUE);
			}
			if (in_array('idPayment', $arrayFields) === TRUE)
			{
				$this->setIdPayment($_POST['idPayment'], TRUE);
			}
			if (in_array('idRefund', $arrayFields) === TRUE)
			{
				$this->setIdRefund($_POST['idRefund'], TRUE);
			}

			//Validaciones extras
			if($this->getType() == 'in' and empty($this->getTypePay()) == TRUE)
			{
			    $this->addError(CMOVEMENT_ADD_FORM_IN_MUST_SET_TYPE_PAY);
			}

			//'box_in','box_out','expenditure','sale','','partner_take_off','payment_to_provider','investment','',''
			//Si es cta cte solo puede ser un movimiento "Pago a Proveedor", "Agrega a Cta. Cte." o "Restar a Cta. Cte."
			if($this->getTypePay(FALSE) == 'cta_cte' and $this->getTypeMovement(FALSE) != 'payment_to_provider' and $this->getTypeMovement(FALSE) != 'add_cta_cte' and $this->getTypeMovement(FALSE) != 'del_cta_cte')
			{
			    $this->addError(CMOVEMENT_ADD_FORM_CTA_CTE_MUST_BE);
			}

			//Si elije cta cte debe elegir un proveedor
			if($this->getTypeMovement(FALSE) == 'payment_to_provider' and empty($this->getIdProvider(FALSE)) == TRUE)
			{
			    $this->addError(CMOVEMENT_ADD_FORM_PAYMMENT_TO_PROVIDER);
			}

			//Si es un "me paga un cliente" debe elegir cual es el cliente
			if($this->getTypeMovement(FALSE) == 'cta_cte_pay' and empty($this->getIdClient(FALSE)) == TRUE)
			{
			    $this->addError(CMOVEMENT_ADD_FORM_CTA_CTE_ID_CLIENT);
			}

			if(($this->getTypeMovement(FALSE) == 'add_cta_cte' or $this->getTypeMovement(FALSE) == 'del_cta_cte') and empty($this->getIdProvider(FALSE)) == TRUE)
			{
			    $this->addError(CMOVEMENT_ADD_FORM_MOVEMENT_ID_CLIENT_OR_ID_PROVIDER);
			}
			if(($this->getTypeMovement(FALSE) == 'add_cta_cte' or $this->getTypeMovement(FALSE) == 'del_cta_cte') and $this->getTypePay(FALSE) != 'cta_cte')
			{
			    $this->addError(CMOVEMENT_ADD_FORM_MOVEMENT_MUST_BE_CTA_CTE);
			}

			//Si elije cta cte debe elegir un cliente
			if($this->getTypePay(FALSE) == 'cta_cte' and  empty($this->getIdClient(FALSE)) == TRUE and empty($this->getIdProvider(FALSE)) == TRUE)
			{
			    $this->addError(CMOVEMENT_ADD_FORM_CTA_CTE_ID_CLIENT_OR_ID_PROVIDER);
			}

			//Si un cliente me está pagando no lo puede hacer con cta cte
			if($this->getTypeMovement(FALSE) == 'cta_cte_pay' and $this->getTypePay(FALSE) == 'cta_cte')
			{
			    $this->addError(CMOVEMENT_ADD_FORM_PAYMMENT_CTA_CTE_PAY);
			}

			//No puede pagar un cta cte con cta cte
			/*if($this->getTypeMovement(FALSE) == 'payment_to_provider' and $this->getTypePay(FALSE) == 'cta_cte')
			{
			    $this->addError(CMOVEMENT_ADD_FORM_PAYMMENT_CTA_CTE);
			}*/

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
				<form name="formAddMovement" id="formAddMovement" method="post" action="">
				<input name="addMovement" type="hidden" id="addMovement" value="back" />
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
				if (in_array('idClient', $arrayFields) === TRUE)
				{
					echo '<input name="idClient" type="hidden" id="idClient" value="'.$this->getIdClient().'" />';
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

				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';
				}
				if (in_array('discount', $arrayFields) === TRUE)
				{
					echo '<input name="discount" type="hidden" id="discount" value="'.$this->getDiscount().'" />';
				}
				if (in_array('idPayment', $arrayFields) === TRUE)
				{
					echo '<input name="idPayment" type="hidden" id="idPayment" value="'.$this->getIdPayment().'" />';
				}
				if (in_array('idRefund', $arrayFields) === TRUE)
				{
					echo '<input name="idRefund" type="hidden" id="idRefund" value="'.$this->getIdRefund().'" />';
				}
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
			if ($_POST['addMovement'] == 'back')
			{
				if (in_array('dateAdded', $arrayFields) === TRUE)
				{
					$this->setDateAdded($_POST['dateAdded'], FALSE);
				}
				if (in_array('amount', $arrayFields) === TRUE)
				{
					$this->setAmount($_POST['amount'], TRUE);
				}
				if (in_array('idClient', $arrayFields) === TRUE)
				{
					$this->setIdClient($_POST['idClient'], TRUE);
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

				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					$this->setIdProvider($_POST['idProvider'], TRUE);
				}
				if (in_array('discount', $arrayFields) === TRUE)
				{
					$this->setDiscount($_POST['discount'], TRUE);
				}
				if (in_array('idPayment', $arrayFields) === TRUE)
				{
					$this->setIdPayment($_POST['idPayment'], TRUE);
				}
				if (in_array('idRefund', $arrayFields) === TRUE)
				{
					$this->setIdRefund($_POST['idRefund'], TRUE);
				}
			}
			else
			{
			    if(empty($_POST['dateAdded']) == TRUE)
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
				<form name="formAddMovement" id="formAddMovement" method="post" action="">
				<input name="addMovement" type="hidden" id="addMovement" value="add" />
				<div class="fields">
			<?php
			foreach ($arrayFields as $value)
			{
				if ($value == 'dateAdded')
				{
				?>
					<div class="field">
						<label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_DATE_ADDED; ?> <span>*</span></label>
						<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
				<?php
				}
				if ($value == 'amount')
				{
				?>
					<div class="field">
						<label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_AMOUNT; ?> <span>*</span></label>
						<input name="amount" type="text" id="amount" value="<?php echo $this->getAmount(); ?>" class="num" />
					</div>
				<?php
				}
				if ($value == 'idClient')
				{
				    $auxClientName = '';
				    $auxStyle = ' style="display: none;"';
				    if(empty($this->getIdClient(FALSE)) == FALSE)
				    {
    					$auxClient = new Cprovider($this->getDbConn());
    					$auxClient->setId($this->getIdClient(FALSE));
    					if($auxClient->getData() == TRUE)
    					{
    					    $auxClientName  = $auxClient->getName(FALSE);
    					    $auxStyle	    = '';
    					}
				    }
				    elseif($this->getTypeMovement(FALSE) == 'cta_cte_pay')
				    {
				        $auxStyle		= '';
				    }
				    ?>
					<div id="wrapperIdClient" class="field autocompleteWrapper"<?php echo $auxStyle; ?>>
						<label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_ID_CLIENT; ?></label>
						<input name="idClientAutocomplete" id="idClientAutocomplete" value="<?php echo $auxClientName; ?>" class="str autocomplete" maxlength="255" type="text" />
						<input name="idClient" id="idClient" value="<?php echo $this->getIdClient(FALSE); ?>" type="hidden" />
					</div>
				    <?php
				}
				if ($value == 'idSale')
				{
				?>
					<div class="field">
						<label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_ID_SALE; ?></label>
						<input name="idSale" type="text" id="idSale" value="<?php echo $this->getIdSale(); ?>" class="num" />
					</div>
				<?php
				}
				if ($value == 'description')
				{
				?>
					<div class="field">
						<label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_DESCRIPTION; ?></label>
						<textarea name="description" id="description"><?php echo $this->getDescription(); ?></textarea>
					</div>
				<?php
				}
				if ($value == 'typePay')
				{
				?>
					<div class="field">
						<label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_TYPE_PAY; ?> <span>*</span></label>
						<select name="typePay" id="typePay">
							<option value=""></option>
							<option value="cash" <?php if ($this->getTypePay() == 'cash') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cash'); ?></option>
							<option value="bank" <?php if ($this->getTypePay() == 'bank') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('bank'); ?></option>
							<option value="credit" <?php if ($this->getTypePay() == 'credit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('credit'); ?></option>
							<option value="debit" <?php if ($this->getTypePay() == 'debit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('debit'); ?></option>
							<option value="cta_cte" <?php if ($this->getTypePay() == 'cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cta_cte'); ?></option>
							<option value="mercado_pago" <?php if ($this->getTypePay() == 'mercado_pago') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('mercado_pago'); ?></option>
						</select>
					</div>
				<?php
				}
				if ($value == 'typeMovement')
				{
				?>
					<div class="field">
						<label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_TYPE_MOVEMENT; ?> <span>*</span></label>
						<select name="typeMovement" id="typeMovement">
							<option value=""></option>
							<option value="box_in" <?php if ($this->getTypeMovement() == 'box_in') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('box_in'); ?></option>
							<option value="box_out" <?php if ($this->getTypeMovement() == 'box_out') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('box_out'); ?></option>
							<option value="expenditure" <?php if ($this->getTypeMovement() == 'expenditure') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('expenditure'); ?></option>
							<?php
							/*No permito desde el formulario de alta la creación de movimientos de ventas
							<option value="sale" <?php if ($this->getTypeMovement() == 'sale') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('sale'); ?></option>
							 */
							?>
							<option value="cta_cte_pay" <?php if ($this->getTypeMovement() == 'cta_cte_pay') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('cta_cte_pay'); ?></option>
							<option value="partner_take_off" <?php if ($this->getTypeMovement() == 'partner_take_off') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('partner_take_off'); ?></option>
							<?php
							/*No permito desde el formulario de alta la creación de movimientos de pago a proveedores
							<option value="payment_to_provider" <?php if ($this->getTypeMovement() == 'payment_to_provider') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('payment_to_provider'); ?></option>
							*/
							?>
							<option value="investment" <?php if ($this->getTypeMovement() == 'investment') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('investment'); ?></option>
							<option value="add_cta_cte" <?php if ($this->getTypeMovement() == 'add_cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('add_cta_cte'); ?></option>
							<option value="del_cta_cte" <?php if ($this->getTypeMovement() == 'del_cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('del_cta_cte'); ?></option>
						</select>
					</div>
				<?php
				}

				if ($value == 'idProvider')
				{
				    $auxProviderName	 = '';
				    $auxStyle		     = ' style="display: none;"';
				    if(empty($this->getIdProvider(FALSE)) == FALSE)
				    {
    					$auxProvider = new Cprovider($this->getDbConn());
    					$auxProvider->setId($this->getIdProvider(FALSE));

    					if($auxProvider->getData() == TRUE)
    					{
    					    $auxProviderName	= $auxProvider->getName(FALSE);
    					    $auxStyle		= '';
    					}
				    }
				    elseif($this->getTypeMovement(FALSE) == 'payment_to_provider' or $this->getTypeMovement(FALSE) == 'add_cta_cte' or $this->getTypeMovement(FALSE) == 'del_cta_cte')
				    {
				        $auxStyle		= '';
				    }
				    ?>
					<div id="wrapperIdProvider" class="field autocompleteWrapper"<?php echo $auxStyle; ?>>
						 <label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
						<input name="idProviderAutocomplete" id="idProviderAutocomplete" value="<?php echo $auxProviderName; ?>" class="str autocomplete" maxlength="255" type="text" />
						<input name="idProvider" id="idProvider" value="<?php echo $this->getIdProvider(FALSE); ?>" type="hidden" />
					</div>
				    <?php
				}
				if ($value == 'discount')
				{
				?>
					<div class="field">
						<label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_DISCOUNT; ?></label>
						<input name="discount" type="text" id="discount" value="<?php echo $this->getDiscount(); ?>" class="num" />
					</div>
				<?php
				}
				if ($value == 'idPayment')
				{
				?>
					<div class="field">
						<label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_ID_PAYMENT; ?></label>
					<?php
					$oIdPayment = new Cpayment();
					$oIdPayment->setDbConn($this->getDbConn());
					$oIdPayment->showList('dateAdded', 'date_added', $this->getIdPayment(), 'idPayment', 'idPayment', 'select');
					?>
					</div>
				<?php
				}
				if ($value == 'idRefund')
				{
				?>
					<div class="field">
						<label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_ID_REFUND; ?></label>
					<?php
					$oIdRefund = new Crefund();
					$oIdRefund->setDbConn($this->getDbConn());
					$oIdRefund->showList('dateAdded', 'date_added', $this->getIdRefund(), 'idRefund', 'idRefund', 'select');
					?>
					</div>
				<?php
				}
			}
			?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CMOVEMENT_ADD_FORM_SUBMIT_BTN; ?>" class="accept" />
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CMOVEMENT_ADD_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
			<?php
			}
			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CMOVEMENT_ADD_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Muestra un formulario para actualizar un registro existente de la tabla movement
	 *
	 * Este método muestra un formulario para actualizar un registro de la tabla movement mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,dateAdded,amount,idClient,idSale,description,typePay,typeMovement,idUserAdd,type,idProvider,discount,idPayment,idRefund';
	    }

	    $arrayFields = explode(',', $fields);
	    foreach ($arrayFields as $key => $value)
	    {
	        $arrayFields[$key] = trim($value);
	    }

	    if (isset($_POST['updateMovement']) === FALSE)
	    {
	        $_POST['updateMovement'] = '';
	    }

	    if (isset($_GET['p']) === FALSE)
	    {
	        $_GET['p'] = '';
	    }
	    if (isset($_GET['fromScreen']) === FALSE)
	    {
	        $_GET['fromScreen'] = '';
	    }
	    if (isset($_GET['fromScreen']) === FALSE)
	    {
	        $_GET['fromScreen'] = '';
	    }
	    if (isset($_GET['idProvider']) === FALSE)
	    {
	        $_GET['idProvider'] = '';
	    }
	    if(empty($_GET['fromScreen']) == FALSE and $_GET['fromScreen'] == 'showProvider')
	    {
	        if(empty($_GET['idProvider']) == TRUE)
	        {
	            $_GET['idProvider'] = '';
	        }

	        $href		= 'provider-show.php';
	        $param[]		= 'fromScreen=showProvider';
	        $param[]		= 'id='.$_GET['idProvider'];
	        $this->extraParam	= implode('&', $param);
	        $auxParam		= '';

	        if(empty($_GET['p']) == FALSE)
	        {
	            $auxParam = '&';
	        }
	        $_GET['p'] = $auxParam.$this->extraParam;
	    }

	    if ($_POST['updateMovement'] == 'update')
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
	        if (in_array('idClient', $arrayFields) === TRUE)
	        {
	            $this->setIdClient($_POST['idClient'], TRUE);
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
	        if (in_array('type', $arrayFields) === TRUE)
	        {
	            $this->autoSetType();
	        }
	        if (in_array('idProvider', $arrayFields) === TRUE)
	        {
	            $this->setIdProvider($_POST['idProvider'], TRUE);
	        }
	        if (in_array('discount', $arrayFields) === TRUE)
	        {
	            $this->setDiscount($_POST['discount'], TRUE);
	        }
	        if (in_array('idPayment', $arrayFields) === TRUE)
	        {
	            $this->setIdPayment($_POST['idPayment'], TRUE);
	        }
		if (in_array('idRefund', $arrayFields) === TRUE)
		{
			$this->setIdRefund($_POST['idRefund'], TRUE);
		}

	        //Validaciones extras
	        if($this->getType() == 'in' and empty($this->getTypePay()) == TRUE)
	        {
	            $this->addError(CMOVEMENT_ADD_FORM_IN_MUST_SET_TYPE_PAY);
	        }
	        if($this->getTypeMovement() == 'sale')
	        {
	            $this->addError(CMOVEMENT_UPDATE_FORM_NOT_UPDATE_SALE);
	        }

	        if($this->getTypeMovement() == 'payment_to_provider')
	        {
	            $this->addError(CMOVEMENT_UPDATE_FORM_NOT_UPDATE_PAYMENT_TO_PROVIDER);
	        }

	        //Si es cta cte solo puede ser un movimiento "Pago a Proveedor", "Agrega a Cta. Cte." o "Restar a Cta. Cte."
	        if($this->getTypePay(FALSE) == 'cta_cte' and $this->getTypeMovement(FALSE) != 'payment_to_provider' and $this->getTypeMovement(FALSE) != 'add_cta_cte' and $this->getTypeMovement(FALSE) != 'del_cta_cte')
	        {
	            $this->addError(CMOVEMENT_ADD_FORM_CTA_CTE_MUST_BE);
	        }

	        //Si elije cta cte debe elegir un proveedor
	        if($this->getTypeMovement(FALSE) == 'payment_to_provider' and empty($this->getIdProvider(FALSE)) == TRUE)
	        {
	            $this->addError(CMOVEMENT_ADD_FORM_PAYMMENT_TO_PROVIDER);
	        }

	        //Si es un "me paga un cliente" debe elegir cual es el cliente
	        if($this->getTypeMovement(FALSE) == 'cta_cte_pay' and empty($this->getIdClient(FALSE)) == TRUE)
	        {
	            $this->addError(CMOVEMENT_ADD_FORM_CTA_CTE_ID_CLIENT);
	        }

	        if(($this->getTypeMovement(FALSE) == 'add_cta_cte' or $this->getTypeMovement(FALSE) == 'del_cta_cte') and empty($this->getIdProvider(FALSE)) == TRUE)
	        {
	            $this->addError(CMOVEMENT_ADD_FORM_MOVEMENT_ID_CLIENT_OR_ID_PROVIDER);
	        }

	        if(($this->getTypeMovement(FALSE) == 'add_cta_cte' or $this->getTypeMovement(FALSE) == 'del_cta_cte') and $this->getTypePay(FALSE) != 'cta_cte')
	        {
	            $this->addError(CMOVEMENT_ADD_FORM_MOVEMENT_MUST_BE_CTA_CTE);
	        }
	        //Si elije cta cte debe elegir un cliente
	        if($this->getTypePay(FALSE) == 'cta_cte' and  empty($this->getIdClient(FALSE)) == TRUE and empty($this->getIdProvider(FALSE)) == TRUE)
	        {
	            $this->addError(CMOVEMENT_ADD_FORM_CTA_CTE_ID_CLIENT_OR_ID_PROVIDER);
	        }

	        //Si un cliente me está pagando no lo puede hacer con cta cte
	        if($this->getTypeMovement(FALSE) == 'cta_cte_pay' and $this->getTypePay(FALSE) == 'cta_cte')
	        {
	            $this->addError(CMOVEMENT_ADD_FORM_PAYMMENT_CTA_CTE_PAY);
	        }
	        //No puede pagar un cta cte con cta cte
	        /*if($this->getTypeMovement(FALSE) == 'payment_to_provider' and $this->getTypePay(FALSE) == 'cta_cte')
	         {
	         $this->addError(CMOVEMENT_ADD_FORM_PAYMMENT_CTA_CTE);
	         }*/

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
    					<div class="message success"><?php echo CMOVEMENT_UPDATE_FORM_OK; ?></div>
    				</div>
    				<div class="middle"></div>
    				<div class="buttons">
    				<?php
    				if (validateRequiredValue($href) === TRUE)
    				{
    				    ?>
    					<input type="button" value="<?php echo CMOVEMENT_UPDATE_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
				<form name="formUpdateMovement" id="formUpdateMovement" method="post" action="">
				<input name="updateMovement" type="hidden" id="updateMovement" value="back" />
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
				if (in_array('idClient', $arrayFields) === TRUE)
				{
					echo '<input name="idClient" type="hidden" id="idClient" value="'.$this->getIdClient().'" />';
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

				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';
				}
				if (in_array('discount', $arrayFields) === TRUE)
				{
					echo '<input name="discount" type="hidden" id="discount" value="'.$this->getDiscount().'" />';
				}
				if (in_array('idPayment', $arrayFields) === TRUE)
				{
					echo '<input name="idPayment" type="hidden" id="idPayment" value="'.$this->getIdPayment().'" />';
				}
				if (in_array('idRefund', $arrayFields) === TRUE)
				{
					echo '<input name="idRefund" type="hidden" id="idRefund" value="'.$this->getIdRefund().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CMOVEMENT_UPDATE_FORM_BACK_BTN; ?>" class="back" />
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
			    //Control para que no modifiquen los movimientos hechos en una venta desde acá
			    if($this->getTypeMovement(FALSE) == 'sale' or $this->getTypeMovement(FALSE) == 'payment_to_provider')
			    {

				?>
			<div class="message error"><?php echo CMOVEMENT_UPDATE_FORM_NOT_ALLOW; ?></div>
				<?php
				exit;
			    }
				if ($_POST['updateMovement'] == 'back')
				{
					if (in_array('dateAdded', $arrayFields) === TRUE)
					{
						$this->setDateAdded($_POST['dateAdded'], FALSE);
					}
					if (in_array('amount', $arrayFields) === TRUE)
					{
						$this->setAmount($_POST['amount'], TRUE);
					}
					if (in_array('idClient', $arrayFields) === TRUE)
					{
						$this->setIdClient($_POST['idClient'], TRUE);
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
					if (in_array('idProvider', $arrayFields) === TRUE)
					{
						$this->setIdProvider($_POST['idProvider'], TRUE);
					}
					if (in_array('discount', $arrayFields) === TRUE)
					{
						$this->setDiscount($_POST['discount'], TRUE);
					}
					if (in_array('idPayment', $arrayFields) === TRUE)
					{
						$this->setIdPayment($_POST['idPayment'], TRUE);
					}
					if (in_array('idRefund', $arrayFields) === TRUE)
					{
						$this->setIdRefund($_POST['idRefund'], TRUE);
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
				<form name="formUpdateMovement" id="formUpdateMovement" method="post" action="">
				<input name="updateMovement" type="hidden" id="updateMovement" value="update" />
				<input name="id" type="hidden" id="id" value="<?php echo $this->getId(); ?>" />
				<div class="fields">
				<?php
				foreach ($arrayFields as $value)
				{
					if ($value == 'id')
					{
					?>
					<div class="field">
						<label><?php echo CMOVEMENT_UPDATE_FORM_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
					<?php
					}
					if ($value == 'dateAdded')
					{
					?>
					<div class="field">
						<label><?php echo CMOVEMENT_UPDATE_FORM_LABEL_FIELD_DATE_ADDED; ?> <span>*</span></label>
						<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
					<?php
					}
					if ($value == 'amount')
					{
					?>
					<div class="field">
						<label><?php echo CMOVEMENT_UPDATE_FORM_LABEL_FIELD_AMOUNT; ?> <span>*</span></label>
						<input name="amount" type="text" id="amount" value="<?php echo $this->getAmount(); ?>" class="num" />
					</div>
					<?php
					}
					if ($value == 'idClient')
					{
					    $auxClientName  = '';
					    $auxStyle	    = ' style="display: none;"';
					    if(empty($this->getIdClient(FALSE)) == FALSE)
					    {
    						$auxClient = new Cprovider($this->getDbConn());
    						$auxClient->setId($this->getIdClient(FALSE));
    						if($auxClient->getData() == TRUE)
    						{
    						    $auxClientName  = $auxClient->getName(FALSE);
    						    $auxStyle	    = '';
    						}
					    }
					    elseif($this->getTypeMovement(FALSE) == 'cta_cte_pay')
					    {
					        $auxStyle		= '';
					    }
    					?>
    					<div id="wrapperIdClient" class="field autocompleteWrapper"<?php echo $auxStyle; ?>>
    						<label><?php echo CMOVEMENT_UPDATE_FORM_LABEL_FIELD_ID_CLIENT; ?></label>
    						<input name="idClientAutocomplete" id="idClientAutocomplete" value="<?php echo $auxClientName; ?>" class="str autocomplete" maxlength="255" type="text" />
    						<input name="idClient" id="idClient" value="<?php echo $this->getIdClient(FALSE); ?>" type="hidden" />
					    </div>
					    <?php
					}
					if ($value == 'idSale')
					{
					?>
					<div class="field">
						<label><?php echo CMOVEMENT_UPDATE_FORM_LABEL_FIELD_ID_SALE; ?></label>
						<input name="idSale" type="text" id="idSale" value="<?php echo $this->getIdSale(); ?>" class="num" />
					</div>
					<?php
					}
					if ($value == 'description')
					{
					?>
					<div class="field">
						<label><?php echo CMOVEMENT_UPDATE_FORM_LABEL_FIELD_DESCRIPTION; ?></label>
						<textarea name="description" id="description"><?php echo $this->getDescription(); ?></textarea>
					</div>
					<?php
					}
					if ($value == 'typePay')
					{
					?>
					<div class="field">
						<label><?php echo CMOVEMENT_UPDATE_FORM_LABEL_FIELD_TYPE_PAY; ?> <span>*</span></label>
						<select name="typePay" id="typePay">
							<option value=""></option>
							<option value="cash" <?php if ($this->getTypePay() == 'cash') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cash'); ?></option>
							<option value="bank" <?php if ($this->getTypePay() == 'bank') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('bank'); ?></option>
							<option value="credit" <?php if ($this->getTypePay() == 'credit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('credit'); ?></option>
							<option value="debit" <?php if ($this->getTypePay() == 'debit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('debit'); ?></option>
							<option value="cta_cte" <?php if ($this->getTypePay() == 'cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cta_cte'); ?></option>
							<option value="mercado_pago" <?php if ($this->getTypePay() == 'mercado_pago') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('mercado_pago'); ?></option>
						</select>
					</div>
					<?php
					}
					if ($value == 'typeMovement')
					{
					?>
					<div class="field">
						<label><?php echo CMOVEMENT_UPDATE_FORM_LABEL_FIELD_TYPE_MOVEMENT; ?> <span>*</span></label>
						<select name="typeMovement" id="typeMovement">
							<option value=""></option>
							<option value="box_in" <?php if ($this->getTypeMovement() == 'box_in') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('box_in'); ?></option>
							<option value="box_out" <?php if ($this->getTypeMovement() == 'box_out') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('box_out'); ?></option>
							<option value="expenditure" <?php if ($this->getTypeMovement() == 'expenditure') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('expenditure'); ?></option>
							<?php
							/*No permito desde el formulario de modificación la creación de movimientos de ventas
							<option value="sale" <?php if ($this->getTypeMovement() == 'sale') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('sale'); ?></option>
							 */
							?>
							<option value="cta_cte_pay" <?php if ($this->getTypeMovement() == 'cta_cte_pay') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('cta_cte_pay'); ?></option>
							<option value="partner_take_off" <?php if ($this->getTypeMovement() == 'partner_take_off') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('partner_take_off'); ?></option>
							<?php
							/*No permito desde el formulario de modificación la creación de movimientos de ventas
							<option value="payment_to_provider" <?php if ($this->getTypeMovement() == 'payment_to_provider') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('payment_to_provider'); ?></option>
							*/
							?>
							<option value="investment" <?php if ($this->getTypeMovement() == 'investment') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('investment'); ?></option>
							<option value="add_cta_cte" <?php if ($this->getTypeMovement() == 'add_cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('add_cta_cte'); ?></option>
							<option value="del_cta_cte" <?php if ($this->getTypeMovement() == 'del_cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('del_cta_cte'); ?></option>
						</select>
					</div>
					<?php
					}

					if ($value == 'idProvider')
					{
					    $auxProviderName = '';
					    $auxStyle = ' style="display: none;"';
					    if(empty($this->getIdProvider(FALSE)) == FALSE)
					    {
    						$auxProvider = new Cprovider($this->getDbConn());
    						$auxProvider->setId($this->getIdProvider(FALSE));
    						if($auxProvider->getData() == TRUE)
    						{
    						    $auxProviderName	= $auxProvider->getName(FALSE);
    						    $auxStyle		= '';
    						}
					    }
					    elseif($this->getTypeMovement(FALSE) == 'payment_to_provider' or $this->getTypeMovement(FALSE) == 'add_cta_cte' or $this->getTypeMovement(FALSE) == 'del_cta_cte')
					    {
					        $auxStyle		= '';
					    }
					    ?>
					    <div id="wrapperIdProvider" class="field autocompleteWrapper"<?php echo $auxStyle; ?>>
						    <label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
						    <input name="idProviderAutocomplete" id="idProviderAutocomplete" value="<?php echo $auxProviderName; ?>" class="str autocomplete" maxlength="255" type="text" />
						    <input name="idProvider" id="idProvider" value="<?php echo $this->getIdProvider(FALSE); ?>" type="hidden" />
					    </div>
					    <?php
					}
					if ($value == 'discount')
					{
					?>
					<div class="field">
						<label><?php echo CMOVEMENT_UPDATE_FORM_LABEL_FIELD_DISCOUNT; ?></label>
						<input name="discount" type="text" id="discount" value="<?php echo $this->getDiscount(); ?>" class="num" />
					</div>
					<?php
					}
					if ($value == 'idPayment')
					{
					?>
					<div class="field">
						<label><?php echo CMOVEMENT_UPDATE_FORM_LABEL_FIELD_ID_PAYMENT; ?></label>
						<?php
						$oIdPayment = new Cpayment();
						$oIdPayment->setDbConn($this->getDbConn());
						$oIdPayment->showList('dateAdded', 'date_added', $this->getIdPayment(), 'idPayment', 'idPayment', 'select');
						?>
					</div>
					<?php
					}
					if ($value == 'idRefund')
					{
					?>
					<div class="field">
						<label><?php echo CMOVEMENT_UPDATE_FORM_LABEL_FIELD_ID_REFUND; ?></label>
						<?php
						$oIdRefund = new Crefund();
						$oIdRefund->setDbConn($this->getDbConn());
						$oIdRefund->showList('dateAdded', 'date_added', $this->getIdRefund(), 'idRefund', 'idRefund', 'select');
						?>
					</div>
					<?php
					}
				}
				?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CMOVEMENT_UPDATE_FORM_SUBMIT_BTN; ?>" class="accept" />
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CMOVEMENT_UPDATE_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="cancel" />
				<?php
				}
				?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CMOVEMENT_UPDATE_FORM_LABEL_REQUIRED; ?></span>
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
					<input type="button" value="<?php echo CMOVEMENT_UPDATE_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
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
	 * Elimina un registro existente de la tabla movement y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un registro de la tabla movement y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
		if (isset($_GET['fromScreen']) === FALSE)
		{
			$_GET['fromScreen'] = '';
		}
		if (isset($_GET['fromScreen']) === FALSE)
		{
			$_GET['fromScreen'] = '';
		}
		if (isset($_GET['idProvider']) === FALSE)
		{
			$_GET['idProvider'] = '';
		}
		if(empty($_GET['fromScreen']) == FALSE and $_GET['fromScreen'] == 'showProvider')
		{
		    if(empty($_GET['idProvider']) == TRUE)
		    {
			$_GET['idProvider'] = '';
		    }
		    $href	= 'provider-show.php';
		    $param[]	= 'fromScreen=showProvider';
		    $param[]	= 'id='.$_GET['idProvider'];
		    $this->extraParam = implode('&', $param);

		    $auxParam = '';
		    if(empty($_GET['p']) == FALSE)
		    {
			$auxParam = '&';
		    }
		    $_GET['p'] = $auxParam.$this->extraParam;
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
					<div class="message success"><?php echo CMOVEMENT_DEL_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CMOVEMENT_DEL_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
					<input type="button" value="<?php echo CMOVEMENT_DEL_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
				</div>
		<?php
		}
		?>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Elimina un grupo de registros existente de la tabla movement y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un grupo de registros de la tabla movement y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
			$this->addError(CMOVEMENT_DEL_GROUP_FORM_REQUIRED_PK);
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
					<div class="message success"><?php echo CMOVEMENT_DEL_GROUP_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CMOVEMENT_DEL_GROUP_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="success" />
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
				$this->addError(CMOVEMENT_DEL_GROUP_FORM_CANT_DELETE_ALL);
			}
			?>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="button" value="<?php echo CMOVEMENT_DEL_GROUP_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="back" />
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
			$fields = 'id,dateAdded,amount,idClient,idSale,description,typePay,typeMovement,idUserAdd,type,idProvider,discount,idPayment,idRefund';
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
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'dateAdded')
			{
			?>
					<div class="field">
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_DATE_ADDED; ?></label>
						<strong><?php echo $this->getDateAdded(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'amount')
			{
			?>
					<div class="field">
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_AMOUNT; ?></label>
						<strong><?php echo $this->getAmount(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idClient')
			{
			?>
					<div class="field">
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_ID_CLIENT; ?></label>
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
			if ($value == 'idSale')
			{
			?>
					<div class="field">
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_ID_SALE; ?></label>
						<?php if(empty($this->getIdSale()) == FALSE): ?>
						<strong>#<?php echo $this->getIdSale(); ?> <a href="sale-update.php?id=<?php echo $this->getIdSale(); ?>" title="Ver detalle de la venta"><img src="img/form-search.png" /></a></strong>
						<?php else: ?>
						<strong>&nbsp;</strong>
						<?php endif; ?>
					</div>
			<?php
			}
			if ($value == 'description')
			{
			?>
					<div class="field">
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_DESCRIPTION; ?></label>
						<strong><?php echo $this->getDescription(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'typePay')
			{
			?>
					<div class="field">
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_TYPE_PAY; ?></label>
						<strong><?php echo $this->getValuesTypePay($this->getTypePay()); ?></strong>
					</div>
			<?php
			}
			if ($value == 'typeMovement')
			{
			?>
					<div class="field">
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_TYPE_MOVEMENT; ?></label>
						<strong><?php echo $this->getValuesTypeMovement($this->getTypeMovement()); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idUserAdd')
			{
			?>
					<div class="field">
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_ID_USER_ADD; ?></label>
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
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_TYPE; ?></label>
						<strong><?php echo $this->getValuesType($this->getType()); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idProvider')
			{
			?>
					<div class="field">
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_ID_PROVIDER; ?></label>
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
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_DISCOUNT; ?></label>
						<strong><?php echo $this->getDiscount(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idPayment')
			{
			?>
					<div class="field">
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_ID_PAYMENT; ?></label>
				<?php
				$oIdPayment = new Cpayment();
				$oIdPayment->setDbConn($this->getDbConn());
				$oIdPayment->setId($this->getIdPayment(FALSE));
				$oIdPayment->getData();
				?>
						<strong><?php echo $oIdPayment->getDateAdded(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idRefund')
			{
			?>
					<div class="field">
						<label><?php echo CMOVEMENT_SHOW_DATA_LABEL_FIELD_ID_REFUND; ?></label>
				<?php
				$oIdRefund = new Crefund();
				$oIdRefund->setDbConn($this->getDbConn());
				$oIdRefund->setId($this->getIdRefund(FALSE));
				$oIdRefund->getData();
				?>
						<strong><?php echo $oIdRefund->getDateAdded(); ?></strong>
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
					<input type="button" value="<?php echo CMOVEMENT_SHOW_DATA_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
		<?php
		}
		?>
				</div>
				<div class="bottom"></div>
			</div>
	<?php
	}

	/**
	 * Muestra un formulario de búsqueda de registros de la tabla movement
	 *
	 * Este método muestra un formulario con los campos seteados en el parámetro $fields para realizar una búsqueda de los registros de la tabla movement.
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
			$fields = 'id,dateAdded,amount,idClient,idSale,description,typePay,typeMovement,idUserAdd,type,idProvider,discount,idPayment,idRefund';
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
		if (isset($values['dateAddedFrom']) === FALSE)
		{
		    $values['dateAddedFrom'] = '';
		}
		if (isset($values['dateAddedTo']) === FALSE)
		{
		    $values['dateAddedTo'] = '';
		}


		$oDateInfo = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
		?>
			<div class="form search">
				<div class="aux"></div>
		<?php
		$display = '';
		if ($showHideBtn === TRUE)
		{
			if (isset($_SESSION['main_tr_search_movement']) === FALSE)
			{
				$_SESSION['main_tr_search_movement'] = '';
			}

			$display  = 'display: none;';
			$btnClass = 'closed';
			if ($_SESSION['main_tr_search_movement'] === 'open')
			{
				$display  = '';
				$btnClass = 'open';
			}
		}
		?>
				<div class="title">
					<div class="ico"><?php if ($showHideBtn === TRUE) { ?><a href="#" onclick="showHideSearch('movement'); return false;" class="<?php echo $btnClass; ?>"></a><?php } ?></div>
					<div class="label"><a href="#" onclick="showHideSearch('movement'); return false;"><?php echo $title; ?></a></div>
				</div>
				<div id="container_search_movement" style="<?php echo $display; ?>">
					<div class="top"></div>
					<form name="formSearchMovement" id="formSearchMovement" method="<?php echo $method; ?>" action="">
					<div class="fields">
		<?php
		$condition  = array();
		$params	    = array();

		foreach ($arrayFields as $value)
		{
			if ($value == 'id')
			{
				$this->setId($values['id'], TRUE);
				?>
						<div class="field">
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_ID; ?></label>
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
			    $this->setDateAdded($values['dateAddedFrom'], FALSE);
			    $dateFrom		= $this->getDateAdded();
			    $dateFromCondition	= $this->dateAdded;

			    $this->setDateAdded($values['dateAddedTo'], FALSE);
			    $dateTo		    = $this->getDateAdded();
			    $dateToCondition    = $this->dateAdded;

			    /*if(empty($values['dateAddedFrom']) == TRUE)
			    {
				$this->setDateAdded(date(FORMAT_DATE), FALSE);
				$dateTo		    = $this->getDateAdded();
				$dateToCondition    = $this->dateAdded;
			    }
			    else
			    {
				$this->setDateAdded($values['dateAddedTo'], FALSE);
				$dateTo		    = $this->getDateAdded();
				$dateToCondition    = $this->dateAdded;
			    }*/
			    ?>
					    <div class="field">
						    <label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_DATE_ADDED; ?></label>
						    <?php dateFields('dateAdded', $this->getDbConn()->fmtDate, $dateFrom, $dateTo); ?>
					    </div>
			    <?php
			    if (validateRequiredValue($values['dateAddedFrom']) === TRUE or validateRequiredValue($values['dateAddedTo']) === TRUE)
			    {

				$condition[]	= $this->getFieldSql('date_added', $this->getTableName()).' BETWEEN '.$this->getValueSql($dateFromCondition).' AND '.$this->getValueSql($dateToCondition);
				$params[]	= 'dateAddedFrom='.urlencode($dateFrom);
				$params[]	= 'dateAddedTo='.urlencode($dateTo);
			    }
			}

			if ($value == 'amount')
			{
				$this->setAmount($values['amount'], TRUE);
				?>
						<div class="field">
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_AMOUNT; ?></label>
							<input name="amount" type="text" id="amount" value="<?php echo $this->getAmount(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getAmount()) === TRUE)
				{
					$condition[] = $this->getFieldSql('amount', $this->getTableName()).' = '.$this->getValueSql($this->amount);
					$params[] = 'amount='.urlencode($this->amount);
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
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_ID_CLIENT; ?></label>
							<input name="idClientAutocomplete" id="idClientAutocomplete" value="<?php echo $auxClientName; ?>" class="str autocomplete" maxlength="255" type="text" />
							<input name="idClient" id="idClient" value="<?php echo $this->getIdClient(FALSE); ?>" type="hidden" />
						</div>
				<?php
				if (validateRequiredValue($this->getIdClient()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_client', $this->getTableName()).' = '.$this->getValueSql($this->idClient);
					$params[] = 'idClient='.urlencode($this->idClient);
				}
			}

			if ($value == 'idSale')
			{
				$this->setIdSale($values['idSale'], TRUE);
				?>
						<div class="field">
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_ID_SALE; ?></label>
							<input name="idSale" type="text" id="idSale" value="<?php echo $this->getIdSale(); ?>" class="num" />
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
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_DESCRIPTION; ?></label>
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
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_TYPE_PAY; ?></label>
							<select name="typePay" id="typePay">
								<option value=""></option>
								<option value="cash" <?php if ($this->getTypePay() == 'cash') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cash'); ?></option>
								<option value="bank" <?php if ($this->getTypePay() == 'bank') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('bank'); ?></option>
								<option value="credit" <?php if ($this->getTypePay() == 'credit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('credit'); ?></option>
								<option value="debit" <?php if ($this->getTypePay() == 'debit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('debit'); ?></option>
								<option value="cta_cte" <?php if ($this->getTypePay() == 'cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cta_cte'); ?></option>
								<option value="mercado_pago" <?php if ($this->getTypePay() == 'mercado_pago') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('mercado_pago'); ?></option>
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
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_TYPE_MOVEMENT; ?></label>
							<select name="typeMovement" id="typeMovement">
								<option value=""></option>
								<option value="box_in" <?php if ($this->getTypeMovement() == 'box_in') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('box_in'); ?></option>
								<option value="box_out" <?php if ($this->getTypeMovement() == 'box_out') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('box_out'); ?></option>
								<option value="expenditure" <?php if ($this->getTypeMovement() == 'expenditure') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('expenditure'); ?></option>
								<option value="sale" <?php if ($this->getTypeMovement() == 'sale') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('sale'); ?></option>
								<option value="cta_cte_pay" <?php if ($this->getTypeMovement() == 'cta_cte_pay') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('cta_cte_pay'); ?></option>
								<option value="partner_take_off" <?php if ($this->getTypeMovement() == 'partner_take_off') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('partner_take_off'); ?></option>
								<option value="payment_to_provider" <?php if ($this->getTypeMovement() == 'payment_to_provider') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('payment_to_provider'); ?></option>
								<option value="investment" <?php if ($this->getTypeMovement() == 'investment') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('investment'); ?></option>
								<option value="add_cta_cte" <?php if ($this->getTypeMovement() == 'add_cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('add_cta_cte'); ?></option>
								<option value="del_cta_cte" <?php if ($this->getTypeMovement() == 'del_cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypeMovement('del_cta_cte'); ?></option>
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
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_ID_USER_ADD; ?></label>
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

			if ($value == 'type')
			{
				$this->setType($values['type'], TRUE);
				?>
						<div class="field">
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_TYPE; ?></label>
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
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
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
			if ($value == 'discount')
			{
				$this->setDiscount($values['discount'], TRUE);
				?>
						<div class="field">
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_DISCOUNT; ?></label>
							<input name="discount" type="text" id="discount" value="<?php echo $this->getDiscount(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getDiscount()) === TRUE)
				{
					$condition[] = $this->getFieldSql('discount', $this->getTableName()).' = '.$this->getValueSql($this->discount);
					$params[] = 'discount='.urlencode($this->discount);
				}
			}
			if ($value == 'idPayment')
			{
				$this->setIdPayment($values['idPayment'], TRUE);
				?>
						<div class="field">
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_ID_PAYMENT; ?></label>
				<?php
				$oIdPayment = new Cpayment();
				$oIdPayment->setDbConn($this->getDbConn());
				$oIdPayment->showList('dateAdded', 'date_added', $this->getIdPayment(), 'idPayment', 'idPayment', 'select_search');
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdPayment()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_payment', $this->getTableName()).' = '.$this->getValueSql($this->idPayment);
					$params[] = 'idPayment='.urlencode($this->idPayment);
				}
			}
			if ($value == 'idRefund')
			{
				$this->setIdRefund($values['idRefund'], TRUE);
				?>
						<div class="field">
							<label><?php echo CMOVEMENT_SEARCH_FORM_LABEL_FIELD_ID_REFUND; ?></label>
				<?php
				$oIdRefund = new Crefund();
				$oIdRefund->setDbConn($this->getDbConn());
				$oIdRefund->showList('dateAdded', 'date_added', $this->getIdRefund(), 'idRefund', 'idRefund', 'select_search');
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdRefund()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_refund', $this->getTableName()).' = '.$this->getValueSql($this->idRefund);
					$params[] = 'idRefund='.urlencode($this->idRefund);
				}
			}
		}
		?>
					</div>
					<div class="middle"></div>
					<div class="buttons">
						<input type="submit" value="<?php echo CMOVEMENT_SEARCH_FORM_SUBMIT_BTN; ?>" class="search" />
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
	 * Muestra el resultado de una consulta a la tabla movement
	 *
	 * Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla movement. Muestra sólo los campos seteados en el parámetro $fields.
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
	 * Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST['movementGroup'] (array)</b>
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
			$fields[3]['field'] = 'idClient';
			$fields[4]['field'] = 'idSale';
			$fields[5]['field'] = 'description';
			$fields[6]['field'] = 'typePay';
			$fields[7]['field'] = 'typeMovement';
			$fields[8]['field'] = 'idUserAdd';
			$fields[9]['field'] = 'type';
			$fields[10]['field'] = 'idProvider';
			$fields[11]['field'] = 'discount';
			$fields[12]['field'] = 'idPayment';
			$fields[13]['field'] = 'idRefund';
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
			$arrayOrder = array('id', 'date_added', 'amount', 'id_client', 'id_sale', 'description', 'type_pay', 'type_movement', 'id_user_add', 'type', 'id_provider', 'discount', 'id_payment', 'id_refund');
			array_push($arrayOrder, 'provider_name', 'user_name', 'provider_name', 'payment_date_added', 'refund_date_added');

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

		$head	    = '';
		$headers    = array();

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

				$head.= '<div class="col" style="width: '.$arrayWidth['id'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></div>';
				$headers['id'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['dateAdded'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div></div>';
				$headers['dateAdded'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['amount'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_AMOUNT, $arrayStrLen['amount']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_AMOUNT).'</a></div></div>';
				$headers['amount'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_AMOUNT, $arrayStrLen['amount']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_AMOUNT).'</a></div>';
			}
			if ($value == 'realAmount')
			{
			    if ($_GET['orderby'] == 'realAmount')
			    {
			        if ($_GET['ascdesc'] == 'ASC')
			        {
			            $href = '?orderby=realAmount&ascdesc=DESC';
			        }
			        else
			        {
			            $href = '?orderby=realAmount&ascdesc=ASC';
			        }
			    }
			    else
			    {
			        $href = '?orderby=realAmount&ascdesc=ASC';
			    }
			    if ($this->getParams() != '')
			    {
			        $href.= '&'.$this->getParams();
			    }

			    $head.= '<div class="col" style="width: '.$arrayWidth['realAmount'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_AMOUNT, $arrayStrLen['realAmount']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_AMOUNT).'</a></div></div>';
			    $headers['realAmount'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_AMOUNT, $arrayStrLen['realAmount']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_AMOUNT).'</a></div>';
			}

			if ($value == 'idClient')
			{
				if ($_GET['orderby'] == 'client_name')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=client_name&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=client_name&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=client_name&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['idClient'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_CLIENT, $arrayStrLen['idClient']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_CLIENT).'</a></div></div>';
				$headers['idClient'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_CLIENT, $arrayStrLen['idClient']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_CLIENT).'</a></div>';
			}

			if ($value == 'idSale')
			{
				if ($_GET['orderby'] == 'id_sale')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=id_sale&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=id_sale&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=id_sale&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['idSale'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_SALE, $arrayStrLen['idSale']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_SALE).'</a></div></div>';
				$headers['idSale'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_SALE, $arrayStrLen['idSale']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_SALE).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['description'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION, $arrayStrLen['description']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION).'</a></div></div>';
				$headers['description'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION, $arrayStrLen['description']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['typePay'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE_PAY, $arrayStrLen['typePay']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE_PAY).'</a></div></div>';
				$headers['typePay'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE_PAY, $arrayStrLen['typePay']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE_PAY).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['typeMovement'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE_MOVEMENT, $arrayStrLen['typeMovement']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE_MOVEMENT).'</a></div></div>';
				$headers['typeMovement'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE_MOVEMENT, $arrayStrLen['typeMovement']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE_MOVEMENT).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['idUserAdd'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div></div>';
				$headers['idUserAdd'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['type'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE, $arrayStrLen['type']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE).'</a></div></div>';
				$headers['type'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE, $arrayStrLen['type']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_TYPE).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['idProvider'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div></div>';
				$headers['idProvider'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div>';
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
				$head.= '<div class="col" style="width: '.$arrayWidth['discount'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DISCOUNT, $arrayStrLen['discount']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DISCOUNT).'</a></div></div>';
				$headers['discount'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DISCOUNT, $arrayStrLen['discount']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_DISCOUNT).'</a></div>';
			}
			if ($value == 'idPayment')
			{
				if ($_GET['orderby'] == 'payment_date_added')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=payment_date_added&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=payment_date_added&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=payment_date_added&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}
				$head.= '<div class="col" style="width: '.$arrayWidth['idPayment'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_PAYMENT, $arrayStrLen['idPayment']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_PAYMENT).'</a></div></div>';
				$headers['idPayment'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_PAYMENT, $arrayStrLen['idPayment']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_PAYMENT).'</a></div>';
			}
			if ($value == 'idRefund')
			{
				if ($_GET['orderby'] == 'refund_date_added')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=refund_date_added&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=refund_date_added&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=refund_date_added&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}
				$head.= '<div class="col" style="width: '.$arrayWidth['idRefund'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_REFUND, $arrayStrLen['idRefund']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_REFUND).'</a></div></div>';
				$headers['idRefund'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_REFUND, $arrayStrLen['idRefund']), CMOVEMENT_SHOW_QUERY_HEAD_FIELD_ID_REFUND).'</a></div>';
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

		//Agrego los parámetros extras
		if(empty($this->extraParam) == FALSE)
		{
		    if (validateRequiredValue($actionsParams) === TRUE)
		    {
			    $actionsParams.= '&';
		    }
		    $actionsParams.= $this->extraParam;
		}
		?>
			<div class="form query">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<form name="formQueryMovement" id="formQueryMovement" method="post" action="">
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
				<div class="message warning"><?php echo CMOVEMENT_SHOW_QUERY_NOT_FOUND; ?></div>
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
					<div class="row row<?php echo $class; ?>" id="movement_tr_<?php echo $row['id']; ?>" data-table-name="movement" data-id="<?php echo $row['id']; ?>" data-form-id="formQueryMovement">
				<?php
				if (is_array($groupActions) === TRUE)
				{
				?>
						<div class="col header"></div>
						<div class="col" style="width: <?php echo $widthGroupActions; ?>;"><div class="group-actions"><input name="movementGroup[]" type="checkbox" id="cb_movement_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="checkboxClick(this)" /></div></div>
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
					if ($value == 'realAmount')
					{
					    ?>
						<div class="col header"><?php echo $headers['realAmount']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['realAmount']; ?>;"><div class="num"><?php echo altText(getCutString($row['realAmount'], $arrayStrLen['realAmount']), $row['realAmount']); ?></div></div>
						<?php
					}
					if ($value == 'idClient')
					{
					?>
						<div class="col header"><?php echo $headers['idClient']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idClient']; ?>;"><div class="str"><?php echo altText(getCutString($row['clientName'], $arrayStrLen['idClient']), $row['clientName']); ?></div></div>
					<?php
					}

					if ($value == 'idSale')
					{
					?>
						<div class="col header"><?php echo $headers['idSale']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idSale']; ?>;"><div class="num"><?php echo altText(getCutString($row['idSale'], $arrayStrLen['idSale']), $row['idSale']); ?></div></div>
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
					if ($value == 'idPayment')
					{
					?>
						<div class="col header"><?php echo $headers['idPayment']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idPayment']; ?>;"><div class="date"><?php echo altText(getCutString($row['paymentDateAdded'], $arrayStrLen['idPayment']), $row['paymentDateAdded']); ?></div></div>
					<?php
					}
					if ($value == 'idRefund')
					{
					?>
						<div class="col header"><?php echo $headers['idRefund']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idRefund']; ?>;"><div class="date"><?php echo altText(getCutString($row['refundDateAdded'], $arrayStrLen['idRefund']), $row['refundDateAdded']); ?></div></div>
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

						if(($row['typeMovement'] == 'sale' or $row['typeMovement'] == 'payment_to_provider' or empty($row['idRefund']) == FALSE) and $value['class'] != 'show')
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
						<input name="movement_select_all" type="checkbox" id="movement_select_all" value="" class="checkbox_show_query" onclick="querySelectAll('movement', 'formQueryMovement')" />
						<span><?php echo CMOVEMENT_SHOW_QUERY_SELECT_ALL; ?></span>
					</div>
			<?php
			$j = 1;
			foreach ($groupActions as $value)
			{
				if ($value['confirm'] === TRUE)
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryMovement\', \''.$value['file'].'\', \''.$actionsParams.'\', true, \''.$value['msg'].'\');"';
				}
				else
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryMovement\', \''.$value['file'].'\', \''.$actionsParams.'\', false, \'\');"';
				}

				if ($value['button'] === TRUE)
				{
					echo '<input type="button" name="movement_ga_'.$j.'" id="movement_ga_'.$j.'" value="'.$value['text'].'" class="'.$value['class'].'" '.$onclick.' />';
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
	 * Agrega los elementos de formulario necesarios para agregar los items de la relación con la tabla {@link Csale sale}
	 *
	 * Este método muestra los campos del formulario de la tabla detail seteados en el parámetro $fields que se utilizan
	 * dentro de los métodos {@link Csale::addForm() addForm} y {@link Csale::updateForm() updateForm} de la tabla {@link Csale sale}.
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
	 * - 'width'  : ancho que tiene la columna de ese campo (en la tabla que muestra el detalle)
	 * - 'strlen' : cantidad de caracteres que se van a mostrar de ese campo (en la tabla que muestra el detalle)
	 *
	 * El parámetro $update es un array asociativo con el siguiente formato:
	 * <code>
	 * <?php
	 * $update['image']      = 'img/update.png';
	 * $update['image-over'] = 'img/update-over.png';
	 * $update['image-head'] = 'img/update-head.png';
	 * $update['class']      = 'update';
	 * $update['title']      = 'Modificar';
	 * $update['width']      = '5%';
	 * ?>
	 * </code>
	 * - 'image'        : url de la imagen que se muestra en el link de la acción
	 * - 'image-over'   : url de la imagen que se muestra en el link de la acción, estado over
	 * - 'image-head'   : url de la imagen de la cabecera de la acción
	 * - 'class'        : clase css
	 * - 'title'        : title o alt del link de la acción
	 * - 'width'        : ancho que tiene la columna de la acción (en la tabla que muestra el detalle)
	 *
	 * El parámetro $delete es un array asociativo con el siguiente formato:
	 * <code>
	 * <?php
	 * $delete['image']      = 'img/delete.png';
	 * $delete['image-over'] = 'img/delete-over.png';
	 * $delete['image-head'] = 'img/delete-head.png';
	 * $delete['class']      = 'del';
	 * $delete['title']      = 'Eliminar';
	 * $delete['width']      = '5%';
	 * ?>
	 * </code>
	 * - 'image'        : url de la imagen que se muestra en el link de la acción
	 * - 'image-over'   : url de la imagen que se muestra en el link de la acción, estado over
	 * - 'image-head'   : url de la imagen de la cabecera de la acción
	 * - 'class'        : clase css
	 * - 'title'        : title o alt del link de la acción
	 * - 'width'        : ancho que tiene la columna de la acción (en la tabla que muestra el detalle)
	 *
	 * Ver también: {@link addDetail()}, {@link updateDetail()}, {@link listDetail()}
	 * @param string $fileControl url del archivo que realiza las validaciones correspondientes
	 * @param array $fields [opcional] contiene los campos que se van a mostrar
	 * @param array $update [opcional] contiene la configuración de la acción modificar ítem
	 * @param array $delete [opcional] contiene la configuración de la acción eliminar ítem
	 * @param string $title [opcional] título
	 * @param string $uniqueID [opcional] nombre de la variable de sesión
	 *
	 * @return mixed
	 * @access public
	 */
	public function formDetail($fileControl, $uniqueID = '')
	{
		?>
		<div class="title">Pagos</div>
		<div class="content">
			<div class="fields movement">
			<?php
			$jsFields = array();
			$jsFields[] = '\'typePay\'';
			$jsFields[] = '\'amount\'';
			$jsFields[] = '\'discount\'';

			//Datos del formulario
			?>
			<div class="field">
				<label><?php echo CMOVEMENT_FORM_DETAIL_LABEL_FIELD_TYPE_PAY; ?> <span>*</span></label>
				<select name="movement_typePay" id="movement_typePay">
				<option value=""></option>
				<option value="cash" <?php if ($this->getTypePay() == 'cash') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cash'); ?></option>
				<option value="bank" <?php if ($this->getTypePay() == 'bank') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('bank'); ?></option>
				<?php
				/*
				<option value="credit" <?php if ($this->getTypePay() == 'credit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('credit'); ?></option>
				<option value="debit" <?php if ($this->getTypePay() == 'debit') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('debit'); ?></option>
				*/
				?>
				<option value="cta_cte" <?php if ($this->getTypePay() == 'cta_cte') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('cta_cte'); ?></option>
				<option value="mercado_pago" <?php if ($this->getTypePay() == 'mercado_pago') echo 'selected="selected"' ?>><?php echo $this->getValuesTypePay('mercado_pago'); ?></option>
				</select>
			</div>
			<div class="field">
				<label><?php echo CMOVEMENT_FORM_DETAIL_LABEL_FIELD_AMOUNT; ?> <span>*</span></label>
				<input name="movement_amount" id="movement_amount" value="" class="num" maxlength="255" type="text" />
			</div>
			<div class="field">
				<label><?php echo CMOVEMENT_FORM_DETAIL_LABEL_FIELD_DISCOUNT; ?></label>
				<input name="movement_discount" id="movement_discount" value="" class="num" maxlength="255" type="text" />
			</div>
			<div class="field">
				<label><?php echo CMOVEMENT_FORM_DETAIL_LABEL_FIELD_LEFT; ?></label>
				<span id="amount_left">0</span>
			</div>
		
		</div>
		<div class="buttons">
			<input type="button" name="movement_addButton" id="movement_addButton" value="<?php echo CMOVEMENT_FORM_DETAIL_ADD_BTN; ?>" onclick="addItem('<?php echo $fileControl; ?>', 'movement', new Array(<?php echo implode(',', $jsFields); ?>), '<?php echo $uniqueID; ?>', 'sumAllFields', new Array('.product_amount_table', '.pay_amount_table', '#amount_left'))" class="add" />
			<input type="button" name="movement_updateButton" id="movement_updateButton" value="<?php echo CMOVEMENT_FORM_DETAIL_UPDATE_BTN; ?>" onclick="updateItem('<?php echo $fileControl; ?>', 'movement', new Array(<?php echo implode(',', $jsFields); ?>), '<?php echo $uniqueID; ?>', 'sumAllFields', new Array('.product_amount_table', '.pay_amount_table', '#amount_left'))" class="update" style="display: none;" />
			<input type="button" name="movement_cancelButton" id="movement_cancelButton" value="<?php echo CMOVEMENT_FORM_DETAIL_CANCEL_BTN; ?>" onclick="cancelItemForm('movement', new Array(<?php echo implode(',', $jsFields); ?>))" class="cancel" style="display: none;" />
			<input name="movement_updateIndex" type="hidden" id="movement_updateIndex" value="" />
		</div>
		<div id="movement_detail" class="list">
		<?php
		$this->listDetail($fileControl, $uniqueID);
		?>
						</div>
					</div>
		<?php
	}

	/**
	 * Muestra en una tabla los items agregados de la relación con la tabla {@link Csale sale}
	 *
	 * Muestra en una tabla los items agregados de la relación con la tabla {@link Csale sale} mostrando los campos
	 * seteados en el parámetro $fields.
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
	 * - 'width'  : ancho que tiene la columna de ese campo (en la tabla que muestra el detalle)
	 * - 'strlen' : cantidad de caracteres que se van a mostrar de ese campo (en la tabla que muestra el detalle)
	 *
	 * El parámetro $update es un array asociativo con el siguiente formato:
	 * <code>
	 * <?php
	 * $update['image']      = 'img/update.png';
	 * $update['image-over'] = 'img/update-over.png';
	 * $update['image-head'] = 'img/update-head.png';
	 * $update['class']      = 'update';
	 * $update['title']      = 'Modificar';
	 * $update['width']      = '5%';
	 * ?>
	 * </code>
	 * - 'image'        : url de la imagen que se muestra en el link de la acción
	 * - 'image-over'   : url de la imagen que se muestra en el link de la acción, estado over
	 * - 'image-head'   : url de la imagen de la cabecera de la acción
	 * - 'class'        : clase css
	 * - 'title'        : title o alt del link de la acción
	 * - 'width'        : ancho que tiene la columna de la acción (en la tabla que muestra el detalle)
	 *
	 * El parámetro $delete es un array asociativo con el siguiente formato:
	 * <code>
	 * <?php
	 * $delete['image']      = 'img/delete.png';
	 * $delete['image-over'] = 'img/delete-over.png';
	 * $delete['image-head'] = 'img/delete-head.png';
	 * $delete['class']      = 'del';
	 * $delete['title']      = 'Eliminar';
	 * $delete['width']      = '5%';
	 * ?>
	 * </code>
	 * - 'image'        : url de la imagen que se muestra en el link de la acción
	 * - 'image-over'   : url de la imagen que se muestra en el link de la acción, estado over
	 * - 'image-head'   : url de la imagen de la cabecera de la acción
	 * - 'class'        : clase css
	 * - 'title'        : title o alt del link de la acción
	 * - 'width'        : ancho que tiene la columna de la acción (en la tabla que muestra el detalle)
	 *
	 * Ver también: {@link formDetail()}, {@link controlFormDetail()}
	 * @param string $fileControl url del archivo que realiza las validaciones correspondientes
	 * @param array $fields [opcional] contiene los campos que se van a mostrar
	 * @param array $update [opcional] contiene la configuración de la acción modificar ítem
	 * @param array $delete [opcional] contiene la configuración de la acción eliminar ítem
	 * @param string $uniqueID [optional] nombre de la variable de sesión
	 *
	 * @return mixed
	 * @access public
	 */
	public function listDetail($fileControl, $uniqueID = '')
	{
	    ?>
	    <div class="data">
		<div class="row header">
		    <?php
		    $headers = array();
		    $jsFields = array();

		    //Type Pay
		    ?>
		    <div class="col" style="width: 22%;"><div class="str"><?php echo altText(CMOVEMENT_FORM_DETAIL_HEAD_FIELD_TYPE_PAY, CMOVEMENT_FORM_DETAIL_HEAD_FIELD_TYPE_PAY); ?></div></div>
		    <?php
		    $headers['typePay'] = '<div class="str">'.altText(CMOVEMENT_FORM_DETAIL_HEAD_FIELD_TYPE_PAY, CMOVEMENT_FORM_DETAIL_HEAD_FIELD_TYPE_PAY).'</div>';
		    $jsFields[] = '\'typePay\'';

		    //Amount
		    ?>
		    <div class="col" style="width: 22%;"><div class="num"><?php echo altText(CMOVEMENT_FORM_DETAIL_HEAD_FIELD_AMOUNT, CMOVEMENT_FORM_DETAIL_HEAD_FIELD_AMOUNT); ?></div></div>
		    <?php
		    $headers['amount'] = '<div class="num">'.altText(CMOVEMENT_FORM_DETAIL_HEAD_FIELD_AMOUNT, CMOVEMENT_FORM_DETAIL_HEAD_FIELD_AMOUNT).'</div>';
		    $jsFields[] = '\'amount\'';

		    //Discount
		    ?>
		    <div class="col" style="width: 22%;"><div class="num"><?php echo altText(CMOVEMENT_FORM_DETAIL_HEAD_FIELD_DISCOUNT, CMOVEMENT_FORM_DETAIL_HEAD_FIELD_DISCOUNT); ?></div></div>
		    <?php
		    $headers['discount'] = '<div class="num">'.altText(CMOVEMENT_FORM_DETAIL_HEAD_FIELD_DISCOUNT, CMOVEMENT_FORM_DETAIL_HEAD_FIELD_DISCOUNT).'</div>';
		    $jsFields[] = '\'discount\'';

		    //TOTAL
		    ?>
		    <div class="col" style="width: 22%;"><div class="num"><?php echo altText(CMOVEMENT_FORM_DETAIL_HEAD_FIELD_TOTAL, CMOVEMENT_FORM_DETAIL_HEAD_FIELD_TOTAL); ?></div></div>
		    <?php
		    $headers['total'] = '<div class="num">'.altText(CMOVEMENT_FORM_DETAIL_HEAD_FIELD_TOTAL, CMOVEMENT_FORM_DETAIL_HEAD_FIELD_TOTAL).'</div>';
		    ?>
		    <div class="col" style="width: 6%;"><div class="action"></div></div>
		    <div class="col" style="width: 6%;"><div class="action"></div></div>
		    <div class="clear"></div>
		</div>
		<?php
		if (is_array($_SESSION[$uniqueID]) === TRUE)
		{
			$class = '1';

			$jsFields[] = '\'typePay\'';
			$jsFields[] = '\'amount\'';
			$jsFields[] = '\'discount\'';

			$TOTAL = 0;

			foreach ($_SESSION[$uniqueID] as $key => $item)
			{
			    $actionHead	    = '';
			    $actionsBtns    = '';

			    if(empty($item['amount']) == TRUE)
			    {
				$item['amount'] = 0;
			    }
			    if(empty($item['typePay']) == TRUE)
			    {
				$item['typePay'] = 0;
			    }
			    if(empty($item['discount']) == TRUE)
			    {
				$item['discount'] = 0;
			    }

			    //Amount
			    $this->setAmount($item['amount']);
			    $this->setTypePay($item['typePay']);
			    $this->setDiscount($item['discount']);

			    $aux    = $this->getAmount(FALSE) * ((100 - $this->getDiscount(FALSE)) / 100);
			    $total  = numberFormat($aux);

			    $TOTAL += $aux;


			    $auxDiscount = '';
			    if(empty($this->getDiscount(FALSE)) == FALSE)
			    {
				$auxDiscount = $this->getDiscount(FALSE).'%';
			    }

			    ?>
			    <div class="row row<?php echo $class; ?>">

				<div class="col header"><?php echo $headers['typePay']; ?></div>
				<div class="col" style="width: 22%;">
				    <input name="movement_typePay_<?php echo $key; ?>" type="hidden" id="movement_typePay_<?php echo $key; ?>" value="<?php echo $this->getTypePay(); ?>" />
				    <div class="str"><?php echo altText($this->getValuesTypePay($this->getTypePay()), $this->getValuesTypePay($this->getTypePay())); ?></div>
				</div>

				<div class="col header"><?php echo $headers['amount']; ?></div>
				<div class="col" style="width: 22%;">
				    <input name="movement_amount_<?php echo $key; ?>" type="hidden" id="movement_amount_<?php echo $key; ?>" value="<?php echo $this->getAmount(FALSE); ?>" />
				    <div class="num"><?php echo altText($this->getAmount(FALSE), $this->getAmount(FALSE)); ?></div>
				</div>

				<div class="col header"><?php echo $headers['discount']; ?></div>
				<div class="col" style="width: 22%;">
				    <input name="movement_discount_<?php echo $key; ?>" type="hidden" id="movement_discount_<?php echo $key; ?>" value="<?php echo $this->getDiscount(FALSE); ?>" />
				    <div class="num"><?php echo altText($auxDiscount, $auxDiscount); ?></div>
				</div>

				<div class="col header"><?php echo $headers['total']; ?></div>
				<div class="col" style="width: 22%;">
					<div class="num"><?php echo altText($total, $total); ?></div>
					<input type="hidden" value="<?php echo $this->getAmount(FALSE); ?>" class="pay_amount_table" \>
				</div>

				<div class="col action" style="width: 6%;"><div class="action"><a href="#" onclick="updateItemForm('movement', '<?php echo $key; ?>', new Array(<?php echo implode(',', $jsFields); ?>), '<?php echo $uniqueID; ?>'); return false;"><img src="img/update-head.png" title="Modificar pago" class="out" /><img src="img/update.png" title="Modificar pago" class="over" /></a></div></div>
				<?php
				$actionsBtns.= '<input type="button" value="" onclick="updateItemForm(\'movement\', \''.$key.'\', new Array('.implode(',', $jsFields).'), \''.$uniqueID.'\');" class="update" />';

				?>
				<div class="col action" style="width: 6%;"><div class="action"><a href="#" onclick="delItem('<?php echo $fileControl; ?>', 'movement', '<?php echo $key; ?>', '<?php echo $uniqueID; ?>', 'sumAllFields', new Array('.product_amount_table', '.pay_amount_table', '#amount_left')); return false;"><img src="img/delete-head.png" title="Eliminar pago" class="out" /><img src="img/delete.png" title="Eliminar pago" class="over" /></a></div></div>
				<?php
				$actionsBtns.= '<input type="button" value="" onclick="delItem(\''.$fileControl.'\', \'movement\', \''.$key.'\', \''.$uniqueID.'\', \'sumAllFields\', new Array(\'.product_amount_table\', \'.pay_amount_table\', \'#amount_left\'));" class="del" />';
				?>
				<div class="col header"><div class="action"></div></div>
				<div class="col action-vertical"><div class="action"><?php echo $actionsBtns; ?></div></div>
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
		}
		if($TOTAL > 0)
		{
		?>
		<div class="row rowTotal">
		    <div class="col header"><div class="num"><b><?php echo CMOVEMENT_FORM_DETAIL_HEAD_FIELD_TOTAL_TOTAL; ?></b></div></div>
		    <div class="col" style="width: 22%;"><div class="num noDisplayLg"><b><?php echo altText(numberFormat($TOTAL), numberFormat($TOTAL)); ?></b></div></div>

		    <div class="col header noDisplaySM">&nbsp;</div>
		    <div class="col noDisplaySM" style="width: 22%;">&nbsp;</div>

		    <div class="col header noDisplaySM">&nbsp;</div>
		    <div class="col noDisplaySM" style="width: 22%;">
			<div class="num"><b><?php echo CMOVEMENT_FORM_DETAIL_HEAD_FIELD_TOTAL_TOTAL; ?></b></div>
		    </div>

		    <div class="col header noDisplaySM">&nbsp;</div>
		    <div class="col noDisplaySM" style="width: 22%;">
			<div class="num"><b><?php echo altText(numberFormat($TOTAL), numberFormat($TOTAL)); ?></b></div>
		    </div>
		    <div class="clear"></div>
		</div>
		<?php
		}
		?>
	    </div>
		<?php
	}

	/**
	 * Realiza los controles necesarios de las acciones ejecutadas en la relación con la tabla {@link Csale sale}
	 *
	 * Realiza los controles necesarios de las acciones ejecutadas en la relación con la tabla {@link Csale sale}.
	 * Este método se utiliza en el archivo de control de la relación que se ejecuta mediante AJAX. Luego de realizar
	 * los controles se ejecuta el método {@link listDetail()}.
	 *
	 * El parámetro $action permite estos valores:
	 * - 'addItem'  : agregar un ítem
	 * - 'delItem'  : eliminar un ítem
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
	 * - 'width'  : ancho que tiene la columna de ese campo (en la tabla que muestra el detalle)
	 * - 'strlen' : cantidad de caracteres que se van a mostrar de ese campo (en la tabla que muestra el detalle)
	 *
	 * El parámetro $update es un array asociativo con el siguiente formato:
	 * <code>
	 * <?php
	 * $update['image']      = 'img/update.png';
	 * $update['image-over'] = 'img/update-over.png';
	 * $update['image-head'] = 'img/update-head.png';
	 * $update['class']      = 'update';
	 * $update['title']      = 'Modificar';
	 * $update['width']      = '5%';
	 * ?>
	 * </code>
	 * - 'image'        : url de la imagen que se muestra en el link de la acción
	 * - 'image-over'   : url de la imagen que se muestra en el link de la acción, estado over
	 * - 'image-head'   : url de la imagen de la cabecera de la acción
	 * - 'class'        : clase css
	 * - 'title'        : title o alt del link de la acción
	 * - 'width'        : ancho que tiene la columna de la acción (en la tabla que muestra el detalle)
	 *
	 * El parámetro $delete es un array asociativo con el siguiente formato:
	 * <code>
	 * <?php
	 * $delete['image']      = 'img/delete.png';
	 * $delete['image-over'] = 'img/delete-over.png';
	 * $delete['image-head'] = 'img/delete-head.png';
	 * $delete['class']      = 'del';
	 * $delete['title']      = 'Eliminar';
	 * $delete['width']      = '5%';
	 * ?>
	 * </code>
	 * - 'image'        : url de la imagen que se muestra en el link de la acción
	 * - 'image-over'   : url de la imagen que se muestra en el link de la acción, estado over
	 * - 'image-head'   : url de la imagen de la cabecera de la acción
	 * - 'class'        : clase css
	 * - 'title'        : title o alt del link de la acción
	 * - 'width'        : ancho que tiene la columna de la acción (en la tabla que muestra el detalle)
	 *
	 * Ver también: {@link formDetail()}, {@link listDetail()}
	 * @param string $action acción a realizar
	 * @param string $fileControl url del archivo que realiza las validaciones correspondientes
	 * @param array $fields [opcional] contiene los campos que se van a mostrar
	 * @param array $update [opcional] contiene la configuración de la acción modificar ítem
	 * @param array $delete [opcional] contiene la configuración de la acción eliminar ítem
	 * @param boolean $cleanForm [opcional] indica si se limpia el formulario luego de agregar un ítem
	 * @param string $uniqueID [opcional] nombre de la variable de sesión
	 *
	 * @return mixed
	 * @access public
	 */
	public function controlFormDetail($action, $fileControl, $cleanForm = FALSE, $uniqueID = '')
	{

		switch ($action)
		{
			case 'addItem':

			    $jsFields = array();

			    if(empty($_POST['typePay']) == TRUE)
			    {
				$this->addError(CMOVEMENT_CONTROL_FORM_SET_TYPE_PAY_REQUIRED_VALUE);
			    }

			    $this->setTypePay($_POST['typePay'], TRUE);
			    $addItem['typePay'] = $this->getTypePay(FALSE);
			    $jsFields[] = '\'typePay\'';

			    $this->setAmount($_POST['amount'], TRUE);
			    $addItem['amount'] = $this->getAmount(FALSE);
			    $jsFields[] = '\'amount\'';

			    $this->setDiscount($_POST['discount'], TRUE);
			    $addItem['discount'] = $this->getDiscount(FALSE);
			    $jsFields[] = '\'discount\'';


			    if ($this->error() === FALSE)
			    {
				if ($this->existItem($uniqueID) === TRUE)
				{
				    $this->addError(CMOVEMENT_CONTROL_FORM_DETAIL_EXIST_ITEM);
				}
				else
				{
				    $index = time().'-'.mt_rand();

				    $this->addItem($index, $addItem, $uniqueID);
				}
			    }

			    break;

			case 'updateItem':

			    $jsFields = array();

			    if(empty($_POST['typePay']) == TRUE)
			    {
				$this->addError(CMOVEMENT_CONTROL_FORM_SET_TYPE_PAY_REQUIRED_VALUE);
			    }

			    $this->setTypePay($_POST['typePay'], TRUE);
			    $updateItem['typePay'] = $this->getTypePay(FALSE);
			    $jsFields[] = '\'typePay\'';

			    $this->setAmount($_POST['amount'], TRUE);
			    $updateItem['amount'] = $this->getAmount(FALSE);
			    $jsFields[] = '\'amount\'';

			    $this->setDiscount($_POST['discount'], TRUE);
			    $updateItem['discount'] = $this->getDiscount(FALSE);
			    $jsFields[] = '\'discount\'';

			    if ($this->error() === FALSE)
			    {
				$index = $_POST['index'];

				if ($this->existItem($uniqueID, $index) === TRUE)
				{
					$this->addError(CMOVEMENT_CONTROL_FORM_DETAIL_EXIST_ITEM);
				}
				else
				{
					$this->updateItem($index, $updateItem, $uniqueID);
				}
			    }

			    break;

			case 'delItem':

				$this->delItem($_POST['index'], $uniqueID);

				$cleanForm = FALSE;

				break;
		}

		if ($this->error() === TRUE)
		{
			echo 'KO';
			?>
						<div class="fields">
							<div class="message error">
			<?php
			$this->showErrors();
			?>
							</div>
						</div>
			<?php
		}
		else
		{
			echo 'OK';
			if ($cleanForm === TRUE)
			{
				?>
				<script>
					cleanForm('movement', new Array(<?php echo implode(',', $jsFields); ?>));
				</script>
				<?php
			}
		}

		$this->listDetail($fileControl, $uniqueID);
	}

	/**
	 * Agrega un ítem a la variable de sesión correspondiente a este objeto
	 *
	 * Agrega un ítem a la variable de sesión correspondiente a este objeto. Los valores se toman del array asociativo
	 * $values que se pasa como parámetro. Los índices de este array tienen el mismo nombre que los índices del array
	 * que devuelve el método {@link getList()}.
	 *
	 * @param integer $index índice del array para identificar el ítem
	 * @param array $values array con los valores del ítem
	 * @param string $uniqueID nombre de la variable de sesión
	 *
	 * @return boolean
	 * @access public
	 */
	public function addItem($index, $values, $uniqueID)
	{
		if (is_array($values) === TRUE)
		{
		    if (isset($values['typePay']) === FALSE)
		    {
			$values['typePay'] = '';
		    }
		    if (isset($values['amount']) === FALSE)
		    {
			$values['amount'] = '';
		    }
		    if (isset($values['discount']) === FALSE)
		    {
			$values['discount'] = '';
		    }

			$_SESSION[$uniqueID][$index] = $values;

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Modifica un ítem de la variable de sesión correspondiente a este objeto
	 *
	 * Modifica un ítem de la variable de sesión correspondiente a este objeto. Los valores se toman del array asociativo
	 * $values que se pasa como parámetro. Los índices de este array tienen el mismo nombre que los índices del array
	 * que devuelve el método {@link getList()}.
	 *
	 * @param integer $index índice del array para identificar el ítem
	 * @param array $values array con los valores del ítem
	 * @param string $uniqueID nombre de la variable de sesión
	 *
	 * @return boolean
	 * @access public
	 */
	public function updateItem($index, $values, $uniqueID)
	{
		if (is_array($values) === TRUE)
		{
			if (isset($values['typePay']) === TRUE)
			{
				$_SESSION[$uniqueID][$index]['typePay'] = $values['typePay'];
			}

			if (isset($values['amount']) === TRUE)
			{
				$_SESSION[$uniqueID][$index]['amount'] = $values['amount'];
			}

			if (isset($values['discount']) === TRUE)
			{
				$_SESSION[$uniqueID][$index]['discount'] = $values['discount'];
			}

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Elimina un ítem de la variable de sesión correspondiente a este objeto
	 *
	 * @param integer $index índice del ítem a eliminar
	 * @param string $uniqueID nombre de la variable de sesión
	 *
	 * @return boolean
	 * @access public
	 */
	public function delItem($index, $uniqueID)
	{
		if (isset($_SESSION[$uniqueID]) === FALSE)
		{
			return FALSE;
		}
		else
		{
			if (is_array($_SESSION[$uniqueID]) === TRUE)
			{
				unset($_SESSION[$uniqueID][$index]);

				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}

	/**
	 * Verifica si ya existe en la variable de sesión el ítem por agregar
	 *
	 * Verifica si ya existe en la variable de sesión el ítem por agregar.
	 * Si en la variable se sesión existe un ítem que tenga el valor de los siguientes campos seteados:
	 * - {@link $idProduct Producto}
	 * el método devuelve TRUE.
	 *
	 * @param string $uniqueID nombre de la variable de sesión
	 * @param string $index Identificador (key) del array del valor que estoy modificando
	 *
	 * @return boolean
	 * @access public
	 */
	public function existItem($uniqueID, $index = '')
	{
		if (isset($_SESSION[$uniqueID]) === FALSE)
		{
			return FALSE;
		}
		else
		{
			if (is_array($_SESSION[$uniqueID]) === TRUE)
			{
				foreach ($_SESSION[$uniqueID] as $key => $item)
				{
					if ($item['typePay'] == $this->getTypePay(FALSE) and $index != $key)
					{
						return TRUE;
					}
				}

				return FALSE;
			}
			else
			{
				return FALSE;
			}
		}
	}

	/**
	 * Controla que se haya cargado al menos un ítem en el detalle
	 *
	 * @param string $uniqueID nombre de la variable de sesión
	 *
	 * @return boolean
	 * @access public
	 */
	public function validateRequiredDetail($uniqueID)
	{
		if (isset($_SESSION[$uniqueID]) === FALSE)
		{
			return FALSE;
		}
		else
		{
			if (is_array($_SESSION[$uniqueID]) === TRUE and count($_SESSION[$uniqueID]) > 0)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}

	/**
	 * Inserta los registros en la tabla detail
	 *
	 * Este método inserta en la tabla detail los items de la relación con la tabla {@link Csale sale}.
	 *
	 * Ver también: {@link formDetail()}
	 * @param date $dateAddedSale fecha de la venta
	 * @param $idCliente ID del cliente que realizó la compra
	 * @param string $uniqueID [opcional] nombre de la variable de sesión
	 *
	 * @return boolean
	 * @access public
	 *
	 * NOTA: En la venta no se bien qué parte de cada movimiento es del producto por eso no guardo ni el producto ni el proveedor.
	 */
	public function addDetail($dateAddedSale, $idClient = 0, $uniqueID = '')
	{
		if (validateRequiredValue($this->idSale) === TRUE and validateRequiredValue($dateAddedSale) === TRUE)
		{
			if (is_array($_SESSION[$uniqueID]) === TRUE)
			{
				foreach ($_SESSION[$uniqueID] as $item)
				{
					$this->setTypePay($item['typePay']);
					$this->setAmount($item['amount']);
					$this->setDiscount($item['discount']);
					$this->setIdUserAdd($_SESSION['userId']);
					$this->setDateAdded($dateAddedSale, TRUE);

					$this->setDescription(CMOVEMENT_ADD_DETAIL_MOVEMENT_DESCRIPTION.' '.$this->getIdSale(FALSE));
					$this->setTypeMovement('sale');
					$this->autoSetType();

					if($idClient > 0)
					{
					    $this->setIdClient($idClient);
					}

					if ($this->error() === FALSE)
					{
					    $this->add();
					}
				}

				$_SESSION[$uniqueID] = array();

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

	/**
	 * Actualiza los registros en la tabla detail
	 *
	 * Este método actualiza en la tabla detail los items de la relación con la tabla {@link Csale sale}.
	 *
	 * Ver también: {@link formDetail()}
	 * @param date $dateAddedSale fecha de la venta
	 * @param array $fields [opcional] contiene los campos que se mostraron en el formulario
	 * @param string $uniqueID [opcional] nombre de la variable de sesión
	 *
	 * @return boolean
	 * @access public
	 */
	public function updateDetail($dateAddedSale = '', $idClient = 0, $uniqueID = '')
	{
		if (validateRequiredValue($this->idSale) === TRUE and validateRequiredValue($dateAddedSale) === TRUE)
		{
			$auxIdSale = $this->idSale;

			$search  = $this->getFieldSql('id_sale', $this->getTableName()).' = '.$this->getValueSql($this->idSale);
			$rs	     = $this->getList($search, 0, 0, '', FALSE);

			$this->idSale = $auxIdSale;

			$return = FALSE;

			if ($this->getTotalList() > 0)
			{
				foreach ($rs as $row)
				{
					$values[0]['value'] = $row['id'];
					$values[0]['field'] = 'id';

					if (isInArray($_SESSION[$uniqueID], $values) === FALSE)
					{
						$this->setId($row['id']);
						$this->del();
					}
				}

				$return = TRUE;
			}

			if (is_array($_SESSION[$uniqueID]) === TRUE)
			{
				foreach ($_SESSION[$uniqueID] as $item)
				{
				    if(empty($item['id']) == TRUE)
				    {
					   $item['id'] = 0;
				    }
				    $this->setTypePay($item['typePay']);
				    $this->setAmount($item['amount']);
				    $this->setDiscount($item['discount']);
				    $this->setDescription(CMOVEMENT_UPDATE_DETAIL_MOVEMENT_DESCRIPTION.' '.$this->getIdSale(FALSE));

				    $this->setDateAdded($dateAddedSale, TRUE);
				    $this->setTypeMovement('sale');
				    $this->setType('in');

				    if($idClient > 0)
				    {
					   $this->setIdClient($idClient);
				    }

				    $values[0]['value'] = $item['id'];
				    $values[0]['field'] = 'id';

				    if ($item['id'] > 0 and isInArray($rs, $values) === TRUE)
				    {
    					$this->setId($item['id']);
    					$this->update();
				    }
				    else
				    {
    					unset($this->id);
    					$this->add();
				    }
				}

				$_SESSION[$uniqueID] = array();

				$return = TRUE;
			}

			return $return;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Elimina los registros en la tabla detail
	 *
	 * Este método elimina en la tabla detail los items de la relación con la tabla {@link Csale sale}.
	 *
	 * @return boolean
	 * @access public
	 */
	public function delDetail()
	{
		if (validateRequiredValue($this->idSale) === TRUE)
		{
			$sql = 'DELETE FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_sale').' = '.$this->getValueSql($this->idSale);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CDETAIL_DEL_DETAIL_ERROR);

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
	 * Agrega los ítems a la variable de sesión correspondiente a este objeto
	 *
	 * Ver también: {@link formDetail()}
	 * @param string $uniqueID nombre de la variable de sesión
	 *
	 * @return boolean
	 * @access public
	 */
	public function loadDetail($uniqueID)
	{
		if (validateRequiredValue($this->idSale) === TRUE)
		{
		    $search = $this->getFieldSql('id_sale', $this->getTableName()).' = '.$this->getValueSql($this->idSale).' AND ('.$this->getFieldSql('id_refund', $this->getTableName()).' = '.$this->getValueSql(0).' OR '.$this->getFieldSql('id_refund', $this->getTableName()).' IS NULL)';
			$order	= $this->getFieldSql('id_sale', $this->getTableName()).' ASC';
			$rs	= $this->getList($search, 0, 0, $order, FALSE);

			if ($this->getTotalList() > 0)
			{
				foreach ($rs as $item)
				{
					$index = $item['id'];

					$this->addItem($index, $item, $uniqueID);
				}
			}

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function getTotalAmount($uniqueID)
	{
	    if (empty($uniqueID) == FALSE and is_array($_SESSION[$uniqueID]) === TRUE)
	    {
		$sumTotalGross	= 0;
		$sumTotalNet	= 0;
		foreach($_SESSION[$uniqueID] as $item)
		{
		    if(empty($item['discount']) == TRUE)
		    {
			$item['discount'] = 0;
		    }
		    $sumTotalGross += $item['amount'];

		    $sumTotalNet += $item['amount'] * ((100 - $item['discount'])/100);
		}

		return array($sumTotalGross, $sumTotalNet);
	    }
	}

	/**
	 * Me dice si un registro de la tabla categoria puede ser eliminado
	 *
	 * Este método me dice si un registro de la tabla puede ser eliminado porque existe una relación de la misma con las siguientes tablas:
	 * - {@link Cproducto producto}
	 *
	 * Si existe al menos un registro que tenga el valor de la clave primaria que se quiere eliminar en los siguientes campos:
	 * - campo {@link Cproducto::$idCategoria idCategoria} de la tabla {@link Cproducto producto}
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
			$this->getData();

			if ($this->getTypeMovement() == 'sale')
			{
				$this->addError(CMOVEMENT_CAN_DELETE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CMOVEMENT_CAN_DELETE_REQUIRED_PK);

			return FALSE;
		}
	}

	public function payProductsForm($fields = '', $href = '', $autoRedirect = FALSE, $title = '')
	{
		if (validateRequiredValue($fields) === FALSE)
		{
			$fields = 'id,dateAdded,amount,idClient,idSale,description,typePay,typeMovement,idUserAdd,type,idProvider,discount';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['id']) === FALSE)
		{
		    $_POST['id'] = '';
		}
		if (isset($_POST['addMovement']) === FALSE)
		{
			$_POST['addMovement'] = '';
		}

		if ($_POST['addMovement'] == 'add')
		{
		    $this->setDateAdded($_POST['dateAdded'], FALSE);
		    $this->setTypeMovement('payment_to_provider');
		    $this->setDescription(CMOVEMENT_PAY_PRODUCT_FORM_MOVEMENT_DESCRIPTION);
		    $this->setIdUserAdd($_SESSION['userId'], TRUE);


            /**
             * CONTROLES
             */
		    if(empty($_POST['idProvider']) == TRUE)
		    {
                $this->addError(CMOVEMENT_PAY_PRODUCT_FORM_REQUIRED_VALUE);
		    }
		    else
		    {
                $this->setIdProvider($_POST['idProvider'], TRUE);
		    }

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
		        $this->addError(CMOVEMENT_PAY_PRODUCT_FORM_REQUIRED_ITEM);
		    }


		    if ($this->error() === FALSE)
		    {
		        $payment = new Cpayment($this->getDbConn());
		        $product = new Cproduct($this->getDbConn());

		        $amountPayed  = 0;
		        $amountBack   = 0;
		        $idPayment    = NULL;

		        $payment->setIdProvider($_POST['idProvider'], TRUE);
		        $payment->setDateAdded($_POST['dateAdded'], FALSE);
		        $payment->setIdUserAdd($_SESSION['userId'], TRUE);

		        if($payment->error() === FALSE)
		        {
		            $payment->add();

		            $idPayment = $payment->getLastId();
		        }

    			//Productos devueltos
    			if(isset($_POST['productsBackGroup']) == TRUE and is_array($_POST['productsBackGroup']) == TRUE and count($_POST['productsBackGroup']) > 0)
    			{
    			    foreach($_POST['productsBackGroup'] as $val)
    			    {
        				$product->setId($val);
        				if($product->getData() == TRUE)
        				{
        				    $product->setStatus('returned');

        				    $product->update();

        				    $amountBack++;

        				    $detailPayment = new Cdetail_payment($this->getDbConn());
        				    $detailPayment->setIdPayment($idPayment);
        				    $detailPayment->setIdProduct($product->getId(FALSE));
        				    $detailPayment->setType('give_back');
        				    $detailPayment->add();
        				}
    			    }
    			}
    			$payment->setTotalAmountBack($amountBack);

    			//Productos pagos
    			if(isset($_POST['productsPayGroup']) == TRUE and is_array($_POST['productsPayGroup']) == TRUE and count($_POST['productsPayGroup']) > 0)
    			{
    			    foreach($_POST['productsPayGroup'] as $val)
    			    {
        				$product->setId($val);
        				if($product->getData() == TRUE)
        				{
        				    $product->setStatus('paid_out');

        				    $product->update();

        				    $amountPayed++;

        				    $detailPayment = new Cdetail_payment($this->getDbConn());
        				    $detailPayment->setIdPayment($idPayment);
        				    $detailPayment->setIdProduct($product->getId(FALSE));
        				    $detailPayment->setType('payed');
        				    $detailPayment->add();
        				}
    			    }
    			}
    			$payment->setTotalAmountPay($amountPayed);

    			//Agrego los movimientos
    			if(empty($_POST['type_pay']) == FALSE and ($_POST['total_cash'] > 0 or $_POST['total_cta_cte'] > 0))
    			{
    			    if($_POST['type_pay'] == 'cash' and $_POST['total_cash'] > 0)
    			    {
    				    $this->setAmount($_POST['total_cash']);
    				    $this->setTypePay('cash');
    			    }
    			    elseif($_POST['type_pay'] == 'cta_cte' and $_POST['total_cta_cte'] > 0)
    			    {
    				    $this->setAmount($_POST['total_cta_cte']);
    				    $this->setTypePay('cta_cte');
    			    }
    			    $this->autoSetType();
    			}

    			if ($this->error() === FALSE)
    			{
    			    $this->add();

    			    if($payment->error() === FALSE)
    			    {
    			        $payment->update();
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
				<form name="formAddMovement" id="formAddMovement" method="post" action="">
				<input name="addMovement" type="hidden" id="addMovement" value="back" />
				<div class="fields">
				    <?php
				    echo '<input name="dateAdded" type="hidden" id="dateAdded" value="'.$this->getDateAdded().'" />';
				    echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';
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
			if ($_POST['addMovement'] == 'back')
			{
			    $this->setDateAdded($_POST['dateAdded'], FALSE);
			    $this->setIdProvider($_POST['idProvider'], TRUE);
			}
			else
			{
			    if(empty($_POST['dateAdded']) == TRUE)
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
				<form name="formAddMovement" id="formAddMovement" method="post" action="">
				<input name="addMovement" type="hidden" id="addMovement" value="add" />
				<div class="fields">

				    <div class="field">
					    <label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_DATE_ADDED; ?> <span>*</span></label>
					    <input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
				    </div>
				    <?php
				    $auxIdProvider = TRUE;
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
    					<label><?php echo CMOVEMENT_ADD_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
    					<input name="idProviderAutocomplete" id="idProviderAutocomplete" value="<?php echo $auxProviderName; ?>" class="str autocomplete" maxlength="255" type="text" />
    					<input name="idProvider" id="idProvider" value="<?php echo $this->getIdProvider(FALSE); ?>" type="hidden" />
				    </div>
				</div>
				<input type="hidden" id="orderHidden" value="" />
				<input type="hidden" id="ascDescHidden" value="<?php echo $_GET['ascdesc']; ?>" />
				<div id="providerProductList"></div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CMOVEMENT_ADD_FORM_SUBMIT_BTN; ?>" class="accept" />
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CMOVEMENT_ADD_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
			<?php
			}
			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CMOVEMENT_ADD_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Devuelve lo que debe o se le debe al proveedor/cliente
	 *
	 * @param int $idProvider
	 * @return boolean
	 */
	public function getProviderStatus($idProvider)
	{
	    if (validateRequiredValue($idProvider) === TRUE)
	    {
    		$TOTAL = $this->getTOTAL('', '', 'cta_cte', $idProvider);

    		return $TOTAL[2];
	    }
	    else
	    {
    		$this->addError(CMOVEMENT_SHOW_PROVIDER_STATUS_REQUIRED_ID_PROVIDER);

    		return FALSE;
	    }

	}

	/**
	 * Calcula el monto con el descuento
	 *
	 * @param float $amount Monto de dinero
	 * @param int $discount Monto del descuento
	 *
	 * @return float
	 */
	public function getRealAmount($amount = 0, $discount = 0)
	{
	    $res = 0;
	    if($discount != 0)
	    {
            $res = $amount * ((100 - $discount) / 100);
	    }
	    else
	    {
            $res = $amount;
	    }

	    return $res;
	}

	/**
	 * Controla que se haya cargado al menos un ítem en el detalle
	 *
	 * @param string $uniqueID nombre de la variable de sesión
	 *
	 * @return boolean
	 * @access public
	 */
	public function validateDataDetail($uniqueID, $idClient)
	{
		if (isset($_SESSION[$uniqueID]) === FALSE)
		{
			return TRUE;
		}
		else
		{
			if (is_array($_SESSION[$uniqueID]) === TRUE and count($_SESSION[$uniqueID]) > 0)
			{
			    foreach ($_SESSION[$uniqueID] as $val)
			    {
				if($val['typePay'] == 'cta_cte' and empty($idClient) == TRUE)
				{
				    return FALSE;
				}
			    }
			}
			else
			{
				return TRUE;
			}
		}
	}

	/**
	 * Reporte de estado de caja
	 */
	public function reportCashFlow()
	{
	    $filterName = 'filterDate';

	    if(empty($_POST[$filterName.'From']) == TRUE)
	    {
		//$_POST[$filterName.'From'] = date(FORMAT_DATE, mktime(0, 0, 0, date("m")-1, 1));
		$_POST[$filterName.'From'] = '';
	    }
	    if(empty($_POST[$filterName.'To']) == TRUE)
	    {
		//$_POST[$filterName.'To'] = date('t-m-Y', mktime(0, 0, 0, date("m")-1, 1));
		$_POST[$filterName.'To'] = '';
	    }
	    ?>
	    <div class="form">
	        <div class="aux"></div>
		    <div class="title">
			<div class="ico"><a href="#"></a></div>
			    <div class="label"><?php echo CMOVEMENT_REPORT_CASH_FLOW_TABLE_TITLE; ?></div>
		    </div>
		    <div class="top"></div>
		    <form name="formCashFlow" id="formCashFlow" method="post" action="">
			<div class="fields">
			    <div class="field">
				<label><?php echo CMOVEMENT_REPORT_CASH_FLOW_FILTER_DATE; ?> <span>*</span></label>

				<?php dateFields($filterName, $this->getDbConn()->fmtDate, $_POST[$filterName.'From'], $_POST[$filterName.'To']); ?>

				<input type="submit" value="<?php echo CMOVEMENT_REPORT_CASH_FLOW_FILTER_BTN; ?>" class="search extraSpace" />
			    </div>
			    <?php
			    $product	= new Cproduct($this->getDbConn());

			    $efvo	= $this->getTOTAL($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'cash');
			    $ctaCte	= $this->getTOTAL($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'cta_cte');
			    $prodVto	= $product->getProviderStatus(NULL, $_POST[$filterName.'From'], $_POST[$filterName.'To']);
			    $bank	= $this->getTOTAL($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'bank');
			    $creditCard = $this->getTOTAL($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'credit');
			    $debitCard	= $this->getTOTAL($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'debit');
			    $mercadoPago= $this->getTOTAL($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'mercado_pago');
			    ?>
			    <div class="reportRow">
				<div class="left">
				    <h2>Efectivo</h2>
				    <div class="num">$ <?php echo numberFormat($efvo[2]); ?></div>
				</div>
				<div class="left">
				    <h2>Cuenta Corriente</h2>
				    <div class="num">$ <?php echo numberFormat($ctaCte[2]); ?></div>
				</div>
				<div class="left">
				    <h2>Mercado Pago</h2>
				    <div class="num">$ <?php echo numberFormat($mercadoPago[2]); ?></div>
				</div>
				<div class="clear"></div>


				<div class="left">
				    <h2>Banco</h2>
				    <div class="num">$ <?php echo numberFormat($bank[2]); ?></div>
				</div>
				<div class="left">
				    <h2>Productos a Pagar</h2>
				    <div class="num2">$ <?php echo numberFormat($prodVto[0]); ?> (efvo) / $ <?php echo numberFormat($prodVto[1]); ?> (cta cte)</div>
				</div>
				<?php /*?>
				<div class="left">
				    <h2>Productos a Vencer</h2>
				    <div class="num2">$ <?php echo numberFormat($prodVto[2]); ?> (efvo) / $ <?php echo numberFormat($prodVto[3]); ?> (cta cte)</div>
				</div>
				<div class="clear"></div>
<?php */?>
				<div class="left">
				    <h2>Tarjeta de Crédito</h2>
				    <div class="num">$ <?php echo numberFormat($creditCard[2]); ?></div>
				</div>
				<div class="left">
				    <h2>Tarjeta de Débito</h2>
				    <div class="num">$ <?php echo numberFormat($debitCard[2]);
				    ?></div>
				</div>
				<div class="clear"></div>
			    </div>

			</div>
			<div class="middle"></div>
			<div class="buttons">
			    <input type="submit" value="BORRAR" class="accept" />
			</div>
		    </form>
		    <div class="bottom"></div>
		    <span class="required">* Requeridos</span>
	    </div>
	    <?php
	}

	/**
	 * Reporte de estado de caja
	 */
	public function reportExpenditure()
	{
	    $filterName = 'filterDate';

	    if(empty($_POST[$filterName.'From']) == TRUE)
	    {
		//$_POST[$filterName.'From'] = date(FORMAT_DATE, mktime(0, 0, 0, date("m")-1, 1));
		$_POST[$filterName.'From'] = '';
	    }
	    if(empty($_POST[$filterName.'To']) == TRUE)
	    {
		//$_POST[$filterName.'To'] = date('t-m-Y', mktime(0, 0, 0, date("m")-1, 1));
		$_POST[$filterName.'To'] = '';
	    }
	    ?>
	    <div class="form">
	        <div class="aux"></div>
		    <div class="title">
			<div class="ico"><a href="#"></a></div>
			    <div class="label"><?php echo CMOVEMENT_REPORT_CASH_FLOW_TABLE_TITLE; ?></div>
		    </div>
		    <div class="top"></div>
		    <form name="formCashFlow" id="formCashFlow" method="post" action="">
			<div class="fields">
			    <div class="field">
				<label><?php echo CMOVEMENT_REPORT_CASH_FLOW_FILTER_DATE; ?> <span>*</span></label>

				<?php dateFields($filterName, $this->getDbConn()->fmtDate, $_POST[$filterName.'From'], $_POST[$filterName.'To']); ?>

				<input type="submit" value="<?php echo CMOVEMENT_REPORT_CASH_FLOW_FILTER_BTN; ?>" class="search extraSpace" />
			    </div>
			    <?php
			    $product	= new Cproduct($this->getDbConn());

			    //'box_in','box_out','expenditure','sale','cta_cte_pay','partner_take_off','payment_to_provider','investment'

			    $boxIn	= $this->getTOTALByTypeMovement($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'box_in');
			    $boxOut	= $this->getTOTALByTypeMovement($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'box_out');
			    $expenditure= $this->getTOTALByTypeMovement($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'expenditure');
			    $sale	= $this->getTOTALByTypeMovement($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'sale');
			    $partner	= $this->getTOTALByTypeMovement($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'partner_take_off');
			    $ctaCtePay	= $this->getTOTALByTypeMovement($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'cta_cte_pay');
			    $ProviderPay= $this->getTOTALByTypeMovement($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'payment_to_provider');
			    $investment	= $this->getTOTALByTypeMovement($_POST[$filterName.'From'], $_POST[$filterName.'To'], 'investment');
			    ?>
			    <div class="reportRow">
				<div class="left">
				    <h2>Ingresos de caja</h2>
				    <div class="num">$ <?php echo numberFormat($boxIn[2]); ?></div>
				</div>
				<div class="left">
				    <h2>Egresos de Caja</h2>
				    <div class="num">$ <?php echo numberFormat($boxOut[2]); ?></div>
				</div>
				<div class="left">
				    <h2>Gastos</h2>
				    <div class="num">$ <?php echo numberFormat($expenditure[2]); ?></div>
				</div>
				<div class="clear"></div>


				<div class="left">
				    <h2>Ventas</h2>
				    <div class="num">$ <?php echo numberFormat($sale[2]); ?></div>
				</div>
				<div class="left">
				    <h2>Retiro de Socio</h2>
				    <div class="num">$ <?php echo numberFormat($partner[2]); ?></div>
				</div>
				<div class="left">
				    <h2>Pagos de Cta. Cte.</h2>
				    <div class="num">$ <?php echo numberFormat($ctaCtePay[2]); ?></div>
				</div>
				<div class="clear"></div>

				<div class="left">
				    <h2>Pagos a Proveedores</h2>
				    <div class="num">$ <?php echo numberFormat($ProviderPay[2]); ?></div>
				</div>
				<div class="left">
				    <h2>Inversiones</h2>
				    <div class="num">$ <?php echo numberFormat($investment[2]);
				    ?></div>
				</div>
				<div class="clear"></div>
			    </div>

			</div>
			<div class="middle"></div>
			<div class="buttons">
			    <input type="submit" value="BORRAR" class="accept" />
			</div>
		    </form>
		    <div class="bottom"></div>
		    <span class="required">* Requeridos</span>
	    </div>
	    <?php
	}

	/**
	 * Calcula los totales según los tipos de pagos (type_pay)
	 *
	 * @param date $dateStart Fecha inicio en formato de lectura
	 * @param date $dateEnd Fecha fin en formato de lectura
	 * @param string $typePay Para filtrar por tipo de pago ('cash','bank','credit','debit','cta_cte')
	 * @param int $idProvider ID del proveedor
	 *
	 * @return array Devuleve el total de ingresos, egresos y la sumatoria
	 */
	public function getTOTAL($dateStart = '', $dateEnd = '', $typePay = '', $idProvider = 0)
	{
	    $totalIn	= 0;
	    $totalOut	= 0;
	    $TOTAL	= 0;
	    $search	= '';
	    $aux	= '';

	    $auxDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);

	    if(empty($idProvider) == FALSE)
	    {
    		$search .= $aux.'('.$this->getFieldSql('id_client', $this->getTableName()).' = '.$this->getValueSql($idProvider).' OR '.$this->getFieldSql('id_provider', $this->getTableName()).' = '.$this->getValueSql($idProvider).')';

    		$aux = ' AND ';
	    }
	    if(empty($dateStart) == FALSE)
	    {
    		$auxDate->setStrDate($dateStart);
    		$search .= $aux.$this->getFieldSql('date_added', $this->getTableName()).' >= '.$this->getValueSql($auxDate->getDbDate());

    		$aux = ' AND ';
	    }
	    if(empty($dateEnd) == FALSE)
	    {
    		$auxDate->setStrDate($dateEnd);
    		$search .= $aux.$this->getFieldSql('date_added', $this->getTableName()).' <= '.$this->getValueSql($auxDate->getDbDate());

    		$aux = ' AND ';
	    }

	    if($typePay == 'cta_cte')
	    {
    		//echo $search .= $aux.'('.$this->getFieldSql('type_movement', $this->getTableName()).' = '.$this->getValueSql('payment_to_provider').' OR '.$this->getFieldSql('type_pay', $this->getTableName()).' = '.$this->getValueSql($typePay).' OR '.$this->getFieldSql('type_movement', $this->getTableName()).' = '.$this->getValueSql('cta_cte_pay').')';
    		$search .= $aux.'('.$this->getFieldSql('type_pay', $this->getTableName()).' = '.$this->getValueSql($typePay).' OR '.$this->getFieldSql('type_movement', $this->getTableName()).' = '.$this->getValueSql('cta_cte_pay').')';

    		$aux = ' AND ';
	    }
	    else
	    {
    		if(empty($typePay) == FALSE)
    		{
    		    $search .= $aux.$this->getFieldSql('type_pay', $this->getTableName()).' = '.$this->getValueSql($typePay);

    		    $aux = ' AND ';
    		}
	    }
	    $list   = $this->getList($search, 0, 0, '');

	    if($list != FALSE)
	    {
		if(is_array($list) == TRUE and count($list) > 0)
		{
		    foreach ($list as $row)
		    {
    			if($row['typeMovement'] == 'cta_cte_pay' and $typePay == 'cta_cte')
    			{
    			    if($row['type'] == 'out')
    			    {
    				    $totalIn += $this->getRealAmount($row['amount'], $row['discount']);
    			    }
    			    elseif($row['type'] == 'in')
    			    {
    				    $totalOut += $this->getRealAmount($row['amount'], $row['discount']);
    			    }
    			}
    			else
    			{
    			    if($row['type'] == 'in')
    			    {
    				    $totalIn += $this->getRealAmount($row['amount'], $row['discount']);
    			    }
    			    elseif($row['type'] == 'out')
    			    {
    				    $totalOut += $this->getRealAmount($row['amount'], $row['discount']);
    			    }
    			}
		    }
		}

		$TOTAL  = $totalIn - $totalOut;

	    }

	    return array ($totalIn, $totalOut, $TOTAL);
	}

	/**
	 * Calcula los totales segun el tipo de movimiento (type_movement)
	 *
	 * @param date $dateStart Fecha inicio en formato de lectura
	 * @param date $dateEnd Fecha fin en formato de lectura
	 * @param string $typeMovement Para filtrar por tipo de pago ('box_in','box_out','expenditure','sale','cta_cte_pay','partner_take_off','payment_to_provider','investment')
	 * @param int $idProvider ID del proveedor
	 *
	 * @return array Devuleve el total de ingresos, egresos y la sumatoria
	 */
	public function getTOTALByTypeMovement($dateStart = '', $dateEnd = '', $typeMovement = '', $idProvider = 0)
	{
	    $totalIn	= 0;
	    $totalOut	= 0;
	    $TOTAL	= 0;
	    $search	= '';
	    $aux	= '';

	    $auxDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);

	    if(empty($idProvider) == FALSE)
	    {
    		$search .= $aux.'('.$this->getFieldSql('id_client', $this->getTableName()).' = '.$this->getValueSql($idProvider).' OR '.$this->getFieldSql('id_provider', $this->getTableName()).' = '.$this->getValueSql($idProvider).')';

    		$aux = ' AND ';
	    }
	    if(empty($dateStart) == FALSE)
	    {
    		$auxDate->setStrDate($dateStart);
    		$search .= $aux.$this->getFieldSql('date_added', $this->getTableName()).' >= '.$this->getValueSql($auxDate->getDbDate());

    		$aux = ' AND ';
	    }
	    if(empty($dateEnd) == FALSE)
	    {
    		$auxDate->setStrDate($dateEnd);
    		$search .= $aux.$this->getFieldSql('date_added', $this->getTableName()).' <= '.$this->getValueSql($auxDate->getDbDate());

    		$aux = ' AND ';
	    }

	    /*if($typePay == 'cta_cte')
	    {
		$search .= $aux.'('.$this->getFieldSql('type_movement', $this->getTableName()).' = '.$this->getValueSql('payment_to_provider').' OR '.$this->getFieldSql('type_pay', $this->getTableName()).' = '.$this->getValueSql($typePay).' OR '.$this->getFieldSql('type_movement', $this->getTableName()).' = '.$this->getValueSql('cta_cte_pay').')';


		$aux = ' AND ';
	    }
	    else
	    {*/
		if(empty($typeMovement) == FALSE)
		{
		    $search .= $aux.$this->getFieldSql('type_movement', $this->getTableName()).' = '.$this->getValueSql($typeMovement);

		    $aux = ' AND ';
		}
	    //}
	    $list   = $this->getList($search, 0, 0, '');

	    if($list != FALSE)
	    {
		if(is_array($list) == TRUE and count($list) > 0)
		{
		    foreach ($list as $row)
		    {
		        if(empty($row['amount']) == TRUE)
		        {
		          continue;
		        }
    	        if(empty($row['discount']) == TRUE)
    	        {
    	            $row['discount'] = 0;
    	        }

    		    if($row['type'] == 'in')
    		    {
    			    $totalIn += $this->getRealAmount($row['amount'], $row['discount']);
    		    }
    		    elseif($row['type'] == 'out')
    		    {
    			    $totalOut += $this->getRealAmount($row['amount'], $row['discount']);
    		    }
		    }
		}

		$TOTAL  = $totalIn - $totalOut;

	    }

	    return array ($totalIn, $totalOut, $TOTAL);
	}


	/**
	 * Pone el in o out en base al type_movement
	 * @return boolean
	 */
	public function autoSetType()
	{
	    if(empty($this->getTypeMovement(FALSE)) == TRUE)
	    {
		return FALSE;
	    }
	    else
	    {
    		//'box_in','box_out','expenditure','sale','cta_cte_pay','partner_take_off','payment_to_provider','investment'
    		if($this->getTypeMovement(FALSE) == 'sale')
    		{
    		    $this->setType('in');
    		}
    		elseif($this->getTypeMovement(FALSE) == 'payment_to_provider')
    		{
    		    $this->setType('out');
    		}
    		elseif($this->getTypeMovement(FALSE) == 'expenditure')
    		{
    		    $this->setType('out');
    		}
    		elseif($this->getTypeMovement(FALSE) == 'box_in')
    		{
    		    $this->setType('in');
    		}
    		elseif($this->getTypeMovement(FALSE) == 'box_out')
    		{
    		    $this->setType('out');
    		}
    		elseif($this->getTypeMovement(FALSE) == 'cta_cte_pay')
    		{
    		    $this->setType('in');
    		}
    		elseif($this->getTypeMovement(FALSE) == 'partner_take_off')
    		{
    		    $this->setType('out');
    		}
    		elseif($this->getTypeMovement(FALSE) == 'investment')
    		{
    		    $this->setType('out');
    		}
    		elseif($this->getTypeMovement(FALSE) == 'add_cta_cte')
    		{
    		    $this->setType('out');
    		}
    		elseif($this->getTypeMovement(FALSE) == 'del_cta_cte')
    		{
    		    $this->setType('in');
    		}
	    }
	}

	/**
	 * Muestra las ctas ctes
	 */
	public function reportCtaCte()
	{
	    $filterName = 'filterDate';
	    $filter	= '';

	    $auxDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);

	    if(empty($_POST[$filterName.'From']) == TRUE)
	    {
    		//$_POST[$filterName.'From'] = date(FORMAT_DATE, mktime(0, 0, 0, date("m")-1, 1));
    		$_POST[$filterName.'From'] = '';
	    }
	    else
	    {
    		$auxDate->setStrDate($_POST[$filterName.'From']);
    		$filter .= ' AND '.$this->getFieldSql('fecha').' >='.$this->getValueSql($auxDate->getDbDate());
	    }
	    if(empty($_POST[$filterName.'To']) == TRUE)
	    {
    		//$_POST[$filterName.'To'] = date('t-m-Y', mktime(0, 0, 0, date("m")-1, 1));
    		$_POST[$filterName.'To'] = '';
	    }
	    else
	    {
    		$auxDate->setStrDate($_POST[$filterName.'To']);
    		$filter .= ' AND '.$this->getFieldSql('fecha').' <='.$this->getValueSql($auxDate->getDbDate());
	    }

	    $realAmount = 'IF(discount = 0, amount, (amount - (discount * amount) / 100))';

	    $amountIn	= 'SUM(IF('.$this->getFieldSql('type', 't1').'="in" AND '.$this->getFieldSql('type_pay', 't1').'="cta_cte", '.$realAmount.', 0))';
	    $amountOut	='SUM(IF('.$this->getFieldSql('type', 't1').'="out" AND '.$this->getFieldSql('type_pay', 't1').'="cta_cte", '.$realAmount.', 0))';
	    $payIn	= 'SUM(IF('.$this->getFieldSql('type', 't1').'="in" AND '.$this->getFieldSql('type_movement', 't1').'="cta_cte_pay", '.$realAmount.', 0))';
	    $payOut	= 'SUM(IF('.$this->getFieldSql('type', 't1').'="out" AND '.$this->getFieldSql('type_movement', 't1').'="cta_cte_pay", '.$realAmount.', 0))';

	    $amountIn2	= 'SUM(IF('.$this->getFieldSql('type', 't3').'="in" AND '.$this->getFieldSql('type_pay', 't3').'="cta_cte", '.$realAmount.', 0))';
	    $amountOut2	='SUM(IF('.$this->getFieldSql('type', 't3').'="out" AND '.$this->getFieldSql('type_pay', 't3').'="cta_cte", '.$realAmount.', 0))';
	    $payIn2	= 'SUM(IF('.$this->getFieldSql('type', 't3').'="in" AND '.$this->getFieldSql('type_movement', 't3').'="cta_cte_pay", '.$realAmount.', 0))';
	    $payOut2	= 'SUM(IF('.$this->getFieldSql('type', 't3').'="out" AND '.$this->getFieldSql('type_movement', 't3').'="cta_cte_pay", '.$realAmount.', 0))';

	    //SELECT id_user, date FROM `test` t1 WHERE (SELECT SUM(amount) FROM `test` t2 WHERE t2.date<= t1.date AND t2.id_user=t1.id_user GROUP BY t2.id_user) = 0 GROUP BY id_user
	    $date0 = 'SELECT MAX('.$this->getFieldSql('date_added', 't2').') FROM '.$this->getTableSql().' t2 ';
	    $date0.= 'WHERE (SELECT ('.$amountIn2.'-'.$amountOut2.'-'.$payIn2.'+'.$payOut2.') FROM '.$this->getTableSql().' t3 WHERE t3.date_added <= t2.date_added AND (t3.id_client=t2.id_client OR t3.id_client=t2.id_provider OR t3.id_provider=t2.id_client OR t3.id_provider=t2.id_provider)) = 0 ';
	    $date0.= 'AND (t2.id_client=t4.id_client OR t2.id_client=t4.id_provider OR t2.id_provider=t4.id_client OR t2.id_provider=t4.id_provider) ';
	    $date0.= 'GROUP BY IF(t2.id_provider IS NULL, t2.id_client, t2.id_provider)';

	    $date1 = 'SELECT MIN('.$this->getFieldSql('date_added', 't4').') FROM '.$this->getTableSql().' t4 WHERE t4.date_added > ('.$date0.') AND (t4.id_client=t1.id_client OR t4.id_client=t1.id_provider OR t4.id_provider=t1.id_client OR t4.id_provider=t1.id_provider) ';

	    $date2 = 'SELECT MIN('.$this->getFieldSql('date_added', 't5').') FROM '.$this->getTableSql().' t5 WHERE t5.type_pay="cta_cte" AND (t5.id_client=t1.id_client OR t5.id_client=t1.id_provider OR t5.id_provider=t1.id_client OR t5.id_provider=t1.id_provider)';
	    $date2.= 'GROUP BY IF(t5.id_provider IS NULL, t5.id_client, t5.id_provider)';

	    $date3 = '(IF(('.$date1.') IS NULL, ('.$date2.'), ('.$date1.'))) AS fecha, ';

	    $sql = 'SELECT '.$this->getFieldSql('id_provider', 't1').', '.$this->getFieldSql('id_client', 't1').', IF('.$this->getFieldSql('id_provider', 't1').' IS NULL, id_client, id_provider) AS id_people, ';
	    $sql .= $amountIn.' AS amount_in, ';
	    $sql .= $amountOut.' AS amount_out, ';
	    $sql .= $payIn.' AS pay_in, ';
	    $sql .= $payOut.' AS pay_out, ';
	    $sql .= '('.$amountIn.'-'.$amountOut.'-'.$payIn.'+'.$payOut.') AS total, ';
	    $sql .= $date3;
	    $sql .= 'MAX('.$this->getFieldSql('date_added', 't1').') ';
	    $sql .= 'FROM '.$this->getTableSql().' t1 ';
	    $sql .= 'GROUP BY id_people ';
	    $sql .= 'HAVING total > 0'.$filter.' ';
	    $sql .= 'ORDER BY total DESC';

	    $provider = new Cprovider($this->getDbConn());

	    ?>
	    <form name="formCashFlow" id="formCashFlow" method="post" action="">
		<div class="form">
		    <div class="filter">
			<label><?php echo CMOVEMENT_REPORT_CASH_FLOW_FILTER_DATE; ?> <span>*</span></label>

			<?php dateFields($filterName, $this->getDbConn()->fmtDate, $_POST[$filterName.'From'], $_POST[$filterName.'To']); ?>

			<input type="submit" value="<?php echo CMOVEMENT_REPORT_CASH_FLOW_FILTER_BTN; ?>" class="search extraSpace" />
		    </div>
		    <div class="wrapperProducts">
			<div class="aux"></div>
			<div class="title">
			    <div class="ico"></div>
			    <div class="label">Listado de cta. cte.</div>
			    <div class="filter"></div>
			</div>
			<div id="formQueryProductBack" class="form query">
			    <div class="data">
				<div class="row header">
				    <div class="col left" style="width: 6%;"><div class="num">ID</div></div>
				    <div class="col left" style="width: 70%;"><div class="str">Nombre</div></div>
				    <div class="col left" style="width: 7%;"><div class="date">Fecha</div></div>
				    <div class="col left" style="width: 17%;"><div class="num">Cta Cte</div></div>
				    <div class="clear"></div>
				</div>
		    <?php
		    $rs = $this->getDbConn()->Execute($sql);

		    if ($rs !== FALSE)
		    {
    			$i = 1;
    			while (!$rs->EOF)
    			{
    			    $provider->setId($rs->fields['id_people']);
    			    if($provider->getData() == FALSE)
    			    {
    				    continue;
    			    }
    			    ?>
    				<div class="row row<?php echo $i; ?>" id="product_back_tr_<?php echo $provider->getId(FALSE); ?>" data-table-name="product_back" data-id="<?php echo $provider->getId(FALSE); ?>" data-form-id="formQueryProductBack">
    				<div class="col header">&nbsp;</div>
    				<div class="col header"><div class="num">ID</div></div>
    				<div class="col left" style="width: 6%;"><div class="num"><?php echo $provider->getId(FALSE); ?></div></div>
    				<div class="col header"><div class="str">Nombre</div></div>
    				<div class="col left" style="width: 70%;"><div class="str"><?php echo $provider->getName(); ?></div></div>
    				<div class="col header"><div class="date">Fecha</div></div>
    				<div class="col left" style="width: 7%;"><div class="num"><?php echo $rs->fields['fecha']; ?></div></div>
    				<div class="col header"><div class="num">Cta Cte</div></div>
    				<div class="col left" style="width: 17%;"><div class="num"><?php echo numberFormat($rs->fields['total']); ?></div></div>
    				<div class="clear"></div>
    			    </div>
    			    <?php
    			    if($i == 1)
    			    {
    				    $i = 2;
    			    }
    			    else
    			    {
    				    $i = 1;
    			    }

    			    $rs->MoveNext();
    			}
    			?>
    			<div class="buttons">&nbsp;</div>
    			<?php
		    }
		    else
		    {
			?>
				<div class="message warning"><?php echo CMOVEMENT_REPORT_CTA_CTE_NOT_ROWS; ?></div>
			<?php
		    }

		    ?>
			    </div>
			</div>
		    </div>
		</div>
	    </form>
	    <?php
	}
}
?>