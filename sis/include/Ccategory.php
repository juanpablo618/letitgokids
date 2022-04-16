<?php
/**
 * Archivo php creado por O-creator
 * 
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla category
 * 
 * Esta clase se encarga de la administración de la tabla category brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 * 
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Ccategory.php');
 * $category = new Ccategory();
 * $category->setDbConn($dbConn);
 * ?>
 * </code>
 * 
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.3:29-05-2019
 */
class Ccategory extends Cbase
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
	 * - Tabla: {@link Cproduct product}
	 * - Campo: {@link Cproduct::$idCategory idCategory}
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
	 * - Tipo de campo en la base de datos: varchar(50)
	 * - Campo requerido
	 * 
	 * Ver también: {@link getName()}, {@link setName()}
	 * @var string
	 * @access private
	 */
	private $name;

	/**
	 * Constructor de la clase
	 * 
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('category');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Ccategory.php');
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
			$this->addError(CCATEGORY_SETID_REQUIRED_VALUE);

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
				$this->addError(CCATEGORY_SETID_VALIDATE_VALUE);

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
			$this->addError(CCATEGORY_SETNAME_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->name = setValue($name, $gpc);

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
	 * Inserta un nuevo registro en la tabla category
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

		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CCATEGORY_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla category
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

			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CCATEGORY_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CCATEGORY_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla category
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
				$this->addError(CCATEGORY_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CCATEGORY_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla category
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
				
				return TRUE;
			}
			else
			{
				$this->addError(CCATEGORY_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CCATEGORY_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}
	
	/**
	 * Obtiene un registro de la tabla category
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
				
				return TRUE;
			}
			else
			{
				$this->addError(CCATEGORY_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CCATEGORY_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un conjunto de registros de la tabla category
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
				$this->addError(CCATEGORY_GETLIST_ERROR);

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

					$list[] = array(
						'id' => $this->getId($htmlEntities) ,
						'name' => $this->getName($htmlEntities)
					);

					$rs->MoveNext();
				}

				$this->id = NULL;
				$this->name = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CCATEGORY_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}

	/**
	 * Me dice si un registro de la tabla category puede ser eliminado
	 * 
	 * Este método me dice si un registro de la tabla puede ser eliminado porque existe una relación de la misma con las siguientes tablas:
	 * - {@link Cproduct product}
	 * 
	 * Si existe al menos un registro que tenga el valor de la clave primaria que se quiere eliminar en los siguientes campos:
	 * - campo {@link Cproduct::$idCategory idCategory} de la tabla {@link Cproduct product}
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
			$oProduct = new Cproduct();
			$oProduct->setDbConn($this->getDbConn());
			$rsProduct = $oProduct->getList($oProduct->getFieldSql('id_category', $oProduct->getTableName()).' = '.$oProduct->getValueSql($this->id));

			if ($rsProduct === FALSE)
			{
				$this->addError(CCATEGORY_CAN_DELETE_ERROR);

				return FALSE;
			}
			else
			{
				$return = TRUE;

				if ($oProduct->getTotalList() > 0)
				{
					$this->addError(CCATEGORY_CAN_DELETE_CANT_PRODUCT);

					$return = FALSE;
				}

				return $return;
			}
		}
		else
		{
			$this->addError(CCATEGORY_CAN_DELETE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Devuelve el último valor ID insertado en la tabla category
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
			$this->addError(CCATEGORY_GET_LAST_ID_ERROR);

			return FALSE;
		}
		else
		{
			return $row['id'];
		}
	}

	/**
	 * Muestra un formulario para dar de alta un registro de la tabla category
	 * 
	 * Este método muestra un formulario para dar de alta un registro de la tabla category mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,name';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['addCategory']) === FALSE)
		{
			$_POST['addCategory'] = '';
		}

		if ($_POST['addCategory'] == 'add')
		{
			if (in_array('name', $arrayFields) === TRUE)
			{
				$this->setName($_POST['name'], TRUE);
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
					<div class="message success"><?php echo CCATEGORY_ADD_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CCATEGORY_ADD_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="success" />
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
				<form name="formAddCategory" id="formAddCategory" method="post" action="">
				<input name="addCategory" type="hidden" id="addCategory" value="back" />
				<div class="fields">
				<?php
				if (in_array('name', $arrayFields) === TRUE)
				{
					echo '<input name="name" type="hidden" id="name" value="'.$this->getName().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CCATEGORY_ADD_FORM_BACK_BTN; ?>" class="back" />
				</div>
				</form>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
		else
		{
			if ($_POST['addCategory'] == 'back')
			{
				if (in_array('name', $arrayFields) === TRUE)
				{
					$this->setName($_POST['name'], TRUE);
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
				<form name="formAddCategory" id="formAddCategory" method="post" action="">
				<input name="addCategory" type="hidden" id="addCategory" value="add" />
				<div class="fields">
			<?php
			foreach ($arrayFields as $value)
			{
				if ($value == 'name')
				{
				?>
					<div class="field">
						<label><?php echo CCATEGORY_ADD_FORM_LABEL_FIELD_NAME; ?> <span>*</span></label>
						<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" maxlength="50" />
					</div>
				<?php
				}
			}
			?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CCATEGORY_ADD_FORM_SUBMIT_BTN; ?>" class="accept" />
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CCATEGORY_ADD_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
			<?php
			}
			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CCATEGORY_ADD_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Muestra un formulario para actualizar un registro existente de la tabla category
	 * 
	 * Este método muestra un formulario para actualizar un registro de la tabla category mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,name';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['updateCategory']) === FALSE)
		{
			$_POST['updateCategory'] = '';
		}

		if (isset($_GET['p']) === FALSE)
		{
			$_GET['p'] = '';
		}

		if ($_POST['updateCategory'] == 'update')
		{
			$this->setId($_POST['id'], TRUE);
			if (in_array('name', $arrayFields) === TRUE)
			{
				$this->setName($_POST['name'], TRUE);
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
					<div class="message success"><?php echo CCATEGORY_UPDATE_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CCATEGORY_UPDATE_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
				<form name="formUpdateCategory" id="formUpdateCategory" method="post" action="">
				<input name="updateCategory" type="hidden" id="updateCategory" value="back" />
				<div class="fields">
				<?php
				if (in_array('name', $arrayFields) === TRUE)
				{
					echo '<input name="name" type="hidden" id="name" value="'.$this->getName().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CCATEGORY_UPDATE_FORM_BACK_BTN; ?>" class="back" />
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
				if ($_POST['updateCategory'] == 'back')
				{
					if (in_array('name', $arrayFields) === TRUE)
					{
						$this->setName($_POST['name'], TRUE);
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
				<form name="formUpdateCategory" id="formUpdateCategory" method="post" action="">
				<input name="updateCategory" type="hidden" id="updateCategory" value="update" />
				<input name="id" type="hidden" id="id" value="<?php echo $this->getId(); ?>" />
				<div class="fields">
				<?php
				foreach ($arrayFields as $value)
				{
					if ($value == 'id')
					{
					?>
					<div class="field">
						<label><?php echo CCATEGORY_UPDATE_FORM_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
					<?php
					}
					if ($value == 'name')
					{
					?>
					<div class="field">
						<label><?php echo CCATEGORY_UPDATE_FORM_LABEL_FIELD_NAME; ?> <span>*</span></label>
						<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" maxlength="50" />
					</div>
					<?php
					}
				}
				?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CCATEGORY_UPDATE_FORM_SUBMIT_BTN; ?>" class="accept" />
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CCATEGORY_UPDATE_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="cancel" />
				<?php
				}
				?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CCATEGORY_UPDATE_FORM_LABEL_REQUIRED; ?></span>
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
					<input type="button" value="<?php echo CCATEGORY_UPDATE_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
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
	 * Elimina un registro existente de la tabla category y muestra el resultado obtenido
	 * 
	 * Este método intenta eliminar un registro de la tabla category y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
					<div class="message success"><?php echo CCATEGORY_DEL_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CCATEGORY_DEL_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
					<input type="button" value="<?php echo CCATEGORY_DEL_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
				</div>
		<?php
		}
		?>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Elimina un grupo de registros existente de la tabla category y muestra el resultado obtenido
	 * 
	 * Este método intenta eliminar un grupo de registros de la tabla category y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
			$this->addError(CCATEGORY_DEL_GROUP_FORM_REQUIRED_PK);
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
					<div class="message success"><?php echo CCATEGORY_DEL_GROUP_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CCATEGORY_DEL_GROUP_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="success" />
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
				$this->addError(CCATEGORY_DEL_GROUP_FORM_CANT_DELETE_ALL);
			}
			?>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="button" value="<?php echo CCATEGORY_DEL_GROUP_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="back" />
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
			$fields = 'id,name';
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
						<label><?php echo CCATEGORY_SHOW_DATA_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'name')
			{
			?>
					<div class="field">
						<label><?php echo CCATEGORY_SHOW_DATA_LABEL_FIELD_NAME; ?></label>
						<strong><?php echo $this->getName(); ?></strong>
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
					<input type="button" value="<?php echo CCATEGORY_SHOW_DATA_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
		<?php
		}
		?>
				</div>
				<div class="bottom"></div>
			</div>
	<?php
	}

	/**
	 * Muestra un formulario de búsqueda de registros de la tabla category
	 * 
	 * Este método muestra un formulario con los campos seteados en el parámetro $fields para realizar una búsqueda de los registros de la tabla category.
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
			$fields = 'id,name';
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
			if (isset($_SESSION['main_tr_search_category']) === FALSE)
			{
				$_SESSION['main_tr_search_category'] = '';
			}

			$display  = 'display: none;';
			$btnClass = 'closed';
			if ($_SESSION['main_tr_search_category'] === 'open')
			{
				$display  = '';
				$btnClass = 'open';
			}
		}
		?>
				<div class="title">
					<div class="ico"><?php if ($showHideBtn === TRUE) { ?><a href="#" onclick="showHideSearch('category'); return false;" class="<?php echo $btnClass; ?>"></a><?php } ?></div>
					<div class="label"><a href="#" onclick="showHideSearch('category'); return false;"><?php echo $title; ?></a></div>
				</div>
				<div id="container_search_category" style="<?php echo $display; ?>">
					<div class="top"></div>
					<form name="formSearchCategory" id="formSearchCategory" method="<?php echo $method; ?>" action="">
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
							<label><?php echo CCATEGORY_SEARCH_FORM_LABEL_FIELD_ID; ?></label>
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
							<label><?php echo CCATEGORY_SEARCH_FORM_LABEL_FIELD_NAME; ?></label>
							<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getName()) === TRUE)
				{
					$condition[] = $this->getFieldSql('name', $this->getTableName()).' LIKE '.$this->getValueSql($this->name, '%%');
					$params[] = 'name='.urlencode($this->name);
				}
			}
		}
		?>
					</div>
					<div class="middle"></div>
					<div class="buttons">
						<input type="submit" value="<?php echo CCATEGORY_SEARCH_FORM_SUBMIT_BTN; ?>" class="search" />
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
	 * Muestra el resultado de una consulta a la tabla category
	 * 
	 * Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla category. Muestra sólo los campos seteados en el parámetro $fields.
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
	 * Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST['categoryGroup'] (array)</b>
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
			$arrayOrder = array('id', 'name');
			
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

				$head.= '<div class="col" style="width: '.$arrayWidth['id'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CCATEGORY_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CCATEGORY_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></div>';
				$headers['id'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CCATEGORY_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CCATEGORY_SHOW_QUERY_HEAD_FIELD_ID).'</a></div>';
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

				$head.= '<div class="col" style="width: '.$arrayWidth['name'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CCATEGORY_SHOW_QUERY_HEAD_FIELD_NAME, $arrayStrLen['name']), CCATEGORY_SHOW_QUERY_HEAD_FIELD_NAME).'</a></div></div>';
				$headers['name'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CCATEGORY_SHOW_QUERY_HEAD_FIELD_NAME, $arrayStrLen['name']), CCATEGORY_SHOW_QUERY_HEAD_FIELD_NAME).'</a></div>';
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
				<form name="formQueryCategory" id="formQueryCategory" method="post" action="">
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
				<div class="message warning"><?php echo CCATEGORY_SHOW_QUERY_NOT_FOUND; ?></div>
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
					<div class="row row<?php echo $class; ?>" id="category_tr_<?php echo $row['id']; ?>" data-table-name="category" data-id="<?php echo $row['id']; ?>" data-form-id="formQueryCategory">
				<?php
				if (is_array($groupActions) === TRUE)
				{
				?>
						<div class="col header"></div>
						<div class="col" style="width: <?php echo $widthGroupActions; ?>;"><div class="group-actions"><input name="categoryGroup[]" type="checkbox" id="cb_category_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="checkboxClick(this)" /></div></div>
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
						<input name="category_select_all" type="checkbox" id="category_select_all" value="" class="checkbox_show_query" onclick="querySelectAll('category', 'formQueryCategory')" />
						<span><?php echo CCATEGORY_SHOW_QUERY_SELECT_ALL; ?></span>
					</div>
			<?php
			$j = 1;
			foreach ($groupActions as $value)
			{
				if ($value['confirm'] === TRUE)
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryCategory\', \''.$value['file'].'\', \''.$actionsParams.'\', true, \''.$value['msg'].'\');"';
				}
				else
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryCategory\', \''.$value['file'].'\', \''.$actionsParams.'\', false, \'\');"';
				}

				if ($value['button'] === TRUE)
				{
					echo '<input type="button" name="category_ga_'.$j.'" id="category_ga_'.$j.'" value="'.$value['text'].'" class="'.$value['class'].'" '.$onclick.' />';
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
	 * Muestra un listado de la tabla category en un campo select
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