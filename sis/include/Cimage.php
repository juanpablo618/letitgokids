<?php
/**
 * Archivo php creado EVO I.T.
 * 
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Manejo de imágenes
 *
 * Esta clase procesa archivos de imágenes. Soporta los siguientes formatos: jpg, gif, png
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.2:25-08-2015
 */
class Cimage
{
	/**
	 * Archivo fuente
	 *
	 * Ver también: {@link getSource()}, {@link setSource()}
	 * @var string
	 * @access private 
	 */
	private $source;

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
		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cimage.php');
	}
    
	/**
	 * Destructor de la clase
	 */
	function __destruct()
	{

	}    

    /**
	 * Setea el valor {@link $source Archivo fuente}
	 *
	 * @param string $source indica el archivo fuente
	 * @return boolean
	 * @access public
	 */        
	public function setSource($source)
	{
        if (validateRequiredValue($source) === FALSE)
		{
			$this->source = $source;
            $this->addError(CIMAGE_SETSOURCE_REQUIRED_VALUE);
			
            return FALSE;
		}
		else
		{
			$this->source = $source;
            
			return TRUE;
		}
	}

    /**
	 * Devuelve el valor {@link $source Archivo fuente}
	 *
	 * @return string
	 * @access public
	 */    
	public function getSource()
    {
		return $this->source;
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
	 * @param string $li [opcional] indica que caracter o que caracteres se muestran al inicio de cada línea de error.
	 * @return string
	 * @access public
	 */
	public function showErrors($li = '&#8226;&#160;')
	{
		if (is_array($this->errors) === TRUE)
		{
			foreach ($this->errors as $err)
			{
				echo '<div class="error_item">'.$li.$err.'</div>';
			}
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
	 * Devuelve un array con información del archivo fuente
	 *
	 * Descripción del array:
	 * $array['width']: ancho de la imagen
	 * $array['height']: alto de la imagen
	 * $array['type']: tipo de imagen: 1 -> gif, 2 -> jpeg, 3 -> png
	 * $array['mime']: tipo MIME correspondiente de la imagen
	 *
	 * @return array|boolean
	 * @access public 
	 */
	public function getImageInfo()
	{
		if (validateRequiredValue($this->source) === TRUE)
		{
			$info = getimagesize($this->source);
            
			if (is_array($info) === TRUE)
			{
				$array['width']  = $info[0];
				$array['height'] = $info[1];
				$array['type']   = $info[2];
				$array['mime']   = $info['mime'];

				return $array;
			}
			else
			{
                $this->addError(CIMAGE_GETIMAGEINFO_ERROR);
                
				return FALSE;
			}
		}
		else
		{
			$this->addError(CIMAGE_GETIMAGEINFO_REQUIRED_SOURCE);

			return FALSE;
		}
	}

	/**
	 * Redimensiona una imagen
	 *
	 * Si el parámetro $fileDest no está seteado no se crea un archivo físico de la imagen redimensionada,
	 * se produce una salida directa de la imagen.
	 *
	 * @param int $width ancho del nuevo tamaño
	 * @param int $height alto del nuevo tamaño
	 * @param string $fileDest [opcional] indica el path completo donde se crea la imagen redimensionada
	 * @param int $quality [opcional] calidad de la imagen (valor entre 1 y 100)
	 * @return boolean
	 * @access public 
	 */
	public function resize($width, $height, $fileDest = '', $quality = 75)
	{
		$imgInfo = $this->getImageInfo();

		if (is_array($imgInfo) === TRUE)
		{
			$altoCuadrado  = 0;
			$anchoCuadrado = 0;

			$X = 0;
			$Y = 0;

            //te dice por cuanto tenes que multiplicar al ALTO para que te de el ANCHO
            $proporcionalidadParaAncho = $width / $height;
            
            //te dice por cuanto tenes que multiplicar al ANCHO para que te de el ALTO
            $proporcionalidadParaAlto  = $height / $width;

			//defino el ancho y el alto del cuadrado con el aspecto ratio
			$difAncho = $imgInfo['width'] / $width;
			$difAlto  = $imgInfo['height'] / $height;

			if ($difAncho > $difAlto)
			{
				$altoCuadrado  = $imgInfo['height'];
				$anchoCuadrado = $imgInfo['height'] * $proporcionalidadParaAncho;

				$X = ($imgInfo['width'] - $anchoCuadrado) / 2;
				$Y = 0;
			}
			else
			{
				$anchoCuadrado = $imgInfo['width'];
				$altoCuadrado  = $imgInfo['width'] * $proporcionalidadParaAlto;

				$Y = ($imgInfo['height'] - $altoCuadrado) / 2;
				$X = 0;
			}

			switch ($imgInfo['type'])
			{
				case 1:
					//gif
					$imgSrc = imagecreatefromgif($this->source);
					break;

				case 2:
					//jpg/jpeg
					$imgSrc = imagecreatefromjpeg($this->source);
					break;

				case 3:
					//png
					$imgSrc = imagecreatefrompng($this->source);
					break;

				default :
                    $this->addError(CIMAGE_RESIZE_INVALID_IMAGE);
                    
					return FALSE;
			}

			if ($imgSrc)
			{
				$imgRes = imagecreatetruecolor($width, $height);
				imagecopyresampled($imgRes, $imgSrc, 0, 0, $X, $Y, $width, $height, $anchoCuadrado, $altoCuadrado);

				if ($imgRes)
				{
					switch ($imgInfo['type'])
					{
						case 1:
							//gif
							if (validateRequiredValue($fileDest) === TRUE)
							{
								$result = imagegif($imgRes, $fileDest);
							}
							else
							{
								$result = imagegif($imgRes);
							}
							break;
                            
						case 2:
							//jpg
							if (validateRequiredValue($fileDest) === TRUE)
							{
								$result = imagejpeg($imgRes, $fileDest, $quality);
							}
							else
							{
								$result = imagejpeg($imgRes, NULL, $quality);
							}
							break;
                            
						case 3:
							//png
							if (validateRequiredValue($fileDest) === TRUE)
							{
								$result = imagepng($imgRes, $fileDest);
							}
							else
							{
								$result = imagepng($imgRes);
							}
							break;
					}

					imagedestroy($imgRes);
					imagedestroy($imgSrc);

					if ($result === TRUE)
					{
						return TRUE;
					}
					else
					{
                        $this->addError(CIMAGE_RESIZE_ERROR);
                        
						return FALSE;
					}
				}
				else
				{
					imagedestroy($imgSrc);
                    $this->addError(CIMAGE_RESIZE_ERROR);
                    
					return FALSE;
				}
			}
			else
			{
                $this->addError(CIMAGE_RESIZE_SOURCE_ERROR);
                
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Corta una imagen
	 *
	 * @param string $fileDest indica el path completo donde se crea la imagen recortada
	 * @param int $x es el punto x desde donde se empezará a cortar la imagen
	 * @param int $y es el punto y desde donde se empezará a cortar la imagen
	 * @param int $width es el ancho de la imagen cortada
	 * @param int $height es el alto de la imagen cortada
	 * @return boolean
	 * @access public 
	 */
	function crop($fileDest, $x, $y, $width, $height)
	{
		if (validateRequiredValue($fileDest) === TRUE)
		{
			$imgInfo = $this->getImageInfo();

			if (is_array($imgInfo) === TRUE)
			{
				switch ($imgInfo['type'])
				{
					case 1:
						//gif
						$imgSrc = imagecreatefromgif($this->source);
						break;
                        
					case 2:
						//jpg/jpeg
						$imgSrc = imagecreatefromjpeg($this->source);
						break;
                        
					case 3:
						//png
						$imgSrc = imagecreatefrompng($this->source);
						break;
                        
					default :
                        $this->addError(CIMAGE_CROP_INVALID_IMAGE);
                        
						return FALSE;
				}

				if ($imgSrc)
				{
					$imgRes = imagecreatetruecolor($width, $height);
					imagecopyresized($imgRes, $imgSrc, 0, 0, $x, $y, $width, $height, $width, $height);

					if ($imgRes)
					{
						switch ($imgInfo['type'])
						{
							case 1:
								//gif
								$result = imagegif($imgRes, $fileDest);
								break;
                                
							case 2:
								//jpg
								$result = imagejpeg($imgRes, $fileDest, 100);
								break;
                                
							case 3:
								//png
								$result = imagepng($imgRes, $fileDest);
								break;
						}

						imagedestroy($imgRes);
						imagedestroy($imgSrc);

						if ($result === TRUE)
						{
							return TRUE;
						}
						else
						{
                            $this->addError(CIMAGE_CROP_ERROR);
                            
							return FALSE;
						}
					}
					else
					{
						imagedestroy($imgSrc);
                        $this->addError(CIMAGE_CROP_ERROR);
                        
						return FALSE;
					}
				}
				else
				{
                    $this->addError(CIMAGE_CROP_SOURCE_ERROR);
                    
					return FALSE;
				}
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
            $this->addError(CIMAGE_CROP_REQUIRED_FILE_DEST);
            
			return FALSE;
		}
	}
}
?>