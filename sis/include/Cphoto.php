<?php
/**
 * Archivo php creado por O-creator
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Administración de la tabla photo
 *
 * Esta clase se encarga de la administración de la tabla photo brindando métodos que permiten insertar, modificar, eliminar o mostrar registros de la misma.
 * Una clase puede utilizar la clase Cphoto para agregar funcionalidades que permiten agregar, eliminar, modificar y mostrar fotos para cada registro de la misma.
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Cphoto.php');
 * $photo = new Cphoto();
 * $photo->setDbConn($dbConn);
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.2:25-08-2015
 */
class Cphoto extends Cbase
{
	/**
	 * ID
	 *
	 * - Clave Primaria
	 * - Auto Increment: campo auto_increment
	 * - Campo en la base de datos: id_photo
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * Ver también: {@link getIdPhoto()}, {@link setIdPhoto()}
	 * @var integer
	 * @access private
	 */
	private $idPhoto;

	/**
	 * Tabla FK
	 *
	 * - Campo en la base de datos: table_fk
	 * - Tipo de campo en la base de datos: varchar(50)
	 * - Campo requerido
	 *
	 * Ver también: {@link getTableFk()}, {@link setTableFk()}
	 * @var string
	 * @access private
	 */
	private $tableFk;

	/**
	 * ID FK
	 *
	 * - Campo en la base de datos: id_fk
	 * - Tipo de campo en la base de datos: bigint(20)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 * - Campo requerido
	 *
	 * Ver también: {@link getIdFk()}, {@link setIdFk()}
	 * @var integer
	 * @access private
	 */
	private $idFk;

	/**
	 * Nombre
	 *
	 * - Campo en la base de datos: name
	 * - Tipo de campo en la base de datos: varchar(255)
	 * - Campo requerido
	 *
	 * Ver también: {@link getName()}, {@link setName()}
	 * @var string
	 * @access private
	 */
	private $name;

	/**
	 * Principal
	 *
	 * - Campo en la base de datos: main
	 * - Tipo de campo en la base de datos: enum('yes','no')
	 * - Campo requerido
	 *
	 * Ver también: {@link getMain()}, {@link setMain()}
	 * @var string
	 * @access private
	 */
	private $main;

	/**
	 * Eliminada
	 *
	 * - Campo en la base de datos: deleted
	 * - Tipo de campo en la base de datos: enum('yes','no')
	 * - Campo requerido
	 *
	 * Ver también: {@link getDeleted()}, {@link setDeleted()}
	 * @var string
	 * @access private
	 */
	private $deleted;

	/**
	 * Ancho
	 *
	 * - Campo en la base de datos: width
	 * - Tipo de campo en la base de datos: int(11)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * Ver también: {@link getWidth()}, {@link setWidth()}
	 * @var integer
	 * @access private
	 */
	private $width;

	/**
	 * Alto
	 *
	 * - Campo en la base de datos: height
	 * - Tipo de campo en la base de datos: int(11)
	 * - Extra: Entero, positivo sin el cero [+] (ver {@link validateIntValue()})
	 *
	 * Ver también: {@link getHeight()}, {@link setHeight()}
	 * @var integer
	 * @access private
	 */
	private $height;

	/**
	 * Leyenda
	 *
	 * - Campo en la base de datos: caption
	 * - Tipo de campo en la base de datos: varchar(255)
	 *
	 * Ver también: {@link getCaption()}, {@link setCaption()}
	 * @var string
	 * @access private
	 */
	private $caption;

	/**
	 * Identificador temporal para las fotos
	 *
	 * Este valor se utiliza para controlar e identificar las transacciones de carga de fotos.
	 * Se maneja por medio de una variable de sesión ($_SESSION['tempPhoto'])
	 *
	 * @var string
	 * @access private
	 */
	private $tempPhoto;

	/**
	 * Identificador temporal de la foto principal
	 *
	 * Este valor se utiliza para controlar e identificar cuál es la foto principal de una transacción de carga de fotos.
	 * Se maneja por medio de una variable de sesión ($_SESSION['tempMain']) y por medio de una variable post ($_POST['temp_main'])
	 *
	 * @var string
	 * @access private
	 */
	private $tempMain;

	/**
	 * Path físico donde se guardan las fotos temporalmente
	 *
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhotoTempPath()}, {@link setPhotoTempPath()}
	 * @var string
	 * @access private
	 */
	private $photoTempPath;

	/**
	 * Path físico de las fotos
	 *
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhotoPath()}, {@link setPhotoPath()}
	 * @var string
	 * @access private
	 */
	private $photoPath;

	/**
	 * Path físico donde se guardan los thumbs de las fotos temporalmente
	 *
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhotoThumbsTempPath()}, {@link setPhotoThumbsTempPath()}
	 * @var string
	 * @access private
	 */
	private $photoThumbsTempPath;

	/**
	 * Path físico de los thumbs de las fotos
	 *
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhotoThumbsPath()}, {@link setPhotoThumbsPath()}
	 * @var string
	 * @access private
	 */
	private $photoThumbsPath;

	/**
	 * Url de las fotos temporales
	 *
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhotoTempUrl()}, {@link setPhotoTempUrl()}
	 * @var string
	 * @access private
	 */
	private $photoTempUrl;

	/**
	 * Url de las fotos
	 *
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhotoUrl()}, {@link setPhotoUrl()}
	 * @var string
	 * @access private
	 */
	private $photoUrl;

	/**
	 * Url de los thumbs de las fotos temporales
	 *
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhotoThumbsTempUrl()}, {@link setPhotoThumbsTempUrl()}
	 * @var string
	 * @access private
	 */
	private $photoThumbsTempUrl;

	/**
	 * Url de los thumbs de las fotos
	 *
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhotoThumbsUrl()}, {@link setPhotoThumbsUrl()}
	 * @var string
	 * @access private
	 */
	private $photoThumbsUrl;

	/**
	 * Ancho de los thumbs de las fotos
	 *
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhotoThumbsWidth()}, {@link setPhotoThumbsWidth()}
	 * @var string
	 * @access private
	 */
	private $photoThumbsWidth;

	/**
	 * Alto de los thumbs de las fotos
	 *
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhotoThumbsHeight()}, {@link setPhotoThumbsHeight()}
	 * @var string
	 * @access private
	 */
	private $photoThumbsHeight;

	/**
	 * Ancho de los thumbs de las fotos temporales
	 *
	 * - Campo requerido
	 *
	 * Ver también: {@link getPhotoTempThumbsWidth()}, {@link setPhotoTempThumbsWidth()}
	 * @var string
	 * @access private
	 */
	private $photoTempThumbsWidth;

	/**
	 * Determina si la foto es temporal o no
	 *
	 * Ver también: {@link getIsTemp()}, {@link setIsTemp()}
	 * @var string
	 * @access private
	 */
	private $isTemp;

	/**
	 * Extensiones de fotos válidas
	 *
	 * @var array
	 * @access private
	 */
	private $allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');

	/**
	 * Límite de fotos permitido
	 *
	 * - Extra: Entero, positivo con el cero [0,+] (ver {@link validateIntValue()})
	 *
	 * Este valor entero indica el límite máximo de fotos que se permiten cargar para cada registro de la Tabla FK.
	 * Si no se quiere indicar un límite en la cantidad de fotos, se le debe asignar el valor cero [0] (valor por defecto).
	 *
	 * Ver también: {@link getPhotosLimit()}, {@link setPhotosLimit()}
	 * @var integer
	 * @access private
	 */
	private $photosLimit;

	/**
	 * Constructor de la clase
	 *
	 * @param object (ADODB PHP) $dbConn [opcional] Conexión a la base de datos
	 * @return void
	 */
	function __construct($dbConn = '')
	{
		parent::__construct($dbConn);

		$this->setTableName('photo');

		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cphoto.php');

		//tempPhoto
		if (isset($_SESSION['tempPhoto']) === FALSE)
		{
			$_SESSION['tempPhoto'] = '';
		}
		if (validateRequiredValue($_SESSION['tempPhoto']) === TRUE)
		{
			$this->tempPhoto = $_SESSION['tempPhoto'];
		}

		//tempMain
		if (isset($_POST['tempMain']) === FALSE)
		{
			$_POST['tempMain'] = '';
		}
		if (isset($_SESSION['tempMain']) === FALSE)
		{
			$_SESSION['tempMain'] = '';
		}
		if (validateRequiredValue($_POST['tempMain']) === TRUE)
		{
			$_SESSION['tempMain'] = $_POST['tempMain'];
		}
		$this->tempMain = $_SESSION['tempMain'];

		//valor por defecto del límite de fotos permitido
		$this->setPhotosLimit(0);
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
	 * Setea el valor {@link $idPhoto ID}
	 *
	 * @param integer $idPhoto indica el valor ID
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdPhoto($idPhoto, $gpc = FALSE)
	{
		if (validateRequiredValue($idPhoto) === FALSE)
		{
			$this->idPhoto = $idPhoto;
			$this->addError(CPHOTO_SETID_PHOTO_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->idPhoto = setValue($idPhoto, $gpc);

			if (validateIntValue($this->idPhoto, '+') === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CPHOTO_SETID_PHOTO_VALIDATE_VALUE);

				return FALSE;
			}
		}
	}

	/**
	 * Setea el valor {@link $tableFk Tabla FK}
	 *
	 * @param string $tableFk indica el valor Tabla FK
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setTableFk($tableFk, $gpc = FALSE)
	{
		if (validateRequiredValue($tableFk) === FALSE)
		{
			$this->tableFk = $tableFk;
			$this->addError(CPHOTO_SETTABLE_FK_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->tableFk = setValue($tableFk, $gpc);

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $idFk ID FK}
	 *
	 * @param integer $idFk indica el valor ID FK
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setIdFk($idFk, $gpc = FALSE)
	{
		if (validateRequiredValue($idFk) === FALSE)
		{
			$this->idFk = $idFk;
			$this->addError(CPHOTO_SETID_FK_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->idFk = setValue($idFk, $gpc);

			if (validateIntValue($this->idFk, '+') === TRUE)
			{
				return TRUE;
			}
			else
			{
				$this->addError(CPHOTO_SETID_FK_VALIDATE_VALUE);

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
			$this->addError(CPHOTO_SETNAME_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->name = setValue($name, $gpc);

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $main Principal}
	 *
	 * @param string $main indica el valor Principal
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setMain($main, $gpc = FALSE)
	{
		if (validateRequiredValue($main) === FALSE)
		{
			$this->main = $main;
			$this->addError(CPHOTO_SETMAIN_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->main = setValue($main, $gpc);

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $deleted Eliminada}
	 *
	 * @param string $deleted indica el valor Eliminada
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setDeleted($deleted, $gpc = FALSE)
	{
		if (validateRequiredValue($deleted) === FALSE)
		{
			$this->deleted = $deleted;
			$this->addError(CPHOTO_SETDELETED_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->deleted = setValue($deleted, $gpc);

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $width Ancho}
	 *
	 * @param integer $width indica el valor Ancho
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setWidth($width, $gpc = FALSE)
	{
		if ($width == '0')
		{
			$width = '';
		}
		$this->width = setValue($width, $gpc);

		if (validateIntValue($this->width, '+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CPHOTO_SETWIDTH_VALIDATE_VALUE);

			return FALSE;
		}
	}

	/**
	 * Setea el valor {@link $height Alto}
	 *
	 * @param integer $height indica el valor Alto
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setHeight($height, $gpc = FALSE)
	{
		if ($height == '0')
		{
			$height = '';
		}
		$this->height = setValue($height, $gpc);

		if (validateIntValue($this->height, '+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CPHOTO_SETHEIGHT_VALIDATE_VALUE);

			return FALSE;
		}
	}

	/**
	 * Setea el valor {@link $caption Leyenda}
	 *
	 * @param string $caption indica el valor Leyenda
	 * @param boolean $gpc [opcional] indica si el valor llega a través de los métodos GET, POST o a través de las cookies. Ver: {@link http://www.php.net/addslashes/}
	 * @return boolean
	 * @access public
	 */
	public function setCaption($caption, $gpc = FALSE)
	{
		$this->caption = setValue($caption, $gpc);

		return TRUE;
	}

	/**
	 * Setea el {@link $tempPhoto identificador temporal para las fotos}
	 *
	 * @param string $tempPhoto indica el valor del identificador temporal para las fotos
	 * @return boolean
	 * @access public
	 */
	public function setTempPhoto($tempPhoto)
	{
		$this->tempPhoto = $tempPhoto;

		return TRUE;
	}

	/**
	 * Setea el {@link $tempMain identificador temporal de la foto principal}
	 *
	 * @param string $tempMain indica el valor del identificador temporal de la foto principal
	 * @return boolean
	 * @access public
	 */
	public function setTempMain($tempMain)
	{
		$this->tempMain = $tempMain;

		return TRUE;
	}

	/**
	 * Setea el valor {@link $photoTempPath}
	 *
	 * @param string $photoTempPath indica el valor photoTempPath
	 * @return boolean
	 * @access public
	 */
	public function setPhotoTempPath($photoTempPath)
	{
		if (validateRequiredValue($photoTempPath) === FALSE)
		{
			$this->photoTempPath = $photoTempPath;
            $this->addError(CPHOTO_SETPHOTO_TEMP_PATH_REQUIRED_VALUE);

            return FALSE;
		}
		else
		{
			$this->photoTempPath = $photoTempPath;

            return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $photoPath}
	 *
	 * @param string $photoPath indica el valor photoPath
	 * @return boolean
	 * @access public
	 */
	public function setPhotoPath($photoPath)
	{
		if (validateRequiredValue($photoPath) === FALSE)
		{
			$this->photoPath = $photoPath;
            $this->addError(CPHOTO_SETPHOTO_PATH_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->photoPath = $photoPath;

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $photoThumbsTempPath}
	 *
	 * @param string $photoThumbsTempPath indica el valor photoThumbsTempPath
	 * @return boolean
	 * @access public
	 */
	public function setPhotoThumbsTempPath($photoThumbsTempPath)
	{
		if (validateRequiredValue($photoThumbsTempPath) === FALSE)
		{
			$this->photoThumbsTempPath = $photoThumbsTempPath;
            $this->addError(CPHOTO_SETPHOTO_THUMBS_TEMP_PATH_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->photoThumbsTempPath = $photoThumbsTempPath;

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $photoThumbsPath}
	 *
	 * @param string $photoThumbsPath indica el valor photoThumbsPath
	 * @return boolean
	 * @access public
	 */
	public function setPhotoThumbsPath($photoThumbsPath)
	{
		if (validateRequiredValue($photoThumbsPath) === FALSE)
		{
			$this->photoThumbsPath = $photoThumbsPath;
            $this->addError(CPHOTO_SETPHOTO_THUMBS_PATH_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->photoThumbsPath = $photoThumbsPath;

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $photoTempUrl}
	 *
	 * @param string $photoTempUrl indica el valor photoTempUrl
	 * @return boolean
	 * @access public
	 */
	public function setPhotoTempUrl($photoTempUrl)
	{
		if (validateRequiredValue($photoTempUrl) === FALSE)
		{
			$this->photoTempUrl = $photoTempUrl;
            $this->addError(CPHOTO_SETPHOTO_TEMP_URL_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->photoTempUrl = $photoTempUrl;

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $photoUrl}
	 *
	 * @param string $photoUrl indica el valor photoUrl
	 * @return boolean
	 * @access public
	 */
	public function setPhotoUrl($photoUrl)
	{
		if (validateRequiredValue($photoUrl) === FALSE)
		{
			$this->photoUrl = $photoUrl;
            $this->addError(CPHOTO_SETPHOTO_URL_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->photoUrl = $photoUrl;

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $photoThumbsTempUrl}
	 *
	 * @param string $photoThumbsTempUrl indica el valor photoThumbsTempUrl
	 * @return boolean
	 * @access public
	 */
	public function setPhotoThumbsTempUrl($photoThumbsTempUrl)
	{
		if (validateRequiredValue($photoThumbsTempUrl) === FALSE)
		{
			$this->photoThumbsTempUrl = $photoThumbsTempUrl;
            $this->addError(CPHOTO_SETPHOTO_THUMBS_TEMP_URL_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->photoThumbsTempUrl = $photoThumbsTempUrl;

            return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $photoThumbsUrl}
	 *
	 * @param string $photoThumbsUrl indica el valor photoThumbsUrl
	 * @return boolean
	 * @access public
	 */
	public function setPhotoThumbsUrl($photoThumbsUrl)
	{
		if (validateRequiredValue($photoThumbsUrl) === FALSE)
		{
			$this->photoThumbsUrl = $photoThumbsUrl;
            $this->addError(CPHOTO_SETPHOTO_THUMBS_URL_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->photoThumbsUrl = $photoThumbsUrl;

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $photoThumbsWidth}
	 *
	 * @param integer $photoThumbsWidth indica el valor photoThumbsWidth
	 * @return boolean
	 * @access public
	 */
	public function setPhotoThumbsWidth($photoThumbsWidth)
	{
		if (validateRequiredValue($photoThumbsWidth) === FALSE)
		{
			$this->photoThumbsWidth = $photoThumbsWidth;
            $this->addError(CPHOTO_SETPHOTO_THUMBS_WIDTH_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->photoThumbsWidth = $photoThumbsWidth;

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $photoThumbsHeight}
	 *
	 * @param integer $photoThumbsHeight indica el valor photoThumbsHeight
	 * @return boolean
	 * @access public
	 */
	public function setPhotoThumbsHeight($photoThumbsHeight)
	{
		if (validateRequiredValue($photoThumbsHeight) === FALSE)
		{
			$this->photoThumbsHeight = $photoThumbsHeight;
            $this->addError(CPHOTO_SETPHOTO_THUMBS_HEIGHT_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->photoThumbsHeight = $photoThumbsHeight;

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $photoTempThumbsWidth}
	 *
	 * @param integer $photoTempThumbsWidth indica el valor photoTempThumbsWidth
	 * @return boolean
	 * @access public
	 */
	public function setPhotoTempThumbsWidth($photoTempThumbsWidth)
	{
		if (validateRequiredValue($photoTempThumbsWidth) === FALSE)
		{
			$this->photoTempThumbsWidth = $photoTempThumbsWidth;
            $this->addError(CPHOTO_SETPHOTO_TEMP_THUMBS_WIDTH_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->photoTempThumbsWidth = $photoTempThumbsWidth;

			return TRUE;
		}
	}

	/**
	 * Setea el valor {@link $isTemp}
	 *
	 * @param boolean $isTemp indica el valor isTemp
	 * @return boolean
	 * @access public
	 */
	public function setIsTemp($isTemp)
	{
		if ($isTemp === TRUE)
		{
			$this->isTemp = TRUE;
		}
		elseif ($isTemp === FALSE)
		{
			$this->isTemp = FALSE;
		}
		else
		{
			$this->addError(CPHOTO_SETIS_TEMP_REQUIRED_VALUE);

			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Setea el valor {@link $photosLimit}
	 *
	 * @param integer $photosLimit indica el valor photosLimit
	 * @return boolean
	 * @access public
	 */
	public function setPhotosLimit($photosLimit)
	{
		$this->photosLimit = $photosLimit;

		if (validateIntValue($photosLimit, '0+') === TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->addError(CPHOTO_SETPHOTOS_LIMIT_VALIDATE_VALUE);

			return FALSE;
		}
	}

	/**
	 * Devuelve el valor {@link $idPhoto ID}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdPhoto($htmlEntities = TRUE)
	{
		return getValue($this->idPhoto, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $tableFk Tabla FK}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getTableFk($htmlEntities = TRUE)
	{
		return getValue($this->tableFk, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $idFk ID FK}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getIdFk($htmlEntities = TRUE)
	{
		return getValue($this->idFk, $htmlEntities, $this->getCharset());
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
	 * Devuelve el valor {@link $main Principal}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getMain($htmlEntities = TRUE)
	{
		return getValue($this->main, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve la descripción de los valores de {@link $main Principal}
	 *
	 * @param string $main indica el valor Principal
	 * @return string
	 * @access public
	 */
	public function getValuesMain($main)
	{
		switch ($main)
		{
			case 'yes':
				return CPHOTO_GET_VALUES_MAIN_VALUE_1;
				break;

			case 'no':
				return CPHOTO_GET_VALUES_MAIN_VALUE_2;
				break;

			default:
				return '&nbsp;';
		}
	}

	/**
	 * Devuelve el valor {@link $deleted Eliminada}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getDeleted($htmlEntities = TRUE)
	{
		return getValue($this->deleted, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve la descripción de los valores de {@link $deleted Eliminada}
	 *
	 * @param string $deleted indica el valor Eliminada
	 * @return string
	 * @access public
	 */
	public function getValuesDeleted($deleted)
	{
		switch ($deleted)
		{
			case 'yes':
				return CPHOTO_GET_VALUES_DELETED_VALUE_1;
				break;

			case 'no':
				return CPHOTO_GET_VALUES_DELETED_VALUE_2;
				break;

			default:
				return '&nbsp;';
		}
	}

	/**
	 * Devuelve el valor {@link $width Ancho}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getWidth($htmlEntities = TRUE)
	{
		return getValue($this->width, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $height Alto}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return integer
	 * @access public
	 */
	public function getHeight($htmlEntities = TRUE)
	{
		return getValue($this->height, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el valor {@link $caption Leyenda}
	 *
	 * @param boolean $htmlEntities [opcional] indica si se convierten o no los caracteres a su entidad HTML
	 * @return string
	 * @access public
	 */
	public function getCaption($htmlEntities = TRUE)
	{
		return getValue($this->caption, $htmlEntities, $this->getCharset());
	}

	/**
	 * Devuelve el {@link $tempPhoto identificador temporal para las fotos}
	 *
	 * @return integer
	 * @access public
	 */
	public function getTempPhoto()
	{
        return $this->tempPhoto;
	}

	/**
	 * Devuelve el {@link $tempMain identificador temporal de la foto principal}
	 *
	 * @return integer
	 * @access public
	 */
	public function getTempMain()
	{
        return $this->tempMain;
	}

	/**
	 * Devuelve el valor {@link $photoTempPath}
	 *
	 * @return string
	 * @access public
	 */
	public function getPhotoTempPath()
	{
		return $this->photoTempPath;
	}

	/**
	 * Devuelve el valor {@link $photoPath}
	 *
	 * @return string
	 * @access public
	 */
	public function getPhotoPath()
	{
		return $this->photoPath;
	}

	/**
	 * Devuelve el valor {@link $photoThumbsTempPath}
	 *
	 * @return string
	 * @access public
	 */
	public function getPhotoThumbsTempPath()
	{
		return $this->photoThumbsTempPath;
	}

	/**
	 * Devuelve el valor {@link $photoThumbsPath}
	 *
	 * @return string
	 * @access public
	 */
	public function getPhotoThumbsPath()
	{
		return $this->photoThumbsPath;
	}

	/**
	 * Devuelve el valor {@link $photoTempUrl}
	 *
	 * @return string
	 * @access public
	 */
	public function getPhotoTempUrl()
	{
		return $this->photoTempUrl;
	}

	/**
	 * Devuelve el valor {@link $photoUrl}
	 *
	 * @return string
	 * @access public
	 */
	public function getPhotoUrl()
	{
		return $this->photoUrl;
	}

	/**
	 * Devuelve el valor {@link $photoThumbsTempUrl}
	 *
	 * @return string
	 * @access public
	 */
	public function getPhotoThumbsTempUrl()
	{
		return $this->photoThumbsTempUrl;
	}

	/**
	 * Devuelve el valor {@link $photoThumbsUrl}
	 *
	 * @return string
	 * @access public
	 */
	public function getPhotoThumbsUrl()
	{
		return $this->photoThumbsUrl;
	}

	/**
	 * Devuelve el valor {@link $photoThumbsWidth}
	 *
	 * @return integer
	 * @access public
	 */
	public function getPhotoThumbsWidth()
	{
		return $this->photoThumbsWidth;
	}

	/**
	 * Devuelve el valor {@link $photoThumbsHeight}
	 *
	 * @return integer
	 * @access public
	 */
	public function getPhotoThumbsHeight()
	{
		return $this->photoThumbsHeight;
	}

	/**
	 * Devuelve el valor {@link $photoTempThumbsWidth}
	 *
	 * @return integer
	 * @access public
	 */
	public function getPhotoTempThumbsWidth()
	{
		return $this->photoTempThumbsWidth;
	}

	/**
	 * Devuelve el valor {@link $isTemp}
	 *
	 * @return boolean
	 * @access public
	 */
	public function getIsTemp()
	{
		return $this->isTemp;
	}

	/**
	 * Devuelve el valor {@link $photosLimit}
	 *
	 * @return integer
	 * @access public
	 */
	public function getPhotosLimit()
	{
		return $this->photosLimit;
	}

	/**
	 * Setea las constantes definidas para el manejo de fotos
	 *
	 * Debe estar seteada la propiedad {@link $tableFk tableFk}
	 *
	 * @return boolean
	 * @access public
	 */
	public function setConstants()
	{
		if (validateRequiredValue($this->tableFk) === FALSE)
		{
			$this->addError(CPHOTO_SETCONSTANTS_REQUIRED_TABLE_FK);

			return FALSE;
		}
		else
		{
			//photoTempPath
			if (defined(strtoupper($this->tableFk).'_TEMP_PATH') === TRUE)
			{
				$this->setPhotoTempPath(constant(strtoupper($this->tableFk).'_TEMP_PATH'));
			}
			else
			{
				$this->addError(CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED.' '.strtoupper($this->tableFk).'_TEMP_PATH');
			}

			//photoPath
			if (defined(strtoupper($this->tableFk).'_PATH') === TRUE)
			{
				$this->setPhotoPath(constant(strtoupper($this->tableFk).'_PATH'));
			}
			else
			{
				$this->addError(CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED.' '.strtoupper($this->tableFk).'_PATH');
			}

			//photoThumbsTempPath
			if (defined(strtoupper($this->tableFk).'_THUMBS_TEMP_PATH') === TRUE)
			{
				$this->setPhotoThumbsTempPath(constant(strtoupper($this->tableFk).'_THUMBS_TEMP_PATH'));
			}
			else
			{
				$this->addError(CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED.' '.strtoupper($this->tableFk).'_THUMBS_TEMP_PATH');
			}

			//photoThumbsPath
			if (defined(strtoupper($this->tableFk).'_THUMBS_PATH') === TRUE)
			{
				$this->setPhotoThumbsPath(constant(strtoupper($this->tableFk).'_THUMBS_PATH'));
			}
			else
			{
				$this->addError(CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED.' '.strtoupper($this->tableFk).'_THUMBS_PATH');
			}

			//photoTempUrl
			if (defined(strtoupper($this->tableFk).'_TEMP_URL') === TRUE)
			{
				$this->setPhotoTempUrl(constant(strtoupper($this->tableFk).'_TEMP_URL'));
			}
			else
			{
				$this->addError(CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED.' '.strtoupper($this->tableFk).'_TEMP_URL');
			}

			//photoUrl
			if (defined(strtoupper($this->tableFk).'_URL') === TRUE)
			{
				$this->setPhotoUrl(constant(strtoupper($this->tableFk).'_URL'));
			}
			else
			{
				$this->addError(CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED.' '.strtoupper($this->tableFk).'_URL');
			}

			//photoThumbsTempUrl
			if (defined(strtoupper($this->tableFk).'_THUMBS_TEMP_URL') === TRUE)
			{
				$this->setPhotoThumbsTempUrl(constant(strtoupper($this->tableFk).'_THUMBS_TEMP_URL'));
			}
			else
			{
				$this->addError(CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED.' '.strtoupper($this->tableFk).'_THUMBS_TEMP_URL');
			}

			//PhotoThumbsUrl
			if (defined(strtoupper($this->tableFk).'_THUMBS_URL') === TRUE)
			{
				$this->setPhotoThumbsUrl(constant(strtoupper($this->tableFk).'_THUMBS_URL'));
			}
			else
			{
				$this->addError(CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED.' '.strtoupper($this->tableFk).'_THUMBS_URL');
			}

			//photoThumbsWidth
			if (defined(strtoupper($this->tableFk).'_THUMBS_WIDTH') === TRUE)
			{
				$this->setPhotoThumbsWidth(constant(strtoupper($this->tableFk).'_THUMBS_WIDTH'));
			}
			else
			{
				$this->addError(CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED.' '.strtoupper($this->tableFk).'_THUMBS_WIDTH');
			}

			//photoThumbsHeight
			if (defined(strtoupper($this->tableFk).'_THUMBS_HEIGHT') === TRUE)
			{
				$this->setPhotoThumbsHeight(constant(strtoupper($this->tableFk).'_THUMBS_HEIGHT'));
			}
			else
			{
				$this->addError(CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED.' '.strtoupper($this->tableFk).'_THUMBS_HEIGHT');
			}

			//photoTempThumbsWidth
			if (defined(strtoupper($this->tableFk).'_TEMP_THUMBS_WIDTH') === TRUE)
			{
				$this->setPhotoTempThumbsWidth(constant(strtoupper($this->tableFk).'_TEMP_THUMBS_WIDTH'));
			}
			else
			{
				$this->addError(CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED.' '.strtoupper($this->tableFk).'_TEMP_THUMBS_WIDTH');
			}
		}
	}

	/**
	 * Inserta un nuevo registro en la tabla photo
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

		if (isset($this->idPhoto) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_photo');
			$values[] = $this->getValueSql($this->idPhoto);
		}

		if (isset($this->tableFk) === TRUE)
		{
			$fields[] = $this->getFieldSql('table_fk');
			$values[] = $this->getValueSql($this->tableFk);
		}

		if (isset($this->idFk) === TRUE)
		{
			$fields[] = $this->getFieldSql('id_fk');

			if (validateRequiredValue($this->idFk) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->idFk);
			}
		}

		if (isset($this->name) === TRUE)
		{
			$fields[] = $this->getFieldSql('name');
			$values[] = $this->getValueSql($this->name);
		}

		if (isset($this->main) === TRUE)
		{
			$fields[] = $this->getFieldSql('main');
			$values[] = $this->getValueSql($this->main);
		}

		if (isset($this->deleted) === TRUE)
		{
			$fields[] = $this->getFieldSql('deleted');
			$values[] = $this->getValueSql($this->deleted);
		}

		if (isset($this->width) === TRUE)
		{
			$fields[] = $this->getFieldSql('width');

			if (validateRequiredValue($this->width) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->width);
			}
		}

		if (isset($this->height) === TRUE)
		{
			$fields[] = $this->getFieldSql('height');

			if (validateRequiredValue($this->height) === FALSE)
			{
				$values[] = $this->getValueSql(0);
			}
			else
			{
				$values[] = $this->getValueSql($this->height);
			}
		}

		if (isset($this->caption) === TRUE)
		{
			$fields[] = $this->getFieldSql('caption');
			$values[] = $this->getValueSql($this->caption);
		}

		$sql = 'INSERT INTO '.$this->getTableSql().' ('.implode(' , ', $fields).') VALUES ('.implode(' , ', $values).')';

		if ($this->getDbConn()->Execute($sql) === FALSE)
		{
			$this->addError(CPHOTO_ADD_ERROR);

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Actualiza un registro de la tabla photo
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
		if (validateRequiredValue($this->idPhoto) === TRUE)
		{
			$values = array();

			if (isset($this->tableFk) === TRUE)
			{
				$values[] = $this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk);
			}

			if (isset($this->idFk) === TRUE)
			{
				if (validateRequiredValue($this->idFk) === FALSE)
				{
					$values[] = $this->getFieldSql('id_fk').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk);
				}
			}

			if (isset($this->name) === TRUE)
			{
				$values[] = $this->getFieldSql('name').' = '.$this->getValueSql($this->name);
			}

			if (isset($this->main) === TRUE)
			{
				$values[] = $this->getFieldSql('main').' = '.$this->getValueSql($this->main);
			}

			if (isset($this->deleted) === TRUE)
			{
				$values[] = $this->getFieldSql('deleted').' = '.$this->getValueSql($this->deleted);
			}

			if (isset($this->width) === TRUE)
			{
				if (validateRequiredValue($this->width) === FALSE)
				{
					$values[] = $this->getFieldSql('width').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('width').' = '.$this->getValueSql($this->width);
				}
			}

			if (isset($this->height) === TRUE)
			{
				if (validateRequiredValue($this->height) === FALSE)
				{
					$values[] = $this->getFieldSql('height').' = '.$this->getValueSql(0);
				}
				else
				{
					$values[] = $this->getFieldSql('height').' = '.$this->getValueSql($this->height);
				}
			}

			if (isset($this->caption) === TRUE)
			{
				$values[] = $this->getFieldSql('caption').' = '.$this->getValueSql($this->caption);
			}

			$sql = 'UPDATE '.$this->getTableSql().' SET '.implode(' , ', $values).' WHERE '.$this->getFieldSql('id_photo').' = '.$this->getValueSql($this->idPhoto);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CPHOTO_UPDATE_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CPHOTO_UPDATE_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Elimina un registro de la tabla photo
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
		if (validateRequiredValue($this->idPhoto) === TRUE)
		{
			$sql = 'DELETE FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_photo').' = '.$this->getValueSql($this->idPhoto);

			if ($this->getDbConn()->Execute($sql) === FALSE)
			{
				$this->addError(CPHOTO_DEL_ERROR);

				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->addError(CPHOTO_DEL_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un registro de la tabla photo
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
		if (validateRequiredValue($this->idPhoto) === TRUE)
		{
			$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('id_photo').' = '.$this->getValueSql($this->idPhoto);

			$row = $this->getDbConn()->GetRow($sql);

			if (is_array($row) === TRUE and count($row) > 0)
			{
				$this->setIdPhoto($row['id_photo']);
				$this->setTableFk($row['table_fk']);
				$this->setIdFk($row['id_fk']);
				$this->setName($row['name']);
				$this->setMain($row['main']);
				$this->setDeleted($row['deleted']);
				$this->setWidth($row['width']);
				$this->setHeight($row['height']);
				$this->setCaption($row['caption']);

				return TRUE;
			}
			else
			{
				$this->addError(CPHOTO_GETDATA_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CPHOTO_GETDATA_REQUIRED_PK);

			return FALSE;
		}
	}

	/**
	 * Obtiene un conjunto de registros de la tabla photo
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
				$this->addError(CPHOTO_GETLIST_ERROR);

				return FALSE;
			}
			else
			{
				settype ($htmlEntities, 'boolean');

				$list = array();

				$this->setTotalQuery($rs->RecordCount());

				while (!$rs->EOF)
				{
					$this->setIdPhoto($rs->fields['id_photo']);
					$this->setTableFk($rs->fields['table_fk']);
					$this->setIdFk($rs->fields['id_fk']);
					$this->setName($rs->fields['name']);
					$this->setMain($rs->fields['main']);
					$this->setDeleted($rs->fields['deleted']);
					$this->setWidth($rs->fields['width']);
					$this->setHeight($rs->fields['height']);
					$this->setCaption($rs->fields['caption']);

					$list[] = array(
						'idPhoto' => $this->getIdPhoto($htmlEntities) ,
						'tableFk' => $this->getTableFk($htmlEntities) ,
						'idFk' => $this->getIdFk($htmlEntities) ,
						'name' => $this->getName($htmlEntities) ,
						'main' => $this->getMain($htmlEntities) ,
						'deleted' => $this->getDeleted($htmlEntities) ,
						'width' => $this->getWidth($htmlEntities) ,
						'height' => $this->getHeight($htmlEntities) ,
						'caption' => $this->getCaption($htmlEntities)
					);

					$rs->MoveNext();
				}

				$this->idPhoto = NULL;
				$this->tableFk = NULL;
				$this->idFk = NULL;
				$this->name = NULL;
				$this->main = NULL;
				$this->deleted = NULL;
				$this->width = NULL;
				$this->height = NULL;
				$this->caption = NULL;

				return $list;
			}
		}
		else
		{
			$this->addError(CPHOTO_GETLIST_TOTAL_LIST_ERROR);

			return FALSE;
		}
	}

	/**
	 * Devuelve el último valor ID insertado en la tabla photo
	 *
	 * @return integer|boolean
	 * @access public
	 */
	public function getLastIdPhoto()
	{
		$sql = 'SELECT MAX('.$this->getFieldSql('id_photo').') AS '.$this->getFieldSql('idPhoto').' FROM '.$this->getTableSql();

		$row = $this->getDbConn()->GetRow($sql);

		if ($row === FALSE)
		{
			$this->addError(CPHOTO_GET_LAST_ID_PHOTO_ERROR);

			return FALSE;
		}
		else
		{
			return $row['idPhoto'];
		}
	}

	/**
	 * Photo IFRAME
	 *
	 * Este método imprime el IFRAME para el manejo de las fotos e imprime un campo hidden para el control
	 * de la foto principal.
	 * Debe estar seteada la propiedad {@link $tableFk tableFk}
	 *
	 * @param string $title [opcional] título
	 * @param string $file [opcional] archivo del iframe
	 * @param string $width [opcional] ancho del iframe
	 * @param string $height [opcional] alto del iframe
	 * @return mixed
	 * @access public
	 */
	public function showIframePhoto($title = CPHOTO_SHOW_IFRAME_PHOTO_DEFAULT_TITLE, $file = 'photo-add.php', $width = '100%', $height = '330')
	{
		if (validateRequiredValue($this->tableFk) === FALSE)
		{
			?>
            <div class="title"><?php echo $title; ?></div>
            <div class="content">
                <br /><br />
                <div class="message error">
                    <ul><li><?php echo CPHOTO_SHOW_IFRAME_PHOTO_REQUIRED_TABLE_FK; ?></li></ul>
                </div>
                <br /><br />
			</div>
			<?php
		}
		else
		{
			$params = '?tableFk='.base64_encode($this->getTableFk());

			if (validateRequiredValue($this->idFk) === TRUE)
			{
				//si está seteada esta propiedad significa que está modificando un registro de la Tabla FK

				if (validateRequiredValue($_POST[lowerCamelCase('update_'.$this->tableFk)]) === FALSE)
				{
					//si la variable $_POST['updateTabla'] no tiene ningún valor significa que está ingresando para modificar un registro
					//no está guardando ($_POST['updateTabla'] == 'update') o no está volviendo de un error ($_POST['updateTabla'] == 'back')

					//actualizo las fotos eliminadas temporalmente, por si canceló o cambió de página sin guardar los cambios
					$this->updateDeleted();

					//genero un nuevo valor temporal
					$_SESSION['tempPhoto'] = time();
					$this->tempPhoto       = $_SESSION['tempPhoto'];

					//obtengo la foto principal
					$this->tempMain       = $this->getMainPhoto();
					$_SESSION['tempMain'] = $this->tempMain;
					$_POST['tempMain']    = $this->tempMain;
				}

				$params.= '&idFk='.base64_encode($this->getIdFk());
			}
			else
			{
				//si NO está seteada la propiedad ID FK significa que está dando de alta un nuevo registro de la Tabla Fk

				if (validateRequiredValue($_POST[lowerCamelCase('add_'.$this->tableFk)]) === FALSE)
				{
					//si la variable $_POST['addTabla'] no tiene ningún valor significa que está ingresando para dar de alta un registro
					//no está guardando ($_POST['addTabla'] == 'add') o no está volviendo de un error ($_POST['addTabla'] == 'back')

					//genero un nuevo valor temporal
					$_SESSION['tempPhoto'] = time();
					$this->tempPhoto       = $_SESSION['tempPhoto'];

					//inicializo la foto principal
					$_SESSION['tempMain'] = '';
					$_POST['tempMain']    = '';
					$this->tempMain       = '';
				}
			}

			$params.= '&photosLimit='.base64_encode($this->photosLimit);
			?>
            <script>
            $(document).ready(function () {
                $('#photoDialog').dialog({
                    autoOpen: false,
            		modal: true,
                    resizable: false,
                    close: function( event, ui ) {
                        $('#photoDialogImg').prop('src', '');
                    }
                });
            });
            </script>
            <div id="photoDialog" title="<?php echo CPHOTO_PHOTO_DIALOG_TITLE; ?>"><div style="text-align: center;"><img id="photoDialogImg" src="" /></div></div>
            <input name="tempMain" type="hidden" id="tempMain" value="<?php echo $this->tempMain; ?>" />
            <div class="title"><?php echo $title; ?></div>
            <div class="content">
				<iframe src="<?php echo $file.$params; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" scrolling="auto"><?php echo CPHOTO_SHOW_IFRAME_PHOTO_IFRAMES_ERROR; ?></iframe>
			</div>
			<?php
		}
	}

	/**
	 * Formulario para agregar fotos
	 *
	 * Este método muestra un formulario para agregar fotos, muestra las fotos agregadas, permite eliminar fotos
	 * y permite elegir la foto principal.
	 * Debe estar seteada la propiedad {@link $tableFk tableFk}
	 *
	 * @param string $images [opcional] url donde se encuentran las imágenes que se pueden utilizar en este método
	 * @param string $previewFile [opcional] archivo php donde se obtiene en forma dinámica un preview de las fotos
	 * @param string $delFile [opcional] archivo php donde se eliminan las fotos
	 * @param boolean $main [opcional] indica si se utiliza el checkbox para seleccionar la foto principal
	 * @param boolean $caption [opcional] indica si se utiliza el input text para la leyenda de las fotos
	 * @param boolean $crop [opcional] indica si se utiliza la herramienta crop
	 * @param string $cropFile [opcional] url donde se implementa la herramienta crop
	 * @return mixed
	 * @access public
	 */
	public function addPhotoForm($images = '', $previewFile = 'photo-preview.php', $delFile = 'photo-del.php', $main = TRUE, $caption = FALSE, $crop = FALSE, $cropFile = 'photo-crop.php')
	{
		if (validateRequiredValue($this->tableFk) === FALSE)
		{
			?>
            <br /><br />
            <div class="message error">
                <ul><li><?php echo CPHOTO_ADD_PHOTO_FORM_REQUIRED_TABLE_FK; ?></li></ul>
            </div>
            <br /><br />
			<?php
		}
		else
		{
			$params = '&tableFk='.base64_encode($this->getTableFk());

			if (isset($_POST['addPhoto']) === FALSE)
			{
				$_POST['addPhoto'] = '';
			}

			if ($_POST['addPhoto'] == 'add')
			{
				$auxTableFk = $this->tableFk;
				$auxIdFk    = $this->idFk;

				//obtengo la cantidad de fotos cargadas
				if (validateRequiredValue($this->idFk) === TRUE)
				{
					//si está seteada esta propiedad significa que está modificando un registro de la Tabla FK
					$photoList = $this->getPhotos(TRUE, TRUE);
				}
				else
				{
					$photoList = $this->getPhotosTemp();
				}

				$this->tableFk = $auxTableFk;
				$this->idFk    = $auxIdFk;

				$totalPhotos = count($photoList);

				if ($this->photosLimit == 0 or ($this->photosLimit > 0 and  $totalPhotos < $this->photosLimit))
				{
					$this->addTempPhoto();
				}
				else
				{
					$this->addError(CPHOTO_ADD_PHOTO_FORM_PHOTOS_LIMIT_ERROR.$this->photosLimit);
				}
			}

			if (validateRequiredValue($this->idFk) === TRUE)
			{
				$params.= '&idFk='.base64_encode($this->getIdFk());

				//si está seteada esta propiedad significa que está modificando un registro de la Tabla FK
				$photoList = $this->getPhotos(TRUE, TRUE);
			}
			else
			{
				$photoList = $this->getPhotosTemp();
			}
			?>
            <form name="photoForm" id="photoForm" method="post" action="" enctype="multipart/form-data">
            <input name="addPhoto" type="hidden" id="addPhoto" value="add" />
			<div class="fields photo">
                <div class="field">
                    <input name="fotoFile" type="file" id="fotoFile" />
				</div>
            </div>
            <div class="buttons photo">
                <input type="button" name="btnAddPhoto" id="btnAddPhoto" value="<?php echo CPHOTO_ADD_PHOTO_FORM_ADD_PHOTO_BTN; ?>" class="add" onclick="addPhotoSubmit()" />
            </div>
            <div class="list photo">
            <?php
			if ($this->error() !== FALSE)
			{
				?>
                <div class="fields photo">
					<div class="message error"><?php $this->showErrors(); ?></div>
                </div>
				<?php
			}

			if (is_array($photoList) === TRUE and count($photoList) > 0)
			{
				$file = new Cfile();
                ?>
                <ul class="photo">
                <?php
				foreach ($photoList as $photo)
				{
					if ($photo['idPhoto'] == 0)
					{
						$_t = 'true';
						$_url = $this->getPhotoTempUrl().$photo['name'];
					}
					else
					{
						$_t = 'false';
						$_url = $this->getPhotoUrl().$photo['name'];
					}
					?>
                    <li>
                        <div class="thumb"><a href="#" onclick="openPhotoDialog('<?php echo $_url; ?>', <?php echo $photo['width']; ?>, <?php echo $photo['height']; ?>); return false;"><img id="<?php echo base64_encode($photo['name']); ?>" src="<?php echo $previewFile.'?p='.base64_encode($photo['name']).'&t='.$_t.$params.'&r='.mt_rand(); ?>" /></a></div>
					<?php
					if ($main === TRUE)
					{
					?>
                        <div class="main"><input name="mainPhoto" type="radio" value="<?php echo $photo['name']; ?>" onclick="updateMain('<?php echo $photo['name']; ?>')" /><span><?php echo CPHOTO_ADD_PHOTO_FORM_LABEL_MAIN; ?></span></div>
					<?php
					}
					?>
                        <div class="actions">
                    <?php
					if ($crop === TRUE)
					{
					?>
                            <a href="<?php echo $cropFile; ?>?p=<?php echo base64_encode($photo['name']).'&t='.$_t.'&idPhoto='.$photo['idPhoto'].$params; ?>" title="<?php echo CPHOTO_ADD_PHOTO_FORM_CROP_TITLE; ?>" class="crop" target="_blank" onclick="openCropPhotoForm(this.href); return false;"></a>
					<?php
					}
					?>
                            <a href="<?php echo $delFile.'?p='.base64_encode($photo['name']).'&t='.$_t.'&idPhoto='.$photo['idPhoto'].$params; ?>" title="<?php echo CPHOTO_ADD_PHOTO_FORM_DEL_TITLE; ?>" class="del"></a>
                        </div>
					<?php
					if ($caption === TRUE)
					{
						$file->setFile($photo['name']);
						$captionId = lowerCamelCase($this->tempPhoto.'_caption_'.$file->getFile(FALSE));

						if (isset($_SESSION[$captionId]) === FALSE)
						{
							$_SESSION[$captionId] = $photo['caption'];
						}
						$this->setCaption($_SESSION[$captionId]);
					?>
                        <div class="caption">
                            <input name="<?php echo $captionId; ?>" id="<?php echo $captionId; ?>" type="text" onblur="saveCaption('<?php echo $captionId; ?>'); return false;" value="<?php echo $this->getCaption(); ?>" maxlength="255" />
                        </div>
					<?php
					}
					?>
                        <div class="clear"></div>
                    </li>
					<?php
				}
                ?>
                </ul>
                <?php
			}
			?>
            </div>
			</form>
			<?php
		}
	}

	/**
	 * Agrega una foto en el directorio de fotos temporales
	 *
	 * @return boolean
	 * @access public
	 */
	public function addTempPhoto()
	{
		$file = new Cfile();

        $file->setDir($this->getPhotoTempPath());
        $file->setFile($_FILES['fotoFile']['name']);

		if ($this->validateExtension($file->getExtension(TRUE)) === TRUE)
		{
			$i = 1;
            $file->setFile($this->tempPhoto.'_'.$i.'.'.$file->getExtension(TRUE));

			while ($file->existFile() === TRUE)
			{
				$i++;
				$file->setfile($this->tempPhoto.'_'.$i.'.'.$file->getExtension(TRUE));
			}
			if (move_uploaded_file($_FILES['fotoFile']['tmp_name'], $file->getDir().$file->getFile()))
			{
				return TRUE;
			}
			else
			{
                $this->addError(CPHOTO_ADD_TEMP_PHOTO_UPLOAD_ERROR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CPHOTO_ADD_TEMP_PHOTO_INVALID_EXTENSION.' '.implode(', ', $this->allowedExtensions));

            return FALSE;
		}
	}

	/**
	 * Devuelve las fotos temporales de una "transacción"
	 *
	 * @return array
	 * @access public
	 */
	public function getPhotosTemp()
	{
		$file = new Cfile();

        $file->setDir($this->getPhotoTempPath());

		$tempList = array();

		$list = $file->getListDir();

		if (is_array($list) and count($list) > 0)
		{
			$image = new Cimage();

			$i = 1;

			foreach ($list as $row)
			{
				if ($row['type'] == 'F')
				{
					$file->setFile($row['name']);

                    if ($this->validateExtension($file->getExtension(TRUE)) === TRUE)
					{
                        if (preg_match('/'.$this->tempPhoto.'/', $row['name']))
						{
							$image->setSource($this->getPhotoTempPath().$row['name']);
							$info = $image->getImageInfo();

							if ($info !== FALSE)
							{
								$_width  = $info['width'];
								$_height = $info['height'];
							}
							else
							{
								$_width  = 0;
								$_height = 0;
							}

							$tempList[] = array('idPhoto' => 0, 'name' => $row['name'], 'width' => $_width, 'height' => $_height, 'caption' => '', 'order' => $i);

							$i++;
						}
					}
				}
			}
		}

		$tempList = $this->sortPhotos($tempList);

		return $tempList;
	}

	/**
	 * Devuelve las fotos de un registro de la Tabla FK
	 *
	 * Este método devuelve las fotos de un registro de la Tabla FK.
	 *
	 * Si el parámetro $temp es TRUE incluye también las fotos temporales que se están agregando a ese registro (generalmente esto es para la sección del administrador).
	 * Si el parámetro $temp es FALSE no se incluyen fotos temporales (generalmente esto se utiliza para la sección de usuarios).
	 *
	 * Si el parámetro $deleted es TRUE en el listado se incluyen sólo las fotos que no están marcadas como eliminadas (`deleted` = 'no').
	 * Si el parámetro $deleted es FALSE en el listado se incluyen todas las fotos, no se tiene en cuenta si están marcadas como borradas o no.
	 *
	 * @param boolean $temp [opcional] indica si se obtienen también las fotos temporales
	 * @param boolean $deleted [opcional] indica si se tiene en cuenta el campo de borrado lógico en la consulta de las fotos
	 * @return boolean|array
	 * @access public
	 */
	public function getPhotos($temp = FALSE, $deleted = TRUE)
	{
		if (validateRequiredValue($this->tableFk) === FALSE or validateRequiredValue($this->idFk) === FALSE)
		{
			$this->addError(CPHOTO_GET_PHOTOS_REQUIRED_VALUES);

			return FALSE;
		}
		else
		{
			$photoList = array();

			//consulto las fotos de la BD
			if ($deleted === FALSE)
			{
                $search = $this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk).' AND '.$this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk);
			}
			else
			{
                $search = $this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk).' AND '.$this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk).' AND '.$this->getFieldSql('deleted').' = '.$this->getValueSql('no');
			}

			$order = $this->getFieldSql('id_photo').' ASC';

            $auxTableFk = $this->tableFk;
			$auxIdFk    = $this->idFk;

			$list = $this->getList($search, 0, 0, $order, FALSE);

			$this->tableFk = $auxTableFk;
			$this->idFk    = $auxIdFk;

			if ($this->getTotalList() > 0)
			{
				foreach ($list as $row)
				{
					$photoList[] = array('idPhoto' => $row['idPhoto'], 'name' => $row['name'], 'width' => $row['width'], 'height' => $row['height'], 'caption' => $row['caption']);
				}
			}

			if ($temp === TRUE)
			{
				//agrego las fotos temporales
				$tempList = $this->getPhotosTemp();

				if (count($tempList) > 0)
				{
					foreach ($tempList as $row)
					{
						$photoList[] = array('idPhoto' => $row['idPhoto'], 'name' => $row['name'], 'width' => $row['width'], 'height' => $row['height'], 'caption' => $row['caption']);
					}
				}
			}

			return $photoList;
		}
	}

	/**
	 * Realiza una vista preliminar de una foto de acuerdo a los valores seteados
	 *
	 * @param boolean $isAdmin [opcional] indica si el preview se hace en la sección de administrador o no
	 * @access public
	 */
	public function previewPhoto($isAdmin = TRUE)
	{
		$file = new Cfile();

        if ($this->getIsTemp() === TRUE)
		{
			if ($file->existFile($this->getPhotoThumbsTempPath().$this->getName(FALSE)) === TRUE)
			{
				$source = $this->getPhotoThumbsTempPath().$this->getName(FALSE);
			}
			else
			{
				$source = $this->getPhotoTempPath().$this->getName(FALSE);
			}
		}
		else
		{
			if ($file->existFile($this->getPhotoThumbsTempPath().$this->tempPhoto.'_'.$this->getName(FALSE)) === TRUE)
			{
				$source = $this->getPhotoThumbsTempPath().$this->tempPhoto.'_'.$this->getName(FALSE);
			}
			else
			{
				$source = $this->getPhotoThumbsPath().$this->getName(FALSE);
			}
		}

		if ($isAdmin === TRUE)
		{
			$width  = $this->getPhotoTempThumbsWidth();
			$height = ceil($this->getPhotoThumbsHeight() * $this->getPhotoTempThumbsWidth() / $this->getPhotoThumbsWidth());
		}
		else
		{
			$width  = $this->getPhotoThumbsWidth();
			$height = $this->getPhotoThumbsHeight();
		}

		$image = new Cimage();
		$image->setSource($source);
		$image->resize($width, $height, '', 75);
	}

	/**
	 * Guarda en la base de datos y en los directorios seteados las fotos cargadas cuando se inserta un registro de la Tabla FK
	 *
	 * Deben estar seteados los path correspondientes y las propiedades {@link $tableFk} y {@link $idFk}
	 *
	 * @param string $str [opcional] cadena que se agrega al nombre de las fotos
	 * @return array|boolean
	 * @access public
	 */
	public function addPhotos($str = '')
	{
		if (validateRequiredValue($this->tableFk) === FALSE or validateRequiredValue($this->idFk) === FALSE)
		{
			$this->addError(CPHOTO_ADD_PHOTOS_REQUIRED_VALUES);

			return FALSE;
		}
		else
		{
			//array con el nombre temporal de la foto que se agrego y el nombre final con que quedó
			$addedPhotos = array();

			//obtengo las fotos temporales cargadas de la "transacción"
			$list = $this->getPhotosTemp();

			if (count($list) > 0)
			{
				$file = new Cfile();

                $image = new Cimage();

                $i = 1;

				foreach ($list as $row)
				{
					$file->setFile($row['name']);

					$this->setName($str.'_'.$this->idFk.'_'.$i.'.'.$file->getExtension(TRUE));

					//si no está definida la foto principal, asigno una por defecto
					if ($this->tempMain == '')
					{
						$this->tempMain = $row['name'];
					}
					if ($row['name'] == $this->tempMain)
					{
						$this->setMain('yes');
					}
					else
					{
						$this->setMain('no');
					}

					$this->setDeleted('no');

					$this->setWidth($row['width']);
					$this->setHeight($row['height']);

                    $captionId = lowerCamelCase($this->tempPhoto.'_caption_'.$file->getFile(FALSE));
					if (isset($_SESSION[$captionId]) === TRUE)
					{
						$this->setCaption($_SESSION[$captionId]);
					}

                    //Verifico si existe ese nombre de archivo en el directorio de los thumb temporales.
					//Si existe en ese directorio significa que se utilizó la herramienta crop

					$file->setDir($this->getPhotoThumbsTempPath());

					if ($file->existFile() === TRUE)
					{
						//si existe el thumb temporal lo muevo al directorio correspondiente y lo renombro
						$file->moveFile($this->getPhotoThumbsPath(), $this->getName(FALSE));
					}
					else
					{
						//si no existe el thumb temporal lo creo en el directorio correspondiente
						$image->setSource($this->getPhotoTempPath().$file->getFile());
						$image->resize($this->getPhotoThumbsWidth(), $this->getPhotoThumbsHeight(), $this->getPhotoThumbsPath().$this->getName(FALSE), 100);
					}

					//muevo el archivo original de la foto al directorio correspondiente
					$file->setDir($this->getPhotoTempPath());
					$file->moveFile($this->getPhotoPath(), $this->getName(FALSE));

					//guardo la foto en la base de datos
					if ($this->add() === TRUE)
					{
						$addedPhotos[] = array('temp' => $file->getFile() , 'name' => $this->getName(FALSE));

						$i++;
					}
					else
					{
						$addedPhotos[] = array('temp' => $file->getFile() , 'name' => '');
					}
				}
			}

			return $addedPhotos;
		}
	}

	/**
	 * Actualiza las fotos eliminadas temporalmente (`deleted` = 'yes') y las pone como no eliminadas (`deleted` = 'no')
	 *
	 * @access public
	 */
	public function updateDeleted()
	{
		if (validateRequiredValue($this->tableFk) === FALSE or validateRequiredValue($this->idFk) === FALSE)
		{
			$this->addError(CPHOTO_UPDATE_DELETED_REQUIRED_VALUES);

            return FALSE;
		}
		else
		{
			$sql = 'UPDATE '.$this->getTableSql().' SET '.$this->getFieldSql('deleted').' = '.$this->getValueSql('no').' WHERE '.$this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk).' AND '.$this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk);

            $this->getDbConn()->Execute($sql);
		}
	}

	/**
	 * Devuelve el nombre de la foto principal
	 *
	 * @access public
	 */
	public function getMainPhoto()
	{
		if (validateRequiredValue($this->tableFk) === FALSE or validateRequiredValue($this->idFk) === FALSE)
		{
            $this->addError(CPHOTO_GET_MAIN_PHOTO_REQUIRED_VALUES);

			return FALSE;
		}
		else
		{
			$sql = 'SELECT * FROM '.$this->getTableSql().' WHERE '.$this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk).' AND '.$this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk).' AND '.$this->getFieldSql('main').' = '.$this->getValueSql('yes').' AND '.$this->getFieldSql('deleted').' = '.$this->getValueSql('no');

			$row = $this->getDbConn()->GetRow($sql);

			if (is_array($row) === TRUE and count($row) > 0)
			{
				return $row['name'];
            }
            else
            {
                return FALSE;
            }
		}
	}

	/**
	 * Guarda en la base de datos y en los directorios seteados las fotos cargadas cuando se modifica un registro de la Tabla FK
	 *
	 * Deben estar seteados los path correspondientes y las propiedades {@link $tableFk} y {@link $idFk}
	 *
	 * @param string $str [opcional] cadena que se agrega al nombre de las fotos
	 * @return array|boolean
	 * @access public
	 */
	public function updatePhotos($str = '')
	{
		if (validateRequiredValue($this->tableFk) === FALSE or validateRequiredValue($this->idFk) === FALSE)
		{
			$this->addError(CPHOTO_UPDATE_PHOTOS_REQUIRED_VALUES);

			return FALSE;
		}
		else
		{
			$file = new Cfile();

            $auxTableFk = $this->tableFk;
			$auxIdFk    = $this->idFk;

			//1 - primero me fijo si eliminó alguna foto

			//array con el nombre de las fotos eliminadas
			$deletedPhotos = '';

			$search = $this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk).' AND '.$this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk).' AND '.$this->getFieldSql('deleted').' = '.$this->getValueSql('yes');
            $list   = $this->getList($search);

			$this->tableFk = $auxTableFk;
			$this->idFk    = $auxIdFk;

			if ($this->getTotalList() > 0)
			{
				foreach ($list as $row)
				{
					//elimino físicamente
					$file->setFile($row['name']);

					$file->setDir($this->getPhotoThumbsPath());
					$file->delFile();

					$file->setDir($this->getPhotoPath());
					$file->delFile();

					//elimino de la base de datos
					$this->setIdPhoto($row['idPhoto']);
					$this->del();

					$deletedPhotos[] = $row['name'];
				}
			}

			//2 - ahora actualizo el main de las fotos existentes (si es que cambio), obtengo el ultimo nombre de foto guardado y actualizo los caption

			$sql = 'UPDATE '.$this->getTableSql().' SET '.$this->getFieldSql('main').' = '.$this->getValueSql('no').' WHERE '.$this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk).' AND '.$this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk);
			$this->getDbConn()->Execute($sql);

			$fileName = '';
			$idFile   = '';

			$search = $this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk).' AND '.$this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk);
            $order  = $this->getFieldSql('id_photo').' DESC';
            $list   = $this->getlist($search, 0, 0, $order);

            $this->tableFk = $auxTableFk;
			$this->idFk    = $auxIdFk;

			if ($this->getTotalList() > 0)
			{
				foreach ($list as $row)
				{
					if ($fileName == '')
					{
                        $fileName = $row['name'];
					}

					$file->setFile($row['name']);

					$this->setIdPhoto($row['idPhoto']);
					$this->setName($row['name']);
					$this->setDeleted('no');
					$this->setWidth($row['width']);
					$this->setHeight($row['height']);

                    $captionId = lowerCamelCase($this->tempPhoto.'_caption_'.$file->getFile(FALSE));
					if (isset($_SESSION[$captionId]) === TRUE)
					{
						$this->setCaption($_SESSION[$captionId]);
					}

					if ($row['name'] == $this->tempMain)
					{

						$this->setMain('yes');
					}
					else
					{
						$this->setMain('no');
					}

					$this->update();
				}

				$file->setFile($fileName);
				$values  = explode('_', $file->getFile(FALSE));

                //tomo el último
				$idFile = $values[count($values) - 1];
			}

			//3 - ahora me fijo si se hicieron nuevos thumbs con el crop para las fotos ya guardadas
			$search = $this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk).' AND '.$this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk).' AND '.$this->getFieldSql('deleted').' = '.$this->getValueSql('no');
            $list = $this->getList($search);

			$this->tableFk = $auxTableFk;
			$this->idFk    = $auxIdFk;

			if ($this->getTotalList() > 0)
			{
				foreach ($list as $row)
				{
					//verifico si existe el thumb en el directorio de los thumb temporales.
					if ($file->existFile($this->getPhotoThumbsTempPath().$this->tempPhoto.'_'.$row['name']) === TRUE)
					{
						//elimino el thumb viejo
						$file->setDir($this->getPhotoThumbsPath());
						$file->setFile($row['name']);
						$file->delFile();

						//muevo el thumb nuevo
						$file->setDir($this->getPhotoThumbsTempPath());
						$file->setFile($this->tempPhoto.'_'.$row['name']);
						$file->moveFile($this->getPhotoThumbsPath(), $row['name']);
					}
				}
			}

			//4 - ahora me fijo si se cargaron nuevas fotos

			//array con el nombre temporal de la foto que se agrego y el nombre final con que quedó
			$addedPhotos = array();

			//obtengo las fotos temporales cargadas de la "transacción"
			$list = $this->getPhotosTemp();

			if (count($list) > 0)
			{
				$image = new Cimage();

                if ($idFile == '')
				{
					$i = 1;
				}
				else
				{
					$i = $idFile + 1;
				}

				unset($this->idPhoto);

				foreach ($list as $row)
				{
					$file->setFile($row['name']);

					$this->setName($str.'_'.$this->idFk.'_'.$i.'.'.$file->getExtension(TRUE));

					if ($row['name'] == $this->tempMain)
					{
						$this->setMain('yes');
					}
					else
					{
						$this->setMain('no');
					}

					$this->setDeleted('no');

					$this->setWidth($row['width']);
					$this->setHeight($row['height']);

                    $captionId = lowerCamelCase($this->tempPhoto.'_caption_'.$file->getFile(FALSE));
					if (isset($_SESSION[$captionId]) === TRUE)
					{
						$this->setCaption($_SESSION[$captionId]);
					}

					//Verifico si existe ese nombre de archivo en el directorio de los thumb temporales.
					//Si existe en ese directorio significa que se utilizó la herramienta crop
					$file->setDir($this->getPhotoThumbsTempPath());

					if ($file->existFile() === TRUE)
					{
						//si existe el thumb temporal lo muevo al directorio correspondiente y lo renombro
						$file->moveFile($this->getPhotoThumbsPath(), $this->getName(FALSE));
					}
					else
					{
						//si no existe el thumb temporal lo creo en el directorio correspondiente
						$image->setSource($this->getPhotoTempPath().$file->getFile());
						$image->resize($this->getPhotoThumbsWidth(), $this->getPhotoThumbsHeight(), $this->getPhotoThumbsPath().$this->getName(FALSE), 100);
					}

					//muevo el archivo original de la foto al directorio correspondiente
					$file->setDir($this->getPhotoTempPath());
					$file->moveFile($this->getPhotoPath(), $this->getName(FALSE));

					//guardo la foto en la base de datos
					if ($this->add() === TRUE)
					{
						$addedPhotos[] = array('temp' => $file->getFile() , 'name' => $this->getName(FALSE));

                        $i++;
					}
					else
					{
						$addedPhotos[] = array('temp' => $file->getFile() , 'name' => '');
					}
				}
			}

			//5 - control de foto principal: si no hay ninguna foto principal asigno una por defecto
            $search = $this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk).' AND '.$this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk).' AND '.$this->getFieldSql('main').' = '.$this->getValueSql('yes');
			$list   = $this->getList($search);

            $this->tableFk = $auxTableFk;
			$this->idFk    = $auxIdFk;

			if ($this->getTotalList() < 1)
			{
				$search = $this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk).' AND '.$this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk);
                $order  = $this->getFieldSql('name').' ASC';
                $list   = $this->getList($search, 1, 0, $order);

				$this->tableFk = $auxTableFk;
                $this->idFk    = $auxIdFk;

				if ($this->getTotalList() > 0)
				{
					foreach ($list as $row)
					{
						$this->setIdPhoto($row['idPhoto']);
						$this->setName($row['name']);
						$this->setMain('yes');
						$this->setDeleted('no');
						$this->setWidth($row['width']);
						$this->setHeight($row['height']);
						$this->update();

						break;
					}
				}
			}

			return array ($deletedPhotos, $addedPhotos);
		}
	}

	/**
	 * Este método elimina las fotos de un registro de la Tabla FK
	 *
	 * Las fotos se eliminan de la base de datos y físicamente. Deben estar seteados los path correspondientes
	 * y las propiedades {@link $tableFk} y {@link $idFk}
	 *
	 * @return boolean
	 * @access public
	 */
	public function deletePhotos()
	{
		if (validateRequiredValue($this->tableFk) === FALSE or validateRequiredValue($this->idFk) === FALSE)
		{
			$this->addError(CPHOTO_DELETE_PHOTOS_REQUIRED_VALUES);

			return FALSE;
		}
		else
		{
			$search = $this->getFieldSql('table_fk').' = '.$this->getValueSql($this->tableFk).' AND '.$this->getFieldSql('id_fk').' = '.$this->getValueSql($this->idFk);
            $list   = $this->getlist($search);

			if ($this->getTotalList() > 0)
			{
				$file = new Cfile();

                foreach ($list as $row)
				{
					//elimino físicamente
					$file->setFile($row['name']);

					$file->setDir($this->getPhotoThumbsPath());
					$file->delFile();

					$file->setDir($this->getPhotoPath());
					$file->delFile();

					//elimino de la base de datos
					$this->setIdPhoto($row['idPhoto']);
					$this->del();
				}
			}

			return TRUE;
		}
	}

	/**
	 * Este método elimina las fotos temporales o marca las fotos (`deleted` = 'yes') para ser borradas al guardar
	 *
	 * Deben estar seteados los path correspondientes
	 *
	 * @return boolean
	 * @access public
	 */
	public function deletePhotosTemporarily()
	{
		if ($this->getIsTemp() === TRUE)
		{
			//es una foto temporal
			if (validateRequiredValue($this->getPhotoTempPath()) === FALSE)
			{
				$this->addError(CPHOTO_DELETE_PHOTOS_TEMPORARILY_REQUIRED_PHOTO_TEMP_PATH);

                return FALSE;
			}

            $file = new Cfile();

			$file->setDir($this->getPhotoTempPath());
			$file->setFile($this->getName(FALSE));
			$file->delFile();

			//borro el thumb temporal si existe
			$file->setDir($this->getPhotoThumbsTempPath());
			if ($file->existFile() === TRUE)
			{
				$file->delFile();
			}

			//elimino el caption
            $captionId = lowerCamelCase($this->tempPhoto.'_caption_'.$file->getFile(FALSE));
			if (isset($_SESSION[$captionId]) === TRUE)
			{
				$_SESSION[$captionId] = '';
			}

			return TRUE;
		}
		else
		{
			//es una foto registrada en la BD
			if (validateRequiredValue($this->getIdPhoto()) === FALSE)
			{
				$this->addError(CPHOTO_DELETE_PHOTOS_TEMPORARILY_REQUIRED_ID_PHOTO);

				return FALSE;
			}

			$this->setDeleted('yes');

			return $this->update();
		}
	}

	/**
	 * Este método elimina las fotos temporales antiguas
	 *
	 * Deben estar seteados los path correspondientes
	 *
	 * @return boolean
	 * @access public
	 */
	public function deleteOldTempPhotos()
	{
		if (validateRequiredValue($this->getPhotoTempPath()) === FALSE)
		{
			$this->addError(CPHOTO_DELETE_OLD_TEMP_PHOTOS_REQUIRED_PHOTO_TEMP_PATH);

			return FALSE;
		}
		else
		{
			$file = new Cfile;

            //marca actual
            $temp = time();

			//este es el tiempo que utilizo para determinar si elimino los temporales o no
			//un día (en segundos) (1 * 24 * 60 * 60)
            $time = 86400;

			//recorro el directorio de las fotos temporales
			$file->setDir($this->getPhotoTempPath());

			$list = $file->getListDir();

			if (is_array($list) and count($list) > 0)
			{
				foreach ($list as $row)
				{
					$file->setFile($row['name']);

					if ($this->validateExtension($file->getExtension(TRUE)) === TRUE)
					{
						//otengo sólo la marca del archivo temporal
						$parts = explode('_', $file->getFile(FALSE));

						$fileTemp = $parts[0];

						//diferencia entre la marca del temporal y la marca actual
						$result = $temp - $fileTemp;

						//si la diferencia es mayor al tiempo de control elimino el temporal
						if ($result > $time)
						{
							$file->delFile();
						}
					}
				}
			}

			//recorro el directorio de los thumbs de las fotos temporales
			$file->setDir($this->getPhotoThumbsTempPath());

			$list = $file->getListDir();

			if (is_array($list) and count($list) > 0)
			{
				foreach ($list as $row)
				{
					$file->setFile($row['name']);

					if ($this->validateExtension($file->getExtension(TRUE)) === TRUE)
					{
						//otengo sólo la marca del archivo temporal
						$parts = explode('_', $file->getFile(FALSE));

						$fileTemp = $parts[0];

						//diferencia entre la marca del temporal y la marca actual
						$result = $temp - $fileTemp;

						//si la diferencia es mayor al tiempo de control elimino el temporal
						if ($result > $time)
						{
							$file->delFile();
						}
					}
				}
			}
		}
	}

	/**
	 * Este método controla que estén creados los directorios necesarios
	 *
	 * El método controla que estén creados los siguientes directorios: {@link $photoTempPath},
	 * {@link $photoPath}, {@link $photoThumbsTempPath} y {@link $photoThumbsPath}.
	 * Si alguno de estos directorios no existe el método intenta crearlos.
	 * Los directorios deben estar seteados.
	 *
	 * @return boolean
	 * @access public
	 */
	public function pathControl()
	{
		$file = new Cfile();

        //photoPath
		if (validateRequiredValue($this->getPhotoPath()) === FALSE)
		{
			$this->addError(CPHOTO_PATH_CONTROL_PHOTO_PATH_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$file->setDir($this->getPhotoPath());

			if ($file->existDir() === FALSE)
			{
				$file->createDir(0755);
			}
		}

        //photoTempPath
		if (validateRequiredValue($this->getPhotoTempPath()) === FALSE)
		{
			$this->addError(CPHOTO_PATH_CONTROL_PHOTO_TEMP_PATH_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$file->setDir($this->getPhotoTempPath());

			if ($file->existDir() === FALSE)
			{
				$file->createDir(0755);
			}
		}

		//photoThumbsTempPath
		if (validateRequiredValue($this->getPhotoThumbsTempPath()) === FALSE)
		{
			$this->addError(CPHOTO_PATH_CONTROL_PHOTO_THUMBS_TEMP_PATH_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$file->setDir($this->getPhotoThumbsTempPath());

			if ($file->existDir() === FALSE)
			{
				$file->createDir(0755);
			}
		}

		//photoThumbsPath
		if (validateRequiredValue($this->getPhotoThumbsPath()) === FALSE)
		{
			$this->addError(CPHOTO_PATH_CONTROL_PHOTO_THUMBS_PATH_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$file->setDir($this->getPhotoThumbsPath());

			if ($file->existDir() === FALSE)
			{
				$file->createDir(0755);
			}
		}
	}

	/**
	 * Este método controla que la extensión del archivo sea válida
	 *
	 * @param string $ext Extensión a validar
	 * @return boolean
	 * @access public
	 */
	public function validateExtension($ext)
	{
		if (validateRequiredValue($ext) === TRUE)
		{
			if (in_array($ext, $this->allowedExtensions) === TRUE)
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

	/**
	 * Muestra un formulario para cortar los thumbs
	 *
	 * Este método muestra un formulario para cortar y modificar el thumb de la foto.
	 *
	 * @param string $previewFile [opcional] archivo php donde se obtiene en forma dinámica un preview de las fotos
	 * @param string $title [opcional] título
	 * @return mixed
	 * @access public
	 */
	public function cropPhotoForm($previewFile = 'photo-preview.php', $title = '')
	{
		if (isset($_POST['crop']) === FALSE)
		{
			$_POST['crop'] = '';
		}

		//title control
		if (validateRequiredValue($title) === FALSE)
		{
			$title = '&nbsp;';
		}

		$image = new Cimage();

		if ($_POST['crop'] == 'true')
		{
			$_POST['x'] = ceil($_POST['x']);
			$_POST['y'] = ceil($_POST['y']);
			$_POST['w'] = ceil($_POST['w']);
			$_POST['h'] = ceil($_POST['h']);

			if (validateIntValue($_POST['x'], '0+') === FALSE or validateIntValue($_POST['y'], '0+') === FALSE or validateIntValue($_POST['w'], '+') === FALSE or validateIntValue($_POST['h'], '+') === FALSE)
			{
				$this->addError(CPHOTO_CROP_PHOTO_FORM_SELECTION_ERROR);
			}

			if ($this->error() === FALSE)
			{
				if ($this->getIsTemp())
				{
					$source   = $this->getPhotoTempPath().$this->getName(FALSE);
					$fileDest = $this->getPhotoThumbsTempPath().$this->getName(FALSE);
					$urlImg   = $this->getPhotoThumbsTempUrl().$this->getName(FALSE);
				}
				else
				{
					$source   = $this->getPhotoPath().$this->getName(FALSE);
					$fileDest = $this->getPhotoThumbsTempPath().$this->tempPhoto.'_'.$this->getName(FALSE);
					$urlImg   = $this->getPhotoThumbsTempUrl().$this->tempPhoto.'_'.$this->getName(FALSE);
				}

				$image->setSource($source);

				//corto la imagen
				if ($image->crop($fileDest, $_POST['x'], $_POST['y'], $_POST['w'], $_POST['h']))
				{
					//si la cortó bien, la redimensiono (el source es el archivo de destino del crop)
					$image->setSource($fileDest);

					if ($image->resize($this->getPhotoThumbsWidth(), $this->getPhotoThumbsHeight(), $image->getSource(), 100) === FALSE)
					{
						$this->addError(CPHOTO_CROP_PHOTO_FORM_RESIZE_ERROR);
					}
				}
				else
				{
					$this->addError(CPHOTO_CROP_PHOTO_FORM_CROP_ERROR);
				}
			}
			?>
			<form name="form_crop" method="post" action="" class="form">
			<input type="hidden" id="crop" name="crop" value="back" />
			<table border="0" cellspacing="0" cellpadding="0" class="crop_tbl">
				<tr class="crop_tr_title">
					<td class="crop_td_title"><?=$title?></td>
				</tr>
				<tr class="crop_tr_separator_top">
					<td class="crop_td_separator_top"></td>
				</tr>
			<?php
			if ($this->error() === FALSE)
			{
				?>
				<tr class="crop_tr">
					<td class="crop_td" align="center">
						<img name="crop_image" id="crop_image" src="<?php echo $urlImg; ?>" border="0" alt="" width="<?php echo $this->getPhotoThumbsWidth(); ?>" height="<?php echo $this->getPhotoThumbsHeight(); ?>" />
					</td>
				</tr>
				<?php
			}
			else
			{
				?>
				<tr class="crop_tr_error">
					<td class="crop_td_error"><div class="text_error"><?php $this->showErrors(); ?></div></td>
				</tr>
				<?php
			}
			?>
				<tr class="crop_tr_sub">
					<td class="crop_td_sub">
						<input type="submit" name="btn_back" value="<?php echo CPHOTO_CROP_PHOTO_FORM_BACK_BTN; ?>" class="input_button" />
						<input type="button" name="btn_close" value="<?php echo CPHOTO_CROP_PHOTO_FORM_CLOSE_BTN; ?>" onclick="window.close()" class="input_button" />
					</td>
				</tr>
				<tr class="crop_tr_info">
					<td class="crop_td_info">
						<b class="text_info"><?php echo CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE; ?></b>
						<div class="text_info">&bull; <?php echo CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE_1; ?></div>
						<div class="text_info">&bull; <?php echo CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE_2; ?></div>
						<div class="text_info">&bull; <?php echo CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE_3; ?></div>
					</td>
				</tr>
				<tr class="crop_tr_separator_bottom">
					<td class="crop_td_separator_bottom"></td>
				</tr>
			</table>
			</form>
			<?php
			if ($this->error() === FALSE)
			{
				$url = $previewFile.'?p='.base64_encode($this->getName(FALSE)).'&t='.($this->getIsTemp() ? 'true' : 'false').'&tableFk='.base64_encode($this->getTableFk()).'&r='.mt_rand();
				?>
			<script type="text/javascript">
				refreshCropThumb('<?php echo base64_encode($this->getName(FALSE)); ?>', '<?php echo $url; ?>');
			</script>
				<?php
			}
		}
		else
		{
			if ($this->getIsTemp() === TRUE)
			{
				$urlImg  = $this->getPhotoTempUrl().$this->getName(FALSE);
				$pathImg = $this->getPhotoTempPath().$this->getName(FALSE);
			}
			else
			{
				$urlImg  = $this->getPhotoUrl().$this->getName(FALSE);
				$pathImg = $this->getPhotoPath().$this->getName(FALSE);
			}

			//obtengo el ancho y alto de la imagen
			$image->setSource($pathImg);
			$imageinfo = $image->getImageInfo();

			//redimensiono la imagen si supera el alto o ancho máximo (sólo con css y html)
			$maxWidth  = 700;
			$maxHeight = 360;

			$previewWidth  = $imageinfo['width'];
			$previewHeight = $imageinfo['height'];

			if ($previewHeight > $maxHeight)
			{
				$previewHeight = $maxHeight;
				$previewWidth  = ceil($previewHeight * $imageinfo['width'] / $imageinfo['height']);
			}

			if ($previewWidth > $maxWidth)
			{
				$previewHeight = ceil($maxWidth * $previewHeight / $previewWidth);
				$previewWidth  = $maxWidth;
			}
			?>
			<script type="text/javascript">
			var ias = '';
			$(document).ready(function () {
					ias = $('#crop_image').imgAreaSelect({
					instance: true,
					aspectRatio: '<?php echo $this->getPhotoThumbsWidth().':'.$this->getPhotoThumbsHeight(); ?>',
					handles: true,
					imageWidth: '<?php echo $imageinfo['width']; ?>',
					imageHeight: '<?php echo $imageinfo['height']; ?>'
				});
			});
			function submitCrop()
			{
				document.formCrop.x.value = ias.getSelection().x1;
				document.formCrop.y.value = ias.getSelection().y1;
				document.formCrop.w.value = ias.getSelection().width;
				document.formCrop.h.value = ias.getSelection().height;
				document.formCrop.submit();
			}
			</script>
			<form name="formCrop" method="post" action="" class="form">
			<input type="hidden" id="crop" name="crop" value="true" />
			<input type="hidden" id="x" name="x" value="" />
			<input type="hidden" id="y" name="y" value="" />
			<input type="hidden" id="w" name="w" value="" />
			<input type="hidden" id="h" name="h" value="" />
			<table border="0" cellspacing="0" cellpadding="0" class="crop_tbl">
				<tr class="crop_tr_title">
					<td class="crop_td_title"><?=$title?></td>
				</tr>
				<tr class="crop_tr_separator_top">
					<td class="crop_td_separator_top"></td>
				</tr>
				<tr class="crop_tr">
					<td class="crop_td" align="center">
						<img name="crop_image" id="crop_image" width="<?php echo $previewWidth; ?>" height="<?php echo $previewHeight; ?>" style="width: <?php echo $previewWidth; ?>px; height: <?php echo $previewHeight; ?>px;" src="<?php echo $urlImg; ?>" border="0" alt="" />
					</td>
				</tr>
				<tr class="crop_tr_sub">
					<td class="crop_td_sub">
						<input type="button" name="btn_submit" value="<?php echo CPHOTO_CROP_PHOTO_FORM_SUBMIT_BTN; ?>" onclick="submitCrop();" class="input_button" />
						<input type="button" name="btn_close" value="<?php echo CPHOTO_CROP_PHOTO_FORM_CLOSE_BTN; ?>" onclick="window.close();" class="input_button" />
					</td>
				</tr>
				<tr class="crop_tr_info">
					<td class="crop_td_info">
						<b class="text_info"><?php echo CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE; ?></b>
						<div class="text_info">&bull; <?php echo CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE_1; ?></div>
						<div class="text_info">&bull; <?php echo CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE_2; ?></div>
						<div class="text_info">&bull; <?php echo CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE_3; ?></div>
					</td>
				</tr>
				<tr class="crop_tr_separator_bottom">
					<td class="crop_td_separator_bottom"></td>
				</tr>
			</table>
			</form>
			<?php
		}
	}

	/**
	 * Lista las fotos para utilizarlas con el script TinyMCE
	 *
	 * Debe estar seteada la propiedad {@link $tableFk}
	 *
	 * @param string $previewFile [opcional] archivo php donde se obtiene en forma dinámica un preview de las fotos
	 * @return mixed
	 * @access public
	 */
	public function listPhotoTinyMCE($previewFile = 'photo-preview.php')
	{
		if (validateRequiredValue($this->tableFk) === FALSE)
		{
			?>
			<div class="text_error"><?php echo CPHOTO_LIST_PHOTO_TINYMCE_REQUIRED_TABLE_FK; ?></div>
			<?php
		}
		else
		{
			$params = '&tableFk='.base64_encode($this->getTableFk());

			$auxTableFk = $this->tableFk;

            if (validateRequiredValue($this->idFk) === TRUE)
			{
				$params.= '&idFk='.base64_encode($this->getIdFk());

				//si está seteada esta propiedad significa que está modificando un registro de la Tabla FK

				$photoList = $this->getPhotos(TRUE, TRUE);
			}
			else
			{
				$photoList = $this->getPhotosTemp();
			}

			$this->tableFk = $auxTableFk;

			if (is_array($photoList) and count($photoList) > 0)
			{
			?>
			<table border="0" cellspacing="0" cellpadding="0" class="tinymce_photo_table">
			<?php
				$i = 0;
				foreach ($photoList as $photo)
				{
					if ($photo['idPhoto'] == 0)
					{
						$_t = 'true';
						$_url = $previewFile.'?p='.base64_encode($photo['name']).'&t='.$_t.$params.'&a=false&r='.mt_rand();
					}
					else
					{
						$_t = 'false';
						$_url = $this->getPhotoThumbsUrl().$photo['name'];
					}

					if ($i == 0)
					{
						?>
				<tr>
						<?php
					}
					?>
					<td>
						<div class="tinymce_photo" id="cont_<?php echo $photo['name']; ?>">
							<a href="#" onclick="addPhotoTinyMCE('<?php echo $_url; ?>', '<?php echo $this->getTableFk(); ?>', '<?php echo $photo['name']; ?>'); return false;"><img id="<?php echo base64_encode($photo['name']); ?>" src="<?php echo $previewFile.'?p='.base64_encode($photo['name']).'&t='.$_t.$params.'&r='.mt_rand(); ?>" border="0" /></a>
						</div>
					</td>
					<?php
					$i++;
					if ($i == 3)
					{
						?>
				</tr>
						<?php
						$i = 0;
					}
				}
				if ($i < 3 and $i > 0)
				{
					for ($j = $i; $j < 3; $j++)
					{
						?>
					<td>&nbsp;</td>
						<?php
					}
					?>
				</tr>
					<?php
				}
			?>
			</table>
			<?php
			}
		}
	}

	/**
	 * Reemplaza los nombre de las fotos temporales que se agregaron y fueron utilizadas con el script TinyMCE
	 *
	 * Debe estar seteada la propiedad {@link $tableFk}
	 *
	 * @param array $addedPhotos array con el nombre temporal de la foto que se agrego y el nombre final con que quedó
	 * @param string $field campo donde se insertaron las fotos con el script TinyMCE
	 * @return string
	 * @access public
	 */
	public function replaceTempPhotosTinyMCE($addedPhotos, $field)
	{
		if (is_array($addedPhotos) and count($addedPhotos) > 0)
		{
			foreach ($addedPhotos as $photo)
			{
				if (validateRequiredValue($photo['name']) === TRUE)
				{
					//reemplazo el id del img
					$field = str_replace('id="'.$photo['temp'].'"', 'id="'.$photo['name'].'"', $field);

					//reemplazo el src del img
					$p = '/src=\"photo-preview\.php\?p='.base64_encode($photo['temp']).'&amp;t=true&amp;tableFk='.base64_encode($this->getTableFk()).'(&amp;idFk='.base64_encode($this->getIdFk()).')?&amp;a=false&amp;r=[0-9]+\"/';

					$r = 'src="'.$this->getPhotoThumbsUrl().$photo['name'].'"';

					$field = preg_replace($p, $r, $field);
				}
			}
		}

		$field = $this->cleanTempPhotosTinyMCE($field);

		return $field;
	}

	/**
	 * Limpia las fotos temporales que se agregaron con el script TinyMCE pero fueron eliminadas físicamente
	 *
	 * @param string $field campo donde se insertaron las fotos con el script TinyMCE
	 * @return string
	 * @access public
	 */
	public function cleanTempPhotosTinyMCE($field)
	{
		//pattern
		$p = '/(<a(.*?)>)?(<img(.*?)src=(\'|")(.*?)(\'|")(.*?)>)(<\/a>)?/si';

		$rs = array();

		preg_match_all($p, $field, $rs, PREG_PATTERN_ORDER);

		if (is_array($rs[0]))
		{
			$cant = count($rs[0]);

			for ($j = 0; $j < $cant; $j++)
			{
                if (preg_match('/'.$this->tempPhoto.'/i', $rs[0][$j]) and preg_match('/photo-preview\.php/i', $rs[0][$j]))
				{
					$field = str_replace($rs[0][$j], '', $field);
				}
			}
		}

		return $field;
	}

	/**
	 * Agrega los links a las fotos agregadas con el script TinyMCE
	 *
	 * Deben estar seteadas las propiedades {@link $tableFk} y {@link $idFk}
	 *
	 * @param string $field campo donde se insertaron las fotos con el script TinyMCE
	 * @return string
	 * @access public
	 */
	public function addLinkPhotosTinyMCE($field)
	{
		$photoList = $this->getPhotos(FALSE, FALSE);

		if (is_array($photoList) and count($photoList) > 0)
		{
			$img = $this->getTagsImgTinyMCE($field);

			if (is_array($img) and count($img) > 0)
			{
				foreach ($photoList as $photo)
				{
					if (isset($img[$photo['name']]) === TRUE)
					{
						$replace = '<a onclick="display(this.href, '.$photo['width'].', '.$photo['height'].'); return false;" href="'.$this->getPhotoUrl().$photo['name'].'" target="_blank">'.$img[$photo['name']]['img'].'</a>';

						if (validateRequiredValue($img[$photo['name']]['a']) === TRUE)
						{
							$field = str_replace($img[$photo['name']]['complete'], $replace, $field);
						}
						else
						{
							$field = str_replace($img[$photo['name']]['img'], $replace, $field);
						}
					}
				}
			}
		}

		return $field;
	}

	/**
	 * Elimina las fotos agregadas con el script TinyMCE que fueron eliminadas de la base de datos
	 *
	 * @param array $deletedPhotos array con las fotos que fueron eliminadas de la base de datos
	 * @param string $field campo donde se insertaron las fotos con el script TinyMCE
	 * @return string
	 * @access public
	 */
	public function deletePhotosTinyMCE($deletedPhotos, $field)
	{
		if (is_array($deletedPhotos) and count($deletedPhotos) > 0)
		{
			$img = $this->getTagsImgTinyMCE($field, $deletedPhotos);

			if (is_array($img) and count($img) > 0)
			{
				foreach ($deletedPhotos as $photo)
				{
					if (isset($img[$photo]) === TRUE)
					{
						$field = str_replace($img[$photo]['complete'], '', $field);
					}
				}
			}
		}

		return $field;
	}

	/**
	 * Filtra el listados de fotos para que no se muestren las fotos agregadas con el script TinyMCE
	 *
	 * @param array $photoList array con las fotos listadas
	 * @param string $field campo donde se insertaron las fotos con el script TinyMCE
	 * @return array
	 * @access public
	 */
	public function filterListPhotosTinyMCE($photoList, $field)
	{
		$newPhotoList = '';

		if (is_array($photoList) and count($photoList) > 0)
		{
			$img = $this->getTagsImgTinyMCE($field);

			if (is_array($img) and count($img) > 0)
			{
				foreach ($photoList as $photo)
				{
					if (isset($img[$photo['name']]) === FALSE)
					{
						$newPhotoList[] = $photo;
					}
				}
			}
			else
			{
				$newPhotoList	= $photoList;
			}
		}

		return $newPhotoList;
	}

	/**
	 * Obtiene los tags <img> de un campo que utiliza el script TinyMCE
	 *
	 * Deben estar seteadas las propiedades {@link $tableFk} y {@link $idFk}. Esta función obtiene
	 * los tags <img> con todas sus propiedades. Si el tag <img> está dentro de un enlace también devuelve el tag <a></a>
	 *
	 * Formato del array que se devuelve:
	 * <code>
	 * <?php
	 * $img['news_1_1.jpg']['complete'] = '<a onclick="display(this.href, 774, 518); return false;" href="http://www.sitio.com/news/news_1_1.jpg" target="_blank"><img id="news_1_1.jpg" src="http://www.sitio.com/news/thumbs/news_1_1.jpg" border="0" alt="" width="150" height="100" /></a>';
	 * $img['news_1_1.jpg']['a']        = '<a onclick="display(this.href, 774, 518); return false;" href="http://www.sitio.com/news/news_1_1.jpg" target="_blank">';
	 * $img['news_1_1.jpg']['img']      = '<img id="news_1_1.jpg" src="http://www.sitio.com/news/thumbs/news_1_1.jpg" border="0" alt="" width="150" height="100" />';
	 * $img['news_1_2.jpg']['complete'] = '<a onclick="display(this.href, 1630, 1086); return false;" href="http://www.sitio.com/news/news_1_2.jpg" target="_blank"><img id="news_1_2.jpg" style="margin-top: 10px; margin-bottom: 10px;" src="http://www.sitio.com/news/thumbs/news_1_2.jpg" border="0" alt="" width="259" height="173" /></a>';
	 * $img['news_1_2.jpg']['a']        = '<a onclick="display(this.href, 1630, 1086); return false;" href="http://www.sitio.com/news/news_1_2.jpg" target="_blank">';
	 * $img['news_1_2.jpg']['img']      = '<img id="news_1_2.jpg" style="margin-top: 10px; margin-bottom: 10px;" src="http://www.sitio.com/news/thumbs/news_1_2.jpg" border="0" alt="" width="259" height="173" />';
	 * $img['news_1_3.jpg']['complete'] = '<img id="news_1_3.jpg" src="http://www.sitio.com/news/thumbs/news_1_3.jpg" border="0" alt="" width="268" height="179" />';
	 * $img['news_1_3.jpg']['a']        = '';
	 * $img['news_1_3.jpg']['img']      = '<img id="news_1_3.jpg" src="http://www.sitio.com/news/thumbs/news_1_3.jpg" border="0" alt="" width="268" height="179" />';
	 * ?>
	 * </code>
	 * - 'complete' : tag 'img' con todas sus propiedades y tag 'a' que lo contiene con todas sus propiedades (si existiese)
	 * - 'a'        : tag 'a' con todas sus propiedades (si existiese)
	 * - 'img'      : tag 'img' con todas sus propiedades
	 *
	 * @param string $field campo donde se insertaron las fotos con el script TinyMCE
	 * @param array $deleted array con los nombres de las fotos que fueron borradas
	 * @return array
	 * @access public
	 */
	public function getTagsImgTinyMCE($field, $deleted = '')
	{
		$img = array();
		$rs  = array();

		//pattern
		/**
		 * También funcionan (faltaría agregarle la parte del tag 'a'):
		 * $p = '/<img[^>]*src=(\'|")[^>]*(\'|")[^>]*>/si';
		 * $p = '/<img[\s]+[^>]*?((alt*?[\s]?=[\s\"\']+(.*?)[\"\']+.*?)|(src*?[\s]?=[\s\"\']+(.*?)[\"\']+.*?))((src*?[\s]?=[\s\"\']+(.*?)[\"\']+.*?>)|(alt*?[\s]?=[\s\"\']+(.*?)[\"\']+.*?>)|>)/si';
		 */
		$p = '/(<a(.*?)>)?(<img(.*?)src=(\'|")(.*?)(\'|")(.*?)>)(<\/a>)?/si';

		preg_match_all($p, $field, $rs, PREG_PATTERN_ORDER);

		if (is_array($rs[0]))
		{
			$photoList = $this->getPhotos(FALSE, FALSE);

			$cant = count($rs[0]);

			for ($j = 0; $j < $cant; $j++)
			{
				if (is_array($photoList) and count($photoList) > 0)
				{
					foreach ($photoList as $photo)
					{
                        if (preg_match('/id="'.$photo['name'].'"/i', $rs[3][$j]))
						{
							$img[$photo['name']] = array('complete' => $rs[0][$j] , 'a' => $rs[1][$j] , 'img' => $rs[3][$j]);

							break;
						}
					}
				}

				//si se borraron fotos las tengo que agregar a la lista para poder borrarlas del campo que usa el TinyMCE
				if (is_array($deleted) and count($deleted) > 0)
				{
					foreach ($deleted as $photo)
					{
                        if (preg_match('/id="'.$photo.'"/i', $rs[3][$j]))
						{
							$img[$photo] = array('complete' => $rs[0][$j] , 'a' => $rs[1][$j] , 'img' => $rs[3][$j]);

							break;
						}
					}
				}
			}
		}

		return $img;
	}

	/**
	 * Este método ordena las fotos temporales para que se registren en el orden que fueron cargadas
	 *
	 * @param array $list array con las fotos obtenidas con {@link getPhotosTemp()}
	 * @return array
	 * @access public
	 */
	public function sortPhotos($list)
	{
		$newList = array();

		if (is_array($list) and count($list) > 0)
		{
			$file = new Cfile();

            foreach ($list as $row)
			{
				$file->setFile($row['name']);

				$order = str_replace($this->tempPhoto.'_', '', $file->getFile(FALSE));

				settype ($order, 'integer');

				$newList[]  = array('idPhoto' => 0, 'name' => $row['name'], 'width' => $row['width'], 'height' => $row['height'], 'caption' => '', 'order' => $order);
			}

		}

		//ordeno el array
		reset($newList);
		uasort($newList, array($this, 'cmpPhotos'));

		return $newList;
	}

	/**
	 * Esta función sólo se usa para ordenar el array que devuelve el método {@link sortPhotos()}
     *
	 */
	function cmpPhotos($a, $b)
	{
		$sortable = array(strtolower($a['order']), strtolower($b['order']));
		$sorted = $sortable;
		sort($sorted);

		return ($sorted[0] == $sortable[0]) ? -1 : 1;
	}
}
?>
