<?php
/**
 * Archivo php creado por EVO I.T.
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 */

/**
 * Muestra un navegador para consultas
 *
 * Esta clase se encarga de armar un navegador para resultados de consultas mostrando enlaces para movernos
 * entre las distintas páginas del resultado
 *
 * Ejemplo:
 * <code>
 * <?php
 * include_once('Cnavigator.php');
 * $nav = new Cnavigator();
 * $nav->setPage('query.php');
 * $nav->setAmountPages(10);
 * $nav->setResultsPerPage(25);
 * $nav->setCssNameLink('nav');
 * $nav->setIndex($_GET['i']);
 * $nav->setTotalResults($totalList);
 * $nav->showNavigator();
 * ?>
 * </code>
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.2:25-08-2015
 */
class Cnavigator
{
	/**
	 * Página de los enlaces del navegador
	 *
	 * Ver también: {@link setPage()}, {@link getPage()}
	 * @var string
	 * @access private
	 */
	private $page;

	/**
	 * Índice del LIMIT
	 *
	 * Este valor es el índice del LIMIT de la consulta, por ejemplo: SELECT * FROM tabla LIMIT $index, $resultsPerPage
	 *
	 * Ver también: {@link setIndex()}, {@link getIndex()}
	 * @var integer
	 * @access private 
	 */
	private $index;

	/**
	 * Nombre de la variable del índice
	 *
	 * Con esta propiedad defino el nombre de la variable que se pasa como párametro indicando el indice. Por defecto es "i"
	 *
	 * Ver también: {@link setIndexName()}, {@link getIndexName()}
	 * @var string
     * @access private
	 */
	private $indexName;

	/**
	 * Cantidad de resultados que se muestran por página
	 *
	 * Ver también: {@link setResultsPerPage()}, {@link getResultsPerPage()}
	 * @var integer
     * @access private
	 */
	private $resultsPerPage;

	/**
	 * Cantidad total de resultados de la consulta
	 *
	 * Ver también: {@link setTotalResults()}, {@link getTotalResults()}
	 * @var integer
     * @access private
	 */
	private $totalResults;

	/**
	 * Parámetros que se envían en los enlaces del navegador
	 *
	 * Ver también: {@link setParameters()}, {@link getParameters()}
	 * @var string
     * @access private
	 */
	private $parameters;

	/**
	 * Cantidad de páginas que se muestran
	 *
	 * Este valor determina la cantidad de páginas que se muestran entre los enlaces de Primero - Anterior y Siguiente - Último
	 *
	 * Ver también: {@link setAmountPages()}, {@link getAmountPages()}
	 * @var integer
     * @access private
	 */
	private $amountPages;

	/**
	 * Nombre de la clase de estilo para el texto del navegador
	 *
	 * Ver también: {@link setCssText()}, {@link getCssText()}
	 * @var string
     * @access private
	 */
	private $cssText;

	/**
	 * Nombre de la clase de estilo para los enlaces del navegador
	 *
	 * Ver también: {@link setCssLink()}, {@link getCssLink()}
	 * @var string
     * @access private
	 */
	private $cssLink;

	/**
	 * Nombre de la clase de estilo para el texto de información del navegador
	 *
	 * Ver también: {@link setCssInfo()}, {@link getCssInfo()}
	 * @var string
     * @access private
	 */
	private $cssInfo;

	/**
	 * Nombre de la clase de estilo para las imágenes del navegador
	 *
	 * Ver también: {@link setCssImg()}, {@link getCssImg()}
	 * @var string
     * @access private
	 */
	private $cssImg;

	/**
	 * Url donde están almacenadas las imágenes que se muestran en el navegador
	 *
	 * Imágenes que utiliza la Clase:
	 * - first.gif: Primero
	 * - back.gif: Anterior
	 * - next.gif: Siguiente
	 * - last.gif: Último
	 *
	 * Ver también: {@link setUrlToImages()}, {@link getUrlToImages()}
	 * @var string
     * @access private
	 */
	private $urlToImages;

	/**
	 * Ancla de los enlaces del navegador
	 *
	 * Ver también: {@link setAnchor()}, {@link getAnchor()}
	 * @var string
     * @access private
	 */
	private $anchor;

	/**
	 * Constructor de la clase
	 * 
	 * @return void
	 */
	function __construct()
	{
		require_once (CLASS_LANGUAGE_PATH.CLASS_LANGUAGE.FILE_SLASH.'Cnavigator.php');
	}
    
	/**
	 * Destructor de la clase
	 */
	function __destruct()
	{

	}

	/**
	 * Setea el valor {@link $page page}
	 *
	 * @param string $page indica el valor de page
	 * @return boolean 
	 * @access public
	 */
	public function setPage($page)
	{
		$this->page = $page;
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $index index}
	 *
	 * @param integer $index indica el valor de index
	 * @return boolean 
	 * @access public  
	 */
	public function setIndex($index)
	{
		$this->index = $index;
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $indexName indexName}
	 *
	 * @param string $indexName indica el valor de indexName
	 * @return boolean 
	 * @access public  
	 */
	public function setIndexName($indexName)
	{
		$this->indexName = $indexName;
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $resultsPerPage resultsPerPage}
	 *
	 * @param integer $resultsPerPage indica el valor de resultsPerPage
	 * @return boolean 
	 * @access public  
	 */
	public function setResultsPerPage($resultsPerPage)
	{
		$this->resultsPerPage = $resultsPerPage;
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $totalResults totalResults}
	 *
	 * @param integer $totalResults indica el valor de totalResults
	 * @return boolean 
	 * @access public  
	 */
	public function setTotalResults($totalResults)
	{
		$this->totalResults = $totalResults;
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $parameters parameters}
	 *
	 * @param string $parameters indica el valor de parameters
	 * @return boolean 
	 * @access public  
	 */
	public function setParameters($parameters)
	{
		if ($parameters == '')
		{
			$this->parameters = '';
		}
		else
		{
			$this->parameters = '&'.$parameters;
		}
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $amountPages amountPages}
	 *
	 * @param integer $amountPages indica el valor de amountPages
	 * @return boolean 
	 * @access public  
	 */
	public function setAmountPages($amountPages)
	{
		$this->amountPages = $amountPages;
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $cssText cssText}
	 *
	 * @param string $cssText indica el valor de cssText
	 * @return boolean 
	 * @access public  
	 */
	public function setCssText($cssText)
	{
		$this->cssText = $cssText;
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $cssLink cssLink}
	 *
	 * @param string $cssLink indica el valor de cssLink
	 * @return boolean 
	 * @access public  
	 */
	public function setCssLink($cssLink)
	{
		$this->cssLink = $cssLink;
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $cssInfo cssInfo}
	 *
	 * @param string $cssInfo indica el valor de cssInfo
	 * @return boolean 
	 * @access public  
	 */
	public function setCssInfo($cssInfo)
	{
		$this->cssInfo = $cssInfo;
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $cssImg cssImg}
	 *
	 * @param string $cssImg indica el valor de cssImg
	 * @return boolean 
	 * @access public  
	 */
	public function setCssImg($cssImg)
	{
		$this->cssImg = $cssImg;
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $urlToImages urlToImages}
	 *
	 * @param string $urlToImages indica el valor de urlToImages
	 * @return boolean 
	 * @access public  
	 */
	public function setUrlToImages($urlToImages)
	{
		$this->urlToImages = $urlToImages;
        
        return TRUE;
	}

	/**
	 * Setea el valor {@link $anchor anchor}
	 *
	 * @param string $anchor indica el valor de anchor
	 * @return boolean 
	 * @access public  
	 */
	public function setAnchor($anchor)
	{
		$this->anchor = $anchor;
        
        return TRUE;
	}

	/**
	 * Devuelve el valor {@link $page page}
	 *
	 * @return string
	 * @access public 
	 */
	public function getPage()
	{
		return $this->page;
	}

	/**
	 * Devuelve el valor {@link $index index}
	 *
	 * @return integer
	 * @access public
	 */
	public function getIndex()
	{
		return $this->index;
	}

	/**
	 * Devuelve el valor {@link $indexName indexName}
	 *
	 * @return string
	 * @access public 
	 */
	public function getIndexName()
	{
		return $this->indexName;
	}

	/**
	 * Devuelve el valor {@link $resultsPerPage resultsPerPage}
	 *
	 * @return integer
	 * @access public 
	 */
	public function getResultsPerPage()
	{
		return $this->resultsPerPage;
	}

	/**
	 * Devuelve el valor {@link $totalResults totalResults}
	 *
	 * @return integer
	 * @access public 
	 */
	public function getTotalResults()
	{
		return $this->totalResults;
	}

	/**
	 * Devuelve el valor {@link $parameters parameters}
	 *
	 * @return string
	 * @access public 
	 */
	public function getParameters()
	{
		return $this->parameters;
	}

	/**
	 * Devuelve el valor {@link $amountPages amountPages}
	 *
	 * @return integer
	 * @access public 
	 */
	public function getAmountPages()
	{
		return $this->amountPages;
	}

	/**
	 * Devuelve el valor {@link $cssText cssText}
	 *
	 * @return string
	 * @access public 
	 */
	public function getCssText()
	{
		return $this->cssText;
	}

	/**
	 * Devuelve el valor {@link $cssLink cssLink}
	 *
	 * @return string
	 * @access public 
	 */
	public function getCssLink()
	{
		return $this->cssLink;
	}

	/**
	 * Devuelve el valor {@link $cssInfo cssInfo}
	 *
	 * @return string
	 * @access public 
	 */
	public function getCssInfo()
	{
		return $this->cssInfo;
	}

	/**
	 * Devuelve el valor {@link $cssImg cssImg}
	 *
	 * @return string
	 * @access public 
	 */
	public function getCssImg()
	{
		return $this->cssImg;
	}

	/**
	 * Devuelve el valor {@link $urlToImages urlToImages}
	 *
	 * @return string
	 * @access public 
	 */
	public function getUrlToImages()
	{
		return $this->urlToImages;
	}

	/**
	 * Devuelve el valor {@link $anchor anchor}
	 *
	 * @return string
	 * @access public 
	 */
	public function getAnchor()
	{
		return $this->anchor;
	}

	/**
	 * Muestra el navegador
	 *
	 * @param boolean $showPages [opcional] indica si se muestran o no las páginas del navegador
	 * @return string
	 * @access public 
	 */
	public function showNavigator($showPages = TRUE)
	{
		if ($this->getIndexName() == '')
		{
			$this->setIndexName('i');
		}

		$firstIndex = 0;

		//si los resultados por páginas son menores o iguales a 0, los igualo al total
		//de resultados (se muestra todo en una misma página)
		if ($this->getResultsPerPage() <= 0)
        {
			$this->setResultsPerPage($this->getTotalResults());
		}

		$resto = $this->getTotalResults() % $this->getResultsPerPage();
		if ($resto == 0)
		{
		    $lastIndex = $this->getTotalResults() - $this->getResultsPerPage();
		}
		else
		{
			$lastIndex = $this->getTotalResults() - $resto;
		}


		$firstTitle = CNAVIGATOR_SHOW_NAVIGATOR_FIRST_TITLE;
		$backTitle  = CNAVIGATOR_SHOW_NAVIGATOR_BACK_TITLE;
		$nextTitle  = CNAVIGATOR_SHOW_NAVIGATOR_NEXT_TITLE;
		$lastTitle  = CNAVIGATOR_SHOW_NAVIGATOR_LAST_TITLE;

		//si no define el url de las imagenes, pongo las flechitas
		if ($this->getUrlToImages() != '')
		{
		    $firstImg  = '<img src="'.$this->getUrlToImages().'nav_first.gif" border="0" alt="'.$firstTitle.'" title="'.$firstTitle.'" class="'.$this->getCssImg().'" />';
			$backImg   = '<img src="'.$this->getUrlToImages().'nav_back.gif" border="0" alt="'.$backTitle.'" title="'.$backTitle.'" class="'.$this->getCssImg().'" />';
			$nextImg   = '<img src="'.$this->getUrlToImages().'nav_next.gif" border="0" alt="'.$nextTitle.'" title="'.$nextTitle.'" class="'.$this->getCssImg().'" />';
			$lastImg   = '<img src="'.$this->getUrlToImages().'nav_last.gif" border="0" alt="'.$lastTitle.'" title="'.$lastTitle.'" class="'.$this->getCssImg().'" />';
		    $firstImg2 = '<img src="'.$this->getUrlToImages().'nav_first2.gif" border="0" alt="'.$firstTitle.'" title="'.$firstTitle.'" class="'.$this->getCssImg().'" />';
			$backImg2  = '<img src="'.$this->getUrlToImages().'nav_back2.gif" border="0" alt="'.$backTitle.'" title="'.$backTitle.'" class="'.$this->getCssImg().'" />';
			$nextImg2  = '<img src="'.$this->getUrlToImages().'nav_next2.gif" border="0" alt="'.$nextTitle.'" title="'.$nextTitle.'" class="'.$this->getCssImg().'" />';
			$lastImg2  = '<img src="'.$this->getUrlToImages().'nav_last2.gif" border="0" alt="'.$lastTitle.'" title="'.$lastTitle.'" class="'.$this->getCssImg().'" />';
		}
		else
		{
		    $firstImg  = '&#171;';
			$backImg   = '&#8249;';
			$nextImg   = '&#8250;';
			$lastImg   = '&#187;';
		    $firstImg2 = '&#171;';
			$backImg2  = '&#8249;';
			$nextImg2  = '&#8250;';
			$lastImg2  = '&#187;';
		}

		if ($this->getAnchor() != '')
		{
			$anchor = '#'.$this->getAnchor();
		}
		else
		{
			$anchor = '';
		}

		echo '<div>';

		if ($this->getIndex() <= 0)
    	{
        	//primera página

			$nextIndex = $this->getIndex() + $this->getResultsPerPage();
            
            //controlo si es justo lo que quiero mostrar lo del rango
            if ($this->getTotalResults() > $this->getResultsPerPage())
            {
                if ($this->getUrlToImages() != '')
				{
					echo $firstImg2.'&#160;'.$backImg2;
				}
				else
				{
					echo '<span class="'.$this->getCssText().'">'.$firstImg2.'</span>&#160;<span class="'.$this->getCssText().'">'.$backImg2.'</span>';
				}

				if ($showPages === TRUE)
				{
					$this->showNavigatorPages();
				}
				else
				{
					echo '&#160;';
				}

                if ($this->getUrlToImages() != '')
				{
					echo '<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$nextIndex.$this->getParameters().$anchor.'" title="'.$nextTitle.'">'.$nextImg.'</a>&#160;<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$lastIndex.$this->getParameters().$anchor.'" title="'.$lastTitle.'">'.$lastImg.'</a>';
				}
				else
				{
					echo '<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$nextIndex.$this->getParameters().$anchor.'" class="'.$this->getCssLink().'" title="'.$nextTitle.'">'.$nextImg.'</a>&#160;<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$lastIndex.$this->getParameters().$anchor.'" class="'.$this->getCssLink().'" title="'.$lastTitle.'">'.$lastImg.'</a>';
				}
        	}
		}
        else
       	{
			$backIndex = $this->getIndex() - $this->getResultsPerPage();
        	$nextIndex = $this->getIndex() + $this->getResultsPerPage();
            
        	if ($this->getTotalResults() > $nextIndex)
        	{
        		//páginas intermedias

				if ($this->getUrlToImages() != '')
				{
					echo '<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$firstIndex.$this->getParameters().$anchor.'" title="'.$firstTitle.'">'.$firstImg.'</a>&#160;<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$backIndex.$this->getParameters().$anchor.'" title="'.$backTitle.'">'.$backImg.'</a>';
				}
				else
				{
					echo '<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$firstIndex.$this->getParameters().$anchor.'" class="'.$this->getCssLink().'" title="'.$firstTitle.'">'.$firstImg.'</a>&#160;<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$backIndex.$this->getParameters().$anchor.'" class="'.$this->getCssLink().'" title="'.$backTitle.'">'.$backImg.'</a>';
				}

				if ($showPages === TRUE)
				{
					$this->showNavigatorPages();
				}
				else
				{
					echo '&#160;';
				}

				if ($this->getUrlToImages() != '')
				{
					echo '<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$nextIndex.$this->getParameters().$anchor.'" title="'.$nextTitle.'">'.$nextImg.'</a>&#160;<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$lastIndex.$this->getParameters().$anchor.'" title="'.$lastTitle.'">'.$lastImg.'</a>';
				}
				else
				{
					echo '<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$nextIndex.$this->getParameters().$anchor.'" class="'.$this->getCssLink().'" title="'.$nextTitle.'">'.$nextImg.'</a>&#160;<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$lastIndex.$this->getParameters().$anchor.'" class="'.$this->getCssLink().'" title="'.$lastTitle.'">'.$lastImg.'</a>';
				}
        	}
        	else
        	{
				//última página

				if ($this->getUrlToImages() != '')
				{
					echo '<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$firstIndex.$this->getParameters().$anchor.'" title="'.$firstTitle.'">'.$firstImg.'</a>&#160;<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$backIndex.$this->getParameters().$anchor.'" title="'.$backTitle.'">'.$backImg.'</a>';
				}
				else
				{
					echo '<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$firstIndex.$this->getParameters().$anchor.'" class="'.$this->getCssLink().'" title="'.$firstTitle.'">'.$firstImg.'</a>&#160;<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$backIndex.$this->getParameters().$anchor.'" class="'.$this->getCssLink().'" title="'.$backTitle.'">'.$backImg.'</a>';
				}

				if ($showPages === TRUE)
				{
					$this->showNavigatorPages();
				}
				else
				{
					echo '&#160;';
				}

                if ($this->getUrlToImages() != '')
				{
					echo $nextImg2.'&#160;'.$lastImg2;
				}
				else
				{
					echo '<span class="'.$this->getCssText().'">'.$nextImg2.'</span>&#160;<span class="'.$this->getCssText().'">'.$lastImg2.'</span>';
				}
			}
		}

		echo '</div>';
	}

	/**
	 * Muestra las páginas del navegador
	 *
	 * @return string
	 * @access public 
	 */
	public function showNavigatorPages()
	{
		if ($this->getTotalResults() >= $this->getResultsPerPage())
		{
			$pagesNumbers = ceil($this->getTotalResults() / $this->getResultsPerPage());

            //Inicio cálculo de paginaciones
			if ($pagesNumbers > $this->getAmountPages())
			{
				$j = ceil($this->getIndex() / $this->getResultsPerPage());
                
				if ($j < 1)
				{
					$j = 1;
				}
			}
			else
			{
				$j = 1;
			}

			$tope = $j + $this->getAmountPages() - 1;

			if ($tope > $pagesNumbers)
			{
				$tope = $pagesNumbers;
				$j = $tope - $this->getAmountPages() + 1;
				$index = ($j - 1) * $this->getResultsPerPage();
                
				if ($j <= 0)
				{
					$j = 1;
				}
			}
            //Fin cálculo de paginaciones

			if ($this->getAnchor() != '')
			{
				$anchor = '#'.$this->getAnchor();
			}
			else
			{
				$anchor = '';
			}

			echo '&#160;';
            
			while ($j <= $tope)
			{
				$index = ($j - 1) * $this->getResultsPerPage();
                
				if ($this->getIndex() == $index)
				{
					echo '&#160;<span class="'.$this->getCssText().'">'.$j.'</span>&#160;';
				}
				else
				{
					echo '&#160;<a href="'.$this->getPage().'?'.$this->getIndexName().'='.$index.$this->getParameters().$anchor.'" class="'.$this->getCssLink().'">'.$j.'</a>&#160;';
				}
                
				$j++;
			}
            
			echo '&#160;';
		}
	}

	/**
	 * Muestra información del navegador
	 *
	 * @return string
	 * @access public 
	 */
	public function showNavigatorInfo()
	{
		$frs = $this->getIndex() + 1;
		$lrs = $this->getIndex() + $this->getResultsPerPage();
		if ($lrs > $this->getTotalResults())
		{
			$lrs = $this->getTotalResults();
		}

		if ($this->getTotalResults() > 0)
		{
			echo '<div class="'.$this->getCssInfo().'">'.CNAVIGATOR_SHOW_NAVIGATOR_INFO_RESULTS.' '.$frs.' '.CNAVIGATOR_SHOW_NAVIGATOR_INFO_TO.' '.$lrs.' '.CNAVIGATOR_SHOW_NAVIGATOR_INFO_OF.' '.$this->getTotalResults().'</div>';
		}
		else
		{
			echo '<div class="'.$this->getCssInfo().'">'.CNAVIGATOR_SHOW_NAVIGATOR_INFO_RESULTS.' '.$this->getTotalResults().'</div>';
		}
	}
}
?>