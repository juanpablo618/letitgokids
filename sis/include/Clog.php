<?php
/**
 * Archivo php creado por O-creator
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla log
 *
 * Esta clase se encarga de la administración de la tabla log brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Clog.php');
 * $log = new Clog();
 * $log->setDbConn($dbConn);
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:15-06-2020
 */
class Clog extends Cbase
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
	 * Usuario
	 *
	 * - Clave Foránea
	 * - Campo en la base de datos: id_user
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
	 * Ver también: {@link getIdUser()}, {@link setIdUser()}
	 * @var integer
	 * @access private
	 */
	private $idUser;

	/**
	 * Fecha
	 *
	 * - Campo en la base de datos: date
	 * - Tipo de campo en la base de datos: date
	 * - Campo requerido
	 * - Utiliza la clase {@link Cdate}
	 *
	 * Ver también: {@link getDate()}, {@link setDate()}
	 * @var string
	 * @access private
	 */
	private $date;

	/**
	 * Hora
	 *
	 * - Campo en la base de datos: hour
	 * - Tipo de campo en la base de datos: time
	 * - Campo requerido
	 * - Utiliza la clase {@link Cdate}
	 *
	 * Ver también: {@link getHour()}, {@link setHour()}
	 * @var string
	 * @access private
	 */
	private $hour;

	/**
	 * Acción
	 *
	 * - Campo en la base de datos: action
	 * - Tipo de campo en la base de datos: enum('login')
	 * - Campo requerido
	 *
	 * Ver también: {@link getAction()}, {@link setAction()}
	 * @var string
	 * @access private
	 */
	private $action;

	/**
	 * Constructor de la clase
	 *
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('log');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Clog.php');
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
			$this->addError(CLOG_SETID_REQUIRED_VALUE);

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
				$this->addError(CLOG_SETID_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $idUser Usuario}
	 *
	 * @param integer $idUser indica el valor Usuario
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdUser($idUser, $gpc = FALSE)
	{
		if (validateRequiredValue($idUser) === FALSE)
		{
			$this->idUser = $idUser;
			$this->addError(CLOG_SETID_USER_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->idUser = setValue($idUser, $gpc);

			if (validateIntValue($this->idUser, '+') === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CLOG_SETID_USER_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $date Fecha}
	 *
	 * Setea el valor Fecha. Si el parámetro $dbFormat es TRUE se está indicando que el parámetro $date se encuentra en el formato de la base de datos,
	 * sino, se está indicando que se encuentra en el formato definido en el archivo de configuración del script (FORMAT_DATE).
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $log = new Clog();
	 * //seteo en el formato que acepta la base de datos (yyyy-mm-dd)
	 * $log->setDate('1980-11-24', TRUE);
	 * //seteo en el formato definido en la configuración del script (suponemos que el formato utilizado es dd-mm-yyyy)
	 * $log->setDate('24-11-1980', FALSE);
	 * ?>
	 * </code>
	 *
	 * @param string $date indica el valor Fecha
	 * @param boolean $dbFormat indica si el valor Fecha está dado en el formato de la base de datos
	 * @return boolean
	 * @access public
	 */
	public function setDate($date, $dbFormat)
	{
		if (validateRequiredValue($date) === FALSE)
		{
			$this->date = $date;
			$this->addError(CLOG_SETDATE_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$oDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
			if ($dbFormat === TRUE)
			{
				if ($oDate->validateDate($date, 'db'))
				{
					$this->date = $date;

					return TRUE;
				}
				else
				{
					$this->date = '';
					$this->addError(CLOG_SETDATE_VALIDATE_VALUE);

					return FALSE;
				}
			}
			elseif ($dbFormat === FALSE)
			{
				if ($oDate->validateDate($date, 'str'))
				{
					$oDate->setStrDate($date);
					$this->date = $oDate->getDbDate();

					return TRUE;
				}
				else
				{
					$this->date = '';
					$this->addError(CLOG_SETDATE_VALIDATE_VALUE);

					return FALSE;
				}
			}
			else
			{
				$this->date = '';
				$this->addError(CLOG_SETDATE_ERROR);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $hour Hora}
	 *
	 * @param string $hour indica el valor Hora
	 * @return boolean
	 * @access public
	 */
	public function setHour($hour)
	{
		if (validateRequiredValue($hour) === FALSE)
		{
			$this->hour = $hour;
			$this->addError(CLOG_SETHOUR_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$oDate = new Cdate();
			$hour = getHourFormated($hour);
			if ($oDate->validateTime($hour) === TRUE)
			{
				$this->hour = $hour;

				return TRUE;
			}
			else
			{
				$this->addError(CLOG_SETHOUR_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $action Acción}
	 *
	 * @param string $action indica el valor Acción
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setAction($action, $gpc = FALSE)
	{
		if (validateRequiredValue($action) === FALSE)
		{
			$this->action = $action;
			$this->addError(CLOG_SETACTION_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->action = setValue($action, $gpc);

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
	 * Devuelve el valor {@link $idUser Usuario}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdUser($htmlEntities = TRUE)
	{
		return getValue($this->idUser, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $date Fecha}
	 *
	 * Devuelve el valor Fecha de acuerdo al valor del parámetro $dbFormat.
	 * Si $dbFormat es TRUE devuelve el valor en el formato que acepte la base de datos, sino, lo devuelve en el formato definido en el archivo de configuración del script (FORMAT_DATE).
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $log = new Clog();
	 * $log->setDate('1980-11-24', TRUE);
	 * echo 'Fecha en formato del script: ';
	 * echo $log->getDate().'<br />';
	 * echo 'Fecha en el formato que acepta la base de datos: ';
	 * echo $log->getDate(TRUE).'<br />';
	 * ?>
	 * </code>
	 *
	 * @param boolean $dbFormat [opcional] indica si el valor Fecha se devuelve en el formato que acepta la base de datos
	 * @return string
	 * @access public
	 */
	public function getDate($dbFormat = FALSE)
	{
		if ($dbFormat === TRUE)
		{
			return $this->date;
		}
		else
		{
			$oDate = new Cdate(FORMAT_DATE, $this->getDbConn()->fmtDate);
			$oDate->setDbDate($this->date);

			return $oDate->getStrDate();
		}
	}

	/**
	 * Devuelve el valor {@link $hour Hora}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getHour($htmlEntities = TRUE)
	{
		return getValue($this->hour, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $action Acción}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getAction($htmlEntities = TRUE)
	{
		return getValue($this->action, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve la descripción de los valores de {@link $action Acción}
	 *
	 * @param string $action indica el valor Acción
	 * @return string
	 * @access public
	 */
	public function getValuesAction($action)
	{
		switch ($action)
		{
			case 'login':
				return CLOG_GET_VALUES_ACTION_VALUE_1;
				break;

			default:
				return '&nbsp;';
		}
	}

	/**
	 * Inserta un nuevo registro en la tabla log
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

		if (isset($this->idUser) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_user');

			if (validateRequiredValue($this->idUser) === FALSE)
			{
				$values[] = 'NULL';
			}
			else
			{
				$values[] = $this->getValueSql($this->idUser);
			}
		}

		if (isset($this->date) === TRUE)
		{
			$fields[] = $this->getFieldSql('date');
			$values[] = $this->getValueSql($this->date);
		}

		if (isset($this->hour) === TRUE)
		{
			$fields[] = $this->getFieldSql('hour');
			$values[] = $this->getValueSql($this->hour);
		}

		if (isset($this->action) === TRUE)
		{
			$fields[] = $this->getFieldSql('action');
			$values[] = $this->getValueSql($this->action);
		}

		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CLOG_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla log
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

			if (isset($this->idUser) === TRUE)
			{
				if (validateRequiredValue($this->idUser) === FALSE)
				{
					$values[] = $this->getFieldSql('id_user').' = NULL';
				}
				else
				{
					$values[] = $this->getFieldSql('id_user').' = '.$this->getValueSql($this->idUser);
				}
			}

			if (isset($this->date) === TRUE)
			{
				$values[] = $this->getFieldSql('date').' = '.$this->getValueSql($this->date);
			}

			if (isset($this->hour) === TRUE)
			{
				$values[] = $this->getFieldSql('hour').' = '.$this->getValueSql($this->hour);
			}

			if (isset($this->action) === TRUE)
			{
				$values[] = $this->getFieldSql('action').' = '.$this->getValueSql($this->action);
			}

			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CLOG_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CLOG_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla log
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
				$this->addError(CLOG_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CLOG_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla log
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
				$this->setIdUser($row['id_user']);
				$this->setDate($row['date'], TRUE);
				$this->setHour($row['hour']);
				$this->setAction($row['action']);

				return TRUE;
			}
			else
			{
				$this->addError(CLOG_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CLOG_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un conjunto de registros de la tabla log
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
		$oIdUser = new Cuser();
		$oIdUser->setDbConn($this->getDbConn());

		$sql = 'SELECT ';
		$sql.= $this->getFieldSql('id', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_user', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('date', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('hour', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('action', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id', $oIdUser->getTableName(), 'user_id');
		$sql.= ', '.$this->getFieldSql('user', $oIdUser->getTableName(), 'user_user');
		$sql.= ', '.$this->getFieldSql('pass', $oIdUser->getTableName(), 'user_pass');
		$sql.= ', '.$this->getFieldSql('id_group', $oIdUser->getTableName(), 'user_id_group');
		$sql.= ', '.$this->getFieldSql('active', $oIdUser->getTableName(), 'user_active');
		$sql.= ', '.$this->getFieldSql('token', $oIdUser->getTableName(), 'user_token');
		$sql.= ', '.$this->getFieldSql('name', $oIdUser->getTableName(), 'user_name');
		$sql.= ', '.$this->getFieldSql('lastname', $oIdUser->getTableName(), 'user_lastname');
		$sql.= ', '.$this->getFieldSql('email', $oIdUser->getTableName(), 'user_email');
		$sql.= ', '.$this->getFieldSql('id_provider', $oIdUser->getTableName(), 'user_id_provider');
		$sql.= ' FROM '.$this->getTableSql();
		$sql.= ' LEFT JOIN '.$oIdUser->getTableSql().' ON '.$this->getFieldSql('id_user', $this->getTableName()).' = '.$oIdUser->getFieldSql('id', $oIdUser->getTableName());
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
				$this->addError(CLOG_GETLIST_ERROR);

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
					$this->setIdUser($rs->fields['id_user']);
					$this->setDate($rs->fields['date'], TRUE);
					$this->setHour($rs->fields['hour']);
					$this->setAction($rs->fields['action']);

					$oIdUser->setName($rs->fields['user_name']);

					$list[] = array(
						'id' => $this->getId($htmlEntities) ,
						'idUser' => $this->getIdUser($htmlEntities) ,
						'date' => $this->getDate() ,
						'hour' => $this->getHour($htmlEntities) ,
						'action' => $this->getAction($htmlEntities) ,
						'userName' => $oIdUser->getName($htmlEntities)
					);

					$rs->MoveNext();
				}

				$this->id = NULL;
				$this->idUser = NULL;
				$this->date = NULL;
				$this->hour = NULL;
				$this->action = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CLOG_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}

	/**
	 * Devuelve el último valor ID insertado en la tabla log
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
			$this->addError(CLOG_GET_LAST_ID_ERROR);

			return FALSE;
		}
		else
		{
			return $row['id'];
		}
	}

	/**
	 * Muestra un formulario para dar de alta un registro de la tabla log
	 *
	 * Este método muestra un formulario para dar de alta un registro de la tabla log mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,idUser,date,hour,action';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['addLog']) === FALSE)
		{
			$_POST['addLog'] = '';
		}

		if ($_POST['addLog'] == 'add')
		{
			if (in_array('idUser', $arrayFields) === TRUE)
			{
				$this->setIdUser($_POST['idUser'], TRUE);
			}
			if (in_array('date', $arrayFields) === TRUE)
			{
				$this->setDate($_POST['date'], FALSE);
			}
			if (in_array('hour', $arrayFields) === TRUE)
			{
				$this->setHour($_POST['hour']);
			}
			if (in_array('action', $arrayFields) === TRUE)
			{
				$this->setAction($_POST['action'], TRUE);
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
					<div class="message success"><?php echo CLOG_ADD_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CLOG_ADD_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="success" />
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
				<form name="formAddLog" id="formAddLog" method="post" action="">
				<input name="addLog" type="hidden" id="addLog" value="back" />
				<div class="fields">
				<?php
				if (in_array('idUser', $arrayFields) === TRUE)
				{
					echo '<input name="idUser" type="hidden" id="idUser" value="'.$this->getIdUser().'" />';
				}
				if (in_array('date', $arrayFields) === TRUE)
				{
					echo '<input name="date" type="hidden" id="date" value="'.$this->getDate().'" />';
				}
				if (in_array('hour', $arrayFields) === TRUE)
				{
					echo '<input name="hour" type="hidden" id="hour" value="'.$this->getHour().'" />';
				}
				if (in_array('action', $arrayFields) === TRUE)
				{
					echo '<input name="action" type="hidden" id="action" value="'.$this->getAction().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CLOG_ADD_FORM_BACK_BTN; ?>" class="back" />
				</div>
				</form>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
		else
		{
			if ($_POST['addLog'] == 'back')
			{
				if (in_array('idUser', $arrayFields) === TRUE)
				{
					$this->setIdUser($_POST['idUser'], TRUE);
				}
				if (in_array('date', $arrayFields) === TRUE)
				{
					$this->setDate($_POST['date'], FALSE);
				}
				if (in_array('hour', $arrayFields) === TRUE)
				{
					$this->setHour($_POST['hour']);
				}
				if (in_array('action', $arrayFields) === TRUE)
				{
					$this->setAction($_POST['action'], TRUE);
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
				<form name="formAddLog" id="formAddLog" method="post" action="">
				<input name="addLog" type="hidden" id="addLog" value="add" />
				<div class="fields">
			<?php
			foreach ($arrayFields as $value)
			{
				if ($value == 'idUser')
				{
				?>
					<div class="field">
						<label><?php echo CLOG_ADD_FORM_LABEL_FIELD_ID_USER; ?> <span>*</span></label>
					<?php
					$oIdUser = new Cuser();
					$oIdUser->setDbConn($this->getDbConn());
					$oIdUser->showList('name', 'name', $this->getIdUser(), 'idUser', 'idUser', 'select');
					?>
					</div>
				<?php
				}
				if ($value == 'date')
				{
				?>
					<div class="field">
						<label><?php echo CLOG_ADD_FORM_LABEL_FIELD_DATE; ?> <span>*</span></label>
						<input name="date" type="text" id="date" value="<?php echo $this->getDate(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDate" class="calendar"></a><script> $(document).ready(function () { showCalendar('#date', '#btnDate', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
				<?php
				}
				if ($value == 'hour')
				{
				?>
					<div class="field">
						<label><?php echo CLOG_ADD_FORM_LABEL_FIELD_HOUR; ?> <span>*</span></label>
						<input name="hour" type="text" id="hour" value="<?php echo $this->getHour(); ?>" class="datetime" maxlength="19" placeholder="<?php echo $oDateInfo->getDescStrFormat().' HH:mm:ss'; ?>" /><a href="#" id="btnHour" class="calendar"></a><script> $(document).ready(function () { showCalendar('#hour', '#btnHour', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
				<?php
				}
				if ($value == 'action')
				{
				?>
					<div class="field">
						<label><?php echo CLOG_ADD_FORM_LABEL_FIELD_ACTION; ?> <span>*</span></label>
						<select name="action" id="action">
							<option value=""></option>
							<option value="login" <?php if ($this->getAction() == 'login') echo 'selected="selected"' ?>><?php echo $this->getValuesAction('login'); ?></option>
						</select>
					</div>
				<?php
				}
			}
			?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CLOG_ADD_FORM_SUBMIT_BTN; ?>" class="accept" />
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CLOG_ADD_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
			<?php
			}
			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CLOG_ADD_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Muestra un formulario para actualizar un registro existente de la tabla log
	 *
	 * Este método muestra un formulario para actualizar un registro de la tabla log mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,idUser,date,hour,action';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['updateLog']) === FALSE)
		{
			$_POST['updateLog'] = '';
		}

		if (isset($_GET['p']) === FALSE)
		{
			$_GET['p'] = '';
		}

		if ($_POST['updateLog'] == 'update')
		{
			$this->setId($_POST['id'], TRUE);
			if (in_array('idUser', $arrayFields) === TRUE)
			{
				$this->setIdUser($_POST['idUser'], TRUE);
			}
			if (in_array('date', $arrayFields) === TRUE)
			{
				$this->setDate($_POST['date'], FALSE);
			}
			if (in_array('hour', $arrayFields) === TRUE)
			{
				$this->setHour($_POST['hour']);
			}
			if (in_array('action', $arrayFields) === TRUE)
			{
				$this->setAction($_POST['action'], TRUE);
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
					<div class="message success"><?php echo CLOG_UPDATE_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CLOG_UPDATE_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
				<form name="formUpdateLog" id="formUpdateLog" method="post" action="">
				<input name="updateLog" type="hidden" id="updateLog" value="back" />
				<div class="fields">
				<?php
				if (in_array('idUser', $arrayFields) === TRUE)
				{
					echo '<input name="idUser" type="hidden" id="idUser" value="'.$this->getIdUser().'" />';
				}
				if (in_array('date', $arrayFields) === TRUE)
				{
					echo '<input name="date" type="hidden" id="date" value="'.$this->getDate().'" />';
				}
				if (in_array('hour', $arrayFields) === TRUE)
				{
					echo '<input name="hour" type="hidden" id="hour" value="'.$this->getHour().'" />';
				}
				if (in_array('action', $arrayFields) === TRUE)
				{
					echo '<input name="action" type="hidden" id="action" value="'.$this->getAction().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CLOG_UPDATE_FORM_BACK_BTN; ?>" class="back" />
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
				if ($_POST['updateLog'] == 'back')
				{
					if (in_array('idUser', $arrayFields) === TRUE)
					{
						$this->setIdUser($_POST['idUser'], TRUE);
					}
					if (in_array('date', $arrayFields) === TRUE)
					{
						$this->setDate($_POST['date'], FALSE);
					}
					if (in_array('hour', $arrayFields) === TRUE)
					{
						$this->setHour($_POST['hour']);
					}
					if (in_array('action', $arrayFields) === TRUE)
					{
						$this->setAction($_POST['action'], TRUE);
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
				<form name="formUpdateLog" id="formUpdateLog" method="post" action="">
				<input name="updateLog" type="hidden" id="updateLog" value="update" />
				<input name="id" type="hidden" id="id" value="<?php echo $this->getId(); ?>" />
				<div class="fields">
				<?php
				foreach ($arrayFields as $value)
				{
					if ($value == 'id')
					{
					?>
					<div class="field">
						<label><?php echo CLOG_UPDATE_FORM_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
					<?php
					}
					if ($value == 'idUser')
					{
					?>
					<div class="field">
						<label><?php echo CLOG_UPDATE_FORM_LABEL_FIELD_ID_USER; ?> <span>*</span></label>
						<?php
						$oIdUser = new Cuser();
						$oIdUser->setDbConn($this->getDbConn());
						$oIdUser->showList('name', 'name', $this->getIdUser(), 'idUser', 'idUser', 'select');
						?>
					</div>
					<?php
					}
					if ($value == 'date')
					{
					?>
					<div class="field">
						<label><?php echo CLOG_UPDATE_FORM_LABEL_FIELD_DATE; ?> <span>*</span></label>
						<input name="date" type="text" id="date" value="<?php echo $this->getDate(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDate" class="calendar"></a><script> $(document).ready(function () { showCalendar('#date', '#btnDate', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
					<?php
					}
					if ($value == 'hour')
					{
					?>
					<div class="field">
						<label><?php echo CLOG_UPDATE_FORM_LABEL_FIELD_HOUR; ?> <span>*</span></label>
						<input name="hour" type="text" id="hour" value="<?php echo $this->getHour(); ?>" class="datetime" maxlength="19" placeholder="<?php echo $oDateInfo->getDescStrFormat().' HH:mm:ss'; ?>" /><a href="#" id="btnHour" class="calendar"></a><script> $(document).ready(function () { showCalendar('#hour', '#btnHour', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
					</div>
					<?php
					}
					if ($value == 'action')
					{
					?>
					<div class="field">
						<label><?php echo CLOG_UPDATE_FORM_LABEL_FIELD_ACTION; ?> <span>*</span></label>
						<select name="action" id="action">
							<option value=""></option>
							<option value="login" <?php if ($this->getAction() == 'login') echo 'selected="selected"' ?>><?php echo $this->getValuesAction('login'); ?></option>
						</select>
					</div>
					<?php
					}
				}
				?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CLOG_UPDATE_FORM_SUBMIT_BTN; ?>" class="accept" />
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CLOG_UPDATE_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="cancel" />
				<?php
				}
				?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CLOG_UPDATE_FORM_LABEL_REQUIRED; ?></span>
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
					<input type="button" value="<?php echo CLOG_UPDATE_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
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
	 * Elimina un registro existente de la tabla log y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un registro de la tabla log y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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

		$this->del();

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
					<div class="message success"><?php echo CLOG_DEL_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CLOG_DEL_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
					<input type="button" value="<?php echo CLOG_DEL_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
				</div>
		<?php
		}
		?>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Elimina un grupo de registros existente de la tabla log y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un grupo de registros de la tabla log y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
				}
				else
				{
					$flagGroup = TRUE;
				}
			}
		}
		else
		{
			$this->addError(CLOG_DEL_GROUP_FORM_REQUIRED_PK);
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
					<div class="message success"><?php echo CLOG_DEL_GROUP_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CLOG_DEL_GROUP_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="success" />
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
				$this->addError(CLOG_DEL_GROUP_FORM_CANT_DELETE_ALL);
			}
			?>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="button" value="<?php echo CLOG_DEL_GROUP_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="back" />
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
			$fields = 'id,idUser,date,hour,action';
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
						<label><?php echo CLOG_SHOW_DATA_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idUser')
			{
			?>
					<div class="field">
						<label><?php echo CLOG_SHOW_DATA_LABEL_FIELD_ID_USER; ?></label>
				<?php
				$oIdUser = new Cuser();
				$oIdUser->setDbConn($this->getDbConn());
				$oIdUser->setId($this->getIdUser(FALSE));
				$oIdUser->getData();
				?>
						<strong><?php echo $oIdUser->getName(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'date')
			{
			?>
					<div class="field">
						<label><?php echo CLOG_SHOW_DATA_LABEL_FIELD_DATE; ?></label>
						<strong><?php echo $this->getDate(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'hour')
			{
			?>
					<div class="field">
						<label><?php echo CLOG_SHOW_DATA_LABEL_FIELD_HOUR; ?></label>
						<strong><?php echo $this->getHour(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'action')
			{
			?>
					<div class="field">
						<label><?php echo CLOG_SHOW_DATA_LABEL_FIELD_ACTION; ?></label>
						<strong><?php echo $this->getValuesAction($this->getAction()); ?></strong>
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
					<input type="button" value="<?php echo CLOG_SHOW_DATA_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
		<?php
		}
		?>
				</div>
				<div class="bottom"></div>
			</div>
	<?php
	}

	/**
	 * Muestra un formulario de búsqueda de registros de la tabla log
	 *
	 * Este método muestra un formulario con los campos seteados en el parámetro $fields para realizar una búsqueda de los registros de la tabla log.
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
			$fields = 'id,idUser,date,hour,action';
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
			if (isset($_SESSION['main_tr_search_log']) === FALSE)
			{
				$_SESSION['main_tr_search_log'] = '';
			}

			$display  = 'display: none;';
			$btnClass = 'closed';
			if ($_SESSION['main_tr_search_log'] === 'open')
			{
				$display  = '';
				$btnClass = 'open';
			}
		}
		?>
				<div class="title">
					<div class="ico"><?php if ($showHideBtn === TRUE) { ?><a href="#" onclick="showHideSearch('log'); return false;" class="<?php echo $btnClass; ?>"></a><?php } ?></div>
					<div class="label"><a href="#" onclick="showHideSearch('log'); return false;"><?php echo $title; ?></a></div>
				</div>
				<div id="container_search_log" style="<?php echo $display; ?>">
					<div class="top"></div>
					<form name="formSearchLog" id="formSearchLog" method="<?php echo $method; ?>" action="">
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
							<label><?php echo CLOG_SEARCH_FORM_LABEL_FIELD_ID; ?></label>
							<input name="id" type="text" id="id" value="<?php echo $this->getId(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getId()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id', $this->getTableName()).' = '.$this->getValueSql($this->id);
					$params[] = 'id='.urlencode($this->id);
				}
			}

			if ($value == 'idUser')
			{
				$this->setIdUser($values['idUser'], TRUE);
				?>
						<div class="field">
							<label><?php echo CLOG_SEARCH_FORM_LABEL_FIELD_ID_USER; ?></label>
				<?php
				$oIdUser = new Cuser();
				$oIdUser->setDbConn($this->getDbConn());
				$oIdUser->showList('name', 'name', $this->getIdUser(), 'idUser', 'idUser', 'select_search');
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdUser()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_user', $this->getTableName()).' = '.$this->getValueSql($this->idUser);
					$params[] = 'idUser='.urlencode($this->idUser);
				}
			}

			if ($value == 'date')
			{
				$this->setDate($values['date'], FALSE);
				?>
						<div class="field">
							<label><?php echo CLOG_SEARCH_FORM_LABEL_FIELD_DATE; ?></label>
							<input name="date" type="text" id="date" value="<?php echo $this->getDate(); ?>" class="date" maxlength="10" placeholder="<?php echo $oDateInfo->getDescStrFormat(); ?>" /><a href="#" id="btnDate" class="calendar"></a><script> $(document).ready(function () { showCalendar('#date', '#btnDate', '<?php echo $oDateInfo->getCalendarStrFormat(); ?>'); }); </script>
						</div>
				<?php
				if (validateRequiredValue($this->getDate()) === TRUE)
				{
					$condition[] = $this->getFieldSql('date', $this->getTableName()).' = '.$this->getValueSql($this->date);
					$params[] = 'date='.urlencode($this->getDate());
				}
			}

			if ($value == 'hour')
			{
				$this->setHour($values['hour']);
				?>
						<div class="field">
							<label><?php echo CLOG_SEARCH_FORM_LABEL_FIELD_HOUR; ?></label>
							<input name="hour" type="text" id="hour" value="<?php echo $this->getHour(); ?>" class="datetime" maxlength="19" placeholder="<?php echo ' HH:mm:ss'; ?>" />
						</div>
				<?php
				if (validateRequiredValue($this->getHour()) === TRUE)
				{
					$condition[] = $this->getFieldSql('hour', $this->getTableName()).' = '.$this->getValueSql($this->hour);
					$params[] = 'hour='.urlencode($this->hour);
				}
			}

			if ($value == 'action')
			{
				$this->setAction($values['action'], TRUE);
				?>
						<div class="field">
							<label><?php echo CLOG_SEARCH_FORM_LABEL_FIELD_ACTION; ?></label>
							<select name="action" id="action">
								<option value=""></option>
								<option value="login" <?php if ($this->getAction() == 'login') echo 'selected="selected"' ?>><?php echo $this->getValuesAction('login'); ?></option>
							</select>
						</div>
				<?php
				if (validateRequiredValue($this->getAction()) === TRUE)
				{
					$condition[] = $this->getFieldSql('action', $this->getTableName()).' = '.$this->getValueSql($this->action);
					$params[] = 'action='.urlencode($this->action);
				}
			}
		}
		?>
					</div>
					<div class="middle"></div>
					<div class="buttons">
						<input type="submit" value="<?php echo CLOG_SEARCH_FORM_SUBMIT_BTN; ?>" class="search" />
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
	 * Muestra el resultado de una consulta a la tabla log
	 *
	 * Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla log. Muestra sólo los campos seteados en el parámetro $fields.
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
	 * Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST['logGroup'] (array)</b>
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
			$fields[1]['field'] = 'idUser';
			$fields[2]['field'] = 'date';
			$fields[3]['field'] = 'hour';
			$fields[4]['field'] = 'action';
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
			$arrayOrder = array('id', 'id_user', 'date', 'hour', 'action');
			array_push($arrayOrder, 'user_name');

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

				$head.= '<div class="col" style="width: '.$arrayWidth['id'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CLOG_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CLOG_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></div>';
				$headers['id'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CLOG_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CLOG_SHOW_QUERY_HEAD_FIELD_ID).'</a></div>';
			}

			if ($value == 'idUser')
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

				$head.= '<div class="col" style="width: '.$arrayWidth['idUser'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CLOG_SHOW_QUERY_HEAD_FIELD_ID_USER, $arrayStrLen['idUser']), CLOG_SHOW_QUERY_HEAD_FIELD_ID_USER).'</a></div></div>';
				$headers['idUser'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CLOG_SHOW_QUERY_HEAD_FIELD_ID_USER, $arrayStrLen['idUser']), CLOG_SHOW_QUERY_HEAD_FIELD_ID_USER).'</a></div>';
			}

			if ($value == 'date')
			{
				if ($_GET['orderby'] == 'date')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=date&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=date&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=date&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['date'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CLOG_SHOW_QUERY_HEAD_FIELD_DATE, $arrayStrLen['date']), CLOG_SHOW_QUERY_HEAD_FIELD_DATE).'</a></div></div>';
				$headers['date'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CLOG_SHOW_QUERY_HEAD_FIELD_DATE, $arrayStrLen['date']), CLOG_SHOW_QUERY_HEAD_FIELD_DATE).'</a></div>';
			}

			if ($value == 'hour')
			{
				if ($_GET['orderby'] == 'hour')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=hour&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=hour&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=hour&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['hour'].';"><div class="date"><a href="'.$href.'">'.altText(getCutString(CLOG_SHOW_QUERY_HEAD_FIELD_HOUR, $arrayStrLen['hour']), CLOG_SHOW_QUERY_HEAD_FIELD_HOUR).'</a></div></div>';
				$headers['hour'] = '<div class="date"><a href="'.$href.'">'.altText(getCutString(CLOG_SHOW_QUERY_HEAD_FIELD_HOUR, $arrayStrLen['hour']), CLOG_SHOW_QUERY_HEAD_FIELD_HOUR).'</a></div>';
			}

			if ($value == 'action')
			{
				if ($_GET['orderby'] == 'action')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=action&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=action&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=action&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['action'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CLOG_SHOW_QUERY_HEAD_FIELD_ACTION, $arrayStrLen['action']), CLOG_SHOW_QUERY_HEAD_FIELD_ACTION).'</a></div></div>';
				$headers['action'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CLOG_SHOW_QUERY_HEAD_FIELD_ACTION, $arrayStrLen['action']), CLOG_SHOW_QUERY_HEAD_FIELD_ACTION).'</a></div>';
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
				<form name="formQueryLog" id="formQueryLog" method="post" action="">
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
				<div class="message warning"><?php echo CLOG_SHOW_QUERY_NOT_FOUND; ?></div>
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
					<div class="row row<?php echo $class; ?>" id="log_tr_<?php echo $row['id']; ?>" data-table-name="log" data-id="<?php echo $row['id']; ?>" data-form-id="formQueryLog">
				<?php
				if (is_array($groupActions) === TRUE)
				{
				?>
						<div class="col header"></div>
						<div class="col" style="width: <?php echo $widthGroupActions; ?>;"><div class="group-actions"><input name="logGroup[]" type="checkbox" id="cb_log_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="checkboxClick(this)" /></div></div>
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

					if ($value == 'idUser')
					{
					?>
						<div class="col header"><?php echo $headers['idUser']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idUser']; ?>;"><div class="str"><?php echo altText(getCutString($row['userName'], $arrayStrLen['idUser']), $row['userName']); ?></div></div>
					<?php
					}

					if ($value == 'date')
					{
					?>
						<div class="col header"><?php echo $headers['date']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['date']; ?>;"><div class="date"><?php echo altText(getCutString($row['date'], $arrayStrLen['date']), $row['date']); ?></div></div>
					<?php
					}

					if ($value == 'hour')
					{
					?>
						<div class="col header"><?php echo $headers['hour']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['hour']; ?>;"><div class="date"><?php echo altText(getCutString($row['hour'], $arrayStrLen['hour']), $row['hour']); ?></div></div>
					<?php
					}

					if ($value == 'action')
					{
					?>
						<div class="col header"><?php echo $headers['action']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['action']; ?>;"><div class="str"><?php echo altText(getCutString($this->getValuesAction($row['action']), $arrayStrLen['action']), $this->getValuesAction($row['action'])); ?></div></div>
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
						<input name="log_select_all" type="checkbox" id="log_select_all" value="" class="checkbox_show_query" onclick="querySelectAll('log', 'formQueryLog')" />
						<span><?php echo CLOG_SHOW_QUERY_SELECT_ALL; ?></span>
					</div>
			<?php
			$j = 1;
			foreach ($groupActions as $value)
			{
				if ($value['confirm'] === TRUE)
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryLog\', \''.$value['file'].'\', \''.$actionsParams.'\', true, \''.$value['msg'].'\');"';
				}
				else
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryLog\', \''.$value['file'].'\', \''.$actionsParams.'\', false, \'\');"';
				}

				if ($value['button'] === TRUE)
				{
					echo '<input type="button" name="log_ga_'.$j.'" id="log_ga_'.$j.'" value="'.$value['text'].'" class="'.$value['class'].'" '.$onclick.' />';
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

}
?>