<?php
/**
* Archivo php creado por O-creator
*
* @package EVOIT
* @author {@link http://www.evoit.com/ EVO I.T.}
* @copyright {@link http://www.evoit.com/ EVO I.T.}
*/

/**
* Administración de la tabla "groupxpermission"
*
* Esta clase se encarga de la administración de la tabla "groupxpermission" brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
*
* Ejemplo:
* <code>
* <?php
* include_once('Cgroupxpermission.php');
* $groupxpermission = new Cgroupxpermission();
* $groupxpermission->setdb_connection($db_connection);
* ?>
* </code>
*
* @package EVOIT
* @author {@link http://www.evoit.com/ EVO I.T.}
* @version v3:12-07-2011
* @copyright {@link http://www.evoit.com/ EVO I.T.}
*/
class Cgroupxpermission extends Cbase
{
	/**
	* Id grupo
	*
	* - Clave Primaria
	* - Clave Foránea
	* - Tipo MySql: bigint(20)
	* - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	*
	* <b>Este campo es clave foránea a:</b>
	* - Tabla: {@link Cgroup "group"}
	* - Campo: {@link Cgroup::$id id}
	* - Relación de detalle: Tabla detalle, campo ID de la tabla principal
	*
	* Ver también: {@link getid_group()}, {@link setid_group()}
	* @var integer
	* @access private
	*/
	private $id_group;

	/**
	* Id permiso
	*
	* - Clave Primaria
	* - Clave Foránea
	* - Tipo MySql: bigint(20)
	* - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	*
	* <b>Este campo es clave foránea a:</b>
	* - Tabla: {@link Cpermission "permission"}
	* - Campo: {@link Cpermission::$id id}
	* - Campo que se muestra: {@link Cpermission::$name name}
	* - Relación de detalle: Tabla detalle, campo ID de la tabla ítem
	*
	* Ver también: {@link getid_permission()}, {@link setid_permission()}
	* @var integer
	* @access private
	*/
	private $id_permission;

	/**
	* Constructor de la clase
	*
	* En el constructor se setea por defecto el {@link $charset charset} de la clase.
	* Toma el valor de la constante CHARSET definida en el archivo de configuración del script.
	* Si no se le pasa como parámetro un conexión a la base de datos, intenta tomar una global ($GLOBALS['db_connection'])
	*
	* @param object (ADODB PHP) $db_connection  [opcional] Conección a la base de datos
	* @return void
	*/
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('groupxpermission');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cgroupxpermission.php');
	}

	/**
	* Destructor de la clase
	*/
	function __destruct()
	{

	}

	/**
	* Devuelve el valor "Id grupo"
	*
	* - Campo MySql: {@link $id_group id_group}
	*
	* @param boolean $htmlentities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	* @return integer
	* @access public
	*/
	public function getid_group($htmlentities=TRUE)
	{
		return getValue($this->id_group, $htmlentities, $this->charset);
	}

	/**
	* Devuelve el valor "Id permiso"
	*
	* - Campo MySql: {@link $id_permission id_permission}
	*
	* @param boolean $htmlentities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	* @return integer
	* @access public
	*/
	public function getid_permission($htmlentities=TRUE)
	{
		return getValue($this->id_permission, $htmlentities, $this->charset);
	}

	/**
	* Setea el valor "Id grupo"
	*
	* - Campo MySql: {@link $id_group id_group}
	*
	* @param integer $id_group indica el valor "Id grupo"
	* @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	* @return boolean
	* @access public
	*/
	public function setid_group($id_group, $gpc=FALSE)
	{
		if (!validateRequiredValue($id_group))
		{
			$this->id_group = $id_group;
			$this->errors[] = CGROUPXPERMISSION_SETID_GROUP_REQUIRED_VALUE;
			return FALSE;
		}
		else
		{
			$this->id_group = setValue($id_group, $gpc);

			if (validateIntValue($this->id_group, '+'))
			{
				return TRUE;
			}
			else
			{
				$this->errors[] = CGROUPXPERMISSION_SETID_GROUP_VALIDATE_VALUE;
				return FALSE;
			}
		}
	}

	/**
	* Setea el valor "Id permiso"
	*
	* - Campo MySql: {@link $id_permission id_permission}
	*
	* @param integer $id_permission indica el valor "Id permiso"
	* @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	* @return boolean
	* @access public
	*/
	public function setid_permission($id_permission, $gpc=FALSE)
	{
		if (!validateRequiredValue($id_permission))
		{
			$this->id_permission = $id_permission;
			$this->errors[] = CGROUPXPERMISSION_SETID_PERMISSION_REQUIRED_VALUE;
			return FALSE;
		}
		else
		{
			$this->id_permission = setValue($id_permission, $gpc);

			if (validateIntValue($this->id_permission, '+'))
			{
				return TRUE;
			}
			else
			{
				$this->errors[] = CGROUPXPERMISSION_SETID_PERMISSION_VALIDATE_VALUE;
				return FALSE;
			}
		}
	}

	/**
	* Inserta un nuevo registro en la tabla "groupxpermission"
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
		if (isset($this->id_group))
		{
			//Le pongo 0 a los integers/bigint en vez de ''
			if (validateRequiredValue($this->id_group) === FALSE)
			{
				$this->id_group = 0;
			}
			$fields.= $aux.$this->getFieldSql("id_group");
			$values.= $aux.$this->getValueSql($this->id_group);
			$aux = " , ";
		}
		if (isset($this->id_permission))
		{
			$fields.= $aux.$this->getFieldSql("id_permission");
			if(validateRequiredValue($this->id_permission) === FALSE)
			{
				//Le pongo NULL a las FK en vez de ''
				$values.= $aux.'NULL';
			}
			else
			{
				$values.= $aux.$this->getValueSql($this->id_permission);
			}
			$aux = " , ";
		}
		$sql = "INSERT INTO ".$this->getTableSql()." (".$fields.") VALUES (".$values.")";
		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->errors[] = CGROUPXPERMISSION_ADD_ERROR;
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	* Actualiza un registro de la tabla "groupxpermission"
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
		if (validateRequiredValue($this->id_group) and validateRequiredValue($this->id_permission))
		{
			$values = "";
			$aux = "";
			$sql = "UPDATE ".$this->getTableSql()." SET ".$values." WHERE ".$this->getFieldSql("id_group")." = ".$this->getValueSql($this->id_group)." AND ".$this->getFieldSql("id_permission")." = ".$this->getValueSql($this->id_permission);
			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->errors[] = CGROUPXPERMISSION_UPDATE_ERROR;
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->errors[] = CGROUPXPERMISSION_UPDATE_REQUIRED_PK;
			return FALSE;
		}
	}

	/**
	* Elimina un registro de la tabla "groupxpermission"
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
		if (validateRequiredValue($this->id_group) and validateRequiredValue($this->id_permission))
		{
			$sql = "DELETE FROM ".$this->getTableSql()." WHERE ".$this->getFieldSql("id_group")." = ".$this->getValueSql($this->id_group)." AND ".$this->getFieldSql("id_permission")." = ".$this->getValueSql($this->id_permission);
			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->errors[] = CGROUPXPERMISSION_DEL_ERROR;
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->errors[] = CGROUPXPERMISSION_DEL_REQUIRED_PK;
			return FALSE;
		}
	}

	/**
	* Obtiene un registro de la tabla "groupxpermission"
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
		if (validateRequiredValue($this->id_group) === TRUE and validateRequiredValue($this->id_permission) === TRUE)
		{
			$sql = "SELECT * FROM ".$this->getTableSql()." WHERE ".$this->getFieldSql("id_group")." = ".$this->getValueSql($this->id_group)." AND ".$this->getFieldSql("id_permission")." = ".$this->getValueSql($this->id_permission);
			$rs = $this->getDbConn()->GetRow($sql);

			if ($rs !== FALSE and count($rs) > 0)
			{
				$this->setid_group($rs["id_group"]);
				$this->setid_permission($rs["id_permission"]);
				return TRUE;
			}
			else
			{
				$this->errors[] = CGROUPXPERMISSION_GETDATA_ERROR;
				return FALSE;
			}
		}
		else
		{
			$this->errors[] = CGROUPXPERMISSION_GETDATA_REQUIRED_PK;
			return FALSE;
		}
	}

	/**
	* Obtiene un conjunto de registros de la tabla "groupxpermission"
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
			$this->errors[] = CGROUPXPERMISSION_GETLIST_TOTAL_LIST_ERROR;
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
			$this->errors[] = CGROUPXPERMISSION_GETLIST_ERROR;
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
				$this->setid_group($rs->fields["id_group"]);
				$this->setid_permission($rs->fields["id_permission"]);

				$list[] = array("id_group" => $this->getid_group($htmlentities) , "id_permission" => $this->getid_permission($htmlentities));

				$rs->MoveNext();
			}
			$this->id_group = NULL;
			$this->id_permission = NULL;

			return $list;
		}
	}

	/**
	* Verifica si ya existe en la tabla "groupxpermission" la clave primaria (compuesta) seteada
	*
	* Este método controla si ya existe en la tabla "groupxpermission" la clave primaria (compuesta) seteada.
	* Si no está seteado el valor de al menos uno de los campos que forman la clave compuesta el método devuelve FALSE.
	*
	* @return boolean
	* @access public
	*/
	public function exist_primary_key()
	{
		if (validateRequiredValue($this->id_group) === TRUE and validateRequiredValue($this->id_permission) === TRUE)
		{
			$sql = "SELECT * FROM ".$this->getTableSql()." WHERE ".$this->getFieldSql("id_group")." = ".$this->getValueSql($this->id_group)." AND ".$this->getFieldSql("id_permission")." = ".$this->getValueSql($this->id_permission);
			$rs = $this->getDbConn()->GetRow($sql);
			if ($rs !== FALSE)
			{
				if (count($rs) > 0)
				{
					$this->errors[] = CGROUPXPERMISSION_EXIST_PK_EXIST;
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				$this->errors[] = CGROUPXPERMISSION_EXIST_PK_ERROR;
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	/**
	* Agrega los elementos de formulario necesarios para agregar los items de la relación de detalle con la tabla {@link Cgroup "group"}
	*
	* Este método muestra los campos del formulario de la tabla "groupxpermission" seteados en el parámetro $fields que se utilizan
	* dentro de los métodos add_form y update_form de la tabla {@link Cgroup "group"}.
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
	* El parámetro $delete es un array asociativo con el siguiente formato:
	* <code>
	* <?php
	* $delete['image'] = 'img/del_item.gif';
	* $delete['title'] = 'Eliminar';
	* $delete['width'] = '5%';
	* ?>
	* </code>
	* - 'image' : url de la imagen que se muestra en el link de la acción
	* - 'title' : title o alt del link de la acción
	* - 'width' : ancho que tiene la columna de la acción (en la tabla que muestra el detalle)
	*
	* Ver también: {@link add_detail()}, {@link update_detail()}, {@link print_hidden_fields()}, {@link load_detail()}
	* @param string $file_control url del archivo que realiza las validaciones correspondientes
	* @param array $fields [opcional] contiene los campos que se van a mostrar
	* @param integer $columns [opcional] indica la cantidad de columnas en que se muestran los pares, campo-valor, en el formulario
	* @param array $delete [opcional] contiene la configuración de la acción eliminar ítem
	* @param string $images [opcional] url donde se encuentran las imágenes que se pueden utilizar en este método, como por ejemplo la imagen que muestra el calendario
	* @param string $title [opcional] título
	* @return mixed
	* @access public
	*/
	public function form_detail($file_control, $fields='', $columns=1, $delete='', $images='', $title='Detalle')
	{
		if (!is_array($fields))
		{
			unset($fields);
			$fields[0]['field'] = 'id_permission';
		}

		#fields control
		$amount_fields = count($fields);
		$flag_id_permission = FALSE;
		for ($i = 0; $i < $amount_fields; $i++)
		{
			$fields[$i]['field'] = trim($fields[$i]['field']);
			if ($fields[$i]['field'] == 'id_permission')
			{
				$flag_id_permission = TRUE;
			}
		}
		if ($flag_id_permission === FALSE)
		{
			$fields[]['field'] = 'id_permission';
		}

		#separo el array de cantidad de caracteres y ancho de columna
		foreach ($fields as $field)
		{
			$array_fields[] = $field['field'];

			settype ($field['strlen'], 'integer');
			$array_strlen[$field['field']] = $field['strlen'];

			if (!isset($field['width']))
			{
				$field['width'] = '';
			}
			$array_width[$field['field']] = $field['width'];
		}

		#title control
		if (!validateRequiredValue($title))
		{
			$title = '&nbsp;';
		}

		settype ($columns, 'integer');
		if ($columns == 0)
		{
			$columns = 1;
		}

		$r = 0;
		$cs = $columns * 2;

		#delete action control
		if (!isset($delete['image']))
		{
			$delete['image'] = 'del_item.gif';
		}
		if (!isset($delete['title']))
		{
			$delete['title'] = CGROUPXPERMISSION_FORM_DETAIL_DELETE_ACTION_DEFAULT_TITLE;
		}
		if (!isset($delete['width']))
		{
			$delete['width'] = '';
		}
		?>
		<table border="0" cellspacing="0" cellpadding="0" class="detail_tbl">
			<tr class="detail_tr_title">
				<td class="detail_td_title" colspan="<?=$cs?>"><?=$title?></td>
			</tr>
			<tr class="detail_tr_separator_top">
				<td class="detail_td_separator_top" colspan="<?=$cs?>"></td>
			</tr>
		<?php
		$aux = '';
		$js_fields = '';
		$type_fields = '';
		$strlen_fields = '';

		$o_permission = new Cpermission();
		$o_permission->setDbConn($this->getDbConn());

		foreach ($array_fields as $value)
		{
			#id_permission
			if ($value == 'id_permission')
			{
				if ($r == 0)
				{
					?>
			<tr class="detail_tr">
					<?php
				}
				$r++;
				?>
				<td class="detail_td_l"><div class="text_field_detail"><?=CGROUPXPERMISSION_FORM_DETAIL_LABEL_FIELD_ID_PERMISSION?> <span class="symbol_required">*</span></div></td>
				<?php
				$list_permission = $o_permission->getlist('', 0, 0, 'name');
				$cant = count($list_permission);
				?>
				<td class="detail_td_r">
					<select name="groupxpermission_id_permission" id="groupxpermission_id_permission" class="select_detail">
				<?php
				for ($i = 0; $i < $cant; $i++)
				{
				?>
						<option value="<?=$list_permission[$i]['id']?>"><?=$list_permission[$i]['name']?></option>
				<?php
				}
				?>
					</select>
				</td>
				<?php
				if ($r == $columns)
				{
					?>
			</tr>
					<?php
					$r = 0;
				}

				$js_fields.= $aux.'\'id_permission\'';
				$type_fields.= $aux.'\'str\'';
				$strlen_fields.= $aux.'\''.$array_strlen['id_permission'].'\'';
				$aux = ',';
			}

		}

		if ($r != 0)
		{
			for ($s = $r; $s < $columns; $s++)
			{
				?>
				<td class="detail_td_l">&nbsp;</td>
				<td class="detail_td_r">&nbsp;</td>
				<?php
			}
			?>
			</tr>
			<?php
		}
		?>
			<tr class="detail_tr_sub">
				<td class="detail_td_sub" colspan="<?=$cs?>">
					<input type="button" name="add_button" id="groupxpermission_add_button" value="<?=CGROUPXPERMISSION_FORM_DETAIL_ADD_BTN?>" onclick="add_item('<?=$file_control?>', 'groupxpermission', 'id_permission', new Array(<?=$js_fields?>), new Array(<?=$type_fields?>), new Array(<?=$strlen_fields?>), '<?=$delete['image']?>', '<?=$delete['title']?>')" class="input_button_detail" />
				</td>
			</tr>
			<tr class="detail_tr_error">
				<td class="detail_td_error" colspan="<?=$cs?>"><div id="td_error_groupxpermission" class="text_error_detail"></div></td>
			</tr>
			<tr class="detail_tr_cs">
				<td class="detail_td_cs" colspan="<?=$cs?>">
					<table id="tbl_items_groupxpermission" border="0" cellpadding="0" cellspacing="0" class="items_tbl">
						<tr class="items_tr_head">
		<?php
		foreach ($array_fields as $value)
		{
			#id_permission
			if ($value == 'id_permission')
			{
				if (!isset($_POST['values_id_permission']))
				{
					$_POST['values_id_permission'] = '';
				}
				?>
							<td class="items_td_head_str" width="<?=$array_width['id_permission']?>"><div class="text_items_head"><?=alt_text(getcut_string(CGROUPXPERMISSION_FORM_DETAIL_HEAD_FIELD_ID_PERMISSION, $array_strlen['id_permission']), CGROUPXPERMISSION_FORM_DETAIL_HEAD_FIELD_ID_PERMISSION)?></div></td>
				<?php
			}

		}
		?>
							<td class="items_td_head_actions" width="<?=$delete['width']?>"><div class="text_items_head">&nbsp;</div></td>
						</tr>
		<?php
		if (is_array($_POST['values_id_permission']))
		{
			$amount_items = count($_POST['values_id_permission']);
			for ($i = 0; $i < $amount_items; $i++)
			{
				?>
						<tr class="items_tr">
				<?php
				foreach ($array_fields as $value)
				{
					#id_permission
					if ($value == 'id_permission')
					{
						$this->setid_permission($_POST['values_id_permission'][$i], TRUE);
						$hidden = '<input name="values_id_permission[]" type="hidden" value="'.$this->getid_permission().'" />';

						$o_permission->setid($_POST['values_id_permission'][$i], TRUE);
						$o_permission->getdata();
						if ($o_permission->getname() == '')
						{
							$td_value = '&nbsp;';
						}
						else
						{
							$td_value = alt_text(getcut_string($o_permission->getname(), $array_strlen['id_permission']), $o_permission->getname());
						}
						?>
							<td class="items_td_str"><?=$hidden?><div class="text_items"><?=$td_value?></div></td>
						<?php
					}

				}
				?>
							<td class="items_td_actions"><a href="#" onclick="del_item('groupxpermission', 'id_permission', '<?=$o_permission->getid()?>', this); return false;"><img src="<?=$delete['image']?>" border="0" title="<?=$delete['title']?>" /></a></td>
						</tr>
				<?php
			}
		}
		?>
					</table>
		<?php
		if (!isset($_POST['values_id_permission_groupxpermission']))
		{
			$_POST['values_id_permission_groupxpermission'] = '';
		}
		?>
					<input name="values_id_permission_groupxpermission" id="values_id_permission_groupxpermission" type="hidden" value="<?=$_POST['values_id_permission_groupxpermission']?>" />
				</td>
			</tr>
			<tr class="detail_tr_separator_bottom">
				<td class="detail_td_separator_bottom" colspan="<?=$cs?>"></td>
			</tr>
		</table>
		<?php
	}

	/**
	* Controla que se haya cargado al menos un ítem en el detalle
	*
	* @return boolean
	* @access public
	*/
	public function validate_detail()
	{
		if (!isset($_POST['values_id_permission']))
		{
			$_POST['values_id_permission'] = '';
		}
		if (!is_array($_POST['values_id_permission']))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	* Inserta los registros en la tabla "groupxpermission"
	*
	* Este método inserta en la tabla "groupxpermission" los items de la relación de detalle con la tabla {@link Cgroup "group"}.
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
	* Ver también: {@link form_detail()}
	* @param integer $id_group id del nuevo registro insertado en la tabla {@link Cgroup "group"}
	* @param array $fields [opcional] contiene los campos que se mostraron en el formulario
	* @access public
	*/
	public function add_detail($id_group, $fields='')
	{
		if (is_array($fields) === FALSE)
		{
			unset($fields);
			$fields[0]['field'] = 'id_permission';
		}

		#fields control
		$amount_fields = count($fields);
		$flag_id_permission = FALSE;
		$aux_fields = array();
		for ($i = 0; $i < $amount_fields; $i++)
		{
			$fields[$i]['field'] = trim($fields[$i]['field']);
			if ($fields[$i]['field'] == 'id_permission')
			{
				$flag_id_permission = TRUE;
			}
			$aux_fields[] = $fields[$i]['field'];
		}
		if ($flag_id_permission === FALSE)
		{
			$aux_fields[] = 'id_permission';
		}

		if (isset($_POST['values_id_permission']) === TRUE and is_array($_POST['values_id_permission']) === TRUE)
		{
			$this->setid_group($id_group);

			foreach ($_POST['values_id_permission'] as $key => $value)
			{
				#id_permission
				if (in_array('id_permission', $aux_fields))
				{
					$this->setid_permission($value, TRUE);
				}

				$this->add();
			}
		}
	}

	/**
	* Actualiza los registros en la tabla "groupxpermission"
	*
	* Este método actualiza en la tabla "groupxpermission" los items de la relación de detalle con la tabla {@link Cgroup "group"}.
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
	* Ver también: {@link form_detail()}
	* @param integer $id_group id del registro modificado en la tabla {@link Cgroup "group"}
	* @param array $fields [opcional] contiene los campos que se mostraron en el formulario
	* @access public
	*/
	public function update_detail($id_group, $fields='')
	{
		if (!is_array($fields))
		{
			unset($fields);
			$fields[0]['field'] = 'id_permission';
		}

		#fields control
		$amount_fields = count($fields);
		$flag_id_permission = FALSE;
		$aux_fields = array();
		for ($i = 0; $i < $amount_fields; $i++)
		{
			$fields[$i]['field'] = trim($fields[$i]['field']);
			if ($fields[$i]['field'] == 'id_permission')
			{
				$flag_id_permission = TRUE;
			}
			$aux_fields[] = $fields[$i]['field'];
		}
		if ($flag_id_permission === FALSE)
		{
			$aux_fields[] = 'id_permission';
		}

		$this->setid_group($id_group);

		$rs_detail = $this->getlist($this->getFieldSql('id_group')." = ". $this->getValueSql($this->id_group), 0, 0, '', FALSE);

		$this->setid_group($id_group);

		$id_permission_array = array();

		if ($this->gettotal_list() > 0)
		{
			foreach ($rs_detail as $row)
			{
				if (!in_array($row['id_permission'], $_POST['values_id_permission']))
				{
					$this->setid_permission($row['id_permission']);
					$this->del();
				}
				else
				{
					$id_permission_array[] = $row['id_permission'];
				}
			}
		}

		if (is_array($_POST['values_id_permission']) === TRUE)
		{
			foreach ($_POST['values_id_permission'] as $key => $value)
			{
				if (in_array($value, $id_permission_array) === FALSE)
				{
					#id_permission
					if (in_array('id_permission', $aux_fields))
					{
						$this->setid_permission($value, TRUE);
					}

					$this->add();
				}
			}
		}
	}

	/**
	* Elimina los registros en la tabla "groupxpermission"
	*
	* Este método elimina en la tabla "groupxpermission" los items de la relación de detalle con la tabla {@link Cgroup "group"}.
	*
	* @param integer $id_group id del registro eliminado en la tabla {@link Cgroup "group"}
	* @return boolean
	* @access public
	*/
	public function del_detail($id_group)
	{
		if ($this->setid_group($id_group))
		{
			$sql = "DELETE FROM ".$this->getTableSql()." WHERE ".$this->getFieldSql('id_group')." = ".$this->getValueSql($this->id_group);
			if ($this->db_connection->Execute($sql) === FALSE)
			{
				return TRUE;
			}
			else
			{
				$this->errors[] = CGROUPXPERMISSION_DEL_DETAIL_ERROR;
				return FALSE;
			}
		}
	}

	/**
	* Muestra los items de la relación de detalle con la tabla {@link Cgroup "group"}
	*
	* Este método muestra los valores de los campos de la tabla "groupxpermission" seteados en el parámetro $fields que se utilizan dentro del método
	* show_data de la tabla {@link Cgroup "group"}.
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
	* @param integer $id_group id del registro de la tabla {@link Cgroup "group"}
	* @param array $fields [opcional] contiene los campos que se van a mostrar
	* @param string $title [opcional] título
	* @return mixed
	* @access public
	*/
	public function show_detail($id_group, $fields='', $title='Detalle')
	{
		if (!is_array($fields))
		{
			unset($fields);
			$fields[0]['field'] = 'id_permission';
		}

		#fields control
		$amount_fields = count($fields);
		$flag_id_permission = FALSE;
		for ($i = 0; $i < $amount_fields; $i++)
		{
			$fields[$i]['field'] = trim($fields[$i]['field']);
			if ($fields[$i]['field'] == 'id_permission')
			{
				$flag_id_permission = TRUE;
			}
		}
		if ($flag_id_permission === FALSE)
		{
			$fields[]['field'] = 'id_permission';
		}

		#separo el array de cantidad de caracteres y ancho de columna
		foreach ($fields as $field)
		{
			$array_fields[] = $field['field'];

			settype ($field['strlen'], 'integer');
			$array_strlen[$field['field']] = $field['strlen'];

			if (!isset($field['width']))
			{
				$field['width'] = '';
			}
			$array_width[$field['field']] = $field['width'];
		}

		#title control
		if (!validateRequiredValue($title))
		{
			$title = '&nbsp;';
		}
		?>
		<table border="0" cellspacing="0" cellpadding="0" class="show_detail_tbl">
			<tr class="show_detail_tr_title">
				<td class="show_detail_td_title"><?=$title?></td>
			</tr>
			<tr class="show_detail_tr_separator_top">
				<td class="show_detail_td_separator_top"></td>
			</tr>
			<tr class="show_detail_tr">
				<td class="show_detail_td">
					<table border="0" cellpadding="0" cellspacing="0" class="show_items_tbl">
						<tr class="show_items_tr_head">
		<?php
		foreach ($array_fields as $value)
		{
			#id_permission
			if ($value == 'id_permission')
			{
				?>
							<td class="show_items_td_head_str" width="<?=$array_width['id_permission']?>"><div class="text_show_items_head"><?=alt_text(getcut_string(CGROUPXPERMISSION_SHOW_DETAIL_HEAD_FIELD_ID_PERMISSION, $array_strlen['id_permission']), CGROUPXPERMISSION_SHOW_DETAIL_HEAD_FIELD_ID_PERMISSION)?></div></td>
				<?php
			}

		}
		?>
						</tr>
		<?php
		$this->setid_group($id_group);

		$rs_detail = $this->getlist($this->getFieldSql('id_group')." = ".$this->getValueSql($this->id_group), 0, 0, '', FALSE);

		if ($this->gettotal_list() > 0)
		{
			$o_permission = new Cpermission();
			$o_permission->setdb_connection($this->db_connection);

			for ($i = 0; $i < $this->gettotal_list(); $i++)
			{
				?>
						<tr class="show_items_tr">
				<?php
				foreach ($array_fields as $value)
				{
					#id_permission
					if ($value == 'id_permission')
					{
						$o_permission->setid($rs_detail[$i]['id_permission']);
						$o_permission->getdata();
						if ($o_permission->getname() == '')
						{
							$td_value = '&nbsp;';
						}
						else
						{
							$td_value = alt_text(getcut_string($o_permission->getname(), $array_strlen['id_permission']), $o_permission->getname());
						}
						?>
							<td class="show_items_td_str"><div class="text_show_items"><?=$td_value?></div></td>
						<?php
					}

				}
				?>
						</tr>
				<?php
			}
		}
		?>
					</table>
				</td>
			</tr>
			<tr class="show_detail_tr_separator_bottom">
				<td class="show_detail_td_separator_bottom"></td>
			</tr>
		</table>
		<?php
	}

	/**
	* Imprime los campos hidden necesarios para el método {@link form_detail()}
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
	* Ver también: {@link form_detail()}
	* @param array $fields [opcional] contiene los campos que se van a imprimir
	* @return string
	* @access public
	*/
	public function print_hidden_fields($fields='')
	{
		if (!is_array($fields))
		{
			unset($fields);
			$fields[0]['field'] = 'id_permission';
		}

		#fields control
		$amount_fields = count($fields);
		$flag_id_permission = FALSE;
		for ($i = 0; $i < $amount_fields; $i++)
		{
			$fields[$i]['field'] = trim($fields[$i]['field']);
			if ($fields[$i]['field'] == 'id_permission')
			{
				$flag_id_permission = TRUE;
			}
		}
		if ($flag_id_permission === FALSE)
		{
			$fields[]['field'] = 'id_permission';
		}

		#hidden fields
		$amount_fields = count($fields);
		for ($i = 0; $i < $amount_fields; $i++)
		{
			if (!isset($_POST['values_'.$fields[$i]['field']]))
			{
				$_POST['values_'.$fields[$i]['field']] = '';
			}

			if (is_array($_POST['values_'.$fields[$i]['field']]))
			{
				foreach ($_POST['values_'.$fields[$i]['field']] as $value)
				{
					#id_permission
					if ($fields[$i]['field'] == 'id_permission')
					{
						$this->setid_permission($value, TRUE);

						echo '<input name="values_'.$fields[$i]['field'].'[]" type="hidden" value="'.$this->getid_permission().'" />';
					}

				}
			}
		}

		echo '<input name="values_id_permission_groupxpermission" id="values_id_permission_groupxpermission" type="hidden" value="'.$_POST['values_id_permission_groupxpermission'].'" />';
	}

	/**
	* Setea las variables POST necesarios para el método {@link form_detail()}
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
	* - 'field'  : nombre del campo
	* - 'width'  : no se utiliza en este método
	* - 'strlen' : no se utiliza en este método
	*
	* Ver también: {@link form_detail()}
	* @param integer $id_group id del registro de la tabla {@link Cgroup "group"}
	* @param array $fields [opcional] contiene los campos que se van a setear
	* @access public
	*/
	public function load_detail($id_group, $fields='')
	{
		if (!is_array($fields))
		{
			unset($fields);
			$fields[0]['field'] = 'id_permission';
		}

		#fields control
		$amount_fields = count($fields);
		$flag_id_permission = FALSE;
		$aux_fields = array();
		for ($i = 0; $i < $amount_fields; $i++)
		{
			$fields[$i]['field'] = trim($fields[$i]['field']);
			if ($fields[$i]['field'] == 'id_permission')
			{
				$flag_id_permission = TRUE;
			}
			$aux_fields[] = $fields[$i]['field'];
		}
		if ($flag_id_permission === FALSE)
		{
			$aux_fields[] = 'id_permission';
		}

		$this->setid_group($id_group);

		$rs_detail = $this->getlist($this->getFieldSql('id_group')." = ".$this->getValueSql($this->id_group), 0, 0, '', FALSE);

		if ($this->gettotal_list() > 0)
		{
			$aux = '';
			$_POST['values_id_permission_groupxpermission'] = '';
			foreach ($rs_detail as $row)
			{
				#id_permission
				if (in_array('id_permission', $aux_fields))
				{
					if (get_magic_quotes_gpc())
					{
						$row['id_permission'] = addslashes($row['id_permission']);
					}
					$_POST['values_id_permission'][] = $row['id_permission'];

					$_POST['values_id_permission_groupxpermission'].= $aux.$row['id_permission'];
					$aux = ',';
				}

			}
		}
	}

}
?>