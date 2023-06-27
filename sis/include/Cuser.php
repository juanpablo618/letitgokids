<?php
/**
 * Archivo php creado por O-creator
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla user
 *
 * Esta clase se encarga de la administración de la tabla user brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Cuser.php');
 * $user = new Cuser();
 * $user->setDbConn($dbConn);
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:03-07-2019
 */
class Cuser extends Cbase
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
	 * - Campo: {@link Cmovement::$idUserAdd idUserAdd}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * <b>Relación</b>
	 * Este campo es usado como clave foránea en:
	 * - Tabla: {@link Cproduct product}
	 * - Campo: {@link Cproduct::$idUserAdd idUserAdd}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * Ver también: {@link getId()}, {@link setId()}
	 * @var integer
	 * @access private
	 */
	private $id;

	/**
	 * Usuario
	 *
	 * - Campo en la base de datos: user
	 * - Tipo de campo en la base de datos: varchar(30)
	 * - Extra: Alfanumérico sin espacios en blanco (ver {@link validateStringValue()})
	 * - Campo requerido
	 * - Campo único
	 *
	 * Ver también: {@link getUser()}, {@link setUser()}
	 * @var string
	 * @access private
	 */
	private $user;

	/**
	 * Contraseña
	 *
	 * - Campo en la base de datos: pass
	 * - Tipo de campo en la base de datos: varchar(100)
	 * - Campo requerido
	 *
	 * Ver también: {@link getPass()}, {@link setPass()}
	 * @var string
	 * @access private
	 */
	private $pass;

	/**
	 * Grupo
	 *
	 * - Clave Foránea
	 * - Campo en la base de datos: id_group
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 * - Campo requerido
	 *
	 * <b>Relación</b>
	 * Este campo es clave foránea a:
	 * - Tabla: {@link Cgroup group}
	 * - Campo: {@link Cgroup::$id id}
	 * - Campo que se muestra: {@link Cgroup::$name name}
	 * - Interfaz: independiente
	 * - Eliminar: restrictivo
	 *
	 * Ver también: {@link getIdGroup()}, {@link setIdGroup()}
	 * @var integer
	 * @access private
	 */
	private $idGroup;

	/**
	 * Activo
	 *
	 * - Campo en la base de datos: active
	 * - Tipo de campo en la base de datos: enum('yes','no')
	 * - Campo requerido
	 *
	 * Ver también: {@link getActive()}, {@link setActive()}
	 * @var string
	 * @access private
	 */
	private $active;

	/**
	 * Token
	 *
	 * - Campo en la base de datos: token
	 * - Tipo de campo en la base de datos: varchar(100)
	 *
	 * Ver también: {@link getToken()}, {@link setToken()}
	 * @var string
	 * @access private
	 */
	private $token;
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
	 * Apellido
	 *
	 * - Campo en la base de datos: lastname
	 * - Tipo de campo en la base de datos: varchar(100)
	 * - Campo requerido
	 *
	 * Ver también: {@link getLastname()}, {@link setLastname()}
	 * @var string
	 * @access private
	 */
	private $lastname;

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
	 * Proveedor/Cliente
	 *
	 * - Clave Foránea
	 * - Campo en la base de datos: id_provider
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 * - Campo único
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
	 * Constructor de la clase
	 *
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('user');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cuser.php');
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
			$this->addError(CUSER_SETID_REQUIRED_VALUE);

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
				$this->addError(CUSER_SETID_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $user Usuario}
	 *
	 * @param string $user indica el valor Usuario
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setUser($user, $gpc = FALSE)
	{
		if (validateRequiredValue($user) === FALSE)
		{
			$this->user = $user;
			$this->addError(CUSER_SETUSER_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->user = setValue($user, $gpc);

			if (validateStringValue($this->user, 'alphanumeric', FALSE) === TRUE or validateEmailValue($this->user) === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CUSER_SETUSER_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $pass Contraseña}
	 *
	 * @param string $pass indica el valor Contraseña
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setPass($pass, $gpc = FALSE)
	{
	    if (validateRequiredValue($pass) === FALSE)
	    {
		$this->pass = $pass;
		$this->addError(CUSER_SETPASS_REQUIRED_VALUE);

		return FALSE;
	    }
	    else
	    {
		$this->pass = setValue($pass, $gpc);

		return TRUE;
	    }
	}

	/**
	 * Setea el valor {@link $idGroup Grupo}
	 *
	 * @param integer $idGroup indica el valor Grupo
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdGroup($idGroup, $gpc = FALSE)
	{
		if (validateRequiredValue($idGroup) === FALSE)
		{
			$this->idGroup = $idGroup;
			$this->addError(CUSER_SETID_GROUP_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->idGroup = setValue($idGroup, $gpc);

			if (validateIntValue($this->idGroup, '+') === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CUSER_SETID_GROUP_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $active Activo}
	 *
	 * @param string $active indica el valor Activo
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setActive($active, $gpc = FALSE)
	{
		if (validateRequiredValue($active) === FALSE)
		{
			$this->active = $active;
			$this->addError(CUSER_SETACTIVE_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->active = setValue($active, $gpc);

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $token Token}
	 *
	 * @param string $token indica el valor Token
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setToken($token, $gpc = FALSE)
	{
		$this->token = setValue($token, $gpc);

		return TRUE;
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
			$this->addError(CUSER_SETNAME_REQUIRED_VALUE);
			return FALSE;
		}
		else
		{
			$this->name = setValue($name, $gpc);
			return TRUE;
		}
	}
	/**
	 * Setea el valor {@link $lastname Apellido}
	 *
	 * @param string $lastname indica el valor Apellido
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setLastname($lastname, $gpc = FALSE)
	{
		if (validateRequiredValue($lastname) === FALSE)
		{
			$this->lastname = $lastname;
			$this->addError(CUSER_SETLASTNAME_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->lastname = setValue($lastname, $gpc);

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
			$this->addError(CUSER_SETEMAIL_REQUIRED_VALUE);

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
			$this->addError(CUSER_SETEMAIL_VALIDATE_VALUE);

			return FALSE;
		    }
		}
	}
	/**
	 * Setea el valor {@link $idProvider Proveedor/Cliente}
	 *
	 * @param integer $idProvider indica el valor Proveedor/Cliente
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
			$this->addError(CUSER_SETID_PROVIDER_VALIDATE_VALUE);
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
	 * Devuelve el valor {@link $user Usuario}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getUser($htmlEntities = TRUE)
	{
		return getValue($this->user, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $pass Contraseña}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getPass($htmlEntities = TRUE)
	{
		return getValue($this->pass, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $idGroup Grupo}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdGroup($htmlEntities = TRUE)
	{
		return getValue($this->idGroup, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $active Activo}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getActive($htmlEntities = TRUE)
	{
		return getValue($this->active, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve la descripción de los valores de {@link $active Activo}
	 *
	 * @param string $active indica el valor Activo
	 * @return string
	 * @access public
	 */
	public function getValuesActive($active)
	{
		switch ($active)
		{
			case 'yes':
				return CUSER_GET_VALUES_ACTIVE_VALUE_1;
				break;

			case 'no':
				return CUSER_GET_VALUES_ACTIVE_VALUE_2;
				break;

			default:
				return '&nbsp;';
		}
	}

	/**
	 * Devuelve el valor {@link $token Token}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getToken($htmlEntities = TRUE)
	{
		return getValue($this->token, $htmlEntities, $this->getCharset());
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
	 * Devuelve el valor {@link $lastname Apellido}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getLastname($htmlEntities = TRUE)
	{
		return getValue($this->lastname, $htmlEntities, $this->getCharset());
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
	 * Devuelve el valor {@link $idProvider Proveedor/Cliente}
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
	 * Inserta un nuevo registro en la tabla user
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
		if (isset($this->user) === TRUE)
		{
			$fields[] = $this->getFieldSql('user');
			$values[] = $this->getValueSql($this->user);
		}
		if (isset($this->pass) === TRUE)
		{
			$fields[] = $this->getFieldSql('pass');
			$values[] = $this->getValueSql(md5($this->pass));
		}
		if (isset($this->idGroup) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_group');

			if (validateRequiredValue($this->idGroup) === FALSE)
			{
				$values[] = 'NULL';
			}
			else
			{
				$values[] = $this->getValueSql($this->idGroup);
			}
		}
		if (isset($this->active) === TRUE)
		{
			$fields[] = $this->getFieldSql('active');
			$values[] = $this->getValueSql($this->active);
		}
		if (isset($this->token) === TRUE)
		{
			$fields[] = $this->getFieldSql('token');
			$values[] = $this->getValueSql($this->token);
		}
		if (isset($this->name) === TRUE)
		{
			$fields[] = $this->getFieldSql('name');
			$values[] = $this->getValueSql($this->name);
		}
		if (isset($this->lastname) === TRUE)
		{
			$fields[] = $this->getFieldSql('lastname');
			$values[] = $this->getValueSql($this->lastname);
		}
		if (isset($this->email) === TRUE)
		{
			$fields[] = $this->getFieldSql('email');
			$values[] = $this->getValueSql($this->email);
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

		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CUSER_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla user
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

			if (isset($this->user) === TRUE)
			{
				$values[] = $this->getFieldSql('user').' = '.$this->getValueSql($this->user);
			}

			if (isset($this->pass) === TRUE)
			{
				$values[] = $this->getFieldSql('pass').' = '.$this->getValueSql(md5($this->pass));
			}

			if (isset($this->idGroup) === TRUE)
			{
				if (validateRequiredValue($this->idGroup) === FALSE)
				{
					$values[] = $this->getFieldSql('id_group').' = NULL';
				}
				else
				{
					$values[] = $this->getFieldSql('id_group').' = '.$this->getValueSql($this->idGroup);
				}
			}

			if (isset($this->active) === TRUE)
			{
				$values[] = $this->getFieldSql('active').' = '.$this->getValueSql($this->active);
			}
			if (isset($this->token) === TRUE)
			{
				$values[] = $this->getFieldSql('token').' = '.$this->getValueSql($this->token);
			}
			if (isset($this->name) === TRUE)
			{
				$values[] = $this->getFieldSql('name').' = '.$this->getValueSql($this->name);
			}
			if (isset($this->lastname) === TRUE)
			{
				$values[] = $this->getFieldSql('lastname').' = '.$this->getValueSql($this->lastname);
			}

			if (isset($this->email) === TRUE)
			{
				$values[] = $this->getFieldSql('email').' = '.$this->getValueSql($this->email);
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

			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($this->id);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CUSER_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CUSER_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla user
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
				$this->addError(CUSER_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CUSER_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla user
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
				$this->setUser($row['user']);
				$this->setPass($row['pass']);
				$this->setIdGroup($row['id_group']);
				$this->setActive($row['active']);
				$this->setToken($row['token']);
				$this->setName($row['name']);
				$this->setLastname($row['lastname']);
				$this->setEmail($row['email']);
				$this->setIdProvider($row['id_provider']);

				return TRUE;
			}
			else
			{
				$this->addError(CUSER_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CUSER_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla user
	 *
	 * Este método realiza una consulta a la base de datos del tipo <b>"SELECT * FROM `tabla` WHERE id_tabla = '1'"</b>.
	 * Debe estar seteada la clave primaria del registro que se quiere obtener. Devuelve TRUE si se pudo obtener el registro en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ver también: {@link showData()}
	 * @return boolean
	 * @access public
	 */
	public function getDataByIdProvider()
	{
	    if (validateRequiredValue($this->idProvider) === TRUE)
	    {
	        $sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_provider').' = '.$this->getValueSql($this->idProvider);

	        $row = $this->getDbConn()->GetRow($sql);

	        if (is_array($row) === TRUE and count($row) > 0)
	        {
	            $this->setId($row['id']);
	            $this->setUser($row['user']);
	            $this->setPass($row['pass']);
	            $this->setIdGroup($row['id_group']);
	            $this->setActive($row['active']);
	            $this->setToken($row['token']);
	            $this->setName($row['name']);
	            $this->setLastname($row['lastname']);
	            $this->setEmail($row['email']);
	            $this->setIdProvider($row['id_provider']);

	            return TRUE;
	        }
	        else
	        {
	            $this->addError(CUSER_GETDATA_ERROR);

	            return FALSE;
	        }
	    }
	    else
	    {
	        $this->addError(CUSER_GETDATA_REQUIRED_PK);

	        return FALSE;
	    }
	}

	/**
	 * Obtiene un conjunto de registros de la tabla user
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
		$oIdGroup = new Cgroup();
		$oIdGroup->setDbConn($this->getDbConn());

		$oIdProvider = new Cprovider();
		$oIdProvider->setDbConn($this->getDbConn());

		$sql = 'SELECT ';
		$sql.= $this->getFieldSql('id', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('user', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('pass', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_group', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('active', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('token', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('name', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('lastname', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('email', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id_provider', $this->getTableName());
		$sql.= ', '.$this->getFieldSql('id', $oIdGroup->getTableName(), 'group_id');
		$sql.= ', '.$this->getFieldSql('name', $oIdGroup->getTableName(), 'group_name');
		$sql.= ', '.$this->getFieldSql('id', $oIdProvider->getTableName(), 'provider_id');
		$sql.= ', '.$this->getFieldSql('name', $oIdProvider->getTableName(), 'provider_name');
		$sql.= ', '.$this->getFieldSql('email', $oIdProvider->getTableName(), 'provider_email');
		$sql.= ', '.$this->getFieldSql('phone', $oIdProvider->getTableName(), 'provider_phone');
		$sql.= ' FROM '.$this->getTableSql();
		$sql.= ' LEFT JOIN '.$oIdGroup->getTableSql().' ON '.$this->getFieldSql('id_group', $this->getTableName()).' = '.$oIdGroup->getFieldSql('id', $oIdGroup->getTableName());
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
				$this->addError(CUSER_GETLIST_ERROR);

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
					$this->setUser($rs->fields['user']);
					$this->setPass($rs->fields['pass']);
					$this->setIdGroup($rs->fields['id_group']);
					$this->setActive($rs->fields['active']);
					$this->setToken($rs->fields['token']);
					$this->setName($rs->fields['name']);
					$this->setLastname($rs->fields['lastname']);
					$this->setEmail($rs->fields['email']);
					$this->setIdProvider($rs->fields['id_provider']);

					$oIdGroup->setName($rs->fields['group_name']);
					$oIdProvider->setName($rs->fields['provider_name']);

					$list[] = array(
						'id' => $this->getId($htmlEntities) ,
						'user' => $this->getUser($htmlEntities) ,
						'pass' => $this->getPass($htmlEntities) ,
						'idGroup' => $this->getIdGroup($htmlEntities) ,
						'active' => $this->getActive($htmlEntities) ,
						'token' => $this->getToken($htmlEntities) ,
						'name' => $this->getName($htmlEntities) ,
						'lastname' => $this->getLastname($htmlEntities) ,
						'email' => $this->getEmail($htmlEntities) ,
						'idProvider' => $this->getIdProvider($htmlEntities) ,
						'groupName' => $oIdGroup->getName($htmlEntities) ,
						'providerName' => $oIdProvider->getName($htmlEntities)
					);

					$rs->MoveNext();
				}

				$this->id = NULL;
				$this->user = NULL;
				$this->pass = NULL;
				$this->idGroup = NULL;
				$this->active = NULL;
				$this->token = NULL;
				$this->name = NULL;
				$this->lastname = NULL;
				$this->email = NULL;
				$this->idProvider = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CUSER_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}

	/**
	 * Verifica si ya existe en la tabla user el valor Usuario seteado
	 *
	 * Este método controla si ya existe en la tabla user un registro con el valor {@link $user Usuario} seteado.
	 * Si se está verificando la existencia del valor para un registro existente en la base de datos (se está modificando el registro), el parámetro $update debe ser TRUE y debe estar seteada la clave primaria del registro.
	 * Si no está seteado el valor {@link $user Usuario} el método devuelve FALSE.
	 *
	 * @param boolean $update [opcional] indica si el método se está llamando durante la actualización de un registro
	 * @return boolean
	 * @access public
	 */
	public function existUser($update = FALSE)
	{
		if (validateRequiredValue($this->user) === TRUE)
		{
			$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('user').' = '.$this->getValueSql($this->user);

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
					$this->addError(CUSER_EXIST_USER_EXIST);

					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				$this->addError(CUSER_EXIST_USER_ERROR);

				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Verifica si ya existe en la tabla user el valor Email seteado
	 *
	 * Este método controla si ya existe en la tabla user un registro con el valor {@link $email Email} seteado.
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
					$this->addError(CUSER_EXIST_EMAIL_EXIST);
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				$this->addError(CUSER_EXIST_EMAIL_ERROR);
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	/**
	 * Verifica si ya existe en la tabla user el valor Proveedor/Cliente seteado
	 *
	 * Este método controla si ya existe en la tabla user un registro con el valor {@link $idProvider Proveedor/Cliente} seteado.
	 * Si se está verificando la existencia del valor para un registro existente en la base de datos (se está modificando el registro), el parámetro $update debe ser TRUE y debe estar seteada la clave primaria del registro.
	 * Si no está seteado el valor {@link $idProvider Proveedor/Cliente} el método devuelve FALSE.
	 *
	 * @param boolean $update [opcional] indica si el método se está llamando durante la actualización de un registro
	 * @return boolean
	 * @access public
	 */
	public function existIdProvider($update = FALSE)
	{
		if (validateRequiredValue($this->idProvider) === TRUE)
		{
			$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_provider').' = '.$this->getValueSql($this->idProvider);
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
					$this->addError(CUSER_EXIST_ID_PROVIDER_EXIST);
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				$this->addError(CUSER_EXIST_ID_PROVIDER_ERROR);
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	/**
	 * Me dice si un registro de la tabla user puede ser eliminado
	 *
	 * Este método me dice si un registro de la tabla puede ser eliminado porque existe una relación de la misma con las siguientes tablas:
	 * - {@link Cmovement movement}
	 * - {@link Cproduct product}
	 *
	 * Si existe al menos un registro que tenga el valor de la clave primaria que se quiere eliminar en los siguientes campos:
	 * - campo {@link Cmovement::$idUserAdd idUserAdd} de la tabla {@link Cmovement movement}
	 * - campo {@link Cproduct::$idUserAdd idUserAdd} de la tabla {@link Cproduct product}
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
			$rsMovement = $oMovement->getList($oMovement->getFieldSql('id_user_add', $oMovement->getTableName()).' = '.$oMovement->getValueSql($this->id));

			$oProduct = new Cproduct();
			$oProduct->setDbConn($this->getDbConn());
			$rsProduct = $oProduct->getList($oProduct->getFieldSql('id_user_add', $oProduct->getTableName()).' = '.$oProduct->getValueSql($this->id));

			$oSale = new Csale();
			$oSale->setDbConn($this->getDbConn());
			$rsSale = $oSale->getList($oSale->getFieldSql('id_user_add', $oSale->getTableName()).' = '.$oSale->getValueSql($this->id));

			if ($rsMovement === FALSE or $rsProduct === FALSE or $rsSale === FALSE)
			{
				$this->addError(CUSER_CAN_DELETE_ERROR);

				return FALSE;
			}
			else
			{
				$return = TRUE;
				if($this->id == 1)
				{
				    $this->addError(CUSER_CAN_DELETE_ADMIN);
				    $return = FALSE;
				}

				if ($oMovement->getTotalList() > 0)
				{
					$this->addError(CUSER_CAN_DELETE_CANT_MOVEMENT);
					$return = FALSE;
				}

				if ($oProduct->getTotalList() > 0)
				{
					$this->addError(CUSER_CAN_DELETE_CANT_PRODUCT);
					$return = FALSE;
				}

				if ($oSale->getTotalList() > 0)
				{
					$this->addError(CUSER_CAN_DELETE_CANT_SALE);
					$return = FALSE;
				}

				return $return;
			}
		}
		else
		{
			$this->addError(CUSER_CAN_DELETE_REQUIRED_PK);
			return FALSE;
		}
	}
	/**
	 * Devuelve el último valor ID insertado en la tabla user
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
			$this->addError(CUSER_GET_LAST_ID_ERROR);

			return FALSE;
		}
		else
		{
			return $row['id'];
		}
	}

	/**
	 * Muestra un formulario para dar de alta un registro de la tabla user
	 *
	 * Este método muestra un formulario para dar de alta un registro de la tabla user mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,user,pass,idGroup,active,token,name,lastname,email,sendEmail,idProvider';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['addUser']) === FALSE)
		{
			$_POST['addUser'] = '';
		}

		if ($_POST['addUser'] == 'add')
		{
			if (in_array('user', $arrayFields) === TRUE)
			{
			    $this->setUser(strtolower(trim($_POST['user'])), TRUE);
			}
			if (in_array('pass', $arrayFields) === TRUE)
			{
			    $this->setPass(trim($_POST['pass']), TRUE);
			}
			if (in_array('idGroup', $arrayFields) === TRUE)
			{
				$this->setIdGroup($_POST['idGroup'], TRUE);
			}
			if (in_array('active', $arrayFields) === TRUE)
			{
			    $this->setActive($_POST['active'], TRUE);
			}
			if (in_array('token', $arrayFields) === TRUE)
			{
			    $this->setToken($_POST['token'], TRUE);
			}
			if (in_array('name', $arrayFields) === TRUE)
			{
			    $this->setName($_POST['name'], TRUE);
			}
			if (in_array('lastname', $arrayFields) === TRUE)
			{
			    $this->setLastname($_POST['lastname'], TRUE);
			}
			if (in_array('email', $arrayFields) === TRUE)
			{
				$this->setEmail($_POST['email'], TRUE);
			}
			if (in_array('idProvider', $arrayFields) === TRUE)
			{
				$this->setIdProvider($_POST['idProvider'], TRUE);
			}

			if (in_array('user', $arrayFields) === TRUE)
			{
				$this->existUser();
			}

			if (in_array('email', $arrayFields) === TRUE)
			{
				$this->existEmail();
			}

			if (in_array('idProvider', $arrayFields) === TRUE)
			{
			    $this->existIdProvider();
			}

			if ($this->error() === FALSE)
			{
			    if($this->add() === TRUE)
			    {
				//Verifico si tiene email y si está marcado el envío
				$aux = $this->getEmail(FALSE);

				if(empty($aux) == FALSE and empty($_POST['sendEmail']) == FALSE and $_POST['sendEmail'] == 'yes')
				{
				    $arrValues['userName']  = $this->getLastname().' '.$this->getName();
				    $arrValues['siteURL']   = ADMIN_URL;
				    $arrValues['siteName']  = ADMIN_CLIENT;
				    $arrValues['userUser']  = $this->getUser();
				    $arrValues['userPass']  = $this->getPass();

				    //Envío el email
				    $this->sendEmail($arrValues);
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
					<div class="message success"><?php echo CUSER_ADD_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CUSER_ADD_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="success" />
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
				<form name="formAddUser" id="formAddUser" method="post" action="">
				<input name="addUser" type="hidden" id="addUser" value="back" />
				<div class="fields">
				<?php
				if (in_array('user', $arrayFields) === TRUE)
				{
					echo '<input name="user" type="hidden" id="user" value="'.$this->getUser().'" />';
				}
				if (in_array('pass', $arrayFields) === TRUE)
				{
					echo '<input name="pass" type="hidden" id="pass" value="'.$this->getPass().'" />';
				}
				if (in_array('idGroup', $arrayFields) === TRUE)
				{
					echo '<input name="idGroup" type="hidden" id="idGroup" value="'.$this->getIdGroup().'" />';
				}
				if (in_array('active', $arrayFields) === TRUE)
				{
					echo '<input name="active" type="hidden" id="active" value="'.$this->getActive().'" />';
				}
				if (in_array('token', $arrayFields) === TRUE)
				{
					echo '<input name="token" type="hidden" id="token" value="'.$this->getToken().'" />';
				}
				if (in_array('name', $arrayFields) === TRUE)
				{
					echo '<input name="name" type="hidden" id="name" value="'.$this->getName().'" />';
				}
				if (in_array('lastname', $arrayFields) === TRUE)
				{
					echo '<input name="lastname" type="hidden" id="lastname" value="'.$this->getLastname().'" />';
				}
				if (in_array('email', $arrayFields) === TRUE)
				{
					echo '<input name="email" type="hidden" id="email" value="'.$this->getEmail().'" />';
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CUSER_ADD_FORM_BACK_BTN; ?>" class="back" />
				</div>
				</form>
				<div class="bottom"></div>
			</div>
			<?php
			}
		}
		else
		{
			if ($_POST['addUser'] == 'back')
			{
				if (in_array('user', $arrayFields) === TRUE)
				{
					$this->setUser($_POST['user'], TRUE);
				}
				if (in_array('pass', $arrayFields) === TRUE)
				{
					$this->setPass($_POST['pass'], TRUE);
				}
				if (in_array('idGroup', $arrayFields) === TRUE)
				{
					$this->setIdGroup($_POST['idGroup'], TRUE);
				}
				if (in_array('active', $arrayFields) === TRUE)
				{
					$this->setActive($_POST['active'], TRUE);
				}
				if (in_array('token', $arrayFields) === TRUE)
				{
					$this->setToken($_POST['token'], TRUE);
				}
				if (in_array('name', $arrayFields) === TRUE)
				{
					$this->setName($_POST['name'], TRUE);
				}
				if (in_array('lastname', $arrayFields) === TRUE)
				{
					$this->setLastname($_POST['lastname'], TRUE);
				}
				if (in_array('email', $arrayFields) === TRUE)
				{
					$this->setEmail($_POST['email'], TRUE);
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					$this->setIdProvider($_POST['idProvider'], TRUE);
				}
			}
			else
			{
			    $this->setIdGroup(2);
			    $this->setActive('yes');
			}
			?>
			<div class="form add">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<form name="formAddUser" id="formAddUser" method="post" action="">
				<input name="addUser" type="hidden" id="addUser" value="add" />
				<div class="fields">
			<?php
			foreach ($arrayFields as $value)
			{
				if ($value == 'user')
				{
				?>
					<div class="field">
						<label><?php echo CUSER_ADD_FORM_LABEL_FIELD_USER; ?> <span>*</span></label>
						<input name="user" type="text" id="user" value="<?php echo $this->getUser(); ?>" class="str" maxlength="100" />
					</div>
				<?php
				}
				if ($value == 'pass')
				{
				?>
					<div class="field">
						<label><?php echo CUSER_ADD_FORM_LABEL_FIELD_PASS; ?> <span>*</span></label>
						<input name="pass" type="text" id="pass" value="<?php echo $this->getPass(); ?>" class="str" maxlength="100" /> <a href="#" onclick="generatePassword('pass')">Generar</a>
					</div>
				<?php
				}
				if ($value == 'idGroup')
				{
				?>
					<div class="field">
						<label><?php echo CUSER_ADD_FORM_LABEL_FIELD_ID_GROUP; ?> <span>*</span></label>
					<?php
					$oIdGroup = new Cgroup();
					$oIdGroup->setDbConn($this->getDbConn());
					$oIdGroup->showList('name', 'name', $this->getIdGroup(), 'idGroup', 'idGroup', 'select');
					?>
					</div>
				<?php
				}
				if ($value == 'active')
				{
				?>
					<div class="field">
						<label><?php echo CUSER_ADD_FORM_LABEL_FIELD_ACTIVE; ?> <span>*</span></label>
						<select name="active" id="active">
							<option value=""></option>
							<option value="yes" <?php if ($this->getActive() == 'yes') echo 'selected="selected"' ?>><?php echo $this->getValuesActive('yes'); ?></option>
							<option value="no" <?php if ($this->getActive() == 'no') echo 'selected="selected"' ?>><?php echo $this->getValuesActive('no'); ?></option>
						</select>
					</div>
				<?php
				}
				if ($value == 'token')
				{
				?>
					<div class="field">
						<label><?php echo CUSER_ADD_FORM_LABEL_FIELD_TOKEN; ?></label>
						<input name="token" type="text" id="token" value="<?php echo $this->getToken(); ?>" class="str" maxlength="100" />
					</div>
				<?php
				}
				if ($value == 'name')
				{
				?>
					<div class="field">
						<label><?php echo CUSER_ADD_FORM_LABEL_FIELD_NAME; ?> <span>*</span></label>
						<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" maxlength="100" />
					</div>
				<?php
				}
				if ($value == 'lastname')
				{
				?>
					<div class="field">
						<label><?php echo CUSER_ADD_FORM_LABEL_FIELD_LASTNAME; ?> <span>*</span></label>
						<input name="lastname" type="text" id="lastname" value="<?php echo $this->getLastname(); ?>" class="str" maxlength="100" />
					</div>
				<?php
				}


				if ($value == 'email')
				{
				?>
					<div class="field">
						<label><?php echo CUSER_ADD_FORM_LABEL_FIELD_EMAIL; ?> <span>*</span></label>
						<input name="email" type="text" id="email" value="<?php echo $this->getEmail(); ?>" class="str" maxlength="255" />
					</div>
				<?php
				}
				if ($value == 'idProvider')
				{
				    $auxProviderName	= '';
				    $auxStyle		= ' style="display: none;"';
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
				    ?>
					<div class="field autocompleteWrapper">
						<label><?php echo CUSER_ADD_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
						<input name="idProviderAutocomplete" id="idProviderAutocomplete" value="<?php echo $auxProviderName; ?>" class="str autocomplete" maxlength="255" type="text" />
						<input name="idProvider" id="idProvider" value="<?php echo $this->getIdProvider(FALSE); ?>" type="hidden" />
					</div>
				<?php
				}
				if ($value == 'sendEmail')
				{
				?>
					<div class="field">
						<label></label>
						<input name="sendEmail" type="checkbox" id="sendEmail" value="yes" checked="checked" /><small><?php echo CUSER_ADD_FORM_LABEL_FIELD_SENDEMAIL; ?></small>
					</div>
				<?php
				}
			}
			?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CUSER_ADD_FORM_SUBMIT_BTN; ?>" class="accept" />
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CUSER_ADD_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
			<?php
			}
			?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CUSER_ADD_FORM_LABEL_REQUIRED; ?></span>
			</div>
		<?php
		}
	}

	/**
	 * Muestra un formulario para actualizar un registro existente de la tabla user
	 *
	 * Este método muestra un formulario para actualizar un registro de la tabla user mostrando sólo los campos seteados en el parámetro $fields.
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
			$fields = 'id,user,pass,idGroup,active,token,name,lastname,email,sendEmail,idProvider';
		}

		$arrayFields = explode(',', $fields);
		foreach ($arrayFields as $key => $value)
		{
			$arrayFields[$key] = trim($value);
		}

		if (isset($_POST['updateUser']) === FALSE)
		{
			$_POST['updateUser'] = '';
		}

		if (isset($_GET['p']) === FALSE)
		{
			$_GET['p'] = '';
		}

		if ($_POST['updateUser'] == 'update')
		{
			$this->setId($_POST['id'], TRUE);
			if (in_array('user', $arrayFields) === TRUE)
			{
			    $this->setUser(strtolower(trim($_POST['user'])), TRUE);
			}
			if (in_array('pass', $arrayFields) === TRUE)
			{
			    //Si deja vacío el password no se modifica.
			    if(empty($_POST['pass']) == FALSE)
			    {
			        $this->setPass(trim($_POST['pass']), TRUE);
			    }
			}
			if (in_array('idGroup', $arrayFields) === TRUE)
			{
				$this->setIdGroup($_POST['idGroup'], TRUE);
			}
			if (in_array('active', $arrayFields) === TRUE)
			{
				$this->setActive($_POST['active'], TRUE);
			}
			if (in_array('token', $arrayFields) === TRUE)
			{
				$this->setToken($_POST['token'], TRUE);
			}
			if (in_array('name', $arrayFields) === TRUE)
			{
				$this->setName($_POST['name'], TRUE);
			}
			if (in_array('lastname', $arrayFields) === TRUE)
			{
				$this->setLastname($_POST['lastname'], TRUE);
			}
			if (in_array('email', $arrayFields) === TRUE)
			{
				$this->setEmail($_POST['email'], TRUE);
			}
			if (in_array('idProvider', $arrayFields) === TRUE)
			{
				$this->setIdProvider($_POST['idProvider'], TRUE);
			}
			//Si está por enviar los datos de acceso, debe teenr sí o sí la contraseña ya que se guarda encriptada.
			if(empty($_POST['sendEmail']) == FALSE and $_POST['sendEmail'] == 'yes' and empty($_POST['pass']) == TRUE)
			{
			    $this->addError(CUSER_UPDATE_FORM_SET_PASSWORD);
			}

			if (in_array('user', $arrayFields) === TRUE)
			{
				$this->existUser(TRUE);
			}

			if (in_array('email', $arrayFields) === TRUE)
			{
				$this->existEmail(TRUE);
			}

			if (in_array('idProvider', $arrayFields) === TRUE)
			{
				$this->existIdProvider(TRUE);
			}

			if ($this->error() === FALSE)
			{
				if($this->update() == TRUE)
				{
				    //Verifico si tiene email, si está marcado el envío y si ingresó un nuevo password
				    $aux = $this->getEmail(FALSE);

				    if(empty($aux) == FALSE and empty($_POST['sendEmail']) == FALSE and $_POST['sendEmail'] == 'yes' and empty($_POST['pass']) == FALSE)
				    {
    					$arrValues['userName']  = $this->getLastname().' '.$this->getName();
    					$arrValues['siteURL']   = ADMIN_URL;
    					$arrValues['siteName']  = ADMIN_CLIENT;
    					$arrValues['userUser']  = $this->getUser();
    					$arrValues['userPass']  = $this->getPass();

    					//Envío el email
    					$this->sendEmail($arrValues);
				    }
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
					<div class="message success"><?php echo CUSER_UPDATE_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CUSER_UPDATE_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
				<form name="formUpdateUser" id="formUpdateUser" method="post" action="">
				<input name="updateUser" type="hidden" id="updateUser" value="back" />
				<div class="fields">
				<?php
				if (in_array('user', $arrayFields) === TRUE)
				{
					echo '<input name="user" type="hidden" id="user" value="'.$this->getUser().'" />';
				}
				if (in_array('pass', $arrayFields) === TRUE)
				{
					echo '<input name="pass" type="hidden" id="pass" value="'.$this->getPass().'" />';
				}
				if (in_array('idGroup', $arrayFields) === TRUE)
				{
					echo '<input name="idGroup" type="hidden" id="idGroup" value="'.$this->getIdGroup().'" />';
				}
				if (in_array('active', $arrayFields) === TRUE)
				{
					echo '<input name="active" type="hidden" id="active" value="'.$this->getActive().'" />';
				}
				if (in_array('token', $arrayFields) === TRUE)
				{
					echo '<input name="token" type="hidden" id="token" value="'.$this->getToken().'" />';
				}
				if (in_array('name', $arrayFields) === TRUE)
				{
					echo '<input name="name" type="hidden" id="name" value="'.$this->getName().'" />';
				}
				if (in_array('lastname', $arrayFields) === TRUE)
				{
					echo '<input name="lastname" type="hidden" id="lastname" value="'.$this->getLastname().'" />';
				}
				if (in_array('email', $arrayFields) === TRUE)
				{
					echo '<input name="email" type="hidden" id="email" value="'.$this->getEmail().'" />';
				}
				if (in_array('idProvider', $arrayFields) === TRUE)
				{
					echo '<input name="idProvider" type="hidden" id="idProvider" value="'.$this->getIdProvider().'" />';
				}
				?>
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CUSER_UPDATE_FORM_BACK_BTN; ?>" class="back" />
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
				if ($_POST['updateUser'] == 'back')
				{
					if (in_array('user', $arrayFields) === TRUE)
					{
						$this->setUser($_POST['user'], TRUE);
					}
					if (in_array('pass', $arrayFields) === TRUE)
					{
						$this->setPass($_POST['pass'], TRUE);
					}
					if (in_array('idGroup', $arrayFields) === TRUE)
					{
						$this->setIdGroup($_POST['idGroup'], TRUE);
					}
					if (in_array('active', $arrayFields) === TRUE)
					{
						$this->setActive($_POST['active'], TRUE);
					}
					if (in_array('token', $arrayFields) === TRUE)
					{
						$this->setToken($_POST['token'], TRUE);
					}
					if (in_array('name', $arrayFields) === TRUE)
					{
						$this->setName($_POST['name'], TRUE);
					}
					if (in_array('lastname', $arrayFields) === TRUE)
					{
						$this->setLastname($_POST['lastname'], TRUE);
					}
					if (in_array('email', $arrayFields) === TRUE)
					{
						$this->setEmail($_POST['email'], TRUE);
					}
					if (in_array('idProvider', $arrayFields) === TRUE)
					{
						$this->setIdProvider($_POST['idProvider'], TRUE);
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
				<form name="formUpdateUser" id="formUpdateUser" method="post" action="">
				<input name="updateUser" type="hidden" id="updateUser" value="update" />
				<input name="id" type="hidden" id="id" value="<?php echo $this->getId(); ?>" />
				<div class="fields">
				<?php
				foreach ($arrayFields as $value)
				{
					if ($value == 'id')
					{
					?>
					<div class="field">
						<label><?php echo CUSER_UPDATE_FORM_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
					<?php
					}
					if ($value == 'user')
					{
					?>
					<div class="field">
						<label><?php echo CUSER_UPDATE_FORM_LABEL_FIELD_USER; ?> <span>*</span></label>
						<input name="user" type="text" id="user" value="<?php echo $this->getUser(); ?>" class="str" maxlength="100" />
					</div>
					<?php
					}
					if ($value == 'pass')
					{
					?>
					<div class="field">
						<label><?php echo CUSER_UPDATE_FORM_LABEL_FIELD_PASS; ?></label>
						<input name="pass" type="text" id="pass" value="" class="str" maxlength="100" title="Dejar vacío si no se desea cambiar."/> <a href="#" onclick="generatePassword('pass')">Generar</a>
					</div>
					<?php
					}
					if ($value == 'idGroup')
					{
					?>
					<div class="field">
						<label><?php echo CUSER_UPDATE_FORM_LABEL_FIELD_ID_GROUP; ?> <span>*</span></label>
						<?php
						$oIdGroup = new Cgroup();
						$oIdGroup->setDbConn($this->getDbConn());
						$oIdGroup->showList('name', 'name', $this->getIdGroup(), 'idGroup', 'idGroup', 'select');
						?>
					</div>
					<?php
					}
					if ($value == 'active')
					{
					?>
					<div class="field">
						<label><?php echo CUSER_UPDATE_FORM_LABEL_FIELD_ACTIVE; ?> <span>*</span></label>
						<select name="active" id="active">
							<option value=""></option>
							<option value="yes" <?php if ($this->getActive() == 'yes') echo 'selected="selected"' ?>><?php echo $this->getValuesActive('yes'); ?></option>
							<option value="no" <?php if ($this->getActive() == 'no') echo 'selected="selected"' ?>><?php echo $this->getValuesActive('no'); ?></option>
						</select>
					</div>
					<?php
					}
					if ($value == 'token')
					{
					?>
					<div class="field">
						<label><?php echo CUSER_UPDATE_FORM_LABEL_FIELD_TOKEN; ?></label>
						<input name="token" type="text" id="token" value="<?php echo $this->getToken(); ?>" class="str" maxlength="100" />
					</div>
					<?php
					}
					if ($value == 'name')
					{
					?>
					<div class="field">
						<label><?php echo CUSER_UPDATE_FORM_LABEL_FIELD_NAME; ?> <span>*</span></label>
						<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" maxlength="100" />
					</div>
					<?php
					}
					if ($value == 'lastname')
					{
					?>
					<div class="field">
						<label><?php echo CUSER_UPDATE_FORM_LABEL_FIELD_LASTNAME; ?> <span>*</span></label>
						<input name="lastname" type="text" id="lastname" value="<?php echo $this->getLastname(); ?>" class="str" maxlength="100" />
					</div>
					<?php
					}

					if ($value == 'email')
					{
					?>
					<div class="field">
						<label><?php echo CUSER_UPDATE_FORM_LABEL_FIELD_EMAIL; ?> <span>*</span></label>
						<input name="email" type="text" id="email" value="<?php echo $this->getEmail(); ?>" class="str" maxlength="255" />
					</div>
					<?php
					}
					if ($value == 'idProvider')
					{
					    $auxProviderName	= '';
					    $auxStyle		= ' style="display: none;"';
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
					?>
					<div class="field autocompleteWrapper">
						<label><?php echo CUSER_UPDATE_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
						<input name="idProviderAutocomplete" id="idProviderAutocomplete" value="<?php echo $auxProviderName; ?>" class="str autocomplete" maxlength="255" type="text" />
						<input name="idProvider" id="idProvider" value="<?php echo $this->getIdProvider(FALSE); ?>" type="hidden" />
					</div>
					<?php
					}
					if ($value == 'sendEmail')
					{
					?>
						<div class="field">
							<label></label>
							<input name="sendEmail" type="checkbox" id="sendEmail" value="yes" /><small><?php echo CUSER_ADD_FORM_LABEL_FIELD_SENDEMAIL; ?></small>
						</div>
					<?php
					}
				}
				?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CUSER_UPDATE_FORM_SUBMIT_BTN; ?>" class="accept" />
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CUSER_UPDATE_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="cancel" />
				<?php
				}
				?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CUSER_UPDATE_FORM_LABEL_REQUIRED; ?></span>
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
					<input type="button" value="<?php echo CUSER_UPDATE_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
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
	 * Elimina un registro existente de la tabla user y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un registro de la tabla user y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
					<div class="message success"><?php echo CUSER_DEL_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CUSER_DEL_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="success" />
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
					<input type="button" value="<?php echo CUSER_DEL_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
				</div>
		<?php
		}
		?>
				<div class="bottom"></div>
			</div>
		<?php
	}

	/**
	 * Elimina un grupo de registros existente de la tabla user y muestra el resultado obtenido
	 *
	 * Este método intenta eliminar un grupo de registros de la tabla user y muestra el resultado obtenido, redireccionando o no a la página correspondiente de acuerdo a los parámetros seteados.
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
			    if ($this->setId($value, TRUE) === TRUE and $value != 1)
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
				if ($value == 1)
				{
				    $this->addError(CUSER_DEL_GROUP_FORM_ADMIN);
				}
				$flagGroup = TRUE;
			    }
			}
		}
		else
		{
			$this->addError(CUSER_DEL_GROUP_FORM_REQUIRED_PK);
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
					<div class="message success"><?php echo CUSER_DEL_GROUP_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
			<?php
			if (validateRequiredValue($href) === TRUE)
			{
			?>
					<input type="button" value="<?php echo CUSER_DEL_GROUP_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="success" />
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
				$this->addError(CUSER_DEL_GROUP_FORM_CANT_DELETE_ALL);
			}
			?>
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="button" value="<?php echo CUSER_DEL_GROUP_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_POST['p'] != '' ? '?p='.$_POST['p'] : ''); ?>'" class="back" />
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
			$fields = 'id,user,pass,idGroup,active,token,name,lastname,email,idProvider';
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
						<label><?php echo CUSER_SHOW_DATA_LABEL_FIELD_ID; ?></label>
						<strong class="pk"><?php echo $this->getId(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'user')
			{
			?>
					<div class="field">
						<label><?php echo CUSER_SHOW_DATA_LABEL_FIELD_USER; ?></label>
						<strong><?php echo $this->getUser(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'pass')
			{
			?>
					<div class="field">
						<label><?php echo CUSER_SHOW_DATA_LABEL_FIELD_PASS; ?></label>
						<strong><?php echo $this->getPass(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idGroup')
			{
			?>
					<div class="field">
						<label><?php echo CUSER_SHOW_DATA_LABEL_FIELD_ID_GROUP; ?></label>
				<?php
				$oIdGroup = new Cgroup();
				$oIdGroup->setDbConn($this->getDbConn());
				$oIdGroup->setId($this->getIdGroup(FALSE));
				$oIdGroup->getData();
				?>
						<strong><?php echo $oIdGroup->getName(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'active')
			{
			?>
					<div class="field">
						<label><?php echo CUSER_SHOW_DATA_LABEL_FIELD_ACTIVE; ?></label>
						<strong><?php echo $this->getValuesActive($this->getActive()); ?></strong>
					</div>
			<?php
			}
			if ($value == 'token')
			{
			?>
					<div class="field">
						<label><?php echo CUSER_SHOW_DATA_LABEL_FIELD_TOKEN; ?></label>
						<strong><?php echo $this->getToken(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'name')
			{
			?>
					<div class="field">
						<label><?php echo CUSER_SHOW_DATA_LABEL_FIELD_NAME; ?></label>
						<strong><?php echo $this->getName(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'lastname')
			{
			?>
					<div class="field">
						<label><?php echo CUSER_SHOW_DATA_LABEL_FIELD_LASTNAME; ?></label>
						<strong><?php echo $this->getLastname(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'email')
			{
			?>
					<div class="field">
						<label><?php echo CUSER_SHOW_DATA_LABEL_FIELD_EMAIL; ?></label>
						<strong><?php echo $this->getEmail(); ?></strong>
					</div>
			<?php
			}
			if ($value == 'idProvider')
			{
			?>
					<div class="field">
						<label><?php echo CUSER_SHOW_DATA_LABEL_FIELD_ID_PROVIDER; ?></label>
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
		}
		?>
				</div>
				<div class="middle"></div>
				<div class="buttons">
		<?php
		if (validateRequiredValue($href) === TRUE)
		{
		?>
					<input type="button" value="<?php echo CUSER_SHOW_DATA_BACK_BTN; ?>" onclick="location.href='<?php echo $href.($_GET['p'] != '' ? '?p='.$_GET['p'] : ''); ?>'" class="back" />
		<?php
		}
		?>
				</div>
				<div class="bottom"></div>
			</div>
	<?php
	}

	/**
	 * Muestra un formulario de búsqueda de registros de la tabla user
	 *
	 * Este método muestra un formulario con los campos seteados en el parámetro $fields para realizar una búsqueda de los registros de la tabla user.
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
			$fields = 'id,user,pass,idGroup,active,token,name,lastname,email,idProvider';
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
			if (isset($_SESSION['main_tr_search_user']) === FALSE)
			{
				$_SESSION['main_tr_search_user'] = '';
			}

			$display  = 'display: none;';
			$btnClass = 'closed';
			if ($_SESSION['main_tr_search_user'] === 'open')
			{
				$display  = '';
				$btnClass = 'open';
			}
		}
		?>
				<div class="title">
					<div class="ico"><?php if ($showHideBtn === TRUE) { ?><a href="#" onclick="showHideSearch('user'); return false;" class="<?php echo $btnClass; ?>"></a><?php } ?></div>
					<div class="label"><a href="#" onclick="showHideSearch('user'); return false;"><?php echo $title; ?></a></div>
				</div>
				<div id="container_search_user" style="<?php echo $display; ?>">
					<div class="top"></div>
					<form name="formSearchUser" id="formSearchUser" method="<?php echo $method; ?>" action="">
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
							<label><?php echo CUSER_SEARCH_FORM_LABEL_FIELD_ID; ?></label>
							<input name="id" type="text" id="id" value="<?php echo $this->getId(); ?>" class="num" />
						</div>
				<?php
				if (validateRequiredValue($this->getId()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id', $this->getTableName()).' = '.$this->getValueSql($this->id);
					$params[] = 'id='.urlencode($this->id);
				}
			}

			if ($value == 'user')
			{
			    $this->setUser($values['user'], TRUE);
			    ?>
					    <div class="field">
						    <label><?php echo CUSER_SEARCH_FORM_LABEL_FIELD_USER; ?></label>
						    <input name="user" type="text" id="user" value="<?php echo $this->getUser(); ?>" class="str" />
					    </div>
			    <?php
			    if (validateRequiredValue($this->getUser()) === TRUE)
			    {
				    $condition[] = $this->getFieldSql('user', $this->getTableName()).' LIKE '.$this->getValueSql($this->user, '%%');
				    $params[] = 'user='.urlencode($this->user);
			    }
			}

			if ($value == 'pass')
			{
				$this->setPass($values['pass'], TRUE);
				?>
						<div class="field">
							<label><?php echo CUSER_SEARCH_FORM_LABEL_FIELD_PASS; ?></label>
							<input name="pass" type="text" id="pass" value="<?php echo $this->getPass(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getPass()) === TRUE)
				{
					$condition[] = $this->getFieldSql('pass', $this->getTableName()).' LIKE '.$this->getValueSql($this->pass, '%%');
					$params[] = 'pass='.urlencode($this->pass);
				}
			}

			if ($value == 'idGroup')
			{
				$this->setIdGroup($values['idGroup'], TRUE);
				?>
						<div class="field">
							<label><?php echo CUSER_SEARCH_FORM_LABEL_FIELD_ID_GROUP; ?></label>
				<?php
				$oIdGroup = new Cgroup();
				$oIdGroup->setDbConn($this->getDbConn());
				$oIdGroup->showList('name', 'name', $this->getIdGroup(), 'idGroup', 'idGroup', 'select_search');
				?>
						</div>
				<?php
				if (validateRequiredValue($this->getIdGroup()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_group', $this->getTableName()).' = '.$this->getValueSql($this->idGroup);
					$params[] = 'idGroup='.urlencode($this->idGroup);
				}
			}

			if ($value == 'active')
			{
				$this->setActive($values['active'], TRUE);
				?>
						<div class="field">
							<label><?php echo CUSER_SEARCH_FORM_LABEL_FIELD_ACTIVE; ?></label>
							<select name="active" id="active">
								<option value=""></option>
								<option value="yes" <?php if ($this->getActive() == 'yes') echo 'selected="selected"' ?>><?php echo $this->getValuesActive('yes'); ?></option>
								<option value="no" <?php if ($this->getActive() == 'no') echo 'selected="selected"' ?>><?php echo $this->getValuesActive('no'); ?></option>
							</select>
						</div>
				<?php
				if (validateRequiredValue($this->getActive()) === TRUE)
				{
					$condition[] = $this->getFieldSql('active', $this->getTableName()).' = '.$this->getValueSql($this->active);
					$params[] = 'active='.urlencode($this->active);
				}
			}
			if ($value == 'token')
			{
				$this->setToken($values['token'], TRUE);
				?>
						<div class="field">
							<label><?php echo CUSER_SEARCH_FORM_LABEL_FIELD_TOKEN; ?></label>
							<input name="token" type="text" id="token" value="<?php echo $this->getToken(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getToken()) === TRUE)
				{
					$condition[] = $this->getFieldSql('token', $this->getTableName()).' LIKE '.$this->getValueSql($this->token, '%%');
					$params[] = 'token='.urlencode($this->token);
				}
			}
			if ($value == 'name')
			{
				$this->setName($values['name'], TRUE);
				?>
						<div class="field">
							<label><?php echo CUSER_SEARCH_FORM_LABEL_FIELD_NAME; ?></label>
							<input name="name" type="text" id="name" value="<?php echo $this->getName(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getName()) === TRUE)
				{
					$condition[] = $this->getFieldSql('name', $this->getTableName()).' LIKE '.$this->getValueSql($this->name, '%%');
					$params[] = 'name='.urlencode($this->name);
				}
			}
			if ($value == 'lastname')
			{
				$this->setLastname($values['lastname'], TRUE);
				?>
						<div class="field">
							<label><?php echo CUSER_SEARCH_FORM_LABEL_FIELD_LASTNAME; ?></label>
							<input name="lastname" type="text" id="lastname" value="<?php echo $this->getLastname(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getLastname()) === TRUE)
				{
					$condition[] = $this->getFieldSql('lastname', $this->getTableName()).' LIKE '.$this->getValueSql($this->lastname, '%%');
					$params[] = 'lastname='.urlencode($this->lastname);
				}
			}



			if ($value == 'email')
			{
				$this->setEmail($values['email'], TRUE);
				?>
						<div class="field">
							<label><?php echo CUSER_SEARCH_FORM_LABEL_FIELD_EMAIL; ?></label>
							<input name="email" type="text" id="email" value="<?php echo $this->getEmail(); ?>" class="str" />
						</div>
				<?php
				if (validateRequiredValue($this->getEmail()) === TRUE)
				{
					$condition[] = $this->getFieldSql('email', $this->getTableName()).' LIKE '.$this->getValueSql($this->email, '%%');
					$params[] = 'email='.urlencode($this->email);
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
					<label><?php echo CUSER_SEARCH_FORM_LABEL_FIELD_ID_PROVIDER; ?></label>
					<input name="idProviderAutocomplete" id="idProviderAutocomplete" value="<?php echo $auxProviderName; ?>" class="str autocomplete" maxlength="255" type="text" />
					<input name="idProvider" id="idProvider" value="<?php echo $this->getIdProvider(); ?>" type="hidden" />
				</div>
				<?php
				if (validateRequiredValue($this->getIdProvider()) === TRUE)
				{
					$condition[] = $this->getFieldSql('id_provider', $this->getTableName()).' = '.$this->getValueSql($this->idProvider);
					$params[] = 'idProvider='.urlencode($this->idProvider);
				}
			}
		}
		?>
					</div>
					<div class="middle"></div>
					<div class="buttons">
						<input type="submit" value="<?php echo CUSER_SEARCH_FORM_SUBMIT_BTN; ?>" class="search" />
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
	 * Muestra el resultado de una consulta a la tabla user
	 *
	 * Este método muestra un conjunto de registros que son el resultado de una consulta a la tabla user. Muestra sólo los campos seteados en el parámetro $fields.
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
	 * Nota: Los registros seleccionados se envían al archivo seteado por medio del método post en la siguiente variable: <b>$_POST['userGroup'] (array)</b>
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
			$fields[1]['field'] = 'user';
			$fields[2]['field'] = 'pass';
			$fields[3]['field'] = 'idGroup';
			$fields[4]['field'] = 'active';
			$fields[5]['field'] = 'token';
			$fields[6]['field'] = 'name';
			$fields[7]['field'] = 'lastname';
			$fields[8]['field'] = 'email';
			$fields[9]['field'] = 'idProvider';
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
			$arrayOrder = array('id', 'user', 'pass', 'id_group', 'active', 'token', 'name', 'lastname', 'email', 'id_provider');
			array_push($arrayOrder, 'group_name', 'provider_name');

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

				$head.= '<div class="col" style="width: '.$arrayWidth['id'].';"><div class="num"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CUSER_SHOW_QUERY_HEAD_FIELD_ID).'</a></div></div>';
				$headers['id'] = '<div class="num"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_ID, $arrayStrLen['id']), CUSER_SHOW_QUERY_HEAD_FIELD_ID).'</a></div>';
			}

			if ($value == 'user')
			{
				if ($_GET['orderby'] == 'user')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=user&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=user&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=user&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['user'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_USER, $arrayStrLen['user']), CUSER_SHOW_QUERY_HEAD_FIELD_USER).'</a></div></div>';
				$headers['user'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_USER, $arrayStrLen['user']), CUSER_SHOW_QUERY_HEAD_FIELD_USER).'</a></div>';
			}

			if ($value == 'pass')
			{
				if ($_GET['orderby'] == 'pass')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=pass&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=pass&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=pass&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['pass'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_PASS, $arrayStrLen['pass']), CUSER_SHOW_QUERY_HEAD_FIELD_PASS).'</a></div></div>';
				$headers['pass'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_PASS, $arrayStrLen['pass']), CUSER_SHOW_QUERY_HEAD_FIELD_PASS).'</a></div>';
			}

			if ($value == 'idGroup')
			{
				if ($_GET['orderby'] == 'group_name')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=group_name&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=group_name&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=group_name&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['idGroup'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_ID_GROUP, $arrayStrLen['idGroup']), CUSER_SHOW_QUERY_HEAD_FIELD_ID_GROUP).'</a></div></div>';
				$headers['idGroup'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_ID_GROUP, $arrayStrLen['idGroup']), CUSER_SHOW_QUERY_HEAD_FIELD_ID_GROUP).'</a></div>';
			}

			if ($value == 'active')
			{
				if ($_GET['orderby'] == 'active')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=active&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=active&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=active&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}

				$head.= '<div class="col" style="width: '.$arrayWidth['active'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_ACTIVE, $arrayStrLen['active']), CUSER_SHOW_QUERY_HEAD_FIELD_ACTIVE).'</a></div></div>';
				$headers['active'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_ACTIVE, $arrayStrLen['active']), CUSER_SHOW_QUERY_HEAD_FIELD_ACTIVE).'</a></div>';
			}
			if ($value == 'token')
			{
				if ($_GET['orderby'] == 'token')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=token&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=token&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=token&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}
				$head.= '<div class="col" style="width: '.$arrayWidth['token'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_TOKEN, $arrayStrLen['token']), CUSER_SHOW_QUERY_HEAD_FIELD_TOKEN).'</a></div></div>';
				$headers['token'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_TOKEN, $arrayStrLen['token']), CUSER_SHOW_QUERY_HEAD_FIELD_TOKEN).'</a></div>';
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
				$head.= '<div class="col" style="width: '.$arrayWidth['name'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_NAME, $arrayStrLen['name']), CUSER_SHOW_QUERY_HEAD_FIELD_NAME).'</a></div></div>';
				$headers['name'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_NAME, $arrayStrLen['name']), CUSER_SHOW_QUERY_HEAD_FIELD_NAME).'</a></div>';
			}
			if ($value == 'lastname')
			{
				if ($_GET['orderby'] == 'lastname')
				{
					if ($_GET['ascdesc'] == 'ASC')
					{
						$href = '?orderby=lastname&ascdesc=DESC';
					}
					else
					{
						$href = '?orderby=lastname&ascdesc=ASC';
					}
				}
				else
				{
					$href = '?orderby=lastname&ascdesc=ASC';
				}
				if ($this->getParams() != '')
				{
					$href.= '&'.$this->getParams();
				}
				$head.= '<div class="col" style="width: '.$arrayWidth['lastname'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_LASTNAME, $arrayStrLen['lastname']), CUSER_SHOW_QUERY_HEAD_FIELD_LASTNAME).'</a></div></div>';
				$headers['lastname'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_LASTNAME, $arrayStrLen['lastname']), CUSER_SHOW_QUERY_HEAD_FIELD_LASTNAME).'</a></div>';
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
				$head.= '<div class="col" style="width: '.$arrayWidth['email'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_EMAIL, $arrayStrLen['email']), CUSER_SHOW_QUERY_HEAD_FIELD_EMAIL).'</a></div></div>';
				$headers['email'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_EMAIL, $arrayStrLen['email']), CUSER_SHOW_QUERY_HEAD_FIELD_EMAIL).'</a></div>';
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
				$head.= '<div class="col" style="width: '.$arrayWidth['idProvider'].';"><div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CUSER_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div></div>';
				$headers['idProvider'] = '<div class="str"><a href="'.$href.'">'.altText(getCutString(CUSER_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER, $arrayStrLen['idProvider']), CUSER_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER).'</a></div>';
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
				<form name="formQueryUser" id="formQueryUser" method="post" action="">
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
				<div class="message warning"><?php echo CUSER_SHOW_QUERY_NOT_FOUND; ?></div>
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
					<div class="row row<?php echo $class; ?>" id="user_tr_<?php echo $row['id']; ?>" data-table-name="user" data-id="<?php echo $row['id']; ?>" data-form-id="formQueryUser">
				<?php
				if (is_array($groupActions) === TRUE)
				{
				    $disabled = '';
				    if($row['id'] == 1)
				    {
					$disabled = ' disabled="disabled"';
				    }
				    ?>
				    <div class="col header"></div>
				    <div class="col" style="width: <?php echo $widthGroupActions; ?>;"><div class="group-actions"><input name="userGroup[]" type="checkbox" id="cb_user_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="checkboxClick(this)" <?php echo $disabled; ?>/></div></div>
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

					if ($value == 'user')
					{
					?>
						<div class="col header"><?php echo $headers['user']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['user']; ?>;"><div class="str"><?php echo altText(getCutString($row['user'], $arrayStrLen['user']), $row['user']); ?></div></div>
					<?php
					}

					if ($value == 'pass')
					{
					?>
						<div class="col header"><?php echo $headers['pass']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['pass']; ?>;"><div class="str"><?php echo altText(getCutString($row['pass'], $arrayStrLen['pass']), $row['pass']); ?></div></div>
					<?php
					}

					if ($value == 'idGroup')
					{
					?>
						<div class="col header"><?php echo $headers['idGroup']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idGroup']; ?>;"><div class="str"><?php echo altText(getCutString($row['groupName'], $arrayStrLen['idGroup']), $row['groupName']); ?></div></div>
					<?php
					}

					if ($value == 'active')
					{
					?>
						<div class="col header"><?php echo $headers['active']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['active']; ?>;"><div class="str"><?php echo altText(getCutString($this->getValuesActive($row['active']), $arrayStrLen['active']), $this->getValuesActive($row['active'])); ?></div></div>
					<?php
					}
					if ($value == 'token')
					{
					?>
						<div class="col header"><?php echo $headers['token']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['token']; ?>;"><div class="str"><?php echo altText(getCutString($row['token'], $arrayStrLen['token']), $row['token']); ?></div></div>
					<?php
					}
					if ($value == 'name')
					{
					?>
						<div class="col header"><?php echo $headers['name']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['name']; ?>;"><div class="str"><?php echo altText(getCutString($row['name'], $arrayStrLen['name']), $row['name']); ?></div></div>
					<?php
					}
					if ($value == 'lastname')
					{
					?>
						<div class="col header"><?php echo $headers['lastname']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['lastname']; ?>;"><div class="str"><?php echo altText(getCutString($row['lastname'], $arrayStrLen['lastname']), $row['lastname']); ?></div></div>
					<?php
					}

					if ($value == 'email')
					{
					?>
						<div class="col header"><?php echo $headers['email']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['email']; ?>;"><div class="str"><?php echo altText(getCutString($row['email'], $arrayStrLen['email']), $row['email']); ?></div></div>
					<?php
					}
					if ($value == 'idProvider')
					{
					?>
						<div class="col header"><?php echo $headers['idProvider']; ?></div>
						<div class="col" style="width: <?php echo $arrayWidth['idProvider']; ?>;"><div class="str"><?php echo altText(getCutString($row['providerName'], $arrayStrLen['idProvider']), $row['providerName']); ?></div></div>
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
						<input name="user_select_all" type="checkbox" id="user_select_all" value="" class="checkbox_show_query" onclick="querySelectAll('user', 'formQueryUser')" />
						<span><?php echo CUSER_SHOW_QUERY_SELECT_ALL; ?></span>
					</div>
			<?php
			$j = 1;
			foreach ($groupActions as $value)
			{
				if ($value['confirm'] === TRUE)
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryUser\', \''.$value['file'].'\', \''.$actionsParams.'\', true, \''.$value['msg'].'\');"';
				}
				else
				{
					$onclick = 'onclick="formQuerySubmit(\'formQueryUser\', \''.$value['file'].'\', \''.$actionsParams.'\', false, \'\');"';
				}

				if ($value['button'] === TRUE)
				{
					echo '<input type="button" name="user_ga_'.$j.'" id="user_ga_'.$j.'" value="'.$value['text'].'" class="'.$value['class'].'" '.$onclick.' />';
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
		    ?>
		    <option value="<?php echo $row['id']; ?>"<?php if ($value == $row['id']) echo ' selected="selected"' ?>>
			<?php
			$space = '';
			foreach($parts as $val)
			{
			    echo $space.$row[trim($val)];
			    $space = ' ';
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
	 * Valida si el user y pass corresponden a algún registro de la BD
	 *
	 * Este método controla que el user y pass seteados correspondan con algún registro de la BD.
	 * Si es así crea las variables de sesión correspondientes.
	 * Variables de sesión creadas:
	 * <code>
	 * <?php
	 * $_SESSION['adminId']   = $row['id'];
	 * $_SESSION['adminUser'] = $row['user'];
	 * $_SESSION['adminPass'] = $row['pass'];
	 * ?>
	 * </code>
	 *
	 * @return boolean
	 * @access public
	 */
	public function loginUser()
	{
	    if (validateRequiredValue($this->user) === TRUE and validateRequiredValue($this->pass) === TRUE)
	    {
		$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('user').' = '.$this->getValueSql($this->user).' AND '.$this->getFieldSql('pass').' = '.$this->getValueSql(md5($this->pass)).' AND '.$this->getFieldSql('active').' = '.$this->getValueSql('yes');

		$row = $this->getDbConn()->GetRow($sql);
		if ($row === FALSE)
		{
			$this->addError(CUSER_LOGIN_ADMIN_ERROR);
			return FALSE;
		}
		else
		{
			if (is_array($row) === TRUE and count($row) > 0 and $row['user'] == $this->user and $row['pass'] == md5($this->pass))
			{
				$_SESSION['userId']	        = $row['id'];
				$_SESSION['userUser']	    = $row['user'];
				$_SESSION['userToken']	    = md5(rand().$_SESSION['userUser']);
				$_SESSION['userIdGroup']    = $row['id_group'];

				$this->setId($row['id']);
				$this->settoken($_SESSION['userToken']);

				//La elimino para que cuando haga el update no se modifique la contraseña
				unset($this->pass);

				if ($this->update())
				{
					return TRUE;
				}
				else
				{
					$this->errors[] = CUSER_LOGIN_USER_ERROR;
					return FALSE;
				}
			}
			else
			{
				$this->addError(CUSER_LOGIN_ADMIN_WRONG_VALUES);
				return FALSE;
			}
		}
	    }
	    else
	    {
		    $this->addError(CUSER_LOGIN_ADMIN_REQUIRED_VALUES);
		    return FALSE;
	    }
	}

	/**
	 * Valida si las variables de sessión fueron creadas y si corresponden a algún registro de la BD
	 *
	 * Este método controla si las variables de sesión creadas por el método {@link loginUser()} corresponden con algún registro de la BD.
	 * Si no hay correspondencia, redirecciona al url correspondiente, sino devuelve TRUE.
	 *
	 * @return boolean
	 * @access public
	 */
	public function validateUser()
	{
		if (isset($_SESSION['userId']) === FALSE or isset($_SESSION['userUser']) === FALSE or isset($_SESSION['userToken']) === FALSE)
		{
			header('location: '.ADMIN_LOGIN_URL);
   			exit;
		}
		else
		{
			if (validateRequiredValue($_SESSION['userId']) === TRUE and validateRequiredValue($_SESSION['userUser']) === TRUE and validateRequiredValue($_SESSION['userToken']) === TRUE)
			{
				$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id').' = '.$this->getValueSql($_SESSION['userId']).' AND '.$this->getFieldSql('user').' = '.$this->getValueSql($_SESSION['userUser']).' AND '.$this->getFieldSql('token').' = '.$this->getValueSql($_SESSION['userToken']).' AND '.$this->getFieldSql('active').' = '.$this->getValueSql('yes');
				$row = $this->getDbConn()->GetRow($sql);
				if ($row === FALSE)
				{
					return FALSE;
				}
				else
				{
					if (is_array($row) === TRUE and count($row) > 0 and $row['id'] == $_SESSION['userId'] and $row['user'] == $_SESSION['userUser'] and $row['token'] == $_SESSION['userToken'])
					{

					    $_SESSION['userToken'] = md5(rand().$_SESSION['userToken']);

					    $this->setid($row['id']);
					    $this->settoken($_SESSION['userToken']);

					    //veo si el grupo, al que pertenece el usuario, tiene permiso de acceder a este archivo
					    $group = new Cgroup();
					    $group->setDbConn($this->getDbConn());
					    $group->setid($row['id_group']);
					    $resGroup = $group->filePermission(basename($_SERVER['PHP_SELF']), TRUE);

					    if ($this->update() === TRUE and $resGroup === TRUE)
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
						return FALSE;
					}
				}
			}
			else
			{
			    return FALSE;
			}
		}
	}

	/**
	 * Muestra un formulario para actualizar el perfil del usuario
	 *
	 * Este método muestra un formulario para actualizar un registro de la tabla "user" que se corresponde con las variables de sesión creadas.
	 * Debe estar seteada la clave primaria del registro que se quiere modificar.
	 *
	 * @param string $href [opcional] indica la página a la que se redirecciona cuando se cancela el formulario o cuando el registro es modificado en forma correcta
	 * @param boolean $autoRedirect [opcional] indica si se debe auto redireccionar a la página definida en $href una vez que se modificó en forma correcta el registro
	 * @param string $title [opcional] título
	 * @return mixed
	 * @access public
	 */
	public function updateProfileForm($href = '', $autoRedirect = FALSE, $title = '')
	{
		if (isset($_POST['updateProfileUser']) === FALSE)
		{
			$_POST['updateProfileUser'] = '';
		}
		if ($_POST['updateProfileUser'] == 'update')
		{
			$this->setId($_POST['id'], TRUE);
			$this->setUser($_POST['user'], TRUE);
			$this->existUser(TRUE);
			if (validateRequiredValue($_POST['passActual']) === FALSE)
			{
				$this->addError(CUSER_UPDATE_PROFILE_FORM_REQUIRED_PASS_ACTUAL);
			}
			else
			{
			    //Verifico si el pass guardado es igual al que ingresó.
			    $auxUser	= new Cuser($this->getDbConn());
			    $rsAuxUser	= $auxUser->getList($auxUser->getFieldSql('pass', $auxUser->getTableName()).' = '.$auxUser->getValueSql(md5($_POST['passActual'])));
			    if ($rsAuxUser === FALSE or $auxUser->getTotalList() <= 0)
			    {
				   $this->addError(CUSER_UPDATE_PROFILE_FORM_WRONG_PASS_ACTUAL);
			    }
			}
			$this->setPass($_POST['pass'], TRUE);
			if (validateRequiredValue($_POST['passConfirm']) === FALSE)
			{
				$this->addError(CUSER_UPDATE_PROFILE_FORM_REQUIRED_PASS_CONFIRM);
			}
			else
			{
				if ($_POST['pass'] != $_POST['passConfirm'])
				{
					$this->addError(CUSER_UPDATE_PROFILE_FORM_WRONG_PASS_CONFIRM);
				}
			}
			if ($this->error() === FALSE)
			{
				$this->update();
			}
			if ($this->error() === FALSE)
			{
				$_SESSION['userUser'] = $this->getUser(FALSE);
				if ($autoRedirect === TRUE and validateRequiredValue($href) === TRUE)
				{
				?>
			<script>
				location.href = '<?php echo $href; ?>';
			</script>
				<?php
				}
				?>
			<div class="form profile">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<div class="fields">
					<div class="message success"><?php echo CUSER_UPDATE_PROFILE_FORM_OK; ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CUSER_UPDATE_PROFILE_FORM_OK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="success" />
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
			<div class="form profile">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<form name="formUpdateProfileUser" id="formUpdateProfileUser" method="post" action="">
				<input name="updateProfileUser" type="hidden" id="updateProfileUser" value="back" />
				<input name="user" type="hidden" id="user" value="<?php echo $this->getUser(); ?>" />
				<div class="fields">
					<div class="message error"><?php $this->showErrors(); ?></div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CUSER_UPDATE_PROFILE_FORM_BACK_BTN; ?>" class="back" />
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
				if ($_POST['updateProfileUser'] == 'back')
				{
					$this->setUser($_POST['user'], TRUE);
				}
                ?>
			<div class="form profile">
				<div class="aux"></div>
				<div class="title">
					<div class="ico"></div>
					<div class="label"><?php echo $title; ?></div>
				</div>
				<div class="top"></div>
				<form name="formUpdateProfileUser" id="formUpdateProfileUser" method="post" action="">
				<input name="updateProfileUser" type="hidden" id="updateProfileUser" value="update" />
				<input name="id" type="hidden" id="id" value="<?php echo $this->getId(); ?>" />
				<div class="fields">
					<div class="field">
						<label><?php echo CUSER_UPDATE_PROFILE_FORM_LABEL_FIELD_USER; ?> <span>*</span></label>
						<input name="user" type="text" id="user" value="<?php echo $this->getUser(); ?>" class="str" maxlength="30" />
					</div>
					<div class="field">
						<label><?php echo CUSER_UPDATE_PROFILE_FORM_LABEL_FIELD_PASS_ACTUAL; ?> <span>*</span></label>
						<input name="passActual" type="password" id="passActual" value="" class="str" maxlength="30" />
					</div>
                    <div class="field">
						<label><?php echo CUSER_UPDATE_PROFILE_FORM_LABEL_FIELD_PASS; ?> <span>*</span></label>
						<input name="pass" type="password" id="pass" value="" class="str" maxlength="30" />
					</div>
                    <div class="field">
						<label><?php echo CUSER_UPDATE_PROFILE_FORM_LABEL_FIELD_PASS_CONFIRM; ?> <span>*</span></label>
						<input name="passConfirm" type="password" id="passConfirm" value="" class="str" maxlength="30" />
					</div>
				</div>
				<div class="middle"></div>
				<div class="buttons">
					<input type="submit" value="<?php echo CUSER_UPDATE_PROFILE_FORM_SUBMIT_BTN; ?>" class="accept" />
				<?php
				if (validateRequiredValue($href) === TRUE)
				{
				?>
					<input type="button" value="<?php echo CUSER_UPDATE_PROFILE_FORM_CANCEL_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="cancel" />
				<?php
				}
				?>
				</div>
				</form>
				<div class="bottom"></div>
				<span class="required">* <?php echo CUSER_UPDATE_PROFILE_FORM_LABEL_REQUIRED; ?></span>
			</div>
			<?php
			}
			else
			{
			?>
			<div class="form profile">
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
					<input type="button" value="<?php echo CUSER_UPDATE_PROFILE_FORM_BACK_BTN; ?>" onclick="location.href='<?php echo $href; ?>'" class="back" />
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
	 * Envía el email con el usuario y contraseña
	 *
	 * @param $fields Campos que se están prosesando
	 *
	 * @return boolean
	 */
	private function sendEmail($fields)
	{
	    if (validateEmailValue($this->email) === TRUE)
	    {
		/*$mail		= new phpmailer();
		$mail->Subject  = CUSER_SENDEMAIL_SUBJECT;
		$mail->FromName = CONTACT_NAME;
		$mail->From     = CONTACT_EMAIL;
		$mail->AddReplyTo(CONTACT_EMAIL);
		$mail->AddAddress($this->getEmail(FALSE));
		$mail->Sender   = CONTACT_SENDER;
		$mail->Mailer   = 'smtp';
		$mail->CharSet  = $this->getCharset();

		$mail->Host     = CONTACT_SMTP_HOST;
		$mail->SMTPAuth = true;
		$mail->Username = CONTACT_SMTP_USER;
		$mail->Password = CONTACT_SMTP_PASS;
        $mail->Port     = CONTACT_SMTP_PORT;
		$mail->SMTPDebug = true;*/



		$mail = new PHPMailer();  
		   $mail->IsSMTP();
   $mail->Host = 'c2331324.ferozo.com';
   $mail->Port = 465;
   $mail->SMTPSecure = 'ssl';
   $mail->SMTPAuth = true;
   $mail->Username = "manialiaga@letitgo-modacircular.com";
   $mail->Password = "letitGO0618*";
   $mail->setFrom('manialiaga@letitgo-modacircular.com', 'Letitgo');  //add sender email 
   $mail->addAddress($this->getEmail(FALSE));  //Set who the
      $mail->Subject = $response->subject;


		//Agrego las imganes adjuntas
		$mail->AddEmbeddedImage(ADMIN_PATH.'img'.FILE_SLASH.'logo.png', 'logo_desmadre', 'logo.png');

		$html = file_get_contents(HTML_PATH.HTML_USER_TEMPLATE);
		if($html === FALSE)
		{
		    $html = CUSER_SENDEMAIL_TEXT_BODY;
		}

		$mail->Body     = $this->processTags($fields, $html);
		$mail->AltBody  = $this->processTags($fields, CUSER_SENDEMAIL_TEXT_BODY);

		$result		= $mail->Send();

		$mail->ClearAddresses();
		$mail->ClearReplyTos();
		$mail->ClearAttachments();

		if(!$result)
		{
		    $this->addError(CUSER_SENDEMAIL_SETEMAIL_NOT_SENT);

		    return FALSE;
		}
		else
		{
		    return TRUE;
		}
	    }
	    else
	    {
		    $this->addError(CUSER_SENDEMAIL_SETEMAIL_VALIDATE_VALUE);
		    return FALSE;
	    }
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
	private function processTags($fields, $content)
	{
	    foreach ($fields as $key => $value)
	    {
		$content = str_replace('#'.$key.'#', trim($value), $content);
	    }

	    return $content;
	}
}
?>