<?php
/**
 * Archivo php creado por O-creator
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla product
 *
 * Esta clase se encarga de la administración de la tabla product brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Cproduct.php');
 * $product = new Cproduct();
 * $product->setDbConn($dbConn);
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:20-08-2020
 */
class Cproduct extends Cbase
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
	 * - Campo: {@link Cdetail::$idProduct idProduct}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * Ver también: {@link getId()}, {@link setId()}
	 * @var integer
	 * @access private
	 */
	private $id;

	/**
	 * Nombre
	 *
	 * - Campo en la base de datos: name
	 * - Tipo de campo en la base de datos: varchar(255)
	 * - Campo requerido
	 * - Campo único en conjunto con: {@link $id_provider id_provider}
	 *
	 * Ver también: {@link getName()}, {@link setName()}
	 * @var string
	 * @access private
	 */
	private $name;

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
	 * Proveedor
	 *
	 * - Clave Foránea
	 * - Campo en la base de datos: id_provider
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 * - Campo requerido
	 * - Campo único en conjunto con: {@link $name name}
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
	 * Alta
	 *
	 * - Campo en la base de datos: date_added
	 * - Tipo de campo en la base de datos: date
	 * - Extra: Fecha de alta
	 * - Campo requerido
	 * - Utiliza la clase {@link Cdate}
	 *
	 * Ver también: {@link getDateAdded()}, {@link setDateAdded()}
	 * @var string
	 * @access private
	 */
	private $dateAdded;

	/**
	 * Estado
	 *
	 * - Campo en la base de datos: status
	 * - Tipo de campo en la base de datos: enum('exhibited','sold','give_back','returned','to_pay','paid_out','donate')
	 * - Campo requerido
	 *
	 * Ver también: {@link getStatus()}, {@link setStatus()}
	 * @var string
	 * @access private
	 */
	private $status;

	/**
	 * Categoría
	 *
	 * - Clave Foránea
	 * - Campo en la base de datos: id_category
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * <b>Relación</b>
	 * Este campo es clave foránea a:
	 * - Tabla: {@link Ccategory category}
	 * - Campo: {@link Ccategory::$id id}
	 * - Campo que se muestra: {@link Ccategory::$name name}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * Ver también: {@link getIdCategory()}, {@link setIdCategory()}
	 * @var integer
	 * @access private
	 */
	private $idCategory;

	/**
	 * Precio de Lista
	 *
	 * - Campo en la base de datos: list_price
	 * - Tipo de campo en la base de datos: decimal(10,2)
	 * - Extra: Decimal, positivo sin el cero [+] (ver {@link validateDecimalValue()})
	 * - Número de decimales: 2
	 * - Campo requerido
	 *
	 * Ver también: {@link getListPrice()}, {@link setListPrice()}
	 * @var float
	 * @access private
	 */
	private $listPrice;

	/**
	 * Precio de Vta.
	 *
	 * - Campo en la base de datos: sale_price
	 * - Tipo de campo en la base de datos: decimal(10,2)
	 * - Extra: Decimal, positivo sin el cero [+] (ver {@link validateDecimalValue()})
	 * - Número de decimales: 2
	 * - Campo requerido
	 *
	 * Ver también: {@link getSalePrice()}, {@link setSalePrice()}
	 * @var float
	 * @access private
	 */
	private $salePrice;

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
	 * Código
	 *
	 * - Campo en la base de datos: code
	 * - Tipo de campo en la base de datos: varchar(50)
	 * - Campo único
	 *
	 * Ver también: {@link getCode()}, {@link setCode()}
	 * @var string
	 * @access private
	 */
	private $code;

	/**
	 * Vendido
	 *
	 * - Campo en la base de datos: date_sold
	 * - Tipo de campo en la base de datos: date
	 * - Utiliza la clase {@link Cdate}
	 *
	 * Ver también: {@link getDateSold()}, {@link setDateSold()}
	 * @var string
	 * @access private
	 */
	private $dateSold;

	/**
	 * Cambio Estado
	 *
	 * - Campo en la base de datos: date_change_status
	 * - Tipo de campo en la base de datos: date
	 * - Utiliza la clase {@link Cdate}
	 *
	 * Ver también: {@link getDateChangeStatus()}, {@link setDateChangeStatus()}
	 * @var string
	 * @access private
	 */
	private $dateChangeStatus;

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

		$this->setTableName('product');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cproduct.php');
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
			$this->addError(CPRODUCT_SETID_REQUIRED_VALUE);

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
				$this->addError(CPRODUCT_SETID_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $name Nombre}
	 *
	 * @param string $name indica el valor Nombre
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setName($name, $gpc = FALSE)
	{
		if (validateRequiredValue($name) === FALSE)
		{
			$this->name = $name;
			$this->addError(CPRODUCT_SETNAME_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->name = setValue($name, $gpc);

			return TRUE;
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
			$this->addError(CPRODUCT_SETID_PROVIDER_REQUIRED_VALUE);

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
				$this->addError(CPRODUCT_SETID_PROVIDER_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $dateAdded Alta}
	 *
	 * Setea el valor Alta. Si el parámetro $dbFormat es TRUE se está indicando que el parámetro $dateAdded se encuentra en el formato de la base de datos,
	 * sino, se está indicando que se encuentra en el formato definido en el archivo de configuración del script (FORMAT_DATE).
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $product = new Cproduct();
	 * //seteo en el formato que acepta la base de datos (yyyy-mm-dd)
	 * $product->setDateAdded('1980-11-24', TRUE);
	 * //seteo en el formato definido en la configuración del script (suponemos que el formato utilizado es dd-mm-yyyy)
	 * $product->setDateAdded('24-11-1980', FALSE);
	 * ?>
	 * </code>
	 *
	 * @param string $dateAdded indica el valor Alta
	 * @param boolean $dbFormat indica si el valor Alta está dado en el formato de la base de datos
	 * @return boolean
	 * @access public
	 */
	public function setDateAdded($dateAdded, $dbFormat)
	{
		if (validateRequiredValue($dateAdded) === FALSE)
		{
			$this->dateAdded = $dateAdded;
			$this->addError(CPRODUCT_SETDATE_ADDED_REQUIRED_VALUE);

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
					$this->addError(CPRODUCT_SETDATE_ADDED_VALIDATE_VALUE);

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
					$this->addError(CPRODUCT_SETDATE_ADDED_VALIDATE_VALUE);

					return FALSE;
				}
			}
			else
			{
				$this->dateAdded = '';
				$this->addError(CPRODUCT_SETDATE_ADDED_ERROR);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $status Estado}
	 *
	 * @param string $status indica el valor Estado
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setStatus($status, $gpc = FALSE)
	{
		if (validateRequiredValue($status) === FALSE)
		{
			$this->status = $status;
			$this->addError(CPRODUCT_SETSTATUS_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->status = setValue($status, $gpc);

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $idCategory Categoría}
	 *
	 * @param integer $idCategory indica el valor Categoría
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdCategory($idCategory, $gpc = FALSE)
	{
		if ($idCategory == '0')
		{
			$idCategory = '';
		}
		$this->idCategory = setValue($idCategory, $gpc);

		if (validateIntValue($this->idCategory, '+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CPRODUCT_SETID_CATEGORY_VALIDATE_VALUE);

			return FALSE;
		}
	}

	/**
	 * Setea el valor {@link $listPrice Precio de Lista}
	 *
	 * @param float $listPrice indica el valor Precio de Lista
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setListPrice($listPrice, $gpc = FALSE)
	{
		if (validateRequiredValue($listPrice) === FALSE)
		{
			$this->listPrice = $listPrice;
			$this->addError(CPRODUCT_SETLIST_PRICE_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->listPrice = setValue($listPrice, $gpc);

			if (validateDecimalValue($this->listPrice, '+') === TRUE)
			{
				if (validateRequiredValue($listPrice) === TRUE)
				{
					$this->listPrice = numberFormat($listPrice, 2);
				}
				return TRUE;
			}
			else
			{
				$this->addError(CPRODUCT_SETLIST_PRICE_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $salePrice Precio de Vta.}
	 *
	 * @param float $salePrice indica el valor Precio de Vta.
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setSalePrice($salePrice, $gpc = FALSE)
	{
		if (validateRequiredValue($salePrice) === FALSE)
		{
			$this->salePrice = $salePrice;
			$this->addError(CPRODUCT_SETSALE_PRICE_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->salePrice = setValue($salePrice, $gpc);

			if (validateDecimalValue($this->salePrice, '+') === TRUE)
			{
				if (validateRequiredValue($salePrice) === TRUE)
				{
					$this->salePrice = numberFormat($salePrice, 2);
				}
				return TRUE;
			}
			else
			{
				$this->addError(CPRODUCT_SETSALE_PRICE_VALIDATE_VALUE);

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
			$this->addError(CPRODUCT_SETID_USER_ADD_REQUIRED_VALUE);

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
				$this->addError(CPRODUCT_SETID_USER_ADD_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}
	/**
	 * Setea el valor {@link $code Código}
	 *
	 * @param string $code indica el valor Código
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setCode($code, $gpc = FALSE)
	{
		$this->code = setValue($code, $gpc);
		return TRUE;
	}
	/**
	 * Setea el valor {@link $dateSold Vendido}
	 *
	 * Setea el valor Vendido. Si el parámetro $dbFormat es TRUE se está indicando que el parámetro $dateSold se encuentra en el formato de la base de datos,
	 * sino, se está indicando que se encuentra en el formato definido en el archivo de configuración del script (FORMAT_DATE).
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $product = new Cproduct();
	 * //seteo en el formato que acepta la base de datos (yyyy-mm-dd)
	 * $product->setDateSold('1980-11-24', TRUE);
	 * //seteo en el formato definido en la configuración del script (suponemos que el formato utilizado es dd-mm-yyyy)
	 * $product->setDateSold('24-11-1980', FALSE);
	 * ?>
	 * </code>
	 *
	 * @param string $dateSold indica el valor Vendido
	 * @param boolean $dbFormat indica si el valor Vendido está dado en el formato de la base de datos
	 * @return boolean
	 * @access public
	 */
	public function setDateSold($dateSold, $dbFormat)
	{
		$oDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
		if ($dbFormat === TRUE)
		{
			if ($oDate->validateDate($dateSold, 'db') == TRUE or $dateSold == NULL)
			{
				$this->dateSold = $dateSold;
				return TRUE;
			}
			else
			{
				$this->dateSold = '';
				$this->addError(CPRODUCT_SETDATE_SOLD_VALIDATE_VALUE);
				return FALSE;
			}
		}
		elseif ($dbFormat === FALSE)
		{
			if ($oDate->validateDate($dateSold, 'str'))
			{
				$oDate->setStrDate($dateSold);
				$this->dateSold = $oDate->getDbDate();
				return TRUE;
			}
			else
			{
				$this->dateSold = '';
				$this->addError(CPRODUCT_SETDATE_SOLD_VALIDATE_VALUE);
				return FALSE;
			}
		}
		else
		{
			$this->dateSold = '';
			$this->addError(CPRODUCT_SETDATE_SOLD_ERROR);
			return FALSE;
		}
	}

	/**
	 * Setea el valor {@link $dateChangeStatus Cambio Estado}
	 *
	 * Setea el valor Cambio Estado. Si el parámetro $dbFormat es TRUE se está indicando que el parámetro $dateChangeStatus se encuentra en el formato de la base de datos,
	 * sino, se está indicando que se encuentra en el formato definido en el archivo de configuración del script (FORMAT_DATE).
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $product = new Cproduct();
	 * //seteo en el formato que acepta la base de datos (yyyy-mm-dd)
	 * $product->setDateChangeStatus('1980-11-24', TRUE);
	 * //seteo en el formato definido en la configuración del script (suponemos que el formato utilizado es dd-mm-yyyy)
	 * $product->setDateChangeStatus('24-11-1980', FALSE);
	 * ?>
	 * </code>
	 *
	 * @param string $dateChangeStatus indica el valor Cambio Estado
	 * @param boolean $dbFormat indica si el valor Cambio Estado está dado en el formato de la base de datos
	 * @return boolean
	 * @access public
	 */
	public function setDateChangeStatus($dateChangeStatus, $dbFormat)
	{
		$oDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
		if ($dbFormat === TRUE)
		{
			if ($oDate->validateDate($dateChangeStatus, 'db'))
			{
				$this->dateChangeStatus = $dateChangeStatus;

				return TRUE;
			}
			else
			{
				$this->dateChangeStatus = '';
				$this->addError(CPRODUCT_SETDATE_CHANGE_STATUS_VALIDATE_VALUE);

				return FALSE;
			}
		}
		elseif ($dbFormat === FALSE)
		{
			if ($oDate->validateDate($dateChangeStatus, 'str'))
			{
				$oDate->setStrDate($dateChangeStatus);
				$this->dateChangeStatus = $oDate->getDbDate();

				return TRUE;
			}
			else
			{
				$this->dateChangeStatus = '';
				$this->addError(CPRODUCT_SETDATE_CHANGE_STATUS_VALIDATE_VALUE);

				return FALSE;
			}
		}
		else
		{
			$this->dateChangeStatus = '';
			$this->addError(CPRODUCT_SETDATE_CHANGE_STATUS_ERROR);

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
	 * Devuelve el valor {@link $name Nombre}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getName($htmlEntities = TRUE)
	{
		return getValue($this->name, $htmlEntities, $this->getCharset());
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
	 * Devuelve el valor {@link $dateAdded Alta}
	 *
	 * Devuelve el valor Alta de acuerdo al valor del parámetro $dbFormat.
	 * Si $dbFormat es TRUE devuelve el valor en el formato que acepte la base de datos, sino, lo devuelve en el formato definido en el archivo de configuración del script (FORMAT_DATE).
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $product = new Cproduct();
	 * $product->setDateAdded('1980-11-24', TRUE);
	 * echo 'Alta en formato del script: ';
	 * echo $product->getDateAdded().'<br />';
	 * echo 'Alta en el formato que acepta la base de datos: ';
	 * echo $product->getDateAdded(TRUE).'<br />';
	 * ?>
	 * </code>
	 *
	 * @param boolean $dbFormat [opcional] indica si el valor Alta se devuelve en el formato que acepta la base de datos
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
	 * Devuelve el valor {@link $status Estado}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getStatus($htmlEntities = TRUE)
	{
		return getValue($this->status, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve la descripción de los valores de {@link $status Estado}
	 *
	 * @param string $status indica el valor Estado
	 * @return string
	 * @access public
	 */
	public function getValuesStatus($status)
	{
		switch ($status)
		{
			case 'exhibited':
				return CPRODUCT_GET_VALUES_STATUS_VALUE_1;
				break;

			case 'sold':
				return CPRODUCT_GET_VALUES_STATUS_VALUE_2;
				break;

			case 'give_back':
				return CPRODUCT_GET_VALUES_STATUS_VALUE_3;
				break;

			case 'returned':
				return CPRODUCT_GET_VALUES_STATUS_VALUE_4;
				break;

			case 'to_pay':
				return CPRODUCT_GET_VALUES_STATUS_VALUE_5;
				break;

			case 'paid_out':
				return CPRODUCT_GET_VALUES_STATUS_VALUE_6;
				break;

			case 'donate':
				return CPRODUCT_GET_VALUES_STATUS_VALUE_7;
				break;
			default:
				return '&nbsp;';
		}
	}

	/**
	 * Devuelve el valor {@link $idCategory Categoría}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdCategory($htmlEntities = TRUE)
	{
		return getValue($this->idCategory, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $listPrice Precio de Lista}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return float
	 * @access public
	 */
	public function getListPrice($htmlEntities = TRUE)
	{
		return getValue($this->listPrice, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $salePrice Precio de Vta.}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return float
	 * @access public
	 */
	public function getSalePrice($htmlEntities = TRUE)
	{
		return getValue($this->salePrice, $htmlEntities, $this->getCharset());
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
	 * Devuelve el valor {@link $code Código}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getCode($htmlEntities = TRUE)
	{
		return getValue($this->code, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $dateSold Vendido}
	 *
	 * Devuelve el valor Vendido de acuerdo al valor del parámetro $dbFormat.
	 * Si $dbFormat es TRUE devuelve el valor en el formato que acepte la base de datos, sino, lo devuelve en el formato definido en el archivo de configuración del script (FORMAT_DATE).
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $product = new Cproduct();
	 * $product->setDateSold('1980-11-24', TRUE);
	 * echo 'Vendido en formato del script: ';
	 * echo $product->getDateSold().'<br />';
	 * echo 'Vendido en el formato que acepta la base de datos: ';
	 * echo $product->getDateSold(TRUE).'<br />';
	 * ?>
	 * </code>
	 *
	 * @param boolean $dbFormat [opcional] indica si el valor Vendido se devuelve en el formato que acepta la base de datos
	 * @return string
	 * @access public
	 */
	public function getDateSold($dbFormat = FALSE)
	{
		if ($dbFormat === TRUE)
		{
			return $this->dateSold;
		}
		else
		{
			$oDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
			$oDate->setDbDate($this->dateSold);

			return $oDate->getStrDate();
		}
	}

	/**
	 * Devuelve el valor {@link $dateChangeStatus Cambio Estado}
	 *
	 * Devuelve el valor Cambio Estado de acuerdo al valor del parámetro $dbFormat.
	 * Si $dbFormat es TRUE devuelve el valor en el formato que acepte la base de datos, sino, lo devuelve en el formato definido en el archivo de configuración del script (FORMAT_DATE).
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $product = new Cproduct();
	 * $product->setDateChangeStatus('1980-11-24', TRUE);
	 * echo 'Cambio Estado en formato del script: ';
	 * echo $product->getDateChangeStatus().'<br />';
	 * echo 'Cambio Estado en el formato que acepta la base de datos: ';
	 * echo $product->getDateChangeStatus(TRUE).'<br />';
	 * ?>
	 * </code>
	 *
	 * @param boolean $dbFormat [opcional] indica si el valor Cambio Estado se devuelve en el formato que acepta la base de datos
	 * @return string
	 * @access public
	 */
	public function getDateChangeStatus($dbFormat = FALSE)
	{
		if ($dbFormat === TRUE)
		{
			return $this->dateChangeStatus;
		}
		else
		{
			$oDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
			$oDate->setDbDate($this->dateChangeStatus);

			return $oDate->getStrDate();
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
	 * Inserta un nuevo registro en la tabla product
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

		if (isset($this->name) === TRUE)
		{
			$fields[] = $this->getFieldSql('name');
			$values[] = $this->getValueSql($this->name);
		}

		if (isset($this->description) === TRUE)
		{
			$fields[] = $this->getFieldSql('description');
			$values[] = $this->getValueSql($this->description);
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

		if (isset($this->dateAdded) === TRUE)
		{
			$fields[] = $this->getFieldSql('date_added');
			$values[] = $this->getValueSql($this->dateAdded);
		}

		if (isset($this->status) === TRUE)
		{
			$fields[] = $this->getFieldSql('status');
			$values[] = $this->getValueSql($this->status);
		}

		if (isset($this->idCategory) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_category');

			if (validateRequiredValue($this->idCategory) === FALSE)
			{
				$values[] = 'NULL';
			}
			else
			{
				$values[] = $this->getValueSql($this->idCategory);
			}
		}

		if (isset($this->listPrice) === TRUE)
		{
			$fields[] = $this->getFieldSql('list_price');

			if (validateRequiredValue($this->listPrice) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->listPrice);
			}
		}

		if (isset($this->salePrice) === TRUE)
		{
			$fields[] = $this->getFieldSql('sale_price');

			if (validateRequiredValue($this->salePrice) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->salePrice);
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

		if (isset($this->code) === TRUE)
		{
			$fields[] = $this->getFieldSql('code');
			$values[] = $this->getValueSql($this->code);
		}
		if (isset($this->dateSold) === TRUE)
		{
			$fields[] = $this->getFieldSql('date_sold');
			$values[] = $this->getValueSql($this->dateSold);
		}
		if (isset($this->dateChangeStatus) === TRUE)
		{
			$fields[] = $this->getFieldSql('date_change_status');
			$values[] = $this->getValueSql($this->dateChangeStatus);
		}
		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CPRODUCT_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla product
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

			if (isset($this->name) === TRUE)
			{
				$values[] = $this->getFieldSql('name').' = '.$this->getValueSql($this->name);
			}

			if (isset($this->description) === TRUE)
			{
				$values[] = $this->getFieldSql('description').' = '.$this->getValueSql($this->description);
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

			if (isset($this->dateAdded) === TRUE)
			{
				$values[] = $this->getFieldSql('date_added').' = '.$this->getValueSql($this->dateAdded);
			}

			if (isset($this->status) === TRUE)
			{
				$values[] = $this->getFieldSql('status').' = '.$this->getValueSql($this->status);
			}

			if (isset($this->idCategory) === TRUE)
			{
				if (validateRequiredValue($this->idCategory) === FALSE)
				{
					$values[] = $this->getFieldSql('id_category').' = NULL';
				}
				else
				{
					$values[] = $this->getFieldSql('id_category').' = '.$this->getValueSql($this->idCategory);
				}
			}

			if (isset($this->listPrice) === TRUE)
			{
				if (validateRequiredValue($this->listPrice) === FALSE)
				{
					$values[] = $this->getFieldSql('list_price').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('list_price').' = '.$this->getValueSql($this->listPrice);
				}
			}

			if (isset($this->salePrice) === TRUE)
			{
				if (validateRequiredValue($this->salePrice) === FALSE)
				{
					$values[] = $this->getFieldSql('sale_price').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('sale_price').' = '.$this->getValueSql($this->salePrice);
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

			if (isset($this->code) === TRUE)
			{
				$values[] = $this->getFieldSql('code').' = '.$this->getValueSql($this->code);
			}

			if (validateRequiredValue($this->dateSold) === FALSE)
			{
				$values[] = $this->getFieldSql('date_sold').' = NULL';
			}
			else
			{
				$values[] = $this->getFieldSql('date_sold').' = '.$this->getValueSql($this->dateSold);
			}

			if (validateRequiredValue($this->dateChangeStatus) === TRUE)
			{
				$values[] = $this->getFieldSql('date_change_status').' = '.$this->getValueSql($this->dateChangeStatus);
			}

			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CPRODUCT_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CPRODUCT_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla product
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
				$this->addError(CPRODUCT_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CPRODUCT_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla product
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
				$this->setName($row['name']);
				$this->setDescription($row['description']);
				$this->setIdProvider($row['id_provider']);
				$this->setDateAdded($row['date_added'], TRUE);
				$this->setStatus($row['status']);
				$this->setIdCategory($row['id_category']);
				$this->setListPrice($row['list_price']);
				$this->setSalePrice($row['sale_price']);
				$this->setIdUserAdd($row['id_user_add']);
				$this->setCode($row['code']);
				$this->setDateSold($row['date_sold'], TRUE);
				$this->setDateChangeStatus($row['date_change_status'], TRUE);

				return TRUE;
			}
			else
			{
				$this->addError(CPRODUCT_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CPRODUCT_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla product
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"SELECT * FROM `tabla` WHERE code = '1'"</b>.
	 * Debe estar seteada la clave primaria del registro que se quiere obtener. Devuelve TRUE si se pudo obtener el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link showData()}
	 * @return boolean
	 * @access public
	 */
	public function getDataByCode()
	{
		if (validateRequiredValue($this->code) === TRUE)
		{
			$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('code').' = '.$this->getValueSql($this->code);

			$row = $this->getDbConn()->GetRow($sql);

			if (is_array($row) === TRUE and count($row) > 0)
			{
				$this->setId($row['id']);
				$this->setName($row['name']);
				$this->setDescription($row['description']);
				$this->setIdProvider($row['id_provider']);
				$this->setDateAdded($row['date_added'], TRUE);
				$this->setStatus($row['status']);
				$this->setIdCategory($row['id_category']);
				$this->setListPrice($row['list_price']);
				$this->setSalePrice($row['sale_price']);
				$this->setIdUserAdd($row['id_user_add']);
				$this->setCode($row['code']);
				$this->setDateSold($row['date_sold'], TRUE);
				$this->setDateChangeStatus($row['date_change_status'], TRUE);

				return TRUE;
			}
			else
			{
				$this->addError(CPRODUCT_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CPRODUCT_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un conjunto de registros de la tabla product
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
		$oIdProvider = new Cprovider();
		$oIdProvider->setDbConn($this->getDbConn());

		$oIdCategory = new Ccategory();
		$oIdCategory->setDbConn($this->getDbConn());

		$oIdUserAdd = new Cuser();
		$oIdUserAdd->setDbConn($this->getDbConn());

		$sql = 'SELECT ';
		$sql.= $this->getFieldSql('id', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('name', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('description', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_provider', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('date_added', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('status', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_category', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('list_price', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('sale_price', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_user_add', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('code', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('date_sold', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('date_change_status', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id', $oIdProvider->getTableName(), 'provider_id');
		$sql.= ', '.$this->getFieldSql('name', $oIdProvider->getTableName(), 'provider_name');
		$sql.= ', '.$this->getFieldSql('email', $oIdProvider->getTableName(), 'provider_email');
		$sql.= ', '.$this->getFieldSql('phone', $oIdProvider->getTableName(), 'provider_phone');
		$sql.= ', '.$this->getFieldSql('id', $oIdCategory->getTableName(), 'category_id');
		$sql.= ', '.$this->getFieldSql('name', $oIdCategory->getTableName(), 'category_name');
		$sql.= ', '.$this->getFieldSql('id', $oIdUserAdd->getTableName(), 'user_id');
		$sql.= ', '.$this->getFieldSql('user', $oIdUserAdd->getTableName(), 'user_user');
		$sql.= ', '.$this->getFieldSql('pass', $oIdUserAdd->getTableName(), 'user_pass');
		$sql.= ', '.$this->getFieldSql('id_group', $oIdUserAdd->getTableName(), 'user_id_group');
		$sql.= ', '.$this->getFieldSql('active', $oIdUserAdd->getTableName(), 'user_active');
		$sql.= ', '.$this->getFieldSql('token', $oIdUserAdd->getTableName(), 'user_token');
		$sql.= ', '.$this->getFieldSql('name', $oIdUserAdd->getTableName(), 'user_name');
		$sql.= ', '.$this->getFieldSql('lastname', $oIdUserAdd->getTableName(), 'user_lastname');
		$sql.= ', '.$this->getFieldSql('email', $oIdUserAdd->getTableName(), 'user_email');
		$sql.= ' FROM '.$this->getTableSql();
		$sql.= ' LEFT JOIN '.$oIdProvider->getTableSql().' ON '.$this->getFieldSql('id_provider', $this->getTableName()).' = '.$oIdProvider->getFieldSql('id', $oIdProvider->getTableName());
		$sql.= ' LEFT JOIN '.$oIdCategory->getTableSql().' ON '.$this->getFieldSql('id_category', $this->getTableName()).' = '.$oIdCategory->getFieldSql('id', $oIdCategory->getTableName());
		$sql.= ' LEFT JOIN '.$oIdUserAdd->getTableSql().' ON '.$this->getFieldSql('id_user_add', $this->getTableName()).' = '.$oIdUserAdd->getFieldSql('id', $oIdUserAdd->getTableName());
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
				$this->addError(CPRODUCT_GETLIST_ERROR);

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
					$this->setName($rs->fields['name']);
					$this->setDescription($rs->fields['description']);
					$this->setIdProvider($rs->fields['id_provider']);
					$this->setDateAdded($rs->fields['date_added'], TRUE);
					$this->setStatus($rs->fields['status']);
					$this->setIdCategory($rs->fields['id_category']);
					$this->setListPrice($rs->fields['list_price']);
					$this->setSalePrice($rs->fields['sale_price']);
					$this->setIdUserAdd($rs->fields['id_user_add']);
					$this->setCode($rs->fields['code']);
					$this->setDateSold($rs->fields['date_sold'], TRUE);
					$this->setDateChangeStatus($rs->fields['date_change_status'], TRUE);

					$oIdProvider->setName($rs->fields['provider_name']);
					$oIdCategory->setName($rs->fields['category_name']);
					$oIdUserAdd->setName($rs->fields['user_name']);

					$list[] = array(
						'id' => $this->getId($htmlEntities) ,
						'name' => $this->getName($htmlEntities) ,
						'description' => $this->getDescription($htmlEntities) ,
						'idProvider' => $this->getIdProvider($htmlEntities) ,
						'dateAdded' => $this->getDateAdded() ,
						'status' => $this->getStatus($htmlEntities) ,
						'idCategory' => $this->getIdCategory($htmlEntities) ,
						'listPrice' => $this->getListPrice($htmlEntities) ,
						'salePrice' => $this->getSalePrice($htmlEntities) ,
						'idUserAdd' => $this->getIdUserAdd($htmlEntities) ,
						'code' => $this->getCode($htmlEntities) ,
						'dateSold' => $this->getDateSold() ,
						'dateChangeStatus' => $this->getDateChangeStatus() ,
						'providerName' => $oIdProvider->getName($htmlEntities) ,
						'categoryName' => $oIdCategory->getName($htmlEntities) ,
						'userName' => $oIdUserAdd->getName($htmlEntities)
					);

					$rs->MoveNext();
				}

				$this->id = NULL;
				$this->name = NULL;
				$this->description = NULL;
				$this->idProvider = NULL;
				$this->dateAdded = NULL;
				$this->status = NULL;
				$this->idCategory = NULL;
				$this->listPrice = NULL;
				$this->salePrice = NULL;
				$this->idUserAdd = NULL;
				$this->code = NULL;
				$this->dateSold = NULL;
				$this->dateChangeStatus = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CPRODUCT_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}

	/**






	 * Verifica si ya existe en la tabla product el valor Código seteado
	 *
	 * Este método controla si ya existe en la tabla product un registro con el valor {@link $code Código} seteado.
	 * Si se está verificando la existencia del valor para un registro existente en la base de datos (se está modificando el registro), el parámetro $update debe ser TRUE y debe estar seteada la clave primaria del registro.
	 * Si no está seteado el valor {@link $code Código} el método devuelve FALSE.
	 *
	 * @param boolean $update [opcional] indica si el método se está llamando durante la actualización de un registro
	 * @return boolean
	 * @access public
	 */
	public function existCode($update = FALSE)
	{
		if (validateRequiredValue($this->code) === TRUE)
		{
			$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('code').' = '.$this->getValueSql($this->code);
			if ($update === TRUE)
			{
				if (validateRequiredValue($this->id) === TRUE)
				{
					$sql.= ' AND '.$this->getFieldSql('id').' != '.$this->getValueSql($this->id);
				}
			}
			$row = $this->getDbConn()->GetRow($sql);
			if ($row !== FALSE)
			{
				if (count($row) > 0)
				{
					$this->addError(CPRODUCT_EXIST_CODE_EXIST);
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				$this->addError(CPRODUCT_EXIST_CODE_ERROR);
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	/**
	 * Verifica si ya existe en la tabla product el valor del grupo Nombre, Proveedor seteado
	 *
	 * Este método controla si ya existe en la tabla product un registro con el valor del grupo {@link $name name}, {@link $id_provider id_provider} seteado.
	 * Si se está verificando la existencia del valor para un registro existente en la base de datos (se está modificando el registro), el parámetro $update debe ser TRUE y debe estar seteada la clave primaria del registro.
	 *
	 * @param boolean $update [opcional] indica si el método se está llamando durante la actualización de un registro
	 * @return boolean
	 * @access public
	 */
	public function existGroup($update = FALSE)
	{
		$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('name').' = '.$this->getValueSql($this->name).' AND '.$this->getFieldSql('id_provider').' = '.$this->getValueSql($this->idProvider);
		if ($update === TRUE)
		{
			if (validateRequiredValue($this->id) === TRUE)
			{
				$sql.= ' AND '.$this->getFieldSql('id').' != '.$this->getValueSql($this->id);
			}
		}
		$row = $this->getDbConn()->GetRow($sql);
		if ($row !== FALSE)
		{
			if (count($row) > 0)
			{
				$this->addError(CPRODUCT_EXIST_GROUP_EXIST);
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			$this->addError(CPRODUCT_EXIST_GROUP_ERROR);
			return TRUE;
		}
	}
	/**
	 * Me dice si un registro de la tabla product puede ser eliminado
	 *
	 * Este método me dice si un registro de la tabla puede ser eliminado porque existe una relación de la misma con las siguientes tablas:
	 * - {@link Cdetail detail}
	 *
	 * Si existe al menos un registro que tenga el valor de la clave primaria que se quiere eliminar en los siguientes campos:
	 * - campo {@link Cdetail::$idProduct idProduct} de la tabla {@link Cdetail detail}
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
			$oDetail = new Cdetail();
			$oDetail->setDbConn($this->getDbConn());
			$rsDetail = $oDetail->getList($oDetail->getFieldSql('id_product', $oDetail->getTableName()).' = '.$oDetail->getValueSql($this->id));

			if ($rsDetail === FALSE)
			{
				$this->addError(CPRODUCT_CAN_DELETE_ERROR);

				return FALSE;
			}
			else
			{
				$return = TRUE;

				if ($oDetail->getTotalList() > 0)
				{
					$this->addError(CPRODUCT_CAN_DELETE_CANT_DETAIL);

					$return = FALSE;
				}

				return $return;
			}
		}
		else
		{
			$this->addError(CPRODUCT_CAN_DELETE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Devuelve el último valor ID insertado en la tabla product
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
			$this->addError(CPRODUCT_GET_LAST_ID_ERROR);

			return FALSE;
		}
		else
		{
			return $row['id'];
		}
	}

	/**
	 * Muestra un formulario para dar de alta un registro de la tabla product
	 *
	 * Este método muestra un formulario para dar de alta un registro de la tabla product mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,name,description,idProvider,dateAdded,status,idCategory,listPrice,salePrice,idUserAdd,code,dateSold,dateChangeStatus';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['addProduct']) === FALSE)
		{
			$_POST['addProduct'] = '';
		}

		$photo = new Cphoto();
		$photo->setDbConn($this->getDbConn());
		$photo->setTableFk($this->getTableName());
		$photo->setConstants();

		if ($_POST['addProduct'] == 'add')
		{
			if (in_array('name', $arrayFields) === TRUE)
			{
				$this->setName($_POST['name'], TRUE);
			}
			if (in_array('description', $arrayFields) === TRUE)
			{
				$this->setDescription($_POST['description'], TRUE);
			}
			if (in_array('idProvider', $arrayFields) === TRUE)
			{
				$this->setIdProvider($_POST['idProvider'], TRUE);
			}

			//Se toma la fecha actual
			$oDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
			$this->setDateAdded(date($oDate->getDbFormat()), TRUE);

			if (in_array('status', $arrayFields) === TRUE)
			{
				$this->setStatus($_POST['status'], TRUE);
			}
			if (in_array('idCategory', $arrayFields) === TRUE)
			{
				$this->setIdCategory($_POST['idCategory'], TRUE);
			}
			if (in_array('listPrice', $arrayFields) === TRUE)
			{
				$this->setListPrice($_POST['listPrice'], TRUE);
			}
			if (in_array('salePrice', $arrayFields) === TRUE)
			{
				$this->setSalePrice($_POST['salePrice'], TRUE);
			}
			/*No se carga, se toma el actual*/
			$this->setIdUserAdd($_SESSION['userId'], TRUE);
			if (in_array('code', $arrayFields) === TRUE)
			{
				$this->setCode($_POST['code'], TRUE);
			}

			//Si el estado es vendido pongo la fecha de hoy
			if($this->getStatus() == 'sold')
			{
			    $this->setDateSold(date($oDate->getDbFormat()), TRUE);
			}

			//Pongo la fecha de hoy
			$this->setDateChangeStatus(date($oDate->getDbFormat()), TRUE);

			if (in_array('code', $arrayFields) === TRUE)
			{
				$this->existCode();
			}
			$this->existGroup();

			if ($this->error() === FALSE)
			{
				$this->add();

				if ($this->error() === FALSE)
				{
					$id = $this->getLastId();

					$photo->setIdFk($id);
					$addedPhotos = $photo->addPhotos(strtolower($this->getTableName()));
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
					<div class="message success"><?php echo CPRODUCT_ADD_FORM_OK.' <b>#'.$id.'</b>'; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				    ?>
				    <input type="button" value="<?php echo CPRODUCT_ADD_FORM_NEW_BTN; ?>" onclick="location.href='product-add.php?idLastProduct=<?php echo $id; ?>'" class="success" />
				    <input type="button" value="<?php echo CPRODUCT_ADD_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="success" />
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
				<form name="formAddProduct" id="formAddProduct" method="post" action="">
				<input name="addProduct" type="hidden" id="addProduct" value="back" />
				<div class="fields">
				<?php
				if (in_array('name', $arrayFields) === TRUE)
				{
					echo '<input name="name" type="hidden" id="name" value="'.$this->getName().'" />';
				}
				if (in_array('description', $arrayFields) === TRUE)
				{
					echo '<input name="description" type="hidden" id="description" value="'.$this->getDescription().'" />';
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';
				}
				if (in_array('status', $arrayFields) === TRUE)
				{
					echo '<input name="status" type="hidden" id="status" value="'.$this->getStatus().'" />';
				}
				if (in_array('idCategory', $arrayFields) === TRUE)
				{
					echo '<input name="idCategory" type="hidden" id="idCategory" value="'.$this->getIdCategory().'" />';
				}
				if (in_array('listPrice', $arrayFields) === TRUE)
				{
					echo '<input name="listPrice" type="hidden" id="listPrice" value="'.$this->getListPrice().'" />';
				}
				if (in_array('salePrice', $arrayFields) === TRUE)
				{
					echo '<input name="salePrice" type="hidden" id="salePrice" value="'.$this->getSalePrice().'" />';
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					echo '<input name="idUserAdd" type="hidden" id="idUserAdd" value="'.$this->getIdUserAdd().'" />';
				}
				if (in_array('code', $arrayFields) === TRUE)
				{
					echo '<input name="code" type="hidden" id="code" value="'.$this->getCode().'" />';
				}
				if (in_array('dateSold', $arrayFields) === TRUE)
				{
					echo '<input name="dateSold" type="hidden" id="dateSold" value="'.$this->getDateSold().'" />';
				}
				if (in_array('dateChangeStatus', $arrayFields) === TRUE)
				{
					echo '<input name="dateChangeStatus" type="hidden" id="dateChangeStatus" value="'.$this->getDateChangeStatus().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPRODUCT_ADD_FORM_BACK_BTN; ?>" class="back" />
				</div>
				</form>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
		else
		{
			if ($_POST['addProduct'] == 'back')
			{
				if (in_array('name', $arrayFields) === TRUE)
				{
					$this->setName($_POST['name'], TRUE);
				}
				if (in_array('description', $arrayFields) === TRUE)
				{
					$this->setDescription($_POST['description'], TRUE);
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					$this->setIdProvider($_POST['idProvider'], TRUE);
				}
				if (in_array('status', $arrayFields) === TRUE)
				{
					$this->setStatus($_POST['status'], TRUE);
				}
				if (in_array('idCategory', $arrayFields) === TRUE)
				{
					$this->setIdCategory($_POST['idCategory'], TRUE);
				}
				if (in_array('listPrice', $arrayFields) === TRUE)
				{
					$this->setListPrice($_POST['listPrice'], TRUE);
				}
				if (in_array('salePrice', $arrayFields) === TRUE)
				{
					$this->setSalePrice($_POST['salePrice'], TRUE);
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
				}
				if (in_array('code', $arrayFields) === TRUE)
				{
					$this->setCode($_POST['code'], TRUE);
				}
				if (in_array('dateSold', $arrayFields) === TRUE)
				{
					$this->setDateSold($_POST['dateSold'], FALSE);
				}
				if (in_array('dateChangeStatus', $arrayFields) === TRUE)
				{
					$this->setDateChangeStatus($_POST['dateChangeStatus'], FALSE);
				}
			}
			else
			{
			    if(empty($_GET['idLastProduct']) == FALSE)
			    {
    				//Valores por defecto
    				$auxProduct = new Cproduct();
    				$auxProduct->setId($_GET['idLastProduct'], TRUE);
    				$auxProduct->getData();

    				$this->setIdProvider($auxProduct->getIdProvider(FALSE));
			    }

			    $this->setStatus('exhibited');
			    $this->setIdCategory(2);
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
				<form name="formAddProduct" id="formAddProduct" method="post" action="">
				<input name="addProduct" type="hidden" id="addProduct" value="add" />
				<div class="fields">
			<?php
			foreach ($arrayFields as $value)
			{
				if ($value == 'name')
				{
				?>
					<div class="field">
						<label><?php echo CPRODUCT_ADD_FORM_LABEL_FIELD_NAME; ?> <span>*</span></label>
						<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" maxlength="255" />
					</div>
				<?php
				}
				if ($value == 'description')
				{
				?>
					<div class="field">
						<label><?php echo CPRODUCT_ADD_FORM_LABEL_FIELD_DESCRIPTION; ?></label>
						<textarea name="description" id="description"><?php echo $this->getDescription(); ?></textarea>
					</div>
				<?php
				}
				if ($value == 'idProvider')
				{
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
						<label><?php echo CPRODUCT_ADD_FORM_LABEL_FIELD_ID_PROVIDER; ?> <span>*</span></label>
						<input name="idProviderAutocomplete" id="idProviderAutocomplete" value="<?php echo $auxProviderName; ?>" class="str autocomplete" maxlength="255" type="text" />
						<input name="idProvider" id="idProvider" value="<?php echo $this->getIdProvider(FALSE); ?>" type="hidden" />
					</div>
				<?php
				}
				if ($value == 'status')
				{
				?>
					<div class="field">
						<label><?php echo CPRODUCT_ADD_FORM_LABEL_FIELD_STATUS; ?> <span>*</span></label>
						<select name="status" id="status">
							<option value=""></option>
							<option value="exhibited" <?php if ($this->getStatus() == 'exhibited') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('exhibited'); ?></option>
							<option value="sold" <?php if ($this->getStatus() == 'sold') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('sold'); ?></option>
							<option value="give_back" <?php if ($this->getStatus() == 'give_back') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('give_back'); ?></option>
							<option value="returned" <?php if ($this->getStatus() == 'returned') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('returned'); ?></option>
							<?php /*No permito más este estado. Ahora directamente es sold?>
							<option value="to_pay" <?php if ($this->getStatus() == 'to_pay') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('to_pay'); ?></option>
							<?php*/ ?>
							<option value="paid_out" <?php if ($this->getStatus() == 'paid_out') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('paid_out'); ?></option>
							<option value="donate" <?php if ($this->getStatus() == 'donate') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('donate'); ?></option>
						</select>
					</div>
				<?php
				}
				if ($value == 'idCategory')
				{
				?>
					<div class="field">
					    <label><?php echo CPRODUCT_ADD_FORM_LABEL_FIELD_ID_CATEGORY; ?></label>
					    <?php
					    $oIdCategory = new Ccategory();
					    $oIdCategory->setDbConn($this->getDbConn());
					    $oIdCategory->showList('name', 'name', $this->getIdCategory(), 'idCategory', 'idCategory', 'select');
					    ?>
					</div>
				<?php
				}
				if ($value == 'listPrice')
				{
				?>
					<div class="field">
						<label><?php echo CPRODUCT_ADD_FORM_LABEL_FIELD_LIST_PRICE; ?> <span>*</span></label>
						<input name="listPrice" type="text" id="listPrice" value="<?php echo $this->getListPrice(); ?>" class="num" />
					</div>
				<?php
				}
				if ($value == 'salePrice')
				{
				?>
					<div class="field">
						<label><?php echo CPRODUCT_ADD_FORM_LABEL_FIELD_SALE_PRICE; ?> <span>*</span></label>
						<input name="salePrice" type="text" id="salePrice" value="<?php echo $this->getSalePrice(); ?>" class="num" />
					</div>
				<?php
				}
				if ($value == 'idUserAdd')
				{
				?>
					<div class="field">
						<label><?php echo CPRODUCT_ADD_FORM_LABEL_FIELD_ID_USER_ADD; ?> <span>*</span></label>
					<?php
					$oIdUserAdd = new Cuser();
					$oIdUserAdd->setDbConn($this->getDbConn());
					$oIdUserAdd->showList('name', 'name', $this->getIdUserAdd(), 'idUserAdd', 'idUserAdd', 'select');
					?>
					</div>
				<?php
				}
				if ($value == 'code')
				{
				?>
					<div class="field">
						<label><?php echo CPRODUCT_ADD_FORM_LABEL_FIELD_CODE; ?></label>
						<input name="code" type="text" id="code" value="<?php echo $this->getCode(); ?>" class="str" maxlength="50" />
					</div>
				<?php
				}
				if ($value == 'dateSold')
				{
				?>
					<div class="field">
						<label><?php echo CPRODUCT_ADD_FORM_LABEL_FIELD_DATE_SOLD; ?></label>
						<input name="dateSold" type="text" id="dateSold" value="<?php echo $this->getDateSold(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateSold" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateSold', '#btnDateSold', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
				<?php
				}
				if ($value == 'dateChangeStatus')
				{
				?>
					<div class="field">
						<label><?php echo CPRODUCT_ADD_FORM_LABEL_FIELD_DATE_CHANGE_STATUS; ?></label>
						<input name="dateChangeStatus" type="text" id="dateChangeStatus" value="<?php echo $this->getDateChangeStatus(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateChangeStatus" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateChangeStatus', '#btnDateChangeStatus', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
				<?php
				}
			}
			?>
				</div>
				<div class="detail">
			<?php
			//$photo->showIframePhoto();
			?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPRODUCT_ADD_FORM_SUBMIT_BTN; ?>" class="accept" />
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CPRODUCT_ADD_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
			<?php
			}
			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CPRODUCT_ADD_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Muestra un formulario para actualizar un registro existente de la tabla product
	 *
	 * Este método muestra un formulario para actualizar un registro de la tabla product mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,name,description,idProvider,dateAdded,status,idCategory,listPrice,salePrice,idUserAdd,code,dateSold,dateChangeStatus';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['updateProduct']) === FALSE)
		{
			$_POST['updateProduct'] = '';
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

		    $href		        = 'my-status.php';
		    $param[]		    = 'fromScreen=showProvider';
		    $param[]		    = 'id='.$_GET['idProvider'];
		    $this->extraParam	= implode('&', $param);
		    $auxParam		    = '';

		    if(empty($_GET['p']) == FALSE)
		    {
                $auxParam = '&';
		    }
		    $_GET['p'] = $auxParam.$this->extraParam;
		}

		$photo = new Cphoto();
		$photo->setDbConn($this->getDbConn());
		$photo->setTableFk($this->getTableName());
		$photo->setIdFk($this->getId());
		$photo->setConstants();

		$oDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);

		if ($_POST['updateProduct'] == 'update')
		{
			$this->setId($_POST['id'], TRUE);
			if (in_array('name', $arrayFields) === TRUE)
			{
				$this->setName($_POST['name'], TRUE);
			}
			if (in_array('description', $arrayFields) === TRUE)
			{
				$this->setDescription($_POST['description'], TRUE);
			}
			if (in_array('idProvider', $arrayFields) === TRUE)
			{
				$this->setIdProvider($_POST['idProvider'], TRUE);
			}
			if (in_array('status', $arrayFields) === TRUE)
			{
				$this->setStatus($_POST['status'], TRUE);
			}
			if (in_array('idCategory', $arrayFields) === TRUE)
			{
				$this->setIdCategory($_POST['idCategory'], TRUE);
			}
			if (in_array('listPrice', $arrayFields) === TRUE)
			{
				$this->setListPrice($_POST['listPrice'], TRUE);
			}
			if (in_array('salePrice', $arrayFields) === TRUE)
			{
				$this->setSalePrice($_POST['salePrice'], TRUE);
			}
			if (in_array('idUserAdd', $arrayFields) === TRUE)
			{
				$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
			}
			if (in_array('code', $arrayFields) === TRUE)
			{
				$this->setCode($_POST['code'], TRUE);
			}
			/*if (in_array('dateSold', $arrayFields) === TRUE)
			{
				$this->setDateSold($_POST['dateSold'], FALSE);
			}*/

			if($_POST['status'] != $_POST['oldStatus'])
			{
    			//Si el estado es vendido pongo la fecha de hoy
    			if($this->getStatus() == 'sold')
    			{
    			    $this->setDateSold(date($oDate->getDbFormat()), TRUE);
    			}

    			$this->setDateChangeStatus(date($oDate->getDbFormat()), TRUE);
			}

			if (in_array('code', $arrayFields) === TRUE)
			{
				$this->existCode(TRUE);
			}
			$this->existGroup(TRUE);
			if ($this->error() === FALSE)
			{
				$this->update();


				if ($this->error() === FALSE)
				{
					list ($deletedPhotos, $addedPhotos) = $photo->updatePhotos(strtolower($this->getTableName()));
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
					<div class="message success"><?php echo CPRODUCT_UPDATE_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CPRODUCT_UPDATE_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
				<form name="formUpdateProduct" id="formUpdateProduct" method="post" action="">
				<input name="updateProduct" type="hidden" id="updateProduct" value="back" />
				<div class="fields">
				<?php
				if (in_array('name', $arrayFields) === TRUE)
				{
					echo '<input name="name" type="hidden" id="name" value="'.$this->getName().'" />';
				}
				if (in_array('description', $arrayFields) === TRUE)
				{
					echo '<input name="description" type="hidden" id="description" value="'.$this->getDescription().'" />';
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';
				}
				if (in_array('status', $arrayFields) === TRUE)
				{
					echo '<input name="status" type="hidden" id="status" value="'.$this->getStatus().'" />';
				}
				if (in_array('idCategory', $arrayFields) === TRUE)
				{
					echo '<input name="idCategory" type="hidden" id="idCategory" value="'.$this->getIdCategory().'" />';
				}
				if (in_array('listPrice', $arrayFields) === TRUE)
				{
					echo '<input name="listPrice" type="hidden" id="listPrice" value="'.$this->getListPrice().'" />';
				}
				if (in_array('salePrice', $arrayFields) === TRUE)
				{
					echo '<input name="salePrice" type="hidden" id="salePrice" value="'.$this->getSalePrice().'" />';
				}
				if (in_array('idUserAdd', $arrayFields) === TRUE)
				{
					echo '<input name="idUserAdd" type="hidden" id="idUserAdd" value="'.$this->getIdUserAdd().'" />';
				}
				if (in_array('code', $arrayFields) === TRUE)
				{
					echo '<input name="code" type="hidden" id="code" value="'.$this->getCode().'" />';
				}
				if (in_array('dateSold', $arrayFields) === TRUE)
				{
					echo '<input name="dateSold" type="hidden" id="dateSold" value="'.$this->getDateSold().'" />';
				}
				if (in_array('dateChangeStatus', $arrayFields) === TRUE)
				{
					echo '<input name="dateChangeStatus" type="hidden" id="dateChangeStatus" value="'.$this->getDateChangeStatus().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPRODUCT_UPDATE_FORM_BACK_BTN; ?>" class="back" />
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

			    $_POST['oldStatus'] = $this->getStatus();

			    if ($_POST['updateProduct'] == 'back')
				{
					if (in_array('name', $arrayFields) === TRUE)
					{
						$this->setName($_POST['name'], TRUE);
					}
					if (in_array('description', $arrayFields) === TRUE)
					{
						$this->setDescription($_POST['description'], TRUE);
					}
					if (in_array('idProvider', $arrayFields) === TRUE)
					{
						$this->setIdProvider($_POST['idProvider'], TRUE);
					}
					if (in_array('status', $arrayFields) === TRUE)
					{
						$this->setStatus($_POST['status'], TRUE);
					}
					if (in_array('idCategory', $arrayFields) === TRUE)
					{
						$this->setIdCategory($_POST['idCategory'], TRUE);
					}
					if (in_array('listPrice', $arrayFields) === TRUE)
					{
						$this->setListPrice($_POST['listPrice'], TRUE);
					}
					if (in_array('salePrice', $arrayFields) === TRUE)
					{
						$this->setSalePrice($_POST['salePrice'], TRUE);
					}
					if (in_array('idUserAdd', $arrayFields) === TRUE)
					{
						$this->setIdUserAdd($_POST['idUserAdd'], TRUE);
					}
					if (in_array('code', $arrayFields) === TRUE)
					{
						$this->setCode($_POST['code'], TRUE);
					}
					if (in_array('dateSold', $arrayFields) === TRUE)
					{
						$this->setDateSold($_POST['dateSold'], FALSE);
					}
					if (in_array('dateChangeStatus', $arrayFields) === TRUE)
					{
						$this->setDateChangeStatus($_POST['dateChangeStatus'], FALSE);
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
				<form name="formUpdateProduct" id="formUpdateProduct" method="post" action="">
				<input name="updateProduct" type="hidden" id="updateProduct" value="update" />
				<input name="id" type="hidden" id="id" value="<?php echo $this->getId(); ?>" />
				<div class="fields">
				<?php
				foreach ($arrayFields as $value)
				{
					if ($value == 'id')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
					<?php
					}
					if ($value == 'name')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_NAME; ?> <span>*</span></label>
						<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" maxlength="255" />
					</div>
					<?php
					}
					if ($value == 'description')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_DESCRIPTION; ?></label>
						<textarea name="description" id="description"><?php echo $this->getDescription(); ?></textarea>
					</div>
					<?php
					}
					if ($value == 'idProvider')
					{
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
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_ID_PROVIDER; ?> <span>*</span></label>
						<input name="idProviderAutocomplete" id="idProviderAutocomplete" value="<?php echo $auxProviderName; ?>" class="str autocomplete" maxlength="255" type="text" />
						<input name="idProvider" id="idProvider" value="<?php echo $this->getIdProvider(FALSE); ?>" type="hidden" />
					</div>
					<?php
					}
					if ($value == 'dateAdded')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_DATE_ADDED; ?></label>
						<strong class="added"><?php echo $this->getDateAdded(); ?></strong>
					</div>
					<?php
					}
					if ($value == 'status')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_STATUS; ?> <span>*</span></label>
						<select name="status" id="status">
							<option value=""></option>
							<option value="exhibited" <?php if ($this->getStatus() == 'exhibited') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('exhibited'); ?></option>
							<option value="sold" <?php if ($this->getStatus() == 'sold') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('sold'); ?></option>
							<option value="give_back" <?php if ($this->getStatus() == 'give_back') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('give_back'); ?></option>
							<option value="returned" <?php if ($this->getStatus() == 'returned') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('returned'); ?></option>
							<?php if($this->getStatus() == 'to_pay'):?>
							<option value="to_pay" <?php if ($this->getStatus() == 'to_pay') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('to_pay'); ?></option>
							<?php endif; ?>
							<option value="paid_out" <?php if ($this->getStatus() == 'paid_out') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('paid_out'); ?></option>
							<option value="donate" <?php if ($this->getStatus() == 'donate') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('donate'); ?></option>
						</select>
						<input name="oldStatus" id="oldStatus" value="<?php echo $_POST['oldStatus']; ?>" type="hidden" />
					</div>
					<?php
					}
					if ($value == 'idCategory')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_ID_CATEGORY; ?></label>
						<?php
						$oIdCategory = new Ccategory();
						$oIdCategory->setDbConn($this->getDbConn());
						$oIdCategory->showList('name', 'name', $this->getIdCategory(), 'idCategory', 'idCategory', 'select');
						?>
					</div>
					<?php
					}
					if ($value == 'listPrice')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_LIST_PRICE; ?> <span>*</span></label>
						<input name="listPrice" type="text" id="listPrice" value="<?php echo $this->getListPrice(); ?>" class="num" />
					</div>
					<?php
					}
					if ($value == 'salePrice')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_SALE_PRICE; ?> <span>*</span></label>
						<input name="salePrice" type="text" id="salePrice" value="<?php echo $this->getSalePrice(); ?>" class="num" />
					</div>
					<?php
					}
					if ($value == 'idUserAdd')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_ID_USER_ADD; ?> <span>*</span></label>
						<?php
						$oIdUserAdd = new Cuser();
						$oIdUserAdd->setDbConn($this->getDbConn());
						$oIdUserAdd->showList('name', 'name', $this->getIdUserAdd(), 'idUserAdd', 'idUserAdd', 'select');
						?>
					</div>
					<?php
					}
					if ($value == 'code')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_CODE; ?></label>
						<input name="code" type="text" id="code" value="<?php echo $this->getCode(); ?>" class="str" maxlength="50" />
					</div>
					<?php
					}
					if ($value == 'dateSold')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_DATE_SOLD; ?></label>
						<input name="dateSold" type="text" id="dateSold" value="<?php echo $this->getDateSold(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateSold" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateSold', '#btnDateSold', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
					<?php
					}
					if ($value == 'dateChangeStatus')
					{
					?>
					<div class="field">
						<label><?php echo CPRODUCT_UPDATE_FORM_LABEL_FIELD_DATE_CHANGE_STATUS; ?></label>
						<input name="dateChangeStatus" type="text" id="dateChangeStatus" value="<?php echo $this->getDateChangeStatus(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateChangeStatus" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateChangeStatus', '#btnDateChangeStatus', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
					<?php
					}
				}
				?>
				</div>
				<div class="detail">
				<?php
				//$photo->showIframePhoto();
				?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPRODUCT_UPDATE_FORM_SUBMIT_BTN; ?>" class="accept" />
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CPRODUCT_UPDATE_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="cancel" />
				<?php
				}
				?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CPRODUCT_UPDATE_FORM_LABEL_REQUIRED; ?></span>
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
					<input type="button" value="<?php echo CPRODUCT_UPDATE_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
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
	 * Elimina un registro existente de la tabla product y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un registro de la tabla product y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
			if ($this->del() === TRUE)
			{
				$photo = new Cphoto();
				$photo->setDbConn($this->getDbConn());
				$photo->setTableFk($this->getTableName());
				$photo->setConstants();
				$photo->setIdFk($this->getId());
				$photo->deletePhotos();
			}
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
					<div class="message success"><?php echo CPRODUCT_DEL_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CPRODUCT_DEL_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
					<input type="button" value="<?php echo CPRODUCT_DEL_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
				</div>
		<?php
		}
		?>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Elimina un grupo de registros existente de la tabla product y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un grupo de registros de la tabla product y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
			$photo = new Cphoto();
			$photo->setDbConn($this->getDbConn());
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
						else
						{
							$photo->setIdFk($this->getId());
							$photo->setTableFk($this->getTableName());
							$photo->setConstants();
							$photo->deletePhotos();
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
			$this->addError(CPRODUCT_DEL_GROUP_FORM_REQUIRED_PK);
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
					<div class="message success"><?php echo CPRODUCT_DEL_GROUP_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CPRODUCT_DEL_GROUP_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="success" />
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
				$this->addError(CPRODUCT_DEL_GROUP_FORM_CANT_DELETE_ALL);
			}
			?>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="button" value="<?php echo CPRODUCT_DEL_GROUP_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="back" />
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
		    if(empty($_SESSION['userIdGroup']) == FALSE and $_SESSION['userIdGroup'] == 2)
		    {
		        $href = 'my-status.php';
		    }
		    else
		    {
                $href = 'provider-show.php';
		    }
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

		if (validateRequiredValue($fields) === FALSE)
		{
			$fields = 'id,name,description,idProvider,dateAdded,status,idCategory,listPrice,salePrice,idUserAdd,code,dateSold,dateChangeStatus';
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
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_CODE; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'name')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_NAME; ?></label>
						<strong><?php echo $this->getName(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'description')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_DESCRIPTION; ?></label>
						<strong><?php echo $this->getDescription(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idProvider')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_ID_PROVIDER; ?></label>
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
			if ($value == 'dateAdded')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_DATE_ADDED; ?></label>
						<strong><?php echo $this->getDateAdded(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'status')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_STATUS; ?></label>
						<strong><?php echo $this->getValuesStatus($this->getStatus()); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idCategory')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_ID_CATEGORY; ?></label>
				<?php
				$oIdCategory = new Ccategory();
				$oIdCategory->setDbConn($this->getDbConn());
				$oIdCategory->setId($this->getIdCategory(FALSE));
				$oIdCategory->getData();
				?>
						<strong><?php echo $oIdCategory->getName(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'listPrice')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_LIST_PRICE; ?></label>
						<strong><?php echo $this->getListPrice(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'salePrice')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_SALE_PRICE; ?></label>
						<strong><?php echo $this->getSalePrice(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idUserAdd')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_ID_USER_ADD; ?></label>
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
			if ($value == 'code')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_CODE; ?></label>
						<strong><?php echo $this->getCode(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'dateSold')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_DATE_SOLD; ?></label>
						<strong><?php echo $this->getDateSold(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'dateChangeStatus')
			{
			?>
					<div class="field">
						<label><?php echo CPRODUCT_SHOW_DATA_LABEL_FIELD_DATE_CHANGE_STATUS; ?></label>
						<strong><?php echo $this->getDateChangeStatus(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'history')
			{
			    $arrText['give_back'] = 'Se pasó a "Para Devolver" desde';
			    $arrText['returned']  = 'Se te devolvió';
			    $arrText['paid_out']  = 'Se te pagó';
			    $arrText['donate']    = 'Se donó';


			    $textStarus = '';
			    if(empty($this->getDateChangeStatus()) == FALSE)
			    {
			        //No pongo los estados 'exhibited' ni 'sold' ni 'to_pay' porque están de otra forma tenidos en cuenta
			        if($this->getStatus() != 'exhibited' and $this->getStatus() != 'sold' and $this->getStatus() != 'to_pay')
			        {
			            $textStarus = $arrText[$this->getStatus()];
			        }
			    }
			    ?>
					<div class="field">
						<label><h3>Historial:</h3></label>
						<ul class="history">
							<li>Se cargó: <?php echo $this->getDateAdded(); ?></li>

							<?php if(empty($this->getDateSold()) == FALSE): ?>
							<li>Se vendió: <?php echo $this->getDateSold(); ?></li>
							<?php endif;?>

							<?php if(empty($textStarus) == FALSE): ?>
							<li><?php echo $textStarus; ?>: <?php echo $this->getDateChangeStatus(); ?></li>
							<?php endif;?>
						</ul>
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
					<input type="button" value="<?php echo CPRODUCT_SHOW_DATA_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
		<?php
		}
		?>
				</div>
				<div class="bottom"></div>
			</div>
	<?php
	}

	/**
	 * Muestra un formulario de búsqueda de registros de la tabla product
	 *
	 * Este método muestra un formulario con los campos seteados en el parámetro $fields para realizar una búsqueda de los registros de la tabla product.
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
			$fields = 'id,name,description,idProvider,dateAdded,status,idCategory,listPrice,salePrice,idUserAdd,code,dateSold,dateChangeStatus';
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
			if (isset($_SESSION['main_tr_search_product']) === FALSE)
			{
				$_SESSION['main_tr_search_product'] = '';
			}

			$display  = 'display: none;';
			$btnClass = 'closed';
			if ($_SESSION['main_tr_search_product'] === 'open')
			{
				$display  = '';
				$btnClass = 'open';
			}
		}
		?>
				<div class="title">
					<div class="ico"><?php if ($showHideBtn === TRUE) { ?><a href="#" onclick="showHideSearch('product'); return false;" class="<?php echo $btnClass; ?>"></a><?php } ?></div>
					<div class="label"><a href="#" onclick="showHideSearch('product'); return false;"><?php echo $title; ?></a></div>
				</div>
				<div id="container_search_product" style="<?php echo $display; ?>">
					<div class="top"></div>
					<form name="formSearchProduct" id="formSearchProduct" method="<?php echo $method; ?>" action="">
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
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_ID; ?></label>
							<input name="id" type="text" id="id" value="<?php echo $this->getId(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getId()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id', $this->getTableName()).' = '.$this->getValueSql($this->id);
					$params[] = 'id='.urlencode($this->id);
				}
			}

			if ($value == 'name')
			{
				$this->setName($values['name'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_NAME; ?></label>
							<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getName()) === TRUE)
				{
					$condition[] = $this->getFieldSql('name', $this->getTableName()).' LIKE '.$this->getValueSql($this->name, '%%');
					$params[] = 'name='.urlencode($this->name);
				}
			}

			if ($value == 'description')
			{
				$this->setDescription($values['description'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_DESCRIPTION; ?></label>
							<input name="description" type="text" id="description" value="<?php echo $this->getDescription(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getDescription()) === TRUE)
				{
					$condition[] = $this->getFieldSql('description', $this->getTableName()).' LIKE '.$this->getValueSql($this->description, '%%');
					$params[] = 'description='.urlencode($this->description);
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
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
							<input name="idProviderAutocomplete" id="idProviderAutocomplete" value="<?php echo $auxProviderName; ?>" class="str autocomplete" maxlength="255" type="text" />
							<input name="idProvider" id="idProvider" value="<?php echo $this->getIdProvider(FALSE); ?>" type="hidden" />
						</div>
				<?php
				if (validateRequiredValue($this->getIdProvider()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_provider', $this->getTableName()).' = '.$this->getValueSql($this->idProvider);
					$params[] = 'idProvider='.urlencode($this->idProvider);
				}
			}

			if ($value == 'dateAdded')
			{
				$this->setDateAdded($values['dateAdded'], FALSE);
				?>
						<div class="field">
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_DATE_ADDED; ?></label>
							<input name="dateAdded" type="text" id="dateAdded" value="<?php echo $this->getDateAdded(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateAdded" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateAdded', '#btnDateAdded', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
						</div>
				<?php
				if (validateRequiredValue($this->getDateAdded()) === TRUE)
				{
					$condition[] = $this->getFieldSql('date_added', $this->getTableName()).' = '.$this->getValueSql($this->dateAdded);
					$params[] = 'dateAdded='.urlencode($this->getDateAdded());
				}
			}

			if ($value == 'status')
			{
				$this->setStatus($values['status'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_STATUS; ?></label>
							<select name="status" id="status">
								<option value=""></option>
								<option value="exhibited" <?php if ($this->getStatus() == 'exhibited') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('exhibited'); ?></option>
								<option value="sold" <?php if ($this->getStatus() == 'sold') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('sold'); ?></option>
								<option value="give_back" <?php if ($this->getStatus() == 'give_back') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('give_back'); ?></option>
								<option value="returned" <?php if ($this->getStatus() == 'returned') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('returned'); ?></option>
								<option value="to_pay" <?php if ($this->getStatus() == 'to_pay') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('to_pay'); ?></option>
								<option value="paid_out" <?php if ($this->getStatus() == 'paid_out') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('paid_out'); ?></option>
								<option value="donate" <?php if ($this->getStatus() == 'donate') echo 'selected="selected"' ?>><?php echo $this->getValuesStatus('donate'); ?></option>
							</select>
						</div>
				<?php
				if (validateRequiredValue($this->getStatus()) === TRUE)
				{
					$condition[] = $this->getFieldSql('status', $this->getTableName()).' = '.$this->getValueSql($this->status);
					$params[] = 'status='.urlencode($this->status);
				}
			}

			if ($value == 'idCategory')
			{
				$this->setIdCategory($values['idCategory'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_ID_CATEGORY; ?></label>
				<?php
				$oIdCategory = new Ccategory();
				$oIdCategory->setDbConn($this->getDbConn());
				$oIdCategory->showList('name', 'name', $this->getIdCategory(), 'idCategory', 'idCategory', 'select_search');
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdCategory()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_category', $this->getTableName()).' = '.$this->getValueSql($this->idCategory);
					$params[] = 'idCategory='.urlencode($this->idCategory);
				}
			}

			if ($value == 'listPrice')
			{
				$this->setListPrice($values['listPrice'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_LIST_PRICE; ?></label>
							<input name="listPrice" type="text" id="listPrice" value="<?php echo $this->getListPrice(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getListPrice()) === TRUE)
				{
					$condition[] = $this->getFieldSql('list_price', $this->getTableName()).' = '.$this->getValueSql($this->listPrice);
					$params[] = 'listPrice='.urlencode($this->listPrice);
				}
			}

			if ($value == 'salePrice')
			{
				$this->setSalePrice($values['salePrice'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_SALE_PRICE; ?></label>
							<input name="salePrice" type="text" id="salePrice" value="<?php echo $this->getSalePrice(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getSalePrice()) === TRUE)
				{
					$condition[] = $this->getFieldSql('sale_price', $this->getTableName()).' = '.$this->getValueSql($this->salePrice);
					$params[] = 'salePrice='.urlencode($this->salePrice);
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
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_ID_USER_ADD; ?></label>
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
			if ($value == 'code')
			{
				$this->setCode($values['code'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_CODE; ?></label>
							<input name="code" type="text" id="code" value="<?php echo $this->getCode(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getCode()) === TRUE)
				{
					$condition[] = $this->getFieldSql('code', $this->getTableName()).' LIKE '.$this->getValueSql($this->code, '%%');
					$params[] = 'code='.urlencode($this->code);
				}
			}
			if ($value == 'dateSold')
			{
				$this->setDateSold($values['dateSold'], FALSE);
				?>
						<div class="field">
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_DATE_SOLD; ?></label>
							<input name="dateSold" type="text" id="dateSold" value="<?php echo $this->getDateSold(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateSold" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateSold', '#btnDateSold', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
						</div>
				<?php
				if (validateRequiredValue($this->getDateSold()) === TRUE)
				{
					$condition[] = $this->getFieldSql('date_sold', $this->getTableName()).' = '.$this->getValueSql($this->dateSold);
					$params[] = 'dateSold='.urlencode($this->getDateSold());
				}
			}

			if ($value == 'dateChangeStatus')
			{
				$this->setDateChangeStatus($values['dateChangeStatus'], FALSE);
				?>
						<div class="field">
							<label><?php echo CPRODUCT_SEARCH_FORM_LABEL_FIELD_DATE_CHANGE_STATUS; ?></label>
							<input name="dateChangeStatus" type="text" id="dateChangeStatus" value="<?php echo $this->getDateChangeStatus(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDateChangeStatus" class="calendar"></a><script> $(document).ready(function () { showCalendar('#dateChangeStatus', '#btnDateChangeStatus', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
						</div>
				<?php
				if (validateRequiredValue($this->getDateChangeStatus()) === TRUE)
				{
					$condition[] = $this->getFieldSql('date_change_status', $this->getTableName()).' = '.$this->getValueSql($this->dateChangeStatus);
					$params[] = 'dateChangeStatus='.urlencode($this->getDateChangeStatus());
				}
			}
		}
		?>
					</div>
					<div class="middle"></div>
					<div class="buttons">
						<input type="submit" value="<?php echo CPRODUCT_SEARCH_FORM_SUBMIT_BTN; ?>" class="search" />
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
	 * Muestra el resultado de una consulta a la tabla product
	 *
	 * Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla product. Muestra sólo los campos seteados en el parámetro $fields.
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
	 * Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST['productGroup'] (array)</b>
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
	public function showQuery($fields = '', $actions = '', $groupActions = '', $widthGroupActions = '', $showNavTop = TRUE, $showNavBottom = TRUE,
	$imagesNav = '', $showNavPages = TRUE, $showNavInfo = TRUE, $title = '', $amountPages = 0, $resultsPerPage = 0, $changeStatusColumnLabel = '')
	{
		if (is_array($fields) === FALSE)
		{
			unset($fields);
			$fields[0]['field'] = 'id';
			$fields[1]['field'] = 'name';
			$fields[2]['field'] = 'description';
			$fields[3]['field'] = 'idProvider';
			$fields[4]['field'] = 'dateAdded';
			$fields[5]['field'] = 'status';
			$fields[6]['field'] = 'idCategory';
			$fields[7]['field'] = 'listPrice';
			$fields[8]['field'] = 'salePrice';
			$fields[9]['field'] = 'idUserAdd';
			$fields[10]['field'] = 'code';
			$fields[11]['field'] = 'dateSold';
			$fields[12]['field'] = 'dateChangeStatus';
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
			$arrayOrder = array('id', 'name', 'description', 'id_provider', 'date_added', 'status', 'id_category', 'list_price', 'sale_price', 'id_user_add', 'code', 'date_sold', 'date_change_status');
			array_push($arrayOrder, 'provider_name', 'category_name', 'user_name');

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

				$head.= '<div class="col" style="width: '.$arrayWidth['id'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></div>';
				$headers['id'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID).'</a></div>';
			}

			if ($value == 'name')
			{
				if ($_GET['orderby'] == 'name')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=name&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=name&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=name&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['name'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_NAME, $arrayStrLen['name']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_NAME).'</a></div></div>';
				$headers['name'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_NAME, $arrayStrLen['name']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_NAME).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['description'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION, $arrayStrLen['description']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION).'</a></div></div>';
				$headers['description'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION, $arrayStrLen['description']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['idProvider'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div></div>';
				$headers['idProvider'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['dateAdded'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div></div>';
				$headers['dateAdded'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div>';
			}

			if ($value == 'status')
			{
				if ($_GET['orderby'] == 'status')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=status&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=status&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=status&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['status'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_STATUS, $arrayStrLen['status']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_STATUS).'</a></div></div>';
				$headers['status'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_STATUS, $arrayStrLen['status']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_STATUS).'</a></div>';
			}

			if ($value == 'idCategory')
			{
				if ($_GET['orderby'] == 'category_name')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=category_name&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=category_name&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=category_name&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['idCategory'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CATEGORY, $arrayStrLen['idCategory']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CATEGORY).'</a></div></div>';
				$headers['idCategory'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CATEGORY, $arrayStrLen['idCategory']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CATEGORY).'</a></div>';
			}

			if ($value == 'listPrice')
			{
				if ($_GET['orderby'] == 'list_price')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=list_price&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=list_price&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=list_price&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['listPrice'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_LIST_PRICE, $arrayStrLen['listPrice']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_LIST_PRICE).'</a></div></div>';
				$headers['listPrice'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_LIST_PRICE, $arrayStrLen['listPrice']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_LIST_PRICE).'</a></div>';
			}

			if ($value == 'salePrice')
			{
				if ($_GET['orderby'] == 'sale_price')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=sale_price&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=sale_price&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=sale_price&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['salePrice'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_PRICE, $arrayStrLen['salePrice']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_PRICE).'</a></div></div>';
				$headers['salePrice'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_PRICE, $arrayStrLen['salePrice']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_PRICE).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['idUserAdd'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div></div>';
				$headers['idUserAdd'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div>';
			}
			if ($value == 'code')
			{
				if ($_GET['orderby'] == 'code')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=code&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=code&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=code&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}
				$head.= '<div class="col" style="width: '.$arrayWidth['code'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_CODE, $arrayStrLen['code']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_CODE).'</a></div></div>';
				$headers['code'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_CODE, $arrayStrLen['code']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_CODE).'</a></div>';
			}
			if ($value == 'dateSold')
			{
				if ($_GET['orderby'] == 'date_sold')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=date_sold&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=date_sold&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=date_sold&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}
				$head.= '<div class="col" style="width: '.$arrayWidth['dateSold'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_SOLD, $arrayStrLen['dateSold']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_SOLD).'</a></div></div>';
				$headers['dateSold'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_SOLD, $arrayStrLen['dateSold']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_SOLD).'</a></div>';
			}
			if ($value == 'dateChangeStatus')
			{
				if ($_GET['orderby'] == 'date_change_status')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=date_change_status&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=date_change_status&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=date_change_status&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				if(empty($changeStatusColumnLabel) == TRUE)
				{
				    $changeStatusColumnLabel = CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_CHANGE_STATUS;
				}


				$head.= '<div class="col" style="width: '.$arrayWidth['dateChangeStatus'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString($changeStatusColumnLabel, $arrayStrLen['dateChangeStatus']), $changeStatusColumnLabel).'</a></div></div>';
				$headers['dateChangeStatus'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString($changeStatusColumnLabel, $arrayStrLen['dateChangeStatus']), $changeStatusColumnLabel).'</a></div>';
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
				<form name="formQueryProduct" id="formQueryProduct" method="post" action="">
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
				<div class="message warning"><?php echo CPRODUCT_SHOW_QUERY_NOT_FOUND; ?></div>
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
					<div class="row row<?php echo $class; ?>" id="product_tr_<?php echo $row['id']; ?>" data-table-name="product" data-id="<?php echo $row['id']; ?>" data-form-id="formQueryProduct">
				<?php
				if (is_array($groupActions) === TRUE)
				{
				?>
						<div class="col header"></div>
						<div class="col" style="width: <?php echo $widthGroupActions; ?>;"><div class="group-actions"><input name="productGroup[]" type="checkbox" id="cb_product_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="checkboxClick(this)" /></div></div>
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

					if ($value == 'name')
					{
					?>
						<div class="col header"><?php echo $headers['name']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['name']; ?>;"><div class="str"><?php echo altText(getCutString($row['name'], $arrayStrLen['name']), $row['name']); ?></div></div>
					<?php
					}

					if ($value == 'description')
					{
					?>
						<div class="col header"><?php echo $headers['description']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['description']; ?>;"><div class="str"><?php echo altText(getCutString($row['description'], $arrayStrLen['description']), $row['description']); ?></div></div>
					<?php
					}

					if ($value == 'idProvider')
					{
					?>
						<div class="col header"><?php echo $headers['idProvider']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idProvider']; ?>;"><div class="str"><?php echo altText(getCutString($row['providerName'], $arrayStrLen['idProvider']), $row['providerName']); ?></div></div>
					<?php
					}

					if ($value == 'dateAdded')
					{
					?>
						<div class="col header"><?php echo $headers['dateAdded']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['dateAdded']; ?>;"><div class="date"><?php echo altText(getCutString($row['dateAdded'], $arrayStrLen['dateAdded']), $row['dateAdded']); ?></div></div>
					<?php
					}

					if ($value == 'status')
					{
					?>
						<div class="col header"><?php echo $headers['status']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['status']; ?>;"><div class="str"><?php echo altText(getCutString($this->getValuesStatus($row['status']), $arrayStrLen['status']), $this->getValuesStatus($row['status'])); ?></div></div>
					<?php
					}

					if ($value == 'idCategory')
					{
					?>
						<div class="col header"><?php echo $headers['idCategory']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idCategory']; ?>;"><div class="str"><?php echo altText(getCutString($row['categoryName'], $arrayStrLen['idCategory']), $row['categoryName']); ?></div></div>
					<?php
					}

					if ($value == 'listPrice')
					{
					?>
						<div class="col header"><?php echo $headers['listPrice']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['listPrice']; ?>;"><div class="num"><?php echo altText(getCutString($row['listPrice'], $arrayStrLen['listPrice']), $row['listPrice']); ?></div></div>
					<?php
					}

					if ($value == 'salePrice')
					{
					?>
						<div class="col header"><?php echo $headers['salePrice']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['salePrice']; ?>;"><div class="num"><?php echo altText(getCutString($row['salePrice'], $arrayStrLen['salePrice']), $row['salePrice']); ?></div></div>
					<?php
					}

					if ($value == 'idUserAdd')
					{
					?>
						<div class="col header"><?php echo $headers['idUserAdd']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idUserAdd']; ?>;"><div class="str"><?php echo altText(getCutString($row['userName'], $arrayStrLen['idUserAdd']), $row['userName']); ?></div></div>
					<?php
					}
					if ($value == 'code')
					{
					?>
						<div class="col header"><?php echo $headers['code']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['code']; ?>;"><div class="str"><?php echo altText(getCutString($row['code'], $arrayStrLen['code']), $row['code']); ?></div></div>
					<?php
					}
					if ($value == 'dateSold')
					{
					?>
						<div class="col header"><?php echo $headers['dateSold']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['dateSold']; ?>;"><div class="date"><?php echo altText(getCutString($row['dateSold'], $arrayStrLen['dateSold']), $row['dateSold']); ?></div></div>
					<?php
					}
					if ($value == 'dateChangeStatus')
					{
					?>
						<div class="col header"><?php echo $headers['dateChangeStatus']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['dateChangeStatus']; ?>;"><div class="date"><?php echo altText(getCutString($row['dateChangeStatus'], $arrayStrLen['dateChangeStatus']), $row['dateChangeStatus']); ?></div></div>
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
						<input name="product_select_all" type="checkbox" id="product_select_all" value="" class="checkbox_show_query" onclick="querySelectAll('product', 'formQueryProduct')" />
						<span><?php echo CPRODUCT_SHOW_QUERY_SELECT_ALL; ?></span>
					</div>
			<?php
			$j = 1;
			foreach ($groupActions as $value)
			{
				if ($value['confirm'] === TRUE)
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryProduct\', \''.$value['file'].'\', \''.$actionsParams.'\', true, \''.$value['msg'].'\');"';
				}
				else
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryProduct\', \''.$value['file'].'\', \''.$actionsParams.'\', false, \'\');"';
				}

				if ($value['button'] === TRUE)
				{
					echo '<input type="button" name="product_ga_'.$j.'" id="product_ga_'.$j.'" value="'.$value['text'].'" class="'.$value['class'].'" '.$onclick.' />';
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
	 * Muestra el resultado de una consulta a la tabla product
	 *
	 * Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla product. Muestra sólo los campos seteados en el parámetro $fields.
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
	 * Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST['productGroup'] (array)</b>
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
	public function showQuerySell($fields = '', $actions = '', $groupActions = '', $widthGroupActions = '', $showNavTop = TRUE, $showNavBottom = TRUE, $imagesNav = '', $showNavPages = TRUE, $showNavInfo = TRUE, $title = '', $amountPages = 0, $resultsPerPage = 0)
	{
	    if (is_array($fields) === FALSE)
	    {
	        unset($fields);
	        $fields[0]['field'] = 'id';
	        $fields[1]['field'] = 'name';
	        $fields[2]['field'] = 'description';
	        $fields[3]['field'] = 'idProvider';
	        $fields[4]['field'] = 'dateAdded';
	        $fields[5]['field'] = 'status';
	        $fields[6]['field'] = 'idCategory';
	        $fields[7]['field'] = 'listPrice';
	        $fields[8]['field'] = 'salePrice';
	        $fields[9]['field'] = 'idUserAdd';
	        $fields[10]['field'] = 'code';
	        $fields[11]['field'] = 'dateSold';
	        $fields[12]['field'] = 'dateChangeStatus';
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
	        $arrayOrder = array('id', 'name', 'description', 'id_provider', 'date_added', 'status', 'id_category', 'list_price', 'sale_price', 'id_user_add', 'code', 'date_sold', 'date_change_status');
	        array_push($arrayOrder, 'provider_name', 'category_name', 'user_name');

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

	            $head.= '<div class="col" style="width: '.$arrayWidth['id'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></div>';
	            $headers['id'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID).'</a></div>';
	        }

	        if ($value == 'name')
	        {
	            if ($_GET['orderby'] == 'name')
	            {
	                if ($_GET['ascdesc'] == 'ASC')
	                {
	                    $href = '?orderby=name&ascdesc=DESC';
	                }
	                else
	                {
	                    $href = '?orderby=name&ascdesc=ASC';
	                }
	            }
	            else
	            {
	                $href = '?orderby=name&ascdesc=ASC';
	            }
	            if ($this->getParams() != '')
	            {
	                $href.= '&'.$this->getParams();
	            }

	            $head.= '<div class="col" style="width: '.$arrayWidth['name'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_NAME, $arrayStrLen['name']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_NAME).'</a></div></div>';
	            $headers['name'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_NAME, $arrayStrLen['name']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_NAME).'</a></div>';
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

	            $head.= '<div class="col" style="width: '.$arrayWidth['description'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION, $arrayStrLen['description']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION).'</a></div></div>';
	            $headers['description'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION, $arrayStrLen['description']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DESCRIPTION).'</a></div>';
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

	            $head.= '<div class="col" style="width: '.$arrayWidth['idProvider'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div></div>';
	            $headers['idProvider'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div>';
	        }
	        if ($value == 'idClient')
	        {
	            $head.= '<div class="col" style="width: '.$arrayWidth['idClient'].';"><div class="str">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CLIENT, $arrayStrLen['idClient']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CLIENT).'</div></div>';
	            $headers['idClient'] = '<div class="str">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CLIENT, $arrayStrLen['idClient']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CLIENT).'</div>';
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

	            $head.= '<div class="col" style="width: '.$arrayWidth['dateAdded'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div></div>';
	            $headers['dateAdded'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED, $arrayStrLen['dateAdded']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED).'</a></div>';
	        }

	        if ($value == 'status')
	        {
	            if ($_GET['orderby'] == 'status')
	            {
	                if ($_GET['ascdesc'] == 'ASC')
	                {
	                    $href = '?orderby=status&ascdesc=DESC';
	                }
	                else
	                {
	                    $href = '?orderby=status&ascdesc=ASC';
	                }
	            }
	            else
	            {
	                $href = '?orderby=status&ascdesc=ASC';
	            }
	            if ($this->getParams() != '')
	            {
	                $href.= '&'.$this->getParams();
	            }

	            $head.= '<div class="col" style="width: '.$arrayWidth['status'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_STATUS, $arrayStrLen['status']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_STATUS).'</a></div></div>';
	            $headers['status'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_STATUS, $arrayStrLen['status']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_STATUS).'</a></div>';
	        }

	        if ($value == 'idCategory')
	        {
	            if ($_GET['orderby'] == 'category_name')
	            {
	                if ($_GET['ascdesc'] == 'ASC')
	                {
	                    $href = '?orderby=category_name&ascdesc=DESC';
	                }
	                else
	                {
	                    $href = '?orderby=category_name&ascdesc=ASC';
	                }
	            }
	            else
	            {
	                $href = '?orderby=category_name&ascdesc=ASC';
	            }
	            if ($this->getParams() != '')
	            {
	                $href.= '&'.$this->getParams();
	            }

	            $head.= '<div class="col" style="width: '.$arrayWidth['idCategory'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CATEGORY, $arrayStrLen['idCategory']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CATEGORY).'</a></div></div>';
	            $headers['idCategory'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CATEGORY, $arrayStrLen['idCategory']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_CATEGORY).'</a></div>';
	        }

	        if ($value == 'listPrice')
	        {
	            if ($_GET['orderby'] == 'list_price')
	            {
	                if ($_GET['ascdesc'] == 'ASC')
	                {
	                    $href = '?orderby=list_price&ascdesc=DESC';
	                }
	                else
	                {
	                    $href = '?orderby=list_price&ascdesc=ASC';
	                }
	            }
	            else
	            {
	                $href = '?orderby=list_price&ascdesc=ASC';
	            }
	            if ($this->getParams() != '')
	            {
	                $href.= '&'.$this->getParams();
	            }

	            $head.= '<div class="col" style="width: '.$arrayWidth['listPrice'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_LIST_PRICE, $arrayStrLen['listPrice']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_LIST_PRICE).'</a></div></div>';
	            $headers['listPrice'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_LIST_PRICE, $arrayStrLen['listPrice']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_LIST_PRICE).'</a></div>';
	        }

	        if ($value == 'salePrice')
	        {
	            if ($_GET['orderby'] == 'sale_price')
	            {
	                if ($_GET['ascdesc'] == 'ASC')
	                {
	                    $href = '?orderby=sale_price&ascdesc=DESC';
	                }
	                else
	                {
	                    $href = '?orderby=sale_price&ascdesc=ASC';
	                }
	            }
	            else
	            {
	                $href = '?orderby=sale_price&ascdesc=ASC';
	            }
	            if ($this->getParams() != '')
	            {
	                $href.= '&'.$this->getParams();
	            }

	            $head.= '<div class="col" style="width: '.$arrayWidth['salePrice'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_PRICE, $arrayStrLen['salePrice']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_PRICE).'</a></div></div>';
	            $headers['salePrice'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_PRICE, $arrayStrLen['salePrice']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_PRICE).'</a></div>';
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

	            $head.= '<div class="col" style="width: '.$arrayWidth['idUserAdd'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div></div>';
	            $headers['idUserAdd'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD, $arrayStrLen['idUserAdd']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD).'</a></div>';
	        }
	        if ($value == 'code')
	        {
	            if ($_GET['orderby'] == 'code')
	            {
	                if ($_GET['ascdesc'] == 'ASC')
	                {
	                    $href = '?orderby=code&ascdesc=DESC';
	                }
	                else
	                {
	                    $href = '?orderby=code&ascdesc=ASC';
	                }
	            }
	            else
	            {
	                $href = '?orderby=code&ascdesc=ASC';
	            }
	            if ($this->getParams() != '')
	            {
	                $href.= '&'.$this->getParams();
	            }
	            $head.= '<div class="col" style="width: '.$arrayWidth['code'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_CODE, $arrayStrLen['code']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_CODE).'</a></div></div>';
	            $headers['code'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_CODE, $arrayStrLen['code']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_CODE).'</a></div>';
	        }
	        if ($value == 'dateSold')
	        {
	            if ($_GET['orderby'] == 'date_sold')
	            {
	                if ($_GET['ascdesc'] == 'ASC')
	                {
	                    $href = '?orderby=date_sold&ascdesc=DESC';
	                }
	                else
	                {
	                    $href = '?orderby=date_sold&ascdesc=ASC';
	                }
	            }
	            else
	            {
	                $href = '?orderby=date_sold&ascdesc=ASC';
	            }
	            if ($this->getParams() != '')
	            {
	                $href.= '&'.$this->getParams();
	            }
	            $head.= '<div class="col" style="width: '.$arrayWidth['dateSold'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_SOLD, $arrayStrLen['dateSold']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_SOLD).'</a></div></div>';
	            $headers['dateSold'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_SOLD, $arrayStrLen['dateSold']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_SOLD).'</a></div>';
	        }
	        if ($value == 'dateChangeStatus')
	        {
	            if ($_GET['orderby'] == 'date_change_status')
	            {
	                if ($_GET['ascdesc'] == 'ASC')
	                {
	                    $href = '?orderby=date_change_status&ascdesc=DESC';
	                }
	                else
	                {
	                    $href = '?orderby=date_change_status&ascdesc=ASC';
	                }
	            }
	            else
	            {
	                $href = '?orderby=date_change_status&ascdesc=ASC';
	            }
	            if ($this->getParams() != '')
	            {
	                $href.= '&'.$this->getParams();
	            }
	            $head.= '<div class="col" style="width: '.$arrayWidth['dateChangeStatus'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_CHANGE_STATUS, $arrayStrLen['dateChangeStatus']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_CHANGE_STATUS).'</a></div></div>';
	            $headers['dateChangeStatus'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_CHANGE_STATUS, $arrayStrLen['dateChangeStatus']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_DATE_CHANGE_STATUS).'</a></div>';
	        }

	        if ($value == 'saleInfo')
	        {
	            $auxWidth = intval($arrayWidth['saleInfo']) / 3;

	            $head.= '<div class="col" style="width: '.$arrayWidth['saleInfo'].';"><div class="num">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_INFO_AMOUNT, $arrayStrLen['saleInfo']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_INFO_AMOUNT).'</div></div>';
	            $headers['saleInfo'] = '<div class="num">'.altText(getCutString(CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_INFO_AMOUNT, $arrayStrLen['saleInfo']), CPRODUCT_SHOW_QUERY_HEAD_FIELD_SALE_INFO_AMOUNT).'</div>';
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

	    //Solo productos vendidos
        $condition[] = $this->getFieldSql('status', $this->getTableName()).' = '.$this->getValueSql('sold');

        $this->setCondition(implode(' AND ', $condition));

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
				<form name="formQueryProduct" id="formQueryProduct" method="post" action="">
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
				<div class="message warning"><?php echo CPRODUCT_SHOW_QUERY_NOT_FOUND; ?></div>
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
					<div class="row row<?php echo $class; ?>" id="product_tr_<?php echo $row['id']; ?>" data-table-name="product" data-id="<?php echo $row['id']; ?>" data-form-id="formQueryProduct">
				<?php
				if (is_array($groupActions) === TRUE)
				{
				?>
						<div class="col header"></div>
						<div class="col" style="width: <?php echo $widthGroupActions; ?>;"><div class="group-actions"><input name="productGroup[]" type="checkbox" id="cb_product_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="checkboxClick(this)" /></div></div>
				<?php
				}

				$amountSale = 0;
				foreach ($arrayField as $value)
				{
					if ($value == 'id')
					{
					?>
						<div class="col header"><?php echo $headers['id']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['id']; ?>;"><div class="num"><?php echo altText(getCutString($row['id'], $arrayStrLen['id']), $row['id']); ?></div></div>
					<?php
					}

					if ($value == 'name')
					{
					?>
						<div class="col header"><?php echo $headers['name']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['name']; ?>;"><div class="str"><?php echo altText(getCutString($row['name'], $arrayStrLen['name']), $row['name']); ?></div></div>
					<?php
					}

					if ($value == 'description')
					{
					?>
						<div class="col header"><?php echo $headers['description']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['description']; ?>;"><div class="str"><?php echo altText(getCutString($row['description'], $arrayStrLen['description']), $row['description']); ?></div></div>
					<?php
					}

					if ($value == 'idProvider')
					{
					?>
						<div class="col header"><?php echo $headers['idProvider']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idProvider']; ?>;"><div class="str"><?php echo altText(getCutString($row['providerName'], $arrayStrLen['idProvider']), $row['providerName']); ?></div></div>
					<?php
					}

					if ($value == 'idClient')
					{
					    $clientName = '';

					    $sale = new Csale();
					    $sale->setDbConn($this->getDbConn());

					    $detail = new Cdetail();
					    $detail->setDbConn($this->getDbConn());

					    $provider = new Cprovider();
					    $provider->setDbConn($this->getDbConn());

					    $searcDetail = $detail->getFieldSql('id_product').' = '.$detail->getValueSql($row['id']);
					    $resDetail = $detail->getList($searcDetail);

					    if($resDetail)
					    {
					        $idSale = 0;
                            foreach($resDetail as $val)
                            {
                                $idSale = $val['idSale'];
                            }

                            if($idSale > 0)
                            {
                                $sale->setId($idSale);
                                if($sale->getData() == TRUE)
                                {
                                    $amountSale = $sale->getTotalAmountNet();
                                    if(empty($sale->getIdClient(FALSE)) == FALSE)
                                    {
                                        $provider->setId($sale->getIdClient(FALSE));
                                        if($provider->getData() == TRUE)
                                        {
                                            $clientName = $provider->getName();
                                        }
                                    }
                                    else
                                    {
                                        if(empty($sale->getCasualCustomer()) == FALSE)
                                        {
                                            $clientName = $sale->getCasualCustomer().' (no cliente)';
                                        }
                                    }
                                }
                            }
					    }


					    ?>
						<div class="col header"><?php echo $headers['idClient']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idClient']; ?>;"><div class="str"><?php echo altText(getCutString($clientName, $arrayStrLen['idClient']), $clientName); ?></div></div>
						<?php
					}

					if ($value == 'dateAdded')
					{
					?>
						<div class="col header"><?php echo $headers['dateAdded']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['dateAdded']; ?>;"><div class="date"><?php echo altText(getCutString($row['dateAdded'], $arrayStrLen['dateAdded']), $row['dateAdded']); ?></div></div>
					<?php
					}

					if ($value == 'status')
					{
					?>
						<div class="col header"><?php echo $headers['status']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['status']; ?>;"><div class="str"><?php echo altText(getCutString($this->getValuesStatus($row['status']), $arrayStrLen['status']), $this->getValuesStatus($row['status'])); ?></div></div>
					<?php
					}

					if ($value == 'idCategory')
					{
					?>
						<div class="col header"><?php echo $headers['idCategory']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idCategory']; ?>;"><div class="str"><?php echo altText(getCutString($row['categoryName'], $arrayStrLen['idCategory']), $row['categoryName']); ?></div></div>
					<?php
					}

					if ($value == 'listPrice')
					{
					?>
						<div class="col header"><?php echo $headers['listPrice']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['listPrice']; ?>;"><div class="num"><?php echo altText(getCutString($row['listPrice'], $arrayStrLen['listPrice']), $row['listPrice']); ?></div></div>
					<?php
					}

					if ($value == 'salePrice')
					{
					?>
						<div class="col header"><?php echo $headers['salePrice']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['salePrice']; ?>;"><div class="num"><?php echo altText(getCutString($row['salePrice'], $arrayStrLen['salePrice']), $row['salePrice']); ?></div></div>
					<?php
					}

					if ($value == 'idUserAdd')
					{
					?>
						<div class="col header"><?php echo $headers['idUserAdd']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idUserAdd']; ?>;"><div class="str"><?php echo altText(getCutString($row['userName'], $arrayStrLen['idUserAdd']), $row['userName']); ?></div></div>
					<?php
					}
					if ($value == 'code')
					{
					?>
						<div class="col header"><?php echo $headers['code']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['code']; ?>;"><div class="str"><?php echo altText(getCutString($row['code'], $arrayStrLen['code']), $row['code']); ?></div></div>
					<?php
					}
					if ($value == 'dateSold')
					{
					?>
						<div class="col header"><?php echo $headers['dateSold']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['dateSold']; ?>;"><div class="date"><?php echo altText(getCutString($row['dateSold'], $arrayStrLen['dateSold']), $row['dateSold']); ?></div></div>
					<?php
					}
					if ($value == 'dateChangeStatus')
					{
					?>
						<div class="col header"><?php echo $headers['dateChangeStatus']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['dateChangeStatus']; ?>;"><div class="date"><?php echo altText(getCutString($row['dateChangeStatus'], $arrayStrLen['dateChangeStatus']), $row['dateChangeStatus']); ?></div></div>
					<?php
					}
					if ($value == 'saleInfo')
					{
					    ?>
						<div class="col header"><?php echo $headers['saleInfo']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['saleInfo']; ?>;"><div class="num"><?php echo altText(getCutString($amountSale, $arrayStrLen['saleInfo']), $amountSale); ?></div></div>
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
						<input name="product_select_all" type="checkbox" id="product_select_all" value="" class="checkbox_show_query" onclick="querySelectAll('product', 'formQueryProduct')" />
						<span><?php echo CPRODUCT_SHOW_QUERY_SELECT_ALL; ?></span>
					</div>
			<?php
			$j = 1;
			foreach ($groupActions as $value)
			{
				if ($value['confirm'] === TRUE)
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryProduct\', \''.$value['file'].'\', \''.$actionsParams.'\', true, \''.$value['msg'].'\');"';
				}
				else
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryProduct\', \''.$value['file'].'\', \''.$actionsParams.'\', false, \'\');"';
				}

				if ($value['button'] === TRUE)
				{
					echo '<input type="button" name="product_ga_'.$j.'" id="product_ga_'.$j.'" value="'.$value['text'].'" class="'.$value['class'].'" '.$onclick.' />';
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
	 * Muestra un listado de la tabla product en un campo select
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

	/**
	 * Muestra el estado del Proveedor/Cliente
	 *
	 * @param int $idProvider ID del proveedor sobre el que muestro
	 * @param Array [opcional] $selectedValuesBack Valos selectos
	 * * @param Array [opcional] $selectedValuesPay Valos selectos
	 * @param string [opcional] $auxFilter Filtro en la consulta de los productos del proveedor
	 */
	public function showProviderProductTable($idProvider, $selectedValuesBack = array(), $selectedValuesPay = array(), $auxFilter = '')
	{
	    $arrayProductPayed = array();
	    $arrayProductBacked= array();
	    $auxPaymentType    = 'cash';

	    if(isset($_POST['addPayment']) == FALSE)
	    {
	        $_POST['addPayment'] = '';
	    }

	    if($_POST['addPayment'] == 'back')
	    {
	        if(empty($_POST['productsBackGroup']) == FALSE)
	        {
	            $_POST['productsBackGroup'] = explode(',',$_POST['productsBackGroup']);
	        }

	        if(empty($_POST['productsPayGroup']) == FALSE)
	        {
	            $_POST['productsPayGroup'] = explode(',',$_POST['productsPayGroup']);
	        }

	        if(empty($_POST['type_pay']) == FALSE)
	        {
	            $auxPaymentType = $_POST['type_pay'];
	        }
	    }

	    if(empty($_POST['idPayment']) == FALSE)
	    {
            $detailPayment = new Cdetail_payment($this->getDbConn());
            $detailPayment->setIdPayment($_POST['idPayment']);

            $products = $detailPayment->getListByIdPayment();

            foreach ($products as $prod)
            {
                if($prod['type'] == 'payed')
                {
                    $arrayProductPayed[] = $prod['idProduct'];
                }
                else
                {
                    $arrayProductBacked[] = $prod['idProduct'];
                }
            }

            if(empty($_POST['productsBackGroup']) == TRUE and $_POST['addPayment'] != 'back')
            {
                $_POST['productsBackGroup'] = $arrayProductBacked;
            }

            if(empty($_POST['productsPayGroup']) == TRUE and $_POST['addPayment'] != 'back')
            {
                $_POST['productsPayGroup'] = $arrayProductPayed;
            }

            $movement = new Cmovement($this->getDbConn());
            $movement->setIdPayment($_POST['idPayment']);
            $movement->getDataByIdPayment();

            if($movement->getTypePay(FALSE) == 'cta_cte' and $_POST['addPayment'] != 'back')
            {
                $auxPaymentType    = 'cta_cte';
            }
	    }

	    $product = new Cproduct($this->getDbConn());

	    ?>
	    <div class="boxProducts">
		<div class="top">
		    <div class="title left">Listado de productos</div>
		    <div class="clear"></div>
		</div>
		<?php
		//Productos para devolver
		$serach = $this->getFieldSql('id_provider', $this->getTableName()).' = '.$product->getValueSql($idProvider);
		$serach .= ' AND '.$this->getFieldSql('status', $this->getTableName()).' = '.$product->getValueSql('give_back');

		if(empty($auxFilter) == FALSE)
		{
		    $serach .= ' AND '.$auxFilter;
		}
		if(is_array($arrayProductBacked) == TRUE and count($arrayProductBacked) > 0)
		{
		    //$serach .= ' OR ('.$this->getFieldSql('status', $this->getTableName()).' = '.$product->getValueSql('returned').' AND '.$this->getFieldSql('id', $this->getTableName()).' IN('.implode(', ', $arrayProductBacked).'))';
		    //Con la devolución puede cambair el estado de returned a otros estaod pero sigue siendo aprte de lo que se rindió.
		    $serach .= ' OR '.$this->getFieldSql('id', $this->getTableName()).' IN('.implode(', ', $arrayProductBacked).')';
		}
		?>
		<div class="wrapperProducts">
		    <div class="aux"></div>
		    <div class="title">
			<div class="ico"></div>
			<div class="label">Productos a devolver</div>
			<div class="filter"></div>
		    </div>
		    <div id="formQueryProductBack" class="form query">
			<div class="data">
			    <div class="row header">
				<div class="col" style="width: 3%;">&nbsp;</div>
				<div class="col left" style="width: 6%;"><div class="num">Código</div></div>
				<div class="col left" style="width: 67%;"><div class="str">Prenda</div></div>
				<div class="col left" style="width: 14%;"><div class="date">Ingreso</div></div>
				<div class="col left" style="width: 10%;"><div class="str">Donar</div></div>
				<div class="clear"></div>
			    </div>
		<?php
		$amountSelectds = 0;
		$list = $this->getList($serach);
		if (is_array($list) === TRUE and count($list) > 0)
		{
		    $i = 1;
		    foreach($list as $val)
		    {
    			$selectd = '';
    			if(empty($_POST['productsBackGroup']) == FALSE and is_array($_POST['productsBackGroup']) == TRUE)
    			{
    			    if(in_array($val['id'], $_POST['productsBackGroup']) == TRUE)
    			    {
        				$selectd = ' checked="checked"';

        				$amountSelectds++;
    			    }
    			}
    			?>
    			<div class="row row<?php echo $i; ?>" id="product_back_tr_<?php echo $val['id']; ?>" data-table-name="product_back" data-id="<?php echo $val['id']; ?>" data-form-id="formQueryProductBack">
    			    <div class="col header">&nbsp;</div>
    			    <div class="col" style="width: 3%;"><div class="group-actions"><input name="productsBackGroup[]" type="checkbox" id="cb_product_back_<?php echo $val['id']; ?>" class="productBack" value="<?php echo $val['id']; ?>" onclick="checkboxClick(this)"<?php echo $selectd; ?> /></div></div>
    			    <div class="col header"><div class="num">Código</div></div>
    			    <div class="col left" style="width: 6%;"><div class="num"><?php echo $val['id']; ?></div></div>
    			    <div class="col header"><div class="str">Prenda</div></div>
    			    <div class="col left" style="width: 67%;"><div class="str"><?php echo $val['name']; ?></div></div>
    			    <div class="col header"><div class="date">Ingreso</div></div>
    			    <div class="col left" style="width: 14%;"><div class="date"><?php echo $val['dateAdded']; ?></div></div>
    			    <div class="col header"><div class="str">Donar</div></div>
    			    <div class="col left" style="width: 10%;">
    			    	<div class="str">
    			    		<select name="donar_<?php echo $val['id']; ?>" class="donate">
    			    			<option value=""></option>
    			    			<option value="yes" <?php echo $val['status'] == 'donate'? 'selected="selected"': ''; ?>>Sí</option>
    			    		</select>
    			    	</div>
    			    </div>
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
		    }

		    $selectd = '';
		    if($amountSelectds == count($list))
		    {
                $selectd = ' checked="checked"';
		    }
		    ?>
		    <div class="buttons">
			<div class="group-actions">
				<input name="product_back_select_all" type="checkbox" id="product_back_select_all" value="" class="checkbox_show_query productBackAll" onclick="querySelectAll2('product_back', 'formQueryProductBack')" <?php echo $selectd; ?>/>
				<span><?php echo CPRODUCT_SHOW_PROVIDER_PRODUCT_TABLE_SELECT_ALL; ?></span>
			</div>
			<div class="clear"></div>
		    </div>
		    <?php
		}
		else
		{
		    ?>
			    <div class="message warning"><?php echo CPRODUCT_SHOW_PROVIDER_PRODUCT_TABLE_NOT_PROVIDER_PRODUCT_TO_BACK; ?></div>
		    <?php
		}

		?>
			</div>
		    </div>
		</div>
		<?php
		//Productos para pagar
		$serach = $this->getFieldSql('id_provider', $this->getTableName()).' = '.$product->getValueSql($idProvider);
		$serach .= ' AND ('.$this->getFieldSql('status', $this->getTableName()).' = '.$product->getValueSql('to_pay').' OR '.$this->getFieldSql('status', $this->getTableName()).' = '.$product->getValueSql('sold').')';

		if(empty($auxFilter) == FALSE)
		{
		    $serach .= ' AND '.$auxFilter;
		}
        if(is_array($arrayProductPayed) == TRUE and count($arrayProductPayed) > 0)
        {
            //$serach .= ' OR ('.$this->getFieldSql('status', $this->getTableName()).' = '.$product->getValueSql('paid_out').' AND '.$this->getFieldSql('id', $this->getTableName()).' IN('.implode(', ', $arrayProductPayed).'))';
            $serach .= ' OR '.$this->getFieldSql('id', $this->getTableName()).' IN('.implode(', ', $arrayProductPayed).')';
        }
		?>
		<div class="wrapperProducts">
		    <div class="aux"></div>
		    <div class="title">
			<div class="ico"></div>
			<div class="label">Productos a pagar</div>
			<div class="filter"></div>
		    </div>
		    <div id="formQueryProductPay" class="form query">
		    <div class="table_notice">
		    	<span>* Porcentaje para proveedora</span>
		    </div>
			<div class="data">
			    <div class="row header">
    				<div class="col" style="width: 3%;">&nbsp;</div>
    				<div class="col left" style="width: 6%;"><div class="num">Código</div></div>
    				<div class="col left" style="width: 40%;"><div class="str">Prenda</div></div>
    				<div class="col left" style="width: 14%;"><div class="date">Venta</div></div>
    				<div class="col left" style="width: 17%;"><div class="str">Precio</div></div>
    				<div class="col left" style="width: 10%;"><div class="str">Efvo.</div></div>
    				<div class="col left" style="width: 10%;"><div class="str">Cta. Cte.</div></div>
    				<div class="clear"></div>
			    </div>
		<?php
		$amountSelectds = 0;
		$list = $this->getList($serach);
		if (is_array($list) === TRUE and count($list) > 0)
		{

		    $i = 1;
		    foreach($list as $val)
		    {
    			$selectd = '';
		        if(empty($_POST['productsPayGroup']) == FALSE and is_array($_POST['productsPayGroup']) == TRUE)
    			{
    			    if(in_array($val['id'], $_POST['productsPayGroup']) == TRUE)
    			    {
        				$selectd = ' checked="checked"';

        				$amountSelectds++;
    			    }
    			}
    			if(empty($_POST['amount_'.$val['id']]) == TRUE)
    			{
    			    $_POST['amount_'.$val['id']] = $val['listPrice'];
    			}
    			?>
    			<div class="row row<?php echo $i; ?>" id="product_pay_tr_<?php echo $val['id']; ?>" data-table-name="product_pay" data-id="<?php echo $val['id']; ?>" data-form-id="formQueryProductPay">
    			    <div class="col header">&nbsp;</div>
    			    <div class="col" style="width: 3%;"><div class="group-actions"><input name="productsPayGroup[]" type="checkbox" id="cb_product_pay_<?php echo $val['id']; ?>" class="productPay" value="<?php echo $val['id']; ?>" onclick="checkboxClick(this)"<?php echo $selectd; ?> /></div></div>
    			    <div class="col header"><div class="num">Código</div></div>
    			    <div class="col left" style="width: 6%;"><div class="num"><?php echo $val['id']; ?></div></div>
    			    <div class="col header"><div class="str">Prenda</div></div>
    			    <div class="col left" style="width: 40%;"><div class="str"><?php echo $val['name']; ?></div></div>
    			    <div class="col header"><div class="date">Venta</div></div>
    			    <div class="col left" style="width: 14%;"><div class="date"><?php echo $val['dateSold']; ?></div></div>
    			    <div class="col header"><div class="str">Precio</div></div>
    			    <div class="col left" style="width: 17%;"><div class="str"><input name="amount_<?php echo $val['id']; ?>" id="amount_<?php echo $val['id']; ?>" value="<?php echo $_POST['amount_'.$val['id']];?>" class="amountInput" maxlength="255" type="text" /></div></div>
    			    <div class="col header"><div class="str">Efvo.</div></div>
    			    <div class="col left" style="width: 10%;"><div class="str"><?php echo numberFormat($_POST['amount_'.$val['id']] * CASH_COMMISSION);?></div></div>
    			    <div class="col header"><div class="str">Cta. Cte.</div></div>
    			    <div class="col left" style="width: 10%;"><div class="str"><?php echo numberFormat($_POST['amount_'.$val['id']] * CURRENT_ACCOUNT_COMMISSION);?></div></div>
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
		    }

		    $selectd = '';
		    if($amountSelectds == count($list))
		    {
                $selectd = ' checked="checked"';
		    }
		    ?>
		    <div class="buttons">
    			<div class="group-actions">
    				<input name="product_pay_select_all" type="checkbox" id="product_pay_select_all" value="" class="checkbox_show_query productPayAll" onclick="querySelectAll2('product_pay', 'formQueryProductPay')" <?php echo $selectd; ?>/>
    				<span><?php echo CPRODUCT_SHOW_PROVIDER_PRODUCT_TABLE_SELECT_ALL; ?></span>
    			</div>
    			<div class="clear"></div>
		    </div>
		    <?php
		}
		else
		{
		    ?>
			    <div class="message warning"><?php echo CPRODUCT_SHOW_PROVIDER_PRODUCT_TABLE_NOT_PROVIDER_PRODUCT_TO_PAY; ?></div>
		    <?php
		}

		?>
		    </div>
		</div>
		<div id="controlWrapper">
		    <div class="left col50">
    			<h2>Productos a devolver</h2>
    			<span id="productToBackControl">0</span>
		    </div>
		    <div class="left col50">
    			<h2>Total a pagar</h2>
    			<fieldset>
    			    <legend>Seleccione forma de pago: </legend>
    			    <label for="cash">Efectivo: <span id="productToPayControlCash">$ 0</span></label>
    			    <?php
    			    $selectedCash = '';
    			    if($auxPaymentType == 'cash')
    			    {
    			        $selectedCash = ' checked="checked"';
    			    }
    			    ?>
    			    <input type="radio" name="type_pay_btn" id="cash" class="btnPay"<?php echo $selectedCash; ?>>
    			    <label for="cta_cte">Cta. Cte.: <span id="productToPayControlCtaCte">$ 0</span></label>
    			    <?php
    			    $selectedCtaCte = '';
    			    if($auxPaymentType == 'cta_cte')
    			    {
    			        $selectedCtaCte = ' checked="checked"';
    			    }
    			    ?>
    			    <input type="radio" name="type_pay_btn" id="cta_cte" class="btnPay"<?php echo $selectedCtaCte; ?>>
    			</fieldset>
    			<input type="hidden" id="type_pay" name="type_pay" value="<?php echo $auxPaymentType; ?>" />
    			<input type="hidden" id="total_cash" name="total_cash" value="" />
    			<input type="hidden" id="total_cta_cte" name="total_cta_cte" value="" />
    			<input type="hidden" id="cash_commission" name="cash_commission" value="<?php echo CASH_COMMISSION; ?>" />
    			<input type="hidden" id="current_account_commission" name="current_account_commission" value="<?php echo CURRENT_ACCOUNT_COMMISSION; ?>" />
		    </div>
		    <div class="clear"></div>
		</div>
		<script type="text/javascript">
		$(document).ready(function() {
		    $( ".btnPay" ).checkboxradio({
				icon: false
		    });
		    $( "fieldset" ).controlgroup();
		});
		</script>
	    </div>
	    </div>
	    <?php
	}

	/**
	 * Muestra los productos vendidos en una venta
	 *
	 * @param int $idSale ID de la venta
	 * @param string [opcional] $auxFilter Filtor sobre los productos de la venta
	 */
	public function showSaleProductTable($idSale, $selectedValues = array(), $auxFilter = '')
	{
	    $detail        = new Cdetail($this->getDbConn());
	    $detailRefund  = new Cdetail_refund($this->getDbConn());
	    $refund        = new Crefund($this->getDbConn());
	    $sale          = new Csale($this->getDbConn());

	    $sale->setId($idSale);
	    if($sale->getData() == FALSE)
	    {
	        ?>
            <div class="message warning"><?php echo CPRODUCT_SHOW_SALE_PRODUCT_TABLE_NO_ID; ?></div>
            <?php
            return FALSE;
	    }
	    ?>
	    <div class="boxProducts">
		<div class="top">
		    <div class="title left">Listado de productos</div>
		    <div class="clear"></div>
		</div>
		<?php
		//Productos vendidos
		$search   = $detail->getFieldSql('id_sale', $detail->getTableName()).' = '.$detail->getValueSql($sale->getId(FALSE));
		$rs       = $detail->getList($search, 0, 0, '', FALSE);
		$productsSale = array();

		if ($detail->getTotalList() > 0)
		{
		    foreach ($rs as $item)
		    {
		        $productsSale[] = $item['idProduct'];
		    }
		}

		//Productos devueltos
		$search       = $refund->getFieldSql('id_sale', $refund->getTableName()).' = '.$refund->getValueSql($sale->getId(FALSE));
		$rs           = $refund->getList($search, 0, 0, '', FALSE);
		$refundArray  = array();

		if ($refund->getTotalList() > 0)
		{
		    foreach ($rs as $item)
		    {
		        $refundArray[] = $item['id'];
		    }
		}


		$search           = $detailRefund->getFieldSql('id_refund', $detailRefund->getTableName()).' IN ('.implode(', ', $refundArray).')';
		$rs               = $detailRefund->getList($search, 0, 0, '', FALSE);
		$productsBacked   = array();

		if ($detailRefund->getTotalList() > 0)
		{
		    foreach ($rs as $item)
		    {
		        $productsBacked[] = $item['idProduct'];
		    }
		}

		$serach = $this->getFieldSql('id', $this->getTableName()).' IN ('.implode(', ', $productsSale).')';
		/*if(is_array($productsBacked) == TRUE and count($productsBacked) > 0)
		{
		    $serach .= ' AND '.$this->getFieldSql('id', $this->getTableName()).' NOT IN('.implode(', ', $productsBacked).')';
		}*/

		if(empty($auxFilter) == FALSE)
		{
		    $serach .= ' AND '.$auxFilter;
		}
		?>
		<div class="wrapperProducts">
		    <div class="aux"></div>
		    <div class="title">
    			<div class="ico"></div>
    			<div class="label">Productos de la venta</div>
    			<div class="filter"></div>
		    </div>
		    <div id="formQueryProductRefund" class="form query">
    			<div class="data">
    			    <div class="row header">
        				<div class="col" style="width: 3%;">&nbsp;</div>
        				<div class="col" style="width: 6%;"><div class="num">ID</div></div>
        				<div class="col" style="width: 14%;"><div class="date">Fecha</div></div>
        				<div class="col" style="width: 55%;"><div class="str">Nombre</div></div>
        				<div class="col" style="width: 10%;"><div class="num">Monto</div></div>
        				<div class="col" style="width: 10%;"><div class="num">Monto Pagado</div></div>
        				<div class="col" style="width: 2%;"><div class="action"></div></div>
        				<div class="clear"></div>
    			    </div>
            		<?php
            		$amountSelectds   = 0;
            		$list             = $this->getList($serach);
            		if (is_array($list) === TRUE and count($list) > 0)
            		{
            		    $i = 1;
            		    foreach($list as $val)
            		    {
            		        $returned = '';
                			$selectd  = '';
                			if(empty($selectedValues) == FALSE and is_array($selectedValues) == TRUE and count($selectedValues) > 0)
                			{
                			    if(in_array($val['id'], $selectedValues) == TRUE)
                			    {
                    				$selectd = ' checked="checked"';

                    				$amountSelectds++;
                			    }
                			}

                			$detail = new Cdetail($this->getDbConn());
                			$detail->setIdProduct($val['id']);
                			$detail->setIdSale($sale->getId(FALSE));
                			$auxAmount = 0;
                			$amountPayed = 0;
                			if($detail->getData() == TRUE)
                			{
                			    $auxAmount = $detail->getAmount(FALSE);
                			    $amountPayed = ($sale->getTotalAmountNet() * (($detail->getAmount() * 100) / $sale->getTotalAmountGross())) / 100;
                			}

                			if(in_array($val['id'], $productsBacked) == TRUE)
                			{
                			    $returned = ' [devuelto]';
                			}
                			?>
                			<div class="row row<?php echo $i; ?>" id="product_refund_tr_<?php echo $val['id']; ?>" data-table-name="product_refund" data-id="<?php echo $val['id']; ?>" data-form-id="formQueryProductRefund">
                			    <div class="col header">&nbsp;</div>
                			    <div class="col" style="width: 3%;">
                			    	<div class="group-actions">
                			    		<?php if(in_array($val['id'], $productsBacked) == FALSE): ?>
                			    		<input name="productsRefundGroup[]" type="checkbox" id="cb_product_refund_<?php echo $val['id']; ?>" class="productRefund" value="<?php echo $val['id']; ?>" onclick="checkboxClick(this)"<?php echo $selectd; ?> />
                			    		<?php else:?>
                			    		&nbsp;
                			    		<?php endif;?>
                			    	</div>
                			   </div>
                			    <div class="col header"><div class="num">ID</div></div>
                			    <div class="col left" style="width: 6%;"><div class="num"><?php echo $val['id']; ?></div></div>
                			    <div class="col header"><div class="date">Fecha</div></div>
                			    <div class="col left" style="width: 14%;"><div class="date"><?php echo $val['dateAdded']; ?></div></div>
                			    <div class="col header"><div class="str">Nombre</div></div>
                			    <div class="col left" style="width: 55%;"><div class="str"><?php echo $val['name'].$returned; ?></div></div>
                			    <div class="col header"><div class="num">Monto</div></div>
                			    <div class="col left" style="width: 10%;"><div class="num"><?php echo $auxAmount; ?></div></div>
                			    <div class="col header"><div class="num">Monto Pagado</div></div>
                			    <div class="col left" style="width: 10%;"><div class="num"><?php echo $amountPayed; ?></div></div>
                			    <div class="col action" style="width: 2%;">&nbsp;</div>
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
            		    }

            		    $selectd = '';
            		    if($amountSelectds == count($list))
            		    {
                            $selectd = ' checked="checked"';
            		    }
            		    ?>
            		    <div class="buttons">
                			<div class="group-actions">
                				<input name="product_refund_select_all" type="checkbox" id="product_refund_select_all" value="" class="checkbox_show_query productRefundAll" onclick="querySelectAll2('product_refund', 'formQueryProductRefund')" <?php echo $selectd; ?>/>
                				<span><?php echo CPRODUCT_SHOW_PROVIDER_PRODUCT_TABLE_SELECT_ALL; ?></span>
                			</div>
                			<div class="clear"></div>
            		    </div>
            		    <?php
            		}
            		else
            		{
            		    ?>
            			    <div class="message warning"><?php echo CPRODUCT_SHOW_PROVIDER_PRODUCT_TABLE_NOT_PROVIDER_PRODUCT_TO_BACK; ?></div>
            		    <?php
            		}

            		?>
    			</div>
			</div>
		</div>
		</div>
	    <?php
	}

	/**
	 * Me da lo que le debemos ahora al proveedor (to_pay y sold)
	 *
	 * De cada una de las opciones anteriores, nos da la posibilidad de si lo quiere en efvo o en cta cte. Por ese motivo nos deviuelve 4 valores.
	 *
	 * Primer valor (key 0) es el total que le tenemos que pagar en efvo.
	 * Segundo valor (key 1) es el total que le tenemos que pagar si lo quiere en cta cte.
	 *
	 * @param int $idProvider [opcional] ID del proveedor
	 *
	 * @return boolean
	 */
	public function getProviderStatus($idProvider = '', $dateStart = '', $dateEnd = '')
	{
	    $TOTAL  = 0;
	    //$TOTAL2 = 0;

	    $auxDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);

	    $search = $this->getFieldSql('status', $this->getTableName()).' IN ('.$this->getValueSql('to_pay').', '.$this->getValueSql('sold').')';
	    $aux    = ' AND ';
	    if(empty($idProvider) == FALSE)
	    {
            $search .= $aux.$this->getFieldSql('id_provider', $this->getTableName()).' = '.$this->getValueSql($idProvider);
	    }

	    if(empty($dateStart) == FALSE)
	    {
            $auxDate->setStrDate($dateStart);
            $search .= $aux.$this->getFieldSql('date_sold', $this->getTableName()).' >= '.$this->getValueSql($auxDate->getDbDate());
	    }

	    if(empty($dateEnd) == FALSE)
	    {
            $auxDate->setStrDate($dateEnd);
            $search .= $aux.$this->getFieldSql('date_sold', $this->getTableName()).' <= '.$this->getValueSql($auxDate->getDbDate());
	    }

	    $list	= $this->getList($search, 0, 0, '');

	    if($list != FALSE)
	    {
    		if(is_array($list) == TRUE and count($list) > 0)
    		{
    		    foreach ($list as $row)
    		    {
    		        $TOTAL += $row['listPrice'];
    		    }
    		}
	    }

	    /**
	     * [0] Lo que hay que pagar si es en efvo
	     * [1] Lo que hay que apgar si es en cta cte
	     */
	    return array(numberFormat($TOTAL*CASH_COMMISSION), numberFormat($TOTAL*CURRENT_ACCOUNT_COMMISSION));

	}

	/**
	 * Cambia el estado de los productos
	 */
	public function changeStatus($status, $dateAdded = '')
	{
	    if(empty($this->id) == FALSE and empty($status) == FALSE)
	    {
	        if($this->getData() == TRUE)
	        {
	            $oldStatus = $this->getStatus(FALSE);

	            if($oldStatus != $status)
	            {
	                //Si no viene la fecha pongo la de hoy
	                if(empty($dateAdded) == TRUE)
	                {
	                    $dateAdded = date($this->getDbConn()->fmtDate);
	                }

	                //Suele venir con comillas la fecha, se las saco
	                $dateAdded = str_replace("'", '', $dateAdded);

	                $this->setStatus($status);

	                if($status == 'sold')
	                {
	                    $this->setDateSold($dateAdded, TRUE);
	                }
	                elseif($status == 'exhibited')
	                {
	                    $this->setDateSold(NULL, TRUE);
	                }

	                $this->setDateChangeStatus($dateAdded, TRUE);

	                $this->update();
	            }
	        }
	    }
	}

	/**
	 * Verifica si un producto tiene refund para una venta
	 *
	 * @param int $idSale ID de la sale
	 *
	 * @return boolean
	 */
	public function isRefunded($idSale)
	{
	    if(empty($this->id) == FALSE and empty($idSale) == FALSE)
	    {
	        $refund = new Crefund($this->getDbConn());
	        $search = $refund->getFieldSql('id_sale', $refund->getTableName()).' = '.$refund->getValueSql($idSale);
	        $list   = $refund->getList($search);

	        if ($refund->getTotalList() > 0)
	        {
	            foreach ($list as $val)
	            {
                    $detailRefund = new Cdetail_refund($this->getDbConn());
                    $detailRefund->setIdRefund($val['id']);
                    $detailRefund->setIdProduct($this->id);
                    if($detailRefund->getData() == TRUE)
                    {
                        return TRUE;
                    }
	            }
	        }
	    }

	    return FALSE;
	}

	/**
	 * Verifica si un producto tiene payment para una venta
	 *
	 * @param int $idSale ID de la sale
	 *
	 * @return boolean
	 */
	public function isPayed($idSale)
	{
	    if(empty($this->id) == FALSE and empty($idSale) == FALSE)
	    {
	        $detailPayment = new Cdetail_payment($this->getDbConn());
	        $search        = $detailPayment->getFieldSql('id_sale', $detailPayment->getTableName()).' = '.$detailPayment->getValueSql($idSale).' AND '.$detailPayment->getFieldSql('id_product', $detailPayment->getTableName()).' = '.$detailPayment->getValueSql($this->getId(FALSE));
	        $list          = $detailPayment->getList($search);

	        if ($detailPayment->getTotalList() > 0)
	        {
	            return TRUE;
	        }
	    }

	    return FALSE;
	}

	/**
	 * Devuelve el HTML del PSEUDOANALITICO para enviarlo vía email
	 *
	 * @param int $idUser ID del alumno del que quiero el analítico
	 * @param boolean [opcional] $fromMoodle Define si viene desde la Moodle (TRUE)
	 */
	public function getChangeStatusEmailContent($idProvider, $idProds)
	{
	    global $dbConn;

	    $provider = new Cprovider($dbConn);
	    $provider->setId($idProvider);
	    if($provider->getData() == FALSE)
	    {
	        return;
	    }

	    $html = '';

	    $html .= '<div style="border: 1px solid #E5E5E5; border-radius: 1px; box-shadow: 0 1px 1px rgba(0,0,0,0.05);">';
	    $html .= '<div style="height: 35px !important; background: url('.ADMIN_URL.'img/ico-profile.png) no-repeat 11px center; line-height: 35px; border-bottom: 1px solid #E5E5E5; border-top: 0 !important; padding-left: 38px; padding-right: 15px;">';
	    $html .= '    <div style="font-size: 15px; font-weight: bold; color: #333333; background: none; float: left; font-family: Arial, Helvetica, sans-serif;">'.$provider->getName().'</div>';
	    $html .= '    <div style="height: 0; clear: both; overflow: hidden;"></div>';
	    $html .= '</div>';

	    //Traigo los productos
	    $search = $this->getFieldSql('id', $this->getTableName()).' IN ('.implode(', ', $idProds).')';

	    $list = $this->getList($search);
	    if (is_array($list) === TRUE and count($list) > 0)
	    {
	        $html .= '<div style="width: 98%; margin: 15px; border: 1px solid #E5E5E5; border-radius: 1px; box-shadow: 0 1px 1px rgba(0,0,0,0.05);">';
	        $html .= '    <div style=" height: 32px; position: absolute; left: 62px; border-left: 1px solid #DADADA; border-right: 1px solid #FFF;"></div>';
	        $html .= '    <div style="height: 31px; border-top: 1px solid #FFF; border-left: 1px solid #FFF; border-right: 1px solid #FFF; background-color: #E8E8E8; background-image: linear-gradient(#FAFAFA, #E8E8E8);">';
	        $html .= '        <div style="width: 35px; height: 31px; float: left; background: url('.ADMIN_URL.'img/form-query.png) no-repeat center;"></div>';
	        $html .= '        <div style=" float: left; padding-left: 13px; line-height: 31px; font-size: 17px; color: #666666; font-family: Arial, Helvetica, sans-serif;">Productos</div>';
	        $html .= '        <div style="height: 31px; float: right; padding-right: 13px; line-height: 31px; font-size: 1.7em; color: #337BB7;"></div>';
	        $html .= '    </div>';
	        $html .= '    <div>';
	        $html .= '        <div style="cursor: default; background-color: #000000;">';
	        $html .= '        <div style="box-sizing: border-box; border-right: 1px solid #FFF; background-color: #000000; height: 39px; line-height: 39px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 15px; color: #FFF; float: left; width: 10%;"><div style="text-align: right; padding: 0 10px;">ID</div></div>';
	        $html .= '        <div style="box-sizing: border-box; border-right: 1px solid #FFF; background-color: #000000; height: 39px; line-height: 39px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 15px; color: #FFF; float: left; width: 50%;"><div style="text-align: left; padding: 0 10px;">Nombre</div></div>';
	        $html .= '        <div style="box-sizing: border-box; border-right: 1px solid #FFF; background-color: #000000; height: 39px; line-height: 39px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 15px; color: #FFF; float: left; width: 20%;"><div style="text-align: center; padding: 0 10px;">Estado</div></div>';
	        $html .= '        <div style="box-sizing: border-box; border-right: 1px solid #FFF; background-color: #000000; height: 39px; line-height: 39px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 15px; color: #FFF; float: left; width: 20%;"><div style="text-align: center; padding: 0 10px;">Cambio Estado</div></div>';
	        $html .= '        <div style="height: 0; clear: both; overflow: hidden;"></div>';
	        $html .= '    </div>';

	        $i = 1;

	        $auxRowClass[1] = 'background-color: #FFF3C8; border-top: 1px solid #F6FAFD; border-bottom: 1px solid #CFDBE6;';
	        $auxRowClass[2] = 'background-color: #FFFBEC; border-top: 1px solid #FAFCFE; border-bottom: 1px solid #C4D5E4;';

	        foreach($list as $val)
	        {
                $html .= '<div style="cursor: default; '.$auxRowClass[$i].'">';
                $html .= '  <div style="height: 30px; float: left; line-height: 30px; overflow: hidden; font-family: Verdana; font-size: 13px; color: #1C4971; width: 10%;"><div style="text-align: right; padding: 0 10px;">'.$val['id'].'</div></div>';
                $html .= '  <div style="height: 30px; float: left; line-height: 30px; overflow: hidden; font-family: Verdana; font-size: 13px; color: #1C4971; width: 50%;"><div style="text-align: left; padding: 0 10px;">'.$val['name'].'</div></div>';
                $html .= '  <div style="height: 30px; float: left; line-height: 30px; overflow: hidden; font-family: Verdana; font-size: 13px; color: #1C4971; width: 20%;"><div style="text-align: center; padding: 0 10px;">'.$this->getValuesStatus($val['status']).'</div></div>';
                $html .= '  <div style="height: 30px; float: left; line-height: 30px; overflow: hidden; font-family: Verdana; font-size: 13px; color: #1C4971; width: 20%;"><div style="text-align: center; padding: 0 10px;">'.$val['dateChangeStatus'].'</div></div>';
                $html .= '  <div style="height: 0; clear: both; overflow: hidden;"></div>';
                $html .= '</div>';

                if($i == 1)
                {
                    $i = 2;
                }
                else
                {
                    $i = 1;
                }
	        }

	        $html .= '   </div>';
	        $html .= '</div>';
	    }

	    $html .= '</div>';

	    return $html;
	}

	/**
	 * Toma los textos y reemplaza los tags
	 *
	 * Por ejemplo busca el #name# y lo cambia por Juan Perez
	 *
	 * @param type $fields Campos que tiene valor
	 * @param type $content Textos/HTML sobre los que hay que reemplazar
	 *
	 * @return string
	 */
	public function processTags($fields, $content)
	{
	    foreach ($fields as $key => $value)
	    {
	        $content = str_replace('#'.$key.'#', trim($value), $content);
	    }

	    return $content;
	}
}
?>