<?php
/**
 * Archivo php creado por O-creator
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla detail_payment
 *
 * Esta clase se encarga de la administración de la tabla detail_payment brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Cdetail_payment.php');
 * $detail_payment = new Cdetail_payment();
 * $detail_payment->setDbConn($dbConn);
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:28-05-2020
 */
class Cdetail_payment extends Cbase
{
	/**
	 * Rendición
	 *
	 * - Clave Primaria
	 * - Clave Foránea
	 * - Campo en la base de datos: id_payment
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * <b>Relación</b>
	 * Este campo es clave foránea a:
	 * - Tabla: {@link Cpayment payment}
	 * - Campo: {@link Cpayment::$id id}
	 * - Interfaz: dependiente
	 * - Eliminar: cascada
	 * - Detalle requerido: Sí
	 *
	 * Ver también: {@link getIdPayment()}, {@link setIdPayment()}
	 * @var integer
	 * @access private
	 */
	private $idPayment;

	/**
	 * Producto
	 *
	 * - Clave Primaria
	 * - Clave Foránea
	 * - Campo en la base de datos: id_product
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * <b>Relación</b>
	 * Este campo es clave foránea a:
	 * - Tabla: {@link Cproduct product}
	 * - Campo: {@link Cproduct::$id id}
	 * - Campo que se muestra: {@link Cproduct::$name name}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * Ver también: {@link getIdProduct()}, {@link setIdProduct()}
	 * @var integer
	 * @access private
	 */
	private $idProduct;

	/**
	 * Monto
	 *
	 * - Campo en la base de datos: amount
	 * - Tipo de campo en la base de datos: decimal(10,2)
	 * - Extra: Decimal, positivo sin el cero [+] (ver {@link validateDecimalValue()})
	 * - Número de decimales: 2
	 *
	 * Ver también: {@link getAmount()}, {@link setAmount()}
	 * @var float
	 * @access private
	 */
	private $amount;

	/**
	 * Tipo
	 *
	 * - Campo en la base de datos: type
	 * - Tipo de campo en la base de datos: enum('payed','give_back','donate')
	 *
	 * Ver también: {@link getType()}, {@link setType()}
	 * @var string
	 * @access private
	 */
	private $type;

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
	 * Constructor de la clase
	 *
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('detail_payment');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cdetail_payment.php');
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
	 * Setea el valor {@link $idPayment Rendición}
	 *
	 * @param integer $idPayment indica el valor Rendición
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdPayment($idPayment, $gpc = FALSE)
	{
		if (validateRequiredValue($idPayment) === FALSE)
		{
			$this->idPayment = $idPayment;
			$this->addError(CDETAIL_PAYMENT_SETID_PAYMENT_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->idPayment = setValue($idPayment, $gpc);

			if (validateIntValue($this->idPayment, '+') === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CDETAIL_PAYMENT_SETID_PAYMENT_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $idProduct Producto}
	 *
	 * @param integer $idProduct indica el valor Producto
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdProduct($idProduct, $gpc = FALSE)
	{
		if (validateRequiredValue($idProduct) === FALSE)
		{
			$this->idProduct = $idProduct;
			$this->addError(CDETAIL_PAYMENT_SETID_PRODUCT_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->idProduct = setValue($idProduct, $gpc);

			if (validateIntValue($this->idProduct, '+') === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CDETAIL_PAYMENT_SETID_PRODUCT_VALIDATE_VALUE);

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
		if ($amount == '0')
		{
			$amount = '';
		}
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
			$this->addError(CDETAIL_PAYMENT_SETAMOUNT_VALIDATE_VALUE);

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
		$this->type = setValue($type, $gpc);

		return TRUE;
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
			$this->addError(CDETAIL_PAYMENT_SETID_SALE_VALIDATE_VALUE);
			return FALSE;
		}
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
	 * Devuelve el valor {@link $idProduct Producto}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdProduct($htmlEntities = TRUE)
	{
		return getValue($this->idProduct, $htmlEntities, $this->getCharset());
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
			case 'payed':
				return CDETAIL_PAYMENT_GET_VALUES_TYPE_VALUE_1;
				break;

			case 'give_back':
				return CDETAIL_PAYMENT_GET_VALUES_TYPE_VALUE_2;
				break;

			case 'donate':
				return CDETAIL_PAYMENT_GET_VALUES_TYPE_VALUE_3;
				break;
			default:
				return '&nbsp;';
		}
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
	 * Inserta un nuevo registro en la tabla detail_payment
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"INSERT INTO `tabla` (`campo1`, `campo2`) VALUES ('valor1', 'valor2')"</b>.
	 * Para armar la consulta sólo tiene en cuenta los campos que están seteados. Devuelve TRUE si se pudo insertar el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link addDetail()}, {@link updateDetail()}
	 * @return boolean
	 * @access public
	 */
	public function add()
	{
		$fields = array();
		$values = array();

		if (isset($this->idPayment) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_payment');
			$values[] = $this->getValueSql($this->idPayment);
		}

		if (isset($this->idProduct) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_product');
			$values[] = $this->getValueSql($this->idProduct);
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

		if (isset($this->type) === TRUE)
		{
			$fields[] = $this->getFieldSql('type');
			$values[] = $this->getValueSql($this->type);
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

		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CDETAIL_PAYMENT_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla detail_payment
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"UPDATE `tabla` SET `campo1` = 'valor1', `campo2` = 'valor2' WHERE `id_tabla` = '1'"</b>.
	 * Para armar la consulta sólo tiene en cuenta los campos que están seteados. Debe estar seteada la clave primaria del registro que se quiere modificar. Devuelve TRUE si se pudo modificar el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link updateDetail()}
	 * @return boolean
	 * @access public
	 */
	public function update()
	{
		if (validateRequiredValue($this->idPayment) === TRUE and validateRequiredValue($this->idProduct) === TRUE)
		{
			$values = array();

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

			if (isset($this->type) === TRUE)
			{
				$values[] = $this->getFieldSql('type').' = '.$this->getValueSql($this->type);
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

			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id_payment').' = '.$this->getValueSql($this->idPayment).' AND '.$this->getFieldSql('id_product').' = '.$this->getValueSql($this->idProduct);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CDETAIL_PAYMENT_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CDETAIL_PAYMENT_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla detail_payment
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"DELETE FROM `tabla` WHERE id_tabla = '1'"</b>.
	 * Para poder eliminar el registro debe estar seteada la clave primaria de la tabla. Devuelve TRUE si se pudo eliminar el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link updateDetail()}
	 * @return boolean
	 * @access public
	 */
	public function del()
	{
		if (validateRequiredValue($this->idPayment) === TRUE and validateRequiredValue($this->idProduct) === TRUE)
		{
			$sql = 'DELETE FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_payment').' = '.$this->getValueSql($this->idPayment).' AND '.$this->getFieldSql('id_product').' = '.$this->getValueSql($this->idProduct);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CDETAIL_PAYMENT_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CDETAIL_PAYMENT_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla detail_payment
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"SELECT * FROM `tabla` WHERE id_tabla = '1'"</b>.
	 * Debe estar seteada la clave primaria del registro que se quiere obtener. Devuelve TRUE si se pudo obtener el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * @return boolean
	 * @access public
	 */
	public function getData()
	{
		if (validateRequiredValue($this->idPayment) === TRUE and validateRequiredValue($this->idProduct) === TRUE)
		{
			$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_payment').' = '.$this->getValueSql($this->idPayment).' AND '.$this->getFieldSql('id_product').' = '.$this->getValueSql($this->idProduct);

			$row = $this->getDbConn()->GetRow($sql);

			if (is_array($row) === TRUE and count($row) > 0)
			{
				$this->setIdPayment($row['id_payment']);
				$this->setIdProduct($row['id_product']);
				$this->setAmount($row['amount']);
				$this->setType($row['type']);
				$this->setIdSale($row['id_sale']);

				return TRUE;
			}
			else
			{
				$this->addError(CDETAIL_PAYMENT_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CDETAIL_PAYMENT_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un conjunto de registros de la tabla detail_payment
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"SELECT * FROM `tabla`"</b>.
	 * Devuelve los registros obtenidos en un array asociativo usando los nombres de los campos como clave en formato lowerCamelCase.
	 *
	 * Ver también: {@link updateDetail()}, {@link loadDetail()}, {@link showDetail()}
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
		$oIdProduct = new Cproduct();
		$oIdProduct->setDbConn($this->getDbConn());

		$oIdSale = new Csale();
		$oIdSale->setDbConn($this->getDbConn());
		$sql = 'SELECT ';
		$sql.= $this->getFieldSql('id_payment', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_product', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('amount', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('type', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_sale', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id', $oIdProduct->getTableName(), 'product_id');
		$sql.= ', '.$this->getFieldSql('name', $oIdProduct->getTableName(), 'product_name');
		$sql.= ', '.$this->getFieldSql('description', $oIdProduct->getTableName(), 'product_description');
		$sql.= ', '.$this->getFieldSql('id_provider', $oIdProduct->getTableName(), 'product_id_provider');
		$sql.= ', '.$this->getFieldSql('date_added', $oIdProduct->getTableName(), 'product_date_added');
		$sql.= ', '.$this->getFieldSql('status', $oIdProduct->getTableName(), 'product_status');
		$sql.= ', '.$this->getFieldSql('id_category', $oIdProduct->getTableName(), 'product_id_category');
		$sql.= ', '.$this->getFieldSql('list_price', $oIdProduct->getTableName(), 'product_list_price');
		$sql.= ', '.$this->getFieldSql('sale_price', $oIdProduct->getTableName(), 'product_sale_price');
		$sql.= ', '.$this->getFieldSql('id_user_add', $oIdProduct->getTableName(), 'product_id_user_add');
		$sql.= ', '.$this->getFieldSql('code', $oIdProduct->getTableName(), 'product_code');
		$sql.= ', '.$this->getFieldSql('date_sold', $oIdProduct->getTableName(), 'product_date_sold');
		$sql.= ', '.$this->getFieldSql('date_change_status', $oIdProduct->getTableName(), 'product_date_change_status');
		$sql.= ', '.$this->getFieldSql('id', $oIdSale->getTableName(), 'sale_id');
		$sql.= ', '.$this->getFieldSql('date_added', $oIdSale->getTableName(), 'sale_date_added');
		$sql.= ', '.$this->getFieldSql('total_amount_gross', $oIdSale->getTableName(), 'sale_total_amount_gross');
		$sql.= ', '.$this->getFieldSql('discount', $oIdSale->getTableName(), 'sale_discount');
		$sql.= ', '.$this->getFieldSql('total_amount_net', $oIdSale->getTableName(), 'sale_total_amount_net');
		$sql.= ', '.$this->getFieldSql('id_user_add', $oIdSale->getTableName(), 'sale_id_user_add');
		$sql.= ', '.$this->getFieldSql('id_client', $oIdSale->getTableName(), 'sale_id_client');
		$sql.= ', '.$this->getFieldSql('casual_customer', $oIdSale->getTableName(), 'sale_casual_customer');
		$sql.= ' FROM '.$this->getTableSql();
		$sql.= ' LEFT JOIN '.$oIdProduct->getTableSql().' ON '.$this->getFieldSql('id_product', $this->getTableName()).' = '.$oIdProduct->getFieldSql('id', $oIdProduct->getTableName());
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
				$this->addError(CDETAIL_PAYMENT_GETLIST_ERROR);

				return FALSE;
			}
			else
			{
				settype ($htmlEntities, 'boolean');

				$list = array();

				$this->setTotalQuery($rs->RecordCount());

				while (!$rs->EOF)
				{
					$this->setIdPayment($rs->fields['id_payment']);
					$this->setIdProduct($rs->fields['id_product']);
					$this->setAmount($rs->fields['amount']);
					$this->setType($rs->fields['type']);
					$this->setIdSale($rs->fields['id_sale']);

					$oIdProduct->setName($rs->fields['product_name']);
					$oIdSale->setDateAdded($rs->fields['sale_date_added'], TRUE);

					$list[] = array(
						'idPayment' => $this->getIdPayment($htmlEntities) ,
						'idProduct' => $this->getIdProduct($htmlEntities) ,
						'amount' => $this->getAmount($htmlEntities) ,
						'type' => $this->getType($htmlEntities) ,
						'idSale' => $this->getIdSale($htmlEntities) ,
						'productName' => $oIdProduct->getName($htmlEntities) ,
						'saleDateAdded' => $oIdSale->getDateAdded()
					);

					$rs->MoveNext();
				}

				$this->idPayment = NULL;
				$this->idProduct = NULL;
				$this->amount = NULL;
				$this->type = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CDETAIL_PAYMENT_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}
	public function getListByIdPayment($search = '', $numRows = 0, $offset = 0, $order = '', $htmlEntities = TRUE)
	{
	    if (validateRequiredValue($this->idPayment) === TRUE)
	    {
    	    $oIdProduct = new Cproduct();
    	    $oIdProduct->setDbConn($this->getDbConn());

		$oIdSale = new Csale();
		$oIdSale->setDbConn($this->getDbConn());
    	    $sql = 'SELECT ';
    	    $sql.= $this->getFieldSql('id_payment', $this->getTableName());
    	    $sql.= ', '.$this->getFieldSql('id_product', $this->getTableName());
    	    $sql.= ', '.$this->getFieldSql('amount', $this->getTableName());
    	    $sql.= ', '.$this->getFieldSql('type', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_sale', $this->getTableName());
    	    $sql.= ', '.$this->getFieldSql('id', $oIdProduct->getTableName(), 'product_id');
    	    $sql.= ', '.$this->getFieldSql('name', $oIdProduct->getTableName(), 'product_name');
    	    $sql.= ', '.$this->getFieldSql('description', $oIdProduct->getTableName(), 'product_description');
    	    $sql.= ', '.$this->getFieldSql('id_provider', $oIdProduct->getTableName(), 'product_id_provider');
    	    $sql.= ', '.$this->getFieldSql('date_added', $oIdProduct->getTableName(), 'product_date_added');
    	    $sql.= ', '.$this->getFieldSql('status', $oIdProduct->getTableName(), 'product_status');
    	    $sql.= ', '.$this->getFieldSql('id_category', $oIdProduct->getTableName(), 'product_id_category');
    	    $sql.= ', '.$this->getFieldSql('list_price', $oIdProduct->getTableName(), 'product_list_price');
    	    $sql.= ', '.$this->getFieldSql('sale_price', $oIdProduct->getTableName(), 'product_sale_price');
    	    $sql.= ', '.$this->getFieldSql('id_user_add', $oIdProduct->getTableName(), 'product_id_user_add');
    	    $sql.= ', '.$this->getFieldSql('code', $oIdProduct->getTableName(), 'product_code');
    	    $sql.= ', '.$this->getFieldSql('date_sold', $oIdProduct->getTableName(), 'product_date_sold');
    	    $sql.= ', '.$this->getFieldSql('date_change_status', $oIdProduct->getTableName(), 'product_date_change_status');
		$sql.= ', '.$this->getFieldSql('id', $oIdSale->getTableName(), 'sale_id');
		$sql.= ', '.$this->getFieldSql('date_added', $oIdSale->getTableName(), 'sale_date_added');
		$sql.= ', '.$this->getFieldSql('total_amount_gross', $oIdSale->getTableName(), 'sale_total_amount_gross');
		$sql.= ', '.$this->getFieldSql('discount', $oIdSale->getTableName(), 'sale_discount');
		$sql.= ', '.$this->getFieldSql('total_amount_net', $oIdSale->getTableName(), 'sale_total_amount_net');
		$sql.= ', '.$this->getFieldSql('id_user_add', $oIdSale->getTableName(), 'sale_id_user_add');
		$sql.= ', '.$this->getFieldSql('id_client', $oIdSale->getTableName(), 'sale_id_client');
		$sql.= ', '.$this->getFieldSql('casual_customer', $oIdSale->getTableName(), 'sale_casual_customer');
    	    $sql.= ' FROM '.$this->getTableSql();
    	    $sql.= ' LEFT JOIN '.$oIdProduct->getTableSql().' ON '.$this->getFieldSql('id_product', $this->getTableName()).' = '.$oIdProduct->getFieldSql('id', $oIdProduct->getTableName());
		$sql.= ' LEFT JOIN '.$oIdSale->getTableSql().' ON '.$this->getFieldSql('id_sale', $this->getTableName()).' = '.$oIdSale->getFieldSql('id', $oIdSale->getTableName());
    	    $sql.= ' WHERE '.$this->getFieldSql('id_payment', $this->getTableName()).' = '.$this->getValueSql($this->idPayment);

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
    	            $this->addError(CDETAIL_PAYMENT_GETLIST_ERROR);

    	            return FALSE;
    	        }
    	        else
    	        {
    	            settype ($htmlEntities, 'boolean');

    	            $list = array();

    	            $this->setTotalQuery($rs->RecordCount());

    	            while (!$rs->EOF)
    	            {
    	                $this->setIdPayment($rs->fields['id_payment']);
    	                $this->setIdProduct($rs->fields['id_product']);
    	                $this->setAmount($rs->fields['amount']);
    	                $this->setType($rs->fields['type']);
					$this->setIdSale($rs->fields['id_sale']);

    	                $oIdProduct->setName($rs->fields['product_name']);
					$oIdSale->setDateAdded($rs->fields['sale_date_added'], TRUE);

    	                $list[] = array(
    	                    'idPayment' => $this->getIdPayment($htmlEntities) ,
    	                    'idProduct' => $this->getIdProduct($htmlEntities) ,
    	                    'amount' => $this->getAmount($htmlEntities) ,
    	                    'type' => $this->getType($htmlEntities) ,
						'idSale' => $this->getIdSale($htmlEntities) ,
						'productName' => $oIdProduct->getName($htmlEntities) ,
						'saleDateAdded' => $oIdSale->getDateAdded()
    	                );

    	                $rs->MoveNext();
    	            }

    	            $this->idPayment = NULL;
    	            $this->idProduct = NULL;
    	            $this->amount = NULL;
    	            $this->type = NULL;
				$this->idSale = NULL;

    	            return $list;
    	        }
    	    }
    	    else
    	    {
    	        $this->addError(CDETAIL_PAYMENT_GETLIST_TOTAL_LIST_ERROR);

    	        return FALSE;
    	    }
	    }
	    else
	    {
	        $this->addError(CDETAIL_PAYMENT_GETLIST_BY_ID_PAYMET_REQUIRED_ID_PAYMENT);

	        return FALSE;
	    }
	}

	/**
	 * Verifica si ya existe en la tabla detail_payment la clave primaria (compuesta) seteada
	 *
	 * Este método controla si ya existe en la tabla detail_payment la clave primaria (compuesta) seteada.
	 * Si no está seteado el valor de al menos uno de los campos que forman la clave compuesta el método devuelve FALSE.
	 *
	 * @return boolean
	 * @access public
	 */
	public function existPrimaryKey()
	{
		if (validateRequiredValue($this->idPayment) === TRUE and validateRequiredValue($this->idProduct) === TRUE)
		{
			$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_payment').' = '.$this->getValueSql($this->idPayment).' AND '.$this->getFieldSql('id_product').' = '.$this->getValueSql($this->idProduct);

			$row = $this->getDbConn()->GetRow($sql);

			if ($row !== FALSE)
			{
				if (count($row) > 0)
				{
					$this->addError(CDETAIL_PAYMENT_EXIST_PK_EXIST);

					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				$this->addError(CDETAIL_PAYMENT_EXIST_PK_ERROR);

				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
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
			if (isset($values['idPayment']) === FALSE)
			{
				$values['idPayment'] = '';
			}

			if (isset($values['idProduct']) === FALSE)
			{
				$values['idProduct'] = '';
			}

			if (isset($values['amount']) === FALSE)
			{
				$values['amount'] = '';
			}

			if (isset($values['type']) === FALSE)
			{
				$values['type'] = '';
			}

			if (isset($values['idSale']) === FALSE)
			{
				$values['idSale'] = '';
			}
			if (isset($values['productName']) === FALSE)
			{
				$values['productName'] = '';
			}
			if (isset($values['saleDateAdded']) === FALSE)
			{
				$values['saleDateAdded'] = '';
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
			if (isset($values['idPayment']) === TRUE)
			{
				$_SESSION[$uniqueID][$index]['idPayment'] = $values['idPayment'];
			}

			if (isset($values['idProduct']) === TRUE)
			{
				$_SESSION[$uniqueID][$index]['idProduct'] = $values['idProduct'];
			}

			if (isset($values['amount']) === TRUE)
			{
				$_SESSION[$uniqueID][$index]['amount'] = $values['amount'];
			}

			if (isset($values['type']) === TRUE)
			{
				$_SESSION[$uniqueID][$index]['type'] = $values['type'];
			}

			if (isset($values['idSale']) === TRUE)
			{
				$_SESSION[$uniqueID][$index]['idSale'] = $values['idSale'];
			}
			if (isset($values['productName']) === TRUE)
			{
				$_SESSION[$uniqueID][$index]['productName'] = $values['productName'];
			}
			if (isset($values['saleDateAdded']) === TRUE)
			{
				$_SESSION[$uniqueID][$index]['saleDateAdded'] = $values['saleDateAdded'];
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
					if ($item['idProduct'] == $this->getIdProduct(FALSE) and $index != $key)
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
	 * Inserta los registros en la tabla detail_payment
	 *
	 * Este método inserta en la tabla detail_payment los items de la relación con la tabla {@link Cpayment payment}.
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
	 * - 'width'  : no se utiliza en este método
	 * - 'strlen' : no se utiliza en este método
	 *
	 * Ver también: {@link formDetail()}
	 * @param date $dateAddedPayment fecha de la rendición
	 * @param array $fields [opcional] contiene los campos que se mostraron en el formulario
	 * @param string $uniqueID [opcional] nombre de la variable de sesión
	 *
	 * @return boolean
	 * @access public
	 */
	public function addDetail($dateAddedPayment, $fields = '', $uniqueID = '')
	{
		if (validateRequiredValue($this->idPayment) === TRUE)
		{
			if (is_array($fields) === FALSE)
			{
				unset($fields);
				$fields[0]['field'] = 'idProduct';
				$fields[1]['field'] = 'amount';
				$fields[2]['field'] = 'type';
				$fields[3]['field'] = 'idSale';
			}

			$arrayFields = array();
			foreach ($fields as $field)
			{
				$arrayFields[] = trim($field['field']);
			}
			if (in_array('idProduct', $arrayFields) === FALSE)
			{
				$arrayFields[] = 'idProduct';
			}

			if (is_array($_SESSION[$uniqueID]) === TRUE)
			{
				foreach ($_SESSION[$uniqueID] as $item)
				{
					if (in_array('idProduct', $arrayFields))
					{
						$this->setIdProduct($item['idProduct']);
					}

					if (in_array('amount', $arrayFields))
					{
						$this->setAmount($item['amount']);
					}

					if (in_array('type', $arrayFields))
					{
						$this->setType($item['type']);
					}

					if (in_array('idSale', $arrayFields))
					{
						$this->setIdSale($item['idSale']);
					}

					if($this->add() == TRUE)
					{
					    //Actalizo el estado del producto
					    $this->uptateProductStatus($item['idProduct'], 'give_back', $dateAddedPayment);
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
	 * Actualiza los registros en la tabla detail_payment
	 *
	 * Este método actualiza en la tabla detail_payment los items de la relación con la tabla {@link Cpayment payment}.
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
	 * - 'width'  : no se utiliza en este método
	 * - 'strlen' : no se utiliza en este método
	 *
	 * Ver también: {@link formDetail()}
	 * @param date $dateAddedPayment fecha de la rendición
	 * @param array $fields [opcional] contiene los campos que se mostraron en el formulario
	 * @param string $uniqueID [opcional] nombre de la variable de sesión
	 *
	 * @return boolean
	 * @access public
	 */
	public function updateDetail($dateAddedPayment = '', $fields = '', $uniqueID = '')
	{
		if (validateRequiredValue($this->idPayment) === TRUE)
		{
			if (is_array($fields) === FALSE)
			{
				unset($fields);
				$fields[0]['field'] = 'idProduct';
				$fields[1]['field'] = 'amount';
				$fields[2]['field'] = 'type';
				$fields[3]['field'] = 'idSale';
			}

			$arrayFields = array();
			foreach ($fields as $field)
			{
				$arrayFields[] = trim($field['field']);
			}
			if (in_array('idProduct', $arrayFields) === FALSE)
			{
				$arrayFields[] = 'idProduct';
			}

			$auxIdPayment = $this->idPayment;

			$search = $this->getFieldSql('id_payment', $this->getTableName()).' = '.$this->getValueSql($this->idPayment);
			$rs = $this->getList($search, 0, 0, '', FALSE);

			$this->idPayment = $auxIdPayment;

			$return = FALSE;

			if ($this->getTotalList() > 0)
			{
				foreach ($rs as $row)
				{
					$values[0]['value'] = $row['idProduct'];
					$values[0]['field'] = 'idProduct';

					if (isInArray($_SESSION[$uniqueID], $values) === FALSE)
					{
						$this->setIdProduct($row['idProduct']);
						if($this->del() == TRUE)
						{
							//Actualizo el estado del producto
							$this->uptateProductStatus($row['idProduct'], 'sold');
						}
					}
				}

				$return = TRUE;
			}

			if (is_array($_SESSION[$uniqueID]) === TRUE)
			{
				foreach ($_SESSION[$uniqueID] as $item)
				{
					if (in_array('idProduct', $arrayFields))
					{
						$this->setIdProduct($item['idProduct']);
					}

					if (in_array('amount', $arrayFields))
					{
						$this->setAmount($item['amount']);
					}

					if (in_array('type', $arrayFields))
					{
						$this->setType($item['type']);
					}

					if (in_array('idSale', $arrayFields))
					{
						$this->setIdSale($item['idSale']);
					}
					$values[0]['value'] = $item['idProduct'];
					$values[0]['field'] = 'idProduct';

					if (isInArray($rs, $values) === TRUE)
					{

						$this->update();
					}
					else
					{
						$this->add();
					}
					//Actalizo el estado del producto
					$this->uptateProductStatus($item['idProduct'], 'give_back', $dateAddedPayment);
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
	 * Elimina los registros en la tabla detail_payment
	 *
	 * Este método elimina en la tabla detail_payment los items de la relación con la tabla {@link Cpayment payment}.
	 *
	 * @return boolean
	 * @access public
	 */
	public function delDetail()
	{
		if (validateRequiredValue($this->idPayment) === TRUE)
		{
			//Actualizo los estados de los productos
			$auxIdPayment	    = $this->idPayment;
			$search		        = $this->getFieldSql('id_payment', $this->getTableName()).' = '.$this->getValueSql($this->idPayment);
			$rs		            = $this->getList($search, 0, 0, '', FALSE);
			$this->idPayment	= $auxIdPayment;
			if ($this->getTotalList() > 0)
			{
			    foreach ($rs as $row)
			    {
	    			//Actualizo el estado del producto
	    			if($row['type'] == 'payed')
	    			{
	    			    $this->uptateProductStatus($row['idProduct'], 'sold');
	    			}
	    			else
	    			{
	    			    $this->uptateProductStatus($row['idProduct'], 'give_back');
	    			}
			    }
			}
			$sql = 'DELETE FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_payment').' = '.$this->getValueSql($this->idPayment);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CDETAIL_PAYMENT_DEL_DETAIL_ERROR);

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
	 * @param $uniqueID nombre de la variable de sesión
	 *
	 * @return boolean
	 * @access public
	 */
	public function loadDetail($uniqueID)
	{
		if (validateRequiredValue($this->idPayment) === TRUE)
		{
			$search = $this->getFieldSql('id_payment', $this->getTableName()).' = '.$this->getValueSql($this->idPayment);
			$order = $this->getFieldSql('id_payment', $this->getTableName()).' ASC';
			$rs = $this->getList($search, 0, 0, $order, FALSE);

			if ($this->getTotalList() > 0)
			{
				foreach ($rs as $item)
				{
					$index = $item['idProduct'];

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

	/**
	 * Agrega los elementos de formulario necesarios para agregar los items de la relación con la tabla {@link Cpayment payment}
	 *
	 * Este método muestra los campos del formulario de la tabla detail_payment seteados en el parámetro $fields que se utilizan
	 * dentro de los métodos {@link Cpayment::addForm() addForm} y {@link Cpayment::updateForm() updateForm} de la tabla {@link Cpayment payment}.
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
	public function formDetail($fileControl, $fields = '', $update = '', $delete = '', $title = '', $uniqueID = '')
	{
		if (is_array($fields) === FALSE)
		{
			unset($fields);
			$fields[0]['field'] = 'idProduct';
			$fields[1]['field'] = 'amount';
			$fields[2]['field'] = 'type';
			$fields[3]['field'] = 'idSale';
		}

		$arrayFields = array();
		foreach ($fields as $field)
		{
			$arrayFields[] = trim($field['field']);
		}
		if (in_array('idProduct', $arrayFields) === FALSE)
		{
			$arrayFields[] = 'idProduct';
		}
		?>
					<div class="title"><?php echo $title; ?></div>
					<div class="content">
						<div class="fields detail_payment">
		<?php
		$jsFields = array();

		foreach ($arrayFields as $value)
		{
			if ($value == 'idProduct')
			{
				?>
				<div class="field autocompleteWrapper">
					<label><?php echo CDETAIL_PAYMENT_FORM_DETAIL_LABEL_FIELD_ID_PRODUCT; ?></label>
					<input name="detail_payment_idProductAutocomplete" id="detail_payment_idProductAutocomplete" value="" class="str autocomplete" maxlength="255" type="text" />
					<input name="detail_payment_idProduct" id="detail_payment_idProduct" value="" type="hidden" />
					<input name="searchFilter" id="searchFilter" value="productStatusExhibited" type="hidden" />
				<?php
				/*$oIdProduct = new Cproduct();
				$oIdProduct->setDbConn($this->getDbConn());
				$oIdProduct->showList('name', 'name', '', 'detail_payment_idProduct', 'detail_payment_idProduct', 'select_detail');*/
				?>
							</div>
				<?php
				$jsFields[] = '\'idProduct\'';
			}

			if ($value == 'amount')
			{
				?>
							<div class="field">
								<label><?php echo CDETAIL_PAYMENT_FORM_DETAIL_LABEL_FIELD_AMOUNT; ?></label>
								<input name="detail_payment_amount" type="text" id="detail_payment_amount" value="" class="num" onkeypress="return noSubmit(event)" />
							</div>
				<?php
				$jsFields[] = '\'amount\'';
			}

			if ($value == 'type')
			{
				?>
							<div class="field">
								<label><?php echo CDETAIL_PAYMENT_FORM_DETAIL_LABEL_FIELD_TYPE; ?></label>
								<select name="detail_payment_type" id="detail_payment_type">
									<option value=""></option>
									<option value="payed" <?php if ($this->getType() == 'payed') echo 'selected="selected"' ?>><?php echo $this->getValuesType('payed'); ?></option>
									<option value="give_back" <?php if ($this->getType() == 'give_back') echo 'selected="selected"' ?>><?php echo $this->getValuesType('give_back'); ?></option>
									<option value="donate" <?php if ($this->getType() == 'donate') echo 'selected="selected"' ?>><?php echo $this->getValuesType('donate'); ?></option>
								</select>
							</div>
				<?php
				$jsFields[] = '\'type\'';
			}
			if ($value == 'idSale')
			{
				?>
							<div class="field">
								<label><?php echo CDETAIL_PAYMENT_FORM_DETAIL_LABEL_FIELD_ID_SALE; ?></label>
				<?php
				$oIdSale = new Csale();
				$oIdSale->setDbConn($this->getDbConn());
				$oIdSale->showList('dateAdded', 'date_added', '', 'detail_payment_idSale', 'detail_payment_idSale', 'select_detail');
				?>
							</div>
				<?php
				$jsFields[] = '\'idSale\'';
			}
		}
		?>
						</div>
						<div class="buttons">
							<input type="button" name="detail_payment_addButton" id="detail_payment_addButton" value="<?php echo CDETAIL_PAYMENT_FORM_DETAIL_ADD_BTN; ?>" onclick="addItem('<?php echo $fileControl; ?>', 'detail_payment', new Array(<?php echo implode(',', $jsFields); ?>), '<?php echo $uniqueID; ?>')" class="add" />
							<input type="button" name="detail_payment_updateButton" id="detail_payment_updateButton" value="<?php echo CDETAIL_PAYMENT_FORM_DETAIL_UPDATE_BTN; ?>" onclick="updateItem('<?php echo $fileControl; ?>', 'detail_payment', new Array(<?php echo implode(',', $jsFields); ?>), '<?php echo $uniqueID; ?>')" class="update" style="display: none;" />
							<input type="button" name="detail_payment_cancelButton" id="detail_payment_cancelButton" value="<?php echo CDETAIL_PAYMENT_FORM_DETAIL_CANCEL_BTN; ?>" onclick="cancelItemForm('detail_payment', new Array(<?php echo implode(',', $jsFields); ?>))" class="cancel" style="display: none;" />
							<input name="detail_payment_updateIndex" type="hidden" id="detail_payment_updateIndex" value="" />
						</div>
						<div id="detail_payment_detail" class="list">
		<?php
		$this->listDetail($fileControl, $fields, $update, $delete, $uniqueID);
		?>
						</div>
					</div>
		<?php
	}

	/**
	 * Muestra en una tabla los items agregados de la relación con la tabla {@link Cpayment payment}
	 *
	 * Muestra en una tabla los items agregados de la relación con la tabla {@link Cpayment payment} mostrando los campos
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
	public function listDetail($fileControl, $fields = '', $update = '', $delete = '', $uniqueID = '')
	{
		if (is_array($fields) === FALSE)
		{
			unset($fields);
			$fields[0]['field'] = 'idProduct';
			$fields[1]['field'] = 'amount';
			$fields[2]['field'] = 'type';
			$fields[3]['field'] = 'idSale';
		}

		foreach ($fields as $field)
		{
			$arrayFields[] = trim($field['field']);

			settype ($field['strlen'], 'integer');
			$arrayStrLen[$field['field']] = $field['strlen'];

			if (isset($field['width']) === FALSE)
			{
				$field['width'] = '';
			}
			$arrayWidth[$field['field']] = $field['width'];
		}
		if (in_array('idProduct', $arrayFields) === FALSE)
		{
			$arrayFields[] = 'idProduct';
			$arrayStrLen['idProduct'] = 0;
			$arrayWidth['idProduct'] = '';
		}

		if (isset($update['image']) === FALSE)
		{
			$update['image'] = '';
		}
		if (isset($update['image-over']) === FALSE)
		{
			$update['image-over'] = '';
		}
		if (isset($update['image-head']) === FALSE)
		{
			$update['image-head'] = '';
		}
		if (isset($update['class']) === FALSE)
		{
			$update['class'] = '';
		}
		if (isset($update['title']) === FALSE)
		{
			$update['title'] = '';
		}
		if (isset($update['width']) === FALSE)
		{
			$update['width'] = '';
		}

		if (isset($delete['image']) === FALSE)
		{
			$delete['image'] = '';
		}
		if (isset($delete['image-over']) === FALSE)
		{
			$delete['image-over'] = '';
		}
		if (isset($delete['image-head']) === FALSE)
		{
			$delete['image-head'] = '';
		}
		if (isset($delete['class']) === FALSE)
		{
			$delete['class'] = '';
		}
		if (isset($delete['title']) === FALSE)
		{
			$delete['title'] = '';
		}
		if (isset($delete['width']) === FALSE)
		{
			$delete['width'] = '';
		}
		?>
						<div class="data">
							<div class="row header">
		<?php
		$headers = array();
		$jsFields = array();

		foreach ($arrayFields as $value)
		{
			if ($value == 'idProduct')
			{
			?>
								<div class="col" style="width: <?php echo $arrayWidth['idProduct']; ?>;"><div class="str"><?php echo altText(getCutString(CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_ID_PRODUCT, $arrayStrLen['idProduct']), CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_ID_PRODUCT); ?></div></div>
			<?php
				$headers['idProduct'] = '<div class="str">'.altText(getCutString(CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_ID_PRODUCT, $arrayStrLen['idProduct']), CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_ID_PRODUCT).'</div>';
				$jsFields[] = '\'idProduct\'';
			}

			if ($value == 'amount')
			{
			?>
								<div class="col" style="width: <?php echo $arrayWidth['amount']; ?>;"><div class="num"><?php echo altText(getCutString(CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_AMOUNT, $arrayStrLen['amount']), CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_AMOUNT); ?></div></div>
			<?php
				$headers['amount'] = '<div class="num">'.altText(getCutString(CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_AMOUNT, $arrayStrLen['amount']), CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_AMOUNT).'</div>';
				$jsFields[] = '\'amount\'';
			}

			if ($value == 'type')
			{
			?>
								<div class="col" style="width: <?php echo $arrayWidth['type']; ?>;"><div class="str"><?php echo altText(getCutString(CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_TYPE, $arrayStrLen['type']), CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_TYPE); ?></div></div>
			<?php
				$headers['type'] = '<div class="str">'.altText(getCutString(CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_TYPE, $arrayStrLen['type']), CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_TYPE).'</div>';
				$jsFields[] = '\'type\'';
			}
			if ($value == 'idSale')
			{
			?>
								<div class="col" style="width: <?php echo $arrayWidth['idSale']; ?>;"><div class="date"><?php echo altText(getCutString(CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_ID_SALE, $arrayStrLen['idSale']), CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_ID_SALE); ?></div></div>
			<?php
				$headers['idSale'] = '<div class="date">'.altText(getCutString(CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_ID_SALE, $arrayStrLen['idSale']), CDETAIL_PAYMENT_FORM_DETAIL_HEAD_FIELD_ID_SALE).'</div>';
				$jsFields[] = '\'idSale\'';
			}
		}

		if (validateRequiredValue($update['image']) === TRUE)
		{
			$actionHead = '';
			if (validateRequiredValue($update['image-head']) === TRUE)
			{
				$actionHead = '<img src="'.$update['image-head'].'" alt="'.$update['title'].'" />';
			}
			?>
								<div class="col" style="width: <?php echo $update['width']; ?>;"><div class="action"><?php echo $actionHead; ?></div></div>
			<?php
		}

		if (validateRequiredValue($delete['image']) === TRUE)
		{
			$actionHead = '';
			if (validateRequiredValue($delete['image-head']) === TRUE)
			{
				$actionHead = '<img src="'.$delete['image-head'].'" alt="'.$delete['title'].'" />';
			}
			?>
								<div class="col" style="width: <?php echo $delete['width']; ?>;"><div class="action"><?php echo $actionHead; ?></div></div>
			<?php
		}
		?>
								<div class="clear"></div>
							</div>
		<?php
		if (is_array($_SESSION[$uniqueID]) === TRUE)
		{
			$class = '1';

			$oIdProduct = new Cproduct();

			$oIdSale = new Csale();
			foreach ($_SESSION[$uniqueID] as $key => $item)
			{
				?>
							<div class="row row<?php echo $class; ?>">
				<?php
				foreach ($arrayFields as $value)
				{
					if ($value == 'idProduct')
					{
						$this->setIdProduct($item['idProduct']);
						$oIdProduct->setName($item['productName']);
						?>
								<div class="col header"><?php echo $headers['idProduct']; ?></div>
								<div class="col" style="width: <?php echo $arrayWidth['idProduct']; ?>;">
									<input name="detail_payment_idProduct_<?php echo $key; ?>" type="hidden" id="detail_payment_idProduct_<?php echo $key; ?>" value="<?php echo $this->getIdProduct(); ?>" />
									<div class="str"><?php echo altText(getCutString($oIdProduct->getName(), $arrayStrLen['idProduct']), $oIdProduct->getName()); ?></div>
								</div>
						<?php
					}

					if ($value == 'amount')
					{
						$this->setAmount($item['amount']);
						?>
								<div class="col header"><?php echo $headers['amount']; ?></div>
								<div class="col" style="width: <?php echo $arrayWidth['amount']; ?>;">
									<input name="detail_payment_amount_<?php echo $key; ?>" type="hidden" id="detail_payment_amount_<?php echo $key; ?>" value="<?php echo $this->getAmount(); ?>" />
									<div class="num"><?php echo altText(getCutString($this->getAmount(), $arrayStrLen['amount']), $this->getAmount()); ?></div>
								</div>
						<?php
					}

					if ($value == 'type')
					{
						$this->setType($item['type']);
						?>
								<div class="col header"><?php echo $headers['type']; ?></div>
								<div class="col" style="width: <?php echo $arrayWidth['type']; ?>;">
									<input name="detail_payment_type_<?php echo $key; ?>" type="hidden" id="detail_payment_type_<?php echo $key; ?>" value="<?php echo $this->getType(); ?>" />
									<div class="str"><?php echo altText(getCutString($this->getValuesType($this->getType()), $arrayStrLen['type']), $this->getValuesType($this->getType())); ?></div>
								</div>
						<?php
					}
					if ($value == 'idSale')
					{
						$oIdSale->setDateAdded($item['saleDateAdded'], FALSE);
						?>
								<div class="col header"><?php echo $headers['idSale']; ?></div>
								<div class="col" style="width: <?php echo $arrayWidth['idSale']; ?>;">
									<input name="detail_payment_idSale_<?php echo $key; ?>" type="hidden" id="detail_payment_idSale_<?php echo $key; ?>" value="<?php echo $this->getIdSale(); ?>" />
									<div class="date"><?php echo altText(getCutString($oIdSale->getDateAdded(), $arrayStrLen['idSale']), $oIdSale->getDateAdded()); ?></div>
								</div>
						<?php
					}
				}

				$actionHead = '';
				$actionsBtns = '';

				if (validateRequiredValue($update['image']) === TRUE)
				{
					if (validateRequiredValue($update['image-head']) === TRUE)
					{
						$actionHead.= '<img src="'.$update['image-head'].'" alt="'.$update['title'].'" />';
					}
					?>
								<div class="col action" style="width: <?php echo $update['width']; ?>;"><div class="action"><a href="#" onclick="updateItemForm('detail_payment', '<?php echo $key; ?>', new Array(<?php echo implode(',', $jsFields); ?>), '<?php echo $uniqueID; ?>'); return false;"><img src="<?php echo $update['image']; ?>" title="<?php echo $update['title']; ?>" class="out" /><img src="<?php echo $update['image-over']; ?>" title="<?php echo $update['title']; ?>" class="over" /></a></div></div>
					<?php
					$actionsBtns.= '<input type="button" value="" onclick="updateItemForm(\'detail_payment\', \''.$key.'\', new Array('.implode(',', $jsFields).'), \''.$uniqueID.'\');" class="'.$update['class'].'" />';
				}

				if (validateRequiredValue($delete['image']) === TRUE)
				{
					if (validateRequiredValue($delete['image-head']) === TRUE)
					{
						$actionHead.= '<img src="'.$delete['image-head'].'" alt="'.$delete['title'].'" />';
					}
					?>
								<div class="col action" style="width: <?php echo $delete['width']; ?>;"><div class="action"><a href="#" onclick="delItem('<?php echo $fileControl; ?>', 'detail_payment', '<?php echo $key; ?>', '<?php echo $uniqueID; ?>'); return false;"><img src="<?php echo $delete['image']; ?>" title="<?php echo $delete['title']; ?>" class="out" /><img src="<?php echo $delete['image-over']; ?>" title="<?php echo $delete['title']; ?>" class="over" /></a></div></div>
					<?php
					$actionsBtns.= '<input type="button" value="" onclick="delItem(\''.$fileControl.'\', \'detail_payment\', \''.$key.'\', \''.$uniqueID.'\');" class="'.$delete['class'].'" />';
				}
				?>
								<div class="col header"><div class="action"><?php echo $actionHead; ?></div></div>
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
		?>
						</div>
		<?php
	}

	/**
	 * Muestra los items de la relación con la tabla {@link Cpayment payment}
	 *
	 * Este método muestra los valores de los campos de la tabla detail_payment seteados en el parámetro $fields
	 * que se utilizan dentro del método {@link Cpayment::showData() showData} de la tabla {@link Cpayment payment}.
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
	 * @param array $fields [opcional] contiene los campos que se van a mostrar
	 * @param string $title [opcional] título
	 * @return mixed
	 * @access public
	 */
	public function showDetail($fields = '', $title = '')
	{
		if (validateRequiredValue($this->idPayment) === TRUE)
		{
			if (is_array($fields) === FALSE)
			{
				unset($fields);
				$fields[0]['field'] = 'idProduct';
				$fields[1]['field'] = 'amount';
				$fields[2]['field'] = 'type';
				$fields[3]['field'] = 'idSale';
			}

			foreach ($fields as $field)
			{
				$arrayFields[] = trim($field['field']);

				settype ($field['strlen'], 'integer');
				$arrayStrLen[$field['field']] = $field['strlen'];

				if (isset($field['width']) === FALSE)
				{
					$field['width'] = '';
				}
				$arrayWidth[$field['field']] = $field['width'];
			}
			if (in_array('idProduct', $arrayFields) === FALSE)
			{
				$arrayFields[] = 'idProduct';
				$arrayStrLen['idProduct'] = 0;
				$arrayWidth['idProduct'] = '';
			}
			?>
					<div class="title"><?php echo $title; ?></div>
					<div class="content">
						<div class="list">
							<div class="data">
								<div class="row header">
			<?php
			$headers = array();

			foreach ($arrayFields as $value)
			{
				if ($value == 'idProduct')
				{
					?>
									<div class="col" style="width: <?php echo $arrayWidth['idProduct']; ?>;"><div class="str"><?php echo altText(getCutString(CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_ID_PRODUCT, $arrayStrLen['idProduct']), CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_ID_PRODUCT); ?></div></div>
					<?php
					$headers['idProduct'] = '<div class="str">'.altText(getCutString(CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_ID_PRODUCT, $arrayStrLen['idProduct']), CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_ID_PRODUCT).'</div>';
				}

				if ($value == 'amount')
				{
					?>
									<div class="col" style="width: <?php echo $arrayWidth['amount']; ?>;"><div class="num"><?php echo altText(getCutString(CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_AMOUNT, $arrayStrLen['amount']), CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_AMOUNT); ?></div></div>
					<?php
					$headers['amount'] = '<div class="num">'.altText(getCutString(CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_AMOUNT, $arrayStrLen['amount']), CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_AMOUNT).'</div>';
				}

				if ($value == 'type')
				{
					?>
									<div class="col" style="width: <?php echo $arrayWidth['type']; ?>;"><div class="str"><?php echo altText(getCutString(CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_TYPE, $arrayStrLen['type']), CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_TYPE); ?></div></div>
					<?php
					$headers['type'] = '<div class="str">'.altText(getCutString(CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_TYPE, $arrayStrLen['type']), CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_TYPE).'</div>';
				}
				if ($value == 'idSale')
				{
					?>
									<div class="col" style="width: <?php echo $arrayWidth['idSale']; ?>;"><div class="date"><?php echo altText(getCutString(CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_ID_SALE, $arrayStrLen['idSale']), CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_ID_SALE); ?></div></div>
					<?php
					$headers['idSale'] = '<div class="date">'.altText(getCutString(CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_ID_SALE, $arrayStrLen['idSale']), CDETAIL_PAYMENT_SHOW_DETAIL_HEAD_FIELD_ID_SALE).'</div>';
				}
			}
			?>
									<div class="clear"></div>
								</div>
			<?php
			$search = $this->getFieldSql('id_payment').' = '.$this->getValueSql($this->idPayment);
			$order = $this->getFieldSql('id_payment').' ASC';
			$list = $this->getList($search, 0, 0, $order, TRUE);

			if ($this->getTotalList() > 0)
			{
				$class = '1';

				foreach ($list as $row)
				{
					?>
								<div class="row row<?php echo $class; ?>">
					<?php
					foreach ($arrayFields as $value)
					{
						if ($value == 'idProduct')
						{
							?>
									<div class="col header"><?php echo $headers['idProduct']; ?></div>
									<div class="col" style="width: <?php echo $arrayWidth['idProduct']; ?>;"><div class="str"><?php echo altText(getCutString($row['productName'], $arrayStrLen['idProduct']), $row['productName']); ?></div></div>
							<?php
						}

						if ($value == 'amount')
						{
							?>
									<div class="col header"><?php echo $headers['amount']; ?></div>
									<div class="col" style="width: <?php echo $arrayWidth['amount']; ?>;"><div class="num"><?php echo altText(getCutString($row['amount'], $arrayStrLen['amount']), $row['amount']); ?></div></div>
							<?php
						}

						if ($value == 'type')
						{
							?>
									<div class="col header"><?php echo $headers['type']; ?></div>
									<div class="col" style="width: <?php echo $arrayWidth['type']; ?>;"><div class="str"><?php echo altText(getCutString($this->getValuesType($row['type']), $arrayStrLen['type']), $this->getValuesType($row['type'])); ?></div></div>
							<?php
						}
						if ($value == 'idSale')
						{
							?>
									<div class="col header"><?php echo $headers['idSale']; ?></div>
									<div class="col" style="width: <?php echo $arrayWidth['idSale']; ?>;"><div class="date"><?php echo altText(getCutString($row['saleDateAdded'], $arrayStrLen['idSale']), $row['saleDateAdded']); ?></div></div>
							<?php
						}
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
			}
			?>
							</div>
						</div>
					</div>
			<?php
		}
	}

	/**
	 * Realiza los controles necesarios de las acciones ejecutadas en la relación con la tabla {@link Cpayment payment}
	 *
	 * Realiza los controles necesarios de las acciones ejecutadas en la relación con la tabla {@link Cpayment payment}.
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
	public function controlFormDetail($action, $fileControl, $fields = '', $update = '', $delete = '', $cleanForm = FALSE, $uniqueID = '')
	{
		if (is_array($fields) === FALSE)
		{
			unset($fields);
			$fields[0]['field'] = 'idProduct';
			$fields[1]['field'] = 'amount';
			$fields[2]['field'] = 'type';
			$fields[3]['field'] = 'idSale';
		}

		$arrayFields = array();
		foreach ($fields as $field)
		{
			$arrayFields[] = trim($field['field']);
		}
		if (in_array('idProduct', $arrayFields) === FALSE)
		{
			$arrayFields[] = 'idProduct';
		}

		switch ($action)
		{
			case 'addItem':

				$jsFields = array();

				if (in_array('idProduct', $arrayFields) === TRUE)
				{
					$this->setIdProduct($_POST['idProduct'], TRUE);

					$addItem['idProduct'] = $this->getIdProduct(FALSE);

					$oIdProduct = new Cproduct();
					$oIdProduct->setDbConn($this->getDbConn());
					$oIdProduct->setId($this->getIdProduct(FALSE), FALSE);
					$oIdProduct->getData();

					$addItem['productName'] = $oIdProduct->getName(FALSE);

					$jsFields[] = '\'idProduct\'';
				}

				if (in_array('amount', $arrayFields) === TRUE)
				{
					$this->setAmount($_POST['amount'], TRUE);

					$addItem['amount'] = $this->getAmount(FALSE);

					$jsFields[] = '\'amount\'';
				}

				if (in_array('type', $arrayFields) === TRUE)
				{
					$this->setType($_POST['type'], TRUE);

					$addItem['type'] = $this->getType(FALSE);

					$jsFields[] = '\'type\'';
				}
				if (in_array('idSale', $arrayFields) === TRUE)
				{
					$this->setIdSale($_POST['idSale'], TRUE);
					$addItem['idSale'] = $this->getIdSale(FALSE);
					$oIdSale = new Csale();
					$oIdSale->setDbConn($this->getDbConn());
					$oIdSale->setId($this->getIdSale(FALSE), FALSE);
					$oIdSale->getData();
					$addItem['saleDateAdded'] = $oIdSale->getDateAdded(FALSE);
					$jsFields[] = '\'idSale\'';
				}

				if ($this->error() === FALSE)
				{
					if ($this->existItem($uniqueID) === TRUE)
					{
						$this->addError(CDETAIL_PAYMENT_CONTROL_FORM_DETAIL_EXIST_ITEM);
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

				if (in_array('idProduct', $arrayFields) === TRUE)
				{
					$this->setIdProduct($_POST['idProduct'], TRUE);

					$updateItem['idProduct'] = $this->getIdProduct(FALSE);

					$oIdProduct = new Cproduct();
					$oIdProduct->setDbConn($this->getDbConn());
					$oIdProduct->setId($this->getIdProduct(FALSE), FALSE);
					$oIdProduct->getData();

					$updateItem['productName'] = $oIdProduct->getName(FALSE);

					$jsFields[] = '\'idProduct\'';
				}

				if (in_array('amount', $arrayFields) === TRUE)
				{
					$this->setAmount($_POST['amount'], TRUE);

					$updateItem['amount'] = $this->getAmount(FALSE);

					$jsFields[] = '\'amount\'';
				}

				if (in_array('type', $arrayFields) === TRUE)
				{
					$this->setType($_POST['type'], TRUE);

					$updateItem['type'] = $this->getType(FALSE);

					$jsFields[] = '\'type\'';
				}
				if (in_array('idSale', $arrayFields) === TRUE)
				{
					$this->setIdSale($_POST['idSale'], TRUE);
					$updateItem['idSale'] = $this->getIdSale(FALSE);
					$oIdSale = new Csale();
					$oIdSale->setDbConn($this->getDbConn());
					$oIdSale->setId($this->getIdSale(FALSE), FALSE);
					$oIdSale->getData();
					$updateItem['saleDateAdded'] = $oIdSale->getDateAdded(FALSE);
					$jsFields[] = '\'idSale\'';
				}

				if ($this->error() === FALSE)
				{
					$index = $_POST['index'];

					if ($this->existItem($uniqueID, $index) === TRUE)
					{
						$this->addError(CDETAIL_PAYMENT_CONTROL_FORM_DETAIL_EXIST_ITEM);
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
					cleanForm('detail_payment', new Array(<?php echo implode(',', $jsFields); ?>));
				</script>
				<?php
			}
		}

		$this->listDetail($fileControl, $fields, $update, $delete, $uniqueID);
	}

	/**
	 * Actualiza el estado del producto
	 *
	 * @param int $idProduct
	 * @param string $status
	 * @param date $dateAddedPayment Fecha del cambio
	 */
	public function uptateProductStatus($idProduct, $status, $dateAddedPayment = '')
	{
	    if(empty($idProduct) == FALSE and empty($status) == FALSE)
	    {
    		$auxProd = new Cproduct($this->getDbConn());
    		$auxProd->setId($idProduct);
    		$auxProd->changeStatus($status, $dateAddedPayment);
	    }
	}
}
?>