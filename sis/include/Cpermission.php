<?php
/**
* Archivo php creado por O-creator
*
* @package EVOIT
* @author {@link http://www.evoit.com/ EVO I.T.}
* @copyright {@link http://www.evoit.com/ EVO I.T.}
*/

/**
* Administración de la tabla "permission"
*
* Esta clase se encarga de la administración de la tabla "permission" brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
*
* Ejemplo:
* <code>
* <?php
* include_once('Cpermission.php');
* $permission = new Cpermission();
* $permission->setDbConn()($getDbConn());
* ?>
* </code>
*
* @package EVOIT
* @author {@link http://www.evoit.com/ EVO I.T.}
* @version v3:12-07-2011
* @copyright {@link http://www.evoit.com/ EVO I.T.}
*/
class Cpermission extends Cbase
{
	/**
	* Id
	*
	* - Clave Primaria
	* - Auto Increment: campo auto_increment de MySQL
	* - Tipo MySql: bigint(20)
	* - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	*
	* Ver también: {@link getid()}, {@link setid()}
	* @var integer
	* @access private
	*/
	private $id;

	/**
	* Archivo
	*
	* - Tipo MySql: varchar(50)
	* - Campo requerido
	* - Campo único
	*
	* Ver también: {@link getname()}, {@link setname()}
	* @var string
	* @access private
	*/
	private $name;

	/**
	* Constructor de la clase
	*
	* En el constructor se setea por defecto el {@link $charset charset} de la clase.
	* Toma el valor de la constante CHARSET definida en el archivo de configuración del script.
	* Si no se le pasa como parámetro un conexión a la base de datos, intenta tomar una global ($GLOBALS['getDbConn()'])
	*
	* @param object (ADODB PHP) $getDbConn()  [opcional] Conección a la base de datos
	* @return void
	*/
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('permission');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cpermission.php');
	}

	/**
	* Destructor de la clase
	*/
	function __destruct()
	{

	}

	/**
	* Devuelve el valor "Id"
	*
	* - Campo MySql: {@link $id id}
	*
	* @param boolean $htmlentities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	* @return integer
	* @access public
	*/
	public function getid($htmlentities=TRUE)
	{
		return getValue($this->id, $htmlentities, $this->getCharset());
	}

	/**
	* Devuelve el valor "Archivo"
	*
	* - Campo MySql: {@link $name name}
	*
	* @param boolean $htmlentities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	* @return string
	* @access public
	*/
	public function getname($htmlentities=TRUE)
	{
		return getValue($this->name, $htmlentities, $this->getCharset());
	}

	/**
	* Setea el valor "Id"
	*
	* - Campo MySql: {@link $id id}
	*
	* @param integer $id indica el valor "Id"
	* @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	* @return boolean
	* @access public
	*/
	public function setid($id, $gpc=FALSE)
	{
		if (!validateRequiredValue($id))
		{
			$this->id = $id;
			$this->errors[] = CPERMISSION_SETID_REQUIRED_VALUE;
			return FALSE;
		}
		else
		{
			$this->id = setValue($id, $gpc);

			if (validateIntValue($this->id, '+'))
			{
				return TRUE;
			}
			else
			{
				$this->errors[] = CPERMISSION_SETID_VALIDATE_VALUE;
				return FALSE;
			}
		}
	}

	/**
	* Setea el valor "Archivo"
	*
	* - Campo MySql: {@link $name name}
	*
	* @param string $name indica el valor "Archivo"
	* @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	* @return boolean
	* @access public
	*/
	public function setname($name, $gpc=FALSE)
	{
		if (!validateRequiredValue($name))
		{
			$this->name = $name;
			$this->errors[] = CPERMISSION_SETNAME_REQUIRED_VALUE;
			return FALSE;
		}
		else
		{
			$this->name = setValue($name, $gpc);

			return TRUE;
		}
	}

	/**
	* Inserta un nuevo registro en la tabla "permission"
	*
	* Este método realiza una consulta a la base de datos del tipo <b>"INSERT INTO `tabla` (`campo1`, `campo2`) VALUES ('valor1', 'valor2')"</b>.
	* Para armar la consulta sólo tiene en cuenta los campos que están seteados. Devuelve TRUE si se pudo insertar el registro en forma correcta, en caso contrario devuelve FALSE.
	*
	* Ver también: {@link add_form()}
	* @return boolean
	* @access public
	*/
	public function add()
	{
		$fields = "";
		$values = "";
		$aux = "";
		if (isset($this->id))
		{
			//Le pongo 0 a los integers/bigint en vez de ''
			if (validateRequiredValue($this->id) === FALSE)
			{
				$this->id = 0;
			}
			$fields.= $aux.set_field_sql("id", "", "", $this->getDbConn());
			$values.= $aux.$this->getValueSql($this->id);
			$aux = " , ";
		}
		if (isset($this->name))
		{
			$fields.= $aux.set_field_sql("name", "", "", $this->getDbConn());
			$values.= $aux.$this->getValueSql($this->name);
			$aux = " , ";
		}
		$sql = "INSERT INTO ".$this->getTableSql()." (".$fields.") VALUES (".$values.")";
		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->errors[] = CPERMISSION_ADD_ERROR;
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	* Actualiza un registro de la tabla "permission"
	*
	* Este método realiza una consulta a la base de datos del tipo <b>"UPDATE `tabla` SET `campo1` = 'valor1', `campo2` = 'valor2' WHERE id_tabla = '1'"</b>.
	* Para armar la consulta sólo tiene en cuenta los campos que están seteados. Debe estar seteada la clave primaria del registro que se quiere modificar. Devuelve TRUE si se pudo modificar el registro en forma correcta, en caso contrario devuelve FALSE.
	*
	* Ver también: {@link update_form()}
	* @return boolean
	* @access public
	*/
	public function update()
	{
		if (validateRequiredValue($this->id))
		{
			$values = "";
			$aux = "";
			if (isset($this->name))
			{
				$values.= $aux.set_field_sql("name", "", "", $this->getDbConn())." = ".$this->getValueSql($this->name);
				$aux = " , ";
			}
			$sql = "UPDATE ".$this->getTableSql()." SET ".$values." WHERE ".set_field_sql("id", "", "", $this->getDbConn())." = ".$this->getValueSql($this->id);
			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->errors[] = CPERMISSION_UPDATE_ERROR;
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->errors[] = CPERMISSION_UPDATE_REQUIRED_PK;
			return FALSE;
		}
	}

	/**
	* Elimina un registro de la tabla "permission"
	*
	* Este método realiza una consulta a la base de datos del tipo <b>"DELETE FROM `tabla` WHERE id_tabla = '1'"</b>.
	* Para poder eliminar el registro debe estar seteada la clave primaria de la tabla. Devuelve TRUE si se pudo eliminar el registro en forma correcta, en caso contrario devuelve FALSE.
	*
	* Ver también: {@link del_form()}
	* @return boolean
	* @access public
	*/
	public function del()
	{
		if (validateRequiredValue($this->id))
		{
			$sql = "DELETE FROM ".$this->getTableSql()." WHERE ".set_field_sql("id", "", "", $this->getDbConn())." = ".$this->getValueSql($this->id);
			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->errors[] = CPERMISSION_DEL_ERROR;
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->errors[] = CPERMISSION_DEL_REQUIRED_PK;
			return FALSE;
		}
	}

	/**
	* Obtiene un registro de la tabla "permission"
	*
	* Este método realiza una consulta a la base de datos del tipo <b>"SELECT * FROM `tabla` WHERE id_tabla = '1'"</b>.
	* Debe estar seteada la clave primaria del registro que se quiere obtener. Devuelve TRUE si se pudo obtener el registro en forma correcta, en caso contrario devuelve FALSE.
	*
	* Ver también: {@link show_data()}
	* @return boolean
	* @access public
	*/
	public function getdata()
	{
		if (validateRequiredValue($this->id) === TRUE)
		{
			$sql = "SELECT * FROM ".$this->getTableSql()." WHERE ".set_field_sql("id", $this->gettable_name(), "", $this->getDbConn())." = ".$this->getValueSql($this->id);
			$rs = $this->getDbConn()->GetRow($sql);

			if ($rs !== FALSE and count($rs) > 0)
			{
				$this->setid($rs["id"]);
				$this->setname($rs["name"]);
				return TRUE;
			}
			else
			{
				$this->errors[] = CPERMISSION_GETDATA_ERROR;
				return FALSE;
			}
		}
		else
		{
			$this->errors[] = CPERMISSION_GETDATA_REQUIRED_PK;
			return FALSE;
		}
	}

	/**
	* Obtiene un conjunto de registros de la tabla "permission"
	*
	* Este método realiza una consulta a la base de datos del tipo <b>"SELECT * FROM `tabla`"</b>.
	* Devuelve los registros obtenidos en un array asociativo usando los nombres de los campos como clave.
	*
	* Ver también: {@link search_form()}, {@link show_query()}
	* @param string $search [opcional] condición de búsqueda para filtrar el resultado obtenido (se agrega al WHERE de la consulta)
	* @param integer $cant [opcional] indica la cantidad de registros a obtener en el array de resultado
	* @param integer $limit [opcional] indica el registro de la consulta por el que empezar a obtener el array de resultado
	* @param string $order [opcional] indica el orden en el que se obtienen los registros (cláusula ORDER BY de la consulta)
	* @param boolean $htmlentities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	* @return array|boolean
	* @access public
	*/
	public function getlist($search="", $cant=0, $limit=0, $order="", $htmlentities=TRUE)
	{
		$sql = "SELECT * FROM ".$this->getTableSql()." WHERE true";
		if ($search != "")
		{
			$sql.= " AND ".$search;
		}

		$sql_total = $sql;

		if ($order != "")
		{
			$sql.= " ORDER BY ".$order;
		}

		settype ($cant, "integer");
		settype ($limit, "integer");

		if (!$rs_total = $this->getDbConn()->Execute($sql_total))
		{
			$this->errors[] = CPERMISSION_GETLIST_TOTAL_LIST_ERROR;
			return FALSE;
		}
		else
		{
			$this->total_list = $rs_total->RecordCount();
		}

		if ($cant > 0)
		{
			$rs = $this->getDbConn()->SelectLimit($sql, $cant, $limit);
		}
		else
		{
			$rs = $this->getDbConn()->Execute($sql);
		}

		if ($rs === FALSE)
		{
			$this->errors[] = CPERMISSION_GETLIST_ERROR;
			return FALSE;
		}
		else
		{
			if ($htmlentities !== TRUE and $htmlentities !== FALSE)
			{
				$htmlentities = TRUE;
			}

			$list = array();
			$this->total_query = $rs->RecordCount();
			while (!$rs->EOF)
			{
				$this->setid($rs->fields["id"]);
				$this->setname($rs->fields["name"]);

				$list[] = array("id" => $this->getid($htmlentities) , "name" => $this->getname($htmlentities));

				$rs->MoveNext();
			}
			$this->id = NULL;
			$this->name = NULL;

			return $list;
		}
	}

	/**
	* Verifica si ya existe en la tabla "permission" el valor "Archivo" seteado
	*
	* Este método controla si ya existe en la tabla "permission" un registro con el valor {@link $name "Archivo"} seteado.
	* Si se está verificando la existencia del valor para un registro existente en la base de datos (se está modificando el registro), el parámetro $update debe ser TRUE y debe estar seteada la clave primaria del registro.
	* Si no está seteado el valor {@link $name "Archivo"} el método devuelve FALSE.
	*
	* @param boolean $update [opcional] indica si el método se está llamando durante la actualización de un registro
	* @return boolean
	* @access public
	*/
	public function exist_name($update=FALSE)
	{
		if (validateRequiredValue($this->name) === TRUE)
		{
			$sql = "SELECT * FROM ".$this->getTableSql()." WHERE ".set_field_sql("name", "", "", $this->getDbConn())." = ".$this->getValueSql($this->name);
			if ($update === TRUE)
			{
				if (validateRequiredValue($this->id) === TRUE)
				{
					$sql.= " AND ".set_field_sql("id", "", "", $this->getDbConn())." != ".$this->getValueSql($this->id)."";
				}
			}
			$rs = $this->getDbConn()->GetRow($sql);
			if ($rs !== FALSE)
			{
				if (count($rs) > 0)
				{
					$this->errors[] = CPERMISSION_EXIST_NAME_EXIST;
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				$this->errors[] = CPERMISSION_EXIST_NAME_ERROR;
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	/**
	* Muestra un formulario para dar de alta un registro de la tabla "permission"
	*
	* Este método muestra un formulario para dar de alta un registro de la tabla "permission" mostrando sólo los campos seteados en el parámetro $fields.
	*
	* Ver también: {@link add()}, {@link update_form()}, {@link del_form()}, {@link show_data()}
	* @param string $fields [opcional] cadena con los campos (separados con comas) que se van a mostrar en el formulario. Ej: "campo1,campo2,campo3, ... ,campoN"
	* @param string $href [opcional] indica la página a la que se redirecciona cuando se cancela el formulario o cuando el registro es insertado en forma correcta
	* @param boolean $auto_redirect [opcional] indica si se debe auto redireccionar a la página definida en $href una vez que se insertó en forma correcta el registro
	* @param string $images [opcional] url donde se encuentran las imágenes que se pueden utilizar en este método, como por ejemplo la imagen que muestra el calendario
	* @param string $title [opcional] título
	* @return mixed
	* @access public
	*/
	public function add_form($fields='', $href='', $auto_redirect=FALSE, $images='', $title='')
	{
		if (!validateRequiredValue($fields))
		{
			$fields = "id,name";
		}

		#fields control
		$array_fields = explode(",", $fields);
		$amount_fields = count($array_fields);
		for ($j = 0; $j < $amount_fields; $j++)
		{
			$array_fields[$j] = trim ($array_fields[$j]);
		}

		#title control
		if (!validateRequiredValue($title))
		{
			$title = '&nbsp;';
		}

		if (!isset($_POST["add_permission"]))
		{
			$_POST["add_permission"] = "";
		}

		if ($_POST["add_permission"] == "add")
		{
			if (in_array("name", $array_fields))
			{
				$this->setname($_POST["name"], TRUE);
			}

			if (in_array("name", $array_fields))
			{
				$this->exist_name();
			}

			if ($this->error() === FALSE)
			{
				$this->add();
			}
			if ($this->error() === FALSE)
			{
				if ($auto_redirect === TRUE and validateRequiredValue($href))
				{
				?>
				<script language="JavaScript" type="text/JavaScript">
					location.href = '<?=$href?>';
				</script>
				<?php
				}
				?>
				<table border="0" cellspacing="0" cellpadding="0" class="form_tbl">
					<tr class="form_tr_title">
						<td class="form_td_title"><?=$title?></td>
					</tr>
					<tr class="form_tr_separator_top">
						<td class="form_td_separator_top"></td>
					</tr>
					<tr class="form_tr_ok">
						<td class="form_td_ok"><div class="text_ok"><?=CPERMISSION_ADD_FORM_OK?></div></td>
					</tr>
				<?php
				if (validateRequiredValue($href))
				{
				?>
					<tr class="form_tr_sub">
						<td class="form_td_sub"><input type="button" name="btnok" value="<?=CPERMISSION_ADD_FORM_OK_BTN?>" onclick="location.href='<?=$href?>'" class="input_button" /></td>
					</tr>
				<?php
				}
				?>
					<tr class="form_tr_separator_bottom">
						<td class="form_td_separator_bottom"></td>
					</tr>
				</table>
			<?php
			}
			else
			{
			?>
				<form name="form_add_permission" method="post" action="" class="form">
				<input name="add_permission" type="hidden" id="add_permission" value="back" />
				<?php
				if (in_array("name", $array_fields))
				{
					echo '<input name="name" type="hidden" id="name" value="'.$this->getname().'" />';
				}
				?>
				<table border="0" cellspacing="0" cellpadding="0" class="form_tbl">
					<tr class="form_tr_title">
						<td class="form_td_title"><?=$title?></td>
					</tr>
					<tr class="form_tr_separator_top">
						<td class="form_td_separator_top"></td>
					</tr>
					<tr class="form_tr_error">
						<td class="form_td_error"><div class="text_error"><?=$this->show_errors()?></div></td>
					</tr>
					<tr class="form_tr_sub">
						<td class="form_td_sub"><input type="submit" name="btnback" value="<?=CPERMISSION_ADD_FORM_BACK_BTN?>" class="input_button" /></td>
					</tr>
					<tr class="form_tr_separator_bottom">
						<td class="form_td_separator_bottom"></td>
					</tr>
				</table>
				</form>
			<?php
			}
		}
		else
		{
			if ($_POST["add_permission"] == "back")
			{
				if (in_array("name", $array_fields))
				{
					$this->setname($_POST["name"], TRUE);
				}
			}
			?>
			<form name="form_add_permission" method="post" action="" class="form">
			<input name="add_permission" type="hidden" id="add_permission" value="add" />
			<table border="0" cellspacing="0" cellpadding="0" class="form_tbl">
				<tr class="form_tr_title">
					<td class="form_td_title" colspan="2"><?=$title?></td>
				</tr>
				<tr class="form_tr_separator_top">
					<td class="form_td_separator_top" colspan="2"></td>
				</tr>
			<?php
			foreach ($array_fields as $value)
			{
				if ($value == 'name')
				{
				?>
				<tr class="form_tr">
					<td class="form_td_l"><div class="text_field"><?=CPERMISSION_ADD_FORM_LABEL_FIELD_NAME?> <span class="symbol_required">*</span></div></td>
					<td class="form_td_r"><input name="name" type="text" id="name" value="<?=$this->getname()?>" class="input_text" maxlength="50" /></td>
				</tr>
				<?php
				}
			}
			?>
				<tr class="form_tr_cs">
					<td class="form_td_cs" colspan="2"><div class="text_required">* <?=CPERMISSION_ADD_FORM_LABEL_REQUIRED?></div></td>
				</tr>
				<tr class="form_tr_sub">
					<td class="form_td_sub" colspan="2">
						<input type="submit" name="btnsubmit" value="<?=CPERMISSION_ADD_FORM_SUBMIT_BTN?>" class="input_button" />
			<?php
			if (validateRequiredValue($href))
			{
			?>
						<input type="button" name="btncancel" value="<?=CPERMISSION_ADD_FORM_CANCEL_BTN?>" onclick="location.href='<?=$href?>'" class="input_button" />
			<?php
			}
			?>
					</td>
				</tr>
				<tr class="form_tr_separator_bottom">
					<td class="form_td_separator_bottom" colspan="2"></td>
				</tr>
			</table>
			</form>
		<?php
		}
	}

	/**
	* Muestra un formulario para actualizar un registro existente de la tabla "permission"
	*
	* Este método muestra un formulario para actualizar un registro de la tabla "permission" mostrando sólo los campos seteados en el parámetro $fields.
	* Debe estar seteada la clave primaria del registro que se quiere modificar.
	*
	* Ver también: {@link update()}, {@link add_form()}, {@link del_form()}, {@link show_data()}
	* @param string $fields [opcional] cadena con los campos (separados con comas) que se van a mostrar en el formulario. Ej: "campo1,campo2,campo3, ... ,campoN"
	* @param string $href [opcional] indica la página a la que se redirecciona cuando se cancela el formulario o cuando el registro es modificado en forma correcta
	* @param boolean $auto_redirect [opcional] indica si se debe auto redireccionar a la página definida en $href una vez que se modificó en forma correcta el registro
	* @param string $images [opcional] url donde se encuentran las imágenes que se pueden utilizar en este método, como por ejemplo la imagen que muestra el calendario
	* @param string $title [opcional] título
	* @return mixed
	* @access public
	*/
	public function update_form($fields='', $href='', $auto_redirect=FALSE, $images='', $title='')
	{
		if (!validateRequiredValue($fields))
		{
			$fields = "id,name";
		}

		#fields control
		$array_fields = explode(",", $fields);
		$amount_fields = count($array_fields);
		for ($j = 0; $j < $amount_fields; $j++)
		{
			$array_fields[$j] = trim ($array_fields[$j]);
		}

		#title control
		if (!validateRequiredValue($title))
		{
			$title = '&nbsp;';
		}

		if (!isset($_POST["update_permission"]))
		{
			$_POST["update_permission"] = "";
		}
		if (!isset($_GET["p"]))
		{
			$_GET["p"] = "";
		}

		if ($_POST["update_permission"] == "update")
		{
			$this->setid($_POST["id"], TRUE);
			if (in_array("name", $array_fields))
			{
				$this->setname($_POST["name"], TRUE);
			}

			if (in_array("name", $array_fields))
			{
				$this->exist_name(TRUE);
			}

			if ($this->error() === FALSE)
			{
				$this->update();
			}
			if ($this->error() === FALSE)
			{
				if ($auto_redirect === TRUE and validateRequiredValue($href))
				{
				?>
				<script language="JavaScript" type="text/JavaScript">
					location.href = '<?=$href?><?=($_GET["p"] != "") ? '?p='.$_GET["p"] : ''?>';
				</script>
				<?php
				}
			?>
				<table border="0" cellspacing="0" cellpadding="0" class="form_tbl">
					<tr class="form_tr_title">
						<td class="form_td_title"><?=$title?></td>
					</tr>
					<tr class="form_tr_separator_top">
						<td class="form_td_separator_top"></td>
					</tr>
					<tr class="form_tr_ok">
						<td class="form_td_ok"><div class="text_ok"><?=CPERMISSION_UPDATE_FORM_OK?></div></td>
					</tr>
				<?php
				if (validateRequiredValue($href))
				{
				?>
					<tr class="form_tr_sub">
						<td class="form_td_sub"><input type="button" name="btnok" value="<?=CPERMISSION_UPDATE_FORM_OK_BTN?>" onclick="location.href='<?=$href?><?=($_GET["p"] != "") ? '?p='.$_GET["p"] : ''?>'" class="input_button" /></td>
					</tr>
				<?php
				}
				?>
					<tr class="form_tr_separator_bottom">
						<td class="form_td_separator_bottom"></td>
					</tr>
				</table>
			<?php
			}
			else
			{
			?>
				<form name="form_update_permission" method="post" action="" class="form">
				<input name="update_permission" type="hidden" id="update_permission" value="back" />
				<?php
				if (in_array("name", $array_fields))
				{
					echo '<input name="name" type="hidden" id="name" value="'.$this->getname().'" />';
				}
				?>
				<table border="0" cellspacing="0" cellpadding="0" class="form_tbl">
					<tr class="form_tr_title">
						<td class="form_td_title"><?=$title?></td>
					</tr>
					<tr class="form_tr_separator_top">
						<td class="form_td_separator_top"></td>
					</tr>
					<tr class="form_tr_error">
						<td class="form_td_error"><div class="text_error"><?=$this->show_errors()?></div></td>
					</tr>
					<tr class="form_tr_sub">
						<td class="form_td_sub"><input type="submit" name="btnback" value="<?=CPERMISSION_UPDATE_FORM_BACK_BTN?>" class="input_button" /></td>
					</tr>
					<tr class="form_tr_separator_bottom">
						<td class="form_td_separator_bottom"></td>
					</tr>
				</table>
				</form>
			<?php
			}
		}
		else
		{
			if ($this->getdata())
			{
				if ($_POST["update_permission"] == "back")
				{
					if (in_array("name", $array_fields) === TRUE)
					{
						$this->setname($_POST["name"], TRUE);
					}
				}
				?>
				<form name="form_update_permission" method="post" action="" class="form">
				<input name="update_permission" type="hidden" id="update_permission" value="update" />
				<input name="id" type="hidden" id="id" value="<?=$this->getid()?>" />
				<table border="0" cellspacing="0" cellpadding="0" class="form_tbl">
					<tr class="form_tr_title">
						<td class="form_td_title" colspan="2"><?=$title?></td>
					</tr>
					<tr class="form_tr_separator_top">
						<td class="form_td_separator_top" colspan="2"></td>
					</tr>
				<?php
				foreach ($array_fields as $value)
				{
					if ($value == 'id')
					{
					?>
					<tr class="form_tr">
						<td class="form_td_l"><div class="text_field"><?=CPERMISSION_UPDATE_FORM_LABEL_FIELD_ID?></div></td>
						<td class="form_td_r"><div class="text_bold"><?=$this->getid()?></div></td>
					</tr>
					<?php
					}
					if ($value == 'name')
					{
					?>
					<tr class="form_tr">
						<td class="form_td_l"><div class="text_field"><?=CPERMISSION_UPDATE_FORM_LABEL_FIELD_NAME?> <span class="symbol_required">*</span></div></td>
						<td class="form_td_r"><input name="name" type="text" id="name" value="<?=$this->getname()?>" class="input_text" maxlength="50" /></td>
					</tr>
					<?php
					}
				}
				?>
					<tr class="form_tr_cs">
						<td class="form_td_cs" colspan="2"><div class="text_required">* <?=CPERMISSION_UPDATE_FORM_LABEL_REQUIRED?></div></td>
					</tr>
					<tr class="form_tr_sub">
						<td class="form_td_sub" colspan="2">
							<input type="submit" name="btnsubmit" value="<?=CPERMISSION_UPDATE_FORM_SUBMIT_BTN?>" class="input_button" />
				<?php
				if (validateRequiredValue($href))
				{
				?>
							<input type="button" name="btncancel" value="<?=CPERMISSION_UPDATE_FORM_CANCEL_BTN?>" onclick="location.href='<?=$href?><?=($_GET["p"] != "") ? '?p='.$_GET["p"] : ''?>'" class="input_button" />
				<?php
				}
				?>
						</td>
					</tr>
					<tr class="form_tr_separator_bottom">
						<td class="form_td_separator_bottom" colspan="2"></td>
					</tr>
				</table>
				</form>
			<?php
			}
			else
			{
			?>
				<table border="0" cellspacing="0" cellpadding="0" class="form_tbl">
					<tr class="form_tr_title">
						<td class="form_td_title"><?=$title?></td>
					</tr>
					<tr class="form_tr_separator_top">
						<td class="form_td_separator_top"></td>
					</tr>
					<tr class="form_tr_error">
						<td class="form_td_error"><div class="text_error"><?=$this->show_errors()?></div></td>
					</tr>
				<?php
				if (validateRequiredValue($href))
				{
				?>
					<tr class="form_tr_sub">
						<td class="form_td_sub"><input type="button" name="btnback" value="<?=CPERMISSION_UPDATE_FORM_BACK_BTN?>" onclick="location.href='<?=$href?><?=($_GET["p"] != "") ? '?p='.$_GET["p"] : ''?>'" class="input_button" /></td>
					</tr>
				<?php
				}
				?>
					<tr class="form_tr_separator_bottom">
						<td class="form_td_separator_bottom"></td>
					</tr>
				</table>
			<?php
			}
		}
	}

	/**
	* Elimina un registro existente de la tabla "permission" y muestra el resultado obtenido
	*
	* Este método intenta eliminar un registro de la tabla "permission" y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
	* Para realizar esto debe estar seteada la clave primaria del registro a eliminar.
	*
	* Ver también: {@link del()}, {@link add_form()}, {@link update_form()}, {@link show_data()}
	* @param string $href [opcional] indica la página a la que se redirecciona una vez que fue mostrado el resultado de la eliminación del registro
	* @param boolean $auto_redirect [opcional] indica si se debe auto redireccionar a la página definida en $href una vez que se eliminó el registro en forma correcta
	* @param string $title [opcional] título
	* @return mixed
	* @access public
	*/
	public function del_form($href="", $auto_redirect=FALSE, $title="")
	{
		#title control
		if (!validateRequiredValue($title))
		{
			$title = '&nbsp;';
		}

		if (!isset($_GET["p"]))
		{
			$_GET["p"] = "";
		}

		$rs = $this->del();

		if ($this->error() === FALSE and validateRequiredValue($href) and $auto_redirect === TRUE)
		{
			echo '<script language="JavaScript" type="text/JavaScript">';
			if ($_GET["p"] != "")
			{
				echo 'location.href=\''.$href.'?p='.$_GET["p"].'\';';
			}
			else
			{
				echo 'location.href=\''.$href.'\';';
			}
			echo '</script>';

			return TRUE;
		}
		?>
		<table border="0" cellspacing="0" cellpadding="0" class="form_tbl">
			<tr class="form_tr_title">
				<td class="form_td_title"><?=$title?></td>
			</tr>
			<tr class="form_tr_separator_top">
				<td class="form_td_separator_top"></td>
			</tr>
		<?php
		if ($this->error() === FALSE)
		{
		?>
			<tr class="form_tr_ok">
				<td class="form_td_ok"><div class="text_ok"><?=CPERMISSION_DEL_FORM_OK?></div></td>
			</tr>
			<?php
			if (validateRequiredValue($href))
			{
			?>
			<tr class="form_tr_sub">
				<td class="form_td_sub"><input type="button" name="btnok" value="<?=CPERMISSION_DEL_FORM_OK_BTN?>" onclick="location.href='<?=$href?><?=($_GET["p"] != "") ? '?p='.$_GET["p"] : ''?>'" class="input_button" /></td>
			</tr>
			<?php
			}
		}
		else
		{
		?>
			<tr class="form_tr_error">
				<td class="form_td_error"><div class="text_error"><?=$this->show_errors()?></div></td>
			</tr>
			<tr class="form_tr_sub">
				<td class="form_td_sub"><input type="button" name="btnback" value="<?=CPERMISSION_DEL_FORM_BACK_BTN?>" onclick="location.href='<?=$href?><?=($_GET["p"] != "") ? '?p='.$_GET["p"] : ''?>'" class="input_button" /></td>
			</tr>
		<?php
		}
		?>
			<tr class="form_tr_separator_bottom">
				<td class="form_td_separator_bottom"></td>
			</tr>
		</table>
		<?php
	}

	/**
	* Elimina un grupo de registros existente de la tabla "permission" y muestra el resultado obtenido
	*
	* Este método intenta eliminar un grupo de registros de la tabla "permission" y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
	*
	* Ver también: {@link del()}, {@link del_form()}
	* @param array $group array con las claves primarias de los registros a eliminarse
	* @param string $href [opcional] indica la página a la que se redirecciona una vez que fue mostrado el resultado de la eliminación de los registros
	* @param boolean $auto_redirect [opcional] indica si se debe auto redireccionar a la página definida en $href una vez que se eliminaron los registros en forma correcta
	* @param string $title [opcional] título
	* @return mixed
	* @access public
	*/
	public function del_group_form($group, $href="", $auto_redirect=FALSE, $title="")
	{
		#title control
		if (!validateRequiredValue($title))
		{
			$title = '&nbsp;';
		}

		if (!isset($_POST["p"]))
		{
			$_POST["p"] = "";
		}

		$flag_group = FALSE;

		if (is_array($group))
		{
			foreach ($group as $value)
			{
				if ($this->setid($value, TRUE))
				{
					if (!$this->del())
					{
						$flag_group = TRUE;
					}
				}
				else
				{
					$flag_group = TRUE;
				}
			}
		}
		else
		{
			$this->errors[] = CPERMISSION_DEL_GROUP_FORM_REQUIRED_PK;
		}

		if ($this->error() === FALSE and validateRequiredValue($href) and $auto_redirect === TRUE)
		{
			echo '<script language="JavaScript" type="text/JavaScript">';
			if ($_POST["p"] != "")
			{
				echo 'location.href=\''.$href.'?p='.$_POST["p"].'\';';
			}
			else
			{
				echo 'location.href=\''.$href.'\';';
			}
			echo '</script>';

			return TRUE;
		}
		?>
		<table border="0" cellspacing="0" cellpadding="0" class="form_tbl">
			<tr class="form_tr_title">
				<td class="form_td_title"><?=$title?></td>
			</tr>
			<tr class="form_tr_separator_top">
				<td class="form_td_separator_top"></td>
			</tr>
		<?php
		if ($this->error() === FALSE)
		{
		?>
			<tr class="form_tr_ok">
				<td class="form_td_ok"><div class="text_ok"><?=CPERMISSION_DEL_GROUP_FORM_OK?></div></td>
			</tr>
			<?php
			if (validateRequiredValue($href))
			{
			?>
			<tr class="form_tr_sub">
				<td class="form_td_sub"><input type="button" name="btnok" value="<?=CPERMISSION_DEL_GROUP_FORM_OK_BTN?>" onclick="location.href='<?=$href?><?=($_POST["p"] != "") ? '?p='.$_POST["p"] : ''?>'" class="input_button" /></td>
			</tr>
			<?php
			}
		}
		else
		{
			if ($flag_group === TRUE)
			{
				$this->delete_errors();
				$this->errors[] = CPERMISSION_DEL_GROUP_FORM_CANT_DELETE_ALL;
			}
		?>
			<tr class="form_tr_error">
				<td class="form_td_error"><div class="text_error"><?=$this->show_errors()?></div></td>
			</tr>
			<tr class="form_tr_sub">
				<td class="form_td_sub"><input type="button" name="btnback" value="<?=CPERMISSION_DEL_GROUP_FORM_BACK_BTN?>" onclick="location.href='<?=$href?><?=($_POST["p"] != "") ? '?p='.$_POST["p"] : ''?>'" class="input_button" /></td>
			</tr>
		<?php
		}
		?>
			<tr class="form_tr_separator_bottom">
				<td class="form_td_separator_bottom"></td>
			</tr>
		</table>
		<?php
	}

	/**
	* Muestra los campos seteados
	*
	* Este método muestra los valores de los campos seteados en el parámetro $fields.
	*
	* Ver también: {@link getdata()}, {@link add_form()}, {@link update_form()}, {@link show_data()}
	* @param string $fields [opcional] cadena con los campos (separados con comas) que se van a mostrar. Ej: "campo1,campo2,campo3, ... ,campoN"
	* @param boolean $htmlentities [opcional] indica si se convierten o no los caracteres a su entidad HTML sólo de los campos que son Extra: HTML
	* @param string $href [opcional] indica la página a la que se redirecciona cuando se hace clic en el botón volver de este método
	* @param string $title [opcional] título
	* @return mixed
	* @access public
	*/
	public function show_data($fields='', $htmlentities=TRUE, $href='', $title='')
	{
		if (!isset($_GET["p"]))
		{
			$_GET["p"] = "";
		}

		if (!validateRequiredValue($fields))
		{
			$fields = "id,name";
		}

		#fields control
		$array_fields = explode(",", $fields);
		$amount_fields = count($array_fields);
		for ($j = 0; $j < $amount_fields; $j++)
		{
			$array_fields[$j] = trim ($array_fields[$j]);
		}

		if ($htmlentities !== TRUE and $htmlentities !== FALSE)
		{
			$htmlentities = TRUE;
		}

		#title control
		if (!validateRequiredValue($title))
		{
			$title = '&nbsp;';
		}
		?>
		<table border="0" cellspacing="0" cellpadding="0" class="show_tbl">
			<tr class="show_tr_title">
				<td class="show_td_title" colspan="2"><?=$title?></td>
			</tr>
			<tr class="show_tr_separator_top">
				<td class="show_td_separator_top" colspan="2"></td>
			</tr>
		<?php
		foreach ($array_fields as $value)
		{
			if ($value == 'id')
			{
			?>
			<tr class="show_tr">
				<td class="show_td_l"><div class="text_field_show"><?=CPERMISSION_SHOW_DATA_LABEL_FIELD_ID?></div></td>
				<td class="show_td_r"><div class="text_show"><?=$this->getid()?></div></td>
			</tr>
			<?php
			}
			if ($value == 'name')
			{
			?>
			<tr class="show_tr">
				<td class="show_td_l"><div class="text_field_show"><?=CPERMISSION_SHOW_DATA_LABEL_FIELD_NAME?></div></td>
				<td class="show_td_r"><div class="text_show"><?=$this->getname()?></div></td>
			</tr>
			<?php
			}
		}
		if (validateRequiredValue($href))
		{
		?>
			<tr class="show_tr_sub">
				<td class="show_td_sub" colspan="2">
					<input type="button" name="btnback" value="<?=CPERMISSION_SHOW_DATA_BACK_BTN?>" onclick="location.href='<?=$href?><?=($_GET["p"] != "") ? '?p='.$_GET["p"] : ''?>'" class="input_button" />
				</td>
			</tr>
		<?php
		}
		?>
			<tr class="show_tr_separator_bottom">
				<td class="show_td_separator_bottom" colspan="2"></td>
			</tr>
		</table>
	<?php
	}

	/**
	* Muestra un formulario de búsqueda de registros de la tabla "permission"
	*
	* Este método muestra un formulario con los campos seteados en el parámetro $fields para realizar una búsqueda de los registros de la tabla "permission".
	*
	* Ver también: {@link getlist()}, {@link show_query()}
	* @param string $method [opcional] indica el método de envío del formulario de búsqueda: "get" o "post"
	* @param integer $columns [opcional] indica la cantidad de columnas en que se muestran los pares, campo-valor, en el formulario de búsqueda
	* @param string $fields [opcional] cadena con los campos (separados con comas) que se van a mostrar en el formulario de búsqueda. Ej: "campo1,campo2,campo3, ... ,campoN"
	* @param string $url_params [opcional] parámetros que vienen desde otras páginas
	* @param string $images [opcional] url donde se encuentran las imágenes que se pueden utilizar en este método, como por ejemplo la imagen que muestra el calendario
	* @param string $title [opcional] título
	* @param boolean $showhide_btn [opcional] indica si se muestra o no el botón para ocultar o mostrar el formulario de búsqueda
	* @return mixed
	* @access public
	*/
	public function search_form($method="get", $columns=1, $fields="", $url_params="", $images="", $title="", $showhide_btn=FALSE)
	{
		if ($method != "get" and $method != "post")
		{
			$method = "get";
		}
		settype ($columns, "integer");
		if ($columns == 0)
		{
			$columns = 1;
		}
		if (!validateRequiredValue($fields))
		{
			$fields = "id,name";
		}

		#fields control
		$array_fields = explode(",", $fields);
		$amount_fields = count($array_fields);
		for ($j = 0; $j < $amount_fields; $j++)
		{
			$array_fields[$j] = trim ($array_fields[$j]);
		}

		#title control
		if (!validateRequiredValue($title))
		{
			$title = '&nbsp;';
		}

		if (validateRequiredValue($url_params))
		{
			$url_params = base64_decode($url_params);
			$array_params = explode("&",$url_params);
			$amount_params = count($array_params);
			for ($j = 0; $j < $amount_params; $j++)
			{
				$array_param_value = explode("=",$array_params[$j]);
				if ($method == "post")
				{
					$_POST[$array_param_value[0]] = urldecode($array_param_value[1]);
				}
				else
				{
					$_GET[$array_param_value[0]] = urldecode($array_param_value[1]);
				}
			}
		}

		if ($method == "post")
		{
			$values = $_POST;
		}
		else
		{
			$values = $_GET;
		}

		for ($j = 0; $j < $amount_fields; $j++)
		{
			if (!isset($values[$array_fields[$j]]))
			{
				$values[$array_fields[$j]] = "";
			}
		}

		$i = 0;
		$aux = "";
		$auxp = "";

		$colspan = $columns * 2;
		$aux_cs = '';
		if ($showhide_btn === TRUE)
		{
			$aux_cs = 'colspan="2"';
		}
		?>
		<form name="form_search_permission" method="<?=$method?>" action="" class="form">
		<table border="0" cellspacing="0" cellpadding="0" class="search_tbl">
			<tr class="search_tr_title">
		<?php
		$display = '';
		if ($showhide_btn === TRUE)
		{
			if (!isset($_SESSION["main_tr_search_permission"]))
			{
				$_SESSION["main_tr_search_permission"] = '';
			}

			$display  = 'display: none;';
			$btnclass = 'btn_search_closed';
			if ($_SESSION["main_tr_search_permission"] === "open")
			{
				$display  = '';
				$btnclass = 'btn_search_open';
			}
			?>
				<td class="search_td_title_btn"><a href="javascript:showhide_search('permission')" id="btn_search_permission" class="<?=$btnclass?>"></a></td>
			<?php
		}
		?>
				<td class="search_td_title"><?=$title?></td>
			</tr>
			<tr class="search_tr_separator_top">
				<td class="search_td_separator_top" <?=$aux_cs?>></td>
			</tr>
		</table>
		<div id="container_search_permission" style="<?=$display?>">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search_tbl">
		<?php
		$condicion = "";
		$params = "";

		foreach ($array_fields as $value)
		{
			#id
			if ($value == 'id')
			{
				$this->setid($values["id"], TRUE);
				if ($i == 0)
				{
					?>
				<tr class="search_tr">
					<?php
				}
				$i++;
				?>
					<td class="search_td_l"><div class="text_field_search"><?=CPERMISSION_SEARCH_FORM_LABEL_FIELD_ID?></div></td>
					<td class="search_td_r"><input name="id" type="text" id="id" value="<?=$this->getid()?>" class="input_number_search" /></td>
				<?php
				if ($i == $columns)
				{
					?>
				</tr>
					<?php
					$i = 0;
				}
				if (validateRequiredValue($this->getid()))
				{
					$condicion.= $aux.set_field_sql("id", $this->table_name, "", $this->getDbConn())." = ".$this->getValueSql($this->id);
					$aux = " AND ";
					$params.= $auxp."id=".urlencode($this->id);
					$auxp = "&";
				}
			}

			#name
			if ($value == 'name')
			{
				$this->setname($values["name"], TRUE);
				if ($i == 0)
				{
					?>
				<tr class="search_tr">
					<?php
				}
				$i++;
				?>
					<td class="search_td_l"><div class="text_field_search"><?=CPERMISSION_SEARCH_FORM_LABEL_FIELD_NAME?></div></td>
					<td class="search_td_r"><input name="name" type="text" id="name" value="<?=$this->getname()?>" class="input_text_search" /></td>
				<?php
				if ($i == $columns)
				{
					?>
				</tr>
					<?php
					$i = 0;
				}
				if (validateRequiredValue($this->getname()))
				{
					$condicion.= $aux." LOWER(".set_field_sql("name", $this->table_name, "", $this->getDbConn()).") LIKE LOWER(".$this->getValueSql($this->name, "%%").")";
					$aux = " AND ";
					$params.= $auxp."name=".urlencode($this->name);
					$auxp = "&";
				}
			}

		}

		if ($i != 0)
		{
			for ($j = $i; $j < $columns; $j++)
			{
				?>
					<td class="search_td_l">&nbsp;</td>
					<td class="search_td_r">&nbsp;</td>
				<?php
			}
			?>
				</tr>
			<?php
		}
		?>
				<tr class="search_tr_sub">
					<td class="search_td_sub" colspan="<?=$colspan?>">
						<input type="submit" class="input_button_search" name="btnsubmit" value="<?=CPERMISSION_SEARCH_FORM_SUBMIT_BTN?>" />
					</td>
				</tr>
				<tr class="search_tr_separator_bottom">
					<td class="search_td_separator_bottom" colspan="<?=$colspan?>"></td>
				</tr>
			</table>
		</div>
		</form>
		<?php
		$this->condition = $condicion;
		$this->params = $params;
	}

	/**
	* Muestra el resultado de una consulta a la tabla "permission"
	*
	* Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla "permission". Muestra sólo los campos seteados en el parámetro $fields.
	*
	* El parámetro $fields es un array bidimensional con el siguiente formato:
	* <code>
	* <?php
	* $fields[0]["field"]  = "campo1";
	* $fields[0]["width"]  = "45%";
	* $fields[0]["strlen"] = "30";
	* $fields[1]["field"]  = "campo2";
	* $fields[1]["width"]  = "45%";
	* $fields[1]["strlen"] = "30";
	* ?>
	* </code>
	* - "field"  : nombre del campo a mostrar
	* - "width"  : ancho que tiene la columna de ese campo
	* - "strlen" : cantidad de caracteres que se van a mostrar de ese campo
	*
	* El parámetro $actions es un array bidimensional con el siguiente formato:
	* <code>
	* <?php
	* $actions[0]["file"]  = "update.php";
	* $actions[0]["image"] = "img/update.gif";
	* $actions[0]["text"]  = "Modificar";
	* $actions[0]["title"] = "Modificar Registro";
	* $actions[0]["js"]    = "";
	* $actions[0]["width"] = "5%";
	* $actions[1]["file"]  = "del.php";
	* $actions[1]["image"] = "img/delete.gif";
	* $actions[1]["text"]  = "Eliminar";
	* $actions[1]["title"] = "Eliminar Registro";
	* $actions[1]["js"]    = "onclick=\"return confirm('¿Eliminar el registro?')\""
	* $actions[1]["width"] = "5%";
	* ?>
	* </code>
	* - "file"  : nombre del archivo donde se realiza la acción
	* - "image" : url de la imagen del link de la acción
	* - "text"  : texto del link de la acción (si se define una imagen no se muestra)
	* - "title" : title o alt del link de la acción
	* - "js"    : javascript del link de la acción
	* - "width" : ancho que tiene la columna de la acción
	*
	* El parámetro $group_actions es un array bidimensional con el siguiente formato:
	* <code>
	* <?php
	* $group_actions[0]["file"]    = "del_group.php";
	* $group_actions[0]["image"]   = "img/delete.gif";
	* $group_actions[0]["text"]    = "Eliminar";
	* $group_actions[0]["title"]   = "Eliminar registros seleccionados";
	* $group_actions[0]["confirm"] = TRUE;
	* $group_actions[0]["msg"]     = "¿Eliminar los registros seleccionados?";
	* $group_actions[0]["button"]  = TRUE;
	* $group_actions[1]["file"]    = "show_group.php";
	* $group_actions[1]["image"]   = "img/show.gif";
	* $group_actions[1]["text"]    = "Ver";
	* $group_actions[1]["title"]   = "Ver registros seleccionados";
	* $group_actions[1]["confirm"] = FALSE;
	* $group_actions[1]["msg"]     = "";
	* $group_actions[1]["button"]  = TRUE;
	* ?>
	* </code>
	* - "file"    : nombre del archivo donde se realiza la acción
	* - "image"   : url de la imagen del link de la acción
	* - "text"    : texto del link de la acción (si se define una imagen no se muestra) o del botón de la acción
	* - "title"   : title o alt del link de la acción
	* - "confirm" : si se necesita una confirmación antes de realizar la acción
	* - "msg"     : mensaje que aparece en la confirmación
	* - "button"  : si se utiliza un botón en lugar de un link
	* Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST["permission_group"] (array)</b>
	*
	* Ver también: {@link getlist()}, {@link search_form()}
	* @param array $fields [opcional] contiene los campos que se van a mostrar
	* @param array $actions [opcional] contiene los archivos a los que se puede redireccionar con la clave primaria de cada registro para realizar una acción determinada
	* @param array $group_actions [opcional] contiene los archivos a los que se puede redireccionar con la clave primaria de cada registro seleccionado para realizar una acción determinada
	* @param string $width_ga [opcional] ancho de la columna con los checkbox para las acciones grupales
	* @param boolean $show_nav_top [opcional] indica si se muestra o no el navegador de arriba
	* @param boolean $show_nav_bottom [opcional] indica si se muestra o no el navegador de abajo
	* @param string $images_nav [opcional] url donde se almacenan las imágenes que se utilizan para el Cnavigator
	* @param boolean $show_nav_pages [opcional] indica si se muestran o no las páginas del navegador (Ej.: 1 2 3)
	* @param boolean $show_nav_info [opcional] indica si se muestra o no la información del navegador (Ej.: Resultados: 1 al 10 de 100)
	* @param string $title [opcional] título
	* @param integer $amount_pages [opcional] cantidad de páginas que muestra el navegador
	* @param integer $results_per_page [opcional] cantidad de resultados (filas) por página de la consulta
	* @return mixed
	* @access public
	*/
	public function show_query($fields="", $actions="", $group_actions="", $width_ga="", $show_nav_top=TRUE, $show_nav_bottom=TRUE, $images_nav="", $show_nav_pages=TRUE, $show_nav_info=TRUE, $title="", $amount_pages=0, $results_per_page=0)
	{
		if (!is_array($fields))
		{
			unset($fields);
			$fields[0]["field"] = "id";
			$fields[1]["field"] = "name";
		}

		#separo el array de cantidad de caracteres y ancho de columna
		foreach ($fields as $field)
		{
			$array_field[] = $field["field"];

			settype ($field["strlen"], "integer");
			$array_strlen[$field["field"]] = $field["strlen"];

			if (isset($field["width"]) === FALSE)
			{
				$field["width"] = "";
			}
			$array_width[$field["field"]] = $field["width"];
		}

		settype ($_GET["i"], "integer");

		#orderby
		if (isset($_GET["orderby"]) === FALSE)
		{
			$_GET["orderby"] = "";
		}
		else
		{
			if (in_array($_GET["orderby"], $array_field) === FALSE)
			{
				$_GET["orderby"] = "";
			}
		}
		if (isset($_GET["ascdesc"]) === FALSE)
		{
			$_GET["ascdesc"] = "";
		}
		else
		{
			if (in_array(strtoupper($_GET["ascdesc"]), array("ASC", "DESC")) === FALSE)
			{
				$_GET["ascdesc"] = "";
			}
		}
		if ($_GET["orderby"] != "" and $_GET["ascdesc"] != "")
		{
			$orderby = set_field_sql($_GET["orderby"], "", "", $this->getDbConn())." ".$_GET["ascdesc"];
		}
		else
		{
			$orderby = "";
		}

		#title control
		if (validateRequiredValue($title) === FALSE)
		{
			$title = '&nbsp;';
		}

		$i = 0;
		$head = '';

		#group actions
		if (is_array($group_actions) === TRUE)
		{
			$head.= '<td class="query_td_head_group_actions" width="'.$width_ga.'"><div class="text_query_head">&nbsp;</div></td>';
			$i++;
		}

		foreach ($array_field as $value)
		{
			#id
			if ($value == 'id')
			{
				if ($_GET["orderby"] == "id")
				{
					if ($_GET["ascdesc"] == "ASC")
					{
						$href = "?orderby=id&ascdesc=DESC";
					}
					else
					{
						$href = "?orderby=id&ascdesc=ASC";
					}
				}
				else
				{
					$href = "?orderby=id&ascdesc=ASC";
				}
				if ($this->getparams() != "")
				{
					$href.= "&".$this->getparams();
				}

				$head.= '<td class="query_td_head_num" width="'.$array_width["id"].'"><div class="text_query_head"><a href="'.$href.'" class="text_query_head">'.alt_text(getcut_string(CPERMISSION_SHOW_QUERY_HEAD_FIELD_ID, $array_strlen["id"]), CPERMISSION_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></td>';
				$i++;
			}

			#name
			if ($value == 'name')
			{
				if ($_GET["orderby"] == "name")
				{
					if ($_GET["ascdesc"] == "ASC")
					{
						$href = "?orderby=name&ascdesc=DESC";
					}
					else
					{
						$href = "?orderby=name&ascdesc=ASC";
					}
				}
				else
				{
					$href = "?orderby=name&ascdesc=ASC";
				}
				if ($this->getparams() != "")
				{
					$href.= "&".$this->getparams();
				}

				$head.= '<td class="query_td_head_str" width="'.$array_width["name"].'"><div class="text_query_head"><a href="'.$href.'" class="text_query_head">'.alt_text(getcut_string(CPERMISSION_SHOW_QUERY_HEAD_FIELD_NAME, $array_strlen["name"]), CPERMISSION_SHOW_QUERY_HEAD_FIELD_NAME).'</a></div></td>';
				$i++;
			}

		}

		#actions
		if (is_array($actions) === TRUE)
		{
			$actions_colspan = count($actions);
			$head.= '<td class="query_td_head_actions" colspan="'.$actions_colspan.'"><div class="text_query_head">&nbsp;</div></td>';
			$i = $i + $actions_colspan;
		}

		settype ($amount_pages, 'integer');
		settype ($results_per_page, 'integer');

		#Cnavigator
		$nav = new Cnavigator();
		$nav->setpage('');
		$nav->setamount_pages($amount_pages);
		$nav->setresults_per_page($results_per_page);
		$nav->setcss_text('nav_text');
		$nav->setcss_link('nav_link');
		$nav->setcss_info('nav_info');
		$nav->setcss_img('nav_img');
		$nav->setindex($_GET['i']);
		if ($images_nav != '')
		{
			$nav->seturl_to_images($images_nav);
		}

		#obtengo el listado
		$list = $this->getlist($this->getcondition(), $nav->getresults_per_page(), $_GET['i'], $orderby);

		$nav->settotal_results($this->gettotal_list());

		#parámetros
		$params = $this->getparams();
		if ($_GET["orderby"] != "" and $_GET["ascdesc"] != "")
		{
			if ($this->getparams() != "")
			{
				$params.= "&";
			}
			$params.= "orderby=".$_GET["orderby"]."&ascdesc=".$_GET["ascdesc"];
		}
		$nav->setparameters($params);

		#parámetros para las acciones individuales y grupales
		$actions_params = '';
		if ($_GET["i"])
		{
			$actions_params = 'i='.$_GET["i"];
		}
		if ($params != '')
		{
			if ($actions_params != '')
			{
				$actions_params.= '&';
			}
			$actions_params.= $params;
		}
		if ($actions_params != '')
		{
			$actions_params = base64_encode($actions_params);
		}
		?>
		<form name="form_query_permission" id="form_query_permission" method="post" action="" class="form">
		<input type="hidden" name="p" id="p" value="" />
		<table border="0" cellspacing="0" cellpadding="0" class="query_tbl">
			<tr class="query_tr_title">
				<td class="query_td_title" colspan="<?=$i?>"><?=$title?></td>
			</tr>
			<tr class="query_tr_separator_top">
				<td class="query_td_separator_top" colspan="<?=$i?>"></td>
			</tr>
		<?php
		if ($show_nav_top === TRUE)
		{
		?>
			<tr class="query_tr_nav">
				<td class="query_td_nav" colspan="<?=$i?>">
					<div class="query_td_nav_pages">
					<?php
					if ($this->gettotal_list() > $nav->getresults_per_page())
					{
						$nav->show_navigator($show_nav_pages);
					}
					?>
					</div>
					<div class="query_td_nav_info">
					<?php
					if ($show_nav_info === TRUE)
					{
						$nav->show_navigator_info();
					}
					?>
					</div>
				</td>
			</tr>
		<?php
		}
		?>
			<tr class="query_tr_head">
				<?=$head?>
			</tr>
		<?php
		if ($this->gettotal_list() < 1)
		{
			?>
			<tr class="query_tr_no">
				<td class="query_td_no" colspan="<?=$i?>"><div class="text"><?=CPERMISSION_SHOW_QUERY_NOT_FOUND?></div></td>
			</tr>
			<?php
		}
		else
		{
			$class = "1";
			foreach ($list as $row)
			{
				#group actions
				if (is_array($group_actions) === TRUE)
				{
					$click_check = 'true';
				}
				else
				{
					$click_check = 'false';
				}
			?>
			<tr class="query_tr_<?=$class?>" id="permission_tr_<?=$row["id"]?>" onmouseover="tr_over(this, '<?=$class?>')" onmouseout="tr_out(this, '<?=$class?>')" onclick="tr_click(this, '<?=$class?>', <?=$click_check?>, '<?=$row["id"]?>', 'permission')">
			<?php
				#group actions
				if (is_array($group_actions) === TRUE)
				{
				?>
				<td class="query_td_<?=$class?>_group_actions"><input name="permission_group[]" type="checkbox" id="cb_permission_<?=$row["id"]?>" value="<?=$row["id"]?>" class="checkbox_show_query" onclick="checkbox_click(this)" /></td>
				<?php
				}

				foreach ($array_field as $value)
				{
					#id
					if ($value == "id")
					{
					?>
				<td class="query_td_<?=$class?>_num"><div class="text_query"><?=alt_text(getcut_string($row["id"], $array_strlen["id"]), $row["id"])?></div></td>
					<?php
					}

					#name
					if ($value == "name")
					{
					?>
				<td class="query_td_<?=$class?>_str"><div class="text_query"><?=alt_text(getcut_string($row["name"], $array_strlen["name"]), $row["name"])?></div></td>
					<?php
					}

				}

				#actions
				if (is_array($actions) === TRUE)
				{
					$aux_actions_params = '';
					if ($actions_params != '')
					{
						$aux_actions_params = '&p='.$actions_params;
					}
					foreach ($actions as $value)
					{
						if ($value["image"] == "")
						{
							echo '<td class="query_td_'.$class.'_actions" width="'.$value["width"].'"><a href="'.$value["file"].'?id='.$row["id"].''.$aux_actions_params.'" class="query_actions" title="'.$value["title"].'" '.$value["js"].'>'.$value["text"].'</a></td>';
						}
						else
						{
							echo '<td class="query_td_'.$class.'_actions" width="'.$value["width"].'"><a href="'.$value["file"].'?id='.$row["id"].''.$aux_actions_params.'" class="query_actions" title="'.$value["title"].'" '.$value["js"].'><img src="'.$value["image"].'" border="0" alt="'.$value["title"].'" /></a></td>';
						}
					}
				}
				?>
			</tr>
				<?php
				if ($class == "1")
				{
					$class = "2";
				}
				else
				{
					$class = "1";
				}
			}

			if (is_array($group_actions) === TRUE)
			{
			?>
			<tr class="query_tr_group_actions">
				<td class="query_td_group_actions">
					<input name="permission_select_all" type="checkbox" id="permission_select_all" value="" class="checkbox_show_query" onclick="query_select_all('permission')" />
				</td>
				<td class="query_td_cs_group_actions" colspan="<?=($i - 1)?>">
					<div class="text_query_group_actions">
						<?=CPERMISSION_SHOW_QUERY_SELECT_ALL?>
						<?php
						$j = 1;
						foreach ($group_actions as $value)
						{
							if ($value["confirm"] === TRUE)
							{
								$onclick = 'onclick="form_query_submit(\'form_query_permission\', \''.$value["file"].'\', \''.$actions_params.'\', true, \''.$value["msg"].'\');"';
							}
							else
							{
								$onclick = 'onclick="form_query_submit(\'form_query_permission\', \''.$value["file"].'\', \''.$actions_params.'\', false, \'\');"';
							}

							if ($value["button"] === TRUE)
							{
								echo '<input type="button" name="permission_ga_'.$j.'" id="permission_ga_'.$j.'" value="'.$value["text"].'" class="input_button_query" '.$onclick.' />';
							}
							else
							{
								if ($value["image"] == "")
								{
									echo '<a href="#" class="query_group_actions" title="'.$value["title"].'" '.$onclick.'>'.$value["text"].'</a>';
								}
								else
								{
									echo '<a href="#" class="query_group_actions" title="'.$value["title"].'" '.$onclick.'><img src="'.$value["image"].'" border="0" alt="'.$value["title"].'" /></a>';
								}
							}
							$j++;
						}
						?>
					</div>
				</td>
			</tr>
			<?php
			}
		}
		if ($show_nav_bottom === TRUE)
		{
		?>
			<tr class="query_tr_nav">
				<td class="query_td_nav" colspan="<?=$i?>">
					<div class="query_td_nav_pages">
					<?php
					if ($this->gettotal_list() > $nav->getresults_per_page())
					{
						$nav->show_navigator($show_nav_pages);
					}
					?>
					</div>
					<div class="query_td_nav_info">
					<?php
					if ($show_nav_info === TRUE)
					{
						$nav->show_navigator_info();
					}
					?>
					</div>
				</td>
			</tr>
		<?php
		}
		?>
			<tr class="query_tr_separator_bottom">
				<td class="query_td_separator_bottom" colspan="<?=$i?>"></td>
			</tr>
		</table>
		</form>
		<?php
	}

	/**
	* Devuelve el último valor "Id" insertado en la tabla "permission"
	*
	* @return integer|boolean
	* @access public
	*/
	public function get_last_id()
	{
		$sql = "SELECT MAX(".set_field_sql("id", "", "", $this->getDbConn()).") AS ".set_field_sql("last_id", "", "", $this->getDbConn())." FROM ".$this->getTableSql();
		$rs  = $this->getDbConn()->GetRow($sql);
		if ($rs === FALSE)
		{
			$this->errors[] = CPERMISSION_GET_LAST_ID_ERROR;
			return FALSE;
		}
		else
		{
			return $rs["last_id"];
		}
	}

}
?>