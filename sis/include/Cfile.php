<?php
/**
 * Archivo php creado EVO I.T.
 * 
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Manejo de archivos y directorios
 *
 * Esta clase se encarga de manipular archivos y directorios utilizando funciones del Sistema de Archivos de PHP.
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.2:25-08-2015
 */
class Cfile
{
	/**
	 * Archivo
	 * 
	 * Ver también: {@link getFile()}, {@link setFile()}
	 * @var string
	 * @access private
	 */    
	private $file;

	/**
	 * Directorio
	 *
	 * Ver también: {@link getDir()}, {@link setDir()}
	 * @var string
     * @access private
	 */
	private $dir;

	/**
	 * Extensión del archivo
	 *
	 * Ver también: {@link getExtension()}, {@link setExtension()}
	 * @var string
     * @access private
	 */
	private $extension;

	/**
	 * Separador de directorios y archivos
	 *
	 * Ver también: {@link getSlash()}, {@link setSlash()}
	 * @var string
     * @access private
	 */
	private $slash;

	/**
	 * Array donde se almacenan los errores
	 *
	 * Ver también: {@link addError()}, {@link getErrors()}, {@link error()}, {@link showErrors()}, {@link deleteErrors()}
	 * @var array
	 * @access private
	 */
	private $errors = array();

	/**
	 * Constructor de la clase
	 * 
	 * @return void
	 */
	function __construct()
	{
		if (isWindows() === TRUE)
		{
			$this->slash = '\\';
		}
		else
		{
			$this->slash = '/';
		}

        require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cfile.php');
	}
    
	/**
	 * Destructor de la clase
	 */
	function __destruct()
	{

	}    	

    /**
	 * Setea el valor {@link $file Archivo}
	 *
	 * @param string $file indica el archivo
	 * @return boolean
	 * @access public
	 */    
	public function setFile($file)
	{
        if (validateRequiredValue($file) === FALSE)
		{
			$this->file = $file;
            $this->addError(CFILE_SETFILE_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->file = $file;
            
			$this->setExtension();
            
			return TRUE;
		}
	}

    /**
	 * Setea el valor {@link $dir Directorio}
	 *
	 * @param string $dir indica el directorio
	 * @return boolean
	 * @access public
	 */     
	public function setDir($dir)
	{
		if (validateRequiredValue($dir) === FALSE)
		{
			$this->dir = $dir;
            $this->addError(CFILE_SETDIR_REQUIRED_VALUE);

			return FALSE;
		}
		else
		{
			$this->dir = $dir;
            
			$this->checkDir();
			
            return TRUE;
		}
	}

    /**
	 * Setea el valor {@link $extension Extensión} según el valor de {@link $file Archivo} seteado
	 *
	 * @return boolean
	 * @access public
	 */     
	public function setExtension()
	{
		if (validateRequiredValue($this->file) === TRUE)
		{
			$partes = explode('.', $this->file);
            
			if (count($partes) <= 1 )
			{
				$this->extension = '';
			}
			else
			{
				$this->extension = $partes[count($partes) - 1];
			}
			
            return TRUE;
		}
		else
		{
            $this->addError(CFILE_SETEXTENSION_REQUIRED_FILE);
			
            return FALSE;
		}
	}
    
    /**
	 * Setea el valor {@link $slash Separador de directorios y archivos}
	 *
	 * @param string $slash indica el separador de directorios y archivos
	 * @return boolean
	 * @access public
	 */    
	public function setSlash($slash)
	{
		if (validateRequiredValue($slash) === FALSE)
		{
            $this->addError(CFILE_SETSLASH_REQUIRED_VALUE);
            
			return FALSE;
		}
		else
		{
			$this->slash = $slash;
            
			return TRUE;
		}
	}

	/**
	 * Devuelve el valor {@link $file Archivo}
     * 
	 * El parámetro $withExt indica si se devuelve el archivo con la extensión o no. Si tiene el valor TRUE
	 * se devuelve el nombre del archivo completo (ej.: file_name.zip), si tiene el valor FALSE se devuelve el nombre
	 * del archivo sin la extensión (ej.: file_name). 
	 * 
	 * @param boolean $withExt [opcional] indica si se devuelve el archivo con la extensión o no
	 * @return string
	 * @access public
	 */    
	public function getFile($withExt = TRUE)
    {
		if ($withExt === TRUE)
		{
			return $this->file;
		}
		else
		{
			if (strlen($this->extension) > 0)
			{
				return substr($this->file, 0, strlen($this->file) - strlen($this->extension) - 1);
			}
			else
			{
				return substr($this->file, 0, strlen($this->file) - strlen($this->extension));
			}
		}
	}

    /**
	 * Devuelve el valor {@link $dir Directorio}
	 *
	 * @return string
	 * @access public
	 */      
    public function getDir()
    {
        return $this->dir;
    }

	/**
	 * Devuelve el valor {@link $extension Extensión}
	 *
	 * El parámetro $lower indica si la extensión se devuelve en minúsculas o no. Si tiene el valor FALSE
	 * se devuelve la extensión original (ej.: ZiP), si tiene el valor TRUE se devuelve la extensión en
	 * minúsculas (ej.: zip).
	 *
	 * @param boolean $lower [opcional] indica si la extensión se devuelve en minúsculas
	 * @return string
     * @access public
	 */
	public function getExtension($lower = FALSE)
    {
		if ($lower === FALSE)
		{
			return $this->extension;
		}
		else
		{
			return strtolower($this->extension);
		}
	}

    /**
	 * Devuelve el valor {@link $slash Separador de directorios y archivos}
	 *
	 * @return string
	 * @access public
	 */      
	public function getSlash()
    {
        return $this->slash;
    }

	/**
	 * Agrega un error en el array de errores
	 *
	 * Ver también: {@link getErrors()}, {@link error()}, {@link showErrors()}, {@link deleteErrors()}
	 * @param string $error Error
	 * @access public
	 */
	public function addError($error)
	{
		$this->errors[] = $error;
	}

	/**
	 * Devuelve los errores acumulados en {@link $errors errors}
	 *
	 * Ver también: {@link addError()}, {@link error()}, {@link showErrors()}, {@link deleteErrors()}
	 * @return array
	 * @access public
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Indica si se produjo algún error
	 *
	 * Este método devuelve TRUE sin en el array {@link $errors errors} existe al menos un error cargado.
	 *
	 * Ver también: {@link addError()}, {@link getErrors()}, {@link showErrors()}, {@link deleteErrors()}
	 * @return boolean
	 * @access public
	 */
	public function error()
	{
		if (is_array($this->errors) === TRUE)
		{
			if (count($this->errors) == 0)
			{
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
	 * Imprime los errores acumulados en {@link $errors errors}
	 *
	 * Ver también: {@link addError()}, {@link getErrors()}, {@link error()}, {@link deleteErrors()}
	 * @return string
	 * @access public
	 */
	public function showErrors()
	{
		if (is_array($this->errors) === TRUE)
		{
			echo '<ul>';
            foreach ($this->errors as $err)
			{
				echo '<li>'.$err.'</li>';
			}
            echo '</ul>';
		}
	}

	/**
	 * Elimina los errores acumulados en {@link $errors errors}
	 *
	 * Ver también: {@link addError()}, {@link getErrors()}, {@link error()}, {@link showErrors()}
	 * @return void
	 * @access public
	 */
	public function deleteErrors()
	{
		$this->errors = array();
	}	

	/**
	 * Crea un directorio
	 *
	 * Este método intenta crear el {@link $dir directorio} seteado. Devuelve TRUE si el directorio se creó en forma
	 * correcta, en caso contrario devuelve FALSE.
	 *
	 * El parámetro $perms se debe especificar como un número octal (anteponer el 0 al número). Ej.: 0777
	 *
	 * @param integer $perms indica el nivel de permisos del directorio
	 * @return boolean
     * @access public
	 */
	public function createDir($perms = 0755)
	{
		if (validateRequiredValue($this->dir) === TRUE)
		{
			if ($this->existDir() === TRUE)
			{
				$this->addError(CFILE_CREATE_DIR_EXIST);
                
				return FALSE;
			}
			else
			{
				if (mkdir($this->dir, $perms) === TRUE)
				{
					chmod($this->dir, $perms);
                    
					return TRUE;
				}
				else
				{
                    $this->addError(CFILE_CREATE_DIR_ERROR);

					return FALSE;
				}
			}
		}
		else
		{
            $this->addError(CFILE_CREATE_DIR_REQUIRED_DIR);
            
			return FALSE;
		}
	}

	/**
	 * Copia un archivo
	 *
	 * Este método intenta copiar el {@link $file archivo} seteado del {@link $dir directorio} seteado en el directorio
	 * indicado en el parámetro $dirDest. El parámetro $fileDest indica el nombre con el que se copia el archivo. Si no
	 * está seteado este parámetro se copia con el nombre original. Devuelve TRUE si el archivo se copió en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * @param string $dirDest directorio destino donde se va a copiar el archivo
	 * @param string $fileDest [opcional] nombre con el que se copiará el archivo
	 * @return boolean
     * @access public
	 */
	public function copyFile($dirDest, $fileDest = '')
	{
        if (validateRequiredValue($this->dir) === TRUE)
		{
			if (validateRequiredValue($this->file) === TRUE)
			{
				if ($this->existFile($this->dir.$this->file) === TRUE)
				{
					if (validateRequiredValue($dirDest) === TRUE)
					{
						$dirDest = $this->checkDir($dirDest);

						if ($this->existDir($dirDest) === TRUE)
						{
							if (validateRequiredValue($fileDest) === TRUE)
							{
								$path = $dirDest.$fileDest;
							}
							else
							{
								$path = $dirDest.$this->file;
							}

							if ($this->existFile($path) === TRUE)
							{
                                $this->addError(CFILE_COPY_FILE_EXIST_FILE);
                                
								return FALSE;
							}
							else
							{
								if (copy($this->dir.$this->file, $path) === TRUE)
								{
									return TRUE;
								}
								else
								{
                                    $this->addError(CFILE_COPY_FILE_ERROR);
                                    
									return FALSE;
								}
							}
						}
						else
						{
                            $this->addError(CFILE_COPY_FILE_NO_DIR_DEST);
                            
							return FALSE;
						}
					}
					else
					{
                        $this->addError(CFILE_COPY_FILE_REQUIRED_DIR_DEST);

						return FALSE;
					}
				}
				else
				{
                    $this->addError(CFILE_COPY_FILE_NO_FILE);
                    
					return FALSE;
				}
			}
			else
			{
                $this->addError(CFILE_COPY_FILE_REQUIRED_FILE);
                
				return FALSE;
			}
		}
		else
		{
            $this->addError(CFILE_COPY_FILE_REQUIRED_DIR);
            
			return FALSE;
		}
	}

	/**
	 * Mueve un archivo
	 *
	 * Este método intenta mover el {@link $file archivo} seteado del {@link $dir directorio} seteado al directorio
	 * indicado en el parámetro $dirDest. El parámetro $fileDest indica el nombre con el que se mueve el archivo. Si no
	 * está seteado este parámetro se mueve con el nombre original. Devuelve TRUE si el archivo se movió en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * @param string $dirDest directorio destino donde se va a mover el archivo
	 * @param string $fileDest [opcional] nombre con el que se moverá el archivo
	 * @return boolean
     * @access public 
	 */
	public function moveFile($dirDest, $fileDest = '')
	{
		if (validateRequiredValue($this->dir) === TRUE)
		{
			if (validateRequiredValue($this->file) === TRUE)
			{
				if ($this->existFile($this->dir.$this->file) === TRUE)
				{
					if (validateRequiredValue($dirDest) === TRUE)
					{
						$dirDest = $this->checkDir($dirDest);

						if ($this->existDir($dirDest) === TRUE)
						{
							if (validateRequiredValue($fileDest) === TRUE)
							{
								$path = $dirDest.$fileDest;
							}
							else
							{
								$path = $dirDest.$this->file;
							}

							if ($this->existFile($path) === TRUE)
							{
                                $this->addError(CFILE_MOVE_FILE_EXIST_FILE);
								
                                return FALSE;
							}
							else
							{
								if (rename($this->dir.$this->file, $path) === TRUE)
								{
									return TRUE;
								}
								else
								{
									$this->addError(CFILE_MOVE_FILE_ERROR);

									return FALSE;
								}
							}
						}
						else
						{
							$this->addError(CFILE_MOVE_FILE_NO_DIR_DEST);

							return FALSE;
						}
					}
					else
					{
						$this->addError(CFILE_MOVE_FILE_REQUIRED_DIR_DEST);

						return FALSE;
					}
				}
				else
				{
					$this->addError(CFILE_MOVE_FILE_NO_FILE);

					return FALSE;
				}
			}
			else
			{
				$this->addError(CFILE_MOVE_FILE_REQUIRED_FILE);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CFILE_MOVE_FILE_REQUIRED_DIR);

			return FALSE;
		}
	}

	/**
	 * Renombra un archivo
	 *
	 * Este método intenta renombrar el {@link $file archivo} seteado del {@link $dir directorio} seteado con el nombre
	 * indicado en el parámetro $fileDest. Devuelve TRUE si el archivo se renombró en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * @param string $fileDest nombre al que se renombrará el archivo
	 * @return boolean
     * @access public 
	 */
	public function renameFile($fileDest)
	{
        if (validateRequiredValue($this->dir) === TRUE)
		{
			if (validateRequiredValue($this->file) === TRUE)
			{
				if ($this->existFile($this->dir.$this->file) === TRUE)
				{
					if (validateRequiredValue($fileDest) === TRUE)
					{
						if ($this->existFile($this->dir.$fileDest) === TRUE)
						{
                            $this->addError(CFILE_RENAME_FILE_EXIST_FILE);
                            
							return FALSE;
						}
						else
						{
							if (rename($this->dir.$this->file, $this->dir.$fileDest) === TRUE)
							{
								return TRUE;
							}
							else
							{
                                $this->addError(CFILE_RENAME_FILE_ERROR);
                                
								return FALSE;
							}
						}
					}
					else
					{
                        $this->addError(CFILE_RENAME_FILE_REQUIRED_FILE_DEST);
                        
						return FALSE;
					}
				}
				else
				{
					$this->addError(CFILE_RENAME_FILE_NO_FILE);

					return FALSE;
				}
			}
			else
			{
				$this->addError(CFILE_RENAME_FILE_REQUIRED_FILE);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CFILE_RENAME_FILE_REQUIRED_DIR);

			return FALSE;
		}
    }

	/**
	 * Renombra un directorio
	 *
	 * Este método intenta renombrar el {@link $dir directorio} seteado con el nombre indicado en el
	 * parámetro $dir_dest. Devuelve TRUE si el directorio se renombró en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * @param string $dirDest nombre al que se renombrará el directorio
	 * @return boolean
     * @access public
	 */
	public function renameDir($dirDest)
    {
        if (validateRequiredValue($this->dir) === TRUE)
		{
			if ($this->existFile($this->dir) === TRUE)
			{
				if (validateRequiredValue($dirDest) === TRUE)
				{
					$dirDest = $this->checkDir($dirDest);

					if ($this->existDir($dirDest) === TRUE)
					{
                        $this->addError(CFILE_RENAME_DIR_EXIST_DIR);
                        
						return FALSE;
					}
					else
					{
						if (rename($this->dir, $dirDest) === TRUE)
						{
							return TRUE;
						}
						else
						{
                            $this->addError(CFILE_RENAME_DIR_ERROR);
                            
							return FALSE;
						}
					}
				}
				else
				{
                    $this->addError(CFILE_RENAME_DIR_REQUIRED_DIR_DEST);
                    
					return FALSE;
				}
			}
			else
			{
                $this->addError(CFILE_RENAME_DIR_NO_DIR);
                
				return FALSE;
			}
		}
		else
		{
			$this->addError(CFILE_RENAME_DIR_REQUIRED_DIR);

			return FALSE;
		}
	}

	/**
	 * Elimina un archivo
	 *
	 * Este método intenta eliminar el {@link $file archivo} seteado del {@link $dir directorio} seteado.
	 * Devuelve TRUE si el archivo se eliminó en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * @return boolean
     * @access public 
	 */
	public function delFile()
	{
        if (validateRequiredValue($this->dir) === TRUE)
		{
			if (validateRequiredValue($this->file) === TRUE)
			{
				if ($this->existFile() === TRUE)
				{
					if (unlink($this->dir.$this->file) === TRUE)
					{
						return TRUE;
					}
					else
					{
						$this->addError(CFILE_DEL_FILE_ERROR);

						return FALSE;
					}
				}
				else
				{
					$this->addError(CFILE_DEL_FILE_NO_FILE);

					return FALSE;
				}
			}
			else
			{
				$this->addError(CFILE_DEL_FILE_REQUIRED_FILE);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CFILE_DEL_FILE_REQUIRED_DIR);

			return FALSE;
		}
	}

	/**
	 * Elimina un directorio
	 *
	 * Este método intenta eliminar el {@link $dir directorio} seteado.
	 * Devuelve TRUE si el directorio se eliminó en forma correcta, en caso contrario devuelve FALSE.
	 * El directorio que quiere eliminarse debe estar vacío, sino no se elimina.
	 *
	 * @return boolean
     * @access public 
	 */
	public function delDir()
	{
        if (validateRequiredValue($this->dir) === TRUE)
		{
			if ($this->existDir() === TRUE)
			{
				if (rmdir($this->dir) === TRUE)
				{
					return TRUE;
				}
				else
				{
					$this->addError(CFILE_DEL_DIR_ERROR);

					return FALSE;
				}
			}
			else
			{
				$this->addError(CFILE_DEL_DIR_NO_DIR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CFILE_DEL_DIR_REQUIRED_DIR);

			return FALSE;
		}
	}

	/**
	 * Elimina el contenido de un directorio
	 *
	 * Este método intenta eliminar el contenido del {@link $dir directorio} seteado.
	 * Devuelve TRUE si todo se eliminó en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * El parámetro $delDir indica si se elimina también el directorio seteado (el directorio contenedor). Si $delDir
	 * es igual a TRUE se elimina también el directorio seteado.
	 *
	 * @param boolean $delDir [opcional] indica si se elimina también el directorio seteado
	 * @return boolean
     * @access public 
	 */
	public function delDirContent($delDir = FALSE)
	{
        if (validateRequiredValue($this->dir) === TRUE)
		{
			if ($this->existDir() === TRUE)
			{
				if ($handle = opendir($this->dir))
				{
					$delError = FALSE;

					while ($_file = readdir($handle))
					{
		       			if ($_file != '.' and $_file != '..')
						{
							$path = $this->dir.$_file;

		           			if (is_dir($path) === FALSE)
							{
		               			//si es un archivo, lo elimino

								$this->setFile($_file);
                                
								if ($this->delFile() === FALSE)
								{
									$delError = TRUE;
								}
		           			}
							else
							{
		               			//si es un directorio llamo al método nuevamente (recursividad)

								$mainDir = $this->getDir();

								$this->setDir($path);

								if ($this->delDirContent(TRUE) === FALSE)
								{
									$delError = TRUE;
								}

								$this->setDir($mainDir);
		           			}
		       			}
		   			}

					closedir($handle);

					$this->deleteErrors();

					if ($delError === TRUE)
					{
                        $this->addError(CFILE_DEL_DIR_CONTENT_ERROR);
                        
						return FALSE;
					}
					else
					{
						if ($delDir === TRUE)
						{
							if ($this->delDir() === TRUE)
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
							return TRUE;
						}
					}
				}
				else
				{
					$this->addError(CFILE_DEL_DIR_CONTENT_OPEN_ERROR);

					return FALSE;
				}
			}
			else
			{
				$this->addError(CFILE_DEL_DIR_CONTENT_NO_DIR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CFILE_DEL_DIR_CONTENT_REQUIRED_DIR);

			return FALSE;
		}
	}

	/**
	 * Verifica si existe un directorio
	 *
	 * Este método verifica si existe el directorio seteado en el parámetro $dirAlt. Si el parámetro $dirAlt
	 * no se setea, la verificación se realiza sobre el directorio seteado con {@link setDir()}.
	 * Devuelve TRUE si el directorio existe, en caso contrario devuelve FALSE.
	 *
	 * @param string $dirAlt [opcional] directorio a verificar
	 * @return boolean
     * @access public 
	 */
	public function existDir($dirAlt = '')
	{
		if (validateRequiredValue($dirAlt) === TRUE)
		{
			$dirAlt = $this->checkDir($dirAlt);

			if (file_exists($dirAlt) === TRUE)
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
			if (validateRequiredValue($this->dir) === TRUE)
			{
				if (file_exists($this->dir) === TRUE)
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
				$this->addError(CFILE_EXIST_DIR_REQUIRED_DIR);

				return FALSE;
			}
		}
	}

	/**
	 * Verifica si existe un archivo
	 *
	 * Este método verifica si existe el archivo seteado en el parámetro $fileAlt. Si el parámetro $fileAlt
	 * no se setea, la verificación se realiza sobre el archivo seteado con {@link setFile()} del directorio
	 * seteado con {@link setDir()}.
	 * Devuelve TRUE si el archivo existe, en caso contrario devuelve FALSE.
	 *
	 * @param string $fileAlt [opcional] archivo a verificar
	 * @return boolean
     * @access public 
	 */
	public function existFile($fileAlt = '')
	{
		if (validateRequiredValue($fileAlt) === TRUE)
		{
			if (file_exists($fileAlt) === TRUE)
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
			if (validateRequiredValue($this->dir) === TRUE)
			{
				if (validateRequiredValue($this->file) === TRUE)
				{
					if (file_exists($this->dir.$this->file) === TRUE)
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
					$this->addError(CFILE_EXIST_FILE_REQUIRED_FILE);

					return FALSE;
				}
			}
			else
			{
				$this->addError(CFILE_EXIST_FILE_REQUIRED_DIR);

				return FALSE;
			}
		}
	}

	/**
	 * Devuelve los permisos de un directorio o de un archivo
	 *
	 * Si se encuentra seteado solamente el {@link $dir directorio}, este método devuelve los permisos del directorio seteado.
	 * Si además del {@link $dir directorio} también se encuentra seteado el {@link $file archivo}, devuelve los permisos del archivo seteado
	 * en el directorio seteado.
	 *
	 * @return string
     * @access public 
	 */
	public function getPerms()
	{
		if (validateRequiredValue($this->dir) === TRUE)
		{
			$banExist = FALSE;

			if (validateRequiredValue($this->file) === TRUE)
			{
				if ($this->existFile() === TRUE)
				{
					$path = $this->dir.$this->file;
					
                    $banExist = TRUE;
				}
				else
				{
					$this->addError(CFILE_GETPERMS_NO_FILE);

					$banExist = FALSE;
				}
			}
			else
			{
				if ($this->existDir() === TRUE)
				{
					$path = $this->dir;
                    
					$banExist = TRUE;
				}
				else
				{
					$this->addError(CFILE_GETPERMS_NO_DIR);

					$banExist = FALSE;
				}
			}

			if ($banExist === TRUE)
			{
				$permsDec = fileperms($path);

				$permsOct = sprintf('%o', $permsDec);

				$perms = substr($permsOct, -3);

				return $perms;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			$this->addError(CFILE_GETPERMS_REQUIRED_DIR);

			return FALSE;
		}
	}

	/**
	 * Controla que al final del directorio seteado se encuentre el separador correspondiente
	 *
	 * Si el parámetro $dirAlt no se setea, la verificación se hace sobre el directorio seteado con {@link setDir()}
	 *
	 * @param string $dirAlt [opcional] directorio alternativo a verificar
	 * @return string
     * @access public 
	 */
	public function checkDir($dirAlt = '')
	{
		if (validateRequiredValue($dirAlt) === TRUE)
		{
			$final = substr($dirAlt, -1, 1);

			if ($final != $this->slash)
			{
				$dirAlt = $dirAlt.$this->slash;
			}

			return $dirAlt;
		}
		else
		{
			if (validateRequiredValue($this->dir) === TRUE)
			{
				$final = substr($this->dir, -1, 1);

				if ($final != $this->slash)
				{
					$this->dir = $this->dir.$this->slash;
				}
			}
			else
			{
				$this->addError(CFILE_CHECKDIR_REQUIRED_DIR);

				return FALSE;
			}
		}
	}

	/**
	 * Devuelve el contenido de un directorio
	 *
	 * Este método devuelve en un array el contenido del directorio seteado con {@link setDir()}.
	 * El array esta ordenado por nombre.
	 *
	 * El array tiene la siguiente estructura:
	 * <code>
	 * <?php
	 * $list[0]['name']  = 'include';
	 * $list[0]['type']  = 'D';
	 * $list[1]['name']  = 'index.php';
	 * $list[1]['type']  = 'F';
	 * $list[2]['name']  = 'header.jpg';
	 * $list[2]['type']  = 'F';
	 * ?>
	 * </code>
	 * - 'name'  : nombre del directorio o archivo
	 * - 'type'  : tipo de elemento, D para directorio y F para archivo
	 *
	 * @return array
     * @access public 
	 */
	public function getListDir()
	{
        if (validateRequiredValue($this->dir) === TRUE)
		{
			if ($this->existDir() === TRUE)
			{
				if ($handle = opendir($this->dir))
				{
					$listDir  = array();
					$listFile = array();

					while ($_file = readdir($handle))
					{
						if ($_file != '.' and $_file != '..')
						{
							if (is_dir($this->dir.$_file) === TRUE)
							{
								$listDir[]  = array('name' => $_file , 'type' => 'D');
							}
							else
							{
								$listFile[] = array('name' => $_file , 'type' => 'F');
							}
						}
					}

					closedir($handle);

					//ordeno el array de los directorios
					reset($listDir);
					uasort($listDir, array($this, 'cmp'));

					//ordeno el array de los archivos
					reset($listFile);
					uasort($listFile, array($this, 'cmp'));

					//devuelvo los dos array combinados
					$list = array_merge($listDir, $listFile);
                    
					return $list;
				}
				else
				{
					$this->addError(CFILE_GETLIST_DIR_OPEN_ERROR);

					return FALSE;
				}
			}
			else
			{
				$this->addError(CFILE_GETLIST_DIR_NO_DIR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CFILE_GETLIST_DIR_REQUIRED_DIR);

			return FALSE;
		}
	}

	/**
	 * Esta función sólo se usa para ordenar el array que devuelve el método {@link getListDir()}
	 *
	 * Fuente: {@link http://ar2.php.net/uasort}
     * 
     * @access public 
	 */
	public function cmp($a, $b)
	{
		$sortable = array(strtolower($a['name']), strtolower($b['name']));
		$sorted = $sortable;
		sort($sorted);

		return ($sorted[0] == $sortable[0]) ? -1 : 1;
	}

	/**
	 * Devuelve el directorio de trabajo actual
	 *
	 * @return string
     * @access public 
	 */
	public function getBaseDir()
    {
		return getcwd();
    }

	/**
	 * Define el directorio de trabajo actual
	 *
	 * Este método cambia al directorio definido en el parámetro $baseDir
	 * Devuelve TRUE si se cambió al directorio en forma correcta, en caso contrario devuelve FALSE.
	 *
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $file = new Cfile();
	 *
	 * $file->setDir('D:\www\dir1\content\img');
	 * $list  = $file->getListDir();
	 *
	 * //el mismo resultado se puede obtener
	 * $file->setBaseDir('D:\www\dir1\');
	 * $file->setDir('content\img');
	 * $list2 = $file->getListDir();
	 * ?>
	 * </code>
	 *
	 * @param string $baseDir nuevo directorio de trabajo
	 * @return string
     * @access public 
	 */
	public function setBaseDir($baseDir)
	{
		if (validateRequiredValue($baseDir) === TRUE)
		{
			$baseDir = $this->checkDir($baseDir);

			if ($this->existDir($baseDir) === TRUE)
			{
				if (chdir($baseDir) === TRUE)
				{
					return TRUE;
				}
				else
				{
					$this->addError(CFILE_SETBASE_DIR_ERROR);

					return FALSE;
				}
			}
			else
			{
				$this->addError(CFILE_SETBASE_DIR_NO_DIR);

				return FALSE;
			}
		}
		else
		{
			$this->addError(CFILE_SETBASE_DIR_REQUIRED_DIR);

			return FALSE;
		}
	}
}
?>