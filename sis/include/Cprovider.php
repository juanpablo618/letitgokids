<?php
/**
 * Archivo php creado por O-creator
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla provider
 *
 * Esta clase se encarga de la administración de la tabla provider brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Cprovider.php');
 * $provider = new Cprovider();
 * $provider->setDbConn($dbConn);
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.3:29-05-2019
 */
class Cprovider extends Cbase
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
	 * - Campo: {@link Cmovement::$idProvider idProvider}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * <b>Relación</b>
	 * Este campo es usado como clave foránea en:
	 * - Tabla: {@link Cproduct product}
	 * - Campo: {@link Cproduct::$idProvider idProvider}
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
	 * - Tipo de campo en la base de datos: varchar(100)
	 * - Campo requerido
	 *
	 * Ver también: {@link getName()}, {@link setName()}
	 * @var string
	 * @access private
	 */
	private $name;

	/**
	 * Email
	 *
	 * - Campo en la base de datos: email
	 * - Tipo de campo en la base de datos: varchar(255)
	 * - Extra: E-mail (ver {@link validateEmailValue()})
	 * - Campo requerido
	 * - Campo único
	 *
	 * Ver también: {@link getEmail()}, {@link setEmail()}
	 * @var string
	 * @access private
	 */
	private $email;

	/**
	 * Teléfono
	 *
	 * - Campo en la base de datos: phone
	 * - Tipo de campo en la base de datos: varchar(100)
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhone()}, {@link setPhone()}
	 * @var string
	 * @access private
	 */
	private $phone;

	/**
	 * Constructor de la clase
	 *
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('provider');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cprovider.php');
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
			$this->addError(CPROVIDER_SETID_REQUIRED_VALUE);

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
				$this->addError(CPROVIDER_SETID_VALIDATE_VALUE);

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
			$this->addError(CPROVIDER_SETNAME_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->name = setValue($name, $gpc);

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $email Email}
	 *
	 * @param string $email indica el valor Email
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setEmail($email, $gpc = FALSE)
	{
		if (validateRequiredValue($email) === FALSE)
		{
			$this->email = $email;
			$this->addError(CPROVIDER_SETEMAIL_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->email = setValue($email, $gpc);

			if (validateEmailValue($this->email) === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CPROVIDER_SETEMAIL_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $phone Teléfono}
	 *
	 * @param string $phone indica el valor Teléfono
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setPhone($phone, $gpc = FALSE)
	{
		if (validateRequiredValue($phone) === FALSE)
		{
			$this->phone = $phone;
			$this->addError(CPROVIDER_SETPHONE_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->phone = setValue($phone, $gpc);

			return TRUE;
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
	 * Devuelve el valor {@link $email Email}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getEmail($htmlEntities = TRUE)
	{
		return getValue($this->email, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $phone Teléfono}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getPhone($htmlEntities = TRUE)
	{
		return getValue($this->phone, $htmlEntities, $this->getCharset());
	}

	/**
	 * Inserta un nuevo registro en la tabla provider
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

		if (isset($this->email) === TRUE)
		{
			$fields[] = $this->getFieldSql('email');
			$values[] = $this->getValueSql($this->email);
		}

		if (isset($this->phone) === TRUE)
		{
			$fields[] = $this->getFieldSql('phone');
			$values[] = $this->getValueSql($this->phone);
		}

		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CPROVIDER_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla provider
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

			if (isset($this->email) === TRUE)
			{
				$values[] = $this->getFieldSql('email').' = '.$this->getValueSql($this->email);
			}

			if (isset($this->phone) === TRUE)
			{
				$values[] = $this->getFieldSql('phone').' = '.$this->getValueSql($this->phone);
			}

			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CPROVIDER_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CPROVIDER_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla provider
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
				$this->addError(CPROVIDER_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CPROVIDER_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla provider
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
				$this->setEmail($row['email']);
				$this->setPhone($row['phone']);

				return TRUE;
			}
			else
			{
				$this->addError(CPROVIDER_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CPROVIDER_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla provider
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"SELECT * FROM `tabla` WHERE name = 'nombre'"</b>.
	 * Debe estar seteada la clave primaria del registro que se quiere obtener. Devuelve TRUE si se pudo obtener el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link showData()}
	 * @return boolean
	 * @access public
	 */
	public function getDataByName()
	{
		if (validateRequiredValue($this->name) === TRUE)
		{
			$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('name').' = '.$this->getValueSql($this->name);

			$row = $this->getDbConn()->GetRow($sql);

			if (is_array($row) === TRUE and count($row) > 0)
			{
				$this->setId($row['id']);
				$this->setName($row['name']);
				$this->setEmail($row['email']);
				$this->setPhone($row['phone']);

				return TRUE;
			}
			else
			{
				$this->addError(CPROVIDER_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CPROVIDER_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un conjunto de registros de la tabla provider
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
		$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE true';

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
				$this->addError(CPROVIDER_GETLIST_ERROR);

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
					$this->setEmail($rs->fields['email']);
					$this->setPhone($rs->fields['phone']);

					$list[] = array(
						'id' => $this->getId($htmlEntities) ,
						'name' => $this->getName($htmlEntities) ,
						'email' => $this->getEmail($htmlEntities) ,
						'phone' => $this->getPhone($htmlEntities)
					);

					$rs->MoveNext();
				}

				$this->id = NULL;
				$this->name = NULL;
				$this->email = NULL;
				$this->phone = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CPROVIDER_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}

	/**
	 * Verifica si ya existe en la tabla provider el valor Email seteado
	 *
	 * Este método controla si ya existe en la tabla provider un registro con el valor {@link $email Email} seteado.
	 * Si se está verificando la existencia del valor para un registro existente en la base de datos (se está modificando el registro), el parámetro $update debe ser TRUE y debe estar seteada la clave primaria del registro.
	 * Si no está seteado el valor {@link $email Email} el método devuelve FALSE.
	 *
	 * @param boolean $update [opcional] indica si el método se está llamando durante la actualización de un registro
	 * @return boolean
	 * @access public
	 */
	public function existEmail($update = FALSE)
	{
		if (validateRequiredValue($this->email) === TRUE)
		{
			$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('email').' = '.$this->getValueSql($this->email);

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
					$this->addError(CPROVIDER_EXIST_EMAIL_EXIST);

					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				$this->addError(CPROVIDER_EXIST_EMAIL_ERROR);

				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Me dice si un registro de la tabla provider puede ser eliminado
	 *
	 * Este método me dice si un registro de la tabla puede ser eliminado porque existe una relación de la misma con las siguientes tablas:
	 * - {@link Cmovement movement}
	 * - {@link Cproduct product}
	 *
	 * Si existe al menos un registro que tenga el valor de la clave primaria que se quiere eliminar en los siguientes campos:
	 * - campo {@link Cmovement::$idProvider idProvider} de la tabla {@link Cmovement movement}
	 * - campo {@link Cproduct::$idProvider idProvider} de la tabla {@link Cproduct product}
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
			$rsMovement = $oMovement->getList($oMovement->getFieldSql('id_provider', $oMovement->getTableName()).' = '.$oMovement->getValueSql($this->id));

			$oProduct = new Cproduct();
			$oProduct->setDbConn($this->getDbConn());
			$rsProduct = $oProduct->getList($oProduct->getFieldSql('id_provider', $oProduct->getTableName()).' = '.$oProduct->getValueSql($this->id));

			if ($rsMovement === FALSE or $rsProduct === FALSE)
			{
				$this->addError(CPROVIDER_CAN_DELETE_ERROR);

				return FALSE;
			}
			else
			{
				$return = TRUE;

				if ($oMovement->getTotalList() > 0)
				{
					$this->addError(CPROVIDER_CAN_DELETE_CANT_MOVEMENT);

					$return = FALSE;
				}

				if ($oProduct->getTotalList() > 0)
				{
					$this->addError(CPROVIDER_CAN_DELETE_CANT_PRODUCT);

					$return = FALSE;
				}

				return $return;
			}
		}
		else
		{
			$this->addError(CPROVIDER_CAN_DELETE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Devuelve el último valor ID insertado en la tabla provider
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
			$this->addError(CPROVIDER_GET_LAST_ID_ERROR);

			return FALSE;
		}
		else
		{
			return $row['id'];
		}
	}

	/**
	 * Muestra un formulario para dar de alta un registro de la tabla provider
	 *
	 * Este método muestra un formulario para dar de alta un registro de la tabla provider mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,name,email,phone';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['addProvider']) === FALSE)
		{
			$_POST['addProvider'] = '';
		}

		if ($_POST['addProvider'] == 'add')
		{
			if (in_array('name', $arrayFields) === TRUE)
			{
				$this->setName($_POST['name'], TRUE);
			}
			if (in_array('email', $arrayFields) === TRUE)
			{
				$this->setEmail($_POST['email'], TRUE);
			}
			if (in_array('phone', $arrayFields) === TRUE)
			{
				$this->setPhone($_POST['phone'], TRUE);
			}

			if (in_array('email', $arrayFields) === TRUE)
			{
				$this->existEmail();
			}

			if ($this->error() === FALSE)
			{
				$this->add();

				if ($this->error() === FALSE)
				{
				    $id = $this->getLastId();
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
					<div class="message success"><?php echo CPROVIDER_ADD_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				    ?>
				    <input type="button" value="<?php echo CPROVIDER_ADD_FORM_NEW_BTN; ?>" onclick="location.href='user-add.php?idLastProvider=<?php echo $id; ?>'" class="success" />
				    <input type="button" value="<?php echo CPROVIDER_ADD_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="success" />
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
				<form name="formAddProvider" id="formAddProvider" method="post" action="">
				<input name="addProvider" type="hidden" id="addProvider" value="back" />
				<div class="fields">
				<?php
				if (in_array('name', $arrayFields) === TRUE)
				{
					echo '<input name="name" type="hidden" id="name" value="'.$this->getName().'" />';
				}
				if (in_array('email', $arrayFields) === TRUE)
				{
					echo '<input name="email" type="hidden" id="email" value="'.$this->getEmail().'" />';
				}
				if (in_array('phone', $arrayFields) === TRUE)
				{
					echo '<input name="phone" type="hidden" id="phone" value="'.$this->getPhone().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPROVIDER_ADD_FORM_BACK_BTN; ?>" class="back" />
				</div>
				</form>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
		else
		{
			if ($_POST['addProvider'] == 'back')
			{
				if (in_array('name', $arrayFields) === TRUE)
				{
					$this->setName($_POST['name'], TRUE);
				}
				if (in_array('email', $arrayFields) === TRUE)
				{
					$this->setEmail($_POST['email'], TRUE);
				}
				if (in_array('phone', $arrayFields) === TRUE)
				{
					$this->setPhone($_POST['phone'], TRUE);
				}
			}
			?>
			<div class="form add">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<form name="formAddProvider" id="formAddProvider" method="post" action="">
				<input name="addProvider" type="hidden" id="addProvider" value="add" />
				<div class="fields">
			<?php
			foreach ($arrayFields as $value)
			{
				if ($value == 'name')
				{
				?>
					<div class="field">
						<label><?php echo CPROVIDER_ADD_FORM_LABEL_FIELD_NAME; ?> <span>*</span></label>
						<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" maxlength="100" />
					</div>
				<?php
				}
				if ($value == 'email')
				{
				?>
					<div class="field">
						<label><?php echo CPROVIDER_ADD_FORM_LABEL_FIELD_EMAIL; ?> <span>*</span></label>
						<input name="email" type="text" id="email" value="<?php echo $this->getEmail(); ?>" class="str" maxlength="255" />
					</div>
				<?php
				}
				if ($value == 'phone')
				{
				?>
					<div class="field">
						<label><?php echo CPROVIDER_ADD_FORM_LABEL_FIELD_PHONE; ?> <span>*</span></label>
						<input name="phone" type="text" id="phone" value="<?php echo $this->getPhone(); ?>" class="str" maxlength="100" />
					</div>
				<?php
				}
			}
			?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPROVIDER_ADD_FORM_SUBMIT_BTN; ?>" class="accept" />
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CPROVIDER_ADD_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
			<?php
			}
			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CPROVIDER_ADD_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Muestra un formulario para actualizar un registro existente de la tabla provider
	 *
	 * Este método muestra un formulario para actualizar un registro de la tabla provider mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,name,email,phone';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['updateProvider']) === FALSE)
		{
			$_POST['updateProvider'] = '';
		}

		if (isset($_GET['p']) === FALSE)
		{
			$_GET['p'] = '';
		}

		if ($_POST['updateProvider'] == 'update')
		{
			$this->setId($_POST['id'], TRUE);
			if (in_array('name', $arrayFields) === TRUE)
			{
				$this->setName($_POST['name'], TRUE);
			}
			if (in_array('email', $arrayFields) === TRUE)
			{
				$this->setEmail($_POST['email'], TRUE);
			}
			if (in_array('phone', $arrayFields) === TRUE)
			{
				$this->setPhone($_POST['phone'], TRUE);
			}

			if (in_array('email', $arrayFields) === TRUE)
			{
				$this->existEmail(TRUE);
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
					<div class="message success"><?php echo CPROVIDER_UPDATE_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CPROVIDER_UPDATE_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
				<form name="formUpdateProvider" id="formUpdateProvider" method="post" action="">
				<input name="updateProvider" type="hidden" id="updateProvider" value="back" />
				<div class="fields">
				<?php
				if (in_array('name', $arrayFields) === TRUE)
				{
					echo '<input name="name" type="hidden" id="name" value="'.$this->getName().'" />';
				}
				if (in_array('email', $arrayFields) === TRUE)
				{
					echo '<input name="email" type="hidden" id="email" value="'.$this->getEmail().'" />';
				}
				if (in_array('phone', $arrayFields) === TRUE)
				{
					echo '<input name="phone" type="hidden" id="phone" value="'.$this->getPhone().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPROVIDER_UPDATE_FORM_BACK_BTN; ?>" class="back" />
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
				if ($_POST['updateProvider'] == 'back')
				{
					if (in_array('name', $arrayFields) === TRUE)
					{
						$this->setName($_POST['name'], TRUE);
					}
					if (in_array('email', $arrayFields) === TRUE)
					{
						$this->setEmail($_POST['email'], TRUE);
					}
					if (in_array('phone', $arrayFields) === TRUE)
					{
						$this->setPhone($_POST['phone'], TRUE);
					}
				}
				?>
			<div class="form update">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<form name="formUpdateProvider" id="formUpdateProvider" method="post" action="">
				<input name="updateProvider" type="hidden" id="updateProvider" value="update" />
				<input name="id" type="hidden" id="id" value="<?php echo $this->getId(); ?>" />
				<div class="fields">
				<?php
				foreach ($arrayFields as $value)
				{
					if ($value == 'id')
					{
					?>
					<div class="field">
						<label><?php echo CPROVIDER_UPDATE_FORM_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
					<?php
					}
					if ($value == 'name')
					{
					?>
					<div class="field">
						<label><?php echo CPROVIDER_UPDATE_FORM_LABEL_FIELD_NAME; ?> <span>*</span></label>
						<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" maxlength="100" />
					</div>
					<?php
					}
					if ($value == 'email')
					{
					?>
					<div class="field">
						<label><?php echo CPROVIDER_UPDATE_FORM_LABEL_FIELD_EMAIL; ?> <span>*</span></label>
						<input name="email" type="text" id="email" value="<?php echo $this->getEmail(); ?>" class="str" maxlength="255" />
					</div>
					<?php
					}
					if ($value == 'phone')
					{
					?>
					<div class="field">
						<label><?php echo CPROVIDER_UPDATE_FORM_LABEL_FIELD_PHONE; ?> <span>*</span></label>
						<input name="phone" type="text" id="phone" value="<?php echo $this->getPhone(); ?>" class="str" maxlength="100" />
					</div>
					<?php
					}
				}
				?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CPROVIDER_UPDATE_FORM_SUBMIT_BTN; ?>" class="accept" />
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CPROVIDER_UPDATE_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="cancel" />
				<?php
				}
				?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CPROVIDER_UPDATE_FORM_LABEL_REQUIRED; ?></span>
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
					<input type="button" value="<?php echo CPROVIDER_UPDATE_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
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
	 * Elimina un registro existente de la tabla provider y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un registro de la tabla provider y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
					<div class="message success"><?php echo CPROVIDER_DEL_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CPROVIDER_DEL_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
					<input type="button" value="<?php echo CPROVIDER_DEL_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
				</div>
		<?php
		}
		?>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Elimina un grupo de registros existente de la tabla provider y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un grupo de registros de la tabla provider y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
			$this->addError(CPROVIDER_DEL_GROUP_FORM_REQUIRED_PK);
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
					<div class="message success"><?php echo CPROVIDER_DEL_GROUP_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CPROVIDER_DEL_GROUP_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="success" />
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
				$this->addError(CPROVIDER_DEL_GROUP_FORM_CANT_DELETE_ALL);
			}
			?>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="button" value="<?php echo CPROVIDER_DEL_GROUP_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="back" />
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
			$fields = 'id,name,email,phone';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		settype ($htmlEntities, 'boolean');
		?>
			<div class="form show provider">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<div id="provider-wrapper">
				<div class="picture"></div>
				<div class="fields">
		<?php
		foreach ($arrayFields as $value)
		{
			if ($value == 'id')
			{
			?>
					<div class="field">
						<label><?php echo CPROVIDER_SHOW_DATA_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'name')
			{
			?>
					<div class="field">
						<label><?php echo CPROVIDER_SHOW_DATA_LABEL_FIELD_NAME; ?></label>
						<strong><?php echo $this->getName(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'email')
			{
			?>
					<div class="field">
						<label><?php echo CPROVIDER_SHOW_DATA_LABEL_FIELD_EMAIL; ?></label>
						<strong><?php echo $this->getEmail(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'phone')
			{
			?>
					<div class="field">
						<label><?php echo CPROVIDER_SHOW_DATA_LABEL_FIELD_PHONE; ?></label>
						<strong><?php echo $this->getPhone(); ?></strong>
					</div>
			<?php
			}
		}
		?>
				</div>
				</div>
				<div class="clear"></div>
				<div class="wrapperProviderShow">
				    <?php
				    $param[] = 'fromScreen=showProvider';
				    $param[] = 'idProvider='.$this->getId(FALSE);

				    /**
				    * Productos de este proveedor
				    */

				    $product	 = new Cproduct($this->getDbConn());
				    $group	     = new Cgroup($this->getDbConn());

				    $group->setId($_SESSION['userIdGroup']);

				    //campos que se muestran en la consulta
				    $i = 0;
				    $fieldsProduct[$i]['field'] = 'id';
				    $fieldsProduct[$i]['width'] = '10%';
				    $fieldsProduct[$i]['strlen'] = '';

				    $i++;
				    $fieldsProduct[$i]['field'] = 'name';
				    $fieldsProduct[$i]['width'] = '41%';
				    $fieldsProduct[$i]['strlen'] = '';

				    $i++;
				    $fieldsProduct[$i]['field'] = 'dateChangeStatus';
				    $fieldsProduct[$i]['width'] = '20%';
				    $fieldsProduct[$i]['strlen'] = '';

				    $i++;
				    $fieldsProduct[$i]['field'] = 'listPrice';
				    $fieldsProduct[$i]['width'] = '20%';
				    $fieldsProduct[$i]['strlen'] = '';

				    $actionsProduct = array();

				    //acciones de la consulta
				    if ($group->filePermission('product-update.php', TRUE) == TRUE)
				    {
    					$actionsProduct[0]['file']         = 'product-update.php';
    					$actionsProduct[0]['image']        = 'img/update-head.png';
    					$actionsProduct[0]['image-over']   = 'img/update.png';
    					$actionsProduct[0]['image-head']   = '';
    					$actionsProduct[0]['class']        = 'update';
    					$actionsProduct[0]['text']         = 'Modificar';
    					$actionsProduct[0]['title']        = 'Modificar producto';
    					$actionsProduct[0]['confirm']      = FALSE;
    					$actionsProduct[0]['msg']          = '';
    					$actionsProduct[0]['width']        = '3%';
				    }

				    if ($group->filePermission('product-del.php', TRUE) == TRUE)
				    {
    					$actionsProduct[1]['file']         = 'product-del.php';
    					$actionsProduct[1]['image']        = 'img/delete-head.png';
    					$actionsProduct[1]['image-over']   = 'img/delete.png';
    					$actionsProduct[1]['image-head']   = '';
    					$actionsProduct[1]['class']        = 'del';
    					$actionsProduct[1]['text']         = 'Eliminar';
    					$actionsProduct[1]['title']        = 'Eliminar producto';
    					$actionsProduct[1]['confirm']      = TRUE;
    					$actionsProduct[1]['msg']          = '¿Está seguro que desea eliminar el producto?';
    					$actionsProduct[1]['width']        = '3%';
				    }

				    if ($group->filePermission('product-show.php', TRUE) == TRUE)
				    {
    					$actionsProduct[2]['file']         = 'product-show.php';
    					$actionsProduct[2]['image']        = 'img/show-head.png';
    					$actionsProduct[2]['image-over']   = 'img/show.png';
    					$actionsProduct[2]['image-head']   = '';
    					$actionsProduct[2]['class']        = 'show';
    					$actionsProduct[2]['text']         = 'Ver';
    					$actionsProduct[2]['title']        = 'Ver producto';
    					$actionsProduct[2]['confirm']      = FALSE;
    					$actionsProduct[2]['msg']          = '';
    					$actionsProduct[2]['width']        = '3%';
				    }

				    $conditionProduct[] = $product->getFieldSql('id_provider', $product->getTableName()).' = '.$product->getValueSql($this->getId(FALSE));

				    ?>


                	<div class="ui-state-highlight ui-corner-all notice">
                		<i class="fa fa-filter fa-2x" aria-hidden="true"></i> <p>Los productos estan filtrados según su estado.</p>
                	</div>
				    <div id="tabs">
						<ul>
                            <li><a href="#tabs-exhibited">Exhibidos</a></li>
                            <li><a href="#tabs-sold">Vendidos</a></li>
                            <li><a href="#tabs-give_back">Para devolver</a></li>
                            <li><a href="#tabs-returned">Devueltos</a></li>
                            <li><a href="#tabs-paid_out">Pagados</a></li>
                            <li><a href="#tabs-donate">Donados</a></li>
                      	</ul>
                      	<div id="tabs-exhibited">
							<?php
							$conditionProductExhibited   = $conditionProduct;
							$conditionProductExhibited[] = $product->getFieldSql('status', $product->getTableName()).' = '.$product->getValueSql('exhibited');
							$product->setCondition(implode(' AND ', $conditionProductExhibited));

							$product->showQuery($fieldsProduct, $actionsProduct, '', '3%', FALSE, FALSE, '', FALSE, FALSE, 'Listado de productos exhibidos', 0, 0, 'Agregado');
							?>
						</div>
						<div id="tabs-sold">
							<?php
							$conditionProductSold    = $conditionProduct;
							$conditionProductSold[]  = '('.$product->getFieldSql('status', $product->getTableName()).' = '.$product->getValueSql('sold').' OR '.$product->getFieldSql('status', $product->getTableName()).' = '.$product->getValueSql('to_pay').')';
							//$conditionProductSold[] = ;
							$product->setCondition(implode(' AND ', $conditionProductSold));

							$product->showQuery($fieldsProduct, $actionsProduct, '', '3%', FALSE, FALSE, '', FALSE, FALSE, 'Listado de productos vendidos', 0, 0, 'Vendido');
							?>
						</div>
						<div id="tabs-give_back">
							<?php
							$conditionProductGiveBack   = $conditionProduct;
							$conditionProductGiveBack[] = $product->getFieldSql('status', $product->getTableName()).' = '.$product->getValueSql('give_back');
							$product->setCondition(implode(' AND ', $conditionProductGiveBack));

							$product->showQuery($fieldsProduct, $actionsProduct, '', '3%', FALSE, FALSE, '', FALSE, FALSE, 'Listado de productos para devolver', 0, 0, 'Para devolver');
							?>
						</div>
						<div id="tabs-returned">
							<?php
							$conditionProductReturned   = $conditionProduct;
							$conditionProductReturned[] = $product->getFieldSql('status', $product->getTableName()).' = '.$product->getValueSql('returned');
							$product->setCondition(implode(' AND ', $conditionProductReturned));

							$product->showQuery($fieldsProduct, $actionsProduct, '', '3%', FALSE, FALSE, '', FALSE, FALSE, 'Listado de productos devueltos', 0, 0, 'Devueltos');
							?>
						</div>
						<div id="tabs-paid_out">
							<?php
							$conditionProductPaidOut   = $conditionProduct;
							$conditionProductPaidOut[] = $product->getFieldSql('status', $product->getTableName()).' = '.$product->getValueSql('paid_out');
							$product->setCondition(implode(' AND ', $conditionProductPaidOut));

							$product->showQuery($fieldsProduct, $actionsProduct, '', '3%', FALSE, FALSE, '', FALSE, FALSE, 'Listado de productos pagados', 0, 0, 'Pagados');
							?>
						</div>
						<div id="tabs-donate">
							<?php
							$conditionProductDonate   = $conditionProduct;
							$conditionProductDonate[] = $product->getFieldSql('status', $product->getTableName()).' = '.$product->getValueSql('donate');
							$product->setCondition(implode(' AND ', $conditionProductDonate));

							$product->showQuery($fieldsProduct, $actionsProduct, '', '3%', FALSE, FALSE, '', FALSE, FALSE, 'Listado de productos donados', 0, 0, 'Donado');
							?>
						</div>
				    </div>
				    <?php

				    /**
				     * MOVEMENTs
				     */
				    if($_SESSION['userIdGroup'] == 1)
				    {
    					?>
    					</div>
    					<div class="wrapperProviderShow">
    					<?php
    					/**
    					 * Cta Cte del proveedor
    					 */
    					$movement = new Cmovement($this->getDbConn());

    					//campos que se muestran en la consulta
    					$i = 0;
    					$fieldsMovement[$i]['field'] = 'id';
    					$fieldsMovement[$i]['width'] = '5%';
    					$fieldsMovement[$i]['strlen'] = '';

    					$i++;
    					$fieldsMovement[$i]['field'] = 'dateAdded';
    					$fieldsMovement[$i]['width'] = '10%';
    					$fieldsMovement[$i]['strlen'] = '';

    					$i++;
    					$fieldsMovement[$i]['field'] = 'typeMovement';
    					$fieldsMovement[$i]['width'] = '13%';
    					$fieldsMovement[$i]['strlen'] = '';

    					$i++;
    					$fieldsMovement[$i]['field'] = 'description';
    					$fieldsMovement[$i]['width'] = '36%';
    					$fieldsMovement[$i]['strlen'] = '';

    					$i++;
    					$fieldsMovement[$i]['field'] = 'type';
    					$fieldsMovement[$i]['width'] = '10%';
    					$fieldsMovement[$i]['strlen'] = '';

    					$i++;
    					$fieldsMovement[$i]['field'] = 'typePay';
    					$fieldsMovement[$i]['width'] = '10%';
    					$fieldsMovement[$i]['strlen'] = '';

    					$i++;
    					$fieldsMovement[$i]['field'] = 'realAmount';
    					$fieldsMovement[$i]['width'] = '10%';
    					$fieldsMovement[$i]['strlen'] = '';

    					$actionsMovement = array();

    					//acciones de la consulta
    					if ($group->filePermission('movement-update.php', TRUE) == TRUE)
    					{
    					    $actionsMovement[0]['file']         = 'movement-update.php';
    					    $actionsMovement[0]['image']        = 'img/update-head.png';
    					    $actionsMovement[0]['image-over']   = 'img/update.png';
    					    $actionsMovement[0]['image-head']   = '';
    					    $actionsMovement[0]['class']        = 'update';
    					    $actionsMovement[0]['text']         = 'Modificar';
    					    $actionsMovement[0]['title']        = 'Modificar movimiento';
    					    $actionsMovement[0]['confirm']      = FALSE;
    					    $actionsMovement[0]['msg']          = '';
    					    $actionsMovement[0]['width']        = '3%';
    					}
    					if ($group->filePermission('movement-del.php', TRUE) == TRUE)
    					{
    					    $actionsMovement[1]['file']         = 'movement-del.php';
    					    $actionsMovement[1]['image']        = 'img/delete-head.png';
    					    $actionsMovement[1]['image-over']   = 'img/delete.png';
    					    $actionsMovement[1]['image-head']   = '';
    					    $actionsMovement[1]['class']        = 'del';
    					    $actionsMovement[1]['text']         = 'Eliminar';
    					    $actionsMovement[1]['title']        = 'Eliminar movimiento';
    					    $actionsMovement[1]['confirm']      = TRUE;
    					    $actionsMovement[1]['msg']          = '¿Está seguro que desea eliminar el movimiento?';
    					    $actionsMovement[1]['width']        = '3%';
    					}
    					$conditionMovement[]    = $movement->getFieldSql('id_provider', $movement->getTableName()).' = '.$movement->getValueSql($this->getId(FALSE)).' OR '.$movement->getFieldSql('id_client', $movement->getTableName()).' = '.$movement->getValueSql($this->getId(FALSE));

    					$movement->setCondition(implode(' AND ', $conditionMovement));
    					$movement->extraParam = implode('&', $param);


    					$movement->showQuery($fieldsMovement, $actionsMovement, '', '5%', FALSE, FALSE, '', FALSE, FALSE, 'Movimientos', 0, 0);
				    }

				    /**
				     * LOGs
				     */
				    if($_SESSION['userIdGroup'] == 1)
				    {
				        ?>
    					</div>
    					<div class="wrapperProviderShow">
    					<?php
    					/**
    					 * logs del usuario
    					 */
    					$logs      = new Clog($this->getDbConn());
    					$auxUser   = new Cuser($this->getDbConn());
    					$auxUser->setIdProvider($this->getId(FALSE));
    					$auxUser->getDataByIdProvider();

    					//campos que se muestran en la consulta
    					$i = 0;
    					$fieldsLog[$i]['field']    = 'id';
    					$fieldsLog[$i]['width']    = '5%';
    					$fieldsLog[$i]['strlen']   = '';

    					$i++;
    					$fieldsLog[$i]['field']    = 'date';
    					$fieldsLog[$i]['width']    = '10%';
    					$fieldsLog[$i]['strlen']   = '';

    					$i++;
    					$fieldsLog[$i]['field']    = 'hour';
    					$fieldsLog[$i]['width']    = '13%';
    					$fieldsLog[$i]['strlen']   = '';

    					$logs->setCondition($logs->getFieldSql('id_user').'='.$logs->getValueSql($auxUser->getId(FALSE)));

    					$logs->showQuery($fieldsLog, NULL, '', '5%', FALSE, FALSE, '', FALSE, FALSE, 'Ingresos', 0, 0);
				    }
				    ?>
				</div>
				<div class="wrapperProviderShow">
				    <?php
				    $this->showProviderStatus();
				    ?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
		<?php
		if (validateRequiredValue($href) === TRUE)
		{
		?>
					<input type="button" value="<?php echo CPROVIDER_SHOW_DATA_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
		<?php
		}
		?>
				</div>
				<div class="bottom"></div>
			</div>
	<?php
	}

	/**
	 * Muestra un formulario de búsqueda de registros de la tabla provider
	 *
	 * Este método muestra un formulario con los campos seteados en el parámetro $fields para realizar una búsqueda de los registros de la tabla provider.
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
			$fields = 'id,name,email,phone';
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
		?>
			<div class="form search">
				<div class="aux"></div>
		<?php
		$display = '';
		if ($showHideBtn === TRUE)
		{
			if (isset($_SESSION['main_tr_search_provider']) === FALSE)
			{
				$_SESSION['main_tr_search_provider'] = '';
			}

			$display  = 'display: none;';
			$btnClass = 'closed';
			if ($_SESSION['main_tr_search_provider'] === 'open')
			{
				$display  = '';
				$btnClass = 'open';
			}
		}
		?>
				<div class="title">
					<div class="ico"><?php if ($showHideBtn === TRUE) { ?><a href="#" onclick="showHideSearch('provider'); return false;" class="<?php echo $btnClass; ?>"></a><?php } ?></div>
					<div class="label"><a href="#" onclick="showHideSearch('provider'); return false;"><?php echo $title; ?></a></div>
				</div>
				<div id="container_search_provider" style="<?php echo $display; ?>">
					<div class="top"></div>
					<form name="formSearchProvider" id="formSearchProvider" method="<?php echo $method; ?>" action="">
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
							<label><?php echo CPROVIDER_SEARCH_FORM_LABEL_FIELD_ID; ?></label>
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
							<label><?php echo CPROVIDER_SEARCH_FORM_LABEL_FIELD_NAME; ?></label>
							<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getName()) === TRUE)
				{
					$condition[] = $this->getFieldSql('name', $this->getTableName()).' LIKE '.$this->getValueSql($this->name, '%%');
					$params[] = 'name='.urlencode($this->name);
				}
			}

			if ($value == 'email')
			{
				$this->setEmail($values['email'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPROVIDER_SEARCH_FORM_LABEL_FIELD_EMAIL; ?></label>
							<input name="email" type="text" id="email" value="<?php echo $this->getEmail(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getEmail()) === TRUE)
				{
					$condition[] = $this->getFieldSql('email', $this->getTableName()).' LIKE '.$this->getValueSql($this->email, '%%');
					$params[] = 'email='.urlencode($this->email);
				}
			}

			if ($value == 'phone')
			{
				$this->setPhone($values['phone'], TRUE);
				?>
						<div class="field">
							<label><?php echo CPROVIDER_SEARCH_FORM_LABEL_FIELD_PHONE; ?></label>
							<input name="phone" type="text" id="phone" value="<?php echo $this->getPhone(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getPhone()) === TRUE)
				{
					$condition[] = $this->getFieldSql('phone', $this->getTableName()).' LIKE '.$this->getValueSql($this->phone, '%%');
					$params[] = 'phone='.urlencode($this->phone);
				}
			}
		}
		?>
					</div>
					<div class="middle"></div>
					<div class="buttons">
						<input type="submit" value="<?php echo CPROVIDER_SEARCH_FORM_SUBMIT_BTN; ?>" class="search" />
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
	 * Muestra el resultado de una consulta a la tabla provider
	 *
	 * Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla provider. Muestra sólo los campos seteados en el parámetro $fields.
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
	 * Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST['providerGroup'] (array)</b>
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
			$fields[1]['field'] = 'name';
			$fields[2]['field'] = 'email';
			$fields[3]['field'] = 'phone';
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
			$arrayOrder = array('id', 'name', 'email', 'phone');

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

				$head.= '<div class="col" style="width: '.$arrayWidth['id'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CPROVIDER_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CPROVIDER_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></div>';
				$headers['id'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CPROVIDER_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CPROVIDER_SHOW_QUERY_HEAD_FIELD_ID).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['name'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPROVIDER_SHOW_QUERY_HEAD_FIELD_NAME, $arrayStrLen['name']), CPROVIDER_SHOW_QUERY_HEAD_FIELD_NAME).'</a></div></div>';
				$headers['name'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPROVIDER_SHOW_QUERY_HEAD_FIELD_NAME, $arrayStrLen['name']), CPROVIDER_SHOW_QUERY_HEAD_FIELD_NAME).'</a></div>';
			}

			if ($value == 'email')
			{
				if ($_GET['orderby'] == 'email')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=email&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=email&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=email&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['email'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPROVIDER_SHOW_QUERY_HEAD_FIELD_EMAIL, $arrayStrLen['email']), CPROVIDER_SHOW_QUERY_HEAD_FIELD_EMAIL).'</a></div></div>';
				$headers['email'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPROVIDER_SHOW_QUERY_HEAD_FIELD_EMAIL, $arrayStrLen['email']), CPROVIDER_SHOW_QUERY_HEAD_FIELD_EMAIL).'</a></div>';
			}

			if ($value == 'phone')
			{
				if ($_GET['orderby'] == 'phone')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=phone&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=phone&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=phone&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['phone'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CPROVIDER_SHOW_QUERY_HEAD_FIELD_PHONE, $arrayStrLen['phone']), CPROVIDER_SHOW_QUERY_HEAD_FIELD_PHONE).'</a></div></div>';
				$headers['phone'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CPROVIDER_SHOW_QUERY_HEAD_FIELD_PHONE, $arrayStrLen['phone']), CPROVIDER_SHOW_QUERY_HEAD_FIELD_PHONE).'</a></div>';
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
				<form name="formQueryProvider" id="formQueryProvider" method="post" action="">
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
				<div class="message warning"><?php echo CPROVIDER_SHOW_QUERY_NOT_FOUND; ?></div>
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
					<div class="row row<?php echo $class; ?>" id="provider_tr_<?php echo $row['id']; ?>" data-table-name="provider" data-id="<?php echo $row['id']; ?>" data-form-id="formQueryProvider">
				<?php
				if (is_array($groupActions) === TRUE)
				{
				?>
						<div class="col header"></div>
						<div class="col" style="width: <?php echo $widthGroupActions; ?>;"><div class="group-actions"><input name="providerGroup[]" type="checkbox" id="cb_provider_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="checkboxClick(this)" /></div></div>
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

					if ($value == 'email')
					{
					?>
						<div class="col header"><?php echo $headers['email']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['email']; ?>;"><div class="str"><?php echo altText(getCutString($row['email'], $arrayStrLen['email']), $row['email']); ?></div></div>
					<?php
					}

					if ($value == 'phone')
					{
					?>
						<div class="col header"><?php echo $headers['phone']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['phone']; ?>;"><div class="str"><?php echo altText(getCutString($row['phone'], $arrayStrLen['phone']), $row['phone']); ?></div></div>
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
						<input name="provider_select_all" type="checkbox" id="provider_select_all" value="" class="checkbox_show_query" onclick="querySelectAll('provider', 'formQueryProvider')" />
						<span><?php echo CPROVIDER_SHOW_QUERY_SELECT_ALL; ?></span>
					</div>
			<?php
			$j = 1;
			foreach ($groupActions as $value)
			{
				if ($value['confirm'] === TRUE)
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryProvider\', \''.$value['file'].'\', \''.$actionsParams.'\', true, \''.$value['msg'].'\');"';
				}
				else
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryProvider\', \''.$value['file'].'\', \''.$actionsParams.'\', false, \'\');"';
				}

				if ($value['button'] === TRUE)
				{
					echo '<input type="button" name="provider_ga_'.$j.'" id="provider_ga_'.$j.'" value="'.$value['text'].'" class="'.$value['class'].'" '.$onclick.' />';
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
	 * Muestra un listado de la tabla provider en un campo select
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
	 * Muestra el estado de cuenta de un proveedor/cliente
	 *
	 * @param int $idProvider ID del proveedor/cliente
	 */
	public function showProviderStatus()
	{
	    if (validateRequiredValue($this->id) === TRUE)
	    {
		$movement	= new Cmovement($this->getDbConn());

		$TOTAL		= $movement->getProviderStatus($this->id);
		$txtCtaCte	= '';
		$classCtaCte	= '';
		if($TOTAL > 0)
		{
		    $txtCtaCte    = '$ '.numberFormat($TOTAL);
		    $classCtaCte  = 'red';
		}
		elseif($TOTAL == 0)
		{
		    $txtCtaCte    = '$ '.numberFormat($TOTAL);
		    $classCtaCte  = 'gray';
		}
		else
		{
		    $txtCtaCte = '$ '.numberFormat($TOTAL * -1);
		    $classCtaCte  = 'green';
		}

		$product	= new Cproduct($this->getDbConn());
		$TOTAL		= $product->getProviderStatus($this->id);
		$txtProduct	= '';
		$classProduct	= '';
		if($TOTAL[0] > 0)
		{
		    $txtProduct    = '$ '.numberFormat($TOTAL[0]).' (efvo) / $ '.numberFormat($TOTAL[1]).' (cta cte)';
		    $classProduct  = 'green';
		}
		else
		{
		    $txtProduct = '$ '.numberFormat(0);
		    $classProduct  = 'gray';
		}

		$product = new Cproduct();
		$search = $product->getFieldSql('id_provider', $product->getTableName()).' = '.$product->getValueSql($this->id).' AND '.$product->getFieldSql('status').' = '.$product->getValueSql('give_back');
		$product->getList($search);
		$txtProductToReturn = '';
		$classProductToReturn = '';
		if($product->getTotalList() > 0)
		{
		    $txtProductToReturn      = $product->getTotalList();
		    $classProductToReturn     = 'green';
		}
		else
		{
		    $txtProductToReturn      = 0;
		    $classProductToReturn     = 'gray';
		}

		?>
		<div id="controlWrapper">
		    <div class="left col33">
    			<h2>Crédito</h2>
    			<div class="<?php echo $classCtaCte; ?>">
    			    <?php echo $txtCtaCte; ?>
    			</div>
		    </div>
		    <div class="left col33">
    			<h2>Monto a Rendir</h2>
    			<div class="<?php echo $classProduct; ?>">
    				<div>Tenés para cobrar:</div>
    			    <?php echo $txtProduct; ?>
    			</div>
		    </div>
		    <div class="left col33">
    			<h2>Productos a Devolver</h2>
    			<div class="<?php echo $classProductToReturn; ?>">
    			    <?php echo $txtProductToReturn; ?>
    			</div>
		    </div>
		    <div class="clear"></div>
		</div>
		<?php
	    }
	    else
	    {
		    $this->addError(CMOVEMENT_SHOW_PROVIDER_STATUS_REQUIRED_ID_PROVIDER);

		    return FALSE;
	    }
	}

	/**
	 * Muestra listado de productos a devolver
	 */
	public function reportProductToBack()
	{
	    $product = new Cproduct($this->getDbConn());

	    $sql = 'SELECT '.$this->getFieldSql('id', 'c').' AS '.$this->getFieldSql('id').', '.$this->getFieldSql('name', 'c').' AS '.$this->getFieldSql('name').', '.$this->getFieldSql('email', 'c').' AS '.$this->getFieldSql('email').', '.$this->getFieldSql('phone', 'c').' AS '.$this->getFieldSql('phone').', COUNT('.$this->getFieldSql('id', 'p').') AS '.$this->getFieldSql('to_back').' FROM '.$this->getTableSql().' c, '.$product->getTableSql().' p WHERE '.$this->getFieldSql('id_provider', 'p').'='.$this->getFieldSql('id', 'c').' AND '.$this->getFieldSql('status', 'p').'='.$this->getValueSql('give_back').' GROUP BY '.$this->getFieldSql('id', 'c').' ORDER BY '.$this->getFieldSql('to_back').' DESC';
	    ?>
		<div class="form">
		    <div class="wrapperProducts">
			<div class="aux"></div>
			<div class="title">
			    <div class="ico"></div>
			    <div class="label">Listado de proveedores</div>
			    <div class="filter"></div>
			</div>
			<div id="formQueryProductBack" class="form query">
			    <div class="data">
				<div class="row header">
				    <div class="col left" style="width: 5%;"><div class="num">ID</div></div>
				    <div class="col left" style="width: 40%;"><div class="str">Nombre</div></div>
				    <div class="col left" style="width: 20%;"><div class="str">Email</div></div>
				    <div class="col left" style="width: 20%;"><div class="str">Teléfono</div></div>
				    <div class="col left" style="width: 15%;"><div class="num">Devolver</div></div>
				    <div class="clear"></div>
				</div>
		    <?php
		    $rs = $this->getDbConn()->Execute($sql);

		    if ($rs !== FALSE)
		    {
    			$i = 1;
    			while (!$rs->EOF)
    			{
    			    ?>
    				<div class="row row<?php echo $i; ?>" id="product_back_tr_<?php echo $rs->fields['id']; ?>" data-table-name="product_back" data-id="<?php echo $rs->fields['id']; ?>" data-form-id="formQueryProductBack">
    				<div class="col header">&nbsp;</div>
    				<div class="col header"><div class="num">ID</div></div>
    				<div class="col left" style="width: 5%;"><div class="num"><?php echo $rs->fields['id']; ?></div></div>
    				<div class="col header"><div class="str">Nombre</div></div>
    				<div class="col left" style="width: 40%;"><div class="str"><?php echo $rs->fields['name']; ?></div></div>
    				<div class="col header"><div class="str">Email</div></div>
    				<div class="col left" style="width: 20%;"><div class="str"><?php echo $rs->fields['email']; ?></div></div>
    				<div class="col header"><div class="str">Teléfono</div></div>
    				<div class="col left" style="width: 20%;"><div class="str"><?php echo $rs->fields['phone']; ?></div></div>
    				<div class="col header"><div class="num">Devolver</div></div>
    				<div class="col left" style="width: 15%;"><div class="num"><?php echo $rs->fields['to_back']; ?></div></div>
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
				<div class="message warning"><?php echo CPROVIDER_REPORT_PRODUCT_TO_BACK_NOT_ROWS; ?></div>
			<?php
		    }

		    ?>
			    </div>
			</div>
		    </div>
		</div>
	    <?php
	}

}
?>